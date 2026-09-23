@extends('layouts.dashboard')
@section('title','Deposit History')
@section('content')
<div class="dashboard-heading">
  <div><div class="eyebrow"><span class="live-pulse"></span>Cash flow</div><h1>Deposit history</h1><p>Review every deposit credited to your trading account.</p></div>
  <a href="{{ route('deposit') }}" class="btn dashboard-primary-btn"><i class="bi bi-plus-lg me-2"></i>Make a deposit</a>
</div>
<div class="dashboard-panel">
  <div class="panel-heading"><div><div class="section-kicker">Transaction ledger</div><h2>All deposits</h2></div><span class="trade-status positive">{{ $deposits->total() }} records</span></div>
  <div class="table-responsive mt-3"><table class="table trading-table align-middle mb-0"><thead><tr><th>Transaction</th><th>Amount</th><th>Date</th><th>Status</th></tr></thead><tbody>
  @forelse($deposits as $item)
    <tr><td><div class="asset-cell"><span class="asset-icon positive"><i class="bi bi-arrow-down-left"></i></span><div><strong>Deposit</strong><small>Account transaction</small></div></div></td><td class="fw-semibold">{{ $investor->curAbbr ?? '$' }}{{ number_format((float)$item->Amount_Deposited*(float)($investor->exchangerate ?? 1),2) }}</td><td>{{ $item->Date ?? '—' }}</td><td><span class="trade-status positive">Recorded</span></td></tr>
  @empty
    <tr><td colspan="4"><div class="empty-state"><i class="bi bi-receipt"></i><strong>No deposits yet</strong><span>Your deposits will appear here when available.</span></div></td></tr>
  @endforelse
  </tbody></table></div>
  <div class="mt-3">{{ $deposits->links() }}</div>
</div>
@endsection