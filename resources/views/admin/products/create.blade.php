@extends('layouts.admin')

@section('content')
<div class="container mt-5">
    <h2>{{ __('message.add_product') }}</h2>

    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label>{{ __('message.product_name') }}</label>
           <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}">
           @error('name')
            <div class="text-danger mt-1" style="font-size: 0.875em;">
                {{ $message }}
            </div>
        @enderror
        </div>

        <div class="mb-3">
    <label>{{ __('message.category') }}</label>
    <select name="category_id" class="form-control @error('category_id') is-invalid @enderror" required>
        <option value="">{{ __('message.select_category') }}</option>
        @foreach($categories as $category)
            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                {{ $category->name }}
            </option>
        @endforeach
    </select>
    @error('category_id')
        <div class="text-danger mt-1" style="font-size: 0.875em;">
            {{ $message }}
        </div>
    @enderror
</div>



      <div class="mb-3">
    <label>{{ __('message.price') }} ($)</label>
    <input type="number" name="price" class="form-control @error('price') is-invalid @enderror" step="0.01" required value="{{ old('price') }}">
    @error('price')
        <div class="text-danger mt-1" style="font-size: 0.875em;">
            {{ $message }}
        </div>
    @enderror
</div>

        <div class="mb-3">
            <label>{{ __('message.discount') }} (%)</label>
            <input type="number" name="discount" class="form-control @error('discount') is-invalid @enderror" step="1" min="0" max="100" value="{{ old('discount', 0) }}">
            @error('discount')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label>{{ __('message.image') }}</label>
            <input type="file" name="image" class="form-control-file @error('image') is-invalid @enderror">
            @error('image')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-success">{{ __('message.submit') }}</button>
        <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">{{ __('message.back') }}</a>
    </form>
</div>
@endsection
