<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Traits\CommonResponseTrait;
use App\Traits\SystemStorageTrait;
use Illuminate\Http\Request;

class FileUploadController extends Controller
{
    use SystemStorageTrait, CommonResponseTrait;
    public function upload(Request $request){

        if (!empty($request->file())){
            $file = $request->file(array_key_first($request->file()));

            $this->uploadFile($file, 'tmp');
            $data = [
                'file_url' => $this->full_url,
                'path'=> $this->db_directory
            ];

            return $this->sendSuccessJsonResponse(config('systemresponse.OPERATION_SUCCESS.CODE'),
                config('systemresponse.OPERATION_SUCCESS.MESSAGE'),$data, 'FILE UPLOAD');
        }
        return $this->sendSuccessJsonResponse(config('systemresponse.OPERATION_FAILED.CODE'),
            config('systemresponse.OPERATION_FAILED.MESSAGE'), [], 'FILE UPLOAD');

    }
}
