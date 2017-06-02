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
                        {!! Form::open(['url' => '/deletemessage']) !!}

                        <div class="form-group">
                          <input type="hidden" name="thread" value="{{$thread -> id}}" />
                        </div>

                        {!! Form::submit('Delete'); !!}
                        {!! Form::close() !!}
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
