<!DOCTYPE html>
<html lang="en">
<head>

    <!-- Meta tags and styling -->
    <meta http-equiv="Cache-Control" content="no-store, no-cache, must-revalidate, max-age=0">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">

    <style>
    /* Add user home page specific styles here */

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
    background: -webkit-linear-gradient(left, #003366, #004080, #0059b3, #0073e6);
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
.field-btn {
    display: flex;
    justify-content: center;
    align-items: center;
    width: fit-content;
    margin: 0 auto;
}

    .title.user-home {
        width: 100%;
        font-size: 35px;
        font-weight: 600;
        text-align: center;
        color:#fff;
        transition: all 0.6s cubic-bezier(0.68, -0.55, 0.265, 1.55);
    }

/* Update the .account-container style to center its content */
/* Update the .account-container style to utilize flexbox for vertical stacking */
.account-container {
    width: 50%;
    overflow: hidden;
    margin: 30px auto;
    display: flex;
    flex-direction: column; /* Ensure vertical stacking */
    align-items: center; /* Center its children horizontally */
}

@media (min-width: 768px) {
    .account-container {
        width: 50%;
    }
}



/* Update the .account style to a grid layout */
/* Update the .account style to set a smaller width for the buttons */
/* Update the .account style to stack buttons vertically */
.account {
    display: grid;
    grid-template-columns: 1fr 1fr;
    height: 50px;
    width: 80%;
    margin-top: 20px;
    background: #fff;
    color: #000;
    border-radius: 15px;
    font-size: 20px; /* Increase the font size */
    font-weight: bold; /* Make the font bolder */
    font-family: 'Poppins', sans-serif; /* Specify a professional font */
    cursor: pointer;
    transition: all 0.6s ease;
    margin-bottom: 10px;
}
/* Adjust .account:hover to maintain the background change */
.account:hover {
    background: #0059b3;
}

/* Style for left side (account name) */
.account-left {
    padding-left: 10px; /* Adjust as needed */
    line-height: 50px;
}

/* Style for right side (currency) */
.account-right {
    padding-right: 10px; /* Adjust as needed */
    line-height: 50px;
    text-align: right;
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
        <a href="#" class="nav-link">Home</a>
        <a href="{{route('transactions.get')}}" class="nav-link">Transactions</a>
        <a href="{{ route('logout') }}" class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>

        <form id="logout-form" action="{{ route('logout') }}" style="display: none;">
            @csrf
        </form>
    </div>
</div>

        <div class="wrapper">
            <div class="title-text">
                <div class="title user-home">Welcome {{ $data->first_name }}</div>
            </div>
            <div class="account-container" id="accountContainer"></div>
                <!-- Account details will be displayed here -->

                <!-- Button to add a new account -->
                <div class="field-btn" onclick="window.location.href = '{{ route('addaccount') }}'">
                    <div class="btn-layer"></div>
                    <div class="btn-text">Add New Account</div>
                </div>
            </div>
        </div>
    </div>

    <script>

        document.addEventListener("DOMContentLoaded", function() {
        // Fetch accounts when the page loads
        fetchAccounts();
    });

    function fetchAccounts() {
        // Make an asynchronous request to the '/getaccounts' route
        fetch("{{ route('getaccounts') }}")
            .then(response => response.json())
            .then(data => {
                // Handle the data and update the DOM
                displayAccounts(data.accounts);
            })
            .catch(error => console.error('Error fetching accounts:', error));
    }

    function displayAccounts(accounts) {
    // Get the container element
    const accountContainer = document.getElementById('accountContainer');

    // Clear existing content
    accountContainer.innerHTML = '';

    // Iterate through the accounts and create HTML elements
    accounts.forEach(account => {
        const accountElement = document.createElement('div');
        accountElement.classList.add('account');

        // Create left side for account name
        const leftSide = document.createElement('div');
        leftSide.classList.add('account-left');
        leftSide.innerText = account.account_name;

        // Create right side for currency
        const rightSide = document.createElement('div');
        rightSide.classList.add('account-right');
        rightSide.innerText = account.currency;

        // Append left and right sides to the account element
        accountElement.appendChild(leftSide);
        accountElement.appendChild(rightSide);

        // Add a click event to view account details
        accountElement.addEventListener('click', function () {
            window.location.href = "{{ route('account', '') }}/" + account.account_number;
        });

        // Append the account element to the container
        accountContainer.appendChild(accountElement);
    });
}



    </script>
</body>
</html>
