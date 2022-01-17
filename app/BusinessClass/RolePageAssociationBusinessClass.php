<?php

namespace App\BusinessClass;

use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class RolePageAssociationBusinessClass
{
    public $status_code;
    public $status_message;

    public function rolePageAssociation($pageIds, $role_id){

        $logData['action'] = 'ROLE PAGE ASSOCIATION';
        $roleObj = (new Role())->findById($role_id);

        if (empty($roleObj)){
            $this->status_code = config('systemresponse.OBJECT_NOT_FOUND.CODE');
            $this->status_message = config('systemresponse.OBJECT_NOT_FOUND.MESSAGE');
        }

        if (empty($this->status_code)){

            try {
                DB::beginTransaction();

                $roleObj->pages()->sync($pageIds);

                User::query()->whereIn('id', $roleObj->users->pluck('id')->toArray())->update([
                    'permission_version' => DB::raw('permission_version +1')
                ]);
                DB::commit();

                $this->status_code = config('systemresponse.OPERATION_SUCCESS.CODE');
                $this->status_message = config('systemresponse.OPERATION_SUCCESS.MESSAGE');

            }catch (\Exception $exception){
                DB::rollBack();
                $logData['exception'] = $exception->getMessage();
                $this->status_code = config('systemresponse.OPERATION_FAILED.CODE');
                $this->status_message = config('systemresponse.OPERATION_FAILED.MESSAGE');
            }


        }

        $logData = $logData + [
                'status_code' => $this->status_code,
                'status_message' => $this->status_message,
            ];
        createLog($logData);
    }

}
