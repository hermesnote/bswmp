<?php
//連線資料庫
require_once ("../vender/dbtools.inc.php");

//取得今天日期
$todayDate = date("Y-m-d H:i:s");
//
////取得cookie
//$passed = $_COOKIE["passed"];
//$account = $_COOKIE["account"];
//$staffNO = $_COOKIE["staffNO"];
//$staffName = $_COOKIE["staffName"];

//// 若cookie中的變數passed不為TRUE，則導回登入頁
//if ($passed != "TRUE"){
//	echo "<script type='text/javascript'>";
//	echo "alert('COOKIE錯誤或逾時!請重新登入！')";
//	echo "</script>";
//	header("location:admin_login.php");
//	exit();
//}


//更新評分資料庫
$scoreDB = "histock_HSscore";
$teamDB = "histock_HSsignup";

//取得AJAX傳送值
$projectNO = $_POST["selectProject"];
$bach = $_POST["selectBach"];
	if( $bach == 'bach1' ){
		$bachX = '北區';
	}
	if( $bach == 'bach2' ){
		$bachX = '中區';
	}
	if( $bach == 'bach3' ){
		$bachX = '南區';
	}
// 建立存值陣列
$examNumberArr = array();
$combineScoreArr = array();

// 建立bombineScore排名
$sqlSELECTcombineScore = " SELECT examNumber, combineScore FROM $scoreDB WHERE projectNO = '$projectNO' AND bach = '$bach' AND finalist = 'Y' AND combineScore != '' ORDER BY combineScore DESC ";
$sqlRESULTcombineScore = mysql_query($sqlSELECTcombineScore, $sqlLink);
while ( $row = mysql_fetch_array($sqlRESULTcombineScore) ){
	$examNumberArr[] = $row["examNumber"];
	$combineScoreArr[] = $row["combineScore"];
}
$examNumbers = $examNumberArr;
$combineScores = $combineScoreArr;
$j = count($examNumbers);
for( $i=0; $i<$j; $i++ ){
	$rank = $i+1;
	// rank存入DB
	$examNumber = $examNumbers[$i];
	$sqlUPDATE = "
	UPDATE $scoreDB
	SET
	rank = '$rank'
	WHERE examNumber = '$examNumber'
	";
	$sqlDOUPDATE = mysql_query($sqlUPDATE, $sqlLink);
}

// 名次
//$top1 = $examNumbers[0];
//$top2 = $examNumbers[1];
//$top3 = $examNumbers[2];
//$top4 = $examNumbers[3];
//$top5 = $examNumbers[4];
//$sec1 = $examNumbers[5];
//$sec2 = $examNumbers[6];
//$sec3 = $examNumbers[7];
//$sec4 = $examNumbers[8];
//$sec5 = $examNumbers[9];
//$left1 = $examNumbers[10];
//$left2 = $examNumbers[11];
//$left3 = $examNumbers[12];
//$left4 = $examNumbers[13];
//$left5 = $examNumbers[14];

// 成績
$score1 = $combineScores[0];
$score2 = $combineScores[1];
$score3 = $combineScores[2];
$score4 = $combineScores[3];
$score5 = $combineScores[4];
$score6 = $combineScores[5];
$score7 = $combineScores[6];
$score8 = $combineScores[7];
$score9 = $combineScores[8];
$score10 = $combineScores[9];
$score11 = $combineScores[10];
$score12 = $combineScores[11];
$score13 = $combineScores[12];
$score14 = $combineScores[13];
$score15 = $combineScores[14];

// 隊伍資訊
$top1 = $examNumbers[0];
	// 取隊名 城市 學校
	$sqlSELECTteamInfo1 = " SELECT teamName, city, school FROM $teamDB WHERE examNumber = '$examNumbers[0]' ";
	$sqlRESULTteamInfo1 = mysql_query($sqlSELECTteamInfo1, $sqlLink);
	$sqlFETCHteamInfo1 = mysql_fetch_array($sqlRESULTteamInfo1);
	$teamName1 = $sqlFETCHteamInfo1["teamName"];
	$cityCode1 = $sqlFETCHteamInfo1["city"];
		// 轉換城市
		$sqlSELECTcity1 = " SELECT city FROM cityCode WHERE cityCode = '$cityCode1' ";
		$sqlRESULTcity1 = mysql_query($sqlSELECTcity1, $sqlLink);
		$sqlFETCHcity1 = mysql_fetch_array($sqlRESULTcity1);
		$city1 = $sqlFETCHcity1["city"];
	$schoolCode1 = $sqlFETCHteamInfo1["school"];
		// 轉換校名
		$sqlSELECTschool1 = " SELECT school FROM hischoolCode WHERE cityCode = '$cityCode1' AND schoolCode = '$schoolCode1' ";
		$sqlRESULTschool1 = mysql_query($sqlSELECTschool1, $sqlLink);
		$sqlFETCHschool1 = mysql_fetch_array($sqlRESULTschool1);
		$school1 = $sqlFETCHschool1["school"];

