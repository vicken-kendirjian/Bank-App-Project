
<!DOCTYPE html>
<html>
<head>
    <title>Account Access</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 400px;
            margin: 100px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #333;
        }

        p {
            text-align: center;
            color: #666;
        }

        .button-container {
            text-align: center;
            margin-top: 20px;
        }

        .button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Account Access</h1>
        <p>Your account is currently pending activation or blocked by the bank.</p>
        <div class="button-container">
            <a href="{{route('userdashboard')}}" class="button">Home</a>
            <button onclick="logout()" class="button">Logout</button>
        </div>
    </div>

    <script>
        function logout() {
            window.location.href = '/logout';
        }
    </script>
</body>
</html>
