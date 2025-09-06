<?php
if (!function_exists('t')) {
    function t($key, $lang = null) {
        $lang = $lang ?: app()->getLocale();
        $path = resource_path("lang/tolgee/{$lang}.json");
        if (file_exists($path)) {
            $translations = json_decode(file_get_contents($path), true);
            return $translations[$key] ?? $key;
        }
        return $key;
    }
}
