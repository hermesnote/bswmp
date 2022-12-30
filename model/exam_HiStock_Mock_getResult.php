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
$listNumber = $_POST["listNumber"];
$ansS = $_POST["ansS"];
$AQ = $_POST["AQ"];

//建立下一題題號
$nextNumber = 'number'.$listNumber;
$number = $_COOKIE[$nextNumber];

	//提出下一題資料
	$sqlSELECT1 = mysql_query("
		SELECT * FROM examDB_hiStock WHERE number = '$number'
	");
	$sqlFETCH1 = mysql_fetch_array($sqlSELECT1);
	$topic = $sqlFETCH1[4];
	$choiceA = $sqlFETCH1[5];
	$choiceB = $sqlFETCH1[6];
	$choiceC = $sqlFETCH1[7];
	$choiceD = $sqlFETCH1[8];

	//建立下一題題序
	$listNumber++;
	
	//建立回傳陣列
	$arr = array($listNumber, $number, $topic, $choiceA, $choiceB, $choiceC, $choiceD);
	echo json_encode($arr);
	exit();

?>