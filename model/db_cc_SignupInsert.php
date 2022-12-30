<?php
//資料庫連線
require_once("../vender/dbtools.inc.php");

//訂單資料入庫
	$sqlOrder = "INSERT IGNORE INTO orderList (orderTime, orderNO, customerNO, projectNO, projectName, MN, payWay, payStatus, eventCode, receiptTitle, taxID) VALUES ( '$orderTime', '$orderNO', '$customerNO', '$projectNO', '$projectName', '$MN', '$payWay', '$payStatus', '$eventCode', '$receiptTitle', '$taxID' )";
	$resultOrder = mysql_query($sqlOrder, $sqlLink);
	
//隊伍資料入庫
if ($teamName != ''){
	$sqlTeam = "INSERT IGNORE INTO competCollege (registerTime, projectNO, teamNO, district, school, teamName, teacher ) VALUES ( '$registerTime', '$projectNO', '$teamNO', '$district', '$school', '$teamName', '$teacher' )";
	$resultTeam = mysql_query($sqlTeam, $sqlLink);
}

//隊長寫入資料庫
if ($captainName != ''){
	$sql = "INSERT IGNORE INTO studentsInfo ( registerTime, projectNO, teamNO, studentName, identifyNO, studentSex, studentBirth, studentPhone, studentEmail, studentAddr, school, college, depart, degree, grade, remarks ) VALUES ( '$registerTime', '$projectNO', '$teamNO', '$captainName', '$captainID', '$captainSex', '$captainBirth', '$captainPhone', '$captainEmail', '$captainAddr', '$school', '$captainCollege', '$captainDepart', '$captainDegree', '$captainGrade', '隊長' )";
	$result = mysql_query($sql, $sqlLink);
}

//隊員1寫入資料庫
if ($member1Name != ''){
	$sql = "INSERT IGNORE INTO studentsInfo ( registerTime, projectNO, teamNO, studentName, identifyNO, studentSex, studentBirth, studentPhone, studentEmail, studentAddr, school, college, depart, degree, grade, remarks ) VALUES ( '$registerTime', '$projectNO', '$teamNO', '$member1Name', '$member1ID', '$member1Sex', '$member1Birth', '$member1Phone', '$member1Email', '$member1Addr', '$school', '$member1College', '$member1Depart', '$member1Degree', '$member1Grade', '隊員1' )";
	$result = mysql_query($sql, $sqlLink);
}

//隊員2寫入資料庫
if ($member2Name != ''){
	$sql = "INSERT IGNORE INTO studentsInfo ( registerTime, projectNO, teamNO, studentName, identifyNO, studentSex, studentBirth, studentPhone, studentEmail, studentAddr, school, college, depart, degree, grade, remarks ) VALUES ( '$registerTime', '$projectNO', '$teamNO', '$member2Name', '$member2ID', '$member2Sex', '$member2Birth', '$member2Phone', '$member2Email', '$member2Addr', '$school', '$member2College', '$member2Depart', '$member2Degree', '$member2Grade', '隊員2' )";
	$result = mysql_query($sql, $sqlLink);
}

mysqli_close($sqlLink);

?>