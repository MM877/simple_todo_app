<?php

use Illuminate\Auth\Events\Lockout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Volt\Component;

new #[Layout('components.layouts.auth')] class extends Component {
    #[Validate('required|string|email')]
    public string $email = '';

    #[Validate('required|string')]
    public string $password = '';

    public bool $remember = false;

    public function login(): void
    {
        $this->validate();
        $this->ensureIsNotRateLimited();

        if (!Auth::attempt(['email' => $this->email, 'password' => $this->password], $this->remember)) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'email' => __('auth.failed'),
            ]);
        }

        RateLimiter::clear($this->throttleKey());
        Session::regenerate();

        $this->redirectIntended(default: route('dashboard', absolute: false), navigate: true);
    }

    protected function ensureIsNotRateLimited(): void
    {
        if (!RateLimiter::tooManyAttempts($this->throttleKey(), 5)) return;

        event(new Lockout(request()));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'email' => __('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    protected function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->email) . '|' . request()->ip());
    }
};
?>

<!-- HTML View -->
<div class="max-w-md mx-auto mt-16 p-8 bg-white shadow-xl rounded-2xl space-y-8">
    <div class="text-center">
        <h1 class="text-3xl font-bold text-gray-800">{{ __('Log in to your account') }}</h1>
        <p class="mt-1 text-gray-600 text-sm">{{ __('Enter your credentials to continue.') }}</p>
    </div>

    <x-auth-session-status class="text-center text-green-600" :status="session('status')" />

    <form wire:submit="login" class="flex flex-col gap-6">
        <!-- Email Field -->
        <flux:input
            wire:model.defer="email"
            :label="__('Email address')"
            type="email"
            required
            autofocus
            autocomplete="email"
            placeholder="you@example.com"
        />

        <!-- Password Field -->
        <div class="relative">
            <flux:input
                wire:model.defer="password"
                :label="__('Password')"
                type="password"
                required
                autocomplete="current-password"
                :placeholder="__('Password')"
                viewable
            />
            @if (Route::has('password.request'))
                <flux:link 
                    class="absolute top-0 right-0 mt-1 mr-2 text-sm text-blue-600 hover:underline"
                    :href="route('password.request')" 
                    wire:navigate
                >
                    {{ __('Forgot password?') }}
                </flux:link>
            @endif
        </div>

        <!-- Remember Me -->
        <flux:checkbox 
            wire:model="remember" 
            :label="__('Remember me')" 
            class="text-sm text-gray-600"
        />

        <!-- Submit Button -->
        <div>
            <flux:button 
                variant="primary" 
                type="submit" 
                class="w-full text-lg font-semibold py-3"
            >
                {{ __('Log In') }}
            </flux:button>
        </div>
    </form>

    <!-- Register Redirect -->
    @if (Route::has('register'))
        <div class="text-center text-sm text-gray-600">
            {{ __("Don't have an account?") }}
            <flux:link :href="route('register')" wire:navigate class="text-blue-600 hover:underline">
                {{ __('Sign up') }}
            </flux:link>
        </div>
    @endif
</div>
