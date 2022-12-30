<?php
//連線資料庫
require_once ("../vender/dbtools.inc.php");

// 設置資料類型 json，編碼格式 utf-8
header('Content-Type: application/json; charset=UTF-8');


//取得COOKIE
$teamNO = $_COOKIE["teamNO"];
$teamName = $_COOKIE["teamName"];
$passed = $_COOKIE["passed"];
$projectNO = $_COOKIE["projectNO"];
$projectName = $_COOKIE["projectName"];
$teamDB = $_COOKIE["teamDB"];
$passed = $_COOKIE["passed"];
$memberDB = $_COOKIE["memberDB"];

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
$sqlSELECTData = "SELECT * FROM $memberDB WHERE teamNO = '$teamNO' AND identifyNO = '$identifyNO' AND remarks='隊員' ";
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

//回傳成功訊息
echo json_encode($delDone);




?>