// JavaScript Document
function chkAdminRegister() {

//	//【到職日是否為空】
//	if (document.staffSignupForm.arrival.value === "") {
//		alert("請選擇到職日！");
//		return false;
//	}
//	//【職務名稱是否為空】
//	if (document.staffSignupForm.postTitle.value === "") {
//		alert("請填寫職務名稱！");
//		return false;
//	}	
//	//【姓名是否為空】
//	if (document.staffSignupForm.staffName.value === "") {
//		alert("請填寫姓名！");
//		return false;
//	}
//	//【身份證字號是否為空】
	if (document.staffSignupForm.identifyNO.value === "") {
		alert("請填寫身份證字號！");
		return false;
	}
//	//【稱謂是否為空】
//	if (document.staffSignupForm.staffSex.value === "") {
//		alert("請選擇稱謂！");
//		return false;
//	}
//	//【生日是否為空】
//	if (document.staffSignupForm.staffBirth.value === "") {
//		alert("請選擇生日！");
//		return false;
//	}
//	//【LINE ID是否為空】
//	if (document.staffSignupForm.staffLineID.value === "") {
//		alert("請填寫LINE ID！");
//		return false;
//	}
//	//【最高學歷是否為空】
//	if (document.staffSignupForm.staffDegree.value === "") {
//		alert("請選擇最高學歷！");
//		return false;
//	}
//	//【行動電話是否為空】
//	if (document.staffSignupForm.staffPhone.value === "") {
//		alert("請填寫行動電話！");
//		return false;
//	}
//	//【Email是否為空】
//	if (document.staffSignupForm.staffEmail.value === "") {
//		alert("請填寫Email！");
//		return false;
//	}
//	//【通訊地-城市是否為空】
//	if (document.staffSignupForm.staffCity.value === "") {
//		alert("請選擇通訊地-城市！");
//		return false;
//	}
//	//【通訊地-行政區是否為空】
//	if (document.staffSignupForm.staffDistrict.value === "") {
//		alert("請選擇通訊地-行政區！");
//		return false;
//	}
//	//【通訊地址是否為空】
//	if (document.staffSignupForm.staffAddr.value === "") {
//		alert("請填寫通訊地址！");
//		return false;
//	}
//	//【登入使用帳號是否為空】
	if (document.staffSignupForm.account.value === "") {
		alert("請選擇登入使用帳號！");
		return false;
	}
//	//【密碼是否為空】
//	if (document.staffSignupForm.pwd.value === "") {
//		alert("請填寫密碼！");
//		return false;
//	}
	//【確認密碼是否為空】
	if (document.staffSignupForm.pwd2.value === "") {
		alert("請填寫確認密碼！");
		return false;
	}
	//如果密碼確認不同
	if (document.staffSignupForm.pwd.value !== document.staffSignupForm.pwd2.value) {
		alert("輸入密碼不同！請確認！");
		return false;
	}	
	
	staffSignupForm.submit();
}
