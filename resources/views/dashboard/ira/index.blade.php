@extends('layouts.dashboard')

@section('title','IRA')

@section('content')
<div class="dashboard-heading">
    <div>
        <div class="eyebrow"><i class="bi bi-safe2-fill"></i> Retirement planning</div>
        <h1>Your IRA workspace</h1>
        <p>Learn how Traditional and Roth IRAs work, review key retirement-planning concepts, and keep your long-term goals organized from one place.</p>
    </div>
    <a href="{{ route('investments.plans') }}" class="dashboard-primary-btn text-decoration-none"><i class="bi bi-lightning-charge-fill me-1"></i> Explore investments</a>
</div>

<div class="row g-4 mb-4">
    <div class="col-12">
        <div class="dashboard-panel ira-hero-panel">
            <div class="row align-items-center g-4">
                <div class="col-lg-7">
                    <span class="plan-badge"><i class="bi bi-shield-check"></i> Long-term planning</span>
                    <h2 class="ira-hero-title">Build a retirement strategy with clarity.</h2>
                    <p class="ira-hero-copy">An Individual Retirement Account (IRA) is a tax-advantaged account designed to help eligible individuals save and invest for retirement. The rules depend on the IRA type, your circumstances, and the jurisdiction that applies to you.</p>
                    <div class="d-flex flex-wrap gap-2 mt-4">
                        <a href="#ira-types" class="btn btn-brand"><i class="bi bi-arrow-down-circle me-1"></i> Learn the basics</a>
                        <a href="#ira-tips" class="btn btn-outline-secondary"><i class="bi bi-lightbulb me-1"></i> IRA tips</a>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="ira-visual">
                        <div class="ira-orbit ira-orbit-one"></div><div class="ira-orbit ira-orbit-two"></div>
                        <div class="ira-center"><i class="bi bi-safe2-fill"></i></div>
                        <div class="ira-float ira-float-top"><i class="bi bi-graph-up-arrow"></i><span>Long-term</span></div>
                        <div class="ira-float ira-float-bottom"><i class="bi bi-shield-check"></i><span>Tax-aware</span></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="ira-types" class="section-kicker mb-2">IRA types</div>
<div class="row g-4 mb-4">
    <div class="col-lg-6"><div class="plan-card ira-type-card">
        <div class="plan-top"><div class="plan-hero-icon"><i class="bi bi-piggy-bank-fill"></i></div><span class="plan-badge">Traditional</span></div>
        <h2>Traditional IRA</h2>
        <p class="text-muted small flex-grow-1">A Traditional IRA generally provides tax treatment that differs from a Roth IRA. Contributions, deductions, withdrawals, and required distributions are subject to applicable rules.</p>
        <div class="info-list mt-2">
            <div><i class="bi bi-check2-circle"></i><span>Understand contribution and deduction rules.</span></div>
            <div><i class="bi bi-check2-circle"></i><span>Consider how withdrawals may be taxed.</span></div>
            <div><i class="bi bi-check2-circle"></i><span>Review applicable distribution requirements.</span></div>
        </div>
    </div></div>
    <div class="col-lg-6"><div class="plan-card ira-type-card">
        <div class="plan-top"><div class="plan-hero-icon"><i class="bi bi-rocket-takeoff-fill"></i></div><span class="plan-badge">Roth</span></div>
        <h2>Roth IRA</h2>
        <p class="text-muted small flex-grow-1">A Roth IRA generally uses a different tax treatment from a Traditional IRA, with contributions and qualified withdrawals governed by eligibility and tax rules.</p>
        <div class="info-list mt-2">
            <div><i class="bi bi-check2-circle"></i><span>Understand eligibility and contribution rules.</span></div>
            <div><i class="bi bi-check2-circle"></i><span>Learn how qualified withdrawals are treated.</span></div>
            <div><i class="bi bi-check2-circle"></i><span>Consider the role of long-term compounding.</span></div>
        </div>
    </div></div>
</div>

<div class="row g-4 mb-4">
    <div class="col-lg-7"><div class="dashboard-panel h-100">
        <div class="panel-heading mb-3"><div><div class="section-kicker">Potential benefits</div><h2>Why people use retirement accounts</h2></div><div class="security-icon"><i class="bi bi-stars"></i></div></div>
        <div class="row g-3">
            <div class="col-sm-6"><div class="ira-benefit"><div class="security-icon"><i class="bi bi-percent"></i></div><strong>Tax advantages</strong><span>Depending on the account type and applicable rules, retirement accounts can provide tax benefits.</span></div></div>
            <div class="col-sm-6"><div class="ira-benefit"><div class="security-icon"><i class="bi bi-hourglass-split"></i></div><strong>Long-term focus</strong><span>A retirement account can help keep retirement goals visible over a longer investing horizon.</span></div></div>
            <div class="col-sm-6"><div class="ira-benefit"><div class="security-icon"><i class="bi bi-graph-up-arrow"></i></div><strong>Compounding</strong><span>Returns that remain invested may compound over time, although investment values can also fall.</span></div></div>
            <div class="col-sm-6"><div class="ira-benefit"><div class="security-icon"><i class="bi bi-bullseye"></i></div><strong>Goal discipline</strong><span>A dedicated retirement account can make it easier to separate long-term goals from everyday spending.</span></div></div>
        </div>
    </div></div>
    <div class="col-lg-5" id="ira-tips"><div class="dashboard-panel h-100">
        <div class="section-kicker">IRA tips</div><h2>Simple habits to consider</h2>
        <div class="step-list mt-3">
            <div><span>01</span><strong>Know your IRA type</strong><small>Understand how the account is taxed before contributing or withdrawing.</small></div>
            <div><span>02</span><strong>Think long term</strong><small>Retirement planning usually works best when goals and time horizon are clear.</small></div>
            <div><span>03</span><strong>Watch the rules</strong><small>Contribution limits, income rules, distributions, and penalties can change.</small></div>
            <div><span>04</span><strong>Keep records</strong><small>Save statements and transaction records so your retirement activity is easy to review.</small></div>
        </div>
    </div></div>
