<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>@yield('title', 'Dashboard') — 3IQ Trading</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('assets/css/dashboard.css') }}?v={{ filemtime(public_path('assets/css/dashboard.css')) }}">
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
<button type="button" class="topbar-icon theme-toggle" style="background: none; border: none;" id="themeToggle" aria-label="Toggle theme"><i class="bi bi-moon-stars" id="themeIcon"></i></button><a href="{{ route('notifications') }}" class="topbar-icon" aria-label="Notifications"><i class="bi bi-bell"></i>@if(($notifications ?? collect())->count())<span class="notification-dot"></span>@endif</a>
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
<a href="{{ route('dashboard.ira') }}" class="{{ request()->routeIs('dashboard.ira*') ? 'active' : '' }}"><i class="bi bi-safe2-fill"></i>IRA</a>
<a href="{{ route('dashboard.ira.savings') }}" class="{{ request()->routeIs('dashboard.ira.savings') ? 'active' : '' }}"><i class="bi bi-piggy-bank-fill"></i>IRA Savings</a>
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
<div id="activityToast" class="activity-toast" role="status" aria-live="polite" aria-atomic="true">
<div class="activity-toast-head"><span><i class="bi bi-activity"></i> Recent activity</span><button type="button" id="activityToastClose" aria-label="Close">&times;</button></div>
<div class="activity-toast-body"><div class="activity-avatar" id="activityAvatar">3I</div><div class="activity-copy"><strong id="activityName">Investor</strong><span id="activityMeta"></span>
<small id="activityDisclosure">Payouts are made to only to verified transactions.</small>
</div></div>
</div>
<script src="{{ asset('assets/js/app.js') }}?v={{ filemtime(public_path('assets/js/app.js')) }}"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.7/dist/chart.umd.min.js"></script>
<script>
(function(){
const root=document.documentElement;
const body=document.body;
const toggle=document.getElementById('themeToggle');
const icon=document.getElementById('themeIcon');

function applyTheme(theme){
    const value=theme==='light'?'light':'dark';
    root.setAttribute('data-theme',value);
    body.setAttribute('data-theme',value);
    if(icon) icon.className=value==='light'?'bi bi-sun':'bi bi-moon-stars';
    if(toggle) toggle.setAttribute('aria-pressed',value==='light'?'true':'false');
}

let saved='dark';
try { saved=localStorage.getItem('3iq-theme') || 'dark'; } catch(e) {}
applyTheme(saved);

if(toggle){
    toggle.addEventListener('click',function(){
        const next=root.getAttribute('data-theme')==='light'?'dark':'light';
        applyTheme(next);
        try { localStorage.setItem('3iq-theme',next); } catch(e) {}
    });
}

const investors=[
{name:'Amara Okafor',country:'Sweden',invested:4200,profit:756},{name:'Daniel Brooks',country:'United Kingdom',invested:8500,profit:1360},
{name:'Sofia Martins',country:'Portugal',invested:3200,profit:544},{name:'Liam Carter',country:'Canada',invested:12750,profit:1912.5},
{name:'Aisha Bello',country:'Netherlands',invested:6100,profit:976},{name:'Noah Williams',country:'United States',invested:9800,profit:1568},
{name:'Mia Rossi',country:'Italy',invested:5400,profit:918},{name:'Ethan Smith',country:'Australia',invested:15000,profit:2400},
{name:'Chloe Martin',country:'France',invested:7300,profit:1095},{name:'Samuel Adeyemi',country:'Ghana',invested:4600,profit:736},
{name:'Elena Garcia',country:'Spain',invested:11800,profit:1770},{name:'Owen Jones',country:'Ireland',invested:3900,profit:624},
{name:'Fatima Yusuf',country:'Belgium',invested:6800,profit:1088},{name:'Lucas Silva',country:'Brazil',invested:9200,profit:1472},
{name:'Grace Kim',country:'South Korea',invested:7600,profit:1216},{name:'James Wilson',country:'New Zealand',invested:13400,profit:2144},
{name:'Nora Ahmed',country:'Egypt',invested:5100,profit:816},{name:'Benjamin Clark',country:'United States',invested:11200,profit:1680},
{name:'Yuki Tanaka',country:'Japan',invested:6400,profit:1024},{name:'Oliver Brown',country:'South Africa',invested:8700,profit:1305},
{name:'Layla Hassan',country:'United Arab Emirates',invested:14500,profit:2320},{name:'Henry Evans',country:'Germany',invested:5800,profit:928},
{name:'Zainab Musa',country:'Austria',invested:3500,profit:560},{name:'Jack Taylor',country:'United Kingdom',invested:10100,profit:1616},
{name:'Isabella Costa',country:'Portugal',invested:4700,profit:752},{name:'Michael King',country:'Canada',invested:12600,profit:1890},
{name:'Sarah White',country:'Australia',invested:7900,profit:1264},{name:'David Mensah',country:'Ghana',invested:4300,profit:688},
{name:'Clara Dubois',country:'France',invested:9600,profit:1536},{name:'Adam Rossi',country:'Italy',invested:6200,profit:992},
{name:'Mariam Ali',country:'Kenya',invested:7300,profit:1168},{name:'Thomas Green',country:'Ireland',invested:11800,profit:1888},
{name:'Hannah Lee',country:'Singapore',invested:8900,profit:1424},{name:'Ryan Moore',country:'United States',invested:15600,profit:2496},
{name:'Priya Nair',country:'India',invested:5200,profit:832},{name:'George Smith',country:'Australia',invested:6700,profit:1072},
{name:'Nadia Khan',country:'Pakistan',invested:4100,profit:656},{name:'William Scott',country:'United Kingdom',invested:9400,profit:1504},
{name:'Aya Nakamura',country:'Japan',invested:13800,profit:2208},{name:'Daniel Mensah',country:'Ghana',invested:5600,profit:896},
{name:'Maya Patel',country:'India',invested:8300,profit:1328},{name:'Alex Turner',country:'Canada',invested:10800,profit:1728},
{name:'Sarah Adams',country:'United States',invested:7100,profit:1136},{name:'Emeka Nwosu',country:'Switzerland',invested:12400,profit:1984},
{name:'Sophie Laurent',country:'France',invested:4800,profit:768},{name:'Marco Bianchi',country:'Italy',invested:9900,profit:1584},
{name:'Amina Sule',country:'Denmark',invested:5700,profit:912},{name:'Elias Weber',country:'Germany',invested:11600,profit:1856},
{name:'Victoria Brown',country:'New Zealand',invested:6800,profit:1088},{name:'Ahmed Farouk',country:'Egypt',invested:8200,profit:1312}
];
const toast=document.getElementById('activityToast');
if(toast){
    const money=n=>new Intl.NumberFormat(undefined,{minimumFractionDigits:2,maximumFractionDigits:2}).format(n);
    function showActivity(){
        const x=investors[Math.floor(Math.random()*investors.length)];
        document.getElementById('activityAvatar').textContent=x.name.split(' ').map(v=>v[0]).join('').slice(0,2).toUpperCase();
        document.getElementById('activityName').textContent=x.name;
        document.getElementById('activityMeta').textContent=x.country+' · Invested '+money(x.invested)+' · Profit '+money(x.profit);
        toast.classList.add('show');
        clearTimeout(window.activityToastTimer);
        window.activityToastTimer=setTimeout(()=>toast.classList.remove('show'),10000);
    }
    const close=document.getElementById('activityToastClose');
    if(close) close.addEventListener('click',()=>toast.classList.remove('show'));
    setTimeout(showActivity,3000);
    setInterval(showActivity,30000);
}
})();
</script>
@stack('scripts')
</body>
</html>