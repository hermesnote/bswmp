<?php
require_once ("../vender/dbtools.inc.php");

//取得現在時間
$getToday = date("Y-m-d H:i:s");
//轉換現在時間
$getTime = strtotime($getToday);

$passed = $_COOKIE["passed"];
$account = $_COOKIE["account"];
$staffNO = $_COOKIE["staffNO"];
$staffName = $_COOKIE["staffName"];
$postType = $_COOKIE["postType"];

// 若cookie中的變數passed不為TRUE，則導回登入頁
if ($passed != "TRUE"){
echo "<script type='text/javascript'>";
echo "alert('COOKIE錯誤!請重新登入！')";
echo "</script>";
header("location:admin_login.php");
exit();
}

$data1 = mysql_query("select * from surveyList ORDER BY id DESC ");//從surveyList中選取全部(*)的資料
$data2 = mysql_query("select * from surveyGroup ORDER BY id DESC ");//從surveyGroup中選取全部(*)的資料
$data3 = mysql_query("select * from surveySub ORDER BY id DESC ");//從中surveySub選取全部(*)的資料
$data4 = mysql_query("select * from surveyDB ORDER BY id DESC ");//從中surveyDB選取全部(*)的資料

?>

<!DOCTYPE html>

<html>

<head>

<meta charset="utf-8">

<meta name="viewport" content="width=device-width, initial-scale=1">

<title>WMPCCA - 後台管理系統</title>



<link href="../lumino/css/bootstrap.min.css" rel="stylesheet">
<!--<link href="../lumino/css/datepicker3.css" rel="stylesheet">-->
<!--<link href="../lumino/css/bootstrap-table.css" rel="stylesheet">-->
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.0/themes/smoothness/jquery-ui.css">

<link href="../lumino/css/styles.css" rel="stylesheet">


<!--[if lt IE 9]>

<script src="js/html5shiv.js"></script>

<script src="js/respond.min.js"></script>

<![endif]-->



</head>



<body>
	
	<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="admin_index2.php"><span>WMPCCA</span>後台管理系統</a>
				<ul class="user-menu">
					<li class="dropdown pull-right">
						<a href="" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span> <?php echo $staffName ?> <span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
							<li><a href=""><span class="glyphicon glyphicon-user"></span> 個人資料</a></li>
							<li><a href=""><span class="glyphicon glyphicon-cog"></span> 設定</a></li>
							<li><a href="../model/admin_logout.php"><span class="glyphicon glyphicon-log-out"></span> 登出</a></li>
						</ul>
					</li>
				</ul>
			</div>
							
		</div><!-- /.container-fluid -->
	</nav>

<!-- Admin Left Side Bar -->
<?php require_once("../model/admin_leftSideBar.php") ?>	
<!--/.sidebar-->
		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#"><span class="glyphicon glyphicon-home"></span></a></li>
				<li>表單系統/問卷系統</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">問卷系統</h1>
			</div>
		</div><!--/.row-->
		

		
<!-- 問卷列表 / 新增問卷 -->
		<div class="row">
			
			<div class="col-md-12" id="submitArea">
				<div class="panel panel-default">
					
					<div class="panel-heading text-center" style="color:darkred;font-weight: bold;font-size: 22px;font-family: Microsoft JhengHei;">
						<span id="">問卷設定</span>
					</div>
			
					<div class="panel-body">
						
							<div class="row">
								
<!-- 新增問卷 -->								
								<div class="col-md-3" style="border-right:1px #E0E0E0 solid;">
									<div class="panel-heading text-center">
										建立問卷 (surveyList)
									</div>
									<div class="panel-body">
										<div id="selectSurveyGroup" style="margin-top: 10px;" class="survey_select_wrap">
											<button class="add_survey_button btn btn-success">新增問卷題組</button>
											<br>
											題組1：
											<select class="groupSelect" name="mySurvey[]" id="surveyGroup1" style="margin-top: 10px;">
												<option>選擇題組</option>

													<?
													$surveyGroup = mysql_query("SELECT number, topic FROM surveyGroup"); //取得schoolList
													while ($surveyGroupList = mysql_fetch_assoc($surveyGroup)){
													?>
													<option value="<? echo $surveyGroupList['number']; ?>"><? echo $surveyGroupList['number']; ?> / <? echo $surveyGroupList['topic']; ?></option>
													<?
													}
													?>

											</select>
										</div>
										<div class="text-center" style="margin-top: 188px">
											<button class="btn btn-lg btn-info" onClick="initSurvey()">確認建立問卷</button>
										</div>
									</div>
								</div>
								
