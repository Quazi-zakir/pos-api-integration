<?php
/**
 * Created by PhpStorm.
 * User: zakir
 * Date: 3/3/15
 * Time: 2:42 AM
 */

include 'lib/lightspeed/Light_Api.php';
//$api = new lib\lightspeed\Light_Api("https://api.merchantos.com/API/Account/94275/Item?load_relations=all");
$api = new lib\lightspeed\Light_Api(null);
//$result = $api->getDataByApi();
//$result = file_get_contents('http://milanoshoes.com/llsync/categories.php');
$_sku = 'HTP01-RED-5';
$result = $api->lookupItemDetailsBySku($_sku);
echo "<pre>";
print_r($result);