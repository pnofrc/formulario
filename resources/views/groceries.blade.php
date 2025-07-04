<!DOCTYPE html>
<html>
<head>
    <title>Groceries To Buy</title>
    <style>
        body { font-family: Arial, sans-serif; }
        table { border-collapse: collapse; width: 60%; margin: 2rem auto; }
        th, td { border: 1px solid #ccc; padding: 10px; text-align: left; }
        th { background-color: #f9f9f9; }
        h2 { text-align: center; }
    </style>
</head>
<body>
    <h2>Groceries To Buy</h2>
    <table>
        <thead>
            <tr>
                <th>Item</th>
                <th>To Buy</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($items as $item)
                <tr>
                    <td>{{ $item['name'] }}</td>
                    <td>{{ $item['to_buy'] }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="2">Nessun item da comprare.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
