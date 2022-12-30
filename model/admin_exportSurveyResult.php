<?php

require_once ("../vender/dbtools.inc.php");

// export CVS
if (isset($_POST["result"]));
{
	$quizArr = array("流水號", "作答時間", "隊伍編號", "角色", "性別", "年齡", "學校", "科系", "年級");
	$surveyNO = $_POST["result"];
	$surveyQuiz = $surveyNO.'Q';
	$sqlSELECTquizQ = mysql_query("
		SELECT * FROM $surveyQuiz
	");
	while ($topic = mysql_fetch_assoc($sqlSELECTquizQ)){
//		foreach ( $row as $topic ){
			array_push($quizArr, $topic['quizTopic']);
//		}
	}

	header('Content-Type:text/csv; charset=utf-8');
	header('Content-Disposition:attachment; filename=surveyResult.csv');
	echo "\xEF\xBB\xBF";
	
	$output = fopen("php://output", "w");
	fputcsv($output, $quizArr);
	
	$query = "SELECT * FROM $surveyNO ORDER BY id ASC";
	$result = mysql_query($query, $sqlLink);
		while ($row = mysql_fetch_assoc($result)) {
			fputcsv($output, $row);
		}
	fclose($output);
}


?>