<?php

define('CRM_HOST', 'b24-rpyv2x.bitrix24.ru');
define('CRM_PORT', '443');
define('CRM_PATH', '/crm/configs/import/lead.php');

define('CRM_LOGIN', 'amazing-cash.ru@yandex.ru');
define('CRM_PASSWORD', '123456789Rus/');
/********************************************************************************************/

$nameToCrm = $_POST['Имя'];
$phoneToCrm = $_POST['Телефон'];
$emailToCrm = $_POST['email'];

include 'manager-init.php';

$manager = isset($_COOKIE[$cookieKey]) ? $_COOKIE[$cookieKey] : $random;

$from = isset($_POST['is_blog'])  ?  'amazing-cash.ru/blog' : 'amazing-cash.ru';
$SOURCE_ID = isset($_POST['is_blog'])  ?  '1' : 'WEB';


$postData = array(
	'TITLE' => 'Заявка с сайта '.$from,
    'NAME' => $nameToCrm,
    'PHONE_WORK' => $phoneToCrm,
    'SOURCE_ID' => $SOURCE_ID,
    'COMMENTS' => $message,
    'EMAIL_HOME' => $emailToCrm,
	'ASSIGNED_BY_ID' => $manager,
);

if($_COOKIE['UTM_SOURCE']) {
	$postData['UTM_SOURCE'] = $_COOKIE['UTM_SOURCE'];
	$postData['UTM_MEDIUM'] = $_COOKIE['UTM_MEDIUM'];
	$postData['UTM_CAMPAIGN'] = $_COOKIE['UTM_CAMPAIGN'];
	$postData['UTM_CONTENT'] = $_COOKIE['UTM_CONTENT'];
	$postData['UTM_TERM'] = $_COOKIE['UTM_TERM'];
}

// if($_COOKIE['UTM_SOURCE']) {
// 	echo '<pre>'.print_r($postData, true).'</pre>';
// 	}

// append authorization data
if (defined('CRM_AUTH')) {
	$postData['AUTH'] = CRM_AUTH;
} else {
	$postData['LOGIN'] = CRM_LOGIN;
	$postData['PASSWORD'] = CRM_PASSWORD;
}

// open socket to CRM
$fp = fsockopen("ssl://".CRM_HOST, CRM_PORT, $errno, $errstr, 30);
if ($fp) {
	// prepare POST data
	$strPostData = '';
	foreach ($postData as $key => $value)
		$strPostData .= ($strPostData == '' ? '' : '&').$key.'='.urlencode($value);

	// prepare POST headers
	$str = "POST ".CRM_PATH." HTTP/1.0\r\n";
	$str .= "Host: ".CRM_HOST."\r\n";
	$str .= "Content-Type: application/x-www-form-urlencoded\r\n";
	$str .= "Content-Length: ".strlen($strPostData)."\r\n";
	$str .= "Connection: close\r\n\r\n";

	$str .= $strPostData;

	// send POST to CRM
	fwrite($fp, $str);

	// get CRM headers
	$result = '';
	while (!feof($fp)) {
		$result .= fgets($fp, 128);
	}
	fclose($fp);
	// cut response headers
	$response = explode("\r\n\r\n", $result);

	// $output = '<pre>'.print_r($response[1], 1).'</pre>';
	//echo $output;
}


 ?>