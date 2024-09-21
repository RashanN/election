<!DOCTYPE html>
<html>
<head>
    <title>User District Votes</title>
</head>
<body>

<h1>Last 3 District Votes</h1>


    <div>
        @foreach($lastDistrictVotes as $vote)
        <tr>
            <td>{{ $vote->priority }}</td>
            <td>
                <img src="{{ $vote->party->logo ?? 'default-logo.png' }}" alt="Party Logo" width="50">
            </td>
        </tr>
        @endforeach
    </div>
    <div>
        @foreach($lastNationalVotes as $vote)
        <tr>
            <td>{{ $vote->priority }}</td>
            <td>
                <img src="{{ $vote->party->logo ?? 'default-logo.png' }}" alt="Party Logo" width="50">
            </td>
        </tr>
        @endforeach
    </div>


</body>
</html>