<!-- 新增主題組 -->								
								<div class="col-md-3" style="border-right:1px #E0E0E0 solid;border-lrft:1px #E0E0E0 solid;">
									<div class="panel-heading text-center">
										建立主題組 (surveyGroup)
									</div>
									<div class="panel-body">
										<div>
											<select id="selectDistrict">
												<option value="">選擇學校所在分區</option>
												
												<?
												$schoolDistrict = mysql_query("SELECT DISTINCT schoolDistrict FROM schoolList"); //取得schoolList
												while ($districtData = mysql_fetch_assoc($schoolDistrict)){
												?>
												<option value="<? echo $districtData['schoolDistrict']; ?>"><? echo $districtData['schoolDistrict']; ?></option>
												<?
												}
												?>
												
											</select>
										</div>
										<div style="margin-top: 10px">
											<select id="selectSchool">
												<option value="">選擇出題學校</option>
											</select>
										</div>
										<div style="margin-top: 10px">
											<select id="selectTeacher">
												<option value="">選擇出題教師</option>
											</select>
										</div>
										<div style="margin-top: 10px">
											題組標題：<input type="text" size="30" id="inputGroupTopic">
										</div>
										<div style="margin-top: 10px">
											<textarea id="inputGroupInfo" style="width: 100%; height:100px;vertical-align: top;" placeholder="主題組說明資訊"></textarea>
										</div>
										<div class="text-center" style="margin-top: 30px">
											<button class="btn btn-lg btn-info" onClick="initGroup()">建立主題組</button>
										</div>
									</div>
								</div>

<!-- 新增副題組 -->
								<div class="col-md-3">
									<div class="panel-heading text-center">
										建立副題組 (surveySub)
									</div>
									<div class="panel-body">
										<div >
											<select id="selectGroup">
												<option value="">選擇所屬主題組</option>
												
												<?
												$surveyGroup = mysql_query("SELECT number, topic FROM surveyGroup"); //取得schoolList
												while ($surveyGroupData = mysql_fetch_assoc($surveyGroup)){
												?>
												<option value="<? echo $surveyGroupData['number']; ?>"><? echo $surveyGroupData['number']; ?> / <? echo $surveyGroupData['topic']; ?></option>
												<?
												}
												?>
												
											</select>
										</div>
										<div style="margin-top: 10px">
										</div>
										<div style="margin-top: 10px">
											副題組標題：<input type="text" size="30" id="inputSubTopic">
										</div>
										<div class="text-center" style="margin-top: 208px">
											<button class="btn btn-lg btn-info" onClick="initSub()">建立副題組</button>
										</div>
									</div>
								</div>
								
