<?php
if (empty($_SESSION['_toss_pay_total_test'])) {
  $_SESSION['_toss_pay_total_test'] = 0;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Toss test</title>
  <script src="https://js.tosspayments.com/v1"></script>
  <script>
    const clientKey = 'test_ck_XjExPeJWYVQ1XdPmEPxV49R5gvNL';
    const tossPayments = TossPayments(clientKey);

    function tossTest() {
      const amount = +document.getElementById('amount').value;

      if (!amount) return;

      tossPayments.requestPayment('카드', {
        amount,
        orderId: Date.now(),
        orderName: amount + '원 결제 테스트',
        customerName: '박토스',
        successUrl: window.location.origin + '/_api/toss_success.php',
        failUrl: window.location.origin + '/_api/toss_fail.php',
      });
    }
  </script>
</head>
<body>
  <input type="number" placeholder="결제할 금액" id="amount">
  <button onclick="tossTest()">토스 결제하기</button>
  <p>
    총 결제 금액: <?= $_SESSION['_toss_pay_total_test'] ?>
  </p>
</body>
</html>