// JavaScript Document// JavaScript Document
function amountCHK() {
	
	var projectNO= $("#projectNO").val();
	var amount= $("#amount").val();
	var conference = $("#conference").val();
	var city = $("#city").val();
	var hischool = $("#hischool").val();
	var teacher = $("#teacherName").val();
	var teamName = $("#teamName").val();
	
	if( (conference == '')||(city == '')||(hischool == '')||(teacher == '')||(teamName == '') ){
		alert('請確實填寫各項欄位');
		return;
	}
	
	
	
$.ajax({
	
	url:"https://wmpcca.com/bswmp/form/model/histock_HSamountCHK.php",
	data:{
		"projectNO" : projectNO,
		"amount" : amount,
		"conference" : conference,
		"city" : city, 
		"hischool" : hischool,
		"teacher" : teacher,
		"teamName" : teamName
	},
	
	method : "POST",
	
	error : function(Msg){
		alert(Msg);
	},
	
	success : function(Msg){
		if (Msg == 'full'){
			alert('該校已滿額');
			}
		if (Msg == 'teamNameWRG'){
			alert('隊名格式不符');
			}
		if (Msg == 'dup'){
			alert('隊名已被使用');
			}
		if (Msg == 'app'){
			$("#amountArea").fadeOut("fast"); // fadeOut 學校區域
			$("#capArea").fadeIn("slow"); // fadeIn 隊長區域
			$("#viceArea").fadeOut("fast"); // fadeOut 副手區域
			$("#memArea").fadeOut("fast"); // fadeOut 隊員區域
			$("#confirmSub").fadeOut("fast"); // fadeOut 提交區域
		}
	}
	
});
	
}