// JavaScript Document
function score3() {
	//取得表單值
	var score3 = $("#inputScore3").val();
	var teamNO = $("#teamNOGet3").val();
	
$.ajax({
	
	url:"https://wmpcca.com/bswmp/form/model/admin_competScore3.php",
	data:{
		"teamNO" : teamNO,
		"score3" : score3
	},
	
	method : "POST",
	
	error : function(msg){
		$("#scoreMsg3").html(msg);
	},
	
	success : function(msg){
		$("#scoreMsg3").html(msg);
		$("#scoreMsg3").css('color', 'red');
		$("#scoreMsg3").css('font-weight', 'bold');

		if (msg === '資料已更新！'){
			window.location.reload();
		}
		
	}
	
});
	
}