<!-- 新增問題 -->
								<div class="col-md-3" style="border-left:1px #E0E0E0 solid;border-right:1px #E0E0E0 solid;">
									<div class="panel-heading text-center">
										新增問題 (surveyDB)
									</div>
									<div class="panel-body">
										<div >回答方式：
											<select id="selectAnswerWay">
												<option value="0">7量度(預設)</option>
												<option value="1">自定義</option>
											</select>
										</div>
										<div id="defineAnswer" style="margin-top: 10px" class="hide input_fields_wrap">
												<button class="add_field_button btn btn-success">新增回答選項</button>
												<input type="text" class="quizInput" name="mytext[]" id="defineAnswer1" size="30" style="margin-top: 10px;" placeholder="選項1-限中英文數字禁用符號">
										</div>
										<div style="margin-top: 10px">
											所屬副題組：
											<select id="selectSub">
												<option value="">選擇副題組</option>
												
													<?
													$surveySub = mysql_query("SELECT number, topic FROM surveySub"); //取得schoolList
													while ($surveySubList = mysql_fetch_assoc($surveySub)){
													?>
													<option value="<? echo $surveySubList['number']; ?>"><? echo $surveySubList['number']; ?> / <? echo $surveySubList['topic']; ?></option>
													<?
													}
													?>
												
											</select>
										</div>
										<div style="margin-top: 10px">
											<textarea id="inputQuizArea" style="width: 100%; height:100px;vertical-align: top;" placeholder="填入問題"></textarea>
										</div>
										<div class="text-center" style="margin-top: 100px">
											<button class="btn btn-lg btn-info" onClick="initQuestion()">確認新增題目</button>
										</div>
									</div>
								</div>

							</div>

						
					</div>
					
				</div>
			</div>
		</div>


		<div class="row authority0">
			
<!-- 問卷列表 -->			
			<div class="col-md-6">
				<div class="panel panel-default">
					
					<div class="panel-heading text-center" style="color:darkred;font-weight: bold;font-size: 22px;font-family: Microsoft JhengHei;">
						<span id="">問卷列表(surveyList)</span>
					</div>
			
					<div class="panel-body">
						
						<table id="surveyForm" class="table table-hover table-striped table-bordered text-center">
							<thead class="thead-dark bg-info">
								<tr>
									<th class="text-center">ID</th>
									<th class="text-center">卷號</th>
									<th class="text-center">題組</th>
									<th class="text-center">操作</th>
									<th class="text-center">下載</th>
								</tr>
							</thead>
							<tbody>	

							<?php
							for ($i=1; $i<=mysql_num_rows($data1); $i++) {
								$row=mysql_fetch_row($data1);

							?>

								<tr>
									<td><?php echo $row[0];?></td>
									<td><?php echo $row[2];?></td>
									<td><?php echo $row[3];?></td>
									<td >
										<button onclick="window.open('https://wmpcca.com/bswmp/form/view/admin_survey_review.php?survey=<? echo $row[2]; ?>&teamNO=<? echo $staffNO; ?>')">預覽</button><br>
										<button onclick="deleteSurvey('<? echo $row[2]; ?>')">刪除</button> 
<!--										<button onclick="surveyResult('<? echo $row[2]; ?>')">測試</button>-->
									</td>
									<td>
										<form action="../model/admin_exportSurveyResult.php" method="post">
											<input type="text" name="result" value="<? echo $row[2]; ?>" hidden>
											<button type="submit">結果</button>
										</form>
										<form action="../model/admin_exportSurveyQuiz.php" method="post">
											<input type="text" name="quizQ" value="<? echo $row[2].'Q'; ?>" hidden>
											<button type="submit">題庫</button>
										</form>
									</td>
								</tr>

							<?php }?>
							</tbody>
						</table>
					
					</div>
					
				</div>
			</div>
			
<!-- 主題組列表 -->			
			<div class="col-md-6">
				<div class="panel panel-default">
					
					<div class="panel-heading text-center" style="color:darkred;font-weight: bold;font-size: 22px;font-family: Microsoft JhengHei;">
						<span id="">主題組列表(surveyGroup)</span>
					</div>
			
					<div class="panel-body">
						<table id="groupForm" class="table table-hover table-striped table-bordered text-center">
							<thead class="thead-dark bg-info">
								<tr>
									<th class="text-center">ID</th>
									<th class="text-center">組號</th>
									<th class="text-center">標題</th>
									<th class="text-center">說明</th>
									<th class="text-center">操作</th>
								</tr>
							</thead>
							<tbody>	

							<?php
							for ($i=1; $i<=mysql_num_rows($data2); $i++) {
								$row=mysql_fetch_row($data2);

							?>

								<tr>
									<td><?php echo $row[0];?></td>
									<td><?php echo $row[2];?></td>
									<td><?php echo $row[3];?></td>
									<td><?php echo $row[4];?></td>
									<td onclick="deleteGroup('<? echo $row[2]; ?>')"><button>刪除</button></td>
								</tr>

							<?php }?>
							</tbody>
						</table>
					</div>
					
				</div>
			</div>
			
		</div>			
		
		<div class="row authority0">
			
