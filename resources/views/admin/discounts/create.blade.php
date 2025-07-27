@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h4>{{ __('message.add_discount_title') }}</h4>
    <form action="{{ route('admin.discounts.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="product_id">{{ __('message.select_product') }}</label>
            <select name="product_id" class="form-control" required>
                @foreach($products as $product)
                    <option value="{{ $product->id }}">{{ $product->name }} - {{ $product->price }} $</option>
                @endforeach
            </select>
        </div>

        <div class="form-group mt-3">
            <label for="discount">{{ __('message.discount_percentage') }}</label>
            <input type="number" name="discount" class="form-control" min="0" max="100" required>
        </div>

        <button type="submit" class="btn mt-3" style="background-color: #c26b6b; color: #fff;">{{ __('message.apply_discount') }}</button>
    </form>
</div>
@endsection
