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

<!-- nexus CSS -->
<link rel="stylesheet" href="../nexus/css/font-awesome.min.css">
<link rel="stylesheet" href="../nexus/vendors/animate-css/animate.css">
<link rel="stylesheet" href="../nexus/vendors/owl-carousel/owl.carousel.min.css">
<link rel="stylesheet" href="../nexus/vendors/flaticon/flaticon.css">

<link rel="stylesheet" href="../nexus/css/style.css">
<link rel="stylesheet" href="../nexus/css/responsive.css">
<meta charset="utf-8">

<title>BSgrid</title>

<style>
	
/* TEST */
.card { background-color: rgba(245, 245, 245, 0.4); }
.card { border: none; }
.card-header, .card-footer { opacity: 1}
.b-radius{ border-radius: 10px; }

.radioStyle {display: none;
}
.radioStyle:not(:disabled) ~ label {
  cursor: pointer;
}
.radioStyle:disabled ~ label {
  color: #bcc2bf;
  border-color: #bcc2bf;
  box-shadow: none;
  cursor: not-allowed;
}

.radioStyle-label {
  height: 100%;
  display: block;
  background: white;
  border: 2px solid #20df80;
  border-radius: 20px;
  padding: 1rem;
  margin-bottom: 1rem;
  text-align: center;
  box-shadow: 0px 3px 10px -2px rgba(161, 170, 166, 0.5);
  position: relative;
}

.radioStyle:checked + label {
  background: #20df80;
  color: white;
  box-shadow: 0px 0px 20px rgba(0, 255, 128, 0.75);
}
.radioStyle:checked + label::after {
/*  color: #3d3f43;*/ 
  color: green;  
  font-family: FontAwesome;
  border: 2px solid #1dc973;
  content: "\f00c";
  font-size: 24px;
  position: absolute;
  top: -25px;
  left: 50%;
  transform: translateX(-50%);
  height: 50px;
  width: 50px;
  line-height: 50px;
  text-align: center;
  border-radius: 50%;
  background: white;
  box-shadow: 0px 2px 5px -2px rgba(0, 0, 0, 0.25);
}

.inputStyle{
	border-top: none;
	border-left: none;
	border-right: none;
	border-bottom: 2 silver dashed;
	border-radius: 0;
	background: transparent;
}
	
.form-control:focus {
	border-color: green;
	box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(126, 255, 104, 0.8);
	border-bottom: 2 green dashed;
}

/*
input[type="radio"] {
  display: none;
}
input[type="radio"]:not(:disabled) ~ label {
  cursor: pointer;
}
input[type="radio"]:disabled ~ label {
  color: #bcc2bf;
  border-color: #bcc2bf;
  box-shadow: none;
  cursor: not-allowed;
}

label {
  height: 100%;
  display: block;
  background: white;
  border: 2px solid #20df80;
  border-radius: 20px;
  padding: 1rem;
  margin-bottom: 1rem;
  text-align: center;
  box-shadow: 0px 3px 10px -2px rgba(161, 170, 166, 0.5);
  position: relative;
}

input[type="radio"]:checked + label {
  background: #20df80;
  color: white;
  box-shadow: 0px 0px 20px rgba(0, 255, 128, 0.75);
}
input[type="radio"]:checked + label::after {
  color: #3d3f43;
  font-family: FontAwesome;
  border: 2px solid #1dc973;
  content: "\f00c";
  font-size: 24px;
  position: absolute;
  top: -25px;
  left: 50%;
  transform: translateX(-50%);
  height: 50px;
  width: 50px;
  line-height: 50px;
  text-align: center;
  border-radius: 50%;
  background: white;
  box-shadow: 0px 2px 5px -2px rgba(0, 0, 0, 0.25);
}
*/

p {
  font-weight: 900;
}

@media only screen and (max-width: 700px) {
  section {
    flex-direction: column;
  }
}
	
/* TEST End */


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
				<p class="h2">KEYs財富管理系統<span class="h6">(啟用／升級)</span></p>
			</div>
		</div>
	</div>
</section>
	
<section class="made_life_area p_120">
<div class="container">

