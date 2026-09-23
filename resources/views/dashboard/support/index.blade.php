@extends('layouts.dashboard')
@section('title','Support')
@section('heading','Help & Support')
@section('content')
<div class="row"><div class="col-md-6 mb-4"><div class="card table-card"><div class="card-body"><h5>Live support</h5><p class="text-muted">Open your support channel from the application.</p><a class="btn btn-brand" target="_blank" rel="noopener" href="https://tawk.to/chat/62da40e037898912e95f0df1/1g8i8qs35">Start a conversation</a></div></div></div><div class="col-md-6 mb-4"><div class="card table-card"><div class="card-body"><h5>WhatsApp support</h5><p class="text-muted">Configured support contact: {{ $whatsapp ?: 'Not configured' }}</p>@if($whatsapp)<a class="btn btn-brand" target="_blank" rel="noopener" href="https://wa.me/{{ preg_replace('/\D+/','',$whatsapp) }}">WhatsApp Support</a>@endif</div></div></div></div>
@endsection