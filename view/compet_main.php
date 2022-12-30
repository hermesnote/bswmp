<?php

//連結資料庫
require_once("../vender/dbtools.inc.php");

//建立資料庫連線
$sqlLink = mysql_connect("localhost", "hermesn1_wmpcca", "Since2018");
mysql_select_db("hermesn1_wmpccaBackEnd", $sqlLink);
mysql_query("SET NAMES 'UTF8'");

//取得現在日期時間
$getToday = date("Y-m-d H:i:s");

//取得COOKIE
$teamNO = $_COOKIE["teamNO"];
$teamName = $_COOKIE["teamName"];
$passed = $_COOKIE["passed"];
$projectNO = $_COOKIE["projectNO"];
$projectName = $_COOKIE["projectName"];
$teamDB = $_COOKIE["teamDB"];
$passed = $_COOKIE["passed"];
$memberDB = $_COOKIE["memberDB"];

//COOKIE登入錯誤
if ($passed != "TRUE"){
echo "<script type='text/javascript'>";
echo "alert('COOKIE錯誤!請重新登入！')";
echo "</script>";
header("location:compet_index.php");
exit();
}

//取得隊長資料
$sqlSELECTcaptainInfo = " SELECT * FROM socialInfo WHERE teamNO = '$teamNO' AND remarks = '隊長' ";
$sqlRESULTcaptainInfo = mysql_query($sqlSELECTcaptainInfo, $sqlLink);
$sqlFETCHcaptainInfo = mysql_fetch_row($sqlRESULTcaptainInfo);
$captainName = $sqlFETCHcaptainInfo[3];

$sqlSCN = " SELECT name FROM socialInfo WHERE teamNO = '$teamNO' AND remarks = '隊長' ";
$sqlRCN = mysql_query($sqlSCN, $sqlLink);
$sqlFCN = mysql_fetch_row($sqlRCN);
$FCN = $sqlFCN[0];

//取得副手資料

//取得隊員資料
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
				<a href="#signupMain" id="signupMain"><button type="button" class="form-control btn btn-outline-danger" style="text-align: center; width: 50%">資料編輯</button></a>
			</div>
			<div class="form-group mx-auto text-center">
				<a href="#signupMain" id="signupMain"><button type="button" class="form-control btn btn-outline-info" style="text-align: center; width: 50%">檔案上傳</button></a>
			</div>
			<div class="form-group mx-auto text-center">
				<a href="#signupMain" id="signupMain"><button type="button" class="form-control btn btn-outline-warning" style="text-align: center; width: 50%">收據列印</button></a>
			</div>
			<div class="form-group mx-auto text-center">
				<a href="#signupMain" id="signupMain"><button type="button" class="form-control btn btn-outline-secondary" style="text-align: center; width: 50%">參賽證明</button></a>
			</div>
			<div class="mx-auto text-center">
			<div class="form-group mx-auto text-center">
				<a href="#signupMain" id="signupMain"><button type="button" class="form-control btn btn-outline-success" style="text-align: center; width: 50%">線上繳費</button></a>
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




<section class="made_life_area p_120">
	<div class="container">
		<nav>
		<div class="nav nav-tabs" id="nav-tab" role="tablist">
		<a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#teaminfo" role="tab" aria-controls="nav-home" aria-selected="true">隊 伍 資 訊</a>
		<a class="nav-item nav-link ml-3" id="nav-profile-tab" data-toggle="tab" href="#captainProfile" role="tab" aria-controls="nav-profile" aria-selected="false">隊 長 資 料</a>
		<a class="nav-item nav-link ml-3" id="nav-contact-tab" data-toggle="tab" href="#member1Profile" role="tab" aria-controls="nav-contact" aria-selected="false">副 手 資 料</a>
		<a class="nav-item nav-link ml-3" id="nav-contact-tab" data-toggle="tab" href="#member2Profile" role="tab" aria-controls="nav-contact" aria-selected="false">隊 員 資 料</a>
		</div>
		</nav>
		
		<div class="tab-content" id="nav-tabContent">
			
		<div class="tab-pane fade show active" id="teaminfo" role="tabpanel" aria-labelledby="nav-home-tab">
			<form class="form-group form-control" name="teamInfoForm">
				
				<div class="row mt-2">
					<div class="col-xl-6">
						參賽項目：<input type="text" class="form-group form-control mx-auto text-center" name="projectName" id="projectName" value="<?php echo $projectName; ?>" placeholder="<?php echo $projectName; ?>" disabled>
					</div>
					<div class="col-xl-3">
						隊伍編號：<input type="text" class="form-group form-control mx-auto text-center" name="teamNO" id="teamNO" value="<?php echo $teamNO; ?>" placeholder="<?php echo $teamNO; ?>" disabled>
					</div>
					<div class="col-xl-3">
						隊伍名稱：<input type="text" class="form-group form-control mx-auto text-center" name="teamName" id="teamName" value="<?php echo $teamName; ?>" placeholder="<?php echo $teamName; ?>" disabled>
					</div>
				</div>
				
