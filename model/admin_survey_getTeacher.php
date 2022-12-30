<?php
require_once ("../vender/dbtools.inc.php");

// 設置資料類型 json，編碼格式 utf-8
header('Content-Type: application/json; charset=UTF-8');

//接Ajax
$school = $_POST['school'];

//撈資料
$sql = mysql_query("SELECT teacherNO, teacherName FROM teacherList WHERE teacherSchool = '$school' ");
$res = '';
while ($data = mysql_fetch_assoc($sql)){
	$res .= "
		<option value='{$data["teacherNO"]}'>{$data["teacherNO"]}{$data["teacherName"]}</option>
	";
};

echo json_encode($res);
exit();

?>