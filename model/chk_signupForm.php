<?php
//資料庫連線
require_once("../vender/dbtools.inc.php");

//隊伍名稱是否重複
$sqlTeamNameCheck = "SELECT * FROM competCollege WHERE teamName = '$teamName' AND projectNO = '$projectNO'";
$sqlTeamNameResult = mysql_query($sqlTeamNameCheck, $sqlLink);
$sqlTeamNameRows = mysql_num_rows($sqlTeamNameResult);
if ($sqlTeamNameRows != '0'){
echo"<script type='text/javascript'>";
echo "alert('隊名已被使用！請重新輸入!');";
echo "history.back();";
echo "</script>";
exit();
}

//隊長是否報名過
$sqlCaptainCheck = "SELECT * FROM studentsInfo WHERE studentName = '$captainName' AND projectNO = '$projectNO' AND identifyNO = '$captainID' ";
$sqlCaptainResult = mysql_query($sqlCaptainCheck, $sqlLink);
$sqlCaptainRows = mysql_num_rows($sqlCaptainResult);
if ($sqlCaptainRows != '0'){
echo"<script type='text/javascript'>";
echo "alert('隊長已報名過!請勿重覆報名!');";
echo "history.back();";
echo "</script>";
exit();
}

//隊員1是否報名過
$sqlmember1Check = "SELECT * FROM studentsInfo WHERE studentName = '$member1Name' AND projectNO = '$projectNO' AND identifyNO = '$member1ID' ";
$sqlmember1Result = mysql_query($sqlmember1Check, $sqlLink);
$sqlmember1Rows = mysql_num_rows($sqlmember1Result);
if ($sqlmember1Rows != '0'){
echo"<script type='text/javascript'>";
echo "alert('隊員1已報名過!請勿重覆報名!');";
echo "history.back();";
echo "</script>";
exit();
}

//隊員2是否報名過
$sqlmember2Check = "SELECT * FROM studentsInfo WHERE studentName = '$member2Name' AND projectNO = '$projectNO' AND identifyNO = '$member2ID' ";
$sqlmember2Result = mysql_query($sqlmember2Check, $sqlLink);
$sqlmember2Rows = mysql_num_rows($sqlmember2Result);
if ($sqlmember2Rows != '0'){
echo"<script type='text/javascript'>";
echo "alert('隊員2已報名過!請勿重覆報名!');";
echo "history.back();";
echo "</script>";
exit();
}

?>