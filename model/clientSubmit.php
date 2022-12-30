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

//建立回傳參數
$clientNameEPT = "請填寫您的大名";
$clientPhoneEPT = "請填寫聯絡電話";
$clientEmailEPT = "請填寫Email";
$submitDone = '已收到您的申請！請留意專人與您聯絡！';

//取得傳值
$clientName = $_POST["clientName"];
	if($clientName == ''){
		echo json_encode($clientNameEPT);
		exit();
	}
$clientPhone = $_POST["clientPhone"];
	if($clientPhone == ''){
		echo json_encode($clientPhoneEPT);
		exit();
	}
$clientEmail = $_POST["clientEmail"];
	if($clientEmail == ''){
		echo json_encode($clientEmailEPT);
		exit();
	}

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
$email = 'wmpdatw@gmail.com';

//寄發開通碼通知Email
$mail->ClearAddresses();
$mail->setFrom('service@wmpcca.com', '台灣財富管理規劃顧問認證協會'); 
$mail->AddAddress($email);
$mail->Subject = "案主徵選申請"; //信件主旨
$mail->Body = "
姓名：$clientName<br>
電話：$clientPhone<br>
Email：$clientEmail
";
$mail->Send();

//回傳成功訊息
echo json_encode($submitDone);
?>