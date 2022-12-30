<?php

require_once ("../vender/dbtools.inc.php");

// 設置資料類型 json，編碼格式 utf-8
header('Content-Type: application/json; charset=UTF-8');

//取得日期
$today = date("Y-m-d H:i:s");

// 回傳字串
$dataEPT = "建新問卷需至少選擇一個題組";
$res = "Done";


//接Ajax
$surveyArr = $_POST["surveyArr"];
	if ( $surveyArr == '' ){
		echo json_encode($dataEPT);
		exit();
	}

// 陣列轉字串
$newSurvey = implode(",", $surveyArr);


// 建立當年初始卷號
$surveyNumber = 'S'.date("y").'E'.'01'; // ex: 20ST03201

// 尋找是否已存在, 若存在則取最近一筆+1, 若否則做為初始
$sqlSELECTsurveyNumber = " SELECT * FROM surveyList WHERE number = '$surveyNumber' ";
$sqlRESULTsurveyNumber = mysql_query($sqlSELECTsurveyNumber, $sqlLink);
$sqlROWsurveyNumber = mysql_num_rows($sqlRESULTsurveyNumber);
if ($sqlROWsurveyNumber == 0 ){
	$surveyNumber = $surveyNumber;
}else{
	// 取得該師最近一筆
	$sqlSELECTsurvey = " SELECT number FROM surveyList ORDER BY id desc ";
	$sqlRESULTsurvey = mysql_query($sqlSELECTsurvey, $sqlLink);
	$lastFETCHsurvey = mysql_fetch_array($sqlRESULTsurvey);
	$latestNumber = $lastFETCHsurvey[0];
	$getStr = substr($latestNumber, -2);
	$strAdd1 = $getStr+1;
	$lastStr = str_pad($strAdd1, 2, "0", STR_PAD_LEFT);
	$surveyNumber = 'S'.date("y").'E'.$lastStr;
}

// 存入資料庫
$sqlINSERTsurvey = "
					INSERT INTO surveyList ( dateTime, number, groups )
					VALUES ( '$today', '$surveyNumber', '$newSurvey' )
";
$sqlINSERT = mysql_query($sqlINSERTsurvey, $sqlLink);

// 新增問卷題庫資料表
$quizQ = $surveyNumber.'Q';
$sqlCREATEtableQ = "
	CREATE TABLE $quizQ (
		id INT AUTO_INCREMENT PRIMARY KEY,
		quizNumber VARCHAR(20) NOT NULL,
		quizTopic VARCHAR(100) NOT NULL
	)
	ENGINE = InnoDB
	DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci
";
$sqlDOCREATEQ = mysql_query($sqlCREATEtableQ);

// 新增答卷資料表
$sqlCREATEtable = "
	CREATE TABLE $surveyNumber (
		id INT AUTO_INCREMENT PRIMARY KEY,
		time datetime NOT NULL,
		teamNO VARCHAR(20) NOT NULL,
		role VARCHAR(20) NOT NULL,
		sex VARCHAR(20) NOT NULL,
		age VARCHAR(20) NOT NULL,
		school VARCHAR(20) NOT NULL,
		depart VARCHAR(20) NOT NULL,
		grade VARCHAR(20) NOT NULL
	)
	ENGINE = InnoDB
	DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci
";
$sqlDOCREATE = mysql_query($sqlCREATEtable);


// 建立該問卷答題資料表 & 滾出所有題號
$groupsArr = $surveyArr;  // 主題組題號Array
//$subsArr = array();
//$quizArr = array();
	
foreach( $groupsArr as $groupsNumber ){
	
		
	// 找出主題組內的副題組
	$sqlSELECTsurveySubs = mysql_query(" SELECT number FROM surveySub WHERE number LIKE '$groupsNumber%' ");
	while ( $subsArr = mysql_fetch_array($sqlSELECTsurveySubs) ){
		foreach ( $subsArr as $subsNumber ){
			
			// 找出副題組
			$sqlSELECTsurveyQuiz = mysql_query(" SELECT number FROM surveyDB WHERE number LIKE '$subsNumber%' ");
			while ( $quizArr = mysql_fetch_array($sqlSELECTsurveyQuiz) ){
				foreach ( $quizArr as $quizNumber ){
				// 依題組建新欄位
				$sqlALTER = "
					ALTER TABLE $surveyNumber
					ADD $quizNumber
					VARCHAR (20) NOT NULL
				";
				$sqlDOALTER = mysql_query($sqlALTER, $sqlLink);
				}
			}
		}
	}
}



foreach( $groupsArr as $groupsNumber ){
		
	// 找出主題組內的副題組
	$sqlSELECTsurveySubs = mysql_query(" SELECT number FROM surveySub WHERE number LIKE '$groupsNumber%' ");
	while ( $subsArr = mysql_fetch_array($sqlSELECTsurveySubs) ){
		
		foreach ( $subsArr as $subsNumber ){
			$sqlSELECTsurveyQuizQ = mysql_query(" SELECT number, topic FROM surveyDB WHERE number LIKE '$subsNumber%' ");
		}
		
		while( $quizQArr = mysql_fetch_assoc($sqlSELECTsurveyQuizQ) ){
			$quizQArrNumber = $quizQArr['number'];
			$quizQArrTopic = $quizQArr['topic'];
			$sqlINSERT = "
				INSERT INTO $quizQ ( quizNumber, quizTopic )
				VALUES ( '$quizQArrNumber', '$quizQArrTopic' )
			";
			$sqlDOINSERT = mysql_query($sqlINSERT);	
		}
	}
}

echo json_encode($res);
exit();

?>