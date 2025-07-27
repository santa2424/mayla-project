<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('signin') }} - @yield('title')</title>

    <!-- استيراد CSS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
     @vite(['resources/js/app.js'])
     
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
  <style>
    body {
      font-family: 'Tajawal', sans-serif;
    }
    html[lang="en"] body {
      font-family: 'Playfair Display', serif;
    }
</style>
</head>
<body class="hold-transition login-page">
 <!-- Preloader -->
  <div id="preloader">
    <div class="loader"></div>
  </div>

    @yield('content')

   <script>
    // Preloader hide after load
    window.addEventListener('load', function () {
      document.getElementById('preloader').style.display = 'none';
    });
   </script>
   @stack('scripts')
</body>
</html>
