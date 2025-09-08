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

        // Apply immediately for this request cycle so re-render picks translations
        app()->setLocale($locale);
        $this->currentLocale = $locale;

        // Optional: dispatch browser event if front-end scripts need to react
        $this->dispatch('locale-changed', locale: $locale);
    }

    public function render()
    {
        return view('livewire.marketplace.navigation.top-navigation');
    }
}
