<?php
//連線資料庫
require_once ("../vender/dbtools.inc.php");

// 設置資料類型 json，編碼格式 utf-8
header('Content-Type: application/json; charset=UTF-8');

//取得使用者資料
$passed = $_COOKIE["passed"];
$account = $_COOKIE["account"];
$staffNO = $_COOKIE["staffNO"];
$staffName = $_COOKIE["staffName"];
$postType = $_COOKIE["postType"];

// 若cookie中的變數passed不為TRUE，則導回登入頁
if ($passed != "TRUE"){
echo "<script type='text/javascript'>";
echo "alert('COOKIE逾時!請重新登入！')";
echo "</script>";
header("location:admin_login.php");
exit();
}

//取得今天日期
$todayDate = date("Y-m-d H:i:s");

//取得AJAX傳值
$teamNO = $_POST["teamNO"];
$teamNO_college = $teamNO;

//取得訂單資料
$sqlSELECTorderList = " SELECT * FROM orderList WHERE customerNO = '$teamNO' ORDER BY id DESC ";
$sqlRESULTorderList = mysql_query($sqlSELECTorderList, $sqlLink);
$sqlFETCHorderList = mysql_fetch_row($sqlRESULTorderList);
$MN_college = $sqlFETCHorderList[6];
$payWay_college = $sqlFETCHorderList[7];
$payStatus_college = $sqlFETCHorderList[8];
$patTime_college = $sqlFETCHorderList[9];
$vAccount = $sqlFETCHorderList[14];
$paymentNO = $sqlFETCHorderList[15];
	if ( ($vAccount == '') && ($paymentNO !='') ){
		$vAccount_college = $paymentNO;
	}else if( ($vAccount != '') && ($paymentNO == '') ){
		$vAccount_college = $vAccount;
	}else if( ($vAccount == '') && ($paymentNO == '') ){
		$vAccount_college = '';
	}

// 取得隊伍資料
$sqlSELECTteamData = " SELECT * FROM competCollege WHERE teamNO = '$teamNO' ";
$sqlRESULTteamData = mysql_query($sqlSELECTteamData, $sqlLink);
$sqlFETCHteamData = mysql_fetch_row($sqlRESULTteamData);
$schoolName = $sqlFETCHteamData[5];
$teamName_college = $sqlFETCHteamData[6];
$teacher_college = $sqlFETCHteamData[7];

//取得學校ID
$sqlSELECTschoolID = " SELECT * FROM schoolList WHERE schoolName = '$schoolName' ";
$sqlRESULTschoolID = mysql_query($sqlSELECTschoolID, $sqlLink);
$sqlFETCHschoolID = mysql_fetch_row($sqlRESULTschoolID);
$schoolID_college = $sqlFETCHschoolID[2];

//取得隊長資料
$sqlSELECTcaptainData = " SELECT * FROM studentsInfo WHERE teamNO = '$teamNO' AND remarks = '隊長' ";
$sqlRESULTcaptainData = mysql_query($sqlSELECTcaptainData, $sqlLink);
$sqlFETCHcaptainData = mysql_fetch_row($sqlRESULTcaptainData);
$captainName_college = $sqlFETCHcaptainData[4];
$captainSex_college = $sqlFETCHcaptainData[6];
$captainID_college = $sqlFETCHcaptainData[5];
$captainBirth_college = $sqlFETCHcaptainData[7];
$captainPhone_college = $sqlFETCHcaptainData[8];
$captainEmail_college = $sqlFETCHcaptainData[9];
$captainCity_college = $sqlFETCHcaptainData[10];
$captainDistrict_college = $sqlFETCHcaptainData[11];
$captainAddr_college = $sqlFETCHcaptainData[12];
$captaincollege_college = $sqlFETCHcaptainData[15];
$captainDepart_college = $sqlFETCHcaptainData[16];
$captainDegree_college = $sqlFETCHcaptainData[17];
$captainGrade_college = $sqlFETCHcaptainData[18];

//取得副手資料
$sqlSELECTmember1Data = " SELECT * FROM studentsInfo WHERE teamNO = '$teamNO' AND remarks = '副手' ";
$sqlRESULTmember1Data = mysql_query($sqlSELECTmember1Data, $sqlLink);
$sqlFETCHmember1Data = mysql_fetch_row($sqlRESULTmember1Data);
$member1Name_college = $sqlFETCHmember1Data[4];
$member1Sex_college = $sqlFETCHmember1Data[6];
$member1ID_college = $sqlFETCHmember1Data[5];
$member1Birth_college = $sqlFETCHmember1Data[7];
$member1Phone_college = $sqlFETCHmember1Data[8];
$member1Email_college = $sqlFETCHmember1Data[9];
$member1City_college = $sqlFETCHmember1Data[10];
$member1District_college = $sqlFETCHmember1Data[11];
$member1Addr_college = $sqlFETCHmember1Data[12];
$member1college_college = $sqlFETCHmember1Data[15];
$member1Depart_college = $sqlFETCHmember1Data[16];
$member1Degree_college = $sqlFETCHmember1Data[17];
$member1Grade_college = $sqlFETCHmember1Data[18];

