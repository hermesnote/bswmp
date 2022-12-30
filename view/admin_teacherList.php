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

$data1 = mysql_query("select * from teacherList");//從competCollege中選取全部(*)的資料

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
				<li>訂單資訊/產學聯繫</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">產學聯繫</h1>
			</div>
		</div><!--/.row-->
				
		
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">
						<form align="center" name="export" action="../model/admin_exportTeacherList.php" method="post">
						<button type="submit" name="exportButton" class="btn btn-info">下載資料(CSV)</button>
						</form>
					</div>
	
					<div class="panel-body">
						<table id="competForm" class="table table-hover table-striped table-bordered text-center" style="100%">
							<thead class="thead-dark bg-info">
								<tr>
									<th>ID</th>
									<th>教師編號</th>
									<th>任職學校</th>
									<th>院所</th>
									<th>科系</th>
									<th>職務</th>
									<th>姓名</th>
									<th>電話</th>
									<th>電子郵件</th>
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
									<td><?php echo $row[4];?></td>
									<td><?php echo $row[5];?></td>
									<td><?php echo $row[6];?></td>
									<td><?php echo $row[7];?></td>
									<td><?php echo $row[8];?></td>
									<td><?php echo $row[9];?></td>
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
						<div class="panel-heading text-center" style="color:dodgerblue;font-weight: bold;font-size: 22px;font-family: Microsoft JhengHei;"><span id="returnMsg">新 增 聯 絡 資 料</span></div>

