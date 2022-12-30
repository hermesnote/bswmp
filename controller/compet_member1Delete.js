function member1Delete() {
	//Checkbox
	var delData = confirm('確認刪除副手資料？');
	if (!delData){
		return;
	}
    var projectNO = $("#projectNO").val();
	var teamNO = $("#teamNO").val();
	var member1ID = $("#member1ID").val();

	
$.ajax({

	url:"https://wmpcca.com/bswmp/form/model/compet_member1Delete.php",
	data:{
		"projectNO" : projectNO,
		"teamNO" : teamNO,
		"identifyNO" : member1ID
	},

	method : "POST",

	error : function(msg){
		$("#member1Msg").html(msg);
	},

	success : function(msg){

		$("#member1Msg").html(msg);
		$("#member1Msg").css('color', 'red');
		$("#member1Msg").css('font-weight', 'bold');
		
		if (msg === '刪除成功'){
			setTimeout(function(){
			window.location.reload();
			},1000);
		}
	}

	});	
		
}// JavaScript Document