<!--
	<div class="row">
		<div class="col"></div>
		<div class="col"><img src="../img/11111.png" width="auto" height="auto"></div>
		<div class="col"><img src="../img/22222.png"></div>
	</div>
-->
	
	<div class="row">
		<div class="col-md-4 pt-3">

			<div class="card mt-2">
			<img class="card-img-top" src="../img/op001.png">
			<div class="card-body">
				<input type="radio" class="radioStyle" id="OP001" name="select" value="OP001" checked>
				<label class="radioStyle-label" for="OP001">
				<h2 class="pt-2">專業版授權</h2>
				<p class="h4">12個月</p>
				<p class="h1">$19,800</p>
				</label>
			</div>
			</div>
        </div>
		  
        <div class="col-md-4 pt-3">

			<div class="card mt-2">
			<img class="card-img-top" src="../img/op002.png">
			<div class="card-body">
				<input type="radio" class="radioStyle" id="OP002" name="select" value="OP002">
				<label class="radioStyle-label" for="OP002">
				<h2 class="pt-2">專業版授權</h2>
				<p class="h4">25個月</p>
				<p class="h1">$24,800</p>
				</label>
			</div>
			</div>
        </div>
		  
        <div class="col-md-4 pt-3">

			<div class="card mt-2">
			<img class="card-img-top" src="../img/op003.png">
			<div class="card-body">
				<input type="radio" class="radioStyle" id="OP003" name="select" value="OP003">
				<label class="radioStyle-label" for="OP003">
				<h2 class="pt-2">專業版授權</h2>
				<p class="h4">39個月</p>
				<p class="h1">$29,800</p>
				</label>
			</div>
			</div>
        </div>
	</div>

  <div class="row">
	  
    <div class="col-md-9 not-right-table-content">
      <!--nest content here, it's like a new grid-->
      <div class="row">

        <div class="col-md-12 pt-2">
			<div class="card bg-white b-radius">
			<div class="card-body">
			<h5 class="card-title font-weight-bolder"><i class="fas fa-user h5"></i><span class="pl-2">用戶資訊 <small class="text-danger pl-3">※ 新用戶請確實完整選填</small></span></h5>
				
				<div class="row">
					
					<div class="col-4">
						<label for="name">姓名</label>
						<input type="text" class="form-control inputStyle text-center" id="name">
					</div>
					
					<div class="col-2">
						<label for="sex">稱謂</label>
							<select name="sex" class="form-control inputStyle text-center" id="sex">
								<option value="先生">先生</option>
								<option value="小姐">小姐</option>
							</select>
					</div>
					
					<div class="col-3">
						<label for="identifyNO">身份證字號</label>
						<input type="text" class="form-control inputStyle text-center" id="identifyNO">
					</div>
					
					<div class="col-3">
						<label for="birth">生日</label><small class="pl-2">(YYYY-MM-DD)</small>
							<input type="text" class="form-control inputStyle datepicker text-center" name="birth" id="birth">
					</div>
					
				</div>
					
				<div class="row pt-5">
					
					<div class="col-4">
						<label for="phone">行動電話</label><small class="pl-2">(輸入格式：0912345678)</small>
						<input type="text" class="form-control inputStyle text-center" id="phone">
					</div>

					<div class="col-8">
						<label for="email">Email</label>
						<input type="text" class="form-control inputStyle text-center" id="email">
					</div>
					
				</div>
				
				<div class="row pt-5">
					
					<div class="col-3">
						<label for="city">通訊地-縣市</label>
							<select name="city" class="form-control inputStyle" id="captainCity">
								<option value="">請選擇...</option>
							</select>
					</div>

					<div class="col-3">
						<label for="district">通訊地-鄉鎮市區</label>
							<select class="form-control inputStyle" name="captainDistrict" id="captainDistrict">
								<option value="">請選擇...</option>
							</select>
					</div>
					
					<div class="col-6">
						<label for="addr">通訊地-地址</label>
						<input type="text" class="form-control inputStyle text-center" id="addr">
					</div>
					
				</div>
				
				<div class="row pt-5 pb-4">
					<div class="col-5">
						<label for="job">服務產業</label>
						<select class="form-control inputStyle" name="job" id="job" style="font-size: 15px;">
							<option value="">請選擇...</option>
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
						<label for="title">職務類別</label>
						<select class="form-control inputStyle" name="title" id="title" style="font-size: 15px;">
							<option value="">請選擇...</option>
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
						<label for="year">工作年資</label>
						<select class="form-control inputStyle" name="year" id="year" style="font-size: 15px;">
							<option value="">請選擇...</option>
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
				
			</div>
			</div>
        </div>
		  
        <div class="col-md-12 pt-4 pb-2">
			<div class="card bg-light h-100 b-radius">
			<div class="card-body">
			<h5 class="card-title font-weight-bolder"><i class="fas fa-file-invoice-dollar h5"></i><span class="pl-2">發票資訊<input type="checkbox" class="ml-4 mr-2" style="transform: scale(1.5)" id="invoiceCHK">同訂購人</span></h5>
				
				<div class="row">

					<div class="col-3">
						<label for="invoice">樣式</label>
							<select name="invoice" class="form-control inputStyle text-center" id="invoice">
								<option value="二聯式">二聯式</option>
								<option value="三聯式">三聯式</option>
							</select>
					</div>
					
					<div class="col-3">
						<label for="taxID">統一編號</label>
							<input type="text" name="taxID" class="form-control inputStyle text-center" id="taxID" value="">
					</div>
					
					<div class="col-6">
						<label for="buyer">買受人(抬頭)</label>
						<input type="text" name="buyer" class="form-control inputStyle text-center" id="buyer" value="">
					</div>

				</div>
				
				<div class="row">
					
					<div class="col pt-5">
						<label for="invoiceAddr">發票寄送地址</label>
							<input type="text" name="invoiceAddr" class="form-control inputStyle text-center" id="invoiceAddr" value="">
					</div>

				</div>
				
			</div>
			</div>
        </div>
		  
		  
		  
      </div>
    </div>
	  
    <div class="col-md-3 pt-2">
		<div class="card bg-white d-inline-block b-radius">
			<div class="card-body">
				
