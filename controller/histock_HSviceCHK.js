// JavaScript Document// JavaScript Document
function memAdd() {
	
	var projectNO= $("#projectNO").val();
	var viceName= $("#viceName").val();
	var viceId = $("#viceId").val();
	var viceSN = $("#viceSN").val();
	var viceMobile = $("#viceMobile").val();
	var viceEmail = $("#viceEmail").val();
	
	if( (viceName == '')||(viceId == '')||(viceSN == '')||(viceMobile == '')||(viceEmail == '') ){
		alert('請確實填寫各項欄位');
		return;
	}
	
	// 檢核同次重覆報名 對隊長
	var capId = $("#capId").val()
	if( capId === viceId ){
		alert('副手不可與隊長為同一人!');
	}
	
$.ajax({
	
	url:"https://wmpcca.com/bswmp/form/model/histock_HSviceCHK.php",
	data:{
		"projectNO" : projectNO,
		"viceName" : viceName,
		"viceId" : viceId,
		"viceSN" : viceSN,
		"viceMobile" : viceMobile,
		"viceEmail" : viceEmail
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
			$("#amountArea").fadeOut("fast"); // fadeOut學校區域
			$("#capArea").fadeOut("fast"); // fadeOut隊長區域
			$("#viceArea").fadeOut("fast"); // fadeOut副手區域
			$("#memArea").fadeIn("slow"); // fadeIn隊員區域
			$("#confirmSub").fadeOut("fast"); // fadeOut提交區域
		}
	}
	
});
	
}