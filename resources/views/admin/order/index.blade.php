@extends('layouts.app')

@section('content')
@if($orders->count() < 1)
<div class="row justify-content-center">
    <div class="alert alert-danger" role="alert">
      <h4 class="alert-heading">No orders found!</h4>
    </div>
  </div>
@endif
@foreach ($orders->chunk(5) as $chunk)
    <div class="row justify-content-center">
        @foreach ($chunk as $order)
            <div class="card" style="width: 12rem; margin: 5px;">
            <img src="{{ asset( $order->picture) }}" style="width:100%; height:350px;" class="card-img-top" alt="picture">
            <div class="card-body">
                <h5 class="card-title">{{ $order->title }}</h5>
                <h5 class="card-title">
                    @foreach ($order->computers as $computer)
                        {{ $computer->computer . ' ' }}
                    @endforeach
                </h5>
                <h4 class="card-title"> {{ $order->level }}; </h4>
                <h4 class="card-title"> Status:@if($order->approved) Aproved @else Waiting for approval @endif </h4>
                <div class="row">
                    <div class="col-6">
                        <a href="{{ route('order.edit', [ $order ]) }}" class="btn btn-sm btn-primary">Edit order </a>             
                    </div>

                    <div class="col-6">
                        <a  class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteModal">Delete order </a>
                    </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        @if($order->approved)
                        <a href="{{ route('admin.order.change.approved', [ 'order' => $order, 'status' => true ]) }}" class="btn btn-block btn-danger">Reject order </a>
                        @else
                        <a href="{{ route('admin.order.change.approved', [ 'order' => $order, 'status' => 0 ]) }}" class="btn btn-block btn-primary">Approve order </a>
                        @endif
                    </div>
                </div>
            <div class="modal modal-danger fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="Delete" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Delete Order</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                        <form action="{{ route('order.destroy', $order) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <h5 class="text-center">Are you sure you want to delete this order?</h5>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-sm btn-danger">Yes, Delete Ordeer</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div >
    <!-- Delete Warning Modal -->
    <div class="row justify-content-center">
        {{$orders->links() }}
    </div>
    <!-- End Delete Modal --> 
@endforeach

@endsection