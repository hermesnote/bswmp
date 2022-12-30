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

$data1 = mysql_query("select * from competScore");//從competCollege中選取全部(*)的資料
$data2 = mysql_query("select * from competRefer");//從competCollege中選取全部(*)的資料

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
					<div class="panel-heading">
<!--
						<form align="center" name="export" action="../model/admin_exportReceiptList.php" method="post">
						<button type="submit" name="exportButton" class="btn btn-info">下載資料(CSV)</button>
						</form>
-->
					</div>
	
					<div class="panel-body">
						<table id="competForm" class="table table-hover table-striped table-bordered text-center" style="100%">
							<thead class="thead-dark bg-info">
								<tr>
									<th>ID</th>
									<th>資料時間</th>
									<th>項目代碼</th>
									<th>隊伍編號</th>
									<th>初賽報告/報到</th>
									<th>初賽成績</th>
									<th>決賽報告/報到</th>
									<th>決賽成績</th>
								</tr>
							</thead>
							<tbody>	
								
							<?php
							for ($i=1; $i<=mysql_num_rows($data1); $i++) {
								$row=mysql_fetch_row($data1);
							?>

								<tr>
									<td><?php echo $row[0];?></td>
									<td><?php echo $row[1];?></td>
									<td><?php echo $row[2];?></td>
									<td onclick="teamNOSelect(this)"><?php echo $row[3];?></td>
									<td><?php echo $row[4];?></td>
									<td><?php echo $row[5];?></td>
									<td><?php echo $row[6];?></td>
									<td><?php echo $row[7];?></td>
								</tr>

							<?php }?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div><!--/.row-->

		
<!--
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-default">
					
					<div class="panel-heading text-center" style="color:dodgerblue;font-weight: bold;font-size: 22px;font-family: Microsoft JhengHei;" id="referA">
						<span id="returnMsg">評 審 選 定</span>
					</div>
					
					<div class="panel-body">

					</div>
				</div>
			</div>			
		</div>
