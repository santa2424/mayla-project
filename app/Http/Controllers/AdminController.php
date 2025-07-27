<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Notifications\PromotionalNotification;
use Illuminate\Http\Request;

class AdminController extends Controller
{
     // عرض فورم الإشعار
    public function showNotificationForm()
    {
        return view('admin.send-promo');
    }

    // تنفيذ إرسال الإشعار
    public function sendPromotionalNotification(Request $request)
    {
      $request->validate([
    'title' => 'required|string|max:255',
    'message' => 'required|string|max:1000',
]);


        $message = $request->input('message');

        foreach (User::all() as $user) {
           $user->notify(new PromotionalNotification($request->message, $request->title)); // صح

        }

        return redirect()->back()->with('success', 'تم إرسال الإشعار الترويجي لجميع المستخدمين.');
    }
}
