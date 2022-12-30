<?php

//連結資料庫
require_once("../vender/dbtools.inc.php");

//取得現在日期時間
$getToday = date("Y-m-d H:i:s");
//$getToday = date("2020-11-03 13:00:30");

//COOKIE陣列解序
$loginInfo = unserialize($_COOKIE["loginCompet"]);



//取得COOKIE內容
$teamDB = $loginInfo[0];
$memberDB = $loginInfo[1];
$teamNO = $loginInfo[2];
$teamName = $loginInfo[3];
$projectNO = $loginInfo[4];
$projectName = $loginInfo[5];
$competInfo = $loginInfo[6];
$passed = $loginInfo[7];

//COOKIE登入錯誤
//if ($passed != "TRUE"){
//echo "<script type='text/javascript'>";
//echo "alert('COOKIE逾時或錯誤!請重新登入！');";
//echo "window.location.href='compet_index.php';";
//echo "</script>";
//exit();
//}

//取得競賽項目資料
$sqlSELECTcompetList = " SELECT * FROM competList WHERE projectNO = '$projectNO' ";
$sqlRESULTcompetList = mysql_query($sqlSELECTcompetList, $sqlLink);
$sqlFETCHcompetList = mysql_fetch_row($sqlRESULTcompetList);
$amount = $sqlFETCHcompetList[3]; //報名費用
$competStartDate = $sqlFETCHcompetList[4]; //競賽開始
$competEndDate = $sqlFETCHcompetList[5]; //競賽結束
$payStartDate = $sqlFETCHcompetList[6]; //繳費開始
$payEndDate = $sqlFETCHcompetList[7]; //繳費結束
$report1Date = $sqlFETCHcompetList[8]; //初賽報告截止日
$report2Date = $sqlFETCHcompetList[9]; //初賽報告截止日
$downloadLink = $sqlFETCHcompetList[10]; //檔案下載連結
$surveyNumber = $sqlFETCHcompetList[11]; //對應問卷


	// 若問卷存在, 則調出對應成員是否作答
	if ( $surveyNumber != '' ){
		
		$sqlSELECTsurveyFeed = mysql_query("
			SELECT *
			FROM studentsInfo
			LEFT JOIN S21E01
			ON studentsInfo.teamNO = S21E01.teamNO
			AND studentsInfo.remarks = S21E01.role
			WHERE S21E01.role is null
			AND studentsInfo.teamNO = '$teamNO'
		");
		$sqlNUMROWSsurveyFeed = mysql_num_rows($sqlSELECTsurveyFeed);
		
			if ( $sqlNUMROWSsurveyFeed != 0 ){
				$surveyButton = 'FALSE';
			}else {
				$surveyButton = 'TRUE';
			}
		
	}else{
		$surveyButton = 'TRUE';
	}



//取得評分資料
$sqlSELECTcompetInfo = " SELECT * FROM competScore WHERE teamNO = '$teamNO' ";
$sqlRESULTcompetInfo = mysql_query($sqlSELECTcompetInfo, $sqlLink);
$sqlFETCHcompetInfo = mysql_fetch_row($sqlRESULTcompetInfo);
$report1 = $sqlFETCHcompetInfo[4];  //初賽報告繳交
$score1 = $sqlFETCHcompetInfo[5];  //初賽成績
$report2 = $sqlFETCHcompetInfo[6];  //決賽報告繳交
$score2 = $sqlFETCHcompetInfo[7];  //決賽成績

//判斷繳費取單
$sqlSELECTpayInfo = " SELECT * FROM orderList WHERE customerNO = '$teamNO' ORDER BY id DESC ";
$sqlRESULTpayInfo = mysql_query($sqlSELECTpayInfo, $sqlLink);
$sqlFETCHpayInfo = mysql_fetch_row($sqlRESULTpayInfo);
$orderTime = $sqlFETCHpayInfo[1];  //訂單成立時間
$orderNO = $sqlFETCHpayInfo[2];  // 訂單編號
$payWay = $sqlFETCHpayInfo[7];  // 付款方式
if (substr($payWay, 0, 3) == 'ATM'){
	$payWay = 'ATM轉帳';
}
if (substr($payWay, 0, 3) == 'CVS'){
	$payWay = '超商代碼';
}
$payStatus = $sqlFETCHpayInfo[8];  // 繳費狀態
$payTime = $sqlFETCHpayInfo[9];  // 繳費完成時間
$BankCode = $sqlFETCHpayInfo[13];  // 銀行代碼
$vAccount = $sqlFETCHpayInfo[14];  // 匯款帳號
$PaymentNO = $sqlFETCHpayInfo[15];  // 超商代碼
$ExpireDate = $sqlFETCHpayInfo[16];  // 繳費期限



if ($competInfo == "SG"){
	//取得社會組隊長資料
	$sqlSELECTcaptainInfo = " SELECT * FROM $memberDB WHERE teamNO = '$teamNO' AND remarks = '隊長' ";
	$sqlRESULTcaptainInfo = mysql_query($sqlSELECTcaptainInfo, $sqlLink);
	$sqlFETCHcaptainInfo = mysql_fetch_row($sqlRESULTcaptainInfo);
	$captainName = $sqlFETCHcaptainInfo[3];
	$captainSex = $sqlFETCHcaptainInfo[4];
	$captainID =  $sqlFETCHcaptainInfo[5];
	$captainBirth = $sqlFETCHcaptainInfo[6];
	$captainPhone = $sqlFETCHcaptainInfo[7];
	$captainEmail = $sqlFETCHcaptainInfo[8];
	$captainCity = $sqlFETCHcaptainInfo[9];
	$captainDistrict = $sqlFETCHcaptainInfo[10];
	$captainAddr = $sqlFETCHcaptainInfo[11];
	$captainJob = $sqlFETCHcaptainInfo[13];
	$captainTitle = $sqlFETCHcaptainInfo[14];
	$captainYear = $sqlFETCHcaptainInfo[15];

	//提醒隊長補資料
	if ( strtotime($getToday) <= strtotime($competEndDate) && ($captainPhone == "") ){
	echo "<script type='text/javascript'>";
	echo "alert('提醒您：「隊長」資料尚未完善！請於報名截止前補全競賽專區之「隊長」及其他欲共同參賽成員資料，以免因資料不全喪失競賽資格！')";
	echo "</script>";
		}

	//取得社會組副手資料
	$sqlSELECTmember1Info = " SELECT * FROM $memberDB WHERE teamNO = '$teamNO' AND remarks = '副手' ";
	$sqlRESULTmember1Info = mysql_query($sqlSELECTmember1Info, $sqlLink);
	$sqlFETCHmember1Info = mysql_fetch_row($sqlRESULTmember1Info);
	$member1Name = $sqlFETCHmember1Info[3];
	$member1Sex = $sqlFETCHmember1Info[4];
	$member1ID =  $sqlFETCHmember1Info[5];
	$member1Birth = $sqlFETCHmember1Info[6];
	$member1Phone = $sqlFETCHmember1Info[7];
	$member1Email = $sqlFETCHmember1Info[8];
	$member1City = $sqlFETCHmember1Info[9];
	$member1District = $sqlFETCHmember1Info[10];
	$member1Addr = $sqlFETCHmember1Info[11];
	$member1Job = $sqlFETCHmember1Info[13];
	$member1Title = $sqlFETCHmember1Info[14];
	$member1Year = $sqlFETCHmember1Info[15];

	//取得社會組隊員資料
	$sqlSELECTmember2Info = " SELECT * FROM $memberDB WHERE teamNO = '$teamNO' AND remarks = '隊員' ";
	$sqlRESULTmember2Info = mysql_query($sqlSELECTmember2Info, $sqlLink);
	$sqlFETCHmember2Info = mysql_fetch_row($sqlRESULTmember2Info);
	$member2Name = $sqlFETCHmember2Info[3];
	$member2Sex = $sqlFETCHmember2Info[4];
	$member2ID =  $sqlFETCHmember2Info[5];
	$member2Birth = $sqlFETCHmember2Info[6];
	$member2Phone = $sqlFETCHmember2Info[7];
	$member2Email = $sqlFETCHmember2Info[8];
	$member2City = $sqlFETCHmember2Info[9];
	$member2District = $sqlFETCHmember2Info[10];
	$member2Addr = $sqlFETCHmember2Info[11];
	$member2Job = $sqlFETCHmember2Info[13];
	$member2Title = $sqlFETCHmember2Info[14];
	$member2Year = $sqlFETCHmember2Info[15];

}else{
	
	//取得大專隊伍資料
	$sqlSELECTcompetCollegeInfo = " SELECT * FROM $teamDB WHERE teamNO = '$teamNO' AND projectNO = '$projectNO' ";
	$sqlRESULTcompetCollegeInfo = mysql_query($sqlSELECTcompetCollegeInfo, $sqlLink);
	$sqlFETCHcompetCollegeInfo = mysql_fetch_row($sqlRESULTcompetCollegeInfo);
	$schoolDistrict = $sqlFETCHcompetCollegeInfo[4];
	$schoolPre = $sqlFETCHcompetCollegeInfo[5];
	$teacherName = $sqlFETCHcompetCollegeInfo[7];
	
	//取得參賽學校隊數 = 報名費優惠
	$sqlSELECTschoolNums = " SELECT * FROM $teamDB WHERE school='$schoolPre' AND projectNO = '$projectNO' ";
	$sqlRESULTschoolNums = mysql_query($sqlSELECTschoolNums, $sqlLink);
	$sqlNUMSschoolNUMs = mysql_num_rows($sqlRESULTschoolNums);
	$schoolNUMs = $sqlNUMSschoolNUMs;
	//超過10隊以上修改報名費
	if ($schoolNUMs >= 10){
		$amount = $amount*0.85;
	}
	
	//取得學校ID
	$sqlSELECTschoolID = " SELECT schoolID FROM schoolList WHERE schoolName = '$schoolPre' ";
	$sqlRESULTschoolID = mysql_query($sqlSELECTschoolID, $sqlLink);
	$sqlFETCHschoolID = mysql_fetch_row($sqlRESULTschoolID);
	$schoolID = $sqlFETCHschoolID[0];

	//取得大專組隊長資料
	$sqlSELECTcaptainInfo = " SELECT * FROM $memberDB WHERE teamNO = '$teamNO' AND remarks = '隊長' ";
	$sqlRESULTcaptainInfo = mysql_query($sqlSELECTcaptainInfo, $sqlLink);
	$sqlFETCHcaptainInfo = mysql_fetch_row($sqlRESULTcaptainInfo);
	$captainName = $sqlFETCHcaptainInfo[4];
	$captainID = $sqlFETCHcaptainInfo[5];
	$captainSex = $sqlFETCHcaptainInfo[6];
	$captainBirth = $sqlFETCHcaptainInfo[7];
	$captainPhone = $sqlFETCHcaptainInfo[8];
	$captainEmail = $sqlFETCHcaptainInfo[9];
	$captainCity = $sqlFETCHcaptainInfo[10];
	$captainDistrict = $sqlFETCHcaptainInfo[11];
	$captainAddr = $sqlFETCHcaptainInfo[12];
	$captainCombineAddr = $sqlFETCHcaptainInfo[13];
	$captainCollege = $sqlFETCHcaptainInfo[15];
	$captainDepart = $sqlFETCHcaptainInfo[16];
	$captainDegree = $sqlFETCHcaptainInfo[17];
	$captainGrade = $sqlFETCHcaptainInfo[18];
	$captainRemarks = $sqlFETCHcaptainInfo[19];
	
	//提醒隊長補資料
	if ( strtotime($getToday) <= strtotime($competEndDate) && ($captainPhone == "") ){
	echo "<script type='text/javascript'>";
	echo "alert('提醒您：「隊長」資料尚未完善！請於報名截止前補全競賽專區之「隊長」及其他欲共同參賽成員之資料，以免因資料不全喪失競賽資格！');";
	echo "</script>";
	}


	//取得大專組副手資料
	$sqlSELECTmember1Info = " SELECT * FROM $memberDB WHERE teamNO = '$teamNO' AND remarks = '副手' ";
	$sqlRESULTmember1Info = mysql_query($sqlSELECTmember1Info, $sqlLink);
	$sqlFETCHmember1Info = mysql_fetch_row($sqlRESULTmember1Info);
	$member1Name = $sqlFETCHmember1Info[4];
	$member1ID = $sqlFETCHmember1Info[5];
	$member1Sex = $sqlFETCHmember1Info[6];
	$member1Birth = $sqlFETCHmember1Info[7];
	$member1Phone = $sqlFETCHmember1Info[8];
	$member1Email = $sqlFETCHmember1Info[9];
	$member1City = $sqlFETCHmember1Info[10];
	$member1District = $sqlFETCHmember1Info[11];
	$member1Addr = $sqlFETCHmember1Info[12];
	$member1CombineAddr = $sqlFETCHmember1Info[13];
	$member1College = $sqlFETCHmember1Info[15];
	$member1Depart = $sqlFETCHmember1Info[16];
	$member1Degree = $sqlFETCHmember1Info[17];
	$member1Grade = $sqlFETCHmember1Info[18];
	$member1Remarks = $sqlFETCHmember1Info[19];

	//取得大專組隊員資料
	$sqlSELECTmember2Info = " SELECT * FROM $memberDB WHERE teamNO = '$teamNO' AND remarks = '隊員' ";
	$sqlRESULTmember2Info = mysql_query($sqlSELECTmember2Info, $sqlLink);
	$sqlFETCHmember2Info = mysql_fetch_row($sqlRESULTmember2Info);
	$member2Name = $sqlFETCHmember2Info[4];
	$member2ID = $sqlFETCHmember2Info[5];
	$member2Sex = $sqlFETCHmember2Info[6];
	$member2Birth = $sqlFETCHmember2Info[7];
	$member2Phone = $sqlFETCHmember2Info[8];
	$member2Email = $sqlFETCHmember2Info[9];
	$member2City = $sqlFETCHmember2Info[10];
	$member2District = $sqlFETCHmember2Info[11];
	$member2Addr = $sqlFETCHmember2Info[12];
	$member2CombineAddr = $sqlFETCHmember2Info[13];
	$member2College = $sqlFETCHmember2Info[15];
	$member2Depart = $sqlFETCHmember2Info[16];
	$member2Degree = $sqlFETCHmember2Info[17];
	$member2Grade = $sqlFETCHmember2Info[18];
	$member2Remarks = $sqlFETCHmember2Info[19];

}

//判斷報告書及簡報格式是否出現
if ( ($competInfo == "SG") && ($score1 != "") ){
	$fileDownload02 = "TRUE";
}else{
	$fileDownload02 = "FALSE";
}

//判斷繳費期間
if (strtotime($getToday) >= strtotime($payStartDate) && strtotime($getToday) <= strtotime($payEndDate)){
	$payPeriod = "TRUE";
}else {
	$payPeriod = "FALSE";
}

//判斷繳費期限
if (strtotime($ExpireDate) >= strtotime($getToday) ){
	$payDate = "TRUE";
}else{
	$payDate = "FALSE";
}

//繳費按鈕開關
if ($ExpireDate != "" && (strtotime($ExpireDate) >= strtotime($getToday))){
	$payButton = "getCode";
}else if ( ($ExpireDate != "") && (strtotime($ExpireDate) <= strtotime($getToday)) ){
	$payButton = "reCode";
}

//取得收據資料
if ($payStatus == "繳費完成"){
		$payButton = "payed";
		$receiptButton = "TRUE";
		//取得收據號碼
		$sqlSELECTreceiptNO = " SELECT receiptNO FROM receiptList WHERE orderNO = '$orderNO' ";
		$sqlRESULTreceiptNO = mysql_query($sqlSELECTreceiptNO, $sqlLink);
		$sqlFETCHreceiptNO = mysql_fetch_row($sqlRESULTreceiptNO);
		$receiptNO = $sqlFETCHreceiptNO[0];  // 收據號碼
}else{
	$receiptButton = "FALSE";
}

//判斷progressbar - --報名開始 -> 報名結束 progressStep1
if ( (strtotime($getToday) >= strtotime($competStartDate)) && (strtotime($getToday) <= strtotime($competEndDate))  ){
	$progressStep1 = "TRUE";
}else{
	$progressStep1 = "FALSE";
}

//判斷progressbar - 報名結束 -> 繳費開始 progressStep2
if ( (strtotime($getToday) >= strtotime($competEndDate)) && (strtotime($getToday) <= strtotime($payStartDate))  ){
	$progressStep2 = "TRUE";
}else{
	$progressStep2 = "FALSE";
}

//判斷progressbar - 繳費開始 -> 繳費結束 progressStep3
if ( (strtotime($getToday) >= strtotime($payStartDate)) && (strtotime($getToday) <= strtotime($payEndDate))  ){
	$progressStep3 = "TRUE";
}else{
	$progressStep3 = "FALSE";
}

//判斷progressbar - 繳費結束 -> 初賽報告截止前 progressStep4
if ( (strtotime($getToday) >= strtotime($payEndDate)) && (strtotime($getToday) <= strtotime($report1Date))  ){
	$progressStep4 = "TRUE";
}else{
	$progressStep4 = "FALSE";
}

//判斷progressbar - 初賽報告截止後 -> 決賽報告截止前 progressStep5
if ( strtotime($getToday) >= strtotime($report1Date) && (strtotime($getToday) <= strtotime($report2Date)) ){
	$progressStep5 = "TRUE";
}else{
	$progressStep5 = "FALSE";
}

//判斷progressbar - 決賽報告截止後 progressStep6
if ( strtotime($getToday) >= strtotime($report2Date) ){
	$GG30 = "TRUE";
}else{
	$GG30 = "FALSE";
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


<!-- 頁首 -->
<section class="home_banner_area">
	<div class="banner_inner">
	<div class="main">
	<div class="containerIndex">
		<div class="" style="padding-top: 30px;">
			<div class="h4 mx-auto text-center" style="color: #0B7376;">嗨!「<?php echo $teamName; ?>」隊</div>
			
			<div class="form-group mt-4 mx-auto text-center">
				<a href="#editInfo"><button type="button" class="form-control btn btn-outline-danger" id="dataEditButton" style="text-align: center; width: 50%">競賽專區</button></a>
			</div>
			
			<div class="form-group mx-auto text-center">
				<button type="button" class="form-control btn btn-outline-success" id="payButton" style="text-align: center; width: 50%" data-toggle="collapse" data-target="#buttonEcpay" aria-expanded="false" aria-controls="buttonEcpay">取號繳費</button>
				
				<div class="collapse mt-2" id="buttonEcpay">
					<div class="form-group mx-auto text-center">
						<button type="button" class="mt-1 pay_button form-control btn btn-success buttonFail" onclick="ajax_payment('ATM', 0)" style="text-align: center; width: 50%">ATM付款</button>
						<button type="button" class="mt-1 pay_button form-control btn btn-success mt-0 buttonFail" onclick="ajax_payment('CVS', 0)" style="text-align: center; width: 50%">超商代碼付款</button>
					</div>
					<div id="dialog" class="dialog mx-auto text-center" title="台灣財富管理規劃顧問認證協會-<?php echo $projectName.'報名費';?>"></div>
				</div>
			</div>	

			<div class="form-group mx-auto text-center mt-3">
				<button type="button" class="form-control btn btn-outline-warning" id="receiptButton" style="text-align: center; width: 50%" onClick="receiptPage()">收據列印</button>
			</div>
			
			<div class="form-group mx-auto text-center">
				<button type="button" id="uploadButton" class="form-control btn btn-outline-info" style="text-align: center; width: 50%" data-toggle="collapse" data-target="#buttonUpload" aria-expanded="false" aria-controls="buttonUpload">檔案上傳</button>
				
			<div class="collapse" id="buttonUpload">
				<div class="form-group mx-auto tyext-center">
					<button type="button" class="mt-2 form-control btn btn-info" id="report1Button" style="text-align: center; width: 50%" onClick="uploadReport1()">報告上傳</button>
					<button type="button" class="mt-2 form-control btn btn-info" id="report2Button" style="text-align: center; width: 50%" onClick="uploadReport2()">報告上傳</button>
					<button type="button" class="mt-2 form-control btn btn-info" id="report3Button" style="text-align: center; width: 50%" onClick="uploadReport3()">簡報上傳</button>
				</div>
			</div>
				
			<div class="form-group mx-auto text-center mt-3">
				<button type="button" class="form-control btn btn-outline-info" id="surveyButton" style="text-align: center; width: 50%" onClick="survey()">競賽問卷</button>
			</div>

			<div class="form-group mt-3 mx-auto text-center">
				<button type="button" class="form-control btn btn-outline-primary" id="proveButton" style="text-align: center; width: 50%" onClick="entryProvePage()">參賽證明</button>
				<small id="payHelp" class="form-text text-muted mx-auto text-center"><a href="#ECPayPayWay" id="ECPayInfo">繳費操作說明</a></small>
				<small class="form-text text-muted mx-auto text-center"><a href="#QA" id="competHelp">常見問題(QA)</a></small>
			</div>

				
			<div class="form-group mx-auto text-center py-4">
				<button type="button" class="form-control btn btn-danger" id="recieptButton" style="text-align: center; width: 30%"><a href="../model/compet_logout.php">登出</a></button>
			</div>
				
				
		</div>
		
	</div>
</div>
	</div>
</section>

<!-- 競賽時程 -->
<section class="made_life_area p_120">
	<div class="container">
		
			<div class="mx-auto text-center pb-2">
				<p class="h1"><?php echo $projectName ?></p>
				<p class="h4">競 賽 時 程 表</p>
			</div>
			
<ol class="progress-track py-5 fa-ul">
	
  <li class="" id="step1">
    <center>
      <div class="icon-wrap"></div>
      <span class="progress-text"><i class="fas fa-user-plus pr-2" style="font-size: 18px;color: #979797;"></i>開始報名<br><?php echo substr($competStartDate, 0, 16) ?></span>
    </center>
  </li>

  <li class="" id="step2">
    <center>
      <div class="icon-wrap"></div>
      <span class="progress-text"><i class="fas fa-user-times pr-2" style="font-size: 18px;color: #979797;"></i>報名截止<br><?php echo date("Y-m-d H:i", strtotime($competEndDate) ) ?></span>
    </center>
  </li>

  <li class="" id="step3">
    <center>
      <div class="icon-wrap"></div>
      <span class="progress-text"><i class="fas fa-dollar-sign pr-2" style="font-size: 18px;color: #979797;"></i>開放繳費<br><?php echo substr($payStartDate, 0, 16) ?></span>
    </center>
  </li>

  <li class="" id="step4">
    <center>
      <div class="icon-wrap"></div>
      <span class="progress-text"><i class="fas fa-cash-register pr-2" style="font-size: 18px;color: #979797;"></i>繳費截止<br><?php echo date("Y-m-d H:i", strtotime($payEndDate) ) ?></span>
    </center>
  </li>
  <li class="" id="step5">
    <center>
      <div class="icon-wrap"></div>
      <span class="progress-text"><i class="fas fa-file-upload pr-2" style="font-size: 18px;color: #979797;"></i>初賽報告<br><?php echo date("Y-m-d H:i", strtotime($report1Date) ) ?></span>
    </center>
  </li>
  <li class="" id="step6">
    <center>
      <div class="icon-wrap"></div>
      <span class="progress-text"><i class="fas fa-file-upload pr-2" style="font-size: 18px;color: #979797;"></i>決賽報告<br><?php echo date("Y-m-d H:i", strtotime($report2Date) ) ?></span>
    </center>
  </li>
	
</ol>
			

	</div>
<a name="editInfo" id="editInfo"></a>
</section>
	
<!-- 社會組隊伍資訊 -->
<section class="price_area p_120" id="competSocialInfo">
	<div class="container">
		<div class="mx-auto text-center pb-3">
			<p class="h1">競賽專區</a></p>
			<p class="h2 pt-2" id="SGdownloadFiles">
				<a href="#editInfo" class="downloadPDF actMethod" id="SGactMethod" data-toggle="tooltip" data-placement="top" title="活動辦法"><i class="fas fa-book-reader pr-2"></i></a>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<a href="#editInfo" class="downloadPDF competRules" id="SGcompetRules" data-toggle="tooltip" data-placement="top" title="競賽規則"><i class="fas fa-balance-scale pr-2"></i></a>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<a href="#editInfo" class="downloadPDF privacy" id="SGprivacy" data-toggle="tooltip" data-placement="top" title="隱私權保護政策"><i class="fas fa-user-lock pr-2"></i></a>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<a href="https://drive.google.com/file/d/1BU5GuDmnJDXtk7rjaQkbX0i_vcQWsD12/view" class="downloadPDF" target="_blank" data-toggle="tooltip" data-placement="top" title="競賽同意書(未成年者需簽署)"><i class="fas fa-user-shield pr-2"></i></i></a>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<a href="<?php echo $downloadLink; ?>" class="downloadZip" target="_blank" data-toggle="tooltip" data-placement="top" title="案例下載"><i class="fas fa-file-signature pr-2"></i></a>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<a href="https://drive.google.com/file/d/1vLFEmdg-UO88pfFdBAUcq_xjR_fsjyyg/view" class="downloadWord" id="SGreport02" target="_blank" data-toggle="tooltip" data-placement="top" title="決賽報告書頁首"><i class="fas fa-file-word pr-2"></i></i></a>
			</p>
<!--
			<p class="h3 pt-2" id="SGdownloadFiles">
				<a href="#editInfo" class="downloadPDF" id="SGactMethod" data-toggle="tooltip" data-placement="top" title="活動辦法"><i class="fas fa-book-reader pr-2"></i></a>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<a href="#editInfo" class="downloadPDF" id="SGcompetRules" data-toggle="tooltip" data-placement="top" title="競賽規則"><i class="fas fa-balance-scale pr-2"></i></a>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<a href="#editInfo" class="downloadPDF" id="SGprivacy" data-toggle="tooltip" data-placement="top" title="隱私權保護政策"><i class="fas fa-user-shield pr-2"></i>隱私權保護政策</a>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<a href="https://drive.google.com/open?id=0Bzz_M6cf2stadG42SDRySTJwSFU" class="SGdownloadWord" target="_blank" data-toggle="tooltip" data-placement="top" title="未滿20歲之參賽者請下載印出填寫並交由監護人簽名後於初賽收件截止前寄回本會：台北市南京東路二段216號8樓 (台灣財富管理規劃顧問認證協會收)"><i class="fas fa-user-lock pr-2"></i></i>競賽同意書(未成年)</a>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<a href="<?php echo $downloadLink; ?>" class="SGdownloadZip" target="_blank" data-toggle="tooltip" data-placement="top" title="Zip壓縮檔"><i class="fas fa-cloud-download-alt pr-2"></i>競賽便利包</a>
			</p>
-->
		</div>
		
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
			<form class="form-group form-control" name="teamInfoForm" autocomplete="off">
				
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
				
				<div class="row mt-2">
					<div class="col-xl-3">
						報名費用：<input type="text" class="form-group form-control mx-auto text-center" name="amount" id="amount" value="<?php echo $amount; ?>" placeholder="新台幣 <?php echo $amount; ?> 元整" disabled>
					</div>
					<div class="col-xl-3">
						繳費狀態：<input type="text" class="form-group form-control mx-auto text-center" name="payStatus" id="payStatus" value="<?php echo $payStatus; ?>" placeholder="<?php echo $payStatus; ?>" disabled>
					</div>
					<div class="col-xl-3">
						繳費方式：<input type="text" class="form-group form-control mx-auto text-center" name="payWay" id="payWay" value="<?php echo $payWay; ?>" placeholder="<?php echo $payWay; ?>" disabled>
					</div>
					<div class="col-xl-3">
						繳費期限：<input type="text" class="form-group form-control mx-auto text-center" name="ExpireDate" id="ExpireDate" value="<?php echo $ExpireDate; ?>" placeholder="<?php echo $ExpireDate; ?>" disabled>
					</div>
				</div>
				
				<div class="row mt-2">
					<div class="col-xl-3">
						ATM銀行代碼：<input type="text" class="form-group form-control mx-auto text-center" name="BankCode" id="BankCode" value="<?php echo $BankCode; ?>" placeholder="<?php echo $BankCode; ?>" disabled>
					</div>
					<div class="col-xl-3">
						ATM繳費帳號：<input type="text" class="form-group form-control mx-auto text-center" name="vAccount" id="vAccount" value="<?php echo $vAccount; ?>" placeholder="<?php echo $vAccount; ?>" disabled>
					</div>
					<div class="col-xl-3">
						超商繳費代碼：<input type="text" class="form-group form-control mx-auto text-center" name="PaymentNO" id="PaymentNO" value="<?php echo $PaymentNO; ?>" placeholder="<?php echo $PaymentNO; ?>" disabled>
					</div>
					<div class="col-xl-3">
						繳費日期：<input type="text" class="form-group form-control mx-auto text-center" name="payTime" id="payTime" value="<?php echo $payTime; ?>" placeholder="<?php echo $payTime; ?>" disabled>
					</div>
				</div>
				
				<div class="row mt-2">
					<div class="col-xl-3">
						初賽報告：<input type="text" class="form-group form-control mx-auto text-center" name="report1" id="report1" value="<?php echo $report1; ?>" placeholder="<?php echo $report1; ?>" disabled>
					</div>
					<div class="col-xl-3">
						初賽成績：<input type="text" class="form-group form-control mx-auto text-center" name="score1" id="score1" value="<?php echo $score1; ?>" placeholder="<?php echo $score1; ?>" disabled>
					</div>
					<div class="col-xl-3">
						決賽報告：<input type="text" class="form-group form-control mx-auto text-center" name="report2" id="report2" value="<?php echo $report2; ?>" placeholder="<?php echo $report2; ?>" disabled>
					</div>
					<div class="col-xl-3">
						決賽成績：<input type="text" class="form-group form-control mx-auto text-center" name="score2" id="score2" value="<?php echo $score2; ?>" placeholder="<?php echo $score2; ?>" disabled>
					</div>
				</div>
				
			<div class="mx-auto text-center mt-5">
					<button type="button" class="btn btn-danger" id="delSignup" onClick="signupAbort()">取消報名</button>
					<br>
					<br>
			</div>
		
			</form>
		</div>
			
		<div class="tab-pane fade" id="captainProfile" role="tabpanel" aria-labelledby="nav-profile-tab">
			<form class="form-group form-control" name="captainSignupForm" autocomplete="off">
				
			<div class="row mt-2">
				<div class="col-xl-3">
					姓名：<input type="text" class="form-group form-control mx-auto text-center" name="captainName" id="captainName" value="<?php echo $captainName;?>" placeholder="<?php echo $captainName;?>" disabled>
				</div>
				<div class="col-xl-3">
					稱謂：<select class="custom-select mr-sm-2" id="captainSex">
							<option value="<?php echo $captainSex;?>" selected><?php echo $captainSex;?></option>
							<option value="先生">先生</option>
							<option value="女士">女士</option>
						</select>
				</div>
				<div class="col-xl-3">
					身份證字號：<input type="text" class="form-group form-control mx-auto text-center" name="captainID" id="captainID" value="<?php echo $captainID;?>" placeholder="<?php echo $captainID;?>" disabled>
				</div>
				<div class="col-xl-3">
					生日：<span class="text-secondary" style="font-size: 8px">(ex:2000-01-01或點選日曆)</span><input type="text" class="form-group form-control mx-auto text-center datepicker" name="captainBirth" id="captainBirth" value="<?php echo $captainBirth;?>" placeholder="<?php echo $captainBirth;?>">
				</div>
			</div>
				
			<div class="row">
				<div class="col-xl-4">
					行動電話：<span class="text-secondary" style="font-size: 8px">(ex:0987654321)</span><input type="text" class="form-group form-control mx-auto text-center" name="captainPhone" id="captainPhone" value="<?php echo $captainPhone;?>" placeholder="<?php echo $captainPhone;?>">
				</div>
				<div class="col-xl-8">
					E-Mail：<span class="text-secondary" style="font-size: 8px">(建議使用Gmail以確保收到競賽相關通知)</span><input type="text" class="form-group form-control mx-auto text-center" name="captainEmail" id="captainEmail" value="<?php echo $captainEmail;?>" placeholder="<?php echo $captainEmail;?>" disabled>
				</div>
			</div>
				
			<div class="row">
				<div class="col-xl-3">
					通訊地址-城市：<select name="captainCity" class="form-control" id="captainCity">
									<option selected value="<?php echo $captainCity;?>"><?php echo $captainCity;?></option>
								</select>
				</div>
				<div class="col-xl-3">
					通訊地址-行政區：<select class="form-control" name="captainDistrict" id="captainDistrict">
									<option selected value="<?php echo $captainDistrict;?>"><?php echo $captainDistrict;?></option>
								</select>
				</div>
				<div class="col-xl-6">
					通訊地址：<input type="text" class="form-group form-control mx-auto text-center" name="captainAddr" id="captainAddr" value="<?php echo $captainAddr;?>" placeholder="<?php echo $captainAddr;?>">
				</div>
			</div>
				
			<div class="row">
				<div class="col-xl-4">
					服務產業：<select class="custom-select mr-sm-2" name="captainJob" id="captainJob">
								<option value="<?php echo $captainJob;?>" selected><?php echo $captainJob;?></option>
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
								<option value="<?php echo $captainTitle;?>" selected><?php echo $captainTitle;?></option>
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
								<option value="<?php echo $captainYear;?>" selected><?php echo $captainYear;?></option>
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
				
			<div class="mx-auto text-center mt-5">
					<button type="button" class="btn btn-success" id="captainEditButton" onclick="captainEdit()">新增／修改</button>
					<br>
					<br>
					<span id="captainMsg"></span>
			</div>
			</form>
		</div>
			
		<div class="tab-pane fade" id="member1Profile" role="tabpanel" aria-labelledby="nav-profile-tab">
			<form class="form-group form-control" name="member1SignupForm" autocomplete="off">
				
			<div class="row mt-2">
				<div class="col-xl-3">
					姓名：<input type="text" class="form-group form-control mx-auto text-center" name="member1Name" id="member1Name" value="<?php echo $member1Name;?>" placeholder="<?php echo $member1Name;?>">
				</div>
				<div class="col-xl-3">
					稱謂：<select class="custom-select mr-sm-2" id="member1Sex">
							<option value="<?php echo $member1Sex;?>" selected><?php echo $member1Sex;?></option>
							<option value="先生">先生</option>
							<option value="女士">女士</option>
						</select>
				</div>
				<div class="col-xl-3">
					身份證字號：<input type="text" class="form-group form-control mx-auto text-center" name="member1ID" id="member1ID" value="<?php echo $member1ID;?>" placeholder="<?php echo $member1ID;?>">
				</div>
				<div class="col-xl-3">
					生日：<span class="text-secondary" style="font-size: 8px">(ex:2000-01-01或點選日曆)</span><input type="text" class="form-group form-control mx-auto text-center datepicker" name="member1Birth" id="member1Birth" value="<?php echo $member1Birth;?>" placeholder="<?php echo $member1Birth;?>">
				</div>
			</div>
				
			<div class="row">
				<div class="col-xl-4">
					行動電話：<span class="text-secondary" style="font-size: 8px">(ex:0987654321)</span><input type="text" class="form-group form-control mx-auto text-center" name="member1Phone" id="member1Phone" value="<?php echo $member1Phone;?>" placeholder="<?php echo $member1Phone;?>">
				</div>
				<div class="col-xl-8">
					E-Mail：<span class="text-secondary" style="font-size: 8px">(建議使用Gmail以確保收到競賽相關通知)</span><input type="text" class="form-group form-control mx-auto text-center" name="member1Email" id="member1Email" value="<?php echo $member1Email;?>" placeholder="<?php echo $member1Email;?>">
				</div>
			</div>
				
			<div class="row">
				<div class="col-xl-3">
					通訊地址-城市：<select name="member1City" class="form-control" id="member1City">
									<option selected value="<?php echo $member1City;?>"><?php echo $member1City;?></option>
								</select>
				</div>
				<div class="col-xl-3">
					通訊地址-行政區：<select class="form-control" name="member1District" id="member1District">
									<option selected value="<?php echo $member1District;?>"><?php echo $member1District;?></option>
								</select>
				</div>
				<div class="col-xl-6">
					通訊地址：<input type="text" class="form-group form-control mx-auto text-center" name="member1Addr" id="member1Addr" value="<?php echo $member1Addr;?>" placeholder="<?php echo $member1Addr;?>">
				</div>
			</div>
				
			<div class="row">
				<div class="col-xl-4">
					服務產業：<select class="custom-select mr-sm-2" name="member1Job" id="member1Job">
								<option value="<?php echo $member1Job;?>" selected><?php echo $member1Job;?></option>
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
								<option value="<?php echo $member1Title;?>" selected><?php echo $member1Title;?></option>
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
								<option value="<?php echo $member1Year;?>" selected><?php echo $member1Year;?></option>
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
				
			<div class="mx-auto text-center mt-5">
					<button type="button" class="btn btn-success" id="member1EditButton" onclick="member1Edit()">新增／修改</button>
					<button type="reset" class="btn btn-danger ml-3" id="member1DeleteButton" onClick="member1Delete()">刪除副手</button>
					<br>
					<br>
					<span id="member1Msg">更換<u>副手</u>前，請先刪除現有<u>副手</u>再進行新增</span>
			</div>
			</form>
		</div>
			
		<div class="tab-pane fade" id="member2Profile" role="tabpanel" aria-labelledby="nav-profile-tab">
			<form class="form-group form-control" name="member2SignupForm" autocomplete="off">
				
			<div class="row mt-2">
				<div class="col-xl-3">
					姓名：<input type="text" class="form-group form-control mx-auto text-center" name="member2Name" id="member2Name" value="<?php echo $member2Name;?>" placeholder="<?php echo $member2Name;?>">
				</div>
				<div class="col-xl-3">
					稱謂：<select class="custom-select mr-sm-2" id="member2Sex">
							<option value="<?php echo $member2Sex;?>" selected><?php echo $member2Sex;?></option>
							<option value="先生">先生</option>
							<option value="女士">女士</option>
						</select>
				</div>
				<div class="col-xl-3">
					身份證字號：<input type="text" class="form-group form-control mx-auto text-center" name="member2ID" id="member2ID" value="<?php echo $member2ID;?>" placeholder="<?php echo $member2ID;?>">
				</div>
				<div class="col-xl-3">
					生日：<span class="text-secondary" style="font-size: 8px">(ex:2000-01-01或點選日曆)</span><input type="text" class="form-group form-control mx-auto text-center datepicker" name="member2Birth" id="member2Birth" value="<?php echo $member2Birth;?>" placeholder="<?php echo $member2Birth;?>">
				</div>
			</div>
				
			<div class="row">
				<div class="col-xl-4">
					行動電話：<span class="text-secondary" style="font-size: 8px">(ex:0987654321)</span><input type="text" class="form-group form-control mx-auto text-center" name="member2Phone" id="member2Phone" value="<?php echo $member2Phone;?>" placeholder="<?php echo $member2Phone;?>">
				</div>
				<div class="col-xl-8">
					E-Mail：<span class="text-secondary" style="font-size: 8px">(建議使用Gmail以確保收到競賽相關通知)</span><input type="text" class="form-group form-control mx-auto text-center" name="member2Email" id="member2Email" value="<?php echo $member2Email;?>" placeholder="<?php echo $member2Email;?>">
				</div>
			</div>
				
			<div class="row">
				<div class="col-xl-3">
					通訊地址-城市：<select name="member2City" class="form-control" id="member2City">
									<option selected value="<?php echo $member2City;?>"><?php echo $member2City;?></option>
								</select>
				</div>
				<div class="col-xl-3">
					通訊地址-行政區：<select class="form-control" name="member2District" id="member2District">
									<option selected value="<?php echo $member2District;?>"><?php echo $member2District;?></option>
								</select>
				</div>
				<div class="col-xl-6">
					通訊地址：<input type="text" class="form-group form-control mx-auto text-center" name="member2Addr" id="member2Addr" value="<?php echo $member2Addr;?>" placeholder="<?php echo $member2Addr;?>">
				</div>
			</div>
				
			<div class="row">
				<div class="col-xl-4">
					服務產業：<select class="custom-select mr-sm-2" name="member2Job" id="member2Job">
								<option value="<?php echo $member2Job;?>" selected><?php echo $member2Job;?></option>
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
								<option value="<?php echo $member2Title;?>" selected><?php echo $member2Title;?></option>
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
								<option value="<?php echo $member2Year;?>" selected><?php echo $member2Year;?></option>
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
				
			<div class="mx-auto text-center mt-5">
					<button type="button" class="btn btn-success" id="member2EditButton" onclick="member2Edit()">新增／修改</button>
					<button type="reset" class="btn btn-danger ml-3" id="member2DeleteButton" onClick="member2Delete()">刪除隊員</button>
					<br>
					<br>
					<span id="member2Msg">更換<u>隊員</u>前，請先刪除現有<u>隊員</u>再進行新增</span>
			</div>
			</form>
		</div>
			
		</div>
<a name="ECPayPayWay" id="ECPayPayWay"></a>
	</div>
</section>

<!-- 大專組隊伍資訊 -->
<section class="price_area p_120" id="competCollegeInfo">
	<div class="container">
		<div class="mx-auto text-center pb-3">
			<p class="h1">競賽專區</a></p>
			<p class="h2 pt-2" id="CGdownloadFiles">
				<a href="#editInfo" class="downloadPDF actMethod" id="actMethod" data-toggle="tooltip" data-placement="top" title="活動辦法"><i class="fas fa-book-reader pr-2"></i></a>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<a href="#editInfo" class="downloadPDF competRules" id="competRules" data-toggle="tooltip" data-placement="top" title="競賽規則"><i class="fas fa-balance-scale pr-2"></i></a>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<a href="#editInfo" class="downloadPDF privacy" id="privacy" data-toggle="tooltip" data-placement="top" title="隱私權保護政策"><i class="fas fa-user-lock pr-2"></i></a>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<a href="https://drive.google.com/file/d/1BU5GuDmnJDXtk7rjaQkbX0i_vcQWsD12/view" class="downloadPDF" target="_blank" data-toggle="tooltip" data-placement="top" title="競賽同意書(未成年者需簽署)"><i class="fas fa-user-shield pr-2"></i></i></a>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<a href="<?php echo $downloadLink; ?>" class="downloadZip" target="_blank" data-toggle="tooltip" data-placement="top" title="競賽案例"><i class="fas fa-file-signature pr-2"></i></a>
			</p>
		</div>
		
		<nav>
		<div class="nav nav-tabs" id="nav-tab" role="tablist">
		<a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#teaminfo-College" role="tab" aria-controls="nav-home" aria-selected="true">隊 伍 資 訊</a>
		<a class="nav-item nav-link ml-3" id="nav-profile-tab" data-toggle="tab" href="#captainProfile-College" role="tab" aria-controls="nav-profile" aria-selected="false">隊 長 資 料</a>
		<a class="nav-item nav-link ml-3" id="nav-contact-tab" data-toggle="tab" href="#member1Profile-College" role="tab" aria-controls="nav-contact" aria-selected="false">副 手 資 料</a>
		<a class="nav-item nav-link ml-3" id="nav-contact-tab" data-toggle="tab" href="#member2Profile-College" role="tab" aria-controls="nav-contact" aria-selected="false">隊 員 資 料</a>
		</div>
		</nav>
		
		<div class="tab-content" id="nav-tabContent">
			
		<div class="tab-pane fade show active" id="teaminfo-College" role="tabpanel" aria-labelledby="nav-home-tab">
			<form class="form-group form-control" name="teamInfoForm" autocomplete="off">
				
				<div class="row mt-2">
					<div class="col-xl-2">
						指導老師：<input type="text" class="form-group form-control mx-auto text-center" name="teacherName" id="teacherName" value="<?php echo $teacherName; ?>" placeholder="<?php echo $teacherName; ?>" disabled>
					</div>
					<div class="col-xl-2">
						競賽分區：<input type="text" class="form-group form-control mx-auto text-center" name="schoolDistrict" id="schoolDistrict" value="<?php echo $schoolDistrict; ?>" placeholder="<?php echo $schoolDistrict; ?>" disabled>
					</div>
					<div class="col-xl-8">
						代表學校：<input type="text" class="form-group form-control mx-auto text-center" name="schoolPre" id="schoolPre" value="<?php echo $schoolPre; ?>" placeholder="<?php echo $schoolPre; ?>" disabled>
					</div>
				</div>
				
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
				
				<div class="row mt-2">
					<div class="col-xl-3">
						報名費用：<input type="text" class="form-group form-control mx-auto text-center" name="amount" id="amount" value="<?php echo $amount; ?>" placeholder="新台幣 <?php echo $amount; ?> 元整" disabled>
					</div>
					<div class="col-xl-3">
						繳費狀態：<input type="text" class="form-group form-control mx-auto text-center" name="payStatus" id="payStatus" value="<?php echo $payStatus; ?>" placeholder="<?php echo $payStatus; ?>" disabled>
					</div>
					<div class="col-xl-3">
						繳費方式：<input type="text" class="form-group form-control mx-auto text-center" name="payWay" id="payWay" value="<?php echo $payWay; ?>" placeholder="<?php echo $payWay; ?>" disabled>
					</div>
					<div class="col-xl-3">
						繳費期限：<input type="text" class="form-group form-control mx-auto text-center" name="ExpireDate" id="ExpireDate" value="<?php echo $ExpireDate; ?>" placeholder="<?php echo $ExpireDate; ?>" disabled>
					</div>
				</div>
				
				<div class="row mt-2">
					<div class="col-xl-3">
						ATM銀行代碼：<input type="text" class="form-group form-control mx-auto text-center" name="BankCode" id="BankCode" value="<?php echo $BankCode; ?>" placeholder="<?php echo $BankCode; ?>" disabled>
					</div>
					<div class="col-xl-3">
						ATM繳費帳號：<input type="text" class="form-group form-control mx-auto text-center" name="vAccount" id="vAccount" value="<?php echo $vAccount; ?>" placeholder="<?php echo $vAccount; ?>" disabled>
					</div>
					<div class="col-xl-3">
						超商繳費代碼：<input type="text" class="form-group form-control mx-auto text-center" name="PaymentNO" id="PaymentNO" value="<?php echo $PaymentNO; ?>" placeholder="<?php echo $PaymentNO; ?>" disabled>
					</div>
					<div class="col-xl-3">
						繳費日期：<input type="text" class="form-group form-control mx-auto text-center" name="payTime" id="payTime" value="<?php echo $payTime; ?>" placeholder="<?php echo $payTime; ?>" disabled>
					</div>
				</div>
				
				<div class="row mt-2">
					<div class="col-xl-3">
						初賽報告：<input type="text" class="form-group form-control mx-auto text-center" name="report1" id="report1" value="<?php echo $report1; ?>" placeholder="<?php echo $report1; ?>" disabled>
					</div>
					<div class="col-xl-3">
						初賽成績：<input type="text" class="form-group form-control mx-auto text-center" name="score1" id="score1" value="<?php echo $score1; ?>" placeholder="<?php echo $score1; ?>" disabled>
					</div>
					<div class="col-xl-3">
						決賽報告：<input type="text" class="form-group form-control mx-auto text-center" name="report2" id="report2" value="<?php echo $report2; ?>" placeholder="<?php echo $report2; ?>" disabled>
					</div>
					<div class="col-xl-3">
						決賽成績：<input type="text" class="form-group form-control mx-auto text-center" name="score2" id="score2" value="<?php echo $score2; ?>" placeholder="<?php echo $score2; ?>" disabled>
					</div>
				</div>
				
			<div class="mx-auto text-center mt-5">
					<button type="button" class="btn btn-danger" id="delSignup" onClick="signupAbortCollege()">取消報名</button>
					<br>
					<br>
			</div>
		
			</form>
		</div>
			
		<div class="tab-pane fade" id="captainProfile-College" role="tabpanel" aria-labelledby="nav-profile-tab">
			<form class="form-group form-control" name="captainSignupForm" autocomplete="off">
				
			<div class="row mt-2">
				<div class="col-xl-3">
					姓名：<input type="text" class="form-group form-control mx-auto text-center" name="captainName-College" id="captainName-College" value="<?php echo $captainName;?>" placeholder="<?php echo $captainName;?>" disabled>
				</div>
				<div class="col-xl-3">
					稱謂：<select class="custom-select mr-sm-2" id="captainSex-College">
							<option value="<?php echo $captainSex;?>" selected><?php echo $captainSex;?></option>
							<option value="先生">先生</option>
							<option value="女士">女士</option>
						</select>
				</div>
				<div class="col-xl-3">
					身份證字號：<input type="text" class="form-group form-control mx-auto text-center" name="captainID-College" id="captainID-College" value="<?php echo $captainID;?>" placeholder="<?php echo $captainID;?>" disabled>
				</div>
				<div class="col-xl-3">
					生日：<span class="text-secondary" style="font-size: 8px">(ex:2000-01-01或點選日曆)</span><input type="text" class="form-group form-control mx-auto text-center datepicker" name="captainBirth-College" id="captainBirth-College" value="<?php echo $captainBirth;?>" placeholder="<?php echo $captainBirth;?>">
				</div>
			</div>
				
			<div class="row">
				<div class="col-xl-4">
					行動電話：<span class="text-secondary" style="font-size: 8px">(ex:0987654321)</span><input type="text" class="form-group form-control mx-auto text-center" name="captainPhone-College" id="captainPhone-College" value="<?php echo $captainPhone;?>" placeholder="<?php echo $captainPhone;?>">
				</div>
				<div class="col-xl-8">
					E-Mail：<span class="text-secondary" style="font-size: 8px">(建議使用Gmail以確保收到競賽相關通知)</span><input type="text" class="form-group form-control mx-auto text-center" name="captainEmail-College" id="captainEmail-College" value="<?php echo $captainEmail;?>" placeholder="<?php echo $captainEmail;?>" disabled>
				</div>
			</div>
		
			<div class="row">
				<div class="col-xl-3">
					通訊地址-城市：<select name="captainCity-College" class="form-control" id="captainCity-College">
									<option><?php echo $captainCity;?></option>
								</select>
				</div>
				<div class="col-xl-3">
					通訊地址-行政區：<select class="form-control" name="captainDistrict-College" id="captainDistrict-College">
									<option><?php echo $captainDistrict;?></option>
								</select>
				</div>
				<div class="col-xl-6">
					通訊地址：<input type="text" class="form-group form-control mx-auto text-center" name="captainAddr-College" id="captainAddr-College" value="<?php echo $captainAddr;?>" placeholder="<?php echo $captainAddr;?>">
				</div>
			</div>

			<div class="row">
				<div class="col-xl-3">
					院所：<select name="captainCollege" class="form-control" id="captainCollege">
							<option><?php echo $captainCollege; ?></option>
						 </select>
				</div>
				<div class="col-xl-5">
					科系：<select name="captainDepart" class="form-control" id="captainDepart">
							<option><?php echo $captainDepart; ?></option>
						 </select>
				</div>
				<div class="col-xl-2">
					學位：<select name="captainDegree" class="form-control" id="captainDegree">
							<option><?php echo $captainDegree; ?></option>
							<option value="五專">五專</option>
							<option value="二專">二專</option>
							<option value="四技">四技</option>
							<option value="二技">二技</option>
							<option value="學士">學士</option>
							<option value="碩士">碩士</option>
							<option value="博士">博士</option>
						</select>
				</div>
				<div class="col-xl-2">
					年級：<select name="captainGrade" class="form-control" id="captainGrade">
							<option><?php echo $captainGrade; ?></option>
							<option value="一年級">一年級</option>
							<option value="二年級">二年級</option>
							<option value="三年級">三年級</option>
							<option value="四年級">四年級</option>
							<option value="五年級">五年級</option>
							<option value="六年級">六年級</option>
							<option value="七年級">七年級</option>
						</select>
				</div>
			</div>

			<div class="mx-auto text-center mt-5">
					<button type="button" class="btn btn-success" id="captainEditButton-College" onclick="captainEditCollege()">新增／修改</button>
					<br>
					<br>
					<span id="captainMsg-College"></span>
			</div>
			</form>
		</div>
			
		<div class="tab-pane fade" id="member1Profile-College" role="tabpanel" aria-labelledby="nav-profile-tab">
			<form class="form-group form-control" name="member1SignupForm" autocomplete="off">
				
			<div class="row mt-2">
				<div class="col-xl-3">
					姓名：<input type="text" class="form-group form-control mx-auto text-center" name="member1Name-College" id="member1Name-College" value="<?php echo $member1Name;?>" placeholder="<?php echo $member1Name;?>">
				</div>
				<div class="col-xl-3">
					稱謂：<select class="custom-select mr-sm-2" id="member1Sex-College">
							<option value="<?php echo $member1Sex;?>" selected><?php echo $member1Sex;?></option>
							<option value="先生">先生</option>
							<option value="女士">女士</option>
						</select>
				</div>
				<div class="col-xl-3">
					身份證字號：<input type="text" class="form-group form-control mx-auto text-center" name="member1ID-College" id="member1ID-College" value="<?php echo $member1ID;?>" placeholder="<?php echo $member1ID;?>">
				</div>
				<div class="col-xl-3">
					生日：<span class="text-secondary" style="font-size: 8px">(ex:2000-01-01或點選日曆)</span><input type="text" class="form-group form-control mx-auto text-center datepicker" name="member1Birth-College" id="member1Birth-College" value="<?php echo $member1Birth;?>" placeholder="<?php echo $member1Birth;?>">
				</div>
			</div>
				
			<div class="row">
				<div class="col-xl-4">
					行動電話：<span class="text-secondary" style="font-size: 8px">(ex:0987654321)</span><input type="text" class="form-group form-control mx-auto text-center" name="member1Phone-College" id="member1Phone-College" value="<?php echo $member1Phone;?>" placeholder="<?php echo $member1Phone;?>">
				</div>
				<div class="col-xl-8">
					E-Mail：<span class="text-secondary" style="font-size: 8px">(建議使用Gmail以確保收到競賽相關通知)</span><input type="text" class="form-group form-control mx-auto text-center" name="member1Email-College" id="member1Email-College" value="<?php echo $member1Email;?>" placeholder="<?php echo $member1Email;?>">
				</div>
			</div>
				
			<div class="row">
				<div class="col-xl-3">
					通訊地址-城市：<select name="member1City-College" class="form-control" id="member1City-College">
									<option><?php echo $member1City;?></option>
								</select>
				</div>
				<div class="col-xl-3">
					通訊地址-行政區：<select class="form-control" name="member1District-College" id="member1District-College">
									<option><?php echo $member1District;?></option>
								</select>
				</div>
				<div class="col-xl-6">
					通訊地址：<input type="text" class="form-group form-control mx-auto text-center" name="member1Addr-College" id="member1Addr-College" value="<?php echo $member1Addr;?>" placeholder="<?php echo $member1Addr;?>">
				</div>
			</div>

			<div class="row">
				<div class="col-xl-3">
					院所：<select name="member1College" class="form-control" id="member1College">
							<option id="member1CollegeOption"><?php echo $member1College; ?></option>
						 </select>
				</div>
				<div class="col-xl-5">
					科系：<select name="member1Depart" class="form-control" id="member1Depart">
							<option id="member1DepartOption"><?php echo $member1Depart; ?></option>
						 </select>
				</div>
				<div class="col-xl-2">
					學位：<select name="member1Degree" class="form-control" id="member1Degree">
							<option id="member1DegreeOption"><?php echo $member1Degree; ?></option>
							<option value="五專">五專</option>
							<option value="二專">二專</option>
							<option value="四技">四技</option>
							<option value="二技">二技</option>
							<option value="學士">學士</option>
							<option value="碩士">碩士</option>
							<option value="博士">博士</option>
						</select>
				</div>
				<div class="col-xl-2">
					年級：<select name="member1Grade" class="form-control" id="member1Grade">
							<option id="member1GradeOption"><?php echo $member1Grade; ?></option>
							<option value="一年級">一年級</option>
							<option value="二年級">二年級</option>
							<option value="三年級">三年級</option>
							<option value="四年級">四年級</option>
							<option value="五年級">五年級</option>
							<option value="六年級">六年級</option>
							<option value="七年級">七年級</option>
						</select>
				</div>
			</div>
				
			<div class="mx-auto text-center mt-5">
					<button type="button" class="btn btn-success" id="member1EditButton-College" onclick="member1EditCollege()">新增／修改</button>
					<button type="reset" class="btn btn-danger ml-3" id="member1DeleteButton-College" onClick="member1DeleteCollege()">刪除副手</button>
					<br>
					<br>
					<span id="member1Msg-College">更換<u>副手</u>前，請先刪除現有<u>副手</u>再進行新增</span>
			</div>
			</form>
		</div>
			
		<div class="tab-pane fade" id="member2Profile-College" role="tabpanel" aria-labelledby="nav-profile-tab">
			<form class="form-group form-control" name="member2SignupForm" autocomplete="off">
				
			<div class="row mt-2">
				<div class="col-xl-3">
					姓名：<input type="text" class="form-group form-control mx-auto text-center" name="member2Name-College" id="member2Name-College" value="<?php echo $member2Name;?>" placeholder="<?php echo $member2Name;?>">
				</div>
				<div class="col-xl-3">
					稱謂：<select class="custom-select mr-sm-2" id="member2Sex-College">
							<option value="<?php echo $member2Sex;?>" selected><?php echo $member2Sex;?></option>
							<option value="先生">先生</option>
							<option value="女士">女士</option>
						</select>
				</div>
				<div class="col-xl-3">
					身份證字號：<input type="text" class="form-group form-control mx-auto text-center" name="member2ID-College" id="member2ID-College" value="<?php echo $member2ID;?>" placeholder="<?php echo $member2ID;?>">
				</div>
				<div class="col-xl-3">
					生日：<span class="text-secondary" style="font-size: 8px">(ex:2000-01-01或點選日曆)</span><input type="text" class="form-group form-control mx-auto text-center datepicker" name="member2Birth-College" id="member2Birth-College" value="<?php echo $member2Birth;?>" placeholder="<?php echo $member2Birth;?>">
				</div>
			</div>
				
			<div class="row">
				<div class="col-xl-4">
					行動電話：<span class="text-secondary" style="font-size: 8px">(ex:0987654321)</span><input type="text" class="form-group form-control mx-auto text-center" name="member2Phone-College" id="member2Phone-College" value="<?php echo $member2Phone;?>" placeholder="<?php echo $member2Phone;?>">
				</div>
				<div class="col-xl-8">
					E-Mail：<span class="text-secondary" style="font-size: 8px">(建議使用Gmail以確保收到競賽相關通知)</span><input type="text" class="form-group form-control mx-auto text-center" name="member2Email-College" id="member2Email-College" value="<?php echo $member2Email;?>" placeholder="<?php echo $member2Email;?>">
				</div>
			</div>
				
			<div class="row">
				<div class="col-xl-3">
					通訊地址-城市：<select name="member2City-College" class="form-control" id="member2City-College">
									<option selected value="<?php echo $member2City;?>"><?php echo $member2City;?>縣市</option>
								</select>
				</div>
				<div class="col-xl-3">
					通訊地址-行政區：<select class="form-control" name="member2District-College" id="member2District-College">
									<option selected value="<?php echo $member2District;?>"><?php echo $member2District;?>鄉鎮市區</option>
								</select>
				</div>
				<div class="col-xl-6">
					通訊地址：<input type="text" class="form-group form-control mx-auto text-center" name="member2Addr-College" id="member2Addr-College" value="<?php echo $member2Addr;?>" placeholder="<?php echo $member2Addr;?>">
				</div>
			</div>

			<div class="row">
				<div class="col-xl-3">
					院所：<select name="member2College" class="form-control" id="member2College">
							<option selected value="<?php echo $member2College; ?>"><?php echo $member2College; ?></option>
						 </select>
				</div>
				<div class="col-xl-5">
					科系：<select name="member2Depart" class="form-control" id="member2Depart">
							<option selected value="<?php echo $member2Depart; ?>"><?php echo $member2Depart; ?></option>
						 </select>
				</div>
				<div class="col-xl-2">
					學位：<select name="member2Degree" class="form-control" id="member2Degree">
							<option selected value="<?php echo $member2Degree; ?>"><?php echo $member2Degree; ?></option>
							<option value="五專">五專</option>
							<option value="二專">二專</option>
							<option value="四技">四技</option>
							<option value="二技">二技</option>
							<option value="學士">學士</option>
							<option value="碩士">碩士</option>
							<option value="博士">博士</option>
						</select>
				</div>
				<div class="col-xl-2">
					年級：<select name="member2Grade" class="form-control" id="member2Grade">
							<option selected value="<?php echo $member2Grade; ?>"><?php echo $member2Grade; ?></option>
							<option value="一年級">一年級</option>
							<option value="二年級">二年級</option>
							<option value="三年級">三年級</option>
							<option value="四年級">四年級</option>
							<option value="五年級">五年級</option>
							<option value="六年級">六年級</option>
							<option value="七年級">七年級</option>
						</select>
				</div>
			</div>
				
			<div class="mx-auto text-center mt-5">
					<button type="button" class="btn btn-success" id="member2EditButton-College" onclick="member2EditCollege()">新增／修改</button>
					<button type="reset" class="btn btn-danger ml-3" id="member2DeleteButton-College" onClick="member2DeleteCollege()">刪除隊員</button>
					<br>
					<br>
					<span id="member2Msg-College">更換<u>隊員</u>前，請先刪除現有<u>隊員</u>再進行新增</span>
			</div>
			</form>
		</div>
			
		</div>
<a name="ECPayPayWay" id="ECPayPayWay"></a>
	</div>
</section>

<!-- KEYs -->
<section class="" style="background-image:url(../img/keysbg05.jpg);background-repeat: no-repeat;background-size:cover;height: 300px;width: 100%;">
	<div class="container">
		<div class="row justify-content-center py-5">
			<div class="col-4">
				<img class="align-middle inline" src="../img/key.png" alt="keys" width="auto" height="180">
			</div>
			<div class="col-8">
				<h1 class="text-info" style="margin-top: 25px;">競賽推薦使用「關鍵理財網-財務決策系統」</h1>
				<button type="button" class="btn btn-info btn-lg mt-2" onClick="goHoldinkeys()">前往關鍵理財網</button>
				<div><small class="text-muted">※首次註冊免費使用標準版三個月</small></div>
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
					<h1 class="text-green mb-4 text-center">常見問題(Q&A)</h1>
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
<a href="#" id="gotop">
   <i class="fa fa-angle-up"></i>
</a>



<!-- 測試區 -->
<section class="testimonials_area p_120">
	<div class="container">
		survey : <? echo $surveyNumber; ?><br>
		teamNO : <? echo $teamNO; ?><br><br>
		
		surveyButton : <? echo $surveyButton; ?><br>
		teamDB : <?php echo $teamDB; ?><br>
		memberDB : <?php echo $memberDB; ?><br>
		sqlNUMROWSsurveyFeed：<? echo $sqlNUMROWSsurveyFeed; ?><br><br>
		
		captainCollege : <?php echo $captainCollege; ?><br>
		captainDepart : <?php echo $captainDepart; ?><br>
		captainDegree : <?php echo $captainDegree; ?><br>
		captainGrade : <?php echo $captainGrade; ?><br><br>
		
		member1Name : <?php echo $member1Name; ?><br>
		member1ID : <?php echo $member1ID; ?><br>
		member1Sex : <?php echo $member1Sex; ?><br>
		member1Birthday : <?php echo $member1Birth; ?><br>
		member1Phone : <?php echo $member1Phone; ?><br>
		member1Email : <?php echo $member1Email; ?><br>
		member1City : <?php echo $member1City; ?><br>
		member1District : <?php echo $member1District; ?><br>
		member1Addr : <?php echo $member1Addr; ?><br>
		member1CombineAddr : <?php echo $member1CombineAddr; ?><br>
		member1College : <?php echo $member1College; ?><br>
		member1Depart : <?php echo $member1Depart; ?><br>
		member1Degree : <?php echo $member1Degree; ?><br>
		member1Grade : <?php echo $member1Grade; ?><br>
		member1Remarks : <?php echo $member1Remarks; ?><br>
	</div>
</section>



<!-- 隱藏表單 -->
<div>
	<!-- hidden PHP Time Value-->
	<input type="hidden" name="schoolID" id="schoolID" Value="<?php echo $schoolID; ?>">  <!-- 學校ID -->
	<input type="hidden" name="dataEditSwitch" id="dataEditSwitch" Value="<?php echo $editButton; ?>">  <!-- 編輯資料 -->
	<input type="hidden" name="payButtonSwitch" id="payButtonSwitch" Value="<?php echo $payButton; ?>">  <!-- 取號繳費 -->
	<input type="hidden" name="receiptButtonSwitch" id="receiptButtonSwitch" Value="<?php echo $receiptButton; ?>">  <!-- 編輯資料 -->
	<input type="hidden" name="surveyButtonSwitch" id="surveyButtonSwitch" Value="<?php echo $surveyButton; ?>">  <!-- 問卷比對 FALSE未作 TRUE已完成 -->
	<input type="hidden" name="uploadButtonSwitch" id="uploadButtonSwitch" Value="<?php echo $uploadButton; ?>">  <!-- 上傳檔案 -->
	<input type="hidden" name="report1Switch" id="report1Switch" Value="<?php echo $report1Upload; ?>">  <!-- 初賽報告上傳 -->
	<input type="hidden" name="report2Switch" id="report2Switch" Value="<?php echo $report2Upload; ?>">  <!-- 決賽報告上傳 -->
	<input type="hidden" name="fileDownload02" id="fileDownload02" Value="<?php echo $fileDownload02; ?>">  <!-- 決賽報告上傳 -->
	<input type="hidden" name="teamDB" id="teamDB" Value="<?php echo $teamDB; ?>">
	<input type="hidden" name="memberDB" id="memberDB" Value="<?php echo $memberDB; ?>">
	<input type="hidden" name="projectNO" id="projectNO" Value="<?php echo $projectNO; ?>">
	<input type="hidden" name="competInfo" id="competInfoSwitch" Value="<?php echo $competInfo; ?>">

	<!-- hidden receiptForm -->
	<form name="receiptForm" method="post" action="" id="receiptForm" target="_blank">
	<input type="hidden" name="receiptNO" id="receiptNO" Value="<?php echo $receiptNO; ?>">
	<input type="hidden" name="receiptSchool" id="receiptSchool" Value="<?php echo $schoolPre; ?>">
	<input type="hidden" name="receiptTeamName" id="receiptTeamName" Value="<?php echo $teamName; ?>">
	<input type="hidden" name="receiptTeamNO" id="receiptTeamNO" Value="<?php echo $teamNO; ?>">
	<input type="hidden" name="receiptProjectName" id="receiptProjectName" Value="<?php echo $projectName; ?>">
	<input type="hidden" name="receiptMN" id="receiptMN" Value="<?php echo $amount; ?>">
	<input type="hidden" name="receiptTPayTime" id="receiptTPayTime" Value="<?php echo $payTime; ?>">
	<input type="hidden" name="receiptCaptainName" id="receiptCaptainName" Value="<?php echo $captainName; ?>">
	<input type="hidden" name="receiptMember1Name" id="receiptMember1Name" Value="<?php echo $member1Name; ?>">
	<input type="hidden" name="receiptMember2Name" id="receiptMember2Name" Value="<?php echo $member2Name; ?>">
	</form>

	<!-- hidden proveForm -->
	<form name="proveForm" method="post" action="" id="proveForm" target="_blank">
	<input type="hidden" name="proveSchool" id="proveSchool" Value="<?php echo $schoolPre; ?>">
	<input type="hidden" name="proveCaptainName" id="proveCaptainName" Value="<?php echo $captainName; ?>">
	<input type="hidden" name="proveMember1Name" id="proveMember1Name" Value="<?php echo $member1Name; ?>">
	<input type="hidden" name="proveMember2Name" id="proveMember2Name" Value="<?php echo $member2Name; ?>">
	<input type="hidden" name="proveProjectName" id="proveProjectName" Value="<?php echo $projectName; ?>">
	<input type="hidden" name="proveTeamNO" id="proveTeamNO" Value="<?php echo $teamNO; ?>">
	<input type="hidden" name="proveTeamName" id="proveTeamName" Value="<?php echo $teamName; ?>">
	<input type="hidden" name="proveDate" id="proveDate" Value="<?php echo $competStartDate; ?>">
	</form>

	<!-- Hidden progressbar -->
	<input type="hidden" name="progressStep1" id="progressStep1" Value="<?php echo $progressStep1; ?>">
	<input type="hidden" name="progressStep2" id="progressStep2" Value="<?php echo $progressStep2; ?>">
	<input type="hidden" name="progressStep3" id="progressStep3" Value="<?php echo $progressStep3; ?>">
	<input type="hidden" name="progressStep4" id="progressStep4" Value="<?php echo $progressStep4; ?>">
	<input type="hidden" name="progressStep5" id="progressStep5" Value="<?php echo $progressStep5; ?>">
	<input type="hidden" name="GG30" id="GG30" Value="<?php echo $GG30; ?>">
</div>

<?php require_once("../model/index_footer.php"); ?>
<?php require_once("../model/index_js.php"); ?>

<!--<script src="../lumino/js/bootstrap.min.js"></script>-->
<script type="text/javascript" src="../controller/waitload.js"></script>
<script type="text/javascript" src="../controller/index_nav.js"></script>
<script type="text/javascript" src="../controller/toggle_tooltip.js"></script>
<!-- nexus JS -->
<script src="../nexus/vendors/owl-carousel/owl.carousel.min.js"></script>
<script type="text/javascript" src="../controller/datepicker.js"></script>
<script type="text/javascript" src="../controller/zipcode.js"></script>
<script type="text/javascript" src="../controller/zipcode2.js"></script>
<script type="text/javascript" src="../controller/Division2.js"></script>
<!-- AJAX Profile Edit -->
<script src="../controller/compet_signupAbort.js"></script>
<script src="../controller/compet_signupAbortCollege.js"></script>
<script src="../controller/compet_captainEdit.js"></script>
<script src="../controller/compet_captainEditCollege.js"></script>
<script src="../controller/compet_member1Edit.js"></script>
<script src="../controller/compet_member1EditCollege.js"></script>
<script src="../controller/compet_member2Edit.js"></script>
<script src="../controller/compet_member2EditCollege.js"></script>
<script src="../controller/compet_member1Delete.js"></script>
<script src="../controller/compet_member1DeleteCollege.js"></script>
<script src="../controller/compet_member2Delete.js"></script>
<script src="../controller/compet_member2DeleteCollege.js"></script>


<!-- 偵測禁用行動裝置 -->
<script>
	// 偵測禁用行動裝置
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
</script>

<!-- 表單開放 -->
<script>
	var competInfo = $("#competInfoSwitch").val();
		if (competInfo == "SG"){
			$("#competCollegeInfo").remove();
		}else{
			$("#competSocialInfo").remove();
		}
	var captainCollegeLock = $("#captainCollege").val();
	var member1CollegeLock = $("#member1College").val();
	var member2CollegeLock = $("#member2College").val();
		if (captainCollegeLock != ""){
			  $("#captainCollege").val('<?php echo $captainCollege; ?>');
			}
		if (member1CollegeLock != ""){
			  $("#member1College").val('<?php echo $member1College; ?>');
			}
		if (member2CollegeLock != ""){
			  $("#member2College").val('<?php echo $member2College; ?>');
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
		//取號Button失效
		$(".buttonFail").attr('disabled', 'disabled');
		//取得繳費資訊
		var amount = $("#amount").val();
		var projectNO = $("#projectNO").val();
		var projectName = $("#projectName").val();
		var teamNO = $("#teamNO").val();
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

//報告格式下載
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
var progressStep1 = $("#progressStep1").val();
var progressStep2 = $("#progressStep2").val();
var progressStep3 = $("#progressStep3").val();
var progressStep4 = $("#progressStep4").val();
var progressStep5 = $("#progressStep5").val();
var report1 = '<? echo $report1; ?>';
var score1 = '<? echo $score1; ?>';
var surveyButton = '<? echo $surveyButton; ?>';
var GG30 = $("#GG30").val();
// 報名開始 -> 報名結束 progressStep1
if (progressStep1 === "TRUE"){
//	$("#step1").removeClass();
//	$("#step2").removeClass();
//	$("#step3").removeClass();
//	$("#step4").removeClass();
//	$("#step5").removeClass();
//	$("#step6").removeClass();
	$("#step1").addClass("progress-done progress-current");
	$("#step2").addClass("progress-todo");
	$("#step3").addClass("progress-todo");
	$("#step4").addClass("progress-todo");
	$("#step5").addClass("progress-todo");
	$("#step6").addClass("progress-todo");
	$("#payButton").hide();
	$("#receiptButton").hide();
	$("#surveyButton").hide();
	$("#uploadButton").hide();
	$("#proveButton").hide();
	
}
// 報名結束 -> 繳費開始 progressStep2
if (progressStep2 === "TRUE"){
//	$("#step1").removeClass();
//	$("#step2").removeClass();
//	$("#step3").removeClass();
//	$("#step4").removeClass();
//	$("#step5").removeClass();
//	$("#step6").removeClass();
	$("#step1").addClass("progress-done");
	$("#step2").addClass("progress-done");
	$("#step3").addClass("progress-todo");
	$("#step4").addClass("progress-todo");
	$("#step5").addClass("progress-todo");
	$("#step6").addClass("progress-todo");
//	$("#dataEditButton").hide();
		//關閉社會編輯功能
		$("#delSignup").hide();
		$("#captainEditButton").hide();
		$("#member1EditButton").hide();
		$("#member1DeleteButton").hide();
		$("#member2EditButton").hide();
		$("#member2DeleteButton").hide();
		$("#member2DeleteButton").hide();
		$("#member1Msg").hide();
		$("#member2Msg").hide();
		//關閉大專編輯功能
		$("#delSignup-College").hide();
		$("#captainEditButton-College").hide();
		$("#member1EditButton-College").hide();
		$("#member1DeleteButton-College").hide();
		$("#member2EditButton-College").hide();
		$("#member2DeleteButton-College").hide();
		$("#member1Msg-College").hide();
		$("#member2Msg-College").hide();
	$("#uploadButton").hide();
	$("#proveButton").hide();
}
// 繳費開始 -> 繳費結束 progressStep3
if (progressStep3 === "TRUE"){
//	$("#step1").removeClass();
//	$("#step2").removeClass();
//	$("#step3").removeClass();
//	$("#step4").removeClass();
//	$("#step5").removeClass();
//	$("#step6").removeClass();
	$("#step1").addClass("progress-done");
	$("#step2").addClass("progress-done");
	$("#step3").addClass("progress-done progress-current");
	$("#step4").addClass("progress-todo");
	$("#step5").addClass("progress-todo");
	$("#step6").addClass("progress-todo");
//	$("#dataEditButton").hide();
		//關閉社會編輯功能
		$("#delSignup").hide();
		$("#captainEditButton").hide();
		$("#member1EditButton").hide();
		$("#member1DeleteButton").hide();
		$("#member2EditButton").hide();
		$("#member2DeleteButton").hide();
		$("#member1Msg").hide();
		$("#member2Msg").hide();
		//關閉大專編輯功能
		$("#delSignup-College").hide();
		$("#captainEditButton-College").hide();
		$("#member1EditButton-College").hide();
		$("#member1DeleteButton-College").hide();
		$("#member2EditButton-College").hide();
		$("#member2DeleteButton-College").hide();
		$("#member1Msg-College").hide();
		$("#member2Msg-College").hide();
		
		//無繳費者關閉檔案上傳按鈕及問卷按鈕
		var payStatus = $("#payStatus").val();
		if ( payStatus != "繳費完成" ){
			$("#uploadButton").hide();
			$("#surveyButton").hide();
		}	

	// 已上傳初賽報告 且完成問卷
	if ( (report1 === "已繳交") && (score1 === "入圍") && (surveyButton === "TRUE") ){
		// 隱藏問卷按鈕 開放參賽證明
		$("#surveyButton").hide();

			// 除此之外
		}else if ( (report1 === "已繳交") && (score1 === "") && (surveyButton === "TRUE") ){
			$("#surveyButton").hide();
			$("#uploadButton").hide();
		}else{
			$("#proveButton").hide();
			$("#surveyButton").hide();
			$("#uploadButton").hide();
		}
	
}
// 繳費結束 -> 初賽報告繳交截止 progressStep4

if (progressStep4 === "TRUE"){
//	$("#step1").removeClass();
//	$("#step2").removeClass();
//	$("#step3").removeClass();
//	$("#step4").removeClass();
//	$("#step5").removeClass();
//	$("#step6").removeClass();
	$("#step1").addClass("progress-done");
	$("#step2").addClass("progress-done");
	$("#step3").addClass("progress-done");
	$("#step4").addClass("progress-done");
	$("#step5").addClass("progress-done progress-current");
	$("#step6").addClass("progress-todo");
//	$("#dataEditButton").hide();
		//關閉社會編輯功能
		$("#delSignup").hide();
		$("#captainEditButton").hide();
		$("#member1EditButton").hide();
		$("#member1DeleteButton").hide();
		$("#member2EditButton").hide();
		$("#member2DeleteButton").hide();
		$("#member1Msg").hide();
		$("#member2Msg").hide();
		//關閉大專編輯功能
		$("#delSignup-College").hide();
		$("#captainEditButton-College").hide();
		$("#member1EditButton-College").hide();
		$("#member1DeleteButton-College").hide();
		$("#member2EditButton-College").hide();
		$("#member2DeleteButton-College").hide();
	$("#payButton").hide();

	//無繳費者關閉檔案上傳按鈕及問卷按鈕
	var payStatus = $("#payStatus").val();
	if ( payStatus != "繳費完成" ){
		$("#uploadButton").hide();
		$("#surveyButton").hide();
	}	

	// 已上傳初賽報告 且完成問卷
	if ( (report1 === "已繳交") && (score1 === "入圍") && (surveyButton === "TRUE") ){
		// 隱藏問卷按鈕 開放參賽證明
		$("#surveyButton").hide();

			// 除此之外
		}else if ( (report1 === "已繳交") && (score1 === "") && (surveyButton === "TRUE") ){
			$("#surveyButton").hide();
			$("#uploadButton").hide();
		}else{
			$("#proveButton").hide();
			$("#surveyButton").hide();
			$("#uploadButton").hide();
		}
	
	$("#report2Button").hide();
	$("#report3Button").hide();
	

}
	
// 初賽報告繳交截止 -> 決賽報告繳交截止 progressStep5
var competInfoSwitch = $("#competInfoSwitch").val();
if (progressStep5 === "TRUE"){
//	$("#step1").removeClass();
//	$("#step2").removeClass();
//	$("#step3").removeClass();
//	$("#step4").removeClass();
//	$("#step5").removeClass();
//	$("#step6").removeClass();
	$("#step1").addClass("progress-done");
	$("#step2").addClass("progress-done");
	$("#step3").addClass("progress-done");
	$("#step4").addClass("progress-done");
	$("#step5").addClass("progress-done");
	$("#step6").addClass("progress-done progress-current");
//	$("#dataEditButton").hide();
		//關閉社會編輯功能
		$("#delSignup").hide();
		$("#captainEditButton").hide();
		$("#member1EditButton").hide();
		$("#member1DeleteButton").hide();
		$("#member2EditButton").hide();
		$("#member2DeleteButton").hide();
		$("#member1Msg").hide();
		$("#member2Msg").hide();
		//關閉大專編輯功能
		$("#delSignup-College").hide();
		$("#captainEditButton-College").hide();
		$("#member1EditButton-College").hide();
		$("#member1DeleteButton-College").hide();
		$("#member2EditButton-College").hide();
		$("#member2DeleteButton-College").hide();
		$("#member1Msg-College").hide();
		$("#member2Msg-College").hide();
	
	$("#payButton").hide();
	$("#report1Button").hide();
	
	if (report1 === ""){
		$("#uploadButton").hide();
	}
	//如果隊伍不為SG, 關閉決賽上傳報告按鈕
	if (competInfoSwitch != "SG"){
		$("#report2Button").hide();
	}
	//無繳費者關閉檔案上傳按鈕及問卷按鈕
	var payStatus = $("#payStatus").val();
	if ( payStatus != "繳費完成" ){
		$("#uploadButton").hide();
		$("#surveyButton").hide();
	}	

	// 已上傳初賽報告 且完成問卷
	if ( (report1 === "已繳交") && (score1 === "入圍") && (surveyButton === "TRUE") ){
		// 隱藏問卷按鈕 開放參賽證明
		$("#surveyButton").hide();

			// 除此之外
		}else if ( (report1 === "已繳交") && (score1 === "") && (surveyButton === "TRUE") ){
			$("#surveyButton").hide();
			$("#uploadButton").hide();
		}else{
			$("#proveButton").hide();
			$("#surveyButton").hide();
			$("#uploadButton").hide();
		}
}
// 決賽報告結束 progressStep6
if (GG30 === "TRUE"){
//	$("#step1").removeClass();
//	$("#step2").removeClass();
//	$("#step3").removeClass();
//	$("#step4").removeClass();
//	$("#step5").removeClass();
//	$("#step6").removeClass();
	$("#step1").addClass("progress-done");
	$("#step2").addClass("progress-done");
	$("#step3").addClass("progress-done");
	$("#step4").addClass("progress-done");
	$("#step5").addClass("progress-done");
	$("#step6").addClass("progress-done");
//	$("#dataEditButton").hide();
		//關閉社會編輯功能
		$("#delSignup").hide();
		$("#captainEditButton").hide();
		$("#member1EditButton").hide();
		$("#member1DeleteButton").hide();
		$("#member2EditButton").hide();
		$("#member2DeleteButton").hide();
		$("#member1Msg").hide();
		$("#member2Msg").hide();
		//關閉大專編輯功能
		$("#delSignup-College").hide();
		$("#captainEditButton-College").hide();
		$("#member1EditButton-College").hide();
		$("#member1DeleteButton-College").hide();
		$("#member2EditButton-College").hide();
		$("#member2DeleteButton-College").hide();
		$("#member1Msg-College").hide();
		$("#member2Msg-College").hide();
	
	// 已上傳初賽報告 且完成問卷
	if ( (report1 === "已繳交") && (surveyButton === "TRUE") ){
		// 隱藏問卷按鈕 開放參賽證明
		$("#surveyButton").hide();

			// 除此之外
		}else if ( (report1 === "") || (surveyButton === "FALSE") ){
			$("#proveButton").hide();
			$("#surveyButton").hide();
		}else{
			$("#proveButton").hide();
			$("#surveyButton").hide();
		}
	
	$("#payButton").hide();
	$("#uploadButton").hide();
//	$("#downloadFiles").hide();
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


<!-- 線上問卷 -->
<script>
	function survey(){
		window.location.href ='https://wmpcca.com/bswmp/form/view/admin_survey_review.php?survey=<? echo $surveyNumber; ?>&teamNO=<? echo $teamNO; ?>';
		
	}
</script>

<!-- 檔案上傳 GoTop -->
<script>
function goHoldinkeys() {
  window.open("https://www.holdingkeys.com");
}
function uploadReport1() {
  window.open("https://wmpcca.com/bswmp/form/view/GDcompetUpload.php");
}
function uploadReport2() {
  window.open("https://wmpcca.com/bswmp/form/view/GDcompetUpload2.php");
}
function uploadReport3() {
  window.open("https://wmpcca.com/bswmp/form/view/GDcompetUpload2.php");
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
	
<!-- Modal actMethod Rules Personal-->
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
					<p class="h6 pl-5">特　優：獎金新台幣 $4,500元整，獎盃一座，獎狀一楨</p>
					<p class="h6 pl-5">優　等：獎金新台幣 $3,000元整，獎狀一楨</p>
					<p class="h6 pl-5">佳　作：獎狀一楨</p>
				<p class="h5 pl-3 pt-2"><strong>全國大專財富管理競賽</strong></p>
					<p class="h6 pl-5">第一名：獎金新台幣$15,000元整，冠軍獎盃一座，獎狀一楨</p>
					<p class="h6 pl-5">第二名：獎金新台幣$12,000元整，亞軍獎盃一座，獎狀一楨</p>
					<p class="h6 pl-5">第三名：獎金新台幣 $9,000元整，季軍獎盃一座，獎狀一楨</p>
					<p class="h6 pl-5">特　優：獎金新台幣 $4,500元整，獎盃一座，獎狀一楨</p>
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
</body>
</html>