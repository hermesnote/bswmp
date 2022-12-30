<?php
require_once ("../vender/dbtools.inc.php");

// 設置資料類型 json，編碼格式 utf-8
header('Content-Type: application/json; charset=UTF-8');

//取得日期
$today = date("Y-m-d H:i:s");

// 回傳字串
$dataEPT = "「新增問題」所有資料欄位不得為空";
$res = "Done";

//接Ajax
$quizType = $_POST["quizType"];
$quizSub = $_POST["quizSub"];
	if ( $quizSub == '' ){
		echo json_encode($dataEPT);
		exit();
	}
$quizArea = $_POST["quizArea"];
	if ( $quizArea == '' ){
		echo json_encode($dataEPT);
		exit();
	}

// 判斷選項類型
if ( $quizType == '0' ){
	$ansChoice = "default7"; // 非常同意1 ~ 非常不同意7
}else{
	$quizArr = $_POST["quizArr"];
		if ( $quizArr == '' ){
			echo json_encode($dataEPT);
			exit();
		}
	// 陣列轉字串
	$ansChoice = implode(",", $quizArr);
}



// 建立初始題目序號
$quizNumber = $quizSub.'01';

// 遍歷序號存在
$sqlSELECTquizNumber = " SELECT * FROM surveyDB WHERE number = '$quizNumber' ";
$sqlRESULTquizNumber = mysql_query($sqlSELECTquizNumber, $sqlLink);
$sqlROWquizNumber = mysql_num_rows($sqlRESULTquizNumber);

	if ($sqlROWquizNumber == 0 ){
		$quizNumber = $quizNumber;
	}
	else{

	// 取得該題組最近一筆題目序號
	$sqlSELECTnumber = " SELECT number FROM surveyDB WHERE number LIKE '$quizSub%' ORDER BY id desc ";
	$sqlRESULTnumber = mysql_query($sqlSELECTnumber, $sqlLink);
	$lastFETCHnumber = mysql_fetch_array($sqlRESULTnumber);
	$lastNumber = $lastFETCHnumber[0];	
	$getStr = substr($lastNumber, -2);
	$strAdd1 = $getStr+1;
	$lastStr = str_pad($strAdd1, 2, "0", STR_PAD_LEFT);
	$quizNumber = $quizSub.$lastStr;
	}




// 存入資料庫
$sqlINSERTquizInit = "
	INSERT INTO surveyDB ( dateTime, number, topic, choices )
	VALUES ( '$today', '$quizNumber', '$quizArea', '$ansChoice' )
";
$sqlINSERT = mysql_query($sqlINSERTquizInit, $sqlLink);

echo json_encode($res);
exit();

?>