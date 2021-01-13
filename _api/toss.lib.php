<?php

define('TOSS_SECRET_KEY', 'test_sk_YPBal2vxj81Bl5OBWNe35RQgOAND');

/**
 * POST method로 요청을 날림
 * 
 * @param url:string 요청 url
 * @param body:string 요청 body
 * @param header:array<string> 요청 header
 * 
 * @return string 응답 문자열
 */
function postRequest($url, $body, $header) {
  $curlObject = curl_init($url);
  curl_setopt($curlObject, CURLOPT_CUSTOMREQUEST, "POST");
  curl_setopt($curlObject, CURLOPT_SSL_VERIFYPEER, true);
  curl_setopt($curlObject, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($curlObject, CURLOPT_POSTFIELDS, $body);
  curl_setopt($curlObject, CURLOPT_HTTPHEADER, $header);
  $response = curl_exec($curlObject);
  curl_close($curlObject);
  return $response;
}

/**
 * 토스 API를 사용해 결제 요청을 하고 응답을 리턴
 * @see https://docs.tosspayments.com/guides/card#결제-승인
 * 
 * @param secretKey:string 시크릿키
 * @param paymentKey:string 프론트단의 토스 API로부터 받은 paymentKey
 * @param orderID:string 프론트단의 토스 API로부터 받은 orderID
 * @param amount:string 프론트단의 토스 API로부터 받은 amount
 * 
 * @return object 위의 링크를 참조!
 */
function requestTossPay($paymentKey, $orderID, $amount) {
  $encodedSecretKey = base64_encode(TOSS_SECRET_KEY.":");
  $url = "https://api.tosspayments.com/v1/payments/$paymentKey";
  
  $body = json_encode(array(
    'orderId' => $orderID,
    'amount' => $amount,
  ));

  $header = array(
    "Authorization: Basic $encodedSecretKey",
    "Content-Type: application/json"
  );

  $response = postRequest($url, $body, $header);

  return json_decode($response);
}

?>