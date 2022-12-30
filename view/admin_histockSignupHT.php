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


$signupHT = mysql_query("SELECT * FROM histock_HTsignup ORDER BY id DESC");//從competCollege中選取全部(*)的資料

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
<link href="../lumino/css/styles.css" rel="stylesheet">

<style>

/* The switch - the box around the slider */
.switch {
  position: relative;
  display: inline-block;
  width: 50px;
  height: 25px;
}

/* Hide default HTML checkbox */
.switch input {
  opacity: 0;
  width: 0;
  height: 0;
}

/* The slider */
.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 20px;
  width: 20px;
  left: 4px;
  bottom: 3px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 25px;
}

.slider.round:before {
  border-radius: 50%;
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
				<li>金融證券實務/金融證券投資實務輔導員選拔 - 選拔管理</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">金融證券投資實務輔導員選拔 - 選拔管理</h1>
			</div>
		</div><!--/.row-->
				
		
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">
						<form align="center" name="export" action="../model/admin_exportHistockSignupHT.php" method="post">
						<button type="submit" name="exportButton" class="btn btn-info">下載資料(CSV)</button>
						</form>
					</div>
					<div class="panel-body">
						<table id="competForm" class="table table-hover table-striped table-bordered text-center" style="100%">
							<thead class="thead-dark bg-info">
								<tr>
									<th>報名時間</th>
									<th>活動代碼</th>
									<th>活動梯次</th>
									<th>身份證字號</th>
									<th>選拔代號</th>
									<th>招待公關</th>
<!--									<th>vCode</th>-->
								</tr>
							</thead>
							<tbody>	
								
							<?php
							for ($i=1; $i<=mysql_num_rows($signupHT); $i++) {
								$row=mysql_fetch_row($signupHT);
							?>

								<tr>
									<td><? echo $row[1];?></td>
									<td><? echo $row[2];?></td>
									<td><? echo $row[3];?></td>
									<td><? echo $row[4];?></td>
									<td><? echo $row[5];?></td>
									<td>
										<label class="switch">
										<input type="checkbox" value="Y" id="hostSwitch" onChange="switchHost('<? echo $row[5];?>','<? echo $row[7];?>','<? echo $row[4];?>','<? echo $row[2];?>')" <?php echo $row[7] == 'Y' ? 'checked' : ''; ?>>
										<span class="slider"></span>
										</label>
									</td>
								</tr>

							<?php }?>
							</tbody>
						</table>
					</div>
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

	
<!-- Switch Host -->
<script>
		
	function switchHost(examNO, value, identifyNO, projectNO){

	
		$.ajax({

			url:"https://wmpcca.com/bswmp/form/model/histock_switchHost.php",
			data:{
				"examNO" : examNO,
				"value" : value,
				"identifyNO" : identifyNO,
				"projectNO" : projectNO
			},

			method : "POST",

			error : function(Msg){
				alert(Msg);
			},

			success : function(Msg){
				alert(examNO+Msg);
				window.location.reload();
				}
			});
	}
		
</script>
	
</body>



</html>

