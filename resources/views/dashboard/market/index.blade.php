@extends('layouts.dashboard')
@section('title','Markets')
@section('content')
<div class="dashboard-heading">
  <div><div class="eyebrow"><span class="live-pulse"></span>Markets</div><h1>Market overview</h1><p>Explore available assets, current unit values and market trends.</p></div>
</div>
<div class="row g-3">
@forelse($stocks as $stock)
<div class="col-sm-6 col-xl-4"><div class="market-watch-card h-100">
  <div class="d-flex align-items-center gap-3">
    <div class="asset-icon market-logo"><img src="{{ $stock->Logo }}" alt="" onerror="this.style.display='none'"><i class="bi bi-bar-chart-fill"></i></div>
    <div class="min-w-0"><h2 class="text-truncate">{{ $stock->CompanyName }}</h2><span class="text-muted small">{{ $stock->tradingview }}</span></div>
  </div>
  <div class="market-price-grid mt-4"><div><span class="price-label">Unit value</span><strong>{{ $stock->Unit }}</strong></div><div class="text-end"><span class="price-label">Trend</span><strong class="{{ $stock->Trend>=0?'text-primary':'text-danger' }}">{{ $stock->Trend>=0?'+':'' }}{{ $stock->Trend }}</strong></div></div>
  <div class="market-mini-bar mt-3"><span style="width:{{ min(100,max(8,50 + ((float)$stock->Trend*3))) }}%"></span></div>
  <a href="{{ route('market.stock',$stock) }}" class="btn btn-outline-secondary w-100 mt-4"><i class="bi bi-arrow-up-right me-2"></i>View market</a>
</div></div>
@empty<div class="col-12"><div class="dashboard-panel empty-state"><i class="bi bi-bar-chart"></i><strong>No market assets available</strong><span>Configured assets will appear here.</span></div></div>@endforelse
</div>
@endsection