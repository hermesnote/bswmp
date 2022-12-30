<?php
require_once ("accountLoad.php");
require_once ("ECPay.Payment.Integration.php");
 
$obj = new \ECPay_AllInOne();
 
//服務參數
$obj->ServiceURL  = $ServiceURL;
$obj->HashKey     = $HashKey;
$obj->HashIV      = $HashIV;
$obj->MerchantID  = $MerchantID;


//
$obj->Send['ReturnURL']         = "https://www.wmpcca.com/bswmp/form/ecPay/Hoyo_payEcPay2.php" ;     //付款完成通知回傳的網址
$obj->Send['PaymentInfoURL']    = "https://www.wmpcca.com/bswmp/form/ecPay/cc_paymentInfo.php" ;     //取號資料入庫
$obj->Send['MerchantTradeNo']   = $orderNO;                           //訂單編號
$obj->Send['MerchantTradeDate'] = date('Y/m/d H:i:s');                        //交易時間
$obj->Send['TotalAmount']       = $MN;                                       //交易金額
$obj->Send['TradeDesc']         = $projectName ;                           //交易描述
$obj->Send['ChoosePayment']     = ECPay_PaymentMethod::ALL ;                  //付款方式:全功能 Credit#WebATM#BARCODE
$obj->Send['IgnorePayment']     = 'Credit#WebATM#BARCODE' ;                  //付款方式:全功能 
$obj->Send['CustomField1']     =  $receiptTitle;          //receiptTitle
$obj->Send['CustomField2']     =  $taxID;          //taxID
$obj->Send['CustomField3']     =  $projectName;          //projectName
 
//訂單的商品資料
array_push($obj->Send['Items'], array(
			'Name' => $projectName,
			'Price' => $MN,
            'Currency' => '元',
			'Quantity' => '1',
			'URL' => "dedwed"
    )
);
 
//產生訂單(auto submit至ECPay)
//$obj->CheckOut();
$Response = (string)$obj->CheckOutString();
echo $Response;
 
// 自動將表單送出
echo '<script>document.getElementById("__ecpayForm").submit();</script>';
?>

<!doctype html>

<html>
<head>
<?php require_once("../model/index_rel.php") ?>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.0/themes/smoothness/jquery-ui.css">

<link rel=stylesheet type="text/css" href="../css/body_global.css">
<link rel=stylesheet type="text/css" href="../css/keys_index.css">
<link rel=stylesheet type="text/css" href="../css/navbar.css">
<link rel=stylesheet type="text/css" href="../css/waitload.css">
<link rel=stylesheet type="text/css" href="../css/index_footer.css">
<!-- nexus CSS -->
<link rel="stylesheet" href="../nexus/css/font-awesome.min.css">
<link rel="stylesheet" href="../nexus/vendors/animate-css/animate.css">
<link rel="stylesheet" href="../nexus/vendors/owl-carousel/owl.carousel.min.css">
<link rel="stylesheet" href="../nexus/vendors/flaticon/flaticon.css">

<link rel="stylesheet" href="../nexus/css/style.css">
<link rel="stylesheet" href="../nexus/css/responsive.css">
<meta charset="utf-8">

<title>WMPCCA - 財富管理規劃競賽</title>
	

	
<style>
.banner_inner{
	font-size: 13px;
	line-height: 1.8;
	color: #000000;
	background-image: url("../img/compet_index.png");
	background-repeat: no-repeat;
	background-size: cover;
	-moz-background-size: cover;
	-webkit-background-size: cover;
	-o-background-size: cover;
	-ms-background-size: cover;
	background-position: center center;
	font-weight: 400;
	font-family: "Microsoft JhengHei", "微軟正黑體", "Gill Sans", "Gill Sans MT", "Myriad Pro", "DejaVu Sans Condensed", Helvetica, Arial, "sans-serif";
	margin: 0px;	
}

.main {
padding: 60px 0;
position: relative; 
}


.containerIndex {
	width: 400px;
	height: auto;
	background: white;
	margin-left: 10%;
	border-radius: 10px;
	-moz-border-radius: 10px;
	-webkit-border-radius: 10px;
	-o-border-radius: 10px;
	-ms-border-radius: 10px; 
}


/*webkit瀏覽器專用*/
.form-control ::-webkit-input-placeholder { color: silver;font-size: 13px; }
/*Firefox 4-18瀏覽器專用*/
.form-control input::-moz-placeholder { color: silver;font-size: 13px; }
/*Firefox 19+瀏覽器專用*/
.form-control input::-moz-placeholder{color: silver;font-size: 13px;}
/*IE10瀏覽器專用*/
.form-control:-ms-input-placeholder{color: silver;font-size: 13px;}
	
</style>	
	
	
</head>

<body>
<?php require_once("../model/waitload.php") ?>
<?php require_once("../model/cc_imgGroup_Modal.php") ?>
<?php require_once("../model/index_nav.php") ?>


<section class="home_banner_area">
	<div class="banner_inner">
<div class="main">
	<div class="containerIndex">
		<div class="" style="padding-top: 30px;">
			<div class="h4 mx-auto text-center" style="color: #0B7376;">嗨!「<?php echo $teamName; ?>」隊</div>
			<small id="loginHelp" class="form-text text-muted mx-auto text-center"><?php echo $projectName ?></small>
			<div class="form-group mt-3 mx-auto text-center">
				<button type="button" class="form-control btn btn-outline-danger" id="dataEditButton" style="text-align: center; width: 50%">編輯資料</button>
			</div>
			<div class="form-group mx-auto text-center">
				<button type="button" class="form-control btn btn-outline-info" style="text-align: center; width: 50%">檔案上傳</button>
			</div>
			<div class="form-group mx-auto text-center">
				<button type="button" class="form-control btn btn-outline-warning" style="text-align: center; width: 50%">收據列印</button>
			</div>
			<div class="form-group mx-auto text-center">
				<button type="button" class="form-control btn btn-outline-primary" style="text-align: center; width: 50%">參賽證明</button>
			</div>
			<div class="mx-auto text-center">
			<div class="form-group mx-auto text-center">
				<button type="button" class="form-control btn btn-outline-success" id="payButton" style="text-align: center; width: 50%">線上繳費</button>
				<small id="payHelp" class="form-text text-muted mx-auto text-center"><a href="">繳費操作說明</a></small>
			</div>			
			</div>
		</div>
		
		<div class="mt-5 mx-auto text-center" style="padding-bottom: 30px;">
			

		</div>		
	</div>
</div>
	</div>
</section>


<section class="price_area p_120">
	<div class="container">
		
	</div>
</section>

<section class="testimonials_area p_120">
	<div class="container">
		
	</div>
</section>

	



<?php require_once("../model/index_footer.php") ?>
<?php require_once("../model/index_js.php") ?>

<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="../lumino/js/bootstrap.min.js"></script>	
<script src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js" integrity="sha256-eGE6blurk5sHj+rmkfsGYeKyZx3M4bG+ZlFyA7Kns7E=" crossorigin="anonymous"></script>
<script type="text/javascript" src="../controller/waitload.js"></script>
<script type="text/javascript" src="../controller/index_nav.js"></script>
<script type="text/javascript" src="../controller/toggle_tooltip.js"></script>
<!-- nexus JS -->
<script src="../nexus/vendors/owl-carousel/owl.carousel.min.js"></script>
<script type="text/javascript" src="../controller/datepicker.js"></script>
<script type="text/javascript" src="../controller/zipcode.js"></script>


</body>
</html>