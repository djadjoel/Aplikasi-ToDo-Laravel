<!-- resources/views/admin/partials/header.blade.php -->
<div class="app-header header-shadow">
    <div class="app-header__logo">
        <div class="logo-src"></div>
        <div class="header__pane ms-auto">
            <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                <span class="hamburger-box">
                    <span class="hamburger-inner"></span>
                </span>
            </button>
        </div>
    </div>
    <div class="app-header__mobile-menu">
        <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
            <span class="hamburger-box">
                <span class="hamburger-inner"></span>
            </span>
        </button>
    </div>
    <div class="app-header__menu">
        <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
            <span class="btn-icon-wrapper">
                <i class="bi bi-three-dots-vertical fa-w-6"></i>
            </span>
        </button>
    </div>
    <div class="app-header__content">
        <div class="app-header-right">
            <div class="header-btn-lg pe-0">
                <div class="widget-content p-0">
                    <div class="widget-content-wrapper">
                        <div class="widget-content-left">
                            <div class="btn-group">
                                <button type="button" class="btn p-0 d-flex align-items-center" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-person-circle fs-3 text-secondary"></i>
                                    <i class="bi bi-chevron-down ms-2 opacity-75"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <!-- <li><a class="dropdown-item" href="#">User Account</a></li>
                                    <li><a class="dropdown-item" href="#">Settings</a></li> -->
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <form action="{{ route('default.logout') }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="dropdown-item">Logout</button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="widget-content-left ms-3 header-user-info">
                            <div class="widget-heading">{{ $user->name }}</div>
                            <div class="widget-subheading">{{ $user->email }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>