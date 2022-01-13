@extends('admin.layouts.main')
@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header ">
                    <h4 class="card-title">{{__('ADD USER')}}</h4>
                </div>
                <div class="card-body ">
                    <form id="saveUserForm" method="POST" action="{{route(config('routename.USER_ADD'))}}" class="form-horizontal">

                        @csrf
                        <div class="row">
                            <label class="col-sm-2 control-label">{{__('Name')}}</label>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" value="{{old('name')}}">
                                    @error('name')
                                    <label id="name-error" class="error" for="name">{{$message}}</label>
                                    @enderror

                                </div>
                            </div>

                            <label class="col-sm-2 control-label">{{__('Email')}}</label>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <input name="email" type="email" class="form-control @error('email') is-invalid @enderror" value="{{old('email')}}">
                                    @error('email')
                                    <label id="email-error" class="error" for="email">{{$message}}</label>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <label class="col-sm-2 control-label">{{__('Phone Number')}}</label>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <input name="phone_number" type="text" class="form-control @error('phone_number') is-invalid @enderror" value="{{old('phone_number')}}">

                                    @error('phone_number')
                                    <label id="phone_number-error" class="error" for="phone_number">{{$message}}</label>
                                    @enderror
                                </div>
                            </div>

                            <label class="col-sm-2 control-label">{{__('Roles')}}</label>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <select name="roles[]" multiple data-title="{{__('Please Select')}}" name="currency" class="selectpicker" data-style="btn-outline" >

                                        @foreach($roles as $role)
                                            <option value="{{$role->id}}">{{$role->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('roles')
                                    <label id="email-error" class="error" for="email">{{$message}}</label>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-2 control-label">{{__('Password')}}</label>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input name="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="">
                                    @error('password')
                                    <label id="password-error" class="error" for="password">{{$message}}</label>
                                    @enderror
                                </div>
                            </div>
                            <label class="col-sm-2 control-label">{{__('Confirm Password')}}</label>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input name="password_confirmation" type="password" class="form-control" placeholder="">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-footer text-right">
                    <button id="saveUserBtn" type="submit" class="btn btn-fill btn-default">{{__('Submit')}}</button>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('js_code')
    <script>

        $('#saveUserBtn').on('click', function () {

            $('#saveUserForm').submit();

        })

    </script>

@endsection
