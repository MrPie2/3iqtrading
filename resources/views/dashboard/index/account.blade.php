@extends('layouts.app')
@section('title','Account')
@section('heading','Account')
@section('content')
<div class="card table-card"><div class="card-body"><h4>Account overview</h4><div class="row mt-4">
<div class="col-md-4"><div class="text-muted">Account type</div><h5>{{ $investor->Account_Type }}</h5></div>
<div class="col-md-4"><div class="text-muted">Investor ID</div><h5>{{ $investor->Investor_id }}</h5></div>
<div class="col-md-4"><div class="text-muted">Verification</div><h5>{{ $investor->V_Status ? 'Verified':'Pending' }}</h5></div>
</div></div></div>
@endsection