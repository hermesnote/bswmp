function chkCCForm() {

    //【同意是否有打勾】
    if (document.getElementById("agreeRules").checked == false)
    {
        alert("請詳閱各項辦法及規則和保護政策後，於報名表單末勾選「同意事項」後方能報名！");
        return false;
    }

	/******************  隊伍報名資訊  ******************/

	//【隊名是否為空】
	if (document.ccSignupForm.teamName.value === "") {
		alert("「隊伍名稱」不可為空！");
		return false;
	}
	// 【隊名中文字元限制】
	var limitWords = ['亡', '死', '殺', '毒', '幹', '娘', '媽', '爸', '廢', '糞', '尿', '屎', '操', '雞', '掰', '殘', '肛', '投顧', '證券', '投信', '信託', '銀行', '保險', '人壽', '保經', '保代', '事業', '低能', '智障', '智缺', '腦殘', '腦包', '腦死', '通訊', '中出', '內射', '卵蛋', '月工', 'fuck', 'damn', 'shit', 'stupid', 'troll', 'fool', 'idiot', 'drug'];
	var wordsCheck = function (string) {
		for (var i = 0; i < limitWords.length; i++) {
			if (string.indexOf(limitWords[i]) > -1) {
				return true;
			}
		}
		return false;
	};

	// 【隊名符號字元限制】
	var tn = document.getElementById("teamName").value.trim();
	if (wordsCheck(tn)) {
		alert("「參賽隊名」使用了限制字元！請慎取隊名！");
		return false;
	}
	// 【隊名僅能為中英文和數字組合】
	var reg = new RegExp("^[A-Za-z0-9\u4e00-\u9fa5]+$");
	var teamName = document.getElementById("teamName").value.trim();
	if (!reg.test(teamName)) {
		alert("「參賽隊名」僅能輸入中文、英文和數字的組合！");
		return false;
	}
	
	// 【學校分區是否為空】
	if (document.ccSignupForm.schoolDistrict.value === "") {
		alert("請選擇學校所在地區!");
		return false;
	}

	// 【代表學校是否為空】
	if (document.ccSignupForm.schoolPre.value === "") {
		alert("請選擇代表學校!");
		return false;
	}

	// 【指導老師是否為空】
	if (document.ccSignupForm.directTeacher.value === "") {
		alert("請填寫指導老師大名!");
		return false;
	}

	// 【收據抬頭是否為空】
	if (document.ccSignupForm.receiptTitle.value === "") {
		alert("請選擇收據抬頭(繳款人)!");
		return false;
	}

/******************  隊長報名資訊  ******************/

	// 【隊長姓名是否為空】
	if (document.ccSignupForm.captainName.value === "") {
		alert("「隊長」請填寫「姓名」!");
		return false;
	}

	// 【隊長稱謂是否為空】
	if (document.ccSignupForm.captainSex.value === "") {
		alert("「隊長」請選擇「稱謂」!");
		return false;
	}

	// 【隊長身份證字號是否為空】
	if (document.ccSignupForm.captainID.value === "") {
		alert("「隊長」請填寫「身份證字號」!");
		return false;
	}

	// 【隊長生日是否為空】
	if (document.ccSignupForm.captainBirth.value === "") {
		alert("「隊長」請選擇「生日」!");
		return false;
	}
	
	// 【隊長行動電話是否為空】
	if (document.ccSignupForm.captainPhone.value === "") {
		alert("「隊長」請填寫「行動電話」!");
		return false;
	}	

	// 【隊長手機號碼格式是否正確】
    if (!(/^09\d{8}$/).test(ccSignupForm.captainPhone.value))
    {
        alert("「隊長」請輸入正確的行動電話格式！");
        aForm.mobile.focus();
        return false;
    }	
	
	// 【隊長Email是否為空】
	if (document.ccSignupForm.captainEmail.value === "") {
		alert("「隊長」請填寫「Email」(※gmail或其它非免費信箱)!");
		return false;
	}
	
    // 【隊長email格式是否正確】
    var strEmail = ccSignupForm.captainEmail.value;
    emailRule = /^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z]+$/;
    if (strEmail.search(emailRule) == -1)
    {
        alert("「隊長」email格式有誤！");
        return false;
    }	
	
	// 【隊長通訊地-城市是否為空】
	if (document.ccSignupForm.captainCity.value === "") {
		alert("「隊長」請選擇「通訊地-城市」!");
		return false;
	}
	
	// 【隊長通訊地-行政區是否為空】
	if (document.ccSignupForm.captainDistrict.value === "") {
		alert("「隊長」請選擇「通訊地-行政區」!");
		return false;
	}
	
	// 【隊長通訊地址是否為空】
	if (document.ccSignupForm.captainAddr.value === "") {
		alert("「隊長」請填寫「通訊地址」!");
		return false;
	}

	// 【隊長院所是否為空】
	if (document.ccSignupForm.captainCollege.value === "") {
		alert("「隊長」請選擇「就讀院所」!");
		return false;
	}
	
	// 【隊長科系是否為空】
	if (document.ccSignupForm.captainDepart.value === "") {
		alert("「隊長」請選擇「就讀科系」!");
		return false;
	}

	// 【隊長學位是否為空】
	if (document.ccSignupForm.captainDegree.value === "") {
		alert("「隊長」請選擇「修習學位」!");
		return false;
	}

	// 【隊長年級是否為空】
	if (document.ccSignupForm.captainGrade.value === "") {
		alert("「隊長」請選擇「年級」!");
		return false;
	}


