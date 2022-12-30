<?php
//連線資料庫
require_once ("../vender/dbtools.inc.php");

// 設置資料類型 json，編碼格式 utf-8
header('Content-Type: application/json; charset=UTF-8');

//取得現在日期時間
$getToday = date("Y-m-d H:i:s");

//取得前端值
$project = $_POST["project"];

//查詢project @ productList
$sqlSELECTproject = " SELECT * FROM productList WHERE productNO = '$project' ";
$sqlRESULTproject = mysql_query($sqlSELECTproject, $sqlLink);
$sqlFETCHproject = mysql_fetch_row($sqlRESULTproject);
$projectName = $sqlFETCHproject[3];
$projectunit = $sqlFETCHproject[4];
$projectPrice = $sqlFETCHproject[5];

//建立回傳參數



//建立回傳值Array
$arr = array($projectName, $projectunit, $projectPrice);
echo json_encode($arr);
?>
