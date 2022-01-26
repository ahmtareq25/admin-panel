<?php

namespace App\BusinessClass;

use App\Models\SystemSetting;
use App\Traits\SystemStorageTrait;

class SystemSettingBusinessClass
{
    use SystemStorageTrait;
    public $status_code;
    public $status_message;
    public $systemSettingObj;

    public function getAcceptableRequestParams(){
        return [
            'site_title', 'fav_icon', 'logo'
        ];
    }


    public function processUpdate($requestData, $id, $authObj = null){
        $logData['action'] = 'USER UPDATE';
        $this->systemSettingObj = (new SystemSetting())->findById($id);

        if (empty($this->systemSettingObj)){
            $this->status_code = config('systemresponse.OBJECT_NOT_FOUND.CODE');
            $this->status_message = config('systemresponse.OBJECT_NOT_FOUND.MESSAGE');
        }

        if (empty($this->status_code)){


            if (!empty($this->systemSettingObj->fav_icon)
                && !empty($requestData['fav_icon']) && $this->systemSettingObj->fav_icon != $requestData['fav_icon']) {
                $this->removeFile($this->systemSettingObj->fav_icon);
            }elseif (!empty($this->systemSettingObj->fav_icon) && empty($requestData['fav_icon'])){
                unset($requestData['fav_icon']);
            }

            if (!empty($this->systemSettingObj->logo)
                && !empty($requestData['logo']) && $this->systemSettingObj->logo != $requestData['logo']) {
                $this->removeFile($this->systemSettingObj->logo);
            }elseif (!empty($this->systemSettingObj->logo) && empty($requestData['logo'])){
                unset($requestData['logo']);
            }
            $this->systemSettingObj->update($requestData);

            $this->setCookie();

            $this->status_code = config('systemresponse.OPERATION_SUCCESS.CODE');
            $this->status_message = config('systemresponse.OPERATION_SUCCESS.MESSAGE');
        }
    }


    private function setCookie(){

        cookie()->queue('site_title', $this->systemSettingObj->site_title);
        cookie()->queue('fav_icon', $this->systemSettingObj->fav_icon);
        cookie()->queue('logo', $this->systemSettingObj->logo);

    }

}
