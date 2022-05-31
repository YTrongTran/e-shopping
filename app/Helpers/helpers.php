<?php

use App\Model\Setting;


function config_setting($config_key)
{
    $setting = Setting::where('config_key', $config_key)->first();
    if (!empty($setting)) {
        return $setting->config_value;
    }
    return null;
}