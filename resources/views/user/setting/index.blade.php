@extends('layouts.app')

@section('content')

<div class="row justify-content-center">
    <h5>User setting</h5>
</div>
<div class="row justify-content-center">
    <div class="col-3">
        <div class="card">

            <div class="card-header">{{ __('Change password') }}</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('user.password.update' )}}" >
                        @csrf
                        @if ($errors->userPasswordBag->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->userPasswordBag->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        @if(session()->has('messagePassword'))
                            <div class="alert alert-success">
                                {{ session()->get('messagePassword') }}
                            </div>
                        @endif
                        @if(session()->has('wrongPassword'))
                        <div class="alert alert-danger">
                            {{ session()->get('wrongPassword') }}
                        </div>
                        @endif
                        <div class="form-group">
                            <label for="exampleFormControlInput1">{{ __('Old password') }} </label>
                            <input type="password" name="old_password" class="form-control" value="{{  old('old_password')  }}" placeholder="" required >
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlInput1">{{ __('New password') }} </label>
                            <input type="password" name="new_password" class="form-control" value="{{  old('new_password')  }}" placeholder="" required >
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlInput1">{{ __('Confirm New password') }} </label>
                            <input type="password" name="confirm_password" class="form-control" value="" placeholder="" required >
                        </div>

                        <button type="submit"  class="btn btn-primary btn-lg btn-block">Change password</button>
                    </form>
                </div>
        </div>
    </div>
    <div class="col-3">
        <div class="card">
            <div class="card-header">{{ __('Change email') }}</div>
            <div class="card-body">
                <form method="POST" action="{{ route('user.email.update' ) }}" >
                    @csrf
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    @if(session()->has('wrongEmailPassword'))
                    <div class="alert alert-danger">
                        {{ session()->get('wrongEmailPassword') }}
                    </div>
                    @endif
                    @if(session()->has('messageEmail'))
                    <div class="alert alert-success">
                        {{ session()->get('messageEmail') }}
                    </div>
                    @endif
                    <div class="form-group">
                        <label for="exampleFormControlInput1">{{ __('Password') }} </label>
                        @if ($errors->has('password'))
                            <span class="text-danger">{{ $errors->first('title') }}</span>
                        @endif
                        <input type="password" name="password" class="form-control" value="{{  old('old_password')  }}" placeholder="" autocomplete="off" required >
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">{{ __('New email') }} </label>
                        @if ($errors->has('new_email'))
                            <span class="text-danger">{{ $errors->first('new_email') }}</span>
                        @endif
                        <input type="email" name="new_email" class="form-control" value="{{  old('new_email')  }}" placeholder="" autocomplete="off" required >
                    </div>
                    <button type="submit"  class="btn btn-primary btn-lg btn-block">Change email</button>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection