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

    <h1>Transfer Transactions</h1>
        
    @if(count($transfers) > 0)
        <ul>
            @foreach($transfers as $transfer)
                <li>
                    <strong>Transaction ID:</strong> {{ $transfer->transfer_id }}<br>
                    <strong>Amount:</strong> {{ $transfer->amount }}<br>
                    <strong>Date:</strong> {{ $transfer->date}}<br>
                    <strong>Receiver Account Number:</strong> {{ $transfer->toAccount->account_number}}<br>
                    <strong>Sender Account Number:</strong> {{ $transfer->fromAccount->account_number}}<br>
                    <strong>Receiver id:</strong> {{ $transfer->toAccount->user->user_id}}<br>
                    <strong>Sender id:</strong> {{ $transfer->fromAccount->user->user_id}}<br>
                    <!-- Add other details you want to display -->
                </li>
            @endforeach
        </ul>
    @else
        <p>No transfer transactions available.</p>
    @endif

</body>
</html>
