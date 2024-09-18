<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div>
        <body>
            <div class="container mx-auto px-4 py-8">
                <h1 class="text-2xl font-bold mb-4">National Voting Results</h1>
              {{-- {{dd($data)}} --}}
                @if ($data->isEmpty())
                    <p>No results available yet.</p>
                @else
                    
            <table>
        <thead>
            <tr>
                <th>Rank</th>
                <th>Party Name</th>
                <th>Vote Count</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $index => $result)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $result['party_name'] }}</td>
                    <td>{{ $result['count'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    

                @endif

            </div>
        </body>
    </div>
</x-app-layout>
