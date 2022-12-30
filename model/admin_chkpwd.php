<?php
require_once ("../vender/dbtools.inc.php");
header("Content-type:text/html; charset=utf-8");

//取得今天日期
$todayDate = date("Y-m-d H:i:s");

$account = $_POST["accountInput"];
$password = $_POST["pwdInput"];

$sqlSELECT = " SELECT * FROM staffList WHERE account = '$account' AND password = '$password' AND verification = '驗證成功' ";
$sqlRESULT = mysql_query($sqlSELECT, $sqlLink);
$sqlNUMROWS = mysql_num_rows($sqlRESULT);

//如果帳號不存在則跳視窗
if ($sqlNUMROWS == 0){
	echo "<script type='text/javascript'>";
	echo "alert('帳號密碼錯誤！或帳號尚未通過驗證！');";
	echo "history.back();";
	echo "</script>";
}else{
////取得該帳號員工編號
$sqlSELECTstaffNO = " SELECT staffNO FROM staffList WHERE account = '$account' ";
$sqlRESULTstaffNO = mysql_query($sqlSELECTstaffNO, $sqlLink);
$sqlFETCHstaffNO = mysql_fetch_row($sqlRESULTstaffNO);
$sqlGETstaffNO = $sqlFETCHstaffNO[0];
$staffNO = $sqlGETstaffNO;
////取得該帳號員工姓名
$sqlSELECTstaffName = " SELECT staffName FROM staffList WHERE account = '$account' ";
$sqlRESULTstaffName = mysql_query($sqlSELECTstaffName, $sqlLink);
$sqlFETCHstaffName = mysql_fetch_row($sqlRESULTstaffName);
$sqlGETstaffName = $sqlFETCHstaffName[0];
$staffName = $sqlGETstaffName;
////取得該帳號員工職權
$sqlSELECTpostType = " SELECT postType FROM staffList WHERE account = '$account' ";
$sqlRESULTpostType = mysql_query($sqlSELECTpostType, $sqlLink);
$sqlFETCHpostType = mysql_fetch_row($sqlRESULTpostType);
$sqlGETpostType = $sqlFETCHpostType[0];
$postType = $sqlGETpostType;

//寫入Log
	$file_name = "../log/adminLog.txt"; //檔案名稱
	$file = @file("$file_name"); //讀取檔案
	$open = @fopen("$file_name","a"); //開啟檔案，要是沒有檔案將建立一份
	$log =  "\r\n$todayDate $staffNO 登入了後台";
	@fwrite($open,$log); //寫入資料
	fclose($open); //關閉檔案	
	
//	// 釋放記憶體空間
//	mysqli_free_result();
	//關閉資料連結
	mysqli_close($sqlLink);
//資料寫入cookie, 並導向後台主頁admin_index.php
//$passed = 'TRUE';
setcookie("account", $account, time()+6000, "/" ,"wmpcca.com");
setcookie("passed", "TRUE", time()+6000, "/" ,"wmpcca.com");
setcookie("staffNO", $staffNO, time()+6000, "/" ,"wmpcca.com");
setcookie("staffName", $staffName, time()+6000, "/" ,"wmpcca.com");
setcookie("postType", $postType, time()+6000, "/" ,"wmpcca.com");
header("location: https://wmpcca.com/bswmp/form/view/admin_index2.php");
exit();
}
?>
