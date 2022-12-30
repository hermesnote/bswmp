<?php


//連線資料庫
require_once ("../vender/dbtools.inc.php");

//載入PHPmailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//設定時區
date_default_timezone_set('Asia/Taipei');

// 設置資料類型 json，編碼格式 utf-8
header('Content-Type: application/json; charset=UTF-8');

//取得現在時間
$getToday = date("Y-m-d H:i:s");

//建立資料庫
$teamDB = "histock_HSsignup";
$memberDB = "histock_HSinfo";

//生成驗證碼
$str="QWERTYUIOPASDFGHJKLZXCVBNM1234567890qwertyuiopasdfghjklzxcvbnm";
str_shuffle($str);
$vCode = substr(str_shuffle($str), 26, 8);

//建立回傳參數
$getCode = "done";

//取得AJAX傳值
	// 隊伍
$projectNO = $_POST["projectNO"];
$conference = $_POST["conference"];
$city = $_POST["city"];
	// 轉換城市名
	$sqlSELECTcity = " SELECT city FROM cityCode WHERE cityCode = '$city' ";
	$sqlRESULTcity = mysql_query($sqlSELECTcity, $sqlLink);
	$sqlFETCHcity = mysql_fetch_array($sqlRESULTcity);
	$cityName = $sqlFETCHcity["city"]; // 取得城市名
$hischool = $_POST["hischool"];
	$school = $city.$hischool;
	// 轉換校名
	$sqlSELECTschool = " SELECT school FROM hischoolCode WHERE cityCode = '$city' AND schoolCode = '$hischool' ";
	$sqlRESULTschool = mysql_query($sqlSELECTschool, $sqlLink);
	$sqlFETCHschool = mysql_fetch_array($sqlRESULTschool);
	$schoolName = $sqlFETCHschool["school"]; // 取得學校名
$teacher = $_POST["teacher"];
$teamName = $_POST["teamName"];


//生成隊伍測驗編號
$examNumber = $projectNO.substr(date("d"),0,2).substr(date("s"),0,2).str_pad(mt_rand(0000, 9999), 4, "0", STR_PAD_LEFT);


	// 隊長
$capName = $_POST["capName"];
$capId = $_POST["capId"];
$capSN = $_POST["capSN"];
$capMobile = $_POST["capMobile"];
$capEmail = $_POST["capEmail"];
	//隊長寫入資料庫
	$sqlINSERTcapInfo = "
		INSERT INTO $memberDB
		( registerTime, projectNO, examNumber, school, name, identifyNO, studentNO, mobile, email, remarks )
		VALUES
		( '$getToday', '$projectNO', '$examNumber', '$school', '$capName', '$capId', '$capSN', '$capMobile', '$capEmail', '隊長' )
	";
	$sqlINSERTcap = mysql_query($sqlINSERTcapInfo, $sqlLink);



	// 副手
$viceName = $_POST["viceName"];
$viceId = $_POST["viceId"];
$viceSN = $_POST["viceSN"];
$viceMobile = $_POST["viceMobile"];
$viceEmail = $_POST["viceEmail"];
	// 副手寫入隊員資料庫
	$sqlINSERTviceInfo = "
		INSERT INTO $memberDB
		( registerTime, projectNO, examNumber, school, name, identifyNO, studentNO, mobile, email, remarks )
		VALUES
		( '$getToday', '$projectNO', '$examNumber', '$school', '$viceName', '$viceId', '$viceSN', '$viceMobile', '$viceEmail', '副手' )
	";
	$sqlINSERTvice = mysql_query($sqlINSERTviceInfo, $sqlLink);



	// 隊員
$memName = $_POST["memName"];
$memId = $_POST["memId"];
$memSN = $_POST["memSN"];
$memMobile = $_POST["memMobile"];
$memEmail = $_POST["memEmail"];
if( ($memName != '')&&($memId != '')&&($memSN != '')&&($memMobile != '')&&($memEmail != '') ){
	// 隊員寫入隊員資料庫
	$sqlINSERTmemInfo = "
		INSERT INTO $memberDB
		( registerTime, projectNO, examNumber, school, name, identifyNO, studentNO, mobile, email, remarks )
		VALUES
		( '$getToday', '$projectNO', '$examNumber', '$school', '$memName', '$memId', '$memSN', '$memMobile', '$memEmail', '隊員' )
	";
	$sqlINSERTmem = mysql_query($sqlINSERTmemInfo, $sqlLink);
}


