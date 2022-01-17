@extends('admin.layouts.main')
@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header ">
                    <h4 class="card-title">{{__('System Setting Update')}}</h4>
                </div>
                <div class="card-body ">
                    <form id="saveSystemSettingForm" method="POST" action="{{route(config('routename.SYSTEM_SETTING_UPDATE'), $systemSettingObj->id)}}" class="form-horizontal">

                        @csrf
                        <div class="row">
                            <label class="col-sm-2 control-label">{{__('Site Title')}}</label>
                            <div class="col-sm-10">
                                <div class="form-group">
                                    <input name="site_title" type="text" class="form-control @error('site_title') is-invalid @enderror" value="{{old('site_title')}}">
                                    @error('site_title')
                                    <label id="name-error" class="error" for="site_title">{{$message}}</label>
                                    @enderror

                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <label class="col-sm-2 control-label">{{__('Favicon')}}</label>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input name="fav_icon" type="file" class="form-control @error('fav_icon') is-invalid @enderror" placeholder="">
                                    @error('fav_icon')
                                    <label id="fav_icon-error" class="error" for="fav_icon">{{$message}}</label>
                                    @enderror
                                </div>
                            </div>
                            <label class="col-sm-2 control-label">{{__('Logo')}}</label>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input name="logo" type="file" class="form-control @error('logo') is-invalid @enderror" placeholder="">
                                    @error('logo')
                                    <label id="logo-error" class="error" for="logo">{{$message}}</label>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-footer text-right">
                    <button id="saveSystemSettingBtn" type="submit" class="btn btn-fill btn-default">{{__('Submit')}}</button>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('js_code')
    <script>

        $('#saveSystemSettingBtn').on('click', function () {

            $('#saveSystemSettingForm').submit();

        })

    </script>

@endsection
