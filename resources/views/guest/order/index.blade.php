@extends('layouts.app')

@section('content')

@if( $orders->count() < 1 )
    <div class="row justify-content-center">
        <div class="alert alert-danger" role="alert">
            <h4 class="alert-heading">No orders found!</h4>
            <hr>
        </div>
    </div>
@endif

@foreach ($orders->chunk(5) as $chunk)
    <div class="row justify-content-center">
        @foreach ($chunk as $order)
            <div class="card" style="width: 12rem; margin: 5px;">
                    <img src="{{ asset( $order->picture) }}"  style="width:100%; height:350px;" class="card-img-top rounded" alt="picture">   
                <div class="card-body">
                    @if ($order->promo > 0 )
                        <div class="alert alert-danger" role="alert">
                            <span class="label label-danger"> 
                                <i class="fa fa-percent fa-5" aria-hidden="true">Cupon code is applied</i>
                            </span>
                        </div>
                    @endif
                    @if( $order->is_new )   
                        <div class="alert alert-danger" role="alert">
                            <span class="label label-danger"> 
                                <i class="fa fa-tags fa-5" aria-hidden="true">New</i>
                            </span> 
                        </div>
                    @endif
                    <h5 class="card-title">{{ $order->title }}</h5>
                    <h5 class="card-title">
                        @foreach ($order->computers as $computer)
                            {{ $computer->computer . ' ' }}
                        @endforeach
                    </h5>
                    <a href="{{ route('order.show', [ $order ]) }}" class="btn btn-primary btn-block">Check order</a>
                </div>
            </div>
        @endforeach
    </div >
@endforeach

<div class="row justify-content-center">
    {{$orders->links() }}
</div>

@endsection