<?php

$postData = array(
	'TITLE' => 'Заявка с сайта'
);

if($_COOKIE['UTM_SOURCE']) {
	$postData['UTM_SOURCE'] = $_COOKIE['UTM_SOURCE'];
	$postData['UTM_MEDIUM'] = $_COOKIE['UTM_MEDIUM'];
	$postData['UTM_CAMPAIGN'] = $_COOKIE['UTM_CAMPAIGN'];
	$postData['UTM_CONTENT'] = $_COOKIE['UTM_CONTENT'];
	$postData['UTM_TERM'] = $_COOKIE['UTM_TERM'];
}

if($_COOKIE['UTM_SOURCE']) {
echo '<pre>'.print_r($postData, true).'</pre>';
}