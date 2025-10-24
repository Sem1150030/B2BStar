<?php
namespace App\Services;

use App\Models\Retailer;
use App\Models\User;
use App\RoleTypes;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AuthService
{
    /**
     * Handle user login logic
     */
    public function login(Request $request)
    {
        // Validate incoming credentials
        $validated = $request->validate([
            'email' => ['required','email'],
            'password' => ['required','string','min:6'],
        ]);

        $credentials = [
            'email' => $validated['email'],
            'password' => $validated['password'],
        ];

        $remember = $request->boolean('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();
            return [true, 'Logged in successfully.'];
        }

        return [false, 'Invalid email or password.'];
    }

    public function registerRetailer(array $data)
    {
        try {
            DB::transaction(function () use ($data) {
                $brand = Retailer::create([
                    'business_name' => $data['name'],
                    'email' => $data['email'],
                    'phone' => $data['phone'],
                    'finance_email' => $data['finance_email'],
                    'description' => $data['description'] ?? null,
                    'country' => $data['country'] ?? null,
                ]);

                User::create([
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'password' => bcrypt($data['password']),
                    'role_type' => RoleTypes::BRAND->value,
                    'role_id' => $brand->id,
                ]);
            });

            return [true, 'Registration successful!'];


        } catch (\Exception $e) {
            return [false, 'Failed to create brand: ' . $e->getMessage()];
        }


    }

    public function registerBrand(array $data)
    {
        try {
            $brand = \App\Models\Brand::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'phone' => $data['phone'],
                'finance_email' => $data['finance_email'],
                'motto' => $data['motto'] ?? null,
                'description' => $data['description'] ?? null,
            ]);
        } catch (\Exception $e) {
            return [false, 'Failed to create brand: ' . $e->getMessage()];
        }

        if (!$brand || !$brand->id) {
            return [false, 'Brand creation failed.'];
        }

        try {
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => bcrypt($data['password']),
                'role_type' => RoleTypes::BRAND->value,
                'role_id' => $brand->id,
            ]);
        } catch (\Exception $e) {
            $brand->delete();
            return [false, 'Failed to create user: ' . $e->getMessage()];
        }

        if (!$user || !$user->id) {
            $brand->delete();
            return [false, 'User creation failed.'];
        }
        return [true, 'Registration successful!'];
    }
}
