<x-guest-layout>
    <!-- Error Alert -->
    @if ($errors->any())
        <div style="background-color: #7f1d1d; padding: 1rem; margin-bottom: 1rem; border-left: 4px solid #dc2626; border-radius: 0.25rem;">
            <h3 style="color: #fca5a5; font-size: 0.875rem; font-weight: bold; margin-bottom: 0.5rem;">
                ⚠️ Registration Error
            </h3>
            <ul style="list-style-type: disc; list-style-position: inside; color: #fee2e2; font-size: 0.875rem;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full @error('name') border-red-500 @enderror" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            @error('name')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full @error('email') border-red-500 @enderror" type="email" name="email" :value="old('email')" required autocomplete="username" />
            @error('email')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full @error('password') border-red-500 @enderror"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            @error('password')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full @error('password_confirmation') border-red-500 @enderror"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            @error('password_confirmation')
                <p class="mt-1 text-sm text-red-600">The passwords do not match. Please enter the same password in both fields.</p>
            @enderror
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
