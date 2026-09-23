@extends('layouts.dashboard')
@section('title',$stock->CompanyName)
@section('content')
<div class="dashboard-heading">
  <div><div class="eyebrow"><span class="live-pulse"></span>Market</div><h1>{{ $stock->CompanyName }}</h1><p>{{ $stock->tradingview }} · Review the asset information before opening a position.</p></div>
  <a href="{{ route('market') }}" class="btn btn-outline-secondary"><i class="bi bi-arrow-left me-2"></i>All markets</a>
</div>
<div class="row g-3">
 <div class="col-lg-7"><div class="trading-card h-100">
  <div class="d-flex align-items-center gap-3"><div class="asset-icon market-logo large"><img src="{{ $stock->Logo }}" alt="" onerror="this.style.display='none'"><i class="bi bi-graph-up-arrow"></i></div><div><h2>{{ $stock->CompanyName }}</h2><span class="text-muted">{{ $stock->tradingview }}</span></div></div>
  <div class="market-detail-grid mt-4"><div><span class="price-label">Unit value</span><strong>{{ $stock->Unit }}</strong></div><div><span class="price-label">Spread</span><strong>{{ $stock->Spread }}</strong></div><div><span class="price-label">Trend</span><strong class="{{ $stock->Trend>=0?'text-primary':'text-danger' }}">{{ $stock->Trend>=0?'+':'' }}{{ $stock->Trend }}</strong></div></div>
  <div class="description-box mt-4">{!! $stock->description !!}</div>
 </div></div>
 <div class="col-lg-5"><div class="dashboard-panel h-100"><div class="section-kicker">Trade setup</div><h2>Open a position</h2><p class="text-muted small mt-2">Enter the amount, units and intended duration for this position.</p>
  <form id="stockForm" class="modern-form mt-4">@csrf<input type="hidden" name="company_name" value="{{ $stock->CompanyName }}"><input type="hidden" name="plan_type" value="Stock"><input type="hidden" name="buy_price" value="{{ $stock->Unit }}"><input type="hidden" name="buy_position" value="{{ $stock->Spread }}">
   <div class="form-group"><label>Amount</label><div class="input-shell"><i class="bi bi-cash"></i><input name="amount" type="number" step="0.01" class="form-control" required></div></div>
   <div class="row g-2"><div class="col-6 form-group"><label>Total units</label><input name="total_units" type="number" step="0.0001" class="form-control" required></div><div class="col-6 form-group"><label>Duration</label><input name="duration" type="number" min="1" value="365" class="form-control" required></div></div>
   <button class="btn dashboard-primary-btn w-100 mt-2"><i class="bi bi-lightning-charge-fill me-2"></i>Open position</button>
  </form><div id="msg" class="small mt-3"></div>
 </div></div>
</div>
@endsection
@push('scripts')<script>document.getElementById('stockForm').addEventListener('submit',async e=>{e.preventDefault();try{const d=await api('{{ route('market.invest') }}',{method:'POST',headers:{'Content-Type':'application/x-www-form-urlencoded'},body:new URLSearchParams(new FormData(e.target))});alert(d.message);location.href=d.redirect}catch(x){document.getElementById('msg').innerHTML='<span class="text-danger">'+x.message+'</span>'}})</script>@endpush