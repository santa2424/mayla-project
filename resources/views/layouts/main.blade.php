<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <title>Mayla Cosmetics</title>


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

  <!-- External CSS Libraries -->

 <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
  

  @yield('head')

  <style>
    body {
      font-family: 'Tajawal', sans-serif;
    }
    html[lang="en"] body {
      font-family: 'Playfair Display', serif;
    }

    /* Offcanvas menu styles */
    .offcanvas-menu {
      position: fixed;
      top: 0;
      bottom: 0;
      width: 250px;
      z-index: 1050;
      background-color: #fff;
      box-shadow: 0 0 15px rgba(0,0,0,0.2);
      padding: 2rem 1rem;
      overflow-y: auto;
      transition: transform 0.3s ease-in-out;
    }
    html[dir="ltr"] .offcanvas-menu {
      left: 0;
      transform: translateX(-100%);
    }
    html[dir="rtl"] .offcanvas-menu {
      right: 0;
      transform: translateX(100%);
    }
    .offcanvas-menu.active {
      transform: translateX(0) !important;
    }

    .offcanvas-menu ul.navbar-nav .nav-link {
      color: #666;
      font-weight: 500;
      padding: 0.5rem 0;
      transition: color 0.3s ease;
    }
    .offcanvas-menu ul.navbar-nav .nav-link:hover {
      color: #333;
    }

    .offcanvas-overlay {
      position: fixed;
      top: 0; right: 0; bottom: 0; left: 0;
      z-index: 1040;
      background: rgba(0, 0, 0, 0.5);
      display: none;
    }
    .offcanvas-overlay.active {
      display: block;
    }

    /* Navbar overrides */
    nav.navbar {
      background-color: #fff !important;
    }
 #M {
  position: absolute;
  left: 0;
}
.navbar-brand {
  position: relative;
  padding-left: 3rem; /* عشان يعطي مساحة للحرف M */
}

  </style>
 @livewireStyles
  @vite(['resources/js/app.js'])
  <link rel="stylesheet" href="{{ asset('adminlte/custom.css') }}" />

</head>
<body>

  <!-- Preloader -->
  <div id="preloader">
    <div class="loader"></div>
  </div>

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm px-4 fixed-top">
    <div class="container-fluid">
      <a class="navbar-brand d-flex align-items-center" href="{{ route('home') }}" style="color: #c26b6b ">
        <span id="M" class="me-2" style="direction: ltr; unicode-bidi: isolate;">M</span>
MAYLA
      </a>

      <button class="navbar-toggler" type="button" onclick="toggleOffcanvas()">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
          <li class="nav-item"><a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">{{ __('message.Home') }}</a></li>
          <li class="nav-item"><a class="nav-link {{ request()->routeIs('products') ? 'active' : '' }}" href="{{ route('products') }}">{{ __('message.Products') }}</a></li>
          <li class="nav-item"><a class="nav-link {{ request()->routeIs('cart.view') ? 'active' : '' }}" href="{{ route('cart.view') }}">{{ __('message.Cart') }}</a></li>
          <li class="nav-item"><a class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}" href="{{ route('contact') }}">{{ __('message.contact') }}</a></li>
        </ul>

        <ul class="navbar-nav align-items-center">
          @livewire('language-switch')
          @auth
          <!-- إشعارات -->
          <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#" id="notificationDropdown">
              <i class="far fa-bell"></i>
              <span class="badge navbar-badge" style= "color:  #c26b6b ; background-color:  #FFC8C8">{{ Auth::user()->unreadNotifications->count() }}</span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right shadow" style="width: 300px; max-height: 400px; overflow-y: auto;">
              <span class="dropdown-item dropdown-header">{{ Auth::user()->notifications->count() }} إشعار</span>
              <div class="dropdown-divider"></div>
              @forelse (Auth::user()->notifications->take(10) as $notification)
                <div class="dropdown-item">
                  <div class="fw-bold">{{ $notification->data['title'] ?? 'إشعار' }}</div>
                  <div class="small text-muted">{{ $notification->data['body'] ?? '' }}</div>
               
                </div>
                <div class="dropdown-divider"></div>
              @empty
                <span class="dropdown-item text-center text-muted">لا توجد إشعارات</span>
              @endforelse
              <div class="dropdown-divider"></div>
              <a href="{{ route('notifications.index') }}" class="dropdown-item dropdown-footer">عرض جميع الإشعارات</a>
            </div>
          </li>

          <!-- عربة التسوق -->
             <!-- عربة التسوق -->
