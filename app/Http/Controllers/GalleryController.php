<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index(Request $request)
{
    $products = Product::paginate(12);

    $title = 'معرض الكتب';
    $categories = Category::all(); // ✅ استدعاء التصنيفات الصحيحة

    return view('Pages.products', compact('products', 'title', 'categories'));
}

public function show(Product $product)
{
    return view('product.details', compact('product'));
}



public function search(Request $request)
{
    $query = Product::query();

    // فلترة بالبحث
    if ($request->filled('search')) {
        $query->where('name', 'LIKE', '%' . $request->search . '%');
    }

    // فلترة بالفئة
    if ($request->filled('category')) {
        $query->where('category_id', $request->category);
    }

    // فلترة بالسعر
    if ($request->filled('priceRange')) {
        switch ($request->priceRange) {
            case 'under_50':
                $query->where('price', '<', 50);
                break;
            case '50_100':
                $query->whereBetween('price', [50, 100]);
                break;
            case 'over_100':
                $query->where('price', '>', 100);
                break;
        }
    }

    // الترتيب
    switch ($request->input('sort')) {
        case 'price_low_high':
            $query->orderBy('price', 'asc');
            break;
        case 'price_high_low':
            $query->orderBy('price', 'desc');
            break;
        case 'rating':
            $query->orderBy('rating', 'desc');
            break;
        default:
            $query->orderBy('created_at', 'desc');
    }

    // إذا الطلب من AJAX (مثلاً عند وجود متغير search في الجيت)
    if ($request->ajax()) {
        $products = $query->get();
        return response()->json($products);
    }

    // الطلب عادي (صفحة كاملة مع pagination)
    $products = $query->paginate(12)->withQueryString();
    $categories = Category::select('id', 'name')->get();
    $title = 'Your Beauty Starts Here';

    return view('pages.products', compact('products', 'title', 'categories'));
}

    public function home()
{
    $featuredProducts = Product::take(10)->get(); // تجلب 5 منتجات فقط
    return view('pages.home', compact('featuredProducts'));
}

}
