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
				<li>KEYs操作/帳號設定</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">帳號設定</h1>
			</div>
		</div><!--/.row-->
				
		
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading text-center" style="color:darkred;font-weight: bold;font-size: 22px;font-family: Microsoft JhengHei;">
						<span id="">帳號查詢</span>
					</div>
	
							<div class="mx-auto text-center">
								<input type="text" class="" placeholder="請輸入欲查詢的KEYs帳號" aria-label="Recipient's username" aria-describedby="basic-addon2" id="UserName" size="50">
								<button class="btn-outline-info" type="button" id="submitCHK">查詢</button>
							</div>
					
					<div class="panel-body">
						<table id="" class="table table-hover table-striped table-bordered text-center" style="100%">
							<thead class="thead-dark bg-info">
								<tr>
								  <th class="text-center">使用者</th>
								  <th class="text-center">KEYs版本</th>
								  <th class="text-center">授權到期</th>
								  <th class="text-center">帳號狀態</th>
								  <th class="text-center">功能操作</th>
								</tr>
							</thead>

							<tbody>	
								<tr>
								  <td id="getUserName" width="20%"></th>
								  <td id="getRoleID" width="20%"></td>
								  <td id="getEndDate" width="20%"></td>
								  <td id="getRowStatus" width="20%"></td>
								  <td id="" width="20%"><button class="">變更授權</button> <button class="">設定到期</button></td>
								</tr>
							</tbody>
					
						</table>
					</div>
				</div>
			</div>
		</div><!--/.row-->
		

		
