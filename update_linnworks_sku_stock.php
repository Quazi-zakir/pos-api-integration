<?php
/**
 * Created by PhpStorm.
 * User: zakir
 * Date: 3/2/15
 * Time: 3:01 AM
 */

//include '../pos-api-integration/lib/linnworks/Api.php';
include 'lib/linnworks/Api.php';

//-----------------------------------------------------------------------------------------
/*
function updateStockBySkuAndQty($p_sku,$p_qty)
{
    $_api = "C701B7DE133B";
    //$api = new lib\linnworks\OrderApi($this->_api);
    //$api = new lib\linnworks\OrderApi($_api);

    $api = new lib\linnworks\InventoryApi($_api);
    $result = $api->saveStockItemBySkuAndQty($p_sku,$p_qty);

    //print_r($result);
    //echo $api->debug();
    echo count($result);
    if (count($result)) {
        return $result;
    } else {
        return false;
    }
}*/
// 118735

$time_start = microtime(true);


$_sku='HTP01-RED-5';
$_qty = 18;
$_api_key = "C701B7DE133B";
$api = new lib\linnworks\InventoryApi($_api_key);
$result = $api->saveStockItemBySkuAndQty($_sku,$_qty);

//$result = updateStockBySkuAndQty($_sku,$_qty);

echo "<pre>";
print_r($result);


$time_end = microtime(true);
$execution_time = ($time_end - $time_start);///60;
echo '<br /><b>Total Execution Time:</b> '.$execution_time.' Sec';