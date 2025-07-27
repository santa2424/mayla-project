@extends('layouts.admin')

@section('content')
<section class="content">
  <div class="container-fluid">

    <!-- Stat Boxes -->
    <div class="row">
      <!-- المنتجات -->
      <div class="col-xl-3 col-md-6 col-sm-12 mb-4">
        <div class="small-box box-pink1 h-100">
          <div class="inner">
            <h3>{{ \App\Models\Product::count() }}</h3>
            <p>{{ __('dashboard.products') }}</p>
          </div>
          <div class="icon">
            <i class="fas fa-box-open"></i>
          </div>
          <a href="{{ route('admin.products.index') }}" class="small-box-footer">
            {{ __('dashboard.more') }} <i class="fas fa-arrow-circle-right"></i>
          </a>
        </div>
      </div>

      <!-- الفئات -->
      <div class="col-xl-3 col-md-6 col-sm-12 mb-4">
        <div class="small-box box-pink2 h-100">
          <div class="inner">
            <h3>{{ \App\Models\Category::count() }}</h3>
            <p>{{ __('dashboard.categories') }}</p>
          </div>
          <div class="icon">
            <i class="fas fa-tags"></i>
          </div>
          <a href="{{ route('admin.categories.index') }}" class="small-box-footer">
            {{ __('dashboard.more') }} <i class="fas fa-arrow-circle-right"></i>
          </a>
        </div>
      </div>

      <!-- الطلبات -->
      <div class="col-xl-3 col-md-6 col-sm-12 mb-4">
        <div class="small-box box-pink3 h-100">
          <div class="inner">
            <h3>{{ \App\Models\Order::count() }}</h3>
            <p>{{ __('dashboard.orders') }}</p>
          </div>
          <div class="icon">
            <i class="fas fa-shopping-cart"></i>
          </div>
          <a href="{{ route('admin.reports.index') }}" class="small-box-footer">
            {{ __('dashboard.more') }} <i class="fas fa-arrow-circle-right"></i>
          </a>
        </div>
      </div>

      <!-- رسائل الاتصال -->
      <div class="col-xl-3 col-md-6 col-sm-12 mb-4">
        <div class="small-box box-pink4 h-100">
          <div class="inner">
            <h3>{{ \App\Models\ContactMessage::count() }}</h3>
            <p>{{ __('dashboard.contact_messages') }}</p>
          </div>
          <div class="icon">
            <i class="fas fa-envelope"></i>
          </div>
          <a href="{{ route('admin.messages.index') }}" class="small-box-footer">
            {{ __('dashboard.more') }} <i class="fas fa-arrow-circle-right"></i>
          </a>
        </div>
      </div>
    </div>

    <!-- Divider -->
    <hr class="my-5" />

    <!-- Chart Section -->
    <div class="row justify-content-center">
      <div class="col-md-8 col-sm-12">
        <div class="card shadow-sm">
          <div class="card-body">
            <h5 class="text-center mb-4">{{ __('dashboard.products_chart_title') }}</h5>
            <canvas id="ordersChart" width="250" height="300"></canvas>

          </div>
        </div>
      </div>
    </div>

  </div>
</section>

{{-- إضافة سكربت الرسم --}}
@php
    $categories = ['Concealer', 'Eyeshadow', 'Lipstick', 'Makeup Brushes', 'Mascara'];
    $labels = [];
    $counts = [];

    foreach ($categories as $catName) {
        $category = \App\Models\Category::where('name', $catName)->first();
        if ($category) {
            // يمكن ترجمة اسم التصنيف لو عندك ملف ترجمة لفئات المكياج
            $labels[] = $catName;
            $counts[] = \App\Models\Product::where('category_id', $category->id)->count();
        }
    }
@endphp

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const ctx = document.getElementById('ordersChart')?.getContext('2d');

    if (ctx) {
      const chart = new Chart(ctx, {
        type: 'doughnut',
        data: {
          labels: @json($labels),
          datasets: [{
            label: '{{ __("dashboard.makeup_products_distribution") }}',
            data: @json($counts),
            backgroundColor: ['#FFC8C8', '#f38181', '#e06b6b', '#F9A1A1', '#F5A9B8']
          }]
        },
        options: {
          responsive: true,
          plugins: {
            legend: {
              position: 'bottom'
            },
            title: {
              display: true,
              text: '{{ __("dashboard.makeup_products_distribution") }}',
              font: {
                size: 18
              }
            }
          }
        }
      });
    }
  });
</script>
@endpush

@endsection
