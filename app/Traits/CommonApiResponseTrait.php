<?php

namespace App\Traits;

trait CommonApiResponseTrait
{
    public function sendSuccessResponse($status_code, $status_description, $data, $action_name){

        $response = [
            'status_code' => $status_code,
            'status_description' => $status_description,
            'data' => $data
        ];

        $this->createLog($action_name, $response);

        return response()->json($response);
    }


    public function sendFailResponse($status_code, $status_description, $errors, $action_name){

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
}
