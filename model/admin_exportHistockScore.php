<?php
// 取得欄位
$projedctNO = $_POST["projectNO"];
$bach = $_POST["rankBach"];

// export CVS
if (isset($_POST["export"]));
{
	require_once ("../vender/dbtools.inc.php");
//	$connect = mysqli_connect("localhost", "hermesn1_admin", "Since2018", "hermesn1_wmpccaBackEnd");
	header('Content-Type:text/csv; charset=utf-8');
	header('Content-Disposition:attachment; filename=histockScore.csv');
	echo "\xEF\xBB\xBF";
	$output = fopen("php://output", "w");
	fputcsv($output);
$query = "
		SELECT *
		FROM histock_HTscore
		WHERE projectNO = '$projectNO' AND bach = '$bach' AND combineScore != ''
";
//	$query = "SELECT * FROM histock_HTsignup LEFT OUTER JOIN histock_HTinfo ON histock_HTsignup.identifyNO = histock_HTinfo.identifyNO";
//	$query = "SELECT * FROM histock_HTsignup ORDER BY id ASC";
	$result = mysql_query($query, $sqlLink);
	while ($row = mysql_fetch_assoc($result)) 
	{
		fputcsv($output, $row);
	}
	fclose($output);
}

?>