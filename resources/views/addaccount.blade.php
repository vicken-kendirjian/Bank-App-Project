<!DOCTYPE html>
<html>
<head>
    <title>Add Account</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
        }

        .container {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: #fff;
            text-decoration: none;
            border-radius: 4px;
            transition: background-color 0.3s;
        }

        .btn:hover {
            background-color: #45a049;
        }

        .logout-btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #f44336;
            color: #fff;
            text-decoration: none;
            border-radius: 4px;
            transition: background-color 0.3s;
            margin-top: 10px;
        }

        .logout-btn:hover {
            background-color: #d32f2f;
        }

        .home-btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 4px;
            transition: background-color 0.3s;
            margin-right: 10px;
        }

        .home-btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Add Account</h2>
        <form action="{{ route('createaccount') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="account_name">Account Name</label>
                <input type="text" id="account_name" name="account_name" required>
            </div>
            <div class="form-group">
                <label for="currency">Currency</label>
                <select id="currency" name="currency" required>
                    <option value="USD">USD</option>
                    <option value="LBP">LBP</option>
                    <option value="EUR">EUR</option>
                </select>
            </div>
            <button type="submit" class="btn">Create Account</button>
            <a href="/userdashboard" class="home-btn">Home</a>
        </form>
        <a href="/logout" class="logout-btn">Logout</a>
    </div>
</body>
</html>