$top2 = $examNumbers[1];
	// 取隊名 城市 學校
	$sqlSELECTteamInfo2 = " SELECT teamName, city, school FROM $teamDB WHERE examNumber = '$examNumbers[1]' ";
	$sqlRESULTteamInfo2 = mysql_query($sqlSELECTteamInfo2, $sqlLink);
	$sqlFETCHteamInfo2 = mysql_fetch_array($sqlRESULTteamInfo2);
	$teamName2 = $sqlFETCHteamInfo2["teamName"];
	$cityCode2 = $sqlFETCHteamInfo2["city"];
		// 轉換城市
		$sqlSELECTcity2 = " SELECT city FROM cityCode WHERE cityCode = '$cityCode2' ";
		$sqlRESULTcity2 = mysql_query($sqlSELECTcity2, $sqlLink);
		$sqlFETCHcity2 = mysql_fetch_array($sqlRESULTcity2);
		$city2 = $sqlFETCHcity2["city"];
	$schoolCode2 = $sqlFETCHteamInfo2["school"];
		// 轉換校名
		$sqlSELECTschool2 = " SELECT school FROM hischoolCode WHERE cityCode = '$cityCode2' AND schoolCode = '$schoolCode2' ";
		$sqlRESULTschool2 = mysql_query($sqlSELECTschool2, $sqlLink);
		$sqlFETCHschool2 = mysql_fetch_array($sqlRESULTschool2);
		$school2 = $sqlFETCHschool2["school"];

$top3 = $examNumbers[2];
	// 取隊名 城市 學校
	$sqlSELECTteaminfo3 = " SELECT teamName, city, school FROM $teamDB WHERE examNumber = '$examNumbers[2]' ";
	$sqlRESULTteaminfo3 = mysql_query($sqlSELECTteaminfo3, $sqlLink);
	$sqlFETCHteaminfo3 = mysql_fetch_array($sqlRESULTteaminfo3);
	$teamName3 = $sqlFETCHteaminfo3["teamName"];
	$cityCode3 = $sqlFETCHteaminfo3["city"];
		// 轉換城市
		$sqlSELECTcity3 = " SELECT city FROM cityCode WHERE cityCode = '$cityCode3' ";
		$sqlRESULTcity3 = mysql_query($sqlSELECTcity3, $sqlLink);
		$sqlFETCHcity3 = mysql_fetch_array($sqlRESULTcity3);
		$city3 = $sqlFETCHcity3["city"];
	$schoolCode3 = $sqlFETCHteaminfo3["school"];
		// 轉換校名
		$sqlSELECTschool3 = " SELECT school FROM hischoolCode WHERE cityCode = '$cityCode3' AND schoolCode = '$schoolCode3' ";
		$sqlRESULTschool3 = mysql_query($sqlSELECTschool3, $sqlLink);
		$sqlFETCHschool3 = mysql_fetch_array($sqlRESULTschool3);
		$school3 = $sqlFETCHschool3["school"];

$top4 = $examNumbers[3];
	// 取隊名 城市 學校
	$sqlSELECTteaminfo4 = " SELECT teamName, city, school FROM $teamDB WHERE examNumber = '$examNumbers[3]' ";
	$sqlRESULTteaminfo4 = mysql_query($sqlSELECTteaminfo4, $sqlLink);
	$sqlFETCHteaminfo4 = mysql_fetch_array($sqlRESULTteaminfo4);
	$teamName4 = $sqlFETCHteaminfo4["teamName"];
	$cityCode4 = $sqlFETCHteaminfo4["city"];
		// 轉換城市
		$sqlSELECTcity4 = " SELECT city FROM cityCode WHERE cityCode = '$cityCode4' ";
		$sqlRESULTcity4 = mysql_query($sqlSELECTcity4, $sqlLink);
		$sqlFETCHcity4 = mysql_fetch_array($sqlRESULTcity4);
		$city4 = $sqlFETCHcity4["city"];
	$schoolCode4 = $sqlFETCHteaminfo4["school"];
		// 轉換校名
		$sqlSELECTschool4 = " SELECT school FROM hischoolCode WHERE cityCode = '$cityCode4' AND schoolCode = '$schoolCode4' ";
		$sqlRESULTschool4 = mysql_query($sqlSELECTschool4, $sqlLink);
		$sqlFETCHschool4 = mysql_fetch_array($sqlRESULTschool4);
		$school4 = $sqlFETCHschool4["school"];

