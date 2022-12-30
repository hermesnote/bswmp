<?php

//清除Cookie
setcookie("vCode", "", time()-3600, "/" ,"wmpcca.com");

require_once("../vender/dbtools.inc.php");

//默認時區
date_default_timezone_set('PRC');

//取得今天日期
$getToday = date("Y-m-d H:i:s");

//產生到期日
$OP001endDate = date('Y-m-d', strtotime("$getToday+12months 7days"));
$OP002endDate = date('Y-m-d', strtotime("$getToday+25months 7days"));
$OP003endDate = date('Y-m-d', strtotime("$getToday+39months 7days"));




?>

<!doctype html>

<html>
<head>
<?php require_once("../model/index_rel.php") ?>


<link rel=stylesheet type="text/css" href="../css/body_global.css">
<link rel=stylesheet type="text/css" href="../css/keys_index.css">
<link rel=stylesheet type="text/css" href="../css/waitload.css">
<meta charset="utf-8">

<title> KEYs 功能模組 </title>

<style>
	
	/*webkit瀏覽器專用*/
	.placeholderSilver ::-webkit-input-placeholder { color:silver; }
	/*Firefox 4-18瀏覽器專用*/
	.placeholderSilver input::-moz-placeholder { color:silver }
	/*Firefox 19+瀏覽器專用*/
	.placeholderSilver input::-moz-placeholder{color:silver;}
	/*IE10瀏覽器專用*/
	.placeholderSilver:-ms-input-placeholder{color:silver;}
	
	textarea:focus, input:focus, input[type]:focus, .uneditable-input:focus {   
/*		border-color: rgba(229, 103, 23, 0.8);*/
		border-color: yellow;
		box-shadow: 0 1px 1px rgba(229, 103, 23, 0.075) inset, 0 0 8px rgba(229, 103, 23, 0.6);
		outline: 0 none;
	}
	
	.container-gray{
		background-color:whitesmoke;
		padding-top: 40px;
		padding-bottom: 40px;
	}
	
	.container-white{
		background-color: white;
		padding-top: 40px;
		padding-bottom: 40px;
	}
	.container-yellow{
		background-color:wheat;
		padding-top: 40px;
		padding-bottom: 40px;
	}
	.hidden{
		display: none;
	}

/* Loading CSS */

.lds-spinner {
  color: official;
  display: inline-block;
  position: relative;
  width: 80px;
  height: 80px;
}
.lds-spinner div {
  transform-origin: 40px 40px;
  animation: lds-spinner 1.2s linear infinite;
}
.lds-spinner div:after {
  content: " ";
  display: block;
  position: absolute;
  top: 3px;
  left: 37px;
  width: 6px;
  height: 18px;
  border-radius: 20%;
  background: #cef;
}
.lds-spinner div:nth-child(1) {
  transform: rotate(0deg);
  animation-delay: -1.1s;
}
.lds-spinner div:nth-child(2) {
  transform: rotate(30deg);
  animation-delay: -1s;
}
.lds-spinner div:nth-child(3) {
  transform: rotate(60deg);
  animation-delay: -0.9s;
}
.lds-spinner div:nth-child(4) {
  transform: rotate(90deg);
  animation-delay: -0.8s;
}
.lds-spinner div:nth-child(5) {
  transform: rotate(120deg);
  animation-delay: -0.7s;
}
.lds-spinner div:nth-child(6) {
  transform: rotate(150deg);
  animation-delay: -0.6s;
}
.lds-spinner div:nth-child(7) {
  transform: rotate(180deg);
  animation-delay: -0.5s;
}
.lds-spinner div:nth-child(8) {
  transform: rotate(210deg);
  animation-delay: -0.4s;
}
.lds-spinner div:nth-child(9) {
  transform: rotate(240deg);
  animation-delay: -0.3s;
}
.lds-spinner div:nth-child(10) {
  transform: rotate(270deg);
  animation-delay: -0.2s;
}
.lds-spinner div:nth-child(11) {
  transform: rotate(300deg);
  animation-delay: -0.1s;
}
.lds-spinner div:nth-child(12) {
  transform: rotate(330deg);
  animation-delay: 0s;
}
@keyframes lds-spinner {
  0% {
    opacity: 1;
  }
  100% {
    opacity: 0;
  }
}

	
</style>
	
