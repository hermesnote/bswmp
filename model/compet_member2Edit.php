<?php
//連線資料庫
require_once ("../vender/dbtools.inc.php");

// 設置資料類型 json，編碼格式 utf-8
header('Content-Type: application/json; charset=UTF-8');

//取得現在時間
$todayDate = date("Y-m-d H:i:s");
$getToday = date("Y-m-d H:i:s");

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

//建立回傳參數
$reSignup = "請勿重覆報名";
$noneData = "沒有資料存入";
$WRGData = "資料不完整";
$remarks = "隊員";
$nameEPT = "隊員姓名不可為空";
$sexEPT = "隊員稱謂不可為空";
$idEPT = "隊員身份證字號不可為空";
$birthdayEPT = "隊員生日不可為空";
$phoneEPT = "隊員行動電話不可為空";
$emailEPT = "隊員Email不可為空";
$cityEpt = "請選擇隊員通訊地所在城市";
$districtEPY = "隊員通訊地行政區";
$addrEPT = "請填寫隊員通訊地址";
$jobEPT = "隊員服務產業";
$titleEPT = "隊員職務類別";
$yearEPT = "請選擇隊員工作年資";
$editOK = "新增修改完成，系統將自動重新整理";

//組合地址


//取得AJAX傳值
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

if ($name == ''){
		echo json_encode($nameEPT);
		exit();	
}

if($sex == ''){
		echo json_encode($sexEPT);
		exit();
	}

if($identifyNO == ''){
		echo json_encode($idEPT);
		exit();
	}

if($birthday == ''){
		echo json_encode($birthdayEPT);
		exit();
	}

if($phone == ''){
		echo json_encode($phoneEPT);
		exit();
	}

if($email == ''){
		echo json_encode($emailEPT);
		exit();
	}

if($city == ''){
		echo json_encode($cityEpt);
		exit();
	}

if($district == ''){
		echo json_encode($districtEPY);
		exit();
	}

if($addr == ''){
		echo json_encode($addrEPT);
		exit();
	}

if($job == ''){
		echo json_encode($jobEPT);
		exit();
	}

if($title == ''){
		echo json_encode($titleEPT);
		exit();
	}

if($year == ''){
		echo json_encode($yearEPT);
		exit();
	}

//組合地址
$addrZipcode = substr($district, 0, 3);
$addrDistrict = substr($district, 4);
$combineAddr = $addrZipcode.$city.$addrDistrict.$addr;

//檢查該屆報名資料是否重覆
$sqlSELECTsignupData = " SELECT * FROM $memberDB WHERE projectNO = '$projectNO' AND identifyNO = '$identifyNO' AND teamNO != '$teamNO' ";
$sqlRESULTsignupData = mysql_query($sqlSELECTsignupData, $sqlLink);
$sqlNUMsignupData = mysql_num_rows($sqlRESULTsignupData);
$signupData = $sqlNUMsignupData;

//檢查報名資料是否已經存在隊長
$sqlSELECTcaptainData = "SELECT * FROM $memberDB WHERE projectNO = '$projectNO' AND identifyNO = '$identifyNO' AND remarks = '隊長'";
$sqlRESULTcaptainData = mysql_query($sqlSELECTcaptainData, $sqlLink);
$sqlcaptainData = mysql_num_rows($sqlRESULTcaptainData);

//檢查報名資料是否已經存在副手
$sqlSELECTmember1Data = "SELECT * FROM $memberDB WHERE projectNO = '$projectNO' AND identifyNO = '$identifyNO' AND remarks = '副手'";
$sqlRESULTmember1Data = mysql_query($sqlSELECTmember1Data, $sqlLink);
$sqlmember1Data = mysql_num_rows($sqlRESULTmember1Data);

//檢查報名資料是否已經存在隊員
$sqlSELECTmember2Data = "SELECT * FROM $memberDB WHERE projectNO = '$projectNO' AND identifyNO = '$identifyNO' AND remarks = '隊員'";
$sqlRESULTmember2Data = mysql_query($sqlSELECTmember2Data, $sqlLink);
$sqlmember2Data = mysql_num_rows($sqlRESULTmember2Data);

//如果資料存在同隊非隊員
if ($signupData != 0 || $sqlcaptainData != 0 || $sqlmember1Data != 0){
	echo json_encode($reSignup);
	exit();
}else if ($sqlmember2Data == 0){
	//新增資料語法
	$sqlInsert = "
		INSERT INTO $memberDB ( projectNO, teamNO, name, sex, identifyNO, birthday, phone, email, city, district, addr, combineAddr, job, title, year, remarks )
		VALUES ( '$projectNO', '$teamNO', '$name', '$sex', '$identifyNO', '$birthday', '$phone', '$email', '$city', '$district', '$addr', '$combineAddr', '$job', '$title', '$year', '$remarks' )
	";
	$sqlDoInsert = mysql_query($sqlInsert, $sqlLink);
}else if ($sqlmember2Data != 0){
	//更新資料語法
	$sqlUpdate = "
		UPDATE $memberDB
		set name='$name', sex = '$sex', birthday = '$birthday', phone = '$phone', email = '$email', city = '$city', district = '$district', addr = '$addr', combineAddr = '$combineAddr', job = '$job', title = '$title', year = '$year'
		WHERE identifyNO = '$identifyNO' AND projectNO = '$projectNO'
	";
	$sqlDoUpdate = mysql_query($sqlUpdate, $sqlLink);
}

//寫入Log
	$file_name = "../log/competLog.txt"; //檔案名稱
	$file = @file("$file_name"); //讀取檔案
	$open = @fopen("$file_name","a"); //開啟檔案，要是沒有檔案將建立一份
	$log =  "\r\n$todayDate $teamNO 編修隊員資料, $name, $sex, $birthday, $identifyNO, $phone, $email, $city, $district, $addr, $job, $title, $year";
	@fwrite($open,$log); //寫入資料
	fclose($open); //關閉檔案

//回傳成功訊息
echo json_encode($editOK);




?>