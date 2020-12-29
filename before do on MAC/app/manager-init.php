<?php
include 'managers-list.php';

$randMax = count($randomArr) - 1;
$rand = rand(0, $randMax);
$random = $randomArr[$rand];

$cookieKey = 'manager';
$cookieTime = strtotime( '+30 days' );

if(!$_COOKIE[$cookieKey]) {
 setcookie($cookieKey, $random, $cookieTime, "/");
}