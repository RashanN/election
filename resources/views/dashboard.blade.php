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
</head>
<body class="flex items-center justify-center min-h-screen">
    <div class="absolute top-0 bottom-0 bg-black bg-opacity-30 text-white w-full sm:w-[24rem] md:w-[32rem] lg:w-[40rem] h-[800px] rounded-lg overflow-hidden shadow-lg">
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
        <div class="mt-2 p-1 md:p-1 flex flex-col items-center">
            

        <!-- <div class="mt-0 flex flex-col items-center form-group mb-3"> 
                <div class="form-group">
                    <h2 class="display-4 text-3xl font-weight-bold text-primary">National</h2>
                </div>
        </div> -->
        <div class="mb-3 text-center">
                <img src="img/title/11.png" alt="District Level Predictions" class="mx-auto w-64 sm:w-64 md:w-64 lg:w-80 xl:w-80 h-auto  " />
        </div>

            @if ($data->isEmpty())
                <p class="text-white text-center">No results available yet.</p>
            @else
                <div class="w-full md:w-[90%] mb-4 p-2 rounded-lg shadow-lg bg-black bg-opacity-25">
                    
                    <canvas id="myBarChart" style="width: 100%; height: 150px;"></canvas>
                </div>
    </div>
    <div class="mt-0 p-1 md:p-1 flex flex-col items-center">
        <div class="mt-0 flex flex-col items-center form-group mb-3"> 
                <div class="form-group">
                    <h3 class="display-4 text-3xl font-weight-bold text-primary">Actual National Results</h3>
                </div>
        </div>
        <!-- <div class="mb-3 text-center">
                <img src="img/title/1.png" alt="District Level Predictions" class="mx-auto w-64 sm:w-64 md:w-64 lg:w-80 xl:w-80 h-auto  " />
        </div> -->

        @if ($data->isEmpty())
            <p>No results available yet.</p>
        @else
        <div class="w-full md:w-[90%] mb-4 p-2 rounded-lg shadow-lg bg-black bg-opacity-25">
            
        <canvas id="myDistrictBarChart" style="width: 100%; height: 150px;"></canvas>
        </div>
        @endif

        
        <div class="mt-3 text-center">
        <a href="{{ route('result') }}" class="bg-pink-500 text-white py-2 px-6 rounded-lg shadow-lg hover:bg-pink-600 transition-colors duration-300">
        View My Prediction
        </a>
        </div>
        <div class="mt-4 mb-8 text-center">
                <img src="img/title/10.png" alt="District Level Predictions" class="mx-auto w-full h-auto  " />
        </div>
    </div>
                <!-- Bar Chart Script -->
                <script>
                   // Script for myBarChart (National Voting Results)
const nationalChartLabels = @json($data->pluck('party_name'));
const nationalChartData = @json($data->pluck('count'));

const nationalCtx = document.getElementById('myBarChart').getContext('2d');
const myBarChart = new Chart(nationalCtx, {
    type: 'bar',
    data: {
        labels: nationalChartLabels,
        datasets: [{
            label: 'Winner Prediction %',
            data: nationalChartData,
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
        indexAxis: 'y',
        scales: {
            x: {
                beginAtZero: true,
                ticks: {
                    color: '#FFFFFF',
                }
            },
            y: {
                ticks: {
                    color: '#FFFFFF',
                }
            }
        },
        plugins: {
            legend: {
                labels: {
                    color: '#FFFFFF',
                    boxWidth:0,
                }
            },
            tooltip: {
                callbacks: {
                    label: function(tooltipItem) {
                        const value = tooltipItem.raw; // Get the percentage value
                        return value + '%'; // Append percentage mark
                    }
                }
            }
        },
        animation: {
            duration: 1500,
            easing: 'easeOutBounce',
        }
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
    const districtChartLabels = @json($data1->pluck('party_name'));
    console.log(districtChartLabels);
const districtChartData = @json($data1->pluck('count'));
console.log(districtChartData);
const districtCtx = document.getElementById('myDistrictBarChart').getContext('2d');
const myDistrictBarChart = new Chart(districtCtx, {
    type: 'bar',
    data: {
        labels: districtChartLabels,
        datasets: [{
            label: 'Winner Prediction %',
            data: districtChartData,
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
        indexAxis: 'y',
        scales: {
            x: {
                beginAtZero: true,
                ticks: {
                    color: '#FFFFFF',
                }
            },
            y: {
                ticks: {
                    color: '#FFFFFF',
                }
            }
        },
        plugins: {
            legend: {
                labels: {
                    color: '#FFFFFF',
                    boxWidth:0,
                }
            },
            tooltip: {
                callbacks: {
                    label: function(tooltipItem) {
                        const value = tooltipItem.raw; // Get the percentage value
                        return value + '%'; // Append percentage mark
                    }
                }
            }
        },
        animation: {
            duration: 1500,
            easing: 'easeOutBounce',
        }
    }
});

</script>

                
                     @endif
                </div>



</body>
</html>