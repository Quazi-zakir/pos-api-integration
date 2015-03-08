<?php
/**
 * Created by PhpStorm.
 * User: zakir
 * Date: 3/4/15
 * Time: 12:47 AM
 */

include 'lib/lightspeed/Light_Api.php';

$api = new lib\lightspeed\Light_Api(null);

$_sku = 'HTP01-BLUE-7.5';
$_qoh = 130;

$result = $api->updateQohBySkuAndQty($_sku,$_qoh);

print_r($result);
echo "<pre>";
print_r($result);

//$result->code[0]->lat
echo '  item id '.$result->Item->itemID;
echo '  <br /> Qty - '.$result->Item->ItemShops->ItemShop[0]->qoh;
echo '  <br /> item shop id'. $result->Item->ItemShops->ItemShop[1]->itemShopID;


