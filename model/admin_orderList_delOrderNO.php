<?php
//連線資料庫
require_once ("../vender/dbtools.inc.php");

// 設置資料類型 json，編碼格式 utf-8
header('Content-Type: application/json; charset=UTF-8');

//取得cookie
$passed = $_COOKIE["passed"];
$account = $_COOKIE["account"];
$staffNO = $_COOKIE["staffNO"];
$staffName = $_COOKIE["staffName"];
// 若cookie中的變數passed不為TRUE，則導回登入頁
if ($passed != "TRUE"){
echo "<script type='text/javascript'>";
echo "alert('COOKIE錯誤!請重新登入！')";
echo "</script>";
header("location:admin_login.php");
exit();
}


//取得今天日期
$todayDate = date("Y-m-d H:i:s");

//建立回傳參數
$delWRG = '訂單已完成繳費或退費，不可刪除！';
$delDone = "成功刪除！";

//取得orderNO
$orderNO = $_POST["orderNO"];

//取得訂單繳費狀態
$sqlSELECTorderNO = " SELECT * FROM orderList WHERE orderNO = '$orderNO' ";
$sqlRESULTorderNO = mysql_query($sqlSELECTorderNO, $sqlLink);
$sqlFETCHorderNO = mysql_fetch_row($sqlRESULTorderNO);
$payStatus = $sqlFETCHorderNO[8];

if ( $payStatus != '' ){
	echo json_encode($delWRG);
	exit();
}else{
	$sqlDELorderNO = "DELETE FROM orderList WHERE orderNO = '$orderNO' ";
	mysql_query($sqlDELorderNO, $sqlLink);
}

//寫入Log
	$file_name = "../log/adminLog.txt"; //檔案名稱
	$file = @file("$file_name"); //讀取檔案
	$open = @fopen("$file_name","a"); //開啟檔案，要是沒有檔案將建立一份
	$log =  "\r\n$todayDate $staffNO 刪除了訂單 $orderNO" ;
	@fwrite($open,$log); //寫入資料
	fclose($open); //關閉檔案

echo json_encode($delDone);
exit();

?>