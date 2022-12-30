<?php
//連線資料庫
	require_once ("../vender/dbtools.inc.php");

// 設置資料類型 json，編碼格式 utf-8
	header('Content-Type: application/json; charset=UTF-8');

//取得今天日期
	$todayDate = date("Y-m-d H:i:s");

//取得使用者資料
	$passed = $_COOKIE["passed"];
	$account = $_COOKIE["account"];
	$staffNO = $_COOKIE["staffNO"];

//建立回傳參數
	$delDone = "資料已刪除！";

//取得AJAX傳值
	$teamNO = $_POST["teamNO"];
	$memberDB = $_POST["memberDB"];

//刪除成隊伍資料
	$sqlDELmember = "DELETE FROM $memberDB WHERE teamNO = '$teamNO' AND remarks='副手' ";
	mysql_query($sqlDELmember, $sqlLink);

//寫入Log
	$file_name = "../log/competLog.txt"; //檔案名稱
	$file = @file("$file_name"); //讀取檔案
	$open = @fopen("$file_name","a"); //開啟檔案，要是沒有檔案將建立一份
	$log =  "\r\n$todayDate $staffNO 刪除了 $teamNO 的副手";
	@fwrite($open,$log); //寫入資料
	fclose($open); //關閉檔案

//回傳成功訊息
	echo json_encode($delDone);
	exit();

?>