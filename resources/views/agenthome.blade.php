<!DOCTYPE html>
<html lang="en">
<head>

    <!-- Meta tags and styling -->
    <meta http-equiv="Cache-Control" content="no-store, no-cache, must-revalidate, max-age=0">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">

    <style>
    /* Add agent dashboard specific styles here */

    body {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Poppins', sans-serif;
    }

    .outer-wrapper {
    display: grid;
    grid-template-rows: 2cm auto;
    height: 100vh;
    margin: 0;
    background: -webkit-linear-gradient(left, #004d00, #008000, #00b300, #00e600);

}


.wrapper {
    background: #fff;
    border-radius: 15px;
    box-shadow: 0px 15px 20px rgba(0, 0, 0, 0.1);
    margin-top: 2cm;  /* Adjusted margin-top to align with the bottom of the navigation bar */
    margin-left: 1cm;  /* Adjusted margin-left to create space on the left */
    margin-right: 1cm;  /* Adjusted margin-right to create space on the right */
    margin-bottom: 1cm;  /* Adjusted margin-bottom for spacing at the bottom */
}


    .title.agent-home {
        width: 100%;
        font-size: 35px;
        font-weight: 600;
        text-align: center;
        color:#fff;
        transition: all 0.6s cubic-bezier(0.68, -0.55, 0.265, 1.55);
    }

    .account-container {
        width: 100%;
        overflow: hidden;
        margin-top: 30px;
    }

    .account {
        height: 50px;
        width: 100%;
        margin-top: 20px;
        background: #fff;
        color: #000;
        border-radius: 15px;
        font-size: 17px;
        text-align: center;
        line-height: 50px;
        cursor: pointer;
        transition: all 0.6s ease;
    }

    .account:hover {
        background: #66ff66;
    }

    .btn-text {
        height: 100%;
        width: 100%;
        z-index: 1;
        position: relative;
        color: #fff;
        padding-left: 0;
        border-radius: 15px;
        font-size: 20px;
        font-weight: 500;
        cursor: pointer;
        text-align: center;
        line-height: 50px;
    }
    .nav-bar {
    height: 2cm;
    background-color: transparent;
    display: flex;
    justify-content: space-between;
    align-items: center; /* Add this line to vertically center the logo and nav links */
    padding: 0 1cm;
    position: fixed;
    width: 100%;
    z-index: 2;
}


.logo {
    font-size: 20px;
    color: #fff;
    font-weight: bold;
}

.nav-links {
    display: flex;
    align-items: center; /* Add this line to vertically center the nav links */
    padding: 0 1cm;
}

.nav-link {
    margin-right: 1cm;
    color: #fff;
    text-decoration: none;
    font-weight: 500;
    font-size: 16px;
}

.nav-link:hover {
    text-decoration: underline;
}

</style>


</head>
<body>
    <div class="outer-wrapper">
    <div class="nav-bar">
    <div class="logo">BANK WISO</div>
    <div class="nav-links">
        <a href="{{ route('logout') }}" class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>

        <form id="logout-form" action="{{ route('logout.agent') }}" style="display: none;">
            @csrf
        </form>
    </div>
</div>

        <div class="wrapper">
            <div class="title-text">
                <div class="title agent-home">Welcome {{ $data->first_name }}</div>
            </div>
            <div class="account-container">
                <!-- Display agent account buttons dynamically -->
                <form action="{{ route('pendings') }}">
                    @csrf
                    <button class="account" type="submit" >Pending Accounts</button>
                </form>
                <form action="{{ route('actives') }}">
                    @csrf
                    <button class="account" onclick="viewActiveAccount()">Active Accounts</button>
                </form>
                <form action="{{ route('transactionsA') }}">
                    @csrf
                    <button class="account" onclick="viewActiveAccount()">Transactions</button>
                </form>
                <form action="{{ route('listusers') }}">
                    @csrf
                    <button class="account" onclick="viewActiveAccount()">Users</button>
                </form>
                <!-- Add more buttons dynamically -->

                <!-- Button to add a new account -->
                <div class="field btn" onclick="goToAddAccount()">
                    <div class="btn-layer"></div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Function to navigate to pending account page
        function viewPendingAccount() {
            // Implement navigation logic to view pending account details
            console.log("Viewing Pending Account");
        }

        // Function to navigate to active account page
        function viewActiveAccount() {
            // Implement navigation logic to view active account details
            console.log("Viewing Active Account");
        }

        // Function to navigate to the "Add Account" page
        function goToAddAccount() {
            // Implement navigation logic to go to the "Add Account" page
            console.log("Navigating to Add Account page");
        }
    </script>
</body>
</html>
