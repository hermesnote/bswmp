<?php
//連線資料庫
require_once ("../vender/dbtools.inc.php");

// 設置資料類型 json，編碼格式 utf-8
header('Content-Type: application/json; charset=UTF-8');

//取得今天日期
$todayDate = date("Y-m-d H:i:s");

//取得cookie
$passed = $_COOKIE["passed"];
$account = $_COOKIE["account"];
$staffNO = $_COOKIE["staffNO"];
$staffName = $_COOKIE["staffName"];

// 若cookie中的變數passed不為TRUE，則導回登入頁
if ($passed != "TRUE"){
echo "<script type='text/javascript'>";
echo "alert('COOKIE錯誤!請重新登入！')";
echo "</script>";
header("location:admin_login.php");
exit();
}

//建立回傳參數
$projectNameEmpty = '請選擇欲新增的競賽項目!';
$competStartDateEmpty = '報名開始日為空!';
$competEndDateEmpty = '報名結束日為空!';
$payStartDateEmpty = '繳費起始日為空!';
$payEndDateEmpty = '繳費期限為空!';
$report1DateEPT = '初賽報告截止日為空!';
$report2DateEPT = '初賽報告截止日為空!';
$downloadLinkEPT = '檔案下載連結為空!';
$competStartDateThanToday = '報名開始日期須大於今天';
$competEndDateThanToday = '報名結束日期須大於今天';
$competEndDateThanStartDate = '報名結束日期須大於報名開始日期';
$payStartDateThanToday = '繳費開始日期須大於今天';
$payEndDateThanToday = '繳費結束日期須大於今天';
$payEndDateThanStartDate = '繳費結束日期須大於報名開始日期';
$payStartDateThanCompetEndDate = '繳費開始日期須大於報名結束日期';
$report1DateThancompetEndDate = '初賽截止日不可小於報名截止日';
$report2DateThanreport1Date = '決賽截止日不可小於初賽截止日';
$projectNODNE = '項目已存在';
$projectAdded = '資料已更新！';

//取得今天日期
$todayDate = date("Y-m-d H:i:s");

//取得AJAX傳送值
$projectName = $_POST["projectName"];
	if($projectName == ''){
		echo json_encode($projectNameEmpty);
		exit();
	}

$competStartDate = $_POST["competStartDate"];
	if($competStartDate == ''){
		echo json_encode($competStartDateEmpty);
		exit();
	}

$competEndDate = $_POST["competEndDate"];
	if($competEndDate == ''){
		echo json_encode($competEndDateEmpty);
		exit();
	}

$payStartDate = $_POST["payStartDate"];
	if($payStartDate == ''){
		echo json_encode($payStartDateEmpty);
		exit();
	}

$payEndDate = $_POST["payEndDate"];
	if($payEndDate == ''){
		echo json_encode($payEndDateEmpty);
		exit();
	}

$report1Date = $_POST["report1Date"];
	if($report1Date == ''){
		echo json_encode($report1DateEPT);
		exit();
	}

$report2Date = $_POST["report2Date"];
	if($report2Date == ''){
		echo json_encode($report2DateEPT);
		exit();
	}

$downloadLink = $_POST["downloadLink"];
	if($downloadLink == ''){
		echo json_encode($downloadLinkEPT);
		exit();
	}

//取得競賽開始日年份末兩碼
$competYear =  substr($todayDate, 0, 4);
$competYear1 = $competYear - 2010;
$competYear2 = substr($todayDate, 2, 2);

if ($projectName == 'NCS'){
	$competYear1 = $competYear1-1;
}
if ($projectName == 'HS'){
	$competYear1 = $competYear-2019;
}

if ($competYear1 == 1){
	$TN = '一';
}
if ($competYear1 == 2){
	$TN = '二';
}
if ($competYear1 == 3){
	$TN = '三';
}
if ($competYear1 == 4){
	$TN = '四';
}
if ($competYear1 == 5){
	$TN = '五';
}
if ($competYear1 == 6){
	$TN = '六';
}
if ($competYear1 == 7){
	$TN = '七';
}
if ($competYear1 == 8){
	$TN = '八';
}
if ($competYear1 == 9){
	$TN = '九';
}
if ($competYear1 == 10){
	$TN = '十';
}
if ($competYear1 == 11){
	$TN = '十一';
}
if ($competYear1 == 12){
	$TN = '十二';
}
if ($competYear1 == 13){
	$TN = '十三';
}
if ($competYear1 == 14){
	$TN = '十四';
}
if ($competYear1 == 15){
	$TN = '十五';
}
if ($competYear1 == 16){
	$TN = '十六';
}
if ($competYear1 == 17){
	$TN = '十七';
}
if ($competYear1 == 18){
	$TN = '十八';
}
if ($competYear1 == 19){
	$TN = '十九';
}
if ($competYear1 == 20){
	$TN = '二十';
}
if ($competYear1 == 21){
	$TN = '二十一';
}
if ($competYear1 == 22){
	$TN = '二十二';
}
if ($competYear1 == 23){
	$TN = '二十三';
}
if ($competYear1 == 24){
	$TN = '二十四';
}
if ($competYear1 == 25){
	$TN = '二十五';
}
if ($competYear1 == 26){
	$TN = '二十六';
}
if ($competYear1 == 27){
	$TN = '二十七';
}
if ($competYear1 == 28){
	$TN = '二十八';
}
if ($competYear1 == 29){
	$TN = '二十九';
}
if ($competYear1 == 30){
	$TN = '三十';
}


