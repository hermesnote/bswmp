// JavaScript Document
function score1() {
	//取得表單值
	var teamNO = $("#teamNOGet1").val();
	var firstScore = $("#firstScore").val();
	
$.ajax({
	
	url:"https://wmpcca.com/bswmp/form/model/admin_competScore1.php",
	data:{
		"teamNO" : teamNO,
		"firstScore" : firstScore
	},
	
	method : "POST",
	
	error : function(msg){
		$("#scoreMsg1").html(msg);
	},
	
	success : function(msg){
		$("#scoreMsg1").html(msg);
		$("#scoreMsg1").css('color', 'red');
		$("#scoreMsg1").css('font-weight', 'bold');

		if (msg === '資料已更新！'){
			window.location.reload();
		}
		
	}
	
});
	
}