<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="container mx-auto px-4 py-8">
        <h2 class="text-2xl font-bold mb-6">Make Your District Predictions</h2>
        
        <div class="form-group">
            <label for="district" class="block mb-2 font-bold">Select Your District</label>
            <select name="district" id="district" class="w-full p-2 border rounded" required>
                <option value="">Select your district</option>
                @foreach($districts as $district)
                <option value="{{ $district->id }}" data-image="{{ $district->image }}">{{ $district->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mt-6">
            <img id="district-image" src="" alt="District Image" class="hidden max-w-full h-auto">
        </div>
        <div class="mt-4">
            <a href="{{ route('districtvote.create') }}" id="next-link" class="inline-block px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                Next
            </a>
        </div>
    </div>

    <script>
        const districtSelect = document.getElementById('district');
        const imageElement = document.getElementById('district-image');
        const nextLink = document.getElementById('next-link');

        districtSelect.addEventListener('change', function () {
            const selectedOption = this.options[this.selectedIndex];
            const imageUrl = selectedOption.getAttribute('data-image');
            console.log(imageUrl);
            
            if (imageUrl) {
                imageElement.src = imageUrl;
                imageElement.classList.remove('hidden');
            } else {
                imageElement.classList.add('hidden');
            }
        });

        nextLink.addEventListener('click', function (event) {
            event.preventDefault();
            const districtId = districtSelect.value;
            if (districtId) {
                window.location.href = "{{ route('districtvote.create') }}" + "?district=" + districtId;
            } else {
                alert('Please select a district before proceeding.');
            }
        });
    </script>
</x-app-layout>