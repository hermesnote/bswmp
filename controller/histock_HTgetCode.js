// JavaScript Document// JavaScript Document
function HTgetCode() {
"use strict";
	
	//Checkbox
		if(!$("#agreeCheck").prop("checked")){
			swal({
				title: "等等...似乎哪裡怪怪的...",
				text: "未勾選同意事項確認！",
				icon: "warning",
				button: "好的，我知道了",
			});
			return;
		}
	//buttonFail
	$(".buttonFail").prop('disabled', true);
		
//取得表單值
	var projectNO = $("#HTcompetprojectNO").val();
	var area = $("#histockDistrict").val();
	var city = $("#histockArea").val();
	var school = $("#histockSchool").val();
	var sex = $("#sex").val();
	var depart = $("#depart").val();
	var name = $("#name").val();
	var identifyNO = $("#identifyNO").val();
	var mobile = $("#mobile").val();
	var email = $("#email").val();
	var bach = $("#bach").val();
	
$.ajax({
	
	url:"https://wmpcca.com/bswmp/form/model/histock_HTgetCode.php",
	data:{
		"projectNO" : projectNO,
		"area" : area,
		"city" : city,
		"school" : school,
		"sex" : sex,
		"depart" : depart,
		"name" : name,
		"identifyNO" : identifyNO,
		"mobile" : mobile,
		"email" : email,
		"bach" : bach
	},
	
	method : "POST",
	
	error : function(Msg){
		alert(Msg);
	},
	
	success : function(Msg){
		
		if (Msg === "報名成功！"){
			swal({
				title: "報名成功！",
				text: Msg,
				icon: "success",
				button: "好的，我知道了",
			});
			window.location.href = "https://wmpcca.com/bswmp/form/view/histock_getCodeInfo.php";
		}else{
			swal({
				title: "等等...似乎哪裡怪怪的...",
				text: Msg,
				icon: "warning",
				button: "好的，我知道了",
			});
			//buttonFail-reBorn
			$(".buttonFail").prop('disabled', false);
			return;
		}
	}
	
});
	
}