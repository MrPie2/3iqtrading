<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>{{ $title ?? 'Dashboard' }} — 3IQ Trading</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('assets/css/dashboard.css') }}">
@stack('head')
</head>
<body class="dashboard-body">
<header class="dashboard-topbar">
<div class="container-fluid px-3 px-lg-4 d-flex align-items-center justify-content-between h-100">
<div class="d-flex align-items-center gap-3">
<button class="dashboard-menu-btn" type="button" data-bs-toggle="offcanvas" data-bs-target="#dashboardNav" aria-label="Open navigation"><i class="bi bi-list"></i></button>
<a href="{{ route('dashboard') }}" class="dashboard-brand"><span class="brand-symbol"><i class="bi bi-graph-up-arrow"></i></span><span>3IQ <strong>Trading</strong></span></a>
</div>
<div class="d-flex align-items-center gap-2">
<a href="{{ route('notifications') }}" class="topbar-icon" aria-label="Notifications"><i class="bi bi-bell"></i>@if(($notifications ?? collect())->count())<span class="notification-dot"></span>@endif</a>
<a href="{{ route('profile') }}" class="profile-chip"><span class="profile-avatar">{{ strtoupper(substr($investor->First_Name ?? $investor->name ?? 'U',0,1)) }}</span><span class="d-none d-md-inline">{{ $investor->First_Name ?? $investor->name ?? 'Account' }}</span><i class="bi bi-chevron-down d-none d-md-inline"></i></a>
</div>
</div>
</header>
<div class="offcanvas offcanvas-start dashboard-sidebar" tabindex="-1" id="dashboardNav">
<div class="offcanvas-header sidebar-header"><div class="dashboard-brand"><span class="brand-symbol"><i class="bi bi-graph-up-arrow"></i></span><span>3IQ <strong>Trading</strong></span></div><button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"></button></div>
<div class="offcanvas-body p-0 d-flex flex-column">
<div class="sidebar-label">Trading workspace</div>
<nav class="dashboard-nav">
<a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}"><i class="bi bi-grid-1x2-fill"></i>Overview</a>
<a href="{{ route('market') }}" class="{{ request()->routeIs('market*') ? 'active' : '' }}"><i class="bi bi-bar-chart-line-fill"></i>Markets</a>
<a href="{{ route('investments.plans') }}"><i class="bi bi-lightning-charge-fill"></i>Invest</a>
<a href="{{ route('investments.contracts') }}"><i class="bi bi-layers-fill"></i>Positions</a>
<a href="{{ route('wallet') }}"><i class="bi bi-wallet2"></i>Wallet</a>
<a href="{{ route('transfer') }}"><i class="bi bi-arrow-left-right"></i>Transfer</a>
<a href="{{ route('referrals') }}"><i class="bi bi-people-fill"></i>Referrals</a>
</nav>
<div class="sidebar-label">Account</div>
<nav class="dashboard-nav">
<a href="{{ route('profile') }}"><i class="bi bi-person-circle"></i>Profile</a>
<a href="{{ route('verification') }}"><i class="bi bi-shield-check"></i>Verification</a>
<a href="{{ route('support') }}"><i class="bi bi-headset"></i>Support</a>
</nav>
<div class="mt-auto p-3"><form method="POST" action="{{ route('logout') }}">@csrf<button class="sidebar-logout w-100" type="submit"><i class="bi bi-box-arrow-right"></i> Sign out</button></form></div>
</div>
</div>
<main class="dashboard-main">
@if(session('success'))<div class="alert dashboard-alert alert-success alert-dismissible fade show"><i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>@endif
@yield('content')
</main>
<nav class="mobile-bottom-nav" aria-label="Mobile dashboard navigation">
<a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}"><i class="bi bi-grid-1x2-fill"></i><span>Home</span></a>
<a href="{{ route('market') }}" class="{{ request()->routeIs('market*') ? 'active' : '' }}"><i class="bi bi-bar-chart-line-fill"></i><span>Markets</span></a>
<a href="{{ route('investments.plans') }}"><i class="bi bi-plus-circle-fill"></i><span>Invest</span></a>
<a href="{{ route('wallet') }}" class="{{ request()->routeIs('wallet') ? 'active' : '' }}"><i class="bi bi-wallet2"></i><span>Wallet</span></a>
<a href="{{ route('profile') }}"><i class="bi bi-person-circle"></i><span>Account</span></a>
</nav>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.7/dist/chart.umd.min.js"></script>
@stack('scripts')
</body>
</html>