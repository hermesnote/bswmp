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

//建立回傳參數
$projectNOEmpty = '競賽代碼為空';
$startDate1Empty = '初審開始日期為空';
$endDate1Empty = '初審結束日期為空';
$startDate2Empty = '決審開始日期為空';
$endDate2Empty = '決審結束日期為空';
$referAEmpty = '評審A為空';
$referBEmpty = '評審B為空';
$referCEmpty = '評審C為空';
$referDEmpty = '評審D為空';
$referEEmpty = '評審E為空';
$referXEmpty = '評審X為空';
$referYEmpty = '評審Y為空';
$referZEmpty = '評審Z為空';
$startDate1Passed = '初審開始日期須大於今天';
$endDate1Passed = '初審結束日期須大於今天';
$dateComp1 = '初審結束日期須大於初審開始日期';
$startDate2Passed = '決審開始日期須大於今天';
$endDate2Passed = '決審結束日期須大於今天';
$dateComp2 = '決審結束日期須大於決審開始日期';
$projectNODNE = '競賽代碼錯誤或不存在';
$referADNE = '評審A編號錯誤或不存在';
$referBDNE = '評審B編號錯誤或不存在';
$referCDNE = '評審C編號錯誤或不存在';
$referDDNE = '評審D編號錯誤或不存在';
$referEDNE = '評審E編號錯誤或不存在';
$referXDNE = '評審X編號錯誤或不存在';
$referYDNE = '評審Y編號錯誤或不存在';
$referZDNE = '評審Z編號錯誤或不存在';
$referDup = '評審重覆！請確認！';
$referSelected = '資料已更新！';


//取得今天日期
$todayDate = date("Y-m-d H:i:s");

//取得AJAX傳送值
$projectNO = $_POST["projectNO"];
	if($projectNO == ''){
		echo json_encode($projectNOEmpty);
		exit();
	}

$startDate1 = $_POST["startDate1"];
	if($startDate1 == ''){
		echo json_encode($startDate1Empty);
		exit();
	}

$endDate1 = $_POST["endDate1"];
	if($endDate1 == ''){
		echo json_encode($endDate1Empty);
		exit();
	}

$referA = $_POST["referA"];
	if($referA == ''){
		echo json_encode($referAEmpty);
		exit();
	}

$referB = $_POST["referB"];
	if($referB == ''){
		echo json_encode($referBEmpty);
		exit();
	}

$referC = $_POST["referC"];
	if($referC == ''){
		echo json_encode($referCEmpty);
		exit();
	}

$referD = $_POST["referD"];
	if($referD == ''){
		echo json_encode($referDEmpty);
		exit();
	}

$referE = $_POST["referE"];
	if($referE == ''){
		echo json_encode($referEEmpty);
		exit();
	}

$startDate2 = $_POST["startDate2"];
	if($startDate2 == ''){
		echo json_encode($startDate2Empty);
		exit();
	}

$endDate2 = $_POST["endDate2"];
	if($endDate2 == ''){
		echo json_encode($endDate2Empty);
		exit();
	}

$referX = $_POST["referX"];
	if($referX == ''){
		echo json_encode($referXEmpty);
		exit();
	}

$referY = $_POST["referY"];
	if($referY == ''){
		echo json_encode($referYCEmpty);
		exit();
	}

$referZ = $_POST["referZ"];
	if($referZ == ''){
		echo json_encode($referZEmpty);
		exit();
	}

//對比競賽代碼
$sqlSELECTprojectNO = " SELECT * FROM orderList WHERE projectNO = '$projectNO' ";
$sqlRESULTprojectNO = mysql_query($sqlSELECTprojectNO);
$sqlNUMROWSprojectNO = mysql_num_rows($sqlRESULTprojectNO);
if (!$sqlNUMROWSprojectNO != 0){
	echo json_encode($projectNODNE);
	exit();
}

//對比初審開始日期 (大於今日可)
if (strtotime($startDate1) < strtotime($todayDate)){
	echo json_encode($startDate1Passed);
	exit();
}

