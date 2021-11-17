@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                        <div class="card-header">{{ __('Edit Order') }}</div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('order.update', $order) }}" enctype="multipart/form-data">
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
                                    <input type="text" name="title" class="form-control" value="{{  $order->title  }}" placeholder="{{ __('Short title of your order') }}" required >
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">{{ __('Computer info') }} </label>
                                    @if ($errors->has('computer'))
                                        <span class="text-danger">{{ $errors->first('computer') }}</span>
                                    @endif
                                    <a type="button" data-toggle="tooltip" data-placement="right" title="Seperate computer info with comma to add more than one param!">
                                        <i class="fa fa-info-circle" aria-hidden="true"></i>
                                    </a>
                                    <input type="text" name="computer" class="form-control" value="{{  $order->computers  }}" placeholder="{{ __('Broken sscreen, not working software etc') }}" required >
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">{{ __('Order type') }} </label>
                                    @if ($errors->has('type'))
                                    <span class="text-danger">{{ $errors->first('type') }}</span>
                                    @endif
                                    <a type="button" data-toggle="tooltip" data-placement="right" title="Seperate types with comma to add more than one!">
                                        <i class="fa fa-info-circle" aria-hidden="true"></i>
                                    </a>
                                    <input type="text" name="type" class="form-control"  value="{{  $order->types  }}" placeholder="{{ __('Emmediate, critical') }}" required >
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
                                    <label for="exampleFormControlFile1">{{ __('Picture:') }}</label>
                                    <input type="file" name="picture" value="{{ asset( $order->picture) }}" class="form-control-file" >
                                </div>
                                <div class="form-group">
                                    @if ($errors->has('level'))
                                        <span class="text-danger">{{ $errors->first('picture') }}</span>
                                    @endif
                                    <label for="exampleFormControlFile1">{{ __('Importance level') }}</label>
                                    <input type="number" min="1" name="level"  class="form-control" value="{{   $order->level   }}" placeholder="{{ __('3') }}" required >
                                </div>

                                <button type="submit"  class="btn btn-primary btn-lg btn-block"> Add</button>
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
        document.getElementById("myTextarea").value = "{{   $book->description   }}";
    </script>
@endsection