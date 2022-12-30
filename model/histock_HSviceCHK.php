<?php


//連線資料庫
require_once ("../vender/dbtools.inc.php");

//載入PHPmailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//設定時區
date_default_timezone_set('Asia/Taipei');

// 設置資料類型 json，編碼格式 utf-8
header('Content-Type: application/json; charset=UTF-8');

//取得現在時間
$getToday = date("Y-m-d H:i:s");

//設定連線資料庫
$memberDB = "histock_HSinfo";

//建立回傳參數
$nameWRG = "nameWRG"; //姓名格式錯誤
$emailWRG = "emailWRG"; // mail格式錯誤
$EXT = "EXT"; // 已報名
$app = "app";  // 檢測完成


//取AJAX傳值
$projectNO = $_POST["projectNO"];
$viceName = $_POST["viceName"];
$viceId = $_POST["viceId"];
$viceSN = $_POST["viceSN"];
$viceMobile = $_POST["viceMobile"];
$viceEmail = $_POST["viceEmail"];


// 副手
if( $viceName != '' ){
	//姓名格式查核
	if (!preg_match("/^[\x{4e00}-\x{9fa5}A-Za-z0-9]+$/u", $viceName)){
		echo json_encode($nameWRG);
		exit();
	}
	//email查核
	if (!preg_match('/^([^@\s]+)@((?:[-a-z0-9]+\.)+[a-z]{2,})$/', $viceEmail)){
		echo json_encode($emailWRG);
		exit();
	}
	// 查核隊長報名狀況
	$sqlSELECText = " SELECT * FROM $memberDB WHERE projectNO = '$projectNO' AND identifyNO = '$viceId' ";
	$sqlRESULText = mysql_query($sqlSELECText, $sqlLink);
	$sqlNUMext = mysql_num_rows($sqlRESULText);
	if($sqlNUMext != 0){
		echo json_encode($EXT);
		exit();
	}
}


//回傳成功訊息
echo json_encode($app);

?>