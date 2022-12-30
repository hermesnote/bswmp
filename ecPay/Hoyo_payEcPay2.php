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
//取得付款時間的民國年月日 1999/11/11 12:12:12
	$PaymentDateY = substr($PaymentDate, 0, 4) - 1911;
	$PaymentDateM = substr($PaymentDate, 5, 2);
	$PaymentDateD = substr($PaymentDate, 8, 2);

$PaymentType = $_POST["PaymentType"];
$PaymentTypeChargeFee = $_POST["PaymentTypeChargeFee"];
$TradeDate = $_POST["TradeDate"];
$SimulatePaid = $_POST["SimulatePaid"];
$receiptTitle = $_POST["CustomField1"];
$taxID = $_POST["CustomField2"];
$projectName = $_POST["CustomField3"].'報名費';
$CustomField4 = $_POST["CustomField4"];
$CheckMacValue = $_POST["CheckMacValue"];





// 必須要支付成功並且驗證碼正確
if ( $_POST['RtnCode'] =='1' && $CheckMacValue == $_POST['CheckMacValue'] ){


	// ****************** 更新 receiptList 並判斷orderNO是否已存在receiptList 若有則什麼也不做 若無則做完程式 以免綠界重覆執行程式******************


	//查詢 orderNO @ receiptList
	$sqlorderNOSearch = "SELECT * FROM receiptList WHERE orderNO = '$MerchantTradeNo' ";
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
			$sqlreceiptInsert = "INSERT IGNORE INTO receiptList (dealTime, receiptNO, orderNO, dealNO, receiptTitle, projectName, MN, taxID) VALUES
													('$TradeDate', '$receiptNO', '$MerchantTradeNo', '$TradeNo', '$receiptTitle', '$projectName', '$TradeAmt', '$taxID')";	
			$sqlreceiptInsertDo = mysql_query($sqlreceiptInsert, $sqlLink);
		
		
			// ****************** 更新orderList ******************
	
			//更新繳費狀態
			$sqlUpdatePayStatus = "UPDATE orderList SET payStatus = '完成' WHERE orderNO = '$MerchantTradeNo'"  ;
			$sqlUpdatePayStatusResult = mysql_query($sqlUpdatePayStatus, $sqlLink);
			//更新付款方式
			$sqlUpdatePayWay = "UPDATE orderList SET payWay = '$PaymentType' WHERE orderNO = '$MerchantTradeNo'"  ;
			$sqlUpdatePayWayResult = mysql_query($sqlUpdatePayWay, $sqlLink);
		
			//更新付款時間
			$sqlUpdatePayTime = "UPDATE orderList SET payTime = '$PaymentDate' WHERE orderNO = '$MerchantTradeNo'"  ;
			$sqlUpdatePayTimeResult = mysql_query($sqlUpdatePayTime, $sqlLink);

			//對比訂單編號是否存在 orderList
			$sqlMerchantTradeNoExit = "SELECT * FROM orderList WHERE orderNO = '$MerchantTradeNo'";
			$sqlMerchantTradeNoResult = mysql_query($sqlMerchantTradeNoExit, $sqlLink);
			$sqlMerchantTradeNoRow = mysql_num_rows($sqlMerchantTradeNoResult);
		

				//如果存在，則取得訂單的隊伍編號
				if ($sqlMerchantTradeNoRow != ''){
					$sqlGetTeamNO = "SELECT customerNO FROM orderList WHERE orderNo = '$MerchantTradeNo'";
					$sqlGetTeamNOResult = mysql_query($sqlGetTeamNO, $sqlLink);
					$sqlGetTeamNOFetch = mysql_fetch_row($sqlGetTeamNOResult);
					$getTeamNO = $sqlGetTeamNOFetch[0];  //取得隊伍編號
				}

				//如果隊編已經存在
				if ($getTeamNO != ''){
					
					
				//取得projectNO並更新competScore
				$sqlSELECTprojectNO = " SELECT projectNO FROM competCollege WHERE teamNO = '$getTeamNO' ";
				$sqlRESULTprojectNO = mysql_query($sqlSELECTprojectNO, $sqlLink);
				$sqlFETCHprojectNO = mysql_fetch_row($sqlRESULTprojectNO);
				$projectNO = $sqlFETCHprojectNO[0];

				//更新評分資料庫
				$sqlUPDATEcompetScore = "
					INSERT INTO competScore ( projectNO, teamNO ) VALUES( '$projectNO', '$getTeamNO' )
					ON DUPLICATE KEY UPDATE
					projectNO = '$projectNO', teamNO = '$getTeamNO'
				";
				$sqlINSERTCompetScore = mysql_query($sqlUPDATEcompetScore);		

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

				//用隊編找出隊長 姓名
					$sqlGetCaptainInfo = "SELECT studentName FROM studentsInfo WHERE teamNO = '$getTeamNO' AND remarks = '隊長'";
					$sqlGetCaptainInfoResult = mysql_query($sqlGetCaptainInfo, $sqlLink);
					$sqlGetCaptainInfoData = mysql_fetch_row($sqlGetCaptainInfoResult);
					$getCaptainName = $sqlGetCaptainInfoData[0]; //取得隊長姓名

				//用隊編找出隊長 email
					$sqlStudentsEmailSearch = "SELECT studentEmail FROM studentsInfo WHERE teamNO = '$getTeamNO' AND remarks = '隊長' ";
					$sqlStudentsEmailResult = mysql_query($sqlStudentsEmailSearch, $sqlLink);
					$sqlStudentsEmailFetch = mysql_fetch_row($sqlStudentsEmailResult);
					$getCaptainEmail = $sqlStudentsEmailFetch[0];  //取得隊長Email

				//用隊編找出隊員1 email
					$sqlMember1EmailSearch = "SELECT studentEmail FROM studentsInfo WHERE teamNO = '$getTeamNO' AND remarks = '隊員1' ";
					$sqlMember1EmailResult = mysql_query($sqlMember1EmailSearch, $sqlLink);
					$sqlMember1EmailFetch = mysql_fetch_row($sqlMember1EmailResult);
					$getMember1Email = $sqlMember1EmailFetch[0];  //取得隊員1 Email

				//用隊編找出隊員2 email
					$sqlMember2EmailSearch = "SELECT studentEmail FROM studentsInfo WHERE teamNO = '$getTeamNO' AND remarks = '隊員2' ";
					$sqlMember2EmailResult = mysql_query($sqlMember2EmailSearch, $sqlLink);
					$sqlMember2EmailFetch = mysql_fetch_row($sqlMember2EmailResult);
					$getMember2Email = $sqlMember2EmailFetch[0];  //取得隊員2 Email
				}
		
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

			//設定Mail共用參數
			$School =  $getSchool; //代表學校
			$teamNO = $getTeamNO; //隊編
			$teamName = $getTeamName; //隊名
			$captainName = $getCaptainName; //隊長名字

			//寄發「隊長」通知Email
			if ($getCaptainEmail != '') {
			require_once("../model/cc_CaptainMailSend.php");
			require_once("../model/cc_ecPayedMailSelf.php"); //寄發付款完成通知信到協會信箱
			}
			//寄發「隊員1」通知Email
			if ($getMember1Email != '') {
			require_once("../model/cc_Member1MailSend.php");
			}
			//寄發「隊員2」通知Email
			if ($getMember2Email != '') {
			require_once("../model/cc_Member2MailSend.php");
			}

	}
}




// 接收到資訊回應綠界
echo '1|OK';
?>