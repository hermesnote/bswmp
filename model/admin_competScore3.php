<?php
//連線資料庫
require_once ("../vender/dbtools.inc.php");

// 設置資料類型 json，編碼格式 utf-8
header('Content-Type: application/json; charset=UTF-8');

//取得cookie
$passed = $_COOKIE["passed"];
$account = $_COOKIE["account"];
$staffNO = $_COOKIE["staffNO"];
$staffName = $_COOKIE["staffName"];
// 若cookie中的變數passed不為TRUE，則導回登入頁
if ($passed != "TRUE"){
echo "<script type='text/javascript'>";
echo "alert('COOKIE錯誤!請重新登入！')";
echo "</script>";
header("location:admin_login.php");
exit();
}


//取得今天日期
$todayDate = date("Y-m-d H:i:s");

//建立回傳參數
$NOTrefer = '您不具有總評資格！';
$teamNOEmpty = '請輸入或選取隊伍編號！';
$teamNODNE = '隊伍編號不存在！';
$scoreEmpty = '分數未填！';
$score3Added = '資料已更新！';
$scoreRange = '請輸入0-100!';

$sqlSELECTrefer0 = " SELECT postType FROM staffList WHERE staffNO = '$staffNO'";
$sqlRESULTrefer0 = mysql_query($sqlSELECTrefer0, $sqlLink);
$sqlNUMROWSrefer0 = mysql_FETCH_ROW($sqlRESULTrefer0);
$sqlRefer0 = $sqlNUMROWSrefer0[0];

if ($sqlRefer0 != '0'){
    echo json_encode($NOTrefer);
	exit();
}

$teamNO = $_POST["teamNO"];
if ($teamNO == ''){
	echo json_encode($teamNOEmpty);
	exit();
}

$score3 = $_POST["score3"];
if ($score3 == ''){
	echo json_encode($scoreEmpty);
	exit();
}

if ($score3 < 0 OR $score3 > 100){
	echo json_encode($scoreRange);
	exit();
}

//檢驗隊編 @ competScore
$sqlSELECTteamNO = " SELECT * FROM competScore WHERE teamNO = '$teamNO' ";
$sqlRESULTteamNO = mysql_query($sqlSELECTteamNO, $sqlLink);
$sqlNUMROWSteamNO = mysql_num_rows($sqlRESULTteamNO);
if ($sqlNUMROWSteamNO != 0){  //如果隊編存在 取得項目代碼
	$sqlSELECTprojectNO = " SELECT projectNO FROM competScore WHERE teamNO = '$teamNO' ";
	$sqlRESULTprojectNO = mysql_query($sqlSELECTprojectNO, $sqlLink);
	$sqlFETCHprojectNO = mysql_fetch_row($sqlRESULTprojectNO);
	$projectNO = $sqlFETCHprojectNO[0];
}else{
	echo json_encode($teamNODNE);
	exit();
}

	//更新 secondRound 總評資料
	$sqlINSERTsecondRound = "
		INSERT INTO competScore ( projectNO, teamNO, secondRound ) VALUES( '$projectNO', '$teamNO', '$score3' )
		ON DUPLICATE KEY UPDATE
		projectNO = '$projectNO', teamNO = '$teamNO', secondRound = '$score3'
		";
	$sqlsecondRound = mysql_query($sqlINSERTsecondRound, $sqlLink);



echo json_encode($score3Added);
exit();



?>