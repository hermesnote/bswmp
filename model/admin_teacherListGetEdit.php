<?php
//連線資料庫
require_once ("../vender/dbtools.inc.php");

// 設置資料類型 json，編碼格式 utf-8
header('Content-Type: application/json; charset=UTF-8');


//建立回傳參數
$teacherNOInputEmpty = '請輸入欲修改的教師編號';
$dataEdited = '修 改 成 功 ！ 請 重 新 整 理 網 頁 ！';


//取得輸入的教師編號

$teacherNOInput = $_POST["teacherNOInput"];
	if($teacherNOInput == ''){
		echo json_encode($teacherNOInputEmpty);
		exit();
	}


//驗證編號是否存在
$sqlSELECTteacherNO = " SELECT * FROM teacherList WHERE teacherNO = 'teacherNOInput' ";
$sqlRESULTteacherNO = mysql_query($sqlSELECTteacherNO, $sqlLink);
$sqlNUMROWSteacherNO = mysql_num_rows($sqlRESULTteacherNO);

	if ($sqlNUMROWSteacher != 0){
		echo json_encode($dataExist);
		exit();
	}else{

		//查詢ST001是否存在
		$sqlSELECTteacherNOST001 = "SELECT * FROM teacherList WHERE teacherNO = '$teacherNO'";
		$sqlRESULTteacherNOST001 = mysql_query($sqlSELECTteacherNOST001, $sqlLink);
		$sqlteacherNOST001NUMS = mysql_num_rows($sqlRESULTteacherNOST001);

		//取得最近一筆教師編號末3碼 並+1
		$sqlSELECTteacherNO = "SELECT teacherNO FROM teacherList ORDER BY id DESC";
		$sqlRESULTteacherNO = mysql_query($sqlSELECTteacherNO, $sqlLink);
		$sqlFETCHteacherNO = mysql_fetch_row($sqlRESULTteacherNO);
		$sqlteacherNOLast = $sqlFETCHteacherNO[0];
		$sqlteacherNOLastNUMs = substr($sqlteacherNOLast, -3);
		$sqlteacherNOLastNUMsAdd1 = $sqlteacherNOLastNUMs+$teacherNOadd1;
		$sqlteacherNOAdded = str_pad($sqlteacherNOLastNUMsAdd1, 3, "0", STR_PAD_LEFT);

		if ($sqlteacherNOST001NUMS != 0){
			$teacherNO = "ST".$sqlteacherNOAdded;
		}else{
			$teacherNO = $teacherNO;
		}

		//資料入庫
		$sqlINSERTteacherList = "INSERT IGNORE INTO teacherList ( teacherNO, teacherSchool, teacherCollege, teacherDepart, teacherType, teacherName, teacherPhone, teacherEmail, remarks ) VALUES ( '$teacherNO', '$teacherSchool', '$teacherCollege', '$teacherDepart', '$teacherType', '$teacherName', '$teacherPhone', '$teacherEmail', '$remarks' ) ";
		$result = mysql_query($sqlINSERTteacherList, $sqlLink);

		//回傳成功訊息
		echo json_encode($dataAdded);

	}

//}

?>




