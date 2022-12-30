<?php
//連線資料庫
require_once("../vender/dbtools.inc.php");

//默認時區
date_default_timezone_set('PRC');

// 設置資料類型 json，編碼格式 utf-8
header('Content-Type: application/json; charset=UTF-8');

//參數
$done = "done";

// 取得Ajax傳值
$examNumber = $_POST["examNumber"];
	// 取出projectNO
	$projectNO = substr($examNumber, 0, 7);
$paperNumber = $_POST["paperNumber"];
$score = $_POST["score"];

// 判斷HT HS
if ( preg_match('/HT/i', $examNumber)){
	$memDB = 'histock_HTsignup';
	$scoreDB = 'histock_HTscore';
}else if ( preg_match('/HS/i', $examNumber) ){
	$memDB = 'histock_HSsignup';
	$scoreDB = 'histock_HSscore';
	// 取得conference
	$sqlSELECTconference = " SELECT conference FROM $memDB WHERE examNumber = '$examNumber' ";
	$sqlRESULTconference = mysql_query($sqlSELECTconference, $sqlLink);
	$sqlFETCHconference = mysql_fetch_array($sqlRESULTconference);
	$conference = $sqlFETCHconference["conference"];
	// conference轉換bach
	if( $conference == 'N' ){
		$bach = "bach1";
	}
	if( $conference == 'M' ){
		$bach = "bach2";
	}
	if( $conference == 'S' ){
		$bach = "bach3";
	}
}


// 存入成績
//$sqlUPDATE = "
//	UPDATE $scoreDB
//	SET
//	examScore = '$score'
//	WHERE examNumber = '$examNumber'
//";
//$sqlDoUPDATE = mysql_query($sqlUPDATE, $sqlLink);

$sqlINSERT = "
	INSERT INTO $scoreDB ( projectNO, examNumber, bach, paperNumber, examScore )
	VALUES ( '$projectNO', '$examNumber', '$bach', '$paperNumber', '$score' )
	ON DUPLICATE KEY UPDATE examNumber = '$examNumber',
	examScore = '$score';
";
$sqlINSERT = mysql_query($sqlINSERT, $sqlLink);


//回傳
echo json_encode($done);
exit();

?>