<?php
// 取得欄位
$projectNO = $_POST["rankProject"];
$bach = $_POST["rankBach"];

// export CVS
if (isset($_POST["export"]));
{
	require_once ("../vender/dbtools.inc.php");
//	$connect = mysqli_connect("localhost", "hermesn1_admin", "Since2018", "hermesn1_wmpccaBackEnd");
	header('Content-Type:text/csv; charset=utf-8');
	header('Content-Disposition:attachment; filename=histockRank.csv');
	echo "\xEF\xBB\xBF";
	$output = fopen("php://output", "w");
	fputcsv($output);
$query = "
		SELECT
		histock_HTscore.examNumber,
		histock_HTscore.Rank,
		histock_HTinfo.school,
		histock_HTinfo.name,
		histock_HTinfo.identifyNO
		FROM histock_HTscore
		JOIN histock_HTsignup ON histock_HTscore.examNumber = histock_HTsignup.examNumber
		JOIN histock_HTinfo ON histock_HTsignup.identifyNO = histock_HTinfo.identifyNO
		WHERE histock_HTscore.projectNO = '$projectNO' AND histock_HTscore.bach = '$bach' AND histock_HTscore.combineScore != '' ORDER BY CAST(combineScore AS DECIMAL(5,2)) DESC
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