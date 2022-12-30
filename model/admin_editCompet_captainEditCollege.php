<?php
//連線資料庫
require_once ("../vender/dbtools.inc.php");

// 設置資料類型 json，編碼格式 utf-8
header('Content-Type: application/json; charset=UTF-8');

//取得今天日期
$todayDate = date("Y-m-d H:i:s");

//設置資料庫
$teamDB = "competCollege";
$memberDB = "studentsInfo";

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
$emailEPT = "隊長email不可為空";
$cityEpt = "請選擇隊長通訊地所在城市";
$districtEPY = "請選擇隊長通訊地行政區";
$addrEPT = "請填寫隊長通訊地址";
$collegeEPT = "選擇隊長院別";
$departEPT = "請選擇隊長系所";
$degreeEPT = "請選擇隊長學位";
$gradeEPT = "請選擇隊長年級";
$editOK = "新增修改完成";


////取得AJAX傳值
//$teamNO = $_POST["teamNO"];
//
//if ( substr($teamNO, 0, 2) == 'CG' ){
//	$projectNO = substr($teamNO, 0, 4);
//}else{
//	$projectNO = 'NCS'.substr($teamNO, 2, 2);
//}
//
//$name = $_POST["name"];
//$sex = $_POST["sex"];
//$identifyNO = $_POST["identifyNO"];
//$birthday = $_POST["birthday"];
//$phone = $_POST["phone"];
//$email = $_POST["email"];
//$city = $_POST["city"];
//$district = $_POST["district"];
//$addr = $_POST["addr"];
//$college = $_POST["college"];
//$depart = $_POST["depart"];
//$degree = $_POST["degree"];
//$grade = $_POST["grade"];


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

$email = $_POST["email"];
	if($email == ''){
		echo json_encode($emailEpt);
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

$college = $_POST["college"];
	if($college == ''){
		echo json_encode($collegeEPT);
		exit();
	}

$depart = $_POST["depart"];
	if($depart == ''){
		echo json_encode($departEPT);
		exit();
	}

$degree = $_POST["degree"];
	if($degree == ''){
		echo json_encode($degreeEPT);
		exit();
	}

$grade = $_POST["grade"];
	if($grade == ''){
		echo json_encode($gradeEPT);
		exit();
	}

//組合地址
$addrZipcode = substr($district, 0, 3);
$addrDistrict = substr($district, 4);
$combineAddr = $addrZipcode.$city.$addrDistrict.$addr;

//取得projectNO 及 school
$sqlSELECTprojectNO = " SELECT * FROM $teamDB WHERE teamNO = '$teamNO' ";
$sqlRESULTprojectNO = mysql_query($sqlSELECTprojectNO, $sqlLink);
$sqlFETCHprojectNO = mysql_fetch_row($sqlRESULTprojectNO);
$projectNO = $sqlFETCHprojectNO[2];
$school = $sqlFETCHprojectNO[5];

//檢查該屆報名資料是否重覆
$sqlSELECTsignupData = " SELECT * FROM $memberDB WHERE projectNO = '$projectNO' AND identifyNO = '$identifyNO' AND teamNO != '$teamNO' ";
$sqlRESULTsignupData = mysql_query($sqlSELECTsignupData, $sqlLink);
$sqlNUMsignupData = mysql_num_rows($sqlRESULTsignupData);
$signupData = $sqlNUMsignupData;

//檢查同隊報名資料是否重覆
$sqlSELECTteamSignup = " SELECT * FROM $memberDB WHERE projectNO = '$projectNO' AND identifyNO = '$identifyNO' AND teamNO = '$teamNO' AND remarks != '$remarks'";
$sqlRESULTteamSignup = mysql_query($sqlSELECTteamSignup, $sqlLink);
$sqlNUMteamSignup = mysql_num_rows($sqlRESULTteamSignup);
$teamSignup = $sqlNUMteamSignup;

//檢查隊長資料是否已存在
$sqlSELECTcaptain = mysql_query(" SELECT * FROM studentsInfo WHERE projectNO = '$projectNO' AND identifyNO = '$identifyNO' AND teamNO = '$teamNO' AND remarks='$remarks' ");
$sqlNUMROWScaptain = mysql_num_rows($sqlSELECTcaptain);

//如果重覆報名
if ($signupData != 0 || $teamSignup != 0){
	echo json_encode($reSignup);
	exit();
}else if( $sqlNUMROWScaptain == 0 ){
	//更新資料庫 若隊長不存在 則插入新資料
	$sqlINSERTcaptain = "
		INSERT INTO $memberDB ( registerTime, projectNO, teamNO, name, identifyNO, sex, birthday, phone, email, city, district, addr, combineAddr, school, college, depart, degree, grade, remarks )
		VALUES ( '$todayDate', '$projectNO', '$teamNO', '$name', '$identifyNO', '$sex', '$birthday', '$phone', '$email', '$city', '$district', '$addr', '$combineAddr', '$school', '$college', '$depart', '$degree', '$grade', '$remarks' )
	";
	$sqlDOINSERT = mysql_query($sqlINSERTcaptain, $sqlLink);
}else if( $sqlNUMROWScaptain != 0 ){
	$sqlUpdate = "
		UPDATE $memberDB
		SET registerTime='$todayDate', name='$name', sex='$sex', identifyNO='$identifyNO', birthday='$birthday', phone='$phone', email='$email', city='$city', district='$district', addr='$addr', combineAddr='$combineAddr', college='$college', depart='$depart', degree='$degree', grade='$grade'
		WHERE teamNO = '$teamNO' AND remarks = '隊長';
	";
	$sqlDo = mysql_query($sqlUpdate, $sqlLink);
}

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