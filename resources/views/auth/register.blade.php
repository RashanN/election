<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Page</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            background-image: url('/img/bg.jpg'); /* Adjust path as needed */
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

    <!-- Main container -->
    <div class="w-full sm:w-[20rem] md:w-[24rem] lg:w-[28rem] h-auto rounded-lg flex flex-col items-center justify-center p-6">

        <!-- Logo section -->
        <div class="mb-8">
            <a href="/">
                <img src="/img/logo.png" alt="Logo" class="w-80 h-auto">
            </a>
        </div>

        <!-- Register Form -->
        <form method="POST" action="{{ route('register') }}" class="w-full flex flex-col items-center">
            @csrf

            <!-- Name -->
            <div class="w-full mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                <input id="name" class="w-full bg-white border border-gray-300 rounded px-4 py-2 text-gray-700 focus:outline-none focus:ring-2 focus:ring-black" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name">
                @error('name')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>

            <!-- Register with Email or Phone -->
            <div class="w-full mb-4">
                <label for="login_type" class="block text-sm font-medium text-gray-700">Register with</label>
                <select id="login_type" name="login_type" class="w-full bg-white border border-gray-300 rounded px-4 py-2 text-gray-700 focus:outline-none focus:ring-2 focus:ring-black">
                    <option value="email">Email</option>
                    <option value="phone">Phone</option>
                </select>
            </div>

            <!-- Email or Phone -->
            <div class="w-full mb-4">
                <label for="login" class="block text-sm font-medium text-gray-700">Email or Phone</label>
                <input id="login" class="w-full bg-white border border-gray-300 rounded px-4 py-2 text-gray-700 focus:outline-none focus:ring-2 focus:ring-black" type="text" name="login" value="{{ old('login') }}" required>
                @error('login')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>

            <!-- Password -->
            <div class="w-full mb-4">
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input id="password" class="w-full bg-white border border-gray-300 rounded px-4 py-2 text-gray-700 focus:outline-none focus:ring-2 focus:ring-black" type="password" name="password" required autocomplete="new-password">
                @error('password')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>

            <!-- Confirm Password -->
            <div class="w-full mb-4">
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password</label>
                <input id="password_confirmation" class="w-full bg-white border border-gray-300 rounded px-4 py-2 text-gray-700 focus:outline-none focus:ring-2 focus:ring-black" type="password" name="password_confirmation" required autocomplete="new-password">
                @error('password_confirmation')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>

            <!-- Submit Button -->
            <div class="w-full flex items-center justify-between mt-4">
                <a href="{{ route('login') }}" class="text-sm text-gray-600 hover:text-gray-900 underline">Already registered?</a>
                <button type="submit" class="bg-red-600 text-white font-semibold py-2 px-4 rounded hover:bg-red-700 uppercase">
                    Register
                </button>
            </div>
        </form>
    </div>

    <!-- Footer -->
    <div class="footer">
        &copy; All Rights Reserved.
    </div>

</body>
</html>
