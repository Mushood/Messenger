@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        
    </div>
    <div class="row">
        <div class="col-lg-3">
            <a href="/newmessage">
                <button class="btn btn-warning btn-block">New Message</button>
            </a>
            <a href="/inbox">
                <button class="btn btn-warning btn-block">Inbox</button>
            </a>
            <a href="/sent">
                <button class="btn btn-warning btn-block">Sent</button>
            </a>
            <a href="/deletedmessages">
                <button class="btn btn-warning btn-block">Delete</button>
            </a>
        </div>
        <div class="col-lg-9">
            <h1>New Message</h1>
            <div class="container">
                {!! Form::open(['url' => '/replymessage']) !!}

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
