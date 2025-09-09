<?php

namespace App\Livewire\Marketplace\Navigation;

use Livewire\Component;

class TopNavigation extends Component
{
    /**
     * Available languages (code => label)
     */
    public array $languages = [
        'en' => 'English',
        'nl' => 'Dutch',
        'fr' => 'French',
        'de' => 'German',
    ];

    /** Current active locale (kept in sync so Blade updates without full page reload) */
    public string $currentLocale;

    public function mount(): void
    {
        $this->currentLocale = app()->getLocale();
    }

    /**
     * Switch the application locale (Livewire-driven, no full reload).
     */
    public function switchLocale(string $locale): void
    {
        if (! array_key_exists($locale, $this->languages)) {
            return; // silently ignore invalid
        }

        // Persist to session & long-lived cookie (1 year)
        session(['app_locale' => $locale]);
        cookie()->queue('app_locale', $locale, 60 * 24 * 365, '/');

    app()->setLocale($locale);
    $this->currentLocale = $locale;
    // Emit both Livewire event and browser event; frontend will force reload so whole app re-renders in new locale
    $this->dispatch('locale-changed', locale: $locale);
    $this->dispatch('reload-page');
    }




    public function render()
    {
        return view('livewire.marketplace.navigation.top-navigation');
    }
}
