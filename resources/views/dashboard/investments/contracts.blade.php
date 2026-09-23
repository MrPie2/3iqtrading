@extends('layouts.dashboard')
@section('title','My Investments')
@section('content')
<div class="dashboard-heading">
 <div><div class="eyebrow"><span class="live-pulse"></span>Portfolio</div><h1>My investments</h1><p>Monitor your investment contracts, amounts, returns and current status.</p></div>
 <a href="{{ route('investments.plans') }}" class="btn dashboard-primary-btn"><i class="bi bi-plus-lg me-2"></i>New investment</a>
</div>
<div class="dashboard-panel"><div class="panel-heading"><div><div class="section-kicker">Positions</div><h2>Investment contracts</h2></div><span class="trade-status positive">{{ $contracts->count() }} shown</span></div>
<div class="table-responsive"><table class="table trading-table align-middle"><thead><tr><th>Contract</th><th>Plan</th><th>Amount</th><th>ROI</th><th>Remaining</th><th>Status</th></tr></thead><tbody>
@forelse($contracts as $c)<tr><td><div class="asset-cell"><span class="asset-icon"><i class="bi bi-file-earmark-bar-graph"></i></span><div><strong>{{ $c->Contract_id }}</strong><small>Investment contract</small></div></div></td><td>{{ $c->Plan_Type }}</td><td>{{ auth('investor')->user()->curAbbr }}{{ number_format((float)$c->Amount*(float)auth('investor')->user()->exchangerate,2) }}</td><td>{{ auth('investor')->user()->curAbbr }}{{ number_format((float)$c->ROI*(float)auth('investor')->user()->exchangerate,2) }}</td><td>{{ $c->Remaining }}</td><td><span class="trade-status {{ $c->Status==1?'positive':($c->Status==2?'neutral':'pending') }}">{{ $c->Status==1?'Active':($c->Status==2?'Completed':'Pending') }}</span></td></tr>
@empty<tr><td colspan="6" class="empty-state"><i class="bi bi-layers"></i><strong>No investments yet</strong><span>Your active and completed contracts will appear here.</span></td></tr>@endforelse
</tbody></table></div></div>
@endsection