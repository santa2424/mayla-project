<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Notifications\DatabaseNotification;
use App\Notifications\PromotionalNotification;




class NotificationController extends Controller
{
    public function index()
    {
        $notifications = DatabaseNotification::where('type', PromotionalNotification::class)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.notifications.index', compact('notifications'));
    }

}