-->
		
		
		
		<div class="row authority0" style="display: none;">

			<div class="col-md-6" id="referAArea">
				<div class="panel panel-default">
					
					<div class="panel-heading text-center" style="color:darkred;font-weight: bold;font-size: 22px;font-family: Microsoft JhengHei;" id="">
						<span id="">初賽報到(限HS組)</span>
					</div>
			
					<div class="panel-body">
						
						<div class="text-center">
							<form class="text-center">
								<input type="text" placeholder="點擊或輸入隊伍編號" class="" style="text-align: center;" id="teamNOGet3">
								<select class="" id="HSsignup1" name="HSsignup">
									<option value="1">完成</option>
									<option value="0">取消</option>
								</select>
								<button type="button" class="btn btn-success" onClick="signup1()">送出</button>
							</form>
								操作結果：<span style="text-align: center;" id="signupMsg"></span>
						</div>
						
					</div>
					
				</div>
			</div>
		
			<div class="col-md-6" id="referAArea">
				<div class="panel panel-default">
					
					<div class="panel-heading text-center" style="color:darkred;font-weight: bold;font-size: 22px;font-family: Microsoft JhengHei;" id="">
						<span id="">決賽報到(限HS組)</span>
					</div>
			
					<div class="panel-body">
						
						<div class="text-center">
							<form class="text-center">
								<input type="text" placeholder="點擊或輸入隊伍編號" class="" style="text-align: center;" id="teamNOGet4">
								<select class="" id="HSsignup2" name="HSsignup2">
									<option value="1">完成</option>
									<option value="0">取消</option>
								</select>
								<button type="button" class="btn btn-success" onClick="signup2()">送出</button>
							</form>
								操作結果：<span style="text-align: center;" id="signupMsg2"></span>
						</div>
						
					</div>
					
				</div>
			</div>
			</div>
			
			<div class="row authority0" style="display: none;">			
			<div class="col-md-6" id="referAArea">
				<div class="panel panel-default">
					
					<div class="panel-heading text-center" style="color:darkred;font-weight: bold;font-size: 22px;font-family: Microsoft JhengHei;" id="">
						<span id="">初賽評分</span>
					</div>
			
					<div class="panel-body">
						
						<div class="text-center">
							<form class="text-center">
								<input type="text" placeholder="點擊或輸入隊伍編號" class="" style="text-align: center;" id="teamNOGet1">
								<select class="" id="firstScore" name="firstScore">
									<option value="1">入圍</option>
									<option value="0">取消入圍</option>
								</select>
								<button type="button" class="btn btn-success" onClick="score1()">評審</button>
							</form>
								操作結果：<span style="text-align: center;" id="scoreMsg1"></span>
						</div>
						
					</div>
					
				</div>
			</div>
			
			<div class="col-md-6" id="referCArea">
				<div class="panel panel-default">
					
					<div class="panel-heading text-center" style="color:darkred;font-weight: bold;font-size: 22px;font-family: Microsoft JhengHei;" id="">
						<span id="">決賽評分</span>
					</div>
			
					<div class="panel-body">
						
						<div class="text-center">
							<form class="text-center">
								<input type="text" placeholder="點擊或輸入隊伍編號" class="" style="text-align: center;" id="teamNOGet2">
								<select class="" id="secondScore" name="secondScore">
									<option value="6">佳作</option>
									<option value="5">優等</option>
									<option value="4">特優</option>
									<option value="3">第三名</option>
									<option value="2">第二名</option>
									<option value="1">第一名</option>
									<option value="0">取消名次</option>
								</select>
								<button type="button" class="btn btn-success" onClick="score2()">評審</button>
							</form>
								操作結果：<span style="text-align: center;" id="scoreMsg2"></span>
						</div>
						
					</div>
					
				</div>
			</div>
		</div>
		
			<div class="row authority0" style="display: none;">			
			<div class="col-md-6" id="referAArea">
				<div class="panel panel-default">
					
					<div class="panel-heading text-center" style="color:darkred;font-weight: bold;font-size: 22px;font-family: Microsoft JhengHei;" id="">
						<span id="">初賽繳交</span>
					</div>
			
					<div class="panel-body">
						
						<div class="text-center">
							<form class="text-center">
								<input type="text" placeholder="點擊或輸入隊伍編號" class="" style="text-align: center;" id="teamNOGet5">
								<select class="" id="firstReport" name="firstReport">
									<option value="1">已繳交</option>
									<option value="0">取消繳交</option>
								</select>
								<button type="button" class="btn btn-success" onClick="firstReportFix()">編輯</button>
							</form>
								操作結果：<span style="text-align: center;" id="firstReportMsg"></span>
						</div>
						
					</div>
					
				</div>
			</div>
			
			<div class="col-md-6" id="referCArea">
				<div class="panel panel-default">
					
					<div class="panel-heading text-center" style="color:darkred;font-weight: bold;font-size: 22px;font-family: Microsoft JhengHei;" id="">
						<span id="">決賽繳交</span>
					</div>
			
					<div class="panel-body">
						
						<div class="text-center">
							<form class="text-center">
								<input type="text" placeholder="點擊或輸入隊伍編號" class="" style="text-align: center;" id="teamNOGet6">
								<select class="" id="secondReport" name="secondReport">
									<option value="1">已繳交</option>
									<option value="0">取消繳交</option>
								</select>
								<button type="button" class="btn btn-success" onClick="secondReportFix()">編輯</button>
							</form>
								操作結果：<span style="text-align: center;" id="secondReportMsg"></span>
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
		
<script>
		function teamNOSelect(event){
			var str = $(event).text()
			$("#teamNOGet1").val(str)
			$("#teamNOGet2").val(str)
			$("#teamNOGet3").val(str)
			$("#teamNOGet4").val(str)
			$("#teamNOGet5").val(str)
			$("#teamNOGet6").val(str)
		}
</script>

	
</body>



</html>