$top5 = $examNumbers[4];
	// 取隊名 城市 學校
	$sqlSELECTteaminfo5 = " SELECT teamName, city, school FROM $teamDB WHERE examNumber = '$examNumbers[4]' ";
	$sqlRESULTteaminfo5 = mysql_query($sqlSELECTteaminfo5, $sqlLink);
	$sqlFETCHteaminfo5 = mysql_fetch_array($sqlRESULTteaminfo5);
	$teamName5 = $sqlFETCHteaminfo5["teamName"];
	$cityCode5 = $sqlFETCHteaminfo5["city"];
		// 轉換城市
		$sqlSELECTcity5 = " SELECT city FROM cityCode WHERE cityCode = '$cityCode5' ";
		$sqlRESULTcity5 = mysql_query($sqlSELECTcity5, $sqlLink);
		$sqlFETCHcity5 = mysql_fetch_array($sqlRESULTcity5);
		$city5 = $sqlFETCHcity5["city"];
	$schoolCode5 = $sqlFETCHteaminfo5["school"];
		// 轉換校名
		$sqlSELECTschool5 = " SELECT school FROM hischoolCode WHERE cityCode = '$cityCode5' AND schoolCode = '$schoolCode5' ";
		$sqlRESULTschool5 = mysql_query($sqlSELECTschool5, $sqlLink);
		$sqlFETCHschool5 = mysql_fetch_array($sqlRESULTschool5);
		$school5 = $sqlFETCHschool5["school"];

$sec1 = $examNumbers[5];
	// 取隊名 城市 學校
	$sqlSELECTteaminfo6 = " SELECT teamName, city, school FROM $teamDB WHERE examNumber = '$examNumbers[5]' ";
	$sqlRESULTteaminfo6 = mysql_query($sqlSELECTteaminfo6, $sqlLink);
	$sqlFETCHteaminfo6 = mysql_fetch_array($sqlRESULTteaminfo6);
	$teamName6 = $sqlFETCHteaminfo6["teamName"];
	$cityCode6 = $sqlFETCHteaminfo6["city"];
		// 轉換城市
		$sqlSELECTcity6 = " SELECT city FROM cityCode WHERE cityCode = '$cityCode6' ";
		$sqlRESULTcity6 = mysql_query($sqlSELECTcity6, $sqlLink);
		$sqlFETCHcity6 = mysql_fetch_array($sqlRESULTcity6);
		$city6 = $sqlFETCHcity6["city"];
	$schoolCode6 = $sqlFETCHteaminfo6["school"];
		// 轉換校名
		$sqlSELECTschool6 = " SELECT school FROM hischoolCode WHERE cityCode = '$cityCode6' AND schoolCode = '$schoolCode6' ";
		$sqlRESULTschool6 = mysql_query($sqlSELECTschool6, $sqlLink);
		$sqlFETCHschool6 = mysql_fetch_array($sqlRESULTschool6);
		$school6 = $sqlFETCHschool6["school"];

$sec2 = $examNumbers[6];
	// 取隊名 城市 學校
	$sqlSELECTteaminfo7 = " SELECT teamName, city, school FROM $teamDB WHERE examNumber = '$examNumbers[6]' ";
	$sqlRESULTteaminfo7 = mysql_query($sqlSELECTteaminfo7, $sqlLink);
	$sqlFETCHteaminfo7 = mysql_fetch_array($sqlRESULTteaminfo7);
	$teamName7 = $sqlFETCHteaminfo7["teamName"];
	$cityCode7 = $sqlFETCHteaminfo7["city"];
		// 轉換城市
		$sqlSELECTcity7 = " SELECT city FROM cityCode WHERE cityCode = '$cityCode7' ";
		$sqlRESULTcity7 = mysql_query($sqlSELECTcity7, $sqlLink);
		$sqlFETCHcity7 = mysql_fetch_array($sqlRESULTcity7);
		$city7 = $sqlFETCHcity7["city"];
	$schoolCode7 = $sqlFETCHteaminfo7["school"];
		// 轉換校名
		$sqlSELECTschool7 = " SELECT school FROM hischoolCode WHERE cityCode = '$cityCode7' AND schoolCode = '$schoolCode7' ";
		$sqlRESULTschool7 = mysql_query($sqlSELECTschool7, $sqlLink);
		$sqlFETCHschool7 = mysql_fetch_array($sqlRESULTschool7);
		$school7 = $sqlFETCHschool7["school"];

$sec3 = $examNumbers[7];
	// 取隊名 城市 學校
	$sqlSELECTteaminfo8 = " SELECT teamName, city, school FROM $teamDB WHERE examNumber = '$examNumbers[7]' ";
	$sqlRESULTteaminfo8 = mysql_query($sqlSELECTteaminfo8, $sqlLink);
	$sqlFETCHteaminfo8 = mysql_fetch_array($sqlRESULTteaminfo8);
	$teamName8 = $sqlFETCHteaminfo8["teamName"];
	$cityCode8 = $sqlFETCHteaminfo8["city"];
		// 轉換城市
		$sqlSELECTcity8 = " SELECT city FROM cityCode WHERE cityCode = '$cityCode8' ";
		$sqlRESULTcity8 = mysql_query($sqlSELECTcity8, $sqlLink);
		$sqlFETCHcity8 = mysql_fetch_array($sqlRESULTcity8);
		$city8 = $sqlFETCHcity8["city"];
	$schoolCode8 = $sqlFETCHteaminfo8["school"];
		// 轉換校名
		$sqlSELECTschool8 = " SELECT school FROM hischoolCode WHERE cityCode = '$cityCode8' AND schoolCode = '$schoolCode8' ";
		$sqlRESULTschool8 = mysql_query($sqlSELECTschool8, $sqlLink);
		$sqlFETCHschool8 = mysql_fetch_array($sqlRESULTschool8);
		$school8 = $sqlFETCHschool8["school"];

