<?php
require_once("../vender/dbtools.inc.php");

$getToday = date("Y-m-d H:i:s");

// GET取值
$survey = $_GET['survey'];  // 取得問卷編號
$teamNO = $_GET['teamNO'];  // 取得隊伍編號

?>

<!doctype html>

<html>
<head>
<?php require_once("../model/index_rel.php") ?>


<link rel=stylesheet type="text/css" href="../css/body_global.css">
<link rel=stylesheet type="text/css" href="../css/keys_index.css">

<!-- nexus CSS -->
<link rel="stylesheet" href="../nexus/css/font-awesome.min.css">
<link rel="stylesheet" href="../nexus/vendors/animate-css/animate.css">
<link rel="stylesheet" href="../nexus/vendors/owl-carousel/owl.carousel.min.css">
<link rel="stylesheet" href="../nexus/vendors/flaticon/flaticon.css">

<link rel="stylesheet" href="../nexus/css/style.css">
<link rel="stylesheet" href="../nexus/css/responsive.css">
<meta charset="utf-8">

<title>WMPCCA - 財富管理競賽問卷</title>
	

	
<style>

	#selectRole {
		background-color: aliceblue;
	}
	.select_role_button {
		width: 200px;
		height: 80px;
		border-radius: 20px;
	}
	
	input[type="range"]{
		width:500px;
		height:30px;
	}
	
	input[type="radio"]{
		width:1em;
		height:1em;
	}
	
</style>	
	
	
</head>

<body>
<?php require_once("../model/cc_imgGroup_Modal.php") ?>

<!-- head banner -->
<section class="py-5" id="headBanner">
	<div class="container">
		<div class="row pt-2">
			<div class="col mx-auto text-center" id="headBannerLogo">
				<img src="../img/logo_01.png">
			</div>
		</div>
		<div class="row pt-2">
			<div class="col mx-auto pt-3" id="headBannerInfo">
				<p class="h2 text-center py-3">財富管理競賽問卷</p>
				<p class="h3 pt-3">親愛的參賽同學您好：</p>
				<p class="h3 pt-3">首先感謝您填寫這份問卷。這是一份學術性的研究問卷，目的是為了瞭解您參與本次全國大專財富管理個案競賽的參賽動機，業師與顧問的理財教育，以及針對運用KEYs財富管理軟體之知覺易用性、知覺有用性、理財態度、行為意圖、理財行為與理財素養間關聯之研究。懇請您撥空填寫，您的寶貴意見將是重要的研究資料。</p>
				<p class="h3 pt-3">問卷所收集的資訊僅供學術之用，您的個人資料絕不對外公開，敬請安心作答，感謝您的協助！</p>
				<p class="h4 pt-3 text-center text-danger">所有隊伍成員抽空完成問卷後，便可取得本次競賽參賽證明。</p>
				<p class="h3 pt-3 pl-5">敬祝 平安愉快</p>
				<p class="h3 text-right">台灣財富管理規劃顧問認證協會</p>
			</div>
		</div>
	</div>
</section>


<section class="py-5" id="selectRole">
	<div class="container">
		<div class="row pt-2 mx-auto">
			<div class="col-md-8 mx-auto text-center">
				<p class="py-2 h4">請選擇答卷者身份：</p>
				<div id="roleButton"></div>
			</div>
		</div>
	</div>
</section>


<section class="pt-5" id="surveySection">
	<div class="container" id="surveyMain">
	</div>
</section>



<?php require_once("../model/index_js.php") ?>
<script type="text/javascript" src="../controller/toggle_tooltip.js"></script>