//取得隊員資料
$sqlSELECTmember2Data = " SELECT * FROM studentsInfo WHERE teamNO = '$teamNO' AND remarks = '隊員' ";
$sqlRESULTmember2Data = mysql_query($sqlSELECTmember2Data, $sqlLink);
$sqlFETCHmember2Data = mysql_fetch_row($sqlRESULTmember2Data);
$member2Name_college = $sqlFETCHmember2Data[4];
$member2Sex_college = $sqlFETCHmember2Data[6];
$member2ID_college = $sqlFETCHmember2Data[5];
$member2Birth_college = $sqlFETCHmember2Data[7];
$member2Phone_college = $sqlFETCHmember2Data[8];
$member2Email_college = $sqlFETCHmember2Data[9];
$member2City_college = $sqlFETCHmember2Data[10];
$member2District_college = $sqlFETCHmember2Data[11];
$member2Addr_college = $sqlFETCHmember2Data[12];
$member2college_college = $sqlFETCHmember2Data[15];
$member2Depart_college = $sqlFETCHmember2Data[16];
$member2Degree_college = $sqlFETCHmember2Data[17];
$member2Grade_college = $sqlFETCHmember2Data[18];


//寫入Log
	$file_name = "../log/adminLog.txt"; //檔案名稱
	$file = @file("$file_name"); //讀取檔案
	$open = @fopen("$file_name","a"); //開啟檔案，要是沒有檔案將建立一份
	$log =  "\r\n$todayDate $staffNO 調閱了 $teamNO 準備進行編輯 ";
	@fwrite($open,$log); //寫入資料
	fclose($open); //關閉檔案

//---訂單資料---
//MN_college=[0]
//payWay_college=[1]
//payStatus_college=[2]
//patTime_college=[3]
//vAccount_college=[4]
//---隊伍資料---
//teamNO_college=[5] 
//schoolID_college=[6]
//teamName_college=[7]
//teacher_college=[8]
//---隊長資料---
//captainName_college=[9]
//captainSex_college=[10]
//captainID_college=[11]
//captainBirth_college=[12]
//captainPhone_college=[13]
//captainEmail_college=[14]
//captainCity_college=[15]
//captainDistrict_college=[16]
//captainAddr_college=[17]
//captaincollege_college=[18]
//captainDepart_college=[19]
//captainDegree_college=[20]
//captainGrade_college=[21]
//---副手資料---
//member1Name_college=[22]
//member1Sex_college=[23]
//member1ID_college=[24]
//member1Birth_college=[25]
//member1Phone_college=[26]
//member1Email_college=[27]
//member1City_college=[28]
//member1District_college=[29]
//member1Addr_college=[30]
//member1college_college=[31]
//member1Depart_college=[32]
//member1Degree_college=[33]
//member1Grade_college=[34]
//---隊員資料---
//member2Name_college=[35]
//member2Sex_college=[36]
//member2ID_college=[37]
//member2Birth_college=[38]
//member2Phone_college=[39]
//member2Email_college=[40]
//member2City_college=[41]
//member2District_college=[42]
//member2Addr_college=[43]
//member2college_college=[44]
//member2Depart_college=[45]
//member2Degree_college=[46]
//member2Grade_college=[47]

//建立回傳值Array
$arr = array($MN_college, $payWay_college, $payStatus_college, $patTime_college, $vAccount_college, $teamNO_college, $schoolID_college, $teamName_college, $teacher_college, $captainName_college, $captainSex_college, $captainID_college, $captainBirth_college, $captainPhone_college, $captainEmail_college, $captainCity_college, $captainDistrict_college, $captainAddr_college, $captaincollege_college, $captainDepart_college, $captainDegree_college, $captainGrade_college, $member1Name_college, $member1Sex_college, $member1ID_college, $member1Birth_college, $member1Phone_college, $member1Email_college, $member1City_college, $member1District_college, $member1Addr_college, $member1college_college, $member1Depart_college, $member1Degree_college, $member1Grade_college, $member2Name_college, $member2Sex_college, $member2ID_college, $member2Birth_college, $member2Phone_college, $member2Email_college, $member2City_college, $member2District_college, $member2Addr_college, $member2college_college, $member2Depart_college, $member2Degree_college, $member2Grade_college);
echo json_encode($arr);

?>