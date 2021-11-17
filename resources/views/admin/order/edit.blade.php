@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                        <div class="card-header">{{ __('Edit Order') }}</div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('admin.order.update', $order) }}" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                @if(session()->has('message'))
                                    <div class="alert alert-success">
                                        {{ session()->get('message') }}
                                    </div>
                                @endif
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">{{ __('Order Title') }} </label>
                                    @if ($errors->has('title'))
                                        <span class="text-danger">{{ $errors->first('title') }}</span>
                                    @endif
                                    <input type="text" name="title" class="form-control" value="{{  $book->title  }}" placeholder="{{ __('E.g., broken screen...') }}" required >
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">{{ __('Computer details') }} </label>
                                    @if ($errors->has('computer'))
                                        <span class="text-danger">{{ $errors->first('computer') }}</span>
                                    @endif
                                    <a type="button" data-toggle="tooltip" data-placement="right" title="Seperate Author with comma to add more than one detail, e.g., manufacturer, model etc!">
                                        <i class="fa fa-info-circle" aria-hidden="true"></i>
                                    </a>
                                    <input type="text" name="computer" class="form-control" value="{{  $order->computers  }}" placeholder="{{ __('Lenovo, HP etc.') }}" required >
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">{{ __('Order type') }} </label>
                                    @if ($errors->has('type'))
                                    <span class="text-danger">{{ $errors->first('type') }}</span>
                                    @endif
                                    <a type="button" data-toggle="tooltip" data-placement="right" title="Seperate types with comma to add more than one!">
                                        <i class="fa fa-info-circle" aria-hidden="true"></i>
                                    </a>
                                    <input type="text" name="type" class="form-control"  value="{{  $order->types  }}" placeholder="{{ __('Broken, scratch etc') }}" required >
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">{{ __('Description') }}</label>
                                    @if ($errors->has('description'))
                                        <span class="text-danger">{{ $errors->first('title') }}</span>
                                    @endif
                                    <textarea id="myTextarea" class="form-control" name="description"  required rows="3"></textarea>
                                </div>
                                <div class="form-group">
                                    @if ($errors->has('description'))
                                        <span class="text-danger">{{ $errors->first('picture') }}</span>
                                    @endif
                                    <label for="exampleFormControlFile1">{{ __('Photo of your computer') }}</label>
                                    <input type="file" name="picture" value="{{ asset( $order->picture) }}" class="form-control-file" >
                                </div>
                                <div class="form-group">
                                    @if ($errors->has('promo'))
                                        <span class="text-danger">{{ $errors->first('promo') }}</span>
                                    @endif
                                    <label for="exampleFormControlFile1">{{ __('Cupon code (if you have one)') }}</label>
                                    <input type="number" min="0" max="100" name="promo" value="{{  $order->promo}}" class="form-control" >
                                </div>
                                <div class="form-group">
                                    @if ($errors->has('level'))
                                        <span class="text-danger">{{ $errors->first('picture') }}</span>
                                    @endif
                                    <label for="exampleFormControlFile1">{{ __('Order level of importance(1-5)') }}</label>
                                    <input type="number" min="0.10" step="0.10" name="level"  class="form-control" value="{{   $order->level   }}" placeholder="{{ __('3') }}" required >
                                </div>

                                <button type="submit"  class="btn btn-primary btn-lg btn-block"> Save changes</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(function () {
        $('[data-toggle="tooltip"]').tooltip()
        });
        document.getElementById("myTextarea").value = "{{   $order->description   }}";
    </script>
@endsection