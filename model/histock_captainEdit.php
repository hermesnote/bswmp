<?php
//連線資料庫
require_once ("../vender/dbtools.inc.php");

// 設置資料類型 json，編碼格式 utf-8
header('Content-Type: application/json; charset=UTF-8');

//取得今天日期
$todayDate = date("Y-m-d H:i:s");

//取得COOKIE
$teamNO = $_COOKIE["teamNO"];
$teamName = $_COOKIE["teamName"];
$passed = $_COOKIE["passed"];
$projectNO = $_COOKIE["projectNO"];
$projectName = $_COOKIE["projectName"];
$teamDB = $_COOKIE["teamDB"];
$passed = $_COOKIE["passed"];
$memberDB = $_COOKIE["memberDB"];

//建立回傳參數
$remarks = "隊長";
$sexEPT = "隊長稱謂不可為空";
$birthdayEPT = "隊長生日不可為空";
$phoneEPT = "隊長行動電話不可為空";
$cityEpt = "請選擇隊長通訊地所在城市";
$districtEPY = "請選擇隊長通訊地行政區";
$addrEPT = "請填寫隊長通訊地址";
$editOK = "新增修改完成，系統將自動重新整理";

//組合地址


//取得AJAX傳值
$identifyNO = $_POST["identifyNO"];

$sex = $_POST["sex"];
	if($sex == ''){
		echo json_encode($sexEPT);
		exit();
	}

$birthday = $_POST["birthday"];
	if($birthday == ''){
		echo json_encode($birthdayEPT);
		exit();
	}

$phone = $_POST["phone"];
	if($phone == ''){
		echo json_encode($phoneEPT);
		exit();
	}

$city = $_POST["city"];
	if($city == ''){
		echo json_encode($cityEpt);
		exit();
	}

$district = $_POST["district"];
	if($district == ''){
		echo json_encode($districtEPY);
		exit();
	}

$addr = $_POST["addr"];
	if($addr == ''){
		echo json_encode($addrEPT);
		exit();
	}

//組合地址
$addrZipcode = substr($district, 0, 3);
$addrDistrict = substr($district, 4);
$combineAddr = $addrZipcode.$city.$addrDistrict.$addr;


//更新隊長資料庫
$sqlUpdate = "
	UPDATE $memberDB
	SET sex='$sex', birthday='$birthday', phone='$phone', city='$city', district='$district', addr='$addr', combineAddr='$combineAddr'
	WHERE identifyNO = '$identifyNO' AND projectNO = '$projectNO'
";
$sqlDo = mysql_query($sqlUpdate, $sqlLink);

//寫入Log
	$file_name = "../log/competLog.txt"; //檔案名稱
	$file = @file("$file_name"); //讀取檔案
	$open = @fopen("$file_name","a"); //開啟檔案，要是沒有檔案將建立一份
	$log =  "\r\n$todayDate $teamNO 編修了隊長資料為 $sex, $birthday, $phone, $city, $district, $addr";
	@fwrite($open,$log); //寫入資料
	fclose($open); //關閉檔案

//回傳成功訊息
echo json_encode($editOK);




?>