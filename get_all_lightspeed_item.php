<?php
/**
 * Created by PhpStorm.
 * User: zakir
 * Date: 3/3/15
 * Time: 1:54 AM
 */
include 'lib/lightspeed/Light_Api.php';
//$api = new lib\lightspeed\Light_Api("https://api.merchantos.com/API/Account/94275/Item?load_relations=all");
$api = new lib\lightspeed\Light_Api(null);
//$result = $api->getDataByApi();
//$result = file_get_contents('http://milanoshoes.com/llsync/categories.php');
$result = $api->listAllItem();
echo "<pre>";
print_r($result);

//$xml = simplexml_load_string($output);
//$json = json_encode($xml);
//$array = json_decode($json,TRUE);
//echo "<pre>";
//print_r($xml);