<!--				<form name="submitOrder" id="submitOrder" action="" method="post">-->
				
				<div class="pb-2"><i class="fas fa-shopping-cart h5"></i><span class="pl-3 font-weight-bolder">訂單金額:</sapn></div>
				<div class="card-title h2 text-success font-weight-bolder"><span class="pl-4" id="showPrice">$19,800</span></div>
				
				<hr width="90%">
				
				<div class="pb-2"><i class="fas fa-unlock-alt h5"></i></i><span class="pl-3 font-weight-bolder">授權版本:</sapn></div>
				<div class="card-text h5 text-success font-weight-bolder"><span class="pl-4">KEYs《專業版》</span></div>
				<div class="card-text h5 text-success font-weight-bolder"><span class="pl-4"><span id="months">12</span>個月</span></div>
				
				<hr width="90%">
				
				<div class="pb-2"><i class="far fa-calendar-alt h5"></i><span class="pl-3 font-weight-bolder">到期日:</sapn></div>
				<div class="card-text h5 text-success font-weight-bolder"><span class="pl-4">至 <span id="endDate"><? echo $OP001endDate ?></span></span> 止</div>
				
				<hr width="90%">
				
				<div><i class="fas fa-tag h5"></i><span class="pl-3 font-weight-bolder">vCode</span></div>

				<div class="input-group mb-3 pb-2" id="vCodeInput">
				  <input type="text" class="form-control text-center" aria-label="Recipient's username" aria-describedby="basic-addon2" maxlength="8" id="vCode" placeholder="<?php echo $vCode; ?>">
				  <div class="input-group-append">
					<button class="btn btn-outline-success" type="button" onClick="vCodeCHK()" id="vCodeCHK">GO</button>
				  </div>
				</div>
			
				<div>
				<h3 class="font-weight-bolder mx-auto text-center text-danger" id="getvCodeDescribe"></h3>
				</div>
				<hr width="90%">
				
