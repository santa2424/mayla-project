
 <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
     
        <span id="M" class="me-2">M</span> MAYLA
    </a>

     <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="info">
        <a href="{{ route('admin.dashboard') }}" class="d-block" style="color: #f38181">{{ __('dashboard.dashboard') }}</a>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

        <!-- المنتجات -->
        <li class="nav-item">
          <a href="{{ route('admin.products.index') }}" 
             class="nav-link {{ request()->routeIs('admin.products.index') ? 'active' : '' }}">
            <i class="nav-icon fas fa-box-open"></i>
            <p>{{ __('dashboard.products') }}</p>
          </a>
        </li>

        <!-- الفئات -->
        <li class="nav-item">
          <a href="{{ route('admin.categories.index') }}" 
             class="nav-link {{ request()->routeIs('admin.categories.index') ? 'active' : '' }}">
            <i class="nav-icon fas fa-tags"></i>
            <p>{{ __('dashboard.categories') }}</p>
          </a>
        </li>

        <!-- التقارير -->
        <li class="nav-item">
          <a href="{{ route('admin.reports.index') }}" 
             class="nav-link {{ request()->routeIs('admin.reports.index') ? 'active' : '' }}">
            <i class="nav-icon fas fa-chart-line"></i>
            <p>{{ __('dashboard.reports') }}</p>
          </a>
        </li>

        <!-- الخصومات -->
        <li class="nav-item">
          <a href="{{ route('admin.discounts.create') }}" 
             class="nav-link {{ request()->routeIs('admin.discounts.create') ? 'active' : '' }}">
            <i class="nav-icon fas fa-percent"></i>
            <p>{{ __('dashboard.discounts') }}</p>
          </a>
        </li>

        <!-- الطلبات -->
        <li class="nav-item">
          <a href="{{ route('admin.orders.index') }}" 
             class="nav-link {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-shopping-cart"></i>
            <p>{{ __('dashboard.orders') }}</p>
          </a>
        </li>

        <!-- الإشعارات الترويجية -->
        <li class="nav-item">
          <a href="{{ route('notifications.index') }}" 
             class="nav-link {{ request()->routeIs('notifications.index') ? 'active' : '' }}">
            <i class="nav-icon fas fa-bell"></i>
            <p>{{ __('dashboard.notifications') }}</p>
          </a>
        </li>

        <!-- رسائل المستخدمين -->
        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('admin.messages.index') ? 'active' : '' }}" href="{{ route('admin.messages.index') }}">
            <i class="fas fa-envelope"></i> 
            <p>{{ __('dashboard.user_messages') }}</p>
          </a>
        </li>

        <!-- الرجوع إلى الموقع -->
        <li class="nav-item">
          <a href="{{ route('home') }}" class="nav-link">
            <i class="nav-icon fas fa-arrow-left"></i>
            <p>{{ __('dashboard.go_back_to_site') }}</p>
          </a>
        </li>

      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>