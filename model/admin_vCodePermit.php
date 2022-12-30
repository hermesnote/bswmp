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
$vCode = $_POST["vCode"];

//建立回傳數
$vCodePermit = '已核准';

//更新eventList
$sqlUpdate = "
	UPDATE eventList
	set status = '啟用中'
	WHERE eventCode = '$vCode'
";
$sqlDoUpdate = mysql_query($sqlUpdate, $sqlLink);


//取得申請人的email
$sqlSELECTstaffNO = " SELECT * FROM eventList WHERE eventCode = '$vCode' ";
$sqlRESULTstaffNO = mysql_query($sqlSELECTstaffNO, $sqlLink);
$sqlFETCHstaffNO = mysql_fetch_row($sqlRESULTstaffNO);
$staffNO = $sqlFETCHstaffNO[10];

$sqlSELECTstaffEmail = " SELECT * FROM staffList WHERE staffNO = '$staffNO' ";
$sqlRESULTstaffEmail = mysql_query($sqlSELECTstaffEmail, $sqlLink);
$sqlFETCHstaffEmail = mysql_fetch_row($sqlRESULTstaffEmail);
$staffEmail = $sqlFETCHstaffEmail[10];
$email = $staffEmail;

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
$mail->Subject = "已收到您提交申請的vCode需求《已核准》"; //信件主旨
$mail->Body = "
	  <p> vCode：$vCode </p>
	  <p> 相關vCode資訊請登入後台vCode專區 </p>
";
$mail->Send();


echo json_encode($vCodePermit);
exit();

?>