//對比初審結束日期 (大於今日)
if (strtotime($endDate1) < strtotime($todayDate)){
	echo json_encode($endDate1Passed);
	exit();
}

//初審結束日期須大於開始日期
if (strtotime($endDate1) < strtotime($startDate1)){
	echo json_encode($dateComp1);
	exit();
}

//對比決審開始日期 (大於今日可)
if (strtotime($startDate2) < strtotime($todayDate)){
	echo json_encode($startDate2Passed);
	exit();
}

//對比決審結束日期 (大於今日)
if (strtotime($endDate2) < strtotime($todayDate)){
	echo json_encode($endDate2Passed);
	exit();
}

//決審結束日期須大於開始日期
if (strtotime($endDate2) < strtotime($startDate2)){
	echo json_encode($dateComp2);
	exit();
}

//對比評審A存在員工資料
$sqlSELECTreferA = " SELECT * FROM staffList WHERE staffNO = '$referA' ";
$sqlRESULTreferA = mysql_query($sqlSELECTreferA);
$sqlNUMROWSreferA = mysql_num_rows($sqlRESULTreferA);
if ($sqlNUMROWSreferA == 0){
	echo json_encode($referADNE);
	exit();
}

//對比評審B存在員工資料
$sqlSELECTreferB = " SELECT * FROM staffList WHERE staffNO = '$referB' ";
$sqlRESULTreferB = mysql_query($sqlSELECTreferB);
$sqlNUMROWSreferB = mysql_num_rows($sqlRESULTreferB);
if (!$sqlNUMROWSreferB != 0){
	echo json_encode($referBDNE);
	exit();
}

//對比評審C存在員工資料
$sqlSELECTreferC = " SELECT * FROM staffList WHERE staffNO = '$referC' ";
$sqlRESULTreferC = mysql_query($sqlSELECTreferC);
$sqlNUMROWSreferC = mysql_num_rows($sqlRESULTreferC);
if (!$sqlNUMROWSreferC != 0){
	echo json_encode($referCDNE);
	exit();
}

//對比評審D存在員工資料
$sqlSELECTreferD = " SELECT * FROM staffList WHERE staffNO = '$referD' ";
$sqlRESULTreferD = mysql_query($sqlSELECTreferD);
$sqlNUMROWSreferD = mysql_num_rows($sqlRESULTreferD);
if (!$sqlNUMROWSreferD != 0){
	echo json_encode($referDDNE);
	exit();
}

//對比評審E存在員工資料
$sqlSELECTreferE = " SELECT * FROM staffList WHERE staffNO = '$referE' ";
$sqlRESULTreferE = mysql_query($sqlSELECTreferE);
$sqlNUMROWSreferE = mysql_num_rows($sqlRESULTreferE);
if (!$sqlNUMROWSreferE != 0){
	echo json_encode($referEDNE);
	exit();
}

//對比評審X存在員工資料
$sqlSELECTreferX = " SELECT * FROM staffList WHERE staffNO = '$referX' ";
$sqlRESULTreferX = mysql_query($sqlSELECTreferX);
$sqlNUMROWSreferX = mysql_num_rows($sqlRESULTreferX);
if (!$sqlNUMROWSreferX != 0){
	echo json_encode($referXDNE);
	exit();
}

//對比評審Y存在員工資料
$sqlSELECTreferY = " SELECT * FROM staffList WHERE staffNO = '$referY' ";
$sqlRESULTreferY = mysql_query($sqlSELECTreferY);
$sqlNUMROWSreferY = mysql_num_rows($sqlRESULTreferY);
if (!$sqlNUMROWSreferY != 0){
	echo json_encode($referYCDNE);
	exit();
}

//對比評審Z存在員工資料
$sqlSELECTreferZ = " SELECT * FROM staffList WHERE staffNO = '$referZ' ";
$sqlRESULTreferZ = mysql_query($sqlSELECTreferZ);
$sqlNUMROWSreferZ = mysql_num_rows($sqlRESULTreferZ);
if (!$sqlNUMROWSreferZ != 0){
	echo json_encode($referZDNE);
	exit();
}

