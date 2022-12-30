<?php
require_once ("../vender/dbtools.inc.php");
require_once ("ECPay.Payment.Integration.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

date_default_timezone_set('Asia/Taipei');
 
define( 'ECPay_MerchantID', '3110390' );
define( 'ECPay_HashKey', 'zMMDwouZHSKTU7Un' );
define( 'ECPay_HashIV', 'FfrKQer0AxyhsEsj' );
 
// 重新整理回傳參數。
$arParameters = $_POST;
foreach ($arParameters as $keys => $value) {
    if ($keys != 'CheckMacValue') {
        if ($keys == 'PaymentType') {
            $value = str_replace('_CVS', '', $value);
            $value = str_replace('_BARCODE', '', $value);
            $value = str_replace('_CreditCard', '', $value);
        }
        if ($keys == 'PeriodType') {
            $value = str_replace('Y', 'Year', $value);
            $value = str_replace('M', 'Month', $value);
            $value = str_replace('D', 'Day', $value);
        }
        $arFeedback[$keys] = $value;
    }
}
 
// 計算出 CheckMacValue
$CheckMacValue = ECPay_CheckMacValue::generate( $arParameters, ECPay_HashKey, ECPay_HashIV );


$MerchantID = $_POST["MerchantID"];
$MerchantTradeNo = $_POST["MerchantTradeNo"];
$StoreID = $_POST["StoreID"];
$RtnCode = $_POST["RtnCode"];
$RtnMsg = $_POST["RtnMsg"];
$TradeNo = $_POST["TradeNo"];
$TradeAmt = $_POST["TradeAmt"];
$PaymentDate = $_POST["PaymentDate"];
$PaymentType = $_POST["PaymentType"];
$PaymentTypeChargeFee = $_POST["PaymentTypeChargeFee"];
$TradeDate = $_POST["TradeDate"];
$SimulatePaid = $_POST["SimulatePaid"];
$CustomField1 = $_POST["CustomField1"];
$CustomField2 = $_POST["CustomField2"];
$CustomField3 = $_POST["CustomField3"];
$CustomField4 = $_POST["CustomField4"];
$CheckMacValue = $_POST["CheckMacValue"];

//對比訂單編號是否存在
$sqlMerchantTradeNOExit = "SELECT * FROM orderList WHERE orderNO = '$MerchantTradeNO'";
$sqlMerchantTradeNOResult = mysql_query($sqlMerchantTradeNOExit, $sqlLink);
$sqlMerchantTradeNORow = mysql_num_rows($sqlMerchantTradeNOResult);

//如果存在，則取得訂單的隊伍編號
if ($sqlMerchantTradeNORow != ''){
	$sqlGetTeamNO = "SELECT customerNO FROM orderList WHERE orderNo = '$MerchantTradeNo'";
	$sqlGetTeamNOResult = mysql_query($sqlGetTeamNO, $sqlLink);
	$sqlGetTeamNOFetch = mysql_fetch_row($sqlGetTeamNOResult);
	$getTeamNO = $sqlGetTeamNOFetch[0];  //取得隊伍編號
}

//用隊編取得隊名
if ($getTeamNO != ''){
	$sqlGetTeamName = "SELECT teamName FROM competCollege WHERE teamNO = '$getTeamNO' ";
	$sqlGetTeamNameResult = mysql_query($sqlGetTeamName, $sqlLink);
	$sqlGetTeamNameFetch = mysql_fetch_row($sqlGetTeamNameResult);
	$getTeamName = $sqlGetTeamNameFetch[0]; //取得隊伍名稱

//用隊編取得代表學校	
	$sqlSchoolPre = "SELECT school FROM competCollege WHERE teamNO = '$getTeamNO' ";
	$sqlSchoolPreResult = mysql_query($sqlSchoolPre, $sqlLink);
	$sqlGetSchoolFetch = mysql_fetch_row($sqlStudentsEmailResult);
	$getSchool = $sqlGetSchoolFetch[0]; //取得代表學校

//用隊編找出隊員email
	$sqlStudentsEmailSearch = "SELECT studentEmail FROM studentsInfo WHERE teamNO = '$getTeamNO' ";
	$sqlStudentsEmailResult = mysql_query($sqlStudentsEmailSearch, $sqlLink);
	$sqlStudentsEmailFetch = mysql_fetch_row($sqlStudentsEmailResult);
	$getCaptainEmail = $sqlStudentsEmailFetch[0];  //取得隊長Email
	$getMember1Email = $sqlStudentsEmailFetch[1];  //取得隊員1 Email
	$getMember2Email = $sqlStudentsEmailFetch[2];  //取得隊員2 Email
}


//用Email取得報名者的其它資料
if ($getCaptainEmail !=''){
$sqlGetCaptainInfo = "SELECT * FROM studentsInfo WHERE studentEmail = '$getCaptainEmail'";
$sqlGetCaptainInfoResult = mysql_query($sqlGetCaptainInfo, $sqlLink);
$sqlGetCaptainInfoData = mysql_fetch_row($sqlGetCaptainInfoResult);
$captainName = $sqlGetCaptainInfoData[4]; //取得隊長姓名
}


// 必須要支付成功並且驗證碼正確
if ( $_POST['RtnCode'] =='1' && $CheckMacValue == $_POST['CheckMacValue'] ){
	//更新繳費狀態
	$sqlUpdatePayStatus = "UPDATE orderList SET payStatus = '完成' WHERE orderNO = '$MerchantTradeNo'"  ;
	$sqlUpdatePayStatusResult = mysql_query($sqlUpdatePayStatus, $sqlLink);
	//更新付款方式
	$sqlUpdatePayWay = "UPDATE orderList SET payWay = '$PaymentType' WHERE orderNO = '$MerchantTradeNo'"  ;
	$sqlUpdatePayWayResult = mysql_query($sqlUpdatePayWay, $sqlLink);
}

//寄發Email
require 'Exception.php';
require 'PHPMailer.php';
require 'SMTP.php';

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

//寄發「隊長」通知Email
if ($getCaptainEmail != '') {
$userMail = $getCaptainEmail;
$School =  $getSchool; //代表學校
$teamNO = $getTeamNO; //隊編
$teamName = $getTeamName; //隊名
$captainName = $captainName; //隊長名字
	
$mail->setFrom('service@wmpcca.com', '台灣財富管理規劃顧問認證協會'); 
$mail->AddAddress($userEmail);
$mail->Subject = "您已完成報名"; //信件主旨
$mail->Body = "
<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml'>
 <head>
  <meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
  <title>ecPayed Email</title>
  <meta name='viewport' content='width=device-width, initial-scale=1.0'/>
</head>
<body style='margin: 0; padding: 0;background: #F0F0F0'>
<table align='center' border='0' cellpadding='0' cellspacing='0' width='700' style='max-width:100%' bordercolor='#F0F0F0' style='margin-top: 30px;margin-bottom: 30px;'>
 <tr>
  <td bgcolor='white' align='center'>
	  <a href='http://www.wmpcca.com'><img src='https://wmpcca.com/bswmp/form/img/cc_mail_Main.png' alt='' width='700' height='488' max-width='100%' style='display: block;' /></a>
	 </td>
 </tr>
<tr>
<td bgcolor='#ffffff' style='padding: 30px 30px 30px 30px;'>
 <table border='3' bordercolor='#067277' cellpadding='0' cellspacing='0' width='80%' align='center'>
  <tr>
   <td align='center'>
    	<hr color='white'>
	  <a style='color:#F8B218;font-family:微軟正黑體;font-size:20px;font-weight: 800;'> - 歡迎參加 2019全國大專盃分區理財規劃競賽 - </a><br>
	  <a style='color:#F8B218;font-family:微軟正黑體;font-size:20px;font-weight: 800;'> - 您已完成報名，以下是您的競賽資訊 - </a><br>
	  <a style='color:#067277;font-family:微軟正黑體;font-size:20px;font-weight: 800;'>代表學校：$School</a><br>
	  <a style='color:#067277;font-family:微軟正黑體;font-size:20px;font-weight: 800;'>隊伍名稱：$teamName</a><br>
	  <a style='color:#067277;font-family:微軟正黑體;font-size:20px;font-weight: 800;'>隊伍編號：$teamNO</a><br>
	  <a style='color:#067277;font-family:微軟正黑體;font-size:20px;font-weight: 800;'>隊長代表：$captainName</a><br>
	  <br>
	  <br>
	  <a style='color:silver;font-family:微軟正黑體;font-size:16px;font-weight: 800;'>※以上報名資料如有問題請利用下方表單聯絡協會</a>
		<hr color='white'>
   </td>
  </tr>
 </table>
</td>
</tr>
<tr>
  <td bgcolor='white' align='center'>
	  <a href='https://wmpcca.com/bswmp/form/view/cc_signup.php'><img src='https://wmpcca.com/bswmp/form/img/asc1-4.png' width='346' height='60'></a>
	  <a href='https://goo.gl/2J6T3X'><img src='http://wmpcca.com/wp-content/uploads/2018/09/asc2-4.png' width='346' height='60'></a>
  </td>
</tr>
 <tr>
  <td bgcolor='white' align='center'>
	  <a href='https://www.holdingkeys.com'><img src='http://wmpcca.com/wp-content/uploads/2018/09/asc4-4.png' width='346' height='60'></a>
	  <a href='http://wmpcca.com/contact/'><img src='http://wmpcca.com/wp-content/uploads/2018/09/asc3-4.png' width='346' height='60'></a>
  </td>
 </tr>
 <tr>
  <td bgcolor='white'>
<h3>台灣財富管理規劃顧問認證協會 WMPCCA</h3>
<h4>任何問題，請點擊上方聯絡協會：填寫線上聯絡表單，或參考以下資訊：<br>
<a href='http://www.wmpcca.com'>協會首頁</a> | E-mail：<a href='mailto:wmpdatw@gmail.com'>wmpdatw@gmail.com</a><br>
電話：(02)2501-6862 | 傳真：(02)2501-6882<br>
週一至週五09:30-18:00</h4>
  </td>
 </tr>
<tr>
	<td>
		<a style='font-size: 13px'>此為系統自動發送，請勿直接回覆。可以參考我們的<a href='http://www.wmpcca.com' style='font-size: 13px'>隱私權政策</a>. <a style='font-size: 13px'>為了確保能收到來自台灣財富管理規劃顧問認證協會的信件，請將service@wmpcca.com加入您的通訊錄</a>
	</td>
</tr>
</table>
</body>
</html>
";
$mail->Send();	
}
//寄發「隊員1」通知Email
//寄發「隊員2」通知Email

//建立收據資料


// 接收到資訊回應綠界
echo '1|OK';
?>