<?php 
include 'toss.lib.php';

$orderID = $_GET['orderId'];
$paymentKey = $_GET['paymentKey'];
$amount = $_GET['amount'];

$response = requestTossPay($paymentKey, $orderID, $amount);
$responseCode = $response->code;
$responseMessage = $response->message;
$totalAmount = $response->totalAmount;

$_SESSION['_toss_pay_total_test'] += $totalAmount;
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
  </head>
  <body>
    <p>
      Code: <?= $responseCode ?> <br />
      Message: <?= $responseMessage ?> <br />
      Total amount: <?= $totalAmount ?> <br />
      총 결제 금액: <?= $_SESSION['_toss_pay_total_test'] ?>
    </p>

    <p>
      <a href="../_toss_test.php">
        추가 결제하기
      </a>
    </p>
  </body>
</html>
  