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

// 回傳總隊數
$sqlSELECTexam = " SELECT * FROM $scoreDB WHERE projectNO = '$projectNO' AND bach = '$bach' ";
$sqlRESULTexam = mysql_query($sqlSELECTexam, $sqlLink);
$examNUMs = mysql_num_rows($sqlRESULTexam); 

//回傳成功訊息
echo json_encode($examNUMs);
exit();

?>