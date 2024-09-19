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
    const loginTypeSelect = document.getElementById('login_type'); // Dropdown element
    const loginLabel = document.getElementById('login-label'); // Target the login label

    // Add event listener for the dropdown change event
    loginTypeSelect.addEventListener('change', function() {
        const selectedValue = loginTypeSelect.value;

        // Update the label text based on the selected option
        if (selectedValue === 'email') {
            loginLabel.innerHTML = 'Email Address'; // Update label for Email
        } else if (selectedValue === 'phone') {
            loginLabel.innerHTML = 'Phone Number'; // Update label for Phone
        }
    });

    // Trigger the change event on page load to set the initial label value
    loginTypeSelect.dispatchEvent(new Event('change'));
});
document.addEventListener('DOMContentLoaded', function() {
        const loginTypeSelect = document.getElementById('login_type'); // Dropdown element
        const loginLabel = document.getElementById('login-label'); // Login label
        const loginInput = document.getElementById('login'); // The input field
        const validationMessage = document.getElementById('validation-message'); // For displaying validation messages

        // Function to restrict input for phone numbers
        function restrictPhoneInput(event) {
            const selectedValue = loginTypeSelect.value;

            // Only allow numbers and the "+" sign for phone input
            if (selectedValue === 'phone') {
                const key = event.key;

                // Allow numbers, backspace, delete, arrow keys, and "+" only at the start
                if (!/^\d$/.test(key) && key !== '+' && key !== 'Backspace' && key !== 'Delete' && key !== 'ArrowLeft' && key !== 'ArrowRight') {
                    event.preventDefault(); // Prevent invalid key presses
                }

                // Ensure the "+" sign is only allowed as the first character
                if (key === '+' && loginInput.value.length > 0) {
                    event.preventDefault(); // Prevent "+" if it's not the first character
                }
            }
        }

        // Add event listener for the dropdown change event
        loginTypeSelect.addEventListener('change', function() {
            const selectedValue = loginTypeSelect.value;

            // Update the label text based on the selected option
            if (selectedValue === 'email') {
                loginLabel.innerHTML = 'Email Address'; // Update label for Email
                loginInput.setAttribute('placeholder', 'Enter your email'); // Set placeholder for email
                loginInput.value = ''; // Reset the input value
                loginInput.removeEventListener('keypress', restrictPhoneInput); // Remove phone input restriction
                validationMessage.innerHTML = ''; // Clear validation message
            } else if (selectedValue === 'phone') {
                loginLabel.innerHTML = 'Phone Number'; // Update label for Phone
                loginInput.setAttribute('placeholder', 'Enter your phone number (+94)'); // Set placeholder for phone
                loginInput.value = ''; // Reset the input value
                loginInput.addEventListener('keypress', restrictPhoneInput); // Restrict input for phone
                validationMessage.innerHTML = ''; // Clear validation message
            }
        });

        // Add input validation logic
        loginInput.addEventListener('input', function() {
            const selectedValue = loginTypeSelect.value;
            const inputValue = loginInput.value;

            if (selectedValue === 'email') {
                // Email validation using regex
                const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!emailPattern.test(inputValue)) {
                    validationMessage.innerHTML = 'Please enter a valid email address.';
                } else {
                    validationMessage.innerHTML = ''; // Clear the message on valid input
                }
            } else if (selectedValue === 'phone') {
                // Phone number validation for +94 and 9 digits
                const phonePattern = /^\+94\d{9}$/;
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
