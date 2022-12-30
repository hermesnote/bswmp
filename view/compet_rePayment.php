<?php
require_once("../vender/dbtools.inc.php");

$getToday = date("Y-m-d H:i:s");

//比對網頁開啟時的時間, 若大於現時則開放true, 否則false

?>

<!doctype html>

<html>
<head>
<?php require_once("../model/index_rel.php") ?>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.0/themes/smoothness/jquery-ui.css">
<link rel="stylesheet" href="https://jqueryui.com/resources/demos/style.css">

<link rel=stylesheet type="text/css" href="../css/body_global.css">
<link rel=stylesheet type="text/css" href="../css/keys_index.css">
<link rel=stylesheet type="text/css" href="../css/waitload.css">

<!-- nexus CSS -->
<link rel="stylesheet" href="../nexus/css/font-awesome.min.css">
<link rel="stylesheet" href="../nexus/vendors/animate-css/animate.css">
<link rel="stylesheet" href="../nexus/vendors/owl-carousel/owl.carousel.min.css">
<link rel="stylesheet" href="../nexus/vendors/flaticon/flaticon.css">

<link rel="stylesheet" href="../nexus/css/style.css">
<link rel="stylesheet" href="../nexus/css/responsive.css">
<meta charset="utf-8">

<title>台灣財富管理規劃顧問認證協會 - 繳費補單專區</title>
	

	
<style>
.banner_inner{
	font-size: 13px;
	line-height: 1.8;
	color: #000000;
	background-image: url("../img/567.jpg");
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
	width: 860px;
	height: auto;
	background: white;
	margin:0px auto;
/*	margin-left: 35%;*/
	border-radius: 10px;
	-moz-border-radius: 10px;
	-webkit-border-radius: 10px;
	-o-border-radius: 10px;
	-ms-border-radius: 10px; 
}

/*
.appointment-form {
	padding: 50px 60px 70px 60px; }
*/


* {
  box-sizing: border-box;
}
.inp {
  position: relative;
  margin: auto;
  width: 100%;
  
}
.inp .label1, .label2, .label3, .label4 {
  position: absolute;
  top: 16px;
  left: 0;
  font-size: 16px;
  color: #9098a9;
  font-weight: 500;
  transform-origin: 0 0;
  transition: all 0.2s ease;
}
.inp .border1, .border2, .border3, .border4 {
  position: absolute;
  bottom: 0;
  left: 0;
  height: 2px;
  width: 100%;
  background: #0B7376;
  transform: scaleX(0);
  transform-origin: 0 0;
  transition: all 0.15s ease;
}
.inp input {
  -webkit-appearance: none;
  width: 100%;
  border: 0;
  font-family: inherit;
  padding: 12px 0;
  height: 48px;
  font-size: 16px;
  font-weight: 500;
  border-bottom: 2px solid #c8ccd4;
  background: none;
  border-radius: 0;
  color: #0B7376;
  transition: all 0.15s ease;
}
.inp input:hover {
  background: rgba(34,50,84,0.03);
}
.inp input:not(:placeholder-shown) + span {
  color: #5a667f;
  transform: translateY(-26px) scale(0.75);
}
.inp input:focus {
  background: none;
  outline: none;
}
.inp input:focus + span {
  color: #FAB216;
  transform: translateY(-26px) scale(0.75);
}
.inp input:focus + span + .border1 {
  transform: scaleX(1);
}
.inp input:focus + span + .border2 {
  transform: scaleX(1);
}
.inp input:focus + span + .border3 {
  transform: scaleX(1);
}
.inp input:focus + span + .border4 {
  transform: scaleX(1);
}		

.form-control{
	text-align: center;
}
	
#buyBorder, #teamNO{
	border: 3px #0B7376;
	border-style: groove;
}
	
select {
	text-align: center;
	text-align-last: center;
	/* webkit*/
}
option {
	text-align: left;
	/* reset to left*/
}

</style>	
	
	
</head>

<body>
<?php require_once("../model/waitload.php") ?>
<?php require_once("../model/cc_imgGroup_Modal.php") ?>

