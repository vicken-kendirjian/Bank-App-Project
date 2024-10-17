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
        <h1>Pending Accounts</h1>

        @if(count($pendingAccounts) > 0)
            <ul>
                @foreach($pendingAccounts as $account)
                    <li>
                        
                            <strong>Account Name:</strong> {{ $account->account_name }}<br>
                            <strong>Account Number:</strong> {{ $account->account_number }}<br>
                            <strong>Account Holder First Name:</strong> {{ $account->user->first_name }}<br>
                            <strong>Account Holder Last Name:</strong> {{ $account->user->last_name }}<br>
                            
                            <!-- Accept Form -->
                            <form action="{{ route('acceptAccount', ['id' => $account->account_id]) }}" method="get" style="display: inline;">
                                @csrf
                                <button type="submit">Accept</button>
                            </form>

                            <!-- Reject Form -->
                            <form action="{{ route('rejectAccount', ['id' => $account->account_id]) }}" method="get" style="display: inline;">
                                @csrf
                                <button type="submit">Reject</button>
                            </form>
                        
                    </li>
                @endforeach
            </ul>
        @else
            <p>No pending accounts at the moment.</p>
        @endif
    </div>
</body>
</html>
