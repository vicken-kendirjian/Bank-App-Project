<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        .button-container {
            display: flex;
            justify-content: space-around;
            margin-top: 20px;
        }

        .button-container form {
            display: inline-block;
        }

        .button-container button {
            background-color: #4CAF50; /* Green */
            border: none;
            color: white;
            padding: 15px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .button-container button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div>
        <h1>Agent Transactions Dashboard</h1>

        <div class="button-container">
            <!-- Deposits Button Form -->
            <form action="{{ route('deposits.route') }}" method="get">
                <button type="submit">Deposits</button>
            </form>

            <!-- Withdrawals Button Form -->
            <form action="{{ route('withdrawals.route') }}" method="get">
                <button type="submit">Withdrawals</button>
            </form>

            <!-- Transfers Button Form -->
            <form action="{{ route('transfers.route') }}" method="get">
                <button type="submit">Transfers</button>
            </form>

            
        </div>
    </div>
</body>
</html>
