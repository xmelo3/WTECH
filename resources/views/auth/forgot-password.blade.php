<x-guest-layout>
    <div class="login">
        <x-auth-session-status :status="session('status')" />

        <form method="POST" action="{{ route('password.email') }}" class="form" style="width:100%">
            @csrf

            <input type="email" name="email" placeholder="Email"
                   value="{{ old('email') }}" required autofocus />
            <x-input-error :messages="$errors->get('email')" />

            <button type="submit" class="login-btn">{{ __('Reset Password') }}</button>

            <a href="{{ route('login') }}">
                <button type="button" class="register-btn">{{ __('Back to login') }}</button>
            </a>
        </form>
    </div>
</x-guest-layout>