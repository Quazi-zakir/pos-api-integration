<?php


namespace lib\lightspeed;

class Light_Api
{
    private $_apikey = null;
    private $_userid = null;
    private $_password = null;
    private $_url = null;
    private $_items = array();

    public function __construct($url)
    {
        $this->_apikey = 'c2605a32b2c5480acec7dd0894fe90f3f0a2f7b1aff031dd398676d33a3d6df5';
        $this->_userid = '94275';
        $this->_password = 'apikey';
        $this->_url = $url;
    }

    public function test(){
        return "Helix IT";
    }

    public function getDataByApi()
    {
        // Create cURL resource
        $curl = curl_init();

        // Set URL
        curl_setopt($curl, CURLOPT_URL, $this->_uCURLOPT_URLrl);

        // Authenticate
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($curl, CURLOPT_USERPWD, $this->_apikey . ":" . $this->_password);

        // Send content in proper format
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/xml'));

        // Set Request Type
        // (you'll need to change this depending on what you're doing)
        curl_setopt($curl, CURLOPT_HTTPGET, 1);

        // To send parameters (data)
        // curl_setopt($curl, CURLOPT_POSTFIELDS, $params);


        // Return the transfer as a string
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

        // $output contains the output string
        $output = curl_exec($curl);

        // Close cURL resource to free up system resources
        curl_close($curl);

        $xml = json_decode(json_encode((array)simplexml_load_string($output)), 1);

        if (count($xml)) {
            return $xml;
        } else {
            return curl_error($curl);
        }
    }
    //------------------------------------------------------------------------------------------------------------------
    public function listAllItem(){

        $curl = curl_init();

        // Set URL
        curl_setopt($curl, CURLOPT_URL, "https://api.merchantos.com/API/Account/94275/Item?load_relations=all");
        // https://api.merchantos.com/API/Account/{accountID}/Item?limit=20\&offset=20

        // Authenticate
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        //  curl_setopt($curl, CURLOPT_USERPWD, $apikey . ":" . $password);
        curl_setopt($curl, CURLOPT_USERPWD, $this->_apikey . ":" . $this->_password);
        $additionalHeaders ='';
        //  Send content in proper format
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/xml', $additionalHeaders));

        //  Set Request Type
        //  (you'll need to change this depending on what you're doing)
        curl_setopt($curl,CURLOPT_HTTPGET, 1);

        //  Return the transfer as a string
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

        //  $output contains the output string
        $output = curl_exec($curl);

        //  Close cURL resource to free up system resources
        curl_close($curl);

        return $xml = simplexml_load_string($output);
    }
    //------------------------------------------------------------------------------------------------------------------

    // zakir
    public function lookupItemDetailsBySku($p_sku){

        // curl_setopt($curl, CURLOPT_URL, "https://api.merchantos.com/API/Account/94275/Item?load_relations=all&customSku=12916001-BLK_07");
        $curl = curl_init();

        // Set URL
        curl_setopt($curl, CURLOPT_URL, "https://api.merchantos.com/API/Account/94275/Item?load_relations=all&customSku=".$p_sku);
        // https://api.merchantos.com/API/Account/{accountID}/Item?limit=20\&offset=20

        // Authenticate
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        //  curl_setopt($curl, CURLOPT_USERPWD, $apikey . ":" . $password);
        curl_setopt($curl, CURLOPT_USERPWD, $this->_apikey . ":" . $this->_password);
        $additionalHeaders ='';
        //  Send content in proper format
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/xml', $additionalHeaders));

        //  Set Request Type
        //  (you'll need to change this depending on what you're doing)
        curl_setopt($curl,CURLOPT_HTTPGET, 1);

        //  Return the transfer as a string
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

        //  $output contains the output string
        $output = curl_exec($curl);

        //  Close cURL resource to free up system resources
        curl_close($curl);

        return $xml = simplexml_load_string($output);

    }
    //------------------------------------------------------------------------------------------------------------------
    // zakir
    /**
     * @param $p_sku
     * @param $p_qty
     * @return \SimpleXMLElement
     */
    public function updateQohBySkuAndQty($p_sku,$p_qty){
        try {
            //require_once("lib/lightspeed/MOSAPI/MOSAPICall.class.php");
            include "lib/lightspeed/MOSAPI/MOSAPICall.class.php";
            //$mosapi = new MOSAPICall($this->_apikey,$this->_userid);
            $mos = new \MOSAPICall($this->_apikey,$this->_userid);

            $updated_qoh = $p_qty . " Updated!";
            $result = $this->lookupItemDetailsBySku($p_sku);
            $_item_id = $result->Item->itemID;
           // echo 'Item shop id - ' . $_item_shopid = $result->Item->ItemShops->ItemShop[1]->itemShopID;
            // $_qoh = $result->Item->ItemShops->ItemShop[0]->qoh;  // its ok and return qoh we blocked it for test, we required it

            $updated_str = $p_qty;
            //$updated_str1 = 250;
            $myear = '1250';
            $xml_update_item_stock = "<?xml version='1.0'?><Item><modelYear>".$myear."</modelYear></Item>";
            $xml_update_item_stock = "<?xml version='1.0'?><Item><ItemShops><ItemShop><itemShopID>13637</itemShopID><qoh>".$updated_str."</qoh></ItemShop><ItemShop><itemShopID>13899</itemShopID><qoh>".$updated_str."</qoh></ItemShop></ItemShops></Item>";
            $xml_update_item_stock = "<?xml version='1.0'?><Item><ItemShops><ItemShop><qoh>".$updated_str."</qoh></ItemShop></ItemShops></Item>";

            $updated_item_response_xml = $mos->makeAPICall("Account.Item","Update",$_item_id,$xml_update_item_stock) or die (err_msg);

            //$updated_item_response_xml = $mos->makeAPICall("Account.Item.ItemShops.ItemShop[1].itemShopID","Update",$_item_shopid,$xml_update_item_stock);

            return $result1 = $this->lookupItemDetailsBySku($p_sku);

        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
        // $result = simplexml_load_string($result);

        //echo 'Item id is ' . $item_id = $result['Item']['itemID'];
        //echo '</br> Item description is ' . $item_id = $result['Item']['description'];
//        echo "<pre>";
//        print_r($result);

    }
    //------------------------------------------------------------------------------------------------------------------
    // zakir
    public function updateQohByItemIdAndQty($p_ItemId,$p_qty){
        //return 0;
        require_once("MOSAPI/MOSAPICall.class.php");

        $mosapi = new MOSAPICall($this->_apikey,$this->_userid);

        // Change the item's description
        $item_description='';
        $updated_description = $item_description . " Updated!";

        $xml_update_item_stock = "<?xml version='1.0'?><Item><ItemShops><ItemShop><qoh>$updated_description</qoh></ItemShop></ItemShops></Item>";

// make another API call to Account.Item, this time with Update method and our changed Item XML.
        // $updated_item_response_xml = $mosapi->makeAPICall("Account.Item","Update",$item_id,$xml_update_item);

    }
    //------------------------------------------------------------------------------------------------------------------
    //------------------------------------------------------------------------------------------------------------------
    //------------------------------------------------------------------------------------------------------------------
    //------------------------------------------------------------------------------------------------------------------




} 