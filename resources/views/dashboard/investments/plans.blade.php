@extends('layouts.dashboard')
@section('title','Investment Plans')
@section('content')
<div class="dashboard-heading"><div><div class="eyebrow"><span class="live-pulse"></span>Invest</div><h1>Investment plans</h1><p>Choose an investment plan and start it directly from your funded account.</p></div></div>
<div class="row g-4">
@forelse($plans as $plan)
<div class="col-md-6 col-xl-4"><div class="plan-card h-100 {{ $plan->featured ? 'featured' : '' }}">@if($plan->featured)<span class="plan-badge">Popular</span>@endif<div class="icon-box"><i class="bi bi-pie-chart"></i></div><h4 class="fw-bold">{{ $plan->name }}</h4><p class="text-secondary">{{ $plan->description }}</p><div class="price mt-4">${{ number_format($plan->minimum_amount,0) }}<span class="fs-6 text-secondary fw-normal"> minimum</span></div><div class="small text-secondary mt-1">{{ $plan->term_label }} · {{ $plan->risk_level }} risk</div><ul class="plan-list">@foreach(($plan->features ?? []) as $feature)<li><i class="bi bi-check-circle-fill"></i>{{ $feature }}</li>@endforeach</ul><a class="btn {{ $plan->featured ? 'btn-primary' : 'btn-outline-primary' }} w-100 mt-auto" href="{{ route('investments.create',$plan) }}">Start plan <i class="bi bi-arrow-right ms-2"></i></a></div></div>
@empty
<div class="col-12"><div class="dashboard-panel empty-state"><i class="bi bi-layers"></i><strong>No investment plans available</strong><span>Configured plans will appear here.</span></div></div>
@endforelse
</div>
@endsection