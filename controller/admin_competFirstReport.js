// JavaScript Document
function firstReportFix() {
	//取得表單值
	var teamNO = $("#teamNOGet5").val();
	var firstReport = $("#firstReport").val();
	
$.ajax({
	
	url:"https://wmpcca.com/bswmp/form/model/admin_competFirstReport.php",
	data:{
		"teamNO" : teamNO,
		"firstReport" : firstReport
	},
	
	method : "POST",
	
	error : function(msg){
		$("#firstReportMsg").html(msg);
	},
	
	success : function(msg){
		$("#firstReportMsg").html(msg);
		$("#firstReportMsg").css('color', 'red');
		$("#firstReportMsg").css('font-weight', 'bold');

		if (msg === '資料已更新！'){
			window.location.reload();
		}
		
	}
	
});
	
}