<!--
				<div class="py-2"><i class="fas fa-chalkboard-teacher h5"></i><span class="pl-3 font-weight-bolder text-success">加購顧問課程再優惠</span></div>
					
				<div class="input-group mb-3">
					<select name="invoiceType" class="form-control inputStyle text-center" id="invoiceType" style="border: none;">
						<option>查看課程</option>
						<option value="0">財富規劃實務專業訓練</option>
							<option value="1">財富規劃顧問專業培練</option>
						<option value="2">財富規劃產學講師培訓</option>
					</select>
				</div>
					
				<hr width="90%">
				
				<div class="px-2 py-2 bg-light">
					
					
					<div class="card-text h6"><span class="pl-4">您已選擇以下加購課程：</span></div>
					<div class="card-text h6"><span class="pl-4">財富規劃實務專業訓練</span></div>
					<div class="card-text h6"><span class="pl-4">時數：16小時</span></div>
					<div class="card-text h6"><span class="pl-4">訂價：$19,800</span></div>
					<div class="card-text h6"><span class="pl-4">加購優惠：$12,800</span></div>
					<div class="card-text mx-auto text-right py-1"><button class="btn btn-danger btn-sm"><i class="fas fa-times"></i></button></div>
											
				</div>
					
				<hr width="90%">
-->

<!-- 成立訂單 -->
			
				<div class="mx-auto text-center py-2"><button class="btn btn-success btn-lg" onClick="submitOrderList()" id="submitOrderList">成立訂單</button></div>
				<!--  訂購單 Modal -->
				<div class="modal fade orderList-modal-lg" id="orderList" tabindex="-1" role="dialog" aria-labelledby="orderListTitle" aria-hidden="true">
				  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
					<div class="modal-content px-5 py-2">
						
					  <div class="modal-header">
						<h2 class="modal-title mx-auto text-center" id="orderListTitle"><img src="../img/MS_logo.png" height="80px" width="auto"></h2>
					  </div>
						
					  <div class="modal-body">
						  
						  <h4>訂單明細</h4>

						  <div class="row">
							  <div class="col-4 bg-light font-weight-bold">訂單編號</div>
							  <div class="col-8"><span id="showOrderNO"></span></div>
						  </div>
						  
						  <div class="row">
							  <div class="col-4 bg-light font-weight-bold">訂購項目</div>
							  <div class="col-8"><span id="showProject"></span></div>
						  </div>
						  
						  <div class="row">
							  <div class="col-4 bg-light font-weight-bold">授權期間</div>
							  <div class="col-8"><span id="showMonths"></span>個月</div>
						  </div>
						  
						  <div class="row">
							  <div class="col-4 bg-light font-weight-bold">使用期限</div>
							  <div class="col-8"><span id="showDate"></span></div>
						  </div>
						  
						  <div class="row">
							  <div class="col-4 bg-light font-weight-bold">vCode優惠</div>
							  <div class="col-8 text-success font-weight-bolder"><span id="vCodeDescribe"><? echo $vCode ?></span></div>
						  </div>
						  
						  <hr/>
						  
						  <h4>授權資訊</h4>

						  <div class="row">
							  <div class="col-4 bg-light font-weight-bold">用戶</div>
							  <div class="col-8"><span id="showName"></span>&nbsp;<span id="showSex"></span>&nbsp;&nbsp;&nbsp;(客戶編號：<span id="showCID"></span>)</div>
						  </div>
						  
						  <div class="row">
							  <div class="col-4 bg-light font-weight-bold">身份</div>
							  <div class="col-8"><span id="showJob"></span>&nbsp;<span id="showTitle"></span></div>
						  </div>
						  
						  <div class="row">
							  <div class="col-4 bg-light font-weight-bold">身份證字號</div>
							  <div class="col-8"><span id="showID"></span></div>
						  </div>
						  
						  <div class="row">
							  <div class="col-4 bg-light font-weight-bold">行動電話</div>
							  <div class="col-8"><span id="showPhone"></span></div>
						  </div>
						  
						  <div class="row">
							  <div class="col-4 bg-light font-weight-bold">Email</div>
							  <div class="col-8"><span id="showEmail"></span></div>
						  </div>
						  
						  <div class="row">
							  <div class="col-4 bg-light font-weight-bold">通訊地址</div>
							  <div class="col-8"><span id="showAddr"></span></div>
						  </div>
						  
						  <hr/>
						  
						  <h4>付款明細</h4>

						  <div class="row">
							  <div class="col-4 bg-light font-weight-bold">付款方式</div>
							  <div class="col-8">線上刷卡</div>
						  </div>
						  
						  <div class="row">
							  <div class="col-4 bg-light font-weight-bold">訂單金額</div>
							  <div class="col-8 text-danger font-weight-bolder"><span id="showMN"></span></div>
						  </div>
						  
						  <hr/>
						  
						  <h4>發票明細</h4>

						  <div class="row">
							  <div class="col-4 bg-light font-weight-bold">發票樣式</div>
							  <div class="col-8"><span id="showInvoice"></span></div>
						  </div>
						  
						  <div class="row">
							  <div class="col-4 bg-light font-weight-bold">買受人</div>
							  <div class="col-8"><span id="showBuyer"></span></div>
						  </div>
						  
						  <div class="row">
							  <div class="col-4 bg-light font-weight-bold">統一編號</div>
							  <div class="col-8"><span id="showTaxID"></span></div>
						  </div>
						  
						  <div class="row">
							  <div class="col-4 bg-light font-weight-bold">寄送地址</div>
							  <div class="col-8"><span id="showInvoiceAddr"></span></div>
						  </div>
						  
						  <hr/>
						  
						  <div class="row">
							  <div class="col text-right">訂單時間：<span id="showOrderTime"></span></div>
						  </div>
						  
					  </div>
						
					  <div class="modal-footer">
						<h5 class="modal-title mx-auto text-center">線上刷卡金流服務由<img src="../img/esafe_logo.png" class="px-3" height="40px" width="auto">提供</h5>
						<button type="button" class="btn btn-lg btn-secondary" data-dismiss="modal">取消</button>
						<button type="button" class="btn btn-lg btn-success" onClick="paySafeSend()"><i class="far fa-credit-card"></i><span class="ml-2">確認結帳</span></button>
					  </div>
						
					</div>
				  </div>
				</div>
			
