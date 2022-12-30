<?php
//連線資料庫
require_once ("../vender/dbtools.inc.php");

// 設置資料類型 json，編碼格式 utf-8
header('Content-Type: application/json; charset=UTF-8');

//取得今天日期
$todayDate = date("Y-m-d H:i:s");

//取得cookie
$passed = $_COOKIE["passed"];
$account = $_COOKIE["account"];
$staffNO = $_COOKIE["staffNO"];
$staffName = $_COOKIE["staffName"];

// 若cookie中的變數passed不為TRUE，則導回登入頁
if ($passed != "TRUE"){
	echo "<script type='text/javascript'>";
	echo "alert('COOKIE錯誤或逾時!請重新登入！')";
	echo "</script>";
	header("location:admin_login.php");
	exit();
}

//建立回傳參數
$done = "done";

//更新評分資料庫
$scoreDB = "histock_HSscore";

//取得AJAX傳送值
$projectNO = $_POST["projectNO"];
$bach = $_POST["bach"];

// 建立排序回傳值陣列
$examNumberArr = array();
$semiScoreArr = array();


// 取得combine排序
$sqlSELECTsemiPR = " SELECT examNumber, semiScore FROM $scoreDB WHERE projectNO = '$projectNO' AND bach = '$bach' AND finalist = 'Y' ORDER BY semiScore DESC ";
$sqlRESULTsemiPR = mysql_query($sqlSELECTsemiPR, $sqlLink);
while ( $row = mysql_fetch_array($sqlRESULTsemiPR)){
	$examNumberArr[] = $row["examNumber"];
	$semiScoreArr[] = $row["semiScore"];
}
$examNumbers = $examNumberArr;
$semiScores = $semiScoreArr;
$e = $examNumbers[0];
$basePR = $semiScoreArr[0];
$j = count($examNumbers);
for( $i=0; $i<$j; $i++ ){
	// 計算PR
	$semiScored = round(($semiScores[$i]/$basePR)*50, 2);
	// 存入DB
	$examNumber = $examNumbers[$i];
	$sqlUPDATE = "
	UPDATE $scoreDB
	SET
	semiScorePR = '$semiScored'
	WHERE examNumber = '$examNumber'
	";
	$sqlDOUPDATE = mysql_query($sqlUPDATE, $sqlLink);
}

//
////寫入Log
//	$file_name = "../log/adminLog.txt"; //檔案名稱
//	$file = @file("$file_name"); //讀取檔案
//	$open = @fopen("$file_name","a"); //開啟檔案，要是沒有檔案將建立一份
//	$log =  "\r\n$todayDate $staffNO 更新了 $examNumber 的投資實務為 $score ";
//	@fwrite($open,$log); //寫入資料
//	fclose($open); //關閉檔案

//回傳成功訊息
echo json_encode($done);
exit();

?>