<!-- resources/views/useraccountsview.blade.php -->

<!DOCTYPE html>
<html>
<head>
    <title>User Accounts</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 20px;
        }

        h1 {
            color: #333;
        }

        ul {
            list-style-type: none;
            padding: 0;
        }

        li {
            border: 1px solid #ddd;
            margin-bottom: 10px;
            padding: 10px;
            background-color: #f9f9f9;
        }
    </style>
</head>
<body>

    <h1>User Accounts</h1>

    <ul>
        @foreach($userAccounts as $account)
            <li>
                <strong>Account ID:</strong> {{ $account->account_id }}<br>
                <strong>Account Name:</strong> {{ $account->account_name }}<br>
                <strong>Account Number:</strong> {{ $account->account_number }}<br>
                <strong>Amout:</strong> {{ $account->amount }}<br>
                <strong>Currency:</strong> {{ $account->currency }}<br>
                <!-- Add other account details you want to display -->
                <br>
                    <form action="{{ route('withdraw.display', ['id' => $account->account_id]) }}" method="get">
                    @csrf
                    <button type="submit">Withdraw</button>
                    </form>
                    <br>

                    <form action="{{ route('deposit.display', ['id' => $account->account_id]) }}" method="get">
                    @csrf
                    <button type="submit">Deposit</button>
                    </form>
                    <br>

                    <form action="{{ route('transfer.display', ['id' => $account->account_id]) }}" method="get">
                    @csrf
                    <button type="submit">Transfer</button>
                    </form>
                    <br>

                    <form action="{{ route('usertransactions', ['id' => $account->account_id]) }}" method="get">
                        @csrf
                        <button type="submit">Transactions</button>
                    </form>
                    <br>
            </li>
        @endforeach
    </ul>

</body>
</html>
