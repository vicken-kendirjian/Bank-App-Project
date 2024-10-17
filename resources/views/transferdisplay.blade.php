<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    form {
  max-width: 500px;
  margin: 0 auto;
  border: 2px solid #2892cd;
  padding: 30px;
  border-radius: 10px;
}

h1 {
  text-align: center;
  color: #2892cd;  
}  

label {
  font-weight: 600;
}

input[type="text"] {
  padding: 12px 20px;
  width: 100%;
  outline: none;
  border: 1px solid #2892cd;
  border-radius: 6px;
  margin: 10px 0 20px;
  box-sizing: border-box; 
}

button {
  background: #2892cd;
  border: transparent;
  padding: 12px 0;
  color: white;
  border-radius: 6px;
  width: 100%;  
  font-size: 1.1em; 
  box-shadow: 2px 2px 6px #bbb;
  cursor: pointer;
}

button:hover {
  background: #1c6faf;  
}
</style>
<body>

<h1>Transfer Money</h1>

<p>
  Current Balance: {{ $account->amount }}
</p>

<p>
  Account Number: {{ $account->account_number }}  
</p>

<form method="POST" action="{{ route('transfer.post', ['id' => $account->account_id]) }}">

  @csrf
  
  <div>
    <label>Destination Account Number:</label><br>  
    <input type="text" name="destination">
  </div>
  <div>
    <label>Amount:</label>   
    <input type="number" id="amount" name="amount">
  </div>

  <button type="submit">Submit Transfer</button>

</form>


</body>
<script>

const max = {{ $account->amount }};

const amountInput = document.getElementById('amount');

amountInput.addEventListener('input', () => {
  if(amountInput.value > max) { 
    amountInput.value = '';
    alert("Exceeds available balance!");
  }
})

</script>
</html>