<!--					<div class="panel-heading text-center"><span class="glyphicon glyphicon-plus-sign">新增聯絡人</span></div>-->
					<div class="panel-body">
						<form name="teacherListAdd" class="" id="teacherListAdd" method="post">
							<div class="form-group">
								
								<div class="row my-3" style="margin-top: 10px;">
									<div class="col-sm-2"></div>
									<div class="col-sm-8">
										<label for="disdrict" class="text-primary h4">學校區域</label>
										<select name="schoolDistrict" class="form-control" id="schoolDistrict">
										</select>
									</div>
									<div class="col-sm-2"></div>
								</div>
								
								<div class="row my-3" style="margin-top: 10px;">
									<div class="col-sm-2"></div>
									<div class="col-sm-8">
										<label for="school" class="text-primary h4">選擇學校</label>
										<select name="school" class="form-control" id="schoolPre">
										</select>
									</div>
									<div class="col-sm-2"></div>
								</div>
								
								<div class="row my-3" style="margin-top: 10px;">
									<div class="col-sm-2"></div>
									<div class="col-sm-8">
										<label for="captainCollege" class="text-primary h4">院所</label>
										<select name="teacherCollege" class="form-control" id="captainCollege">
										</select>
									</div>
									<div class="col-sm-2"></div>
								</div>

								<div class="row my-3" style="margin-top: 10px;">
									<div class="col-sm-2"></div>
									<div class="col-sm-8">
										<label for="captainDepart" class="text-primary h4">科系</label>
										<select name="teacherDepart" class="form-control" id="captainDepart">
										</select>
									</div>
									<div class="col-sm-2"></div>
								</div>
								
								<div class="row my-3" style="margin-top: 10px;">
									<div class="col-sm-2"></div>
									<div class="col-sm-8">
										<label for="captainDepart" class="text-primary h4">職務</label>
										<select name="teacherType" class="form-control" id="teacherType">
											<option value="">請選擇...</option>
											<option value="系主任">系主任</option>
											<option value="教授">教授</option>
											<option value="副教授">副教授</option>
											<option value="助理教授">助理教授</option>
											<option value="教師">教師</option>
											<option value="助教">助教</option>
											<option value="秘書">秘書</option>
											<option value="助理">助理</option>
											<option value="其它">其它</option>
										</select>
									</div>
									<div class="col-sm-2"></div>
								</div>
								
								<div class="row my-3" style="margin-top: 10px;">
									<div class="col-sm-2"></div>
									<div class="col-sm-8">
										<label for="teacherName" class="text-primary h4">姓名</label>
										<input type="text" name="teacherName" id="teacherName" class="form-control text-center">
									</div>
									<div class="col-sm-2"></div>
								</div>
								
								<div class="row my-3" style="margin-top: 10px;">
									<div class="col-sm-2"></div>
									<div class="col-sm-8">
										<label for="teacherPhone" class="text-primary h4">聯絡電話 (室話分機請以#表示)</label>
										<input type="text" name="teacherPhone" id="teacherPhone" class="form-control text-center">
									</div>
									<div class="col-sm-2"></div>
								</div>
								
								<div class="row my-3" style="margin-top: 10px;">
									<div class="col-sm-2"></div>
									<div class="col-sm-8">
										<label for="teacherEmail" class="text-primary h4">電子郵件</label>
										<input type="text" name="teacherEmail" id="teacherEmail" class="form-control text-center">
									</div>
									<div class="col-sm-2"></div>
								</div>
								
								<div class="row my-3" style="margin-top: 10px;">
									<div class="col-sm-2"></div>
									<div class="col-sm-8">
										<label for="remarks" class="text-primary h4">備註事項</label>
										<textarea name="remarks" id="remarks" class="form-control" rows="4"></textarea>
									</div>
									<div class="col-sm-2"></div>
								</div>
								
							</div>
						</form>
						
<!--						<div class="text-danger text-center h3"><span id="returnMsg"></span></div>-->
						
						<div class="col mx-auto text-center my-5">
							<button onClick="teacherAdd()" class="btn btn-lg" style="background-color:dodgerblue;color:white;text-align: center;font-size: 16px;border: none;"><span class="glyphicon glyphicon-ok-sign"></span> 新增聯絡資料</button>
						</div>
						
					</div>
				</div>
			</div>
			
			<div class="col-md-6">
				<div class="panel panel-default">
<!--					<div class="panel-heading text-center" style="color:darkred;font-weight: bold;font-size: 22px;font-family: Microsoft JhengHei;"><span id="">修 改 現 有 資 料</span></div>-->
					<div class="panel-heading text-center">
						<div class="row text-center">
						<div class="col-md-6 text-center">
							<span id="editMsg">※目前僅開放刪除功能！</span>
						</div>
						<div class="col-md-6 text-center">
							<input type="text" name="teacherNOInput" class="text-center" id="teacherNOInput" placeholder="教師編號">  <button onClick="deleteData()" style="background-color: red;color:white;font-weight: 400;">  刪除資料 </button>
						</div>
						</div>
					</div>
						

<!--
					<div class="panel-heading text-center">
						<div class="row text-center">
						<div class="col-md-6 text-center">
							<span id="editMsg">※目前僅開放刪除功能！</span>
						</div>
						<div class="col-md-6 text-center">
							<input type="text" class="" name="teacherNOInput" class="text-center" id="teacherNOInput" placeholder="教師編號" style="line-height: normal;" >  <button onClick="editData" class="btn" style="background-color: green;color:white;font-weight: 400;"> 捐助喜韓兒 </button>  <button onClick="deleteData()" class="btn" style="background-color: red;color:white;font-weight: 400;">  刪除資料 </button>
						</div>
						</div>
					</div>
-->

					
<!--
					<div class="panel-body">
						<form>
							<div class="form-group">
								
								<div class="row my-3" style="margin-top: 10px;">
									<div class="col-sm-2"></div>
									<div class="col-sm-8">
										<label for="editteacherNO" class="text-primary h4">教師編號</label>
										<input type="text" name="editteacherNO" id="editteacherNO" class="form-control text-center" placeholder="正在編輯：<?php echo '9527'; ?>" disabled>
										</select>
									</div>
									<div class="col-sm-2"></div>
								</div>
								
								<div class="row my-3" style="margin-top: 10px;">
									<div class="col-sm-2"></div>
									<div class="col-sm-8">
										<label for="editteacherSchool" class="text-primary h4">任職學校</label>
										<input type="text" name="editttacherSchool" id="editteacherSchool" class="form-control text-center" placeholder="目前資料：<?php echo '合太醬料'; ?>">
										</select>
									</div>
									<div class="col-sm-2 text-center">
									</div>
								</div>
						
								<div class="row my-3" style="margin-top: 10px;">
									<div class="col-sm-2"></div>
									<div class="col-sm-8">
										<label for="editteacherCollege" class="text-primary h4">院所</label>
										<input type="text" name="editttacherCollege" id="editteacherCollege" class="form-control text-center" placeholder="目前資料：<?php echo '我家後院'; ?>">
										</select>
									</div>
									<div class="col-sm-2"></div>
								</div>
					
								<div class="row my-3" style="margin-top: 10px;">
									<div class="col-sm-2"></div>
									<div class="col-sm-8">
										<label for="editteacherDepart" class="text-primary h4">科系</label>
										<input type="text" name="editttacherDepart" id="editteacherDepart" class="form-control text-center" placeholder="目前資料：<?php echo '吼哩系'; ?>">
										</select>
									</div>
									<div class="col-sm-2"></div>
								</div>
				
								<div class="row my-3" style="margin-top: 10px;">
									<div class="col-sm-2"></div>
									<div class="col-sm-8">
										<label for="editteacherType" class="text-primary h4">職務</label>
										<input type="text" name="editttacherType" id="editteacherType" class="form-control text-center" placeholder="目前資料：<?php echo '長老'; ?>">
										</select>
									</div>
									<div class="col-sm-2"></div>
								</div>
			
								<div class="row my-3" style="margin-top: 10px;">
									<div class="col-sm-2"></div>
									<div class="col-sm-8">
										<label for="editteacherName" class="text-primary h4">姓名</label>
										<input type="text" name="editttacherName" id="editteacherName" class="form-control text-center" placeholder="目前資料：<?php echo '小魏啦'; ?>">
										</select>
									</div>
									<div class="col-sm-2"></div>
								</div>
					
								<div class="row my-3" style="margin-top: 10px;">
									<div class="col-sm-2"></div>
									<div class="col-sm-8">
										<label for="editteacherPhone" class="text-primary h4">電話</label>
										<input type="text" name="editttacherPhone" id="editteacherPhone" class="form-control text-center" placeholder="目前資料：<?php echo '餓爸爸餓我餓我餓'; ?>">
										</select>
									</div>
									<div class="col-sm-2"></div>
								</div>
					
								<div class="row my-3" style="margin-top: 10px;">
									<div class="col-sm-2"></div>
									<div class="col-sm-8">
										<label for="editteacherEmail" class="text-primary h4">電子郵件</label>
										<input type="text" name="editttacherEmail" id="editteacherEmail" class="form-control text-center" placeholder="目前資料：<?php echo '不告訴逆雷'; ?>">
										</select>
									</div>
									<div class="col-sm-2"></div>
								</div>
			
								<div class="row my-3" style="margin-top: 10px;">
									<div class="col-sm-2"></div>
									<div class="col-sm-8">
										<label for="editRemarks" class="text-primary h4">備註事項</label>
										<textarea name="editRemarks" id="editRemarks" class="form-control" rows="4" placeholder="<?php echo '臣亮言：先帝創業未半，而中道崩殂。今天下三分，益州 疲弊，此誠危急存亡之秋也。然侍衛之臣，不懈於內；忠志之 士，忘身於外者，蓋追先帝之殊 ...'; ?>"></textarea>
									</div>
									<div class="col-sm-2"></div>
								</div>
							
							</div>
						</form>

						<div class="col mx-auto text-center my-5">
							<button onClick="" class="btn btn-lg" style="background-color:green;color:white;text-align: center;font-size: 16px;border: none;"><span class="glyphicon glyphicon-ok-sign"></span> 儲存修改資料</button>
						</div>

					</div>
-->
<!--
						<script>
						    $(function () {
						        $('#hover, #striped, #condensed').click(function () {
						            var classes = 'table';
						
						            if ($('#hover').prop('checked')) {
						                classes += ' table-hover';
						            }
						            if ($('#condensed').prop('checked')) {
						                classes += ' table-condensed';
						            }
						            $('#table-style').bootstrapTable('destroy')
						                .bootstrapTable({
						                    classes: classes,
						                    striped: $('#striped').prop('checked')
						                });
						        });
						    });
						
						    function rowStyle(row, index) {
						        var classes = ['active', 'success', 'info', 'warning', 'danger'];
						
						        if (index % 2 === 0 && index / 2 < classes.length) {
						            return {
						                classes: classes[index / 2]
						            };
						        }
						        return {};
						    }
						</script>
-->
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
	<script src="../controller/Division.js"></script>
	<script src="../controller/admin_teacherListAdd.js"></script>
	<script src="../controller/admin_teacherDataDelete.js"></script>

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

