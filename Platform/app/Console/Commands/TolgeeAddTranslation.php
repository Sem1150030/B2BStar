<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class TolgeeAddTranslation extends Command
{
    protected $signature = 'translate {key} {text} {lang=en}';
    protected $description = 'Add a translation to Tolgee via API';

    public function handle()
    {
        $apiUrl = config('services.tolgee.api_url', 'https://app.tolgee.io');
        $apiKey = config('services.tolgee.api_key');
        $projectId = config('services.tolgee.project_id');
        $key = $this->argument('key');
        $text = $this->argument('text');
        $lang = $this->argument('lang');

        $payload = [
            'key' => $key,
            // Optionally, you can add 'languagesToReturn' => [$lang],
            // 'namespace' => 'default', // or any namespace if needed
            'translations' => [
                $lang => $text
            ]
        ];

        $response = Http::withHeaders([
            'X-API-Key' => $apiKey,
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ])->post("{$apiUrl}/v2/projects/{$projectId}/translations", $payload);

        if ($response->successful()) {
            $this->info('Translation added successfully!');
        } else {
            $this->error('Failed to add translation: ' . $response->body());
        }
    }
}