//如果評審沒重覆 則更新資料庫
if (($referA == $referB) OR ($referA == $referC) OR ($referA == $referD) OR ($referA == $referE) OR ($referB == $referC) OR ($referB == $referD) OR ($referB == $referE) OR ($referC == $referD) OR ($referC == $referE) OR ($referD == $referE) ){
	echo json_encode($referDup);
	exit();
}

if(($referX == $referY) OR ($referX == $referZ) OR ($referY == $referZ)){
	echo json_encode($referDup);
	exit();
}else{
	
//更新staffList所有權限歸2
	$sqlUPDATEpostType = "
		UPDATE staffList
		SET postType = '2'
		WHERE postType = '1'
		";
	$sqlUPDATE = mysql_query($sqlUPDATEpostType, $sqlLink);
	
	
//更新referA 的 staffList所有權限為1
	$sqlUPDATEReferA = "
		UPDATE staffList
		SET postType = '1'
		WHERE staffNO = '$referA'
		";
	$sqlUPDATEA = mysql_query($sqlUPDATEReferA, $sqlLink);
	
	
//更新referB 的 staffList所有權限為1
	$sqlUPDATEReferB = "
		UPDATE staffList
		SET postType = '1'
		WHERE staffNO = '$referB'
		";
	$sqlUPDATEB = mysql_query($sqlUPDATEReferB, $sqlLink);
	
	
//更新referC 的 staffList所有權限為1
	$sqlUPDATEReferC = "
		UPDATE staffList
		SET postType = '1'
		WHERE staffNO = '$referC'
		";
	$sqlUPDATEC = mysql_query($sqlUPDATEReferC, $sqlLink);

//更新referD 的 staffList所有權限為1
	$sqlUPDATEReferD = "
		UPDATE staffList
		SET postType = '1'
		WHERE staffNO = '$referD'
		";
	$sqlUPDATED = mysql_query($sqlUPDATEReferD, $sqlLink);

//更新referE 的 staffList所有權限為1
	$sqlUPDATEReferE = "
		UPDATE staffList
		SET postType = '1'
		WHERE staffNO = '$referE'
		";
	$sqlUPDATEE = mysql_query($sqlUPDATEReferE, $sqlLink);

//更新referX 的 staffList所有權限為1
	$sqlUPDATEReferX = "
		UPDATE staffList
		SET postType = '1'
		WHERE staffNO = '$referX'
		";
	$sqlUPDATEX = mysql_query($sqlUPDATEReferX, $sqlLink);

//更新referY 的 staffList所有權限為1
	$sqlUPDATEReferY = "
		UPDATE staffList
		SET postType = '1'
		WHERE staffNO = '$referY'
		";
	$sqlUPDATEY = mysql_query($sqlUPDATEReferY, $sqlLink);

//更新referZ 的 staffList所有權限為1
	$sqlUPDATEReferZ = "
		UPDATE staffList
		SET postType = '1'
		WHERE staffNO = '$referZ'
		";
	$sqlUPDATEZ = mysql_query($sqlUPDATEReferZ, $sqlLink);

//更新competRefer資料庫
	$sqlINSERTcompetRefer = "
		INSERT INTO competRefer ( projectNO, startTime1, endTime1, startTime2, endTime2, referA, referB, referC, referD, referE, referX, referY, referZ ) VALUES( '$projectNO', '$startDate1', '$endDate1', '$startDate2', '$endDate2', '$referA', '$referB', '$referC', '$referD', '$referE', '$referX', '$referY', '$referZ' )
		ON DUPLICATE KEY UPDATE
		projectNO = '$projectNO', startTime1 = '$startDate1', endTime1 = '$endDate1', startTime2 = '$startDate2', endTime2 = '$endDate2', referA = '$referA', referB = '$referB', referC = '$referC', referD = '$referD', referE = '$referE', referX = '$referX', referY = '$referY', referZ = '$referZ'
		";
	$sqlINSERT = mysql_query($sqlINSERTcompetRefer, $sqlLink);
}

//回傳成功訊息

echo json_encode($referSelected);


?>