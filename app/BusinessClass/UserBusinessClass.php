<?php

namespace App\BusinessClass;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserBusinessClass
{
    public $status_code;
    public $status_message;
    public $userObj;

    public function getRequestParams(){
        return [
            'name', 'email', 'phone_number', 'password', 'confirm_password', 'roles'
        ];
    }

    public function processUserCreate($requestData, $parent_user_id = 0){

        $userData = $this->prepareUserData($requestData, $parent_user_id);

        try {
            DB::beginTransaction();

            $userObj = User::create($userData);

            if (empty($parent_user_id)){
                $userObj->parent_user_id = $userObj->id;
            }

            $roleData = $requestData['roles'];
            $userObj->roles->attach($roleData);

            DB::commit();

            $this->status_code = config('systemresponse.OPERATION_SUCCESS.CODE');
            $this->status_message = config('systemresponse.OPERATION_SUCCESS.MESSAGE');
            $this->userObj = $userObj;

        }catch (\Exception $exception){
            DB::rollBack();
            $this->status_code = config('systemresponse.OPERATION_FAILED.CODE');
            $this->status_message = config('systemresponse.OPERATION_FAILED.MESSAGE');
        }

    }

    public function processUserUpdate($requestData, $id){

    }


    public function getUsers($search){
        $query = User::query();

        if (!empty($search['search'])){
            $query->where(function ($q) use ($search){
                $q->where('name', 'LIKE', '%'.$search['search'].'%');
                $q->orWhere('email', 'LIKE', '%'.$search['search'].'%');
            });
        }

        if (!empty($search['page_limit'])){
            $res = $query->paginate($search['page_limit']);
        }else{
            $res = $query->get();
        }
        return $res;
    }

    public function findUserById($id){
        return User::find($id);
    }

    public function findUserByEmail($email){
        return User::query()->where('email', $email)->first();
    }

    public function findUserByPhone($phone){
        return User::query()->where('phone_number', $phone)->first();
    }

    private function prepareUserData($requestData, $parent_user_id){
        unset($requestData['confirm_password']);
        unset($requestData['roles']);
        $requestData['password'] = Hash::make($requestData['password']);
        if (!empty($parent_user_id)){
            $requestData['parent_user_id'] = $parent_user_id;
        }
        return $requestData;
    }
}
