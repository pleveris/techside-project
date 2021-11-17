@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    @foreach ($errors->all() as $error)
                        {!! $errors->first() !!}
                    @endforeach
                    <div class="card-header">{{ __('Add a new order') }}</div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('order.store') }}" enctype="multipart/form-data">
                                @csrf
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
                                    <input type="text" name="title" class="form-control" value="{{  old('title')  }}" placeholder="{{ __('Broken screen, etc') }}" required >
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">{{ __('Computer info') }} </label>
                                    @if ($errors->has('computer'))
                                        <span class="text-danger">{{ $errors->first('title') }}</span>
                                    @endif
                                    <a type="button" data-toggle="tooltip" data-placement="right" title="Seperate Computer with comma to add more than one param!">
                                        <i class="fa fa-info-circle" aria-hidden="true"></i>
                                    </a>
                                    <input type="text" name="computer" class="form-control" value="{{  old('computer')  }}" placeholder="{{ __('Lenovo, HP etc. ') }}" required >
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">{{ __('Order type') }} </label>
                                    @if ($errors->has('type'))
                                    <span class="text-danger">{{ $errors->first('title') }}</span>
                                    @endif
                                    <a type="button" data-toggle="tooltip" data-placement="right" title="Seperate types with comma to add more than one!">
                                        <i class="fa fa-info-circle" aria-hidden="true"></i>
                                    </a>
                                    <input type="text" name="type" class="form-control" value="{{  old('type')  }}" placeholder="{{ __('Broken screen, not working software etc') }}" required >
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">{{ __('Description') }}</label>
                                    @if ($errors->has('description'))
                                        <span class="text-danger">{{ $errors->first('title') }}</span>
                                    @endif
                                    <textarea class="form-control" name="description" value="{{   old('description')   }}" required rows="3"></textarea>
                                </div>
                                <div class="form-group">
                                    @if ($errors->has('description'))
                                        <span class="text-danger">{{ $errors->first('picture') }}</span>
                                    @endif
                                    <label for="exampleFormControlFile1">{{ __('Picture of your computer') }}</label>
                                    <input type="file" name="picture" class="form-control-file" >
                                </div>
                                <div class="form-group">
                                    @if ($errors->has('level'))
                                        <span class="text-danger">{{ $errors->first('picture') }}</span>
                                    @endif
                                    <label for="exampleFormControlFile1">{{ __('Importance level') }}</label>
                                    <input type="number" min="1" name="level"  class="form-control" value="{{  old('level')  }}" placeholder="{{ __('3') }}" required >
                                </div>

                                <button type="submit"  class="btn btn-primary btn-lg btn-block"> Order</button>
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
    </script>
@endsection