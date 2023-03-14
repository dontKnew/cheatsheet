<?php

$curl = curl_init();

curl_setopt_array($curl, [
  CURLOPT_PORT => "8000",
  CURLOPT_URL => "http://127.0.0.1:8000/api/user/authUserData",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => "",
  CURLOPT_HTTPHEADER => [
    "Accept: application/json",
    "Authorization: Bearer 4|0OVao45IkGNHAPXGn2uVsmxk1c5hfq9heQ7Zbwye"
  ],
]);

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  echo $response;
}