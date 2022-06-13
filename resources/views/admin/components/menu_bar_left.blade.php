<aside class="left-sidebar" data-sidebarbg="skin5">

    <div class="scroll-sidebar">

        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="index.html"
                        aria-expanded="false">
                        <i class="mdi mdi-av-timer"></i>
                        <span class="hide-menu">Dashboard</span>
                    </a>
                </li>
                @if(Auth::check())
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link"
                        href="{{ route('user.edit',['id'=> Auth::id()]) }}" aria-expanded="false">
                        <i class="mdi mdi-account-network"></i>
                        <span class="hide-menu">Profile</span>
                    </a>
                </li>
                @endif

                @can('country-list')
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('country.index') }}"
                        aria-expanded="false">
                        <i class="ti-world"></i>
                        <span class="hide-menu">Country</span>
                    </a>
                </li>
                @endcan

                @can('category-list')
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('category.index') }}"
                        aria-expanded="false">
                        <i class="mdi mdi-border-none"></i>
                        <span class="hide-menu">Category</span>
                    </a>
                </li>
                @endcan

                @can('menu-list')
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('menu.index') }}"
                        aria-expanded="false">
                        <i class="me-2 mdi mdi-menu"></i>
                        <span class="hide-menu">Menu</span>
                    </a>
                </li>
                @endcan

                @can('blog-list')
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('blog.index') }}"
                        aria-expanded="false">
                        <i class="me-2 mdi mdi-blogger"></i>
                        <span class="hide-menu">Blog</span>
                    </a>
                </li>
                @endcan

                @can('brand-list')
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('brand.index') }}"
                        aria-expanded="false">
                        <i class="me-2 mdi mdi-blogger"></i>
                        <span class="hide-menu">Brand</span>
                    </a>
                </li>
                @endcan

                @can('slider-list')
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('slider.index') }}"
                        aria-expanded="false">
                        <i class="ti-layout-slider"></i>
                        <span class="hide-menu">Slider</span>
                    </a>
                </li>
                @endcan

                @can('setting-list')
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('setting.index') }}"
                        aria-expanded="false">
                        <i class="ti-settings"></i>
                        <span class="hide-menu">Setting</span>
                    </a>
                </li>
                @endcan

                @can('product-list')
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('product.index') }}"
                        aria-expanded="false">
                        <i class="me-2 mdi mdi-format-list-bulleted"></i>
                        <span class="hide-menu">Products</span>
                    </a>
                </li>
                @endcan

                {{-- @can('product-list') --}}
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link"
                        href="{{ route('manager-order.index') }}" aria-expanded="false">
                        <i class="me-2 mdi mdi-reorder-horizontal"></i>
                        <span class="hide-menu">Manager Order</span>
                    </a>
                </li>
                {{-- @endcan --}}

                @can('user-list')
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('user.index') }}"
                        aria-expanded="false">
                        <i class="ti-user"></i>
                        <span class="hide-menu">User</span>
                    </a>
                </li>
                @endcan

                @can('role-list')
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('role.index') }}"
                        aria-expanded="false">
                        <i class="me-2 mdi mdi-arrange-bring-forward"></i>
                        <span class="hide-menu">Role (Vai trò)</span>

                    </a>
                </li>
                @endcan

                @can('permission-list')
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('permission.index') }}"
                        aria-expanded="false">
                        <i class="me-2 mdi mdi-calendar-range"></i>
                        <span class="hide-menu">Permission (Quyền của vai trò)</span>
                    </a>
                </li>
                @endcan
                {{--
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link"
                        href="{{ asset('template-admin/nice-html/ltr/form-basic.html') }}" aria-expanded="false">
                        <i class="mdi mdi-arrange-bring-forward"></i>
                        <span class="hide-menu">Form Basic</span>
                    </a>
                </li> --}}


                {{-- <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="starter-kit.html"
                        aria-expanded="false">
                        <i class="mdi mdi-file"></i>
                        <span class="hide-menu">Blank</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="error-404.html"
                        aria-expanded="false">
                        <i class="mdi mdi-alert-outline"></i>
                        <span class="hide-menu">404</span>
                    </a>
                </li> --}}
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link"
                        href="{{ asset('template-admin/nice-html/ltr/icon-material.html') }}" aria-expanded="false">
                        <i class="mdi mdi-face"></i>
                        <span class="hide-menu">Icon</span>
                    </a>
                </li>
            </ul>
        </nav>

    </div>

</aside>
