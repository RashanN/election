<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('District Results') }}
        </h2>
    </x-slot>

    <div class="container mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold mb-4">District Voting Results</h1>

        @if ($results->isEmpty())
            <p>No results available yet.</p>
        @else
            <table class="table-auto w-full border-collapse border border-gray-200">
                <thead>
                    <tr>
                        <th class="border border-gray-300 px-4 py-2">Rank</th>
                        <th class="border border-gray-300 px-4 py-2">Party Name</th>
                        <th class="border border-gray-300 px-4 py-2">Vote Count</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($results as $index => $result)
                        <tr>
                            <td class="border border-gray-300 px-4 py-2">{{ $index + 1 }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $result->party_name }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $result->count }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif

        <div class="mt-4">
           
        </div>
    </div>
</x-app-layout>
