<?php

$randomArr = array(14,10); // - 10, 12, 14 , 18
$randMax = count($randomArr) - 1;
$rand = rand(0, $randMax);
$random = $randomArr[$rand];

$cookieKey = 'manager';
$cookieValue = $randomArr[$rand];
$cookieTime = time() + (3600 * 24 * 30); // 30 дней

if(!$_COOKIE[$cookieKey]) {
 setcookie($cookieKey, $cookieValue, $cookieTime);
}

$manager = isset($_COOKIE[$cookieKey]) ? $_COOKIE[$cookieKey] : $random;


echo 'manager: '.$manager.'<br>';
echo 'rand '.$random.'<br>';
echo '<pre>'.print_r($_COOKIE).'</pre>';
echo '<pre>'.time() .'</pre>';