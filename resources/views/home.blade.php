@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    You are logged in!
                </div>
            </div>
        </div>
    </div>
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
            
        </div>
    </div>
</div>
@endsection
