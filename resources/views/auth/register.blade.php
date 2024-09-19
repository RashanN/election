<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div>
            <x-input-label for="login_type" :value="__('Register with')" />
            <select id="login_type" name="login_type" class="block mt-1 w-full" required>
                <option value="email">Email</option>
                <option value="phone">Phone</option>
            </select>
        </div>

        <!-- Email or Phone Address -->
        <div class="mt-4">
            <label id="login-label" for="login">Login Type</label> <!-- This label will be updated -->
            <x-text-input id="login" class="block mt-1 w-full" type="text" name="login" :value="old('login')" required autofocus />
            <x-input-error :messages="$errors->get('login')" class="mt-2" />
        </div>
        <div id="validation-message" class="text-red-500 mt-2"></div>
        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
    const loginTypeSelect = document.getElementById('login_type'); 
    const loginLabel = document.getElementById('login-label'); 

    loginTypeSelect.addEventListener('change', function() {
            const selectedValue = loginTypeSelect.value;

            
            if (selectedValue === 'email') {
                loginLabel.innerHTML = 'Email Address'; 
            } else if (selectedValue === 'phone') {
                loginLabel.innerHTML = 'Phone Number'; 
            }
        });

        
        loginTypeSelect.dispatchEvent(new Event('change'));
    });
    document.addEventListener('DOMContentLoaded', function() {
        const loginTypeSelect = document.getElementById('login_type'); 
        const loginLabel = document.getElementById('login-label'); 
        const loginInput = document.getElementById('login'); 
        const validationMessage = document.getElementById('validation-message'); 

        
        function restrictPhoneInput(event) {
            const selectedValue = loginTypeSelect.value;

        
            if (selectedValue === 'phone') {
                const key = event.key;

                
                if (!/^\d$/.test(key) && key !== '+' && key !== 'Backspace' && key !== 'Delete' && key !== 'ArrowLeft' && key !== 'ArrowRight') {
                    event.preventDefault(); 
                }

             
                if (key === '+' && loginInput.value.length > 0) {
                    event.preventDefault(); 
                }

                // Prevent entering more than 10 characters (including "+94")
                if (loginInput.value.length >= 12 && key !== 'Backspace' && key !== 'Delete' && key !== 'ArrowLeft' && key !== 'ArrowRight') {
                    event.preventDefault(); 
                }
            }
        }

       
        loginTypeSelect.addEventListener('change', function() {
            const selectedValue = loginTypeSelect.value;

           
            if (selectedValue === 'email') {
                loginLabel.innerHTML = 'Email '; 
                loginInput.setAttribute('placeholder', 'Enter your email'); 
                loginInput.value = ''; 
                loginInput.removeEventListener('keypress', restrictPhoneInput); 
                validationMessage.innerHTML = ''; 
            } else if (selectedValue === 'phone') {
                loginLabel.innerHTML = 'Mobile'; 
                loginInput.setAttribute('placeholder', 'Enter your phone number '); 
                loginInput.value = ''; 
                loginInput.addEventListener('keypress', restrictPhoneInput); 
                validationMessage.innerHTML = ''; 
            }
        });

       
        loginInput.addEventListener('input', function() {
            const selectedValue = loginTypeSelect.value;
            const inputValue = loginInput.value;

            if (selectedValue === 'email') {
               
                const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!emailPattern.test(inputValue)) {
                    validationMessage.innerHTML = 'Please enter a valid email address.';
                } else {
                    validationMessage.innerHTML = ''; 
                }
            } else if (selectedValue === 'phone') {
                // Phone number validation for +94 and 9 digits
                const phonePattern = /^0\d{9}$/;
                if (!phonePattern.test(inputValue)) {
                    validationMessage.innerHTML = 'Phone number must start with +94 and contain exactly 9 digits.';
                } else {
                    validationMessage.innerHTML = ''; // Clear the message on valid input
                }
            }
        });

        // Trigger the change event on page load to set the initial label value
        loginTypeSelect.dispatchEvent(new Event('change'));
    });
    </script>
</x-guest-layout>