$sec4 = $examNumbers[8];
	// 取隊名 城市 學校
	$sqlSELECTteaminfo9 = " SELECT teamName, city, school FROM $teamDB WHERE examNumber = '$examNumbers[8]' ";
	$sqlRESULTteaminfo9 = mysql_query($sqlSELECTteaminfo9, $sqlLink);
	$sqlFETCHteaminfo9 = mysql_fetch_array($sqlRESULTteaminfo9);
	$teamName9 = $sqlFETCHteaminfo9["teamName"];
	$cityCode9 = $sqlFETCHteaminfo9["city"];
		// 轉換城市
		$sqlSELECTcity9 = " SELECT city FROM cityCode WHERE cityCode = '$cityCode9' ";
		$sqlRESULTcity9 = mysql_query($sqlSELECTcity9, $sqlLink);
		$sqlFETCHcity9 = mysql_fetch_array($sqlRESULTcity9);
		$city9 = $sqlFETCHcity9["city"];
	$schoolCode9 = $sqlFETCHteaminfo9["school"];
		// 轉換校名
		$sqlSELECTschool9 = " SELECT school FROM hischoolCode WHERE cityCode = '$cityCode9' AND schoolCode = '$schoolCode9' ";
		$sqlRESULTschool9 = mysql_query($sqlSELECTschool9, $sqlLink);
		$sqlFETCHschool9 = mysql_fetch_array($sqlRESULTschool9);
		$school9 = $sqlFETCHschool9["school"];

$sec5 = $examNumbers[9];
	// 取隊名 城市 學校
	$sqlSELECTteaminfo10 = " SELECT teamName, city, school FROM $teamDB WHERE examNumber = '$examNumbers[9]' ";
	$sqlRESULTteaminfo10 = mysql_query($sqlSELECTteaminfo10, $sqlLink);
	$sqlFETCHteaminfo10 = mysql_fetch_array($sqlRESULTteaminfo10);
	$teamName10 = $sqlFETCHteaminfo10["teamName"];
	$cityCode10 = $sqlFETCHteaminfo10["city"];
		// 轉換城市
		$sqlSELECTcity10 = " SELECT city FROM cityCode WHERE cityCode = '$cityCode10' ";
		$sqlRESULTcity10 = mysql_query($sqlSELECTcity10, $sqlLink);
		$sqlFETCHcity10 = mysql_fetch_array($sqlRESULTcity10);
		$city10 = $sqlFETCHcity10["city"];
	$schoolCode10 = $sqlFETCHteaminfo10["school"];
		// 轉換校名
		$sqlSELECTschool10 = " SELECT school FROM hischoolCode WHERE cityCode = '$cityCode10' AND schoolCode = '$schoolCode10' ";
		$sqlRESULTschool10 = mysql_query($sqlSELECTschool10, $sqlLink);
		$sqlFETCHschool10 = mysql_fetch_array($sqlRESULTschool10);
		$school10 = $sqlFETCHschool10["school"];

$left1 = $examNumbers[10];
	// 取隊名 城市 學校
	$sqlSELECTteaminfo11 = " SELECT teamName, city, school FROM $teamDB WHERE examNumber = '$examNumbers[10]' ";
	$sqlRESULTteaminfo11 = mysql_query($sqlSELECTteaminfo11, $sqlLink);
	$sqlFETCHteaminfo11 = mysql_fetch_array($sqlRESULTteaminfo11);
	$teamName11 = $sqlFETCHteaminfo11["teamName"];
	$cityCode11 = $sqlFETCHteaminfo11["city"];
		// 轉換城市
		$sqlSELECTcity11 = " SELECT city FROM cityCode WHERE cityCode = '$cityCode11' ";
		$sqlRESULTcity11 = mysql_query($sqlSELECTcity11, $sqlLink);
		$sqlFETCHcity11 = mysql_fetch_array($sqlRESULTcity11);
		$city11 = $sqlFETCHcity11["city"];
	$schoolCode11 = $sqlFETCHteaminfo11["school"];
		// 轉換校名
		$sqlSELECTschool11 = " SELECT school FROM hischoolCode WHERE cityCode = '$cityCode11' AND schoolCode = '$schoolCode11' ";
		$sqlRESULTschool11 = mysql_query($sqlSELECTschool11, $sqlLink);
		$sqlFETCHschool11 = mysql_fetch_array($sqlRESULTschool11);
		$school11 = $sqlFETCHschool11["school"];

