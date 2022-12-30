<?php
//連線資料庫
require_once ("../vender/dbtools.inc.php");

// 設置資料類型 json，編碼格式 utf-8
header('Content-Type: application/json; charset=UTF-8');

//取得今天日期
$todayDate = date("Y-m-d H:i:s");

//設置資料庫
$teamDB = "competCollege";
$memberDB = "studentsInfo";

//取得使用者資料
$passed = $_COOKIE["passed"];
$account = $_COOKIE["account"];
$staffNO = $_COOKIE["staffNO"];

//建立回傳參數
$teacherEPT = "指導老師不可為空！";
$payStatusEPT = "請更新繳費狀態！";
$payWayEPT = "繳費方式不可為空！";
$vAccountEPT = "繳款來源不可為空！";
$payTimeEPT = "繳費日期不可為空！";
$MNEPT = "繳費金額不可為空！";
$editOK = "資料已更新！";

//取得AJAX傳值
$teamNO = $_POST["teamNO"];
$projectNO = substr($teamNO, 0, 4);
//取得projectName
$sqlSELECTprojectName = " SELECT * FROM competList WHERE projectNO = '$projectNO' ";
$sqlRESULTprojectName = mysql_query($sqlSELECTprojectName, $sqlLink);
$sqlFETCHprojectName = mysql_fetch_row($sqlRESULTprojectName);
$projectName = $sqlFETCHprojectName[2].'報名費';

$payStatus = $_POST["payStatus"];

	// 若繳費完成 僅更新隊伍指導老師
	if ($payStatus == '繳費完成'){
		$teacher = $_POST["teacher"];
			if($teacher == ''){
				echo json_encode($teacherEPT);
				exit();
			}
		
	//更新指導老師 @ 隊伍資料表
		$sqlUPDATEteacher = "
			UPDATE $teamDB
			SET teacher = '$teacher'
			WHERE teamNO = '$teamNO';
		";
		$sqlDo = mysql_query($sqlUPDATEteacher, $sqlLink);
		
	//寫入Log
		$file_name = "../log/adminLog.txt"; //檔案名稱
		$file = @file("$file_name"); //讀取檔案
		$open = @fopen("$file_name","a"); //開啟檔案，要是沒有檔案將建立一份
		$log =  "\r\n$todayDate $staffNO 編修了 $teamNO 的 指導老師";
		@fwrite($open,$log); //寫入資料
		fclose($open); //關閉檔案
		
	}else{
		
	// else 視為繳費小白 必須有繳費資料 且產生新訂單 及 收據
		$teacher = $_POST["teacher"];
			if($teacher == ''){
				echo json_encode($teacherEPT);
				exit();
			}
		$payWay = $_POST["payWay"];
			if($payWay == ''){
				echo json_encode($payWayEPT);
				exit();
			}
		$vAccount = $_POST["vAccount"];
			if($vAccount == ''){
				echo json_encode($vAccountEPT);
				exit();
			}
		$payTime  = $_POST["payTime"];
			if($payTime == ''){
				echo json_encode($payTimeEPT);
				exit();
			}
		$MN = $_POST["MN"];
			if($MN == ''){
				echo json_encode($MNEPT);
				exit();
			}
		
	// 更新指導老師
		$sqlUPDATEteacher = "
			UPDATE $teamDB
			SET teacher = '$teacher'
			WHERE teamNO = '$teamNO';
		";
		$sqlDo = mysql_query($sqlUPDATEteacher, $sqlLink);
		
	//寫入Log
		$file_name = "../log/adminLog.txt"; //檔案名稱
		$file = @file("$file_name"); //讀取檔案
		$open = @fopen("$file_name","a"); //開啟檔案，要是沒有檔案將建立一份
		$log =  "\r\n$todayDate $staffNO 編修了 $teamNO 的 指導老師";
		@fwrite($open,$log); //寫入資料
		fclose($open); //關閉檔案
		
	// 產生訂單編號
		$orderNO = $projectNO.substr(date("md"),0,4).substr(date("Hi"),0,4).str_pad(mt_rand(00000, 99999), 5, "0", STR_PAD_LEFT);
	// 寫入訂單資料
		$sqlINSERTorderList = "
			INSERT INTO orderList ( orderTime, orderNO, customerNO, projectNO, MN, payWay, payStatus, payTime, vAccount  )
			VALUES ( '$todayDate', '$orderNO', '$teamNO', '$projectNO', '$MN', '$payWay', '繳費完成', '$payTime', '$vAccount' )
		";
		$sqlINSERTorderListDo = mysql_query($sqlINSERTorderList, $sqlLink);
		
	// 產生收據
		
		//生成一組今天的第一組收據號碼
		$receiptToday = date(Ymd)."001";

		//查詢收據資料庫是否已存在
		$sqlreceiptTodaySearch = "SELECT * FROM receiptList WHERE receiptNO = '$receiptToday'";
		$sqlreceiptTodayResult = mysql_query($sqlreceiptTodaySearch, $sqlLink);
		$sqlreceiptTodayRow = mysql_num_rows($sqlreceiptTodayResult);	

		//取得資料庫最近一筆收據號碼
		$sqlgetReceiptNOSearch = "SELECT receiptNO FROM receiptList ORDER BY id DESC";
		$sqlgetReceiptNOResult = mysql_query($sqlgetReceiptNOSearch, $sqlLink);
		$sqlgetReceiptNOFetch = mysql_fetch_row($sqlgetReceiptNOResult);
		$receiptLastNO = $sqlgetReceiptNOFetch[0];

		//如果數組已經存在，則取最近一筆收據尾數+1做為本次收據號碼，如果數組不存在，則直接取用為收據號碼
		if ($sqlreceiptTodayRow != 0){
			$receiptNO = $receiptLastNO+1;
		}else{
			$receiptNO = $receiptToday;
		}

		//更新收據資料庫
		$sqlreceiptInsert = "
			INSERT INTO receiptList (dealTime, receiptNO, orderNO, dealNO, projectName, MN) 
			VALUES ('$todayDate', '$receiptNO', '$orderNO', '$vAccount', '$projectName', '$MN')";	
		$sqlreceiptInsertDo = mysql_query($sqlreceiptInsert, $sqlLink);
		
		
		// 更新評分資料庫
		$sqlscoreInsert = "
			INSERT INTO competScore ( dateTime, projectNO, teamNO ) 
			VALUES ( '$todayDate', '$projectNO', '$teamNO' )";	
		$sqlscoreInsertDo = mysql_query($sqlscoreInsert, $sqlLink);
		
	// 寫入Log
		$file_name = "../log/adminLog.txt"; //檔案名稱
		$file = @file("$file_name"); //讀取檔案
		$open = @fopen("$file_name","a"); //開啟檔案，要是沒有檔案將建立一份
		$log =  "\r\n$todayDate $staffNO 更新了 $teamNO 的繳費資料";
		@fwrite($open,$log); //寫入資料
		fclose($open); //關閉檔案
	
	}

	// 回傳成功訊息
		echo json_encode($editOK);
		exit();

?>