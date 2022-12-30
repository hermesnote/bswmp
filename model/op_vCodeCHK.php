<?php
//連線資料庫
require_once ("../vender/dbtools.inc.php");

// 設置資料類型 json，編碼格式 utf-8
header('Content-Type: application/json; charset=UTF-8');

//取得資料
$getToday = date("Y-m-d H:i:s");
$vCode = $_POST["vCode"];

//建立回傳參數
$vCode1 = "vCode不存在!";
$vCode2 = "vCode已過期!";
$vCode3 = "vCode已滿額!";
$vCode4 = "vCode不可使用!";

// vCode@eventList
$sqlSELECTvCode = " SELECT * FROM eventList WHERE eventCode = '$vCode' ";
$sqlRESULTvCode = mysql_query($sqlSELECTvCode, $sqlLink);
$sqlFETCHvCode = mysql_fetch_row($sqlRESULTvCode);
$vCodeDescribe = $sqlFETCHvCode[4];
$vCodeDate = $sqlFETCHvCode[6];
$vCodeLimited = $sqlFETCHvCode[9];
$vCodeStatus = $sqlFETCHvCode[11];

//vCode@orderList
$sqlSELECTvCodeOrder = " SELECT * FROM orderList WHERE eventCode = '$vCode' ";
$sqlRESULTvCodeOrder = mysql_query($sqlSELECTvCodeOrder, $sqlLink);
$sqlNUMvCodeOrder = mysql_num_rows($sqlRESULTvCodeOrder);

//判斷vCode
if ($sqlFETCHvCode == '' ){
	echo json_encode($vCode1);
	exit();
}else if ( strtotime($vCodeDate) <= strtotime($getToday) ){
	echo json_encode($vCode2);
	exit();
}else if ( $vCodeLimited <= $sqlNUMvCodeOrder ){
	echo json_encode($vCode3);
	exit();
}else if ( $vCodeStatus != '啟用中' ){
	echo json_encode($vCode4);
	exit();
}else{
	//準備回傳vCode Describe
	setcookie("vCode", $vCode, time()+3600, "/" ,"wmpcca.com");
	echo json_encode($vCodeDescribe);
}


?>