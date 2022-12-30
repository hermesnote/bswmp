<?php
//include library
include('../vender/TCPDF/tcpdf.php');

//取得今天日期
$todayDate = date("Y-m-d H:i:s");

//取得COOKIE陣列並解序還原
$loginInfo = unserialize($_COOKIE["loginInfo"]);
$examNO = $loginInfo[0];	//帳號
$pwd = $loginInfo[1];	//驗證碼
$host = $loginInfo[2];	//公關招待
$projectNO = $loginInfo[3];	//活動代號
//$projectName = $loginInfo[4];	//活動名稱
$fee = $loginInfo[5];	//報名費
$start = $loginInfo[6];	//開始報名
$end = $loginInfo[7];	//截止報名
$bachTimeAdd = $loginInfo[9]*60*60;	//正式測驗梯次時間
$bachTimeAdded = strtotime($bach)+$bachTimeAdd;	//正式測驗梯次時間結束時間
$passed = $loginInfo[10];	//帳密符合

//取得參數
$projectName = $_POST["proveProjectName"];
$bach = $_POST["proveBach"];
$city = $_POST["proveCity"];
$school = $_POST["proveSchool"];
$name = $_POST["proveName"];
$teamNO = $_POST["proveExamNO"];
$proveDate = $_POST["proveDate"];
$fileName = $teamNO.'.pdf';

//轉換時間為民國並拆分年月日 108/11/11 12:12:12
$YY = substr($proveDate, 0, 4) - 1911;
$MM = substr($proveDate, 5, 2);
$DD = substr($proveDate, 8, 2);

//寫入Log
	$file_name = "../log/competLog.txt"; //檔案名稱
	$file = @file("$file_name"); //讀取檔案
	$open = @fopen("$file_name","a"); //開啟檔案，要是沒有檔案將建立一份
	$log =  "\r\n$todayDate $teamNO 開啟了參賽證明";
	@fwrite($open,$log); //寫入資料
	fclose($open); //關閉檔案

//make TCPDF object
$pdf = new TCPDF( 'P', 'mm', 'A4', true, 'UTF-8', false, false );

//remove default header and footer
$pdf -> setPrintHeader(false);
$pdf -> setPrintFooter(false);
	
// add a page
$pdf->AddPage();

// writeHTML($html, $ln=true, $fill=false, $reseth=false, $cell=false, $align='')
// writeHTMLCell($w, $h, $x, $y, $html='', $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true)

// create some HTML content
$html = '
		<div><img src="../img/wmpcca_mail_Banner.png" alt=""></div><br><br>
		<div style="font-size:50px;text-align:center;">教 師 研 習 證 明<div/>
		<div style="font-size:20px;text-align:center;margin:0;">
			'.$city.''.$school.'　'.$name.' 老師<br>
			參與本會 '.$bach.'<br>
			『'.$projectName.'』<br>
			研習暨選拔競賽時數 共計 七 小時<br>
			特發此證以茲證明
		</div>
		<div style="font-size:22px;text-align:center;">
			<img src="../img/wmp.png" alt="" width="150"><br>
			<img src="../img/wmpccaChair.jpg" alt="" width="400"><br>
			民國 '.$YY.' 年 '.$MM.' 月 '.$DD.' 日 <br>
			台 灣 財 富 管 理 規 劃 顧 問 認 證 協 會
		<div/>
';

// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');

//output
$pdf -> Output($fileName, 'I');

?>