<?php

/**
 * Created by PhpStorm.
 * User: BABA-YAGA
 * Date: 11/4/2014
 * Time: 6:38 PM
 */
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
        return "Hi";
    }

    public function getDataByApi()
    {
        // Create cURL resource
        $curl = curl_init();

        // Set URL
        curl_setopt($curl, CURLOPT_URL, $this->_url);

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

} 