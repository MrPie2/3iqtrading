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
<div class="card stat"><div class="stat-top"><span>{{ $s[0] }}</span><i class="bi bi-{{ $s[2] }}"></i></div><strong>{{ number_format($stats[$s[1]]) }}</strong><small>Records in database</small></div>
@endforeach
</div>
<div class="card panel"><div class="panel-head"><h2>Management modules</h2><span class="badge">{{ count(config('admin_pages.pages')) }} migrated files</span></div>
<div class="module-grid">
@foreach(config('admin_pages.pages') as $key => $item)
<a class="module" href="{{ route('admin.module.'.$key) }}"><div class="icon"><i class="bi bi-layers"></i></div><b>{{ $item['title'] }}</b><span>{{ $item['kind']==='page' ? 'Admin page' : 'Controller endpoint' }} · {{ $item['legacy'] }}</span></a>
@endforeach
</div></div>
@endsection