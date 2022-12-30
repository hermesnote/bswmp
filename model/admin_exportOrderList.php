<?php
// export CVS
if (isset($_POST["export"]));
{
	require_once ("../vender/dbtools.inc.php");
//	$connect = mysqli_connect("localhost", "hermesn1_admin", "Since2018", "hermesn1_wmpccaBackEnd");
	header('Content-Type:text/csv; charset=utf-8');
	header('Content-Disposition:attachment; filename=orderList.csv');
	echo "\xEF\xBB\xBF";
	$output = fopen("php://output", "w");
	fputcsv($output);
	$query = "SELECT * FROM orderList ORDER BY id ASC";
	$result = mysql_query($query, $sqlLink);
	while ($row = mysql_fetch_assoc($result)) 
	{
		fputcsv($output, $row);
	}
	fclose($output);
}

?>