$left2 = $examNumbers[11];
	// 取隊名 城市 學校
	$sqlSELECTteaminfo12 = " SELECT teamName, city, school FROM $teamDB WHERE examNumber = '$examNumbers[11]' ";
	$sqlRESULTteaminfo12 = mysql_query($sqlSELECTteaminfo12, $sqlLink);
	$sqlFETCHteaminfo12 = mysql_fetch_array($sqlRESULTteaminfo12);
	$teamName12 = $sqlFETCHteaminfo12["teamName"];
	$cityCode12 = $sqlFETCHteaminfo12["city"];
		// 轉換城市
		$sqlSELECTcity12 = " SELECT city FROM cityCode WHERE cityCode = '$cityCode12' ";
		$sqlRESULTcity12 = mysql_query($sqlSELECTcity12, $sqlLink);
		$sqlFETCHcity12 = mysql_fetch_array($sqlRESULTcity12);
		$city12 = $sqlFETCHcity12["city"];
	$schoolCode12 = $sqlFETCHteaminfo12["school"];
		// 轉換校名
		$sqlSELECTschool12 = " SELECT school FROM hischoolCode WHERE cityCode = '$cityCode12' AND schoolCode = '$schoolCode12' ";
		$sqlRESULTschool12 = mysql_query($sqlSELECTschool12, $sqlLink);
		$sqlFETCHschool12 = mysql_fetch_array($sqlRESULTschool12);
		$school12 = $sqlFETCHschool12["school"];

$left3 = $examNumbers[12];
	// 取隊名 城市 學校
	$sqlSELECTteaminfo13 = " SELECT teamName, city, school FROM $teamDB WHERE examNumber = '$examNumbers[12]' ";
	$sqlRESULTteaminfo13 = mysql_query($sqlSELECTteaminfo13, $sqlLink);
	$sqlFETCHteaminfo13 = mysql_fetch_array($sqlRESULTteaminfo13);
	$teamName13 = $sqlFETCHteaminfo13["teamName"];
	$cityCode13 = $sqlFETCHteaminfo13["city"];
		// 轉換城市
		$sqlSELECTcity13 = " SELECT city FROM cityCode WHERE cityCode = '$cityCode13' ";
		$sqlRESULTcity13 = mysql_query($sqlSELECTcity13, $sqlLink);
		$sqlFETCHcity13 = mysql_fetch_array($sqlRESULTcity13);
		$city13 = $sqlFETCHcity13["city"];
	$schoolCode13 = $sqlFETCHteaminfo13["school"];
		// 轉換校名
		$sqlSELECTschool13 = " SELECT school FROM hischoolCode WHERE cityCode = '$cityCode13' AND schoolCode = '$schoolCode13' ";
		$sqlRESULTschool13 = mysql_query($sqlSELECTschool13, $sqlLink);
		$sqlFETCHschool13 = mysql_fetch_array($sqlRESULTschool13);
		$school13 = $sqlFETCHschool13["school"];

$left4 = $examNumbers[13];
	// 取隊名 城市 學校
	$sqlSELECTteaminfo14 = " SELECT teamName, city, school FROM $teamDB WHERE examNumber = '$examNumbers[13]' ";
	$sqlRESULTteaminfo14 = mysql_query($sqlSELECTteaminfo14, $sqlLink);
	$sqlFETCHteaminfo14 = mysql_fetch_array($sqlRESULTteaminfo14);
	$teamName14 = $sqlFETCHteaminfo14["teamName"];
	$cityCode14 = $sqlFETCHteaminfo14["city"];
		// 轉換城市
		$sqlSELECTcity14 = " SELECT city FROM cityCode WHERE cityCode = '$cityCode14' ";
		$sqlRESULTcity14 = mysql_query($sqlSELECTcity14, $sqlLink);
		$sqlFETCHcity14 = mysql_fetch_array($sqlRESULTcity14);
		$city14 = $sqlFETCHcity14["city"];
	$schoolCode14 = $sqlFETCHteaminfo14["school"];
		// 轉換校名
		$sqlSELECTschool14 = " SELECT school FROM hischoolCode WHERE cityCode = '$cityCode14' AND schoolCode = '$schoolCode14' ";
		$sqlRESULTschool14 = mysql_query($sqlSELECTschool14, $sqlLink);
		$sqlFETCHschool14 = mysql_fetch_array($sqlRESULTschool14);
		$school14 = $sqlFETCHschool14["school"];

$left5 = $examNumbers[14];
	// 取隊名 城市 學校
	$sqlSELECTteaminfo15 = " SELECT teamName, city, school FROM $teamDB WHERE examNumber = '$examNumbers[14]' ";
	$sqlRESULTteaminfo15 = mysql_query($sqlSELECTteaminfo15, $sqlLink);
	$sqlFETCHteaminfo15 = mysql_fetch_array($sqlRESULTteaminfo15);
	$teamName15 = $sqlFETCHteaminfo15["teamName"];
	$cityCode15 = $sqlFETCHteaminfo15["city"];
		// 轉換城市
		$sqlSELECTcity15 = " SELECT city FROM cityCode WHERE cityCode = '$cityCode15' ";
		$sqlRESULTcity15 = mysql_query($sqlSELECTcity15, $sqlLink);
		$sqlFETCHcity15 = mysql_fetch_array($sqlRESULTcity15);
		$city15 = $sqlFETCHcity15["city"];
	$schoolCode15 = $sqlFETCHteaminfo15["school"];
		// 轉換校名
		$sqlSELECTschool15 = " SELECT school FROM hischoolCode WHERE cityCode = '$cityCode15' AND schoolCode = '$schoolCode15' ";
		$sqlRESULTschool15 = mysql_query($sqlSELECTschool15, $sqlLink);
		$sqlFETCHschool15 = mysql_fetch_array($sqlRESULTschool15);
		$school15 = $sqlFETCHschool15["school"];


