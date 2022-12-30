<?php
//連線資料庫
require_once ("../vender/dbtools.inc.php");

// 設置資料類型 json，編碼格式 utf-8
header('Content-Type: application/json; charset=UTF-8');

//取得現在時間
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
$dataEPT = "無此成員";
$delDone = "刪除成功";

//組合地址


//取得AJAX傳值
$identifyNO = $_POST["identifyNO"];
	if($name != '' && $identifyNO == ''){
		echo json_encode($idEPT);
		exit();
	}

//檢查成員資料是否已經存在
$sqlSELECTData = "SELECT * FROM $memberDB WHERE teamNO = '$teamNO' AND identifyNO = '$identifyNO' ";
$sqlResultData = mysql_query($sqlSELECTData, $sqlLink);
$sqlNUMsData = mysql_num_rows($sqlResultData);
$sqlData = $sqlNUMsData;

//刪除成員資料
$sqlDELETE = "DELETE FROM $memberDB WHERE teamNO = '$teamNO' AND identifyNO = '$identifyNO' ";	

//寫入資料庫
if ($sqlData == 0){
	echo json_encode($dataEPT);
	exit();
} else {
	$sqlDo = mysql_query($sqlDELETE, $sqlLink);
}

//寫入Log
	$file_name = "../log/competLog.txt"; //檔案名稱
	$file = @file("$file_name"); //讀取檔案
	$open = @fopen("$file_name","a"); //開啟檔案，要是沒有檔案將建立一份
	$log =  "\r\n$todayDate $teamNO 刪除了隊員資料 $identifyNO";
	@fwrite($open,$log); //寫入資料
	fclose($open); //關閉檔案

//回傳成功訊息
echo json_encode($delDone);




?>