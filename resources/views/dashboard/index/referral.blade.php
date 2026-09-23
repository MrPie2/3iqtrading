@extends('layouts.dashboard')
@section('title','Referrals')
@section('heading','Referrals')
@section('content')
<div class="card table-card"><div class="card-body"><div class="d-flex justify-content-between"><h5>Referral activity</h5><button class="btn btn-brand" id="transferReferral">Move available earnings to portfolio</button></div>
<div class="table-responsive mt-3"><table class="table"><thead><tr><th>Name</th><th>Earnings</th><th>Status</th></tr></thead><tbody>
@forelse($referrals as $r)<tr><td>{{ $r->Name }}</td><td>{{ $investor->curAbbr }}{{ number_format($r->Refferal_Earnings*(float)$investor->exchangerate,2) }}</td><td>{{ $r->Status==1?'Available':($r->Status==2?'Transferred':'Pending') }}</td></tr>@empty<tr><td colspan="3">No referrals yet.</td></tr>@endforelse
</tbody></table></div></div></div>
@endsection
@push('scripts')<script>document.getElementById('transferReferral').onclick=async()=>{try{const d=await api('{{ route('referrals.transfer') }}',{method:'POST',headers:{'Content-Type':'application/json'},body:JSON.stringify({amount:{{ $referrals->where('Status',1)->sum('Refferal_Earnings') }})});alert(d.message);location.reload()}catch(e){alert(e.message)}}</script>@endpush