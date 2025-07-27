@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <h1 class="mb-4" style="color: #e06b6b ">Reports</h1>

    <!-- إحصائيات سريعة -->
  <div class="row">
    <div class="col-lg-3 col-6">
        <div class="small-box" style="background-color: #F5A9B8; color: white;">
            <div class="inner">
                <h3>{{ $stats['products'] }}</h3>
                <p>Total Products</p>
            </div>
            <div class="icon">
                <i class="fas fa-box-open"></i>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <div class="small-box" style="background-color: #e06b6b; color: white;">
            <div class="inner">
                <h3>{{ $stats['categories'] }}</h3>
                <p>Total Categories</p>
            </div>
            <div class="icon">
                <i class="fas fa-tags"></i>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <div class="small-box" style="background-color: #f38181; color: white;">
            <div class="inner">
                <h3>{{ $stats['orders'] }}</h3>
                <p>Total Orders</p>
            </div>
            <div class="icon">
                <i class="fas fa-shopping-cart"></i>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <div class="small-box" style="background-color: #FFC8C8; color: black;">
            <div class="inner">
                <h3>${{ $stats['sales'] }}</h3>
                <p>Total Sales</p>
            </div>
            <div class="icon">
                <i class="fas fa-dollar-sign"></i>
            </div>
        </div>
    </div>
</div>

    <!-- جدول تقارير الطلبات (كمثال) -->
    <div class="card">
    <div class="card-header">
      <h3 class="card-title"  style="color: #f38181;">Order Summary</h3>
     
    </div>
    <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Customer</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($orders as $order)
                    <tr>
                        <td>#{{ $order->id }}</td>
                        <td>{{ $order->customer_name }}</td>
                        <td>${{ number_format($order->total, 2) }}</td>
                        <td>
                            <span class="badge badge-{{ $order->status == 'Completed' ? 'success' : ($order->status == 'Pending' ? 'warning' : 'danger') }}">
                                {{ $order->status }}
                            </span>
                        </td>
                        <td>{{ $order->order_date }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">No orders yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

</div>
@endsection