<!--
				<div class="row">
					<div class="col-xl-4">
						報名期限：
					</div>
					<div class="col-xl-4">
						繳費期限：
					</div>
					<div class="col-xl-4">
						報名費用：
					</div>
				</div>
-->
				
			</form>
		</div>
			
		<div class="tab-pane fade" id="captainProfile" role="tabpanel" aria-labelledby="nav-profile-tab">
			<form class="form-group form-control" name="captainSignupForm">
				
			<div class="row mt-2">
				<div class="col-xl-3">
					姓名：<input type="text" class="form-group form-control mx-auto text-center" name="captainName" id="captainName" value="<?php echo $captainName;?>" placeholder="<?php echo $captainName;?>">
				</div>
				<div class="col-xl-3">
					稱謂：<select class="custom-select mr-sm-2" id="captainSex">
							<option value="" selected>請選擇...</option>
							<option value="先生">先生</option>
							<option value="女士">女士</option>
						</select>
				</div>
				<div class="col-xl-3">
					身份證字號：<input type="text" class="form-group form-control mx-auto text-center" name="captainID" id="captainID" value="" placeholder="外籍在台人士請填寫居留證號">
				</div>
				<div class="col-xl-3">
					生日：<input type="text" class="form-group form-control mx-auto text-center datepicker" name="captainBirth" id="captainBirth" value="" placeholder="">
				</div>
			</div>
				
			<div class="row">
				<div class="col-xl-4">
					行動電話：<input type="text" class="form-group form-control mx-auto text-center" name="captainPhone" id="captainPhone" value="" placeholder="格式：0987654321">
				</div>
				<div class="col-xl-8">
					E-Mail：<input type="text" class="form-group form-control mx-auto text-center" name="captainEmail" id="captainEmail" value="" placeholder="建議使用Gmail信箱">
				</div>
			</div>
				
			<div class="row">
				<div class="col-xl-3">
					城市：<select name="captainCity" class="form-control" id="captainCity">
									<option selected value="">請選擇通訊地縣市...</option>
								</select>
				</div>
				<div class="col-xl-3">
					行政區：<select class="form-control" name="captainDistrict" id="captainDistrict">
									<option selected value="">鄉鎮市區</option>
								</select>
				</div>
				<div class="col-xl-6">
					通訊地址：<input type="text" class="form-group form-control mx-auto text-center" name="captainAddr" id="captainAddr">
				</div>
			</div>
				
			<div class="row">
				<div class="col-xl-4">
					服務產業：<select class="custom-select mr-sm-2" name="captainJob" id="captainJob">
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
				<div class="col-xl-4">
					職務類別：<select class="custom-select mr-sm-2" name="captainTitle" id="captainTitle">
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
				<div class="col-xl-4">
					工作年資：<select class="custom-select mr-sm-2" name="captainYear" id="captainYear">
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
				
			<input type="hidden" name="projectNO" id="projectNO" Value="<?php echo $projectNO; ?>">
				
			<div class="mx-auto text-center mt-5">
					<button type="button" class="btn btn-success" onclick="captainEdit()">新增／修改</button>
					<button type="reset" class="btn btn-secondary ml-3">清除重填</button>
					<br>
					<br>
					<span id="captainMsg"></span>
			</div>
			</form>
		</div>
			
		<div class="tab-pane fade" id="member1Profile" role="tabpanel" aria-labelledby="nav-contact-tab">
			<form class="form-group form-control" name="member1SignupForm">
				
			<div class="row mt-2">
				<div class="col-xl-3">
					姓名：<input type="text" class="form-group form-control mx-auto text-center" name="member1Name" id="member1Name" value="" placeholder="外籍在台人士請填寫居留證件中文全名">
				</div>
				<div class="col-xl-3">
					稱謂：<select class="custom-select mr-sm-2" id="member1Sex">
							<option value="" selected>請選擇...</option>
							<option value="先生">先生</option>
							<option value="女士">女士</option>
						</select>
				</div>
				<div class="col-xl-3">
					身份證字號：<input type="text" class="form-group form-control mx-auto text-center" name="member1ID" id="member1ID" value="" placeholder="外籍在台人士請填寫居留證號">
				</div>
				<div class="col-xl-3">
					生日：<input type="text" class="form-group form-control mx-auto text-center datepicker" name="member1Birth" id="member1Birth" value="" placeholder="">
				</div>
			</div>
				
			<div class="row">
				<div class="col-xl-4">
					行動電話：<input type="text" class="form-group form-control mx-auto text-center" name="member1Phone" id="member1Phone" value="" placeholder="格式：0987654321">
				</div>
				<div class="col-xl-8">
					E-Mail：<input type="text" class="form-group form-control mx-auto text-center" name="member1Email" id="member1Email" value="" placeholder="建議使用Gmail信箱">
				</div>
			</div>
				
			<div class="row">
				<div class="col-xl-3">
					城市：<select name="member1City" class="form-control" id="member1City">
									<option selected value="">請選擇通訊地縣市...</option>
								</select>
				</div>
				<div class="col-xl-3">
					行政區：<select class="form-control" name="member1District" id="member1District">
									<option selected value="">鄉鎮市區</option>
								</select>
				</div>
				<div class="col-xl-6">
					通訊地址：<input type="text" class="form-group form-control mx-auto text-center" name="member1Addr" id="member1Addr">
				</div>
			</div>
				
			<div class="row">
				<div class="col-xl-4">
					服務產業：<select class="custom-select mr-sm-2" name="member1Job" id="member1Job">
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
				<div class="col-xl-4">
					職務類別：<select class="custom-select mr-sm-2" name="member1Title" id="member1Title">
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
				<div class="col-xl-4">
					工作年資：<select class="custom-select mr-sm-2" name="member1Year" id="member1Year">
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
				
			<input type="hidden" name="projectNO" id="projectNO" Value="<?php echo $projectNO; ?>">
				
			<div class="mx-auto text-center mt-5">
					<button type="button" class="btn btn-success" onclick="member1Edit()">新增／修改</button>
					<button type="reset" class="btn btn-secondary ml-3">清除重填</button>
					<button type="reset" class="btn btn-danger ml-3" onClick="member1Delete()">刪除成員</button>
					<br>
					<br>
					<span id="member1Msg"></span>
			</div>
			</form>
		</div>
			
		<div class="tab-pane fade" id="member2Profile" role="tabpanel" aria-labelledby="nav-contact-tab">
			<form class="form-group form-control" name="member2SignupForm">
				
			<div class="row mt-2">
				<div class="col-xl-3">
					姓名：<input type="text" class="form-group form-control mx-auto text-center" name="member2Name" id="member2Name" value="" placeholder="外籍在台人士請填寫居留證件中文全名">
				</div>
				<div class="col-xl-3">
					稱謂：<select class="custom-select mr-sm-2" id="member2Sex">
							<option value="" selected>請選擇...</option>
							<option value="先生">先生</option>
							<option value="女士">女士</option>
						</select>
				</div>
				<div class="col-xl-3">
					身份證字號：<input type="text" class="form-group form-control mx-auto text-center" name="member2ID" id="member2ID" value="" placeholder="外籍在台人士請填寫居留證號">
				</div>
				<div class="col-xl-3">
					生日：<input type="text" class="form-group form-control mx-auto text-center datepicker" name="member2Birth" id="member2Birth" value="" placeholder="">
				</div>
			</div>
				
			<div class="row">
				<div class="col-xl-4">
					行動電話：<input type="text" class="form-group form-control mx-auto text-center" name="member2Phone" id="member2Phone" value="" placeholder="格式：0987654321">
				</div>
				<div class="col-xl-8">
					E-Mail：<input type="text" class="form-group form-control mx-auto text-center" name="member2Email" id="member2Email" value="" placeholder="建議使用Gmail信箱">
				</div>
			</div>
				
			<div class="row">
				<div class="col-xl-3">
					城市：<select name="member2City" class="form-control" id="member2City">
									<option selected value="">請選擇通訊地縣市...</option>
								</select>
				</div>
				<div class="col-xl-3">
					行政區：<select class="form-control" name="member2District" id="member2District">
									<option selected value="">鄉鎮市區</option>
								</select>
				</div>
				<div class="col-xl-6">
					通訊地址：<input type="text" class="form-group form-control mx-auto text-center" name="member2Addr" id="member2Addr">
				</div>
			</div>
				
			<div class="row">
				<div class="col-xl-4">
					服務產業：<select class="custom-select mr-sm-2" name="member2Job" id="member2Job">
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
				<div class="col-xl-4">
					職務類別：<select class="custom-select mr-sm-2" name="member2Title" id="member2Title">
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
				<div class="col-xl-4">
					工作年資：<select class="custom-select mr-sm-2" name="member2Year" id="member2Year">
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
				
			<input type="hidden" name="projectNO" id="projectNO" Value="<?php echo $projectNO; ?>">
				
			<div class="mx-auto text-center mt-5">
					<button type="button" class="btn btn-success" onclick="member2Edit()">新增／修改</button>
					<button type="reset" class="btn btn-secondary ml-3">清除重填</button>
					<button type="reset" class="btn btn-danger ml-3" onClick="member2Delete()">刪除成員</button>
					<br>
					<br>
					<span id="member2Msg"></span>
			</div>
			</form>
		</div>
			
		</div>
	</div>
