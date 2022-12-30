function member1DeleteHiStock() {
	//Checkbox
	var delData = confirm('確認刪除副手資料？');
	if (!delData){
		return;
	}
    var projectNO = $("#projectNO").val();
	var teamNO = $("#teamNO").val();
	var member1ID = $("#member1ID-HiStock").val();


$.ajax({

	url:"https://wmpcca.com/bswmp/form/model/histock_member1Delete.php",
	data:{
		"projectNO" : projectNO,
		"teamNO" : teamNO,
		"identifyNO" : member1ID
	},

	method : "POST",

	error : function(msg){
		$("#member1Msg-HiStock").html(msg);
	},

	success : function(msg){

		$("#member1Msg-HiStock").html(msg);
		$("#member1Msg-HiStock").css('color', 'red');
		$("#member1Msg-HiStock").css('font-weight', 'bold');
		
		if (msg === '刪除成功'){
			setTimeout(function(){
			window.location.reload();
			},1000);
	}
}
	});	
		
}// JavaScript Document
