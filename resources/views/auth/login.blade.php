<x-guest-layout>
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="login">
        <img src="{{ asset('images/profile.svg') }}" alt="Logo">

        <form method="POST" action="{{ route('login') }}" class="form" style="width:100%">
            @csrf

            <input type="email" name="email" placeholder="Email"
                   value="{{ old('email') }}" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" />

            <input type="password" name="password" placeholder="Password"
                   required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" />

            <button type="submit" class="login-btn">{{ __('Log in') }}</button>

            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}">
                   <button type="button" class="register-btn">{{ __('Forgot your password?') }}</button>
                </a>
            @endif

            @if (Route::has('register'))
                <a href="{{ route('register') }}">
                    <button type="button" class="register-btn">{{ __('Create account') }}</button>
                </a>
            @endif
        </form>
    </div>
</x-guest-layout>