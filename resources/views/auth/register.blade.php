<x-guest-layout>
    <div class="login">
        <img src="{{ asset('images/profile.svg') }}" alt="Logo">

        <form method="POST" action="{{ route('register') }}" class="form" style="width:100%">
            @csrf

            <input type="text" name="name" placeholder="Name"
                   value="{{ old('name') }}" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" />

            <input type="email" name="email" placeholder="Email"
                   value="{{ old('email') }}" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" />

            <input type="password" name="password" placeholder="Password"
                   required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" />

            <input type="password" name="password_confirmation" placeholder="Confirm Password"
                   required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" />

            <button type="submit" class="login-btn">{{ __('Register') }}</button>

            <a href="{{ route('login') }}">
                <button type="button" class="register-btn">{{ __('Already registered?') }}</button>
            </a>
        </form>
    </div>
</x-guest-layout>