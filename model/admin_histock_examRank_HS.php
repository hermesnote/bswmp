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

//// 若cookie中的變數passed不為TRUE，則導回登入頁
//if ($passed != "TRUE"){
//	echo "<script type='text/javascript'>";
//	echo "alert('COOKIE錯誤或逾時!請重新登入！')";
//	echo "</script>";
//	header("location:admin_login.php");
//	exit();
//}

//建立回傳參數
$done = "done";

//更新評分資料庫
$scoreDB = "histock_HSscore";

//取得AJAX傳送值
$projectNO = $_POST["projectNO"];
$bach = $_POST["bach"];
$finalist = $_POST["finalist"];


// 建立回傳值陣列
$examNumberArr = array();

// 排序並給晉級資格
$examRank = 0;
$sqlSELECTexamRank = " SELECT examNumber FROM $scoreDB WHERE projectNO = '$projectNO' AND bach = '$bach' ORDER BY examScore DESC LIMIT $finalist ";
$sqlRESULTexamRank = mysql_query($sqlSELECTexamRank, $sqlLink);
while ( $row = mysql_fetch_array($sqlRESULTexamRank)){
	$examNumberArr[] = $row["examNumber"];
}
$examNumbers = $examNumberArr;
	for ( $i=0; $i<$finalist; $i++ ){
		$examNumber = $examNumbers[$i];
		$examRank = $i+1;
		$sqlUPDATE = "
			UPDATE $scoreDB
			SET
			examRank = '$examRank', finalist = 'Y'
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