<?php

//連結資料庫
require_once("../vender/dbtools.inc.php");

//取得現在日期時間
$getToday = date("Y-m-d H:i:s");

//取得COOKIE陣列並解序還原
$loginInfo = unserialize($_COOKIE["loginInfo"]);
$examNO = $loginInfo[0];	//帳號
$pwd = $loginInfo[1];	//驗證碼
$host = $loginInfo[2];	//公關招待
$projectNO = $loginInfo[3];	//活動代號
$projectName = $loginInfo[4];	//活動名稱
$fee = $loginInfo[5];	//報名費
$start = $loginInfo[6];	//開始報名
$end = $loginInfo[7];	//截止報名
$bach = $loginInfo[8];	//測驗梯次
$bachTimeAdd = $loginInfo[9]*60*60;	//測驗時間
$bachTimeAdded = strtotime($bach)+$bachTimeAdd;	//測驗結束時間
$finalCompet = $loginInfo[10]; // 決賽時間
$passed = $loginInfo[11];	//帳密符合
$proveDate = date("Y-m-d H:i", strtotime($bach)+$bachTimeAdd);


////COOKIE登入錯誤
//if ($passed != "TRUE"){
//echo "<script type='text/javascript'>";
//echo "alert('COOKIE逾時或錯誤！請重新登入！');";
//echo "window.location.href='histock_index.php';";
//echo "</script>";
//exit();
//}


