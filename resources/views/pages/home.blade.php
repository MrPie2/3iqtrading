@extends('layouts.app', ['title' => '3IQ Trading — Business & Investment'])

@section('content')
<section class="hero-wrap">
    <div class="container">
        <div class="hero-card row g-0 align-items-center overflow-hidden">
            <div class="col-lg-6">
                <div class="hero-copy">
                    <div class="eyebrow"><i class="bi bi-stars"></i> Business & investment</div>
                    <h1 class="hero-title">Build toward your <span>financial goals.</span></h1>
                    <p>Explore investment, stock, share and retirement account solutions through a clean, modern platform designed to make the next step easy to understand.</p>
                    <div class="d-flex flex-wrap gap-3 mt-4">
                        <a href="{{ route('register') }}" class="btn btn-primary btn-lg rounded-pill px-4">Get started <i class="bi bi-arrow-right ms-2"></i></a>
                        <a href="#plans" class="btn btn-light btn-lg rounded-pill px-4 border">Explore plans</a>
                    </div>
                    <div class="d-flex gap-4 mt-5 small text-secondary">
                        <span><i class="bi bi-shield-check text-primary me-1"></i> Secure account flow</span>
                        <span><i class="bi bi-phone text-primary me-1"></i> Responsive design</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 hero-visual">
                <img src="{{ asset('assets/img/hero-investment.svg') }}" alt="Investment illustration">
            </div>
        </div>
    </div>
</section>

<section class="section" id="about">
    <div class="container">
        <div class="row g-5 align-items-center">
            <div class="col-lg-6">
                <div class="about-image"><img src="{{ asset('assets/img/about-investment.svg') }}" alt="Investment growth illustration"></div>
            </div>
            <div class="col-lg-6">
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

<section class="section" id="ira-preview">
    <div class="container">
        <div class="row g-5 align-items-center">
            <div class="col-lg-6 order-lg-2"><div class="about-image"><img src="{{ asset('assets/img/retirement.svg') }}" alt="Retirement planning illustration"></div></div>
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
            <div class="small text-secondary">Demo market data for UI presentation only.</div>
        </div>
        <div class="row g-4">
            <div class="col-lg-8"><div class="chart-box"><canvas id="marketChart" height="135"></canvas></div></div>
            <div class="col-lg-4"><div class="chart-box h-100"><h5 class="fw-bold mb-3">Watchlist</h5><div class="table-responsive"><table class="table market-table mb-0"><tbody>
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
        <div class="accordion" id="faqAccordion">
            @foreach($faqs as $faq)
                <div class="accordion-item"><h2 class="accordion-header"><button class="accordion-button {{ $loop->first ? '' : 'collapsed' }}" type="button" data-bs-toggle="collapse" data-bs-target="#faq-{{ $faq->id }}">{{ $faq->question }}</button></h2><div id="faq-{{ $faq->id }}" class="accordion-collapse collapse {{ $loop->first ? 'show' : '' }}" data-bs-parent="#faqAccordion"><div class="accordion-body text-secondary">{{ $faq->answer }}</div></div></div>
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
const chartData = @json($chart);
new Chart(document.getElementById('marketChart'), {
    type: 'line',
    data: { labels: chartData.labels, datasets: [{ label: 'Demo price', data: chartData.values, borderWidth: 3, pointRadius: 3, tension: .35, fill: true }] },
    options: { responsive:true, plugins:{legend:{display:false}}, scales:{y:{grid:{color:'#eef2f7'}},x:{grid:{display:false}}} }
});
</script>
@endpush
