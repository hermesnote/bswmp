<?php
require_once("../vender/dbtools.inc.php");

$getToday = date("Y-m-d H:i:s");
$competYear = substr($getToday, 2, 2);

//取得HT資料
$HTsqlSELECTcompetData = " SELECT * FROM histock_eventList WHERE projectNO LIKE '%HT%' ORDER BY id DESC ";
$HTsqlResultcompetData = mysql_query($HTsqlSELECTcompetData, $sqlLink);
$HTsqlFETCHcompetData = mysql_fetch_row($HTsqlResultcompetData);
$HTcompetprojectNO = $HTsqlFETCHcompetData[2]; //競賽代號
$HTcompetprojectName = $HTsqlFETCHcompetData[3]; //競賽名稱
$actFeeHT = $HTsqlFETCHcompetData[4]; //報名費
$HTcompetStartDate = $HTsqlFETCHcompetData[5]; //開始時間
$HTcompetEndDate = $HTsqlFETCHcompetData[6]; //結束時間
setcookie("HTcompetprojectNO", $HScompetprojectNO);
setcookie("HTcompetprojectName", $HScompetprojectName);

//取得HS資料
$HSsqlSELECTcompetData = " SELECT * FROM histock_eventList WHERE projectNO LIKE '%HS%' ORDER BY id DESC ";
$HSsqlResultcompetData = mysql_query($HSsqlSELECTcompetData, $sqlLink);
$HSsqlFETCHcompetData = mysql_fetch_row($HSsqlResultcompetData);
$HScompetprojectNO = $HSsqlFETCHcompetData[2]; //競賽代號
$HScompetprojectName = $HSsqlFETCHcompetData[3]; //競賽名稱
$actFeeHS = $HSsqlFETCHcompetData[4]; //報名費
$HScompetStartDate = $HSsqlFETCHcompetData[5]; //開始時間
$HScompetEndDate = $HSsqlFETCHcompetData[6]; //結束時間
setcookie("HScompetprojectNO", $HScompetprojectNO);
setcookie("HScompetprojectName", $HScompetprojectName);

//HT報名按鈕開放
if (strtotime($getToday) >= strtotime($HTcompetStartDate) && strtotime($getToday) <= strtotime($HTcompetEndDate)){
	$HTcompet = "TRUE";
}else {
	$HTcompet = "FALSE";
}

//HS報名按鈕開放
if (strtotime($getToday) >= strtotime($HScompetStartDate) && strtotime($getToday) <= strtotime($HScompetEndDate)){
	$HScompet = "TRUE";
}else {
	$HScompet = "FALSE";
}


?>

<!doctype html>

<html>
<head>
<?php require_once("../model/index_rel.php") ?>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.0/themes/smoothness/jquery-ui.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css" rel="stylesheet">
	
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