</head>

<body>
<?php require_once("../model/waitload.php") ?>
<?php require_once("../model/cc_imgGroup_Modal.php") ?>

	
<!-- KEYs帳號狀態查詢 -->
<section class="container-white">
	<div class="container">
		<div class="row">
			<div class="col mx-auto text-center">
				<img src="../img/partnerLOGO_400x150_MS.png">
				<p class="h2 text-info">KEYs財富管理系統</p>
				<p class="h4 text-info">查詢｜啟用｜續約｜升級</p>
			</div>
		</div>
		<div class="row">
			<div class="col-3"></div>
			<div class="col-6">
				<div class="input-group mb-3 pt-2 placeholderSilver">
				<input type="text" class="form-control" placeholder="第一步：輸入您的KEYs帳號" aria-label="Recipient's username" aria-describedby="basic-addon2" id="UserName" style="text-align: center;">
				<div class="input-group-append">
				<button class="btn btn-outline-warning" type="button" id="submitCHK"><i class="fas fa-search"></i></button>
				</div>
				</div>
			</div>
			<div class="col-3"></div>
		</div>
	</div>
</section>

	
<!-- KEYs 帳戶資訊 -->
<section class="container-gray hidden" id="accountInfo">
	<div class="container">
		<div class="row">
			<div class="col mx-auto text-center">
	<!-- Loading CSS -->
			<div class="hidden" id="loading-1"><div class="lds-spinner"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div></div>
				
				<p class="h6 text-muted">帳戶授權概要</p>
					<div class="row py-3">
						<div class="col-2"></div>
						<div class="col-8 mx-auto text-center">
							<table class="table">
							  <thead class="table-warning">
								<tr class="text-info">
								  <th scope="col" width="25%">使用者</th>
								  <th scope="col" width="25%">現行版本</th>
								  <th scope="col" width="25%">授權到期</th>
								  <th scope="col" width="25%">帳號狀態</th>
<!--								  <th scope="col">付費版本</th>-->
								</tr>
							  </thead>
							  <tbody class="table-light">
								<tr class="text-dark">
								  <td id="getUserName"></th>
								  <td id="getRoleID"></td>
								  <td id="getEndDate"></td>
								  <td id="getRowStatus"></td>
<!--								  <td id="getVersion"></td>-->
								</tr>
							  </tbody>
							</table>
						</div>
						<div class="col-2"></div>
					</div>
				<button class="btn btn-outline-warning my-3">第二步：選擇方案</button>
			</div>
		</div>
	</div>
</section>

