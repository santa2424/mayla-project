<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class DiscountController extends Controller
{
    public function create()
    {
        $products = Product::all();
        return view('admin.discounts.create', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'discount' => 'required|numeric|min:0|max:100',
        ]);

        $product = Product::findOrFail($request->product_id);
        $product->discount = $request->discount;
        $product->save();

        return redirect()->back()->with('success', 'تم تطبيق الخصم بنجاح!');
    }
}
