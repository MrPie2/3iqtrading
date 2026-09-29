<div class="row g-4">
@forelse($plans as $plan)
<div class="col-md-6 col-lg-4"><div class="plan-card {{ $plan->featured ? 'featured' : '' }}">
@if($plan->featured)<span class="plan-badge">Popular</span>@endif
<div class="icon-box"><i class="bi bi-pie-chart"></i></div><h4 class="fw-bold">{{ $plan->name }}</h4><p class="text-secondary">{{ $plan->description }}</p>
<div class="price mt-4">${{ number_format($plan->minimum_amount, 0) }}<span class="fs-6 text-secondary fw-normal"> minimum</span></div><div class="small text-secondary mt-1">{{ $plan->term_label }} · {{ $plan->risk_level }} risk</div>
<ul class="plan-list">@foreach(($plan->features ?? []) as $feature)<li><i class="bi bi-check-circle-fill"></i>{{ $feature }}</li>@endforeach</ul>
@auth('investor')<a href="{{ route('investments.create', $plan) }}" class="btn {{ $plan->featured ? 'btn-primary' : 'btn-outline-primary' }} rounded-pill w-100">Select plan</a>@else<a href="{{ route('register') }}" class="btn {{ $plan->featured ? 'btn-primary' : 'btn-outline-primary' }} rounded-pill w-100">Select plan</a>@endauth
</div></div>
@empty
<div class="col-12"><div class="dashboard-panel empty-state"><strong>No investment plans available</strong></div></div>
@endforelse
</div>