// JavaScript Document
function secondReportFix() {
	//取得表單值
	var teamNO = $("#teamNOGet6").val();
	var secondReport = $("#secondReport").val();
	
$.ajax({
	
	url:"https://wmpcca.com/bswmp/form/model/admin_competSecondReport.php",
	data:{
		"teamNO" : teamNO,
		"secondReport" : secondReport
	},
	
	method : "POST",
	
	error : function(msg){
		$("#secondReportMsg").html(msg);
	},
	
	success : function(msg){
		$("#secondReportMsg").html(msg);
		$("#secondReportMsg").css('color', 'red');
		$("#secondReportMsg").css('font-weight', 'bold');

		if (msg === '資料已更新！'){
			window.location.reload();
		}
		
	}
	
});
	
}