<!DOCTYPE html>
<html>
<head>
    <title>Account Information</title>
    <style>
        /* CSS styles here */
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        .account-info {
            margin-bottom: 20px;
        }

        .account-info label {
            font-weight: bold;
            color: #555;
        }

        .account-info span {
            margin-left: 10px;
            color: #777;
        }

        .account-info span.amount {
            font-weight: bold;
            color: #333;
        }

        .account-info span.yes {
            color: green;
        }

        .account-info span.no {
            color: red;
        }

        .transfer-button {
            display: block;
            width: 100%;
            padding: 10px;
            margin-top: 20px;
            font-size: 16px;
            font-weight: bold;
            text-align: center;
            color: #fff;
            background-color: #007bff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .transfer-button:hover {
            background-color: #0056b3;
        }
        .transactions-button {
            display: block;
            width: 100%;
            padding: 10px;
            margin-top: 10px; /* Slightly less margin to group with Transfer Money button */
            font-size: 16px;
            font-weight: bold;
            text-align: center;
            color: #fff;
            background-color: #28a745; /* Different color for distinction */
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .transactions-button:hover {
            background-color: #218838;
        }

        .logout-button {
            display: block;
            width: 100%;
            padding: 10px;
            margin-top: 10px; /* Same margin as View Transactions button */
            font-size: 16px;
            font-weight: bold;
            text-align: center;
            color: #fff;
            background-color: #dc3545; /* Red color for logout button */
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .logout-button:hover {
            background-color: #c82333;
        }

        .home-button {
            display: block;
            width: 100%;
            padding: 10px;
            margin-top: 10px; /* Same margin as Logout button */
            font-size: 16px;
            font-weight: bold;
            text-align: center;
            color: #fff;
            background-color: #ffc107; /* Yellow color for home button */
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .home-button:hover {
            background-color: #e0a800;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Account Information</h1>

        <div class="account-info">
            <label>Account Name:</label>
            <span id="accountHolder">{{ $account->account_name }}</span>
        </div>

        <div class="account-info">
            <label>Account Number:</label>
            <span id="accountNumber">{{ $account->account_number }}</span>
        </div>

        <div class="account-info">
            <label>Balance:</label>
            <span class="amount" id="balance">{{ $account->amount }}</span>
        </div>

        <div class="account-info">
            <label>Currency:</label>
            <span id="currency">{{ $account->currency }}</span>
        </div>

        <div class="account-info">
            <label>Date Opened:</label>
            <span id="dateOpened">{{ $account->date_opened }}</span>
        </div>

        <div class="account-info">
            <label>Active:</label>
            <span id="active">{{ $account->active ? 'Yes' : 'No' }}</span>
        </div>

        @if($account->active && $account->amount > 0)
        <button class="transfer-button" onclick="transferMoney()">Transfer Money</button>
        @endif

        <button class="transactions-button" onclick="viewTransactions()">View Transactions</button>
        <button class="logout-button" onclick="logout()">Logout</button>
        <button class="home-button" onclick="home()">Home</button>

    </div>
    <script>
    function transferMoney() {
        // Assuming you have the account_number available (replace 'your_account_number' with the actual value)
        var accountNumber = "{{ $account->account_number }}";

        // Redirect to the transfer route with the dynamic account_number
        window.location.href = '/'+ accountNumber +'/transfer';
    }

    function viewTransactions() {
            // Redirect to the transactions route
            var accountNumber = "{{ $account->account_number }}";
            window.location.href = '/'+accountNumber+'/transactions';
        }

    function logout() {
        window.location.href = '/logout';
    }

    function home() {
        window.location.href = '/userdashboard';
    }
</script>
</body>
</html>
