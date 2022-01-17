<?php

namespace App\BusinessClass;
use App\Models\Role;
use Illuminate\Support\Facades\DB;

class RoleBusinessClass
{
    public $status_code;
    public $status_message;
    public $roleObj;


    public function getAcceptableRequestParams()
    {
        return ['name'];
    }

    public function getAllData(array $search = null)
    {
        return Role::all();
    }

    public function processDelete($id)
    {

        $this->roleObj = (new Role())->findById($id);

        if (empty($this->roleObj)){
            $this->status_code = config('systemresponse.OBJECT_NOT_FOUND.CODE');
            $this->status_message = config('systemresponse.OBJECT_NOT_FOUND.MESSAGE');
        }



        if (empty($this->status_code)){
            try {
                DB::beginTransaction();


                $this->roleObj->users()->detach();
                $this->roleObj->pages()->detach();

                (new Role())->deleteById($this->roleObj->id);

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
            'action' => 'ROLE DELETE',
            'status_code' => $this->status_code,
            'status_message' => $this->status_message,
        ];
        createLog($logData);

    }

    public function processSave($requestData, $parent_user_id = 0)
    {
        $logData['action'] = 'ROLE ADD';


        try {
            DB::beginTransaction();

            $roleObj = Role::create($requestData);

            DB::commit();

            $this->status_code = config('systemresponse.OPERATION_SUCCESS.CODE');
            $this->status_message = config('systemresponse.OPERATION_SUCCESS.MESSAGE');
            $this->roleObj = $roleObj;

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

    public function processUpdate($requestData, $id)
    {
        $logData['action'] = 'ROLE UPDATE';
        $this->roleObj = (new Role())->findById($id);

        if (empty($this->roleObj)){
            $this->status_code = config('systemresponse.OBJECT_NOT_FOUND.CODE');
            $this->status_message = config('systemresponse.OBJECT_NOT_FOUND.MESSAGE');
        }


        if (empty($this->status_code)) {
            try {

                $this->roleObj->update($requestData);

                $this->status_code = config('systemresponse.OPERATION_SUCCESS.CODE');
                $this->status_message = config('systemresponse.OPERATION_SUCCESS.MESSAGE');

            } catch (\Exception $exception) {
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
}
