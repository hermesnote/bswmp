<?php
require_once("../vender/dbtools.inc.php");

$getToday = date("Y-m-d H:i:s");

//比對網頁開啟時的時間, 若大於現時則開放true, 否則false

?>

<!doctype html>

<html>
<head>
<?php require_once("../model/index_rel.php") ?>


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

<title>MoneyStar - KEYs訂購單</title>
	

	
<style>
	
input:focus::-webkit-input-placeholder { 
	color:transparent; 
	} 
input:focus:-moz-placeholder { 
	color:transparent;
	} /* FF 4-18 */ 
input:focus::-moz-placeholder { 
	color:transparent;
	} /* FF 19+ */ 
input:focus:-ms-input-placeholder { 
	color:transparent; 
	} /* IE 10+ */	
	
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
	
#buyBorder{
	border: 3px #0B7376;
	border-style: groove;
}
	
.buttonTrans{
	background:Transparent;
	background-repeat:no-repeat;
	border: none;
	cursor:pointer;
	overflow: hidden;
	outline:none;
}

</style>	
	
	
</head>

<body>
<?php require_once("../model/waitload.php") ?>
<?php require_once("../model/cc_imgGroup_Modal.php") ?>

<!-- 競賽規則 -->
<section class="price_area p_120" style="padding-top: 30px;padding-bottom: 50px;">
	<div class="container">
		<div class="row">
			<div class="col mx-auto text-center">
				<img src="../img/partnerLOGO_400x150_MS.png">
				<p class="h2">KEYs財富管理系統 - 線上訂購單 <span class="h6">(新用戶專用)</span></p>
			</div>
		</div>
	</div>
</section>

