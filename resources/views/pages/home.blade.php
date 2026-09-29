@extends('layouts.app', ['title' => '3IQ Trading — Business & Investment'])
@section('content')
<section class="hero-wrap iq-hero" aria-label="3IQ Trading investment solutions">
    <div class="container-fluid px-0">
        <div id="iqHeroCarousel" class="iq-hero-carousel">
            <div class="iq-hero-track">
                <article class="iq-hero-slide is-active"><div class="iq-hero-bg"><img src="{{ asset('assets/images/hero-investment.svg') }}" alt="Investment growth illustration"></div><div class="iq-hero-overlay"></div><div class="iq-hero-inner"><div class="iq-hero-copy"><span class="iq-hero-eyebrow"><i class="bi bi-stars"></i> Investment solutions</span><h1 class="iq-hero-title">Build toward your <span>financial goals.</span></h1><p>Explore investment opportunities through a modern platform designed to help you understand markets, products and your next financial decision.</p><div class="d-flex flex-wrap gap-3 mt-4"><a href="{{ route('register') }}" class="btn btn-primary btn-lg rounded-pill px-4">Get started <i class="bi bi-arrow-right ms-2"></i></a><a href="/login" class="btn btn-light btn-lg rounded-pill px-4 border">Login</a></div></div></div></article>
                <article class="iq-hero-slide"><div class="iq-hero-bg"><img src="{{ asset('assets/images/hero-crypto.svg') }}" alt="Cryptocurrency market illustration"></div><div class="iq-hero-overlay"></div><div class="iq-hero-inner"><div class="iq-hero-copy"><span class="iq-hero-eyebrow"><i class="bi bi-currency-bitcoin"></i> Digital assets</span><h2 class="iq-hero-title">Explore the <span>crypto market.</span></h2><p>Follow digital assets with a clean market experience built around discovery, analysis and informed decision-making.</p><div class="d-flex flex-wrap gap-3 mt-4"><a href="{{ route('register') }}" class="btn btn-primary btn-lg rounded-pill px-4">Explore markets <i class="bi bi-arrow-right ms-2"></i></a><a href="#charts" class="btn btn-light btn-lg rounded-pill px-4 border">View snapshot</a></div></div></div></article>
                <article class="iq-hero-slide"><div class="iq-hero-bg"><img src="{{ asset('assets/images/hero-stock.svg') }}" alt="Global stock market illustration"></div><div class="iq-hero-overlay"></div><div class="iq-hero-inner"><div class="iq-hero-copy"><span class="iq-hero-eyebrow"><i class="bi bi-bar-chart-line"></i> Global equities</span><h2 class="iq-hero-title">Stay close to <span>stock markets.</span></h2><p>Discover global equities and keep market movements within reach from a responsive trading experience.</p><div class="d-flex flex-wrap gap-3 mt-4"><a href="{{ route('register') }}" class="btn btn-primary btn-lg rounded-pill px-4">Start exploring <i class="bi bi-arrow-right ms-2"></i></a><a href="{{ url('/stocks') }}" class="btn btn-light btn-lg rounded-pill px-4 border">View stocks</a></div></div></div></article>
                <article class="iq-hero-slide"><div class="iq-hero-bg"><img src="{{ asset('assets/images/hero-ira.svg') }}" alt="IRA and retirement planning illustration"></div><div class="iq-hero-overlay"></div><div class="iq-hero-inner"><div class="iq-hero-copy"><span class="iq-hero-eyebrow"><i class="bi bi-piggy-bank"></i> Retirement planning</span><h2 class="iq-hero-title">Plan for a <span>stronger tomorrow.</span></h2><p>Learn about IRA concepts and retirement-focused investing with information designed to make long-term planning easier to understand.</p><div class="d-flex flex-wrap gap-3 mt-4"><a href="{{ route('ira') }}" class="btn btn-primary btn-lg rounded-pill px-4">Explore IRA <i class="bi bi-arrow-right ms-2"></i></a><a href="{{ route('register') }}" class="btn btn-light btn-lg rounded-pill px-4 border">Create account</a></div></div></div></article>
            </div>
            <button class="iq-hero-control iq-hero-prev" type="button" aria-label="Previous slide"><i class="bi bi-arrow-left"></i></button>
            <button class="iq-hero-control iq-hero-next" type="button" aria-label="Next slide"><i class="bi bi-arrow-right"></i></button>
            <div class="iq-hero-dots" aria-label="Hero slides"><button class="active" type="button" aria-label="Investment slide"></button><button type="button" aria-label="Crypto slide"></button><button type="button" aria-label="Stock slide"></button><button type="button" aria-label="IRA slide"></button></div>
        </div>
    </div>
