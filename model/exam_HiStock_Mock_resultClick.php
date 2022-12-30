<?php
//連線資料庫
require_once("../vender/dbtools.inc.php");

//默認時區
date_default_timezone_set('PRC');

// 設置資料類型 json，編碼格式 utf-8
header('Content-Type: application/json; charset=UTF-8');

//取得AJAX資料
$number = $_POST["number"];

//取得題目資訊
$SQL = mysql_query("
	SELECT * FROM examDB_hiStock WHERE number = '$number'
");
$sqlFETCH = mysql_fetch_array($SQL);
$topic = $sqlFETCH[4];
$choiceA = $sqlFETCH[5];
$choiceB = $sqlFETCH[6];
$choiceC = $sqlFETCH[7];
$choiceD = $sqlFETCH[8];

//回傳陣列
$arr = array($topic, $choiceA, $choiceB, $choiceC, $choiceD);
echo json_encode($arr);
exit();

?>