<section class="home_banner_area">
	<div class="banner_inner">

		<div class="main pt-5 pb-3">
			<div class="containerIndex">
					<div class="row pt-3">
						<div class="h3 mx-auto text-center pb-3 text-warning"><i class="fas fa-shopping-cart pr-2"></i></i>選擇方案</div>
					</div>
						<div class="row px-4 pb-4">
						<div class="col-4">
								<div class="card projectHover" id="card1">
									<img src="../img/Artboard 4 copy.png" class="card-img-top" alt="...">
										<div class="card-body">
											<h5 class="card-title" id="card1Title">專業版首次啟用授權</h5>
											<p class="card-text h3 float-right" id="card1Months">12個月</h4></p>
											<button class="h2 text-center pt-2 ml-2 buttonTrans" onClick="kp1()" id="card1Button">$19,800<i class="far fa-circle pl-3 h1" id="card1Icon"></i></button>
										</div>
								</div>
							
						</div>
				
						<div class="col-4">
								<div class="card projectHover" id="card2">
									<img src="../img/Artboard 4 copy.png" class="card-img-top" alt="...">
										<div class="card-body">
											<h5 class="card-title" id="card2Title">專業版首次啟用授權1+1方案</h5>
											<p class="card-text h3 float-right" id="card2Months">25個月</h4></p>
											<button class="h2 text-center pt-2 ml-2 buttonTrans" onClick="kp2()" id="card2Button">$24,800<i class="far fa-circle pl-3 h1" id="card2Icon"></i></button>
										</div>
								</div>
						</div>
				
						<div class="col-4">
								<div class="card projectHover" id="card3">
									<img src="../img/Artboard 4 copy.png" class="card-img-top" alt="...">
										<div class="card-body">
											<h5 class="card-title" id="card3Title">專業版首次啟用授權1+2方案</h5>
											<p class="card-text h3 float-right" id="card3Months">39個月</h4></p>
											<button class="h2 text-center pt-2 ml-2 buttonTrans" onClick="kp3()" id="card3Button">$29800<i class="far fa-circle pl-3 h1" id="card3Icon"></i></button>
										</div>
								</div>
						</div>
					</div>
			</div>	
		</div>
		
		<div class="main py-3">
			<div class="containerIndex">
				<form class="form-group px-5 pt-3 pb-5" method="POST">
				<div class="h3 mx-auto text-center pb-3 text-primary"><i class="fas fa-edit pr-2"></i>用戶資料</div>	

					<div class="row">
						<div class="col-4">
							<label for="name">姓名</label>
							<input type="text" class="form-group form-control" name="name" id="name">
						</div>
						<div class="col-2">
							<label for="sex">稱謂</label>
							<select name="sex" class="custom-select" style="font-size: 16px;" id="sex">
								<option value="先生">先生</option>
								<option value="小姐">小姐</option>
							</select>
						</div>
						<div class="col-3">
							<label for="identifyNO">身份證字號</label>
							<input type="text" class="form-group form-control" name="identifyNO" id="identifyNO" placeholder="ex:A123456789">
						</div>
						<div class="col-3">
							<label for="name">生日</label>
							<input type="text" class="form-group form-control datepicker" name="birth" id="birth" placeholder="ex:2000-01-01">
						</div>
					</div>

					<div class="row">
						<div class="col-4">
							<label for="name">行動電話</label>
							<input type="text" class="form-group form-control" name="phone" id="phone" placeholder="ex:0900123456">
						</div>
						<div class="col-8">
							<label for="name">Email</label>
							<input type="text" class="form-group form-control" name="email" id="email">
						</div>
					</div>

					<div class="row">
						<div class="col-3">
							<label for="name">通訊地-城市</label>
							<select name="city" class="form-control" id="captainCity">
								<option>請選擇...</option>
							</select>
						</div>
						<div class="col-3">
							<label for="name">通訊地-行政區</label>
							<select class="form-control" name="captainDistrict" id="captainDistrict">
								<option></option>
							</select>
						</div>
						<div class="col-6">
							<label for="name">通訊地-地址</label>
							<input type="text" class="form-group form-control" name="addr" id="addr">
						</div>
					</div>

					<div class="row">
						<div class="col-5">
							<label for="">服務產業</label>
							<select class="custom-select" name="captainJob" id="job" style="font-size: 15px;">
								<option>請選擇...</option>
								<option value="農林漁牧業">農、林、漁、牧業</option>
								<option value="礦業及土石採取業">礦業及土石採取業</option>
								<option value="製造業">製造業</option>
								<option value="電力及燃氣供應業">電力及燃氣供應業</option>
								<option value="用水供應及污染整治業">用水供應及污染整治業</option>
								<option value="營建工程業">營建工程業</option>
								<option value="批發及零售業">批發及零售業</option>
								<option value="運輸及倉儲業">運輸及倉儲業</option>
								<option value="住宿及餐飲業">住宿及餐飲業</option>
								<option value="出版影音製作傳播及資通訊服務業">出版、影音製作、傳播及資通訊服務業</option>
								<option value="金融及保險業">金融及保險業</option>
								<option value="不動產業">不動產業</option>
								<option value="專業、科學及技術服務業">專業、科學及技術服務業</option>
								<option value="支援服務業">支援服務業</option>
								<option value="公共行政及國防強制性社會安全">公共行政及國防；強制性社會安全</option>
								<option value="教育業">教育業</option>
								<option value="醫療保健及社會工作服務業">醫療保健及社會工作服務業</option>
								<option value="藝術、娛樂及休閒服務業">藝術、娛樂及休閒服務業</option>
								<option value="其他服務業">其他服務業</option>
							</select>
						</div>
						<div class="col-5">
							<label for="">職務類別</label>
							<select class="custom-select" name="captainTitle" id="title" style="font-size: 15px;">
								<option>請選擇...</option>
								<option value="民意代表、高階主管、總執行長">民意代表、高階主管、總執行長</option>
								<option value="行政及商業經理人員">行政及商業經理人員</option>
								<option value="生產及專業服務經理人員">生產及專業服務經理人員</option>
								<option value="餐旅、零售及其他場所服務經理人員">餐旅、零售及其他場所服務經理人員</option>
								<option value="專業人員">專業人員</option>
								<option value="技術員及助理專業人員">技術員及助理專業人員</option>
								<option value="事務支援人員">事務支援人員</option>
								<option value="服務及銷售工作人員">服務及銷售工作人員</option>
								<option value="農林漁牧業生產人員">農林漁牧業生產人員</option>
								<option value="技藝有關工作人員">技藝有關工作人員</option>
								<option value="機械設備操作及組裝人員">機械設備操作及組裝人員</option>
								<option value="基層技術工及勞力工">基層技術工及勞力工</option>
								<option value="軍人">軍人</option>
							</select>
						</div>
						<div class="col-2">
							<label for="">工作年資</label>
							<select class="custom-select" name="captainYear" id="year" style="font-size: 15px;">
								<option>請選擇...</option>
								<option value="1年以下">1年以下</option>
								<option value="1到3年">1-3年</option>
								<option value="3到5年">3-5年</option>
								<option value="5到7年">5-7年</option>
								<option value="7到10年">7-10年</option>
								<option value="10到15年">10-15年</option>
								<option value="15年以上">15年以上</option>
							</select>
						</div>
					</div>

				</form>

			</div>	
		</div>
	
		<div class="main pb-5" style="padding: 0 0">
			<div class="containerIndex">
					<div class="row px-5 py-3">
						<div class="col">
							<div class="h3 mx-auto text-center pb-3 text-secondary"><i class="fas fa-receipt pr-2"></i>發票資訊</div>
							<div class="row pt-2">
								<div class="col-3">
									<label for="">發票式</label>
									<select class="custom-select" style="font-size: 16px;" id="invoice">
										<option value="0">二聯式 (個人)</option>
										<option value="1">三聯式 (公司)</option>
									</select>
								</div>
								<div class="col-3">
									<label for="">統一編號</label>
									<input type="text" class="form-group form-control" maxlength="8" id="taxID">
								</div>
								<div class="col-6">
									<label for="">發票抬頭</label>
									<input type="text" class="form-group form-control" id="buyer">
								</div>
							</div>
							<div class="row pt-2">
								<div class="col">
									<label for="">寄送地址</label>
									<input type="text" class="form-group form-control" id="invoiceAddr">
								</div>
							</div>
						</div>
					</div>
			</div>	
		</div>
	
	<div class="mx-auto text-center pb-5">
		<button type="button" class="btn btn-success btn-lg px-3 py-3" data-toggle="modal" data-target="#orderModal" id="submitOrder" onClick="submitOrder()"><i class="fas fa-paper-plane pr-2 h3"></i><span class="h3">提交訂購單</span></button>
	</div>

