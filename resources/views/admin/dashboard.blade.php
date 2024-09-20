<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .vote-count-container {
        margin-bottom: 30px;
        padding: 10px 0;
        border-bottom: 2px solid #f0f0f0;
        display: flex;
        flex-direction: column;
        align-items: center; /* Center content horizontally */
    }

    /* Styling the count-box */
    .count-box {
        background-color: #f5f5f5;
        padding: 15px 30px;
        border-radius: 8px;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        margin-top: 10px;
    }

        .vote-number {
            font-size: 32px;
            font-weight: bold;
            color: #007bff;
        }

        .container {
            margin-top: 50px;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f5f5f5;
        }

        h5 {
            font-size: 26px;
            font-weight: bold;
            color: #4a4a4a;
            margin-bottom: 20px;
            text-align: center;
        }

        p {
            font-size: 18px;
            text-align: center;
        }

        .table-responsive {
            max-width: 100%;
            overflow-x: auto;
            margin-top: 20px;
        }

        .table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0 15px;
        }

        .custom-table thead th {
            background-color: #007bff;
            color: #fff;
            text-align: left;
            padding: 12px;
            font-size: 18px;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
            border: none;
        }

        .custom-table tbody td {
            padding: 15px 20px;
            text-align: left;
            background-color: #fff;
            border: none;
            box-shadow: 0px 2px 8px rgba(0, 0, 0, 0.1);
        }

        .custom-table tbody tr {
            margin-bottom: 15px;
        }

        .custom-table tbody tr:hover {
            background-color: #f1f1f1;
            transition: 0.3s;
        }
      /* Center the pagination */
      .pagination {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-top: 20px;
    }

    /* Style for each pagination item (Next, Previous) */
    .pagination .page-item {
        list-style: none;
        margin: 0 10px; /* Adds space between buttons */
    }

    /* Style the pagination links */
    .pagination .page-link {
        display: block;
        padding: 10px 20px;
        font-size: 16px;
        font-weight: bold;
        text-decoration: none;
        color: #007bff; /* Default text color */
        border: 2px solid #007bff; /* Border color */
        border-radius: 50px; /* Rounded button shape */
        transition: background-color 0.3s, color 0.3s;
    }

    /* Hover effect on buttons */
    .pagination .page-link:hover {
        background-color: #007bff;
        color: #fff; /* White text on hover */
    }

    /* Disable previous/next buttons */
    .pagination .page-item.disabled .page-link {
        color: #ccc;
        border-color: #ccc;
        pointer-events: none;
    }
    </style>
