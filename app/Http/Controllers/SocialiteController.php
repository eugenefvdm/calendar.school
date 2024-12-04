<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController extends Controller
{
    use ValidatesRequests;

    public function redirect(string $provider)
    {
        $this->validateProvider($provider);

        return Socialite::driver($provider)->redirect();
    }

    public function callback(string $provider)
    {
        $this->validateProvider($provider);

        $response = Socialite::driver($provider)->user();

        $user = User::firstWhere(['email' => $response->getEmail()]);

        if ($user) {
            $user->update([$provider . '_id' => $response->getId()]);
        } else {
            $user = User::create([
                $provider . '_id' => $response->getId(),
                'name' => $response->getName(),
                'email' => $response->getEmail(),
                'password' => '',
            ]);
        }

        auth()->login($user);

        // If the authenticated user is a tenant, redirect to the first tenant's dashboard
        if ($user->tenants()->count() > 0) {
            $tenant = $user->tenants()->first(); // TODO Redirect to the last visited tenant
            return redirect()->route('filament.admin.pages.dashboard', $tenant);
        }

        return redirect()->intended(route('filament.admin.tenant.registration'));
    }

    protected function validateProvider(string $provider): array
    {
        return $this->getValidationFactory()->make(
            ['provider' => $provider],
            ['provider' => 'in:google']
        )->validate();
    }
}
