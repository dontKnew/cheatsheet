<?php
// Initiate curl session in a variable (resource)
$curl_handle = curl_init();

$url = "https://dummy.restapiexample.com/api/v1/employees";

// Set the curl URL option
curl_setopt($curl_handle, CURLOPT_URL, $url);

// This option will return data as a string instead of direct output
curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, true);

// Execute curl & store data in a variable
$curl_data = curl_exec($curl_handle);

curl_close($curl_handle);

// Decode JSON into PHP array
$response_data = json_decode($curl_data);

// Print all data if needed
// Print data if need to debug
echo "<pre>";
print_r($response_data->data);
echo "</pre>";
// die();

// All user data exists in 'data' object
// $user_data = $response_data->data;

// Extract only first 5 user data (or 5 array elements)
// $user_data = array_slice($user_data, 0, 4);

// Traverse array and print employee data
// foreach ($user_data as $user) {
// 	echo "name: ".$user->employee_name;
// 	echo "<br />";
// }

?>