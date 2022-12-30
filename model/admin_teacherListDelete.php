<?php
//連線資料庫
require_once ("../vender/dbtools.inc.php");

// 設置資料類型 json，編碼格式 utf-8
header('Content-Type: application/json; charset=UTF-8');


//建立回傳參數
$teacherNOInputEmpty = '請輸入欲刪除的「教師編號」';
$dataNotFound = '資料不存在！';
$dataDeleted = '刪除成功！請重新整理網頁 ！';


//取得輸入的教師編號
$teacherNOInput = $_POST["teacherNOInput"];

	if($teacherNOInput == ''){
		echo json_encode($teacherNOInputEmpty);
		exit();
	}


//驗證編號是否存在
$sqlSELECTteacherNO = " SELECT * FROM teacherList WHERE teacherNO = '$teacherNOInput' ";
$sqlRESULTteacherNO = mysql_query($sqlSELECTteacherNO, $sqlLink);
$sqlNUMROWSteacherNO = mysql_num_rows($sqlRESULTteacherNO);

	if ($sqlNUMROWSteacherNO == 0){
		echo json_encode($dataNotFound);
		exit();
	}

//刪除資料
$sqlDropData = " delete from teacherList where teacherNO = '$teacherNOInput' ";
mysql_query($sqlDropData);
echo json_encode($dataDeleted);
exit();


?>




