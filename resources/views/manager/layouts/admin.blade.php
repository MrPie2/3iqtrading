<!doctype html>
<html lang="en">
<head>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'Admin' }} · 3IQTrading</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

    <style>
        :root {
            --blue:#2563eb;
            --blue-dark:#1d4ed8;
            --ink:#111827;
            --muted:#64748b;
            --line:#e5e7eb;
            --surface:#fff;
            --bg:#f6f8fc;
        }

        * { box-sizing:border-box; }
        html { scroll-behavior:smooth; }
        body {
            margin:0;
            background:var(--bg);
            color:var(--ink);
            font-family:Inter,system-ui,-apple-system,BlinkMacSystemFont,"Segoe UI",sans-serif;
        }
        a { text-decoration:none; color:inherit; }

        .manager-shell { min-height:100vh; }

        /* Manager top navigation */
        .manager-navbar {
            position:sticky;
            top:0;
            z-index:1030;
            min-height:72px;
            background:rgba(255,255,255,.96);
            border-bottom:1px solid var(--line);
            box-shadow:0 4px 18px rgba(15,23,42,.04);
            backdrop-filter:blur(14px);
        }
        .manager-navbar .container-fluid { min-height:72px; }
        .manager-brand {
            display:flex;
            align-items:center;
            gap:11px;
            font-size:17px;
            font-weight:800;
            letter-spacing:-.03em;
        }
        .manager-brand-mark {
            width:38px;
            height:38px;
            border-radius:12px;
            display:grid;
            place-items:center;
            color:#fff;
            background:linear-gradient(135deg,#2563eb,#60a5fa);
            box-shadow:0 8px 20px rgba(37,99,235,.22);
        }
        .manager-nav {
            display:flex;
            align-items:center;
            gap:4px;
            margin-left:24px;
        }
        .manager-nav-link,
        .manager-dropdown-toggle {
            display:flex;
            align-items:center;
            gap:8px;
            min-height:42px;
            padding:9px 12px;
            border-radius:10px;
            color:#475569;
            font-size:12px;
            font-weight:600;
            transition:.18s ease;
        }
        .manager-nav-link:hover,
        .manager-nav-link.active,
        .manager-dropdown-toggle:hover,
        .manager-dropdown-toggle.active {
            color:var(--blue);
            background:#eff6ff;
        }
        .manager-dropdown-menu {
            min-width:245px;
            padding:8px;
            margin-top:8px!important;
            border:1px solid var(--line);
            border-radius:14px;
            box-shadow:0 18px 45px rgba(15,23,42,.12);
        }
        .manager-dropdown-menu .dropdown-item {
            display:flex;
            align-items:center;
            gap:10px;
            padding:10px 11px;
            border-radius:9px;
            color:#475569;
            font-size:12px;
            font-weight:600;
        }
        .manager-dropdown-menu .dropdown-item:hover,
        .manager-dropdown-menu .dropdown-item.active {
            background:#eff6ff;
            color:var(--blue);
        }

        .manager-user {
            display:flex;
            align-items:center;
            gap:10px;
            margin-left:auto;
        }
        .manager-user-name {
            max-width:150px;
            overflow:hidden;
            text-overflow:ellipsis;
            white-space:nowrap;
            color:#334155;
            font-size:12px;
            font-weight:600;
        }
        .manager-avatar {
            width:38px;
            height:38px;
            border-radius:50%;
            display:grid;
            place-items:center;
            background:#dbeafe;
            color:var(--blue-dark);
            font-size:13px;
            font-weight:800;
        }
        .manager-logout {
            width:38px;
            height:38px;
            border:1px solid var(--line);
            border-radius:10px;
            background:#fff;
            color:#64748b;
            display:grid;
            place-items:center;
            transition:.18s ease;
        }
        .manager-logout:hover {
            color:#dc2626;
            border-color:#fecaca;
            background:#fef2f2;
        }

        /* Mobile topbar + dropdown navigation */
        .manager-mobilebar {
            display:none;
            position:sticky;
            top:0;
            z-index:1030;
            min-height:64px;
            background:rgba(255,255,255,.96);
            border-bottom:1px solid var(--line);
            box-shadow:0 3px 14px rgba(15,23,42,.05);
            backdrop-filter:blur(14px);
        }
        .manager-menu-btn {
            width:40px;
            height:40px;
            border:1px solid var(--line);
            border-radius:10px;
            background:#fff;
            color:#334155;
            display:grid;
            place-items:center;
            font-size:19px;
        }
        .manager-offcanvas {
            width:min(310px,86vw)!important;
            border:0!important;
            background:#0b1220!important;
            color:#cbd5e1;
        }
        .manager-offcanvas .offcanvas-header {
            padding:20px 18px;
            border-bottom:1px solid rgba(255,255,255,.08);
        }
        .manager-offcanvas .btn-close {
            filter:invert(1) grayscale(1);
            opacity:.8;
        }
        .manager-offcanvas .manager-brand { color:#fff; }
        .manager-offcanvas .manager-nav-mobile {
            padding:16px 12px 28px;
        }
        .manager-mobile-section {
            padding:13px 10px 7px;
            color:#64748b;
            font-size:10px;
            font-weight:700;
            letter-spacing:.12em;
            text-transform:uppercase;
        }
        .manager-mobile-link {
            display:flex;
            align-items:center;
            gap:12px;
            width:100%;
            padding:11px 12px;
            margin:2px 0;
            border-radius:10px;
            color:#cbd5e1;
            font-size:12px;
            font-weight:600;
        }
        .manager-mobile-link i {
            width:18px;
            text-align:center;
            font-size:16px;
        }
        .manager-mobile-link:hover,
        .manager-mobile-link.active {
            color:#fff;
            background:#17233a;
        }
        .manager-mobile-link.active i { color:#60a5fa; }

        /* Content */
        .manager-main { min-width:0; }
        .manager-topline {
            display:flex;
            align-items:center;
            justify-content:space-between;
            gap:20px;
            padding:18px clamp(18px,3vw,38px) 0;
            color:var(--muted);
            font-size:12px;
        }
        .manager-content {
            width:100%;
            max-width:1500px;
            margin:0 auto;
            padding:20px clamp(18px,3vw,38px) 42px;
        }
        .heading {
            display:flex;
            align-items:flex-end;
            justify-content:space-between;
            gap:20px;
            margin-bottom:24px;
        }
        .heading h1 { font-size:27px; margin:0 0 7px; font-weight:800; letter-spacing:-.03em; }
        .heading p { margin:0; color:var(--muted); font-size:13px; }
        .grid { display:grid; grid-template-columns:repeat(4,minmax(0,1fr)); gap:16px; }
        .card { background:var(--surface); border:1px solid var(--line); border-radius:16px; box-shadow:0 4px 18px rgba(15,23,42,.04); }
        .stat { padding:20px; }
        .stat-top { display:flex; justify-content:space-between; color:var(--muted); font-size:12px; }
        .stat i { font-size:19px; color:var(--blue); }
        .stat strong { display:block; font-size:28px; margin-top:12px; letter-spacing:-.04em; }
        .stat small { color:var(--muted); }
        .panel { padding:20px; margin-top:20px; }
        .panel-head { display:flex; align-items:center; justify-content:space-between; margin-bottom:16px; }
        .panel-head h2 { font-size:15px; margin:0; }
        .module-grid { display:grid; grid-template-columns:repeat(3,minmax(0,1fr)); gap:12px; }
        .module { padding:16px; border:1px solid var(--line); border-radius:12px; background:#fff; transition:.15s; }
        .module:hover { border-color:#bfdbfe; box-shadow:0 5px 18px rgba(37,99,235,.08); transform:translateY(-1px); }
        .module .icon { width:34px; height:34px; border-radius:10px; background:#eff6ff; color:var(--blue); display:grid; place-items:center; margin-bottom:12px; }
        .module b { font-size:13px; }
        .module span { display:block; font-size:11px; color:var(--muted); margin-top:4px; }
        .table-wrap { overflow:auto; border:1px solid var(--line); border-radius:12px; }
        .data { width:100%; border-collapse:collapse; font-size:12px; background:#fff; }
        .data th { background:#f8fafc; color:#64748b; text-align:left; font-weight:600; white-space:nowrap; }
        .data th,.data td { padding:12px 14px; border-bottom:1px solid var(--line); max-width:280px; }
        .data td { white-space:nowrap; overflow:hidden; text-overflow:ellipsis; }
        .empty { padding:35px; text-align:center; color:var(--muted); font-size:13px; }
        .btn { border:0; border-radius:10px; padding:10px 14px; font-size:12px; font-weight:600; cursor:pointer; }
        .btn-primary { background:var(--blue); color:#fff; }
        .btn-light { background:#f1f5f9; color:#334155; }
        .btn-danger { background:#fee2e2; color:#991b1b; }
        .toolbar { display:flex; gap:8px; align-items:center; }
        .badge { padding:5px 8px; border-radius:999px; font-size:10px; background:#eff6ff; color:#1d4ed8; }
        .legacy-note { background:#fffbeb; border:1px solid #fde68a; color:#92400e; padding:12px 14px; border-radius:12px; font-size:12px; margin-bottom:18px; }

        .manager-mobile-dropdown {
            min-width:250px;
            padding:8px;
            margin-top:8px!important;
            border:1px solid var(--line);
            border-radius:14px;
            box-shadow:0 18px 45px rgba(15,23,42,.12);
        }
        .manager-mobile-dropdown .dropdown-item {
            display:flex;
            align-items:center;
            gap:10px;
            padding:10px 11px;
            border-radius:9px;
            color:#475569;
            font-size:12px;
            font-weight:600;
        }
        .manager-mobile-dropdown .dropdown-item i { width:18px; text-align:center; }
        .manager-mobile-dropdown .dropdown-item:hover,
        .manager-mobile-dropdown .dropdown-item.active { background:#eff6ff; color:var(--blue); }

        @media (max-width:1199.98px) {
            .manager-user-name { display:none; }
            .grid { grid-template-columns:repeat(2,1fr); }
            .module-grid { grid-template-columns:repeat(2,1fr); }
        }

        @media (max-width:991.98px) {
            .manager-navbar { display:none; }
            .manager-mobilebar { display:block; }
            .manager-topline { padding-top:14px; }
        }

        @media (max-width:767.98px) {
            .manager-topline { display:none; }
            .manager-content { padding:22px 15px 34px; }
            .heading { align-items:flex-start; flex-direction:column; margin-bottom:18px; }
            .heading h1 { font-size:23px; }
            .grid { grid-template-columns:1fr; gap:12px; }
            .module-grid { grid-template-columns:1fr; }
            .panel { padding:15px; }
        }

        @media (max-width:420px) {

        @media (max-width:767.98px) {
            .manager-topline { display:none; }
            .manager-content { padding:22px 15px 34px; }
            .heading { align-items:flex-start; flex-direction:column; margin-bottom:18px; }
            .heading h1 { font-size:23px; }
            .grid { grid-template-columns:1fr; gap:12px; }
            .module-grid { grid-template-columns:1fr; }
            .panel { padding:15px; }
        }

        @media (max-width:420px) {
            .manager-content { padding-left:12px; padding-right:12px; }
            .manager-mobilebar .container-fluid { padding-left:12px; padding-right:12px; }
        }
    </style>
    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
    @stack('head')
</head>
<body>
<div class="manager-shell">

    <!-- All screen sizes: compact top navbar + offcanvas manager menu -->
    <nav class="manager-navbar">
        <div class="container-fluid px-4 d-flex align-items-center">
            <button class="manager-menu-btn" type="button" data-bs-toggle="offcanvas" data-bs-target="#managerOffcanvas" aria-controls="managerOffcanvas" aria-label="Open administration menu">
                    <i class="bi bi-list"></i>
                </button>

            <a class="manager-brand" href="{{ route('admin.dashboard') }}">
                <span class="manager-brand-mark"><i class="bi bi-grid-1x2-fill"></i></span>
                <span>3iQ Admin</span>
            </a>

            <div class="manager-nav">
                <a class="manager-nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                    <i class="bi bi-speedometer2"></i><span>Dashboard</span>
                </a>

                <div class="dropdown">
                    <button class="manager-dropdown-toggle border-0 bg-transparent {{ request()->routeIs('admin.module.*') ? 'active' : '' }}" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-grid"></i><span>Management</span><i class="bi bi-chevron-down ms-1 small"></i>
                    </button>
                    <ul class="dropdown-menu manager-dropdown-menu">
                        @foreach([
                            ['myagents','people','Agents'],
                            ['investmentplan','layers','Investment Plans'],
                            ['mywallets','wallet2','My Wallets'],
                            ['sendbulkmail','envelope-paper','Send Bulk Email'],
                            ['verification','shield-check','Verification & Limits'],
                            ['mystocks','bar-chart-line','Stocks'],
                            ['resources','folder2-open','Resources'],
                            ['chat','chat-dots','Chat & Support'],
                            ['faqcontainer','question-circle','FAQs'],
                            ['pages','file-earmark-text','Site Pages'],
                        ] as $item)
                            <li>
                                <a class="dropdown-item {{ request()->routeIs('admin.module.'.$item[0]) ? 'active' : '' }}" href="{{ route('admin.module.'.$item[0]) }}">
                                    <i class="bi bi-{{ $item[1] }}"></i>{{ $item[2] }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <div class="manager-user">
                <span class="manager-user-name">{{ session('Boss_Name','Administrator') }}</span>
                <span class="manager-avatar">{{ strtoupper(substr(session('Boss_Name','A'),0,1)) }}</span>
                <form method="POST" action="{{ route('admin.logout') }}">
                    @csrf
                    <button class="manager-logout" type="submit" title="Sign out" aria-label="Sign out">
                        <i class="bi bi-box-arrow-right"></i>
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <!-- Bootstrap offcanvas manager menu -->
    <nav class="manager-mobilebar">
        <div class="container-fluid px-3 d-flex align-items-center justify-content-between">
            <div class="dropdown">
                <button class="manager-menu-btn" type="button" data-bs-toggle="dropdown" aria-expanded="false" aria-label="Open administration menu">
                    <i class="bi bi-list"></i>
                </button>
                <div class="dropdown-menu manager-mobile-dropdown">
                    <a class="dropdown-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}"><i class="bi bi-speedometer2"></i> Dashboard</a>
                    <div class="dropdown-divider"></div>
                    @foreach([
                        ['myagents','people','Agents'],
                        ['investmentplan','layers','Investment Plans'],
                        ['mywallets','wallet2','My Wallets'],
                        ['sendbulkmail','envelope-paper','Send Bulk Email'],
                        ['verification','shield-check','Verification & Limits'],
                        ['mystocks','bar-chart-line','Stocks'],
                        ['resources','folder2-open','Resources'],
                        ['chat','chat-dots','Chat & Support'],
                        ['faqcontainer','question-circle','FAQs'],
                        ['pages','file-earmark-text','Site Pages'],
                    ] as $item)
                        <a class="dropdown-item {{ request()->routeIs('admin.module.'.$item[0]) ? 'active' : '' }}" href="{{ route('admin.module.'.$item[0]) }}">
                            <i class="bi bi-{{ $item[1] }}"></i>{{ $item[2] }}
                        </a>
                    @endforeach
                    <div class="dropdown-divider"></div>
                    <form method="POST" action="{{ route('admin.logout') }}">
                        @csrf
                        <button class="dropdown-item text-danger" type="submit"><i class="bi bi-box-arrow-right"></i> Sign out</button>
                    </form>
                </div>
            </div>

            <a class="manager-brand" href="{{ route('admin.dashboard') }}">
                <span class="manager-brand-mark"><i class="bi bi-grid-1x2-fill"></i></span>
                <span>3iQ Admin</span>
            </a>

            <div class="manager-avatar">{{ strtoupper(substr(session('Boss_Name','A'),0,1)) }}</div>
        </div>
    </nav>

    <div class="offcanvas offcanvas-start manager-offcanvas" tabindex="-1" id="managerOffcanvas" aria-labelledby="managerOffcanvasLabel">
        <div class="offcanvas-header">
            <a class="manager-brand" href="{{ route('admin.dashboard') }}" data-bs-dismiss="offcanvas">
                <span class="manager-brand-mark"><i class="bi bi-grid-1x2-fill"></i></span>
                <span id="managerOffcanvasLabel">3iQ Admin</span>
            </a>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>

        <div class="manager-nav-mobile">
            <div class="manager-mobile-section">Overview</div>
            <a class="manager-mobile-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                <i class="bi bi-speedometer2"></i><span>Dashboard</span>
            </a>

            <div class="manager-mobile-section">Management</div>
            @foreach([
                ['myagents','people','Agents'],
                ['investmentplan','layers','Investment Plans'],
                ['mywallets','wallet2','My Wallets'],
                ['sendbulkmail','envelope-paper','Send Bulk Email'],
                ['verification','shield-check','Verification & Limits'],
                ['mystocks','bar-chart-line','Stocks'],
                ['resources','folder2-open','Resources'],
                ['chat','chat-dots','Chat & Support'],
                ['faqcontainer','question-circle','FAQs'],
                ['pages','file-earmark-text','Site Pages'],
            ] as $item)
                <a class="manager-mobile-link {{ request()->routeIs('admin.module.'.$item[0]) ? 'active' : '' }}" href="{{ route('admin.module.'.$item[0]) }}">
                    <i class="bi bi-{{ $item[1] }}"></i><span>{{ $item[2] }}</span>
                </a>
            @endforeach

            <div class="manager-mobile-section">System</div>
            <form method="POST" action="{{ route('admin.logout') }}">
                @csrf
                <button class="manager-mobile-link border-0 bg-transparent text-start" type="submit">
                    <i class="bi bi-box-arrow-right"></i><span>Sign out</span>
                </button>
            </form>
        </div>
    </div>

    <main class="manager-main">
        <div class="manager-topline">
            <span>Administration / {{ $title ?? 'Dashboard' }}</span>
            <span><i class="bi bi-shield-check me-1"></i>Secure manager workspace</span>
        </div>
        <section class="manager-content">
            @yield('content')
        </section>
    </main>
</div>

@stack('scripts')
</body>
</html>