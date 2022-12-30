function member1DeleteCollege() {
	//Checkbox
	var delData = confirm('確認刪除副手資料？');
	if (!delData){
		return;
	}
    var projectNO = $("#projectNO").val();
	var teamNO = $("#teamNO").val();
	var member1ID = $("#member1ID-College").val();

	
$.ajax({

	url:"https://wmpcca.com/bswmp/form/model/compet_member1DeleteCollege.php",
	data:{
		"projectNO" : projectNO,
		"teamNO" : teamNO,
		"identifyNO" : member1ID
	},

	method : "POST",

	error : function(msg){
		$("#member1Msg-College").html(msg);
	},

	success : function(msg){

		$("#member1Msg-College").html(msg);
		$("#member1Msg-College").css('color', 'red');
		$("#member1Msg-College").css('font-weight', 'bold');
		
		if (msg === '刪除成功'){
			setTimeout(function(){
			window.location.reload();
			},1000);
	}
}
	});	
		
}// JavaScript Document