<!-- Modal -->
<div class="modal fade" id="orderModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">MoneyStar KEYs財富規劃系統訂購單</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
		  
		  <div class="row">
			  <div class="col">姓名：<span id="getUserName"></span></div>
		  </div>
		  
		  <div class="row">
			  <div class="col">稱謂：<span id="getSex"></span></div>
		  </div>
		  
		  <div class="row">
			  <div class="col">身份證字號：<span id="getID"></span></div>
		  </div>
		  
		  <div class="row">
			  <div class="col">生日：<span id="getBirth"></span></div>
		  </div>
		  
		  <div class="row">
			  <div class="col text-danger font-weight-bolder">Email：<span id="getEmail"></span></div>
		  </div>
		  
		  <div class="row">
			  <div class="col">手機：<span id="getPhone"></span></div>
		  </div>
		  
		  <div class="row">
			  <div class="col">地址：<span id="getAddr"></span></div>
		  </div>
		  
		  <div class="row">
			  <div class="col">產業：<span id="getJob"></span></div>
		  </div>
		  
		  <div class="row">
			  <div class="col">職務：<span id="getTitle"></span></div>
		  </div>
		  
		  <div class="row">
			  <div class="col">年資：<span id="getYear"></span></div>
		  </div>
		  
<hr>
		  
		  <div class="row">
			  <div class="col">發票：<span id="getInvoice"></span></div>
		  </div>
		  
		  <div class="row">
			  <div class="col">買受人：<span id="getBuyer"></span></div>
		  </div>
		  
		  <div class="row">
			  <div class="col">統一編號：<span id="getTaxID"></span></div>
		  </div>
		  
		  <div class="row">
			  <div class="col">發票寄送地址：<span id="getInvoiceAddr"></span></div>
		  </div>
		  
