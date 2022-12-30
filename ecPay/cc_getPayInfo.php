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
<!DOCTYPE HTML>
<html>
<form>
	<thead>
		<th>參數</th>
		<th>取回</th>
		<th>說明</th>
	</thead>
	<tbody>
		<tr>
			<td>$MerchantID</td>
			<td><?php echo $MerchantID ?></td>
			<td>特店編號</td>
		</tr>
		<tr>
			<td>$MerchantTradeNo</td>
			<td><?php echo $MerchantTradeNo?></td>
			<td>特店訂單編號</td>
		</tr>
		<tr>
			<td>$StoreID</td>
			<td><?php echo $StoreID ?></td>
			<td>特店旗下店舖代號</td>
		</tr>
		<tr>
			<td>$RtnCode</td>
			<td><?php echo $RtnCode ?></td>
			<td>交易狀態</td>
		</tr>
		<tr>
			<td>$RtnMsg</td>
			<td><?php echo $RtnMsg ?></td>
			<td>交易訊息</td>
		</tr>
		<tr>
			<td>$TradeNo</td>
			<td><?php echo $TradeNo ?></td>
			<td>綠界交易編號</td>
		</tr>
		<tr>
			<td>$TradeAmt</td>
			<td><?php echo $TradeAmt ?></td>
			<td>交易金額</td>
		</tr>
		<tr>
			<td>$PaymentDate</td>
			<td><?php echo $PaymentDate ?></td>
			<td>?</td>
		</tr>
		<tr>
			<td>$PaymentType</td>
			<td><?php echo $PaymentType ?></td>
			<td>特店選擇付款方式</td>
		</tr>
		<tr>
			<td>$PaymentTypeChargeFee</td>
			<td><?php echo $PaymentTypeChargeFee ?></td>
			<td>?</td>
		</tr>
		<tr>
			<td>$TradeDate</td>
			<td><?php echo $TradeDate ?></td>
			<td>訂單成立時間</td>
		</tr>
		<tr>
			<td>$CustomField1</td>
			<td><?php echo $CustomField1 ?></td>
			<td>客訂欄位1</td>
		</tr>
		<tr>
			<td>$CustomField2</td>
			<td><?php echo $CustomField2 ?></td>
			<td>客訂欄位2</td>
		</tr>
		<tr>
			<td>$CustomField3</td>
			<td><?php echo $CustomField3 ?></td>
			<td>客訂欄位3</td>
		</tr>
		<tr>
			<td>$CustomField4</td>
			<td><?php echo $CustomField4 ?></td>
			<td>客訂欄位4</td>
		</tr>
		<tr>
			<td>$CheckMacValue</td>
			<td><?php echo $CheckMacValue ?></td>
			<td>檢查碼</td>
		</tr>
	</tbody>
</form>
</html>