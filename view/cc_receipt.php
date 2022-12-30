<?php require_once("../vender/dbtools.inc.php") ?>


<?php
//取得今天日期
$todayDate = date("Y-m-d H:i:s");

//取得隱藏表單參數
$receiptNO = $_POST["receiptNO"];
$school = $_POST["receiptSchool"];
$teamNO = $_POST["receiptTeamNO"];
$teamName = $_POST["receiptTeamName"];
$projectName = $_POST["receiptProjectName"].'報名費';
$MN = $_POST["receiptMN"];
$payTime = $_POST["receiptTPayTime"];
$captainName = $_POST["receiptCaptainName"];
$member1Name = $_POST["receiptMember1Name"];
$member2Name = $_POST["receiptMember2Name"];
//轉換繳費時間為民國並拆分年月日 108/11/11 12:12:12
$PaymentDateY = substr($payTime, 0, 4) - 1911;
$PaymentDateM = substr($payTime, 5, 2);
$PaymentDateD = substr($payTime, 8, 2);
//寫入Log
	$file_name = "../log/competLog.txt"; //檔案名稱
	$file = @file("$file_name"); //讀取檔案
	$open = @fopen("$file_name","a"); //開啟檔案，要是沒有檔案將建立一份
	$log =  "\r\n$todayDate $teamNO 開啟了收據 $receiptNO";
	@fwrite($open,$log); //寫入資料
	fclose($open); //關閉檔案

?>

<!DOCTYPE html>
<html>
<head>

<style>
	#wmpimg{
		width: 250px;
		height: 250px;
		position: absolute;
		z-index: -1;
		left: 0;
		right: 0;
		margin: 50px auto;
	}
	h2{
		margin-left: 20px;
	}
</style>

<meta charset='utf-8' />
<title></title>

<body>


<table border='0' bordercolor='#000000' cellpadding='0' cellspacing='0' width='1000px' align='center'>
	<tr>
		<td colspan='2' style='font-size: 40px;text-align: center;font-weight: bold;'>
			<img src='https://wmpcca.com/bswmp/form/img/wmp.png' alt='' id='wmpimg'>
			<p>社 團 法 人 台 灣 財 富 管 理 規 劃 顧 問 認 證 協 會</p>
			<p>收 款 收 據</p>
			<p>中華民國   <?php echo $PaymentDateY; ?> 年   <?php echo $PaymentDateM; ?> 月   <?php echo $PaymentDateD; ?> 日</p>
		</td>
	</tr>

	<tr>
		<td width='50%'>
			<p style='margin-left: 20px;font-size: 20px;'>協會統一編號:31814240</p>
			<p style='margin-left: 20px;font-size: 20px;'>協會立案證號:台內設字第1070035817號</p>
			<p style='margin-left: 20px;font-size: 20px;'>法人登記證書:登記簿第148冊第69頁第3162號</p>
		</td>
		<td width='50%'>
			<p style='font-size: 40px;text-align: center;'>NO.<?php echo $receiptNO; ?></p>
		</td>
	</tr>
</table>
<table border='1' bordercolor='#000000' cellpadding='0' cellspacing='0' width='1000px' align='center'>
	<tr>
		<td width='25%'><h2>繳款人</h2></td>
		<td width='75%' style='text-align: center;'>
			<h2><?php echo $school; ?> <?php echo $teamName; ?>隊<br>
				<?php echo $captainName;?> <?php echo $member1Name; ?> <?php echo $member2Name; ?></h2>
		</td>
	</tr>
	<tr>
		<td><h2>項目名稱</h2></td>
		<td style='text-align: center;'><h2><?php echo $projectName; ?></h2></td>
	</tr>
	<tr>
		<td><h2>金額</h2></td>
		<td style='text-align: center;'><h2>新台幣NT$ <?php echo $MN; ?>元 整</h2></td>
	</tr>
	<tr>
		<td><h2>備註</h2></td>
		<td style='text-align: center;'><h2></h2></td>
	</tr>
	<tr>
		<td colspan='2'>
			<h2>社團法人台灣財富管理規劃顧問認證協會 理事長 <img src='https://wmpcca.com/bswmp/form/img/111.png' width='8%' height='8%' alt='' style='vertical-align: sub;'>　秘書長 <img src='https://wmpcca.com/bswmp/form/img/222.png' width='8%' height='8%' alt='' style='vertical-align: sub;'>　會計 <img src='https://wmpcca.com/bswmp/form/img/333.png' width='8%' height='8%' alt='' style='vertical-align: sub;'></h2>
		</td>
	</tr>
</table>

<div style='text-align: center;margin-top: 50px;'>
<button onclick='printPage();' style="width:250px;height:50px;">列印本頁 (可另存為PDF)</button><br>
<p>※列印後可自行裁剪，保留收據完整性即可</p>
</div>
<script type='text/javascript'>
function printPage()
  {
  window.print()
  }
</script>



</body>
</html>
