<!doctype html>
<html lang="en">
<head>
      @vite(['resources/css/app.css', 'resources/js/app.js'])

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'Admin' }} 3IQTrading</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <style>
      :root{--blue:#2563eb;--blue2:#1d4ed8;--ink:#111827;--muted:#6b7280;--line:#e5e7eb;--surface:#fff;--bg:#f6f8fc;--green:#16a34a;--red:#dc2626}
      *{box-sizing:border-box}body{margin:0;background:var(--bg);color:var(--ink);font-family:Inter,system-ui,sans-serif}
      a{text-decoration:none;color:inherit}.shell{display:flex;min-height:100vh}.sidebar{width:260px;background:#0b1220;color:#cbd5e1;position:fixed;inset:0 auto 0 0;padding:22px 14px;overflow:auto}
      .brand{display:flex;align-items:center;gap:12px;padding:5px 10px 24px;color:#fff;font-weight:800;font-size:18px}.brand-mark{width:38px;height:38px;border-radius:12px;background:linear-gradient(135deg,#3b82f6,#60a5fa);display:grid;place-items:center;color:#fff}
      .nav-title{font-size:10px;text-transform:uppercase;letter-spacing:.12em;color:#64748b;padding:14px 12px 8px}.nav a{display:flex;align-items:center;gap:11px;padding:11px 12px;border-radius:10px;margin:2px 0;font-size:13px}.nav a:hover,.nav a.active{background:#17233a;color:#fff}.nav i{font-size:16px;width:18px;text-align:center}
      .main{margin-left:260px;flex:1;min-width:0}.topbar{height:74px;background:#fff;border-bottom:1px solid var(--line);display:flex;align-items:center;justify-content:space-between;padding:0 30px;position:sticky;top:0;z-index:5}.crumb{font-size:13px;color:var(--muted)}.user{display:flex;align-items:center;gap:10px;font-size:13px}.avatar{width:36px;height:36px;border-radius:50%;display:grid;place-items:center;background:#dbeafe;color:#1d4ed8;font-weight:700}
      .content{padding:30px;max-width:1500px;margin:auto}.heading{display:flex;align-items:flex-end;justify-content:space-between;gap:20px;margin-bottom:24px}.heading h1{font-size:27px;margin:0 0 7px;font-weight:800;letter-spacing:-.03em}.heading p{margin:0;color:var(--muted);font-size:13px}
      .grid{display:grid;grid-template-columns:repeat(4,minmax(0,1fr));gap:16px}.card{background:var(--surface);border:1px solid var(--line);border-radius:16px;box-shadow:0 4px 18px rgba(15,23,42,.04)}.stat{padding:20px}.stat-top{display:flex;justify-content:space-between;color:var(--muted);font-size:12px}.stat i{font-size:19px;color:var(--blue)}.stat strong{display:block;font-size:28px;margin-top:12px;letter-spacing:-.04em}.stat small{color:var(--muted)}
      .panel{padding:20px;margin-top:20px}.panel-head{display:flex;align-items:center;justify-content:space-between;margin-bottom:16px}.panel-head h2{font-size:15px;margin:0}.module-grid{display:grid;grid-template-columns:repeat(3,minmax(0,1fr));gap:12px}.module{padding:16px;border:1px solid var(--line);border-radius:12px;background:#fff;transition:.15s}.module:hover{border-color:#bfdbfe;box-shadow:0 5px 18px rgba(37,99,235,.08);transform:translateY(-1px)}.module .icon{width:34px;height:34px;border-radius:10px;background:#eff6ff;color:var(--blue);display:grid;place-items:center;margin-bottom:12px}.module b{font-size:13px}.module span{display:block;font-size:11px;color:var(--muted);margin-top:4px}
      .table-wrap{overflow:auto;border:1px solid var(--line);border-radius:12px}.data{width:100%;border-collapse:collapse;font-size:12px;background:#fff}.data th{background:#f8fafc;color:#64748b;text-align:left;font-weight:600;white-space:nowrap}.data th,.data td{padding:12px 14px;border-bottom:1px solid var(--line);max-width:280px}.data td{white-space:nowrap;overflow:hidden;text-overflow:ellipsis}.empty{padding:35px;text-align:center;color:var(--muted);font-size:13px}.btn{border:0;border-radius:10px;padding:10px 14px;font-size:12px;font-weight:600;cursor:pointer}.btn-primary{background:var(--blue);color:#fff}.btn-light{background:#f1f5f9;color:#334155}.btn-danger{background:#fee2e2;color:#991b1b}.toolbar{display:flex;gap:8px;align-items:center}.badge{padding:5px 8px;border-radius:999px;font-size:10px;background:#eff6ff;color:#1d4ed8}.legacy-note{background:#fffbeb;border:1px solid #fde68a;color:#92400e;padding:12px 14px;border-radius:12px;font-size:12px;margin-bottom:18px}
      .login-page{min-height:100vh;display:grid;place-items:center;padding:24px;background:radial-gradient(circle at 20% 10%,#dbeafe,transparent 30%),#f8fafc}.login-card{width:min(430px,100%);background:#fff;border:1px solid var(--line);border-radius:22px;padding:32px;box-shadow:0 25px 70px rgba(15,23,42,.12)}.login-logo{width:48px;height:48px;border-radius:15px;background:linear-gradient(135deg,#2563eb,#60a5fa);display:grid;place-items:center;color:#fff;font-size:21px;margin-bottom:20px}.login-card h1{margin:0;font-size:24px}.login-card p{color:var(--muted);font-size:13px;line-height:1.6}.field{margin:16px 0}.field label{display:block;font-size:12px;font-weight:600;margin-bottom:7px}.field input{width:100%;border:1px solid var(--line);border-radius:11px;padding:12px 13px;font:inherit;font-size:13px;outline:none}.field input:focus{border-color:#93c5fd;box-shadow:0 0 0 4px #eff6ff}.login-card .btn{width:100%;padding:13px}.alert{padding:11px 13px;border-radius:10px;font-size:12px;margin:12px 0}.alert-error{background:#fef2f2;color:#991b1b}.alert-success{background:#f0fdf4;color:#166534}
      @media(max-width:1100px){.grid{grid-template-columns:repeat(2,1fr)}.module-grid{grid-template-columns:repeat(2,1fr)}}@media(max-width:800px){.sidebar{width:76px;padding:18px 8px}.brand span,.nav a span,.nav-title{display:none}.brand{justify-content:center}.nav a{justify-content:center}.main{margin-left:76px}.topbar{padding:0 18px}.content{padding:20px}.module-grid{grid-template-columns:1fr}}@media(max-width:520px){.grid{grid-template-columns:1fr}.heading{align-items:flex-start;flex-direction:column}}
    </style>
    	<script src="{{ asset('ckeditor/ckeditor.js') }}"></script>

</head>
<body>
<div class="shell">
<aside class="sidebar">
  <a class="brand" href="{{ route('admin.dashboard') }}"><span class="brand-mark"><i class="bi bi-grid-1x2-fill"></i></span><span>3iQ Admin</span></a>
  <div class="nav-title">Overview</div>
  <nav class="nav">
    <a href="{{ route('admin.dashboard') }}"><i class="bi bi-speedometer2"></i><span>Dashboard</span></a>
  </nav>
  <div class="nav-title">Management</div>
  <nav class="nav">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item"><a href="{{ route('admin.module.myagents') }}" class="navbar-link"><span>Agents</span></a></li>
          <li class="nav-item"><a href="{{ route('admin.module.investmentplan') }}" class="navbar-link"><span>Investment Plans</span></a></li>
          <li class="nav-item"><a href="{{ route('admin.module.mywallets') }}" class="navbar-link"><span>My Wallets</span></a></li>
          <li class="nav-item"><a  href="{{ route('admin.module.sendbulkmail') }}" class="navbar-link" ><span>Send Bulk Email</span></a></li>
          <li class="nav-item"><a href="{{ route('admin.module.verification') }}" class="navbar-link"><span>Verification and Limits</span></a></li>
          <li class="nav-item"><a href="{{ route('admin.module.mystocks') }}" class="navbar-link"><span>Stocks</span></a></li>
          <li class="nav-item"><a href="{{ route('admin.module.resources') }}" class="navbar-link"><span>Resources</span></a></li>
          <li class="nav-item"><a href="{{ route('admin.module.chat') }}" class="navbar-link"><span>Chat and Support</span></a></li>
          <li class="nav-item"><a href="{{ route('admin.module.faqcontainer') }}" class="navbar-link"><span>FAQs</span></a></li>
          <li class="nav-item"><a href="{{ route('admin.module.pages') }}" class="navbar-link"><span>Site Pages</span></a></li>
      </ul>
  </nav>
  
  <div class="nav-title">System</div>
  <nav class="nav">
    <form method="POST" action="{{ route('admin.logout') }}">
      @csrf <button class="nav a" style="width:100%;background:transparent;border:0;color:inherit;text-align:left;cursor:pointer"><i class="bi bi-box-arrow-right"></i><span>Sign out</span></button>
    </form>
  </nav>
</aside>
<main class="main">
  <header class="topbar">
    <div class="crumb">Administration / {{ $title ?? 'Dashboard' }}</div>
    <div class="user"><span>{{ session('Boss_Name','Administrator') }}</span><span class="avatar">{{ strtoupper(substr(session('Boss_Name','A'),0,1)) }}</span></div>
  </header>
  <section class="content">@yield('content')</section>
</main>
</div>
</body>
</html>