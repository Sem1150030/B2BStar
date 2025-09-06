<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class TolgeeService
{
    protected $apiUrl;
    protected $apiKey;
    protected $projectId;

    public function __construct()
    {
        $this->apiUrl = config('services.tolgee.api_url', 'https://app.tolgee.io');
        $this->apiKey = config('services.tolgee.api_key');
        $this->projectId = config('services.tolgee.project_id');
    }

    public function translate($key, $lang = 'en')
    {
        $cacheKey = "tolgee_{$this->projectId}_{$lang}_{$key}";
        dump( $this->apiKey );
        return Cache::remember($cacheKey, 3600, function () use ($key, $lang) {
            $response = Http::withHeaders([
                'X-API-Key' => $this->apiKey
            ])->get("{$this->apiUrl}/v2/projects/{$this->projectId}/translations/{$lang}/export");
            if ($response->successful()) {
                $translations = $response->json();
                return $translations[$key] ?? $key;
            }

            return $key;
        });
    }
}
