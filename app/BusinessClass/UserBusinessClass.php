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

    public function getAcceptableRequestParams(){
        return [
            'name', 'email', 'phone_number', 'password', 'confirm_password', 'roles'
        ];
    }

    public function processSave($requestData, $parent_user_id, $authObj){

        $logData['action'] = 'USER ADD';

        $userData = $this->prepareUserData($requestData, $parent_user_id);

        try {
            DB::beginTransaction();

            $userObj = User::create($userData);

            if (empty($parent_user_id)){
                $userObj->parent_user_id = $userObj->id;
                $userObj->save();
            }

            $roleData = $requestData['roles'];
            $userObj->roles()->attach($roleData);

            DB::commit();

            $this->status_code = config('systemresponse.OPERATION_SUCCESS.CODE');
            $this->status_message = config('systemresponse.OPERATION_SUCCESS.MESSAGE');
            $this->userObj = $userObj;

        }catch (\Exception $exception){
            DB::rollBack();
            $this->status_code = config('systemresponse.OPERATION_FAILED.CODE');
            $this->status_message = config('systemresponse.OPERATION_FAILED.MESSAGE');
            $logData['exception'] = $exception->getMessage();
        }

        $logData = $logData + [
                'status_code' => $this->status_code,
                'status_message' => $this->status_message,
            ];
        createLog($logData);

    }

    public function processUpdate($requestData, $id, $authObj = null){
        $logData['action'] = 'USER UPDATE';
        $this->userObj = (new User())->findUserById($id);

        if (empty($this->userObj)){
            $this->status_code = config('systemresponse.OBJECT_NOT_FOUND.CODE');
            $this->status_message = config('systemresponse.OBJECT_NOT_FOUND.MESSAGE');
        }


        if (empty($this->status_code)){
            try {
                DB::beginTransaction();
                $userData = $this->prepareUserData($requestData);
                $userData['permission_version'] = $this->userObj->permission_version + 1;
                $this->userObj->update($userData);
                $roleData = $requestData['roles'];
                $this->userObj->roles()->sync($roleData);

                DB::commit();

                $this->status_code = config('systemresponse.OPERATION_SUCCESS.CODE');
                $this->status_message = config('systemresponse.OPERATION_SUCCESS.MESSAGE');

            }catch (\Exception $exception){
                DB::rollBack();
                $this->status_code = config('systemresponse.OPERATION_FAILED.CODE');
                $this->status_message = config('systemresponse.OPERATION_FAILED.MESSAGE');
                $logData['exception'] = $exception->getMessage();


            }

        }

        $logData = $logData + [
                'status_code' => $this->status_code,
                'status_message' => $this->status_message,
            ];
        createLog($logData);
    }


    public function processDelete($id, $authUserObj)
    {
        if ($id == $authUserObj->id){
            $this->status_code = config('systemresponse.AUTH_USER_DELETE_FAILED.CODE');
            $this->status_message = config('systemresponse.AUTH_USER_DELETE_FAILED.MESSAGE');
        }

        if (empty($this->status_code)){
            $this->userObj = (new User())->findUserById($id);

            if (empty($this->userObj)){
                $this->status_code = config('systemresponse.OBJECT_NOT_FOUND.CODE');
                $this->status_message = config('systemresponse.OBJECT_NOT_FOUND.MESSAGE');
            }
        }

        if (empty($this->status_code) && $this->userObj->id == $authUserObj->parent_user_id){
            $this->status_code = config('systemresponse.PARENT_USER_DELETE_FAILED.CODE');
            $this->status_message = config('systemresponse.PARENT_USER_DELETE_FAILED.MESSAGE');
        }

        if (empty($this->status_code)){
            try {
                DB::beginTransaction();


                $this->userObj->roles()->detach();

                (new User())->deleteById($this->userObj->id);

                DB::commit();

                $this->status_code = config('systemresponse.OPERATION_SUCCESS.CODE');
                $this->status_message = config('systemresponse.OPERATION_SUCCESS.MESSAGE');

            }catch (\Exception $exception){
                DB::rollBack();
                $this->status_code = config('systemresponse.OPERATION_FAILED.CODE');
                $this->status_message = config('systemresponse.OPERATION_FAILED.MESSAGE');

            }

        }

        $logData = [
            'action' => 'USER DELETE',
            'status_code' => $this->status_code,
            'status_message' => $this->status_message,
        ];
        createLog($logData);
    }


    public function getAllData($search)
    {
        $query = User::query();

        if (!empty($search['search'])){
            $query->where(function ($q) use ($search){
                $q->where('name', 'LIKE', '%'.$search['search'].'%');
                $q->orWhere('email', 'LIKE', '%'.$search['search'].'%');
            });
        }

        $query->orderBy('updated_at', 'DESC');
        if (!empty($search['page_limit'])){
            $res = $query->paginate($search['page_limit']);
        }else{
            $res = $query->get();
        }
        return $res;
    }


    private function prepareUserData($requestData, $parent_user_id = 0){
        unset($requestData['confirm_password']);
        unset($requestData['roles']);

        if (!empty($requestData['password'])){
            $requestData['password'] = Hash::make($requestData['password']);
        }else{
            unset($requestData['password']);
        }

        if (!empty($parent_user_id)){
            $requestData['parent_user_id'] = $parent_user_id;
        }
        return $requestData;
    }


}
