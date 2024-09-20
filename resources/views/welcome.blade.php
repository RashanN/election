<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Page</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Luckiest+Guy&display=swap" rel="stylesheet">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        /* Background images for different devices */
        body {
            background-image: url('/img/bg.jpg'); /* Adjust path as needed */
            background-size: cover;
            background-position: center;
        }

        @media (max-width: 768px) {
            body {
                background-image: url('/img/bg.jpg'); /* Adjust path as needed */
            }
        }

        /* Footer style */
        .footer {
            position: absolute;
            bottom: 0;
            width: 100%;
            text-align: center;
            padding: 10px;
            color: rgb(0, 0, 0);
            font-size: 12px;
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center font-sans antialiased dark:bg-black dark:text-white/50">
<div style="font-family: 'Luckiest Guy', cursive; letter-spacing: 1px;">
    <!-- Main container -->
    <div class="w-full sm:w-[20rem] md:w-[24rem] lg:w-[28rem] h-auto rounded-lg flex flex-col items-center justify-center p-6">

        <!-- Logo section -->
        <div class="mb-8 flex justify-center">
            <img src="/img/logo.png" alt="Logo" class="w-100 h-auto">
        </div>

        <!-- Button container -->
        <div class="w-full flex flex-col items-center space-y-4">

            <!-- Login Button -->
            <a href="{{ route('login') }}" class="w-full bg-red-600 text-white font-semibold py-2 px-4 rounded hover:bg-red-700 uppercase text-center">
                LOGIN
            </a>

            <!-- Register Button -->
            <a href="{{ route('register') }}" class="w-full bg-white text-black font-semibold py-2 px-4 rounded hover:bg-gray-100 uppercase text-center">
                REGISTER
            </a>

            

            <form method="POST" action="{{ route('guest.login') }}" class="w-full bg-black text-white font-semibold py-2 px-4 rounded hover:bg-gray-800 uppercase text-center">
                            @csrf
                    <button type="submit">
                            LOGIN AS  GUEST
                    </button>
            </form>

        </div>

    </div>


    </div>
</body>
</html>