?>


<!doctype html>
<html>
<head>
<?php require_once("../model/index_rel.php") ?>

<link rel=stylesheet type="text/css" href="../css/body_global.css">
<meta charset="utf-8">
<title>「<? echo $projectNO; ?> <? echo $bachx; ?>」競賽成果</title>

<style>


</style>
	
</head>

<body>
	<?php require_once("../model/waitload.php") ?>

	<section class="container-white py-5">
		<div class="container">
			<div class="row">
				<div class="col mx-auto text-center">
					<img src="../img/logo_01.png">
					<p class="h1 text-info mt-5">第 <? echo substr($projectNO, 2, 5) ?> 梯</p>
					<p class="h2 text-info">金融與證券投資實務知識奧運會競賽</p>
					<h3 class="text-info">「<? echo $bachX; ?>」競賽成果</h2>
				</div>
			</div>
		</div>
	</section>


	<div class="jumbotron jumbotron-fluid" style="margin-bottom: 0;">
		<div class="container">
			
			<div class="row">
				<div class="col">
					<h1 class="display-4 mx-auto text-center font-weight-bolder" style="color: gold;"><i class="fas fa-trophy"></i> <i class="fas fa-trophy"></i> <i class="fas fa-trophy"></i> <i class="fas fa-trophy"></i> <i class="fas fa-trophy"></i></h1><br>
					<h1 class="mx-auto text-center font-weight-bolder" style="color: gold;">TOP 5</h1><br>
				</div>
			</div>
			
			<div class="row py-2">
				<div class="col">
					<div class="card">
					  <div class="card-body mx-auto text-center" style="color: gold">
						<p class="display-1 font-weight-bold">第一名</p>
						<p class="h3 font-weight-bold"><? echo $city1 ?> <? echo $school1 ?></p>
						<p class="h3 font-weight-bold"><? echo $top1 ?></p>
						<p class="h2 font-weight-bold"><? echo $teamName1 ?></p>
						<p class="display-1 font-weight-bold"><? echo $score1 ?></p>
					  </div>
					</div>
				</div>
			</div>
			
			<div class="row py-2">
				<div class="col">
					<div class="card">
					  <div class="card-body mx-auto text-center">
						<p class="h1">第二名</p>
						<p class="h3"><? echo $city2 ?> <? echo $school2 ?></p>
						<p class="h3"><? echo $top2 ?></p>
						<p class="h2"><? echo $teamName2 ?></p>
						<p class="h1"><? echo $score2 ?></p>
					  </div>
					</div>
				</div>
				<div class="col">
					<div class="card">
					  <div class="card-body mx-auto text-center">
						<p class="h1">第三名</p>
						<p class="h3"><? echo $city3 ?> <? echo $school3 ?></p>
						<p class="h3"><? echo $top3 ?></p>
						<p class="h2"><? echo $teamName3 ?></p>
						<p class="h1"><? echo $score3 ?></p>
					  </div>
					</div>
				</div>
			</div>
			
			<div class="row">
				<div class="col">
					<div class="card">
					  <div class="card-body mx-auto text-center">
						<p class="h1">第四名</p>
						<p class="h3"><? echo $city4 ?> <? echo $school4 ?></p>
						<p class="h3"><? echo $top4 ?></p>
						<p class="h2"><? echo $teamName4 ?></p>
						<p class="h1"><? echo $score4 ?></p>
					  </div>
					</div>
				</div>
				<div class="col">
					<div class="card">
					  <div class="card-body mx-auto text-center">
						<p class="h1">第五名</p>
						<p class="h3"><? echo $city5 ?> <? echo $school5 ?></p>
						<p class="h3"><? echo $top5 ?></p>
						<p class="h2"><? echo $teamName5 ?></p>
						<p class="h1"><? echo $score5 ?></p>
					  </div>
					</div>
				</div>
			</div>
			
		</div>
	</div>

	<section class="bg-white-50 py-5">
		<div class="container">

			<div class="row">
				<div class="col">
					<h1 class="display-4 mx-auto text-center font-weight-bolder" style="color: darkorange;"><i class="fas fa-medal"></i> <i class="fas fa-medal"></i> <i class="fas fa-medal"></i></h1><br>
					<h1 class="mx-auto text-center font-weight-bolder" style="color: darkorange;">優勝</h1><br>
				</div>
			</div>

			<div class="row py-2">
				<div class="col">
					<div class="card">
					  <div class="card-body mx-auto text-center">
						<p class="h3"><? echo $city6 ?> <? echo $school6 ?></p>
						<p class="h3"><? echo $sec1 ?></p>
						<p class="h2"><? echo $teamName6 ?></p>
						<p class="h1"><? echo $score6 ?></p>
					  </div>
					</div>
				</div>
			</div>
			
			<div class="row py-2">
				<div class="col">
					<div class="card">
					  <div class="card-body mx-auto text-center">
						<p class="h3"><? echo $city7 ?> <? echo $school7 ?></p>
						<p class="h3"><? echo $sec2 ?></p>
						<p class="h2"><? echo $teamName7 ?></p>
						<p class="h1"><? echo $score7 ?></p>
					  </div>
					</div>
				</div>
				<div class="col">
					<div class="card">
					  <div class="card-body mx-auto text-center">
						<p class="h3"><? echo $city8 ?> <? echo $school8 ?></p>
						<p class="h3"><? echo $sec3 ?></p>
						<p class="h2"><? echo $teamName8 ?></p>
						<p class="h1"><? echo $score8 ?></p>
					  </div>
					</div>
				</div>
			</div>
			
			<div class="row">
				<div class="col">
					<div class="card">
					  <div class="card-body mx-auto text-center">
						<p class="h3"><? echo $city9 ?> <? echo $school9 ?></p>
						<p class="h3"><? echo $sec4 ?></p>
						<p class="h2"><? echo $teamName9 ?></p>
						<p class="h1"><? echo $score9 ?></p>
					  </div>
					</div>
				</div>
				<div class="col">
					<div class="card">
					  <div class="card-body mx-auto text-center">
						<p class="h3"><? echo $city10 ?> <? echo $school10 ?></p>
						<p class="h3"><? echo $sec5 ?></p>
						<p class="h2"><? echo $teamName10 ?></p>
						<p class="h1"><? echo $score10 ?></p>
					  </div>
					</div>
				</div>
			</div>
			
		</div>
	</section>

	<section class="bg-light py-5">
		<div class="container">

			<div class="row">
				<div class="col">
					<h1 class="display-4 mx-auto text-center" style="color:lightskyblue;"><i class="fas fa-star"></i> <i class="fas fa-star"></i> <i class="fas fa-star"></i></h1><br>
					<h1 class="mx-auto text-center" style="color: cadetblue;">佳作</h1><br>
				</div>
			</div>
			
			<div class="row py-2">
				<div class="col">
					<div class="card">
					  <div class="card-body mx-auto text-center">
						<p class="h3"><? echo $city11 ?> <? echo $school11 ?></p>
						<p class="h3"><? echo $left1 ?></p>
						<p class="h2"><? echo $teamName11 ?></p>
						<p class="h1"><? echo $score11 ?></p>
					  </div>
					</div>
				</div>
			</div>
			
			<div class="row py-2">
				<div class="col">
					<div class="card">
					  <div class="card-body mx-auto text-center">
						<p class="h3"><? echo $city12 ?> <? echo $school12 ?></p>
						<p class="h3"><? echo $left2 ?></p>
						<p class="h2"><? echo $teamName12 ?></p>
						<p class="h1"><? echo $score12 ?></p>
					  </div>
					</div>
				</div>
				<div class="col">
					<div class="card">
					  <div class="card-body mx-auto text-center">
						<p class="h3"><? echo $city13 ?> <? echo $school13 ?></p>
						<p class="h3"><? echo $left3 ?></p>
						<p class="h2"><? echo $teamName13 ?></p>
						<p class="h1"><? echo $score13 ?></p>
					  </div>
					</div>
				</div>
			</div>
			
			<div class="row">
				<div class="col">
					<div class="card">
					  <div class="card-body mx-auto text-center">
						<p class="h3"><? echo $city14 ?> <? echo $school14 ?></p>
						<p class="h3"><? echo $left4 ?></p>
						<p class="h2"><? echo $teamName14 ?></p>
						<p class="h1"><? echo $score14 ?></p>
					  </div>
					</div>
				</div>
				<div class="col">
					<div class="card">
					  <div class="card-body mx-auto text-center">
						<p class="h3"><? echo $city15 ?> <? echo $school15 ?></p>
						<p class="h3"><? echo $left5 ?></p>
						<p class="h2"><? echo $teamName15 ?></p>
						<p class="h1"><? echo $score15 ?></p>
					  </div>
					</div>
				</div>
			</div>

		</div>
	</section>
	
