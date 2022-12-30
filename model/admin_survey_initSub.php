<?php


require_once ("../vender/dbtools.inc.php");

// 設置資料類型 json，編碼格式 utf-8
header('Content-Type: application/json; charset=UTF-8');

//取得日期
$today = date("Y-m-d H:i:s");

// 回傳字串
$dataEPT = "「建立題組」所有資料欄位不得為空";
$res = "Done";

//接Ajax
$subGroup = $_POST["subGroup"];
	if ( $subGroup == '' ){
		echo json_encode($dataEPT);
		exit();
	}
$subTopic = $_POST["subTopic"];
	if ( $subTopic == '' ){
		echo json_encode($dataEPT);
		exit();
	}
// 建立該教師當年該主題組之初始副題組號
$subNumber = $subGroup.'a';

// 尋找是否已存在, 若存在則取最近一筆+1, 若否則做為初始
$sqlSELECTsubNumber = " SELECT * FROM surveySub WHERE number = '$subNumber' ";
$sqlRESULTsubNumber = mysql_query($sqlSELECTsubNumber, $sqlLink);
$sqlROWsubNumber = mysql_num_rows($sqlRESULTsubNumber);
if ($sqlROWsubNumber == 0 ){
	$subNumber = $subNumber;
}else{
	// 取得該師最近一筆該主題組之副題組
	$sqlSELECTlastSub = " SELECT number FROM surveySub WHERE number LIKE '$subGroup%' ORDER BY id desc ";
	$sqlRESULTlastSub = mysql_query($sqlSELECTlastSub, $sqlLink);
	$lastFETCHlastSub = mysql_fetch_array($sqlRESULTlastSub);
	$lastNumber = $lastFETCHlastSub[0];	// 該師最新一筆主題組紀錄
	$getStr = substr($lastNumber, -1);  // 取出最後一個字母
	$strOrd = ord($getStr); // 轉為ASCII
	$lastStr = chr($strOrd+1);
	$subNumber = $subGroup.$lastStr;
}

// 存入副題組資料庫
$sqlINSERTgroup = "
					INSERT INTO surveySub ( dateTime, number, topic )
					VALUES ( '$today', '$subNumber', '$subTopic' )
";
$sqlINSERT = mysql_query($sqlINSERTgroup, $sqlLink);

// 更新

echo json_encode($res);
exit();

?>