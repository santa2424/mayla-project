<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth;
class CartController extends Controller
{
  public function __construct()
    {
        $this->middleware('auth');
    }




   public function addToCart(Request $request)
{
    $product = Product::find($request->id);
    if (!$product) {
        return response()->json(['error' => 'المنتج غير موجود'], 404);
    }

    if(auth()->user()->productsInCart->contains($product)){
        $currentQuantity = auth()->user()->productsInCart()->where('product_id', $product->id)->first()->pivot->quantity;
        $newQuantity= $request->quantity + $currentQuantity;

        if($newQuantity > $product->quantity) {
            return response()->json([
                'error' => 'لم تتم إضافة المنتج، لقد تجاوزت عدد النسخ الموجودة لدينا، أقصى عدد موجود بإمكانك حجزه من هذا المنتج هو ' . ($product->quantity - $currentQuantity) . ' منتج'
            ], 422);
        }

        auth()->user()->productsInCart()->updateExistingPivot($product->id, ['quantity'=> $newQuantity]);
    } else {
        if($request->quantity > $product->quantity){
            return response()->json([
                'error' => 'لم تتم إضافة المنتج، الكمية المطلوبة أكبر من المخزون المتوفر'
            ], 422);
        }
        auth()->user()->productsInCart()->attach($request->id, ['quantity'=> $request->quantity]);
    }

    $num_of_product = auth()->user()->productsInCart()->sum('product_user.quantity');

    return response()->json(['num_of_product' => $num_of_product]);
}


    public function viewCart()
    {
        $items = auth()->user()->productsInCart;
        return view('pages.cart',compact('items'));
    }

    public function removeOne(Product $product)
    {
        $oldQuantity = auth()->user()->productsInCart()->where('product_id',$product->id)->first()->pivot->quantity;
        if($oldQuantity > 1){
            auth()->user()->productsInCart()->updateExistingPivot($product->id, ['quantity'=> --$oldQuantity]);
        }else
        {
            auth()->user()->productsInCart()->detach($product->id);
        }
        return redirect()->back();
    }

    public function removeAll(Product $product)
    {
        auth()->user()->productsInCart()->detach($product->id);
        return redirect()->back();
    }

    
   public function purchaseSelected(Request $request)
{
    $user = auth()->user();
    $selectedIds = $request->input('selected_products', []);

    if (empty($selectedIds)) {
        return back()->with('error', 'يرجى تحديد منتج واحد على الأقل.');
    }

    $paymentMethod = $request->input('payment_method', 'cash');

    // استرجاع المنتجات المحددة من العلاقة productsInCart
    $selectedProducts = $user->productsInCart()->whereIn('product_id', $selectedIds)->get();

    if ($selectedProducts->isEmpty()) {
        return back()->with('error', 'لم يتم العثور على المنتجات المحددة في السلة.');
    }

    // احسبي المجموع
    $total = 0;
    foreach ($selectedProducts as $product) {
        $total += $product->price * $product->pivot->quantity;
    }

    // (مثال) إنشاء الطلب:
    // $order = Order::create([...]);

    // إزالة المنتجات المحددة من السلة:
    $user->productsInCart()->detach($selectedIds);

    return back()->with('message', 'تم إتمام الطلب بنجاح للمنتجات المحددة.');
}






}
