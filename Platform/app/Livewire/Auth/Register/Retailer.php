<?php

namespace App\Livewire\Auth\Register;

use Livewire\Component;

class Retailer extends Component
{
    public $name = '';
    public $email = '';
    public $phone = '';
    public $description = '';
    public $password = '';
    public $password_confirmation = '';
    public $finance_email = '';
    public $countries = [];
    public $country = '';
    public $debugOutput = '';

    public function mount(){
        // Load countries from resources/data/countries.json so the view can render the select
        $this->countries = [];
        try {
            $path = resource_path('data/countries.json');
            if (file_exists($path)) {
                $data = json_decode(file_get_contents($path), true);
                if (is_array($data)) {
                    $this->countries = $data;
                }
            }
        } catch (\Throwable $e) {
            $this->countries = [];
        }

    }

    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'phone' => 'required|string|max:30',
        'finance_email' => 'required|email',
        'country' => 'required|string|max:3',
        'description' => 'nullable|string|max:1000',
        'password' => 'required|min:6|confirmed',
    ];

    public function submit(){
        $this->validate();

        $data = [
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'finance_email' => $this->finance_email,
            'country' => $this->country,
            'description' => $this->description,
            'password' => $this->password,
            'password_confirmation' => $this->password_confirmation,
        ];

        try {
            [$success, $message] = app(\App\Services\AuthService::class)->registerRetailer($data);
        } catch (\Throwable $e) {
            $success = false;
            $message = 'Registration failed: ' . $e->getMessage();
        }

        if ($success) {
            session()->flash('success', $message);
            return redirect()->route('login');
        }

        $this->addError('register', $message);
    }

    /**
     * Helper for debugging validation from the browser. Call this via wire:click to see if Livewire validation runs.
     */
    public function testValidation()
    {
        try {
            $this->validate();
            $this->debugOutput = 'validation passed';
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Livewire will automatically send validation errors back; leave debugOutput empty
            $this->debugOutput = 'validation failed: ' . implode('; ', collect($e->validator->errors()->all())->toArray());
        }
    }

    public function render()
    {
        return view('livewire.auth.register.retailer');
    }
}
