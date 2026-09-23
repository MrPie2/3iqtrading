@extends('layouts.dashboard')
@section('title','Referrals')
@section('content')
<div class="dashboard-heading">
  <div><div class="eyebrow"><span class="live-pulse"></span>Growth</div><h1>Referral center</h1><p>Track referral activity and move available referral earnings into your portfolio.</p></div>
  <button class="btn dashboard-primary-btn" id="transferReferral"><i class="bi bi-arrow-down-left-circle me-2"></i>Move available earnings</button>
</div>
@php($available = $referrals->where('Status',1)->sum('Refferal_Earnings'))
<div class="row g-3 mb-3">
  <div class="col-sm-6 col-xl-3"><div class="stat-card"><div class="stat-icon"><i class="bi bi-people"></i></div><div class="stat-label">Total referrals</div><div class="stat-value">{{ $referrals->count() }}</div><div class="stat-foot">Registered referrals</div></div></div>
  <div class="col-sm-6 col-xl-3"><div class="stat-card"><div class="stat-icon"><i class="bi bi-cash-stack"></i></div><div class="stat-label">Available earnings</div><div class="stat-value">{{ $investor->curAbbr }}{{ number_format($available*(float)$investor->exchangerate,2) }}</div><div class="stat-foot"><span class="status-dot"></span>Ready to transfer</div></div></div>
  <div class="col-sm-6 col-xl-3"><div class="stat-card"><div class="stat-icon"><i class="bi bi-graph-up"></i></div><div class="stat-label">Program</div><div class="stat-value">Active</div><div class="stat-foot">Referral earnings enabled</div></div></div>
  <div class="col-sm-6 col-xl-3"><div class="stat-card"><div class="stat-icon"><i class="bi bi-link-45deg"></i></div><div class="stat-label">Your investor ID</div><div class="stat-value">{{ $investor->Investor_id }}</div><div class="stat-foot">Share with your network</div></div></div>
</div>
<div class="dashboard-panel">
  <div class="panel-heading"><div><div class="section-kicker">Referral activity</div><h2>Your referrals</h2></div><span class="trade-status positive">{{ $referrals->count() }} records</span></div>
  <div class="table-responsive"><table class="table trading-table align-middle"><thead><tr><th>Referral</th><th>Earnings</th><th>Status</th></tr></thead><tbody>
  @forelse($referrals as $r)<tr><td><div class="asset-cell"><span class="asset-icon"><i class="bi bi-person"></i></span><div><strong>{{ $r->Name }}</strong><small>Referral participant</small></div></div></td><td>{{ $investor->curAbbr }}{{ number_format($r->Refferal_Earnings*(float)$investor->exchangerate,2) }}</td><td><span class="trade-status {{ $r->Status==1?'positive':($r->Status==2?'neutral':'pending') }}">{{ $r->Status==1?'Available':($r->Status==2?'Transferred':'Pending') }}</span></td></tr>
  @empty<tr><td colspan="3" class="empty-state"><i class="bi bi-people"></i><strong>No referrals yet</strong><span>Referral activity will appear here.</span></td></tr>@endforelse
  </tbody></table></div>
</div>
@endsection
@push('scripts')<script>
const referralButton=document.getElementById('transferReferral');
if(referralButton) referralButton.onclick=async()=>{try{const d=await api('{{ route('referrals.transfer') }}',{method:'POST',headers:{'Content-Type':'application/json'},body:JSON.stringify({amount:{{ $available }}})});alert(d.message);location.reload()}catch(e){alert(e.message)}};
</script>@endpush