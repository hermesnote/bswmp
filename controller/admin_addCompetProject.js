// JavaScript Document
function addCompetProject() {
	//buttonFail
	$(".buttonFail").attr('disabled', 'disabled');

	//取得表單值
	var projectName = $("#addCompetProjectSelect").val();
	var competStartDate = $("#competStartDate").val();
	var competEndDate = $("#competEndDate").val();
	var payStartDate = $("#payStartDate").val();
	var payEndDate = $("#payEndDate").val();
	var report1Date = $("#report1Date").val();
	var report2Date = $("#report2Date").val();
	var downloadLink = $("#downloadLink").val();
	var selectSurvey = $("#selectSurvey").val();

	
$.ajax({
	
	url:"https://wmpcca.com/bswmp/form/model/admin_addCompetProject.php",
	data:{
		"projectName" : projectName,
		"competStartDate" : competStartDate,
		"competEndDate" : competEndDate,
		"payStartDate" : payStartDate,
		"payEndDate" : payEndDate,
		"report1Date" : report1Date,
		"report2Date" : report2Date,
		"downloadLink" : downloadLink,
		"selectSurvey" : selectSurvey
	},
	
	method : "POST",
	
	error : function(msg){
		$("#addCompetDateResult").html(msg);
	},
	
	success : function(msg){
		$("#addCompetDateResult").html(msg);
		$("#addCompetDateResult").css('color', 'red');
		$("#addCompetDateResult").css('font-weight', 'bold');

		if (msg === '資料已更新！'){
			window.location.reload();
		}
		
	}
	
});
	
}