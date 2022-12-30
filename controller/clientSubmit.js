function clientSubmit() {
	//取得表單值
	var clientName = $("#clientName").val();
	var clientPhone = $("#clientPhone").val();
	var clientEmail = $("#clientEmail").val();
	
$.ajax({
	
	url:"https://wmpcca.com/bswmp/form/model/clientSubmit.php",
	data:{
		"clientName" : clientName,
		"clientPhone" : clientPhone,
		"clientEmail" : clientEmail
	},
	
	method : "POST",
	
	error : function(msg){
		$("#clientSubmitMsg").html(msg);
	},
	
	success : function(msg){
		$("#clientSubmitMsg").html(msg);
		$("#clientSubmitMsg").css('color', 'red');
		$("#clientSubmitMsg").css('font-weight', 'bold');

		if (msg === '已收到您的申請！請留意專人與您聯絡！'){
		$("#clientSubmitMsg").html(msg);
		$("#clientSubmitMsg").css('color', 'red');
		$("#clientSubmitMsg").css('font-weight', 'bold');
		}
		
	}
	
});
	
}