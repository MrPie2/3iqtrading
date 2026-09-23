@extends('layouts.dashboard')
@section('title','My Investments')
@section('heading','My Investments')
@section('content')
<div class="card table-card"><div class="card-body"><div class="table-responsive"><table class="table"><thead><tr><th>Contract</th><th>Plan</th><th>Amount</th><th>ROI</th><th>Remaining</th><th>Status</th></tr></thead><tbody>@forelse($contracts as $c)<tr><td>{{ $c->Contract_id }}</td><td>{{ $c->Plan_Type }}</td><td>{{ auth('investor')->user()->curAbbr }}{{ number_format((float)$c->Amount*(float)auth('investor')->user()->exchangerate,2) }}</td><td>{{ auth('investor')->user()->curAbbr }}{{ number_format((float)$c->ROI*(float)auth('investor')->user()->exchangerate,2) }}</td><td>{{ $c->Remaining }}</td><td>{{ $c->Status==1?'Active':($c->Status==2?'Completed':'Pending') }}</td></tr>@empty<tr><td colspan="6">No investments yet.</td></tr>@endforelse</tbody></table></div></div></div>
@endsection