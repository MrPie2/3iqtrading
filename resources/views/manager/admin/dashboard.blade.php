@extends('manager.layouts.admin')
@section('content')
@php($title='Dashboard')
<div class="heading"><div><h1>Good to see you, {{ session('Boss_Name','Admin') }}</h1>
<p>Here is a clean overview of your administration workspace.</p></div><span class="badge">LIVE ADMIN</span></div>
<div class="grid">
@foreach([
 ['Clients','clients','people'],
 ['Copy traders','traders','graph-up-arrow'],
 ['Investment plans','plans','layers'],
 ['Stocks','stocks','bar-chart'],
] as $s)
<div class="card stat"><div class="stat-top"><span>{{ $s[0] }}</span><i class="bi bi-{{ $s[2] }}"></i></div>
<strong>{{ number_format($stats[$s[1]]) }}</strong><small>Records in database</small></div>
@endforeach
</div>

<br>
<div class="row">
    <div class="col-lg-8 col-md-12">
        <div class="card panel"><div class="panel-head">
    <h2>Clients</h2><span class="badge"> Total Clients {{ count($clients) }}</span>
    </div>
<div class="table-responsive">
    <table class="table table-striped table-hover">
        <thead class="table-light"><th>S/No</th><th>Name</th><th>Email</th><th>Status</th><th>Action</th></thead>
        <tbody>
              @foreach($clients as $client)

            <tr><td>{{$loop->iteration}}</td><td>{{$client->First_Name}}</td><td>{{$client->Email}}</td><td>@if($client->LockStatus>0) <span class="badge badge-danger">Locked</span> @else <span class="badge text-bg-primary">Active</span> @endif</td><td><a class="btn btn-primary"href="/action/{{$client->id}}">Manage</a></td></tr>
              @endforeach

        </tbody>
    </table>
</div>

</div>

</div>


<div class="col-lg-4">
    
</div>
</div>


@endsection