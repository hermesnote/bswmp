<?php


require_once ("../vender/dbtools.inc.php");

// 設置資料類型 json，編碼格式 utf-8
header('Content-Type: application/json; charset=UTF-8');

//取得使用者資料
$passed = $_COOKIE["passed"];
$account = $_COOKIE["account"];
$staffNO = $_COOKIE["staffNO"];

//取得日期
$today = date("Y-m-d H:i:s");

// 回傳字串
$dataEPT = "出現未知錯誤!";
$res = "Done";

//接Ajax
$getNumber = $_POST["getNumber"];
	if ( $getNumber == '' ){
		echo json_encode($dataEPT);
		exit();
	}

// 取得字串長度
$numberLength = strlen($getNumber);


// 判斷刪除資料庫
if ( $numberLength == '6' ){
	$sqlDB = 'surveyList';
	$surveyName = '問卷';
}else if( $numberLength == '8' ){
	$sqlDB = 'surveyGroup';
	$surveyName = '主題組';
}else if( $numberLength == '9' ){
	$sqlDB = 'surveySub';
	$surveyName = '副題組';
}else if( $numberLength == '11' ){
	$sqlDB = 'surveyDB';
	$surveyName = '題目';
}


// 刪除對應資料
if ( $sqlDB = 'surveyList' ){
	
	// 先砍問卷資料
	$sqlDELnumber = "DELETE FROM $sqlDB WHERE number = '$getNumber' ";
	mysql_query($sqlDELnumber, $sqlLink);
	
	// 再砍作答卷資料表
	$sqlDROPtable = "DROP TABLE $getNumber ";
	mysql_query($sqlDROPtable, $sqlLink);
	
	// 再砍題庫表
	$quizQ = $getNumber.'Q';
	$sqlDROPtableQ = "DROP TABLE $quizQ ";
	mysql_query($sqlDROPtableQ, $sqlLink);
	
}else{
	
	$sqlDELnumber = "DELETE FROM $sqlDB WHERE number = '$getNumber' ";
	mysql_query($sqlDELnumber, $sqlLink);
}

//寫入Log
	$file_name = "../log/adminLog.txt"; //檔案名稱
	$file = @file("$file_name"); //讀取檔案
	$open = @fopen("$file_name","a"); //開啟檔案，要是沒有檔案將建立一份
	$log =  "\r\n$today $staffNO 刪除了 $surveyName $getNumber ";
	@fwrite($open,$log); //寫入資料
	fclose($open); //關閉檔案

echo json_encode($res);
exit();

?>