<x-guest-layout>
    <x-slot:title>Login</x-slot:title>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="space-y-4">
            <div>
                <label for="email" class="form-label">Email</label>
                <input id="email" type="email" name="email" :value="old('email')" required autofocus placeholder="your@email.com"
                    class="modern-input">
                <x-input-error :messages="$errors->get('email')" class="mt-2 text-xs text-red-600" />
            </div>

            <div>
                <label for="password" class="form-label">Password</label>
                <input id="password" type="password" name="password" required placeholder="........"
                    class="modern-input">
                <x-input-error :messages="$errors->get('password')" class="mt-2 text-xs text-red-600" />
            </div>

            <!-- Remember Me -->
            <div class="flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <label for="remember_me" class="ml-2 text-sm text-gray-700">Remember me</label>
            </div>

            <button type="submit" class="modern-button">
                Sign In
            </button>
        </div>
    </form>

    <div class="text-center mt-6">
        @if (Route::has('password.request'))
            <a class="switch-link text-sm" href="{{ route('password.request') }}">
                Forgot your password?
            </a>
        @endif
        <p class="text-xs font-semibold text-gray-700 mt-4">
            Don't have an account?
            <a href="{{ route('register') }}" class="switch-link ml-1">Sign up</a>
        </p>
    </div>
</x-guest-layout>
