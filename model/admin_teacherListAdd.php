<?php
//連線資料庫
require_once ("../vender/dbtools.inc.php");

// 設置資料類型 json，編碼格式 utf-8
header('Content-Type: application/json; charset=UTF-8');


//建立回傳參數
$teacherSchoolEmpty = '請 選 填 學 校 ！';
$teacherCollegeEmpty = '請 選 填 院 所 ！';
$teacherDepartEmpty = '請 選 填 科 系 ！';
$teacherTypeEmpty = '請 選 填 職 務 別 ！';
$teacherNameEmpty = '請 填 寫 姓 名 ！';
$teacherPhoneEmpty = '請 填 寫 電 話 ！';
$teacherEmailEmpty = '請 填 寫 E-mail ！';
$dataExist = '資 料 已 存 在 ！';
$dataAdded = '新 增 成 功 ！ 請 重 新 整 理 網 頁 ！';


//取得ajax資料, 檢驗值是否存在
//if(!isset($_POST["teacherSchool"])){
//	echo json_encode($teacherSchoolEmpty);
//	exit();
//}else if(!isset($_POST["teacherCollege"])){
//	echo json_encode($teacherCollegeEmpty);
//	exit();
//}else if(!isset($_POST["teacherDepart"])){
//	echo json_encode($teacherDepartEmpty);
//	exit();
//}else if(!isset($_POST["teacherType"])){
//	echo json_encode($teacherTypeEmpty);
//	exit();
//}else if(!isset($_POST["teacherName"])){
//	echo json_encode($teacherNameEmpty);
//	exit();
//}else if(!isset($_POST["teacherPhone"])){
//	echo json_encode($teacherPhoneEmpty);
//	exit();
//}else if(!isset($_POST["teacherEmail"])){
//	echo json_encode($teacherEmailEmpty);
//	exit();
//}else{



//取得表單值

$teacherSchool = $_POST["teacherSchool"];
	if($teacherSchool == ''){
		echo json_encode($teacherSchoolEmpty);
		exit();
	}

$teacherCollege = $_POST["teacherCollege"];
	if($teacherCollege == ''){
		echo json_encode($teacherCollegeEmpty);
		exit();
	}

$teacherDepart = $_POST["teacherDepart"];
	if($teacherDepart == ''){
		echo json_encode($teacherDepartEmpty);
		exit();
	}

$teacherType = $_POST["teacherType"];
	if($teacherType == ''){
		echo json_encode($teacherTypeEmpty);
		exit();
	}

$teacherName = $_POST["teacherName"];
	if($teacherName == ''){
		echo json_encode($teacherNameEmpty);
		exit();
	}

$teacherPhone = $_POST["teacherPhone"];
	if($teacherPhone == ''){
		echo json_encode($teacherPhoneEmpty);
		exit();
	}

$teacherEmail = $_POST["teacherEmail"];
	if($teacherEmail == ''){
		echo json_encode($teacherEmailEmpty);
		exit();
	}

$remarks = $_POST["remarks"];
$teacherNO = "ST001";
$teacherNOadd1 = '1';

//驗證是否有同校同系同名老師
$sqlSELECTteacher = " SELECT * FROM teacherList WHERE teacherSchool = '$teacherSchool' AND teacherCollege = '$teacherCollege' AND teacherDepart = '$teacherDepart' AND teacherName = '$teacherName' ";
$sqlRESULTteacher = mysql_query($sqlSELECTteacher, $sqlLink);
$sqlNUMROWSteacher = mysql_num_rows($sqlRESULTteacher);

	if ($sqlNUMROWSteacher != 0){
		echo json_encode($dataExist);
		exit();
	}else{

		//查詢ST001是否存在
		$sqlSELECTteacherNOST001 = "SELECT * FROM teacherList WHERE teacherNO = '$teacherNO'";
		$sqlRESULTteacherNOST001 = mysql_query($sqlSELECTteacherNOST001, $sqlLink);
		$sqlteacherNOST001NUMS = mysql_num_rows($sqlRESULTteacherNOST001);

		//取得最近一筆教師編號末3碼 並+1
		$sqlSELECTteacherNO = "SELECT teacherNO FROM teacherList ORDER BY id DESC";
		$sqlRESULTteacherNO = mysql_query($sqlSELECTteacherNO, $sqlLink);
		$sqlFETCHteacherNO = mysql_fetch_row($sqlRESULTteacherNO);
		$sqlteacherNOLast = $sqlFETCHteacherNO[0];
		$sqlteacherNOLastNUMs = substr($sqlteacherNOLast, -3);
		$sqlteacherNOLastNUMsAdd1 = $sqlteacherNOLastNUMs+$teacherNOadd1;
		$sqlteacherNOAdded = str_pad($sqlteacherNOLastNUMsAdd1, 3, "0", STR_PAD_LEFT);

		if ($sqlteacherNOST001NUMS != 0){
			$teacherNO = "ST".$sqlteacherNOAdded;
		}else{
			$teacherNO = $teacherNO;
		}

		//資料入庫
		$sqlINSERTteacherList = "INSERT IGNORE INTO teacherList ( teacherNO, teacherSchool, teacherCollege, teacherDepart, teacherType, teacherName, teacherPhone, teacherEmail, remarks ) VALUES ( '$teacherNO', '$teacherSchool', '$teacherCollege', '$teacherDepart', '$teacherType', '$teacherName', '$teacherPhone', '$teacherEmail', '$remarks' ) ";
		$result = mysql_query($sqlINSERTteacherList, $sqlLink);

		//回傳成功訊息
		echo json_encode($dataAdded);

	}

//}

?>




