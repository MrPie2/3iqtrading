@extends('manager.layouts.admin')
@section('content')
@php($title=$meta['title'])
<div class="heading">
  <div><h1>{{ $meta['title'] }}</h1><p>Laravel replacement for <strong>{{ $meta['legacy'] }}</strong>.</p></div>
  <div class="toolbar"><span class="badge">{{ strtoupper($meta['kind']) }}</span><a class="btn btn-light" href="{{ route('admin.dashboard') }}">Back</a></div>
</div>
<div class="legacy-note"><strong>Migration status:</strong> this module is routed through Laravel, uses the application session/CSRF layer, and reads its configured database source with the Query Builder. The original source is preserved in <code>storage/legacy-source/</code> for feature-by-feature reconciliation.</div>
@if($table)
<div class="card panel">
  <div class="panel-head"><h2>Live data · {{ $table }}</h2><span class="badge">{{ count($rows) }} shown</span></div>
  @if($rows)
  <div class="table-wrap"><table class="data"><thead><tr>@foreach($columns as $column)<th>{{ $column }}</th>@endforeach</tr></thead><tbody>
  @foreach($rows as $row)<tr>@foreach($columns as $column)<td title="{{ is_scalar($row[$column] ?? null) ? $row[$column] : '' }}">{{ is_scalar($row[$column] ?? null) ? \Illuminate\Support\Str::limit((string)$row[$column], 90) : '—' }}</td>@endforeach</tr>@endforeach
  </tbody></table></div>
  @else <div class="empty">No rows are available, or the table is not present in the configured database.</div>@endif
</div>
@endif
<div class="card panel"><div class="panel-head"><h2>Module endpoint</h2></div>
<form method="POST" action="{{ route('admin.operation.'.$key) }}">
@csrf
<div style="display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:14px">
<div><label style="font-size:12px;font-weight:600">Operation</label>
<input value="{{ $meta['legacy'] }}" readonly style="width:100%;margin-top:7px;padding:11px;border:1px solid var(--line);border-radius:10px;background:#f8fafc"></div>
<div><label style="font-size:12px;font-weight:600">Data source</label>
<input value="{{ $table ?: 'No direct table detected' }}" readonly style="width:100%;margin-top:7px;padding:11px;border:1px solid var(--line);border-radius:10px;background:#f8fafc"></div>
</div>
<button class="btn btn-primary" style="margin-top:16px" type="submit">Run Laravel endpoint</button>
</form></div>
@endsection