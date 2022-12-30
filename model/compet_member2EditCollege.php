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
$districtEPY = "請選擇隊員通訊地行政區";
$addrEPT = "請填寫隊員通訊地址";
$collegeEPT = "選擇隊員院別";
$departEPT = "請選擇隊員系所";
$degreeEPT = "請選擇隊員學位";
$gradeEPT = "請選擇隊員年級";
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
		INSERT INTO $memberDB ( registerTime, projectNO, teamNO, name, identifyNO, sex, birthday, phone, email, city, district, addr, combineAddr, school, college, depart, degree, grade, remarks )
		VALUES ('$getToday', '$projectNO', '$teamNO', '$name', '$identifyNO', '$sex', '$birthday', '$phone', '$email', '$city', '$district', '$addr', '$combineAddr', '$schoolPre', '$college', '$depart', '$degree', '$grade', '$remarks' )
	";
	$sqlDoInsert = mysql_query($sqlInsert, $sqlLink);
}else if ($sqlmember2Data != 0){
	//更新資料語法
	$sqlUpdate = "
		UPDATE $memberDB
		SET registerTime='$getToday', name='$name', identifyNO='$identifyNO', sex='$sex', birthday='$birthday', phone='$phone', email='$email', city='$city', district='$district', addr='$addr', combineAddr='$combineAddr', college='$college', depart='$depart', degree='$degree', grade='$grade'
		WHERE identifyNO = '$identifyNO' AND projectNO = '$projectNO'
	";
	$sqlDoUpdate = mysql_query($sqlUpdate, $sqlLink);
}

//寫入Log
	$file_name = "../log/competLog.txt"; //檔案名稱
	$file = @file("$file_name"); //讀取檔案
	$open = @fopen("$file_name","a"); //開啟檔案，要是沒有檔案將建立一份
	$log =  "\r\n$todayDate $teamNO 編修隊員資料, $name, $identifyNO, $sex, $birthday, $phone, $email, $city, $district, $addr, $college, $depart, $degree, $grade";
	@fwrite($open,$log); //寫入資料
	fclose($open); //關閉檔案

//回傳成功訊息
echo json_encode($editOK);
exit();



?>