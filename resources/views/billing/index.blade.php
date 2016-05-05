@extends('layouts.app')

@section('content')
    <div class="container">
        <div class='row'>
            <div class="col-md-8  col-md-offset-2 ">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>id</th>
                        <th>Billing Name</th>
                        <th>Details</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(count($billings))
                        @foreach($billings as $billing)
                            <tr>
                                <td>{{$billing->id}}</td>
                                <td>{{$billing->name}}</td>
                                <td><a href="/billing/{{$billing->id}}">See</a></td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td>Some billings goes here</td>
                        </tr>
                    @endif
                    </tbody>
                </table>
                <a href="/billing/new" class="btn btn-primary">New</a>
            </div>
        </div>
    </div>
    {{--<img src="/images/def_img.png" alt="">--}}
    {{--{{pp($billings)}}--}}
@endsection
