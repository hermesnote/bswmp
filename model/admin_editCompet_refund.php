<?php
//連線資料庫
	require_once ("../vender/dbtools.inc.php");

// 設置資料類型 json，編碼格式 utf-8
	header('Content-Type: application/json; charset=UTF-8');

//取得今天日期
	$todayDate = date("Y-m-d H:i:s");

//取得使用者資料
	$passed = $_COOKIE["passed"];
	$account = $_COOKIE["account"];
	$staffNO = $_COOKIE["staffNO"];

//建立回傳參數
	$refundWRG = "無法設定退費";
	$delDone = "退費資料已更新！";

//取得AJAX傳值
	$teamNO = $_POST["teamNO"];

//搜尋訂單編號
	$sqlSELECTorderNO = " SELECT * FROM orderList WHERE customerNO = '$teamNO' AND payStatus = '繳費完成' ";
	$sqlRESULTorderNO = mysql_query($sqlSELECTorderNO, $sqlLink);
	$sqlNUMROWSorderNO = mysql_num_rows($sqlRESULTorderNO);
	$sqlFETCHorderNO = mysql_fetch_row($sqlRESULTorderNO);
	$orderNO = $sqlFETCHorderNO[2];

// 若訂單存在 則更新退費 否則回傳無繳費訊息
	if ($sqlNUMROWSorderNO != 0){
	//更改訂單繳費狀態
		$sqlUpdateOrderList = "
			UPDATE orderList
			SET payStatus='已退費', payTime = '$todayDate'
			WHERE orderNO = '$orderNO'
			";
		$sqlDoUpdateOrderList = mysql_query($sqlUpdateOrderList, $sqlLink);

	//收據作廢
		$sqlUpdateReceiptList = "
			UPDATE receiptList
			SET remarks='作廢'
			WHERE orderNO = '$orderNO'
		";
		$sqlDoUpdateReceiptList = mysql_query($sqlUpdateReceiptList, $sqlLink);
	}else{
		echo json_encode($refundWRG);
		exit();		
	}


//寫入Log
	$file_name = "../log/competLog.txt"; //檔案名稱
	$file = @file("$file_name"); //讀取檔案
	$open = @fopen("$file_name","a"); //開啟檔案，要是沒有檔案將建立一份
	$log =  "\r\n$todayDate $staffNO 修正了 $teamNO 的退費資料";
	@fwrite($open,$log); //寫入資料
	fclose($open); //關閉檔案

//回傳成功訊息
	$arr = array($teamNO, $orderNO, $receiptNO);
	echo json_encode($arr);
	exit();

?>