<!-- 副題組列表 -->			
			<div class="col-md-6">
				<div class="panel panel-default">
					
					<div class="panel-heading text-center" style="color:darkred;font-weight: bold;font-size: 22px;font-family: Microsoft JhengHei;">
						<span id="">副題組列表(surveySub)</span>
					</div>
			
					<div class="panel-body">
						
						<table id="subForm" class="table table-hover table-striped table-bordered text-center">
							<thead class="thead-dark bg-info">
								<tr>
									<th class="text-center">ID</th>
									<th class="text-center">組序</th>
									<th class="text-center">標題</th>
									<th class="text-center">操作</th>
								</tr>
							</thead>
							<tbody>	

							<?php
							for ($i=1; $i<=mysql_num_rows($data3); $i++) {
								$row=mysql_fetch_row($data3);

							?>

								<tr>
									<td><?php echo $row[0];?></td>
									<td><?php echo $row[2];?></td>
									<td><?php echo $row[3];?></td>
									<td onclick="deleteSub('<? echo $row[2]; ?>')"><button>刪除</button></td>
								</tr>

							<?php }?>
							</tbody>
						</table>
					
					</div>
					
				</div>
			</div>
			
<!-- 問題列表 -->			
			<div class="col-md-6">
				<div class="panel panel-default">
					
					<div class="panel-heading text-center" style="color:darkred;font-weight: bold;font-size: 22px;font-family: Microsoft JhengHei;">
						<span id="">問題列表(surveDB)</span>
					</div>
			
					<div class="panel-body">
						
						<table id="questionForm" class="table table-hover table-striped table-bordered text-center">
							<thead class="thead-dark bg-info">
								<tr>
									<th class="text-center">ID</th>
									<th class="text-center">題號</th>
									<th class="text-center">題目</th>
									<th class="text-center">選項</th>
									<th class="text-center">操作</th>
								</tr>
							</thead>
							<tbody>	

							<?php
							for ($i=1; $i<=mysql_num_rows($data4); $i++) {
								$row=mysql_fetch_row($data4);

							?>

								<tr>
									<td><?php echo $row[0];?></td>
									<td><?php echo $row[2];?></td>
									<td><?php echo $row[3];?></td>
									<td><?php 
										if ( $row[4] == 'default7'){
											$row[4] = '7量度';
										}
											echo $row[4];
										?>
									</td>
									<td onclick="deleteQuiz('<? echo $row[2]; ?>')"><button>刪除</button></td>
								</tr>

							<?php }?>
							</tbody>
						</table>
					
					</div>
					
				</div>
			</div>
			
		</div>
	
	</div>	
		
		
		
</div>
<!--/.main-->

	

	
	

	<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
	<script src="../lumino/js/bootstrap.min.js"></script>
	<script src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js" integrity="sha256-eGE6blurk5sHj+rmkfsGYeKyZx3M4bG+ZlFyA7Kns7E=" crossorigin="anonymous"></script>
	<script src="../lumino/js/chart.min.js"></script>
	<script src="../lumino/js/chart-data.js"></script>
	<script src="../lumino/js/easypiechart.js"></script>
	<script src="../lumino/js/easypiechart-data.js"></script>
<!--	<script src="../lumino/js/bootstrap-datepicker.js"></script>-->
<!--	<script src="../lumino/js/bootstrap-table.js"></script>-->
<!-- DataTables v1.10.16 -->
	<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>