<!--				</form>-->
				
			</div>
		</div>
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


	<!-- 方案選擇Radio -->
<script>
$(".radioStyle").on("click", function () {
    var checkVal = $(".radioStyle:checked").val()
    switch (checkVal) {
        case "OP001":
            $("#showPrice").text("$19,800");
			$("#months").text("12");
			$("#endDate").text("<? echo $OP001endDate ?>");
            break;
        case "OP002":
            $("#showPrice").text("$24,800");
			$("#months").text("25");
			$("#endDate").text("<? echo $OP002endDate ?>");
            break;
        case "OP003":
            $("#showPrice").text("$29,800");
			$("#months").text("39");
			$("#endDate").text("<? echo $OP003endDate ?>");
            break;
    }
});
</script>

	
	<!-- 發票同訂購人 -->
<script>
	
 $("#invoiceCHK").click(function () {
	 var buyer = $('#name').val();
	 var distArr = $("#captainDistrict").val().split(" ");
	 var invoiceAddr = distArr[0] + $("#captainCity").val() + distArr[1]+ $("#addr").val();
  
  if($('#invoiceCHK').is(":checked")){
   $("#invoiceAddr").text(invoiceAddr);
   $("#invoiceAddr").val(invoiceAddr);
   $("#buyer").text(buyer);
   $("#buyer").val(buyer);
  }else{
   $("#invoiceAddr").text("");
   $("#invoiceAddr").val("");
   $("#buyer").text("");
   $("#buyer").val("");
  }
	  });
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
						$("#vCode").attr("type", "hidden");
						$("#vCodeCHK").attr("style", "display:none");
						$("#vCodeInput").attr("style", "display:none");
						$("#getvCodeDescribe").text(msg);
//						$("#vCode").attr("disabled", "disabled");
//						$("#vCode").attr("placeholder", msg);
//						$("#vCodeDescribe").html(msg);
					  }
					}
				
				
				});	
		
	}
	
	
	

			
</script>


	<!-- 成立訂單 -->
