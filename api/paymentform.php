<?php
try {
  require_once '../utils/init.php';
} catch (Throwable $exp) {
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $validation = [];


  // Check that wallet address is not empty and is a valid format
  if (!isset($_POST['walletAddress']) || $_POST['walletAddress'] === '') {
    $validation['walletAddress'] = 'Wallet Address is required.';
  } else {
    $wallet_address = $_POST['walletAddress'];
  }
  // Check that currency is one of the options in the select menu
  if (!in_array($_POST['currency'], array('btc', 'eth', 'ltc'))) {
    $validation['currency'] = "Please select a valid currency.";
  }

  if (count($validation) === 0) {
    $query = $pdo->prepare('INSERT INTO payment(walletAddress, cryptoType) VALUES(?, ?)');
    if ($query->execute([$wallet_address, $_POST['currency']])) {
      // Success
    } else {
      // Failure
      $validation['insert'] = "Error occured while inserting into the database.";
    }
  }
  if (count($validation) > 0) {
    // Show errors to user
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="../payment.css">

</head>
<?= include_once __DIR__ . '/../includes/nav.php' ?>

<body class="container-fluid" id="paymentmain">

<div class="container-fluid">

<form class="container-fluid" id="form_main">
<label for="amount">Amount:<?php if (isset($_POST['price'])) {
  echo $_POST['price'];
} ?></label>

<output type="number" id="amount" name="amount" value="<?php if (isset($_POST['price'])) {
  echo $_POST['price'];
} ?>"></output><br><br>

<div class="form_elements">
<h1>Payment Form</h1>
<p>Enter your payment information below to pay for your order.</p>

  <label for="wallet-address">Wallet Address:</label>
  <input type="text" id="wallet-address" name="wallet-address"><br><br>

<label for="currency">Currency:</label>
  <select id="currency" name="currency">
    <option value="btc">Bitcoin</option>
    <option value="eth">Ethereum</option>
    <option value="ltc">Litecoin</option>
    </select><br><br>
    <?php
    if (isset($validation) && isset($validation['currency'])) {
      ?>
        <span><?= $validation['currency'] ?></span>
        <?php
    }
    ?>
  <img class="img-fluid" id="qrpic"src="/../images\qr-code-file-bangla-mobile-code-0.png" alt="QR Code">

  

  <input type="submit" value="Submit Payment">

  </div>
</form>

</div>
</body>
<?= include_once __DIR__ . '/../includes/footer.php' ?>
</html>