<?php
//連線資料庫
require_once("../vender/dbtools.inc.php");

//默認時區
date_default_timezone_set('PRC');

// 設置資料類型 json，編碼格式 utf-8
header('Content-Type: application/json; charset=UTF-8');

//取得AJAX資料
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

// 建立下一題PP題序
$i = $listNumber+1;
$PPZ = "Q".$i;

// 找出下一題的題號
$sqlPPX = mysql_query("
	SELECT $PPZ FROM examPP_HiStock WHERE paperNumber = '$paperNumber'
");
$sqlPPY = mysql_fetch_row($sqlPPX);
$nextTopic = $sqlPPY[0];

// 取得下一題資料
$sqlDBX = mysql_query("
	SELECT * FROM examDB_hiStock WHERE number = '$nextTopic'
");
$sqlDBY = mysql_fetch_row($sqlDBX);
$number = $sqlDBY[3];
$topic = $sqlDBY[4];
$choiceA = $sqlDBY[5];
$choiceB = $sqlDBY[6];
$choiceC = $sqlDBY[7];
$choiceD = $sqlDBY[8];
$listNumber = $i;


//建立回傳陣列
$arr = array($listNumber, $number, $topic, $choiceA, $choiceB, $choiceC, $choiceD);
echo json_encode($arr);
exit();

?>