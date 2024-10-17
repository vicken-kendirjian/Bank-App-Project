<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    form {
  max-width: 400px;
  margin: 0 auto;
  border: 2px solid #ccc;
  padding: 20px; 
  border-radius: 10px;
}

h1 {
  text-align: center;  
}

input[type="number"] {
  padding: 10px;
  border: 1px solid #555;
  outline: none;
  width: 100%;
  margin-bottom: 20px;
  border-radius: 5px;
  text-align: center;
  box-shadow: 2px 2px 4px #ccc;
}

button {
  padding: 12px 25px;
  background: #4caf50;
  border: none;
  color: white;
  border-radius: 5px;
  font-size: 1.2em;
  cursor: pointer;
  box-shadow: 2px 2px 4px #999;  
}

button:hover {
  background: #3e8e41;
}

button:active {
  background: #3e8e41;  
  box-shadow: 1px 1px 2px #888;
  transform: translateY(2px); 
}
</style>
<body>



<h1>Withdraw Funds</h1>

<h1>{{$account->user->first_name}} Current balance is: {{ $account->amount }}</h1>

<form method="POST" action="{{ route('withdraw.post', ['id' => $account->account_id]) }}">
@csrf

  <input type="hidden" name="account_id" value="{{ $account->id }}">

  <input type="number" name="amount" id="amount">

  <button type="submit">Withdraw</button>

</form>





<script>
const balance = {{ $account->amount }};

const amountInput = document.getElementById('amount');

amountInput.addEventListener('input', () => {
  if(amountInput.value > balance) {
    amountInput.value = ''; 
    alert("Amount exceeds balance!");
  } 
})
</script>

</body>
</html>