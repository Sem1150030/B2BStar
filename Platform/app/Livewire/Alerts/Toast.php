<?php

namespace App\Livewire\Alerts;

use Livewire\Component;

class Toast extends Component
{

    public $message;
    public $type = 'success'; // success, error, info

    protected $listeners = ['showAlert' => 'showToast', 'showToast' => 'showToast', 'showAToast' => 'showToast'];

    public function mount()
    {
        // Initialize from flash session if present (login/logout etc.)
        if (session()->has('success')) {
            $this->message = session('success');
            $this->type = 'success';
        } elseif (session()->has('error')) {
            $this->message = session('error');
            $this->type = 'error';
        } elseif (session()->has('info')) {
            $this->message = session('info');
            $this->type = 'info';
        }
    }

    public function showToast($message, $type = 'success')
    {
        $this->message = $message;
        $this->type = $type;
    }

    public function dismiss()
    {
        $this->message = null;
    }
    public function render()
    {
        return view('livewire.alerts.toast');
    }
}
