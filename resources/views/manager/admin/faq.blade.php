@extends('manager.layouts.admin')

@section('content')
<div class="container">
    <div class="mb-3">
<label>Question</label>
<input type="text" class="form-control question"/>
    </div>
    <div class="mb-3">
<label>Answer</label>
<textarea class="form-control answer"></textarea>
    </div>
    <div class="mb-3">
<button class="btn btn-primary btn-block AddFaq">Add Faq</button>
    </div>
    
    <div class="">
            <div class="card panel"><div class="panel-head">
    <h1>Freqently asked questions</h1>
    </div>
    @foreach($faqs as $faq)

    <div class="card mb-3"><div class="card-body">
        <h5>{{$faq->question}}</h5>
        <p>{{$faq->answer}}</p>
        <button class="btn btn-danger DeleteFaq" id="{{$faq->id}}">Delete</button>
    </div></div>
    @endforeach
    </div>
@endsection('content')