//寫入隊伍資料庫
$sqlINSERTData = "
	INSERT INTO $teamDB ( registerTime, projectNO, examNumber, teamName, conference, city, school, teacher, pwd )
	VALUES ( '$getToday', '$projectNO', '$examNumber', '$teamName', '$conference', '$city', '$hischool', '$teacher', '$vCode' )
";
$sqlINSERTteam = mysql_query($sqlINSERTData, $sqlLink);

// 取得競賽名稱
$sqlSELECTprojectName = " SELECT projectName FROM histock_eventList WHERE projectNO = '$projectNO' ";
$sqlRESULTprojectName = mysql_query($sqlSELECTprojectName, $sqlLink);
$sqlFETCHprojectName = mysql_fetch_array($sqlRESULTprojectName);
$projectName = $sqlFETCHprojectName["projectName"];

//發送信件
require '../ecPay/Exception.php';
require '../ecPay/PHPMailer.php';
require '../ecPay/SMTP.php';

$mail = new PHPMailer(true);

// 設定為 SMTP 方式寄信
$mail->IsSMTP();

//設定為HTML
$mail->isHTML();

// SMTP 伺服器的設定，以及驗證資訊
$mail->SMTPAuth = true;      
$mail->Host = "wmpcca.com"; //請填您有指過到大朵主機的網址名稱
$mail->Port = 25; //大朵主機的郵件伺服器port為 25 
$mail->SMTPAuth = false;
$mail->SMTPSecure = false;

// 信件內容的編碼方式       
$mail->CharSet = "utf-8";

// 信件處理的編碼方式
$mail->Encoding = "base64";

// SMTP 驗證的使用者資訊
$mail->Username = "service@wmpcca.com";  //在cpanel新增mail的帳號（需要完整的mail帳號，含@後都要填寫）
$mail->Password = "Since2018";  //在cpanel新增mail帳號時設定的密碼，請小心是否有空格，空格也算一碼。

//寄發開通碼通知Email
	// 隊長
$mail->ClearAddresses();
$mail->setFrom('service@wmpcca.com', '台灣財富管理規劃顧問認證協會'); 
$mail->AddAddress($capEmail);
$mail->Subject = "競賽驗證碼"; //信件主旨
$mail->Body = "
	  <p>  嗨! $teamName 隊, 來自 $cityName $schoolName , 歡迎參加 $projectName($projectNO) </p>
	  <p>  隊長：$capName , 副手：$viceName, 隊員：$memName,</p>	  
	  <p>  您的隊伍編號：$examNumber </p>
	  <p>  您的驗證碼：$vCode </p>
	  <p>  請使用上述隊伍編號及驗證碼登入競賽專區進行活動</p>
	  
<br><br><br><br><br>
      <h3>台灣財富管理規劃顧問認證協會 WMPCCA</h3>
      <h4>任何問題請至協會網站填寫線上聯絡表單，或參考以下資訊：<br>
      <a href='http://www.wmpcca.com'>協會首頁</a> | E-mail：<a href='mailto:wmpdatw@gmail.com'>wmpdatw@gmail.com</a><br>
      電話：(02)2501-6862 | 傳真：(02)2501-6882<br>
      週一至週五09:30-18:00</h4>
      <a style='font-size: 13px'>此為系統自動發送，請勿直接回覆。可以參考我們的<a href='http://www.wmpcca.com' style='font-size: 13px'>隱私權政策</a>. <a style='font-size: 13px'>為了確保能收到來自台灣財富管理規劃顧問認證協會的信件，請將service@wmpcca.com加入您的通訊錄</a>
";

$mail->Send();


	// 副手
