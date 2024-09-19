{{-- resources/views/tabs.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .container {
            margin-top: 50px;
        }
        .table thead th {
            background-color: #343a40;
            color: #ffffff;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Admin Dashboard</h2>

        <!-- Tabs Navigation -->
        <ul class="nav nav-tabs" id="orderTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link active" id="orders-tab" data-toggle="tab" href="#orders" role="tab" aria-controls="orders" aria-selected="true">National Votes </a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="playtime-orders-tab" data-toggle="tab" href="#playtime-orders" role="tab" aria-controls="playtime-orders" aria-selected="false">District Votes</a>
            </li>
        </ul>

        <!-- Tabs Content -->
        <div class="tab-content" id="orderTabsContent">
           
            <div class="tab-pane fade show active" id="orders" role="tabpanel" aria-labelledby="orders-tab">
                <p>National Votes</p>
                <table>
                    <thead>
                        <tr>
                            <th>User Name</th>
                            <th>Phone</th>
                            <th>Priority</th>
                            <th>Candidate Name</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($votes as $vote)
                        <tr>
                            <td>{{ $vote->user->name }}</td>
                            <td>{{ $vote->user->phone }}</td>
                            <td>{{ $vote->priority }}</td>
                            <td>{{ $vote->party->candidate_name  }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                
            </div>

            
            <div class="tab-pane fade" id="playtime-orders" role="tabpanel" aria-labelledby="playtime-orders-tab">
                <p>District Votes</p>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS, Popper.js, and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
