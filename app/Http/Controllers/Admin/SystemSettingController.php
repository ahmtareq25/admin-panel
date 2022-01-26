<?php

namespace App\Http\Controllers\Admin;

use App\BusinessClass\SystemSettingBusinessClass;
use App\Http\Requests\SystemSettingRequest;
use App\Models\SystemSetting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\CommonResponseTrait;

class SystemSettingController extends Controller
{
    use CommonResponseTrait;
    public function edit(SystemSettingRequest $request, $id = 0){

        if ($request->isMethod('post')){

            $systemSettingBusinessClass = new SystemSettingBusinessClass();
            $requestData = $request->only($systemSettingBusinessClass->getAcceptableRequestParams());
            $systemSettingBusinessClass->processUpdate($requestData, $id, auth()->user());
            return $this->commonFlashResponse($systemSettingBusinessClass->status_code, $systemSettingBusinessClass->status_message);
        }

        $data = [
            'page_title'=>'System Setting',
            'systemSettingObj' => SystemSetting::query()->first()
        ];

        return view('admin.pages.systemSetting.index', $data);

    }
}
