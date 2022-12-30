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

//取得訂單資料
$sqlSELECTorderList = " SELECT * FROM orderList WHERE customerNO = '$teamNO' ORDER BY id DESC ";
$sqlRESULTorderList = mysql_query($sqlSELECTorderList, $sqlLink);
$sqlFETCHorderList = mysql_fetch_row($sqlRESULTorderList);
$MN_social = $sqlFETCHorderList[6];
$payWay_social = $sqlFETCHorderList[7];
$payStatus_social = $sqlFETCHorderList[8];
$patTime_social = $sqlFETCHorderList[9];
$vAccount = $sqlFETCHorderList[14];
$paymentNO = $sqlFETCHorderList[15];
	if ( ($vAccount == '') && ($paymentNO !='') ){
		$vAccount_social = $paymentNO;
	}else if( ($vAccount != '') && ($paymentNO == '') ){
		$vAccount_social = $vAccount;
	}else if( ($vAccount == '') && ($paymentNO == '') ){
		$vAccount_social = '';
	}

// 取得隊伍資料
$sqlSELECTteamData = " SELECT * FROM competSocial WHERE teamNO = '$teamNO' ";
$sqlRESULTteamData = mysql_query($sqlSELECTteamData, $sqlLink);
$sqlFETCHteamData = mysql_fetch_row($sqlRESULTteamData);
$teamNO_social = $sqlFETCHteamData[3];
$teamName_social = $sqlFETCHteamData[4];

//取得隊長資料
$sqlSELECTcaptainData = " SELECT * FROM socialInfo WHERE teamNO = '$teamNO' AND remarks = '隊長' ";
$sqlRESULTcaptainData = mysql_query($sqlSELECTcaptainData, $sqlLink);
$sqlFETCHcaptainData = mysql_fetch_row($sqlRESULTcaptainData);
$captainName_social = $sqlFETCHcaptainData[3];
$captainSex_social = $sqlFETCHcaptainData[4];
$captainID_social = $sqlFETCHcaptainData[5];
$captainBirth_social = $sqlFETCHcaptainData[6];
$captainPhone_social = $sqlFETCHcaptainData[7];
$captainEmail_social = $sqlFETCHcaptainData[8];
$captainCity_social = $sqlFETCHcaptainData[9];
$captainDistrict_social = $sqlFETCHcaptainData[10];
$captainAddr_social = $sqlFETCHcaptainData[11];
$captainJob_social = $sqlFETCHcaptainData[13];
$captainTitle_social = $sqlFETCHcaptainData[14];
$captainYear_social = $sqlFETCHcaptainData[15];

//取得副手資料
$sqlSELECTmember1Data = " SELECT * FROM socialInfo WHERE teamNO = '$teamNO' AND remarks = '副手' ";
$sqlRESULTmember1Data = mysql_query($sqlSELECTmember1Data, $sqlLink);
$sqlFETCHmember1Data = mysql_fetch_row($sqlRESULTmember1Data);
$member1Name_social = $sqlFETCHmember1Data[3];
$member1Sex_social = $sqlFETCHmember1Data[4];
$member1ID_social = $sqlFETCHmember1Data[5];
$member1Birth_social = $sqlFETCHmember1Data[6];
$member1Phone_social = $sqlFETCHmember1Data[7];
$member1Email_social = $sqlFETCHmember1Data[8];
$member1City_social = $sqlFETCHmember1Data[9];
$member1District_social = $sqlFETCHmember1Data[10];
$member1Addr_social = $sqlFETCHmember1Data[11];
$member1Job_social = $sqlFETCHmember1Data[13];
$member1Title_social = $sqlFETCHmember1Data[14];
$member1Year_social = $sqlFETCHmember1Data[15];

//取得隊員資料
$sqlSELECTmember2Data = " SELECT * FROM socialInfo WHERE teamNO = '$teamNO' AND remarks = '隊員' ";
$sqlRESULTmember2Data = mysql_query($sqlSELECTmember2Data, $sqlLink);
$sqlFETCHmember2Data = mysql_fetch_row($sqlRESULTmember2Data);
$member2Name_social = $sqlFETCHmember2Data[3];
$member2Sex_social = $sqlFETCHmember2Data[4];
$member2ID_social = $sqlFETCHmember2Data[5];
$member2Birth_social = $sqlFETCHmember2Data[6];
$member2Phone_social = $sqlFETCHmember2Data[7];
$member2Email_social = $sqlFETCHmember2Data[8];
$member2City_social = $sqlFETCHmember2Data[9];
$member2District_social = $sqlFETCHmember2Data[10];
$member2Addr_social = $sqlFETCHmember2Data[11];
$member2Job_social = $sqlFETCHmember2Data[13];
$member2Title_social = $sqlFETCHmember2Data[14];
$member2Year_social = $sqlFETCHmember2Data[15];



//寫入Log
	$file_name = "../log/adminLog.txt"; //檔案名稱
	$file = @file("$file_name"); //讀取檔案
	$open = @fopen("$file_name","a"); //開啟檔案，要是沒有檔案將建立一份
	$log =  "\r\n$todayDate $staffNO 調閱了 $teamNO 準備進行編輯 ";
	@fwrite($open,$log); //寫入資料
	fclose($open); //關閉檔案

//---訂單資料---
//MN_social=[0]
//payWay_social=[1]
//payStatus_social=[2]
//patTime_social=[3]
//vAccount_social=[4]
//---隊伍資料---
//schoolID_social=[5]
//teamName_social=[6]
//---隊長資料---
//captainName_social=[7]
//captainSex_social=[8]
//captainID_social=[9]
//captainBirth_social=[10]
//captainPhone_social=[11]
//captainEmail_social=[12]
//captainCity_social=[13]
//captainDistrict_social=[14]
//captainAddr_social=[15]
//captainJob_social=[16]
//captainTitle_social=[17]
//captainYear_social=[18]

//---副手資料---
//member1Name_social=[19]
//member1Sex_social=[20]
//member1ID_social=[21]
//member1Birth_social=[22]
//member1Phone_social=[23]
//member1Email_social=[24]
//member1City_social=[25]
//member1District_social=[26]
//member1Addr_social=[27]
//member1Job_social=[28]
//member1Title_social=[29]
//member1Year_social=[30]
//---隊員資料---
//member2Name_social=[31]
//member2Sex_social=[32]
//member2ID_social=[33]
//member2Birth_social=[34]
//member2Phone_social=[35]
//member2Email_social=[36]
//member2City_social=[37]
//member2District_social=[38]
//member2Addr_social=[39]
//member2Job_social=[40]
//member2Title_social=[41]
//member2Year_social=[42]

//建立回傳值Array
$arr = array($MN_social, $payWay_social, $payStatus_social, $patTime_social, $vAccount_social, $teamNO_social, $teamName_social, $captainName_social, $captainSex_social, $captainID_social, $captainBirth_social, $captainPhone_social, $captainEmail_social, $captainCity_social, $captainDistrict_social, $captainAddr_social, $captainJob_social, $captainTitle_social, $captainYear_social, $member1Name_social, $member1Sex_social, $member1ID_social, $member1Birth_social, $member1Phone_social, $member1Email_social, $member1City_social, $member1District_social, $member1Addr_social, $member1Job_social, $member1Title_social, $member1Year_social, $member2Name_social, $member2Sex_social, $member2ID_social, $member2Birth_social, $member2Phone_social, $member2Email_social, $member2City_social, $member2District_social, $member2Addr_social, $member2Job_social, $member2Title_social, $member2Year_social);
echo json_encode($arr);

?>