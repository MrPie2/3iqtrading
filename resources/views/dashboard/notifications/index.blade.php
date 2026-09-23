@extends('layouts.dashboard')
@section('title','Notifications')
@section('content')
<div class="dashboard-heading">
  <div><div class="eyebrow"><span class="live-pulse"></span>Inbox</div><h1>Notifications</h1><p>Stay up to date with account alerts, transactions and important updates.</p></div>
</div>
<div class="dashboard-panel">
  <div class="panel-heading"><div><div class="section-kicker">Account inbox</div><h2>All notifications</h2></div><span class="trade-status positive">{{ $notifications->total() }} total</span></div>
  <div class="notification-list mt-3">
  @forelse($notifications as $n)
    <div class="notification-item {{ !$n->seen ? 'notification-unread' : '' }}">
      <span class="notification-icon"><i class="bi bi-bell-fill"></i></span>
      <span><strong>{{ $n->Subject }}</strong><small>{{ $n->Text }}</small><small>{{ $n->Date }}</small></span>
      @if(!$n->seen)<button class="panel-link markSeen" type="button" data-id="{{ $n->id }}">Mark read</button>@else<span class="trade-status neutral">Read</span>@endif
    </div>
  @empty
    <div class="empty-state"><i class="bi bi-check2-circle"></i><strong>No notifications</strong><span>You're all caught up.</span></div>
  @endforelse
  </div>
  <div class="mt-3">{{ $notifications->links() }}</div>
</div>
@endsection
@push('head')
<style>
.notification-unread{background:rgba(40,100,255,.05);border-radius:12px}.notification-item{padding:13px 10px}.notification-item>span:nth-child(2){flex:1}.notification-item small{display:block;margin-top:3px}
</style>
@endpush
@push('scripts')
<script>
document.querySelectorAll('.markSeen').forEach(function(b){b.addEventListener('click',async function(){try{await api('{{ route('notifications.seen') }}',{method:'POST',headers:{'Content-Type':'application/json'},body:JSON.stringify({id:b.dataset.id})});b.closest('.notification-item').classList.remove('notification-unread');b.replaceWith(Object.assign(document.createElement('span'),{className:'trade-status neutral',textContent:'Read'}))}catch(e){alert(e.message)}})});
</script>
@endpush