<hr>

		  <div class="row">
			  <div class="col text-success font-weight-bold h5">訂購項目：KEYs專業版授權<span id="getMonths"></span>個月</div>
		  </div>
		  
		  <div class="row">
			  <div class="col text-success font-weight-bold h5">訂單金額：<span id="getAmount"></span>元 整</div>
		  </div>
		  
		  <div class="row">
			  <div class="col text-info font-weight-bold h6">vCode：<input type="text" style="border: 0;outline: 0;background: transparent;" maxlength="8" size="10" class="text-info" id="vCode"><span class="text-info font-weight-bolder ml-2" id="vCodeMsg"></span></div>
		  </div>
		  
		  <div class="row pt-2">
			  <div class="col text-danger h6 mx-auto text-center"><i class="fas fa-exclamation pr-1"></i>提醒您！系統成功開通後，帳號及密碼將寄至您的Email信箱，請確認Email輸入無誤！</div>
		  </div>
		  
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-lg" data-dismiss="modal"><i class="fas fa-backspace pr-2"></i>取消</button>
        <button type="button" class="btn btn-success btn-lg"  data-dismiss="modal" onClick="ajax_payment('CREDIT', 0)"><i class="far fa-credit-card pr-2"></i>線上刷卡繳費</button>
      </div>
    </div>
  </div>
</div>

	
<div id="dialog" class="dialog mx-auto text-center" title="MoneyStar精進財商線上訂購單"></div>
<input type="hidden" value="" id="vCodeResult">
	
<!-- 隱藏傳送訂單資料 -->
<input type="text" value="" id="project">
<input type="hidden" value="" id="">
<input type="hidden" value="" id="">
<input type="hidden" value="" id="">
<input type="hidden" value="" id="">
<input type="hidden" value="" id="">
<input type="hidden" value="" id="">
<input type="hidden" value="" id="">
<input type="hidden" value="" id="">
<input type="hidden" value="" id="">
<input type="hidden" value="" id="">
<input type="hidden" value="" id="">

</section>



<?php require_once("../model/index_js.php") ?>

<script type="text/javascript" src="../controller/waitload.js"></script>
<script type="text/javascript" src="../controller/toggle_tooltip.js"></script>
<!-- 載入ZipCode及Datepicker -->
<script type="text/javascript" src="../controller/datepicker.js"></script>
<script type="text/javascript" src="../controller/zipcode.js"></script>

