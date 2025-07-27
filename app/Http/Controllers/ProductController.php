<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
     public function index(Request $request)
    {
        $search = $request->input('search');

        $products = Product::with('category')
            ->when($search, function($query, $search) {
                return $query->where('name', 'like', "%{$search}%");
            })
            ->paginate(5);

        return view('admin.products.index', compact('products', 'search'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
    return view('admin.products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
 public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string',
        'category_id' => 'required|exists:categories,id',
        'price' => 'required|numeric',
        'discount' => 'nullable|numeric',
        'image' => 'required|image',
    ]);

    // رفع الصورة (مثال)
    $imageName = time() . '.' . $request->image->extension();
    $request->image->move(public_path('images'), $imageName);

    // إنشاء المنتج
    Product::create([
        'name' => $request->name,
        'category_id' => $request->category_id, // 👈 هذا هو المطلوب
        'price' => $request->price,
        'discount' => $request->discount ?? 0,
        'image' => $imageName,
        'user_id' => auth()->id(), // إذا عندك ربط مع المستخدم
    ]);

    return redirect()->route('admin.products.index')->with('success', __('message.product_saved'));
}


    /**
     * Display the specified resource.
     */
public function show($id)
{
    $product = Product::findOrFail($id);

    // إذا بدك تجيب كمية المنتج من السلة (للمستخدم الحالي)
    $quantity = 0;
    if(auth()->check()){
        $cartItem = auth()->user()->productsInCart()->where('product_id', $id)->first();
        if ($cartItem) {
            $quantity = $cartItem->pivot->quantity;
        }
    }

    return view('products.show', compact('product', 'quantity'));
}



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
         $categories =Category::all();
    return view('admin.products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
{
    $request->validate([
         'name' => 'required|string|max:255',
    'price' => 'required|numeric|min:0',
    'category_id' => 'required|exists:categories,id',
    'discount' => 'required|numeric|min:0|max:100',
    'image' => 'nullable|image|max:2048',
    ]);

    $product->name = $request->name;
    $product->category_id = $request->category_id;
    $product->price = $request->price;
    $product->discount = $request->discount ?? 0;

    if ($request->hasFile('image')) {
        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('images'), $imageName);
        $product->image = $imageName;
    }

    $product->save();

    return redirect()->route('admin.products.index')->with('success', 'تم تحديث المنتج بنجاح');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        if ($product->image && file_exists(public_path('images/' . $product->image))) {
        unlink(public_path('images/' . $product->image));
    }

    $product->delete();

    return redirect()->route('admin.products.index')->with('success', 'تم حذف المنتج بنجاح.');
    }

    public function rate(Request $request,Product $product)
{
    if(auth()->user()->rated($product)) {
           $rating = Rating::where(['user_id' => auth()->user()->id, 'product_id' => $product->id])->first();
            $rating->value = $request->value;
            $rating->save();

    }else {
            $rating = new Rating();
            $rating->user_id = auth()->user()->id;
            $rating->product_id = $product->id;
            $rating->value = $request->value;
            $rating->save();
        }
        return back();
    }
}
