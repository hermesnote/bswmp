<?php
//資料庫連線
require_once("../vender/dbtools.inc.php");

// 取得訂單資訊
$orderTime = date("Y-m-d H:i:s");
$projectNO = $_POST["projectNO"];
$projectName = $_POST["projectName"];
$MN = $MN;
$payWay = ""; //由各paid.php更新
$payStatus = "未繳費"; //由各paid.php更新
$eventCode = $eventCode;
//產生訂單編號
$orderNO = $projectNO.substr(date("md"),0,4).substr(date("Hi"),0,4).str_pad(mt_rand(00000, 99999), 5, "0", STR_PAD_LEFT);
//產生隊伍編號
$customerNO = $projectNO.substr(date("d"),0,2).substr(date("s"),0,2).str_pad(mt_rand(0000, 9999), 4, "0", STR_PAD_LEFT);

//取得報名隊伍資訊
$registerTime = $orderTime;
$teamNO = $customerNO;
$teamName = $_POST["teamName"];
$district = $_POST["schoolDistrict"];
$school = $_POST["schoolPre"];
$teacher = $_POST["directTeacher"];
$taxID = $_POST["taxID"];

//取得隊長報名資訊
$captainCollege = $_POST["captainCollege"];
$captainDepart = $_POST["captainDepart"];
$captainDegree = $_POST["captainDegree"];
$captainGrade = $_POST["captainGrade"];
$captainName = $_POST["captainName"];
$captainSex = $_POST["captainSex"];
$captainID = $_POST["captainID"];
$captainBirth = $_POST["captainBirth"];

//如果隊長年齡小於20需填同意書
$dateCaptain = strtotime($captainBirth);//取得隊長生日時戳
$todayCaptain = strtotime($orderTime);//取得報名時間的時戳
$captainAge = floor(($todayCaptain - $dateCaptain)/86400/365.25);//取得相差天數
	if ($captainAge < 20){
	echo"<script type='text/javascript'>";
	echo "alert('「隊長」未成年！請填寫「競賽同意書」完成並交由法定代理人簽名後，於競賽期間寄回協會，以免喪失競賽資格!');";
	echo "</script>";
	}

$captainPhone = $_POST["captainPhone"];
$captainEmail = $_POST["captainEmail"];
$captainCity = $_POST["captainCity"];
$captainDistrict0 = $_POST["captainDistrict"];
$captainZipCode = substr($captainDistrict0, 0, 3);
$captainDistrict = substr($captainDistrict0, 4);
$captainAddr0 = $_POST["captainAddr"];
//合併地址
$captainAddr = $captainZipCode.$captainCity.$captainDistrict.$captainAddr0;

//取得隊員member1報名資訊
$member1College = $_POST["member1College"];
$member1Depart = $_POST["member1Depart"];
$member1Degree = $_POST["member1Degree"];
$member1Grade = $_POST["member1Grade"];
$member1Name = $_POST["member1Name"];
$member1Sex = $_POST["member1Sex"];
$member1ID = $_POST["member1ID"];
$member1Birth = $_POST["member1Birth"];

//如果隊員1年齡小於20需填同意書
$dateMember1 = strtotime($member1Birth);//取得隊長生日時戳
$todayMember1 = strtotime($orderTime);//取得報名時間的時戳
$member1Age = floor(($todayMember1 - $dateMember1)/86400/365.25);//取得相差天數
if ($member1Age < 20){
echo"<script type='text/javascript'>";
echo "alert('「隊員1」未成年！請填寫「競賽同意書」完成並交由法定代理人簽名後，於競賽期間寄回協會，以免喪失競賽資格!');";
echo "</script>";
}


$member1Phone = $_POST["member1Phone"];
$member1Email = $_POST["member1Email"];
$member1City = $_POST["member1City"];
$member1District0 = $_POST["member1District"];
$member1ZipCode = substr($member1District0, 0, 3);
$member1District = substr($member1District0, 4);
$member1Addr0 = $_POST["member1Addr"];
//合併地址
$member1Addr = $member1ZipCode.$member1City.$member1District.$member1Addr0;

//取得隊員member2報名資訊
$member2College = $_POST["member2College"];
$member2Depart = $_POST["member2Depart"];
$member2Degree = $_POST["member2Degree"];
$member2Grade = $_POST["member2Grade"];
$member2Name = $_POST["member2Name"];
$member2Sex = $_POST["member2Sex"];
$member2ID = $_POST["member2ID"];
$member2Birth = $_POST["member2Birth"];

//如果隊員1年齡小於20需填同意書
$dateMember2 = strtotime($member2Birth);//取得隊長生日時戳
$todayMember2 = strtotime($orderTime);//取得報名時間的時戳
$member2Age = floor(($todayMember2 - $dateMember2)/86400/365.25);//取得相差天數
if ($member2Age < 20){
echo"<script type='text/javascript'>";
echo "alert('「隊員2」未成年！請填寫「競賽同意書」完成並交由法定代理人簽名後，於競賽期間寄回協會，以免喪失競賽資格!');";
echo "</script>";
}

$member2Phone = $_POST["member2Phone"];
$member2Email = $_POST["member2Email"];
$member2City = $_POST["member2City"];
$member2District0 = $_POST["member2District"];
$member2ZipCode = substr($member2District0, 0, 3);
$member2District = substr($member2District0, 4);
$member2Addr0 = $_POST["member2Addr"];
//合併地址
$member2Addr = $member2ZipCode.$member2City.$member2District.$member2Addr0;

//取得隊伍人數
if ($captainName != '' && $member1Name == '' && $member2Name == ''){
	$teamMans = '1';}
if ($captainName != '' && $member1Name != '' && $member2Name == ''){
	$teamMans = '2';}
if ($captainName != '' && $member1Name != '' && $member2Name != '' ){
	$teamMans = '3';}

//取得收據抬頭
$receiptTitleValue = $_POST["receiptTitle"];
if ($receiptTitleValue == '0') {
	$receiptTitle = $school;}
if ($receiptTitleValue == '1') {
	$receiptTitle = $teamName;}
if ($receiptTitleValue == '2') {
	$receiptTitle = $captainName;}

mysqli_close($sqlLink);
?>