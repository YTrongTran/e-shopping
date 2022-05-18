<header class="topbar" data-navbarbg="skin6">
    <nav class="navbar top-navbar navbar-expand-md navbar-light">
        <div class="navbar-header" data-logobg="skin5">
            <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)">
                <i class="ti-menu ti-close"></i>
            </a>

            <div class="navbar-brand">
                <a href="index.html" class="logo">
                    <b class="logo-icon">
                        <img src="{{ asset('template-admin/assets/images/logo-icon.png') }}" alt="homepage" class="dark-logo" />
                        <img src="{{ asset('template-admin/assets/images/logo-light-icon.png') }}" alt="homepage" class="light-logo" />
                    </b>

                    <span class="logo-text">
                        <img src="{{ asset('template-admin/assets/images/logo-text.png')}}" alt="homepage" class="dark-logo" />
                        <img src="{{ asset('template-admin/assets/images/logo-light-text.png')}}" class="light-logo" alt="homepage" />
                    </span>
                </a>
            </div>
        </div>

        <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin6">

            <ul class="navbar-nav float-start me-auto">
            </ul>

            <ul class="navbar-nav float-end">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark pro-pic" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="{{ asset(Auth::user()->avatar_path) }}" alt="user" class="rounded-circle" width="31">
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end user-dd animated" aria-labelledby="navbarDropdown">
                        @if (Auth::check())
                        <a class="dropdown-item" href="{{ route('user.edit',['id'=> Auth::id()]) }}"><i class="ti-user me-1 ms-1"></i>
                            My Profile</a>
                        <a class="dropdown-item" href="javascript:void(0)"><i class="ti-wallet me-1 ms-1"></i>
                            My Balance</a>
                        <a class="dropdown-item" href="{{ route('admin.logout') }}"><i class="me-2 mdi mdi-logout-variant"></i>
                            Logout</a>
                        @endif

                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>
