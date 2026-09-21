@extends('layouts.app')
@section('title','Notifications')
@section('heading','Notifications')
@section('content')
<div class="card table-card"><div class="card-body">@forelse($notifications as $n)<div class="border-bottom py-3 {{ !$n->seen?'font-weight-bold':'' }}"><div class="d-flex justify-content-between"><span>{{ $n->Subject }}</span><button class="btn btn-sm btn-link markSeen" data-id="{{ $n->id }}">Mark read</button></div><p class="mb-1 text-muted">{{ $n->Text }}</p><small>{{ $n->Date }}</small></div>@empty<p class="text-muted">No notifications.</p>@endforelse<div class="mt-3">{{ $notifications->links() }}</div></div></div>
@endsection
@push('scripts')<script>document.querySelectorAll('.markSeen').forEach(b=>b.onclick=async()=>{try{await api('{{ route('notifications.seen') }}',{method:'POST',headers:{'Content-Type':'application/json'},body:JSON.stringify({id:b.dataset.id})});b.closest('.border-bottom').classList.remove('font-weight-bold')}catch(e){alert(e.message)}})</script>@endpush