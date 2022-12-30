<?php
//連線資料庫
require_once ("../vender/dbtools.inc.php");

// 設置資料類型 json，編碼格式 utf-8
header('Content-Type: application/json; charset=UTF-8');

// 取得今天日期
$todayDate = date("Y-m-d H:i:s");

// 建立參數
$done = "done";

// 取得Ajax
$projectNO = $_POST["rankProject"];
$bach = $_POST["rankBach"];

// 撈出該梯總分不為空的數據陣列
$sqlRankX = mysql_query("
	SELECT examNumber, combineScore FROM histock_HTscore WHERE projectNO = '$projectNO' AND combineScore != ''
");
$sqlRankY = mysql_fetch_row($sqlRankX);
$rankArray = array($sqlRankY);


//寫入Log
	$file_name = "../log/adminLog.txt"; //檔案名稱
	$file = @file("$file_name"); //讀取檔案
	$open = @fopen("$file_name","a"); //開啟檔案，要是沒有檔案將建立一份
	$log =  "\r\n$todayDate $staffNO 更新了 $examNumber 的競賽分數為 $score, 總成績為 $combineScore ";
	@fwrite($open,$log); //寫入資料
	fclose($open); //關閉檔案

?>

<!doctype html>
<html>
<head>
</head>
<body>
	12
</body>
</html>