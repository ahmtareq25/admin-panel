<?php

namespace App\Http\Controllers\Admin;

use App\BusinessClass\UserBusinessClass;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request){
        $search['page_limit'] = $request->page_limit ?? 10;

        $data = [
            'page_title' => 'User Management',
            'search' => $search,
            'users' =>  (new UserBusinessClass())->getAllData($search),
        ];

        return view('admin.pages.user.index', $data);
    }


    public function add(UserRequest $request)
    {
        if ($request->isMethod('post')) {
            $userBusinessClass = new UserBusinessClass();
            $userBusinessClass->processSave($request->only($userBusinessClass->getAcceptableRequestParams()),
                auth()->user()->parent_user_id, auth()->user());

            return $this->commonFlashResponse($userBusinessClass->status_code, $userBusinessClass->status_message);

        }

        $data = [
            'page_title' => 'User Management',
            'roles' => (new Role())->getAllRole(),
        ];

        return view('admin.pages.user.add', $data);
    }

    public function edit(UserRequest $request, $id){

        if ($request->isMethod('POST')) {
            $userBusinessClass = new UserBusinessClass();
            $userBusinessClass->processUpdate($request->only($userBusinessClass->getAcceptableRequestParams()), $id, auth()->user());

            return $this->commonFlashResponse($userBusinessClass->status_code, $userBusinessClass->status_message);

        }

        $userObj = (new User())->findUserById($id);

        $data = [
            'page_title' => 'User Management',
            'roles' => (new Role())->getAllRole(),
            'userObj' => $userObj,
            'userRoles' => $userObj->userRoles
        ];

        return view('admin.pages.user.edit',$data);
    }

    public function delete($id){
        $userBusinessClass = new UserBusinessClass();
        $userBusinessClass->processDelete($id, auth()->user());
        return $this->commonFlashResponse($userBusinessClass->status_code, $userBusinessClass->status_message);

    }


}
