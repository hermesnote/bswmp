<?php
//連線資料庫
require_once ("../vender/dbtools.inc.php");

// 設置資料類型 json，編碼格式 utf-8
header('Content-Type: application/json; charset=UTF-8');

//取得今天日期
$todayDate = date("Y-m-d H:i:s");

//設置資料庫
$teamDB = "competSocial";
$memberDB = "socialInfo";

//取得使用者資料
$passed = $_COOKIE["passed"];
$account = $_COOKIE["account"];
$staffNO = $_COOKIE["staffNO"];

//建立回傳參數
$remarks = "隊長";
$nameEPT = "隊長姓名為空";
$sexEPT = "隊長稱謂不可為空";
$idEPT = "隊長身份證字號不可為空";
$birthdayEPT = "隊長生日不可為空";
$phoneEPT = "隊長行動電話不可為空";
$cityEpt = "請選擇隊長通訊地所在城市";
$districtEPY = "請選擇隊長通訊地行政區";
$addrEPT = "請填寫隊長通訊地址";
$jobEPT = "請填寫隊長產業";
$titleEPT = "請填寫隊長職務";
$yearEPT = "請填寫隊長年資";
$editOK = "新增修改完成";

//取得AJAX傳值
$teamNO = $_POST["teamNO"];

$name = $_POST["name"];
	if($name == ''){
		echo json_encode($nameEPT);
		exit();
	}

$sex = $_POST["sex"];
	if($sex == ''){
		echo json_encode($sexEPT);
		exit();
	}

$identifyNO = $_POST["identifyNO"];
	if($identifyNO == ''){
		echo json_encode($idEPT);
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

$job = $_POST["job"];
	if($job == ''){
		echo json_encode($jobEPT);
		exit();
	}

$title = $_POST["title"];
	if($title == ''){
		echo json_encode($titleEPT);
		exit();
	}

$year = $_POST["year"];
	if($year == ''){
		echo json_encode($yearEPT);
		exit();
	}

//組合地址
$addrZipcode = substr($district, 0, 3);
$addrDistrict = substr($district, 4);
$combineAddr = $addrZipcode.$city.$addrDistrict.$addr;

////檢查該屆報名資料是否重覆
//$sqlSELECTsignupData = " SELECT * FROM $memberDB WHERE projectNO = '$projectNO' AND identifyNO = '$identifyNO' AND teamNO != '$teamNO' ";
//$sqlRESULTsignupData = mysql_query($sqlSELECTsignupData, $sqlLink);
//$sqlNUMsignupData = mysql_num_rows($sqlRESULTsignupData);
//$signupData = $sqlNUMsignupData;
//
//檢查同隊報名資料是否重覆
$sqlSELECTteamSignup = " SELECT * FROM $memberDB WHERE projectNO = '$projectNO' AND identifyNO = '$identifyNO' AND teamNO = '$teamNO' AND remarks != '$remarks'";
$sqlRESULTteamSignup = mysql_query($sqlSELECTteamSignup, $sqlLink);
$sqlNUMteamSignup = mysql_num_rows($sqlRESULTteamSignup);
$teamSignup = $sqlNUMteamSignup;


////如果重覆報名
//if ($signupData != 0 || $teamSignup != 0){
//	echo json_encode($reSignup);
//	exit();
//}else{
	//更新資料庫
	$sqlUpdate = "
		UPDATE $memberDB
		SET 
		name='$name',
		sex='$sex',
		identifyNO='$identifyNO',
		birthday='$birthday',
		phone='$phone',
		city='$city',
		district='$district',
		addr='$addr',
		combineAddr='$combineAddr',
		job='$job',
		title='$title',
		year='$year'
		WHERE teamNO = '$teamNO' AND remarks = '隊長';
	";
	$sqlDo = mysql_query($sqlUpdate, $sqlLink);
//}

//寫入Log
	$file_name = "../log/adminLog.txt"; //檔案名稱
	$file = @file("$file_name"); //讀取檔案
	$open = @fopen("$file_name","a"); //開啟檔案，要是沒有檔案將建立一份
	$log =  "\r\n$todayDate $staffNO 編修了 $teamNO 的隊長資料";
	@fwrite($open,$log); //寫入資料
	fclose($open); //關閉檔案

//回傳成功訊息
echo json_encode($editOK);




?>