<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prediction Page</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            background-image: url('img/bg.jpg'); /* Replace with your background image */
            background-size: cover;
            background-position: center;
        }

        @media (max-width: 768px) {
            body {
                background-image: url('img/bg.jpg'); /* Replace with your mobile background image */
            }
        }

        .footer {
            position: absolute;
            bottom: 0;
            width: 100%;
            text-align: center;
            padding: 10px;
            color: rgb(255, 255, 255);
            font-size: 12px;
        }

        select {
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            background: none;
        }

        .dropdown-selected {
            width: 300px;
            padding: 10px;
            background-color: #fff;
            color: black;
            border: 2px solid #ccc;
            cursor: pointer;
            text-align: center;
            border-radius: 0.5rem;
            position: relative;
        }

        .dropdown-selected::after {
            content: "";
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            border-width: 5px;
            border-style: solid;
            border-color: black transparent transparent transparent;
        }

        .dropdown-options {
            display: none;
            position: absolute;
            background-color: #fff;
            border: 1px solid #ccc;
            width: 300px;
            z-index: 10;
            max-height: 200px;
            overflow-y: auto;
            top: 100%;
            left: 0;
            border-radius: 0.5rem;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            transform: translateX(-50%);
            left: 50%;
        }

        .dropdown-container {
            position: relative;
            display: inline-block;
            width: 300px;
        }

        .dropdown-options img {
            width: 100%;
            height: auto;
            padding: 3px;
            cursor: pointer;
        }

        .dropdown-selected img {
            height: 50px;
            width: auto;
        }

        .dropdown-container.open .dropdown-options {
            display: block;
        }

        @media (max-width: 768px) {
            .dropdown-selected img {
                height: 50px;
            }

            .dropdown-options img {
                padding: 5px;
                height: 60px;
                width: auto;
            }
        }
    </style>
</head>


<body class="flex items-center justify-center">
    <div class="absolute top-0 bottom-0 bg-black bg-opacity-50 text-white w-full sm:w-[24rem] md:w-[32rem] lg:w-[40rem] h-auto rounded-lg overflow-hidden shadow-lg">
        <div class="flex justify-between items-center bg-black py-4 px-6">
            <div class="text-white font-bold text-lg md:text-2xl"><img src="img/logo-2.png" alt="Logo" class="w-40 h-auto"></div>
            <div class="text-white text-xs md:text-sm">{{ Auth::user()->name }}</div>
        </div>

        <div class="p-4 md:p-6 flex flex-col items-center">
            <h2 class="text-center text-md md:text-lg font-semibold mb-4">Make Your District Predictions</h2>

            <form action="{{route('districtvote.store')}}" method="POST" class="flex flex-col">
                @csrf

                <!-- Select District -->
                <div class="dropdown-container mb-4">
                    
                    <div class="dropdown-selected">
                        <select name="district" id="district" required class="w-full text-center">
                            <option value="">Select your district</option>
                            @foreach($districts as $district)
                                <option value="{{ $district->id }}">{{ $district->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- 1st Prediction -->
                <div class="dropdown-container mb-4" id="dropdownContainer1">
                    
                    <div class="dropdown-selected" id="dropdownSelected1">
                        <span id="selectedText1">Select 1st Prediction</span>
                        <img src="https://via.placeholder.com/350x100" id="selectedImage1" style="display: none;" alt="Select a Candidate">
                    </div>
                    <div class="dropdown-options" id="dropdownOptions1">
                        @foreach($parties as $party)
                            <img src="{{ asset('img/drop/' . $party->id . '.png') }}" alt="{{ $party->name }}" data-value="{{ $party->id }}">
                        @endforeach
                    </div>
                </div>

                <!-- 2nd Prediction -->
                <div class="dropdown-container mb-4" id="dropdownContainer2">
                    
                    <div class="dropdown-selected" id="dropdownSelected2">
                        <span id="selectedText2">Select 2nd Prediction</span>
                        <img src="https://via.placeholder.com/350x100" id="selectedImage2" style="display: none;" alt="Select a Candidate">
                    </div>
                    <div class="dropdown-options" id="dropdownOptions2">
                        @foreach($parties as $party)
                            <img src="{{ asset('img/drop/' . $party->id . '.png') }}" alt="{{ $party->name }}" data-value="{{ $party->id }}">
                        @endforeach
                    </div>
                </div>

                <!-- 3rd Prediction -->
                <div class="dropdown-container mb-4" id="dropdownContainer3">
                    
                    <div class="dropdown-selected" id="dropdownSelected3">
                        <span id="selectedText3">Select 3rd Prediction</span>
                        <img src="https://via.placeholder.com/350x100" id="selectedImage3" style="display: none;" alt="Select a Candidate">
                    </div>
                    <div class="dropdown-options" id="dropdownOptions3">
                        @foreach($parties as $party)
                            <img src="{{ asset('img/drop/' . $party->id . '.png') }}" alt="{{ $party->name }}" data-value="{{ $party->id }}">
                        @endforeach
                    </div>
                </div>

                <div class="mt-6 text-center">
                    <button type="submit" class="bg-yellow-300 hover:bg-blue-700 text-black font-bold py-2 px-10 rounded">Submit</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        const dropdownContainers = [
            {containerId: 'dropdownContainer1', selectedId: 'dropdownSelected1', optionsId: 'dropdownOptions1', imageId: 'selectedImage1', textId: 'selectedText1'},
            {containerId: 'dropdownContainer2', selectedId: 'dropdownSelected2', optionsId: 'dropdownOptions2', imageId: 'selectedImage2', textId: 'selectedText2'},
            {containerId: 'dropdownContainer3', selectedId: 'dropdownSelected3', optionsId: 'dropdownOptions3', imageId: 'selectedImage3', textId: 'selectedText3'}
        ];

        let selectedImages = [];

        function handleDropdown(dropdown) {
            const dropdownContainer = document.getElementById(dropdown.containerId);
            const dropdownSelected = document.getElementById(dropdown.selectedId);
            const dropdownOptions = document.getElementById(dropdown.optionsId);
            const selectedImage = document.getElementById(dropdown.imageId);
            const selectedText = document.getElementById(dropdown.textId);

            dropdownSelected.addEventListener('click', () => {
                closeAllDropdowns(dropdown.containerId);
                dropdownContainer.classList.toggle('open');
            });

            dropdownOptions.querySelectorAll('img').forEach(option => {
                option.addEventListener('click', (event) => {
                    const selectedSrc = event.target.src;
                    const selectedAlt = event.target.alt;

                    selectedImage.src = selectedSrc;
                    selectedImage.alt = selectedAlt;
                    selectedImage.style.display = 'block';
                    selectedText.style.display = 'none';

                    dropdownContainer.classList.remove('open');
                    selectedImages[dropdown.containerId] = selectedSrc;

                    updateDropdownOptions();
                });
            });
        }

        function closeAllDropdowns(exceptContainerId) {
            dropdownContainers.forEach(dropdown => {
                if (dropdown.containerId !== exceptContainerId) {
                    document.getElementById(dropdown.containerId).classList.remove('open');
                }
            });
        }

        function updateDropdownOptions() {
            dropdownContainers.forEach(dropdown => {
                const dropdownOptions = document.getElementById(dropdown.optionsId);
                dropdownOptions.querySelectorAll('img').forEach(option => {
                    if (Object.values(selectedImages).includes(option.src)) {
                        option.style.display = 'none';
                    } else {
                        option.style.display = 'block';
                    }
                });
            });
        }

        dropdownContainers.forEach(dropdown => {
            handleDropdown(dropdown);
        });
    </script>

</body>
</html>