<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf
        @method('POST')

        <input type="text" name="role_di" value={{ $roleId }} hidden>

         <!-- Username -->
         <div>
            <x-input-label for="username" :value="__('Username')" />
            <x-text-input 
            id="username" 
            class="block mt-1 w-full" 
            type="text" 
            name="username" 
            :value="old('username')" 
            placeholder="Your username..."
            required 
            autofocus 
            autocomplete="username" 
            />
            <x-input-error :messages="$errors->get('username')" class="mt-2" />
        </div>

        <!-- Name -->
        <div class="mt-4">
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input 
            id="name" 
            class="block mt-1 w-full" 
            type="text" 
            name="name" 
            :value="old('name')"
            placeholder="Your fullname..." 
            required 
            autofocus 
            autocomplete="name" 
            />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input 
            id="email" 
            class="block mt-1 w-full" 
            type="email" 
            name="email" 
            :value="old('email')" 
            placeholder="Your email address..."
            required 
            autofocus 
            autocomplete="email" 
            />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

         <!-- Phone number -->
         <div class="mt-4">
            <x-input-label for="phone_number" :value="__('PhoneNumber')" />
            <x-text-input 
            id="phone_number" 
            class="block mt-1 w-full" 
            type="text" 
            name="phone_number" 
            :value="old('phone_number')" 
            placeholder="Your phone number..."
            required 
            autofocus 
            />
            <x-input-error :messages="$errors->get('phone_number')" class="mt-2" />
        </div>

         <!-- Address -->
         <div class="mt-4">
            <x-input-label for="address" :value="__('Address')" />
            <textarea 
            id="address" 
            class="
            block 
            p-2.5 
            mt-1 
            w-full
            bg-gray-900
            border-gray-700 
            focus:border-green-500
            focus:ring-green-500
            rounded-md 
            shadow-sm
            " 
            type="text" 
            name="address" 
            :value="old('address')" 
            placeholder="Your full address..."
            required autofocus></textarea>
            <x-input-error :messages="$errors->get('address')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            placeholder="******"
                            required 
                            autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" 
                            placeholder="******"
                            required 
                            autocomplete="new-password" 
                            />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="
            block
            p-1.5
            underline 
            text-sm 
            text-gray-100 
            hover:text-gray-300 
            rounded-md 
            focus:outline-none 
            focus:ring-2 
            focus:ring-offset-2 
            focus:ring-green-500" 
            href="{{ route('login') }}"
            >
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
