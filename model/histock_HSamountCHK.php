<?php


//連線資料庫
require_once ("../vender/dbtools.inc.php");

//設定時區
date_default_timezone_set('Asia/Taipei');

// 設置資料類型 json，編碼格式 utf-8
header('Content-Type: application/json; charset=UTF-8');

//取得現在時間
$getToday = date("Y-m-d H:i:s");

//建立資料庫
$teamDB = "histock_HSsignup";

//建立回傳參數
$full = "full";
$app = "app";
$dup = "dup";
$teamNameWRG = "teamNameWRG";

//取得AJAX傳值
$projectNO = $_POST["projectNO"];  // 競賽代號
$amount = $_POST["amount"]; // 每校限額
$conference = $_POST["conference"]; // 分區
$city = $_POST["city"]; // 城市
$hischool = $_POST["hischool"]; // 學校
$teacher = $_POST["teacher"]; // 學校
$teamName = $_POST["teamName"]; // 學校

// 查詢學校報名狀況
$sqlSELECTamountCHK = " SELECT * FROM $teamDB WHERE projectNO = '$projectNO' AND city = '$city' AND school = '$hischool' ";
$sqlRESULTamountCHK = mysql_query($sqlSELECTamountCHK, $sqlLink);
$sqlNUMsamountCHK = mysql_num_rows($sqlRESULTamountCHK);
if($sqlNUMsamountCHK >= $amount){  //設定每校最高報名隊數
	echo json_encode($full);
	exit();
}

//隊名查核
if (!preg_match("/^[\x{4e00}-\x{9fa5}A-Za-z0-9]+$/u", $teamName)){
	echo json_encode($teamNameWRG);
	exit();
}

// 查詢隊伍名稱是否已被使用
$sqlSELECTteamName = " SELECT * FROM $teamDB WHERE projectNO = '$projectNO' AND teamName = '$teamName' ";
$sqlRESULTteamName = mysql_query($sqlSELECTteamName, $sqlLink);
$sqlNUMteamName = mysql_num_rows($sqlRESULTteamName);
if($sqlNUMteamName != 0){
	echo json_encode($dup);
	exit();
}

//回傳成功訊息
echo json_encode($app);

?>