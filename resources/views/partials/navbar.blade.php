<!-- Smartsupp Live Chat script -->
<script type="text/javascript">
var _smartsupp = _smartsupp || {};
_smartsupp.key = 'f3966d5634196312491eacc58adf521df294c249';
window.smartsupp||(function(d) {
  var s,c,o=smartsupp=function(){ o._.push(arguments)};o._=[];
  s=d.getElementsByTagName('script')[0];c=d.createElement('script');
  c.type='text/javascript';c.charset='utf-8';c.async=true;
  c.src='https://www.smartsuppchat.com/loader.js?';s.parentNode.insertBefore(c,s);
})(document);
</script>
<noscript>Powered by <a href="https://www.smartsupp.com" target="_blank">Smartsupp</a></noscript>
<nav class="navbar navbar-expand-lg iq-galaxy-nav {{ request()->routeIs('home') ? 'iq-home-nav' : 'sticky-top' }}">
    <div class="iq-nav-glow"></div><div class="container position-relative">
        <a class="navbar-brand fw-800 d-flex align-items-center gap-2 iq-brand" href="{{ route('home') }}">
            <span class="iq-brand-orbit"><i class="bi bi-bar-chart-fill"></i></span>
            <span>3IQ<span>Trading</span></span>
        </a>
        <button class="navbar-toggler iq-nav-toggle" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav" aria-label="Toggle navigation">
            <span></span><span></span><span></span>
        </button>
        <div class="collapse navbar-collapse" id="mainNav">
            <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-1">
                <li class="nav-item"><a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}"><i class="bi bi-grid-1x2-fill"></i> Home</a></li>
                <li class="nav-item"><a class="nav-link {{ request()->routeIs('services') ? 'active' : '' }}" href="{{ route('services') }}"><i class="bi bi-layers-fill"></i> Services</a></li>
                <li class="nav-item"><a class="nav-link {{ request()->routeIs('ira') ? 'active' : '' }}" href="{{ route('ira') }}"><i class="bi bi-piggy-bank-fill"></i> IRA</a></li>
                <li class="nav-item"><a class="nav-link {{ request()->routeIs('stocks') ? 'active' : '' }}" href="{{ route('stocks') }}"><i class="bi bi-graph-up-arrow"></i> Stocks</a></li>
                <li class="nav-item"><a class="nav-link {{ request()->routeIs('401k') ? 'active' : '' }}" href="{{ route('401k') }}"><i class="bi bi-safe2-fill"></i> 401(k)</a></li>
                <li class="nav-item"><a class="nav-link {{ request()->routeIs('shares') ? 'active' : '' }}" href="{{ route('shares') }}"><i class="bi bi-pie-chart-fill"></i> Shares</a></li>
                @auth('investor')
                    <li class="nav-item ms-lg-2"><form method="POST" action="{{ route('logout') }}">@csrf<button class="btn iq-nav-login rounded-pill px-4" type="submit">Logout</button></form></li>
                @else
                    <li class="nav-item ms-lg-2"><a class="btn iq-nav-login rounded-pill px-4" href="{{ route('login') }}">Login</a></li>
                    <li class="nav-item"><a class="btn iq-nav-start rounded-pill px-4" href="{{ route('register') }}">Get Started <i class="bi bi-arrow-up-right ms-1"></i></a></li>
                @endauth
            </ul>
        </div>
    </div>
</nav>

