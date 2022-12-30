<?php
// export CVS
if (isset($_POST["export"]));
{
	require_once ("../vender/dbtools.inc.php");
//	$connect = mysqli_connect("localhost", "hermesn1_admin", "Since2018", "hermesn1_wmpccaBackEnd");
	header('Content-Type:text/csv; charset=utf-8');
	header('Content-Disposition:attachment; filename=HistcokScoreHT.csv');
	echo "\xEF\xBB\xBF";
	$output = fopen("php://output", "w");
	fputcsv($output);
$query = "
		SELECT * FROM histock_HTscore ORDER BY id ASC
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