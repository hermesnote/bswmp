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
echo "alert('COOKIE錯誤!請重新登入！')";
echo "</script>";
header("location:admin_login.php");
exit();
}

//建立回傳參數
$DB = "examDB_hiStock";
$done = "操作成功！";

//取得今天日期
$todayDate = date("Y-m-d H:i:s");

//取得AJAX傳送值
$number = $_POST["number"];
$edit = $_POST["edit"];
$option = $_POST["option"];

//更新調用項目
$sqlUpdate = "
	UPDATE $DB
	SET $option = '$edit'
	WHERE number = '$number' ;
";
$sqlDo = mysql_query($sqlUpdate, $sqlLink);

//寫入Log
	$file_name = "../log/adminLog.txt"; //檔案名稱
	$file = @file("$file_name"); //讀取檔案
	$open = @fopen("$file_name","a"); //開啟檔案，要是沒有檔案將建立一份
	$log =  "\r\n$todayDate $staffNO 修改了題號 $number 的 $option ";
	@fwrite($open,$log); //寫入資料
	fclose($open); //關閉檔案
	
	echo json_encode($done);
	exit();

?>