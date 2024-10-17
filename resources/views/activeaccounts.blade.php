<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pending Accounts</title>
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
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        li:hover {
            background-color: #f0f0f0;
        }

        a {
            text-decoration: none;
            color: #333;
        }
    </style>
</head>
<body>
    <div>
        <h1>Active Accounts</h1>

        @if(count($activeAccounts) > 0)
            <ul>
                @foreach($activeAccounts as $account)
                    <li>
                        
                            <strong>Account Name:</strong> {{ $account->account_name }}<br>
                            <strong>Account Number:</strong> {{ $account->account_number }}<br>
                            <strong>Account Holder First Name:</strong> {{ $account->user->first_name }}<br>
                            <strong>Account Holder Last Name:</strong> {{ $account->user->last_name }}<br>
                            
                            <!-- Block | Unblock Form -->
                            <form action="{{ route('UorBaccount', ['id' => $account->account_id]) }}" method="get">
                            @csrf

                            @if($account->blocked)
                                <button type="submit">Unblock</button>  
                            @else
                                <button type="submit">Block</button>
                            @endif

                            </form>
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

                           
                           
                        
                    </li>
                @endforeach
            </ul>
        @else
            <p>No pending accounts at the moment.</p>
        @endif
    </div>
</body>
</html>
