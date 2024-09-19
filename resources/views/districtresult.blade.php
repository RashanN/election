<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('District Results') }}
        </h2>
    </x-slot>

    <div class="container mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold mb-4">District Voting Results</h1>

        @if ($data->isEmpty())
            <p>No results available yet.</p>
        @else
        <div class="mb-6">
            <h3 class="text-center text-md md:text-lg font-semibold mb-2">Predictions Bar Chart</h3>
            <h3 class="text-center text-md md:text-lg font-semibold mb-2"></h3>
            <canvas id="myBarChart"></canvas>
        </div>
        @endif
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Extracting data from the Blade variables
    const chartLabels = @json($data->pluck('party_name'));
    const chartData = @json($data->pluck('count'));

    const ctx = document.getElementById('myBarChart').getContext('2d');
    const myBarChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: chartLabels,
            datasets: [{
                label: '# of Votes/Predictions',
                data: chartData,
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
            indexAxis: 'y', // This makes the bars horizontal
            scales: {
                x: {
                    beginAtZero: true,
                    ticks: {
                        color: '#000', // Change the color of x-axis labels (numbers)
                    }
                },
                y: {
                    ticks: {
                        color: '#000', // Change the color of y-axis labels (names like Anura Kumara)
                    }
                }
            },
            plugins: {
                legend: {
                    labels: {
                        color: '#000', // Change the color of the legend text
                    }
                }
            },
            // Animation settings for the bar chart
            animation: {
                duration: 1500,  // Animation duration in milliseconds
                easing: 'easeOutBounce',  // Easing function for the animation
                onProgress: function(animation) {  // Animation in-progress callback
                    console.log('Animation in progress:', animation.currentStep);
                },
                onComplete: function() {  // Animation complete callback
                    console.log('Animation complete');
                }
            }
        }
    });
</script>
        <div class="mt-4">
            <a href="{{ route('dashboard') }}" >
                Next
            </a>
        </div>
    </div>
</x-app-layout>