/******************  隊員1報名資訊  ******************/

if (document.ccSignupForm.member1Name.value !== "") {
	// 【隊員1稱謂是否為空】
	if (document.ccSignupForm.member1Sex.value === "") {
		alert("「隊員1」請選擇「稱謂」!");
		return false;
	}

	// 【隊員1身份證字號是否為空】
	if (document.ccSignupForm.member1ID.value === "") {
		alert("「隊員1」請填寫「身份證字號」!");
		return false;
	}

	// 【隊員1生日是否為空】
	if (document.ccSignupForm.member1Birth.value === "") {
		alert("「隊員1」請選擇「生日」!");
		return false;
	}
	
	// 【隊員1行動電話是否為空】
	if (document.ccSignupForm.member1Phone.value === "") {
		alert("「隊員1」請填寫「行動電話」!");
		return false;
	}	

	// 【隊員1手機號碼格式是否正確】
    if (!(/^09\d{8}$/).test(ccSignupForm.member1Phone.value))
    {
        alert("「隊員1」請輸入正確的行動電話格式！");
        aForm.mobile.focus();
        return false;
    }	
	
	// 【隊員1Email是否為空】
	if (document.ccSignupForm.member1Email.value === "") {
		alert("「隊員1」請填寫「Email」(※gmail或其它非免費信箱)!");
		return false;
	}
	
    // 【隊員1email格式是否正確】
    var strEmail = ccSignupForm.member1Email.value;
    emailRule = /^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z]+$/;
    if (strEmail.search(emailRule) == -1)
    {
        alert("「隊員1」email格式有誤！");
        return false;
    }	
	
	// 【隊員1通訊地-城市是否為空】
	if (document.ccSignupForm.member1City.value === "") {
		alert("「隊員1」請選擇「通訊地-城市」!");
		return false;
	}
	
	// 【隊員1通訊地-行政區是否為空】
	if (document.ccSignupForm.member1District.value === "") {
		alert("「隊員1」請選擇「通訊地-行政區」!");
		return false;
	}
	
	// 【隊員1通訊地址是否為空】
	if (document.ccSignupForm.member1Addr.value === "") {
		alert("「隊員1」請填寫「通訊地址」!");
		return false;
	}

	// 【隊員1院所是否為空】
	if (document.ccSignupForm.member1College.value === "") {
		alert("「隊員1」請選擇「就讀院所」!");
		return false;
	}
	
	// 【隊員1科系是否為空】
	if (document.ccSignupForm.member1Depart.value === "") {
		alert("「隊員1」請選擇「就讀科系」!");
		return false;
	}

	// 【隊員1學位是否為空】
	if (document.ccSignupForm.member1Degree.value === "") {
		alert("「隊員1」請選擇「修習學位」!");
		return false;
	}

	// 【隊員1年級是否為空】
	if (document.ccSignupForm.member1Grade.value === "") {
		alert("「隊員1」請選擇「年級」!");
		return false;
	}
}



