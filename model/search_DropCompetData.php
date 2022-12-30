<?php
require_once("../vender/dbtools.inc.php");

//取得表單資料
$teamNO = $_POST["teamNO"];
$PaymentDateY = $_POST["PaymentDateY"];
$PaymentDateM = $_POST["PaymentDateM"];
$PaymentDateD = $_POST["PaymentDateD"];
$receiptNO = $_POST["receiptNO"];
$receiptTitle = $_POST["receiptTitle"];
$teamName = $_POST["teamName"];
$captainName = $_POST["captainName"];
$captainID = $_POST["captainID"];
$member1Name = $_POST["member1Name"];
$member2Name = $_POST["member2Name"];
$projectName = $_POST["projectName"].'報名費';
$MN = $_POST["MN"];
$payStatus = $_POST["payStatus"];

//在competCollege資料表找尋隊編資料
$sqlSELECTcompetCollege = "SELECT * FROM competCollege WHERE teamNO='$teamNO'"; //查詢語法
$sqlRESULTcompetCollege = mysql_query($sqlSELECTcompetCollege, $sqlLink);  // 查詢結果
$sqlNUMROWScompetCollege = mysql_num_rows($sqlRESULTcompetCollege); //回傳查詢結果筆數

//在studentsInfo資料表找尋隊編資料
$sqlSELECTstudentsInfo = "SELECT * FROM studentsInfo WHERE teamNO='$teamNO'"; //查詢語法
$sqlRESULTstudentsInfo = mysql_query($sqlSELECTstudentsInfo, $sqlLink);  // 查詢結果
$sqlNUMROWSstudentsInfo = mysql_num_rows($sqlRESULTstudentsInfo); //回傳查詢結果筆數

if ($sqlNUMROWScompetCollege != 0 || $sqlNUMROWSstudentsInfo != 0){
	
	//依隊編刪除competCollege資料
	$sql = "delete from competCollege where teamNO = '$teamNO' ";
	mysql_query($sql, $sqlLink);	
	
	//依隊編刪除studentsInfo資料
	$sql = "delete from studentsInfo where teamNO = '$teamNO' ";
	mysql_query($sql, $sqlLink);
	
	//彈出成功訊息
	$url = "https://wmpcca.com/bswmp/form/view/cc_signup.php" ;  
	echo"<script type='text/javascript'>";
	echo "alert('報名資料已刪除，請重新報名！');";
	echo "window.location.href='$url'";
	echo "</script>";

}else{
	//彈出無資料並回上一頁
	echo"<script type='text/javascript'>";
	echo "alert('資料不存在！');";
	echo "history.back();";
	echo "</script>";
}

?>