<title>WMPCCA - 全國金融證券投資實務競賽</title>
	

	
<style>
.banner_inner{
	font-size: 13px;
	line-height: 1.8;
	color: #000000;
	background-image: url("../img/histockHeader2.png");
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

.form-control-lg {
    padding: 0rem 0rem;
	width: 75%;
	text-align: center;
}
	
.containerIndex {
	width: 600px;
	height: auto;
	background: white;
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

::placeholder { /* Chrome, Firefox, Opera, Safari 10.1+ */
	color: lightgray;
	opacity: 1; /* Firefox */
	text-align: center;
}

:-ms-input-placeholder { /* Internet Explorer 10-11 */
	color: lightgray;
	text-align: center;
}

::-ms-input-placeholder { /* Microsoft Edge */
	color: lightgray;
	text-align: center;
}

/*飽和*/
.saturate{
	-webkit-filter:saturate(100);
}
/*亮度-亮*/
.brightness1{
	-webkit-filter:brightness(100);
}
/*亮度-暗*/
.brightness2{
	-webkit-filter:brightness(.5);
}
/*對比*/
.contrast{
	-webkit-filter:contrast(2);
}
/*模糊*/
.blur{
	-webkit-filter:blur(3px);
}
/*下拉陰影*/
.drop-shadow{
	-webkit-filter:drop-shadow(5px 5px 5px #333);
}
/*不透明*/
.opacity{
	-webkit-filter:opacity(1);
}

/*Mouse Pointer*/
.actMethod, .score, .competFlow, .competRules, .privacy{
	cursor:pointer;
}
	
/* Go Top */
#gotop {
	font-size: 30px;
    position:fixed;
    z-index:90;
    right:30px;
    bottom:30px;
    display:none;
    width:50px;
    height:50px;
    color:#FCCE0D;
    background-color: #0B7376;
    line-height:50px;
    border-radius:50%;
    transition:all 0.5s;
    text-align: center;
    box-shadow: 0 2px 5px 0 rgba(0,0,0,0.16), 0 2px 10px 0 rgba(0,0,0,0.12);
}
#gotop :hover{
    background-color:#0B7376;
}
	
/* Modal */
body .modal-dialog { 
    max-width: 70%;
}

/* tab對齊 */
.nav-tabs{
    margin: 0;
}
.nav-tabs .nav-item {
    padding: 0;
}

</style>	
	
	
</head>

<body>
<?php require_once("../model/waitload.php") ?>
<?php require_once("../model/cc_imgGroup_Modal.php") ?>
<?php require_once("../model/index_nav.php") ?>

	
	
<!-- 登入專區 -->
<section class="home_banner_area">
	<div class="banner_inner">
<div class="main">
	<div class="containerIndex mx-auto">
<!-- Nav tabs -->
	<ul class="nav nav-tabs md-tabs tabs-2 light-blue darken-3 row" role="tablist">

		<li class="nav-item col text-center bg-light">
			<a class="nav-link active" data-toggle="tab" href="#panelHS" role="tab"><i class="fas fa-user-friends" style="font-size: 2em;"></i>
				<h4>同學這裡走</h4>
			</a>
		</li>

		<li class="nav-item col text-center bg-light">
			<a class="nav-link" data-toggle="tab" href="#panelHT" role="tab"><i class="fas fa-chalkboard-teacher" style="font-size: 2em;"></i>
				<h4>老師這邊請</h4>
			</a>
		</li>
		
	</ul>

<!-- Tab panels -->
	<div class="tab-content">
<!-- Panel HS -->
		<div class="tab-pane fade in show active" id="panelHS" role="tabpanel">

<!-- PanelHS Body -->
			<div class="modal-body mb-1 py-2 mx-auto text-center">

				<div class="h2 my-3">金融與證券投資實務知識奧運會競賽</div>
		
				<div class="row py-2">
					<div class="col-2"></div>
					<div class="col-8 text-center">
						<input type="text" class="form-control-lg" id="HSexamNO" placeholder="請輸入隊伍編號" size="15" maxlength="15">
					</div>
					<div class="col-2"></div>
				</div>
				
				<div class="row py-2">
					<div class="col-2"></div>
					<div class="col-8 text-center">
						<input type="text" class="form-control-lg" id="HSpwd" placeholder="請輸入驗證碼" size="15" maxlength="15">
					</div>
					<div class="col-2"></div>
				</div>

			</div>

<!-- panelHS Footer -->
		<div class="mx-auto text-center py-3">
			<button class="btn btn-lg btn-info" onClick="HSpassCHK()">登入競賽專區</button>
		</div>
			
		<div class="mx-auto text-center py-3">
			<a href="https://wmpcca.com/bswmp/form/view/histock_reGetCode.php" target="_blank"><small class="text-muted" id="HSpassCHKMsg">忘記密碼?</small></a>
		</div>

		</div>
<!--/.PanelHT-->

<!-- PanelHT -->
		<div class="tab-pane fade in" id="panelHT" role="tabpanel">

<!-- PanelHT Body -->
			<div class="modal-body mb-1 py-2 mx-auto text-center">

				<div class="h2 my-3">金融證券投資實務輔導員選拔</div>
				
				<div class="row py-2">
					<div class="col-2"></div>
					<div class="col-8 text-center">
						<input type="text" class="form-control-lg" id="examNOHT" placeholder="請輸入選拔代號" size="15" maxlength="15">
					</div>
					<div class="col-2"></div>
				</div>
				
				<div class="row py-2">
					<div class="col-2"></div>
					<div class="col-8 text-center">
						<input type="text" class="form-control-lg" id="vCodeHT" placeholder="請輸入驗證碼" size="15" maxlength="15">
					</div>
					<div class="col-2"></div>
				</div>
				


			</div>

<!-- PanelHT Footer -->
		<div class="mx-auto text-center py-3">
			<button class="btn btn-lg btn-info" onClick="HTpassCHK()">登入活動專區</button>
		</div>
			
		<div class="mx-auto text-center py-3">
			<a href="https://wmpcca.com/bswmp/form/view/histock_reGetCode.php" target="_blank"><small class="" id="loginMsg">忘記密碼?</small></a>
		</div>

		</div>
<!-- /.Panel HT -->
	</div>
		
	</div>
</div>
	</div>
</section>
	


<!-- 競賽介紹 -->
<section class="made_life_area p_120">
	<div class="container">
		<div class="h1 mx-auto text-center font-weight-bold pb-4" style="color: #FAB216;">
			金融與證券投資實務知識奧運會競賽
		</div>
		<p class="h5 py-2">
教育部技術型高級中等學校商業與管理群科中心學校，為提升學生新課綱『金融與證券投資實務課程』中，金融相關知識與股票市場基本操作原理，並強化新課綱做中學、學中做的精神，特與本會共同舉辦本屆「金融證券投資實務全國競賽」，冀期培養學生金融核心素養，透過競賽參與增加自主學習動機，以理論知識為基礎，專研實務操作技巧，深究金融證券市場的價值，理解學用落差。建立正確投資理財觀念，了解風險與報酬的概念及資產配置的重要性，落實金融核心能力。</p>
		<div class="mx-auto text-center py-2">
			<img src="../img/histockIndex.png" width="1080" height="100%">
		</div>
		<p class="h5 py-5">
十二年國教以素養導向教學、強調金融市場實務模擬與生活情境的連結及互動，以驗證金融與證券投資實務課程之學習成效，建構完整學習歷程，協助學生探索日後升學規劃，達到學有所用，興趣導向的終極就業目標。
		</p>
	</div>


</section>

<!-- Keys 推薦 -->
<!--
<section class="" style="background-image:url(../img/keysbg05.jpg);background-repeat: no-repeat;background-size:cover;height: 300px;width: 100%;">
	<div class="container">
		<div class="row justify-content-center py-5">
			<div class="col-4">
				<img class="align-middle inline" src="../img/key.png" alt="keys" width="auto" height="180">
				<img src="../img/MoneyStar-05.png" alt="MoneyStar" width="auto" height="80" style="float: right">
			</div>
			<div class="col-8">
				<h1 class="text-info" style="margin-top: 55px;">競賽使用「我是大股東」</h1>
				<h6 class="pl-2">登入競賽專區前往取得(首次註冊免費使用3個月標準版)</h6>
			</div>
		</div>
	</div>
</section>
-->


<!-- 賽事資訊頁籤 -->
<a name="signupMain" id="signupMain1"></a>


<!-- 賽事資訊 -->
<section class="price_area p_120">
	<div class="container">
		<div class="h1 mx-auto text-center font-weight-bold pb-3" style="color: #FAB216">
			活動資訊
		</div>

		<div class="row text-center mx-auto">
			<div class="col-sm text-center mx-auto">
				<div class="card">
					<img class="card-img-top" src="../img/ht01.jpg" alt="Card image cap" height="300px" width="auto">
					<div class="card-body">
						<h5 class="card-title mx-auto text-center h3 text-info">教師</h5>
						<h5 class="card-title mx-auto text-center h4 font-weight-bold">金融證券投資實務輔導員選拔</h5>
						<p class="card-text">
						活動時間：6小時，日期見本站消息<br>
						研習內容：金融證券投資實務測驗及競賽<br>
						報名對象：全國高中職任課教師<br>
						報名形式：個別報名<br>
						報名費用：每位新台幣<strong class="text-info"> NT$<? echo $actFeeHT; ?>元</strong> 整<br>
						</p>
						<div class="mx-auto text-center">
						<button type="button" class="btn btn-outline-info mx-auto text-center" id="HTsignupButton" onClick="toHTsignup()">點此報名</button>
						</div>
					</div>
				</div>
			</div>
			<div class="col-sm text-center mx-auto">
				<div class="card">
					<img class="card-img-top" src="../img/hs01.jpg" alt="Card image cap" height="300px" width="auto">
					<div class="card-body">
						<h5 class="card-title mx-auto text-center h3 text-warning">高中職</h5>
						<h5 class="card-title mx-auto text-center h4 font-weight-bold">金融與證券投資實務知識奧運會競賽</h5>
						<p class="card-text">
						競賽期間：每年9月 至 12月<br>
						競賽方式：線上測驗及團體投資競賽 二階段<br>
						報名對象：全國高中職學校在學生<br>
						報名形式：每隊2人<br>
						報名費用：每隊新台幣<strong class="text-warning"> NT$<? echo $actFeeHS; ?>元</strong> 整<br>
						</p>
						<div class="mx-auto text-center">
						<button type="button" class="btn btn-outline-warning mx-auto text-center" id="HSsignupButton" onClick="toHSsignup()">我要報名</button>
						</div>
					</div>
				</div>
			</div>

<!--
			<div class="col-sm text-center mx-auto">
				<div class="card" style="width: 20rem;">
					<img class="card-img-top" src="../img/compet/competCollege.png" alt="Card image cap">
					<div class="card-body">
						<h5 class="card-title mx-auto text-center h3 text-success">全國大專校院 北中南</h5>
						<h5 class="card-title mx-auto text-center h4 font-weight-bold">分區理財規劃案例競賽</h5>
						<p class="card-text">
						競賽期間：每年9月 至 次年1月<br>
						競賽方式：初賽、決賽 二階段<br>
						報名對象：大專院校（含專科）在學生<br>
						人數限制：每隊三人（最多，須同校）<br>
						報名費用：每隊新台幣<strong class="text-success">NT$1,000元</strong> 整<br>
						</p>
						<div class="mx-auto text-center">
						<button type="button" class="btn btn-outline-success mx-auto text-center" id="NCSsignupButton" onClick="toNCSsignup()">我要報名</button>
						</div>
					</div>
				</div>
			</div>
-->
			
		</div>
	
<!--
		<div class="row pt-5">
			<div class="col-2 text-center mx-auto">
				<img src="../img/iconpic/a13.png" class="actMethod" alt="" width="100px" height="auto">
				<h3 class="pt-2">活動辦法</h3>
			</div>
			<div class="col-2 text-center mx-auto">
				<img src="../img/iconpic/a01.png" class="score" alt="" width="100px" height="auto">
				<h3 class="pt-2">評分標準</h3>
			</div>
			<div class="col-2 text-center mx-auto">
				<img src="../img/iconpic/a35.png" class="competFlow" alt="" width="100px" height="auto"><br>
				<h3 class="pt-2">競賽流程</h3>
			</div>
			<div class="col-2 text-center mx-auto">
				<img src="../img/iconpic/a63.png" class="competRules" alt="" width="100px" height="auto">
				<h3 class="pt-2">競賽規則</h3>
			</div>
			<div class="col-2 text-center mx-auto">
				<img src="../img/iconpic/a04.png" class="privacy" alt="" width="100px" height="auto">
				<h3 class="pt-2">個資保護政策</h3>
			</div>
			<div class="col-2 text-center mx-auto">
				<a href="http://bit.ly/2uIqM9J" target="_blank"><img src="../img/iconpic/a03.png" alt="" width="100px" height="auto"></a>
				<h3 class="pt-2">未成年同意書</h3><br>
			</div>
		</div>
	
	</div>
</section>
-->



<!-- 案主徵選 -->
<!--
<section class="made_life_area p_120" style="background-image:url(../img/18691635.jpg);background-repeat: no-repeat;background-size: cover;">
	<div class="container">
	<div class="row">
		<div class="col-md-4">
			<i class="fas fa-child" style="color: white;font-size: 50px;"></i><i class="fas fa-child pl-2" style="color: white;font-size: 50px;"></i><i class="fas fa-child pl-2" style="color: white;font-size: 50px;"></i>
			<div class="contact-info">
				<h1 class="text-white">案主徵選</h1>
				<h3 class="text-white-50">成為我們的決賽評審！</h4>
				<h5 class="text-black-50 pt-2">理財菁英與您直接面對面</h5>
				<h5 class="text-black-50">為您量身訂作生涯理財方案</h5>
				<h5 class="text-black-50"></h5>
				<h5 class="text-black-50">入選者即贈「KEYs財務決策系統標準版」（價值 8,800 元）</h5>
				
			</div>
		</div>
		<div class="col-md-8">
			<div class="contact-form">
				<div class="form-group">
				  <label class="control-label col-sm-2" for="fname">姓名:</label>
				  <div class="col-sm-10">          
					<input type="text" class="form-control" id="clientName" placeholder="請輸入全名" name="clientName">
				  </div>
				</div>
				<div class="form-group">
				  <label class="control-label col-sm-2" for="lname">聯絡電話:</label>
				  <div class="col-sm-10">          
					<input type="text" class="form-control" id="clientPhone" placeholder="請輸入行動電話號碼" name="clientPhone">
				  </div>
				</div>
				<div class="form-group">
				  <label class="control-label col-sm-2" for="email">E-mail:</label>
				  <div class="col-sm-10">
					<input type="email" class="form-control" id="clientEmail" placeholder="請輸入您的電子郵件" name="clientEmail">
				  </div>
				</div>
				<div class="form-group">        
				  <div class="col-sm-offset-2 col-sm-10">
					<button type="submit" class="btn" onClick="clientSubmit()">與我聯絡</button>
					<small class="form-text text-muted mx-auto text-right" id="clientSubmitMsg">本會收到您的申請後將與您聯絡</small>
				  </div>
				</div>
			</div>
		</div>
	</div>
	</div>
</section>
-->


<!-- 合作夥伴 -->
<section class="price_area p_120">
	<div class="container">
		
		<div class="h1 mx-auto text-center font-weight-bold pb-3" style="color: #FAB216">
			主辦單位｜協辦單位
		</div>
	
		<div class="row mx-auto text-center">
					<div class="col-4 mx-auto text-center">
						<img src="../img/ntnu_LOGO.png" alt="" width="auto" height="120">
					</div>
					<div class="col-4 mx-auto text-center">
						<img src="../img/logo_01.png" alt="" width="auto" height="80">
					</div>
	<!--
					<div class="col-4 mx-auto text-center">
						<img src="../img/partnerLOGO_400x150_GIA.png" alt="" width="auto" height="100">
					</div>
	-->
		</div>
<!--
		
	<div class="row mx-auto text-center">
				<div class="col-4 mx-auto text-center">
					<img src="../img/partnerLOGO_400x150_ECPAY.png" alt="" width="auto" height="100">
				</div>
				<div class="col-4 mx-auto text-center">
					<img src="" alt="" width="auto" height="100">
				</div>
				<div class="col-4 mx-auto text-center">
					<img src="" alt="" width="auto" height="100">
				</div>
	</div>
	<div class="row pt-4">
				<div class="col">
					<img src="../img/compet/13898669464.jpg" alt="" width="auto" height="100">
				</div>
	</div>
-->
		
	</div>
</section>




<!-- TEST -->
<!--
<section class="price_area p_120">
	<div class="container">
		HScompet : <?php echo $HScompet ?><br>
		HScompetStartDate : <?php echo $HScompetStartDate ?><br>
		HScompetEndDate : <?php echo $HScompetEndDate ?><br>
	</div>
</section>
-->
<!-- TEST End -->

<!-- GoTop -->
<a href="#" id="gotop">
   <i class="fa fa-angle-up"></i>
</a>



<!-- hidden PHP Time Value-->
	<!-- HT -->
<input type="hidden" name="HTcompet" id="HTcompet" Value="<?php echo $HTcompet; ?>">
<input type="hidden" name="HTcompetEndDate" id="HTcompetEndDate" Value="<?php echo $HTcompetStartDate; ?>">
<input type="hidden" name="HTcompetEndDate" id="HTcompetEndDate" Value="<?php echo $HTcompetEndDate; ?>">
<input type="hidden" name="HTcompetprojectNO" id="HTcompetprojectNO" Value="<?php echo $HTcompetprojectNO; ?>">
<input type="hidden" name="HTcompetprojectName" id="HTcompetprojectName" Value="<?php echo $HTcompetprojectName; ?>">	
	<!-- HS -->
<input type="hidden" name="HScompet" id="HScompet" Value="<?php echo $HScompet; ?>">
<input type="hidden" name="HScompetEndDate" id="HScompetEndDate" Value="<?php echo $HScompetStartDate; ?>">
<input type="hidden" name="HScompetEndDate" id="HScompetEndDate" Value="<?php echo $HScompetEndDate; ?>">
<input type="hidden" name="HScompetprojectNO" id="HScompetprojectNO" Value="<?php echo $HScompetprojectNO; ?>">
<input type="hidden" name="HScompetprojectName" id="HScompetprojectName" Value="<?php echo $HScompetprojectName; ?>">
	
<!-- hidden PHP Time Value End-->

<?php require_once("../model/index_footer.php") ?>
<?php require_once("../model/index_js.php") ?>

<script type="text/javascript" src="../controller/waitload.js"></script>
<script type="text/javascript" src="../controller/index_nav.js"></script>
<script type="text/javascript" src="../controller/toggle_tooltip.js"></script>
<!-- nexus JS -->
<script src="../nexus/vendors/owl-carousel/owl.carousel.min.js"></script>
<script src="../controller/HSpassCHK.js"></script>
<script src="../controller/HTpassCHK.js"></script>
	
<!-- 自定義 js -->
<!--<script src="../controller/noMobileDevice.js"></script>-->

	
<!-- SignupDate Query Function -->
<script>
$(document).ready(function(){
	if( navigator.userAgent.match(/Android/i)
	|| navigator.userAgent.match(/webOS/i)
	|| navigator.userAgent.match(/iPhone/i)
	|| navigator.userAgent.match(/iPad/i)
	|| navigator.userAgent.match(/iPod/i)
	|| navigator.userAgent.match(/BlackBerry/i)
	|| navigator.userAgent.match(/Windows Phone/i)
	){
	alert("系統偵測到您正使用手機或平板等行動裝置進行操作，行動瀏覽器可能導致部分功能無法正常使用，請使用電腦進行操作！(※建議使用Google Chrome瀏覽器進行操作)");
	window.location.href = 'https://wmpcca.com/';
	}
});		
	
var HScompet = $("#HScompet").val()
	if (HScompet === "TRUE") {
		$("#HSsignupButton").html("我要報名");
	} else if (HScompet === "FALSE") {
		$("#HSsignupButton").html("尚未開放");
		$("#HSsignupButton").attr("disabled", "disabled");
		$("#HSsignupButton").removeClass();
		$("#HSsignupButton").addClass("btn btn-secondary mx-auto text-center");
	}
	
var HTcompet = $("#HTcompet").val()
	if (HTcompet === "TRUE") {
		$("#HTsignupButton").html("我要報名");
	} else if (HTcompet === "FALSE") {
		$("#HTsignupButton").html("尚未開放");
		$("#HTsignupButton").attr("disabled", "disabled");
		$("#HTsignupButton").removeClass();
		$("#HTsignupButton").addClass("btn btn-secondary mx-auto text-center");
	}
	
$("#HTsignupButton").click(function(){
  window.location.href = 'https://wmpcca.com/bswmp/form/view/histock_HTsignup.php';
 });
						   
$("#HSsignupButton").click(function(){
  window.location.href = 'https://wmpcca.com/bswmp/form/view/histock_HSsignup.php';
 });
// Carousel
		$('#blogCarousel').carousel({
				interval: 3500
		});
		$('#blogCarousel2').carousel({
				interval: 3500
		});
</script>
<!-- SignupDate Function End -->	
	
<script>
$( function () {
	$( '#signupMain' ) . click( function () {
		$( 'html,body' ) . animate( {
			scrollTop: $( '#signupMain1' ) . offset() . top
		}, "show" );
		return false;
	} );
} );
$(function() {
    /* 按下GoTop按鈕時的事件 */
    $('#gotop').click(function(){
        $('html,body').animate({ scrollTop: 0 }, 'slow');   /* 返回到最頂上 */
        return false;
    });
    
    /* 偵測卷軸滑動時，往下滑超過400px就讓GoTop按鈕出現 */
    $(window).scroll(function() {
        if ( $(this).scrollTop() > 400){
            $('#gotop').fadeIn();
        } else {
            $('#gotop').fadeOut();
        }
    });
});
</script>

<script>
$(".actMethod").click(function () {
	let title = "台灣財富管理規劃顧問認證協會 - 競賽活動辦法";
	let content = `
		<div class="pl-3">
			<p class="h5">活動期間：依各競賽公佈為主。</p>
			<p class="h5">參加資格：依各競賽公佈為主。</p>
			<p class="h5">報名方式：網路報名，每隊1~3人。</p>
			<p class="h5">報名費用：依各競賽公佈為主。</p>
			<p class="h5">團報優惠：同校報名10隊以上，每隊新台幣$850元整 (限大專競賽)。</p>
			<p class="h5">活動流程：依各競賽公佈為主。</p>
			<p class="h5 pt-2">活動獎勵：</p>
				<p class="h5 pl-3 pt-2"><strong>全國財富管理競賽</strong></p>
					<p class="h6 pl-5">第一名：獎金新台幣$15,000元整，冠軍獎盃一座，獎狀一楨</p>
					<p class="h6 pl-5">第二名：獎金新台幣$12,000元整，亞軍獎盃一座，獎狀一楨</p>
					<p class="h6 pl-5">第三名：獎金新台幣 $9,000元整，季軍獎盃一座，獎狀一楨</p>
					<p class="h6 pl-5">特　優：獎金新台幣 $4,500元整，獎狀一楨</p>
					<p class="h6 pl-5">優　等：獎金新台幣 $3,000元整，獎狀一楨</p>
					<p class="h6 pl-5">佳　作：獎狀一楨</p>
				<p class="h5 pl-3 pt-2"><strong>全國大專財富管理競賽</strong></p>
					<p class="h6 pl-5">第一名：獎金新台幣$15,000元整，冠軍獎盃一座，獎狀一楨</p>
					<p class="h6 pl-5">第二名：獎金新台幣$12,000元整，亞軍獎盃一座，獎狀一楨</p>
					<p class="h6 pl-5">第三名：獎金新台幣 $9,000元整，季軍獎盃一座，獎狀一楨</p>
					<p class="h6 pl-5">特　優：獎金新台幣 $4,500元整，獎狀一楨</p>
					<p class="h6 pl-5">優　等：獎金新台幣 $3,000元整，獎狀一楨</p>
					<p class="h6 pl-5">佳　作：獎狀一楨</p>
				<p class="h5 pl-3 pt-2"><strong>全國大專校院北、中、南分區理財規劃案例競賽</strong></p>
					<p class="h6 pl-5">第一名：獎金新台幣$6,000元整，獎狀一楨</p>
					<p class="h6 pl-5">第二名：獎金新台幣$4,500元整，獎狀一楨</p>
					<p class="h6 pl-5">第三名：獎金新台幣$3,000元整，獎狀一楨</p>
					<p class="h6 pl-5">特　優：獎金新台幣$1,500元整，獎狀一楨</p>
					<p class="h6 pl-5">優　等：獎金新台幣$1,000元整，獎狀一楨</p>
					<p class="h6 pl-5">佳　作：獎狀一楨</p>
					<p class="h6 pl-5 pt-2"><strong><u>※  以上『特優』、『優等』及『佳作』之名額，視該屆競賽報名總隊伍數斟酌頒發。</u></strong></p>
			<p class="h5 pt-2">注意事項：</p>
				<ol>
					<li class="h5 pl-3 pt-2">競賽期間請各隊參賽成員遵循<strong><a>競賽規則</a></strong>，如有違反規則之情節事實，本會將取消參賽者之活動權利。</li>
					<li class="h5 pl-3 pt-1">參賽成員於參加本活動同時，即視為同意接受本活動辦法，本會得將其部分資料運用或公佈於本會網站或相關活動宣傳物中。</li>
					<li class="h5 pl-3 pt-1">參賽成員個人資料之蒐集、處理及利用，請參考本會之<strong><a>隱私權保護政策。</a></strong></li>
					<li class="h5 pl-3 pt-1"><strong>未成年者(未滿20歲)</strong>須下載並填寫<a href="https://drive.google.com/file/d/1BU5GuDmnJDXtk7rjaQkbX0i_vcQWsD12/view" target="_blank"><u>競賽同意書</u></a>，由其監護人或法定代理人簽章後，於當屆賽事之初賽收件截止日之前，寄至<a data-toggle="tooltip" data-placement="top" title="104台北市中山區南京東路二段216號8樓（台灣財富管理規劃顧問認證協會 收）"><u>本會</u></a>，郵戳為憑，逾期視同放棄參賽資格，本會將取消全隊後續參賽之權利。(可統一收取後一併寄送)</li>
					<li class="h5 pl-3 pt-1">競賽期間，系統將依競賽時程開放／關閉各項報名系統、繳費系統及檔案上傳功能，逾期視同放棄，請參賽成員自行注意競賽專區之競賽時程表。</li>
					<li class="h5 pl-3 pt-1">活動之報名統一由隊長做為代表，系統將發送競賽之隊伍編號及驗證碼至隊長E-mail，持隊編及驗證碼登入競賽專區後，於報名期間完善所有成員之報名資料。報名截止後隊伍任一成員資料不全者視同全隊放棄參賽資格，已繳交之報名費用不予退返。</li>
					<li class="h5 pl-3 pt-1">請各隊成員自行做好溝通，本會將以報名結束時之隊伍成員資料做為參賽認定，不接受任何形式更改隊伍成員之要求。</li>
					<li class="h5 pl-3 pt-1">入圍決賽及簡報之隊伍名單，將於網站公佈，或可登入競賽專區查詢，不另行通知。</li>
					<li class="h5 pl-3 pt-1">各競賽公佈決賽成績之第一名、第二名及第三名之所有隊伍成員，須於頒獎典禮全體出席，並進行成果發表之簡報。</li>
					<li class="h5 pl-3 pt-1">除前三名外之獲獎隊伍須一半以上隊伍成員參與頒獎典禮，如因不可抗拒之事由無法出席頒獎典禮者(非私人因素，經評審團同意者除外)，須於頒獎典禮前至本會網站或競賽專區填寫線上<a><u>請假單</u></a>。未填寫請假單而無故缺席者，或全隊請假無人出席頒獎典禮之隊伍，均視同全隊放棄獲獎資格，包括獲獎名次、所有獎項及獎金之發放，將轉由本會自行處理。因前述原因取消之名次及獎項不予遞補</li>
					<li class="h5 pl-3 pt-1">獎盃、獎牌及獎狀等獎項，以實物為準，如因不可抗拒之事由導致獎品內容變更，中獎人同意接受主辦單位安排之替代獎品，不得要求折現或轉換其他商品，亦不得要求將獎項讓與他人。</li>
					<li class="h5 pl-3 pt-1">頒獎典禮相關資訊將與得獎名單同時公佈，並於公告後一個月內舉行，如遇不可抗拒情事須延期舉行，以本會網站公告為主，不另通知。</li>
					<li class="h5 pl-3 pt-1">前述相關頒獎活動僅限全國財富管理競賽及全國大專財富管理競賽</li>
					<li class="h5 pl-3 pt-1">全國大專校院北、中、南分區理財規劃案例競賽得獎隊伍之獎項將另行寄送至各校單位。</li>
					<li class="h5 pl-3 pt-1">所有活動通知將以本會網站公佈為主不另通知，本會有權決定取消、終止、修改或暫停本活動。</li>
				</ol>
		</div>
			`
	setInModal(title, content);
})
$(".competRules").click(function () {
	let title = "台灣財富管理規劃顧問認證協會 - 競賽規則";
	let content = `
		<div class="pl-3">
			<p class="h5">報告書格式：全國財富管理競賽之決賽報告書首頁須為競賽指定格式，競賽期間登入競賽專區下載後置於檔案首頁。</p>
			<p class="h5">上傳檔案格式：上傳之報告書檔案格式須為PDF，簡報檔案格式須符合微軟Office Powerpoint之通用格式.ppt或.pptx</p>
			<p class="h5">書面報告書：一式四份(A4格式)，能清楚辨識為原則，可自行選擇黑白或彩色列印，並請妥善裝訂。</p>
			<p class="h5">評分標準：依各競賽公佈為主。</p>
			<p class="h5 pt-4">注意事項：</p>
				<ol>
					<li class="h5 pl-3 pt-2">必要之基本假設與計算過程需於報告書附錄頁附上，包括運用工具所輸入的各項數據，若無附數據評審將斟酌扣分。</li>
					<li class="h5 pl-3 pt-2">大專參賽隊伍之所有報告及簡報之內容，嚴禁出現足以辨識參賽者任何資訊(姓名、學校、指導老師、隊名…等)，違者取消參賽資格，已繳交之報名費用不予退返。</li>
					<li class="h5 pl-3 pt-2">大專決賽簡報隊伍請於簡報當天自行攜帶書面報告，於簡報評審老師提問時紀錄使用。</li>
					<li class="h5 pl-3 pt-2">大專決賽簡報隊伍之簡報檔允許美編及動畫修正，若修改數據與文字內容，需提出對照表供評審檢核。</li>
					<li class="h5 pl-3 pt-2">大專決賽簡報時間為10分鐘及評審提問15分鐘。</p>
					<li class="h5 pl-3 pt-2">全國財富管理競賽參賽隊伍之初賽報告書之內容，嚴禁出現足以辨識參賽者任何資訊(姓名、隊名、服務單位、商業圖標…等)，違者取消參賽資格，已繳交之報名費用不予退返。</li>
					<li class="h5 pl-3 pt-2">全國財富管理競賽參賽隊伍於競賽期間，除咨詢時間外，嚴禁以任何形式與案主進行聯繫或接觸，違者取消參賽資格，已繳交之報名費用不予退返。</li>
					<li class="h5 pl-3 pt-2">全國財富管理競賽案主咨詢時間為，隊伍提問一分鐘，案主回答三分鐘。</p>
					<li class="h5 pl-3 pt-2">全國財富管理競賽及全國大專財富管理競賽得獎前三名隊伍於頒獎典禮之成果發表簡報時間為每隊15分鐘</p>
					<li class="h5 pl-3 pt-2">所有競賽應於繳交期間繳交之檔案如有不全或逾期，視同全隊放棄參賽權利，已繳交之報名費用不予退返。</li>
				</ol>
		</div>
			`
	setInModal(title, content);
})
$(".privacy").click(function () {
	let title = "台灣財富管理規劃顧問認證協會 - 隱私權保護政策";
	let content = `
			<div class="pl-3 h5">
				<p>依個人資料保護法要求，請各隊所有成員參與台灣財富管理規劃發展協會活動報名前，務必於詳閱本條款，所有參與活動之人員，詳閱後於報名欄之「同意」欄勾選，始得報名參加本活動。</p>
				<p>本同意條款說明台灣財富管理規劃顧問認證協會（以下簡稱本會）將如何處理本表單所蒐集到的個人資料。當報名時勾選「同意」之欄位選項時，表示參與本活動之所有報名成員均已閱讀、瞭解並同意接受本同意條款之所有內容及其後修改變更規定。若有成員未滿二十歲，應於您的法定代理人閱讀、瞭解並同意本同意條款之所有內容及其後修改變更規定後，方得使用本活動，但若您已接受本活動，視為已取得法定代理人之同意，並遵守以下所有規範。</p>
				<h3>一、基本資料之蒐集、更新及保管</h3>
				<p class="pl-3">1. 本會蒐集您的個人資料在中華民國「個人資料保護法」與相關法令之規範下，依據協會「隱私權保護政策」，蒐集、處理及利用於參與活動之個人資料。</p>
				<p class="pl-3">2. 請於報名時提供正確、最新及完整的個人資料。</p>
				<p class="pl-3">3. 本會因執行業務所蒐集您的個人資料包括姓名、電話、身份證字號、生日、地址、email、現職單位、就讀學校…等。</p>
				<p class="pl-3">4. 若您的個人資料有任何異動，請主動向協會申請更正，使其保持正確、最新及完整。</p>
				<p class="pl-3">5. 若您提供錯誤、不實、過時或不完整或具誤導性的資料，您將損失相關權益。</p>
				<p class="pl-3">6. 成員可依中華民國「個人資料保護法」，通知本會行使以下權利：</p>
				<p class="pl-5">(1)請求補充或更正。</p>
				<p class="pl-5">(2)請求停止蒐集、處理及利用。</p>
				<p class="pl-5">(3)請求刪除。</p>
				<p class="pl-3">但因本會執行職務或業務所必須者，協會得拒絕之。若成員欲執行上述權利時，請透過<strong><a href="https://wmpcca.com/contact/" target="_blank">線上表單</a></strong>與本會聯絡。但因成員行使上述權利，而導致權益受損時，協會將不負相關賠償責任。</p>
				<br>
				<h3>二、蒐集個人資料之目的</h3>
				<p class="pl-3">1. 本會為執行所有參賽成員參與協會所舉辦的活動相關業務需蒐集的個人資料。</p>
				<p class="pl-3">2. 當參賽成員的個人資料使用方式與當初本會蒐集的目的不同時，本會將在使用前先徵求參賽成員的書面同意，成員可以拒絕向協會提供個人資料，但可能因此喪失權益。</p>
				<p class="pl-3">3. 協會利用參賽成員的個人資料期間為即日起1年內，利用地區為台灣地區，於次年定期銷毀所填具之申請表及同意書。</p>
				<br>
				<h3>三、基本資料之保密</h3>
				<p class="pl-3">參賽成員的個人資料受到協會依「個人資料保護法」之保護及規範。協會如違反「個人資料保護法」規定或因天災、事變或其他可抗力所致者，致參賽成員的個人資料被竊取、洩漏、竄改、遭其他侵害者，本會將於查明後以電話、信函、電子郵件或網站公告等方法，擇適當方式通知參賽成員。</p>
				<br>
				<h3>四、同意書之效力</h3>
				<p class="pl-3">1. 當參賽成員於活動報名同意欄位勾選「同意」時視同簽署同意條款，即表示參賽成員已閱讀、瞭解並同意本活動之所有條款及內容，如違反活動辦法及規則條例時，協會得隨時終止對參賽成員所提供之所有權益或服務。</p>
				<p class="pl-3">2. 本會保留隨時修改本同意條款之權利，本會將於修改條款時，於本會網頁(站)公告修改之事實，不另作個別通知。如果參賽成員不同意修改的內容，請勿繼續參與本次活動。否則將視為已同意並接受本同意條款該等增訂或修改內容之拘束。</p>
				<p class="pl-3">3. 參賽成員自本同意條款取得的任何建議或資訊，無論是書面或口頭形式，除非本同意條款有明確規定，均不構成本同意條款以外之任何保證。</p>
				<br>
				<h3>五、準據法與管轄法院</h3>
				<p class="pl-3">本同意條款之解釋與適用，以及本同意條款有關之爭議，均應依照中華民國法律予以處理，並以臺灣臺北地方法院為管轄法院。</p>
			</div>
			`
	setInModal(title, content);
})
	
$(".score").click(function () {
	let title = "財富管理競賽 - 評分標準";
	let content = `
<div class="row">
	<div class="col-6 text-center">
		<p class="h4 text-center pt-2"><strong>全國財富管理競賽</strong></p>
	</div>
	<div class="col-6 text-center">
		<p class="h5 text-center"><strong>全國大專財富管理規劃競賽</strong></p>
		<p class="h6 text-center"><strong>全國大專校院北、中、南分區理財規劃案例競賽</strong></p>
	</div>
</div>

<div class="row">
	<div class="col-6">
		<p class="h5 pl-3 pt-2 text-right"><strong>初賽報告</strong></p>
			<table width="100%" border="1" class="h6">
				<tr>
					<td width="20%" class="font-weight-bold text-center">評分項目</td>
					<td width="60%" class="font-weight-bold text-center">評審說明</td>
					<td width="20%" class="font-weight-bold text-center">佔分比例</td>
				</tr>
				<tr>
					<td>報告友善度</td>
					<td>整體報告是否容易檢索、理解、方便閱讀</td>
					<td class="text-center">25%</td>
				</tr>
				<tr>
					<td>假設數據合理性</td>
					<td>必要之基本假設與參考資料是否合理與正確</td>
					<td class="text-center">15%</td>
				</tr>
				<tr>
					<td>計算正確性</td>
					<td>財務計算過程是否正確</td>
					<td class="text-center">15%</td>
				</tr>
				<tr>
					<td>建議方案廣泛性</td>
					<td>各建議方案是否面面俱到符合客戶需求</td>
					<td class="text-center">25%</td>
				</tr>
				<tr>
					<td>整體執行性</td>
					<td>建議執行步驟與商品之客觀程度</td>
					<td class="text-center">20%</td>
				</tr>
				<tr>
					<td colspan="2" class="text-right">合計</td>
					<td class="text-center">100%</td>
				</tr>
			</table>
	</div>

	<div class="col-6">
		<p class="h5 pl-3 pt-2 text-right"><strong>初賽報告</strong></p>
			<table width="100%" border="1" class="h6">
				<tr>
					<td width="20%" class="font-weight-bold text-center">評分項目</td>
					<td width="60%" class="font-weight-bold text-center">評審說明</td>
					<td width="20%" class="font-weight-bold text-center">佔分比例</td>
				</tr>
				<tr>
					<td>報告友善度</td>
					<td>整體報告是否容易檢索、理解、方便閱讀</td>
					<td class="text-center">25%</td>
				</tr>
				<tr>
					<td>假設數據合理性</td>
					<td>必要之基本假設與參考資料是否合理與正確</td>
					<td class="text-center">15%</td>
				</tr>
				<tr>
					<td>財務診斷能力</td>
					<td>是否具備診斷客戶生涯財務狀況計算能力(需附上計算數據)</td>
					<td class="text-center">25%</td>
				</tr>
				<tr>
					<td>建議方案廣泛性</td>
					<td>各建議方案是否面面俱到符合客戶需求</td>
					<td class="text-center">20%</td>
				</tr>
				<tr>
					<td>整體執行性</td>
					<td>建議執行步驟與商品之客觀程度</td>
					<td class="text-center">15%</td>
				</tr>
				<tr>
					<td colspan="2" class="text-right">合計</td>
					<td class="text-center">100%</td>
				</tr>
			</table>
	</div>
</div>

<div class="row">
	<div class="col-6">
		<p class="h5 pl-3 pt-2 text-right"><strong>決賽咨詢</strong></p>
			<table width="100%" border="1" class="h6">
				<tr>
					<td width="80%" class="font-weight-bold text-center">評分項目</td>
					<td width="20%" class="font-weight-bold text-center">佔分比例</td>
				</tr>
				<tr>
					<td>協助案主瞭解理財各項屬性</td>
					<td class="text-center">15%</td>
				</tr>
				<tr>
					<td>協助案主釐清財務目標項目與需求程度</td>
					<td class="text-center">20%</td>
				</tr>
				<tr>
					<td>協助案主揭露財務資訊</td>
					<td class="text-center">20%</td>
				</tr>
				<tr>
					<td>協助案主確認理財進度</td>
					<td class="text-center">15%</td>
				</tr>
				<tr>
					<td>咨詢技巧展現</td>
					<td class="text-center">15%</td>
				</tr>
				<tr>
					<td>案主是否願意提供書面財務資料</td>
					<td class="text-center">15%</td>
				</tr>
				<tr>
					<td class="text-right">合計</td>
					<td class="text-center">100%</td>
				</tr>
			</table>
	</div>

	<div class="col-6">
		<p class="h5 pl-3 pt-2 text-right"><strong>決賽簡報</strong></p>
			<table width="100%" border="1" class="h6">
				<tr>
					<td width="20%" class="font-weight-bold text-center">評分項目</td>
					<td width="60%" class="font-weight-bold text-center">評審說明</td>
					<td width="20%" class="font-weight-bold text-center">佔分比例</td>
				</tr>
				<tr>
					<td rowspan="3">簡報內容</td>
					<td>簡報製作及編排是否具有邏輯性，條理分明</td>
					<td class="text-center">10%</td>
				</tr>
				<tr>
					<td>簡報是否掌握重點</td>
					<td class="text-center">10%</td>
				</tr>
				<tr>
					<td>簡報是否具備親和力</td>
					<td class="text-center">5%</td>
				</tr>
				<tr>
					<td colspan="2" class="text-right">合計</td>
					<td class="text-center">25%</td>
				</tr>
			</table>
	</div>
</div>

<div class="row">
	<div class="col-6">
		<p class="h5 pl-3 pt-2 text-right"><strong>決賽報告</strong></p>
			<table width="100%" border="1" class="h6">
				<tr>
					<td width="20%" class="font-weight-bold text-center">評分項目</td>
					<td width="60%" class="font-weight-bold text-center">評審說明</td>
					<td width="20%" class="font-weight-bold text-center">佔分比例</td>
				</tr>
				<tr>
					<td rowspan="2">書面報告內容</td>
					<td>是否具備診斷案主生涯財務狀況計算能力</td>
					<td class="text-center">20%</td>
				</tr>
				<tr>
					<td>案主理解程度(案主評分)</td>
					<td class="text-center">15%</td>
				</tr>
				<tr>
					<td rowspan="5">解決方案</td>
					<td>分析與推演是否合理</td>
					<td class="text-center">10%</td>
				</tr>
				<tr>
					<td>總經等參數假設是否合理</td>
					<td class="text-center">5%</td>
				</tr>
				<tr>
					<td>規劃方向是否符合案主需求及價值觀</td>
					<td class="text-center">15%</td>
				</tr>
				<tr>
					<td>解決方案中，金融商品的運用能力</td>
					<td class="text-center">20%</td>
				</tr>
				<tr>
					<td>案主執行意願(案主評分)</td>
					<td class="text-center">15%</td>
				</tr>
				<tr>
					<td colspan="2" class="text-right">合計</td>
					<td class="text-center">100%</td>
				</tr>
			</table>
	</div>

	<div class="col-6">
		<p class="h5 pl-3 pt-2 text-right"><strong>決賽發表</strong></p>
			<table width="100%" border="1" class="h6">
				<tr>
					<td width="20%" class="font-weight-bold text-center">評分項目</td>
					<td width="60%" class="font-weight-bold text-center">評審說明</td>
					<td width="20%" class="font-weight-bold text-center">佔分比例</td>
				</tr>
				<tr>
					<td rowspan="4">表達力</td>
					<td>口語表達能力</td>
					<td class="text-center">5%</td>
				</tr>
				<tr>
					<td>肢體運用能力</td>
					<td class="text-center">5%</td>
				</tr>
				<tr>
					<td>團隊合作能力</td>
					<td class="text-center">5%</td>
				</tr>
				<tr>
					<td>理解問題能力</td>
					<td class="text-center">5%</td>
				</tr>
				<tr>
					<td>案例發表報告</td>
					<td>評審問答</td>
					<td class="text-center">55%</td>
				</tr>
				<tr>
					<td colspan="2" class="text-right">合計</td>
					<td class="text-center">75%</td>
				</tr>
			</table>
	</div>
</div>
			`
	setInModal(title, content);
})

$(".competFlow").click(function () {
	let title = "財富管理競賽 - 評分標準";
	let content = `
<div class="row">
	<div class="col text-center mx-auto">
		<img src="../img/competflow4.png" alt="" width="1200px" height="auto">
	</div>
</div>
			`
	setInModal(title, content);
})
	
</script>		
	
</body>
</html>