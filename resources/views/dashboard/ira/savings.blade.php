@extends('layouts.dashboard')

@section('title','IRA Savings')

@section('content')
@php
    $currency = $investor->Currency ?? $investor->currency ?? '$';
    $fmt = fn($value) => number_format((float) $value, 2);
@endphp

<div class="dashboard-heading">
    <div>
        <div class="eyebrow"><i class="bi bi-piggy-bank-fill"></i> IRA savings portfolio</div>
        <h1>Your retirement savings</h1>
        <p>Track your IRA savings, contributions and portfolio progress in one simple view.</p>
    </div>
    <a href="{{ route('dashboard.ira') }}" class="dashboard-primary-btn text-decoration-none"><i class="bi bi-safe2-fill me-1"></i> IRA overview</a>
</div>

<div class="ira-savings-hero dashboard-panel mb-4">
    <div class="row align-items-center g-4">
        <div class="col-lg-7">
            <span class="savings-status"><i class="bi bi-shield-check"></i> Personal savings portfolio</span>
            <h2 class="savings-total">{{ $currency }}{{ $fmt($iraSavings) }}</h2>
            <p>Total IRA savings</p>
            <div class="savings-actions">
                <a href="{{ route('wallet') }}" class="btn btn-brand"><i class="bi bi-wallet2 me-1"></i> Wallet</a>
                <a href="{{ route('dashboard.ira') }}" class="btn btn-outline-secondary"><i class="bi bi-lightbulb me-1"></i> Planning tips</a>
            </div>
        </div>
        <div class="col-lg-5">
            <div class="savings-ring" style="--progress: {{ $iraProgress }}%;">
                <div class="savings-ring-inner">
                    <strong>{{ number_format($iraProgress,0) }}%</strong>
                    <span>of target</span>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-3 mb-4">
    <div class="col-md-4"><div class="savings-stat"><div class="stat-icon"><i class="bi bi-wallet2"></i></div><span>Total saved</span><strong>{{ $currency }}{{ $fmt($iraSavings) }}</strong><small>Your current IRA savings balance</small></div></div>
    <div class="col-md-4"><div class="savings-stat"><div class="stat-icon"><i class="bi bi-arrow-down-circle"></i></div><span>Contributions</span><strong>{{ $currency }}{{ $fmt($iraContributions) }}</strong><small>Total recorded contributions</small></div></div>
    <div class="col-md-4"><div class="savings-stat"><div class="stat-icon"><i class="bi bi-graph-up-arrow"></i></div><span>Portfolio growth</span><strong>{{ $currency }}{{ $fmt($iraGrowth) }}</strong><small>Recorded growth, if available</small></div></div>
</div>

<div class="row g-4 mb-4">
    <div class="col-lg-8">
        <div class="dashboard-panel h-100">
            <div class="panel-heading">
                <div><div class="section-kicker">Savings portfolio</div><h2>Where your IRA stands</h2></div>
                <span class="mini-live"><i class="bi bi-circle-fill"></i> Portfolio</span>
            </div>
            <div class="portfolio-visual">
                <div class="portfolio-chart"><div class="chart-glow"></div><div class="chart-line"><span></span></div><div class="chart-dot"></div></div>
                <div class="portfolio-empty">
                    <i class="bi bi-bar-chart-line"></i>
                    <strong>Portfolio history will appear here</strong>
                    <p>Your savings history and allocation data will populate this view as IRA savings records become available.</p>
                </div>
            </div>
            <div class="portfolio-legend">
                <div><span class="legend-dot"></span><span>IRA savings</span><strong>{{ $currency }}{{ $fmt($iraSavings) }}</strong></div>
                <div><span class="legend-dot muted"></span><span>Target</span><strong>{{ $iraGoal > 0 ? $currency.$fmt($iraGoal) : 'Not set' }}</strong></div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="dashboard-panel h-100">
            <div class="section-kicker">Savings target</div>
            <h2>Keep your goal visible</h2>
            @if($iraGoal > 0)
                <div class="target-amount">{{ $currency }}{{ $fmt($iraGoal) }}</div>
                <div class="progress savings-progress mt-3"><div class="progress-bar" style="width:{{ $iraProgress }}%"></div></div>
                <p class="text-muted small mt-3">{{ number_format($iraProgress,1) }}% of your current target is represented by recorded savings.</p>
            @else
                <div class="target-placeholder"><i class="bi bi-bullseye"></i><strong>No savings target set</strong><span>Once an IRA target is connected to your account, your progress will appear here.</span></div>
            @endif
        </div>
    </div>
