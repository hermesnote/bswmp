<?php
//連線資料庫
require_once("../vender/dbtools.inc.php");

//默認時區
date_default_timezone_set('PRC');

//清除相關 COOKIE
setcookie("number", "", time()-3600, "/" ,"wmpcca.com");
setcookie("answer", "", time()-3600, "/" ,"wmpcca.com");
setcookie("AQ", "", time()-3600, "/" ,"wmpcca.com");
setcookie("AT", "", time()-3600, "/" ,"wmpcca.com");

//取得今天日期
$getStartTime = date("Y-m-d H:i:s");
$getEndTime = date('Y-m-d H:i:s', strtotime($getStartTime.'+50 minute'));

//取得模擬試題題號存成陣列 @ COOKIE
$sqlMock50 = mysql_query("
		SELECT number,answer FROM (SELECT DISTINCT * FROM examDB_hiStock WHERE mock = 'Y' ORDER BY RAND() LIMIT 50) as TEST ORDER BY number ASC
");

//建立陣列
$Fetch_Number = array();
$Fetch_Answer = array();

//While取得值

while ($row = mysql_fetch_array($sqlMock50)){
	$Fetch_Number[] = $row['number'];
	$Fetch_Answer[] = $row['answer'];
}

$numberArray = $Fetch_Number;
$answerArray = $Fetch_Answer;
$AQArray = array();
$ATArray = array();

//陣列序列存入COOKIE
setcookie("number", serialize($numberArray), time()+3600, "/" ,"wmpcca.com");
setcookie("answer", serialize($answerArray), time()+3600, "/" ,"wmpcca.com");
setcookie("AQ", serialize($AQArray), time()+3600, "/" ,"wmpcca.com");
setcookie("AT", serialize($ATArray), time()+3600, "/" ,"wmpcca.com");



//導向測驗入口
header("Location:https://wmpcca.com/bswmp/form/view/exam_HiStock_Mock.php");
exit();
?>