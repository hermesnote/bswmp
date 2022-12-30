<?php
//include library
include('../vender/TCPDF/tcpdf.php');

//取得今天日期
$todayDate = date("Y-m-d H:i:s");

//取得參數
$school = $_POST["proveSchool"];
$captainName = $_POST["proveCaptainName"];
$member1Name = $_POST["proveMember1Name"];
$member2Name = $_POST["proveMember2Name"];
$projectName = $_POST["proveProjectName"];
$teamNO = $_POST["proveTeamNO"];
$teamName = $_POST["proveTeamName"];
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
		<div style="font-size:50px;text-align:center;">參 賽 證 明<div/>
		<div style="font-size:18px;text-align:center;margin:0;">
			'.$school.'　'.$teamName.' 隊<br>
			'.$captainName.'　'.$member1Name.'　'.$member2Name.'　　　參與 <br>
			'.$projectName.' <br>
			茲以證明
		</div>
		<div style="font-size:22px;text-align:center;">
			<img src="../img/wmp.png" alt="" width="120"><br>
			<img src="../img/wmpccaChair.png" alt="" width="350"><br>
			民國 '.$YY.' 年 '.$MM.' 月 '.$DD.' 日 <br>
			台 灣 財 富 管 理 規 劃 顧 問 認 證 協 會
		<div/>
';

// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');

//output
$pdf -> Output($fileName, 'I');

?>