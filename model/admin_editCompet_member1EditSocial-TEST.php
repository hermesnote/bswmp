<?php
//連線資料庫
require_once ("../vender/dbtools.inc.php");

// 設置資料類型 json，編碼格式 utf-8
header('Content-Type: application/json; charset=UTF-8');

//取得今天日期
$getToday = date("Y-m-d H:i:s");

//設置資料庫
$teamDB = "competSocial";
$memberDB = "socialInfo";

//取得使用者資料
$passed = $_COOKIE["passed"];
$account = $_COOKIE["account"];
$staffNO = $_COOKIE["staffNO"];


//取得AJAX傳值
$remarks = "副手";
$editOK = "成功!"
$teamNO = $_POST["teamNO"];
$name = $_POST["name"];
$sex = $_POST["sex"];
$identifyNO = $_POST["identifyNO"];
$birthday = $_POST["birthday"];
$phone = $_POST["phone"];
$email = $_POST["email"];
$city = $_POST["city"];
$district = $_POST["district"];
$addr = $_POST["addr"];
$job = $_POST["job"];
$title = $_POST["title"];
$year = $_POST["year"];

//組合地址
$addrZipcode = substr($district, 0, 3);
$addrDistrict = substr($district, 4);
$combineAddr = $addrZipcode.$city.$addrDistrict.$addr;

//取得projectNO
$sqlSELECTprojectNO = " SELECT * FROM $teamDB WHERE teamNO = '$teamNO' ";
$sqlRESULTprojectNO = mysql_query($sqlSELECTprojectNO, $sqlLink);
$sqlFETCHprojectNO = mysql_fetch_row($sqlRESULTprojectNO);
$projectNO = $sqlFETCHprojectNO[2];

//	echo json_encode($teamDB.','.$memberDB.','.$getToday.','.$projectNO.','.$teamNO.','.$name.','.$identifyNO.','.$sex.','.$birthday.','.$phone.','.$email.','.$city.','.$district.','.$addr.','.$combineAddr.','.$job.','.$title.','.$year.','.$remarks);
//	exit();

$sqlInsert = "
	INSERT INTO $memberDB ( registerTime, projectNO, teamNO, name, identifyNO, sex, birthday, phone, email, city, district, addr, combineAddr, job, title, year, remarks )
	VALUES ('$getToday', '$projectNO', '$teamNO', '$name', '$identifyNO', '$sex', '$birthday', '$phone', '$email', '$city', '$district', '$addr', '$combineAddr', '$job', '$title', '$year', '$remarks' )
"; 
$sqlDoInsert = mysql_query($sqlInsert, $sqlLink);
	

//寫入Log
	$file_name = "../log/adminLog.txt"; //檔案名稱
	$file = @file("$file_name"); //讀取檔案
	$open = @fopen("$file_name","a"); //開啟檔案，要是沒有檔案將建立一份
	$log =  "\r\n$todayDate $staffNO 編修了 $teamNO 的副手資料 --- 測試用";
	@fwrite($open,$log); //寫入資料
	fclose($open); //關閉檔案

//回傳成功訊息
echo json_encode($editOK);
exit();

?>