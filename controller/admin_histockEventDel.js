// JavaScript Document
function eventDel() {
	//buttonFail
	$(".buttonFail").attr('disabled', 'disabled');
	
	//取得表單值
	var projectNO = $("#eventProjectNO").val();

	
$.ajax({
	
	url:"https://wmpcca.com/bswmp/form/model/admin_histockEventDel.php",
	data:{
		"projectNO" : projectNO
	},
	
	method : "POST",
	
	error : function(msg){
		$("#resultMsg").html(msg);
	},
	
	success : function(msg){
		$("#resultMsg").html(msg);
		$("#resultMsg").css('color', 'red');
		$("#resultMsg").css('font-weight', 'bold');
		
		alert(msg);
		window.location.reload();

//		if (msg === '刪除成功！'){
//			window.location.reload();
//		}
		
	}
	
});
	
}