<li class="nav-item dropdown">
    <a class="nav-link" data-toggle="dropdown" href="#">
        <i class="fas fa-shopping-bag"></i>
        <span id="cart-count" class="badge badge-danger navbar-badge">
            {{ auth()->user()->productsInCart()->count() }}
        </span>
    </a>

    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        <span class="dropdown-item dropdown-header">
            {{ auth()->user()->productsInCart()->count() }} منتجات في السلة
        </span>
        <div class="dropdown-divider"></div>

        @php
            $cartItems = auth()->user()->productsInCart;
        @endphp

        @forelse($cartItems as $product)
            <a href="{{ route('products.show', $product->id) }}" class="dropdown-item d-flex align-items-center">
                <img src="{{ asset('images/' . $product->image) }}" alt="{{ $product->name }}" style="width: 50px; height: 50px; object-fit: cover; margin-right: 10px;">
                <div class="flex-grow-1">
                    <div>{{ $product->name }}</div>
                    <small class="text-muted">الكمية: {{ $product->pivot->quantity }}</small>
                </div>
            </a>
            <div class="dropdown-divider"></div>
        @empty
            <div class="dropdown-item text-center text-muted">السلة فارغة</div>
        @endforelse

        <a href="{{ route('cart.view') }}" class="dropdown-item dropdown-footer">عرض السلة</a>
    </div>
</li>

          <!-- قائمة المستخدم -->
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <span class="ml-2">{{ Auth::user()->first_name }}</span>
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
             @auth
              @if(Auth::user()->role === 'admin')
                <a class="dropdown-item" href="{{ route('admin.dashboard') }}">{{ __('message.Dashboard') }}</a>
              @endif
            @endauth

              <a class="dropdown-item" href="{{ route('profile.show') }}">{{ __('message.profile') }}</a>
              <div class="dropdown-divider"></div>
              <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="dropdown-item" type="submit">{{ __('message.Logout') }}</button>
              </form>
            </div>
          </li>
          @endauth
          @guest
          <li class="nav-item">
            <a class="nav-link" href="{{ route('login') }}">Sign In</a>
          </li>
          @endguest
        </ul>
      </div>
    </div>
  </nav>

  <!-- Offcanvas Overlay -->
  <div class="offcanvas-overlay" onclick="closeOffcanvas()"></div>

  <!-- Offcanvas Sidebar Menu -->
    <div class="offcanvas-menu" id="mobileMenu">
      <ul class="navbar-nav">
          @auth
  <li class="nav-item d-flex align-items-center justify-content-between px-2 my-2">
    <a href="{{ route('notifications.index') }}" class="nav-link p-0" style="color:#666;">
      <i class="far fa-bell"></i>
      <span class="badge" style="background-color: #FFC8C8; color:#c26b6b;">
        {{ Auth::user()->unreadNotifications->count() }}
      </span>
    </a>
  <a href="{{ route('cart.view') }}" class="nav-link p-0" style="color:#666;">
    <i class="fas fa-shopping-bag"></i>
    <span class="badge" style="background-color: #FFC8C8; color:#c26b6b;">
      {{ Auth::user()->productsInCart()->count() ?? 0 }}
    </span>
  </a>