$mail->ClearAddresses();
$mail->setFrom('service@wmpcca.com', '台灣財富管理規劃顧問認證協會'); 
$mail->AddAddress($viceEmail);
$mail->Subject = "競賽驗證碼"; //信件主旨
$mail->Body = "
	  <p>  嗨! $teamName 隊, 來自 $cityName $schoolName , 歡迎參加 $projectName($projectNO) </p>
	  <p>  隊長：$capName , 副手：$viceName, 隊員：$memName,</p>	  
	  <p>  您的隊伍編號：$examNumber </p>
	  <p>  您的驗證碼：$vCode </p>
	  <p>  請使用上述隊伍編號及驗證碼登入競賽專區進行活動</p>
	  
<br><br><br><br><br>
      <h3>台灣財富管理規劃顧問認證協會 WMPCCA</h3>
      <h4>任何問題請至協會網站填寫線上聯絡表單，或參考以下資訊：<br>
      <a href='http://www.wmpcca.com'>協會首頁</a> | E-mail：<a href='mailto:wmpdatw@gmail.com'>wmpdatw@gmail.com</a><br>
      電話：(02)2501-6862 | 傳真：(02)2501-6882<br>
      週一至週五09:30-18:00</h4>
      <a style='font-size: 13px'>此為系統自動發送，請勿直接回覆。可以參考我們的<a href='http://www.wmpcca.com' style='font-size: 13px'>隱私權政策</a>. <a style='font-size: 13px'>為了確保能收到來自台灣財富管理規劃顧問認證協會的信件，請將service@wmpcca.com加入您的通訊錄</a>
";
$mail->Send();


	// 隊員
if( ($memName != '')&&($memId != '')&&($memSN != '')&&($memMobile != '')&&($memEmail != '') ){
	$mail->ClearAddresses();
	$mail->setFrom('service@wmpcca.com', '台灣財富管理規劃顧問認證協會'); 
	$mail->AddAddress($memEmail);
	$mail->Subject = "競賽驗證碼"; //信件主旨
	$mail->Body = "
		  <p>  嗨! $teamName 隊, 來自 $cityName $schoolName , 歡迎參加 $projectName($projectNO) </p>
		  <p>  隊長：$capName , 副手：$viceName, 隊員：$memName,</p>	  
		  <p>  您的隊伍編號：$examNumber </p>
		  <p>  您的驗證碼：$vCode </p>
		  <p>  請使用上述隊伍編號及驗證碼登入競賽專區進行活動</p>

	<br><br><br><br><br>
		  <h3>台灣財富管理規劃顧問認證協會 WMPCCA</h3>
		  <h4>任何問題請至協會網站填寫線上聯絡表單，或參考以下資訊：<br>
		  <a href='http://www.wmpcca.com'>協會首頁</a> | E-mail：<a href='mailto:wmpdatw@gmail.com'>wmpdatw@gmail.com</a><br>
		  電話：(02)2501-6862 | 傳真：(02)2501-6882<br>
		  週一至週五09:30-18:00</h4>
		  <a style='font-size: 13px'>此為系統自動發送，請勿直接回覆。可以參考我們的<a href='http://www.wmpcca.com' style='font-size: 13px'>隱私權政策</a>. <a style='font-size: 13px'>為了確保能收到來自台灣財富管理規劃顧問認證協會的信件，請將service@wmpcca.com加入您的通訊錄</a>
	";
	$mail->Send();
}

//寫入Log
	$ipAddr = $_SERVER['REMOTE_ADDR'];
	$file_name = "../log/competLog.txt"; //檔案名稱
	$file = @file("$file_name"); //讀取檔案
	$open = @fopen("$file_name","a"); //開啟檔案，要是沒有檔案將建立一份
	$log =  "\r\n$getToday IP:$ipAddr , ID:$capid, USER:$capName 新增了一筆 $projectNO 報名資料, 隊名$teamName, 取得隊編$examNumber, 驗證碼寄至$capEmail, $viceEmail, $memEmail";
	@fwrite($open,$log); //寫入資料
	fclose($open); //關閉檔案

//回傳成功訊息
echo json_encode($getCode);

?>