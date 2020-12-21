<?php

require 'getresponce-api.php';

$ip = $_SERVER['REMOTE_ADDR'];
$getresponse = new GetResponse('su4pwmruj7jv2mtinw4q4citst70kumo');
$getresponse->enterprise_domain = 'amazing-cash.ru';
// $getresponse->enterprise_domain = 'localhost';

//api URL is relative to your domain UR:
//$getresponse->api_url = 'https://api3.getresponse360.pl/v3'; //for PL domains
$getresponse->api_url = 'https://api3.getresponse360.com/v3'; //default

echo '<pre>';
var_dump($getresponse->addContact(array(
  'name'              => 'ApiTest',
  'email'             => 'znalex2andr@yandex.ru',
  'dayOfCycle'        => 0,
  'campaign'          => array('campaignId' => 'nAwze'),
  'ipAddress'         => $ip
  )
));
echo '</pre>';