</li>
@endauth
      <li class="nav-item"><a class="nav-link" href="{{ route('home') }}" style="color:#666;">{{ __('message.Home') }}</a></li>
      <li class="nav-item"><a class="nav-link" href="{{ route('products') }}" style="color:#666;">{{ __('message.Products') }}</a></li>
      <li class="nav-item"><a class="nav-link" href="{{ route('cart.view') }}" style="color:#666;">{{ __('message.Cart') }}</a></li>
      <li class="nav-item"><a class="nav-link" href="{{ route('contact') }}" style="color:#666;">{{ __('message.contact') }}</a></li>


      @auth
      <li class="nav-item"><a class="nav-link" href="{{ url('/dashboard') }}" style="color:#666;">{{ __('message.dashboard') }}</a></li>
      <li class="nav-item">
        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <button class="nav-link btn btn-link" type="submit" style="color:#666; padding-left:0;">{{ __('message.Logout') }}</button>
        </form>
      </li>
      @endauth
      

      @guest
      <li class="nav-item"><a class="nav-link" href="{{ route('login') }}" style="color:#666;">Sign In</a></li>
      @endguest

      <li class="nav-item mt-3">
        @livewire('language-switch')
      </li>
    </ul>
  </div>

  <!-- Main Content -->
  <div class="mt-2 pt-4">@yield('hero')</div>
  <main class="container-fluid mt-5 pt-4">@yield('content')</main>

  <!-- Footer -->
  <footer class="bg-white text-dark pt-5 pb-4 mt-6 border-top">
  <div class="container text-md-left">
    <div class="row">
      
      <!-- Box 1 -->
      <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="100">
        <div class="p-3 border rounded shadow-sm h-100">
          <h3 class="text-uppercase fw-bold">
            <span id="M-footer" class="me-2">M</span> MAYLA 
          </h3>
          <p class="small">
           {{__('message.Premium beauty products for the modern woman.') }}<br />
            {{ __('message.Discover Your Natural Beauty') }}
          </p>
        </div>
      </div>

      <!-- Box 2 -->
      <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="200">
        <div class="p-3 border rounded shadow-sm h-100">
          <h5 class="text-uppercase">{{ __('message.Quick Links') }}</h5>
          <ul class="list-unstyled">
            <li><a href="{{ route('home') }}" class="text-muted d-block py-1">{{ __('message.Home') }}</a></li>
            <li><a href="{{ route('products') }}" class="text-muted d-block py-1">{{ __('message.Products') }}</a></li>
            <li><a href="{{ route('cart.view') }}" class="text-muted d-block py-1">{{ __('message.Cart') }}</a></li>
            <li><a href="{{ route('contact') }}" class="text-muted d-block py-1">{{ __('message.contact') }}</a></li>
          </ul>
        </div>
      </div>

      <!-- Box 3 -->
      <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="300">
        <div class="p-3 border rounded shadow-sm h-100">
          <h5 class="text-uppercase">{{__('message.Contact Us')}}</h5>
          <ul class="list-unstyled small text-muted contact-info-list">
            <li class="mb-3">
              <i class="fas fa-envelope me-2 contact-icon"></i>
              contact@mayla.com
            </li>
            <li class="mb-3">
              <i class="fas fa-phone me-2 contact-icon"></i>
              +1-555-0199
            </li>
            <li class="mb-3">
              <i class="fas fa-map-marker-alt me-2 contact-icon"></i>
              123 Beauty Street, New York, NY 10001
            </li>
            <li class="mb-3">
              <i class="fas fa-clock me-2 contact-icon"></i>
              Monday - Friday: 9:00 AM - 6:00 PM<br>
              Saturday: 10:00 AM - 4:00 PM<br>
              Sunday: Closed
            </li>
          </ul>
        </div>
      </div>

    </div>
  </div>

  <div class="text-center text-muted mt-4 pt-3 border-top small">
    &copy; {{ date('Y') }} MAYLA BEAUTY. All rights reserved.
  </div>
</footer>


  <!-- Scripts -->
  
  

  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

  <script>
    AOS.init({
      duration: 800,
      once: false
    });

    function toggleOffcanvas() {
      document.getElementById('mobileMenu').classList.toggle('active');
      document.querySelector('.offcanvas-overlay').classList.toggle('active');
    }
    function closeOffcanvas() {
      document.getElementById('mobileMenu').classList.remove('active');
      document.querySelector('.offcanvas-overlay').classList.remove('active');
    }

      // Preloader hide after load
    window.addEventListener('load', function () {
      document.getElementById('preloader').style.display = 'none';
    });
  </script>

  @yield('script')
    @livewireScripts
    
</body>
</html>
