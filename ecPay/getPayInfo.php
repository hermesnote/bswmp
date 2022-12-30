<?php
require_once ("../vender/dbtools.inc.php");

//取得現在時間
$todayDate = date("Y-m-d H:i:s");
$getToday = date("Y-m-d H:i:s");

//綠界帳號
$ServiceURL  = 'https://payment.ecpay.com.tw/SP/CreateTrade';
$HashKey     = 'LIxB6RbVnd1dAJK2' ;
$HashIV      = 'xlee27vLKUhHB1jg' ;
$MerchantID  = '3114991';
$EncryptType = '1';

require_once ("ECPay.Payment.Integration.php");

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

//轉出隊伍編號
$teamNO = substr($MerchantTradeNo, 0, -3);

//隊編查找隊伍資料庫
if (preg_match("/SG/i", $teamNO)){
	$teamDB = 'competSocial';
}else if (preg_match("/HS/i", $teamNO)){
	$teamDB = 'competHiStock';
}else{
	$teamDB = 'competCollege';
}

//隊伍編號查找projectNO
$sqlSELECTprojectNO = " SELECT projectNO FROM $teamDB WHERE teamNO = '$teamNO' ";
$sqlRESULTprojectNO = mysql_query($sqlSELECTprojectNO, $sqlLink);
$sqlFETCHprojectNO = mysql_fetch_row($sqlRESULTprojectNO);
$projectNO = $sqlFETCHprojectNO[0];

// 如果取號成功, 更新訂單資訊
if ( ($RtnCode =='2' || $RtnCode == '10100073') && $CheckMacValue == $_POST['CheckMacValue'] ){

	//寫入訂單資料庫 orderList
	$sqlINSERTorderList = "
						INSERT INTO orderList ( orderTime, orderNO, customerNO, projectNO, MN, payWay, payStatus, BankCode, vAccount, PaymentNo, ExpireDate )
						VALUES ( '$getToday', '$MerchantTradeNo', '$teamNO', '$projectNO', '$TradeAmt', '$PaymentType', '已取號', '$BankCode', '$vAccount', '$PaymentNo', '$ExpireDate' )
						";
	$sqlINSERT = mysql_query($sqlINSERTorderList);
}

//寫入Log
	$file_name = "../log/competLog.txt"; //檔案名稱
	$file = @file("$file_name"); //讀取檔案
	$open = @fopen("$file_name","a"); //開啟檔案，要是沒有檔案將建立一份
	$log =  "\r\n$todayDate $teamNO 已完成 $MerchantTradeNo 訂單之 $PaymentType 繳費取號 ";
	@fwrite($open,$log); //寫入資料
	fclose($open); //關閉檔案


// 接收到資訊回應綠界
echo '1|OK';
?>