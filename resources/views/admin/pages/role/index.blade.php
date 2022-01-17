@extends('admin.layouts.main')
@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card table-with-links">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title">{{__('Roles')}}</h4>
                    <p class="card-category"></p>
                    <a href="{{route(config('routename.ROLE_ADD'))}}" type="button" class="btn btn-default btn-outline">
                                                    <span class="btn-label">
                                                        <i class="fa fa-plus"></i>
                                                    </span>
                        {{__('Add')}}
                    </a>
                </div>
                <div class="card-body table-full-width table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th class="text-center">{{__('ID')}}</th>
                            <th>{{__('Name')}}</th>
                            <th>{{__('Created Date')}}</th>
                            <th>{{__('Updated Date')}}</th>
                            <th class="text-right">{{__('Actions')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($roles as $role)
                            <tr>
                                <td class="text-center">{{$role->id}}</td>
                                <td>{{$role->name}}</td>
                                 <td>{{commonDateFormat($role->created_at)}}</td>
                                 <td>{{commonDateFormat($role->updated_at)}}</td>
                                <td class="td-actions text-right">
                                    @if(hasPermission(config('routename.ROLE_EDIT')))
                                        <a href="{{route(config('routename.ROLE_EDIT'), $role->id)}}" rel="tooltip" title="" class="btn btn-success btn-link btn-xs" data-original-title="Edit Profile">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                    @endif

                                    @if(hasPermission(config('routename.ROLE_DELETE')))
                                        <a href="#" rel="tooltip" title="" class="btn btn-danger btn-link btn-xs"
                                           data-original-title="Remove" onclick="deleteAction('delete-form-{{$role->id}}')">
                                            <i class="fa fa-times"></i>
                                        </a>
                                        <form id="delete-form-{{$role->id}}"
                                              action="{{route(config('routename.ROLE_DELETE'), $role->id)}}"
                                              method="post" style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    @endif



                                </td>

                            </tr>

                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>


@endsection
