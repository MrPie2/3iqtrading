<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>@yield('title','Investment Dashboard')</title>
<link rel="stylesheet" href="{{ asset('legacy-dashboard/css/lib/bootstrap/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('legacy-dashboard/css/style.css') }}">
<link rel="stylesheet" href="{{ asset('legacy-dashboard/css/lib/toastr/toastr.min.css') }}">
<link rel="stylesheet" href="{{ asset('legacy-dashboard/css/lib/sweetalert/sweetalert.css') }}">
<link rel="stylesheet" href="{{ asset('legacy-dashboard/icons/font-awesome/css/font-awesome.min.css') }}">
<link rel="stylesheet" href="{{ asset('legacy-dashboard/icons/themify-icons/themify-icons.css') }}">
<style>
:root{--brand:#6c2a68;--bg:#f7f8fc;--card:#fff;--muted:#718096}
body{background:var(--bg)}
.app-sidebar{min-height:100vh;background:#171827;color:#fff;position:sticky;top:0}
.app-sidebar a{color:#cbd5e1;text-decoration:none;display:block;padding:.75rem 1rem;border-radius:.6rem;margin:.15rem .5rem}
.app-sidebar a:hover,.app-sidebar a.active{background:rgba(255,255,255,.08);color:#fff}
.app-main{min-height:100vh}
.metric{border:0;border-radius:16px;box-shadow:0 8px 28px rgba(15,23,42,.06)}
.metric .value{font-size:1.65rem;font-weight:700}
.brand{font-weight:800;letter-spacing:.2px}
.table-card{border:0;border-radius:16px;box-shadow:0 8px 28px rgba(15,23,42,.05)}
.btn-brand{background:var(--brand);border-color:var(--brand);color:#fff}
.btn-brand:hover{color:#fff;filter:brightness(.95)}
.badge-soft{background:#f0e9f0;color:var(--brand)}
.avatar{width:42px;height:42px;border-radius:50%;object-fit:cover}
@media(max-width:991px){.app-sidebar{min-height:auto;position:relative}.desktop-only{display:none!important}}
</style>
@stack('head')
</head>
<body>
<div class="container-fluid">
<div class="row no-gutters">
<aside class="col-lg-2 app-sidebar p-3">
  <div class="brand fs-4 mb-4">Vellora Access</div>
  <div class="small text-muted mb-2">ACCOUNT</div>
  <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard')?'active':'' }}"><i class="fa fa-dashboard mr-2"></i> Dashboard</a>
  <a href="{{ route('wallet') }}"><i class="fa fa-credit-card mr-2"></i> Wallet</a>
  <a href="{{ route('deposit') }}"><i class="fa fa-plus-circle mr-2"></i> Deposit</a>
  <a href="{{ route('withdraw') }}"><i class="fa fa-minus-circle mr-2"></i> Withdraw</a>
  <div class="small text-muted mt-3 mb-2">INVEST</div>
  <a href="{{ route('investments.plans') }}"><i class="fa fa-line-chart mr-2"></i> Investment Plans</a>
  <a href="{{ route('investments.contracts') }}"><i class="fa fa-file-text mr-2"></i> My Investments</a>
  <a href="{{ route('market') }}"><i class="fa fa-bar-chart mr-2"></i> Stock Market</a>
  <div class="small text-muted mt-3 mb-2">ACTIVITY</div>
  <a href="{{ route('transfer') }}"><i class="fa fa-exchange mr-2"></i> Transfer</a>
  <a href="{{ route('referrals') }}"><i class="fa fa-users mr-2"></i> Referrals</a>
  <a href="{{ route('notifications') }}"><i class="fa fa-bell mr-2"></i> Notifications</a>
  <a href="{{ route('verification') }}"><i class="fa fa-shield mr-2"></i> Verification</a>
  <a href="{{ route('support') }}"><i class="fa fa-life-ring mr-2"></i> Support</a>
</aside>
<main class="col-lg-10 app-main">
<nav class="navbar navbar-light bg-white border-bottom px-4">
  <span class="navbar-brand mb-0 h1">@yield('heading','Dashboard')</span>
  <div class="ml-auto d-flex align-items-center">
    <a href="{{ route('notifications') }}" class="mr-3 text-muted"><i class="fa fa-bell"></i></a>
    <a href="{{ route('profile') }}" class="d-flex align-items-center text-dark">
      @php($pic=auth('investor')->user()->Profile_Picture)
      @php($picUrl = $pic ? (str_starts_with($pic,'http') ? $pic : (file_exists(public_path('legacy-dashboard/'.$pic)) ? asset('legacy-dashboard/'.$pic) : asset('storage/'.$pic))) : asset('legacy-dashboard/images/profile.jpg'))
      <img class="avatar mr-2" src="{{ $picUrl }}" onerror="this.src='{{ asset('legacy-dashboard/images/profile.jpg') }}'">
      <span>{{ auth('investor')->user()->First_Name }}</span>
    </a>
    <form method="POST" action="{{ route('logout') }}" class="ml-3">@csrf<button class="btn btn-sm btn-outline-secondary">Logout</button></form>
  </div>
</nav>
<div class="p-4">
@yield('content')
</div>
</main>
</div>
</div>
<script src="{{ asset('legacy-dashboard/js/lib/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('legacy-dashboard/js/lib/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('legacy-dashboard/js/lib/toastr/toastr.min.js') }}"></script>
<script>
const csrf=document.querySelector('meta[name="csrf-token"]').content;
async function api(url, options={}) {
  options.headers=Object.assign({'X-CSRF-TOKEN':csrf,'Accept':'application/json'},options.headers||{});
  const r=await fetch(url,options); const data=await r.json().catch(()=>({}));
  if(!r.ok) throw new Error(data.message||'Request failed');
  return data;
}
function formData(form){return new URLSearchParams(new FormData(form));}
</script>
@stack('scripts')
</body></html>