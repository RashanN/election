<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="container mx-auto px-4 py-8">
        <form action="{{route('nationalvote.store')}}" method="POST">
            @csrf
            <h2 class="text-2xl font-bold mb-6">Make Your Predictions</h2>

            <!-- 1st Prediction -->
            <div class="form-group mb-6">
                <label for="first-prediction" class="block mb-2">1st Prediction</label>
                <div class="custom-select" id="first-prediction-select"></div>
                <input type="hidden" name="first_prediction" id="first-prediction-input">
            </div>

            <!-- 2nd Prediction -->
            <div class="form-group mb-6">
                <label for="second-prediction" class="block mb-2">2nd Prediction</label>
                <div class="custom-select" id="second-prediction-select"></div>
                <input type="hidden" name="second_prediction" id="second-prediction-input">
            </div>

            <!-- 3rd Prediction -->
            <div class="form-group mb-6">
                <label for="third-prediction" class="block mb-2">3rd Prediction</label>
                <div class="custom-select" id="third-prediction-select"></div>
                <input type="hidden" name="third_prediction" id="third-prediction-input">
            </div>

            <div>
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Submit
                </button>
            </div>
        </form>
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
    const parties = @json($parties);
    const selectElements = ['first-prediction-select', 'second-prediction-select', 'third-prediction-select'];
    const inputElements = ['first-prediction-input', 'second-prediction-input', 'third-prediction-input'];

    function createCustomSelect(elementId, inputId) {
        const selectContainer = document.getElementById(elementId);
        const hiddenInput = document.getElementById(inputId);

        const selected = document.createElement('div');
        selected.setAttribute('class', 'select-selected');
        selected.innerHTML = 'Select your prediction';
        selectContainer.appendChild(selected);

        const optionsDiv = document.createElement('div');
        optionsDiv.setAttribute('class', 'select-items select-hide');

        parties.forEach(party => {
            const option = document.createElement('div');
            option.setAttribute('data-value', party.id);
            option.innerHTML = `
                <img src="${party.logo}" alt="${party.name}" class="party-logo">
              
            `;
            option.addEventListener('click', function(e) {
                selected.innerHTML = this.innerHTML;
                hiddenInput.value = party.id;
                optionsDiv.classList.add('select-hide');
                updateAllDropdowns();
            });
            optionsDiv.appendChild(option);
        });

        selectContainer.appendChild(optionsDiv);

        selected.addEventListener('click', function(e) {
            e.stopPropagation();
            closeAllSelect(this);
            optionsDiv.classList.toggle('select-hide');
        });
    }

    function closeAllSelect(elmnt) {
        const selectItems = document.getElementsByClassName('select-items');
        const selectSelected = document.getElementsByClassName('select-selected');
        for (let i = 0; i < selectSelected.length; i++) {
            if (elmnt != selectSelected[i]) {
                selectSelected[i].classList.remove('active');
            }
        }
        for (let i = 0; i < selectItems.length; i++) {
            if (elmnt != selectSelected[i]) {
                selectItems[i].classList.add('select-hide');
            }
        }
    }

    function updateAllDropdowns() {
        const selectedValues = inputElements.map(id => document.getElementById(id).value);

        selectElements.forEach((selectId, index) => {
            const currentSelect = document.getElementById(selectId);
            const options = currentSelect.querySelectorAll('.select-items div');

            options.forEach(option => {
                const optionValue = option.getAttribute('data-value');
                if (selectedValues.includes(optionValue) && optionValue !== selectedValues[index]) {
                    option.classList.add('disabled-option');
                } else {
                    option.classList.remove('disabled-option');
                }
            });
        });
    }

    document.addEventListener('DOMContentLoaded', (event) => {
        selectElements.forEach((selectId, index) => {
            createCustomSelect(selectId, inputElements[index]);
        });

        document.addEventListener('click', closeAllSelect);
    });
    </script>
</x-app-layout>