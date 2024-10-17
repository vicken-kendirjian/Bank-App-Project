<!DOCTYPE html>
<html>
<head>
    <title>Transfer Money</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }

        h1 {
            text-align: center;
        }

        .container {
            max-width: 400px;
            margin: 0 auto;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .form-group input {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        .form-group button {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .form-group button:hover {
            background-color: #45a049;
        }

        .logout-button {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            background-color: #f44336;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
        }

        .logout-button:hover {
            background-color: #d32f2f;
        }

        .home-button {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            background-color: #2196F3;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
        }

        .home-button:hover {
            background-color: #1976D2;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Transfer Money</h1>
        <form action="{{ route('transfer.postt', ['account_number' => $account->account_number]) }}" method="POST">
        @csrf
        <div class="form-group">
        <label for="account_number">Account Number:</label>
            <!-- Add 'oninput' attribute to call validateAccountNumber() function -->
            <input type="text" id="account_number" name="account_number" required maxlength="20" oninput="validateAccountNumber()" />
            <!-- Add a span to display validation message -->
            <span id="accountNumberError" style="color: red;"></span>
        </div>

            <div class="form-group">
                <label for="amount">Amount:</label>
                <!-- Add 'oninput' attribute to call validateAmount() function -->
                <input type="number" id="amount" name="amount" required oninput="validateAmount()" />

                <!-- Add a span to display validation message -->
                <span id="amountError" style="color: red;"></span>

            </div>
            <div class="form-group">
                <!-- Add 'disabled' attribute to the button initially -->
                <button type="submit" id="transferButton" disabled>Transfer</button>
            </div>
        </form>
        <a href="/logout" class="logout-button">Logout</a>
        <a href="/userdashboard" class="home-button">Home</a>
    </div>
    <script>
    function validateAmount() {
        var inputAmount = parseFloat(document.getElementById('amount').value);
        var accountBalance = parseFloat("{{ $account->amount }}");
        var amountError = document.getElementById('amountError');
        var transferButton = document.getElementById('transferButton');

        if (isNaN(inputAmount) || inputAmount <= 0) {
            amountError.innerHTML = 'Amount must be a valid number greater than 0.';
            document.getElementById('amount').setCustomValidity('Amount must be a valid number greater than 0.');
            transferButton.disabled = true;
        } else if (inputAmount > accountBalance) {
            amountError.innerHTML = 'Amount cannot exceed account balance.';
            document.getElementById('amount').setCustomValidity('Amount cannot exceed account balance.');
            transferButton.disabled = true;
        } else {
            amountError.innerHTML = '';
            document.getElementById('amount').setCustomValidity('');
            transferButton.disabled = false;
        }
    }
    function validateAccountNumber() {
        var accountNumber = document.getElementById('account_number').value;
        var accountNumberError = document.getElementById('accountNumberError');
        var transferButton = document.getElementById('transferButton');

        var validCharacters = /^[0-9a-zA-Z]+$/;

        if (accountNumber.length !== 20 || !accountNumber.match(validCharacters)) {
            accountNumberError.innerHTML = 'Account number must be 20 characters long and contain only alphanumeric characters.';
            document.getElementById('account_number').setCustomValidity('Invalid account number.');
            transferButton.disabled = true;
        } else {
            accountNumberError.innerHTML = '';
            document.getElementById('account_number').setCustomValidity('');
            validateAmount();  // Validate amount as well when the account number changes
        }
    }
</script>


</body>
</html>
