<!-- 載入資料庫連線PHP程式 -->
<?php require_once("../vender/dbtools.inc.php") ?>

<?php
require_once 'ECPay.Payment.Integration.php';
 
define( 'ECPay_MerchantID', '3110390' );
define( 'ECPay_HashKey', 'zMMDwouZHSKTU7Un' );
define( 'ECPay_HashIV', 'FfrKQer0AxyhsEsj' );

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
	$getTeamNO = $sqlGetTeamNOFetch[0];
}

//用隊編找出隊員email
$sqlStudentsEmailSearch = "SELECT studentEmail FROM studentsInfo WHERE teamNO = '$getTeamNO' ";
$sqlStudentsEmailResult = mysql_query($sqlStudentsEmailSearch, $sqlLink);
$sqlStudentsEmailFetch = mysql_fetch_row($sqlStudentsEmailResult);
$mail1 = $sqlStudentsEmailFetch[0];
$mail2 = $sqlStudentsEmailFetch[1];
$mail3 = $sqlStudentsEmailFetch[2];

// 必須要支付成功並且驗證碼正確
if ( $RtnCode == '1' && $CheckMacValue == $_POST['CheckMacValue'] ){
	//更新繳費方式
	$sqlUpdatePayStatus = "UPDATE orderList SET payStatus = '完成' WHERE orderNO = '$MerchantTradeNo'"  ;
	$sqlUpdatePayStatusResult = mysql_query($sqlUpdatePayStatus, $sqlLink);
}

 
// 接收到資訊回應綠界
echo '1|OK';
?>

