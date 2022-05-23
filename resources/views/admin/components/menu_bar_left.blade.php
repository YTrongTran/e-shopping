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
                        <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('user.edit',['id'=> Auth::id()]) }}"
                            aria-expanded="false">
                            <i class="mdi mdi-account-network"></i>
                            <span class="hide-menu">Profile</span>
                        </a>
                    </li>
                @endif

                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('country.index') }}"
                        aria-expanded="false">
                        <i class="me-2 mdi mdi-earth"></i>
                        <span class="hide-menu">Country</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('category.index') }}"
                        aria-expanded="false">
                        <i class="mdi mdi-border-none"></i>
                        <span class="hide-menu">Category</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('blog.index') }}"
                        aria-expanded="false">
                        <i class="me-2 mdi mdi-blogger"></i>
                        <span class="hide-menu">Blog</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('product.index') }}"
                        aria-expanded="false">
                        <i class="me-2 mdi mdi-format-list-bulleted"></i>
                        <span class="hide-menu">Products</span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ asset('template-admin/nice-html/ltr/form-basic.html') }}"
                        aria-expanded="false">
                        <i class="mdi mdi-arrange-bring-forward"></i>
                        <span class="hide-menu">Form Basic</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ asset('template-admin/nice-html/table-basic.html') }}"
                        aria-expanded="false">
                        <i class="mdi mdi-border-none"></i>
                        <span class="hide-menu">Table</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ asset('template-admin/nice-html/ltr/icon-material.html') }}"
                        aria-expanded="false">
                        <i class="mdi mdi-face"></i>
                        <span class="hide-menu">Icon</span>
                    </a>
                </li>
                <li class="sidebar-item">
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
                </li>
            </ul>
        </nav>

    </div>

</aside>
