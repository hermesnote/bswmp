<?php

require_once ("../vender/dbtools.inc.php");

// 設置資料類型 json，編碼格式 utf-8
header('Content-Type: application/json; charset=UTF-8');

//取得日期
$today = date("Y-m-d H:i:s");

// 回傳字串
$dataEPT = "「建立題組」所有資料欄位不得為空";
$res = "Done";

//接Ajax
$groupDistrict = $_POST["groupDistrict"];
	if ( $groupDistrict == '' ){
		echo json_encode($dataEPT);
		exit();
	}
$groupSchool = $_POST["groupSchool"];
	if ( $groupSchool == '' ){
		echo json_encode($dataEPT);
		exit();
	}
$groupTeacher = $_POST["groupTeacher"]; // 取得教師代碼
	if ( $groupTeacher == '' ){
		echo json_encode($dataEPT);
		exit();
	}
$groupTopic = $_POST["groupTopic"];
	if ( $groupTopic == '' ){
		echo json_encode($dataEPT);
		exit();
	}
$groupInfo = $_POST["groupInfo"];
	if ( $groupInfo == '' ){
		echo json_encode($dataEPT);
		exit();
	}

// 取得學校代碼
$schoolID = " SELECT schoolID FROM schoolList WHERE schoolName = '$groupSchool' ";

// 建立該教師當年初始題組號
$groupNumber = date("y").$groupTeacher.'A'; // ex: 20ST03201

// 尋找是否已存在, 若存在則取最近一筆+1, 若否則做為初始
$sqlSELECTgroupNumber = " SELECT * FROM surveyGroup WHERE number = '$groupNumber' ";
$sqlRESULTgroupNumber = mysql_query($sqlSELECTgroupNumber, $sqlLink);
$sqlROWgroupNumber = mysql_num_rows($sqlRESULTgroupNumber);
if ($sqlROWgroupNumber == 0 ){
	$groupNumber = $groupNumber;
}else{
	// 取得該師最近一筆
	$teacherGroup = date("y").$groupTeacher;
	$sqlSELECTteacher = " SELECT number FROM surveyGroup WHERE number LIKE '$teacherGroup%' ORDER BY id desc ";
	$sqlRESULTteacher = mysql_query($sqlSELECTteacher, $sqlLink);
	$lastFETCHteacher = mysql_fetch_array($sqlRESULTteacher);
	$lastNumber = $lastFETCHteacher[0];	// 該師最新一筆主題組紀錄
	$getStr = substr($lastNumber, -1);  // 取出最後一個字母
	$strOrd = ord($getStr); // 轉為ASCII
	$lastStr = chr($strOrd+1);
	$groupNumber = date("y").$groupTeacher.$lastStr;
}

// 存入資料庫
$sqlINSERTgroup = "
					INSERT INTO surveyGroup ( dateTime, number, topic, info )
					VALUES ( '$today', '$groupNumber', '$groupTopic', '$groupInfo' )
";
$sqlINSERT = mysql_query($sqlINSERTgroup, $sqlLink);

echo json_encode($res);
exit();

?>