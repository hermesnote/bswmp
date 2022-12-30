<?php
require_once ("../vender/dbtools.inc.php");
require_once ("ECPay.Payment.Integration.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

date_default_timezone_set('Asia/Taipei');
 
define( 'ECPay_MerchantID', '3113939' );
define( 'ECPay_HashKey', 'IEvkRJ8sWJTsMXbX' );
define( 'ECPay_HashIV', 'uc0QZRGpDZEn4f3C' );
 
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
//取得付款時間的民國年月日 1999/11/11 12:12:12
	$PaymentDateY = substr($PaymentDate, 0, 4) - 1911;
	$PaymentDateM = substr($PaymentDate, 5, 2);
	$PaymentDateD = substr($PaymentDate, 8, 2);
$PaymentType = $_POST["PaymentType"];
$PaymentTypeChargeFee = $_POST["PaymentTypeChargeFee"];
$TradeDate = $_POST["TradeDate"];
$SimulatePaid = $_POST["SimulatePaid"];
$CheckMacValue = $_POST["CheckMacValue"];


// 必須要支付成功並且驗證碼正確
if ( $_POST['RtnCode'] =='1' && $CheckMacValue == $_POST['CheckMacValue'] ){
	
	//設定參數
	$orderNO = $MerchantTradeNo;
	
	//對比訂單編號是否存在 orderList
	$sqlMerchantTradeNoExit = "SELECT * FROM orderList WHERE orderNO = '$orderNO'";
	$sqlMerchantTradeNoResult = mysql_query($sqlMerchantTradeNoExit, $sqlLink);
	$sqlMerchantTradeNoRow = mysql_num_rows($sqlMerchantTradeNoResult);

		//如果存在，則取得ordeList的其它參數
		if ($sqlMerchantTradeNoRow != 0){

			//orderNO --> teamNO @ orderList
			$sqlSELECTteamNO = " SELECT customerNO FROM orderList WHERE orderNO = '$orderNO' ";
			$sqlRESULteamNO = mysql_query($sqlSELECTteamNO, $sqlLink);
			$sqlFETCHteamNO = mysql_fetch_row($sqlRESULteamNO);
			$teamNO = $sqlFETCHteamNO[0];

			//orderNO --> projectNO @ ordeList
			$sqlSELECTprojectNO = " SELECT projectNO FROM orderList WHERE orderNO = '$orderNO' ";
			$sqlRESULprojectNO = mysql_query($sqlSELECTprojectNO, $sqlLink);
			$sqlFETCHprojectNO = mysql_fetch_row($sqlRESULprojectNO);
			$projectNO = $sqlFETCHprojectNO[0];

			//projectNO --> projectName @ competList
			$sqlSELECTprojectName = " SELECT projectName FROM competList WHERE projectNO = '$projectNO' ";
			$sqlRESULprojectName = mysql_query($sqlSELECTprojectName, $sqlLink);
			$sqlFETCHprojectName = mysql_fetch_row($sqlRESULprojectName);
			$projectName = $sqlFETCHprojectName[0];
			$recieveProject = $projectName.'報名費';

			//更新繳費狀態
			$sqlUpdatePayStatus = "UPDATE orderList SET payStatus = '繳費完成' WHERE orderNO = '$orderNO'"  ;
			$sqlUpdatePayStatusResult = mysql_query($sqlUpdatePayStatus, $sqlLink);
			
			//更新付款方式
			$sqlUpdatePayWay = "UPDATE orderList SET payWay = '$PaymentType' WHERE orderNO = '$orderNO'"  ;
			$sqlUpdatePayWayResult = mysql_query($sqlUpdatePayWay, $sqlLink);

			//更新付款時間
			$sqlUpdatePayTime = "UPDATE orderList SET payTime = '$PaymentDate' WHERE orderNO = '$orderNO'"  ;
			$sqlUpdatePayTimeResult = mysql_query($sqlUpdatePayTime, $sqlLink);	
		}
	
	//查詢 orderNO @ receiptList
		$sqlorderNOSearch = "SELECT * FROM receiptList WHERE orderNO = '$orderNO' ";
		$sqlorderNOResult = mysql_query($sqlorderNOSearch, $sqlLink);
		$sqlorderNORow = mysql_num_rows($sqlorderNOResult);

		if ($sqlorderNORow === 0){

				//生成一組今天的第一組
				$receiptToday = date(Ymd)."001";

				//查詢收據資料庫是否已存在
				$sqlreceiptTodaySearch = "SELECT * FROM receiptList WHERE receiptNO = '$receiptToday'";
				$sqlreceiptTodayResult = mysql_query($sqlreceiptTodaySearch, $sqlLink);
				$sqlreceiptTodayRow = mysql_num_rows($sqlreceiptTodayResult);	

				//取得資料庫最近一筆收據號碼
				$sqlgetReceiptNOSearch = "SELECT receiptNO FROM receiptList ORDER BY id DESC";
				$sqlgetReceiptNOResult = mysql_query($sqlgetReceiptNOSearch, $sqlLink);
				$sqlgetReceiptNOFetch = mysql_fetch_row($sqlgetReceiptNOResult);
				$receiptLastNO = $sqlgetReceiptNOFetch[0];

				//如果數組已經存在，則取最近一筆收據尾數+1做為本次收據號碼，如果數組不存在，則直接取用為收據號碼
				if ($sqlreceiptTodayRow != 0){
					$receiptNO = $receiptLastNO+1;
				}else{
					$receiptNO = $receiptToday;
				}

				//更新收據資料庫
				$sqlreceiptInsert = "INSERT IGNORE INTO receiptList (dealTime, receiptNO, orderNO, dealNO, projectName, MN) VALUES
														('$TradeDate', '$receiptNO', '$MerchantTradeNo', '$TradeNo', '$recieveProject', '$TradeAmt')";	
				$sqlreceiptInsertDo = mysql_query($sqlreceiptInsert, $sqlLink);


//					//隊編查找評分資料庫
//					if (preg_match("/SG/i", $teamNO)){
//						$competScoreDB = 'competScoreSG';
//						$memberDB = 'socialInfo';
//					}
//					if (preg_match("/CG/i", $teamNO)){
//						$competScoreDB = 'competScoreCG';
//						$memberDB = 'studentsInfo';
//					}
//					if (preg_match("/CN/i", $teamNO)){
//						$memberDB = 'studentsInfo';
//					}
//					if (preg_match("/CC/i", $teamNO)){
//						$memberDB = 'studentsInfo';
//					}
//					if (preg_match("/CS/i", $teamNO)){
//						$memberDB = 'studentsInfo';
//					}

//					//取得projectNO並更新評分資料庫
//					$sqlSELECTprojectNO = " SELECT projectNO FROM competCollege WHERE teamNO = '$teamNO' ";
//					$sqlRESULTprojectNO = mysql_query($sqlSELECTprojectNO, $sqlLink);
//					$sqlFETCHprojectNO = mysql_fetch_row($sqlRESULTprojectNO);
//					$projectNO = $sqlFETCHprojectNO[0];
//
//					//更新評分資料庫
//					$sqlUPDATEcompetScore = "
//						INSERT INTO competScore ( projectNO, teamNO ) VALUES( '$projectNO', '$teamNO' )
//						ON DUPLICATE KEY UPDATE
//						projectNO = '$projectNO', teamNO = '$getTeamNO'
//					";
//					$sqlINSERTCompetScore = mysql_query($sqlUPDATEcompetScore);		

					//用隊編找出隊長 email
						$sqlemailSearch = "SELECT email FROM $memberDB WHERE teamNO = '$teamNO' AND remarks = '隊長' ";
						$sqlemailResult = mysql_query($sqlemailSearch, $sqlLink);
						$sqlemailFetch = mysql_fetch_row($sqlemailResult);
						$getemail = $sqlemailFetch[0];  //取得隊長Email
						
					//寄發完成繳費通知Email
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

					//寄發「隊長」繳費完成通知Email
					if ($getemail != '') {
					require_once("../model/cc_CaptainMailSend.php");
					require_once("../model/cc_ecPayedMailSelf.php"); //寄發付款完成通知信到協會信箱
					}

		}	


}
				
				

				
// 接收到資訊回應綠界
echo '1|OK';	
?>