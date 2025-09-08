<?php

namespace App\Livewire\Marketplace\Storefront;

use App\Models\Category;
use Livewire\Component;
use Illuminate\View\View;

class CategorieOverview extends Component
{
    /** @var array<string,string> */
    public array $fallbackImages = [
        'electronics' => 'https://images.unsplash.com/photo-1518770660439-4636190af475?auto=format&fit=crop&w=800&q=80',
        'furniture'   => 'https://images.unsplash.com/photo-1581091870627-3a29040b6f1e?auto=format&fit=crop&w=800&q=80',
        'industrial'  => 'https://tse1.mm.bing.net/th/id/OIP.qbd1SPCYe7dNCFeH1O874QHaEK?rs=1&pid=ImgDetMain&o=7&rm=3',
        'packaging'   => 'https://th.bing.com/th/id/R.c2c491e3b760e29b3f245412fff35647?rik=ewnGCsgiG4EvBw&pid=ImgRaw&r=0',
        'default'     => 'https://images.unsplash.com/photo-1604335399105-a0c924c6b742?auto=format&fit=crop&w=800&q=80',
    ];

    /** @var \Illuminate\Support\Collection<int,Category> */
    public $categories;

    public function mount(): void
    {
        $this->categories = Category::query()
            ->withCount('products')
            ->orderByDesc('products_count')
            ->limit(8)
            ->get();
    }

    public function imageFor(Category $cat): string
    {
        $candidates = [
            strtolower(str_replace(['&',' '], ['', '-'], $cat->slug)),
            strtolower(str_replace(['&',' '], ['', '-'], $cat->name)),
        ];
        foreach ($candidates as $key) {
            if (isset($this->fallbackImages[$key])) {
                return $this->fallbackImages[$key];
            }
        }
        return $this->fallbackImages['default'];
    }

    public function render(): View
    {
        return view('livewire.marketplace.storefront.categorie-overview');
    }
}
