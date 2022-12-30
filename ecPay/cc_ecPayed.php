<!-- 載入資料庫連線PHP程式 -->
<?php require_once("../vender/dbtools.inc.php") ?>
<!-- 載入帳號資訊 -->
<?php require_once("accountLoad.php") ?>

<?php
    // 付款結果通知
    require('ECPay.Payment.Integration.php');
    try {
        // 收到綠界科技的付款結果訊息，並判斷檢查碼是否相符
        $AL = new ECPay_AllInOne();
        $AL->MerchantID = $MerchantID;
        $AL->HashKey = $HashKey;
        $AL->HashIV = $HashIV;
        // $AL->EncryptType = ECPay_EncryptType::ENC_MD5;  // MD5
        $AL->EncryptType = ECPay_EncryptType::ENC_SHA256; // SHA256
        $feedback = $AL->CheckOutFeedback();
        // 以付款結果訊息進行相對應的處理


        回傳的綠界科技的付款結果訊息如下:
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


        // 在網頁端回應 1|OK
        echo '1|OK';
    } catch(Exception $e) {
        echo '0|' . $e->getMessage();
    }
?>