</div>

<div class="row g-4 mb-4">
    <div class="col-lg-6"><div class="dashboard-panel h-100">
        <div class="section-kicker">Portfolio features</div><h2>Designed around your retirement goal</h2>
        <div class="feature-grid mt-3">
            <div><i class="bi bi-activity"></i><strong>Track progress</strong><span>See your recorded savings balance and progress over time.</span></div>
            <div><i class="bi bi-calendar2-check"></i><strong>Contribution view</strong><span>Keep contributions separate from other portfolio activity.</span></div>
            <div><i class="bi bi-pie-chart-fill"></i><strong>Allocation ready</strong><span>Portfolio allocation can be displayed when investment records are connected.</span></div>
            <div><i class="bi bi-shield-lock-fill"></i><strong>Private dashboard</strong><span>Your savings information stays inside your authenticated account area.</span></div>
        </div>
    </div></div>
    <div class="col-lg-6"><div class="dashboard-panel h-100">
        <div class="section-kicker">Savings tips</div><h2>Small habits, long horizon</h2>
        <div class="tip-row"><span>01</span><div><strong>Contribute consistently</strong><small>Regular saving can help you maintain focus on a long-term retirement objective.</small></div></div>
        <div class="tip-row"><span>02</span><div><strong>Review your progress</strong><small>Check your balance and records periodically so you know where you stand.</small></div></div>
        <div class="tip-row"><span>03</span><div><strong>Understand the rules</strong><small>Contribution, withdrawal and tax rules depend on your account and jurisdiction.</small></div></div>
    </div></div>
</div>

<div class="dashboard-panel savings-note mb-4">
    <i class="bi bi-info-circle-fill"></i>
    <div><strong>Portfolio data</strong><span>The page is connected to IRA-specific account fields when available. Until actual IRA savings records are connected, balances remain at {{ $currency }}0.00 rather than displaying invented activity.</span></div>
</div>
@endsection

