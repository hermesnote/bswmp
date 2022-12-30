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
$captainEPT = "capEPT"; // 隊長不可為空
$viceEPT = "viceEPT"; // 副手不可為空
$memEPT = "memEPT"; // 隊員僅部分資料
$capWRG = "capWRG"; //隊長姓名格式錯誤
$viceWRG = "viceWRG"; //副手姓名格式錯誤
$memWRG = "memWRG"; //隊員姓名格式錯誤
$capmailWRG = "capmailWRG"; // 隊長mail格式錯誤
$vicemailWRG = "vicemailWRG"; // 副手mail格式錯誤
$memmailWRG = "memmailWRG"; // 隊員mail格式錯誤
$capEXT = "capEXT"; // 隊長已報名
$viceEXT = "viceEXT"; // 副手已報名
$memEXT = "memEXT"; // 隊員已報名
$checked = "checked";  // 檢測完成

//取全得AJAX傳值
$projectNO = $_POST["projectNO"];
	// 隊長資料
$capName = $_POST["capName"];
$capId = $_POST["capId"];
$capSN = $_POST["capSN"];
$capMobile = $_POST["capMobile"];
$capEmail = $_POST["capEmail"];
	// 副手資料
$viceName = $_POST["viceName"];
$vicepId = $_POST["viceId"];
$viceSN = $_POST["viceSN"];
$viceMobile = $_POST["viceMobile"];
$viceEmail = $_POST["viceEmail"];
	// 隊員資料
$memName = $_POST["memName"];
$memId = $_POST["memId"];
$memSN = $_POST["memSN"];
$memMobile = $_POST["memMobile"];
$memEmail = $_POST["memEmail"];



// 隊長
if( $capName != '' ){
	//姓名格式查核
	if (!preg_match("/^[\x{4e00}-\x{9fa5}A-Za-z0-9]+$/u", $capName)){
		echo json_encode($nameWRG);
		exit();
	}
	//email查核
	if (!preg_match('/^([^@\s]+)@((?:[-a-z0-9]+\.)+[a-z]{2,})$/', $capEmail)){
		echo json_encode($emailWRG);
		exit();
	}
	// 查核隊長報名狀況
	$sqlSELECTcapEXT = " SELECT * FROM $memberDB WHERE projectNO = '$projectNO' AND identifyNO = '$capId' ";
	$sqlRESULTcapEXT = mysql_query($sqlSELECTcapEXT, $sqlLink);
	$sqlNUMcapEXT = mysql_num_rows($sqlRESULTcapEXT);
	if($sqlNUMcapEXT != 0){
		echo json_encode($capEXT);
		exit();
	}
}



// 副手
if( ($viceName != '')&&($viceId != '')&&($viceSN != '')&&($viceMobile != '')&&($viceEmail != '') ){
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
	// 查核副手報名狀況
	$sqlSELECTviceEXT = " SELECT * FROM $memberDB WHERE projectNO = '$projectNO' AND identifyNO = '$viceId' ";
	$sqlRESULTviceEXT = mysql_query($sqlSELECTviceEXT, $sqlLink);
	$sqlNUMviceEXT = mysql_num_rows($sqlRESULTviceEXT);
	if($sqlNUMviceName != 0){
		echo json_encode($viceEXT);
		exit();
	}
}else{
	echo json_encode($viceEPT);
	exit();
}



// 隊員
if( ($memName != '')&&($memId != '')&&($memSN != '')&&($memMobile != '')&&($memEmail != '') ){  // 資料填寫完整查核 若其一欄位不為空則需填寫 否則PASS
	//姓名格式查核
	if (!preg_match("/^[\x{4e00}-\x{9fa5}A-Za-z0-9]+$/u", $memName)){
		echo json_encode($nameWRG);
		exit();
	}
	//email查核
	if (!preg_match('/^([^@\s]+)@((?:[-a-z0-9]+\.)+[a-z]{2,})$/', $memEmail)){
		echo json_encode($emailWRG);
		exit();
	}
	// 查核隊員報名狀況
	$sqlSELECTmemEXT = " SELECT * FROM $memberDB WHERE projectNO = '$projectNO' AND identifyNO = '$memId' ";
	$sqlRESULTmemEXT = mysql_query($sqlSELECTmemEXT, $sqlLink);
	$sqlNUMmemEXT = mysql_num_rows($sqlRESULTmemEXT);
	if($sqlNUMmemEXT != 0){
		echo json_encode($memEXT);
		exit();
	}	
}else if( ($memName == '')&&($memId == '')&&($memSN == '')&&($memMobile == '')&&($memEmail == '') ){
	
}else{
	echo json_encode($memEPT);
	exit();
}

//回傳成功訊息
echo json_encode($checked);

?>