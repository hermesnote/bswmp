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
echo "alert('COOKIE錯誤!請重新登入！')";
echo "</script>";
header("location:admin_login.php");
exit();
}

//建立回傳參數
$DB = "examDB_hiStock";

$numberEPT = "請輸入題號或由上方列表點選！";
$optionEPT = "請選擇要操作的項目！";
$mockFUL = "模擬試題已達100題！請先刪除再新增！";
$done = "操作成功！";

//取得今天日期
$todayDate = date("Y-m-d H:i:s");

//取得AJAX傳送值
$number = $_POST["number"];
$option = $_POST["option"];

//判斷功能
if ($number == ''){
	echo json_encode($numberEPT);
	exit();	
}

if ($option == 0){
	echo json_encode($optionEPT);
	exit();
	
//設為模擬試題
}else if ($option == 1){
	//調出所有mock
	$sqlSELECTmock = " SELECT * FROM $DB WHERE mock = 'Y' ";
	$sqlRESULTmock = mysql_query($sqlSELECTmock, $sqlLink);
	$sqlNUMROWSmock = mysql_num_rows($sqlRESULTmock);

	if($sqlNUMROWSmock <= 100){
		$sqlUpdate = "
			UPDATE $DB
			SET mock = 'Y'
			WHERE number = '$number' ;
		";
		$sqlDo = mysql_query($sqlUpdate, $sqlLink);
		echo json_encode($done);
		exit();
	}else{
		echo json_encode($mockFUL);
		exit();
	}
	
//寫入Log
	$file_name = "../log/adminLog.txt"; //檔案名稱
	$file = @file("$file_name"); //讀取檔案
	$open = @fopen("$file_name","a"); //開啟檔案，要是沒有檔案將建立一份
	$log =  "\r\n$todayDate $staffNO 設定題號 $number 為模擬題 ";
	@fwrite($open,$log); //寫入資料
	fclose($open); //關閉檔案
	
//取消模擬試題	
}else if($option == 2){
		$sqlUpdate = "
			UPDATE $DB
			SET mock = ''
			WHERE number = '$number' ;
		";
		$sqlDo = mysql_query($sqlUpdate, $sqlLink);
		echo json_encode($done);
		exit();
	
		//寫入Log
			$file_name = "../log/adminLog.txt"; //檔案名稱
			$file = @file("$file_name"); //讀取檔案
			$open = @fopen("$file_name","a"); //開啟檔案，要是沒有檔案將建立一份
			$log =  "\r\n$todayDate $staffNO 取消題號 $number 為模擬題 ";
			@fwrite($open,$log); //寫入資料
			fclose($open); //關閉檔案
	
//選擇修改題目
}else if($option == 3){
	$returnEdit = "topic";
	
//寫入Log
	$file_name = "../log/adminLog.txt"; //檔案名稱
	$file = @file("$file_name"); //讀取檔案
	$open = @fopen("$file_name","a"); //開啟檔案，要是沒有檔案將建立一份
	$log =  "\r\n$todayDate $staffNO 調用了 $number 的題目 ";
	@fwrite($open,$log); //寫入資料
	fclose($open); //關閉檔案
	
//選擇修改選項A
}else if ($option == 4){
	$returnEdit = "choiceA";
	
//寫入Log
	$file_name = "../log/adminLog.txt"; //檔案名稱
	$file = @file("$file_name"); //讀取檔案
	$open = @fopen("$file_name","a"); //開啟檔案，要是沒有檔案將建立一份
	$log =  "\r\n$todayDate $staffNO 調用了 $number 的選項A ";
	@fwrite($open,$log); //寫入資料
	fclose($open); //關閉檔案
		
//選擇修改選項B
}else if ($option == 5){
	$returnEdit = "choiceB";
	
//寫入Log
	$file_name = "../log/adminLog.txt"; //檔案名稱
	$file = @file("$file_name"); //讀取檔案
	$open = @fopen("$file_name","a"); //開啟檔案，要是沒有檔案將建立一份
	$log =  "\r\n$todayDate $staffNO 調用了 $number 的選項B ";
	@fwrite($open,$log); //寫入資料
	fclose($open); //關閉檔案
		
//選擇修改選項C
}else if ($option == 6){
	$returnEdit = "choiceC";
	
//寫入Log
	$file_name = "../log/adminLog.txt"; //檔案名稱
	$file = @file("$file_name"); //讀取檔案
	$open = @fopen("$file_name","a"); //開啟檔案，要是沒有檔案將建立一份
	$log =  "\r\n$todayDate $staffNO 調用了 $number 的選項C ";
	@fwrite($open,$log); //寫入資料
	fclose($open); //關閉檔案
	
//選擇修改選項D
}else if ($option == 7){
	$returnEdit = "choiceD";
	
//寫入Log
	$file_name = "../log/adminLog.txt"; //檔案名稱
	$file = @file("$file_name"); //讀取檔案
	$open = @fopen("$file_name","a"); //開啟檔案，要是沒有檔案將建立一份
	$log =  "\r\n$todayDate $staffNO 調用了 $number 的選項D ";
	@fwrite($open,$log); //寫入資料
	fclose($open); //關閉檔案
	
//選擇修改答案
}else if ($option == 8){
	$returnEdit = "answer";
	
//寫入Log
	$file_name = "../log/adminLog.txt"; //檔案名稱
	$file = @file("$file_name"); //讀取檔案
	$open = @fopen("$file_name","a"); //開啟檔案，要是沒有檔案將建立一份
	$log =  "\r\n$todayDate $staffNO 調用了 $number 的答案 ";
	@fwrite($open,$log); //寫入資料
	fclose($open); //關閉檔案
	
}else if ($option == 9){
	$sqlDropData = " delete from $DB where number = '$number' ";
	mysql_query($sqlDropData);
	
//寫入Log
	$file_name = "../log/adminLog.txt"; //檔案名稱
	$file = @file("$file_name"); //讀取檔案
	$open = @fopen("$file_name","a"); //開啟檔案，要是沒有檔案將建立一份
	$log =  "\r\n$todayDate $staffNO 刪除了題號 $number  ";
	@fwrite($open,$log); //寫入資料
	fclose($open); //關閉檔案
	
	echo json_encode($done);
	exit();
}

//調用資料庫並回傳
$sqlSELECTreturn = " SELECT $returnEdit FROM $DB WHERE number = '$number' ";
$sqlRESULTreturn = mysql_query($sqlSELECTreturn, $sqlLink);
$sqlFETCHreturn = mysql_fetch_row($sqlRESULTreturn);
$return = $sqlFETCHreturn[0];
//$arr = array($return, $returnEdit);
echo json_encode($return);
exit();

//寫入Log
	$file_name = "../log/adminLog.txt"; //檔案名稱
	$file = @file("$file_name"); //讀取檔案
	$open = @fopen("$file_name","a"); //開啟檔案，要是沒有檔案將建立一份
	$log =  "\r\n$todayDate $staffNO 修改了一筆題庫 $number ";
	@fwrite($open,$log); //寫入資料
	fclose($open); //關閉檔案

?>