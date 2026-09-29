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
<nav class="navbar navbar-expand-lg iq-galaxy-nav sticky-top">
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
    body{
        overflow-x: hidden;
    }
</style>


