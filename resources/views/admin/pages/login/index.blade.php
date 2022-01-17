@extends('admin.layouts.fullpage')
@section('content')
    <div class="col-md-4 col-sm-6 ml-auto mr-auto">
        <form class="form" method="POST" action="{{route('login')}}">
            @csrf
            <div class="card card-login">
                <div class="card-header ">
                    <h3 class="header text-center">Login</h3>
                    @if(count($errors) > 0)
                        @foreach( $errors->all() as $message )
                            <div class="alert alert-danger display-hide">
                                <button class="close" data-close="alert"></button>
                                <span>{{ $message }}</span>
                            </div>
                        @endforeach
                    @endif
                </div>
                <div class="card-body ">
                    <div class="card-body">
                        <div class="form-group">
                            <label>Email address</label>
                            <input type="email" name="email" value="{{ old('email') }}" placeholder="Enter email" class="form-control">

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" placeholder="Password" name="password" class="form-control">
                        </div>
                        <div class="form-group">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <span class="form-check-sign"></span>
                                    {{ __('Remember Me') }}
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer ml-auto mr-auto">
                    <button type="submit" class="btn btn-default btn-wd">Login</button>
                </div>
            </div>
        </form>
    </div>

@endsection
