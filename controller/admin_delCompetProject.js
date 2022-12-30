// JavaScript Document
function delCompetProject() {
	//取得表單值
	var projectNO = $("#deleteCompetList").val();

	
$.ajax({
	
	url:"https://wmpcca.com/bswmp/form/model/admin_delCompetProject.php",
	data:{
		"projectNO" : projectNO
	},
	
	method : "POST",
	
	error : function(msg){
		$("#delCompetDateResult").html(msg);
	},
	
	success : function(msg){
		$("#delCompetDateResult").html(msg);
		$("#delCompetDateResult").css('color', 'red');
		$("#delCompetDateResult").css('font-weight', 'bold');

		if (msg === '刪除成功！'){
			window.location.reload();
		}
		
	}
	
});
	
}