@extends('layouts.app')

@section('content')
    <div class="container">
        <div class='row'>
            <div class='col-md-4'></div>
            <div class='col-md-4'>
                <form action="/billing/store" method="POST">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class='form-row'>

                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        {{--<div class='col-xs-12 form-group'>--}}
                            {{--<label class='control-label'>Amount</label>--}}
                            {{--<input class='form-control' name="amount" value="{{ isset($billing->amount)?$billing->amount :old('amount')}}" type='text'>--}}
                        {{--</div>--}}
                    </div>
                    <div class='form-row'>
                        <div class='col-xs-12 form-group'>
                            <label class='control-label'>Billing Name</label>
                            <input class='form-control' name="name" value="{{ isset($billing->name)?$billing->name :old('name')}}" type='text'>
                        </div>
                    </div>
                    <div class='form-row'>
                        <div class='col-xs-12 form-group'>
                            <label class='control-label'>By or Sell</label>
                            <select class='form-control' name="buy_sell" >
                                <option value="buy">Buy</option>
                                <option value="sell" {{(isset($billing->buy_sell) && $billing->buy_sell == 'sell' )}}>Sell</option>
                            </select>
                            {{--<input class='form-control' name="buy_sell" value="{{old('buy_sell')}}" type='text'>--}}
                        </div>
                    </div>
                    <div class='form-row'>
                        <div class='col-xs-12 form-group'>
                            <label class='control-label'>Item</label>
                            {{--<input class='form-control' name="item_id" value="{{old('item_id')}}" type='text'>--}}
                            @if(count($items))
                            <select class='form-control' name="item_id" >
                                @foreach($items as $item)
                                    <option value="{{$item->id}}" {{(isset($billing->item_id) && $billing->item_id == $item->id )? 'selected="selected"' : ''}}>{{$item->name}}</option>
                                @endforeach
                            </select>
                            @else
                            No items founded
                            @endif
                        </div>
                    </div>
                    <div class='form-row'>
                        <div class='col-xs-12 form-group'>
                            <label class='control-label'>Price</label>
                            <input class='form-control' name="price" value="{{old('price')}}" type='text'>
                        </div>
                    </div>
                    <div class='form-row'>
                        <div class='col-md-12 form-group'>
                            <button class='form-control btn btn-primary submit-button' type='submit'>Submit »</button>
                        </div>
                    </div>

                </form>
            </div>
            <div class='col-md-4'></div>
        </div>
    </div>

    {{--{{pp($billing)}}--}}
@endsection
