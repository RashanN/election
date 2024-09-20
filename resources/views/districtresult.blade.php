<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prediction Page</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Luckiest+Guy&display=swap" rel="stylesheet">
    <style>
        body {
            background-image: url('img/bg.jpg'); /* Replace with your background image */
            background-size: cover;
            background-position: center;
        }<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Prediction Page</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <link href="https://fonts.googleapis.com/css2?family=Luckiest+Guy&display=swap" rel="stylesheet">

    <style>

        body {

            background-image: url('img/bg.jpg'); /* Replace with your background image */

            background-size: cover;

            background-position: center;

        }



        @media (max-width: 768px) {

            body {

                background-image: url('img/bg.jpg'); /* Use the same image for mobile, or adjust as needed */

            }

        }



     



        .logout-button {

            display: none; /* Initially hidden */

        }



        .logout-button.visible {

            display: block; /* Show when visible class is added */

        }



        @media (max-width: 768px) {

            .chart-label {

                font-size: 10px; /* Reduce font size on mobile */

                white-space: normal; /* Allow wrapping */

                word-wrap: break-word; /* Break long words */

            }

        }



    </style>

</head>

<body class="flex items-center justify-center">

    <div class="absolute top-0 bottom-0 bg-black bg-opacity-30 text-white w-full sm:w-[20rem] md:w-[28rem] lg:w-[36rem] h-auto rounded-lg overflow-hidden shadow-lg">

        <div class="flex justify-between items-center bg-black py-4 px-6">

            <div class="text-white font-bold text-lg md:text-2xl">

                <img src="img/logo w.gif" alt="Logo" class="w-32 md:w-40 h-auto">

            </div>



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



        <!-- Main Content -->

        <div style="font-family: 'Luckiest Guy', cursive; letter-spacing: 1px;">
    <div class="mt-8 p-4 md:p-6 flex flex-col items-center">
        <h1 class="text-xl md:text-2xl font-bold mb-4 text-center">District Results</h1>

        @if ($data->isEmpty())
            <p class="text-white text-center">No results available yet.</p>
        @else
        <div class="w-full md:w-[90%] mb-4 p-2 rounded-lg shadow-lg bg-black bg-opacity-25">
            
        <canvas id="myBarChart" class="w-full" style="height: 250px;"></canvas>
        </div>
        <div class="mt-4 text-center">
            <a href="{{ route('dashboard') }}" class="bg-pink-500 text-white py-2 px-6 rounded-lg shadow-lg hover:bg-pink-600 transition-colors duration-300">
               Next
            </a>
        </div>
        @endif

    </div>
        
<!-- Bar Chart Script -->

<script>

const chartLabels = @json($data->pluck('party_name'));

const chartData = @json($data->pluck('count'));



const ctx = document.getElementById('myBarChart').getContext('2d');

const myBarChart = new Chart(ctx, {

    type: 'bar',

    data: {

        labels: chartLabels,

        datasets: [{

            label: 'Votes/Predictions',

            data: chartData,

            backgroundColor: [

                '#b51d94',

                '#f2d729',

                '#FFB500',

                '#850713',

                '#209915'

            ],

            borderWidth: 1

        }]

    },

    options: {

        indexAxis: 'y', // This makes the bars horizontal

        scales: {

            x: {

                beginAtZero: true,

                ticks: {

                    color: '#FFFFFF', // Change the color of x-axis labels (numbers)

                }

            },

            y: {

                ticks: {

                    color: '#FFFFFF', // Change the color of y-axis labels (party names)

                    font: {

                        size: window.innerWidth < 768 ? 10 : 14 // Adjust font size for mobile

                    }

                }

            }

        },

        plugins: {

            legend: {

                labels: {

                    color: '#FFFFFF', // Legend text color

                }

            }

        },

        responsive: true, // Ensures the chart is responsive

        maintainAspectRatio: false // Allows chart resizing

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
        
 

</body>
</html
