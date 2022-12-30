<?php
//UTF-8編碼
header('Content-Type: text/html; charset=utf-8');

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
$MN = ''; //交易金額
$OrderInfo = ''; //交易內容
$Td = ''; //商家訂單編號
$sna = ''; //消費者姓名
$sdt = ''; //消費者電話（不可有特殊符號）
$email = ''; //消費者Email
$note1 = ''; //備註1（自行應用）
$note2 = ''; //備註2（自行應用）
$Card_Type = ''; //交易類別(信用卡交易:請帶空字串""或"0"，銀聯卡交易:請帶"1"，Apple Pay、Google Pay:請帶"3")
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

//產生實際HTML表單
//以urlencode()函數避免特殊字碼造成HTML語法錯誤
//meta的編碼宣告極為重要，可避免亂碼問題
//送出前可檢視原始碼，查看資料是否正確
?>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<form name="form1" action="<?php echo $paymentURL; ?>" method="POST">
    <input type="hidden" name="web" value="<?php echo $web; ?>">
    <input type="hidden" name="MN" value="<?php echo $MN; ?>">
    <input type="hidden" name="OrderInfo" value="<?php echo urlencode($OrderInfo); ?>">
    <input type="hidden" name="Td" value="<?php echo $Td; ?>">
    <input type="hidden" name="sna" value="<?php echo urlencode($sna); ?>">
    <input type="hidden" name="sdt" value="<?php echo $sdt; ?>">
    <input type="hidden" name="email" value="<?php echo urlencode($email); ?>">
    <input type="hidden" name="note1" value="<?php echo urlencode($note1); ?>">
    <input type="hidden" name="note2" value="<?php echo urlencode($note2); ?>">
    <input type="hidden" name="Card_Type" value="<?php echo $Card_Type; ?>">
    <input type="hidden" name="Country_Type" value="<?php echo $Country_Type; ?>">
    <input type="hidden" name="Term" value="<?php echo $Term; ?>">
    <input type="hidden" name="CargoFlag" value="<?php echo $CargoFlag; ?>">
    <input type="hidden" name="StoreID" value="<?php echo $StoreID; ?>">
    <input type="hidden" name="StoreName" value="<?php echo $StoreName; ?>">
    <input type="hidden" name="BuyerCid" value="<?php echo $BuyerCid; ?>">
    <input type="hidden" name="DonationCode" value="<?php echo $DonationCode; ?>">
    <input type="hidden" name="Carrier_ID" value="<?php echo $Carrier_ID; ?>">
    <input type="hidden" name="ChkValue" value="<?php echo $ChkValue; ?>">
    <input type="submit" name="send" value="送出">
</form>
