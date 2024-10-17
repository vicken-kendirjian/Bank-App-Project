<!DOCTYPE html>
<html>
<head>
    <title>Transactions</title>
    <style>
        /* Add your CSS styles here to make it look professional */
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .header h1 {
            margin: 0;
        }

        .buttons {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .logout-button,
        .home-button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #f44336;
            color: #fff;
            text-decoration: none;
            border-radius: 4px;
            transition: background-color 0.3s ease;
        }

        .home-button {
            background-color: #2196f3;
        }

        .logout-button:hover,
        .home-button:hover {
            background-color: #d32f2f;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f5f5f5;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Transactions</h1>
            <div class="buttons">
                <a href="/logout" class="logout-button">Logout</a>
                <a href="/agentashboard" class="home-button">Home</a>
            </div>
        </div>

        <!-- Filter Form -->
        <form action="{{ route('transactions.Agentget', ['id' => $userId]) }}" method="GET">
            <label for="type">Filter by Type:</label>
            <select name="type" id="type">
                <option value="">All Types</option>
                <option value="1">Deposit</option>
                <option value="2">Withdrawal</option>
                <option value="3">Transfer</option>
            </select>
            
            <button type="submit">Apply Filters</button>
        </form>

        <table>
            <thead>
                <tr>
                    <th>Transaction ID</th>
                    <th>Sender</th>
                    <th>Receiver</th>
                    <th>Amount</th>
                    <th>Type</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach (json_decode($transactions) as $transaction)
                    @if (!isset($_GET['type']) || ($_GET['type'] == '' || $transaction->type == $_GET['type']))
                        <tr>
                            <td>{{ $transaction->transfer_id }}</td>
                            <td>{{ $transaction->senderNumber }}</td>
                            <td>{{ $transaction->receiverNumber }}</td>
                            <td>{{ $transaction->amount }}</td>
                            <td>
                                @if ($transaction->type == 1) Deposit
                                @elseif ($transaction->type == 2) Withdrawal
                                @else Transfer
                                @endif
                            </td>
                            <td>{{ $transaction->date }}</td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>

    <script>
        // Add your JavaScript code here if needed
    </script>
</body>
</html>
