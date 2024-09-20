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
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Luckiest+Guy&display=swap" rel="stylesheet">
    <style>
        body {
            background-image: url('img/bg.jpg'); /* Replace with your background image */
            background-size: cover;
            background-position: center;
        }

        @media (max-width: 768px) {
            body {
                background-image: url('img/bg.jpg'); /* Replace with your mobile background image */
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
        .custom-select {
            position: relative;
            width: 100%;
            max-width: 300px;
        }
        .select-selected {
            background-color: #ffffff;
            padding: 8px 16px;
            border: 1px solid #d1d5db;
            border-radius: 4px;
            cursor: pointer;
            color:#000;
            
        }
        .select-selected::after {
            content: '\25BC'; /* Downward arrow */
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 12px;
            color: #000;
            pointer-events: none;
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
    </style>
</head>

<body class="flex items-center justify-center min-h-screen">
    <div class="absolute top-0 bottom-0 bg-black bg-opacity-30 text-white w-full sm:w-[24rem] md:w-[32rem] lg:w-[40rem] h-auto rounded-lg overflow-hidden shadow-lg">
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
    
    <div class="mt-10 flex flex-col items-center justify-center container mx-auto px-4 py-8">
            <form action="{{route('nationalvote.store')}}" method="POST">
                @csrf
                <h2 class="text-2xl font-bold mb-6 text-center">National Level Predictions</h2>

                <!-- 1st Prediction -->
                <div class="mt-10 flex flex-col items-center form-group mb-6">
                    
                    <div class="custom-select" id="first-prediction-select"></div>
                    <input type="hidden" name="first_prediction" id="first-prediction-input">
                </div>

                <!-- 2nd Prediction -->
                <div class="flex flex-col items-center form-group mb-6">
                    
                    <div class="custom-select" id="second-prediction-select"></div>
                    <input type="hidden" name="second_prediction" id="second-prediction-input">
                </div>

                <!-- 3rd Prediction -->
                <div class="flex flex-col items-center form-group mb-6">
                    
                    <div class="custom-select" id="third-prediction-select"></div>
                    <input type="hidden" name="third_prediction" id="third-prediction-input">
                </div>

                <div class="mt-2 w-full flex justify-center">
                    <button type="submit" class="w-[300px] bg-yellow-300 hover:bg-yellow-500 text-black font-bold py-2 px-4 rounded">
                        Submit
                    </button>
                </div>

                </div>

            </form>
        </div>
    </div>
    </div>

    <script>
    const parties = @json($parties);
    const selectElements = ['first-prediction-select', 'second-prediction-select', 'third-prediction-select'];
    const inputElements = ['first-prediction-input', 'second-prediction-input', 'third-prediction-input'];
    const defaultLabels = ['1<sup>st</sup> Predicted Winner', '2<sup>nd</sup> Predicted Winner', '3<sup>rd</sup> Predicted Winner'];

    function createCustomSelect(elementId, inputId, defaultLabel) {
        const selectContainer = document.getElementById(elementId);
        const hiddenInput = document.getElementById(inputId);

        const selected = document.createElement('div');
        selected.setAttribute('class', 'select-selected');
        selected.innerHTML = defaultLabel; // Use the provided default label
        selectContainer.appendChild(selected);

        const optionsDiv = document.createElement('div');
        optionsDiv.setAttribute('class', 'select-items select-hide');
        const optionsWrapper = document.createElement('div');
        optionsWrapper.style.maxHeight = '200px'; // Match the max-height in CSS
        optionsWrapper.style.overflowY = 'auto';


        parties.forEach(party => {
            const option = document.createElement('div');
            option.setAttribute('data-value', party.id);
            option.innerHTML = `
                <img src="${party.logo}" alt="${party.name}" class="party-logo">  
            `;
            option.addEventListener('click', function(e) {
                selected.innerHTML = this.innerHTML;
                hiddenInput.value = party.id;
                optionsDiv.classList.add('select-hide');
                updateAllDropdowns();
            });
            optionsDiv.appendChild(option);
        });

        selectContainer.appendChild(optionsDiv);

        selected.addEventListener('click', function(e) {
            e.stopPropagation();
            closeAllSelect(this);
            optionsDiv.classList.toggle('select-hide');
        });
    }

    function closeAllSelect(elmnt) {
        const selectItems = document.getElementsByClassName('select-items');
        const selectSelected = document.getElementsByClassName('select-selected');
        for (let i = 0; i < selectSelected.length; i++) {
            if (elmnt != selectSelected[i]) {
                selectSelected[i].classList.remove('active');
            }
        }
        for (let i = 0; i < selectItems.length; i++) {
            if (elmnt != selectSelected[i]) {
                selectItems[i].classList.add('select-hide');
            }
        }
    }

    function updateAllDropdowns() {
        const selectedValues = inputElements.map(id => document.getElementById(id).value);

        selectElements.forEach((selectId, index) => {
            const currentSelect = document.getElementById(selectId);
            const options = currentSelect.querySelectorAll('.select-items div');

            options.forEach(option => {
                const optionValue = option.getAttribute('data-value');
                if (selectedValues.includes(optionValue) && optionValue !== selectedValues[index]) {
                    option.classList.add('disabled-option');
                } else {
                    option.classList.remove('disabled-option');
                }
            });
        });
    }

    document.addEventListener('DOMContentLoaded', (event) => {
        selectElements.forEach((selectId, index) => {
            createCustomSelect(selectId, inputElements[index], defaultLabels[index]);
        });

        document.addEventListener('click', closeAllSelect);
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



</body>
</html>