<?php

namespace App\Http\Controllers;

use App\BusinessClass\UserBusinessClass;
use App\Http\Requests\UserRequest\UserStoreRequest;
use App\Http\Requests\UserRequest\UserUpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index(Request $request){
        $search['page_limit'] = $request->page_limit ?? 10;

        $data['search'] = $search;
        $data['users'] = (new UserBusinessClass())->getUsers($search);

        return view('admin.pages.user.index', $data);
    }


    public function add(UserStoreRequest $request){

        if ($request->isMethod('post')) {
            $userBusinessClass = new UserBusinessClass();
            $userBusinessClass->processUserCreate($request->only($userBusinessClass->getRequestParams()), auth()->id());
            if ($userBusinessClass->status_code == config('systemresponse.OPERATION_SUCCESS.CODE')){
                flash($userBusinessClass->status_message, 'success');
            }else{
                flash($userBusinessClass->status_message, 'danger');
            }

            return back();
        }

        return view('admin.pages.user.add');
    }

    public function edit(UserUpdateRequest $request){

        if ($request->isMethod('post')) {

        }
        return view('admin.pages.user.edit');
    }


}