<!-- vCode申請 -->
		<div class="row authority0">
			
			<div class="col-md-12" id="submitArea">
				<div class="panel panel-default">
					
					<div class="panel-heading text-center" style="color:darkred;font-weight: bold;font-size: 22px;font-family: Microsoft JhengHei;">
						<span id="">大量授權</span>
					</div>
			
					<div class="panel-body">
						
							<div class="row">
								
								<div class="col-md-4" style="border-right:1px #E0E0E0 solid;">
									<div>
										<label for="staffName">申 請 人：</label>
										<span id="staffName"><? echo $staffName; ?></span>
									</div>
									<div>
										<label for="staffNO">代　　碼：</label>
										<span id="staffNO2"><? echo $staffNO; ?></span>
									</div>
									<div>
										<label for="">申請項目：</label>
										<select id="vCodeDescribe">
											<option value="">請選擇...</option>
											<optgroup label="---KEYs首購加贈---">
												<option value="OP加贈1個月">加贈1個月</option>
												<option value="OP加贈2個月">加贈2個月</option>
												<option value="OP加贈3個月">加贈3個月</option>
												<option value="OP加贈6個月">加贈6個月</option>
												<option value="OP加贈12個月">加贈12個月</option>
												<option value="OP9折優惠">9折優惠</option>
												<option value="OP8折優惠">8折優惠</option>
												<option value="OP7折優惠">7折優惠</option>
												<option value="OP6折優惠">6折優惠</option>
												<option value="OP5折優惠">5折優惠</option>
											</optgroup>
										</select>
									</div>
									<div>
										<label for="target">對　　象：</label>
										<input type="text" id="vCodeTarget">
									</div>
									<div>
										<label for="">使用期限：</label>
										<input type="text" class="datepicker" style="text-align: center;" id="vCodeEndDate">
									</div>
									<div>
										<label for="limited">額度上限：</label>
										<select id="vCodeLimited">
											<option>請選擇...</option>
											<option value="5">5</option>
											<option value="10">10</option>
											<option value="15">15</option>
											<option value="20">20</option>
											<option value="25">25</option>
											<option value="30">30</option>
											<option value="35">35</option>
											<option value="50">50</option>
											<option value="100">100</option>
										</select>
									</div>
									<div>
										<label for="textArea">補充說明：</label>
										<textarea style="width:80%;height:200px;vertical-align: top;" id="vCodeRemarks"></textarea>
									</div>
									<div>
										<button class="btn-info" onClick="vCodeSubmit()">送出</button><span id="vCodeMsg"></span>
									</div>
								</div>
								
								<div class="col-md-8">
									<div class="panel-body">
										<table id="competForm" class="table table-hover table-striped table-bordered text-center" style="100%">
											<thead class="thead-dark bg-info">
												<tr>
													<th class="text-center">申請時間</th>
													<th class="text-center">vCode</th>
													<th class="text-center">對應項目</th>
													<th class="text-center">內容描述</th>
													<th class="text-center">結束時間</th>
													<th class="text-center">對象</th>
													<th class="text-center">額度</th>
													<th class="text-center">狀態</th>
												</tr>
											</thead>
											<tbody>	

											<?php
											for ($i=1; $i<=mysql_num_rows($data3); $i++) {
												$row=mysql_fetch_row($data3);
												if ($row[3] = 'OP'){
													$row[3] = 'KEYs首購';
												}
											?>

												<tr>
													<td><?php echo $row[1];?></td>
													<td><?php echo $row[2];?></td>
													<td><?php echo $row[3];?></td>
													<td><?php echo $row[4];?></td>
													<td><?php echo $row[6];?></td>
													<td><?php echo $row[7];?></td>
													<td><?php echo $row[9];?></td>
													<td><?php echo $row[11];?></td>
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
		</div>
			
		<div class="row" style="display: none;" id="postType2">
			<div class="col-md-12" id="manageArea">
				<div class="panel panel-default">
					
					<div class="panel-heading text-center" style="color:darkred;font-weight: bold;font-size: 22px;font-family: Microsoft JhengHei;">
						<span id="">管理vCode</span>
					</div>
			
					<div class="panel-body">
						<table id="competForm" class="table table-hover table-striped table-bordered text-center" style="100%">
							<thead class="thead-dark bg-info">
								<tr>
									<th class="text-center">ID</th>
									<th class="text-center">建立時間</th>
									<th class="text-center">vCode</th>
									<th class="text-center">對應項目</th>
									<th class="text-center">內容描述</th>
									<th class="text-center">結束時間</th>
									<th class="text-center">對象</th>
									<th class="text-center">額度</th>
									<th class="text-center">申請人</th>
									<th class="text-center">操作</th>
								</tr>
							</thead>
							<tbody>	
								
							<?php
							for ($i=1; $i<=mysql_num_rows($data2); $i++) {
								$row=mysql_fetch_row($data2);
							//調出申請人姓名
								$submiter = $row[10];
								$sqlSELECTsubmiter = " SELECT * FROM staffList WHERE staffNO = '$submiter' ";
								$sqlRESULTsubmiter = mysql_query($sqlSELECTsubmiter, $sqlLink);
								$sqlFETCHsubmiter = mysql_fetch_row($sqlRESULTsubmiter);
								$submiter = $sqlFETCHsubmiter[6];
							?>

								<tr>
									<td><?php echo $row[0];?></td>
									<td><?php echo $row[1];?></td>
									<td><?php echo $row[2];?></td>
									<td><?php echo $row[3];?></td>
									<td><?php echo $row[4];?></td>
									<td><?php echo $row[5];?></td>
									<td><?php echo $row[7];?></td>
									<td><?php echo $row[9];?></td>
									<td><?php echo $submiter;?></td>
									<td><button class="btn-success" onclick="vCodePermit('<?php echo $row[2];?>')">通過</button> <button class="btn-danger" onclick="vCodeReject('<?php echo $row[2];?>')">駁回</button></span></td>
								</tr>

							<?php }?>
							</tbody>
						</table>
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
	<script src="../controller/Division.js"></script>
	<script src="../controller/admin_teacherListAdd.js"></script>
	<script src="../controller/admin_teacherDataDelete.js"></script>
	<script src="../controller/admin_referSelect.js"></script>
	<script src="../controller/admin_competScore1.js"></script>
	<script src="../controller/admin_competScore2.js"></script>
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
		}
</script>


