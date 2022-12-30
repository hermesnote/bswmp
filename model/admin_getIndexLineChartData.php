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

//取得最近一週的日期
$day0 = substr($getToday, 5, 5);
$day1 = substr((date('Y-m-d', strtotime("-1 day"))), 5, 5);
$day2 = substr((date('Y-m-d', strtotime("-2 day"))), 5, 5);
$day3 = substr((date('Y-m-d', strtotime("-3 day"))), 5, 5);
$day4 = substr((date('Y-m-d', strtotime("-4 day"))), 5, 5);
$day5 = substr((date('Y-m-d', strtotime("-5 day"))), 5, 5);
$day6 = substr((date('Y-m-d', strtotime("-6 day"))), 5, 5);




//建立回傳值Array
$arr = array($day0, $day1, $day2, $day3, $day4, $day5, $day6);
echo json_encode($arr);
exit();


?>