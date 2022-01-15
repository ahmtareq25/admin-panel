<?php

namespace App\Http\Controllers\Admin;

use App\BusinessClass\UserBusinessClass;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest\UserRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request){
        $search['page_limit'] = $request->page_limit ?? 10;

        $data['search'] = $search;
        $data['users'] = (new UserBusinessClass())->getUsers($search);

        return view('admin.pages.user.index', $data);
    }


    public function add(UserRequest $request)
    {
        if ($request->isMethod('post')) {
            $userBusinessClass = new UserBusinessClass();
            $userBusinessClass->processUserCreate($request->only($userBusinessClass->getRequestParams()), auth()->user()->parent_user_id);

            return $this->commonFlashResponse($userBusinessClass->status_code, $userBusinessClass->status_message);

        }

        $data = [
            'roles' => (new Role())->getAllRole(),
        ];

        return view('admin.pages.user.add', $data);
    }

    public function edit(UserRequest $request, $id){

        if ($request->isMethod('POST')) {
            $userBusinessClass = new UserBusinessClass();
            $userBusinessClass->processUserUpdate($request->only($userBusinessClass->getRequestParams()), $id);

            return $this->commonFlashResponse($userBusinessClass->status_code, $userBusinessClass->status_message);

        }

        $userObj = (new User())->findUserById($id);

        $data = [
            'roles' => (new Role())->getAllRole(),
            'userObj' => $userObj,
            'userRoles' => $userObj->userRoles
        ];

        return view('admin.pages.user.edit',$data);
    }

    public function delete($id){
        $userBusinessClass = new UserBusinessClass();
        $userBusinessClass->processUserDelete($id, auth()->user());
        return $this->commonFlashResponse($userBusinessClass->status_code, $userBusinessClass->status_message);

    }


}