<!-- 自定義JS -->
	<!-- 權限 -->
	<script src="../controller/admin_authority.js"></script>

	<script>
		!function ($) {
			$(document).on("click","ul.nav li.parent > a > span.icon", function(){		  
				$(this).find('em:first').toggleClass("glyphicon-minus");	  
			}); 
			$(".sidebar span.icon").find('em:first').addClass("glyphicon-plus");
			}(window.jQuery);

		$(window).on('resize', function () {
		  if ($(window).width() > 768) $('#sidebar-collapse').collapse('show')
		})
		$(window).on('resize', function () {
		  if ($(window).width() <= 767) $('#sidebar-collapse').collapse('hide')
		})
		
	</script>
	
	<script>

		$("#surveyForm").dataTable({
			"order": [[ 0, "desc" ]],
			"oLanguage": {
				"sInfoFiltered": " ,從 _MAX_ 筆資料中查得",
				"sLengthMenu": "每次顯示 _MENU_ 筆資料",
				"sInfo":"第 _START_ 至 _END_ 筆資料, 共 _TOTAL_ 筆",
				"sSearch": "搜尋：",
				"oPaginate": {
					"sNext": "下一頁",
					"sPrevious": "上一頁"
				}
			}
		});
		
		$("#groupForm").dataTable({
			"order": [[ 0, "desc" ]],
			"oLanguage": {
				"sInfoFiltered": " ,從 _MAX_ 筆資料中查得",
				"sLengthMenu": "每次顯示 _MENU_ 筆資料",
				"sInfo":"第 _START_ 至 _END_ 筆資料, 共 _TOTAL_ 筆",
				"sSearch": "搜尋：",
				"oPaginate": {
					"sNext": "下一頁",
					"sPrevious": "上一頁"
				}
			}
		});
	
		$("#subForm").dataTable({
			"order": [[ 0, "desc" ]],
			"oLanguage": {
				"sInfoFiltered": " ,從 _MAX_ 筆資料中查得",
				"sLengthMenu": "每次顯示 _MENU_ 筆資料",
				"sInfo":"第 _START_ 至 _END_ 筆資料, 共 _TOTAL_ 筆",
				"sSearch": "搜尋：",
				"oPaginate": {
					"sNext": "下一頁",
					"sPrevious": "上一頁"
				}
			}
		});

		$("#questionForm").dataTable({
			"order": [[ 0, "desc" ]],
			"oLanguage": {
				"sInfoFiltered": " ,從 _MAX_ 筆資料中查得",
				"sLengthMenu": "每次顯示 _MENU_ 筆資料",
				"sInfo":"第 _START_ 至 _END_ 筆資料, 共 _TOTAL_ 筆",
				"sSearch": "搜尋：",
				"oPaginate": {
					"sNext": "下一頁",
					"sPrevious": "上一頁"
				}
			}
		});
		
		$(function () {
			$('[data-toggle="tooltip"]').tooltip()
		})
		
	</script>


<script>
	
// 題組階層選單 選擇分區→選擇學校
	$('#selectDistrict').change(function(){
		var district = $('#selectDistrict').val();
			$.ajax({
				url:"https://wmpcca.com/bswmp/form/model/admin_survey_getSchool.php",
				method:"POST",
				data:{
					district:district
				},
				success:function(res){
					$('#selectSchool').html(res);
				}
			}) // end Ajax
	});
	
// 題組階層選單 選擇分區→選擇出題老師
	$('#selectSchool').change(function(){
		var school = $('#selectSchool').val();
		$.ajax({
			url:"https://wmpcca.com/bswmp/form/model/admin_survey_getTeacher.php",
			method:"POST",
			data:{
				school:school
			},
			success:function(res){
				$('#selectTeacher').html(res);
			}
		}) // end Ajax
	});
	
// 問題階層選單 選擇回答方式→顯示對應回答選項
	$('#selectAnswerWay').change(function(){
		var answerWay = $('#selectAnswerWay').val();
		if (answerWay == '0'){ //預設7量度
			$("#defineAnswer").addClass("hide");
		}else{  // 展開自定義
			$("#defineAnswer").removeClass("hide");
		};
	});

