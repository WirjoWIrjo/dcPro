<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel') - DataCenterPro</title>
    <link rel="stylesheet" href="{{ asset('bootstrap-5.3.8-dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        body { background-color: #f4f6f9; font-family: 'Inter', sans-serif; }
        .admin-sidebar {
            width: 260px; min-height: 100vh; position: fixed; left: 0; top: 0;
            background: linear-gradient(180deg, #1a1a2e 0%, #16213e 100%);
            z-index: 1040; transition: all 0.3s;
        }
        .admin-sidebar .sidebar-brand {
            padding: 1.5rem; text-align: center; border-bottom: 1px solid rgba(255,255,255,0.1);
        }
        .admin-sidebar .sidebar-brand h4 { color: #fff; margin: 0; font-weight: 700; }
        .admin-sidebar .sidebar-brand small { color: rgba(255,255,255,0.5); }
        .sidebar-nav { list-style: none; padding: 1rem 0; margin: 0; }
        .sidebar-nav li a {
            display: flex; align-items: center; padding: 0.75rem 1.5rem;
            color: rgba(255,255,255,0.7); text-decoration: none; transition: all 0.2s;
            font-size: 0.9rem;
        }
        .sidebar-nav li a i { width: 24px; margin-right: 12px; font-size: 1.1rem; }
        .sidebar-nav li a:hover, .sidebar-nav li a.active {
            color: #fff; background: rgba(255,255,255,0.1); border-left: 3px solid #0d6efd;
        }
        .sidebar-nav .nav-section {
            padding: 0.5rem 1.5rem; font-size: 0.7rem; text-transform: uppercase;
            color: rgba(255,255,255,0.3); letter-spacing: 1px; margin-top: 0.5rem;
        }
        .admin-content { margin-left: 260px; min-height: 100vh; }
        .admin-topbar {
            background: #fff; padding: 0.75rem 1.5rem; border-bottom: 1px solid #dee2e6;
            display: flex; justify-content: space-between; align-items: center;
        }
        .admin-main { padding: 1.5rem; }
        @media (max-width: 992px) {
            .admin-sidebar { width: 0; overflow: hidden; }
            .admin-content { margin-left: 0; }
        }
    </style>
    @stack('styles')
</head>
<body>
    <div class="admin-sidebar">
        <div class="sidebar-brand">
            <h4><i class="bi bi-shield-lock"></i> Admin</h4>
            <small>DataCenterPro</small>
        </div>
        <ul class="sidebar-nav">
            <li class="nav-section">Menu Utama</li>
            <li>
                <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="bi bi-speedometer2"></i> Dashboard
                </a>
            </li>
            <li class="nav-section">Kelola Data</li>
            <li>
                <a href="{{ route('admin.articles.index') }}" class="{{ request()->routeIs('admin.articles.*') ? 'active' : '' }}">
                    <i class="bi bi-newspaper"></i> Artikel
                </a>
            </li>
            <li>
                <a href="{{ route('admin.products.index') }}" class="{{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
                    <i class="bi bi-box-seam"></i> Produk
                </a>
            </li>
            <li>
                <a href="{{ route('admin.galleries.index') }}" class="{{ request()->routeIs('admin.galleries.*') ? 'active' : '' }}">
                    <i class="bi bi-images"></i> Galeri
                </a>
            </li>
            <li class="nav-section">Lainnya</li>
            <li>
                <a href="{{ route('admin.profile.edit') }}" class="{{ request()->routeIs('admin.profile.*') ? 'active' : '' }}">
                    <i class="bi bi-building"></i> Profil Perusahaan
                </a>
            </li>
            <li>
                <a href="{{ route('admin.reports.articles') }}" target="_blank">
                    <i class="bi bi-file-earmark-pdf"></i> Laporan PDF
                </a>
            </li>
            <li class="nav-section">Akun</li>
            <li>
                <a href="{{ url('/') }}">
                    <i class="bi bi-globe"></i> Lihat Website
                </a>
            </li>
            <li>
                <a href="{{ route('admin.logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="bi bi-box-arrow-left"></i> Logout
                </a>
                <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </li>
        </ul>
    </div>

    <div class="admin-content">
        <div class="admin-topbar">
            <div>
                <span class="fw-bold text-dark">
                    @yield('page-heading', 'Dashboard')
                </span>
            </div>
            <div class="d-flex align-items-center">
                <span class="me-3 text-muted small">
                    <i class="bi bi-person-circle"></i> {{ $adminUser->name ?? 'Admin' }}
                </span>
            </div>
        </div>
        <div class="admin-main">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            @yield('content')
        </div>
    </div>

    <script src="{{ asset('bootstrap-5.3.8-dist/js/bootstrap.bundle.min.js') }}"></script>
    @stack('scripts')
</body>
</html>
