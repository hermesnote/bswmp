<?php
//連線資料庫
require_once ("../vender/dbtools.inc.php");

// 設置資料類型 json，編碼格式 utf-8
header('Content-Type: application/json; charset=UTF-8');

//取得AJAX資料
$teamName = $_POST["teamName"];
$projectNO = $_POST["projectNO"];

//建立回傳訊息
$teamExist = '隊名已被使用！';
$teamAvailable = '隊名可以使用！';
$matches = '不可使用特殊符號！';
$matches2 = '隊伍內有禁用字元！';

//字串檢查
//if (!preg_match("/^[\x{4e00}-\x{9fa5}A-Za-z0-9_] $/u", $teamName)){
//	echo json_encode($matches);
//}

//禁用髒字
//if (!preg_match("幹", $teamName)){
//	echo json_encode($matches2);
//	exit();
//}

//對比competSocial資料庫
$sqlteamNameCHKSearch = " SELECT * FROM competSocial WHERE projectNO = '$projectNO' AND teamName = '$teamName' ";
$sqlteamNameCHKResult = mysql_query($sqlteamNameCHKSearch, $sqlLink);
$sqlteamNameCHKNums = mysql_num_rows($sqlteamNameCHKResult);
$sqlteamNameCHK = $sqlteamNameCHKNums;

if ( $sqlteamNameCHK == 0 ){
	echo json_encode($teamAvailable);
} else {
	echo json_encode($teamExist);
}

?>