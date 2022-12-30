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
echo "alert('COOKIE錯誤或逾時!請重新登入！')";
echo "</script>";
header("location:admin_login.php");
exit();
}

$data1 = mysql_query("select * from competList");//從competCollege中選取全部(*)的資料


?>

<!DOCTYPE html>

<html>

<head>

<meta charset="utf-8">

<meta name="viewport" content="width=device-width, initial-scale=1">

<title>WMPCCA - 競賽時程設定</title>

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
				<a class="navbar-brand" href=""><span>WMPCCA</span>後台管理系統</a>
				<ul class="user-menu">
					<li class="dropdown pull-right">
						<a href="" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span> <?php echo $staffName ?> <span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
							<li><a href=""><span class="glyphicon glyphicon-user"></span> 個人資料</a></li>
							<li><a href=""><span class="glyphicon glyphicon-cog"></span> 設定</a></li>
							<li><a href=""><span class="glyphicon glyphicon-log-out"></span> 登出</a></li>
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
				<li class="active">競賽時程設定</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">競賽時程設定</h1>
			</div>
		</div><!--/.row-->
				
		
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">
						<form align="center" name="export" action="../model/admin_exportCompetCollege.php" method="post">
						<button type="submit" name="exportButton" class="btn btn-info">下載資料(CSV)</button>
						</form>
					</div>
					
					<div class="panel-body">
						<table id="competDateForm" class="table table-hover table-striped table-bordered text-center" style="100%">
							<thead class="thead-dark bg-info">
								<tr>
									<th>id</th>
									<th>競賽代號</th>
									<th>項目名稱</th>
									<th>報名費用</th>
									<th>開始報名</th>
									<th>截止報名</th>
									<th>開始繳費</th>
									<th>繳費期限</th>
									<th>初賽截止</th>
									<th>決賽截止</th>
									<th>下載連結</th>
									<th>備註</th>
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
									<td><?php echo $row[3];?></td>
									<td><?php echo substr($row[4], 0, 16);?></td>
									<td><?php echo substr($row[5], 0, 16)?></td>
									<td><?php echo substr($row[6], 0, 16)?></td>
									<td><?php echo substr($row[7], 0, 16)?></td>
									<td><?php echo substr($row[8], 0, 16)?></td>
									<td><?php echo substr($row[9], 0, 16)?></td>
									<td><?php echo $row[10];?></td>
									<td><?php echo $row[11];?></td>
								</tr>

							<?php }?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div><!--/.row-->	

		<div class="row authority0">
			<div class="col-md-6">
				<div class="panel panel-default">
					<div class="panel-heading text-center">新增競賽時程</div>
					<form class="">
						<label for="addCompetProjectSelect">選擇欲新增的競賽項目</label>
							<select class="form-group" name="addCompetProjectSelect" id="addCompetProjectSelect">
							<option value="">請選擇...</option>
							<option value="CG">全國大專財富管理規劃競賽</option>
							<option value="SG">全國財富管理規劃競賽</option>
							<option value="NCS">全國大專校院北、中、南分區理財規劃案例競賽</option>
							<option value="HS">全國金融證券投資實務競賽</option>
							</select>
								<br>
							<label for="competStartDate">選擇報名開始日：</label>
								<input type="text" class="datepicker" style="text-align: center;" id="competStartDate"><small class="text-danger"> ※時間一律為00:00計</small>
								<br>
							<label for="competEndDate">選擇報名截止日：</label>
								<input type="text" class="datepicker" style="text-align: center;" id="competEndDate"><small class="text-danger"> ※時間一律為00:00計</small>
								<br>
							<label for="startPayDate">選擇繳費開始日：</label>
								<input type="text" class="datepicker" style="text-align: center;" id="payStartDate"><small class="text-danger"> ※時間一律為00:00計</small>
								<br>
							<label for="endPayDate">選擇繳費截止日：</label>
								<input type="text" class="datepicker" style="text-align: center;" id="payEndDate"><small class="text-danger"> ※時間一律為00:00計</small>
								<br>
							<label for="report1Date">初賽報告截止日：</label>
								<input type="text" class="datepicker" style="text-align: center;" id="report1Date"><small class="text-danger"> ※時間一律為00:00計</small>
								<br>
							<label for="report2Date">決賽報告截止日：</label>
								<input type="text" class="datepicker" style="text-align: center;" id="report2Date"><small class="text-danger"> ※時間一律為00:00計</small>
								<br>
							<label for="downloadLink">檔案下載連結：</label>
								<input type="text" class="" style="text-align: center;" id="downloadLink"><small class="text-danger"> ※ Zip壓縮檔+縮網址</small>
								<br>
								<br>
								<div class="mx-auto text-center"><button type="button" class="buttonFail" onclick="addCompetProject()">確認新增</button></div>
								<br>
					</form>
					<div class="text-center">操作結果：<span style="text-align: center;" id="addCompetDateResult"></span></div><br>
				</div>
			</div>
			
			<div class="col-md-6">
				<div class="panel panel-default">
					<div class="panel-heading text-center">刪除競賽時程</div>
					<form class="">
						<label for="delCompetProjectSelect">選擇欲刪除的競賽項目</label>
						<select name="deleteCompetList" id="deleteCompetList">	
						<option value="">請選擇...</option>
							<?php
								$str = "SELECT projectNO, projectName FROM competList ";
								$list = mysql_query($str,$sqlLink);
								while(list($projectNO,$projectName) = mysql_fetch_row($list))
								{
								echo "<option value=".$projectNO.">".$projectNO."：".$projectName."</option>\n";
								}
							?> 
						</select>
						<br>
						<br>
						<div class="mx-auto text-center"><button type="button" class="" onclick="delCompetProject()">確認刪除</button></div>
						<br>
					</form>
					<div class="text-center">操作結果：<span style="text-align: center;" id="delCompetDateResult"></span></div><br>
				</div>
			</div>
		</div><!--/.row-->	
		
		
	</div><!--/.main-->

	<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
	<script src="../lumino/js/bootstrap.min.js"></script>
	<script src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js" integrity="sha256-eGE6blurk5sHj+rmkfsGYeKyZx3M4bG+ZlFyA7Kns7E=" crossorigin="anonymous"></script>
<!--	<script src="../lumino/js/bootstrap-datepicker.js"></script>-->
	<script src="../controller/datepicker.js"></script>
	<script src="../controller/admin_delCompetProject.js"></script>
	<script src="../controller/admin_addCompetProject.js"></script>
	
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
		$("#competDateForm").dataTable({
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

</body>



</html>