@push('head')
<style>
.ira-savings-hero{overflow:hidden;position:relative;background:radial-gradient(circle at 85% 15%,rgba(40,100,255,.2),transparent 35%),var(--db-panel)}
.savings-status{display:inline-flex;align-items:center;gap:7px;padding:7px 11px;border-radius:999px;background:rgba(40,100,255,.1);color:#4d8dff;font-size:.62rem;font-weight:800;text-transform:uppercase;letter-spacing:.07em}
.savings-total{font-size:clamp(2.2rem,5vw,4rem);font-weight:800;letter-spacing:-.05em;margin:20px 0 0}.ira-savings-hero p{color:var(--db-muted);font-size:.78rem}.savings-actions{display:flex;gap:9px;flex-wrap:wrap;margin-top:22px}
.savings-ring{width:220px;height:220px;margin:auto;border-radius:50%;display:grid;place-items:center;background:conic-gradient(#2864ff var(--progress),var(--db-border) 0);position:relative;box-shadow:0 25px 70px rgba(40,100,255,.18)}
.savings-ring:before{content:"";position:absolute;inset:13px;border-radius:50%;background:var(--db-panel)}.savings-ring-inner{position:relative;z-index:2;text-align:center}.savings-ring-inner strong{display:block;font-size:2rem}.savings-ring-inner span{font-size:.62rem;color:var(--db-muted)}
.savings-stat{height:100%;padding:18px;border:1px solid var(--db-border);border-radius:14px;background:var(--db-panel)}.savings-stat .stat-icon{width:38px;height:38px;display:grid;place-items:center;border-radius:10px;background:rgba(40,100,255,.1);color:#4d8dff;margin-bottom:15px}.savings-stat span{display:block;color:var(--db-muted);font-size:.62rem}.savings-stat strong{display:block;font-size:1.2rem;margin:4px 0}.savings-stat small{font-size:.58rem;color:var(--db-muted)}
.portfolio-visual{height:250px;margin-top:18px;border:1px solid var(--db-border);border-radius:14px;position:relative;overflow:hidden;background:linear-gradient(180deg,rgba(40,100,255,.06),transparent)}.portfolio-chart{position:absolute;inset:35px 25px 30px;overflow:hidden}.chart-line{position:absolute;left:0;right:0;bottom:25%;height:2px;background:#2864ff;transform:skewY(-8deg);opacity:.85}.chart-line:after{content:"";position:absolute;left:0;right:0;top:-28px;height:56px;border-top:2px solid rgba(40,100,255,.15);transform:skewY(12deg)}.chart-dot{position:absolute;right:5%;bottom:43%;width:9px;height:9px;border-radius:50%;background:#2864ff;box-shadow:0 0 0 7px rgba(40,100,255,.12)}.portfolio-empty{position:absolute;inset:0;display:flex;align-items:center;justify-content:center;flex-direction:column;text-align:center;padding:25px;background:linear-gradient(180deg,transparent,rgba(0,0,0,.08))}.portfolio-empty i{font-size:1.5rem;color:#4d8dff;margin-bottom:7px}.portfolio-empty strong{font-size:.76rem}.portfolio-empty p{max-width:390px;color:var(--db-muted);font-size:.62rem;margin:6px 0 0;line-height:1.55}
.portfolio-legend{display:grid;grid-template-columns:1fr 1fr;gap:10px;margin-top:12px}.portfolio-legend div{padding:11px;border:1px solid var(--db-border);border-radius:10px;font-size:.62rem}.portfolio-legend strong{float:right}.legend-dot{display:inline-block;width:7px;height:7px;border-radius:50%;background:#2864ff;margin-right:5px}.legend-dot.muted{background:var(--db-muted)}
.mini-live{font-size:.58rem;color:var(--db-muted)}.mini-live i{font-size:.4rem;color:#2864ff;margin-right:4px}.target-amount{font-size:1.65rem;font-weight:800;margin-top:18px}.savings-progress{height:7px;background:var(--db-border)}.savings-progress .progress-bar{background:#2864ff}.target-placeholder{display:flex;flex-direction:column;align-items:flex-start;gap:7px;margin-top:25px}.target-placeholder i{font-size:1.8rem;color:#4d8dff}.target-placeholder strong{font-size:.8rem}.target-placeholder span{font-size:.62rem;color:var(--db-muted);line-height:1.6}
.feature-grid{display:grid;grid-template-columns:1fr 1fr;gap:10px}.feature-grid>div{padding:13px;border:1px solid var(--db-border);border-radius:12px}.feature-grid i{color:#4d8dff;font-size:1rem}.feature-grid strong,.feature-grid span{display:block}.feature-grid strong{font-size:.68rem;margin-top:9px}.feature-grid span{font-size:.59rem;color:var(--db-muted);line-height:1.5;margin-top:4px}
.tip-row{display:flex;gap:12px;padding:13px 0;border-bottom:1px solid var(--db-border)}.tip-row:last-child{border-bottom:0}.tip-row>span{font-size:.62rem;font-weight:800;color:#4d8dff}.tip-row strong,.tip-row small{display:block}.tip-row strong{font-size:.68rem}.tip-row small{font-size:.59rem;color:var(--db-muted);line-height:1.55;margin-top:3px}
.savings-note{display:flex;gap:12px;align-items:flex-start;padding:16px}.savings-note>i{color:#4d8dff;font-size:1rem}.savings-note strong,.savings-note span{display:block}.savings-note strong{font-size:.68rem}.savings-note span{font-size:.6rem;color:var(--db-muted);line-height:1.6;margin-top:3px}
@media(max-width:575.98px){.savings-ring{width:170px;height:170px}.savings-ring-inner strong{font-size:1.5rem}.portfolio-legend,.feature-grid{grid-template-columns:1fr}.portfolio-visual{height:220px}}
</style>
@endpush