<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Str;
use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $categories = Category::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
        ]);

        // إنشاء الفئة
        Category::create([
            'name' => $validated['name'],
            'slug' => \Str::slug($validated['name']),
        ]);

        // إعادة التوجيه مع رسالة نجاح
        return redirect()->route('admin.categories.index')->with('success', 'تمت إضافة الفئة بنجاح.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
          return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $category->id,
        ]);

        $category->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ]);

        return redirect()->route('admin.categories.index')->with('success', 'تم تحديث الفئة بنجاح.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
         $category->delete();

        return redirect()->route('admin.categories.index')->with('success', 'تم حذف الفئة بنجاح.');
    }
}
