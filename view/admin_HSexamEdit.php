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


//定義refund搜尋條件
$list1 = mysql_query("select * from examDB_hiStock");

//取得目前全題庫數量
$sqlgetAllNumber = mysql_query(" SELECT * FROM examDB_hiStock ");
$getAllNumber = mysql_num_rows($sqlgetAllNumber);

//取得現有模擬題數
$sqlgetAllMock = mysql_query(" SELECT * FROM examDB_hiStock WHERE mock = 'Y' ");
$getAllMock = mysql_num_rows($sqlgetAllMock);

//取得現有A分類及A模擬
$sqlgetcategoryANumber = mysql_query(" SELECT * FROM examDB_hiStock WHERE category = 'A' ");
$getcategoryANumber = mysql_num_rows($sqlgetcategoryANumber);
$sqlgetcategoryAMock = mysql_query(" SELECT * FROM examDB_hiStock WHERE category = 'A' AND mock = 'Y' ");
$getcategoryAMock = mysql_num_rows($sqlgetcategoryAMock);

//取得現有B分類及B模擬
$sqlgetcategoryBNumber = mysql_query(" SELECT * FROM examDB_hiStock WHERE category = 'B' ");
$getcategoryBNumber = mysql_num_rows($sqlgetcategoryBNumber);
$sqlgetcategoryBMock = mysql_query(" SELECT * FROM examDB_hiStock WHERE category = 'B' AND mock = 'Y' ");
$getcategoryBMock = mysql_num_rows($sqlgetcategoryBMock);

//取得現有C分類及C模擬
$sqlgetcategoryCNumber = mysql_query(" SELECT * FROM examDB_hiStock WHERE category = 'C' ");
$getcategoryCNumber = mysql_num_rows($sqlgetcategoryCNumber);
$sqlgetcategoryCMock = mysql_query(" SELECT * FROM examDB_hiStock WHERE category = 'C' AND mock = 'Y' ");
$getcategoryCMock = mysql_num_rows($sqlgetcategoryCMock);

//取得現有D分類及D模擬
$sqlgetcategoryDNumber = mysql_query(" SELECT * FROM examDB_hiStock WHERE category = 'D' ");
$getcategoryDNumber = mysql_num_rows($sqlgetcategoryDNumber);
$sqlgetcategoryDMock = mysql_query(" SELECT * FROM examDB_hiStock WHERE category = 'D' AND mock = 'Y' ");
$getcategoryDMock = mysql_num_rows($sqlgetcategoryDMock);

//取得現有E分類及E模擬
$sqlgetcategoryENumber = mysql_query(" SELECT * FROM examDB_hiStock WHERE category = 'E' ");
$getcategoryENumber = mysql_num_rows($sqlgetcategoryENumber);
$sqlgetcategoryEMock = mysql_query(" SELECT * FROM examDB_hiStock WHERE category = 'E' AND mock = 'Y' ");
$getcategoryEMock = mysql_num_rows($sqlgetcategoryEMock);

//取得現有F分類及F模擬
$sqlgetcategoryFNumber = mysql_query(" SELECT * FROM examDB_hiStock WHERE category = 'F' ");
$getcategoryFNumber = mysql_num_rows($sqlgetcategoryFNumber);
$sqlgetcategoryFMock = mysql_query(" SELECT * FROM examDB_hiStock WHERE category = 'F' AND mock = 'Y' ");
$getcategoryFMock = mysql_num_rows($sqlgetcategoryFMock);



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

