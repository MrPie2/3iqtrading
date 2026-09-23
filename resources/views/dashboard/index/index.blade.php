@extends('layouts.app')
@section('title','Dashboard')
@section('heading','Dashboard')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4"><div><h3 class="mb-1">Good to see you, {{ $investor->First_Name }}</h3><div class="text-muted">Account {{ $investor->Investor_id }}</div></div><a href="{{ route('investments.plans') }}" class="btn btn-brand">Start an investment</a></div>
<div class="row">
@foreach([['Available Balance',$stats['balance'],$investor->curAbbr],['Portfolio Value',$stats['portfolio'],$investor->curAbbr],['Active Investments',$stats['active_investments'],'positions'],['Referral Earnings',$stats['referral_earnings'],$investor->curAbbr]] as $m)
<div class="col-md-6 col-xl-3 mb-4"><div class="card metric"><div class="card-body"><div class="text-muted small">{{ $m[0] }}</div><div class="value mt-2">{{ $m[2]==='positions' ? number_format($m[1]) : $m[2].number_format($m[1],2) }}</div></div></div></div>
@endforeach
</div>
<div class="row">
<div class="col-xl-8 mb-4"><div class="card table-card"><div class="card-body"><div class="d-flex justify-content-between"><h5>Investment activity</h5><a href="{{ route('investments.contracts') }}">View all</a></div>
<div class="table-responsive">
    <table class="table table-hover">
        <thead><tr><th>Plan</th><th>Amount</th><th>Start</th><th>Status</th></tr></thead>
        <tbody>
@forelse($contracts as $c)<tr><td>{{ $c->Plan_Type }}</td>
<td>{{ $investor->curAbbr }}{{ number_format((float)$c->Amount*(float)$investor->exchangerate,2) }}</td><td>{{ $c->Contract_Start?->format('M d, Y') }}</td><td><span class="badge badge-soft">{{ $c->Status==1?'Active':($c->Status==2?'Completed':'Pending') }}</span></td></tr>@empty<tr><td colspan="4" class="text-muted">No investments yet.</td></tr>@endforelse
</tbody>
</table></div></div></div></div>
<div class="col-xl-4 mb-4"><div class="card table-card">
    <div class="card-body"><h5>Notifications</h5>@forelse($notifications as $n)<a href="{{ route('notifications') }}" class="d-block py-2 border-bottom text-dark"><strong>{{ $n->Subject }}</strong>
    <div class="small text-muted">{{ Str::limit($n->Text,70) }}</div></a>@empty<p class="text-muted">You're all caught up.</p>@endforelse</div>
</div></div>
</div>
<div class="row"><div class="col-md-6 mb-4"><div class="card table-card"><div class="card-body">
    <h5>Recent deposits</h5>@forelse($deposits as $d)<div class="d-flex justify-content-between py-2 border-bottom"><span>{{ $d->Date }}</span>
    <strong>{{ $investor->curAbbr }}{{ number_format((float)$d->Amount_Deposited*(float)$investor->exchangerate,2) }}</strong>
</div>@empty<p class="text-muted">No deposits found.</p>@endforelse</div></div></div>
<div class="col-md-6 mb-4"><div class="card table-card"><div class="card-body">
    <h5>Recent withdrawals</h5>@forelse($withdrawals as $w)<div class="d-flex justify-content-between py-2 border-bottom">
        <span>{{ $w->Date }}</span><strong>{{ $investor->curAbbr }}{{ number_format((float)$w->Amount_Withdrawn*(float)$investor->exchangerate,2) }}</strong>
    </div>@empty<p class="text-muted">No withdrawals found.</p>@endforelse</div></div></div></div>
@endsection
