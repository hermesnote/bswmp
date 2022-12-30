<?php
//連結資料庫
require_once("../vender/dbtools.inc.php");

//設定時區
date_default_timezone_set('Asia/Taipei');

// 設置資料類型 json，編碼格式 utf-8
header('Content-Type: application/json; charset=UTF-8');

//取得今天日期
$todayDate = date("Y-m-d H:i:s");

//建立回傳參數
$teamNOEPT = "請輸入隊伍編號";
$teamNOEXT = "查無此隊伍編號";
$teamNOWRG = "隊伍編號格式錯誤";
$vCodeEPT = "請輸入驗證碼";
$vCodeWRG = "驗證碼錯誤";
$logined = "登入成功";

//取得AJAX傳值
$teamNO = $_POST["teamNO"];
	if($teamNO == ''){
		echo json_encode($teamNOEPT);
		exit();
	}
$vCode = $_POST["vCode"];
	if($vCode == ''){
		echo json_encode($vCodeEPT);
		exit();
	}

//隊編判斷對應資料表competSocial
if (preg_match("/SG/i", $teamNO)){
	$sqlSELECTteamNO = " SELECT * FROM competSocial WHERE teamNO = '$teamNO' ";
	$sqlRESULTteamNO = mysql_query($sqlSELECTteamNO, $sqlLink);
	$sqlNUMteamNO = mysql_num_rows($sqlRESULTteamNO);
	$sqlteamNO = $sqlNUMteamNO;
		
		//如果隊編不存在
		if ($sqlteamNO == 0){
				echo json_encode($teamNOEXT);
				exit();
		}else{
		//取得驗證碼並比對
		$sqlSELECTvCode = " SELECT vCode FROM competSocial WHERE teamNO = '$teamNO' ";
		$sqlRESULTvCode = mysql_query($sqlSELECTvCode, $sqlLink);
		$sqlFETCHvCode = mysql_fetch_row($sqlRESULTvCode);
		$sqlvCode = $sqlFETCHvCode[0];

			if (!strcmp($vCode, $sqlvCode) == 0){
				echo json_encode($vCodeWRG);
				exit();
			}else{
		//取得項目代號
		$sqlSELECTprojectNO = " SELECT projectNO FROM competSocial WHERE teamNO = '$teamNO' ";
		$sqlRESULTprojectNO = mysql_query($sqlSELECTprojectNO, $sqlLink);
		$sqlFETCHprojectNO = mysql_fetch_row($sqlRESULTprojectNO);
		$sqlprojectNO = $sqlFETCHprojectNO[0];
		$projectNO = $sqlprojectNO;
		//取得競賽名稱
		$sqlSELECTprojectName = " SELECT projectName FROM competList WHERE projectNO = '$projectNO' ";
		$sqlRESULTprojectName = mysql_query($sqlSELECTprojectName, $sqlLink);
		$sqlFETCHprojectName = mysql_fetch_row($sqlRESULTprojectName);
		$sqlprojectName = $sqlFETCHprojectName[0];
		$projectName = $sqlprojectName;
		//
		//取得隊名
		$sqlSELECTteamName = " SELECT teamName FROM competSocial WHERE teamNO = '$teamNO' ";
		$sqlRESULTteamName = mysql_query($sqlSELECTteamName, $sqlLink);
		$sqlFETCHteamName = mysql_fetch_row($sqlRESULTteamName);
		$sqlteamName = $sqlFETCHteamName[0];
		$teamName = $sqlteamName;

		//建立帳號陣列
		$teamDB = "competSocial";
		$memberDB = "socialInfo";
		$competInfo = "SG";
		$passed = "TRUE";
		$loginInfo = array( $teamDB, $memberDB, $teamNO, $teamName, $projectNO, $projectName, $competInfo, $passed );
		setcookie("loginCompet", serialize($loginInfo), time()+6000*24, "/" ,"wmpcca.com");
				
		//寫入Log
		$file_name = "../log/competLog.txt"; //檔案名稱
		$file = @file("$file_name"); //讀取檔案
		$open = @fopen("$file_name","a"); //開啟檔案，要是沒有檔案將建立一份
		$log =  "\r\n$todayDate $teamNO 登入了競賽專區";
		@fwrite($open,$log); //寫入資料
		fclose($open); //關閉檔案		
				
		//回傳成功訊息
		echo json_encode($logined);
		exit();
			}
	}
}


