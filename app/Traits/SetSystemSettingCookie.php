<?php

namespace App\Traits;

trait SetSystemSettingCookie
{
    public function setSystemSettingCookie($systemSettingObj){
        cookie()->queue('site_title', $systemSettingObj->site_title);
        cookie()->queue('fav_icon', $systemSettingObj->fav_icon);
        cookie()->queue('logo', $systemSettingObj->logo);
    }
}
