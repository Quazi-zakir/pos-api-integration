<?php
/**
 * Created by PhpStorm.
 * User: zakir
 * Date: 3/1/15
 * Time: 12:57 PM
 */
//header ( "Content-type: application/vnd.ms-excel" );
//header ( "Content-Disposition: attachment; filename=foo_bar.xls" );

include 'lib/linnworks/Api.php';


function get_ordered_data()
{
    $_api = "C701B7DE133B";
    //$api = new lib\linnworks\OrderApi($this->_api);
    $api = new lib\linnworks\OrderApi($_api);
    $GetOrdersFilter = array(
        'OrderDateFromIsSet' => true,
        'OrderDateFrom' => '2015-03-03T00:00:00',
        'OrderDateToIsSet' => true,
        'OrderDateTo' => '2015-03-03T00:00:00',
        'OrderIdIsSet' => false,
        'pkOrderIdIsSet' => true,
        //'pkOrderId' => '00000000-0000-0000-0000-000000000000',
        'ProcessedIsSet' => false,
        'Processed' => false,
        'StatusIsSet' => false,
        'Status' => 1,
        'ExcludeOnHold' => true,
        'ExcludeParked' => true,
        'EntriesPerPage' => '100',
        'PageNumber' => '1'
    );


    $GetOrdersFilter1 = array(
        'OrderDateFromIsSet' => true,
        'OrderDateFrom' => '2015-03-06T21:07:41',
        'OrderDateToIsSet' => true,
        'OrderDateTo' => '2015-03-07T21:07:41',
        'OrderIdIsSet' => false,
        'pkOrderIdIsSet' => false,
        'pkOrderId' => '00000000-0000-0000-0000-000000000000',
        'ProcessedIsSet' => false,
        'Processed' => false,
        'StatusIsSet' => false,
        'Status' => 1,
        'ExcludeOnHold' => false,
        'ExcludeParked' => false,
        'EntriesPerPage' => '100',
        'PageNumber' => '1'

    );

    $response = $api->getFilteredOrders(array('Filter' => $GetOrdersFilter1));
    //dd($response);
    if ($response) {
        return $response;
    } else {
        return false;
    }
}
//-------------------------------------------------------------------------------------
$time_start = microtime(true);
$result = get_ordered_data();
echo " Total Data - " . sizeof($result['Orders']['Order']);

//$orders = $result['Orders']['Order'][0]['OrderItems'];  // ok
$orders = $result['Orders']['Order'];

$arr_linnworks_order_data=array();
$i=0;
//foreach($orders as $key => $data){
foreach($orders as $data){

    $pk_order_id = $data['pkOrderId'];

    //echo $pk_order_id;
    //echo "</br>";
    //$order_items = $data['OrderItems']['OrderItem'];
    $order_items = $data['OrderItems'];


    foreach ($order_items as $data_items) {

        if (count($data_items['SKU']) == 0){
            $order_multiple_items = $data['OrderItems']['OrderItem'];
            foreach ($order_multiple_items as $multiple_data_items) {
                //echo "</br>";
                //echo $multiple_data_items['SKU'];
                $arr_linnworks_order_data[]=array('pkOrderId'=>$pk_order_id,'SKU' =>$multiple_data_items['SKU'],'Qty'=>$multiple_data_items['Qty']);
            }
        }else{

            //echo $data_items['SKU'];
            $arr_linnworks_order_data[]=array('pkOrderId'=>$pk_order_id,'SKU' =>$data_items['SKU'],'Qty'=>$data_items['Qty']);
            //echo "</br> -- else --</br > ";
        }

        //echo "</br>";
    }

}

//--------------------------------------------------------------------------------------------------------------------------

function create_csv($p_arr=null){
    //header("Content-Type: application/csv");
    //header("Content-Disposition: attachment;Filename=order_date.csv");


}
//-------------------------------------------------------------------------------------------------------------------------

function create_xls($p_arr=null)
{
    echo "<table border='1' cellspacing='2' cellpadding='2'><tr><th>order ID</th><th>SKU</th><th>Qty</th></tr>";
    foreach($p_arr as $data){
        echo "<tr><td>".$data['pkOrderId']."</td><td>".$data['SKU']."</td><td>".$data['Qty']."</td></tr>";
    }
    echo "</table>";
}
//-------------------------------------------------------------------------------------------------------------------------

//-------------------------------------------------------------------------------------------------------------------------

echo "<pre>";
//print_r($arr_linnworks_order_data);
//print_r($result);
print_r($orders);

create_xls($arr_linnworks_order_data);

$time_end = microtime(true);
$execution_time = ($time_end - $time_start);///60;
echo '<b>Total Execution Time:</b> '.$execution_time.' Sec';


