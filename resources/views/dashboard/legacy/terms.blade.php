@extends('layouts.app')
@section('title','Terms & Conditions')
@section('heading','Terms & Conditions')
@section('content')
<div class="card table-card"><div class="card-body">
@if($page){!! $page->Page_Contents !!}@else<p class="text-muted">Terms and conditions have not been configured in the database.</p>@endif
</div></div>
@endsection
