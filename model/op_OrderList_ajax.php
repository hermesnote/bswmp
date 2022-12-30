<?php
//連線資料庫
require_once ("../vender/dbtools.inc.php");

// 設置資料類型 json，編碼格式 utf-8
header('Content-Type: application/json; charset=UTF-8');



//取得訂購資料
$getToday = date("Y-m-d H:i:s");  //取得訂單成立時間
$orderTime = $getToday;
$productNO = $_POST["project"];  //取得產品編號
$vCode = $_COOKIE["vCode"];  //取得Cookie的vCode, 如果沒有就沒有


//取得使用者資料
$identifyNO = $_POST["identifyNO"];  //取得使用者ID, 對應客戶資料 (新KEYs客戶應無資料, 若為其它產品客戶, 則比對原始資料正確性進行更新)
$name = $_POST["name"];
$sex = $_POST["sex"];
$birth = $_POST["birth"];
$phone = $_POST["phone"];
$email = $_POST["email"];
$city = $_POST["city"];
$district = $_POST["district"];
$addr = $_POST["addr"];

//組合地址
$addrZipcode = substr($district, 0, 3);
$addrDistrict = substr($district, 4);
$combineAddr = $addrZipcode.$city.$addrDistrict.$addr;

//取得工作資料
$job = $_POST["job"];
$title = $_POST["title"];
$year = $_POST["year"];

//取得發票資料
$invoice = $_POST["invoice"];
$taxID = $_POST["taxID"];
$buyer = $_POST["buyer"];
$invoiceAddr = $_POST["invoiceAddr"];

//產品編號判斷到期日
if ($productNO == "OP001"){
	$productEndDate = date('Y-m-d', strtotime("$orderTime+12months 7days"));
}
if ($productNO == "OP002"){
	$productEndDate = date('Y-m-d', strtotime("$orderTime+25months 7days"));
}
if ($productNO == "OP003"){
	$productEndDate = date('Y-m-d', strtotime("$orderTime+39months 7days"));
}


//判別product @ productList, 取得產品名稱、單位及定價
$sqlSELECTproductNO = " SELECT * FROM productList WHERE productNO = '$productNO' ";
$sqlRESULTproductNO = mysql_query($sqlSELECTproductNO, $sqlLink);
$sqlFETCHproductNO = mysql_fetch_row($sqlRESULTproductNO);
$productName = $sqlFETCHproductNO[3];  //取得產品名稱
$productUnit = $sqlFETCHproductNO[4];  //取得產品單位
$productPrice = $sqlFETCHproductNO[5];  //取得產品定價


//判斷客戶是否存在, 若存在則取出客戶編號並覆寫現有資料
$sqlSELECTCID = " SELECT * FROM customer WHERE identifyNO = '$identifyNO' ";
$sqlRESULTCID = mysql_query($sqlSELECTCID, $sqlLink);
$sqlFETCHCID = mysql_fetch_row($sqlRESULTCID);
$customerCID = $sqlFETCHCID[2]; //提取已存在客戶的CID
$sqlNUMSCID = mysql_num_rows($sqlRESULTCID);

if ($sqlNUMSCID != 0){
	
	$CID = $customerCID;
	
	//更新現有客戶資料
	$sqlUpdateCustomer = "
		UPDATE customer
		SET initialDate='$orderTime', name='$name', sex='$sex', birth='$birth', phone='$phone', email='$email', city='$city', district='$district', addr='$addr', combineAddr='$combineAddr', job='$job', title='$title', year='$year'
		WHERE identifyNO = '$identifyNO'
		";
	$$sqlDoUpdateCustomer = mysql_query($sqlUpdateCustomer, $sqlLink);
	
}else{

	//產生客戶編號並寫入新客戶資料
	$CID = 'CID'.substr(date("Y"),2,2).substr(date("d"),0,2).substr(date("s"),0,2).str_pad(mt_rand(000, 999), 3, "0", STR_PAD_LEFT);

	//寫入客戶資料表
	$sqlINsertCustomer = "
		INSERT INTO customer ( initialDate, CID, name, sex, identifyNO, birth, phone, email, city, district, addr, combineAddr, job, title, year )
		VALUES ( '$orderTime', '$CID', '$name', '$sex', '$identifyNO', '$birth', '$phone', '$email', '$city', '$district', '$addr', '$combineAddr', '$job', '$title', '$year' )
	";
	$sqlDoInsertCustomer = mysql_query($sqlINsertCustomer, $sqlLink);

}


//判別vCode @ eventList, 取得vCode各項參數
if ($vCode != ''){
	
	// vCode@eventList
	$sqlSELECTvCode = " SELECT * FROM eventList WHERE eventCode = '$vCode' ";
	$sqlRESULTvCode = mysql_query($sqlSELECTvCode, $sqlLink);
	$sqlFETCHvCode = mysql_fetch_row($sqlRESULTvCode);
	$vCodeDescribe = $sqlFETCHvCode[4];
	$vCodeDate = $sqlFETCHvCode[6];
	$vCodeLimited = $sqlFETCHvCode[9];
	$vCodeStatus = $sqlFETCHvCode[11];
	
	if ( $vCodeDescribe == '加贈1個月' ){
		$productUnit = $productUnit+1;
		$productEndDate = date('Y-m-d', strtotime("$productEndDate+1months 7days"));
	}else if ( $vCodeDescribe == '加贈2個月' ){
		$productUnit = $productUnit+2;
		$productEndDate = date('Y-m-d', strtotime("$productEndDate+2months 7days"));
	}else if ( $vCodeDescribe == '加贈3個月' ){
		$productUnit = $productUnit+3;
		$productEndDate = date('Y-m-d', strtotime("$productEndDate+3months 7days"));
	}else if ( $vCodeDescribe == '9折優惠' ){
		$productPrice = $productPrice*0.9;
	}else if ( $vCodeDescribe == '8折優惠' ){
		$productPrice = $productPrice*0.8;
	}else if ( $vCodeDescribe == '7折優惠' ){
		$productPrice = $productPrice*0.7;
	}else if ( $vCodeDescribe == '6折優惠' ){
		$productPrice = $productPrice*0.6;
	}else if ( $vCodeDescribe == '5折優惠' ){
		$productPrice = $productPrice*0.9;
	}
	
}



