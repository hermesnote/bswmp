// JavaScript Document
function deleteData(){
//取得表單值
var teacherNOInput = $("#teacherNOInput").val();

$.ajax({
	
	url:"https://wmpcca.com/bswmp/form/model/admin_teacherListDelete.php",
	data:{
		"teacherNOInput" : teacherNOInput,
	},
	
	method : "POST",
	
	error : function(msg){
		$("#editMsg").html(msg);
	},
	
	success : function(msg){
		$("#editMsg").html(msg);
		$("#editMsg").css('color', 'red');
		$("#editMsg").css('font-weight', 'bold');
	}
	
});
	
}