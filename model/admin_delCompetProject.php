<?php
//連線資料庫
require_once ("../vender/dbtools.inc.php");

// 設置資料類型 json，編碼格式 utf-8
header('Content-Type: application/json; charset=UTF-8');

//取得今天日期
$getToday = date("Y-m-d H:i:s");

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
//建立回傳參數
$projectNOInputEmpty = '請選擇欲刪除的競賽項目';
$dataDeleted = '刪除成功！';


//取得輸入的項目代號
$projectNO = $_POST["projectNO"];

	if($projectNO == ''){
		echo json_encode($projectNOInputEmpty);
		exit();
	}

//刪除資料
$sqlDropData = " delete from competList where projectNO = '$projectNO' ";
mysql_query($sqlDropData);

//寫入Log
	$file_name = "../log/adminLog.txt"; //檔案名稱
	$file = @file("$file_name"); //讀取檔案
	$open = @fopen("$file_name","a"); //開啟檔案，要是沒有檔案將建立一份
	$log =  "\r\n$getToday $staffNO 刪除了一筆競賽代號 $projectNO";
	@fwrite($open,$log); //寫入資料
	fclose($open); //關閉檔案

//回傳成功訊息
echo json_encode($dataDeleted);
exit();


?>