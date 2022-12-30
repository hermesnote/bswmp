// JavaScript Document// JavaScript Document
function viceAdd() {
	
	var projectNO= $("#projectNO").val();
	var capName= $("#capName").val();
	var capId = $("#capId").val();
	var capSN = $("#capSN").val();
	var capMobile = $("#capMobile").val();
	var capEmail = $("#capEmail").val();
	
	if( (capName == '')||(capId == '')||(capSN == '')||(capMobile == '')||(capEmail == '') ){
		alert('請確實填寫各項欄位');
		return;
	}
	
$.ajax({
	
	url:"https://wmpcca.com/bswmp/form/model/histock_HScapCHK.php",
	data:{
		"projectNO" : projectNO,
		"capName" : capName,
		"capId" : capId,
		"capSN" : capSN,
		"capMobile" : capMobile,
		"capEmail" : capEmail
	},
	
	method : "POST",
	
	error : function(Msg){
		alert(Msg);
	},
	
	success : function(Msg){
		
		if(Msg == 'nameWRG'){
			alert('姓名格式不符(僅限中英文不含阿拉伯數字及符號)');
			return;
		}
		if(Msg == 'emailWRG'){
			alert('Email格式不符');
			return;
		}
		if(Msg == 'EXT'){
			alert('不可重覆報名(有問題請致電協會)');
			return;
		}
		if (Msg == 'app'){
			$("#amountArea").fadeOut("fast"); // fadeOutAmountAre
			$("#capArea").fadeOut("fast"); // fadeOut隊長欄位
			$("#viceArea").fadeIn("slow"); // fadeIn副手欄位
			$("#memberArea").fadeOut("fast"); // fadeOut隊員欄位
			$("#confirmSub").fadeOut("fast"); // fadeOut提交欄位
		}
	}
	
});
	
}