//生成當日隨機訂單編號 (OP+2年+2月+2日+2秒+3隨機 = OP200103XXYYY)
$orderNO = substr("$productNO", 0, 2).substr(date("Y"),0,2).substr(date("m"),0,2).substr(date("d"),0,2).substr(date("s"),0,2).str_pad(mt_rand(000, 999), 3, "0", STR_PAD_LEFT);


//訂單資料寫入資料庫
$sqlInsertOrderList = "
	INSERT INTO orderList ( orderTime, orderNO, customerNO, projectNO, projectName, MN, payWay, payStatus, payTime, eventCode, receiptTitle, taxID, ExpireDate, remarks )
	VALUES ( '$orderTime', '$orderNO', '$CID', '$productNO', '$productName', '$productPrice', '$payWay', '$payStatus', '$payTime', '$vCode', '$buyer', '$taxID', '$productEndDate', '$productUnit' )
	";
$sqlDoInsertOrderList = mysql_query($sqlInsertOrderList, $sqlLink);

	




//-------------------------------------------
//  商家端交易授權傳送程式demo（信用卡交易）
//
//  運作原理：Form POST Method(HTTPS)，畫面轉移，不可用背景POST傳送等待回應的方式（例如php的curl函數功能）
//  流程：購物網站->send.php（本程式）->紅陽系統（Etopm.aspx）->receive.php
//  參數值說明請參見技術文件
//-------------------------------------------

//測試用設定（※請修改）
$merchantID = 'S1708109069'; //商家代號（信用卡）（可登入商家專區至「服務設定」中查詢Buysafe服務的代碼）
$transPassword = 'Since2019'; //交易密碼（可登入商家專區至「密碼修改」處設定，此密碼非後台登入密碼）
$isProduction = false; //是否為正式平台（true為正式平台，false為測試平台）

////正式用設定（※請修改）
//$merchantID = 'S1708280068'; //商家代號（信用卡）（可登入商家專區至「服務設定」中查詢Buysafe服務的代碼）
//$transPassword = 'wmpdatw2019'; //交易密碼（可登入商家專區至「密碼修改」處設定，此密碼非後台登入密碼）
//$isProduction = false; //是否為正式平台（true為正式平台，false為測試平台）

//準備傳送參數值（請將您的購物網站系統各項數據對應到以下參數，數據來源可能是您的購物網站的資料庫中，請自行撰寫讀取資料庫的方法）
$web = $merchantID; //商家代號
$MN = $productPrice; //交易金額
$OrderInfo = $productName; //交易內容
$Td = $orderNO; //商家訂單編號
$sna = $name; //消費者姓名
$sdt = $phone; //消費者電話（不可有特殊符號）
$email = $email; //消費者Email
$note1 = $email; //備註1（vCode）
$note2 = $productUnit; //備註2（Unit單位）
$Card_Type = '0'; //交易類別(信用卡交易:請帶空字串""或"0"，銀聯卡交易:請帶"1"，Apple Pay、Google Pay:請帶"3")
$Country_Type = ''; //語言類別(中文:請帶空字串""，英文:請帶"EN"，日文:請帶"JIS")
$Term = ''; //分期期數
$CargoFlag = ''; //空白 or 0：不需搭配物流、1：搭配物流（7-11）、2：搭配物流（全家）、2B：全家貨倉到店
$StoreID = ''; //空白(紅陽端提供選擇) or 參考StoreSelect範例程式取得門市資料
$StoreName = ''; //空白(紅陽端提供選擇) or 參考StoreSelect範例程式取得門市資料
$BuyerCid = ''; //買方統一編號
$DonationCode = ''; //捐贈碼
$Carrier_ID = ''; //手機條碼
$ChkValue = getChkValue($web . $transPassword . $MN . $Term); //交易檢查碼（SHA1雜湊值並轉成大寫）


//系統參數（勿修改）
$paymentURL = ($isProduction) ? 'https://www.esafe.com.tw/Service/Etopm.aspx' : 'https://test.esafe.com.tw/Service/Etopm.aspx'; //傳送網址

/**
 * 檢查交易檢查碼是否正確（SHA1雜湊值）
 */
function getChkValue($string)
{
    return strtoupper(sha1($string));
}



//建立回傳值Array
$arr = array($orderNO, $productName, $productUnit, $productEndDate, $vCodeDescribe, $CID, $name, $sex, $identifyNO, $phone, $email, $combineAddr, $job, $title, $invoice, $taxID, $buyer, $invoiceAddr, $orderTime, $productPrice, $web, $MN, $OrderInfo, $Td, $sna, $sdt, $email, $note1, $note2, $Card_Type, $Country_Type, $Term, $CargoFlag, $StoreID, $StoreName, $BuyerCid, $DonationCode, $Carrier_ID, $ChkValue, $paymentURL );
echo json_encode($arr);

//成立訂單



?>