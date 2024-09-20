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
        .district-select {
    background-color: #f3f4f6;
    padding: 8px 16px;
    border: 1px solid #d1d5db;
    border-radius: 4px;
    cursor: pointer;
    color: #000;
    width: 100%;
    max-width: 300px; /* Keeps this for desktop view */
}

@media (max-width: 768px) {
    .district-select {
        font-size: 14px; /* Slightly smaller text for mobile */
        padding: 6px 12px; /* Adjust padding for mobile */
        max-width: 100%; /* Ensure full width on mobile */
    }

    select {
        width: 100%; /* Ensure select dropdown adjusts to full width */
    }
}

        </style>

</head>

<body class="flex items-center justify-center min-h-screen">
    <div class="absolute top-0 bottom-0 bg-black bg-opacity-30 text-white w-full sm:w-[24rem] md:w-[32rem] lg:w-[40rem] h-[750px] rounded-lg overflow-hidden shadow-lg">
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

        <div style="font-family: 'Luckiest Guy', cursive; letter-spacing: 1px;">

    <div class="flex flex-col items-center justify-center container mx-auto px-4 py-8">
       
            <h2 class="mt-5 text-xl font-bold mb-2">Predict Your District Winner</h2>
            
            <div class=" flex flex-col items-center form-group mb-0 mt-1">
                
                <select class="district-select" name="district" id="district" required>
                    <option value="">Select your district</option>
                    @foreach($districts as $district)
                    <option value="{{ $district->id }}" data-image="{{ $district->image }}">{{ $district->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mt-0">
                <img id="district-image" src="" alt="District Image" style="display: none; max-width: 200px; height: auto;">

            </div>

            <div class="mt-1 flex justify-center w-[100px] bg-yellow-300 hover:bg-yellow-500 text-black font-bold py-2 px-4 rounded" id="next-button" style="display: none;">
                <a  href="{{ route('districtvote.create') }}"  id="next-link">
                    Next
                </a>
            </div>
            
    </div>
    </div>
    <style>
      
    </style>
    <script>
        document.getElementById('district').addEventListener('change', function () {
            const selectedOption = this.options[this.selectedIndex];
            const imageUrl = selectedOption.getAttribute('data-image');
            console.log(imageUrl);
            
            const imageElement = document.getElementById('district-image');

            if (imageUrl) {
                imageElement.src = imageUrl;
                imageElement.style.display = 'block'; // Show the image
            } else {
                imageElement.style.display = 'none'; // Hide the image if no image URL
            }
        });

        document.getElementById('next-link').addEventListener('click', function (event) {
            event.preventDefault(); // Prevent default link behavior

            // Get the selected district value
            const districtId = document.getElementById('district').value;

            if (districtId) {
                window.location.href = "{{ route('districtvote.create') }}" + "?district=" + districtId;
            } else {
                alert('Please select a district before proceeding.');
            }
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const usernameButton = document.getElementById('username');
            const logoutButton = document.getElementById('logoutButton');

            usernameButton.addEventListener('click', function(event) {
                // Prevent the click event from propagating to the document
                event.stopPropagation();
                // Toggle visibility of the logout button
                logoutButton.classList.toggle('visible');
            });

            document.addEventListener('click', function(event) {
                // Hide the logout button if clicking outside of it
                if (!logoutButton.contains(event.target) && !usernameButton.contains(event.target)) {
                    logoutButton.classList.remove('visible');
                }
            });
        });
    </script>
    <script>
        document.getElementById('district').addEventListener('change', function () {
    const selectedOption = this.options[this.selectedIndex];
    const imageUrl = selectedOption.getAttribute('data-image');
    const districtId = this.value;
    
    const imageElement = document.getElementById('district-image');
    const nextButton = document.getElementById('next-button');

    // Show or hide the district image
    if (imageUrl) {
        imageElement.src = imageUrl;
        imageElement.style.display = 'block'; // Show the image
    } else {
        imageElement.style.display = 'none'; // Hide the image if no image URL
    }

    // Show the "Next" button only if a valid district is selected
    if (districtId) {
        nextButton.style.display = 'flex'; // Show the button
    } else {
        nextButton.style.display = 'none'; // Hide the button if no selection
    }
});

        </script>


</body>
</html>