// 	問題階層選單 選擇回答方式→自定義選項
	$(document).ready(function(){
		var max_fields = 10; // 最多可增加10個選項
		var wrapper = $(".input_fields_wrap"); // fields wrapper
		var add_button = $(".add_field_button"); //新增field按鈕
		var x = 1; //初始input數量
		$(add_button).click(function(e){  // on add input click
			e.preventDefault();
			if (x < max_fields){
				$(`#deleteButton${x}`).addClass("hide");
				x++;
				$(wrapper).append(`
									<div>
										<input type="text" class="quizInput" name="mytext[]" id="defineAnswer${x}" size="30" style="margin-top: 10px;" placeholder="選項${x}-限中英文數字禁用符號"/>
										<button class="remove_field" id="deleteButton${x}" style="margin-left:10px;">刪除</button>
									</div>
								`); // add input box
			}else{
				alert("已達上限!");
			}
		});
		
		$(wrapper).on("click", ".remove_field", function(e){ //user click on remove text
			$(`#deleteButton${x-1}`).removeClass("hide");
			e.preventDefault();
			$(this).parent('div').remove();
			x--;
		})
		
	});
		
</script>
	
<script>
	
// 	新增問卷選單 選擇加入題組
	$(document).ready(function(){
		var max_fields = 10; // 最多可增加10個題組
		var wrapper = $(".survey_select_wrap"); // fields wrapper
		var add_button = $(".add_survey_button"); //新增field按鈕
		var x = 1; //初始input數量
		$(add_button).click(function(e){  // on add input click
			e.preventDefault();
			if (x < max_fields){
				$(`#deleteSurveyGroupButton${x}`).addClass("hide");
				x++;
				$(wrapper).append(`
									<div>題組${x}：
										<select class="groupSelect" name="mySurvey[]" id="surveyGroup${x}" style="margin-top: 10px;">
											<option>選擇題組</option>

												<?
												$surveyGroup = mysql_query("SELECT number FROM surveyGroup"); //取得schoolList
												while ($surveyGroupList = mysql_fetch_assoc($surveyGroup)){
												?>
												<option value="<? echo $surveyGroupList['number']; ?>"><? echo $surveyGroupList['number']; ?></option>
												<?
												}
												?>

										</select>
										<button class="remove_survey_field" id="deleteSurveyGroupButton${x}" style="margin-left:10px;">刪除</button>
									</div>
				`); // add input box
			}else{
				alert("已達上限!");
			}
		});
		
		$(wrapper).on("click", ".remove_survey_field", function(e){ //user click on remove text
			$(`#deleteSurveyGroupButton${x-1}`).removeClass("hide");
			e.preventDefault();
			$(this).parent('div').remove();
			x--;
		})
		
	});
	
</script>

<script>
	