<!--
	<div>
		examNumberArr = <? echo $examNumberArr ?><br>
		combineScoreArr = <? echo $combineScoreArr ?><br>
		examNumbers = <? echo $examNumbers ?><br>
		combineScores = <? echo $combineScores ?><br>
		array1 = <? echo print_r($examNumbers) ?><br>
		array2 = <? echo print_r($combineScores) ?><br>
		exmaNumbers[0] = <? echo $examNumbers[0] ?><br>
		exmaNumbers[1] = <? echo $examNumbers[1] ?><br>
		exmaNumbers[2] = <? echo $examNumbers[2] ?><br>
		exmaNumbers[3] = <? echo $examNumbers[3] ?><br>
		exmaNumbers[4] = <? echo $examNumbers[4] ?><br>
		exmaNumber[0] = <? echo $examNumber[0] ?><br>
		exmaNumber[1] = <? echo $examNumber[1] ?><br>
		exmaNumber[2] = <? echo $examNumber[2] ?><br>
		exmaNumber[3] = <? echo $examNumber[3] ?><br>
		exmaNumber[4] = <? echo $examNumber[4] ?><br>
		combineScores = <? echo $combineScores ?><br>
		j = <? echo $j ?><br>
		rank = <? echo $rank ?><br>
		<br><br><br>
		成績預覽<br>
		第一名 : <? echo $top1; ?> , 成績 : <? echo $score1 ?><br>
			城市 : <? echo $city1 ?> , 學校 : <? echo $school1 ?> , 隊名 : <? echo $teamName1 ?><br>
		第二名 : <? echo $top2 ?> , 成績 : <? echo $score2 ?><br>
			城市 : <? echo $city2 ?> , 學校 : <? echo $school2 ?> , 隊名 : <? echo $teamName2 ?><br>
		第三名 : <? echo $top3; ?> , 成績 : <? echo $score3 ?><br>
			城市 : <? echo $city3 ?> , 學校 : <? echo $school3 ?> , 隊名 : <? echo $teamName3 ?><br>
		第四名 : <? echo $top4; ?> , 成績 : <? echo $score4 ?><br>
			城市 : <? echo $city4 ?> , 學校 : <? echo $school4 ?> , 隊名 : <? echo $teamName4 ?><br>
		第五名 : <? echo $top5; ?> , 成績 : <? echo $score5 ?><br>
			城市 : <? echo $city5 ?> , 學校 : <? echo $school5 ?> , 隊名 : <? echo $teamName5 ?><br>
		第六名(優勝) : <? echo $sec1 ?> , 成績 : <? echo $score6 ?><br>
			城市 : <? echo $city6 ?> , 學校 : <? echo $school6 ?> , 隊名 : <? echo $teamName6 ?><br>
		第七名(優勝) : <? echo $sec2 ?> , 成績 : <? echo $score7 ?><br>
			城市 : <? echo $city7 ?> , 學校 : <? echo $school7 ?> , 隊名 : <? echo $teamName7 ?><br>
		第八名(優勝) : <? echo $sec3 ?> , 成績 : <? echo $score8 ?><br>
			城市 : <? echo $city8 ?> , 學校 : <? echo $school8 ?> , 隊名 : <? echo $teamName8 ?><br>
		第九名(優勝) : <? echo $sec4 ?> , 成績 : <? echo $score9 ?><br>
			城市 : <? echo $city9 ?> , 學校 : <? echo $school9 ?> , 隊名 : <? echo $teamName9 ?><br>
		第十名(優勝) : <? echo $sec5 ?> , 成績 : <? echo $score10 ?><br>
			城市 : <? echo $city10 ?> , 學校 : <? echo $school10 ?> , 隊名 : <? echo $teamName10 ?><br>
		第十一名(佳作) : <? echo $left1 ?> , 成績 : <? echo $score11 ?><br>
			城市 : <? echo $city11 ?> , 學校 : <? echo $school11 ?> , 隊名 : <? echo $teamName11 ?><br>
		第十二名(佳作) : <? echo $left2 ?> , 成績 : <? echo $score12 ?><br>
			城市 : <? echo $city12 ?> , 學校 : <? echo $school12 ?> , 隊名 : <? echo $teamName12 ?><br>
		第十三名(佳作) : <? echo $left3 ?> , 成績 : <? echo $score13 ?><br>
			城市 : <? echo $city13 ?> , 學校 : <? echo $school13 ?> , 隊名 : <? echo $teamName13 ?><br>
		第十四名(佳作) : <? echo $left4 ?> , 成績 : <? echo $score14 ?><br>
			城市 : <? echo $city14 ?> , 學校 : <? echo $school14 ?> , 隊名 : <? echo $teamName14 ?><br>
		第十五名(佳作) : <? echo $left5 ?> , 成績 : <? echo $score15 ?><br>
			城市 : <? echo $city15 ?> , 學校 : <? echo $school15 ?> , 隊名 : <? echo $teamName15 ?><br>
	</div>
-->

<?php require_once("../model/index_js.php") ?>
<script type="text/javascript" src="../controller/waitload.js"></script>
<script type="text/javascript" src="../controller/index_nav.js"></script>
<script type="text/javascript" src="../controller/toggle_tooltip.js"></script>
<script type="text/javascript" src="../controller/cc_imgGroup_Option1.js"></script>

</body>
</html>