</section>

<section class="price_area p_120">
	<div class="container">
						<table id="competForm" class="table table-hover table-striped table-bordered text-center" style="100%">
							<thead class="thead-dark bg-info">
								<tr>
									<th>1</th>
									<th>2</th>
									<th>3</th>
									<th>4</th>
									<th>5</th>
									<th>6</th>
									<th>7</th>
									<th>8</th>
								</tr>
							</thead>
							<tbody>	
								
							<?php
							$data1 = "SELECT * FROM socialInfo WHERE teamNO = '$teamNO' AND remarks = '隊長' "
							for ($i=1; $i<=mysql_num_rows($data1); $i++) {
								$row=mysql_fetch_row($data1);
							?>

								<tr>
									<td><?php echo $row[0];?></td>
									<td><?php echo $row[1];?></td>
									<td><?php echo $row[2];?></td>
									<td><?php echo $row[3];?></td>
									<td><?php echo $row[4];?></td>
									<td><?php echo $row[5];?></td>
									<td><?php echo $row[6];?></td>
									<td><?php echo $row[7];?></td>
								</tr>

							<?php }?>
							</tbody>
						</table>
	</div>
</section>

<section class="testimonials_area p_120">
	<div class="container">
		
		隊長：<?php echo $FCN; ?>or<?php echo $captainName; ?><br>
		資料庫連線：<?php echo $sqlSELECTcaptainInfo; ?><br>
		資料庫執行：<?php echo $sqlRESULTcaptainInfo; ?><br>
		資料庫回傳：<?php echo $sqlFETCHcaptainInfo; ?><br>
		變數定義：<?php echo $sqlFETCHcaptainInfo[3]; ?><br>
		
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
<!-- AJAX Profile Edit -->
<script src="../controller/compet_captainEdit.js"></script>
<script src="../controller/compet_member1Edit.js"></script>
<script src="../controller/compet_member2Edit.js"></script>
</body>
</html>