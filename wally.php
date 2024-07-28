<?php


require("hsToken.php");
 
// replace the * with a valid website requests can come from
 

header("Access-Control-Allow-Origin: *"); //replace the * with your website domain (e.g. yourwesbite.github.io)
$record = array();
foreach(array_keys($_POST) as $post_key){
    $record[$post_key] = $_POST[$post_key];
};

$record['redcap_repeat_instance'] = 'new';
$record['redcap_repeat_instrument'] = 'main';

// print_r($record);
//encode array to JSON
$data = json_encode( array( $record ) );
$fields = array(
    'token' => $redcap_token,
    'content' => 'record',
    'format' => 'json',
    'type' => 'flat',
    'overwriteBehavior' => 'normal',
    'forceAutoNumber' => 'false',
    'data' => $data,
    'returnContent' => 'count',
    'returnFormat' => 'json'
);
 
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://uor-redcap.reading.ac.uk/api/');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_VERBOSE, 0);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_AUTOREFERER, true);
curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
curl_setopt($ch, CURLOPT_FRESH_CONNECT, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($fields, '', '&'));
$output = curl_exec($ch);
print $output;
curl_close($ch);
?>