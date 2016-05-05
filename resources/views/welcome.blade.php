@extends('layouts.app')

@section('content')
<div class="container">
    @if(Session::has('msg'))
    <div class="alert alert-{{Session::get('msg-type')}}">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>{{Session::get('msg-header')}}</strong> {{Session::get('msg')}}
    </div>
    @endif

    <div class="row">
        <div class="col-md-3">
            <div class="chat_block">
                Future Chat block
            </div>
        </div>
        <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-heading">Welcome</div>

                <div class="panel-body">
                    Your Application's Landing Page.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
