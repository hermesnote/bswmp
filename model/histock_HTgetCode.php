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
$signupDB = "histock_HTsignup";
$infoDB = "histock_HTinfo";

//取得場次及名額
$HTsqlSELECTcompetData = " SELECT * FROM histock_eventList WHERE projectNO LIKE '%HT%' ORDER BY id DESC ";
$HTsqlResultcompetData = mysql_query($HTsqlSELECTcompetData, $sqlLink);
$HTsqlFETCHcompetData = mysql_fetch_row($HTsqlResultcompetData);
$bach1Limit = $HTsqlFETCHcompetData[9];
$bach2Limit = $HTsqlFETCHcompetData[12];
$bach3Limit = $HTsqlFETCHcompetData[15];

//取得各場次已報名
$sqlBach1Count = mysql_query("
	SELECT * FROM histock_HTsignup WHERE bach = 'bach1'
");
$bach1Used = mysql_num_rows($sqlBach1Count);

$sqlBach2Count = mysql_query("
	SELECT * FROM histock_HTsignup WHERE bach = 'bach2'
");
$bach2Used = mysql_num_rows($sqlBach2Count);

$sqlBach3Count = mysql_query("
	SELECT * FROM histock_HTsignup WHERE bach = 'bach3'
");
$bach3Used = mysql_num_rows($sqlBach3Count);

//計算各場次剩餘
$bach1Left = $bach1Limit - $bach1Used;
$bach2Left = $bach2Limit - $bach2Used;
$bach3Left = $bach3Limit - $bach3Used;

//建立回傳參數
	//留空
$areaEPT = '請選擇學校所在分區';
$cityEPT = '請選擇學校所在城市';
$schoolEPT = '請選擇任職學校';
$sexEPT = '請選擇稱謂';
$departEPT = '請填寫完整任教科系名稱';
$nameEPT = '請填寫姓名';
$identifyNOEPT = '請填寫身份證字號';
$mobileEPT = '請填寫行動電話';
$emailEPT = '請填寫Email';
$bachEPT = '請選擇欲報名之場次';

	//符號
$departWRG = "科系名稱需為中文";
$nameWRG = '姓名需為中文';
$identifyNOWRG = '身份證填寫需為大寫英文及數字';
$mobileWRG = '行動電話格式錯誤';
$emailWRG = 'Email格式錯誤';

	//報名訊息
$reSignup = "請勿重覆報名";
$bachFull = "欲報名場次已額滿！請選擇其它場次！";

	//成功
$getCodeDone = '報名成功！';

//取得AJAX傳值
$projectNO = $_POST["projectNO"];

//找出projectName
$sqlSELECTProjectName = mysql_query("
	SELECT projectName FROM histock_eventList WHERE projectNO = '$projectNO'
");
$sqlFETCHProjectName = mysql_fetch_row($sqlSELECTProjectName);
$projectName = $sqlFETCHProjectName[0];


//取得表單值
$area = $_POST["area"];
	if($area == ''){
		echo json_encode($areaEPT);
		exit();
	}

$city = $_POST["city"];
	if($city == ''){
		echo json_encode($cityEPT);
		exit();
	}

$school = $_POST["school"];
	if($school == ''){
		echo json_encode($schoolEPT);
		exit();
	}

$sex = $_POST["sex"];
	if($sex == ''){
		echo json_encode($sex);
		exit();
	}

$depart = $_POST["depart"];
	if($depart == ''){
		echo json_encode($departEPT);
		exit();
	}
//科系查核(不可符號)
if (!preg_match("/^([\x7f-\xff]+)$/", $depart)){
	echo json_encode($departWRG);
	exit();
}

$name = $_POST["name"];
	if($name == ''){
		echo json_encode($nameEPT);
		exit();
	}
//姓名查核(需為中文)
if (!preg_match("/^([\x7f-\xff]+)$/", $name)){
	echo json_encode($nameWRG);
	exit();
}

$identifyNO = $_POST["identifyNO"];
	if($identifyNO == ''){
		echo json_encode($identifyNOEPT);
		exit();
	}
//身份證字號(需為英數)
if (!preg_match("/^([0-9A-Za-z]+)$/", $identifyNO)){
	echo json_encode($identifyNOWRG);
	exit();
}

$mobile = $_POST["mobile"];
	if($mobile == ''){
		echo json_encode($mobileEPT);
		exit();
	}
//電話查核(需為數字)
if (!preg_match("/^([0-9]+)$/", $mobile)){
	echo json_encode($mobileWRG);
	exit();
}

$email = $_POST["email"];
	if($email == ''){
		echo json_encode($emailEPT);
		exit();
	}
//email查核
if (!preg_match('/^([^@\s]+)@((?:[-a-z0-9]+\.)+[a-z]{2,})$/', $email)){
	echo json_encode($emailWRG);
	exit();
}

$bach = $_POST["bach"];
	if($bach == ''){
		echo json_encode($bachEPT);
		exit();
	}

//額滿告知
if ( ($bach == "bach1") && ($bach1Left == 0)  ){
	echo json_encode($bachFull);
	exit();
}
if ( ($bach == "bach2") && ($bach2Left == 0)  ){
	echo json_encode($bachFull);
	exit();
}
if ( ($bach == "bach3") && ($bach3Left == 0)  ){
	echo json_encode($bachFull);
	exit();
}


//報名重覆查核
$sqlSignupCHK = mysql_query("
	SELECT * FROM $signupDB WHERE projectNO = '$projectNO' AND identifyNO = '$identifyNO'
");
$sqlSignupRow = mysql_num_rows($sqlSignupCHK);
if ($sqlSignupRow != 0){
	echo json_encode($reSignup);
	exit();
}

//找出最近新增代號尾碼
	//查找第一梯是否存在
$sqlSearchPN = mysql_query("
	SELECT examNumber FROM $signupDB WHERE examNumber LIKE 'HT%' ORDER BY id DESC
");
$sqlNUMPN = mysql_num_rows($sqlSearchPN);

if ($sqlNUMPN == 0){
	$examNO = $projectNO.'00001';
}else{
	$sqlFETCHPN = mysql_fetch_row($sqlSearchPN);
	$PN = substr($sqlFETCHPN[0], 7, 5);

	$sqlPN = $PN+1;
	$sqlPN = str_pad($sqlPN, 5, "0", STR_PAD_LEFT);
	$examNO = $projectNO.$sqlPN;
}


//生成驗證碼
$str="QWERTYUIOPASDFGHJKLZXCVBNM1234567890qwertyuiopasdfghjklzxcvbnm";
str_shuffle($str);
$vCode = substr(str_shuffle($str), 26, 8);

//寫入報名資料庫
$sqlINSERTSignup = "
	INSERT INTO $signupDB ( registerTime, projectNO, bach, identifyNO, examNumber, pwd )
	VALUES ( '$getToday', '$projectNO', '$bach', '$identifyNO', '$examNO', '$vCode' )
";
$sqlDoINSERTSignup = mysql_query($sqlINSERTSignup, $sqlLink);

//寫入個人資訊資料庫 存在則更新 不存在則插入

$sqlIDCHK = mysql_query("
	SELECT * FROM $infoDB WHERE identifyNO = 'identifyNO'
");
$sqlID = mysql_num_rows($sqlIDCHK);


if ($sqlID == 0){
	$sqlINSERT = "
		INSERT INTO $infoDB ( registerTime, area, city, school, depart, name, sex, identifyNO, mobile, email )
		VALUES ( '$getToday', '$area', '$city', '$school', '$depart', '$name', '$sex', '$identifyNO', '$mobile', '$email' )
	";
	$sqlDoINSERT = mysql_query($sqlINSERT, $sqlLink);	
}else{
	$sqlUPDATE = ("
		UPDATE $infoDB
		registerTime = '$getToday',
		area = '$area',
		city = '$city',
		school = '$school',
		depart = '$depart',
		name = '$name',
		sex = '$sex',
		mobile = '$mobile',
		email = '$email'
		WHERE identifyNO = '$identifyNO';
	");
	$sqlDoUPDATE = mysql_query($sqlUPDATE, $sqlLink);
}
//
////寫入個人資訊資料庫 存在則更新 不存在則插入
//$sqlINSERTinfo = "
//	INSERT INTO $infoDB ( registerTime, area, city, school, depart, name, sex, identifyNO, mobile, email )
//	VALUES ( '$getToday', '$area', '$city', '$school', '$depart', '$name', '$sex', '$identifyNO', '$mobile', '$email' )
//	ON DUPLICATE KEY
//	
//";
//$sqlDoINSERTinfo = mysql_query($sqlINSERTinfo, $sqlLink);

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
require_once("../model/compet_getCodeMailContent_HT.php");	


//寫入Log
	$file_name = "../log/competLog.txt"; //檔案名稱
	$file = @file("$file_name"); //讀取檔案
	$open = @fopen("$file_name","a"); //開啟檔案，要是沒有檔案將建立一份
	$log =  "\r\n$getToday $name 新增了一筆 $projectNO 報名資料, 來自 $school 的 $depart, 成功報名並取得選拔代號$examNO, 驗證碼已寄至$email";
	@fwrite($open,$log); //寫入資料
	fclose($open); //關閉檔案
//回傳成功訊息
echo json_encode($getCodeDone);
exit();

?>