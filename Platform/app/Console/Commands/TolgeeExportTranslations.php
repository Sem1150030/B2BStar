<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;


class TolgeeExportTranslations extends Command
{
    protected $signature = 'tolgee:export-translations {lang?}';
    protected $description = 'Export all translations from Tolgee to a local JSON file';

    // Shortcut command to sync all translations

    public function handle()
    {
        $apiUrl = config('services.tolgee.api_url', 'https://app.tolgee.io');
        $apiKey = config('services.tolgee.api_key');
        $projectId = config('services.tolgee.project_id');

        $languages = ['en', 'nl', 'fr', 'de'];
        $folder = resource_path('lang/tolgee');
        if (!is_dir($folder)) {
            mkdir($folder, 0777, true);
        }

        foreach ($languages as $lang) {
            $url = "{$apiUrl}/v2/projects/{$projectId}/translations/{$lang}";
            $response = Http::withHeaders([
                'X-API-Key' => $apiKey,
                'Accept' => 'application/json',
            ])->get($url);

            if ($response->successful()) {
                $translations = $response->json();
                $path = $folder . "/{$lang}.json";
                file_put_contents($path, json_encode($translations, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
                $this->info("Translations exported to {$path}");
            } else {
                $this->error("Failed to export {$lang} translations: HTTP " . $response->status() . " - " . $response->body());
            }
        }
    }
}
