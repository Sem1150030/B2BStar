<?php

namespace App\Livewire\Auth\Register;

use Livewire\Component;

class Brand extends Component
{
    public $name = '';
    public $email = '';
    public $phone = '';
    public $finance_email = '';
    public $motto = '';
    public $description = '';
    public $password = '';
    public $password_confirmation = '';

    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'phone' => 'required|string|max:30',
        'finance_email' => 'required|email',
        'motto' => 'nullable|string|max:100',
        'description' => 'nullable|string|max:1000',
        'password' => 'required|min:6|confirmed',
    ];

    public function register()
    {
        $this->validate();
        // Registration logic here (e.g., create user, assign brand role)
        // User::create([...]);
        session()->flash('success', 'Registration successful!');
        // Optionally redirect or reset form
    }

    public function render()
    {
        return view('livewire.auth.register.brand');
    }
}