// HS 登入

	
	//設定DB
	$signupDB = "histock_HSsignup";
	$infoDB = "histock_HSinfo";
	
	// 取得隊伍報名資訊
	$sqlteamName = mysql_query("
		SELECT * FROM $signupDB WHERE examNumber = '$examNO'
	");
	$sqlteamNameFetch = mysql_fetch_row($sqlteamName);
	$registerTime = $sqlteamNameFetch[1];	//報名時間
	$teamName = $sqlteamNameFetch[4];	//隊名

	$conferenceCode = $sqlteamNameFetch[5]; // 分區
		// 分區代碼轉換中文
		if( $conferenceCode == 'N' ){
			$conference = "北區";
		}
		if( $conferenceCode == 'M' ){
			$conference = "中區";
		}
		if( $conferenceCode == 'S' ){
			$conference = "南區";
		}
	$cityCode = $sqlteamNameFetch[6]; // 城市
		// 城市代碼轉換中文
		$sqlSELECTcity = " SELECT city FROM cityCode WHERE cityCode = '$cityCode' ";
		$sqlRESULTcity = mysql_query($sqlSELECTcity, $sqlLink);
		$sqlFTECHcity = mysql_fetch_array($sqlRESULTcity);
		$city = $sqlFTECHcity["city"];
	$schoolCode = $sqlteamNameFetch[7]; // 學校
		// 學校代碼轉換校名
		$sqlSELECTschool = " SELECT school FROM hischoolCode WHERE cityCode = '$cityCode' AND schoolCode = '$schoolCode' ";
		$sqlRESULTschool = mysql_query($sqlSELECTschool, $sqlLink);
		$sqlFTECHschool = mysql_fetch_array($sqlRESULTschool);
		$school = $sqlFTECHschool["school"];

	$teacher = $sqlteamNameFetch[8];	//指導老師
	
	// 取得隊長資料
	$sqlInfoCapX = mysql_query("
		SELECT * FROM $infoDB WHERE examNumber = '$examNO' AND remarks = '隊長'
	");
	$sqlInfoCap = mysql_fetch_row($sqlInfoCapX);
	$capName = $sqlInfoCap[5];	//隊長姓名
	$capId = $sqlInfoCap[7];	//隊長Id
	$capSN = $sqlInfoCap[8];	//隊長學號
	$capMobile = $sqlInfoCap[10];	//隊長Mobile
	$capEmail = $sqlInfoCap[11];	//隊長Email
	
	// 取得副手資料
	$sqlInfoviceX = mysql_query("
		SELECT * FROM $infoDB WHERE examNumber = '$examNO' AND remarks = '副手'
	");
	$sqlInfovice = mysql_fetch_row($sqlInfoviceX);
	$viceName = $sqlInfovice[5];	//副手姓名
	$viceId = $sqlInfovice[7];	//副手Id
	$viceSN = $sqlInfovice[8];	//副手學號
	$viceMobile = $sqlInfovice[10];	//副手Mobile
	$viceEmail = $sqlInfovice[11];	//副手Email
	
	// 取得隊員資料
	$sqlInfomemX = mysql_query("
		SELECT * FROM $infoDB WHERE examNumber = '$examNO' AND remarks = '隊員'
	");
	$sqlInfomem = mysql_fetch_row($sqlInfomemX);
	$memName = $sqlInfomem[5];	//隊員姓名
	$memId = $sqlInfomem[7];	//隊員Id
	$memSN = $sqlInfomem[8];	//隊員學號
	$memMobile = $sqlInfomem[10];	//隊員Mobile
	$memEmail = $sqlInfomem[11];	//隊員Email
	
//	//取得eventList HS 初決賽時間
//	$sqlcompetX = mysql_query( " SELECT * FROM histock_eventList WHERE projectNO = '$projectNO' " );
//	$sqlcompetF = mysql_fetch_row($sqlcompetX);
//	$preCompet = $sqlcompetF[16];
//	$finalCompet = $sqlcompetF[17];
	
	//判斷progressbar - --報名開始 -> 報名結束 progressStep1
	if ( (strtotime($getToday) >= strtotime($start)) && ( strtotime($getToday) <= strtotime($end) )  ){
		$progressStep1 = "TRUE";
	}else{
		$progressStep1 = "FALSE";
	}

	//判斷progressbar - 報名結束 -> 正式測驗開始 progressStep2
	if ( (strtotime($getToday) >= strtotime($end)) && (strtotime($getToday) <= strtotime($bach))  ){
		$progressStep2 = "TRUE";
	}else{
		$progressStep2 = "FALSE";
	}

	//判斷progressbar - 複賽測驗開始 -> 複賽測驗結束 progressStep3
	if ( (strtotime($getToday) >= strtotime($bach)) && (strtotime($getToday) <= (strtotime($bach)+$bachTimeAdd) ) ){
		$progressStep3 = "TRUE";
	}else{
		$progressStep3 = "FALSE";
	}
	
	//判斷progressbar - 複賽測驗結束 -> 決賽開始 progressStep4
	if ( (strtotime($getToday) >= (strtotime($bach)+$bachTimeAdd)) && (strtotime($getToday) <= (strtotime($bach)+$bachTimeAdd)+3600 ) ){
		$progressStep4 = "TRUE";
	}else{
		$progressStep4 = "FALSE";
	}

	//判斷progressbar - 複賽測驗結束 -> 複賽競賽開始 progressStep5
	if ( (strtotime($getToday) >= (strtotime($bach)+$bachTimeAdd)+3600) && (strtotime($getToday) <= (strtotime($bach)+$bachTimeAdd)+28800 ) ){
		$progressStep5 = "TRUE";
	}else{
		$progressStep5 = "FALSE";
	}

		//判斷progressbar - 決賽結束 -> progressStep6
	if ( strtotime($getToday) >= (strtotime($finalCompet)+60000)  ){
	//	if ( (strtotime($getToday) >= strtotime($bach)+$bachTimeAdd) ){
			$GG30 = "TRUE";
		}else{
			$GG30 = "FALSE";
		}



//// 判斷該次活動是否付費
//if ( $fee != 0 ){
//	
//	//取得訂單資訊
//	$sqlOrderListS = mysql_query( " SELECT * FROM orderList WHERE customerNO = '$examNO' " );
//	$sqlOrderListF = mysql_fetch_row($sqlOrderListS);
//	$orderNO = $sqlOrderListF[2];
//	$fee = $sqlOrderListF[6];	// 訂單金額
//	$payWay = $sqlOrderListF[7];	// 付款方式
//		if (substr($payWay, 0, 3) == 'ATM'){
//			$payWay = 'ATM轉帳';
//		}
//		if (substr($payWay, 0, 3) == 'CVS'){
//			$payWay = '超商代碼';
//		}
//	$payStatus= $sqlOrderListF[8];	// 繳費狀態
//	$payTime= $sqlOrderListF[9];	// 入帳時間
//	$BankCode= $sqlOrderListF[13];	// 銀行代碼
//	$vAccount= $sqlOrderListF[14];	// 虛擬帳號
//	$paymentNO= $sqlOrderListF[15];	// 超商代碼
//	$expireDate= $sqlOrderListF[16];	// 繳費期限
//	
//	//判斷報名期間 = 繳費期間
//	if (strtotime($getToday) >= strtotime($start) && strtotime($getToday) <= strtotime($end)){
//		$payPeriod = "TRUE";
//	}else {
//		$payPeriod = "FALSE";
//	}
//	
//	//判斷繳費期限
//	if (strtotime($ExpireDate) >= strtotime($getToday) ){
//		$payDate = "TRUE";
//	}else{
//		$payDate = "FALSE";
//	}
//
//	//繳費按鈕開關
//	if ($ExpireDate != "" && (strtotime($ExpireDate) >= strtotime($getToday))){
//		$payButton = "getCode";
//	}else if ( ($ExpireDate != "") && (strtotime($ExpireDate) <= strtotime($getToday)) ){
//		$payButton = "reCode";
//	}
//		
//	//如繳費完成則取得收據資料
//	if ($payStatus == "繳費完成"){
//			$payButton = "payed";
//			$receiptButton = "TRUE";
//			//取得收據號碼
//			$sqlSELECTreceiptNO = " SELECT receiptNO FROM receiptList WHERE orderNO = '$orderNO' ";
//			$sqlRESULTreceiptNO = mysql_query($sqlSELECTreceiptNO, $sqlLink);
//			$sqlFETCHreceiptNO = mysql_fetch_row($sqlRESULTreceiptNO);
//			$receiptNO = $sqlFETCHreceiptNO[0];  // 收據號碼
//	}else{
//		$receiptButton = "FALSE";
//	}
//	
//	
//	
//	
//// 判斷公關 有值 為公關帳號 全功能使用 無訂單 不需繳費 不開收據 有參加證明 加註顯示公關帳號
//}else if ( $host == 'Y' ){
//	
//	// 各項按鈕關閉
//	$payPeriod = "FALSE";	// 繳費功能關閉
//	$payDate = "FALSE";	// 繳費期限關閉
//	$payButton = "host";	// 繳費按鈕關閉
//	$receiptButton = "FALSE";	// 收據按鈕關閉
//	
//}

// 取得成績資訊
$sqlScoreX = mysql_query(" SELECT * FROM histock_HSscore WHERE examNumber = '$examNO' ");
$sqlScoreY = mysql_fetch_row($sqlScoreX);
$paperNumber = $sqlScoreY[4];
$examScore = $sqlScoreY[5];
$examRank = $sqlScoreY[6];
$finalist =  $sqlScoreY[7];
$semiScore = $sqlScoreY[9];
$finalScore = $sqlScoreY[10];
$combineScore = $sqlScoreY[11];
$rank = $sqlScoreY[12];
	if( $rank == 1 ){
		$rank = '第一名';
	}
	if( $rank == 2 ){
		$rank = '第二名';
	}
	if( $rank == 3 ){
		$rank = '第三名';
	}
	if( $rank == 4 ){
		$rank = '第四名';
	}
	if( $rank == 5 ){
		$rank = '第五名';
	}
	if( $rank >= 6 && $rank <= 10 ){
		$rank = '優勝';
	}
	if( $rank >= 11 && $rank <= 15 ){
		$rank = '佳作';
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
<link href='https://fonts.googleapis.com/css?family=Alegreya+Sans' rel='stylesheet' type='text/css'>

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
	background-image: url("../img/histockHeader2.jpg");
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
	
	
/*
//綠界按鈕樣式定義
.pay_button {
	text-decoration: none;
	color: #ffffff;
	min-width: 150px;
	display: inline-block;
	padding: 10px 20px;
	border-radius: 5px;
	letter-spacing: 2px;
	margin: 15px 0;
	background-color: #3f3f3f;
	background-image: -webkit-gradient(linear, left top, left bottom, from(#3f3f3f), to(#000000));
	background-image: -webkit-linear-gradient(top, #3f3f3f, #000000);
	background-image:-moz-linear-gradient(top, #3f3f3f, #000000);
	background-image:-ms-linear-gradient(top, #3f3f3f, #000000);
	background-image:-o-linear-gradient(top, #3f3f3f, #000000);
	background-image:linear-gradient(top bottom, #3f3f3f, #000000);
}
*/

	
/* progressbar */
ol.progress-track {
  display: table;
  list-style-type: none;
  margin: 0;
  padding: 2em 1em;
  table-layout: fixed;
  width: 100%;
}
ol.progress-track li {
  display: table-cell;
  line-height: 3em;
  position: relative;
  text-align: center;
}
ol.progress-track li .icon-wrap {
  border-radius: 50%;
  top: -1.5em;
  color: #fff;
  display: block;
  height: 2.5em;
  margin: 0 auto -2em;
  left: 0;
  right: 0;
  position: absolute;
  width: 2.5em;
}
ol.progress-track li .icon-check-mark,
ol.progress-track li .icon-down-arrow {
  height: 25px;
  width: 15px;
  display: inline-block;
  fill: currentColor;
}
ol.progress-track li .progress-text {
  position: relative;
  top: 20px;
  font-size: 16px;
  color: #797979;
}
ol.progress-track li.progress-done {
  border-top: 7px solid #FCCE0D;
  transition: border-color 1s ease-in-out;
  -webkit-transition: border-color 1s ease-in-out;
  -moz-transition: border-color 1s ease-in-out;
}
ol.progress-track li.progress-done .icon-down-arrow {
  display: none;
}
ol.progress-track li.progress-done.progress-current .icon-wrap {
  background-color: #FCCE0D;
	font-size: 18px;
}
ol.progress-track li.progress-done.progress-current .icon-wrap .icon-check-mark {
  display: none;
}
ol.progress-track li.progress-done.progress-current .icon-wrap .icon-down-arrow {
  display: block;
}
ol.progress-track li.progress-done .icon-wrap {
  background-color: white;
  border: 5px solid #FCCE0D;
}
ol.progress-track li.progress-todo {
  border-top: 7px solid #ddd;
  color: black;
}
ol.progress-track li.progress-todo .icon-wrap {
  background-color: #fff;
  border: 5px solid #ddd;
  border-radius: 50%;
  bottom: 1.5em;
  color: #fff;
  display: block;
  height: 2.5em;
  margin: 0 auto -2em;
  position: relative;
  width: 2.5em;
}
ol.progress-track li.progress-todo .icon-wrap .icon-check-mark,
ol.progress-track li.progress-todo .icon-wrap .icon-down-arrow {
  display: none;
}
#currentFont {
  color: #0B7376;
}	


#accordion-style-1 h1,
#accordion-style-1 a{
    color:#007b5e;
}
#accordion-style-1 .btn-link {
    font-weight: 400;
    color: #007b5e;
    background-color: transparent;
    text-decoration: none !important;
    font-size: 16px;
    font-weight: bold;
	padding-left: 25px;
}

#accordion-style-1 .card-body {
    border-top: 2px solid #007b5e;
}

#accordion-style-1 .card-header .btn.collapsed .fa.main{
	display:none;
}

