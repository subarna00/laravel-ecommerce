<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/admin/dashboard" class="brand-link">
        <img src="{{ asset('/btheme/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <p>My Ecommerce</p>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="" aria-placeholder="15*15" class="img-circle elevation-2">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ auth()->user()->name ?? 'swr' }}</a>
            </div>
        </div>

        <!-- SidebarSearch Form -->


        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
       with font-awesome or any other icon font library -->
                <li class="nav-item menu-open">
                    <a href="/dashboard" class="nav-link {{ active_sidebar(['dashboard']) }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>

                </li>
                @if(auth()->user()->type == "admin")
                <li class="nav-item">
                    <a href="{{ route('userPage') }}"
                        class="nav-link {{ active_sidebar([route('userPage')]) }}">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Users
                        </p>
                    </a>
                </li>
                @endif
                <li class="nav-item">
                    <a href="{{ route('banner.index') }}"
                        class="nav-link {{ active_sidebar([route('banner.index')]) }}">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Banner
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('brands.index') }}"
                        class="nav-link {{ active_sidebar([route('brands.index')]) }}">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Brand
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('partners.index') }}"
                        class="nav-link {{ active_sidebar([route('partners.index')]) }}">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Partner
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('ads.index') }}" class="nav-link {{ active_sidebar([route('ads.index')]) }}">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Ads
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('categories.index') }}"
                        class="nav-link {{ active_sidebar([route('categories.index'), route('searchCategory')]) }}">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Category
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('sub-categories.index') }}"
                        class="nav-link {{ active_sidebar([route('sub-categories.index'), route('searchSubCategories')]) }}">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Sub Category
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('products.index') }}"
                        class="nav-link {{ active_sidebar([route('products.index'), route('searchProducts')]) }}">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Products
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('orderTable') }}"
                        class="nav-link {{ active_sidebar([route('orderTable'), route('filterOrder')]) }}">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Orders
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('contactFormPage') }}"
                        class="nav-link {{ active_sidebar([route('contactFormPage')]) }}">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Contact Forms
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-search"></i>
                        <p>
                            Settings
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('site-setting.create') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Site Settings</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button class=" bg-transparent mx-2" style="border: none;color:#c2c7d0"> <i
                                        class="far fa-circle nav-icon"></i>
                                    Logout</button>
                            </form>

                        </li>
                    </ul>
                </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
