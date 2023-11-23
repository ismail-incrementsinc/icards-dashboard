
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{route('dashboard')}}" class="brand-link">
        <img src="{{asset('assets/dist/img/iCards-logo.svg')}}" alt="logo" class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text" style="color: #2E9A57"> iCards</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                <li class="nav-item has-treeview">
                    <a href="{{route('dashboard')}}" class="nav-link @yield('insights')">
                        <object type="image/svg+xml" data="image.svg">
                            <img class="nav-icon" src="{{asset('assets/dist/img/svg/insights.svg')}}" alt="">
                        </object>

                        <p>
                            Insights
                        </p>
                    </a>
                </li>
                <li class="nav-item has-treeview @yield('card')">
                    <a href="#" class="nav-link">
                        <object type="image/svg+xml" data="image.svg">
                            <img class="nav-icon" src="{{asset('assets/dist/img/svg/cards.svg')}}" alt="">
                        </object>
                        <p>
                            Cards
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('card.index')}}" class="nav-link @yield('card-item')">
                                <i class="fa fa-arrow-right nav-icon" aria-hidden="true"></i>
                                <p>Company Card</p>
                            </a>
                        </li>
{{--                        <li class="nav-item">--}}
{{--                            <a href="{{route('card.index')}}" class="nav-link @yield('card-item')">--}}
{{--                                <i class="fa fa-arrow-right nav-icon" aria-hidden="true"></i>--}}
{{--                                <p>DC Cards</p>--}}
{{--                            </a>--}}
{{--                        </li>--}}
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{route('coupon.index')}}" class="nav-link @yield('coupon')">
                        <object type="image/svg+xml" data="image.svg">
                            <img class="nav-icon" src="{{asset('assets/dist/img/svg/coupon.svg')}}" alt="">
                        </object>
                        <p>
                            Coupons
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('employee.index')}}" class="nav-link @yield('employee')">
                        <object type="image/svg+xml" data="image.svg">
                            <img class="nav-icon" src="{{asset('assets/dist/img/svg/employees.svg')}}" alt="">
                        </object>
                        <p>
                            Employees
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('customer.index')}}" class="nav-link @yield('customer')">
                        <object type="image/svg+xml" data="image.svg">
                            <img class="nav-icon" src="{{asset('assets/dist/img/svg/users.svg')}}" alt="">
                        </object>
                        <p>
                            Users
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('package-pricing.index')}}" class="nav-link @yield('plan')">
                        <object type="image/svg+xml" data="image.svg">
                            <img class="nav-icon" src="{{asset('assets/dist/img/svg/plans.svg')}}" alt="">
                        </object>
                        <p>
                            Plans
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('logout')}}" class="nav-link">
                        <i class="nav-icon fa-solid fa-lock"></i>
                        <p>Logout</p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
