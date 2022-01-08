@extends('admin.layouts.main')
@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card table-with-links">
                <div class="card-header ">
                    <h4 class="card-title">{{__('Users')}}</h4>
                    <p class="card-category"></p>
                </div>
                <div class="card-body table-full-width table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th class="text-center">{{__('ID')}}</th>
                            <th>{{__('Name')}}</th>
                            <th>{{__('Email')}}</th>
                            <th>{{__('Phone')}}</th>
                            <th>{{__('Verification Date')}}</th>
                            <th>{{__('Register Date')}}</th>
                            <th class="text-right">{{__('Actions')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td class="text-center">{{$user->id}}</td>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->phone_number}}</td>
                                <td>{{!empty($user->email_verified_at) ? $user->email_verified_at : 'Not Verified Yet'}}</td>
                                <td>{{$user->created_at}}</td>
                                <td class="td-actions text-right">
                                    <a href="#" rel="tooltip" title="" class="btn btn-info btn-link btn-xs" data-original-title="View Profile">
                                        <i class="fa fa-user"></i>
                                    </a>
                                    <a href="#" rel="tooltip" title="" class="btn btn-success btn-link btn-xs" data-original-title="Edit Profile">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <a href="#" rel="tooltip" title="" class="btn btn-danger btn-link btn-xs" data-original-title="Remove">
                                        <i class="fa fa-times"></i>
                                    </a>
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