<!-- vCode Submit -->
<script>
	function vCodeSubmit(){
		var staffName = $("#staffName").text();
		var staffNO = $("#staffNO2").text();
		var vCodeDescribe = $("#vCodeDescribe").val();
		var vCodeTarget = $("#vCodeTarget").val();
		var vCodeEndDate = $("#vCodeEndDate").val();
		var vCodeLimited = $("#vCodeLimited").val();
		var vCodeRemarks = $("#vCodeRemarks").val();
		
		$.ajax({

			url:"https://wmpcca.com/bswmp/form/model/admin_vCodeSubmit.php",
			data:{
				"staffName" : staffName,
				"staffNO" : staffNO,
				"vCodeDescribe" : vCodeDescribe,
				"vCodeTarget" : vCodeTarget,
				"vCodeEndDate" : vCodeEndDate,
				"vCodeLimited" : vCodeLimited,
				"vCodeRemarks" : vCodeRemarks
			},

			method : "POST",

			error : function(msg){
				$("#vCodeMsg").html(msg);
			},

			success : function(msg){
				$("#vCodeMsg").html(msg);

				if (msg === '已提交您的申請！'){
					window.location.reload();
				}

			}

		});
		
	}
</script>

<!-- vCode允許/駁回 -->
<script>
	
	function vCodePermit(vCode){
		$.ajax({

			url:"https://wmpcca.com/bswmp/form/model/admin_vCodePermit.php",
			data:{
				"vCode" : vCode
			},

			method : "POST",

			error : function(msg){
				
			},

			success : function(msg){

				if (msg === '已核准'){
					alert('操作完成');
					window.location.reload();
				}

			}

		});
	}
	
	function vCodeReject(vCode){
		$.ajax({

			url:"https://wmpcca.com/bswmp/form/model/admin_vCodeReject.php",
			data:{
				"vCode" : vCode
			},

			method : "POST",

			error : function(msg){
				
			},

			success : function(msg){

				if (msg === '已駁回'){
					alert('操作完成');
					window.location.reload();
				}

			}

		});
	}
	
</script>
	
<!-- Keys查詢 -->
	<script>
$(document).ready(function(){
	$("#endDate").text(moment().add(12, 'M').add(7, 'd').format('YYYY/MM/DD'));
});		
		
$('#submitCHK').click(function () {
   const data = $('#UserName').val()
   $.ajax({
    url:`https://www.holdingkeys.com/hermesAPI/api/member?userId=${data}`,
    contentType:'application/json'
    }).done(function (resp) {
     if(resp.success){
      $('#getUserName').text(resp.data.userName)
      $('#getRoleID').text(resp.data.roleID)
      $('#getStartDate').text(resp.data.startDate)
      $('#getEndDate').text(resp.data.endDate)
      $('#getRowStatus').text(resp.data.rowStatus)
	  GetNewKeys()
     }else{
      alert(resp.message)
     }
    });
})

$(".radioStyle").on("click", function () {
	GetNewKeys()
});

function GetNewKeys(){
    var today = moment();
    var KEYsEndDate = $('#getEndDate').text() !== '' ? $('#getEndDate').text() : moment();
    KEYsEndDate = moment(KEYsEndDate).isBefore(today) ? today : moment(KEYsEndDate);
	var checkVal = $(".radioStyle:checked").val()
	switch (checkVal) {
		case "RP001":
			newEndDate = KEYsEndDate.add(12,'M').add(7, 'd').format('YYYY/MM/DD')
			$("#showPrice").text("$6,000");
			$("#months").text("12");
			$("#endDate").text(newEndDate);
			break;
		case "RP002":
			newEndDate = KEYsEndDate.add(25,'M').add(7, 'd').format('YYYY/MM/DD')
			$("#showPrice").text("$10,800");
			$("#months").text("25");
			$("#endDate").text(newEndDate);
			break;
		case "RP003":
			newEndDate = KEYsEndDate.add(39,'M').add(7, 'd').format('YYYY/MM/DD')
			$("#showPrice").text("$14,800");
			$("#months").text("39");
			$("#endDate").text(newEndDate);
			break;
	}
}
		
	</script>

</body>



</html>