<!-- 競賽規則 -->
<section class="price_area p_120" style="padding-top: 50px;padding-bottom: 50px;">
	<div class="container">
		<div class="row">
			<div class="col mx-auto text-center">
				<img src="../img/logo_01.png">
				<p class="h1 py-4">競賽報名繳費補單專區</p>
			</div>
		</div>
		<div class="row">
			<div class="col-2">
			</div>
			<div class="col-8">
				<div class="pl-3">
					<p class="h5">※ 開放時間：2019年 11月 13日 00:00 - 2019年 11月 13日 23:59</p>
					<p class="h5">※ 限完成報名之隊伍</p>
					<p class="h5">※ 僅開放超商代碼繳費</p>
					<p class="h5">※ 補單不予任何優惠(包括團體報名)</p>
					<p class="h5">※ 成功取號後可至<a href="compet_index.php" target="_blank" style="color: darkcyan">「競賽專區」</a>查詢繳費資訊</p>
					<p class="h5">※ 完成繳費後可至<a href="compet_index.php" target="_blank" style="color: darkcyan">「競賽專區」</a>列印收據及上傳競賽相關檔案</p>
				</div>
			</div>
			<div class="col-2">
			</div>
		</div>
	</div>
</section>

<section class="home_banner_area">
	<div class="banner_inner">

		<div class="main py-5">
			<div class="containerIndex">
				
					<div class="row px-5 pt-3">
						
						<div class="col">
							<div class="h3 mx-auto text-center">選擇補單項目</div>
							<select class="custom-select custom-select-lg" style="font-size: 20px;" id="buyBorder">
								<option value="SG" style="text-align: center">全國財富管理競賽</option>
								<option value="CG">全國大專財富管理競賽</option>
								<option value="NCS">全國大專校院北、中、南分區理財規劃案例競賽</option>
							</select>
						</div>
						
					</div>
				
					<div class="row pt-2">
						<div class="col text-center mx-auto">
							<div class="mx-auto text-center">
								<div class="h3 mx-auto text-center pt-2">請輸入隊伍編號</div>
<!--								<lebal for="teamNO">請輸入隊伍編號：</lebal>-->
								<input type="text" class="form-control mx-auto text-center" aria-label="Large" aria-describedby="inputGroup-sizing-sm" id="teamNO" style="font-size: 20px;width: 89%">
								<input type="hidden" value="1000" id="amount">
							</div>
						</div>
					</div>
				
					<div class="row pt-3 pb-5">
						<div class="col">
							<div class="mx-auto text-center">
								<button type="button" class="mt-2 pay_button form-control btn btn-success mt-0" onclick="ajax_payment('CVS', 0)" style="text-align: center; width: 50%">取得超商繳費代碼</button>
<!--								<button type="button" class="mt-1 pay_button form-control btn btn-success" onclick="ajax_payment('ATM', 0)" style="text-align: center; width: 50%">取得虛擬匯款帳號(ATM)</button>-->
							</div>
							<div class="mx-auto text-center">
								<div id="dialog" class="dialog mx-auto text-center" title="台灣財富管理規劃顧問認證協會-繳費補單"></div>
								<small>取號後請於<span style="color: red;">24小時內</span>持繳費代碼至四大超商完成繳費</small>
							</div>
						</div>
					</div>
				
			</div>	
		</div>
	</div>
</section>

<!--
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="../lumino/js/bootstrap.min.js"></script>	
<script src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js" integrity="sha256-eGE6blurk5sHj+rmkfsGYeKyZx3M4bG+ZlFyA7Kns7E=" crossorigin="anonymous"></script>
-->


<?php require_once("../model/index_js.php") ?>

<script type="text/javascript" src="../controller/waitload.js"></script>
<script type="text/javascript" src="../controller/toggle_tooltip.js"></script>
<!-- 載入ZipCode及Datepicker -->
<script type="text/javascript" src="../controller/datepicker.js"></script>
<script type="text/javascript" src="../controller/zipcode.js"></script>

