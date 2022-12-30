<?php require_once("accountLoad.php") ?>

<?php
require_once ("../vender/dbtools.inc.php");
require_once ("ECPay.Payment.Integration.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

date_default_timezone_set('Asia/Taipei');

define( 'ECPay_MerchantID', $MerchantID );
define( 'ECPay_HashKey', $HashKey   );
define( 'ECPay_HashIV', $HashIV  );
 
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


$MerchantID = $_POST["MerchantID"]; //取得商店編號
$MerchantTradeNo = $_POST["MerchantTradeNo"]; //取得訂單編號
$StoreID = $_POST["StoreID"]; // 取得旗下店鋪編號
$RtnCode = $_POST["RtnCode"]; //取得交易狀態
$RtnMsg = $_POST["RtnMsg"]; //取得交易訊息
$TradeNo = $_POST["TradeNo"]; //取得綠界交易編號
$TradeAmt = $_POST["TradeAmt"]; //取得交易金額
$PaymentType = $_POST["PaymentType"]; //取得付款方式
$TradeDate = $_POST["TradeDate"]; //取得訂單成立時間
$CustomField1 = $_POST["CustomField1"]; //
$CustomField2 = $_POST["CustomField2"]; //
$CustomField3 = $_POST["CustomField3"]; //
$CustomField4 = $_POST["CustomField4"]; //
$CheckMacValue = $_POST["CheckMacValue"];

//取得ATM或CVS繳費資訊
$BankCode = $_POST["BankCode"]; //取得繳費銀行的代碼
$vAccount = $_POST["vAccount"]; //取得虛擬帳號
$PaymentNo = $_POST["PaymentNo"]; //取得繳費代碼
$ExpireDate = $_POST["ExpireDate"]; //取得繳費期限

//取得訂單目前繳費狀態 @ orderList
$sqlpayStatusSearch = "SELECT payStatus FROM orderList WHERE orderNO = '$MerchantTradeNo'";
$sqlpayStatusResult = mysql_query($sqlpayStatusSearch, $sqlLink);
$sqlpayStatusFetch = mysql_fetch_row($sqlpayStatusResult);
$payStatus = $sqlpayStatusFetch[0];	

//訂單編號取得隊伍編號
$sqlGetTeamNO = "SELECT customerNO FROM orderList WHERE orderNo = '$MerchantTradeNo'";
$sqlGetTeamNOResult = mysql_query($sqlGetTeamNO, $sqlLink);
$sqlGetTeamNOFetch = mysql_fetch_row($sqlGetTeamNOResult);
$getTeamNO = $sqlGetTeamNOFetch[0];  //取得隊伍編號

//用隊編取得隊伍名稱
$sqlGetTeamName = "SELECT teamName FROM competCollege WHERE teamNO = '$getTeamNO' ";
$sqlGetTeamNameResult = mysql_query($sqlGetTeamName, $sqlLink);
$sqlGetTeamNameFetch = mysql_fetch_row($sqlGetTeamNameResult);
$getTeamName = $sqlGetTeamNameFetch[0]; //取得隊伍名稱

//用隊編取得代表學校	
$sqlSchoolPre = "SELECT school FROM competCollege WHERE teamNO = '$getTeamNO' ";
$sqlSchoolPreResult = mysql_query($sqlSchoolPre, $sqlLink);
$sqlGetSchoolFetch = mysql_fetch_row($sqlSchoolPreResult);
$getSchool = $sqlGetSchoolFetch[0]; //取得代表學校

//隊伍編號取得隊長MAIL
$sqlStudentsEmailSearch = "SELECT studentEmail FROM studentsInfo WHERE teamNO = '$getTeamNO' AND remarks = '隊長' ";
$sqlStudentsEmailResult = mysql_query($sqlStudentsEmailSearch, $sqlLink);
$sqlStudentsEmailFetch = mysql_fetch_row($sqlStudentsEmailResult);
$getCaptainEmail = $sqlStudentsEmailFetch[0];  //取得隊長Email

//設定Mail共用參數
$School =  $getSchool; //代表學校
$teamNO = $getTeamNO; //隊編
$teamName = $getTeamName; //隊名
$captainName = $getCaptainName; //隊長名字

// 如果取號成功, 更新訂單資訊
if ( ($RtnCode =='2' || $RtnCode == '10100073') && $CheckMacValue == $_POST['CheckMacValue'] ){

	//如果OrderList 繳費狀態為空 則更新取號資訊 並發信
	if ($payStatus == ''){

		//訂單OrderList paymentInfo1 繳費銀行更新
		$sqlUpdateOrderListInfo1 = "UPDATE orderList SET paymentInfo1 = '$BankCode' WHERE orderNO = '$MerchantTradeNo'"  ;
		$sqlUpdateOrderListInfo1Do = mysql_query($sqlUpdateOrderListInfo1, $sqlLink);

		//訂單OrderList paymentInfo2 繳費帳號更新
		$sqlUpdateOrderListInfo2 = "UPDATE orderList SET paymentInfo2 = '$vAccount' WHERE orderNO = '$MerchantTradeNo'"  ;
		$sqlUpdateOrderListInfo2Do = mysql_query($sqlUpdateOrderListInfo2, $sqlLink);
	
		//訂單OrderList paymentInfo3 繳費帳號更新
		$sqlUpdateOrderListInfo3 = "UPDATE orderList SET paymentInfo3 = '$PaymentNo' WHERE orderNO = '$MerchantTradeNo'"  ;
		$sqlUpdateOrderListInfo3Do = mysql_query($sqlUpdateOrderListInfo3, $sqlLink);
		
		//訂單OrderList ExpireDate 繳費期限更新
		$sqlUpdateOrderListExpireDate = "UPDATE orderList SET ExpireDate = '$ExpireDate' WHERE orderNO = '$MerchantTradeNo'"  ;
		$sqlUpdateOrderListExpireDate = mysql_query($sqlUpdateOrderListExpireDate, $sqlLink);
	
	
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

			//寄發繳費通知Email給隊長
			require_once("../model/cc_paymentInfoMail.php"); //通知隊長
		}
}

// 如果CVS取號成功, 更新訂單資訊
//if ( $RtnCode =='10100073' && $CheckMacValue == $_POST['CheckMacValue'] ){
//    // 
//	//訂單OrderList paymentInfo3 繳費帳號更新
//		$sqlUpdateOrderListInfo3 = "UPDATE orderList SET paymentInfo3 = '$PaymentNo' WHERE orderNO = '$MerchantTradeNo'"  ;
//		$sqlUpdateOrderListInfo3Do = mysql_query($sqlUpdateOrderListInfo3, $sqlLink);
//	//寄發Email
//	require 'Exception.php';
//	require 'PHPMailer.php';
//	require 'SMTP.php';
//
//	$mail = new PHPMailer(true);
//
//	// 設定為 SMTP 方式寄信
//	$mail->IsSMTP();
//
//	//設定為HTML
//	$mail->isHTML();
//
//	// SMTP 伺服器的設定，以及驗證資訊
//	$mail->SMTPAuth = true;      
//	$mail->Host = "wmpcca.com"; //請填您有指過到大朵主機的網址名稱
//	$mail->Port = 25; //大朵主機的郵件伺服器port為 25 
//	$mail->SMTPAuth = false;
//	$mail->SMTPSecure = false;
//
//	// 信件內容的編碼方式       
//	$mail->CharSet = "utf-8";
//
//	// 信件處理的編碼方式
//	$mail->Encoding = "base64";
//
//	// SMTP 驗證的使用者資訊
//	$mail->Username = "service@wmpcca.com";  //在cpanel新增mail的帳號（需要完整的mail帳號，含@後都要填寫）
//	$mail->Password = "Since2018";  //在cpanel新增mail帳號時設定的密碼，請小心是否有空格，空格也算一碼。
//
//	//寄發「隊長」通知Email
//	if ($getCaptainEmail != '') {
//	require_once("../model/cc_paymentInfoMail.php");
//	}
//	break;
//}


// 接收到資訊回應綠界
echo '1|OK';
?>