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

$data1 = mysql_query("select * from orderList");//從competCollege中選取全部(*)的資料

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
				<li>訂單資訊/訂單總覽</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">訂單總覽</h1>
			</div>
		</div><!--/.row-->
				
		
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">
						<form align="center" name="export" action="../model/admin_exportOrderList.php" method="post">
						<button type="submit" name="exportButton" class="btn btn-info">下載資料(CSV)</button>
						</form>
					</div>
					<div class="panel-body">
						<table id="competForm" class="table table-hover table-striped table-bordered text-center" style="100%">
							<thead class="thead-dark bg-info">
								<tr>
									<th>流水號</th>
									<th>訂單時間</th>
									<th>訂單編號</th>
									<th>客戶編號</th>
									<th>項目代碼</th>
									<th>訂單金額</th>
									<th>繳費方式</th>
									<th>繳費狀態</th>
									<th>繳費時間</th>
									<th>銀行代碼</th>
									<th>匯款帳號</th>
									<th>超商代碼</th>
									<th>繳費期限</th>
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
									<td><?php echo $row[4];?></td>
									<td><?php echo $row[6];?></td>
									<td><?php echo $row[7];?></td>
									<td><?php echo $row[8];?></td>
									<td><?php echo $row[9];?></td>
									<td><?php echo $row[13];?></td>
									<td><?php echo $row[14];?></td>
									<td><?php echo $row[15];?></td>
									<td><?php echo $row[16];?></td>
								</tr>

							<?php }?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div><!--/.row-->	
		
<!-- 刪除訂單 -->
		<div class="row authority1">
			
			<div class="col-md-12" id="">
				<div class="panel panel-default">
					
					<div class="panel-heading text-center" style="color:darkred;font-weight: bold;font-size: 22px;font-family: Microsoft JhengHei;">
						<span id="">刪除無效訂單</span>
					</div>

					<div class="panel-body" style="border-bottom: 1px #E0E0E0 solid;">
						<div class="row mx-auto text-center">
							<div class="col mx-auto text-center">
								<input type="text" placeholder="輸入訂單編號" id="getOrderNO">
								<button class="btn-info" id="getTeamDataCollegeButton" onClick="getOrder()">繼續</button>
							</div>
						</div>
					</div>
					
					<div class="panel-body">
						<table id="competForm" class="table table-hover table-striped table-bordered text-center" style="100%">
							<thead class="thead-dark bg-info">
								<tr>
									<th>流水號</th>
									<th>訂單時間</th>
									<th>訂單編號</th>
									<th>客戶編號</th>
									<th>項目代碼</th>
									<th>訂單金額</th>
									<th>繳費方式</th>
									<th>繳費狀態</th>
									<th>繳費時間</th>
									<th>銀行代碼</th>
									<th>匯款帳號</th>
									<th>超商代碼</th>
									<th>繳費期限</th>
									<th>功能操作</th>
								</tr>
							</thead>
							<tbody>	
								<tr>
									<td id="getOrderList-id"></td>
									<td id="getOrderList-orderTime"></td>
									<td id="getOrderList-orderNO"></td>
									<td id="getOrderList-customerNO"></td>
									<td id="getOrderList-projectNO"></td>
									<td id="getOrderList-MN"></td>
									<td id="getOrderList-payWay"></td>
									<td id="getOrderList-payStatus"></td>
									<td id="getOrderList-payTime"></td>
									<td id="getOrderList-bankCode"></td>
									<td id="getOrderList-vAccount"></td>
									<td id="getOrderList-paymentNO"></td>
									<td id="getOrderList-expireDate"></td>
									<th class="mx-auto text-center"><button class="btn btn-danger" onClick="delOrder()">刪除此筆訂單</button></th>
								</tr>
							</tbody>
						</table>
					</div>
					
				</div>
			</div>
		</div>
		
	</div><!--/.main-->


	<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
	<script src="../lumino/js/bootstrap.min.js"></script>
	<script src="../lumino/js/chart.min.js"></script>
	<script src="../lumino/js/chart-data.js"></script>
	<script src="../lumino/js/easypiechart.js"></script>
	<script src="../lumino/js/easypiechart-data.js"></script>
<!--
	<script src="../lumino/js/bootstrap-datepicker.js"></script>
	<script src="../lumino/js/bootstrap-table.js"></script>
-->
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
	</script>
	
<!-- 查詢欲刪除訂單 Ajax -->
	<script>
		function getOrder(){
						
			var orderNO = $("#getOrderNO").val();
			
			$.ajax({

				url:"https://wmpcca.com/bswmp/form/model/admin_orderList_getOrderNO.php",
				data:{
					"orderNO" : orderNO
				},

				method : "POST",

				error : function(Msg){
					alert(Msg);
				},

				success : function(Msg){
					$("#getOrderList-id").text(Msg[0]);
					$("#getOrderList-orderTime").text(Msg[1]);
					$("#getOrderList-orderNO").text(Msg[2]);
					$("#getOrderList-customerNO").text(Msg[3]);
					$("#getOrderList-projectNO").text(Msg[4]);
					$("#getOrderList-MN").text(Msg[5]);
					$("#getOrderList-payWay").text(Msg[6]);
					$("#getOrderList-payStatus").text(Msg[7]);
					$("#getOrderList-payTime").text(Msg[8]);
					$("#getOrderList-bankCode").text(Msg[9]);
					$("#getOrderList-vAccount").text(Msg[10]);
					$("#getOrderList-paymentNO").text(Msg[11]);
					$("#getOrderList-expireDate").text(Msg[12]);
				}
			});	// 傳值 修改資料/產生/修改訂單 Ajax 結束
			
		}
		
	</script>
	
<!-- 刪除訂單 Ajax -->
	<script>
		function delOrder(){
						
			var orderNO = $("#getOrderList-orderNO").text();
			
			$.ajax({

				url:"https://wmpcca.com/bswmp/form/model/admin_orderList_delOrderNO.php",
				data:{
					"orderNO" : orderNO
				},

				method : "POST",

				error : function(Msg){
					alert(Msg);
				},

				success : function(Msg){
					alert(Msg);
					setTimeout(function(){
					window.location.reload();
					},1000);
				}
			});	// 傳值 修改資料/產生/修改訂單 Ajax 結束
			
		}
		
	</script>
	
</body>



</html>