</section>
<style>
.iq-hero{padding:0 0 28px;background:#f5f8fd;overflow:hidden}.iq-hero-carousel{position:relative;min-height:590px;background:#071a3b}.iq-hero-track{position:relative;min-height:590px}.iq-hero-slide{position:absolute;inset:0;opacity:0;visibility:hidden;transform:scale(1.02);transition:opacity .7s ease,transform .9s ease,visibility .7s}.iq-hero-slide.is-active{opacity:1;visibility:visible;transform:scale(1);z-index:2}.iq-hero-inner{position:relative;z-index:3;width:min(1400px,100%);min-height:590px;margin:auto;padding:58px clamp(24px,8vw,110px);display:flex;align-items:center}.iq-hero-bg{position:absolute;inset:0;z-index:0;display:flex;justify-content:flex-end;overflow:hidden}.iq-hero-bg img{width:72%;height:100%;object-fit:cover;object-position:center;opacity:.72;filter:drop-shadow(0 30px 55px rgba(0,0,0,.28));animation:iqHeroFloat 6s ease-in-out infinite}.iq-hero-overlay{position:absolute;inset:0;z-index:1;background:linear-gradient(90deg,#071a3b 0%,rgba(7,26,59,.96) 30%,rgba(7,26,59,.65) 58%,rgba(7,26,59,.12) 100%)}.iq-hero-copy.iq-hero-eyebrow{display:inline-flex;align-items:center;gap:8px;padding:9px 15px;border-radius:999px;background:rgba(255,255,255,.09);border:1px solid rgba(255,255,255,.14);color:#bfe8ff;font-size:13px;font-weight:800;letter-spacing:.08em;text-transform:uppercase}.iq-hero-title{margin:20px 0 0;color:#fff;font-size:clamp(42px,5vw,72px);line-height:1.04;letter-spacing:-.045em;font-weight:800}.iq-hero-title span{color:#56d8ff}.iq-hero-copy p{max-width:570px;margin:24px 0 0;color:#cbd8ed;font-size:17px;line-height:1.75}.iq-hero-art{height:100%;min-height:500px;display:flex;align-items:center;justify-content:center}.iq-hero-art img{width:min(100%,720px);max-height:530px;object-fit:contain;filter:drop-shadow(0 30px 55px rgba(0,0,0,.28));animation:iqHeroFloat 6s ease-in-out infinite}.iq-hero-control{position:absolute;z-index:5;top:50%;transform:translateY(-50%);width:46px;height:46px;border:1px solid rgba(255,255,255,.2);border-radius:50%;background:rgba(255,255,255,.09);color:#fff;backdrop-filter:blur(10px);display:grid;place-items:center;transition:.2s}.iq-hero-control:hover{background:#fff;color:#0d5bd7}.iq-hero-prev{left:24px}.iq-hero-next{right:24px}.iq-hero-dots{position:absolute;z-index:6;bottom:25px;left:50%;transform:translateX(-50%);display:flex;gap:8px}.iq-hero-dots button{width:28px;height:4px;border:0;border-radius:20px;background:rgba(255,255,255,.35);padding:0;transition:.3s}.iq-hero-dots button.active{width:52px;background:#56d8ff}@keyframes iqHeroFloat{0%,100%{transform:translateY(0)}50%{transform:translateY(-9px)}}@media(max-width:991px){.iq-hero-carousel,.iq-hero-track,.iq-hero-inner{min-height:720px}.iq-hero-inner{padding:52px 34px 72px}.iq-hero-copy{max-width:680px}.iq-hero-bg img{width:100%;object-fit:cover;object-position:center right}.iq-hero-overlay{background:linear-gradient(180deg,#071a3b 0%,rgba(7,26,59,.78) 48%,#071a3b 100%)}.iq-hero-title{font-size:clamp(40px,8vw,60px)}}@media(max-width:575px){.iq-hero-carousel,.iq-hero-track,.iq-hero-inner{min-height:700px}.iq-hero-inner{padding:38px 22px 68px}.iq-hero-title{font-size:42px}.iq-hero-copy p{font-size:15px;line-height:1.65}.iq-hero-bg img{width:125%;object-position:center right;opacity:.48}.iq-hero-control{width:40px;height:40px}.iq-hero-prev{left:14px}.iq-hero-next{right:14px}.iq-hero-eyebrow{font-size:11px}.iq-hero-dots{bottom:18px}}@media(prefers-reduced-motion:reduce){.iq-hero-slide{transition:none}.iq-hero-art img{animation:none}}
</style>
<section class="services-section py-5">
    <div class="container">

        <!-- Heading -->
        <div class="text-center mb-5">
            <span class="services-eyebrow">WHAT WE OFFER</span>

            <h2 class="services-title">
                Our Services
            </h2>

            <p class="services-subtitle mx-auto">
                Powerful financial solutions designed to help you access,
                manage, and grow your investments with confidence.
            </p>
        </div>

        <!-- Horizontal Services -->
        <div class="services-scroll">

            <!-- Service 1 -->
            <div class="service-card">
                <div class="service-image">
                    <img src="{{ asset('assets/images/trading@1x.webp') }}"
                         alt="Investment Management">
                </div>

                <div class="service-content">
                    <h3>Forex</h3>
                    <p>
                       Forex Currency Pairs
                    </p>
                </div>
            </div>

            <!-- Service 2 -->
            <div class="service-card">
                <div class="service-image">
                    <img src="{{ asset('assets/images/cfd@2x.webp') }}"
                         alt="Market Trading">
                </div>

                <div class="service-content">
                    <h3>Shares</h3>
                    <p>
                       More than 10,000 stocks on global exchanges
                    </p>
                </div>
            </div>

            <!-- Service 3 -->
            <div class="service-card">
                <div class="service-image">
                    <img src="{{ asset('assets/images/indices@2x.webp') }}"
                         alt="Portfolio Management">
                </div>

                <div class="service-content">
                    <h3>Indices</h3>
                    <p>
                        19 major global indices
                    </p>
                </div>
            </div>

            <!-- Service 4 -->
            <div class="service-card">
                <div class="service-image">
                    <img src="{{ asset('assets/images/commodities@2x.webp') }}"
                         alt="Wealth Planning">
                </div>

                <div class="service-content">
                    <h3>Commodities</h3>
                    <p>
                        Coffee, Oil, Natural Gas, Corn and More
                    </p>
                </div>
            </div>

            <!-- Service 5 -->
            <div class="service-card">
                <div class="service-image">
                    <img src="{{ asset('assets/images/bonds@1x.webp') }}"
                         alt="Market Analytics">
                </div>

                <div class="service-content">
                    <h3>Bond</h3>
                    <p>
                        US10YR & UK Long Gilt Futures GILTS
                    </p>
                </div>
            </div>

            <!-- Service 6 -->
            <div class="service-card">
                <div class="service-image">
                    <img src="{{ asset('assets/images/metals@2x.webp') }}"
                         alt="Financial Advisory">
                </div>

                <div class="service-content">
                    <h3>Metal</h3>
                    <p>
                       Global, Silver and More
                    </p>
                </div>
            </div>

        </div>

    </div>
</section>



<section class="section" id="about">
    <div class="containe">
        <div class="row g-5 align-items-center">
            <div class="col-lg-6">
                <div class="about-imag"><center><img style=" width: 80%;text-align: center margin: 0 auto;left: 0; right: 0 " src="{{ asset('assets/images/serverimage@2x.webp') }}" alt="Investment growth illustration"></center></div>
            </div>
            <div class="col-lg-6" style="padding: 50px">
                <div class="eyebrow">About us</div>
                <h2 class="section-title mt-2">A simpler way to organize your investment journey.</h2>
                <p class="section-lead mt-3">3IQ Trading is presented here as a polished website foundation where visitors can learn about investment products, compare options and create an account.</p>
                <div class="row g-3 mt-4">
                    <div class="col-sm-6"><div class="feature-card"><div class="icon-box"><i class="bi bi-graph-up-arrow"></i></div><h5 class="fw-bold">Clear information</h5><p class="mb-0">Present products, terms and risks in a straightforward format.</p></div></div>
                    <div class="col-sm-6"><div class="feature-card"><div class="icon-box"><i class="bi bi-person-check"></i></div><h5 class="fw-bold">Account ready</h5><p class="mb-0">Registration and login are wired into Laravel authentication.</p></div></div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section section-soft" id="plans">
    <div class="container">
        <div class="text-center mb-5">
            <div class="eyebrow">Investment plans</div>
            <h2 class="section-title mt-2">Choose a plan that fits your goals.</h2>
            <p class="section-lead mx-auto mt-3">These are demo plan records seeded into the database. Replace rates, terms and disclosures with your approved product data.</p>
        </div>
        <div class="row g-4">
            @foreach($plans as $plan)
                <div class="col-md-6 col-lg-4">
                    <div class="plan-card {{ $plan->featured ? 'featured' : '' }}">
                        @if($plan->featured)<span class="plan-badge">Popular</span>@endif
                        <div class="icon-box"><i class="bi bi-pie-chart"></i></div>
                        <h4 class="fw-bold">{{ $plan->name }}</h4>
                        <p class="text-secondary">{{ $plan->description }}</p>
                        <div class="price mt-4">${{ number_format($plan->minimum_amount, 0) }}<span class="fs-6 text-secondary fw-normal"> minimum</span></div>
                        <div class="small text-secondary mt-1">{{ $plan->term_label }} · {{ $plan->risk_level }} risk</div>
                        <ul class="plan-list">
                            @foreach(($plan->features ?? []) as $feature)<li><i class="bi bi-check-circle-fill"></i>{{ $feature }}</li>@endforeach
                        </ul>
                        <a href="{{ route('register') }}" class="btn {{ $plan->featured ? 'btn-primary' : 'btn-outline-primary' }} rounded-pill w-100">Select plan</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
<section class="iq-trading-section py-5">
    <div class="contai">
        <div class="row align-items-center g-5">

            {{-- COLUMN 1: IMAGE --}}
            <div class="col-lg-6">
                <div class="iq-trading-image-wrapper">
                    <img style="width: 90%;" src="{{ asset('assets/images/mt5-mobile.png') }}"
                        alt="3IQTrading Trading Platform"
                        class="-img-flid "
                    >
                </div>
            </div>


            {{-- COLUMN 2: CAPTION --}}
            <div class="col-lg-6">
                <div class="iq-trading-content">

             
<h2 class="section-title mt-2">Trade from anywhere around the world</h2>
                    <div class="eyebrow">

                        Trade from anywhere around the world
                        
                    </div>

                    <a href="{{ url('/register') }}"
                       class="btn iq-trading-btn">
                        Start Trading
                        <i class="fas fa-arrow-right ms-2"></i>
                    </a>

                </div>
            </div>

        </div>
    </div>
</section>


<style>
    /* ==============================
       3IQTRADING SECTION
    ============================== */

    .iq-trading-section {
        background: #ffffff;
        padding: 100px 0 !important;
        overflow: hidden;
    }


    /* ==============================
       IMAGE COLUMN
    ============================== */

    .iq-trading-image-wrapper {
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 20px;
    }

    .iq-trading-image {
        width: 100%;
        max-width: 500px;
        height: auto;
        display: block;

        filter: drop-shadow(
            0 25px 45px rgba(13, 71, 161, 0.15)
        );

        transition: transform 0.3s ease;
    }

    .iq-trading-image:hover {
        transform: translateY(-8px);
    }


    /* ==============================
       CONTENT COLUMN
    ============================== */

    .iq-trading-content {
        max-width: 570px;
        padding: 20px 0;
    }


    /* ==============================
       BRAND LABEL
    ============================== */

    .iq-trading-label {
        display: inline-block;

        padding: 8px 16px;

        background: #eaf2ff;
        color: #1261d6;

        border-radius: 30px;

        font-size: 13px;
        font-weight: 700;

        letter-spacing: 1px;
        text-transform: uppercase;

        margin-bottom: 20px;
    }


    /* ==============================
       HEADING
    ============================== */

    .iq-trading-title {
        margin: 0;

        color: #102a43;

        font-size: 48px;
        line-height: 1.15;

        font-weight: 800;

        letter-spacing: -1px;
    }

    .iq-trading-title span {
        display: block;
        color: #1261d6;
        margin-top: 5px;
    }


    /* ==============================
       DESCRIPTION
    ============================== */

    .iq-trading-description {
        margin-top: 25px;
        margin-bottom: 30px;

        color: #68778d;

        font-size: 17px;
        line-height: 1.8;
    }


    /* ==============================
       BUTTON
    ============================== */

    .iq-trading-btn {
        display: inline-flex;
        align-items: center;

        padding: 14px 26px;

        background: #1261d6;
        color: #ffffff;

        border: 1px solid #1261d6;
        border-radius: 8px;

        font-size: 15px;
        font-weight: 700;

        transition: all 0.25s ease;
    }

    .iq-trading-btn:hover {
        background: #0b4fab;
        border-color: #0b4fab;
        color: #ffffff;

        transform: translateY(-2px);
    }


    /* ==============================
       TABLET
    ============================== */

    @media (max-width: 991px) {

        .iq-trading-section {
            padding: 70px 0 !important;
        }

        .iq-trading-content {
            max-width: 100%;
        }

        .iq-trading-title {
            font-size: 42px;
        }

        .iq-trading-image {
            max-width: 430px;
        }
    }


    /* ==============================
       MOBILE
    ============================== */

    @media (max-width: 767px) {

        .iq-trading-section {
            padding: 60px 0 !important;
        }

        .iq-trading-image-wrapper {
            padding: 0 15px;
        }

        .iq-trading-image {
            max-width: 350px;
        }

        .iq-trading-content {
            text-align: center;
            padding: 10px 15px;
        }

        .iq-trading-title {
            font-size: 36px;
        }

        .iq-trading-description {
            font-size: 15px;
            line-height: 1.7;
        }
    }


    /* ==============================
       SMALL MOBILE
    ============================== */

    @media (max-width: 400px) {

        .iq-trading-title {
            font-size: 32px;
        }

        .iq-trading-label {
            font-size: 11px;
        }
    }

</style>

<!-- IRA Section -->
<section class="ira-section py-5">
    <div class="container py-lg-5">
        <div class="row align-items-center g-5">

            <!-- Left Column: Image -->
            <div class="col-lg-6">
                <div class="ira-image-wrapper">
                    <img src="{{ asset('assets/images/ira-retirement.jpg') }}"
                         alt="Secure retirement with IRA"
                         class="img-fluid ira-image">

                    <div class="ira-image-badge">
                        <i class="bi bi-shield-check"></i>
                        <div>
                            <strong>Plan for Tomorrow</strong>
                            <small>Build your retirement with confidence</small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column -->
            <div class="col-lg-6">

                <span class="ira-label">RETIREMENT PLANNING</span>

                <h2 class="ira-title mt-2">
                    Build a More <span>Secure Retirement</span>
                </h2>

                <p class="ira-description">
                    Take control of your financial future with an Individual
                    Retirement Account. 3IQ Trading provides tools and
                    investment solutions designed to help you prepare for
                    the retirement you envision.
                </p>

                <!-- FAQ Accordion -->
                <div class="accordion ira-accordion mt-4" id="iraAccordion">

                    <!-- Question 1 -->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="iraHeadingOne">
                            <button class="accordion-button"
                                    type="button"
                                    data-bs-toggle="collapse"
                                    data-bs-target="#iraCollapseOne"
                                    aria-expanded="true"
                                    aria-controls="iraCollapseOne">
                                What is an IRA?
                            </button>
                        </h2>

                        <div id="iraCollapseOne"
                             class="accordion-collapse collapse show"
                             aria-labelledby="iraHeadingOne"
                             data-bs-parent="#iraAccordion">

                            <div class="accordion-body">
                                An Individual Retirement Account (IRA) is a
                                retirement savings account that can provide
                                tax advantages while you save and invest for
                                your future.
                            </div>

                        </div>
                    </div>

                    <!-- Question 2 -->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="iraHeadingTwo">
                            <button class="accordion-button collapsed"
                                    type="button"
                                    data-bs-toggle="collapse"
                                    data-bs-target="#iraCollapseTwo"
                                    aria-expanded="false"
                                    aria-controls="iraCollapseTwo">
                                Why should I consider an IRA?
                            </button>
                        </h2>

                        <div id="iraCollapseTwo"
                             class="accordion-collapse collapse"
                             aria-labelledby="iraHeadingTwo"
                             data-bs-parent="#iraAccordion">

                            <div class="accordion-body">
                                An IRA can help you set aside money specifically
                                for retirement and potentially benefit from
                                tax-advantaged growth, depending on the type
                                of IRA and applicable rules.
                            </div>

                        </div>
                    </div>

                    <!-- Question 3 -->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="iraHeadingThree">
                            <button class="accordion-button collapsed"
                                    type="button"
                                    data-bs-toggle="collapse"
                                    data-bs-target="#iraCollapseThree"
                                    aria-expanded="false"
                                    aria-controls="iraCollapseThree">
                                How can I get started?
                            </button>
                        </h2>

                        <div id="iraCollapseThree"
                             class="accordion-collapse collapse"
                             aria-labelledby="iraHeadingThree"
                             data-bs-parent="#iraAccordion">

                            <div class="accordion-body">
                                Start by reviewing the available retirement
                                options and determining which account and
                                investment strategy fits your goals. You can
                                then follow the account-opening process and
                                begin planning for your retirement.
                            </div>

                        </div>
                    </div>

                </div>

                <a href="{{ route('ira') }}" class="btn ira-btn mt-4">
                    Explore IRA Options
                    <i class="bi bi-arrow-right ms-2"></i>
                </a>

            </div>
        </div>
    </div>
</section>

<section class="section" id="ira-preview">
    <div class="container">
        <div class="row g-5 align-items-center">
            <div class="col-lg-6 order-lg-2"><div class="about-image"><img src="{{ asset('assets/images/smiling-couples.png') }}" alt="Retirement planning illustration"></div></div>
            <div class="col-lg-6 order-lg-1">
                <div class="eyebrow">IRA account</div>
                <h2 class="section-title mt-2">Keep retirement planning in view.</h2>
                <p class="section-lead mt-3">Give visitors a dedicated place to learn about traditional and Roth IRA concepts, contribution planning and long-term investing.</p>
                <a href="{{ route('ira') }}" class="btn btn-dark rounded-pill px-4 mt-3">Explore IRA <i class="bi bi-arrow-right ms-2"></i></a>
            </div>
        </div>
    </div>
</section>

<section class="section section-soft" id="how-it-works">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-5">
                <div class="eyebrow">How to get started</div>
                <h2 class="section-title mt-2">From sign-up to your next financial decision.</h2>
                <p class="section-lead mt-3">The public site is ready now; a client dashboard can be connected later without redesigning these pages.</p>
            </div>
            <div class="col-lg-7 steps">
                <div class="step"><div class="step-num">1</div><div><h5>Create your account</h5><p>Register with your name, email and password. Laravel validates and securely hashes passwords.</p></div></div>
                <div class="step"><div class="step-num">2</div><div><h5>Explore available products</h5><p>Review services, stocks, shares and retirement account information before making a decision.</p></div></div>
                <div class="step"><div class="step-num">3</div><div><h5>Connect the future dashboard</h5><p>Later, the same Laravel backend can add portfolios, deposits, orders, notifications and account statements.</p></div></div>
            </div>
        </div>
    </div>
</section>

<section class="section" id="charts">
    <div class="container">
        <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-end gap-3 mb-4">
            <div><div class="eyebrow">Trading charts</div><h2 class="section-title mt-2 mb-0">Market snapshot</h2></div>
            <div class="small text-secondary"> market data for UI presentation only.</div>
        </div>
        <div class="row g-4">
            <div class="col-md-12"><div class="chart-box h-100"><h5 class="fw-bold mb-3">Watchlist</h5><div class="table-responsive"><table class="table market-table mb-0"><tbody>
                @foreach($market as $asset)
                    <tr><td><div class="fw-bold">{{ $asset['symbol'] }}</div><div class="small text-secondary">{{ $asset['name'] }}</div></td><td class="text-end"><div class="fw-bold">${{ number_format($asset['price'], 2) }}</div><div class="small change-up">+{{ number_format($asset['change'], 2) }}%</div></td></tr>
                @endforeach
            </tbody></table></div></div></div>
        </div>
    </div>
</section>

<section class="section section-soft" id="faq">
    <div class="container">
        <div class="text-center mb-5"><div class="eyebrow">FAQ</div><h2 class="section-title mt-2">Questions, answered.</h2></div>
        <div class="accordio" id="faqAccordion">
            @foreach($faqs as $faq)
                <div class="accordion-item"><h2 class="accordion-header">
                    <button class="accordion-button {{ $loop->first ? '' : 'collapsed' }}" style="background-color: #007bff; color: #fff;" type="button" data-bs-toggle="collapse" data-bs-target="#faq-{{ $faq->id }}">{{ $faq->question }}</button>
                </h2><div id="faq-{{ $faq->id }}" class="accordion-collapse collapse {{ $loop->first ? 'show' : '' }}" data-bs-parent="#faqAccordion">
                    <div class="accordion-body text-secondary" style="padding: 20px">{{ $faq->answer }}</div></div></div>
            <br>
                @endforeach
        </div>
    </div>
</section>

<section class="section pt-5 pb-4">
    <div class="container"><div class="p-4 p-lg-5 rounded-4 bg-primary text-white d-flex flex-column flex-lg-row justify-content-between align-items-lg-center gap-4"><div><h3 class="fw-bold mb-2">Ready to explore 3IQ Trading?</h3><p class="mb-0 opacity-75">Create an account and continue building the client dashboard later.</p></div><a href="{{ route('register') }}" class="btn btn-light rounded-pill px-4">Create account</a></div></div>
</section>
@endsection

@push('scripts')
<script>
(function(){const root=document.getElementById('iqHeroCarousel');if(!root)return;const slides=[...root.querySelectorAll('.iq-hero-slide')],dots=[...root.querySelectorAll('.iq-hero-dots button')];let index=0,timer;function show(i){index=(i+slides.length)%slides.length;slides.forEach((s,n)=>s.classList.toggle('is-active',n===index));dots.forEach((d,n)=>d.classList.toggle('active',n===index));}function restart(){clearInterval(timer);timer=setInterval(()=>show(index+1),6500)}root.querySelector('.iq-hero-next').addEventListener('click',()=>{show(index+1);restart()});root.querySelector('.iq-hero-prev').addEventListener('click',()=>{show(index-1);restart()});dots.forEach((d,n)=>d.addEventListener('click',()=>{show(n);restart()}));show(0);restart();root.addEventListener('mouseenter',()=>clearInterval(timer));root.addEventListener('mouseleave',restart)})();
</script>
<script>
const chartData = @json($chart);
new Chart(document.getElementById('marketChart'), {
    type: 'line',
    data: { labels: chartData.labels, datasets: [{ label: 'Demo price', data: chartData.values, borderWidth: 3, pointRadius: 3, tension: .35, fill: true }] },
    options: { responsive:true, plugins:{legend:{display:false}}, scales:{y:{grid:{color:'#eef2f7'}},x:{grid:{display:false}}} }
});
</script>
@endpush
