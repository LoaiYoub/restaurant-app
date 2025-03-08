<x-guest-layout>
    <div class="flex flex-col sm:justify-center items-center p-4 sm:p-0 bg-gradient-to-br from-amber-50 to-white">

        <div class="w-full sm:max-w-md px-6 py-8 sm:px-8 bg-white shadow-xl overflow-hidden sm:rounded-xl border border-amber-100">
            <div class="mb-8 text-center">
                <h2 class="text-2xl sm:text-3xl font-bold text-gray-800">
                    Create Account
                </h2>
                <p class="text-gray-600 mt-3">Join us for a delightful experience</p>
            </div>

            <form method="POST" action="{{ route('register') }}" class="space-y-6">
                @csrf

                <!-- Name -->
                <div class="space-y-2">
                    <x-input-label for="name" :value="__('Name')" class="text-gray-700 text-sm font-medium" />
                    <x-text-input id="name"
                        class="block w-full px-4 py-3 rounded-lg border-gray-200 shadow-sm focus:border-amber-500 focus:ring-amber-500 transition-colors duration-200"
                        type="text"
                        name="name"
                        :value="old('name')"
                        required
                        autofocus
                        autocomplete="name" />
                    <x-input-error :messages="$errors->get('name')" class="mt-1" />
                </div>

                <!-- Email Address -->
                <div class="space-y-2">
                    <x-input-label for="email" :value="__('Email')" class="text-gray-700 text-sm font-medium" />
                    <x-text-input id="email"
                        class="block w-full px-4 py-3 rounded-lg border-gray-200 shadow-sm focus:border-amber-500 focus:ring-amber-500 transition-colors duration-200"
                        type="email"
                        name="email"
                        :value="old('email')"
                        required
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
                        autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-1" />
                </div>

                <!-- Confirm Password -->
                <div class="space-y-2">
                    <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="text-gray-700 text-sm font-medium" />
                    <x-text-input id="password_confirmation"
                        class="block w-full px-4 py-3 rounded-lg border-gray-200 shadow-sm focus:border-amber-500 focus:ring-amber-500 transition-colors duration-200"
                        type="password"
                        name="password_confirmation"
                        required
                        autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1" />
                </div>

                <div class="space-y-4 pt-4">
                    <x-primary-button class="w-full justify-center py-3 text-base font-semibold bg-amber-600 hover:bg-amber-700 focus:bg-amber-700 active:bg-amber-800 transition-all duration-200">
                        {{ __('Create Account') }}
                    </x-primary-button>

                    <p class="text-center text-sm text-gray-600">
                        {{ __('Already have an account?') }}
                        <a href="{{ route('login') }}" class="font-semibold text-amber-600 hover:text-amber-700 transition-colors duration-200">
                            {{ __('Sign in') }}
                        </a>
                    </p>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
