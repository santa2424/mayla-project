<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification;


class OrderController extends Controller
{
    public function index()
    {
        // جلب الطلبات مع بيانات المستخدم والمنتجات المرتبطة بالطلب
        $orders = Order::with('user', 'products')->latest()->paginate(15);

        return view('admin.orders.index', compact('orders'));
    }

 
public function confirmPayment(Order $order)
{
    $order->status = 'Completed'; // أو حسب القيمة الموجودة في enum
    $order->save();

    return redirect()->back()->with('success', 'تم تأكيد الدفع بنجاح.');
}
public function destroy(Order $order)
{
    // حذف الطلب وكل علاقاته المرتبطة إذا أردت
    $order->delete();

    return redirect()->back()->with('success', 'تم حذف الطلب بنجاح.');
}


}
