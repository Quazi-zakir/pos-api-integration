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

// Authenticate
curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
curl_setopt($curl, CURLOPT_USERPWD, $apikey . ":" . $password); 

// Send content in proper format
curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/xml'));              

// Set Request Type 
// (you'll need to change this depending on what you're doing)
curl_setopt($curl,CURLOPT_HTTPGET,1);
// curl_setopt($curl,CURLOPT_POST, 1);  // POST (Create)
// curl_setopt($curl,CURLOPT_PUT, 1); // PUT (Update)
// curl_setopt($curl,CURLOPT_CUSTOMREQUEST, 'DELETE') // DELETE

// To send parameters (data)
// curl_setopt($curl, CURLOPT_POSTFIELDS, $params);


// Return the transfer as a string
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

// $output contains the output string
$output = curl_exec($curl);

// Close cURL resource to free up system resources
curl_close($curl);

//$xml = simplexml_load_string($output);
$xml = json_decode(json_encode((array) simplexml_load_string($output)), 1);
echo "<pre>";
print_r($xml);die(); 
?>

<html>
<head>
  <title>PHP Test Page</title>
</head>
<body>
	<ul id="categories">
		
		<?php foreach($xml->Category AS $category) { ?>
		<li><?php echo $category->name ?></li>
		<?php } ?>
	</ul>
</body>
</html>