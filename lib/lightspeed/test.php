<?php

$apikey = 'c2605a32b2c5480acec7dd0894fe90f3f0a2f7b1aff031dd398676d33a3d6df5';
$password = 'apikey'; // API Keys don't have a password and just use this filler string
$account_id = '94275';

// Alternatively you can use your username and password
/*$apikey = 'imademo';
$password = 'thisismypass';
$account_id = 797;*/

// Create cURL resource
$curl = curl_init();

// Set URL
curl_setopt($curl, CURLOPT_URL, "https://api.merchantos.com/API/Account/94275/Item?load_relations=all");
// Send content in proper format
curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));  
// Authenticate
curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);

curl_setopt($curl, CURLOPT_USERPWD, $apikey . ":" . $password); 

$output = curl_exec($curl);
// $parsed = array();
// parse_str(curl_exec($ch), $parsed);
print_r(unserialize($output));
if ($output === FALSE) {
 
    echo "cURL Error: " . curl_error($curl);
 
}