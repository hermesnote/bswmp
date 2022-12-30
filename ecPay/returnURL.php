<?php
require_once ("../vender/dbtools.inc.php");
require_once ("ECPay.Payment.Integration.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

date_default_timezone_set('Asia/Taipei');
 
define( 'ECPay_MerchantID', '3114991' );
define( 'ECPay_HashKey', 'LIxB6RbVnd1dAJK2' );
define( 'ECPay_HashIV', 'xlee27vLKUhHB1jg' );

//取得今天日期
$todayDate = date("Y-m-d H:i:s");

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

//取得回傳資料
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
	
	//設定回接參數
	$orderNO = $MerchantTradeNo;
	
	//對比訂單編號是否存在 orderList
	$sqlMerchantTradeNoExit = mysql_query("SELECT * FROM orderList WHERE orderNO = '$orderNO'");
	$sqlMerchantTradeNoRow = mysql_num_rows($sqlMerchantTradeNoExit);

		//如果存在，則取得ordeList的其它參數
		if ($sqlMerchantTradeNoRow != 0){

			//orderNO --> teamNO @ orderList
			$sqlOrderList = mysql_query(" SELECT * FROM orderList WHERE orderNO = '$orderNO' ");
			$orderList = mysql_fetch_row($sqlOrderList);
			$teamNO = $orderList[3];  //取得已完成訂單中隊伍編號或測驗編號(SG, CG, NCS, HT, HS)
			$projectNO = $orderList[4];  //取得活動代碼
			
			//更新訂單狀態
			$sqlUPDATE = ("
				UPDATE orderList
				SET
				payStatus = '繳費完成',
				payWay = '$PaymentType',
				payTime = '$PaymentDate'
				WHERE orderNO = '$orderNO';
			");
			$sqlDOUPDATE = mysql_query($sqlUPDATE);

			
				// 判斷活動編號 - 全國財管競賽 : SG
				if (preg_match("/SG/i", $teamNO)){
					
					// 設定活動資料表 取得projectName
					$listDB = "competList";
					$memberDB = "socialInfo";
					
					$sqlListDB = mysql_query(" SELECT projectName FROM $listDB WHERE projectNO = '$projectNO' ");
					$competList = mysql_fetch_row($sqlListDB);
					$projectName = $competList[0];  // 取得projectName

						
					$sqlINSERTscore = "
						INSERT INTO competScore ( dateTime, projectNO, teamNO )
						VALUES ( '$todayDate', '$projectNO', '$teamNO'  )
					";
					$sqlDOINSERT = mysql_query($sqlINSERTscore, $sqlLink);
					
					
					//取得報名者或隊長 email
						$sqlemailSearch = "SELECT email FROM $memberDB WHERE teamNO = '$teamNO' AND remarks = '隊長' ";
						$sqlemailResult = mysql_query($sqlemailSearch, $sqlLink);
						$sqlemailFetch = mysql_fetch_row($sqlemailResult);
						$getemail = $sqlemailFetch[0];  //取得隊長Email
					
			
				// 判斷活動編號 - 大專財管競賽 : CG CN CC CS
				}
			
				else if(preg_match("/CG/i", $teamNO) || preg_match("/CN/i", $teamNO) || preg_match("/CC/i", $teamNO) || preg_match("/CS/i", $teamNO)){
					
					// 設定活動資料表 取得projectName
					$listDB = "competList";
					$memberDB = "studentsInfo";
					
					$sqlListDB = mysql_query(" SELECT projectName FROM $listDB WHERE projectNO = '$projectNO' ");
					$competList = mysql_fetch_row($sqlListDB);
					$projectName = $competList[0];  // 取得projectName

						
					$sqlINSERTscore = "
						INSERT INTO competScore ( dateTime, projectNO, teamNO )
						VALUES ( '$todayDate', '$projectNO', '$teamNO'  )
					";
					$sqlDOINSERT = mysql_query($sqlINSERTscore, $sqlLink);
					
					
					//取得報名者或隊長 email
					$sqlemailSearch = "SELECT email FROM $memberDB WHERE teamNO = '$teamNO' AND remarks = '隊長' ";
					$sqlemailResult = mysql_query($sqlemailSearch, $sqlLink);
					$sqlemailFetch = mysql_fetch_row($sqlemailResult);
					$getemail = $sqlemailFetch[0];  //取得隊長Email

					
				// 判斷活動編號 - 金融證券投資 HT HS
				}
			
				else if (preg_match("/HT/i", $teamNO)){
					
					// 設定活動資料表 取得projectName
					$listDB = "histock_eventList";
					$memberDB = "histock_HTinfo";
					$scoreDB = "histock_HTscore";
					
					$sqlListDB = mysql_query(" SELECT projectName FROM $listDB WHERE projectNO = '$projectNO' ");
					$eventList = mysql_fetch_row($sqlListDB);
					$projectName = $eventList[0];  // 取得projectName
					
					// 隊編入評分資料
					$sqlINSERTscore = mysql_query("
						INSERT INTO $scoreDB ( projectNO, examNumber )
						VALUES ( '$projectNO', '$teamNO' )
					");
					$sqlDOINSERT = mysql_query($sqlINSERTscore, $sqlDOINSERT);
					
					//找出identifyNO
					$sqlID = mysql_query("
						SELECT identifyNO FROM histock_HTsignup WHERE examNumber = '$teamNO'
					");
					$sqlGetID = mysql_fetch_row($sqlID);  //取得報名者ID
					$identifyNO = $sqlGetID[0];

					//找出email
					$sqlEmail = mysql_query("
						SELECT email FROM histock_HTinfo WHERE identifyNO = '$identifyNO'
					");
					$sqlGetEmail = mysql_fetch_row($sqlEmail);
					$getemail = $sqlGetEmail[0];
		
				}
			
				else if (preg_match("/HS/i", $teamNO)){
					
					// 設定活動資料表 取得projectName
					$listDB = "histock_eventList";
					$memberDB = "histock_HSinfo";
					$scoreDB = "histock_HSscore";
					
					$sqlListDB = mysql_query(" SELECT projectName FROM $listDB WHERE projectNO = '$projectNO' ");
					$eventList = mysql_fetch_row($sqlListDB);
					$projectName = $eventList[0];  // 取得projectName
					
					// 隊編入評分資料
					$sqlINSERTscore = mysql_query("
						INSERT INTO $scoreDB ( projectNO, examNumber )
						VALUES ( '$projectNO', '$teamNO' )
					");
					$sqlDOINSERT = mysql_query($sqlINSERTscore, $sqlDOINSERT);
					
					//examNO 找出email
					$sqlEmail = mysql_query("
						SELECT email FROM histock_HSinfo WHERE examNumber = '$teamNO' AND remarks = '隊長'
					");
					$sqlGetEmail = mysql_fetch_row($sqlEmail);
					$getemail = $sqlGetEmail[0];
				}
			
		}

		//查詢 orderNO @ receiptList
			$sqlorderNOSearch = "SELECT * FROM receiptList WHERE orderNO = '$orderNO' ";
			$sqlorderNOResult = mysql_query($sqlorderNOSearch, $sqlLink);
			$sqlorderNORow = mysql_num_rows($sqlorderNOResult);

		if ($sqlorderNORow === 0){

			// 設定收據項目名稱
			$recieveProject = $projectName.'報名費';

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
			$sqlreceiptInsert = "
			INSERT IGNORE INTO receiptList (dealTime, receiptNO, orderNO, dealNO, projectName, MN) 
			VALUES ('$TradeDate', '$receiptNO', '$MerchantTradeNo', '$TradeNo', '$recieveProject', '$TradeAmt')
			";
			$sqlreceiptInsertDo = mysql_query($sqlreceiptInsert, $sqlLink);


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

			require_once("../model/cc_CaptainMailSend.php");
			require_once("../model/cc_ecPayedMailSelf.php"); //寄發付款完成通知信到協會信箱

		}	
}
				
//寫入Log
	$file_name = "../log/competLog.txt"; //檔案名稱
	$file = @file("$file_name"); //讀取檔案
	$open = @fopen("$file_name","a"); //開啟檔案，要是沒有檔案將建立一份
	$log =  "\r\n$todayDate 已收到 來自 $teamNO 於活動 $projectNO 的繳費, 訂單編號$MerchantTradeNo, 繳費方式$PaymentType, 金額$TradeAmt";
//	$log =  "\r\n$todayDate '隊編：'$teamNO, '活動代碼：'$projectNO, '活動名稱：'$projectName, '近期收據：'$receiptLastNO, '收據號碼：'$receiptNO, '收據項目：'$recieveProject, '隊長mail：'$getemail";
	@fwrite($open,$log); //寫入資料
	fclose($open); //關閉檔案				

				
// 接收到資訊回應綠界
echo '1|OK';	
?>