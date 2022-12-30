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
$orderNOEPT = '訂單編號不存在！';

//取得orderNO
$orderNO = $_POST["orderNO"];

//取回訂單資訊
$sqlSELECTorderNO = " SELECT * FROM orderList WHERE orderNO = '$orderNO' ";
$sqlRESULTorderNO = mysql_query($sqlSELECTorderNO, $sqlLink);
$sqlNUMROWSorderNO = mysql_num_rows($sqlRESULTorderNO);
$sqlFETCHorderNO = mysql_fetch_row($sqlRESULTorderNO);
$id = $sqlFETCHorderNO[0];
$orderTime = $sqlFETCHorderNO[1];
$orderNO = $sqlFETCHorderNO[2];
$customerNO = $sqlFETCHorderNO[3];
$projectNO = $sqlFETCHorderNO[4];
$MN = $sqlFETCHorderNO[6];
$payWay = $sqlFETCHorderNO[7];
$payStatus = $sqlFETCHorderNO[8];
$payTime = $sqlFETCHorderNO[9];
$bankCode = $sqlFETCHorderNO[13];
$vAccount = $sqlFETCHorderNO[14];
$paymentNO = $sqlFETCHorderNO[15];
$expireDate = $sqlFETCHorderNO[16];

if ( $sqlNUMROWSorderNO == 0 ){
	echo json_encode($orderNOEPT);
	exit();
}


//寫入Log
	$file_name = "../log/adminLog.txt"; //檔案名稱
	$file = @file("$file_name"); //讀取檔案
	$open = @fopen("$file_name","a"); //開啟檔案，要是沒有檔案將建立一份
	$log =  "\r\n$todayDate $staffNO 開啟了 $orderNO 的訂單刪除功能" ;
	@fwrite($open,$log); //寫入資料
	fclose($open); //關閉檔案

$arr = array($id, $orderTime, $orderNO, $customerNO, $projectNO, $MN, $payWay, $payStatus, $payTime, $bankCode, $vAccount, $paymentNO, $expireDate);
echo json_encode($arr);
exit();

?>