// 建立主題組、副題組、題目、問卷
	
	// 主題組
	function initGroup(){
		var groupDistrict = $("#selectDistrict").val();
		var groupSchool = $("#selectSchool").val();
		var groupTeacher = $("#selectTeacher").val();
		var groupTopic = $("#inputGroupTopic").val();
		var groupInfo = $("#inputGroupInfo").val();
		// Ajax 資料存入資料庫
		$.ajax({
			url:"https://wmpcca.com/bswmp/form/model/admin_survey_initGroup.php",
			method:"POST",
			data:{
				groupDistrict : groupDistrict,
				groupSchool : groupSchool,
				groupTeacher : groupTeacher,
				groupTopic : groupTopic,
				groupInfo : groupInfo
			},
			success:function(res){
				alert(res);
				window.location.reload();
			}
		})
	};
	
	// 副題組
	function initSub(){
		var subGroup = $("#selectGroup").val();
		var subTopic = $("#inputSubTopic").val();
		// Ajax 資料存入資料庫
		$.ajax({
			url:"https://wmpcca.com/bswmp/form/model/admin_survey_initSub.php",
			method:"POST",
			data:{
				subGroup : subGroup,
				subTopic : subTopic
			},
			success:function(res){
				alert(res);
				window.location.reload();
			}
		})
	};
	
	// 題目及選項
	function initQuestion(){
		var quizWay = $("#selectAnswerWay").val();
		var quizSub = $("#selectSub").val();
		var quizArea = $("#inputQuizArea").val();
		
		if ( quizWay === '1'){
			var i = 1;
			var quizArr = new Array();
			if ( $(".quizInput").length <=10 ){ // 檢查input值, 若有值進陣列
				$(".quizInput").each(function(){
					if ( $(this).val() != "" )
					quizArr.push( $(this).val() );
				});
			}
			// Ajax 存入資料庫 -- 自定義選項
			$.ajax({
				url:"https://wmpcca.com/bswmp/form/model/admin_survey_initQuestions.php",
				method:"POST",
				data:{
					quizType : '1',
					quizSub : quizSub,
					quizArea : quizArea,
					quizArr : quizArr
				},
				success:function(res){
					alert(res);
					window.location.reload();
				}
			})
		}else{  // Ajax 7量度存入資料庫
			$.ajax({
				url:"https://wmpcca.com/bswmp/form/model/admin_survey_initQuestions.php",
				method:"POST",
				data:{
					quizType : '0',
					quizSub : quizSub,
					quizArea : quizArea
				},
				success:function(res){
					alert(res);
					window.location.reload();
				}
			})
		}
	};
	
	// 問卷
	function initSurvey(){
		var i = 1;
		var surveyArr = new Array();
		if ( $(".groupSelect").length <=10 ){ // 檢查input值, 若有值進陣列
			$(".groupSelect").each(function(){
				if ( $(this).val() != "" )
				surveyArr.push( $(this).val() );
			});
		}
		// Ajax 資料存入資料庫
		$.ajax({
			url:"https://wmpcca.com/bswmp/form/model/admin_survey_initSurvey.php",
			method:"POST",
			data:{
				surveyArr : surveyArr
			},
			success:function(res){
				alert(res);
//				window.location.reload();
			}
		})
	};
	
</script>

	
<script>
	// 預覽問卷
//	function surveyReview(event){
//		var getSurvey = event;
//		console.log(getSurvey);
//		// Ajax 
//		$.ajax({
//			url:"https://wmpcca.com/bswmp/form/model/admin_survey_surveyReview.php",
//			method:"POST",
//			data:{
//				getSurvey : getSurvey
//			},
//			success:function(res){
//				
//			}
//		})
//	}
	
	function deleteSurvey(event){
		var getNumber = event;
		console.log(getNumber);
		// Ajax 資料存入資料庫
		$.ajax({
			url:"https://wmpcca.com/bswmp/form/model/admin_survey_deleteButton.php",
			method:"POST",
			data:{
				getNumber : getNumber
			},
			success:function(res){
				alert(res);
				window.location.reload();
			}
		})
	}
	
	function deleteGroup(event){
		var getNumber = event;
		console.log(getNumber);
		// Ajax 資料存入資料庫
		$.ajax({
			url:"https://wmpcca.com/bswmp/form/model/admin_survey_deleteButton.php",
			method:"POST",
			data:{
				getNumber : getNumber
			},
			success:function(res){
				alert(res);
				window.location.reload();
			}
		})
	}
	
	function deleteSub(event){
		var getNumber = event;
		console.log(getNumber);
		// Ajax 資料存入資料庫
		$.ajax({
			url:"https://wmpcca.com/bswmp/form/model/admin_survey_deleteButton.php",
			method:"POST",
			data:{
				getNumber : getNumber
			},
			success:function(res){
				alert(res);
				window.location.reload();
			}
		})
	}
	
	function deleteQuiz(event){
		var getNumber = event;
		console.log(getNumber);
		// Ajax 資料存入資料庫
		$.ajax({
			url:"https://wmpcca.com/bswmp/form/model/admin_survey_deleteButton.php",
			method:"POST",
			data:{
				getNumber : getNumber
			},
			success:function(res){
				alert(res);
				window.location.reload();
			}
		})
	}
	
	function surveyResult(event){
		var getNumber = event;
		console.log(getNumber);
		$.ajax({
			url:"https://wmpcca.com/bswmp/form/model/admin_exportSurveyResult.php",
			method:"POST",
			data:{
				getNumber : getNumber
			},
			success:function(res){
				alert(res);
			}
		})
	}
	
</script>	
	
</body>



</html>

