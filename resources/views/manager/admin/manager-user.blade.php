@extends('manager.layouts.admin')
@section('content')
@php($title='Manage User')
@php($name=trim(($investor->First_Name ?? '').' '.($investor->Last_Name ?? '')) ?: 'Investor')
<style>
.user-hero{display:flex;align-items:center;justify-content:space-between;gap:18px;padding:22px;border-radius:18px;background:linear-gradient(135deg,#0f172a,#1e3a8a);color:#fff;margin-bottom:18px}
.user-avatar{width:58px;height:58px;border-radius:16px;background:#2563eb;display:grid;place-items:center;font-size:22px;font-weight:800}
.user-actions{display:grid;grid-template-columns:repeat(4,minmax(0,1fr));gap:10px}
.admin-action{border:1px solid var(--line);background:#fff;border-radius:14px;padding:15px}
.admin-action h3{font-size:13px;font-weight:800;margin:0 0 10px}.admin-action p{font-size:11px;color:var(--muted);min-height:32px}
.admin-action form{margin:0}.admin-action .form-control,.admin-action .form-select{font-size:12px}.admin-action .btn{width:100%}
.user-grid{display:grid;grid-template-columns:repeat(3,minmax(0,1fr));gap:16px;margin-top:16px}
.user-panel{background:#fff;border:1px solid var(--line);border-radius:16px;padding:18px}
.user-panel h2{font-size:14px;margin:0 0 14px;font-weight:800}
.detail-grid{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:10px}.detail{padding:10px 12px;background:#f8fafc;border-radius:10px}.detail small{display:block;color:var(--muted);font-size:10px}.detail strong{display:block;font-size:12px;margin-top:3px;word-break:break-word}
.scroll-table{overflow:auto;max-height:320px}.user-table{width:100%;font-size:11px}.user-table th,.user-table td{padding:9px;border-bottom:1px solid var(--line);white-space:nowrap}
.status-pill{display:inline-flex;padding:5px 9px;border-radius:999px;font-size:10px;font-weight:700;background:#eff6ff;color:#1d4ed8}
@media(max-width:1100px){.user-actions{grid-template-columns:repeat(2,1fr)}.user-grid{grid-template-columns:repeat(2,1fr)}}
@media(max-width:767px){.user-hero{align-items:flex-start;flex-direction:column}.user-actions,.user-grid{grid-template-columns:1fr}.detail-grid{grid-template-columns:1fr}}
</style>

<div class="user-hero">
    <div class="d-flex align-items-center gap-3">
        <div class="user-avatar">{{ strtoupper(substr($name,0,1)) }}</div>
        <div>
            <div style="font-size:11px;opacity:.75">INVESTOR #{{ $investor->Investor_id }}</div>
            <h1 style="font-size:25px;font-weight:800;margin:3px 0">{{ $name }}</h1>
            <div style="font-size:12px;opacity:.82">{{ $investor->Email }}</div>
        </div>
    </div>
    <div class="text-end">
        <span class="status-pill">{{ $investor->LockStatus ? 'LOCKED' : 'ACTIVE' }}</span>
        <div class="mt-2" style="font-size:12px">Verification: {{ $investor->V_Status ? 'Verified' : 'Pending' }}</div>
    </div>
</div>

@if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif
@if(session('error'))<div class="alert alert-danger">{{ session('error') }}</div>@endif

<div class="user-actions">
    <div class="admin-action"><h3><i class="bi bi-lock me-1"></i> Account access</h3><p>Lock or unlock login access.</p>
        <form method="POST" action="{{ route('admin.user.action',$investor->id) }}"><input type="hidden" name="action" value="{{ $investor->LockStatus ? 'unlock':'lock' }}">@csrf<button class="btn {{ $investor->LockStatus ? 'btn-primary':'btn-danger' }}">{{ $investor->LockStatus ? 'Unlock account':'Lock account' }}</button></form>
    </div>
    <div class="admin-action"><h3><i class="bi bi-patch-check me-1"></i> Verification</h3><p>Manually mark this investor as verified.</p>
        <form method="POST" action="{{ route('admin.user.action',$investor->id) }}">@csrf<input type="hidden" name="action" value="verify"><button class="btn btn-primary">Verify account</button></form>
    </div>
    <div class="admin-action"><h3><i class="bi bi-stars me-1"></i> Upgrade account</h3><p>Set the investor account level.</p>
        <form method="POST" action="{{ route('admin.user.action',$investor->id) }}">@csrf<input type="hidden" name="action" value="upgrade"><select name="level" class="form-select mb-2">@foreach($plans as $level)<option value="{{ $level }}" @selected((int)$investor->Level===$level)>Level {{ $level }}</option>@endforeach</select><button class="btn btn-primary">Update level</button></form>
    </div>
    <div class="admin-action"><h3><i class="bi bi-bank me-1"></i> Deposit</h3><p>Credit the available account balance.</p>
        <form method="POST" action="{{ route('admin.user.action',$investor->id) }}">@csrf<input type="hidden" name="action" value="deposit"><input name="amount" type="number" step="0.01" min="0.01" class="form-control mb-2" placeholder="Amount" required><button class="btn btn-primary">Credit deposit</button></form>
    </div>
    <div class="admin-action"><h3><i class="bi bi-graph-up-arrow me-1"></i> Load profit</h3><p>Add an amount to financial assets.</p>
        <form method="POST" action="{{ route('admin.user.action',$investor->id) }}">@csrf<input type="hidden" name="action" value="profit"><input name="amount" type="number" step="0.01" min="0.01" class="form-control mb-2" placeholder="Profit amount" required><button class="btn btn-primary">Load profit</button></form>
    </div>
    <div class="admin-action"><h3><i class="bi bi-dash-circle me-1"></i> Reduce balance</h3><p>Subtract from available account balance.</p>
        <form method="POST" action="{{ route('admin.user.action',$investor->id) }}">@csrf<input type="hidden" name="action" value="reduce_balance"><input name="amount" type="number" step="0.01" min="0.01" class="form-control mb-2" placeholder="Amount" required><button class="btn btn-danger">Reduce balance</button></form>
    </div>
    <div class="admin-action"><h3><i class="bi bi-activity me-1"></i> Update signal</h3><p>Set the current administrative signal.</p>
        <form method="POST" action="{{ route('admin.user.action',$investor->id) }}">@csrf<input type="hidden" name="action" value="signal"><select name="signal" class="form-select mb-2"><option value="normal">Normal</option><option value="watch">Watch</option><option value="restricted">Restricted</option><option value="priority">Priority</option></select><button class="btn btn-primary">Update signal</button></form>
    </div>
    <div class="admin-action"><h3><i class="bi bi-upc-scan me-1"></i> SWIFT code</h3><p>Generate and store an account SWIFT reference.</p>
        <form method="POST" action="{{ route('admin.user.action',$investor->id) }}">@csrf<input type="hidden" name="action" value="swift"><button class="btn btn-primary">Generate code</button></form>
    </div>
    <div class="admin-action"><h3><i class="bi bi-shield-x me-1"></i> Withdrawal access</h3><p>Control whether withdrawals can be initiated.</p>
        <form method="POST" action="{{ route('admin.user.action',$investor->id) }}">@csrf<input type="hidden" name="action" value="withdrawal_ban"><button class="btn btn-danger">Ban withdrawals</button></form>
        <form method="POST" action="{{ route('admin.user.action',$investor->id) }}" class="mt-2">@csrf<input type="hidden" name="action" value="withdrawal_unban"><button class="btn btn-primary">Remove withdrawal ban</button></form>
    </div>
    <div class="admin-action"><h3><i class="bi bi-bell me-1"></i> Send notification</h3>
        <form method="POST" action="{{ route('admin.user.action',$investor->id) }}">@csrf<input type="hidden" name="action" value="notification"><input name="subject" class="form-control mb-2" placeholder="Subject" required><textarea name="message" class="form-control mb-2" rows="3" placeholder="Notification text" required></textarea><button class="btn btn-primary">Send notification</button></form>
    </div>
    <div class="admin-action"><h3><i class="bi bi-envelope me-1"></i> Send mail</h3>
        <form method="POST" action="{{ route('admin.user.action',$investor->id) }}">@csrf<input type="hidden" name="action" value="mail"><input name="subject" class="form-control mb-2" placeholder="Subject" required><textarea name="message" class="form-control mb-2" rows="3" placeholder="Email message" required></textarea><button class="btn btn-primary">Send mail</button></form>
    </div>
</div>

<div class="user-grid">
    <div class="user-panel"><h2>Account details</h2><div class="detail-grid">
        <div class="detail"><small>Available balance</small><strong>{{ $investor->curAbbr ?? '$' }}{{ number_format((float)$investor->Total_Deposit,2) }}</strong></div>
        <div class="detail"><small>Financial assets</small><strong>{{ $investor->curAbbr ?? '$' }}{{ number_format((float)$investor->Fin_Asset,2) }}</strong></div>
        <div class="detail"><small>Level</small><strong>{{ $investor->Level }}</strong></div>
        <div class="detail"><small>Status</small><strong>{{ $investor->Status ? 'Active':'Inactive' }}</strong></div>
        <div class="detail"><small>Phone</small><strong>{{ $investor->Phone ?: '—' }}</strong></div>
        <div class="detail"><small>Nationality</small><strong>{{ $investor->Nationality ?: '—' }}</strong></div>
    </div></div>

    @foreach([['Investment history',$contracts,'Contract'],['Stock history',$stockContracts,'Stock'],['Notifications',$notifications,'Notification']] as [$heading,$rows,$type])
    <div class="user-panel"><h2>{{ $heading }}</h2><div class="scroll-table"><table class="user-table"><thead><tr><th>ID</th><th>Amount/Info</th><th>Date</th><th>Status</th></tr></thead><tbody>@forelse($rows as $row)<tr><td>{{ $row->id }}</td><td>{{ $row->Amount ?? $row->Subject ?? '—' }}</td><td>{{ $row->Contract_Start ?? $row->Date ?? '—' }}</td><td>{{ isset($row->Status) ? ($row->Status ? 'Active':'Pending') : '—' }}</td></tr>@empty<tr><td colspan="4">No records.</td></tr>@endforelse</tbody></table></div></div>
    @endforeach

    <div class="user-panel"><h2>Uploaded documents</h2><div class="scroll-table"><table class="user-table"><thead><tr><th>Type</th><th>Document</th><th>Status</th></tr></thead><tbody>@forelse($documents as $doc)<tr><td>{{ class_basename($doc) }}</td><td>{{ $doc->DocToVerify ?? $doc->path ?? $doc->Document ?? 'Uploaded document' }}</td><td>{{ isset($doc->Status) ? ($doc->Status ? 'Approved':'Pending') : 'Uploaded' }}</td></tr>@empty<tr><td colspan="3">No documents uploaded.</td></tr>@endforelse</tbody></table></div></div>

    <div class="user-panel"><h2>Withdrawal details</h2><div class="scroll-table"><table class="user-table"><thead><tr><th>Bank/Account</th><th>Value</th></tr></thead><tbody>@forelse($bankDetails as $bank)<tr><td>{{ $bank->BankName ?? $bank->bankname ?? 'Bank' }}</td><td>{{ $bank->AccountNumber ?? $bank->accountnumber ?? $bank->Account_Name ?? '—' }}</td></tr>@empty<tr><td colspan="2">No withdrawal bank details.</td></tr>@endforelse</tbody></table></div></div>

    <div class="user-panel"><h2>Debit cards</h2><div class="scroll-table"><table class="user-table"><thead><tr><th>Card</th><th>Amount</th><th>Status</th></tr></thead><tbody>@forelse($cards as $card)<tr><td>{{ $card->CardNumber ?? $card->card_number ?? 'Card record' }}</td><td>{{ $card->Amount ?? '—' }}</td><td>{{ $card->Status ?? '—' }}</td></tr>@empty<tr><td colspan="3">No debit cards.</td></tr>@endforelse</tbody></table></div></div>

    <div class="user-panel"><h2>Deposit history</h2><div class="scroll-table"><table class="user-table"><thead><tr><th>ID</th><th>Amount</th><th>Date</th><th>Status</th></tr></thead><tbody>@forelse($deposits as $row)<tr><td>{{ $row->id }}</td><td>{{ $row->Amount_Deposited ?? '—' }}</td><td>{{ $row->Date ?? '—' }}</td><td>{{ isset($row->Status) ? ($row->Status ? 'Completed':'Pending') : '—' }}</td></tr>@empty<tr><td colspan="4">No deposits.</td></tr>@endforelse</tbody></table></div></div>

    <div class="user-panel"><h2>Withdrawal history</h2><div class="scroll-table"><table class="user-table"><thead><tr><th>ID</th><th>Amount</th><th>Date</th><th>Status</th></tr></thead><tbody>@forelse($withdrawals as $row)<tr><td>{{ $row->id }}</td><td>{{ $row->Amount_Withdrawn ?? '—' }}</td><td>{{ $row->Date ?? '—' }}</td><td>{{ isset($row->Status) ? ($row->Status ? 'Completed':'Pending') : '—' }}</td></tr>@empty<tr><td colspan="4">No withdrawals.</td></tr>@endforelse</tbody></table></div></div>
</div>

<div class="admin-action mt-3"><h3 class="text-danger">Delete account</h3><p>This permanently removes the investor and associated records that can be safely identified by Investor_id.</p>
<form method="POST" action="{{ route('admin.user.action',$investor->id) }}" onsubmit="return confirm('Permanently delete this investor account and its associated records? This cannot be undone.')">@csrf<input type="hidden" name="action" value="delete"><button class="btn btn-danger">Delete account permanently</button></form>
</div>
@endsection
