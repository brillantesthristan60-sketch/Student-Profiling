<x-guest-layout>
    <x-slot:title>Register</x-slot:title>

    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="space-y-4">
            <div>
                <label for="name" class="form-label">Full Name</label>
                <input id="name" type="text" name="name" :value="old('name')" required autofocus placeholder="Your Name"
                    class="modern-input">
                <x-input-error :messages="$errors->get('name')" class="mt-2 text-xs text-red-600" />
            </div>

            <div>
                <label for="email" class="form-label">Email</label>
                <input id="email" type="email" name="email" :value="old('email')" required placeholder="your@email.com"
                    class="modern-input">
                <x-input-error :messages="$errors->get('email')" class="mt-2 text-xs text-red-600" />
            </div>

            <div>
                <label for="password" class="form-label">Password</label>
                <input id="password" type="password" name="password" required placeholder="........"
                    class="modern-input">
                <x-input-error :messages="$errors->get('password')" class="mt-2 text-xs text-red-600" />
            </div>

            <div>
                <label for="password_confirmation" class="form-label">Confirm Password</label>
                <input id="password_confirmation" type="password" name="password_confirmation" required placeholder="........"
                    class="modern-input">
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-xs text-red-600" />
            </div>

            <button type="submit" class="modern-button">
                Create Account
            </button>
        </div>
    </form>

    <div class="text-center mt-6">
        <p class="text-xs font-semibold text-gray-700">
            Already have an account?
            <a href="{{ route('login') }}" class="switch-link ml-1">Login</a>
        </p>
    </div>
</x-guest-layout>
