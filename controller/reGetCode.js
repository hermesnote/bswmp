// JavaScript Document// JavaScript Document
function reGetCode() {
	//取得表單值
	var projectNO = $("#deleteCompetList").val();

	
$.ajax({
	
	url:"https://wmpcca.com/bswmp/form/view/compet_reGetCodeSent.php",
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

		if (msg === '已重新發送'){
			window.location.reload();
		}
		
	}
	
});
	
}