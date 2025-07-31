@php
    $settings = \App\Models\Setting::find(1);
@endphp
<x-guest-layout>
    <div class="container h-100">

        <div class="d-flex justify-content-center align-items-center h-100">
            <div class="card shadow border-0 p-3">
                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')"/>

                <form method="POST" action="{{ route('login') }}">
                    <div class="text-center mb-3">
                        <img src="{{asset('public/storage/'.$settings->logo_path)}}" alt="site logo" style="width: 100px; height: auto;">
                    </div>
                    @csrf

                    <!-- Email Address -->
                    <div>
                        <x-input-label for="email" :value="__('Email')"/>
                        <x-text-input id="email" class="form-control" type="email" name="email"
                                      :value="old('email')" required autofocus autocomplete="username"/>
                        <x-input-error :messages="$errors->get('email')" class="mt-2"/>
                    </div>

                    <!-- Password -->
                    <div class="mt-4">
                        <x-input-label for="password" :value="__('Password')"/>

                        <x-text-input id="password" class="form-control"
                                      type="password"
                                      name="password"
                                      required autocomplete="current-password"/>

                        <x-input-error :messages="$errors->get('password')" class="mt-2"/>
                    </div>

                    <!-- Remember Me -->
                    <div class="block mt-4">
                        <label for="remember_me" class="inline-flex items-center">
                            <input id="remember_me" type="checkbox"
                                   class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800"
                                   name="remember">
                            <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
                        </label>
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        @if (Route::has('password.request'))
                            <a class="text-decoration-none"
                               href="{{ route('password.request') }}">
                                {{ __('Forgot your password?') }}
                            </a>
                        @endif

                        <button class="ms-3 btn btn-outline-success">
                            {{ __('Log in') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
</x-guest-layout>
