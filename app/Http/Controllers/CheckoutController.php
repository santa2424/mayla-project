<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Stripe\Stripe;
use Stripe\Checkout\Session;

class CheckoutController extends Controller
{
    public function process(Request $request)
    {
        $request->validate([
            'payment_method' => 'required|in:cash,gateway',
        ]);

        if ($request->payment_method === 'cash') {
            return $this->processCashOrder();
        }

        if ($request->payment_method === 'gateway') {
            return $this->processGatewayOrder($request);
        }

        return redirect()->back()->with('error', 'طريقة الدفع غير مدعومة.');
    }

    protected function processCashOrder()
    {
        $user = Auth::user();
        $cartItems = $user->cartItems;

        if ($cartItems->isEmpty()) {
            return redirect()->back()->with('message', 'السلة فارغة');
        }

        $total = $cartItems->sum(fn($item) => $item->price * $item->pivot->quantity);

        $order = $user->orders()->create([
            'customer_name' => $user->name,
            'total' => $total,
            'payment_method' => 'cash',
            'status' => 'pending',
            'user_id' => $user->id,
            'order_date' => now()->toDateString(),
        ]);

        foreach ($cartItems as $item) {
            $order->products()->attach($item->id, [
                'quantity' => $item->pivot->quantity,
                'price' => $item->price,
            ]);
        }

        $user->cartItems()->detach();

        return redirect()->back()->with('message', 'تم إنشاء الطلب والدفع كاش.');
    }

    protected function processGatewayOrder(Request $request)
    {
        $user = Auth::user();
        $cartItems = $user->cartItems;

        if ($cartItems->isEmpty()) {
            return redirect()->back()->with('message', 'السلة فارغة');
        }

        $total = $cartItems->sum(fn($item) => $item->price * $item->pivot->quantity);

        Stripe::setApiKey(config('services.stripe.secret'));

        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => [
                        'name' => 'طلب المستخدم ' . $user->name,
                    ],
                    'unit_amount' => (int)($total * 100), // السعر بالسنت
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => route('checkout.success'),
            'cancel_url' => route('checkout.cancel'),
        ]);

        // هنا ممكن تحفظي الطلب في حالة "قيد الدفع" لو حابة، أو بعد نجاح الدفع فقط

        // تحويل المستخدم مباشرة لصفحة دفع Stripe
        return redirect($session->url);
    }

    // مثلاً صفحة نجاح الدفع
    public function success()
    {
        // هنا تفرغي سلة المستخدم مثلا أو تعطي رسالة نجاح
        return view('credit.success');
    }

    // صفحة إلغاء الدفع
    public function cancel()
    {
        return view('checkout.cancel');
    }
}
