<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    
    <div>
        
        <form action="{{route('nationalvote.store')}}" method="POST">
            @csrf
            <h2>Make Your  Predictions</h2>
            
           {{-- {{dd($parties)}} --}}

            <!-- 1st Prediction -->
            <div class="form-group">
                <label for="second-prediction">2nd Prediction</label>
                <select name="second_prediction" id="2prediction" required>
                    <option value="">Select your second prediction</option>
                    @foreach($parties as $party)
                        <option value="{{ $party->id }}">{{ $party->name }}</option>
                    @endforeach
                </select>
            </div>
    
            <!-- 2nd Prediction -->
            <div class="form-group">
                <label for="second-prediction">2nd Prediction</label>
                <select name="second_prediction" id="2prediction" required>
                    <option value="">Select your second prediction</option>
                    @foreach($parties as $party)
                        <option value="{{ $party->id }}">{{ $party->logo }}</option>
                    @endforeach
                </select>
            </div>
    
            <!-- 3rd Prediction -->
            <div class="form-group">
                <label for="third-prediction">3rd Prediction</label>
                <select name="third_prediction" id="3prediction" required>
                    <option value="">Select your third prediction</option>
                    @foreach($parties as $party)
                        <option value="{{ $party->id }}"><img src="{{$party->logo}} " alt="ghbvjh" width="50" height="50"></option>
                    @endforeach
                </select>
            </div>
    
            <div>
                <button type="submit">Submit </button>
            </div>
        </form>
    </div>
    
    <script>
      
      const dropdowns = [
  document.getElementById('1prediction'),
  document.getElementById('2prediction'),
  document.getElementById('3prediction')
];
 
function updateDropdowns() {
  const selectedValues = dropdowns.map(dropdown => dropdown.value);
 
  dropdowns.forEach((currentDropdown, index) => {
    const options = currentDropdown.querySelectorAll('option');
    
    options.forEach(option => {
      if (selectedValues.includes(option.value) && option.value !== currentDropdown.value) {
        option.disabled = true;
      } else {
        option.disabled = false;
      }
    });
  });
}
 
dropdowns.forEach(dropdown => {
  dropdown.addEventListener('change', updateDropdowns);
});
updateDropdowns();

    </script>
    
</x-app-layout>
