<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Stripe\Stripe;
use Stripe\PaymentIntent;
use Stripe\SetupIntent;
use App\Mail\OrderMail;
use Illuminate\Support\Facades\Mail;

class PurchaseController extends Controller
{
 
      public function sendOrderConfirmationMail($order, $user)
    {
        Mail::to($user->email)->send(new OrderMail($order, $user));
    }
    
public function creditCheckout(Request $request)
{
    \Stripe\Stripe::setApiKey(config('services.stripe.secret'));

    $user = auth()->user();

    $customerId = $user->stripe_id ?: $user->createOrGetStripeCustomer()->id;

    $intent = SetupIntent::create([
        'customer' => $customerId,
        'payment_method_types' => ['card'], // فقط بطاقات
    ]);

    $products = $user->productsInCart;
    $total = 0;
    foreach ($products as $product) {
        $total += $product->price * $product->pivot->quantity;
    }

    return view('credit.checkout', compact('total', 'intent'));
}
    public function purchase(Request $request)
    {
        $user          = $request->user();
        $paymentMethod = $request->input('payment_method');

        $userId = auth()->user()->id;
        $products = User::find($userId)->productsInCart;
        $total = 0;
        foreach($products as $product) {
            $total += $product->price * $product->pivot->quantity;
        }

        try {
            $user->createOrGetStripeCustomer();
            $user->updateDefaultPaymentMethod($paymentMethod);
            $user->charge($total * 100, $paymentMethod);
        } catch (\Exception $exception) {
            return back()->with('error', 'حصل خطأ أثناء شراء المنتج، الرجاء التأكد من معلومات البطاقة');

        }
        $this->sendOrderConfirmationMail($products, auth()->user());

        foreach($products as $product) {
            $productPrice = $product->price;
            $purchaseTime = Carbon::now();
            $user->productsInCart()->updateExistingPivot($product->id, ['bought' => TRUE, 'price' => $productPrice, 'created_at' => $purchaseTime]);
            $product->save();
        }
        dd('تم الدفع');
        return redirect('/cart')->with('message', 'تم شراء المنتج بنجاح');   
    }


    public function cashCheckout()
    {
        $user = Auth::user();
        $cartItems = $user->productsInCart;

        if ($cartItems->isEmpty()) {
            return back()->with('error', 'السلة فارغة!');
        }

        $total = 0;

        // إنشاء الطلب
        $order = Order::create([
            'user_id' => $user->id,
            'customer_name' => $user->name,
            'total' => $cartItems->sum(fn($item) => $item->pivot->quantity * $item->price),
            'payment_method' => 'cash',
            'status' => 'pending',
        ]);

        // ربط المنتجات بالطلب
        foreach ($cartItems as $item) {
            $order->products()->attach($item->id, ['quantity' => $item->pivot->quantity, 'price' => $item->price,]);
        }

        // حذف محتويات السلة
        $user->productsInCart()->detach();

        return redirect()->route('cart.view')->with('success', 'تم إرسال طلبك والدفع عند الاستلام.');
    }

   
}