#accordion-style-1 .card-header .btn .fa.main{
	background: #007b5e;
    padding: 13px 11px;
    color: #ffffff;
    width: 35px;
    height: 41px;
    position: absolute;
    left: -1px;
    top: 10px;
    border-top-right-radius: 7px;
    border-bottom-right-radius: 7px;
	display:block;
}

/* Download Hover */
.downloadPDF:hover{
	color:tomato;
	font-weight: 600;
}
.downloadWord:hover{
	color:royalblue;
	font-weight: 600;
}
.downloadPPT:hover{
	color:orangered;
	font-weight: 600;
}
.downloadZip:hover{
	color:darkgoldenrod;
	font-weight: 600;
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
	
.tab-pane > form { height: auto; }
</style>	
	
	
</head>

<body>
<?php require_once("../model/waitload.php") ?>
<?php require_once("../model/cc_imgGroup_Modal.php") ?>
<?php require_once("../model/index_nav.php") ?>


<!-- 頁首 各項功能按鈕 收據 參賽證明 -->
<section class="home_banner_area areaHT">
	<div class="banner_inner">
	<div class="main">
	<div class="containerIndex">
		<div class="" style="padding-top: 30px;">
			<div class="h4 mx-auto text-center" style="color: #0B7376;">嗨! <? echo $teamName; ?> 歡迎你們!<div>
			
			<div class="form-group mt-4 mx-auto text-center">
				<a href="#editInfo"><button type="button" class="form-control btn btn-outline-danger" id="dataEditButton" style="text-align: center; width: 50%">競賽專區</button></a>
			</div>
				
			<div class="form-group mx-auto text-center">
<!--				<button type="button" class="form-control btn btn-outline-success" id="payButton" style="text-align: center; width: 50%" data-toggle="collapse" data-target="#buttonEcpay" aria-expanded="false" aria-controls="buttonEcpay" disabled>取號繳費</button>-->
				
				<div class="collapse mt-2" id="buttonEcpay">
					<div class="form-group mx-auto text-center">
						<button type="button" class="mt-1 pay_button form-control btn btn-success buttonFail" onclick="ajax_payment('ATM', 0)" style="text-align: center; width: 50%">ATM付款</button>
						<button type="button" class="mt-1 pay_button form-control btn btn-success mt-0 buttonFail" onclick="ajax_payment('CVS', 0)" style="text-align: center; width: 50%">超商代碼付款</button>
					</div>
					<div id="dialog" class="dialog mx-auto text-center" title="台灣財富管理規劃顧問認證協會-第<? echo substr($projectNO, 2, 5); ?>梯<? echo $projectName; ?>.'報名費';?>"></div>
				</div>
			</div>	

			<div class="form-group mx-auto text-center mt-3">
<!--				<button type="button" class="form-control btn btn-outline-warning" id="receiptButton" style="text-align: center; width: 50%" onClick="receiptPage()" disabled>收據列印</button>-->
			</div>
				
			<div class="form-group mx-auto text-center mt-3">
<!--				<button type="button" class="form-control btn btn-outline-secondary" id="goMockButton" style="text-align: center; width: 50%" onClick="goMock()" disabled>前往模擬測驗</button>-->
			</div>
			
			<div class="form-group mx-auto text-center mt-3">
<!--				<button type="button" class="form-control btn btn-outline-dark buttonFail" id="examButton" style="text-align: center; width: 50%" onClick="goExam()" disabled>開始複賽測驗</button>-->
			</div>
				
			<div class="form-group mx-auto text-center">

				<div class="form-group mt-3 mx-auto text-center">
<!--					<button type="button" class="form-control btn btn-outline-primary" id="proveButton" style="text-align: center; width: 50%" onClick="entryProvePage()" disabled>參賽證明</button>-->
					<small id="payHelp" class="form-text text-muted mx-auto text-center" style="font-size: 12px;"><a href="#ECPayPayWay" id="ECPayInfo">繳費操作說明</a></small>
					<small class="form-text text-muted mx-auto text-center" style="font-size: 12px;"><a href="#QA" id="competHelp">常見問題(QA)</a></small>
				</div>

				<div class="form-group mx-auto text-center py-4">
					<button type="button" class="form-control btn btn-danger" id="recieptButton" style="text-align: center; width: 30%"><a href="../model/histock_logout.php">登出</a></button>
				</div>
				
			</div>
		
	</div>
</div>
	</div>
</section>
	
<!-- 競賽時程 progressBar -->
<section class="made_life_area p_120 areaHT">
	<div class="container">
		
			<div class="mx-auto text-center pb-2">
				<p class="h1"><?php echo $projectName; ?></p>
				<p class="h4">活 動 時 程 表</p>
			</div>
			
<ol class="progress-track py-5 fa-ul">
	
  <li class="" id="step1">
    <center>
      <div class="icon-wrap"></div>
      <span class="progress-text"><i class="fas fa-user-plus pr-2" style="font-size: 18px;color: #979797;"></i>報名開始<br><?php echo substr($start, 0, 16) ?></span>
    </center>
  </li>

  <li class="" id="step2">
    <center>
      <div class="icon-wrap"></div>
      <span class="progress-text"><i class="fas fa-user-times pr-2" style="font-size: 18px;color: #979797;"></i>報名截止<br><?php echo date("Y-m-d H:i", strtotime($end) ) ?></span>
    </center>
  </li>

  <li class="" id="step3">
    <center>
      <div class="icon-wrap"></div>
      <span class="progress-text"><i class="fas fa-mouse pr-2" style="font-size: 18px;color: #979797;"></i>複賽測驗<br><?php echo substr($bach, 0, 16) ?></span>
    </center>
  </li>

  <li class="" id="step4">
    <center>
      <div class="icon-wrap"></div>
      <span class="progress-text"><i class="fas fa-exclamation-circle pr-2" style="font-size: 18px;color: #979797;"></i>複賽截止<br><?php echo date("Y-m-d H:i", strtotime($bach)+$bachTimeAdd ) ?></span>
    </center>
  </li>
  <li class="" id="step5">
    <center>
      <div class="icon-wrap"></div>
      <span class="progress-text"><i class="fas fa-inbox pr-2" style="font-size: 18px;color: #979797;"></i>決賽開始<br><?php echo substr($finalCompet, 0, 16)  ?></span>
    </center>
  </li>

</ol>

	</div>
<a name="editInfo" id="editInfo"></a>
</section>

		
<!--  資料測試區  -->
<!--
<div>
	$loginInfo[0] : <? echo $loginInfo[0] ?><br>
	$loginInfo[1] : <? echo $loginInfo[1] ?><br>
	$loginInfo[2] : <? echo $loginInfo[2] ?><br>
	$loginInfo[3] : <? echo $loginInfo[3] ?><br>
	$loginInfo[4] : <? echo $loginInfo[4] ?><br>
	$loginInfo[5] : <? echo $loginInfo[5] ?><br>
	$loginInfo[6] : <? echo $loginInfo[6] ?><br>
	$loginInfo[7] : <? echo $loginInfo[7] ?><br>
	$loginInfo[8] : <? echo $loginInfo[8] ?><br>
	$loginInfo[9] : <? echo $loginInfo[9] ?><br>
	$loginInfo[10] : <? echo $loginInfo[10] ?><br>
	$loginInfo[11] : <? echo $loginInfo[11] ?><br>
	<br>
	exmaNO : <? echo $examNO; ?><br>
	pwd : <? echo $pwd; ?><br>
	host : <? echo $host; ?><br>
	projectNO : <? echo $projectNO; ?><br>
	projectName : <? echo $projectName; ?><br>
	fee : <? echo $fee; ?><br>
	start : <? echo $start; ?><br>
	end : <? echo $end; ?><br>
	bach : <? echo $bach; ?><br>
	bachTimeAdd : <? echo $bachTimeAdd; ?><br>
	batchTimeAdded : <? echo $bachTimeAdded; ?><br>
	finalCompet : <? echo $finalCompet; ?><br>
	passed : <? echo $passed; ?><br>
	progress1 : <? echo $progressStep1; ?><br>	
	progress2 : <? echo $progressStep2; ?><br>
	progress3 : <? echo $progressStep3; ?><br>
	progress4 : <? echo $progressStep4; ?><br>
	progress5 : <? echo $progressStep5; ?><br>
	GG30 : <? echo $GG30; ?><br>
	toDay : <? echo $getToday; ?><br>
	bachTimeAdded :  <? echo $bachTimeAdded; ?><br>
	bachTimeAdd+3600 :  <? echo $bachTimeAdd+3600; ?><br>
	<br>
	registerTime : <? echo $registerTime; ?><br>
	conference : <? echo $conference; ?><br>
	city : <? echo $city; ?><br>
	school : <? echo $school; ?><br>
	teamName : <? echo $teamName; ?><br>
	teacher : <? echo $teacher; ?><br>
	<br>
	capName : <? echo $capName; ?><br>
	capId : <? echo $capId; ?><br>
	capSN : <? echo $capSN; ?><br>
	capMobile : <? echo $capMobile; ?><br>
	capEmail : <? echo $capEmail; ?><br>
	<br>
	viceName : <? echo $viceName; ?><br>
	viceId : <? echo $viceId; ?><br>
	viceSN : <? echo $viceSN; ?><br>
	viceMobile : <? echo $viceMobile; ?><br>
	viceEmail : <? echo $viceEmail; ?><br>
	<br>
	memName : <? echo $memName; ?><br>
	memId : <? echo $memId; ?><br>
	memSN : <? echo $memSN; ?><br>
	memMobile : <? echo $memMobile; ?><br>
	memEmail : <? echo $memEmail; ?><br>
	<br>
	paperNumber : <? echo $paperNumber; ?><br>
	examScore : <? echo $examScore; ?><br>
	examRank : <? echo $examRank; ?><br>
	semiScore : <? echo $semiScore; ?><br>
	finalScore : <? echo $finalScore; ?><br>
	combineScore : <? echo $combineScore; ?><br>
	rank : <? echo $rank; ?><br>
</div>
-->


<!-- 報名及活動資訊 Information -->
<section class="price_area p_120 areaHT" id="competCollegeInfo">
	<div class="container">
		<div class="mx-auto text-center pb-3">
			<p class="h1">競賽專區</a></p>
<!--
			<p class="h2 pt-2" id="CGdownloadFiles">
				<a href="#editInfo" class="downloadPDF actMethod" id="actMethod" data-toggle="tooltip" data-placement="top" title="活動辦法"><i class="fas fa-book-reader pr-2"></i></a>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<a href="#editInfo" class="downloadPDF competRules" id="competRules" data-toggle="tooltip" data-placement="top" title="競賽規則"><i class="fas fa-balance-scale pr-2"></i></a>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<a href="#editInfo" class="downloadPDF privacy" id="privacy" data-toggle="tooltip" data-placement="top" title="隱私權保護政策"><i class="fas fa-user-lock pr-2"></i></a>
			</p>
-->
		</div>
		
		<div class="tab-content" id="nav-tabContent">
			
		<div class="tab-pane fade show active" id="teaminfo-HiStock" role="tabpanel" aria-labelledby="nav-home-tab">
			<form class="form-group form-control" name="teamInfoForm" autocomplete="off">
				
				<div class="row mt-2 border-bottom bg-light">
					<div class="col-6 text-left">
						<h5>第 <? echo substr($projectNO, 2, 5); ?> 梯<? echo $projectName; ?></h5>
					</div>
					<div class="col-6 text-right">
						<h5><? echo $examNO; ?></h5>
					</div>
				</div>
				
<!--  隊伍資訊  -->
				<div class="row mt-2" id="competInfo">
					<div class="col-2">
						<label for="conference">分區：</label>
						<input type="text" name="conference" class="form-group form-control text-center" id="conference" value="<? echo $conference; ?>" disabled>
					</div>
					
					<div class="col-2">
						<label for="city">城市：</label>
						<input type="text" name="city" class="form-group form-control text-center" id="city" value="<? echo $city; ?>" disabled>
					</div>
					
					<div class="col-6">
						<label for="school">學校：</label>
						<input type="text" name="school" class="form-group form-control text-center" id="school" value="<? echo $school; ?>" disabled>
					</div>
					
					<div class="col-2">
						<label for="bachTime">複賽時間：</label>
						<input type="text" name="bachTime" class="form-group form-control text-center" id="bachTime" value="<? echo substr($bach, 0, 16); ?>" disabled>
					</div>
				</div>
				
<!--  隊長資訊  -->
				<div class="row mt-2" id="capInfo">
					<div class="col-2">
						<label for="capName">隊長姓名：</label>
						<input type="text" name="capName" class="form-group form-control text-center" id="conference" value="<? echo $capName; ?>" disabled>
					</div>
					
					<div class="col-2">
						<label for="capId">隊長ID：</label>
						<input type="text" name="capId" class="form-group form-control text-center" id="city" value="<? echo $capId; ?>" disabled>
					</div>
					
					<div class="col-2">
						<label for="capSN">隊長學號：</label>
						<input type="text" name="capSN" class="form-group form-control text-center" id="school" value="<? echo $capSN; ?>" disabled>
					</div>
					
					<div class="col-2">
						<label for="capMobile">隊長電話：</label>
						<input type="text" name="capMobile" class="form-group form-control text-center" id="bachTime" value="<? echo $capMobile; ?>" disabled>
					</div>
					<div class="col-4">
						<label for="capEmail">隊長Email：</label>
						<input type="text" name="capEmail" class="form-group form-control text-center" id="capEmail" value="<? echo $capEmail; ?>" disabled>
					</div>
				</div>
		
<!--  副手資訊  -->
				<div class="row mt-2" id="viceInfo">
					<div class="col-2">
						<label for="viceName">副手姓名：</label>
						<input type="text" name="viceName" class="form-group form-control text-center" id="conference" value="<? echo $viceName; ?>" disabled>
					</div>
					
					<div class="col-2">
						<label for="viceId">副手ID：</label>
						<input type="text" name="viceId" class="form-group form-control text-center" id="city" value="<? echo $viceId; ?>" disabled>
					</div>
					
					<div class="col-2">
						<label for="viceSN">副手學號：</label>
						<input type="text" name="viceSN" class="form-group form-control text-center" id="school" value="<? echo $viceSN; ?>" disabled>
					</div>
					
					<div class="col-2">
						<label for="viceMobile">副手電話：</label>
						<input type="text" name="viceMobile" class="form-group form-control text-center" id="bachTime" value="<? echo $viceMobile; ?>" disabled>
					</div>
					<div class="col-4">
						<label for="viceEmail">副手Email：</label>
						<input type="text" name="viceEmail" class="form-group form-control text-center" id="viceEmail" value="<? echo $viceEmail; ?>" disabled>
					</div>
				</div>
				
<!--  隊員資訊  -->
				<div class="row mt-2" id="memInfo">
					<div class="col-2">
						<label for="memName">隊員姓名：</label>
						<input type="text" name="memName" class="form-group form-control text-center" id="conference" value="<? echo $memName; ?>" disabled>
					</div>
					
					<div class="col-2">
						<label for="memId">隊員ID：</label>
						<input type="text" name="memId" class="form-group form-control text-center" id="city" value="<? echo $memId; ?>" disabled>
					</div>
					
					<div class="col-2">
						<label for="memSN">隊員學號：</label>
						<input type="text" name="memSN" class="form-group form-control text-center" id="school" value="<? echo $memSN; ?>" disabled>
					</div>
					
					<div class="col-2">
						<label for="memMobile">隊員電話：</label>
						<input type="text" name="memMobile" class="form-group form-control text-center" id="bachTime" value="<? echo $memMobile; ?>" disabled>
					</div>
					<div class="col-4">
						<label for="memEmail">隊員Email：</label>
						<input type="text" name="memEmail" class="form-group form-control text-center" id="memEmail" value="<? echo $memEmail; ?>" disabled>
					</div>
				</div>
				
<!--  複賽資訊  -->
				<div class="row mt-2 py-2" style="background-color:orange">
					<div class="col-3">
						<label for="paperNumber" class="text-white">複賽卷號：</label>
						<input type="text" name="paperNumber" class="form-group form-control text-center" id="paperNumber" value="<? echo $paperNumber; ?>" disabled>
					</div>
					<div class="col-3">
						<label for="examScore" class="text-white">複賽成績：</label>
						<input type="text" name="examScore" class="form-group form-control text-center" id="examScore" value="<? echo $examScore; ?>" disabled>
					</div>
					<div class="col-3">
						<label for="examRank" class="text-white">複賽排名：</label>
						<input type="text" name="examRank" class="form-group form-control text-center" id="combineScore" value="<? echo $examRank; ?>" disabled>
					</div>
					<div class="col-3">
						<label for="finalist" class="text-white">晉級資格：</label>
						<input type="text" name="finalist" class="form-group form-control text-center" id="rank" value="<? echo $finalist; ?>" disabled>
					</div>
				</div>
				
<!--  決賽資訊  -->
				<div class="row mt-2 py-2" style="background-color: blueviolet;">
					<div class="col-3">
						<label for="semiScore" class="text-warning">知識測驗：</label>
						<input type="text" name="semiScore" class="form-group form-control text-center" id="paperNumber" value="<? echo $semiScore; ?>" disabled>
					</div>
					<div class="col-3">
						<label for="finalScore" class="text-warning">投資實務：</label>
						<input type="text" name="finalScore" class="form-group form-control text-center" id="examScore" value="<? echo $finalScore; ?>" disabled>
					</div>
					<div class="col-3">
						<label for="combineScore" class="text-warning">綜合成績：</label>
						<input type="text" name="combineScore" class="form-group form-control text-center" id="combineScore" value="<? echo $combineScore; ?>" disabled>
					</div>
					<div class="col-3">
						<label for="finalRank" class="text-warning">競賽成果：</label>
						<input type="text" name="rank" class="form-group form-control text-center" id="rank" value="<? echo $rank; ?>" disabled>
					</div>
				</div>
				
				
			</form>
		</div>
			
		</div>
		
		<a name="ECPayPayWay" id="ECPayPayWay"></a>
	
	</div>
</section>

<!-- Advertise Area -->
<section class="" style="background-image:url(../img/histockbg02.jpg);background-repeat: no-repeat;background-size:cover;height: 300px;width: 100%;">
	<div class="container">
		<div class="row justify-content-center py-5">
			<div class="col-8">
				<h1 class="text-warning text-right" style="margin-top: 50px;">競賽使用「我是大股東」系列桌遊</h1>
				<button type="button" class="btn btn-outline-warning btn-lg mt-3 float-right" onClick="goPF()">前往了解</button>
			</div>
		</div>
	</div>
</section>

<!-- 繳費操作 -->
<section class="testimonials_area p_120">
	<div class="container">
		<div class="h1 mx-auto text-center">繳費操作說明</div>
		<div class="mx-auto text-center"><img src="../img/ecpay_logo.png"></div>
		<div class="h5 mx-auto text-center">線上金流服務由綠界科技ECPay提供</div>
		
		<div class="row py-3">
			
			<div class="col">
				
				<div class="card">
					<div class="card-body">
						<h2 class="card-title mx-auto text-center text-success">【超商代碼繳費】</h5>
						<h5 class="card-title mx-auto text-center font-weight-bold">全國四大超商皆可繳費</h5>
						<div class="mx-auto text-center"><img src="../img/paycode_pro.png"></div>
					</div>
				</div>
				
			</div>
			
			<div class="col">
				
				<div class="card">
					<div class="card-body">
						<h2 class="card-title mx-auto text-center text-success">【ATM虛擬帳號繳費】</h5>
						<h5 class="card-title mx-auto text-center font-weight-bold">可選銀行：土銀、元大、台灣、國泰、中信、玉山、第一、富邦、台新</h5>
						<div class="mx-auto text-center"><img src="../img/atm_pro.png"></div>
					</div>
				</div>
				
			</div>
			
			
		</div>
<a name="QA" id="QA"></a>		
	</div>
</section>

<!-- 常見問題 -->
<section class="price_area p_120">
<!-- Accordion -->
<div class="container-fluid bg-gray" id="accordion-style-1">
	<div class="container">
		<section>
			<div class="row">
				<div class="col-12">
					<h1 class="text-green mb-4 text-center">常見問題(QA)</h1>
				</div>
				<div class="col-10 mx-auto">
					<div class="accordion" id="accordionExample">
						
						<div class="card">
							<div class="card-header" id="headingOne">
						<h3 class="mb-0">
							<button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
							  <i class="fa fa-angle-double-right mr-3"></i>如何新增／修改／刪除隊伍成員？
							</button>
					  	</h3>
							</div>

							<div id="collapseOne" class="collapse show fade" aria-labelledby="headingOne" data-parent="#accordionExample">
								<div class="card-body">
									<h5>在報名開放期間（參考競賽時程表），點擊頁首上方左側功能選單的「競賽專區」即可前往競賽資料編輯區域，反白的灰色區域不可編輯，請於報名結束前完善隊伍資料，逾期系統將關閉所有編輯功能。</h5>
								</div>
							</div>
						</div>
						
						<div class="card">
							<div class="card-header" id="headingTwo">
								<h3 class="mb-0">
							<button class="btn btn-link collapsed btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
							 <i class="fa fa-angle-double-right mr-3"></i>我想取消報名可以嗎？
							</button>
						  </h3>
							</div>
							<div id="collapseTwo" class="collapse fade" aria-labelledby="headingTwo" data-parent="#accordionExample">
								<div class="card-body">
									<h5>在報名結束前（參考競賽時程表），點擊頁首上方左側功能選單的「競賽專區」前往競賽資料編輯區域，在「隊伍資訊」填寫表單的正下方，點擊『取消報名』按鈕，系統將刪除隊伍報名資料及所有成員資料（限當次競賽）。</h5>
								</div>
							</div>
						</div>
						
						<div class="card">
							<div class="card-header" id="headingThree">
								<h3 class="mb-0">
							<button class="btn btn-link collapsed btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
							  <i class="fa fa-angle-double-right mr-3"></i>報名結束後可以新增／修改／刪除隊伍成員嗎？
							</button>
						  </h3>
							</div>
							<div id="collapseThree" class="collapse fade" aria-labelledby="headingThree" data-parent="#accordionExample">
								<div class="card-body">
									<h5>報名結束後，即確定參賽成員，不可再對所有成員進行新增／修改／刪除的動作。</h5>
								</div>
							</div>
						</div>
						
						<div class="card">
							<div class="card-header" id="headingFour">
								<h3 class="mb-0">
							<button class="btn btn-link collapsed btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
							  <i class="fa fa-angle-double-right mr-3"></i>沒經過同意就被新增／除名或修改資料，該怎麼辦？</h5>
							</button>
						  </h3>
							</div>
							<div id="collapseFour" class="collapse fade" aria-labelledby="headingFour" data-parent="#accordionExample">
								<div class="card-body">
									<h5>請各隊伍自行做好溝通，本會將以報名結束後之隊伍名單為最終參賽資料。</h5>
								</div>
							</div>
						</div>
						
						<div class="card">
							<div class="card-header" id="heading5">
								<h3 class="mb-0">
							<button class="btn btn-link collapsed btn-block text-left" type="button" data-toggle="collapse" data-target="#collapse5" aria-expanded="false" aria-controls="collapse5">
							  <i class="fa fa-angle-double-right mr-3"></i>資料填錯怎麼辦？
							</button>
						  </h3>
							</div>
							<div id="collapse5" class="collapse fade" aria-labelledby="headingFour" data-parent="#accordionExample">
								<div class="card-body">
									<h5>在報名結束前，憑隊伍編號及參賽驗證碼登入競賽專區，均可對隊伍資訊進行編輯，至報名截止，系統將關閉資料編輯功能，請謹慎填寫。如經查證或舉報，任一隊伍成員有資料不實之情況，本會將取消該隊參賽權利及後續所有獲獎資格及所有獎項，且不予退費。</h5>
								</div>
							</div>
						</div>
						
						<div class="card">
							<div class="card-header" id="heading6">
								<h3 class="mb-0">
							<button class="btn btn-link collapsed btn-block text-left" type="button" data-toggle="collapse" data-target="#collapse6" aria-expanded="false" aria-controls="collapse6">
							  <i class="fa fa-angle-double-right mr-3"></i>忘了繳費怎麼辦？
							</button>
						  </h3>
							</div>
							<div id="collapse6" class="collapse fade" aria-labelledby="headingFour" data-parent="#accordionExample">
								<div class="card-body">
									<h5>繳費期間將開放線上繳費按鈕，取號後繳費資訊會顯示於「競賽專區」之「隊伍資訊」欄位內。若在繳費期間（系統開放取號繳費期間），已取號但逾繳費期限無法完成繳費，可重新取號，新的繳費資訊將同步更新於「競賽專區」之「隊伍資訊」欄位內。若超過繳費期間而未完成繳費者，視同放棄參賽，隊伍及所有成員之資料不予刪除。</h5>
								</div>
							</div>
						</div>
						
						<div class="card">
							<div class="card-header" id="heading7">
								<h3 class="mb-0">
							<button class="btn btn-link collapsed btn-block text-left" type="button" data-toggle="collapse" data-target="#collapse7" aria-expanded="false" aria-controls="collapse7">
							  <i class="fa fa-angle-double-right mr-3"></i>如何取得收據？
							</button>
						  </h3>
							</div>
							<div id="collapse7" class="collapse fade" aria-labelledby="headingFour" data-parent="#accordionExample">
								<div class="card-body">
									<h5>完成繳費後，於頁首上方左側功能選單點選「收據列印」，將新開收據視窗／分頁，如收據資料有誤請填寫<strong><a href="https://wmpcca.com/contact/" target="_blank">線上聯絡表單</a></strong>。</h5>
								</div>
							</div>
						</div>
						
						<div class="card">
							<div class="card-header" id="heading8">
								<h3 class="mb-0">
							<button class="btn btn-link collapsed btn-block text-left" type="button" data-toggle="collapse" data-target="#collapse8" aria-expanded="false" aria-controls="collapse8">
							  <i class="fa fa-angle-double-right mr-3"></i>如何取得參賽證明？
							</button>
						  </h3>
							</div>
							<div id="collapse8" class="collapse fade" aria-labelledby="headingFour" data-parent="#accordionExample">
								<div class="card-body">
									<h5>成功上傳初賽報告後，於頁首上方左側功能選單點選「參賽證明」，於新開視窗／分頁取得。</h5>
								</div>
							</div>
						</div>
						
						<div class="card">
							<div class="card-header" id="heading9">
								<h3 class="mb-0">
							<button class="btn btn-link collapsed btn-block text-left" type="button" data-toggle="collapse" data-target="#collapse9" aria-expanded="false" aria-controls="collapse9">
							  <i class="fa fa-angle-double-right mr-3"></i>如何知道參賽成績？
							</button>
						  </h3>
							</div>
							<div id="collapse9" class="collapse fade" aria-labelledby="headingFour" data-parent="#accordionExample">
								<div class="card-body">
									<h5>本會將依各賽程公告之時間，於本會網站首頁公佈，亦顯示於本區隊伍資訊欄。</h5>
								</div>
							</div>
						</div>
						
<!--
						<div class="card">
							<div class="card-header" id="headingFour">
								<h5 class="mb-0">
							<button class="btn btn-link collapsed btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
							  <i class="fa fa-angle-double-right mr-3"></i>
							</button>
						  </h5>
							</div>
							<div id="collapseFour" class="collapse fade" aria-labelledby="headingFour" data-parent="#accordionExample">
								<div class="card-body">
									
								</div>
							</div>
						</div>
-->
						
					</div>
				</div>	
			</div>
		</section>
	</div>
</div>
<!-- .// Accordion -->
</section>	

	
<!-- GoTop -->
<a href="" id="gotop">
   <i class="fa fa-angle-up"></i>
</a>

<!-- 隱藏表單 -->
<div>
	<!-- hidden PHP Time Value 按鈕控制 -->
<!--	<input type="hidden" name="schoolID" id="schoolID" Value="<?php echo $schoolID; ?>">   學校ID -->
	<input type="hidden" name="dataEditSwitch" id="dataEditSwitch" Value="<?php echo $editButton; ?>">  <!-- 編輯資料 -->
	<input type="hidden" name="payButtonSwitch" id="payButtonSwitch" Value="<?php echo $payButton; ?>">  <!-- 取號繳費 -->
	<input type="hidden" name="receiptButtonSwitch" id="receiptButtonSwitch" Value="<?php echo $receiptButton; ?>">  <!-- 編輯資料 -->
	<input type="hidden" name="teamDB" id="teamDB" Value="<?php echo $signupDB; ?>">  <!-- 報名表 -->
	<input type="hidden" name="memberDB" id="memberDB" Value="<?php echo $infoDB; ?>">  <!-- 資料表 -->
	<input type="hidden" name="projectNO" id="projectNO" Value="<?php echo $projectNO; ?>">  <!-- 活動代號 -->
	<input type="hidden" name="competInfo" id="competInfoSwitch" Value="<?php echo $competInfo; ?>">  <!-- 活動判斷 -->

	<!-- hidden receiptForm 線上收據 HS-->
	<form name="receiptForm" method="post" action="" id="receiptForm" target="_blank">
	<input type="hidden" name="receiptNO" id="receiptNO" Value="<?php echo $receiptNO; ?>">
	<input type="hidden" name="receiptSchool" id="receiptSchool" Value="<?php echo $schoolPre; ?>">
	<input type="hidden" name="receiptTeamName" id="receiptTeamName" Value="<?php echo $teamName; ?>">
	<input type="hidden" name="receiptProjectName" id="receiptProjectName" Value="<?php echo $projectName; ?>">
	<input type="hidden" name="receiptMN" id="receiptMN" Value="<?php echo $amount; ?>">
	<input type="hidden" name="receiptTPayTime" id="receiptTPayTime" Value="<?php echo $payTime; ?>">
	<input type="hidden" name="receiptCaptainName" id="receiptCaptainName" Value="<?php echo $captainName; ?>">
	<input type="hidden" name="receiptMember1Name" id="receiptMember1Name" Value="<?php echo $member1Name; ?>">
	<input type="hidden" name="receiptMember2Name" id="receiptMember2Name" Value="<?php echo $member2Name; ?>">
	</form>

	<!-- hidden proveForm 參賽證明 -->
	<form name="proveForm" method="post" action="" id="proveForm" target="_blank">
	<input type="hidden" name="proveSchool" id="proveSchool" Value="<?php echo $school; ?>">
		'[/:>]'
	<input type="hidden" name="proveCaptainName" id="proveCaptainName" Value="<?php echo $capName; ?>">
	<input type="hidden" name="proveMember1Name" id="proveMember1Name" Value="<?php echo $viceName; ?>">
	<input type="hidden" name="proveMember2Name" id="proveMember2Name" Value="<?php echo $memName; ?>">
	<input type="hidden" name="proveProjectName" id="proveProjectName" Value="<?php echo $projectName; ?>">
	<input type="hidden" name="proveTeamNO" id="proveTeamNO" Value="<?php echo $examNO; ?>">
	<input type="hidden" name="proveTeamName" id="proveTeamName" Value="<?php echo $teamName; ?>">
	<input type="hidden" name="proveDate" id="proveDate" Value="<?php echo $proveDate; ?>">
	</form>

	<!-- Hidden progressbar 時程進度條 -->
	<input type="hidden" name="progressStep1" id="progressStep1" Value="<?php echo $progressStep1; ?>">
	<input type="hidden" name="progressStep2" id="progressStep2" Value="<?php echo $progressStep2; ?>">
	<input type="hidden" name="progressStep3" id="progressStep3" Value="<?php echo $progressStep3; ?>">
	<input type="hidden" name="progressStep4" id="progressStep4" Value="<?php echo $progressStep4; ?>">
	<input type="hidden" name="progressStep5" id="progressStep5" Value="<?php echo $progressStep5 ?>">
	<input type="hidden" name="GG30" id="GG30" Value="<?php echo $GG30; ?>">
</div>
	

<?php require_once("../model/index_footer.php") ?>
<?php require_once("../model/index_js.php") ?>

<!--<script src="../lumino/js/bootstrap.min.js"></script>-->
<script type="text/javascript" src="../controller/waitload.js"></script>
<script type="text/javascript" src="../controller/index_nav.js"></script>
<script type="text/javascript" src="../controller/toggle_tooltip.js"></script>
<!-- nexus JS -->
<script src="../nexus/vendors/owl-carousel/owl.carousel.min.js"></script>
<script type="text/javascript" src="../controller/datepicker.js"></script>
<script type="text/javascript" src="../controller/zipcode_HiStock.js"></script>
<script type="text/javascript" src="../controller/HS_schoolList.js"></script>
<!-- AJAX Profile Edit -->
<script src="../controller/histock_signupAbort.js"></script>
<script src="../controller/histock_captainEdit.js"></script>
<script src="../controller/histock_member1Edit.js"></script>
<script src="../controller/histock_member1Delete.js"></script>
<script src="../controller/histock_member2Edit.js"></script>
<script src="../controller/histock_member2Delete.js"></script>


<!-- HT HS 表單開放 -->
<script>
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
		//取號Button失效
		$(".buttonFail").attr('disabled', 'disabled');
		
		//取得繳費資訊
		var amount = $("#fee").val();
		var projectNO = $("#projectNO").val();
		var projectName = $("#projectName").val();
		var teamNO = $("#examNO").val();
		console.log(amount);
		// 隱藏付款按鈕
		$(".pay_button").fadeOut( "slow" );
		// 檢查裝置類型
		IsMobileAgent = getIsMobileAgent();
		// 送出AJAX產生訂單，並取得SPToken等資訊
		$.ajax({
		    type: 'POST',
		    url: 'https://wmpcca.com/bswmp/form/ecPay/ajax_process.php',
		    dataType: 'json',
		    data: 'func=pay&payment_type='+payment_type+'&invoice_status='+invoice_status+'&amount='+amount+'&projectNO='+projectNO+'&projectName='+projectName+'&teamNO='+teamNO,
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

<!-- Script 各項按鈕開放 -->
<script>
//繳費按鈕
var payButton = $("#payButtonSwitch").val()
	if (payButton === "reCode") {
		$("#payButton").html("重新取號");
	} else if (payButton === "getCode") {
		$("#payButton").html("已取號");
		$("#payButton").attr("disabled", "disabled");
		$("#payButton").removeClass();
		$("#payButton").addClass("btn btn-secondary mx-auto text-center");
	} else if (payButton === "payed") { //如果繳費完成, 按鈕不顯示, 也不顯示繳費說明
		$("#payButton").hide();
		$("#payHelp").hide();
	} else if (payButton === "host") {	// 公關帳號, 按鈕不顯示, 也不顯示繳費說明
		$("#payButton").hide();
		$("#payHelp").hide();
	}

//收據按鈕
var receiptButton = $("#receiptButtonSwitch").val()
	if (receiptButton === "FALSE") {
		$("#receiptButton").attr("disabled", "disabled");
		$("#receiptButton").removeClass();
		$("#receiptButton").addClass("btn btn-secondary mx-auto text-center");
	}
	
//參賽證明
var proveButton = $("#report1").val()
	if (proveButton === "") {
		$("#proveButton").attr("disabled", "disabled");
		$("#proveButton").removeClass();
		$("#proveButton").addClass("btn btn-secondary mx-auto text-center");
	}

//格式下載
var fileDownload02 = $("#fileDownload02").val()
	if(fileDownload02 === "FALSE"){
		$("#SGreport02").hide();
	}
</script>
	
<!-- editInfo Page Tag -->
<script>
$( function () {
	$( '#dataEditButton' ) . click( function () {
		$( 'html,body' ) . animate( {
			scrollTop: $( '#editInfo' ) . offset() . top
		}, "show" );
		return false;
	} );
} );
$( function () {
	$( '#ECPayInfo' ) . click( function () {
		$( 'html,body' ) . animate( {
			scrollTop: $( '#ECPayPayWay' ) . offset() . top
		}, "show" );
		return false;
	} );
} );
$( function () {
	$( '#competHelp' ) . click( function () {
		$( 'html,body' ) . animate( {
			scrollTop: $( '#QA' ) . offset() . top
		}, "show" );
		return false;
	} );
} );
</script>


<!-- progressbar -->
<script>
// 取得progress Bar 值
var progressStep1 = $("#progressStep1").val();
var progressStep2 = $("#progressStep2").val();
var progressStep3 = $("#progressStep3").val();
var progressStep4 = $("#progressStep4").val();
var progressStep5 = $("#progressStep5").val();
var GG30 = $("#GG30").val();
var examScore = $("#examScore").val();
	
//	prigress 1 報名(繳費)開始 -> 報名(繳費)結束
if (progressStep1 === "TRUE"){
	// 顯示時程表
	$("#step1").addClass("progress-done progress-current");
	$("#step2").addClass("progress-todo");
	$("#step3").addClass("progress-todo");
	$("#step4").addClass("progress-todo");
	$("#step5").addClass("progress-todo");
	$("#step6").addClass("progress-todo");
	
	// 顯示按鈕
	$("#payButton").hide();
	$("#receiptButton").hide();
	$("#goMockButton").hide();
	$("#examButton").hide();
	$("#proveButton").hide();
}


//	 progress 2 報名(繳費)結束 -> 線上測驗開始
if (progressStep2 === "TRUE"){
	$("#step1").addClass("progress-done");
	$("#step2").addClass("progress-done progress-current");
	$("#step3").addClass("progress-todo");
	$("#step4").addClass("progress-todo");
	$("#step5").addClass("progress-todo");
	$("#step6").addClass("progress-todo");
	
	// 顯示按鈕
	$("#payButton").hide();
	$("#receiptButton").hide();
	$("#goMockButton").show();  // 模擬測驗開啟，其餘關閉
	$("#examButton").hide();
	$("#proveButton").hide();
}
	
	
//	progress 3 線上測驗開始 -> 線上測驗結束
if (progressStep3 === "TRUE"){
	$("#step1").addClass("progress-done");
	$("#step2").addClass("progress-done");
	$("#step3").addClass("progress-done progress-current");
	$("#step4").addClass("progress-todo");
	$("#step5").addClass("progress-todo");
	$("#step6").addClass("progress-todo");
		
	// 顯示按鈕
	$("#payButton").hide();
	$("#receiptButton").hide();
	$("#goMockButton").hide();			
	// 若已有成績 則關閉測驗按鈕
		if( examScore != ''){
			$("#examButton").hide();  // 複賽測驗關閉
			$("#proveButton").show(); // 參賽證明開啟
		}else{
			$("#examButton").show();  // 複賽測驗開啟
			$("#proveButton").hide(); // 參賽證明關閉			
		}
}
	
	
//	progress 4 線上測驗結束 -> 線下競賽開始
if (progressStep4 === "TRUE"){
	$("#step1").addClass("progress-done");
	$("#step2").addClass("progress-done");
	$("#step3").addClass("progress-done");
	$("#step4").addClass("progress-done progress-current");
	$("#step5").addClass("progress-done");
	$("#step6").addClass("progress-todo");
	
	// 顯示按鈕
	$("#payButton").hide();  // 繳費關閉
	$("#receiptButton").hide();  // 收據關閉
	$("#goMockButton").hide();  // 模擬測驗關閉
	$("#examButton").hide();  // 複賽測驗關閉
	// 若已有成績 開啟參賽證明
		if( examScore != '' ){
			$("#proveButton").show(); // 參賽證明開啟
		}
}
	
	
//	progress 5 線下競賽開始 -> 線下競賽結束
if (progressStep5 === "TRUE"){
	$("#step1").addClass("progress-done");
	$("#step2").addClass("progress-done");
	$("#step3").addClass("progress-done");
	$("#step4").addClass("progress-done");
	$("#step5").addClass("progress-done progress-current");
	$("#step6").addClass("progress-todo");
	
	// 顯示按鈕
	$("#payButton").hide();
	$("#receiptButton").hide();
	$("#goMockButton").hide();
	$("#examButton").hide();
	// 若已有成績 開啟參賽證明
		if( examScore != '' ){
			$("#proveButton").show(); // 參賽證明開啟
		}
}
	
	
//	progress 6 線下競賽結束
if (GG30 === "TRUE"){
	$("#step1").addClass("progress-done");
	$("#step2").addClass("progress-done");
	$("#step3").addClass("progress-done");
	$("#step4").addClass("progress-done");
	$("#step5").addClass("progress-done");
	$("#step6").addClass("progress-done");
	
	// 顯示按鈕
	$("#payButton").hide();
	$("#receiptButton").hide();
	$("#goMockButton").hide();
	$("#examButton").hide();
	// 若已有成績 開啟參賽證明
		if( examScore != '' ){
			$("#proveButton").show(); // 參賽證明開啟
		}
}

</script>
	
<!-- 收據及參賽證明 -->
<script>
function receiptPage(){
	$("#receiptForm").attr("action", "https://wmpcca.com/bswmp/form/view/cc_receipt.php");
	receiptForm.submit();
}
function entryProvePage(){
	$("#proveForm").attr("action", "https://wmpcca.com/bswmp/form/model/entryProve.php");
	proveForm.submit();
}
</script>

<!-- 模擬測驗 檔案上傳 GoTop -->
<script>
	function goMock(){
		window.open("https://wmpcca.com/bswmp/form/view/exam_HiStock_Mock_Start.php","線上模擬測驗","fullscreen=yes,status=yes,toolbar=yes,menubar=yes,location=yes");
	}
	function goExam(){
		//buttonFail
		$(".buttonFail").prop('disabled', true);
		window.open("https://wmpcca.com/bswmp/form/view/exam_HiStock_Exam_Start.php","金融與證券投資實務競賽線上測驗","fullscreen=yes,status=yes,toolbar=yes,menubar=yes,location=yes");
}
	function goPF() {
		window.open("http://pf-cashflow.weebly.com/");
	}
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
	
<!-- Modal actMethod Rules Personal 辦法規則-->
<!--
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
</script>
-->



</body>
</html>