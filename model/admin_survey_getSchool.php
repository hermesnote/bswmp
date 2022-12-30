<?php
require_once ("../vender/dbtools.inc.php");

// 設置資料類型 json，編碼格式 utf-8
header('Content-Type: application/json; charset=UTF-8');

//接Ajax
$district = $_POST['district'];

//撈資料
$sql = mysql_query("SELECT schoolName FROM schoolList WHERE schoolDistrict = '$district' ");
$res = '';
while ($data = mysql_fetch_assoc($sql)){
	$res .= "
		<option value='{$data["schoolName"]}'>{$data["schoolName"]}</option>
	";
};

echo json_encode($res);
exit();

?>