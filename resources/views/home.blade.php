@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
 
    </div>
    <div class="row">
        
    </div>
    <div class="row">
        <div class="col-lg-3">
            @include('layouts.sidebar')
        </div>
        <div class="col-lg-9">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
