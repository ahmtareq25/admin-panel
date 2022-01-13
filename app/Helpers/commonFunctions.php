<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

function hasPermission($route_name){
    $routeList = empty(session()->get('permitted_route_list')) ? []: session()->get('permitted_route_list');
    return array_key_exists($route_name, $routeList);
}

function getCurrentRouteSubModuleId($route_name){
    $sub_module_id = 0;
    $routeList = empty(session()->get('permitted_route_list')) ? []: session()->get('permitted_route_list');
    if (array_key_exists($route_name, $routeList)){
        $sub_module_id = $routeList[$route_name]['sub_module_id'];
    }

    return $sub_module_id;

}

function getCurrentRouteModuleId($route_name){
    $module_id = 0;
    $routeList = empty(session()->get('permitted_route_list')) ? []: session()->get('permitted_route_list');
    if (array_key_exists($route_name, $routeList)){
        $module_id = $routeList[$route_name]['module_id'];
    }
    return $module_id;

}

function createLog($logData){

    $logCommonData = [
        'visited_date_time' => Carbon::now()->toDateTimeString(),
        'visitor_ip' => getClientIp(),
        'visitor_agent' => getUserAgent(),
        'remote_server_ip' => getRemoteServerIp()
    ];
    if (auth()->check()) {
        $logCommonData['auth_name'] = auth()->user()->name;
        $logCommonData['auth_id'] = auth()->user()->id;
    }
    $logData = $logData +$logCommonData;

    Log::info(json_encode($logData));
}

function getRemoteServerIp(){
    $ip = '';

    if (isset($_SERVER['HTTP_REFERER'])) {
        $addr = $_SERVER['HTTP_REFERER'];
    }elseif (isset($_SERVER['REMOTE_ADDR'])){
        $addr = $_SERVER['REMOTE_ADDR'];
    } else {
        $addr = url()->previous();

    }

    if (strlen($addr) > 2) {
        $subAddr = substr($addr, 0, 3);
        if ($subAddr == 'htt' || $subAddr == 'www') {
            $host = parse_url($addr, PHP_URL_HOST);
            $currentServerHost = parse_url(config('app.url'), PHP_URL_HOST);
            if ($host != $currentServerHost){
                $ip = gethostbyname($host);
            }

        } else {
            $ip = $addr;
        }
    }

    return $ip;
}

function getClientIp()
{
    if (isset($_SERVER['HTTP_CLIENT_IP']))
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    else if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if (isset($_SERVER['HTTP_X_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    else if (isset($_SERVER['HTTP_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    else if (isset($_SERVER['HTTP_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    else if (isset($_SERVER['REMOTE_ADDR']))
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    else
        $ipaddress = 'UNKNOWN';

    if (strlen($ipaddress) > 45){
        $ipaddress = substr($ipaddress, 0,45);
    }
    return $ipaddress;
}

function getUserAgent()
{
    $maxlength = 80;
    $userAgent = isset($_SERVER['HTTP_USER_AGENT']) ? strtolower($_SERVER['HTTP_USER_AGENT']) : '';
    if (strlen($userAgent) < 80) {
        $maxlength = strlen($userAgent);
    }

    return substr($userAgent, 0, $maxlength);
}


function flash($message, $level = 'info', $title = ''){
    $flash = [
        $level => [
            'title' => $title,
            'message' => $message,
        ]
    ];
    if (session()->has('system_flash_messages')){
        $oldFlash = session()->get('system_flash_messages');
        if (array_key_exists($level, $oldFlash)){
            unset($oldFlash[$level]);
        }

        $flash = array_merge($flash, $oldFlash);

    }

    session()->flash('system_flash_messages', $flash);
}

 function arrayToXML(array $data, $rootTag = '', $headerTag = true)
{
    $xml = new \SimpleXMLElement(!empty($rootTag) ? $rootTag : '<rootTag/>');
    ToXML($xml, $data);

    $result = $xml->asXML();
    if (!$headerTag){
        $result = explode("\n", $result, 2)[1];
        $result = str_replace("\n", "", $result);
    }
    return $result;
}

function ToXML(\SimpleXMLElement $object, array $data)
{
    foreach ($data as $key => $value) {
        if (is_array($value)) {
            $new_object = $object->addChild($key);
            ToXML($new_object, $value);
        } else {
            // if the key is an integer, it needs text with it to actually work.
            if ($key == (int)$key) {
                $key = "$key";
            }

            $object->addChild($key, htmlspecialchars($value));
        }
    }
}

