<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'dashboard')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

   
  <!-- Preloader Style -->
  <style>
    #preloader {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: #fff;
      z-index: 9999;
      display: flex;
      justify-content: center;
      align-items: center;
    }
    .loader {
      border: 5px solid #f3f3f3;
      border-top: 5px solid #c26b6b;
      border-radius: 50%;
      width: 60px;
      height: 60px;
      animation: spin 1s linear infinite;
    }
    @keyframes spin {
      0% { transform: rotate(0deg); }
      100% { transform: rotate(360deg); }
    }
  </style>
    
<!-- CSS -->


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>



    <!-- Livewire Styles -->
     @livewireStyles
   @yield('head')
  <style>
   
      @font-face {
        font-family: 'Tajawal';
        src: url('/fonts/Tajawal-Regular.woff2') format('woff2');
      }

     @font-face {
      font-family: 'PlayfairDisplay';
      src: url('/fonts/Playfair_Display/PlayfairDisplay-VariableFont_wght.ttf') format('truetype');
      font-weight: normal;
      font-style: normal;
    }


      body {
        font-family: 'Tajawal', sans-serif;
      }

      html[lang="en"] body {
        font-family: 'Playfair Display', serif;
      }

         
    </style>
@vite(['resources/css/bootstrap.css'])
<link rel="stylesheet" href="{{ asset('adminlte/admin.css') }}">
</head>
<!-- Preloader -->
<div id="preloader">
    <div class="loader"></div>
</div>

<body class="hold-transition sidebar-mini">
<div class="wrapper">

    <!-- Navbar + Sidebar -->
    @include('themes.header')
    @include('themes.sidebar')

    <!-- Main Content -->
    <div class="content-wrapper">
        @yield('content')
    </div>

    <!-- Footer (اختياري) -->
    {{-- @include('layouts.admin-footer') --}}

</div>

<!-- Charts (اختياري) -->
<script>
  
  document.addEventListener('DOMContentLoaded', function () {
    // Area chart
    var ctxArea = document.getElementById('revenue-chart-canvas')?.getContext('2d');
    if (ctxArea) {
      new Chart(ctxArea, {
        type: 'line',
        data: {
          labels: ['January', 'February', 'March', 'April'],
          datasets: [{
            label: 'Sales',
            data: [100, 200, 150, 300],
            backgroundColor: 'rgba(60,141,188,0.2)',
            borderColor: 'rgba(60,141,188,1)',
            borderWidth: 1,
            fill: true,
          }]
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
        }
      });
    }

    // Donut chart
    var ctxDonut = document.getElementById('sales-chart-canvas')?.getContext('2d');
    if (ctxDonut) {
      new Chart(ctxDonut, {
        type: 'doughnut',
        data: {
          labels: ['Online', 'In-store', 'Mail-order'],
          datasets: [{
            data: [60, 25, 15],
            backgroundColor: ['#f56954', '#00a65a', '#f39c12'],
          }]
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
        }
      });
    }
  });
     // Preloader hide after load
   document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('preloader').style.display = 'none';
  });
</script>

@stack('scripts')
@livewireScripts
@vite(['resources/js/app.js', 'resources/js/admin.js'])
</body>
</html>