//隊編判斷對應資料表competCollege
else if ( (preg_match("/CN/i", $teamNO)) || (preg_match("/CC/i", $teamNO)) || (preg_match("/CS/i", $teamNO)) || (preg_match("/CG/i", $teamNO))){

	$sqlSELECTteamNO = " SELECT * FROM competCollege WHERE teamNO = '$teamNO' ";
	$sqlRESULTteamNO = mysql_query($sqlSELECTteamNO, $sqlLink);
	$sqlNUMteamNO = mysql_num_rows($sqlRESULTteamNO);
	$sqlteamNO = $sqlNUMteamNO;
		
		//如果隊編不存在
		if ($sqlteamNO == 0){
				echo json_encode($teamNOEXT);
				exit();
		}else{
		//取得驗證碼並比對
		$sqlSELECTvCode = " SELECT vCode FROM competCollege WHERE teamNO = '$teamNO' ";
		$sqlRESULTvCode = mysql_query($sqlSELECTvCode, $sqlLink);
		$sqlFETCHvCode = mysql_fetch_row($sqlRESULTvCode);
		$sqlvCode = $sqlFETCHvCode[0];

			if (!strcmp($vCode, $sqlvCode) == 0){
				echo json_encode($vCodeWRG);
				exit();
			}else{
		//取得項目代號
		$sqlSELECTprojectNO = " SELECT projectNO FROM competCollege WHERE teamNO = '$teamNO' ";
		$sqlRESULTprojectNO = mysql_query($sqlSELECTprojectNO, $sqlLink);
		$sqlFETCHprojectNO = mysql_fetch_row($sqlRESULTprojectNO);
		$sqlprojectNO = $sqlFETCHprojectNO[0];
		$projectNO = $sqlprojectNO;
		//取得競賽名稱
		$sqlSELECTprojectName = " SELECT projectName FROM competList WHERE projectNO = '$projectNO' ";
		$sqlRESULTprojectName = mysql_query($sqlSELECTprojectName, $sqlLink);
		$sqlFETCHprojectName = mysql_fetch_row($sqlRESULTprojectName);
		$sqlprojectName = $sqlFETCHprojectName[0];
		$projectName = $sqlprojectName;
		//
		//取得隊名
		$sqlSELECTteamName = " SELECT teamName FROM competCollege WHERE teamNO = '$teamNO' ";
		$sqlRESULTteamName = mysql_query($sqlSELECTteamName, $sqlLink);
		$sqlFETCHteamName = mysql_fetch_row($sqlRESULTteamName);
		$sqlteamName = $sqlFETCHteamName[0];
		$teamName = $sqlteamName;

		//建立帳號陣列
		$teamDB = "competCollege";
		$memberDB = "studentsInfo";
		$competInfo = "NCS";
		$passed = "TRUE";
		$loginInfo = array( $teamDB, $memberDB, $teamNO, $teamName, $projectNO, $projectName, $competInfo, $passed );
		setcookie("loginCompet", serialize($loginInfo), time()+3600*24, "/" ,"wmpcca.com");
				
		//寫入Log
		$file_name = "../log/competLog.txt"; //檔案名稱
		$file = @file("$file_name"); //讀取檔案
		$open = @fopen("$file_name","a"); //開啟檔案，要是沒有檔案將建立一份
		$log =  "\r\n$todayDate $teamNO 登入了競賽專區";
		@fwrite($open,$log); //寫入資料
		fclose($open); //關閉檔案		
				
		//回傳成功訊息
		echo json_encode($logined);
		exit();
			}
	}

}else{
	echo json_encode($teamNOWRG);
	exit();
}





?>