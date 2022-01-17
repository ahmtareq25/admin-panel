<?php

namespace App\Http\Controllers\Admin;
use App\BusinessClass\RoleBusinessClass;
use App\Http\Controllers\Controller;
use App\Http\Requests\RoleRequest;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{

    public function index(){

        $data['page_title'] = 'Role Management';
        $data['roles'] = (new RoleBusinessClass())->getAllData();

        return view('admin.pages.role.index', $data);
    }

    public function add(RoleRequest $request){

        if ($request->isMethod('post')) {
            $roleBusinessClass = new RoleBusinessClass();
            $roleBusinessClass->processSave($request->only($roleBusinessClass->getAcceptableRequestParams()), auth()->user()->parent_user_id);

            return $this->commonFlashResponse($roleBusinessClass->status_code, $roleBusinessClass->status_message);

        }
        $data['page_title'] = 'Role Management';
        return view('admin.pages.role.add');
    }

    public function edit(RoleRequest $request, $id){

        if ($request->isMethod('POST')) {
            $roleBusinessClass = new RoleBusinessClass();
            $roleBusinessClass->processUpdate($request->only($roleBusinessClass->getAcceptableRequestParams()), $id);

            return $this->commonFlashResponse($roleBusinessClass->status_code, $roleBusinessClass->status_message);
        }
        $data =[
            'page_title' => 'Role Management',
            'roleObj' => (new Role())->findById($id),

        ];
        return view('admin.pages.role.edit',$data);
    }

    public function delete($id){
        $roleBusinessClass = new RoleBusinessClass();
        $roleBusinessClass->processDelete($id);
        return $this->commonFlashResponse($roleBusinessClass->status_code, $roleBusinessClass->status_message);
    }

}
