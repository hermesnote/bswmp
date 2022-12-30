<?php require_once("accountLoad.php") ?>

<?php require_once("../model/cc_getForm2.php") ?>

<?php require_once("../model/db_cc_SignupInsert.php") ?>

<?php
/**
*   一般產生訂單(全功能)範例
*/
    
    //載入SDK(路徑可依系統規劃自行調整)
    include('ECPay.Payment.Integration.php');
    try {
        
    	$obj = new ECPay_AllInOne();
   
        //服務參數
        $obj->ServiceURL  = $ServiceURL;//服務位置
        $obj->HashKey     = $HashKey;//測試用Hashkey，請自行帶入ECPay提供的HashKey
        $obj->HashIV      = $HashIV;//測試用HashIV，請自行帶入ECPay提供的HashIV
        $obj->MerchantID  = $MerchantID;//測試用MerchantID，請自行帶入ECPay提供的MerchantID
        $obj->EncryptType = $EncryptType;//CheckMacValue加密類型，請固定填入1，使用SHA256加密
        //基本參數(請依系統規劃自行調整)
        $MerchantTradeNo = "Test".time() ;
        $obj->Send['ReturnURL']         = "https://www.wmpcca.com/bswmp/form/ecPay/Simple_ServerReplyPaymentStatus_ED0.php" ;     //付款完成通知回傳的網址
        $obj->Send['MerchantTradeNo']   = $orderNO;                           //訂單編號
        $obj->Send['MerchantTradeDate'] = date('Y/m/d H:i:s');                        //交易時間
        $obj->Send['TotalAmount']       = $MN;                                       //交易金額
        $obj->Send['TradeDesc']         = $projectName ;                           //交易描述
        $obj->Send['ChoosePayment']     = ECPay_PaymentMethod::ALL ;                  //付款方式:全功能
		$obj->Send['ClientBackURL']     = 'https://www.wmpcca.com/bswmp/form/view/cc_signup.php' ;          //回報名頁面
        //訂單的商品資料
        array_push($obj->Send['Items'], array(
			'Name' => $projectName,
			'Price' => $MN,
            'Currency' => '元',
			'Quantity' => '1',
			'URL' => "dedwed"
		)
				  );
        # 電子發票參數
        /*
        $obj->Send['InvoiceMark'] = ECPay_InvoiceState::Yes;
        $obj->SendExtend['RelateNumber'] = "Test".time();
        $obj->SendExtend['CustomerEmail'] = 'test@ecpay.com.tw';
        $obj->SendExtend['CustomerPhone'] = '0911222333';
        $obj->SendExtend['TaxType'] = ECPay_TaxType::Dutiable;
        $obj->SendExtend['CustomerAddr'] = '台北市南港區三重路19-2號5樓D棟';
        $obj->SendExtend['InvoiceItems'] = array();
        // 將商品加入電子發票商品列表陣列
        foreach ($obj->Send['Items'] as $info)
        {
            array_push($obj->SendExtend['InvoiceItems'],array('Name' => $info['Name'],'Count' =>
                $info['Quantity'],'Word' => '個','Price' => $info['Price'],'TaxType' => ECPay_TaxType::Dutiable));
        }
        $obj->SendExtend['InvoiceRemark'] = '測試發票備註';
        $obj->SendExtend['DelayDay'] = '0';
        $obj->SendExtend['InvType'] = ECPay_InvType::General;
        */
        //產生訂單(auto submit至ECPay)
        $obj->CheckOut();
      
    
    } catch (Exception $e) {
    	echo $e->getMessage();
    } 
 
?>