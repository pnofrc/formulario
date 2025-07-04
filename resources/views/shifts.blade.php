@php
$days = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];
$shifts = ['lunch', 'lunch cleaning', 'dinner', 'dinner cleaning'];

// add dynamic fetch for users
$users = [
    ['name' => 'Alice', 'availability' => ['monday', 'tuesday', 'friday']],
    ['name' => 'Bob', 'availability' => ['monday', 'wednesday', 'saturday']],
    ['name' => 'Carla', 'availability' => ['tuesday', 'wednesday', 'thursday']],
    ['name' => 'Dario', 'availability' => ['thursday', 'friday', 'sunday']],
    ['name' => 'Eva', 'availability' => ['monday', 'saturday', 'sunday']],
    ['name' => 'Franco', 'availability' => ['tuesday', 'wednesday', 'sunday']],
    ['name' => 'Giulia', 'availability' => ['monday', 'tuesday', 'wednesday']],
    ['name' => 'Luca', 'availability' => ['thursday', 'friday', 'saturday']],
    ['name' => 'Marta', 'availability' => ['monday', 'friday', 'saturday']],
    ['name' => 'Nico', 'availability' => ['wednesday', 'saturday', 'sunday']],
];

// Init assignments count
foreach ($users as &$u) {
    $u['assignments'] = 0;
}
unset($u);

$schedule = [];

foreach ($days as $day) {
    $schedule[$day] = [];
    $usedToday = []; // to avoid same person in multiple shifts of the same day

    foreach ($shifts as $shift) {
        // Get users available that day and not already used today
        $available = array_filter($users, function($u) use ($day, $usedToday) {
            return in_array($day, $u['availability']) && !in_array($u['name'], $usedToday);
        });

        // Shuffle full list to get more randomness
        $available = array_values($available); // reindex
        shuffle($available);

        // Pick two different people (if possible)
        $assigned = array_slice($available, 0, 2);

        // Save assigned names
        $schedule[$day][$shift] = array_column($assigned, 'name');

        // Update usage
        foreach ($assigned as $person) {
            $usedToday[] = $person['name'];
            foreach ($users as &$u) {
                if ($u['name'] === $person['name']) {
                    $u['assignments']++;
                }
            }
        }
    }
}
@endphp

<!DOCTYPE html>
<html>
<head>
    <title>Shift Schedule</title>
    <style>
        body { font-family: sans-serif; padding: 20px; }
        table { border-collapse: collapse; width: 90%; margin: 20px auto; }
        th, td { padding: 10px; border: 1px solid #ccc; text-align: center; }
        th { background: #f4f4f4; }
        h2 { text-align: center; margin-top: 40px; }
    </style>
</head>
<body>

<h1 style="text-align:center;">Weekly Shift Schedule (More Random)</h1>

@foreach ($schedule as $day => $shifts)
    <h2>{{ ucfirst($day) }}</h2>
    <table>
        <thead>
            <tr>
                <th>Shift</th>
                <th>Person 1</th>
                <th>Person 2</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($shifts as $shift => $names)
                <tr>
                    <td>{{ ucfirst($shift) }}</td>
                    <td>{{ $names[0] ?? '—' }}</td>
                    <td>{{ $names[1] ?? '—' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endforeach

</body>
</html>
