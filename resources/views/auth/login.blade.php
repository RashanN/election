<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Luckiest+Guy&display=swap" rel="stylesheet">
    <style>
        /* Background image */
        body {
            background-image: url('/img/bg.jpg'); /* Adjust path as needed */
            background-size: cover;
            background-position: center;
        }

        
    </style>
</head>

<body  class="font-sans text-gray-900 antialiased min-h-screen flex items-center justify-center">
<div style="font-family: 'Luckiest Guy', cursive; letter-spacing: 1px;">
    <!-- Main container -->
    <div class="w-full sm:w-[20rem] md:w-[24rem] lg:w-[28rem] h-auto rounded-lg flex flex-col items-center justify-center p-6">

        <!-- Logo section -->
        <div class="mb-8">
            <a href="/">
                <img src="/img/logo.png" alt="Logo" class="w-80 h-auto">
            </a>
        </div>

        <!-- Login Form -->
        <form method="POST" action="/login" class="w-full flex flex-col items-center">
            <!-- CSRF Token -->
            <input type="hidden" name="_token" value="{{ csrf_token() }}">

            <!-- Email or Phone -->
            <div class="w-full mb-4">
                <label for="login" class="block text-sm font-medium text-gray-700">Email or Phone</label>
                <input id="login" class="w-full bg-white border border-gray-300 rounded px-4 py-2 text-gray-700 focus:outline-none focus:ring-2 focus:ring-black uppercase" type="text" name="login" required autofocus>
                <!-- Placeholder for error messages -->
                <!-- Adjust styling as needed -->
            </div>

            <!-- Password -->
            <div class="w-full mb-4">
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input id="password" class="w-full bg-white border border-gray-300 rounded px-4 py-2 text-gray-700 focus:outline-none focus:ring-2 focus:ring-black uppercase" type="password" name="password" required autocomplete="current-password">
                <!-- Placeholder for error messages -->
                <!-- Adjust styling as needed -->
            </div>

            <!-- Remember Me -->
            <div class="block mb-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                    <span class="ms-2 text-sm text-gray-600">Remember me</span>
                </label>
            </div>

            <!-- Submit Button -->
            <!-- <div class="w-full flex items-center justify-between mt-4">
                <a href="/password/reset" class="text-sm text-gray-600 hover:text-gray-900 underline">Forgot your password?</a>
                <button type="submit" class="bg-red-600 text-white font-semibold py-2 px-4 rounded hover:bg-red-700 uppercase">
                    Log in
                </button>
            </div> -->
        </form>

    </div>

    
<div>
</body>
</html>
