<?php require_once("vender/dbtools.inc.php") ?>


<?php
//設定參數
//$teamNO = "CG1928365755"; //手動輸入
$teamNO = $_POST["teamNO"];

//用teamNO找出orderNO
$sqlSELECTorderNO = " SELECT * FROM orderList WHERE customerNO = '$teamNO' AND payStatus = '完成' ";
$sqlRESULTorderNO = mysql_query($sqlSELECTorderNO, $sqlLink);
$sqlFETCHorderNO = mysql_fetch_row($sqlRESULTorderNO);
$orderNO = $sqlFETCHorderNO[2];
$projectName = $sqlFETCHorderNO[5];
$MN = $sqlFETCHorderNO[6];

//用teamNO找出校名及隊名
$sqlSELECTteamInfo = " SELECT * FROM competCollege WHERE teamNO = '$teamNO' ";
$sqlRESULTteamInfo = mysql_query($sqlSELECTteamInfo, $sqlLink);
$sqlFETCHteamInfo = mysql_fetch_row($sqlRESULTteamInfo);
$school = $sqlFETCHteamInfo[5];
$teamName = $sqlFETCHteamInfo[6];

//用teamNO找出隊長名字
$sqlSELECTcaptainName = " SELECT name FROM studentsInfo WHERE teamNO = '$teamNO' AND remarks = '隊長' ";
$sqlRESULTcaptainName = mysql_query($sqlSELECTcaptainName, $sqlLink);
$sqlFETCHcaptainName = mysql_fetch_row($sqlRESULTcaptainName);
$captainName = $sqlFETCHcaptainName[0];

//用teamNO找出副手名字
$sqlSELECTmember1Name = " SELECT name FROM studentsInfo WHERE teamNO = '$teamNO' AND remarks = '隊員1' ";
$sqlRESULTmember1Name = mysql_query($sqlSELECTmember1Name, $sqlLink);
$sqlFETCHmember1Name = mysql_fetch_row($sqlRESULTmember1Name);
$member1Name = $sqlFETCHmember1Name[0];

//用teamNO找出隊員名字
$sqlSELECTmember2Name = " SELECT name FROM studentsInfo WHERE teamNO = '$teamNO' AND remarks = '隊員2' ";
$sqlRESULTmember2Name = mysql_query($sqlSELECTmember2Name, $sqlLink);
$sqlFETCHmember2Name = mysql_fetch_row($sqlRESULTmember2Name);
$member2Name = $sqlFETCHmember2Name[0];

//用orderNO找出收據資訊
$sqlSELECTreceipt = " SELECT * FROM receiptList WHERE orderNO = '$orderNO' ";
$sqlRESULTreceipt = mysql_query($sqlSELECTreceipt, $sqlLink);
$sqlFETCHreceipt = mysql_fetch_row($sqlRESULTreceipt);
$Date = $sqlFETCHreceipt[1];
$receiptNO = $sqlFETCHreceipt[2];

//轉換時間為民國並拆分年月日 108/11/11 12:12:12
$YY = substr($Date, 0, 4) - 1911;
$MM = substr($Date, 5, 2);
$DD = substr($Date, 8, 2);
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
			<p>中華民國   <?php echo $YY; ?> 年   <?php echo $MM; ?> 月   <?php echo $DD; ?> 日</p>
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
			<h2><?php echo $school; ?> <?php echo $teamName; ?> 隊<br>
				<?php echo $captainName;?> <?php echo $member1Name; ?> <?php echo $member2Name; ?></h2>
		</td>
	</tr>
	<tr>
		<td><h2>項目名稱</h2></td>
		<td style='text-align: center;'><h2><?php echo $projectName.'報名費'; ?></h2></td>
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
			<h2>社團法人台灣財富管理規劃顧問認證協會 理事長 <img src='https://wmpcca.com/bswmp/form/img/wmp011.png' width='8%' height='8%' alt='' style='vertical-align: sub;'>　秘書長 <img src='https://wmpcca.com/bswmp/form/img/wmp022.png' width='8%' height='8%' alt='' style='vertical-align: sub;'>　會計 <img src='https://wmpcca.com/bswmp/form/img/wmp033.png' width='8%' height='8%' alt='' style='vertical-align: sub;'></h2>
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
