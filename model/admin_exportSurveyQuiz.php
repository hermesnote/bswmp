<?php
require_once ("../vender/dbtools.inc.php");
// export CVS
if (isset($_POST["quizQ"]));
{
	$surveyNO = $_POST["quizQ"];
	
//	$connect = mysqli_connect("localhost", "hermesn1_admin", "Since2018", "hermesn1_wmpccaBackEnd");
	header('Content-Type:text/csv; charset=utf-8');
	header('Content-Disposition:attachment; filename=surveyQuiz.csv');
	echo "\xEF\xBB\xBF";
	
	$output = fopen("php://output", "w");
	fputcsv($output);
	
	$query = "SELECT * FROM $surveyNO ORDER BY id ASC";
	$result = mysql_query($query, $sqlLink);
		while ($row = mysql_fetch_assoc($result)) 
		{
			fputcsv($output, $row);
		}
	fclose($output);
}

?>