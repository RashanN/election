<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://fonts.googleapis.com/css2?family=Luckiest+Guy&display=swap" rel="stylesheet">
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-M91HG5WFTT"></script>
        <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-M91HG5WFTT');
        </script>

        <!-- Meta Pixel Code -->
        <script>
        !function(f,b,e,v,n,t,s)
        {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
        n.callMethod.apply(n,arguments):n.queue.push(arguments)};
        if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
        n.queue=[];t=b.createElement(e);t.async=!0;
        t.src=v;s=b.getElementsByTagName(e)[0];
        s.parentNode.insertBefore(t,s)}(window, document,'script',
        'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '1506896873263778');
        fbq('track', 'PageView');
        </script>
        <noscript><img height="1" width="1" style="display:none"
        src="https://www.facebook.com/tr?id=1506896873263778&ev=PageView&noscript=1"
        /></noscript>
        <!-- End Meta Pixel Code -->
         
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Page</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://www.google.com/recaptcha/api.js?render={{ env('GOOGLE_RECAPTCHA_KEY') }}"></script>
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
   
        <form method="POST" action="{{ route('register') }}" class="w-full flex flex-col items-center" id="contactUSForm" >
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

    {{-- <div class="footer">
        &copy; All Rights Reserved.
    </div>
       --}}
    <script type="text/javascript">
        $('#contactUSForm').submit(function(event) {
            event.preventDefault();
        
            grecaptcha.ready(function() {
                grecaptcha.execute("{{ env('GOOGLE_RECAPTCHA_KEY') }}", {action: 'register'}).then(function(token) {
                    $('#contactUSForm').prepend('<input type="hidden" name="g-recaptcha-response" value="' + token + '">');
                    $('#contactUSForm').unbind('submit').submit();
                });;
            });
        });
    </script>

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

