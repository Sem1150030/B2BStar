<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class TranslationsSync extends Command
{
    protected $signature = 'translations-sync';
    protected $description = 'Sync all translations from Tolgee for en, nl, fr, de';

    public function handle()
    {
        $this->call('tolgee:export-translations');
    }
}
