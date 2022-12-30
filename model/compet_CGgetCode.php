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

//建立資料庫
$teamDB = "competCollege";
$memberDB = "studentsInfo";

//建立回傳參數
$schoolPreEPT = "請選擇代表學校";
$teacherNameEPT = "請填寫指導老師姓名";
$teamNameEPT = "隊名不可為空";
$teamNameEXT = "隊名已被使用";
$teamNameWRG = "隊名不可使用特殊符號";
$nameEPT = "隊長姓名不可為空";
$nameWRG = "隊長姓名不可使用特殊符號";
$nameEXT = "請勿重覆報名";
$identifyNOEPT = "身份證字號不可為空";
$emailEPT = "電子郵件不可為空";
$emailWRG = "電子郵件格式不正確";
$getCodeDone = "TRUE";

//取得AJAX傳值
$projectNO = $_POST["projectNO"];
$advisor = $_POST["advisor"];


$schoolDistrict = $_POST["schoolDistrict"];
	if($schoolDistrict == ''){
		echo json_encode($schoolPreEPT);
		exit();
	}
$schoolPre = $_POST["schoolPre"];
	if($schoolPre == ''){
		echo json_encode($schoolPreEPT);
		exit();
	}
$teacherName = $_POST["teacherName"];
	if($teacherName == ''){
		echo json_encode($teacherNameEPT);
		exit();
	}
$teamName = $_POST["teamName"];
	if($teamName == ''){
		echo json_encode($teamNameEPT);
		exit();
	}
$name = $_POST["name"];
	if($name == ''){
		echo json_encode($nameEPT);
		exit();
	}
$identifyNO = $_POST["identifyNO"];
	if($identifyNO == ''){
		echo json_encode($identifyNOEPT);
		exit();
	}
$email = $_POST["email"];
	if($email == ''){
		echo json_encode($emailEPT);
		exit();
	}

//隊名查核
if (!preg_match("/^[\x{4e00}-\x{9fa5}A-Za-z0-9]+$/u", $teamName)){
	echo json_encode($teamNameWRG);
	exit();
}
//隊長名查核
if (!preg_match("/^[\x{4e00}-\x{9fa5}A-Za-z0-9]+$/u", $name)){
	echo json_encode($nameWRG);
	exit();
}
//email查核
if (!preg_match('/^([^@\s]+)@((?:[-a-z0-9]+\.)+[a-z]{2,})$/', $email)){
	echo json_encode($emailWRG);
	exit();
}
 
//隊名使用狀況
$sqlSELECTteamName = " SELECT * FROM $teamDB WHERE projectNO = '$projectNO' AND teamName = '$teamName' ";
$sqlRESULTteamName = mysql_query($sqlSELECTteamName, $sqlLink);
$sqlNUMteamName = mysql_num_rows($sqlRESULTteamName);
if($sqlNUMteamName != 0){
	echo json_encode($teamNameEXT);
	exit();
}

//隊長報名狀況
$sqlSELECTname = " SELECT * FROM $memberDB WHERE projectNO = '$projectNO' AND identifyNO = '$identifyNO' ";
$sqlRESULTname = mysql_query($sqlSELECTname, $sqlLink);
$sqlNUMname = mysql_num_rows($sqlRESULTname);
if($sqlNUMname != 0){
	echo json_encode($nameEXT);
	exit();
}

//生成隊伍編號
$teamNO = $projectNO.substr(date("d"),0,2).substr(date("s"),0,2).str_pad(mt_rand(0000, 9999), 4, "0", STR_PAD_LEFT);

//生成驗證碼
$str="QWERTYUIOPASDFGHJKLZXCVBNM1234567890qwertyuiopasdfghjklzxcvbnm";
str_shuffle($str);
$vCode = substr(str_shuffle($str), 26, 8);

//寫入隊伍資料庫
$sqlINSERTData = "
	INSERT INTO competCollege ( registerTime, projectNO, teamNO, district, school, teamName, teacher, advisor, vCode )
	VALUES ( '$getToday', '$projectNO', '$teamNO', '$schoolDistrict', '$schoolPre', '$teamName', '$teacherName', '$advisor', '$vCode' )
";
$sqlINSERT = mysql_query($sqlINSERTData, $sqlLink);

//寫入隊員資料庫
$sqlINSERTCapData = "
	INSERT INTO studentsInfo ( registerTime, projectNO, teamNO, name, identifyNO, email, school, remarks )
	VALUES ( '$getToday', '$projectNO', '$teamNO', '$name', '$identifyNO', '$email', '$schoolPre', '隊長' )
";
$sqlINSERTCap = mysql_query($sqlINSERTCapData, $sqlLink);

//發送信件
require '../ecPay/Exception.php';
require '../ecPay/PHPMailer.php';
require '../ecPay/SMTP.php';

$mail = new PHPMailer(true);

// 設定為 SMTP 方式寄信
$mail->IsSMTP();

//設定為HTML
$mail->isHTML();

// SMTP 伺服器的設定，以及驗證資訊
$mail->SMTPAuth = true;      
$mail->Host = "wmpcca.com"; //請填您有指過到大朵主機的網址名稱
$mail->Port = 25; //大朵主機的郵件伺服器port為 25 
$mail->SMTPAuth = false;
$mail->SMTPSecure = false;

// 信件內容的編碼方式       
$mail->CharSet = "utf-8";

// 信件處理的編碼方式
$mail->Encoding = "base64";

// SMTP 驗證的使用者資訊
$mail->Username = "service@wmpcca.com";  //在cpanel新增mail的帳號（需要完整的mail帳號，含@後都要填寫）
$mail->Password = "Since2018";  //在cpanel新增mail帳號時設定的密碼，請小心是否有空格，空格也算一碼。

//設定Mail共用參數

//寄發開通碼通知Email
require_once("../model/compet_getCodeMailContent.php");	

//寫入Log
	$file_name = "../log/competLog.txt"; //檔案名稱
	$file = @file("$file_name"); //讀取檔案
	$open = @fopen("$file_name","a"); //開啟檔案，要是沒有檔案將建立一份
	$log =  "\r\n$getToday $name 新增了一筆 $projectNO 報名資料, 隊名$teamName, 取得隊編$teamNO, 驗證碼寄至$email";
	@fwrite($open,$log); //寫入資料
	fclose($open); //關閉檔案

//回傳成功訊息
echo json_encode($getCodeDone);

?>