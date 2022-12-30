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
$EPT = "EPT";
$EXT = "EXT"; // 已報名
$app = "app";  // 檢測完成


//取AJAX傳值
$projectNO = $_POST["projectNO"];
$memName = $_POST["memName"];
$memId = $_POST["memId"];
$memSN = $_POST["memSN"];
$memMobile = $_POST["memMobile"];
$memEmail = $_POST["memEmail"];


// 隊員
if( ($memName != '')&&($memId != '')&&($memSN != '')&&($memMobile != '')&&($memEmail != '') ){  // 資料填寫完整查核 若其一欄位不為空則需填寫 否則PASS
	// 若各欄位都有資料 則進行所有查核
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
		echo json_encode($EXT);
		exit();
	}	
}else if( ($memName == '')&&($memId == '')&&($memSN == '')&&($memMobile == '')&&($memEmail == '') ){
	// 若各欄位都沒有資料 則回傳checked給過
	echo json_encode($app);	
	exit();
}else{ // 若部分有資料則回傳EPT
	echo json_encode($EPT);
	exit();
}

//回傳成功訊息
echo json_encode($app);

?>