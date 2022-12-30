<?php

require_once ("../vender/dbtools.inc.php");

// 設置資料類型 json，編碼格式 utf-8
header('Content-Type: application/json; charset=UTF-8');

// 取得日期
$today = date("Y-m-d H:i:s");

// 回傳參數
$done = '成功';

//接Ajax
$survey = $_POST['survey'];
$teamNO = $_POST['teamNO'];
$role = $_POST['remarks'];
$quizListLength = $_POST['quizListLength'];
$quizArr = $_POST['quizList'];
	$quizArr = implode(",", $quizArr);
$feedArr = $_POST['quizFeedBack'];
//	$feedArr = implode(",", $feedArr);

// 找資料
$sqlSELECT = mysql_query(" SELECT sex, birthday, school, depart, grade FROM studentsInfo WHERE teamNO='$teamNO' AND remarks='$role' ");
$sqlFETCH = mysql_fetch_assoc($sqlSELECT);
$sex = $sqlFETCH['sex'];
	if ( $sex == '先生' ){
		$sex = '男';
	}else{
		$sex = '女';
	}
$birthday = $sqlFETCH['birthday'];
	// 計算當時年齡(大概)
	$now = strtotime($today);
	$age = strtotime($birthday);
	$age = $now - $age;
	$age = intval($age/(365*24*60*60));
$school = $sqlFETCH['school'];
$depart = $sqlFETCH['depart'];
$grade = $sqlFETCH['grade'];

//// 個資存入資料庫 surveyFeedBack
//$sqlINSERTinfo = mysql_query("
//	INSERT INTO $survey ( time, teamNO, role, sex, age, school, depart, grade, $quizArr )
//	VALUES ( '$today', '$teamNO', '$role', '$sex', '$age', '$school', '$depart', '$grade', $feedArr)
//");

$sqlINSERTinfo = "
	INSERT INTO $survey ( time, teamNO, role, sex, age, school, depart, grade, $quizArr )
	VALUES ( '$today', '$teamNO', '$role', '$sex', '$age', '$school', '$depart', '$grade'
	";
	foreach( $feedArr as $feed ){
		$sqlINSERTinfo = $sqlINSERTinfo.",'$feed'";
	}
	$sqlINSERTinfo = $sqlINSERTinfo.')';

$sql = mysql_query($sqlINSERTinfo);

//寫入Log
	$file_name = "../log/competLog.txt"; //檔案名稱
	$file = @file("$file_name"); //讀取檔案
	$open = @fopen("$file_name","a"); //開啟檔案，要是沒有檔案將建立一份
	$log =  "\r\n$today $teamNO $role 送出了 $survey 問卷";
	@fwrite($open,$log); //寫入資料
	fclose($open); //關閉檔案

echo json_encode($done);
exit();

?>