<script>
	function submitOrderList(){
		
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
		var project = $("input[name=select]:checked").val();
		var invoice = $("#invoice").val();
		var taxID = $("#taxID").val();
		var buyer = $("#buyer").val();
		var invoiceAddr = $("#invoiceAddr").val();
		var vCode = $("#vCode").val();
		
		if ( (name=="") || (sex=="") || (identifyNO=="") || (birth=="") || (phone=="") || (email=="") || (city=="") || (district=="") || (addr=="") || (job=="") || (title=="") || (year == '') ){
			Swal.fire({
			  icon: 'warning',
			  title: '等等...',
			  text: '用戶資訊似乎沒有確實填寫呢',
			})
			return false;
		}else{
			
			//將訂購資料往後端送但不成立訂單, 先取回對應資料
				$.ajax({

					url:"https://wmpcca.com/bswmp/form/model/op_OrderList_ajax.php",
					data:{
						"project" : project,
						"vCode" : vCode,
						"name" : name,
						"sex" : sex,
						"identifyNO" : identifyNO,
						"birth" : birth,
						"phone" : phone,
						"email" : email,
						"city" : city,
						"district" : district,
						"addr" : addr,
						"job" : job,
						"title" : title,
						"year" : year,
						"invoice" : invoice,
						"taxID" : taxID,
						"buyer" : buyer,
						"invoiceAddr" : invoiceAddr
					},

					method : "POST",

					error : function(msg){
						Swal.fire({
						  icon: 'warning',
						  title: '糟了...',
						  text: '似乎發生了狀況, 請重新操作',
						})
					},

					success : function(msg){
						$("#showOrderNO").text(msg[0]);
						$("#showProject").text(msg[1]);
						$("#showMonths").text(msg[2]);
						$("#showDate").text(msg[3]);
						$("#vCodeDescribe").text(msg[4]);
						$("#showCID").text(msg[5]);
						$("#showName").text(msg[6]);
						$("#showSex").text(msg[7]);
						$("#showID").text(msg[8]);
						$("#showPhone").text(msg[9]);
						$("#showEmail").text(msg[10]);
						$("#showAddr").text(msg[11]);
						$("#showJob").text(msg[12]);
						$("#showTitle").text(msg[13]);
						$("#showInvoice").text(msg[14]);
						$("#showTaxID").text(msg[15]);
						$("#showBuyer").text(msg[16]);
						$("#showInvoiceAddr").text(msg[17]);
						$("#showOrderTime").text(msg[18]);
						var str = msg[19];
						$("#showMN").text( '$'+parseInt(str).toLocaleString() );
						
						$("#hiddenForm").append(`
							<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
							<form name="sendForm" action="${msg[39]}" method="POST">
								<input type="hidden" name="web" value="${msg[20]}">
								<input type="hidden" name="MN" value="${msg[21]}">
								<input type="hidden" name="OrderInfo" value="${msg[22]}">
								<input type="hidden" name="Td" value="${msg[23]}">
								<input type="hidden" name="sna" value="${msg[24]}">
								<input type="hidden" name="sdt" value="${msg[25]}">
								<input type="hidden" name="email" value="${msg[26]}">
								<input type="hidden" name="note1" value="${msg[27]}">
								<input type="hidden" name="note2" value="${msg[28]}">
								<input type="hidden" name="Card_Type" value="${msg[29]}">
								<input type="hidden" name="Country_Type" value="${msg[30]}">
								<input type="hidden" name="Term" value="${msg[31]}">
								<input type="hidden" name="CargoFlag" value="${msg[32]}">
								<input type="hidden" name="StoreID" value="${msg[33]}">
								<input type="hidden" name="StoreName" value="${msg[34]}">
								<input type="hidden" name="BuyerCid" value="${msg[35]}">
								<input type="hidden" name="DonationCode" value="${msg[36]}">
								<input type="hidden" name="Carrier_ID" value="${msg[37]}">
								<input type="hidden" name="ChkValue" value="${msg[38]}">
							</form>
						`);
						
					}

					});	
			
			
			
			$("#orderList").modal("show")
		}
	}
	
//訂單確認結帳	
	function paySafeSend(){
		sendForm.submit();
	}
</script>

	
<!-- 準備傳送表單 -->
<div id="hiddenForm" style="display: none;"></div>
	
</body>
</html>