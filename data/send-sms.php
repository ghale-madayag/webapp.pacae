<?php 
require_once('../vendor/autoload.php'); 
$client = new NexmoClient(new NexmoClientCredentialsBasic('b3b13e90', 'PPAoIuSYVKpPG6YR')); 
$text = new NexmoMessageText('639298370289', "PACAE", 'How to send an SMS with PHP'); 
$response = $client->message()->send($text);
print_r($response->getResponseData());

?>
