<!DOCTYPE html>
<html lang="en">
<head>
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
    <title>Prediction Page</title>
    <link href="https://fonts.googleapis.com/css2?family=Luckiest+Guy&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            background-image: url('img/bg.jpg'); /* Replace with your background image */
            background-size: cover;
            background-position: center;
        }

        @media (max-width: 768px) {
            body {
                background-image: url('img/bg2.jpg'); /* Replace with your mobile background image */
            }
        }

        
        .logout-button {
                display: none; /* Initially hidden */
            }

        .logout-button.visible {
                display: block; /* Show when visible class is added */
        }
        </style>
        <style>
        .district-select{
            background-color: #FFFFFF;
            padding: 8px 16px;
            border: 1px solid #d1d5db;
            border-radius: 4px;
            cursor: pointer;
            color: #000;
            width: 100%;
            max-width: 300px;
        }
        .district-selected::after {
            content: '\25BC'!important; /* Downward arrow symbol */
            position: absolute;
            right: 10px; /* Distance from the right */
            top: 50%; /* Vertically center the arrow */
            transform: translateY(-50%);
            font-size: 12px;
            color: #000;
            pointer-events: none; /* Ensure arrow doesn't affect interactions */
        }
        
        .custom-select {
            position: relative;
            width: 100%;
            max-width: 300px;
            color:#000;
        }
        .select-selected {
            background-color: #FFFFFF;
            padding: 8px 16px;
            border: 1px solid #d1d5db;
            border-radius: 4px;
            cursor: pointer;
            color:#000;
            position: relative;
        }
        .select-selected::after {
            content: '\25BC'; /* Downward arrow symbol */
            position: absolute;
            right: 10px; /* Distance from the right */
            top: 50%; /* Vertically center the arrow */
            transform: translateY(-50%);
            font-size: 12px;
            color: #000;
            pointer-events: none; /* Ensure arrow doesn't affect interactions */
        }

        .select-items {
            position: absolute;
            background-color: #ffffff;
            top: 100%;
            left: 0;
            right: 0;
            z-index: 99;
            border: 1px solid #d1d5db;
            border-top: none;
            border-radius: 0 0 4px 4px;
            max-height:200px;
            overflow-y: auto;
        }
        .select-items::-webkit-scrollbar {
            width: 8px;
        }

        .select-items::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        .select-items::-webkit-scrollbar-thumb {
            background: #888;
            border-radius: 4px;
        }

        .select-items::-webkit-scrollbar-thumb:hover {
            background: #555;
        }
        .select-hide {
            display: none;
        }
        .select-items div {
            padding: 8px 16px;
            cursor: pointer;
            display: flex;
            align-items: center;
        }
        .select-items div:hover {
            background-color: #e5e7eb;
        }
        .party-logo {
            width: 300px;
            height: auto;
            margin-right: 10px;
            object-fit: contain;
        }
        .disabled-option {
            opacity: 0.5;
            pointer-events: none;
        }
        .container-wrapper {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .content {
            flex: 1;
            overflow-y: auto;
        }
    </style>
</head>

<body class="flex items-center justify-center min-h-screen">
    <div class="absolute top-0 bottom-0 bg-black bg-opacity-30 text-white w-full sm:w-[24rem] md:w-[32rem] lg:w-[40rem] h-[770px] rounded-lg overflow-hidden shadow-lg">
        <div class="flex justify-between items-center bg-black py-4 px-6">
            <div class="text-white font-bold text-lg md:text-2xl"><img src="img/logo w.gif" alt="Logo" class="w-40 h-auto"></div>
            <!-- User Name and Logout -->
            <div class="relative flex items-center">
                <div style="font-family: 'Luckiest Guy', cursive; letter-spacing: 1px;" class="text-white text-xs md:text-sm cursor-pointer mr-4" id="username">
                    {{ Auth::user()->name }}
                </div>

                <!-- Logout Button (hidden by default) -->
                <div id="logoutButton" class="logout-button absolute right-0 top-full mt-2 bg-black bg-opacity-75 p-2 rounded-lg shadow-lg transform scale-95 transition-transform duration-300 ease-in-out">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button style="font-family: 'Luckiest Guy', cursive; letter-spacing: 1px;" type="submit" class="text-sm text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:ring-red-300 px-4 py-2 rounded-lg transition-all duration-300 ease-in-out">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div class="mb-3 text-center">
                <img src="img/title/9.png" alt="District Level Predictions" class="mx-auto w-64 sm:w-64 md:w-64 lg:w-80 xl:w-80 h-auto  " />
        </div>>

         <div style="font-family: 'Luckiest Guy', cursive; letter-spacing: 1px; marging: top 10px; text-align: center;">
              <h3>National</h3>
         </div>

        <div style="font-family: 'Luckiest Guy', cursive; letter-spacing: 1px;">

        @if($lastNationalVotes->isNotEmpty())
    @foreach($lastNationalVotes as $vote)
        <!-- Dynamic Prediction Preview for each vote -->
        <div class="flex flex-col items-center form-group mb-6">
            <div class="custom-select">
                <div class="flex items-center">
                    <img src="{{ $vote->party->logo ?? 'default-logo.png' }}" alt="Party Logo" >
                   
                </div>
            </div>
        </div>
    @endforeach
@else
    <p class="text-center">No votes available for preview.</p>
@endif

    </div>
    <div style="font-family: 'Luckiest Guy', cursive; letter-spacing: 1px; marging: top 10px;text-align: center;">
    <h3>{{$districtName }}</h3>
         </div>

    <div style="font-family: 'Luckiest Guy', cursive; letter-spacing: 1px; ">

        @if($lastDistrictVotes->isNotEmpty())
        @foreach($lastDistrictVotes as $vote)
        <!-- Dynamic Prediction Preview for each vote -->
        <div class="flex flex-col items-center form-group mb-6">
            <div class="custom-select">
                <div class="flex items-center">
                    <img src="{{ $vote->party->logo ?? 'default-logo.png' }}" alt="Party Logo" >
                
                </div>
            </div>
        </div>
        @endforeach
        @else
        <p class="text-center">No votes available for preview.</p>
        @endif

</div>
<div class="absolute mb-5 w-full text-center mt-6 ">
    <a href="{{ route('dashboard') }}" class="bg-pink-500 text-white py-2 px-6 rounded-lg shadow-lg hover:bg-pink-600 transition-colors duration-300">
        See Overall Predictions
    </a>
</div>

</div>
    <script>
   
    
    </script>



</body>
</html>
