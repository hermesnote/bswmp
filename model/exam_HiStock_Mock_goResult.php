<?php
//連線資料庫
require_once("../vender/dbtools.inc.php");

//默認時區
date_default_timezone_set('PRC');

// 設置資料類型 json，編碼格式 utf-8
header('Content-Type: application/json; charset=UTF-8');

//建立回傳參數
$done = "done";

//取得AJAX資料
$listNumber = $_POST["listNumber"];  //取得題序
$i = $listNumber-1;  //題序-1的數字

$getAQ = $_POST["AQ"];  //取得作答選項
$AQArray = unserialize($_COOKIE["AQ"]);  //AQ陣列解序
array_push($AQArray, "$getAQ");
$AQ = $AQArray;

$getAT = $_POST["ansS"];  //取得作答秒數
$ATArray = unserialize($_COOKIE["AT"]);  //AT陣列解序
array_push($ATArray, "$getAT");
$AT = $ATArray;

$ANArray = unserialize($_COOKIE["answer"]);
$AN = $ANArray;

$numberArray = unserialize($_COOKIE["number"]);
$NB = $numberArray;

$arr = array($NB, $AN, $AQ, $AT);
echo json_encode($arr);

exit();

?>