<!-- Order Button -->
<script>
	function kp1(){
		$("#card1").addClass(`bg-light`);
		$("#card1").addClass(`border-success`);
		$("#card1Title").addClass(`font-weight-bolder`);
		$("#card1Title").addClass(`text-success`);
		$("#card1Months").addClass(`text-success`);
		$("#card1Months").addClass(`font-weight-bolder`);
		$("#card1Button").addClass(`text-success`);
		$("#card1Button").addClass(`font-weight-bolder`);
		$("#card1Icon").removeClass(`far fa-circle`);
		$("#card1Icon").addClass(`far fa-check-circle`);
		//remove 2
		$("#card2").removeClass(`bg-light`);
		$("#card2").removeClass(`border-info`);
		$("#card2Title").removeClass(`font-weight-bolder`);
		$("#card2Title").removeClass(`text-info`);
		$("#card2Months").removeClass(`text-info`);
		$("#card2Months").removeClass(`font-weight-bolder`);
		$("#card2Button").removeClass(`text-info`);
		$("#card2Button").removeClass(`font-weight-bolder`);
		$("#card2Icon").removeClass(`far fa-check-circle`);
		$("#card2Icon").addClass(`far fa-circle`);
		//remove 3
		$("#card3").removeClass(`bg-light`);
		$("#card3").removeClass(`border-warning`);
		$("#card3Title").removeClass(`font-weight-bolder`);
		$("#card3Title").removeClass(`text-warning`);
		$("#card3Months").removeClass(`text-warning`);
		$("#card3Months").removeClass(`font-weight-bolder`);
		$("#card3Button").removeClass(`text-warning`);
		$("#card3Button").removeClass(`font-weight-bolder`);
		$("#card3Icon").removeClass(`far fa-check-circle`);
		$("#card3Icon").addClass(`far fa-circle`);
		//getInfo
		var project = 'OP001';
		$("#project").val(project);
		}
	
	function kp2(){
		$("#card2").addClass(`bg-light`);
		$("#card2").addClass(`border-info`);
		$("#card2Title").addClass(`font-weight-bolder`);
		$("#card2Title").addClass(`text-info`);
		$("#card2Months").addClass(`text-info`);
		$("#card2Months").addClass(`font-weight-bolder`);
		$("#card2Button").addClass(`text-info`);
		$("#card2Button").addClass(`font-weight-bolder`);
		$("#card2Icon").removeClass(`far fa-circle`);
		$("#card2Icon").addClass(`far fa-check-circle`);
		//remove 1
		$("#card1").removeClass(`bg-light`);
		$("#card1").removeClass(`border-success`);
		$("#card1Title").removeClass(`font-weight-bolder`);
		$("#card1Title").removeClass(`text-success`);
		$("#card1Months").removeClass(`text-success`);
		$("#card1Months").removeClass(`font-weight-bolder`);
		$("#card1Button").removeClass(`text-success`);
		$("#card1Button").removeClass(`font-weight-bolder`);
		$("#card1Icon").removeClass(`far fa-check-circle`);
		$("#card1Icon").addClass(`far fa-circle`);
		//remove 3
		$("#card3").removeClass(`bg-light`);
		$("#card3").removeClass(`border-warning`);
		$("#card3Title").removeClass(`font-weight-bolder`);
		$("#card3Title").removeClass(`text-warning`);
		$("#card3Months").removeClass(`text-warning`);
		$("#card3Months").removeClass(`font-weight-bolder`);
		$("#card3Button").removeClass(`text-warning`);
		$("#card3Button").removeClass(`font-weight-bolder`);
		$("#card3Icon").removeClass(`far fa-check-circle`);
		$("#card3Icon").addClass(`far fa-circle`);
		//getInfo
		var months = $("#card2Months").text();
		var amount = $("#card2Button").text();
		$("#getMonths").text(months);
		$("#getAmount").text(amount);
		var project = 'OP002';
		$("#project").val(project);
	}
	
	function kp3(){
		$("#card3").addClass(`bg-light`);
		$("#card3").addClass(`border-warning`);
		$("#card3Title").addClass(`font-weight-bolder`);
		$("#card3Title").addClass(`text-warning`);
		$("#card3Months").addClass(`text-warning`);
		$("#card3Months").addClass(`font-weight-bolder`);
		$("#card3Button").addClass(`text-warning`);
		$("#card3Button").addClass(`font-weight-bolder`);
		$("#card3Icon").removeClass(`far fa-circle`);
		$("#card3Icon").addClass(`far fa-check-circle`);
		//remove 1
		$("#card1").removeClass(`bg-light`);
		$("#card1").removeClass(`border-success`);
		$("#card1Title").removeClass(`font-weight-bolder`);
		$("#card1Title").removeClass(`text-success`);
		$("#card1Months").removeClass(`text-success`);
		$("#card1Months").removeClass(`font-weight-bolder`);
		$("#card1Button").removeClass(`text-success`);
		$("#card1Button").removeClass(`font-weight-bolder`);
		$("#card1Icon").removeClass(`far fa-check-circle`);
		$("#card1Icon").addClass(`far fa-circle`);
		//remove 2
		$("#card2").removeClass(`bg-light`);
		$("#card2").removeClass(`border-info`);
		$("#card2Title").removeClass(`font-weight-bolder`);
		$("#card2Title").removeClass(`text-info`);
		$("#card2Months").removeClass(`text-info`);
		$("#card2Months").removeClass(`font-weight-bolder`);
		$("#card2Button").removeClass(`text-info`);
		$("#card2Button").removeClass(`font-weight-bolder`);
		$("#card2Icon").removeClass(`far fa-check-circle`);
		$("#card2Icon").addClass(`far fa-circle`);
		//getInfo
		var months = $("#card3Months").text();
		var amount = $("#card3Button").text();
		$("#getMonths").text(months);
		$("#getAmount").text(amount);
		var project = 'OP003';
		$("#project").val(project);
	}
