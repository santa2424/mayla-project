@extends('layouts.admin')

@section('title', 'Orders')

@section('content')
@if(session('message'))
    <div class="alert alert-success">
        {{ session('message') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif


<div class="container-fluid">
    <h1 class="mb-4">{{ __('message.orders_title') }}</h1>

    @if($orders->count())
        <table class="table table-bordered table-hover text-center">
            <thead>
                <tr>
                 <th>{{ __('message.order_id') }}</th>
            <th>{{ __('message.user_name') }}</th>
            <th>{{ __('message.order_date') }}</th>
            <th>{{ __('message.products_quantity') }}</th>
            <th>{{ __('message.total') }}</th>
            <th>{{ __('message.payment_method') }}</th>
            <th>{{ __('message.status') }}</th>
            <th>{{ __('message.confirm_payment') }}</th>
            <th>{{ __('message.delete_order') }}</th>
    
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->user->name ?? 'Unknown' }}</td>
                        <td>{{ $order->order_date ?? $order->created_at->format('Y-m-d') }}</td>
                        <td>
                            <ul class="list-unstyled text-start">
                                @foreach($order->products as $product)
                                    <li class="d-flex align-items-center mb-2">
                                        @if($product->image)
                                            <img src="{{ asset('images/' . $product->image) }}" alt="{{ $product->name }}" style="width: 50px; height: 50px; object-fit: cover; border-radius: 4px; margin-right: 10px;">
                                        @else
                                            <div style="width: 50px; height: 50px; background: #eee; display: inline-block; margin-right: 10px; border-radius: 4px; line-height: 50px; font-size: 12px; color: #999;">{{ __('message.no_image') }}</div>
                                        @endif
                                        <span>{{ $product->name }} - Quantity: {{ $product->pivot->quantity }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </td>
                        <td>{{ $order->total }} $</td>
                        <td>{{ ucfirst($order->payment_method) }}</td>
                        <td>{{ ucfirst($order->status) }}</td>
                        <td>
                            <form action="{{ route('admin.orders.confirmPayment', $order->id) }}" method="POST">
    @csrf
    @method('PUT')
    <button type="submit" class="btn btn-success btn-sm">{{ __('message.confirm_payment') }}</button>
</form>

                        </td>
                        <td>
    <form action="{{ route('admin.orders.destroy', $order->id) }}" method="POST" onsubmit="return confirmconfirm('{{ __('message.delete_confirm') }}');">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger btn-sm">{{ __('message.delete_order') }}</button>
    </form>
</td>

                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $orders->links() }}
    @else
        <div class="alert alert-info text-center">No orders found.</div>
    @endif
</div>
@endsection
