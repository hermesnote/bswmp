// JavaScript Document
function score2() {
	//取得表單值
	var teamNO = $("#teamNOGet2").val();
	var secondScore = $("#secondScore").val();
	
$.ajax({
	
	url:"https://wmpcca.com/bswmp/form/model/admin_competScore2.php",
	data:{
		"teamNO" : teamNO,
		"secondScore" : secondScore
	},
	
	method : "POST",
	
	error : function(msg){
		$("#scoreMsg2").html(msg);
	},
	
	success : function(msg){
		$("#scoreMsg2").html(msg);
		$("#scoreMsg2").css('color', 'red');
		$("#scoreMsg2").css('font-weight', 'bold');

		if (msg === '資料已更新！'){
			window.location.reload();
		}
		
	}
	
});
	
}