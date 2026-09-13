@extends('layouts.app', ['title' => 'Services — 3IQ Trading'])
@section('content')
<section class="page-hero"><div class="container"><div class="eyebrow">3IQ Trading services</div><h1 class="mt-2">Tools and services for your investment journey.</h1><p class="mt-3 mb-0">A flexible public-facing service page designed to explain what your platform offers before the client dashboard is introduced.</p></div></section>
<section class="section"><div class="container"><div class="row g-4">
@foreach([
['bi-graph-up-arrow','Investment planning','Present goal-oriented investment options with transparent terms, risk labels and educational information.'],
['bi-bar-chart-line','Stocks','Give clients a clean way to discover stock-related information, market summaries and educational content.'],
['bi-pie-chart','Shares','Showcase share opportunities and portfolio concepts without overloading the visitor with complexity.'],
['bi-safe2','Retirement accounts','Explain IRA and 401(k) concepts, contribution considerations and long-term planning.'],
['bi-headset','Client support','Add a support workflow later for messages, tickets, notifications and account assistance.'],
['bi-shield-lock','Secure access','Laravel authentication provides a foundation for protected client areas and future dashboard features.']
] as $service)
<div class="col-md-6 col-lg-4"><div class="content-card"><div class="content-icon"><i class="bi {{ $service[0] }}"></i></div><h4 class="fw-bold">{{ $service[1] }}</h4><p class="mb-0">{{ $service[2] }}</p></div></div>
@endforeach
</div></div></section>
@endsection
