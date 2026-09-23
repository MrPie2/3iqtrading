@extends('layouts.dashboard')
@section('title','Investment Plans')
@section('content')
<div class="dashboard-heading">
 <div><div class="eyebrow"><span class="live-pulse"></span>Invest</div><h1>Investment plans</h1><p>Review configured investment options, terms and illustrative rates.</p></div>
</div>
<div class="row g-3">
@forelse($plans as $plan)<div class="col-md-6 col-xl-4"><div class="plan-card h-100"><div class="plan-top"><span class="plan-badge"><i class="bi bi-lightning-charge-fill"></i> Plan</span><span class="text-muted small">{{ $plan->Duration }} days</span></div><h2>{{ $plan->Plan_Name }}</h2><div class="plan-rate">{{ $plan->Percentage }}<small>%</small></div><div class="text-muted small">Illustrative rate</div><div class="plan-range"><div><span>Minimum</span><strong>{{ auth('investor')->user()->curAbbr }}{{ number_format((float)$plan->Minimum*(float)auth('investor')->user()->exchangerate,2) }}</strong></div><div><span>Maximum</span><strong>{{ auth('investor')->user()->curAbbr }}{{ number_format((float)$plan->Maximum*(float)auth('investor')->user()->exchangerate,2) }}</strong></div></div><p class="text-muted small plan-description">{!! \Illuminate\Support\Str::limit(strip_tags($plan->Description),180) !!}</p><a class="btn dashboard-primary-btn w-100 mt-auto" href="{{ route('investments.create',$plan) }}">View plan <i class="bi bi-arrow-right ms-2"></i></a></div></div>
@empty<div class="col-12"><div class="dashboard-panel empty-state"><i class="bi bi-layers"></i><strong>No investment plans available</strong><span>Configured plans will appear here.</span></div></div>@endforelse
</div>
<p class="small text-muted mt-3"><i class="bi bi-info-circle me-1"></i>Rates and returns shown by this application are configuration values from the supplied database; they are not guarantees of future performance.</p>
@endsection