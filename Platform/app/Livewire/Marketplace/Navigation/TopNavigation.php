<?php

namespace App\Livewire\Marketplace\Navigation;

use App\roleTypes;
use Auth;
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

    public ?string $role;

    /** Current active locale (kept in sync so Blade updates without full page reload) */
    public string $currentLocale;

    public function mount(): void
    {
        $this->currentLocale = app()->getLocale();
        $this->role = Auth::user()->role_type ?? null;
        dump($this->role == roleTypes::BRAND->value);
    }

    /**
     * Switch the application locale (Livewire-driven, no full reload).
     */
    public function switchLocale(string $locale)
    {
        if (! array_key_exists($locale, $this->languages)) {
            return; // silently ignore invalid
        }

        // Persist to session & long-lived cookie (1 year)
        session(['app_locale' => $locale]);
        cookie()->queue('app_locale', $locale, 60 * 24 * 365, '/');

        app()->setLocale($locale);
        $this->currentLocale = $locale;
        $this->dispatch('locale-changed', locale: $locale);
        return redirect(request()->header('Referer'));
    }




    public function render()
    {
        return view('livewire.marketplace.navigation.top-navigation');
    }
}
