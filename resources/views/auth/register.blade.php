<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Page</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Luckiest+Guy&display=swap" rel="stylesheet">
    <style>
        body {
            background-image: url('/img/bg.jpg');
            background-size: cover;
            background-position: center;
        }
        .footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            text-align: center;
            padding: 10px;
            color: rgb(0, 0, 0);
            font-size: 12px;
        }
    </style>
</head>
<body class="font-sans text-gray-900 antialiased min-h-screen flex items-center justify-center">
<div style="font-family: 'Luckiest Guy', cursive; letter-spacing: 1px;">
    <div class="w-full sm:w-[20rem] md:w-[24rem] lg:w-[28rem] h-auto rounded-lg flex flex-col items-center justify-center p-6">
        <div class="mb-8">
            <a href="/">
                <img src="/img/logo b.gif" alt="Logo" class="w-80 h-auto">
            </a>
        </div>
   
        <form method="POST" action="{{ route('register') }}" class="w-full flex flex-col items-center">
            @csrf
            
            <div class="w-full mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                <input id="name" class="w-full bg-white border border-gray-300 rounded px-4 py-2 text-gray-700 focus:outline-none focus:ring-2 focus:ring-black" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name">
                @error('name')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>

            <div class="w-full mb-4">
                <label for="login_type" class="block text-sm font-medium text-gray-700">Register with</label>
                <select id="login_type" name="login_type" class="w-full bg-white border border-gray-300 rounded px-4 py-2 text-gray-700 focus:outline-none focus:ring-2 focus:ring-black">
                    <option value="email">Email</option>
                    <option value="phone">Phone</option>
                </select>
            </div>

            <div class="w-full mb-4">
                <label id="login-label" for="login" class="block text-sm font-medium text-gray-700">Email or Phone</label>
                <input id="login" class="w-full bg-white border border-gray-300 rounded px-4 py-2 text-gray-700 focus:outline-none focus:ring-2 focus:ring-black" type="text" name="login" value="{{ old('login') }}" required>
                <span id="validation-message" class="text-red-500 text-xs"></span>
                @error('login')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>

            <div class="w-full mb-4">
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input id="password" class="w-full bg-white border border-gray-300 rounded px-4 py-2 text-gray-700 focus:outline-none focus:ring-2 focus:ring-black" type="password" name="password" required autocomplete="new-password">
                @error('password')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>

            <div class="w-full mb-4">
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password</label>
                <input id="password_confirmation" class="w-full bg-white border border-gray-300 rounded px-4 py-2 text-gray-700 focus:outline-none focus:ring-2 focus:ring-black" type="password" name="password_confirmation" required autocomplete="new-password">
                @error('password_confirmation')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>

            <div class="w-full flex items-center justify-between mt-4">
                <a href="{{ route('login') }}" class="text-sm text-gray-600 hover:text-gray-900 underline">Already registered?</a>
                <button type="submit" class="bg-red-600 text-white font-semibold py-2 px-4 rounded hover:bg-red-700 uppercase">
                    Register
                </button>
            </div>
        </form>
    </div>

  

    <script>
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
                    if (loginInput.value.length >= 12 && key !== 'Backspace' && key !== 'Delete' && key !== 'ArrowLeft' && key !== 'ArrowRight') {
                        event.preventDefault();
                    }
                }
            }

            loginTypeSelect.addEventListener('change', function() {
                const selectedValue = loginTypeSelect.value;
                if (selectedValue === 'email') {
                    loginLabel.innerHTML = 'Email';
                    loginInput.setAttribute('placeholder', 'Enter your email');
                    loginInput.value = '';
                    loginInput.removeEventListener('keypress', restrictPhoneInput);
                    validationMessage.innerHTML = '';
                } else if (selectedValue === 'phone') {
                    loginLabel.innerHTML = 'Mobile';
                    loginInput.setAttribute('placeholder', 'Enter your phone number');
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
                    validationMessage.innerHTML = !emailPattern.test(inputValue) ? 'Please enter a valid email address.' : '';
                } else if (selectedValue === 'phone') {
                    const phonePattern = /^0\d{9}$/;
                    validationMessage.innerHTML = !phonePattern.test(inputValue) ? 'Phone number must start with 0 and contain exactly 10 digits.' : '';
                }
            });

            loginTypeSelect.dispatchEvent(new Event('change'));
        });
    </script>
</div>
</body>
</html>