<!-- 綠界AJAX -->
<script type="text/javascript">
	<!--
	// 監聽API回傳訊息
	$(function () {
		window.addEventListener('message', function (e) {
			console.log('API回傳前端訂單資訊：'+e.data);
		});
		$( "#dialog" ).on( "dialogclose", function( event, ui ) {
			// 顯示付款按鈕
			$(".pay_button").fadeIn( "slow" );
		} );
	});
	// 檢查裝置類型
	function getIsMobileAgent () {
	        var IsMobileAgent = false;
	        var userAgent = navigator.userAgent;
	        var CheckMobile = new RegExp("android.+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino");
	        var CheckMobile2 = new RegExp("mobile|mobi|nokia|samsung|sonyericsson|mot|blackberry|lg|htc|j2me|ucweb|opera mini|mobi|android|iphone");
	        if (CheckMobile.test(userAgent) || CheckMobile2.test(userAgent.toLowerCase())) {
	            IsMobileAgent = true;  
	        }
	        return IsMobileAgent
	}
	// 送出訂單
	function ajax_payment(payment_type, invoice_status)
	{
		//取得繳費資訊
		var project = $("#buyBorder").val();
		var amount = $("#amount").val();
		var teamNO = $("#teamNO").val();
		console.log(amount);
		// 隱藏付款按鈕
		$(".pay_button").fadeOut( "slow" );
		// 檢查裝置類型
		IsMobileAgent = getIsMobileAgent();
		// 送出AJAX產生訂單，並取得SPToken等資訊
		$.ajax({
		    type: 'POST',
		    url: 'https://wmpcca.com/bswmp/form/ecPay/ajax_processRePayment.php',
		    dataType: 'json',
		    data: 'func=pay&payment_type='+payment_type+'&invoice_status='+invoice_status+'&amount='+amount+'&project='+project+'&teamNO='+teamNO,
		    success: function (sMsg){
				console.log(sMsg);
		        if(sMsg.RtnCode == 1)
		        {
				console.log(sMsg);
		            	if(IsMobileAgent)
		            	{
		            		$( "#dialog" ).html('<div><img src="https://www.ecpay.com.tw/Content/Themes/WebStyle20131201/images/header_logo.png" height="40" style="display:block; margin:auto;"></div><iframe src="'+sMsg.SPCheckOut+'?MerchantID=' + sMsg.MerchantID + '&SPToken=' + sMsg.SPToken + '&PaymentType=' + sMsg.PaymentType + '"   frameborder="0" height="100%" width="100%" ></iframe>'); 
		            		$( ".dialog" ).dialog({
						resizable: false,
						modal: true
					});     	
		            	}
		            	else
		            	{
		            		$( "#dialog" ).html('<div><img src="https://www.ecpay.com.tw/Content/Themes/WebStyle20131201/images/header_logo.png" height="40" style="display:block; margin:auto;"></div><iframe src="'+sMsg.SPCheckOut+'?MerchantID=' + sMsg.MerchantID + '&SPToken=' + sMsg.SPToken + '&PaymentType=' + sMsg.PaymentType + '"   frameborder="0" height="90%" width="99%" ></iframe>');
			            	$( ".dialog" ).dialog({
						height: 700,
						width: 750,
						resizable: false,
						modal: true
					});
		            	}
		        }
		        else{
					
					if( sMsg == "隊伍編號不存在!"){
						alert("隊伍編號不存在!");
						window.location.reload();
						return;
					}

					if( sMsg == "隊伍已完成繳費!"){
						alert("隊伍已完成繳費!");
						window.location.reload();
						return;
					}

					if( sMsg == "目前不在開放時間"){
						alert("目前不在開放時間");
						window.location.reload();
						return;
					}

					if( sMsg == "已超過開放時間"){
						alert("已超過開放時間");
						window.location.reload();
						return;
					}
					
		        	console.log(sMsg.msg);
		        }
		    },
		    error: function (sMsg1, sMsg2){
		            $('.ajax-content').html('Ajax Error');
		    }
		});
	}
	-->
	</script>	
	
	
</body>
</html>