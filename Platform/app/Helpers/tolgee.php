<?php

use App\Services\TolgeeService;

if (!function_exists('tolgee')) {
    function tolgee($key, $lang = null)
    {
        $lang = $lang ?? app()->getLocale();
        return app(TolgeeService::class)->translate($key, $lang);
    }
}
