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
$teamNOEmpty = '請輸入或選取隊伍編號！';
$teamNODNE = '隊伍編號不存在！';
$teamWRG = '該隊伍不適用簽到！';
$scoreAdded = '資料已更新！';

$teamNO = $_POST["teamNO"];
if ($teamNO == ''){
	echo json_encode($teamNOEmpty);
	exit();
}else if (!preg_match("/HS/i", $teamNO)){
	echo json_encode($teamWRG);
	exit();
}

$HSsignup = $_POST["HSsignup1"];
if ($HSsignup == 1){
	$score = '完成';
}
if ($HSsignup == 0){
	$score = '';
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
	
	//更新入圍
	$sqlUpdate = "
		UPDATE competScore
		set firstReport = '$score'
		WHERE teamNO = '$teamNO' AND projectNO = '$projectNO'
	";
	$sqlDoUpdate = mysql_query($sqlUpdate, $sqlLink);
	
}else{
	echo json_encode($teamNODNE);
	exit();
}

//寫入Log
	$file_name = "../log/adminLog.txt"; //檔案名稱
	$file = @file("$file_name"); //讀取檔案
	$open = @fopen("$file_name","a"); //開啟檔案，要是沒有檔案將建立一份
	$log =  "\r\n$todayDate $staffNO 編輯了 $teamNO 的初賽報到為 $score";
	@fwrite($open,$log); //寫入資料
	fclose($open); //關閉檔案

echo json_encode($scoreAdded);
exit();

?>