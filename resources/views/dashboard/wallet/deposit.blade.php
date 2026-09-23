@extends('layouts.dashboard')
@section('title','Deposit')
@section('heading','Deposit')
@section('content')
<div class="card table-card"><div class="card-body"><h4>Deposit funds</h4><p class="text-muted">Use your configured funding instructions, then upload proof in Wallet for review.</p><a href="{{ route('wallet') }}" class="btn btn-brand">Open Wallet</a></div></div>
@endsection