<!-- KEys 購買方案 -->
<section class="container-white hidden" id="projectOption">
	<div class="container">
		<div class="h4 text-info mx-auto text-center">以下為適合您的方案</div>
		<div class="row mx-auto text-center">
			<div class="col mx-auto text-center hidden" id="1">
				<div class="card">
				  <div class="card-body">
					<h5 class="card-title">KEYs專業版-啟用</h5>
					<h6 class="card-subtitle mb-2 text-muted">方案時程</h6>
					  
					  <div class="row">
						  <div class="col mx-auto text-center">
							  <button class="btn btn-lg btn-secondary">12個月</button>
							  <button class="btn btn-lg btn-light">24個月</button>
							  <button class="btn btn-lg btn-dark">36個月</button>
						  </div>
					  </div>

					<p class="card-text">完整權限</p>
					<p class="card-text">$19,800</p>
					<button type="button" class="btn btn-light vCodeShow" disabled>繼續</button>
				  </div>
				</div>
			</div>
			<div class="col mx-auto text-center hidden" id="2">
				<div class="card">
				  <div class="card-body">
					<h5 class="card-title">KEYs專業版-續約</h5>
					<div class="card-subtitle mb-2 text-muted">方案時程</div>
					  
					  <div class="row">
						  <div class="col mx-auto text-center">
							  <button class="btn btn-info">12個月</button>
							  <button class="btn btn-warning">24個月</button>
							  <button class="btn btn-success">36個月</button>
						  </div>
					  </div>	  
					
					<p class="card-text">完整權限</p>
					<p class="card-text">$6,000</p>
					<button type="button" class="btn btn-info vCodeShow">繼續</button>
				  </div>
				</div>
			</div>
			<div class="col mx-auto text-center hidden" id="3">
				<div class="card">
				  <div class="card-body">
					<h5 class="card-title">KEYs專業版-升級</h5>
					<h6 class="card-subtitle mb-2 text-muted">方案時程</h6>
					<p class="card-text">完整權限</p>
					<p class="card-text">$8,800</p>
					<button type="button" class="btn btn-info vCodeShow">繼續</button>
				  </div>
				</div>
			</div>
			<div class="col mx-auto text-center hidden" id="4">
				<div class="card">
				  <div class="card-body">
					<h5 class="card-title">KEYs標準版-啟用</h5>
					<h6 class="card-subtitle mb-2 text-muted">方案時程</h6>
					  
	
					  
					<p class="card-text">個人規劃</p>
					<p class="card-text">$8,800</p>
					<button type="button" class="btn btn-info vCodeShow">繼續</button>
				  </div>
				</div>
			</div>
			<div class="col mx-auto text-center hidden" id="5">
				<div class="card">
				  <div class="card-body">
					<h5 class="card-title">KEYs標準版-續約</h5>
					<h6 class="card-subtitle mb-2 text-muted">12個月</h6>
					<p class="card-text">個人規劃</p>
					<p class="card-text">$2,000</p>
					<button type="button" class="btn btn-info vCodeShow">繼續</button>
				  </div>
				</div>
			</div>
		</div>
	</div>
	</div>
</section>
	
<!-- vCode輸入 -->
<section class="container-yellow hidden" id="vCodeInputArea">
	<div class="container">
		<div class="row">
			<div class="col-3"></div>
			<div class="col-6">
				<div class="input-group placeholderSilver">
				<input type="text" class="form-control" placeholder="優惠代碼" aria-label="Recipient's username" aria-describedby="basic-addon2" id="vCode" style="text-align: center;">
				<div class="input-group-append">
					<button class="btn btn-outline-warning" type="button" id="vCodeButton" role="button" data-placement="top" data-toggle="popover" data-trigger="hover"data-content="輸入vCode取得優惠" onClick="vCodeCHK()"><i class="fas fa-tags"></i></button>
				</div>
				</div>
			</div>
			<div class="col-3"></div>
		</div>
	</div>
</section>


<!-- 購買人資料 -->
<section class="container-gray hidden" id="customerInfo">
	<div class="container">
		<div class="row">
			<div class="col">
				123456789
			</div>
		</div>
	</div>
</section>

<?php require_once("../model/index_js.php") ?>

<!-- Sweetalert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

<script type="text/javascript" src="../controller/waitload.js"></script>
<script type="text/javascript" src="../controller/toggle_tooltip.js"></script>
<!-- 載入ZipCode及Datepicker -->
<script type="text/javascript" src="../controller/datepicker.js"></script>
<script type="text/javascript" src="../controller/zipcode.js"></script>

<!-- 自定義 Javascript -->

	
	<!-- tips -->
<script>
$(function () {
  $('[data-toggle="popover"]').popover()
})
</script>
	
	<!-- KEYs帳號查詢 -->
