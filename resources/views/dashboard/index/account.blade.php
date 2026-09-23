@extends('layouts.dashboard')
@section('title','Account')
@section('content')
<div class="dashboard-heading">
  <div><div class="eyebrow"><span class="live-pulse"></span>Account</div><h1>Account overview</h1><p>Review your investor identity, account classification and verification status.</p></div>
  <a href="{{ route('profile') }}" class="btn dashboard-primary-btn"><i class="bi bi-person-gear me-2"></i>Manage profile</a>
</div>
<div class="row g-3">
  <div class="col-md-4"><div class="stat-card h-100"><div class="stat-icon"><i class="bi bi-person-badge"></i></div><div class="stat-label">Account type</div><div class="stat-value">{{ $investor->Account_Type ?: 'Investor' }}</div><div class="stat-foot"><span class="status-dot"></span>Active account profile</div></div></div>
  <div class="col-md-4"><div class="stat-card h-100"><div class="stat-icon"><i class="bi bi-fingerprint"></i></div><div class="stat-label">Investor ID</div><div class="stat-value">{{ $investor->Investor_id }}</div><div class="stat-foot"><i class="bi bi-shield-check"></i>Unique account identifier</div></div></div>
  <div class="col-md-4"><div class="stat-card h-100"><div class="stat-icon"><i class="bi bi-patch-check"></i></div><div class="stat-label">Verification</div><div class="stat-value">{{ $investor->V_Status ? 'Verified' : 'Pending' }}</div><div class="stat-foot"><span class="status-dot"></span>{{ $investor->V_Status ? 'Identity verified' : 'Verification required' }}</div></div></div>
</div>
<div class="row g-3 mt-1">
  <div class="col-lg-8"><div class="dashboard-panel h-100"><div class="panel-heading"><div><div class="section-kicker">Account security</div><h2>Keep your account protected</h2></div><i class="bi bi-shield-lock fs-4 text-primary"></i></div><div class="security-list mt-3">
    <div class="security-row"><span class="security-icon"><i class="bi bi-envelope-check"></i></span><div><strong>Email account</strong><small>{{ $investor->Email }}</small></div><span class="trade-status positive">Configured</span></div>
    <div class="security-row"><span class="security-icon"><i class="bi bi-phone"></i></span><div><strong>Phone number</strong><small>{{ $investor->Phone ?: 'Not provided' }}</small></div><span class="trade-status {{ $investor->Phone ? 'positive' : 'pending' }}">{{ $investor->Phone ? 'Configured' : 'Pending' }}</span></div>
    <div class="security-row"><span class="security-icon"><i class="bi bi-shield-check"></i></span><div><strong>Identity verification</strong><small>Verification documents are managed from your verification workspace.</small></div><a href="{{ route('verification') }}" class="panel-link">Review</a></div>
  </div></div></div>
  <div class="col-lg-4"><div class="dashboard-panel h-100"><div class="section-kicker">Quick links</div><div class="quick-action-grid">
    <a href="{{ route('wallet') }}"><span><i class="bi bi-wallet2"></i></span><strong>Wallet</strong><small>Funding & withdrawals</small></a>
    <a href="{{ route('notifications') }}"><span><i class="bi bi-bell"></i></span><strong>Alerts</strong><small>Account notifications</small></a>
    <a href="{{ route('profile') }}"><span><i class="bi bi-person"></i></span><strong>Profile</strong><small>Personal details</small></a>
    <a href="{{ route('support') }}"><span><i class="bi bi-headset"></i></span><strong>Support</strong><small>Get assistance</small></a>
  </div></div></div>
</div>
@endsection