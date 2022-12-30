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

$data1 = mysql_query("select * from competSocial");//從competCollege中選取全部(*)的資料

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
<!--  FONT-AWESOME 5.10.0 -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.2/css/all.min.css" integrity="sha256-zmfNZmXoNWBMemUOo1XUGFfc0ihGGLYdgtJS3KCr/l0=" crossorigin="anonymous" />
<link href="../lumino/css/styles.css" rel="stylesheet">

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
	
	.mb-1{
		margin-bottom: 10px;
	}
	
	.mb-2{
		margin-bottom: 20px;
	}
	
	.mb-3{
		margin-bottom: 30px;
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
				<li>Log</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Compet Log</h1>
				<button class="btn btn-lg btn-danger ml-2 mb-2" onClick=""><i class="fas fa-dumpster mr-1"></i>完全清空</button>
				<button class="btn btn-lg btn-dark ml-2 mb-2" onClick=""><i class="fas fa-eraser mr-1"></i>保留最近一年</button>
				<button class="btn btn-lg btn-dark ml-2 mb-2" onClick=""><i class="fas fa-eraser mr-1"></i>保留最近半年</button>
				<button class="btn btn-lg btn-success ml-2 mb-2" onClick=""><i class="fas fa-trash-alt mr-1"></i>保留最近一月</button>
				<button class="btn btn-lg btn-warning ml-2 mb-2" onClick=""><i class="fas fa-trash-alt mr-1"></i>保留最近一週</button>
			</div>
		</div><!--/.row-->
				
		
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					
					<?
						$file = fopen("../log/competLog.txt", "r");
						while(! feof($file)){
							echo fgets($file)."<br />";
						}
							
						fclose($file);
					?>
					
				</div>
			</div>
		</div><!--/.row-->	
		
	</div><!--/.main-->


	<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
	<script src="../lumino/js/bootstrap.min.js"></script>
	<script src="../lumino/js/chart.min.js"></script>
	<script src="../lumino/js/chart-data.js"></script>
	<script src="../lumino/js/easypiechart.js"></script>
	<script src="../lumino/js/easypiechart-data.js"></script>
	<script src="../lumino/js/bootstrap-datepicker.js"></script>
<!--	<script src="../lumino/js/bootstrap-table.js"></script>-->
  <!-- DataTables v1.10.16 -->
	<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
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
		$("#competForm").dataTable({
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

