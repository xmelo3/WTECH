<form method="POST" action="{{ route('logout') }}">
    @csrf
    <button type="submit" class="nav-btn">{{ __('Log Out') }}</button>
</form>