<script>
	$('#submitCHK').click(function () {
		$("#accountInfo").removeClass("hidden");
		$("#projectOption").addClass("hidden");
		$("#vCodeInputArea").addClass("hidden");
		$("#customerInfo").addClass("hidden");
		$("#loading-1").removeClass("hidden");
		const data = $('#UserName').val()
		$.ajax({
			url:`https://www.holdingkeys.com/hermesAPI/api/member?userId=${data}`,
			contentType:'application/json'
			}).done(function (resp) {
				if(resp.success){
					$('#getUserName').text(resp.data.userName)
					$('#getRoleID').text(resp.data.strRoleID)
					$('#getStartDate').text(resp.data.startDate)
					$('#getEndDate').text(resp.data.endDate)
					$('#getRowStatus').text(resp.data.strRowStatus)
					$('#getVersion').text(resp.data.strVersion)
					$("#loading-1").addClass("hidden")
				}else{
					alert(resp.message)
				}
				var role = resp.data.roleID //免費版為0 ,不能為null
				var ver = resp.data.version  //免費版為null , 不能為0
				var date = resp.data.endDate
				if ( (role === '0' && ver === null) || (role === '1' && ver === null) || (role === '2' && ver === null) ){
					// 付費為免費版, 現行免費版 (沒花錢用4個月標準版的免費仔) = 標準版-啟用 或 專業版-啟用
					$("#projectOption").removeClass("hidden");
					$("#1").removeClass("hidden");
					$("#4").removeClass("hidden");
					$("#2").addClass("hidden");
					$("#3").addClass("hidden");
					$("#5").addClass("hidden");
				}else if ( (role === '0' && ver === '2') || (role === '1' && ver === '2') || (role === '2' && ver === '2') ){
					// 付費為專業版, 現行為免費版或標準版或專業版 = 專業版-續約
					$("#projectOption").removeClass("hidden");
					$("#2").removeClass("hidden");
					$("#1").addClass("hidden");
					$("#3").addClass("hidden");
					$("#4").addClass("hidden");
					$("#5").addClass("hidden");
				}else if ( (role === '0' && ver === null) || (role === '1' && ver === null) ){
					// 付費為標準版, 現行為免費版或標準版 = 標準版-續約 或 專業版-升級
					$("#projectOption").removeClass("hidden");
					$("#3").removeClass("hidden");
					$("#5").removeClass("hidden");
					$("#1").addClass("hidden");
					$("#2").addClass("hidden");
					$("#4").addClass("hidden");
				}else{
					// 付費為標準版, 現行為專業版 = 專業版-續約 或 專業版-升級
					$("#projectOption").removeClass("hidden");
					$("#3").removeClass("hidden");
					$("#1").addClass("hidden");
					$("#2").addClass("hidden");
					$("#4").addClass("hidden");
					$("#5").addClass("hidden");
				}
			$("#projectOption").slideDown("slow");
			});
	})
	</script>	

	<!-- vCodeCHK -->
<script>
	
	function vCodeCHK(){
		
		var vCode = $("#vCode").val();
		
		//查核vCode
			$.ajax({

				url:"https://wmpcca.com/bswmp/form/model/op_vCodeCHK.php",
				data:{
					"vCode" : vCode
				},

				method : "POST",
				
				error : function(msg){
						Swal.fire({
						icon: 'error',
						text: msg+'!',
						})
				},

				success : function(msg){
					
					if ( (msg == 'vCode不存在!')||(msg == 'vCode已過期!')||(msg == 'vCode已滿額!')||(msg == 'vCode不可使用!')  ){
						Swal.fire({
						icon: 'warning',
						title: '似乎出了點問題?',
						text: msg,
						})
					}
					
					if ( (msg == '加贈1個月')||(msg == '加贈2個月')||(msg == '加贈3個月')||(msg == '9折優惠')||(msg == '8折優惠')||(msg == '7折優惠')||(msg == '6折優惠')||(msg == '5折優惠')  ){
						Swal.fire({
						icon: 'success',
						title: '恭喜您!本次訂購將享有',
						text: msg+'!',
						});
						$("#vCode").attr("disabled", "disabled");
						$("#vCode").val(msg);
						$("#vCodeButton").addClass("hidden");
//						$("#vCodeCHK").attr("style", "display:none");
//						$("#vCodeInput").attr("style", "display:none");
//						$("#getvCodeDescribe").text(msg);
//						$("#vCode").attr("disabled", "disabled");
//						$("#vCode").attr("placeholder", msg);
//						$("#vCodeDescribe").html(msg);
						$("#customerInfo").removeClass("hidden");
						$("#customerInfo").slideDown("slow");
					  }
					}
				
				});	
		
	}
		
</script>

<script>
	$(".vCodeShow").click(function(){
		$("#vCodeInputArea").removeClass("hidden");
		$("#vCodeInputArea").slideDown("slow");
	})
</script>

<!-- 準備傳送表單 -->
<div id="hiddenForm" style="display: none;"></div>
	
</body>
</html>