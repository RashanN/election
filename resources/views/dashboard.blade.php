<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div>
            <form action="{{ route('nationalvote.store') }}" method="POST">
                <h2>Make Your Predictions</h2>
                <div class="form-group">
                    <label for="first-prediction">1st Prediction</label>
                    <select name="first_prediction" id="first-prediction" required>
                        <option value="">Select your first prediction</option>
                        @foreach($parties as $party)
                        <option value="{{ $party->id }}">{{ $party->name }}</option>
                    @endforeach
                    </select>
                </div>
        
                <div class="form-group">
                    <label for="second-prediction">2nd Prediction</label>
                    <select name="second_prediction" id="second-prediction" required>
                        <option value="">Select your second prediction</option>
                        <option value="Prediction 1">Prediction 1</option>
                        <option value="Prediction 2">Prediction 2</option>
                        <option value="Prediction 3">Prediction 3</option>
                    </select>
                </div>
        
                <div class="form-group">
                    <label for="third-prediction">3rd Prediction</label>
                    <select name="third_prediction" id="third-prediction" required>
                        <option value="">Select your third prediction</option>
                        <option value="Prediction 1">Prediction 1</option>
                        <option value="Prediction 2">Prediction 2</option>
                        <option value="Prediction 3">Prediction 3</option>
                    </select>
                </div>
                <div>
                <button type="submit">Submit Predictions</button>
            </div>
            </form>
    </div>
</x-app-layout>