/******************  隊員1報名資訊  ******************/

if (document.ccSignupForm.member2Name.value !== "") {
	// 【隊員2稱謂是否為空】
	if (document.ccSignupForm.member2Sex.value === "") {
		alert("「隊員2」請選擇「稱謂」!");
		return false;
	}

	// 【隊員2身份證字號是否為空】
	if (document.ccSignupForm.member2ID.value === "") {
		alert("「隊員2」請填寫「身份證字號」!");
		return false;
	}

	// 【隊員2生日是否為空】
	if (document.ccSignupForm.member2Birth.value === "") {
		alert("「隊員2」請選擇「生日」!");
		return false;
	}
	
	// 【隊員2行動電話是否為空】
	if (document.ccSignupForm.member2Phone.value === "") {
		alert("「隊員2」請填寫「行動電話」!");
		return false;
	}	

	// 【隊員2手機號碼格式是否正確】
    if (!(/^09\d{8}$/).test(ccSignupForm.member2Phone.value))
    {
        alert("「隊員2」請輸入正確的行動電話格式！");
        aForm.mobile.focus();
        return false;
    }	
	
	// 【隊員2Email是否為空】
	if (document.ccSignupForm.member2Email.value === "") {
		alert("「隊員2」請填寫「Email」(※gmail或其它非免費信箱)!");
		return false;
	}
	
    // 【隊員2email格式是否正確】
    var strEmail = ccSignupForm.member2Email.value;
    emailRule = /^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z]+$/;
    if (strEmail.search(emailRule) == -1)
    {
        alert("「隊員2」email格式有誤！");
        return false;
    }	
	
	// 【隊員2通訊地-城市是否為空】
	if (document.ccSignupForm.member2City.value === "") {
		alert("「隊員2」請選擇「通訊地-城市」!");
		return false;
	}
	
	// 【隊員2通訊地-行政區是否為空】
	if (document.ccSignupForm.member2District.value === "") {
		alert("「隊員2」請選擇「通訊地-行政區」!");
		return false;
	}
	
	// 【隊員2通訊地址是否為空】
	if (document.ccSignupForm.member2Addr.value === "") {
		alert("「隊員2」請填寫「通訊地址」!");
		return false;
	}

	// 【隊員2院所是否為空】
	if (document.ccSignupForm.member2College.value === "") {
		alert("「隊員2」請選擇「就讀院所」!");
		return false;
	}
	
	// 【隊員2科系是否為空】
	if (document.ccSignupForm.member2Depart.value === "") {
		alert("「隊員2」請選擇「就讀科系」!");
		return false;
	}

	// 【隊員2學位是否為空】
	if (document.ccSignupForm.member2Degree.value === "") {
		alert("「隊員2」請選擇「修習學位」!");
		return false;
	}

	// 【隊員2年級是否為空】
	if (document.ccSignupForm.member2Grade.value === "") {
		alert("「隊員2」請選擇「年級」!");
		return false;
	}
}



	
/******************  解除輸入限制 AND 帶回屬性值  ******************/

	$(".disableCancel").removeAttr("disabled");
	$("#projectNO").attr("value", "CG19");
	$("#projectName").attr("value", "2019第九屆全國大專盃財富管理競賽");
	$("#MN").attr("value", "1000");

	/******************  chk End  ******************/
	ccSignupForm.submit();
}