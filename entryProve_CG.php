<?php
//include library
include('vender/TCPDF/tcpdf.php');

//取得參數
$school = $_POST["school"];
$captainName = $_POST["captainName"];
$member1Name = $_POST["member1Name"];
$member2Name = $_POST["member2Name"];
$projectName = $_POST["projectName"];
$teamNO = $_POST["teamNO"];
$teamName = $_POST["teamName"];
$fileName = $teamNO.'.pdf';
//轉換時間為民國並拆分年月日 108/11/11 12:12:12
$YY = $_POST["PaymentDateY"];
$MM = $_POST["PaymentDateM"];
$DD = $_POST["PaymentDateD"];

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
		<div><img src="img/wmpcca_mail_Banner.png" alt=""></div><br><br>
		<div style="font-size:50px;text-align:center;">參 賽 證 明<div/>
		<div style="font-size:20px;text-align:center;margin:0;">
			'.$school.'<br>
			'.$teamName.' 隊<br>
			'.$captainName.' '.$member1Name.' '.$member2Name.' <br>
			參與 '.$projectName.' <br>
			茲以證明
		</div>
		<div style="font-size:22px;text-align:center;">
			<img src="img/wmp.png" alt="" width="150"><br>
			<img src="img/wmpccaChair.jpg" alt="" width="400"><br>
			民國 '.$YY.' 年 '.$MM.' 月 '.$DD.' 日 <br>
			台 灣 財 富 管 理 規 劃 顧 問 認 證 協 會
		<div/>
';

// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');

//output
$pdf -> Output($fileName, 'I');

?>