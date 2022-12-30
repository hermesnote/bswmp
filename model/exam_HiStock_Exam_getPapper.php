<?php
//連線資料庫
require_once("../vender/dbtools.inc.php");

//默認時區
date_default_timezone_set('PRC');

//取得現在日期時間
$getTime = date("Y-m-d H:i:s");

//取得COOKIE陣列並解序還原
$loginInfo = unserialize($_COOKIE["loginInfo"]);
$examNO = $loginInfo[0];	//帳號
$pwd = $loginInfo[1];	//驗證碼
$host = $loginInfo[2];	//公關招待
$projectNO = $loginInfo[3];	//活動代號
$projectName = '第'.substr($projectNO, 2, 5).'梯'.' '.$loginInfo[4];	//活動名稱
$fee = $loginInfo[5];	//報名費
$start = $loginInfo[6];	//開始報名
$end = $loginInfo[7];	//截止報名
$bach = $loginInfo[8];	//測驗梯次
$bachTimeAdd = $loginInfo[9]*60*60;	//測驗時間
$bachTimeAdded = strtotime($bach)+$bachTimeAdd;	//測驗結束時間
$finalCompet = $loginInfo[10]; // 決賽時間
$passed = $loginInfo[11];	//帳密符合

//COOKIE登入錯誤
if ($passed != "TRUE"){
echo "<script type='text/javascript'>";
echo "alert('COOKIE逾時或錯誤！請重新登入！');";
echo "window.location.href='histock_index.php';";
echo "</script>";
exit();
}

//取得今天日期
$startExam = date("Y-m-d H:i:s");
$endExam = date("Y-m-d H:i:s", strtotime($getStartTime."+50 minute"));

//檢查是否已取卷
$sqlPaperX = mysql_query("
	SELECT * FROM examPP_HiStock WHERE examNumber = '$examNO'
");
$sqlPaperY = mysql_num_rows($sqlPaperX);

// 若已取得試卷
if ( $sqlPaperY != 0 ){
	// 取得試卷編號
	$sqlPaperZ = mysql_fetch_row($sqlPaperX);
	$paperNumber = $sqlPaperZ[3];
	
	// 取得作答卷進度
	$sqlAQX = mysql_query("
		SELECT * FROM examAQ_HiStock WHERE examNumber = '$examNO'
	");
	$sqlAQY = mysql_fetch_row($sqlAQX);
	
	// 取得作答題號
		for ( $i=5; $i<55; $i++ ){
			if ($sqlAQY[$i] == ''){
				$j = $i-4;
				$PPZ = 'Q'.$j; // 取得目前試卷進度的欄位名稱
				$AQZ = 'A'.$j; // 取得目前作答進度的欄位名稱
				break;
			}
		}

	// 取得測驗時間
	$AQstart = $sqlAQY[3];
	$AQend = $sqlAQY[4];
	
	// 比較測驗時間
		// 若 登入時間  < 測驗開始時間 = 測驗尚未開始
	if (  strtotime($getTime) < strtotime($AQstart) ){
		echo "<script type='text/javascript'>";
		echo "alert('您的測驗時間尚未開始！');";
		echo "window.location.href='../view/histock_index.php';";
		echo "</script>";
		exit();
		// 若 登入時間 大於 測驗結束時間 = 測驗已經結束
	}else if ( strtotime($getTime) > strtotime($AQend) ){
		echo "<script type='text/javascript'>";
		echo "alert('您的測驗時間已經結束！');";
		echo "window.location.href='../view/histock_index.php';";
		echo "</script>";
		exit();		
	}
	
	// 建立資料Array 存入COOKIE
	$examData = array( $paperNumber, $AQstart, $AQend, $PPZ, $AQZ );
	setcookie("examData", serialize($examData), time()+3600, "/" ,"wmpcca.com");
	
	
}else{
	
// 若尚未取得試卷
	$sqlgetPaperX = mysql_query("
		SELECT paperNumber FROM examPP_HiStock WHERE examNumber = '' ORDER BY id ASC
	");
	$sqlgetPaperY = mysql_fetch_row($sqlgetPaperX);
	$paperNumber = $sqlgetPaperY[0];
	
	// 配對試卷
	$sqlUPDATE = mysql_query("
		UPDATE examPP_HiStock
		SET
		examNumber = '$examNO'
		WHERE paperNumber = '$paperNumber'
	");
	
	// 建立第一題及作答欄位名稱
	$PPZ = "Q1";
	$AQZ = "A1";
	
	// 產生作答卷 並建立 測驗時間
	$AQstart = $getTime;
	$AQend = date("Y-m-d H:i:s", strtotime($getTime."+ 50 minutes"));
	$sqlINSERTAQ = mysql_query("
		INSERT INTO examAQ_HiStock ( examNumber, paperNumber, startExam, endExam )
		VALUES ( '$examNO', '$paperNumber', '$AQstart', '$AQend' )
	");
	$sqlINSERTAT = mysql_query("
		INSERT INTO examAT_HiStock ( examNumber, paperNumber )
		VALUES ( '$examNO', '$paperNumber' )
	");
	
	// 建立資料Array 存入COOKIE
	$examData = array( $paperNumber, $AQstart, $AQend, $PPZ, $AQZ );
	setcookie("examData", serialize($examData), time()+3600, "/" ,"wmpcca.com");
	
}

// 建立成績表
//// 判斷HT HS
//if ( preg_match('/HT/i', $examNO)){
//	$scoreDB = 'histock_HTscore';
//}else if ( preg_match('/HS/i', $examNO) ){
//	$scoreDB = 'histock_HSscore';
//}
//
//$sqlINSERTscore = mysql_query("
//	INSERT INTO $scoreDB ( projectNO, examNumber, PaperNumber )
//	VALUES ( '$projectNO', '$examNO', '$paperNumber' )
//");

//導向測驗入口
header("Location:https://wmpcca.com/bswmp/form/view/exam_HiStock_Exam.php");
exit();
?>