//產生projectNO代碼
if ($projectName === 'CG') {
	$projectNO = 'CG'.$competYear2;
	$projectName = $competYear.'第'.$TN.'屆'.'全國大專財富管理競賽';
	$amount = '1000';
}
if ($projectName === 'SG') {
	$projectNO = 'SG'.$competYear2;
	$projectName = $competYear.'第'.$TN.'屆'.'全國財富管理競賽';
	$amount = '1500';
}
if ($projectName === 'NCS') {
	$projectNO = 'NCS'.$competYear2;
	$projectName = $competYear.'第'.$TN.'屆'.'全國大專校院北、中、南分區理財規劃案例競賽';
	$amount = '1000';
}
if ($projectName === 'HS') {
	$projectNO = 'HS'.$competYear2;
	$projectName = $competYear.'第'.$TN.'屆'.'全國金融證券投資實務競賽';
	$amount = '300';
}

//對比競賽代碼
$sqlSELECTprojectNO = " SELECT * FROM competList WHERE projectNO = '$projectNO' ";
$sqlRESULTprojectNO = mysql_query($sqlSELECTprojectNO);
$sqlNUMROWSprojectNO = mysql_num_rows($sqlRESULTprojectNO);
if ($sqlNUMROWSprojectNO != 0){
	echo json_encode($projectNODNE);
	exit();
}

//對比競賽開始日期 (大於今日可)
if (strtotime($competStartDate) < strtotime($todayDate)){
	echo json_encode($competStartDateThanToday);
	exit();
}

//對比競賽結束日期 (大於今日)
if (strtotime($competEndDate) < strtotime($todayDate)){
	echo json_encode($competEndDateThanToday);
	exit();
}

//競賽結束日期須大於開始日期
if (strtotime($competEndDate) < strtotime($competStartDate)){
	echo json_encode($competEndDateThanStartDate);
	exit();
}

//對比繳費開始日期 (大於今日可)
if (strtotime($payStartDate) < strtotime($todayDate)){
	echo json_encode($payStartDateThanToday);
	exit();
}

//對比繳費結束日期 (大於今日)
if (strtotime($payEndDate) < strtotime($todayDate)){
	echo json_encode($payEndDateThanToday);
	exit();
}

//繳費結束日期須大於繳費開始日期
if (strtotime($payEndDate) < strtotime($payStartDate)){
	echo json_encode($payEndDateThanStartDate);
	exit();
}

//繳費開始日期須大於報名結束日期
if (strtotime($payStartDate) < strtotime($competEndDate)){
	echo json_encode($payStartDateThanCompetEndDate);
	exit();
}

//初賽截止日期須大於報名截止日期
if (strtotime($report1Date) < strtotime($competEndDate)){
	echo json_encode($report1DateThancompetEndDate);
	exit();
}

//決賽截止日期須大於初賽結束日期
if (strtotime($report2Date) < strtotime($report1Date)){
	echo json_encode($report2DateThanreport1Date);
	exit();
}

//更新competRefer資料庫
	$sqlINSERTcompetProject = "
		INSERT INTO competList ( projectNO, projectName, amount, competStartDate, competEndDate, payStartDate, payEndDate, report1Date, report2Date, downloadLink ) 
		VALUES( '$projectNO', '$projectName', '$amount', '$competStartDate', '$competEndDate', '$payStartDate', '$payEndDate', '$report1Date', '$report2Date', '$downloadLink' )
		";
	$sqlINSERT = mysql_query($sqlINSERTcompetProject, $sqlLink);

//寫入Log
	$file_name = "../log/adminLog.txt"; //檔案名稱
	$file = @file("$file_name"); //讀取檔案
	$open = @fopen("$file_name","a"); //開啟檔案，要是沒有檔案將建立一份
	$log =  "\r\n$todayDate $staffNO 新增了一筆競賽代號 $projectNO";
	@fwrite($open,$log); //寫入資料
	fclose($open); //關閉檔案

//回傳成功訊息
echo json_encode($projectAdded);


?>