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


//取得cookie
$passed = $_COOKIE["passed"];
$account = $_COOKIE["account"];
$staffNO = $_COOKIE["staffNO"];
$staffName = $_COOKIE["staffName"];

// 若cookie中的變數passed不為TRUE，則導回登入頁
if ($passed != "TRUE"){
echo "<script type='text/javascript'>";
echo "alert('COOKIE錯誤或逾時!請重新登入！')";
echo "</script>";
header("location:admin_login.php");
exit();
}

//取得現在時間
$getToday = date("Y-m-d H:i:s");

//接值
$examNO = $_POST["examNO"];
	if ( preg_match('/HT/i', $examNO) ){
		// 報名資料庫
		$signupDB = "histock_HTsignup";
	}else if ( preg_match('/HS/i', $examNO) ){
		// 報名資料庫
		$signupDB = "histock_HSsignup";
	}
$value = $_POST["value"];
$identifyNO = $_POST["identifyNO"];
$projectNO = $_POST["projectNO"];

//回傳訊息
$examNOEPT = "選拔代號不存在！";
$swichY = "已設為公關招待";
$swichN = "已移除公關招待";


//取得帳號email
$sqlMail = mysql_query("
	SELECT email FROM $infoDB WHERE identifyNO = '$identifyNO'
");
$sqlMailFETCH = mysql_fetch_row($sqlMail);
$email = $sqlMailFETCH[0];


//更新資料庫
if ( $value == 'Y' ){
	//由Y回空值 = 移除公關招待
	$sqlUPDATE = ("
		UPDATE $signupDB
		SET
		host = ''
		WHERE examNumber = '$examNO';
	");
	$sqlDoUPDATE = mysql_query($sqlUPDATE, $sqlLink);
	
	// 隊編移除評分資料
	$scoreDB = "histock_HTscore";
	$sqlDropData = " DELETE FROM $scoreDB WHERE examNumber = '$examNO' ";
	mysql_query($sqlDropData);
	
	//寫入Log
	$file_name = "../log/adminLog.txt"; //檔案名稱
	$file = @file("$file_name"); //讀取檔案
	$open = @fopen("$file_name","a"); //開啟檔案，要是沒有檔案將建立一份
	$log =  "\r\n$getToday $staffNO 設定 $examNO $swichN 並已移除評分資料";
	@fwrite($open,$log); //寫入資料
	fclose($open); //關閉檔案
	
	//回傳成功訊息
	echo json_encode($swichN);
	exit();
	
}else{
	
	//由空值進Y = 設定公關招待
	$sqlUPDATE = ("
		UPDATE $signupDB
		SET
		host = 'Y'
		WHERE examNumber = '$examNO';
	");
	$sqlDoUPDATE = mysql_query($sqlUPDATE, $sqlLink);
	
	//取得bach
	$sqlBachX = mysql_query("
		SELECT bach FROM $signupDB WHERE examNumber = '$examNO'
	");
	$sqlBachY = mysql_fetch_row($sqlBachX);
	$bach = $sqlBachY[0];
	
	// 隊編入評分資料
	$scoreDB = "histock_HTscore";
	$sqlINSERTscore = mysql_query("
		INSERT INTO $scoreDB ( projectNO, examNumber, bach )
		VALUES ( '$projectNO', '$examNO', '$bach' )
	");
	$sqlDOINSERT = mysql_query($sqlINSERTscore, $sqlDOINSERT);
	
	//寫入Log
	$file_name = "../log/adminLog.txt"; //檔案名稱
	$file = @file("$file_name"); //讀取檔案
	$open = @fopen("$file_name","a"); //開啟檔案，要是沒有檔案將建立一份
	$log =  "\r\n$getToday $staffNO 設定 $examNO $swichY 並新增評分資料";
	@fwrite($open,$log); //寫入資料
	fclose($open); //關閉檔案
	
//	//設定email訊息
//	$swichHost = $swichY;
//	
//		//發送信件
//		require '../ecPay/Exception.php';
//		require '../ecPay/PHPMailer.php';
//		require '../ecPay/SMTP.php';
//
//		$mail = new PHPMailer(true);
//
//		// 設定為 SMTP 方式寄信
//		$mail->IsSMTP();
//
//		//設定為HTML
//		$mail->isHTML();
//
//		// SMTP 伺服器的設定，以及驗證資訊
//		$mail->SMTPAuth = true;      
//		$mail->Host = "wmpcca.com"; //請填您有指過到大朵主機的網址名稱
//		$mail->Port = 25; //大朵主機的郵件伺服器port為 25 
//		$mail->SMTPAuth = false;
//		$mail->SMTPSecure = false;
//
//		// 信件內容的編碼方式       
//		$mail->CharSet = "utf-8";
//
//		// 信件處理的編碼方式
//		$mail->Encoding = "base64";
//
//		// SMTP 驗證的使用者資訊
//		$mail->Username = "service@wmpcca.com";  //在cpanel新增mail的帳號（需要完整的mail帳號，含@後都要填寫）
//		$mail->Password = "Since2018";  //在cpanel新增mail帳號時設定的密碼，請小心是否有空格，空格也算一碼。
//
//		//設定Mail共用參數
//
//
//
//		//寄發開通碼通知Email
//		require_once("../model/histock_HTsignupHostMailContent.php");
	
	//回傳成功訊息
	echo json_encode($swichY);
	exit();
	
}


//	

?>