<nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom sticky-top py-3">
    <div class="container">
        <a class="navbar-brand fw-800 d-flex align-items-center gap-2" href="{{ route('home') }}">
            <span class="brand-mark"><i class="bi bi-bar-chart-fill"></i></span>
            <span>3IQ<span class="text-primary">Trading</span></span>
        </a>
        <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="mainNav">
            <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-2">
                <li class="nav-item"><a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Home</a></li>
                <li class="nav-item"><a class="nav-link {{ request()->routeIs('services') ? 'active' : '' }}" href="{{ route('services') }}">Services</a></li>
                <li class="nav-item"><a class="nav-link {{ request()->routeIs('ira') ? 'active' : '' }}" href="{{ route('ira') }}">IRA</a></li>
                <li class="nav-item"><a class="nav-link {{ request()->routeIs('stocks') ? 'active' : '' }}" href="{{ route('stocks') }}">Stocks</a></li>
                <li class="nav-item"><a class="nav-link {{ request()->routeIs('401k') ? 'active' : '' }}" href="{{ route('401k') }}">401(k)</a></li>
                <li class="nav-item"><a class="nav-link {{ request()->routeIs('shares') ? 'active' : '' }}" href="{{ route('shares') }}">Shares</a></li>
                @auth
                    <li class="nav-item ms-lg-2"><form method="POST" action="{{ route('logout') }}">@csrf<button class="btn btn-outline-dark rounded-pill px-4" type="submit">Logout</button></form></li>
                @else
                    <li class="nav-item ms-lg-2"><a class="btn btn-outline-dark rounded-pill px-4" href="{{ route('login') }}">Login</a></li>
                    <li class="nav-item"><a class="btn btn-primary rounded-pill px-4" href="{{ route('register') }}">Get Started</a></li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
