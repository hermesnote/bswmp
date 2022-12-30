<?php
require_once ("../vender/dbtools.inc.php");

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

$data1 = mysql_query("select * from histock_HTscore ORDER BY id DESC");//從competCollege中選取全部(*)的資料

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

<style>
	
	.select100 {
		width: 100%;
	}
	
	.hidden{
		display: none;
	}
	
	.mt-1{
		margin-top: 10px;
	}
	
	.mt-2{
		margin-top: 20px;
	}
	
	.mt-3{
		margin-top: 30px;
	}
	
	.ml-1{
		margin-left: 10px;
	}
	
	.ml-2{
		margin-left: 20px;
	}
	
	.ml-3{
		margin-left: 30px;
	}
	
	.mr-1{
		margin-right: 10px;
	}
	
	.mr-2{
		margin-right: 30px;
	}
	
	.mr-3{
		margin-right: 30px;
	}
	
	.pt-1{
		padding-top: 10px;
	}
	
	.pt-2{
		padding-top: 20px;
	}
	
	.pt-3{
		padding-top: 30px;
	}
	
	.pb-1{
		padding-bottom: 10px;
	}
	
	.pb-2{
		padding-bottom: 20px;
	}
	
	.pb-2{
		padding-bottom: 20px;
	}
	
	.br-1{
		border-right:1px #E0E0E0 solid;
	}
	
	.bl-1{
		border-left:1px #E0E0E0 solid;
	}
	
</style>

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
				<li>競賽資訊/評審專區</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">評審專區</h1>
			</div>
		</div><!--/.row-->
				
		
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading text-center">
						<div class="">
							<form name="rankForm" method="post" id="rankForm" action="" target="_blank">
								<select name="rankProject" id="rankProject">
									<option>請選擇要進行排名的項目</option>
										<?php
											$str = "SELECT projectNO, projectName FROM histock_eventList WHERE projectNO LIKE 'HT%' ORDER BY id DESC LIMIT 5 ";
											$list = mysql_query($str,$sqlLink);
											while(list($projectNO,$projectName) = mysql_fetch_row($list))
											{
											echo "<option value=".$projectNO.">".$projectNO."：".$projectName."</option>\n";
											}
										?> 
								</select>

								<select name="rankBach" id="rankBach">
									<option>請選擇要進行排名的梯次</option>
									<option value="bach1">bach1</option>
									<option value="bach2">bach2</option>
									<option value="bach3">bach3</option>
								</select>

								<button class="btn btn-warning" onClick="rankHT()">選拔成績(另開視窗)</button>
								<button class="btn btn-success" onClick="downloadScore()">下載名冊(CVS)</button>
							</form>
<!--
							<form align="center" name="export" action="../model/admin_exportHistockScoreHT.php" method="post">
								<button type="submit" name="exportButton" class="btn btn-info">下載資料(CSV)</button>
							</form>
-->
						</div>
					</div>
					
					<h3 class="text-center">金融證券投資實務輔導員選拔</h3>
					
					<div class="panel-body">
						<table id="competForm" class="table table-hover table-striped table-bordered text-center" style="100%">
							<thead class="thead-dark bg-info">
								<tr>
									<th>活動代號</th>
									<th>活動編號</th>
									<th>測驗梯次</th>
									<th>試卷編號</th>
									<th>線上測驗</th>
									<th>實務競賽</th>
									<th>選拔成績</th>
									<th>名次排位</th>
									<th>操作</th>
								</tr>
							</thead>
							<tbody>	
								
							<?php
							for ($i=1; $i<=mysql_num_rows($data1); $i++) {
								$row=mysql_fetch_row($data1);
							?>

								<tr>
									<td><?php echo $row[1];?></td>
									<td><?php echo $row[2];?></td>
									<td><?php echo $row[3];?></td>
									<td><?php echo $row[4];?></td>
									<td><?php echo $row[5];?></td>
									<td><?php echo $row[6];?></td>
									<td><?php echo $row[7];?></td>
									<td><?php echo $row[8];?></td>
									<td><button id="competScoreButton" onClick="submitScore('<? echo $row[2];?>', '<? echo $row[6];?>')">登錄成績</button></td>
								</tr>

							<?php }?>
							</tbody>
						</table>
						
					</div>
				
				</div>
			</div>
		</div><!--/.row-->
	
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
	<script src="../controller/datepicker.js"></script>
<!--	<script src="../controller/Division.js"></script>-->
	<script src="../controller/admin_teacherListAdd.js"></script>
	<script src="../controller/admin_teacherDataDelete.js"></script>
	<script src="../controller/admin_referSelect.js"></script>
	<script src="../controller/admin_competHSsignup.js"></script>
	<script src="../controller/admin_competHSsignup2.js"></script>
	<script src="../controller/admin_competScore1.js"></script>
	<script src="../controller/admin_competScore2.js"></script>
	<script src="../controller/admin_competFirstReport.js"></script>
	<script src="../controller/admin_competSecondReport.js"></script>
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
		$("#competForm,#referForm").dataTable({
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
	
<!-- 登錄競賽成績 -->
<script>
	//按鈕取號
	function submitScore(examNumber, competScore){
		if (competScore != ''){
			alert("競賽成績不可重覆登錄！");
			window.location.reload();
		}else{
			var addCompetScore = prompt("請輸入"+examNumber+"的競賽成績");
			if (addCompetScore != null) {
				var score = addCompetScore;
				var examNumber = examNumber;

				// Ajax傳成績
				$.ajax({

					url:"https://wmpcca.com/bswmp/form/model/admin_histock_addCompetScore.php",
					data:{
						"examNumber" : examNumber,
						"score" : score
					},

					method : "POST",

					error : function(Msg){
						alert(Msg);
					},

					success : function(Msg){
						if ( Msg != "競賽成績登錄完成" ){
							alert(Msg);
						}else{
							alert(examNumber+'的'+Msg);
							window.location.reload();
							}
						}
					});

			}
		}
	}
	
</script>


<!-- 排名 -->
<script>
function rankHT(){
	$("#rankForm").attr("action", "https://wmpcca.com/bswmp/form/view/histock_HTrank.php");
	rankForm.submit();
}
function downloadScore(){
	$("#rankForm").attr("action", "https://wmpcca.com/bswmp/form/model/admin_exportRank.php");
	rankForm.submit();
}
</script>

</script>
	
</body>



</html>

