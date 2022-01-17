<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SystemSettingRequest;
use App\Models\SystemSetting;
use Illuminate\Http\Request;

class SystemSettingController extends Controller
{
    public function edit(SystemSettingRequest $request, $id = 0){

        if ($request->isMethod('post')){

        }

        $data = [
            'page_title'=>'System Setting',
            'systemSettingObj' => SystemSetting::query()->first()
        ];

        return view('admin.pages.systemSetting.index', $data);

    }
}
