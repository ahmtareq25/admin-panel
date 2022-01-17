@extends('admin.layouts.main')
@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header ">
                    <h4 class="card-title">{{__('ADD ROLE')}}</h4>
                </div>
                <div class="card-body ">
                    <form id="saveRoleForm" method="POST" action="{{route(config('routename.ROLE_ADD'))}}" class="form-horizontal row">

                        @csrf
                            <label class="col-sm-2 control-label">{{__('Name')}}</label>
                            <div class="col-sm-10">
                                <div class="form-group">
                                    <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" value="{{old('name')}}">
                                    @error('name')
                                    <label id="name-error" class="error" for="name">{{$message}}</label>
                                    @enderror

                                </div>
                            </div>

                    </form>
                </div>
                <div class="card-footer text-right">
                    <button id="saveRoleBtn" type="submit" class="btn btn-fill btn-default">{{__('Submit')}}</button>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('js_code')
    <script>

        $('#saveRoleBtn').on('click', function () {

            $('#saveRoleForm').submit();

        })

    </script>

@endsection
