<?php
//連線資料庫
require_once("../vender/dbtools.inc.php");

//取得現在日期時間
$todayDate = date("Y-m-d H:i:s");

//COOKIE陣列解序
$loginInfo = unserialize($_COOKIE["loginCompet"]);

//取得COOKIE內容
$teamDB = $loginInfo[0];
$memberDB = $loginInfo[1];
$teamNO = $loginInfo[2];
$teamName = $loginInfo[3];
$projectNO = $loginInfo[4];
$projectName = $loginInfo[5];
$competInfo = $loginInfo[6];
$passed = $loginInfo[7];

//建立回傳參數
$uploadingDone = "上傳成功";

//更新評分資料庫
$sqlINSERTcompetScore = "  
		UPDATE competScore
		SET
		firstReport = '已繳交'
		WHERE teamNO = '$teamNO';
";
$sqlINSERT = mysql_query($sqlINSERTcompetScore);

//寫入Log
	$file_name = "../log/competLog.txt"; //檔案名稱
	$file = @file("$file_name"); //讀取檔案
	$open = @fopen("$file_name","a"); //開啟檔案，要是沒有檔案將建立一份
	$log =  "\r\n$todayDate $teamNO 完成了 $projectName 初賽檔案上傳";
	@fwrite($open,$log); //寫入資料
	fclose($open); //關閉檔案

?>