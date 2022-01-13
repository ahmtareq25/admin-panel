<?php

namespace App\Traits;

trait CommonResponseTrait
{
    public function sendSuccessJsonResponse($status_code, $status_description, $data, $action_name){

        $response = [
            'status_code' => $status_code,
            'status_description' => $status_description,
            'data' => $data
        ];

        $this->createLog($action_name, $response);

        return response()->json($response);
    }


    public function sendFailJsonResponse($status_code, $status_description, $errors, $action_name){

        $response = [
            'status_code' => $status_code,
            'status_description' => $status_description,
            'errors' => $errors
        ];

        $this->createLog($action_name, $response);

        return response()->json($response);
    }

    private function createLog($action_name, $response){
        $logData['action'] = $action_name;
        $logData['response'] = $response;
        createLog($logData);
    }

    public function commonFlashResponse($status_code, $status_message){
        if ($status_code == config('systemresponse.OPERATION_SUCCESS.CODE')) {

            flash($status_message, 'success');

            return back();

        } else {

            flash($status_message, 'danger');

            return back()->withInput();
        }
    }


}
