@extends('layouts.app')

@section('content')
    <div class="container">
        <div id="app" >
        <div class="row">
            <div class="col-4">
                <img src="{{ asset( $order->picture) }}" style="width:100%; height:450px;" class="card-img-top" alt="picture">
            </div>
            <div class="col-8">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col align-self-start">
                                <h5 >{{ $order->title}}</h5>   
                                @auth  
                                    @if(auth()->user()->admin)
                                        <a href="{{ route('admin.order.edit', $order ) }}" type="button" class="btn btn-danger" >
                                            Edit this order
                                        </a>  
                                    @else
                                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#form">
                                            Report this order
                                        </button>  
                                    @endif
                                @endauth
                                
                                
                            </div>
                            <reviews-avg-index :book="{{ json_encode($order) }}"></reviews-avg-index>
                        </div>
                    </div>

                    <div class="card-body" style="height: 350px">
                      <h5 class="card-title">
                          @foreach ($order->computers as $computer)
                              {{ $computer->computer . ' ' }}
                          @endforeach
                    </h5>
                      <p class="card-text">{{ $order->description}}</p>
                    </div>
                </div>
            </div>  
        </div>

                <div class="row mt-5">
                    <div class="w-100">
//                        @include('guest.book.review.index')  
                    </div>
                </div>

            @auth   
//                {{-- User report create form Modal --}}
//                @include('user.book.report.create')
//                {{-- Modal --}}    
            @endauth
        </div>
@endsection