<!-- 依隊伍成員數生成答題者按鈕數 -->
<script>

	$(document).ready(function(){
		<?
		$sqlSELECTteamMember = mysql_query( " 
SELECT name, remarks
FROM studentsInfo
LEFT JOIN $survey
ON studentsInfo.teamNO = $survey.teamNO
AND studentsInfo.remarks = $survey.role
WHERE $survey.role is null
AND studentsInfo.teamNO = '$teamNO'
		" );
		$sqlROWteamMember = mysql_num_rows($sqlSELECTteamMember);
		?>
		var max_buttons = <? echo $sqlROWteamMember; ?> // 取得隊伍成員總數
		var wrapper = $("#roleButton");
		var x = 1; // 起始button數量
		if (x <= max_buttons){
			x++;
			$(wrapper).append(`
				

			<?
			while( list($name, $remarks) = mysql_fetch_array($sqlSELECTteamMember) ){
			?>
			<button class="btn btn-info btn-lg mx-3" onclick="getMember('<? echo $remarks; ?>','<? echo $teamNO; ?>' )"> <? echo $remarks.'：'.$name; ?> </button>
			<?
			}
			?>


			`); // add input box
		}

	});
	
</script>


<script>
function getMember(remarks, teamNO){
	
	// 關閉按鈕區
	$("#selectRole").hide(500);
	
	<?
	$sqlQuerysurveyGroups = mysql_query( " SELECT groups FROM surveyList WHERE number = '$survey' " ); //連結surveyList
	$sqlFETCHsurveyGroups = mysql_fetch_row($sqlQuerysurveyGroups); // 取回Groups
	$groupsArray = explode(",", $sqlFETCHsurveyGroups[0]); // groups解字串入陣列
	$groupsCount = count($groupsArray); // 計算groups元素數量
	?>
	
	var groupsMax = <? echo $groupsCount; ?>; // groups最大數量
	var wrapper = $("#surveyMain"); // 框架載入區
	var groupsStart = 1;  // groups 起始數量
	
	if ( groupsStart < groupsMax ){
		groupsStart++;
		// 滾出主題組 - Groups
		$(wrapper).append(`
			<?
			foreach( $groupsArray as $surveyGroups ){
			?>

				<div class="row" class="backgroundGroups" id="surveyMainAppend">

					<? // 取出 Group, Sub, Quiz
					$sqlQuerygroupsInfo = mysql_query("SELECT topic,info FROM surveyGroup WHERE number = '$surveyGroups' ");  // 取得 groups Info Data
					while ($groupsData = mysql_fetch_assoc($sqlQuerygroupsInfo)){
					?>

					<div class="col-1"></div>
					<div class="align-self-center mt-3 mb-3 col-md-3 h3 text-center text-dark font-weight-bold"><? echo $groupsData['topic']; ?></div>
					<div class="mt-3 mb-3 col-md-7 h3 text-dark font-weight-bold"><? echo $groupsData['info']; ?></div>
					<div class="col-1"></div>

						<?
						$sqlQuerysubsInfo = mysql_query("SELECT number, topic FROM surveySub WHERE number LIKE '$surveyGroups%' ORDER BY id "); // 取得 sub Info Data
						while ($subsData = mysql_fetch_assoc($sqlQuerysubsInfo)){
							$subNumber = $subsData['number'];
						?>
						<div class="col-1"></div>
						<div class="col-md-10 h4 text-center bg-info text-white"><? echo $subsData['topic']; ?></div>
						<div class="col-1"></div>
						
							<?
							$sqlQueryquizInfo = mysql_query("SELECT number, topic, choices FROM surveyDB WHERE number LIKE '$subNumber%' ORDER BY id "); // 取得 quiz Info Data
							while ($quizData = mysql_fetch_assoc($sqlQueryquizInfo)){
							?>
							<div class="col-1"></div>
							<div class="col-md-10 h4 pl-3 bg-warning text-dark font-weight-bold"><? echo $quizData['topic']; ?> <span class="ml-2 h6 text-right">(題號：<? echo $quizData['number']; ?>)</span></div>
							<div class="col-1"></div>
								<?
									$quizChoices = $quizData['choices'];
									if ( $quizChoices != 'default7' ){
										$choicesArray = explode(",", $quizChoices);
										$choicesCount = count($choicesArray);
											for ( $i=0; $i<$choicesCount; $i++ ){
								?>
									<div class="col-1"></div>
									<div class="col-md-10 h4 pl-3 bg-light mx-auto" class="customize">
									<input type="radio" name="<? echo $quizData['number']; ?>" class="<? echo $quizData['number']; ?>" value="<? echo $i+1; ?>">
									<? echo $choicesArray[$i]; ?><br>
									</div>
									<div class="col-1"></div>
								<?
								}
								?>


								<?
									}else{
									$choicesCount = 7;
									$choicesArray = array("非常不同意", "", "", "", "", "", "非常同意");
								?>
									<div class="col-1"></div>
									<div class="py-3 col-md-10 h4 pl-3 bg-light mx-auto text-center" class="default7">
									非常不同意&emsp;<input type="range" name="name="<? echo $quizData['number']; ?>"" id="<? echo $quizData['number']; ?>" min="1" max="<? echo $choicesCount; ?>" step="1" value="1">&emsp;非常同意
									</div>
									<div class="col-1"></div>
								<?
								}
								?>

							<?
							}
							?>


						<?
						}
						?>

					<?
					}
					?>
			</div>
			<?
			}
			?>
			<div class="py-3 mx-auto text-center"><button class="btn btn-lg btn-success" onClick="submit('${remarks}','${teamNO}')">完成送出</button></div>
			`);
		}
};
	
</script>	

<script>
	function submit(remarks, teamNO){
		
//		// 取得隊編及身份
//		var remarks = $("#surveyMainAppend").data("remarks");
//		var teamNO = $("#surveyMainAppend").data("teamNO");
		
		// 取得所有radio的name
		var radioNameArray = $("input[type=radio]");
		var radioNameList = new Array();
		var radioValueList = new Array();
		var Invalid = false;
		
		// 取得所有range的id
		var rangeIdArray = $("input[type=range]");
		var rangeIdList = new Array();
		var rangeValueList = new Array();
		
			// 取得各radio的name
			radioNameArray.each(function(){
				var input = $(this);
				var input_Name = input.attr("name");
				if ( $.inArray(input_Name, radioNameList) == -1 ){

					radioNameList.push(input_Name);

					}
			});

			// 檢查未選取的radio	
			radioNameList.forEach(function(n){

				var Checkobj = $("input[name='" + n + "']:checked").val();
				if (Checkobj == undefined){
					Invalid = true;
				}else{
					radioValueList.push(Checkobj);  // radio Value值 Array
				}
			});
			
			// 未選取ALERT中斷
			if ( Invalid ){
				alert("尚有未作答!");
				return false;
			}

			// 取得各range的id
			rangeIdArray.each(function(){
				var input = $(this);
				var input_Id = input.attr("id");
					rangeIdList.push(input_Id); // range Id值 Array
					rangeValueList.push($(this).val());  // range Value 值 Array
			});
		
		var survey = '<? echo $survey; ?>';
		var quizList = radioNameList.concat(rangeIdList);  // 全問題列表
		var quizListLength = quizList.length;  // 全問題數
		var quizFeedBack = radioValueList.concat(rangeValueList); // 全回答
		
		// Ajax 資料存入資料庫
		$.ajax({
			url:"https://wmpcca.com/bswmp/form/model/admin_survey_submitFeedBack.php",
			method:"POST",
			data:{
				survey : survey,
				remarks : remarks,
				teamNO : teamNO,
				quizListLength : quizListLength,
				quizList : quizList,
				quizFeedBack : quizFeedBack
			},
			success:function(res){
				window.location.href='https://wmpcca.com/bswmp/form/view/compet_mainpage.php';
			}
		})

	}
</script>
	
</body>
</html>