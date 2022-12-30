<?php
//連線資料庫
require_once ("../vender/dbtools.inc.php");


// 設置資料類型 json，編碼格式 utf-8
header('Content-Type: application/json; charset=UTF-8');

//取得現在時間
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

//建立回傳參數
$remarks = "副手";
$nameEPT = "副手姓名不可為空";
$sexEPT = "副手稱謂不可為空";
$idEPT = "副手身份證字號不可為空";
$birthdayEPT = "副手生日不可為空";
$phoneEPT = "副手行動電話不可為空";
$emailEPT = "副手Email不可為空";
$cityEpt = "請選擇副手通訊地所在城市";
$districtEPY = "請選擇副手通訊地行政區";
$addrEPT = "請填寫副手通訊地址";
$reSignup = "請勿重覆報名";
$editOK = "新增修改完成，系統將自動重新整理";

//組合地址


//取得AJAX傳值
$schoolPre = $_POST["schoolPre"];

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

$email = $_POST["email"];
	if($email == ''){
		echo json_encode($emailEPT);
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
if ($signupData != 0 || $sqlcaptainData != 0 || $sqlmember2Data != 0){
	echo json_encode($reSignup);
	exit();
}else if ($sqlmember1Data == 0){
	//新增資料語法
	$sqlInsert = "
		INSERT INTO $memberDB ( registerTime, projectNO, teamNO, name, identifyNO, sex, birthday, phone, email, city, district, addr, combineAddr, school, remarks )
		VALUES ('$getToday', '$projectNO', '$teamNO', '$name', '$identifyNO', '$sex', '$birthday', '$phone', '$email', '$city', '$district', '$addr', '$combineAddr', '$schoolPre', '$remarks' )
	";
	$sqlDoInsert = mysql_query($sqlInsert, $sqlLink);
}else if ($sqlmember1Data != 0){
	//更新資料語法
	$sqlUpdate = "
		UPDATE $memberDB
		SET registerTime='$getToday', name='$name', identifyNO='$identifyNO', sex='$sex', birthday='$birthday', phone='$phone', email='$email', city='$city', district='$district', addr='$addr', combineAddr='$combineAddr'
		WHERE identifyNO = '$identifyNO' AND projectNO = '$projectNO'
	";
	$sqlDoUpdate = mysql_query($sqlUpdate, $sqlLink);
}


//回傳成功訊息
echo json_encode($editOK);




?>