<style>
.iq-galaxy-nav{--nav-cyan:#59ddff;--nav-blue:#2577ff;position:relative;z-index:1000;min-height:64px;background:rgba(2,8,23,.78)!important;border-bottom:1px solid rgba(100,190,255,.16);backdrop-filter:blur(18px) saturate(150%);-webkit-backdrop-filter:blur(18px) saturate(150%);box-shadow:0 10px 40px rgba(0,0,0,.22)}
.iq-nav-glow{position:absolute;inset:auto 8% -1px;height:1px;background:linear-gradient(90deg,transparent,rgba(74,210,255,.8),rgba(66,119,255,.7),transparent);box-shadow:0 0 18px rgba(55,192,255,.55);pointer-events:none}
.iq-galaxy-nav .container{min-height:64px}.iq-brand{color:#fff!important;font-size:1.18rem;letter-spacing:-.03em;position:relative}.iq-brand>span:last-child{font-weight:800}.iq-brand>span:last-child span{color:var(--nav-cyan)}
.iq-brand-orbit{width:34px;height:34px;display:grid;place-items:center;border:1px solid rgba(100,220,255,.5);border-radius:50%;color:#fff;background:radial-gradient(circle at 35% 30%,#53ddff,#1761e8 55%,#091a4b);box-shadow:0 0 18px rgba(40,176,255,.4),inset 0 0 12px rgba(255,255,255,.15);position:relative}
.iq-brand-orbit:before,.iq-brand-orbit:after{content:"";position:absolute;border:1px solid rgba(99,219,255,.35);border-radius:50%;inset:-5px 3px;transform:rotate(35deg)}.iq-brand-orbit:after{inset:3px -5px;transform:rotate(-35deg);border-color:rgba(101,130,255,.28)}
.iq-galaxy-nav .navbar-nav{gap:2px}.iq-galaxy-nav .nav-link{color:#aebed7!important;font-size:.88rem;font-weight:650;padding:.5rem .65rem!important;border-radius:12px;display:flex;align-items:center;gap:7px;transition:color .2s,background .2s,box-shadow .2s,transform .2s}.iq-galaxy-nav .nav-link i{font-size:.82rem;color:#7294c5;transition:color .2s}.iq-galaxy-nav .nav-link:hover,.iq-galaxy-nav .nav-link.active{color:#fff!important;background:rgba(68,180,255,.09);box-shadow:inset 0 0 0 1px rgba(91,202,255,.12),0 0 20px rgba(35,129,255,.08)}.iq-galaxy-nav .nav-link:hover i,.iq-galaxy-nav .nav-link.active i{color:var(--nav-cyan)}
.iq-nav-login{color:#dceaff!important;background:rgba(255,255,255,.045)!important;border:1px solid rgba(157,195,235,.22)!important;transition:.2s}.iq-nav-login:hover{background:rgba(77,190,255,.1)!important;border-color:rgba(89,221,255,.5)!important;box-shadow:0 0 20px rgba(45,171,255,.15)}
.iq-nav-start{color:#fff!important;border:1px solid rgba(89,221,255,.55)!important;background:linear-gradient(135deg,#1264e9,#19a9ff)!important;box-shadow:0 0 22px rgba(32,145,255,.25),inset 0 1px 0 rgba(255,255,255,.22);transition:.2s}.iq-nav-start:hover{transform:translateY(-1px);box-shadow:0 0 30px rgba(32,170,255,.4)}
.iq-nav-toggle{border:1px solid rgba(104,194,255,.25)!important;border-radius:12px;padding:9px 10px;background:rgba(255,255,255,.045);box-shadow:0 0 18px rgba(35,129,255,.08)}.iq-nav-toggle span{display:block;width:21px;height:2px;margin:4px 0;background:#c9edff;border-radius:3px}
@media(max-width:991.98px){
.iq-galaxy-nav{min-height:60px}
.iq-galaxy-nav .container{min-height:60px}
.iq-galaxy-nav .navbar-collapse{
    position:absolute;
    top:calc(100% + 8px);
    left:12px;
    right:12px;
    margin:0;
    padding:8px;
    border:1px solid rgba(100,190,255,.2);
    border-radius:18px;
    background:rgba(10,13,17,.94);
    box-shadow:0 24px 60px rgba(0,0,0,.42),inset 0 1px rgba(255,255,255,.08),0 0 35px rgba(24,130,255,.1);
    backdrop-filter:blur(24px) saturate(160%);
    -webkit-backdrop-filter:blur(24px) saturate(160%);
}
.iq-galaxy-nav .nav-link{padding:.65rem .85rem!important}
.iq-galaxy-nav .navbar-nav{align-items:stretch!important}
.iq-galaxy-nav .nav-item.ms-lg-2{margin-left:0!important;margin-top:5px}
.iq-nav-login,.iq-nav-start{width:100%;justify-content:center;display:flex;align-items:center}
}
body{overflow-x:hidden}

.iq-home-nav{position:absolute!important;top:0;left:0;width:100%}
@media(max-width:991.98px){
.iq-galaxy-nav .navbar-collapse.collapsing,
.iq-galaxy-nav .navbar-collapse.show{
    position:absolute!important;
    top:calc(100% + 8px)!important;
    left:12px!important;
    right:12px!important;
    width:auto!important;
    height:auto!important;
}
.iq-galaxy-nav .navbar-collapse.collapsing{
    display:block!important;
    overflow:visible!important;
    transition:none!important;
}
.iq-galaxy-nav .navbar-collapse.show{
    display:block!important;
}
}
</style>


