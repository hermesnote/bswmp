<?php
require_once ("../vender/dbtools.inc.php");

$account = $_POST["accountInput"];
$verificationInput = $_POST["verificationInput"];

//帳號是否存在
$sqlSELECTaccount = "SELECT * FROM staffList WHERE account = '$account' ";
$sqlRESULTaccount = mysql_query($sqlSELECTaccount, $sqlLink);
$sqlNUMROWSaccount = mysql_num_rows($sqlRESULTaccount);

	if ($sqlNUMROWSaccount == 0){
		echo "<script type='text/javascript'>";
		echo "alert('帳號不存在');";
		echo "history.back();";
		echo "</script>";
	}

//取得帳號的驗證碼
$sqlSELECTverification = " SELECT verification FROM staffList WHERE account = '$account' ";
$sqlRESULTverification = mysql_query($sqlSELECTverification, $sqlLink);
$sqlFGETCHverification = mysql_fetch_row($sqlRESULTverification);
$sqlverification = $sqlFGETCHverification[0];

//驗證碼是否正確
	if ($sqlverification != $verificationInput){
		echo "<script type='text/javascript'>";
		echo "alert('驗證碼錯誤！');";
		echo "history.back();";
		echo "</script>";
	}else{
		//更新verification欄位
		$sqlUPDATEverification = " UPDATE staffList SET verification = '驗證成功' ";
		$sqlRESULTverification = mysql_query($sqlUPDATEverification, $sqlLink);
		header("Location: https://wmpcca.com/bswmp/form/view/admin_login.php"); 
		exit();
	}
?>