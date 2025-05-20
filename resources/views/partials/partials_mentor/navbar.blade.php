<!--begin::Header-->
<nav class="app-header navbar navbar-expand bg-body">
    <div class="container-fluid">
        <!--begin::Start Navbar Links-->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button">
                    <i class="bi bi-list"></i>
                </a>
            </li>
        </ul>
        <!--end::Start Navbar Links-->

        <!--begin::End Navbar Links-->
        <ul class="navbar-nav ms-auto">
            <!-- Fullscreen Toggle -->
            <li class="nav-item">
                <a class="nav-link" href="#" data-lte-toggle="fullscreen">
                    <i data-lte-icon="maximize" class="bi bi-arrows-fullscreen"></i>
                    <i data-lte-icon="minimize" class="bi bi-fullscreen-exit" style="display: none"></i>
                </a>
            </li>

            <!-- Dark Mode Toggle -->
            <li class="nav-item">
                <a class="nav-link" href="#" id="toggle-dark-mode" title="Toggle Dark Mode">
                    <i class="bi bi-moon-fill" id="dark-mode-icon"></i>
                </a>
            </li>

            <!-- Profile Menu Dropdown -->
            <li class="nav-item dropdown user-menu">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="{{ asset('images/isaac.png') }}"
                        class="user-image rounded-circle shadow" alt="User Image">
                    <span class="d-none d-md-inline">Isaac Munandar</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end rounded-5">
                    <li class="user-header text-bg-primary rounded-top-5">
                        <img src="{{ asset('images/isaac.png') }}"
                            class="rounded-circle shadow" alt="User Image">
                        <p>
                            Isaac Munandar - Mentor
                            <small>Member since March 2025</small>
                        </p>
                    </li>
                    <li class="user-footer rounded-bottom-5">
                        <a href="{{ route('logout') }}" class="btn-sign-out">
                            <i class="fa-solid fa-right-from-bracket"></i> Logout
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
        <!--end::End Navbar Links-->
    </div>
</nav>
<!--end::Header-->