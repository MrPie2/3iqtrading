@extends('layouts.dashboard')
@section('title','Investment Plans')
@section('heading','Investment Plans')
@section('content')
<div class="row">
@foreach($plans as $plan)<div class="col-md-6 col-xl-4 mb-4"><div class="card table-card h-100"><div class="card-body d-flex flex-column">
<div class="text-muted small">{{ $plan->Duration }} day term</div><h4 class="mt-2">{{ $plan->Plan_Name }}</h4><div class="h3">{{ auth('investor')->user()->curAbbr }}{{ number_format((float)$plan->Minimum*(float)auth('investor')->user()->exchangerate,2) }}</div><div class="text-success mb-3">{{ $plan->Percentage }}% illustrative rate</div><div class="text-muted flex-grow-1">{!! \Illuminate\Support\Str::limit(strip_tags($plan->Description),220) !!}</div><a class="btn btn-brand mt-4" href="{{ route('investments.create',$plan) }}">View plan</a></div></div></div>@endforeach
</div>
<p class="small text-muted">Rates and returns shown by this application are configuration values from the supplied database; they are not guarantees of future performance.</p>
@endsection