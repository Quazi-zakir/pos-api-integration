<?php
/**
 * Created by PhpStorm.
 * User: zakir
 * Date: 3/2/15
 * Time: 3:01 AM
 */
//ini_set('display_errors', 'On');
//error_reporting(E_ALL);
error_reporting(1);
//include '../pos-api-integration/lib/linnworks/Api.php';
include 'lib/linnworks/Api.php';

function getItemBySku($p_sku)
{
    $_api = "C701B7DE133B";
    //$api = new lib\linnworks\OrderApi($this->_api);
    //$api = new lib\linnworks\OrderApi($_api);

    $api = new lib\linnworks\InventoryApi($_api);
    $result = $api->getItemBySku($p_sku);

    //print_r($result);
    //echo $api->debug();
    echo count($result);
    if (count($result)) {
        return $result;
    } else {
        return false;
    }
}

$time_start = microtime(true);

$_sku='HTP01-RED-5';
$_sku='5854-BLK_9';
//$_sku='5854-BLK_9';
$result = getItemBySku($_sku);

echo "<pre>";
print_r($result);

$time_end = microtime(true);
$execution_time = ($time_end - $time_start);///60;
echo '<b>Total Execution Time:</b> '.$execution_time.' Sec';