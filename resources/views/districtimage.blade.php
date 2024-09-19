<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="container mx-auto px-4 py-8">
       
            <h2 class="text-2xl font-bold mb-6">Make Your District Predictions</h2>
            
            <div class="form-group">
                <label for="district">Select Your District</label>
                <select name="district" id="district" required>
                    <option value="">Select your district</option>
                    @foreach($districts as $district)
                        <option value="{{ $district->id }}">{{ $district->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mt-4">
                <a href="{{ route('districtvote.create') }}"  id="next-link">
                    Next
                </a>
            </div>
            
    </div>

    <style>
      
    </style>
    <script>
        document.getElementById('next-link').addEventListener('click', function (event) {
            event.preventDefault(); // Prevent default link behavior

            // Get the selected district value
            const districtId = document.getElementById('district').value;
            console.log(districtId);
            
            if (districtId) {
                // Redirect to the next page with the selected district as a query parameter
                window.location.href = "{{ route('districtvote.create') }}" + "?district=" + districtId;
            } else {
                alert('Please select a district before proceeding.');
            }
        });
    </script>
</x-app-layout>