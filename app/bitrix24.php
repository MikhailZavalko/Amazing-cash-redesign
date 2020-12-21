<?php
$queryUrl = 'https://b24-rpyv2x.bitrix24.ru/rest/1/o3lzo0f0n8l18lz1/crm.lead.add.json';

$nameToCrm = $_POST['Имя'];
$phoneToCrm = $_POST['Телефон'];
$emailToCrm = $_POST['email'];

include 'manager-init.php';

$manager = isset($_COOKIE[$cookieKey]) ? $_COOKIE[$cookieKey] : $random;

$from = isset($_POST['is_blog'])  ?  'amazing-cash.ru/blog' : 'amazing-cash.ru';
$SOURCE_ID = isset($_POST['is_blog'])  ?  '1' : 'WEB';


$fields = array(
    'TITLE' => 'Заявка с сайта '.$from,
    'EMAIL' => Array(
           "n0" => Array(
               "VALUE" => $emailToCrm,
               "VALUE_TYPE" => "HOME",
           ),
       ),
	'PHONE' => Array(
		"n0" => Array(
			"VALUE" => $phoneToCrm,
			"VALUE_TYPE" => "WORK",
		),
	),
	'NAME' => $nameToCrm,
	'SOURCE_ID' => $SOURCE_ID,
    'COMMENTS' => $message,
	'ASSIGNED_BY_ID' => $manager,
);

if($_COOKIE['UTM_SOURCE']) {
	$fields['UTM_SOURCE'] = $_COOKIE['UTM_SOURCE'];
	$fields['UTM_MEDIUM'] = $_COOKIE['UTM_MEDIUM'];
	$fields['UTM_CAMPAIGN'] = $_COOKIE['UTM_CAMPAIGN'];
	$fields['UTM_CONTENT'] = $_COOKIE['UTM_CONTENT'];
	$fields['UTM_TERM'] = $_COOKIE['UTM_TERM'];
}

$queryData = http_build_query(array(
  'fields' => $fields,
  'params' => array("REGISTER_SONET_EVENT" => "Y")
));


$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_SSL_VERIFYPEER => 0,
  CURLOPT_POST => 1,
  CURLOPT_HEADER => 0,
  CURLOPT_RETURNTRANSFER => 1,
  CURLOPT_URL => $queryUrl,
  CURLOPT_POSTFIELDS => $queryData,
));
$result = curl_exec($curl);
curl_close($curl);
$result = json_decode($result, 1);
if (array_key_exists('error', $result)) echo "Ошибка при сохранении лида: ".$result['error_description']."<br/>";