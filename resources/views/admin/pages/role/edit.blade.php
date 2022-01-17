@extends('admin.layouts.main')
@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card " >
                <div class="card-header ">
                    <h4 class="card-title">{{__('UPDATE ROLE')}}</h4>
                </div>
                <div class="card-body ">
                    <form id="updateRoleForm" method="POST" action="{{route(config('routename.ROLE_EDIT'), $roleObj->id)}}" class="form-horizontal">

                        @csrf
                        <div class="row">
                            <label class="col-sm-2 control-label">{{__('Name')}}</label>
                            <div class="col-sm-10">
                                <div class="form-group">
                                    <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" value="{{!empty(old('name')) ? old('name') : $roleObj->name}}">
                                    @error('name')
                                    <label id="name-error" class="error" for="name">{{$message}}</label>
                                    @enderror

                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-footer text-right">
                    <button id="updateRoleBtn" type="submit" class="btn btn-fill btn-default">{{__('Update')}}</button>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('js_code')
    <script>

        $('#updateRoleBtn').on('click', function () {

            $('#updateRoleForm').submit();

        })

    </script>

@endsection

