<?php
// export CVS
if (isset($_POST["export"]));
{
	require_once ("../vender/dbtools.inc.php");
//	$connect = mysqli_connect("localhost", "hermesn1_admin", "Since2018", "hermesn1_wmpccaBackEnd");
	header('Content-Type:text/csv; charset=utf-8');
	header('Content-Disposition:attachment; filename=competCollege.csv');
	echo "\xEF\xBB\xBF";
	$output = fopen("php://output", "w");
	fputcsv($output);
$query = "
		SELECT 
			histock_HTsignup.examNumber, 
			histock_HTsignup.host,
			histock_HTsignup.bach, 
			histock_HTinfo.area, 
			histock_HTinfo.city, 
			histock_HTinfo.school, 
			histock_HTinfo.depart, 
			histock_HTinfo.name, 
			histock_HTinfo.sex, 
			histock_HTinfo.mobile, 
			histock_HTinfo.email
		FROM histock_HTsignup
		LEFT OUTER JOIN histock_HTinfo
		ON histock_HTsignup.identifyNO = histock_HTinfo.identifyNO
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