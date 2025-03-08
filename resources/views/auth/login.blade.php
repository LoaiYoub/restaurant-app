<x-guest-layout>
    <div class="flex flex-col sm:justify-center items-center p-4 sm:p-0 bg-gradient-to-br from-amber-50 to-white">
        {{-- <div class="text-center mb-8">
             <a href="/" class="inline-flex flex-col items-center">
                <span class="text-4xl sm:text-5xl font-bold text-amber-600 mb-2">
                    Restaurant Name
                </span>
                <span class="text-sm sm:text-base text-gray-600">Authentic Dining Experience</span>
            </a>
        </div> --}}

        <div class="w-full sm:max-w-md px-6 py-8 sm:px-8 bg-white shadow-xl overflow-hidden sm:rounded-xl border border-amber-100">
            <div class="mb-8 text-center">
                <h2 class="text-2xl sm:text-3xl font-bold text-gray-800">
                    Welcome Back
                </h2>
                <p class="text-gray-600 mt-3">Please sign in to your account</p>
            </div>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf

                <!-- Email Address -->
                <div class="space-y-2">
                    <x-input-label for="email" :value="__('Email')" class="text-gray-700 text-sm font-medium" />
                    <x-text-input id="email"
                        class="block w-full px-4 py-3 rounded-lg border-gray-200 shadow-sm focus:border-amber-500 focus:ring-amber-500 transition-colors duration-200"
                        type="email"
                        name="email"
                        :value="old('email')"
                        required
                        autofocus
                        autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-1" />
                </div>

                <!-- Password -->
                <div class="space-y-2">
                    <x-input-label for="password" :value="__('Password')" class="text-gray-700 text-sm font-medium" />
                    <x-text-input id="password"
                        class="block w-full px-4 py-3 rounded-lg border-gray-200 shadow-sm focus:border-amber-500 focus:ring-amber-500 transition-colors duration-200"
                        type="password"
                        name="password"
                        required
                        autocomplete="current-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-1" />
                </div>

                <!-- Remember Me and Forgot Password -->
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between space-y-2 sm:space-y-0">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me"
                            type="checkbox"
                            name="remember"
                            class="rounded border-gray-300 text-amber-600 shadow-sm focus:ring-amber-500 transition-colors duration-200">
                        <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                    </label>

                    @if (Route::has('password.request'))
                        <a class="text-sm text-amber-600 hover:text-amber-700 transition-colors duration-200" href="{{ route('password.request') }}">
                            {{ __('Forgot password?') }}
                        </a>
                    @endif
                </div>

                <div class="space-y-4 pt-4">
                    <x-primary-button class="w-full justify-center py-3 text-base font-semibold bg-amber-600 hover:bg-amber-700 focus:bg-amber-700 active:bg-amber-800 transition-all duration-200">
                        {{ __('Sign in') }}
                    </x-primary-button>

                    <p class="text-center text-sm text-gray-600">
                        {{ __("Don't have an account?") }}
                        <a href="{{ route('register') }}" class="font-semibold text-amber-600 hover:text-amber-700 transition-colors duration-200">
                            {{ __('Register now') }}
                        </a>
                    </p>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
