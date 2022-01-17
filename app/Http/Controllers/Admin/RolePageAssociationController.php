<?php

namespace App\Http\Controllers\Admin;

use App\BusinessClass\RoleBusinessClass;
use App\BusinessClass\RolePageAssociationBusinessClass;
use App\Http\Controllers\Controller;
use App\Http\Requests\RolePageAssociationRequest;
use App\Models\Module;
use App\Models\Role;
use App\Models\RolePage;
use App\Traits\CommonResponseTrait;
use Illuminate\Http\Request;

class RolePageAssociationController extends Controller
{
    use CommonResponseTrait;
    public function index(){

        $modules = Module::with('subModules.pages')->get();


        $data = [
            'roles' => (new RoleBusinessClass())->getAllData(),
            'modules' => $modules,
            'page_title' => 'Role & Page Association'
        ];

        return view('admin.pages.rolePage.index', $data);
    }

    public function updateRolePageAssociation(RolePageAssociationRequest $request, $role_id = 0){

        if ($request->isMethod('post')){

            $rolePageBusinessClass = new RolePageAssociationBusinessClass();
            $rolePageBusinessClass->rolePageAssociation($request->page_ids, $request->role_id);

            return $this->commonFlashResponse($rolePageBusinessClass->status_code, $rolePageBusinessClass->status_message);

        }

        $rolePages = RolePage::query()->where('role_id', $role_id)->get(['page_id'])->groupBy('page_id')->toArray();

        $modules = Module::with('subModules.pages')->get();
        $data = [
            'modules' => $modules,
            'permitted_pages' => array_keys($rolePages)
        ];

        $content = view('admin.pages.rolePage.form', $data)->render();

        return $this->sendSuccessJsonResponse(100, 'successfull', ['content' => $content], 'Role page');


    }
}
