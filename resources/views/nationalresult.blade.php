<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prediction Page</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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

        .footer {
            position: absolute;
            bottom: 0;
            width: 100%;
            text-align: center;
            padding: 10px;
            color: rgb(255, 255, 255);
            font-size: 12px;
        }
    </style>
</head>
<body class="flex items-center justify-center">
    <div class="absolute top-0 bottom-0 bg-black bg-opacity-50 text-white w-full sm:w-[24rem] md:w-[32rem] lg:w-[40rem] h-auto rounded-lg overflow-hidden shadow-lg">
        <div class="flex justify-between items-center bg-black py-4 px-6">
            <div class="text-white font-bold text-lg md:text-2xl"><img src="img/logo-2.png" alt="Logo" class="w-40 h-auto"></div>
            <div class="text-white text-xs md:text-sm">{{ Auth::user()->name }}</div>
        </div>

        <div class="p-4 md:p-6 flex flex-col items-center">
            <h2 class="text-center text-md md:text-lg font-semibold mb-4">NATIONAL LEVEL PREDICTIONS</h2>

            @if ($data->isEmpty())
                <p class="text-white text-center">No results available yet.</p>
            @else
                <div class="mb-6 p-4 rounded-lg shadow-lg">
                    
                    <canvas id="myBarChart" style="width: 100%; height: 300px;"></canvas>
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
                                    }
                                }
                            },
                            animation: {
                                duration: 1500,
                                easing: 'easeOutBounce'
                            }
                        }
                    });
                </script>

                <!-- Predict Button -->
                <div class="mt-4 text-center">
                    <a href="{{ route('districtvote.create') }}" class="bg-pink-500 text-white py-2 px-6 rounded-lg shadow-lg hover:bg-pink-600 transition-colors duration-300">
                        Predict your district winner
                    </a>
                </div>
            @endif
        </div>


    <!-- Footer -->
    <div class="footer">
        &copy; All Rights Reserved.
    </div>

</body>
</html>
