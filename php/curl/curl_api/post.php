<?php

// User data to send using HTTP POST method in curl
// $data = array('name'=>'Sajid ALi','salary'=>'4000', 'age' => '33');

/* for register
// $data = array(
//     "name"=>"Krishan Kumar",
//     "email"=>"krishan@gmail.com",
//     "password"=>"1234",
//     "password_confirmation"=>"1234"
 );*/

 $data = array(
    "email"=>"krishan@gmail.com",
    "password"=>"1234",
    "password_confirmation"=>"1234"
);



// Data should be passed as json format
$data_json = json_encode($data);

// API URL to send data
// $url = 'https://dummy.restapiexample.com/api/v1/employees';
// $url = 'http://127.0.0.1:8000/api/user/login';

// curl initiate
$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, $url);

curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

// SET Method as a POST
curl_setopt($ch, CURLOPT_POST, 1);

// Pass user data in POST command
curl_setopt($ch, CURLOPT_POSTFIELDS,$data_json);

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Execute curl and assign returned data
$response  = curl_exec($ch);

// Close curl
curl_close($ch);

// See response if data is posted successfully or any error
print_r ($response);

?>