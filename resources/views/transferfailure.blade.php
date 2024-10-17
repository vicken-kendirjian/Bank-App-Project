<!DOCTYPE html>
<html>
<head>
    <title>Transfer Failure</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #333;
        }

        p {
            margin-bottom: 20px;
            color: #666;
        }

        .button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .button:hover {
            background-color: #45a049;
        }

        .logout-button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #f44336;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
            margin-right: 10px;
        }

        .logout-button:hover {
            background-color: #d32f2f;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Transfer Failure</h1>
        <p>Sorry, the transfer failed because you entered a wrong account number or the account number you entered has a different currency than your account.</p>
        <a href="{{ route('userdashboard') }}" class="button">Go Home</a>
        <a href="{{ route('logout') }}" class="logout-button">Logout</a>
    </div>
</body>
</html>