<style>
	.hidden{
		display: none;
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
				<li>金融證券實務/題庫操作</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">題庫操作</h1>
			</div>
		</div><!--/.row-->


<!-- 題庫列表 -->
		<div class="row">
			<div class="col-md-12" id="manageArea">
				<div class="panel panel-default">
					
					<div class="panel-heading text-center" style="color:darkred;font-weight: bold;font-size: 22px;font-family: Microsoft JhengHei;">
						<span id="">題庫列表</span>
					</div>
			
					<div class="panel-body">
						
						<div style="padding-bottom: 10px;">
							<table class="text-center" border="1" width="100%">
								<tr>
									<td width="30%">項目／題型／數量</td>
									<td width="10%">分類Ａ</td>
									<td width="10%">分類Ｂ</td>
									<td width="10%">分類Ｃ</td>
									<td width="10%">分類Ｄ</td>
									<td width="10%">分類Ｅ</td>
									<td width="10%">分類Ｆ</td>
									<td width="10%">小計</td>
								</tr>
								<tr>
									<td>模擬試題</td>
									<td><? echo $getcategoryAMock; ?></td>
									<td><? echo $getcategoryBMock; ?></td>
									<td><? echo $getcategoryCMock; ?></td>
									<td><? echo $getcategoryDMock; ?></td>
									<td><? echo $getcategoryEMock; ?></td>
									<td><? echo $getcategoryFMock; ?></td>
									<td><? echo $getAllMock; ?></td>
								</tr>
								<tr>
									<td>標準試題</td>
									<td><? echo $getcategoryANumber; ?></td>
									<td><? echo $getcategoryBNumber; ?></td>
									<td><? echo $getcategoryCNumber; ?></td>
									<td><? echo $getcategoryDNumber; ?></td>
									<td><? echo $getcategoryENumber; ?></td>
									<td><? echo $getcategoryFNumber; ?></td>
									<td><? echo $getAllNumber; ?></td>
								</tr>
							</table>
						</div>
						
						<table id="examDBForm" class="table table-hover table-striped table-bordered text-center" style="100%">
							<thead class="thead-dark bg-info">
								<tr>
									<th class="text-center">ID</th>
									<th class="text-center">入庫時間</th>
									<th class="text-center">分類</th>
									<th class="text-center">題號</th>
									<th class="text-left">題目</th>
									<th class="text-left">選項A</th>
									<th class="text-left">選項B</th>
									<th class="text-left">選項C</th>
									<th class="text-left">選項D</th>
									<th class="text-center">答案</th>
									<th class="text-center">模擬</th>
									<th class="text-center">備註</th>
								</tr>
							</thead>
							<tbody>	
								
							<?php
							for ($i=1; $i<=mysql_num_rows($list1); $i++) {
								$row=mysql_fetch_row($list1);
							?>

								<tr>
									<td><?php echo $row[0];?></td>
									<td><?php echo $row[1];?></td>
									<td><?php echo $row[2];?></td>
									<td onclick="numberSelect(this)"><?php echo $row[3];?></td>
									<td><?php echo $row[4];?></td>
									<td><?php echo $row[5];?></td>
									<td><?php echo $row[6];?></td>
									<td><?php echo $row[7];?></td>
									<td><?php echo $row[8];?></td>
									<td><?php echo $row[9];?></td>
									<td><?php echo $row[10];?></td>
									<td><?php echo $row[11];?></td>
								</tr>

							<?php }?>
							</tbody>
						</table>
					</div>
					
				</div>
			</div>
		</div>
		

		
<!-- 編修題庫 -->
		<div class="row">
			
			<div class="col-md-12" id="">
				<div class="panel panel-default">
					
					<div class="panel-heading text-center" style="color:darkred;font-weight: bold;font-size: 22px;font-family: Microsoft JhengHei;">
						<span id="">編修題庫</span>
					</div>

					<div class="panel-body" style="border-bottom: 1px #E0E0E0 solid;">
						<div class="row mx-auto text-center">
							<div class="col-md-6 mx-auto text-center">
								<input type="text" placeholder="輸入4碼題號或以滑鼠點選上方列表題號" id="numberGet1" size="35">
								<select id="getEditOption">
									<option value="0">選擇操作功能...</option>
									<option value="1">設為模擬題庫</option>
									<option value="2">取消模擬題庫</option>
									<option value="3">修改題目</option>
									<option value="4">修改選項A</option>
									<option value="5">修改選項B</option>
									<option value="6">修改選項C</option>
									<option value="7">修改選項D</option>
									<option value="8">變更答案</option>
									<option value="9">刪除此題</option>
								</select>
								<button class="btn-info" id="editButton" onClick="goEdit()">繼續</button>
								<div style="margin-top: 10px;"><span id="goEditMsg" style="color: red;"></span></div>
							</div>
							
							<div class="col-md-6 mx-auto text-center">
								
								<div>當前編修：題號 <span id="showEditNumber"></span> 的 <span id="showEditOption"></span></div><input type="hidden" value="" id="editChoiceHidden">
								
								<div id="editTopicArea">
									<textarea rows="5" cols="50" id="getReturn" value=""></textarea>
								</div>
								
								<div>
									<button id="editButton" onClick="goEditOption()">確認</button>
								</div>
								
								<div><span id="editReturnMsg"></span></div>
								
							</div>
							
						</div>
					</div>
				
				</div>
			</div>
		</div>
			
		
<!-- 新增題庫 -->
		<div class="row authority0" style="display: none;">
			<div class="col-md-12" id="manageArea">
				<div class="panel panel-default">
					
					<div class="panel-heading text-center" style="color:darkred;font-weight: bold;font-size: 22px;font-family: Microsoft JhengHei;">
						<span id="">新增題庫</span>
					</div>
			
					<div class="panel-body">
						<form name="addQuestionRow">
							<table>
								
								<tr style="padding-top: 20px;">
									<td>
										<label>分類：</label>
									</td>
									<td>
										<select namee="selectcategory" id="selectcategory">
											<option value="A">金融機構意義與種類【代號A，共<? echo $getcategoryANumber; ?>題，模擬<? echo $getcategoryAMock; ?>題】</option>
											<option value="B">金融市場意義、種類及商品工具【代號B，共<? echo $getcategoryBNumber; ?>題，模擬<? echo $getcategoryBMock; ?>題】</option>
											<option value="C">證券市場種類、台灣股市結構及交易制度【代號C，共<? echo $getcategoryCNumber; ?>題，模擬<? echo $getcategoryCMock; ?>題】</option>
											<option value="D">股市與基金基本面、技術面分析及其他影響因素【代號D，共<? echo $getcategoryDNumber; ?>題，模擬<? echo $getcategoryDMock; ?>題】</option>
											<option value="E">銀行種類(如：中央銀行、商業銀行等)【代號E，共<? echo $getcategoryENumber; ?>題，模擬<? echo $getcategoryEMock; ?>題】</option>
											<option value="F">貨幣的時間價值、利率的基本認識及種類【代號F，共<? echo $getcategoryFNumber; ?>題，模擬<? echo $getcategoryFMock; ?>題】</option>
										</select>
										
									</td>
								</tr>
								
								<tr>
									<td>
										<label>題號：</label>
									</td>
									<td>
										<input type="text" name="inputNumber" id="inputNumber" size="30">
									</td>
								</tr>
								
								<tr>
									<td>
										<label>題目：</label>
									</td>
									<td>
										<input type="text" name="inputTopic" id="inputTopic" size="100">
									</td>
								</tr>
								
								<tr>
									<td>
										<label>選項A：</label>
									</td>
									<td>
										<input type="text" nam="inputChoiceA" id="inputChoiceA" size="100">
									</td>
								</tr>

								<tr>
									<td>
										<label>選項B：</label>
									</td>
									<td>
										<input type="text" nam="inputChoiceB" id="inputChoiceB" size="100">
									</td>
								</tr>
								
								<tr>
									<td>
										<label>選項C：</label>
									</td>
									<td>
										<input type="text" nam="inputChoiceC" id="inputChoiceC" size="100">
									</td>
								</tr>
								
								<tr>
									<td>
										<label>選項D：</label>
									</td>
									<td>
										<input type="text" nam="inputChoiceD" id="inputChoiceD" size="100%">
									</td>
								</tr>

								<tr>
									<td>
										<label>答案：</label>
									</td>
									<td>
										<select name="selectAnswer" id="selectAnswer">
											<option value="A">A</option>
											<option value="B">B</option>
											<option value="C">C</option>
											<option value="D">D</option>
										</select>
									</td>
								</tr>
								
								<tr>
									<td>
										<label>模擬：</label>
									</td>
									<td>
										<select name="selectMock" id="selectMock">
											<option value="">否</option>
											<option value="Y">是</option>
										</select>
									</td>
								</tr>
								
								<tr>
									<td></td>
									<td class="text-right">
										<button class="buttonFail" onClick="addNewQuestion()">新增</button>
									</td>
								</tr>
								
								<tr>
									<td></td>
									<td class="text-center" id="addNewMsg"></td>
								</tr>
								
							</table>
						</form>
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

<!-- DataTables v1.10.16 -->
	<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>


<!-- 自定義JS -->
	<script src="../controller/admin_authority.js"></script>

	<!-- DataTables -->
<script>
	$("#examDBForm").dataTable({
		"order": [[ 0, "asc" ]],
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


	<!-- 編修取得return -->
<script>
	//點擊取號
	function numberSelect(event){
		var str = $(event).text()
		$("#numberGet1").val(str)
	}
	
	//調用修改
	function goEdit(){
		
		var getEditNumber = $("#numberGet1").val();
		var getEditOption = $("#getEditOption").val();
		if(getEditOption == 3){
			$("#editChoiceHidden").val("topic");
			$("#showEditNumber").html(getEditNumber);
			$("#showEditOption").html("題目");
		   }
		if(getEditOption == 4){
			$("#editChoiceHidden").val("choiceA");
			$("#showEditNumber").html(getEditNumber);
			$("#showEditOption").html("選項A");
		   }
		if(getEditOption == 5){
			$("#editChoiceHidden").val("choiceB");
			$("#showEditNumber").html(getEditNumber);
			$("#showEditOption").html("選項B");
		   }
		if(getEditOption == 6){
			$("#editChoiceHidden").val("choiceC");
			$("#showEditNumber").html(getEditNumber);
			$("#showEditOption").html("選項C");
		   }
		if(getEditOption == 7){
			$("#editChoiceHidden").val("choiceD");
			$("#showEditNumber").html(getEditNumber);
			$("#showEditOption").html("選項D");
		   }
		if(getEditOption == 8){
			$("#editChoiceHidden").val("answer");
			$("#showEditNumber").html(getEditNumber);
			$("#showEditOption").html("答案");
		   }
		
	$.ajax({

		url:"https://wmpcca.com/bswmp/form/model/admin_goEditHiStockExamDB.php",
		data:{
			"number" : getEditNumber,
			"option" : getEditOption
		},

		method : "POST",

		error : function(msg){
			$("#goEditMsg").html(msg);
		},

		success : function(msg){
			
			if ( (msg == "請輸入題號或由上方列表點選！")||(msg == "請選擇要操作的項目！")||(msg == "模擬試題已達100題！請先刪除再新增！") ){
				$("#goEditMsg").html(msg);
			}else if (msg == "操作成功！"){
				$("#goEditMsg").html(msg);
				window.location.reload();
			}else{
			$("#getReturn").val(msg);	
			}
		}

		});			
	}
	
	//修改調用項目
	function goEditOption(){
		
		var getEditNumber = $("#numberGet1").val();
		var editOption = $("#getReturn").val();
		var option = $("#editChoiceHidden").val();
		
	$.ajax({

		url:"https://wmpcca.com/bswmp/form/model/admin_editHiStockExamDB.php",
		data:{
			"number" : getEditNumber,
			"edit" : editOption,
			"option" : option
		},

		method : "POST",

		error : function(msg){
			$("#goEditMsg").html(msg);
		},

		success : function(msg){
			alert('修改成功！系統將自動更新頁面!');
			window.location.reload();
		}

		});	
		
	}
</script>
	
	<!-- 新增題庫 -->
<script>
	
	function addNeweQuestion(){
	
	//buttonFail
	$(".buttonFail").attr('disabled', 'disabled');
	
	//取得表單值
	var category = ("#selectcategory").val();
	var number = ("#inputNumber").val();
	var topic = ("#inputTopic").val();
	var choiceA = ("#inputChoiceA").val();
	var choiceB = ("#inputChoiceB").val();
	var choiceC = ("#inputChoiceC").val();
	var choiceD = ("#inputChoiceD").val();
	var answer = ("#selectAnswer").val();
	var mock = ("#selectMock").val();
	
	$.ajax({

		url:"https://wmpcca.com/bswmp/form/model/admin_addHiStockExamDB.php",
		data:{
			"category" : category,
			"number" : number,
			"topic" : topic,
			"choiceA" : choiceA,
			"choiceB" : choiceB,
			"choiceC" : choiceC,
			"choiceD" : choiceD,
			"answer" : answer,
			"mock" : mock
		},

		method : "POST",

		error : function(msg){
			$("#addNewMsg").html(msg);
		},

		success : function(msg){
			$("#addNewMsg").html(msg);
			$("#addNewMsg").css('color', 'red');
			$("#addNewMsg").css('font-weight', 'bold');

			if (msg === '資料已更新！'){
				window.location.reload();
			}

		}

	});
		
}
	
</script>

</body>

</html>

