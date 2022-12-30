<?php
/*
    程式撰寫流程(以信用卡為範例)
    0.參數定義
    1.讀取購物車商品
    2.寫入訂單，取得訂單編後
    3.透過站內付SDK 送出請求，並取得API回傳參數
    4.將API回傳參數往前端送
*/
    
// 0.參數定義
$aShopping_Cart     = array();  // 購物車內資訊
$aOrder_Info        = array();  // 訂單資訊
$aAjax_Return       = array();  // 回傳給前端頁面資訊
$sSPCheckOut_Url    = 'https://payment-stage.ecpay.com.tw/SP/SPCheckOut' ;                                                  // 付款連結
$sPayment_Type      = isset($_POST['payment_type'])      ? htmlspecialchars(trim($_POST['payment_type'])) : 'CREDIT' ;      // 付款方式
$nInvoice_Status    = isset($_POST['invoice_status'])    ? (int) $_POST['invoice_status'] : 1 ;                             // 開立發票
// 1. 讀取購物車商品(廠商自行撰寫)
if(true)
{
    $aShopping_Cart = array();
}
// 2.寫入訂單，取得訂單編後(廠商自行撰寫)
if(true)
{
    $aOrder_Info = array();
    $aOrder_Info = $aShopping_Cart ;
    $aOrder_Info['order_id']        = 'SDKTEST'.time() ;
    $aOrder_Info['order_amount']    = 5274;    
    $aOrder_Info['Items']           = array('Name' => "義吸沛礦泉水", 'Price' => (int)"5274", 'Currency' => "元", 'Quantity' => (int) "1") ;
}
// 3.透過站內付SDK 送出請求，並取得API回傳參數
if(true)
{
    //載入SDK(路徑可依系統規劃自行調整)
    include('ECPay.Payment.Integration.php');
    try {
        
        $obj = new ECPay_AllInOne();
        //服務參數
        $obj->ServiceURL  = 'https://payment-stage.ecpay.com.tw/SP/CreateTrade';    //服務位置
        $obj->HashKey     = '5294y06JbISpM5x9' ;                                    //測試用Hashkey，請自行帶入ECPay提供的HashKey
        $obj->HashIV      = 'v77hoKGq4kWxNNIS' ;                                    //測試用HashIV，請自行帶入ECPay提供的HashIV
        $obj->MerchantID  = '2000132';                                              //測試用MerchantID，請自行帶入ECPay提供的MerchantID
        $obj->EncryptType = '1';                                                    //CheckMacValue加密類型，請固定填入1，使用SHA256加密
        //基本參數(請依系統規劃自行調整)
        $obj->Send['ReturnURL']         = $_SERVER['HTTP_HOST'].'/payment_receive.php' ;            //付款完成通知回傳的網址
        $obj->Send['MerchantTradeNo']   = $aOrder_Info['order_id'];                                 //訂單編號
        $obj->Send['MerchantTradeDate'] = date('Y/m/d H:i:s');                                      //交易時間
        $obj->Send['TotalAmount']       = $aOrder_Info['order_amount'];                             //交易金額
        $obj->Send['TradeDesc']         = "Whosoever drinketh of this water shall thirst again" ;   //交易描述
        $obj->Send['ChoosePayment']     = ECPay_PaymentMethod::ALL ;                                //付款方式:全功能
        $obj->Send['NeedExtraPaidInfo']= 'Y' ;
        // //訂單的商品資料
        array_push($obj->Send['Items'], $aOrder_Info['Items']);
        if($sPayment_Type == 'CREDIT')
        {
            $obj->SendExtend['Redeem']= 'Yes' ;                     // 紅利折抵
        }
        if($sPayment_Type == 'ATM')
        {
            // ATM 延伸參數
            $obj->SendExtend['ExpireDate'] = 1 ;                    //繳費期限 (預設3天，最長60天，最短1天)
            $obj->SendExtend['PaymentInfoURL'] = "";                //伺服器端回傳付款相關資訊。
        }
      
         if($sPayment_Type == 'CVS')
        {
            // CVS超商代碼延伸參數(可依系統需求選擇是否代入)
            $obj->SendExtend['Desc_1']            = 'Desc_1';       //交易描述1 會顯示在超商繳費平台的螢幕上。預設空值
            $obj->SendExtend['Desc_2']            = 'Desc_2';       //交易描述2 會顯示在超商繳費平台的螢幕上。預設空值
            $obj->SendExtend['Desc_3']            = '';             //交易描述3 會顯示在超商繳費平台的螢幕上。預設空值
            $obj->SendExtend['Desc_4']            = '';             //交易描述4 會顯示在超商繳費平台的螢幕上。預設空值
            $obj->SendExtend['PaymentInfoURL']    = '';             //預設空值
            $obj->SendExtend['ClientRedirectURL'] = '';             //預設空值
            $obj->SendExtend['StoreExpireDate']   = '2';            //預設空值 (以分鐘為單位)
        }
        if($nInvoice_Status == 1)
        {
            // 電子發票參數
            $obj->Send['InvoiceMark'] = ECPay_InvoiceState::Yes;
            $obj->SendExtend['RelateNumber'] = "SDKTEST".time();
            $obj->SendExtend['CustomerEmail'] = 'test@ecpay.com.tw';
            $obj->SendExtend['CustomerPhone'] = '0911222333';
            $obj->SendExtend['TaxType'] = ECPay_TaxType::Dutiable;
            $obj->SendExtend['CustomerAddr'] = '台北市南港區三重路19-2號6樓D棟';
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
        }
        
        //產生訂單(auto submit至ECPay)
        $aSdk_Return = $obj->CreateTrade();
        // 接回來的參數
        //var_dump($aSdk_Return);
        // exit;
        $aSdk_Return['SPCheckOut']  = $sSPCheckOut_Url ; 
        if($sPayment_Type == 'CREDIT')
        {
            $aSdk_Return['PaymentType'] = 'CREDIT' ; 
        }
        elseif($sPayment_Type == 'ATM')
        { 
            $aSdk_Return['PaymentType'] = 'ATM' ; 
        }
        elseif($sPayment_Type == 'CVS')
        {
            $aSdk_Return['PaymentType'] = 'CVS' ; 
        }
        else
        {
            $aSdk_Return['PaymentType'] = 'CREDIT' ; 
        }
        
        $sAjax_Return = json_encode($aSdk_Return) ;
    } catch (Exception $e) {
        // var_dump($e->getMessage());
        // exit;
        $aAjax_Return['msg'] = $e->getMessage() ;
        $sAjax_Return = json_encode($aAjax_Return) ;
    } 
}
// 4.將API回傳參數往前端送
if(!empty($sAjax_Return))
{
    echo $sAjax_Return ;
}
 
?>