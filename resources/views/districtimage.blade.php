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
        .custom-select {
            position: relative;
            width: 100%;
            max-width: 300px;
        }
        .select-selected {
            background-color: #f3f4f6;
            padding: 8px 16px;
            border: 1px solid #d1d5db;
            border-radius: 4px;
            cursor: pointer;
        }
        .select-items {
            position: absolute;
            background-color: #f9fafb;
            top: 100%;
            left: 0;
            right: 0;
            z-index: 99;
            border: 1px solid #d1d5db;
            border-top: none;
            border-radius: 0 0 4px 4px;
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
            width: 30px;
            height: 30px;
            margin-right: 10px;
            object-fit: contain;
        }
        .disabled-option {
            opacity: 0.5;
            pointer-events: none;
        }
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