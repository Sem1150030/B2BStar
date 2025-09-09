<?php
// Helper function to get translation from Tolgee JSON files
if (!function_exists('t')) {
    function t($key, $lang = null) {
        static $cache = [];
        $lang = $lang ?: app()->getLocale();
        $path = resource_path("lang/tolgee/{$lang}.json");
        if (!array_key_exists($lang, $cache)) {
            if (is_file($path)) {
                $data = json_decode(@file_get_contents($path), true) ?: [];
                if (isset($data[$lang]) && is_array($data[$lang])) {
                    $data = $data[$lang];
                }
                $cache[$lang] = $data;
            } else {
                $cache[$lang] = [];
            }
        }
        // Resolve dot notation
        return data_get($cache[$lang], $key, $key);
    }
}
