@extends('layouts.admin')
@section('content')
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
<div class="container mt-4">
    <h2>{{ __('message.product_list') ?? 'Product List' }}</h2>
    <!-- زر إضافة منتج جديد -->
<div class="mb-3 text-end">
    <a href="{{ route('admin.products.create') }}" class="btn" style="background-color: #FFC8C8">
        <i class="fas fa-plus"></i>{{ __('message.add_new_product') }}
    </a>
</div>


    <!-- نموذج البحث -->
    <form action="{{ route('admin.products.index') }}" method="GET" class="mb-3">
        <div class="input-group" style="max-width: 400px;">
            <input type="text" name="search" class="form-control"  placeholder="{{ __('message.search_placeholder') }}" value="{{ old('search', $search ?? '') }}">
            <button class="btn" style="background-color: #FFC8C8" type="submit">{{ __('message.search') }}</button>
        </div>
    </form>

    <table class="table table-bordered">
        <thead>
            <tr>
            <th>{{ __('message.image') }}</th>
            <th>{{ __('message.name') }}</th>
            <th>{{ __('message.category') }}</th>
            <th>{{ __('message.price') }}</th>
            <th>{{ __('message.discount') }}</th>
            <th>{{ __('message.price_after_discount') }}</th>
            <th></th>
            </tr>
        </thead>
        <tbody>
            @forelse($products as $product)
            <tr>
                <td>
                    @if($product->image && file_exists(public_path('images/' . $product->image)))
                        <img src="{{ asset('images/' . $product->image) }}" alt="{{ $product->name }}" style="width: 70px; height: 70px; object-fit: cover;">
                    @else
                       {{ __('message.no_products') }}
                    @endif
                </td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->category->name ?? '—' }}</td>
                <td>{{ $product->price }} $</td>
                <td>{{ $product->discount }}%</td>
                <td>{{ number_format($product->getDiscountedPrice(), 2) }} $</td>
                <td>
    <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-sm" style="background-color: #FFC8C8">
        <i class="fas fa-edit"></i>
    </a>

        <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('{{ __('message.delete_confirm') }}');">
            @csrf
            @method('DELETE')
            <button class="btn btn-sm" style="background-color: #FF0B55">
                <i class="fas fa-trash"></i>
            </button>
        </form>
</td>

            </tr>
            @empty
            <tr>
                <td colspan="6">لا توجد منتجات حالياً</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <!-- أزرار التصفح -->
    <div>
        {{ $products->appends(['search' => $search])->links() }}
    </div>
</div>
@endsection