</head>
<body>
    <div style="display: flex; flex-direction: row-reverse;" id="logoutButton" class="logout-button absolute right-0 top-full mt-2 bg-black bg-opacity-75 p-2 rounded-lg transform scale-95 transition-transform duration-300 ease-in-out">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button style="color:#000; background-color:red;" type="submit" class="text-sm text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:ring-red-300 px-4 py-2 rounded-lg transition-all duration-300 ease-in-out">
                Logout
            </button>
        </form>
    </div>

    <div class="container mt-5">
        {{-- <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0">Admin Dashboard</h2>
            <a href="{{ route('dashboard') }}" class="btn btn-primary">User Dashboard</a>
        </div> --}}
        <!-- Tabs Navigation -->
        <ul class="nav nav-tabs" id="orderTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link active" id="orders-tab" data-toggle="tab" href="#NationalVotes" role="tab" aria-controls="orders" aria-selected="true">National Votes</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="playtime-orders-tab" data-toggle="tab" href="#DistrictVotes" role="tab" aria-controls="playtime-orders" aria-selected="false">District Votes</a>
            </li>
        </ul>

        <!-- Tabs Content -->
        <div class="tab-content" id="orderTabsContent">
            <!-- National Votes Tab -->
            <div class="tab-pane fade show active" id="NationalVotes" role="tabpanel" aria-labelledby="orders-tab">
                <div class="d-flex justify-content-between align-items-center vote-count-container">
                    <h5>Total National Votes</h5>
                    <div class="count-box">
                        <span class="vote-number">{{ $usercount }}</span>
                    </div>
                </div>
                

                <div class="filters flex justify-between items-center my-4">
                    <form method="GET" action="{{ route('admin.dashboard') }}" class="flex space-x-4">
                        <!-- Candidate Filter -->
                        <div>
                            <label for="candidate" class="block">Filter by Candidate</label>
                            <select name="candidate" id="candidate" class="border p-2 rounded">
                                <option value="">All Candidates</option>
                                @foreach($candidates as $candidate)
                                    <option value="{{ $candidate->id }}" {{ request('candidate') == $candidate->id ? 'selected' : '' }}>
                                        {{ $candidate->candidate_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
        
                        <!-- Priority Filter -->
                        <div>
                            <label for="priority" class="block">Filter by Priority</label>
                            <select name="priority" id="priority" class="border p-2 rounded">
                                <option value="">All Priorities</option>
                                <option value="1" {{ request('priority') == '1' ? 'selected' : '' }}>1</option>
                                <option value="2" {{ request('priority') == '2' ? 'selected' : '' }}>2</option>
                                <option value="3" {{ request('priority') == '3' ? 'selected' : '' }}>3</option>
                            </select>
                        </div>
        
                        <!-- Filter Button -->
                        <div class="mt-6">
                            <button type="submit" class="bg-blue-500 text-red px-4 py-2 rounded">Filter</button>
                        </div>
                    </form>
        
                    
                    <div class="mt-6">
                        <a href="{{ route('admin.dashboard') }}" class="bg-blue-500 text-red px-4 py-2 rounded">Clear Filter</a>
                    </div>
                </div>
        


                <div class="table-responsive">
                    <table class="table custom-table">
                        <thead>
                            <tr>
                                <th>Index</th> 
                                <th>User Name</th>
                                <th>Phone</th>
                                <th>Email</th>
                                <th>Candidate Name</th>
                                <th>Priority</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($votes as $vote)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $vote->user->name }}</td>
                                <td>{{ $vote->user->phone }}</td>
                                <td>{{ $vote->user->email }}</td>
                                <td>{{ $vote->party->candidate_name }}</td>
                                <td>{{ $vote->priority }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="flex justify-center mt-4">
                        {{ $votes->links('pagination::simple-tailwind') }}
                    </div>
                    
                </div>
            </div>
                
            <!-- District Votes Tab -->
            <div class="tab-pane fade" id="DistrictVotes" role="tabpanel" aria-labelledby="playtime-orders-tab">
                <div class="d-flex justify-content-between align-items-center vote-count-container">
                    <h5>Total District Votes</h5>
                    <div class="count-box">
                        <span class="vote-number">{{ $districtCount }}</span>
                    </div>
                </div>
                <div class="form-group mr-3">

                 <form method="GET" action="{{ route('admin.dashboard') }}" class="mb-4">
    <div class="d-flex justify-content-between align-items-center flex-wrap">
        <!-- Candidate Filter -->
        <div class="form-group mr-3">
            <label for="candidate" class="d-block">Candidate</label>
            <select id="candidate" name="candidate" class="form-control">
                <option value="">All Candidates</option>
                @foreach($candidates as $candidate)
                    <option value="{{ $candidate->id }}" {{ request('candidate') == $candidate->id ? 'selected' : '' }}>
                        {{ $candidate->candidate_name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Priority Filter -->
        <div class="form-group mr-3">
            <label for="priority" class="d-block">Priority</label>
            <select id="priority" name="priority" class="form-control">
                <option value="">All Priorities</option>
                <option value="1" {{ request('priority') == '1' ? 'selected' : '' }}>1</option>
                <option value="2" {{ request('priority') == '2' ? 'selected' : '' }}>2</option>
                <option value="3" {{ request('priority') == '3' ? 'selected' : '' }}>3</option>
                <!-- Add more priority options if needed -->
            </select>
        </div>

        <!-- District Filter -->
        <div class="form-group mr-3">
            <label for="district" class="d-block">District</label>
            <select id="district" name="district" class="form-control">
                <option value="">All Districts</option>
                @foreach($districts as $district)
                    <option value="{{ $district->id }}" {{ request('district') == $district->id ? 'selected' : '' }}>
                        {{ $district->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Submit Button -->
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Apply Filters</button>
        </div>
        
        <!-- Clear Filters Button -->
        <div class="form-group">
            <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">Clear Filters</a>
        </div>
    </div>
</form>
        
             
                <table class="table custom-table">
                    <thead>
                        <tr>
                            <th>Index</th> 
                            <th>User Name</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>District</th>
                            <th>Priority</th>
                            <th>Candidate Name</th>
                        </tr>
                    </thead>
                    <tbody>
                
                        @foreach($districtVotes as $vote)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $vote->user->name }}</td>
                        <td>{{ $vote->user->phone }}</td>
                        <td>{{ $vote->user->email }}</td>
                        <td>{{ $vote->district->name }}</td>
                        <td>{{ $vote->priority }}</td>
                        <td>{{ $vote->party->candidate_name }}</td>
                    </tr>
                    @endforeach
                </tbody>
                </table>
                <div class="flex justify-center mt-4">
                    {{ $districtVotes->links('pagination::simple-tailwind') }}
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS, Popper.js, and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const urlParams = new URLSearchParams(window.location.search);
        const activeTab = urlParams.get('tab') || 'NationalVotes';
        
        // Activate the correct tab and its content
        const tabLink = document.querySelector(`a[href="#${activeTab}"]`);
        if (tabLink) {
            const tabPane = document.querySelector(`#${activeTab}`);
            if (tabPane) {
                tabLink.classList.add('active');
                tabPane.classList.add('show', 'active');
            }
        }
    });
</script>