</div>

<div class="row g-4 mb-4">
    <div class="col-lg-6"><div class="dashboard-panel h-100">
        <div class="section-kicker">Planning checklist</div><h2>Before you make an IRA decision</h2>
        <div class="info-list mt-3">
            <div><i class="bi bi-check-circle"></i><span>Define your retirement timeline and objectives.</span></div>
            <div><i class="bi bi-check-circle"></i><span>Compare the tax treatment of the account types available to you.</span></div>
            <div><i class="bi bi-check-circle"></i><span>Check current contribution, eligibility, withdrawal, and distribution rules.</span></div>
            <div><i class="bi bi-check-circle"></i><span>Consider fees, diversification, risk tolerance, and investment horizon.</span></div>
        </div>
    </div></div>
    <div class="col-lg-6"><div class="dashboard-panel h-100">
        <div class="section-kicker">Important</div><h2>Keep your retirement information current</h2>
        <p class="text-muted small lh-lg">IRA rules are jurisdiction-specific and can change. The information on this dashboard is educational and should not be treated as individualized tax, legal, or investment advice. Check current official rules and consult a qualified professional when appropriate.</p>
        <div class="info-callout mt-3"><i class="bi bi-info-circle-fill"></i><div><strong>Educational guide</strong><span>Use this page to understand concepts before making account or investment decisions.</span></div></div>
    </div></div>
</div>
@endsection

@push('head')
<style>
.ira-hero-panel{position:relative;overflow:hidden;background:radial-gradient(circle at 85% 20%,rgba(40,100,255,.15),transparent 34%),var(--db-panel)}
.ira-hero-title{font-size:clamp(1.7rem,3vw,2.55rem);line-height:1.08;max-width:700px;margin:18px 0 12px}
.ira-hero-copy{color:var(--db-muted);font-size:.86rem;line-height:1.8;max-width:700px}
.ira-visual{min-height:280px;position:relative;display:flex;align-items:center;justify-content:center}
.ira-center{width:100px;height:100px;border-radius:28px;background:#2864ff;color:#fff;display:flex;align-items:center;justify-content:center;font-size:2.5rem;box-shadow:0 25px 55px rgba(40,100,255,.3);z-index:3}
.ira-orbit{position:absolute;border:1px solid rgba(40,100,255,.25);border-radius:50%}.ira-orbit-one{width:220px;height:220px}.ira-orbit-two{width:290px;height:150px;transform:rotate(-28deg)}
.ira-float{position:absolute;z-index:4;display:flex;align-items:center;gap:8px;padding:9px 12px;border:1px solid var(--db-border);border-radius:10px;background:rgba(18,22,29,.9);font-size:.65rem;font-weight:800;box-shadow:0 12px 35px rgba(0,0,0,.16)}
.ira-float i{color:#4d8dff}.ira-float-top{top:22px;right:4%}.ira-float-bottom{bottom:25px;left:4%}
.ira-benefit{height:100%;padding:14px;border:1px solid var(--db-border);border-radius:12px;background:rgba(40,100,255,.025)}
.ira-benefit strong,.ira-benefit span{display:block}.ira-benefit strong{font-size:.78rem;margin-top:10px}.ira-benefit span{font-size:.65rem;color:var(--db-muted);line-height:1.55;margin-top:4px}
@media(max-width:991.98px){.ira-visual{min-height:220px}.ira-float-top{right:8%}.ira-float-bottom{left:8%}}
@media(max-width:575.98px){.ira-hero-title{font-size:1.6rem}.ira-hero-copy{font-size:.78rem}.ira-visual{min-height:190px}.ira-center{width:76px;height:76px;border-radius:22px;font-size:1.8rem}.ira-orbit-one{width:160px;height:160px}.ira-orbit-two{width:210px;height:115px}.ira-float{font-size:.57rem;padding:7px 9px}.ira-float-top{top:4px}.ira-float-bottom{bottom:5px}.ira-benefit{padding:12px}}
html[data-theme="light"] .ira-float{background:rgba(255,255,255,.92)}
</style>
@endpush
