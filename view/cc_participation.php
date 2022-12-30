<?php require_once("../vender/dbtools.inc.php") ?>

<?php

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
$projectName = $_POST["projectName"];
$MN = $_POST["MN"];
$payStatus = $_POST["payStatus"];
$firstReport = $_POST["firstReport"];

if ($firstReport === ''){
	echo"<script type='text/javascript'>";
	echo "alert('尚未收到初賽報告書！');";
	echo "window.close()";
	echo "</script>";
}

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
			<p>參 賽 證 明</p>
			<p>中華民國   <?php echo $PaymentDateY; ?> 年   <?php echo $PaymentDateM; ?> 月   <?php echo $PaymentDateD; ?> 日</p>
		</td>
	</tr>

</table>
<table border='1' bordercolor='#000000' cellpadding='0' cellspacing='0' width='1000px' align='center'>
	<tr>
		<td width='25%'><h2>隊伍資訊</h2></td>
		<td width='75%' style='text-align: center;'>
			<h2><?php echo $teamName; ?>隊　<?php echo $captainName;?> <?php echo $member1Name; ?> <?php echo $member2Name; ?></h2>
		</td>
	</tr>
	<tr>
		<td><h2>參賽項目</h2></td>
		<td style='text-align: center;'><h2><?php echo $projectName; ?></h2></td>
	</tr>
	<tr>
		<td><h2>備註</h2></td>
		<td style='text-align: center;'><h2></h2></td>
	</tr>
	<tr>
		<td colspan='2'>
			<h2>社團法人台灣財富管理規劃顧問認證協會 理事長 <img src='https://wmpcca.com/bswmp/form/img/wmp011.png' width='8%' height='8%' alt='' style='vertical-align: sub;'>　秘書長 <img src='https://wmpcca.com/bswmp/form/img/wmp022.png' width='8%' height='8%' alt='' style='vertical-align: sub;'>　會計 <img src='https://wmpcca.com/bswmp/form/img/wmp033.png' width='8%' height='8%' alt='' style='vertical-align: sub;'></h2>
		</td>
	</tr>
</table>

<div style='text-align: center;margin-top: 50px;'>
<button onclick='printPage();' style="width:140px;height:50px;">列印本頁</button><br>
<p>※列印後可自行裁剪，保留證明完整性即可</p>
</div>
<script type='text/javascript'>
function printPage()
  {
  window.print()
  }
</script>



</body>
</html>
