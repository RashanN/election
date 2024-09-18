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
            
           

            <!-- 1st Prediction -->
            <div class="form-group">
                <label for="first-1prediction">1st Prediction</label>
                <select name="first_prediction" id="1prediction" required>
                    <option value="">Select your first prediction</option>
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
                        <option value="{{ $party->id }}">{{ $party->name }}</option>
                    @endforeach
                </select>
            </div>
    
            <!-- 3rd Prediction -->
            <div class="form-group">
                <label for="third-prediction">3rd Prediction</label>
                <select name="third_prediction" id="3prediction" required>
                    <option value="">Select your third prediction</option>
                    @foreach($parties as $party)
                        <option value="{{ $party->id }}">{{ $party->name }}</option>
                    @endforeach
                </select>
            </div>
    
            <div>
                <button type="submit">Submit </button>
            </div>
        </form>
    </div>
    
    <script>
      
        const firstPrediction = document.getElementById('1prediction');
        const secondPrediction = document.getElementById('2prediction');
        const thirdPrediction = document.getElementById('3prediction');
    
       
        function updateDropdowns() {
           
            const selectedFirst = firstPrediction.value;
            const selectedSecond = secondPrediction.value;
    
          
            filterOptions(secondPrediction, selectedFirst);
            filterOptions(thirdPrediction, selectedFirst, selectedSecond);
        }
    
        
        function filterOptions(dropdown, ...selectedValues) {
            const options = dropdown.querySelectorAll('option');
    
            options.forEach(option => {
                if (selectedValues.includes(option.value)) {
                    option.style.display = 'none';  
                } else {
                    option.style.display = 'block'; 
                }
            });
        }
    
       
        firstPrediction.addEventListener('change', updateDropdowns);
        secondPrediction.addEventListener('change', updateDropdowns);
    </script>
    
</x-app-layout>
