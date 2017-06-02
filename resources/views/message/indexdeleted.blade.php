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
            <h1>Deleted Messages</h1>
            @if(isset($threads))
                @foreach($threads as $key => $thread)
                  @if($thread->isOwnerDeleted($thread->id))
                    <div class="row">
                        <h3>{{$thread -> subject}}</h3>
                        @foreach($thread -> messages() as $key => $message)
                            <h4>Written by: {{$message->user()->name}}</h4>
                            <p>{{$message -> body}}</p>
                        @endforeach
                        
                            {!! Form::open(['url' => '/restoremessage']) !!}

                            <div class="form-group">
                              <input type="hidden" name="thread" value="{{$thread -> id}}" />
                            </div>

                            {!! Form::submit('Restore'); !!}
                            {!! Form::close() !!}
                        <hr />  
                    </div>
                  @endif
                @endforeach
            @else
                <h2>No message in inbox</h2>
            @endif
        </div>
    </div>
</div>
@endsection
