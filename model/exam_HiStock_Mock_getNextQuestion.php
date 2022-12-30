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

$answerArray = unserialize($_COOKIE["answer"]);
$answerPre = $answerArray[$i];
$AN = $answerPre;

$AQ = $_POST["AQ"];  //取得作答選項
$AQArray = unserialize($_COOKIE["AQ"]);  //AQ陣列解序
array_push($AQArray, "$AQ");
setcookie("AQ", serialize($AQArray), time()+3600, "/" ,"wmpcca.com");

$AT = $_POST["ansS"];  //取得作答秒數
$ATArray = unserialize($_COOKIE["AT"]);  //AT陣列解序
array_push($ATArray, "$AT");
setcookie("AT", serialize($ATArray), time()+3600, "/" ,"wmpcca.com");

//取得本次作題號的答案建立
$i = $listNumber-1;

//取得下一題題號
$numberArray = unserialize($_COOKIE["number"]);
$preNumber = $numberArray[$i];
$numberNext = $numberArray[$listNumber];
$number = $numberNext;

////取得下一題答案
//$answerArray = unserialize($_COOKIE["answer"]);
//$answerNext = $answerArray[$listNumber];
//$answer = $answerNext;

	//提出下一題資料
	$sqlSELECT1 = mysql_query("
		SELECT * FROM examDB_hiStock WHERE number = '$numberNext'
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