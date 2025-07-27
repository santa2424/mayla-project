@extends('layouts.main')
@section('content')
@extends('layouts.main')

@section('content')
<div class="container py-5">
    <div class="row">
        <!-- صورة المنتج -->
        <div class="col-md-6">
            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="img-fluid rounded shadow">
        </div>

        <!-- تفاصيل المنتج -->
        <div class="col-md-6">
            <h1 class="mb-3">{{ $product->name }}</h1>
            <h3 class="text-danger mb-4">{{ number_format($product->price) }} ل.س</h3>
            
            <p class="mb-4">
                {{ $product->description ?? 'No description available.' }}
            </p>

            <!-- أزرار -->
            <div class="mb-3">
                <a href="#" class="btn btn-primary me-2">Add to Cart</a>
                <a href="{{ route('products') }}" class="btn btn-outline-secondary">Back to Products</a>
            </div>

            <!-- يمكنك إضافة تفاصيل أخرى مثل التصنيف، التقييم، حالة المخزون، ... -->
        </div>
    </div>
</div>
@endsection

    
@endsection