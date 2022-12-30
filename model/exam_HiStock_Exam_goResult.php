<?php
//連線資料庫
require_once("../vender/dbtools.inc.php");


//默認時區
date_default_timezone_set('PRC');

// 設置資料類型 json，編碼格式 utf-8
header('Content-Type: application/json; charset=UTF-8');

// 取得AJAX資料
$listNumber = $_POST["listNumber"];		// 取得當前題序
$examNumber = $_POST["examNumber"];		// 取得准考證號
$paperNumber = $_POST["paperNumber"];	// 取得試卷編號
$AQ = $_POST["AQ"];						// 取得作答選項
$AT = $_POST["ansS"];					// 取得作答秒數

// 建立當前PP AQ AT 欄位名稱
$PPZ = "Q".$listNumber;
$AQZ = "A".$listNumber;
$ATZ = "A".$listNumber;

// UPDATE AQ
$sqlUPDATEAQ = "
	UPDATE examAQ_HiStock
	SET
	$AQZ = '$AQ'
	WHERE paperNumber = '$paperNumber'
";
$sqlDoUPDATEAQ = mysql_query($sqlUPDATEAQ, $sqlLink);

// UPDATE AT
$sqlUPDATEAT = "
	UPDATE examAT_HiStock
	SET
	$ATZ = '$AT'
	WHERE paperNumber = '$paperNumber'
";
$sqlDoUPDATEAT = mysql_query($sqlUPDATEAT, $sqlLink);

// 建立PP AN AQ AT陣列 並回傳
$NB = array();
$AN = array();
$AQ = array();
$AT = array();

$sqlPPX = mysql_query("
	SELECT * FROM examPP_HiStock WHERE paperNumber = '$paperNumber' 
");
$sqlPPY = mysql_fetch_row($sqlPPX);
$NB = $sqlPPY;
unset($NB[0], $NB[1], $NB[2], $NB[3]);
$NB = array_values($NB);

$sqlAQX = mysql_query("
	SELECT * FROM examAQ_HiStock WHERE paperNumber = '$paperNumber' 
");
$sqlAQY = mysql_fetch_row($sqlAQX);
$AQ = $sqlAQY;
unset($AQ[0], $AQ[1], $AQ[2], $AQ[3], $AQ[4]);
$AQ = array_values($AQ);

$sqlATX = mysql_query("
	SELECT * FROM examAT_HiStock WHERE paperNumber = '$paperNumber' 
");
$sqlATY = mysql_fetch_row($sqlATX);
$AT = $sqlATY;
unset($AT[0], $AT[1], $AT[2]);
$AT = array_values($AT);

$sqlANX = mysql_query("
	SELECT * FROM examAN_HiStock WHERE paperNumber = '$paperNumber' 
");
$sqlANY = mysql_fetch_row($sqlANX);
$AN = $sqlANY;
unset($AN[0], $AN[1]);
$AN = array_values($AN);

$arr = array($NB, $AN, $AQ, $AT);
echo json_encode($arr);

exit();

?>
