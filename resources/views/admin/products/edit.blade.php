@extends('layouts.admin')

@section('content')
<div class="container mt-4">
   <h2 class="mb-4">{{ __('message.edit_product') }}</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
           <strong>{{ __('message.errors_occurred') }}</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- الاسم -->
        <div class="mb-3">
            <label for="name" class="form-label">{{ __('message.product_name') }}</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $product->name) }}" required>
        </div>

        <!-- الفئة -->
        <div class="mb-3">
            <label for="category_id" class="form-label">{{ __('message.category') }}</label>
            <select name="category_id" class="form-control" required>
                <option value="">--{{ __('message.select_category') }}--</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- السعر -->
        <div class="mb-3">
            <label for="price" class="form-label">{{ __('message.price') }} ($)</label>
            <input type="number" name="price" class="form-control" value="{{ old('price', $product->price) }}" step="0.01" required>
        </div>

        <!-- الخصم -->
        <div class="mb-3">
            <label for="discount" class="form-label">{{ __('message.discount') }} (%)</label>
            <input type="number" name="discount" class="form-control" value="{{ old('discount', $product->discount) }}" min="0" max="100">
        </div>

        <!-- الصورة الحالية -->
        @if($product->image && file_exists(public_path('images/' . $product->image)))
            <div class="mb-3">
                <label class="form-label">{{ __('message.current_image') }}</label><br>
                <img src="{{ asset('images/' . $product->image) }}" alt="{{ $product->name }}" style="width: 100px; height: 100px; object-fit: cover;">
            </div>
        @endif

        <!-- تغيير الصورة -->
        <div class="mb-3">
            <label for="image" class="form-label">{{ __('message.update_image') }}</label>
            <input type="file" name="image" class="form-control">
        </div>

        <!-- زر الحفظ -->
        <button type="submit" class="btn btn-primary">
            <i class="fas fa-save"></i>  {{ __('message.save_changes') }} 
        </button>
        <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">{{ __('message.cancel') }}</a>
    </form>
</div>
@endsection
