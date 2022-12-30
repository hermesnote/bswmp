<?php
//連線資料庫
require_once ("../vender/dbtools.inc.php");

// 設置資料類型 json，編碼格式 utf-8
header('Content-Type: application/json; charset=UTF-8');

//取得今天日期
$todayDate = date("Y-m-d H:i:s");

//取得cookie
$passed = $_COOKIE["passed"];
$account = $_COOKIE["account"];
$staffNO = $_COOKIE["staffNO"];
$staffName = $_COOKIE["staffName"];
// 若cookie中的變數passed不為TRUE，則導回登入頁
if ($passed != "TRUE"){
echo "<script type='text/javascript'>";
echo "alert('COOKIE錯誤或逾時!請重新登入！')";
echo "</script>";
header("location:admin_login.php");
exit();
}

//建立回傳參數
//$eventStartEmpty = '報名開始日為空!';
//$eventEndEmpty = '報名結束日為空!';
//$eventFeeEPT = '報名費為空';
//$bach1EPT = '一梯為空';
//$bach2EPT = '二梯為空';
//$bach3EPT = '三梯為空';
//$preEPT = '初賽時間為空';
//$finalEPT = '決賽時間為空';
//$eventStartThanToday = '報名開始日期須大於今天';
//$eventEndThanStart = '報名結束日期須大於報名開始日期';
//$eventPreThanEnd = '初賽時間須大於報名截止';
//$eventFinalThanPre = '決賽時間須大於初賽';
$eventAdded = '操作成功！';

//取得AJAX傳送值
$getEvent = $_POST["getEvent"];
$projectName = $_POST["projectName"];

//取得表單值
$start = $_POST["start"];
$end = $_POST["end"];
$fee = $_POST["fee"];
$bach1 = $_POST["bach1"];
$bach1Time = $_POST["bach1Time"];
$bach1Finals = $_POST["bach1Finals"];
$bach2 = $_POST["bach2"];
$bach2Time = $_POST["bach2Time"];
$bach2Finals = $_POST["bach2Finals"];
$bach3 = $_POST["bach3"];
$bach3Time = $_POST["bach3Time"];
$bach3Finals = $_POST["bach3Finals"];
$amount = $_POST["amount"];


//取得活動建立日年份末碼
$eventYear =  substr($todayDate, 2, 2);
$eventFullYear =  substr($todayDate, 0, 4);

//生成projectNO頭碼
$headProjectNO = $getEvent.$eventYear;

//查找第一梯是否存在
$sqlSearchPN = mysql_query("
	SELECT projectNO FROM histock_eventList WHERE projectNO LIKE '$getEvent%' ORDER BY id DESC
");
$sqlNUMPN = mysql_num_rows($sqlSearchPN);
if ($sqlNUMPN == 0){
	$projectNO = $headProjectNO.'001';
}else{
	$sqlFETCHPN = mysql_fetch_row($sqlSearchPN);
	$PN = substr($sqlFETCHPN[0], 4, 3);
	$sqlPN = $PN+1;
	$sqlPN = str_pad($sqlPN, 3, "0", STR_PAD_LEFT);
	$projectNO = $headProjectNO.$sqlPN;
}

////判斷生成活動代碼
//if ( $sqlPN != '001'){
//	$sqlPN = (string)$sqlPN+1;
//	$projectNO = $headProjectNO.$sqlPN;
//}else{
//	$projectNO = $headProjectNO.$sqlPN;
//}

////TEST2
//	echo json_encode($sqlPN);
//	exit();

//生成活動梯次




////對比競賽開始日期 (大於今日可)
//if (strtotime($start) < strtotime($todayDate)){
//	echo json_encode($eventStartThanToday);
//	exit();
//}
//
////競賽結束日期須大於開始日期
//if (strtotime($end) < strtotime($start)){
//	echo json_encode($eventEndThanStart);
//	exit();
//}
//
//if ($getEvent == 'HS'){
//
//	//初賽須大於報名截止
//	if (strtotime($preHS) < strtotime($end)){
//		echo json_encode($eventPreThanEnd);
//		exit();
//	}
//
//	//決賽須大於初賽
//	if (strtotime($finalHS) < strtotime($preHS)){
//		echo json_encode($eventFinalThanPre);
//		exit();
//	}
//}

//更新event資料庫
	$sqlINSERTevent = "
		INSERT INTO histock_eventList ( establish, projectNO, projectName, fee, startSignup, endSignup, bach1, bach1Time, bach1Finals, bach2, bach2Time, bach2Finals, bach3, bach3Time, bach3Finals, amount ) 
		VALUES( '$todayDate', '$projectNO', '$projectName', '$fee', '$start', '$end', '$bach1', '$bach1Time', '$bach1Finals', '$bach2', '$bach2Time', '$bach2Finals', '$bach3', '$bach3Time', '$bach3Finals', '$amount' )
		";
	$sqlINSERT = mysql_query($sqlINSERTevent, $sqlLink);

//寫入Log
	$file_name = "../log/adminLog.txt"; //檔案名稱
	$file = @file("$file_name"); //讀取檔案
	$open = @fopen("$file_name","a"); //開啟檔案，要是沒有檔案將建立一份
	$log =  "\r\n$todayDate $staffNO 新增了一筆競賽代號 $projectNO";
	@fwrite($open,$log); //寫入資料
	fclose($open); //關閉檔案

//回傳成功訊息
echo json_encode($eventAdded);
exit();

?>