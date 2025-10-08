<?php

namespace App\Livewire\Backoffice\Navigation;

use Illuminate\Support\Facades\Request;
use Livewire\Component;

class Sidebar extends Component
{

    public function mount(){

    }
    public function render()
    {
        return view('livewire.backoffice.navigation.sidebar');
    }
}
