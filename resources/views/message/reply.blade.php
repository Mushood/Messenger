@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">

    </div>
    <div class="row">
        <div class="col-lg-3">
            @include('layouts.sidebar')
        </div>
        <div class="col-lg-9">
            <h1>Reply to Message</h1>
            @include('layouts.errors')
            <div class="container">
                {!! Form::open(['url' => '/replymessage']) !!}
                <div class="form-group">
                {!! Form::label('to', 'To'); !!}
                {!! Form::text('to'); !!}
                </div>
                <div class="form-group">
                {!! Form::label('body', 'Body'); !!}
                {!! Form::textarea('body'); !!}
                </div>
                <input type="hidden" name="threadID" value="{{$threadID}}">
                {!! Form::submit('Send Message'); !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection
