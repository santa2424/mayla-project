@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h2>تعديل الفئة</h2>

    <form action="{{ route('categories.update', $category->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name">اسم الفئة</label>
            <input 
                type="text" 
                name="name" 
                id="name" 
                class="form-control @error('name') is-invalid @enderror" 
                value="{{ old('name', $category->name) }}"
                required
            >
            @error('name')
                <div class="text-danger mt-1" style="font-size: 0.875em;">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">تحديث</button>
        <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">إلغاء</a>
    </form>
</div>
@endsection
