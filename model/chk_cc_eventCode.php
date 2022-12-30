<?php
//資料庫連線
require_once("../vender/dbtools.inc.php");

//取得eventCode
$eventCode = $_POST["eventCode"];

//查詢eventCode
$sqleventCodeSearch = "SELECT * FROM eventList WHERE eventCode = '$eventCode'";
$sqleventCodeResult = mysql_query($sqleventCodeSearch, $sqlLink);
$sqleventCodeRows = mysql_num_rows($sqleventCodeResult);

//修改MN
if ($sqleventCodeRows != '0'){
	$MN = $_POST["MN"]*0.75;
}else{
	$MN = $_POST["MN"];
}

mysqli_close($sqlLink);
?>