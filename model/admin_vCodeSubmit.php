<?php
//連線資料庫
require_once ("../vender/dbtools.inc.php");

//載入PHPmailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// 設置資料類型 json，編碼格式 utf-8
header('Content-Type: application/json; charset=UTF-8');

//取得cookie
$passed = $_COOKIE["passed"];
// 若cookie中的變數passed不為TRUE，則導回登入頁
if ($passed != "TRUE"){
echo "<script type='text/javascript'>";
echo "alert('COOKIE逾時或錯誤!請重新登入！')";
echo "</script>";
header("location:admin_login.php");
exit();
}


//取得今天日期
$today = date("Y-m-d H:i:s");

//取得Ajax資料
$staffName = $_POST["staffName"];
$staffNO = $_POST["staffNO"];
$vCodeDescribe1 = $_POST["vCodeDescribe"];
$vCodeTarget = $_POST["vCodeTarget"];
$vCodeEndDate = $_POST["vCodeEndDate"];
$vCodeLimited = $_POST["vCodeLimited"];
$vCodeRemarks = $_POST["vCodeRemarks"];

//拆分correspond及Describe
$vCodeDescribe2 = substr($vCodeDescribe1, 2);
$vCodeCorrespond = substr($vCodeDescribe1, 0, 2);
if ($vCodeCorrespond == 'OP'){
	$vCodeCorrespond = 'KEYs首購';
}
if ($vCodeCorrespond == 'RP'){
	$vCodeCorrespond = 'KEYs續購';
}

//建立回傳數
$vCodeSubmit = '已提交您的申請！';
$dataEPT = '有資料未正確選填';

//資料檢核
if ( ($vCodeDescribe1 == '')||($vCodeTarget == '')||($vCodeEndDate == '')||($vCodeLimited == '')||($vCodeRemarks == '') ){
	echo json_encode($dataEPT);
	exit();
}

//生成vCode
$str="QWERTYUIOPASDFGHJKLZXCVBNM1234567890";
str_shuffle($str);
$vCode = substr(str_shuffle($str), 26, 8);
//do {
//	$str="QWERTYUIOPASDFGHJKLZXCVBNM1234567890";
//	str_shuffle($str);
//	$vCode = substr(str_shuffle($str), 26, 8);
//	
//	$sqlSELECTvCodeAvailable = " SELECT * FROM eventList WHERE eventCode = '$vCode'";
//	$sqlRESULTvCodeAvailable = mysql_query($sqlSELECTvCodeAvailable. $sqlLink);
//	$sqlNUMvCodeAvailable = mysql_num_rows($sqlRESULTvCodeAvailable);
//	
//}while($sqlNUMvCodeAvailable != 0);

//寫入eventList
$sqlInsert = "
	INSERT INTO eventList ( buildTime, eventCode, correspond, eventDescribe, EndTime, target, limited, applicant, status, remarks )
	VALUES ( '$today', '$vCode', '$vCodeCorrespond', '$vCodeDescribe2', '$vCodeEndDate', '$vCodeTarget', '$vCodeLimited', '$staffNO', '審核中', '$vCodeRemarks' )
";
$sqlDoInsert = mysql_query($sqlInsert, $sqlLink);

//取得申請人的email
$sqlSELECTstaffEmail = " SELECT * FROM staffList WHERE staffNO = '$staffNO' ";
$sqlRESULTstaffEmail = mysql_query($sqlSELECTstaffEmail, $sqlLink);
$sqlFETCHstaffEmail = mysql_fetch_row($sqlRESULTstaffEmail);
$email = $sqlFETCHstaffEmail[10];


//發送通知信件
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

//寄發開通碼通知Email
$mail->ClearAddresses();
$mail->setFrom('service@wmpcca.com', '台灣財富管理規劃顧問認證協會'); 
$mail->AddAddress($email);
$mail->Subject = "已收到您提交申請的vCode需求"; //信件主旨
$mail->Body = "
	  <p> 申 請 人：$staffName </p>
	  <p> 代　　碼：$staffNO </p>	  
	  <p> 申請項目：$vCodeDescribe1 </p>
	  <p> 額度上限：$vCodeLimited </p>
	  <p> ※ 後續審核結果將寄發至Email信箱 </p>
";
$mail->Send();


echo json_encode($vCodeSubmit);
exit();

?>