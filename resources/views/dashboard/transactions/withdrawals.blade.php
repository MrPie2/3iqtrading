@extends('layouts.dashboard')
@section('title','Withdrawal History')
@section('content')
<div class="dashboard-heading">
  <div><div class="eyebrow"><span class="live-pulse"></span>Cash flow</div><h1>Withdrawal history</h1><p>Review every withdrawal request made from your trading account.</p></div>
  <a href="{{ route('withdraw') }}" class="btn dashboard-primary-btn"><i class="bi bi-arrow-up-right me-2"></i>Request withdrawal</a>
</div>
<div class="dashboard-panel">
  <div class="panel-heading"><div><div class="section-kicker">Transaction ledger</div><h2>All withdrawals</h2></div><span class="trade-status positive">{{ $withdrawals->total() }} records</span></div>
  <div class="table-responsive mt-3"><table class="table trading-table align-middle mb-0"><thead><tr><th>Transaction</th><th>Amount</th><th>Date</th><th>Status</th></tr></thead><tbody>
  @forelse($withdrawals as $item)
    <tr><td><div class="asset-cell"><span class="asset-icon negative"><i class="bi bi-arrow-up-right"></i></span><div><strong>Withdrawal</strong><small>Account transaction</small></div></div></td><td class="fw-semibold">{{ $investor->curAbbr ?? '$' }}{{ number_format((float)$item->Amount_Withdrawn*(float)($investor->exchangerate ?? 1),2) }}</td><td>{{ $item->Date ?? '—' }}</td><td><span class="trade-status positive">Recorded</span></td></tr>
  @empty
    <tr><td colspan="4"><div class="empty-state"><i class="bi bi-receipt"></i><strong>No withdrawals yet</strong><span>Your withdrawals will appear here when available.</span></div></td></tr>
  @endforelse
  </tbody></table></div>
  <div class="mt-3">{{ $withdrawals->links() }}</div>
</div>
@endsection