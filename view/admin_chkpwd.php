<?php
require_once ("../vender/dbtools.inc.php");

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
//取得該帳號員工編號
//$sqlSELECTstaffNO = " SELECT staffNO FROM staffList WHERE account = '$account' ";
//$sqlRESULTstaffNO = mysql_query($sqlSELECTstaffNO, $sqlLink);
//$sqlFETCHstaffNO = mysql_fetch_row($sqlRESULTstaffNO);
//$sqlGETstaffNO = $sqlFETCHstaffNO[0];
//$staffNO = $sqlGETstaffNO;

	//關閉資料連結
	mysqli_close($sqlLink);
//資料寫入cookie, 並導向後台主頁admin_index.php
setcookie("account", $account);
setcookie("passed", "TRUE");
header("location: https://wmpcca.com/bswmp/form/view/admin_index.php");
exit();
////帳號比對
//$sqlSELECTaccount = " SELECT * FROM staffList WHERE account = '$account' ";
//$sqlRESULTaccount = mysql_query($sqlSELECTaccount, $sqlLink);
//$sqlNUMROWSaccount = mysql_num_rows($sqlRESULTaccount);
////如果帳號不存在則跳視窗
//if ($sqlNUMROWSaccount == 0){
//	echo "<script type='text/javascript'>";
//	echo "alert('帳號不存在！');";
//	echo "history.back();";
//	echo "</script>";
//}else{
//	//取得該帳號密碼
//$sqlSELECTpassword = " SELECT password FROM staffList WHERE account = '$account' ";
//$sqlRESULTpassword = mysql_query($sqlSELECTpassword, $sqlLink);
//$sqlFETCHpassword = mysql_fetch_row($sqlRESULTpassword);
//$sqlGETpassword = $sqlFETCHpassword[0];
//}
//
//if ($sqlGETpassword != $password){
//	echo "<script type='text/javascript'>";
//	echo "alert('密碼錯誤，請重新輸入！');";
//	echo "history.back();";
//	echo "</script>";
//}
//
//	//取得該帳號驗證狀態
//$sqlSELECTverification = " SELECT verification FROM staffList WHERE account = '$account' ";
//$sqlRESULTverification = mysql_query($sqlSELECTverification, $sqlLink);
//$sqlFETCHverification = mysql_fetch_row($sqlRESULTverification);
//$sqlGETverification = $sqlFETCHverification[0];
//if ($sqlGETverification != '驗證成功'){
//	echo "<script type='text/javascript'>";
//	echo "alert('帳號尚未驗證！');";
//	echo "history.back();";
//	echo "</script>";
}

?>