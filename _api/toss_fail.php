<?php

$errorCode = $_GET['code'];
$errorMessage = $_GET['message'];

echo "결제에 실패했습니다. <br />";
echo "$errorCode : $errorMessage";

?>