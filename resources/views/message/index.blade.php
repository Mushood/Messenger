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
            <h1>Inbox</h1>
            @if(isset($threads))
                @foreach($threads as $key => $thread)
                    <div class="row">
                        <h3>{{$thread -> subject}}</h3>
                        @foreach($thread -> messages() as $key => $message)
                            <h4>Written by: {{$message->user()->name}}</h4>
                            <p>{{$message -> body}}</p>
                        @endforeach
                        <a href="/replymessage/{{$thread -> id}}">
                            <button class="btn btn-primary">Reply</button>
                        </a>
                        <hr />
                    </div>
                @endforeach
            @else
                <h2>No message in inbox</h2>
            @endif
        </div>
    </div>
</div>
@endsection
