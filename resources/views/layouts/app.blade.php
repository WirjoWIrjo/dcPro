<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title','Data Center Profile')</title>
    <link rel="stylesheet" href="{{ asset('bootstrap-5.3.8-dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="icon" href="{{ asset('laravel.png') }}" type="image/png">
    <style>
        body { background-color: #f8f9fa; font-family: 'Inter', sans-serif; }

        /* Desktop Sidebar */
        .side-dock {
            width: 90px; height: 100vh; position: fixed; left: 0; top: 0;
            background: linear-gradient(180deg, #0d6efd 0%, #0b5ed7 100%);
            display: flex; flex-direction: column; align-items: center;
            padding: 20px 0; z-index: 1050; transition: all 0.3s ease;
        }
        .nav-dock-item {
            color: rgba(255,255,255,0.7); text-decoration: none; margin: 10px 0;
            transition: .3s; display: flex; flex-direction: column; align-items: center;
            font-size: .65rem; border-radius: 8px; padding: 6px 8px; width: 70px;
        }
        .nav-dock-item i { font-size: 1.5rem; margin-bottom: 2px; }
        .nav-dock-item:hover, .nav-dock-item.active {
            color: #fff; background: rgba(255,255,255,0.15); transform: scale(1.05);
        }
        .nav-dock-item.admin-link {
            margin-top: auto; background: rgba(255,255,255,0.1);
            border: 1px solid rgba(255,255,255,0.2); color: #fff;
        }
        .nav-dock-item.admin-link:hover { background: rgba(255,255,255,0.25); }

        main { margin-left: 90px; min-height: 100vh; }

        /* Mobile bottom bar */
        @media (max-width: 768px) {
            .side-dock {
                width: 100%; height: 65px; flex-direction: row; bottom: 0; top: auto;
                justify-content: space-around; padding: 0; border-radius: 16px 16px 0 0;
            }
            main { margin-left: 0; margin-bottom: 65px; }
            .nav-dock-item { margin: 0; width: auto; padding: 4px 6px; }
            .nav-dock-item span { display: none; }
            .nav-dock-item.admin-link { margin-top: 0; }
        }

        footer { margin-left: 0; }
    </style>
</head>
<body>

    {{-- SIDEBAR --}}
    <nav class="side-dock shadow-lg" aria-label="Main navigation">
        <a href="/" class="mb-3" aria-label="Home">
            <img src="{{ asset('laravel.png') }}" width="36" alt="Logo">
        </a>

        <a href="{{ url('/home') }}"
           class="nav-dock-item {{ Request::is('home') ? 'active' : '' }}">
            <i class="bi bi-house-door"></i><span>HOME</span>
        </a>
        <a href="{{ url('/infrastructure') }}"
           class="nav-dock-item {{ Request::is('infrastructure') ? 'active' : '' }}">
            <i class="bi bi-cpu"></i><span>INFRA</span>
        </a>
        <a href="{{ url('/articles') }}"
           class="nav-dock-item {{ Request::is('articles') ? 'active' : '' }}">
            <i class="bi bi-newspaper"></i><span>ARTICLE</span>
        </a>
        <a href="{{ url('/products') }}"
           class="nav-dock-item {{ Request::is('products') ? 'active' : '' }}">
            <i class="bi bi-box-seam"></i><span>PRODUK</span>
        </a>
        <a href="{{ url('/sustainability') }}"
           class="nav-dock-item {{ Request::is('sustainability') ? 'active' : '' }}">
            <i class="bi bi-recycle"></i><span>ECO</span>
        </a>
        <a href="{{ url('/about') }}"
           class="nav-dock-item {{ Request::is('about') ? 'active' : '' }}">
            <i class="bi bi-info-circle"></i><span>ABOUT</span>
        </a>
        <a href="{{ url('/contact') }}"
           class="nav-dock-item {{ Request::is('contact') ? 'active' : '' }}">
            <i class="bi bi-envelope"></i><span>CONTACT</span>
        </a>

        {{-- Admin Menu --}}
        @if(session()->has('admin_id'))
            <a href="{{ url('/admin') }}" class="nav-dock-item admin-link">
                <i class="bi bi-speedometer2"></i><span>ADMIN</span>
            </a>
        @else
            <a href="{{ url('/admin/login') }}" class="nav-dock-item admin-link">
                <i class="bi bi-shield-lock"></i><span>ADMIN</span>
            </a>
        @endif
    </nav>

    {{-- MAIN CONTENT --}}
    <main>
        @yield('content')

        <footer class="bg-dark text-white text-center mt-5">
            <div class="container">
                <p class="mb-0 py-3 small">
                    &copy; 2026 <strong>DataCenterPro</strong>. Engineering Support Dept.
                </p>
            </div>
        </footer>
    </main>

    <script src="{{ asset('bootstrap-5.3.8-dist/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
