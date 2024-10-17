<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deposit Transactions</title>
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

        ul {
            list-style-type: none;
            padding: 0;
        }

        li {
            background-color: #fff;
            border: 1px solid #ddd;
            margin: 10px;
            padding: 15px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            transition: box-shadow 0.3s ease;
            cursor: pointer;
        }

        li:hover {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        strong {
            display: block;
            margin-bottom: 8px;
        }

        p {
            text-align: center;
            color: #555;
        }
    </style>
</head>
<body>

    <h1>Deposit Transactions</h1>

    @if(count($deposits) > 0)
        <ul>
            @foreach($deposits as $deposit)
                <li>
                    <strong>Transaction ID:</strong> {{ $deposit->transfer_id }}<br>
                    <strong>Amount:</strong> {{ $deposit->amount }}<br>
                    <strong>Date:</strong> {{ $deposit->date}}<br>
                    <strong>Receiver Account Number:</strong> {{ $deposit->toAccount->account_number}}<br>
                    <strong>Receiver Name:</strong> {{ $deposit->toAccount->user->first_name}}<br>
                    <!-- Add other details you want to display -->
                </li>
            @endforeach
        </ul>
    @else
        <p>No deposit transactions available.</p>
    @endif

</body>
</html>
