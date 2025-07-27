<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Order;

class ReportController extends Controller
{
    public function index()
   {
    $orders = Order::latest()->take(10)->get(); // آخر 10 طلبات
    $stats = [
        'products' => Product::count(),
        'categories' => Category::count(),
        'orders' => Order::count(),
        'sales' => Order::sum('total'),
    ];

    return view('admin.reports.index', compact('stats', 'orders'));
    }

}