</script>	
	
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
		
		// 隱藏付款按鈕
		$(".pay_button").fadeOut( "slow" );
		// 檢查裝置類型
		IsMobileAgent = getIsMobileAgent();
		// 送出AJAX產生訂單，並取得SPToken等資訊
		$.ajax({
		    type: 'POST',
		    url: 'https://wmpcca.com/bswmp/form/ecPay/ajax_process_MoneyStar.php',
		    dataType: 'json',
		    data: 'func=pay&payment_type='+payment_type+'&invoice_status='+invoice_status+'&amount='+amount+'&projectName='+projectName,
		    success: function (sMsg){
		        if(sMsg.RtnCode == 1)
		        {
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
		        else
		        {
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

<!-- 成立前端訂單 -->
	<script>
		
		function submitOrder(){

			var name = $("#name").val();
			var sex = $("#sex").val();
			var identifyNO = $("#identifyNO").val();
			var birth = $("#birth").val();
			var phone = $("#phone").val();
			var email = $("#email").val();
			var city = $("#captainCity").val();
			var district = $("#captainDistrict").val();
			var addr = $("#addr").val();
			var job = $("#job").val();
			var title = $("#title").val();
			var year = $("#year").val();
			var invoice = $("#invoice").val();
				if (invoice == '0'){
					var invoice = '二聯式';
					}
				if (invoice == '1'){
					var invoice = '三聯式';
					}
			var taxID = $("#taxID").val();
			var buyer = $("#buyer").val();
			var invoiceAddr = $("#invoiceAddr").val();
			
			$("#getUserName").text(name);
			$("#getSex").text(sex);
			$("#getID").text(identifyNO);
			$("#getBirth").text(birth);
			$("#getPhone").text(phone);
			$("#getEmail").text(email);
			$("#getCity").text(city);
			$("#getDistrict").text(district);
			$("#getAddr").text(city+district+addr);
			$("#getJob").text(job);
			$("#getTitle").text(title);	
			$("#getYear").text(year);
			$("#getInvoice").text(invoice);
			$("#getTaxID").text(taxID);
			$("#getBuyer").text(buyer);
			$("#getInvoiceAddr").text(invoiceAddr);
			
			
			var project = $("#project").val();
			
			
		//訂單check			


					$.ajax({

					url:"https://wmpcca.com/bswmp/form/model/keys_orderCheck.php",
					data:{
						"project" = project
					},

					method : "POST",

					error : function(msg){
						$("#vCodeMsg").text(msg);
					},

					success : function(msg){
						var amount = '$'+msg[2].toLocaleString();
						$("#getAmount").text(amount);
						$("#getMonths").text(msg[1]);
					}

				});			
		}

		//vCode				
			 $("#vCode").keyup(function(){
				var vCode = $("#vCode").val();	 
				var strvCode =  vCode.length;
				 if (strvCode != 8 ){
					 return;
				 }else{

					$.ajax({

					url:"https://wmpcca.com/bswmp/form/model/vCode_Ajax.php",
					data:{
						"vCode" : vCode,
			//			"months" : months,
			//			"amount" : amount
					},

					method : "POST",

					error : function(msg){
						$("#vCodeMsg").text(msg);
					},

					success : function(msg){
						$("#vCodeMsg").text(msg[2]);
			//			var money = '$'+msg[0].toLocaleString();
			//			$("#getAmount").text(money);
			//			$("#getMonths").text(msg[1]);

					}

				});
			 }
			  });
	</script>
	
	
<!-- vCode Ajax -->
<script>

</script>
	
	
</body>
</html>