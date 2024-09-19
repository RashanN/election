<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <body>
        <div class="container mx-auto px-4 py-8">
            <h1 class="text-2xl font-bold mb-4">National Voting Results</h1>
          {{-- {{dd($data)}} --}}
            @if ($data->isEmpty())
                <p>No results available yet.</p>
            @else
                
            <div class="mb-6">
                <h3 class="text-center text-md md:text-lg font-semibold mb-2">Predictions Bar Chart</h3>
                <canvas id="myBarChart"></canvas>
            </div>
            
            <!-- Bar Chart Script -->
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

            <script>
                // Replace the static chartLabels and chartData with dynamic ones if needed.
                const chartLabels = @json($data->pluck('party_name'));  // Dynamically from Laravel data
                const chartData = @json($data->pluck('count'));         // Dynamically from Laravel data
            
                const ctx = document.getElementById('myBarChart').getContext('2d');
                const myBarChart = new Chart(ctx, {
                    type: 'bar',  // Horizontal bar chart
                    data: {
                        labels: chartLabels,  // Dynamic party names
                        datasets: [{
                            label: '# of Votes/Predictions',
                            data: chartData,  // Dynamic vote counts
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(153, 102, 255, 0.2)'
                            ],
                            borderColor: [
                                'rgba(255, 99, 132, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(153, 102, 255, 1)'
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        indexAxis: 'y', // Horizontal bars
                        scales: {
                            x: {
                                beginAtZero: true,
                                ticks: {
                                    color: '#FFFFFF', 
                                }
                            },
                            y: {
                                ticks: {
                                    color: '#FFFF00', // Y-axis label color (party names)
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
                        animation: {
                            duration: 1500,  // 1.5 second animation
                            easing: 'easeOutBounce',  // Animation easing effect
                            onProgress: function(animation) {  
                                console.log('Animation in progress:', animation.currentStep);
                            },
                            onComplete: function() {
                                console.log('Animation complete');
                            }
                        }
                    }
                });
            </script>
            

            @endif

        </div>
    </body>
</x-app-layout>
