<!-- 報名表單 -->
<div class="container-fluid">
<form name="ccSignupForm" id="ccSignupForm" class="col-8 mx-auto my-5" action="cc_confirm.php" method="post">
<button class="btn btn-info btn-lg btn-block mt-3" type="button" disabled><span class="fa fa-pencil"></span>隊伍資訊</button>
	<div class="form-group my-3">
		<div class="row">
				<div class="col-xl-1">
				<label for="disdrict">競賽代碼</label>
				<input type="text" name="projectNO" value="" id="projectNO" class="disableCancel form-control text-center" placeholder="CG19" disabled>

			</div>
			<div class="col-xl-3">
				<label for="disdrict">參賽組別</label>
				<input type="text" name="projectName" value="" id="projectName" class="disableCancel form-control text-center" placeholder="第九屆全國大專盃財富管理競賽" disabled>
			</div>
			<div class="col-xl-2">
				<label for="disdrict">報名費用</label>
				<input type="text" name="MN" value="" id="MN" class="disableCancel form-control text-center" placeholder="每隊 NT$1,000元" disabled>
			</div>
			<div class="col-xl-4">
				<label for="disdrict">隊伍名稱</label>
				<input type="text" name="teamName" id="teamName" class="form-control text-center" placeholder="最多八個字，禁用特殊符號" maxlength="8">
			</div>
			<div class="col-xl-2">
				<label for="teacher" class="text-info">※ eCode</label>
				<input type="text" name="eventCode" class="form-control text-center" placeholder="無eCode者免填" maxlength="8">
			</div>
		</div>
	</div>
	
	<div class="form-group my-3">
		<div class="row">
			<div class="col-xl-2">
				<label for="disdrict">學校分區</label>
					<select name="schoolDistrict" class="form-control" id="schoolDistrict">
					</select>
			</div>
			<div class="col-xl-5">
				<label for="school">代表學校</label>
					<select name="schoolPre" class="form-control" id="schoolPre">
					</select>
			</div>
			
			<div class="col-xl-2">
				<label for="teacher">指導老師</label>
				<input type="text" name="directTeacher" id="directTeacher" class="form-control text-center">
			</div>
			
			<div class="col-xl-3">
				<label for="teacher" class="text-danger">※ 收據抬頭</label>
				<select name="receiptTitle" class="form-control" id="receiptTitle">
				<option selected value="">請選擇...</option>
				<option value="0">以代表學校為繳款人</option>
				<option value="1">以參賽隊伍為繳款人</option>
				<option value="2">以隊長代表為繳款人</option>
				</select>
			</div>
<!--
			
			<div class="col-xl-2">
				<label for="teacher" class="text-danger text-right">※ 統一編號</label>
				<input type="text" name="taxID" class="form-control text-center" maxlength="8">
			</div>			
-->
		</div>
	</div>

<!-- 隊長資料 -->
<button class="btn btn-info btn-lg btn-block mt-5" type="button" disabled><span class="fa fa-users"></span>隊長資訊</button>
<!--<h3 class="text-info mt-5">隊長資訊</h3>-->
	<div id="collegeMemberForm" class="form-group my-3">
		<div class="row">
			<div class="col-xl-4">
				<label for="captainInfo">就讀院所</label>
				<select name="captainCollege" class="form-control" id="captainCollege">
				</select>
			</div>
			<div class="col-xl-4">
				<label for="captainInfo">就讀科系</label>
				<select name="captainDepart" class="form-control" id="captainDepart">
				</select>
			</div>
			<div class="col-xl-2">
				<label for="captainInfo">修習學位</label>
				<select name="captainDegree" class="form-control">
					<option selected value="">請選擇...</option>
					<option value="五專">五專</option>
					<option value="二專">二專</option>
					<option value="四技">四技</option>
					<option value="二技">二技</option>
					<option value="學士">學士</option>
					<option value="碩士">碩士</option>
					<option value="博士">博士</option>
				</select>
			</div>
			<div class="col-xl-2">
				<label for="captainInfo">年級</label>
				<select name="captainGrade" class="form-control">
					<option selected value="">請選擇...</option>
					<option value="一年級">一年級</option>
					<option value="二年級">二年級</option>
					<option value="三年級">三年級</option>
					<option value="四年級">四年級</option>
					<option value="五年級">五年級</option>
					<option value="六年級">六年級</option>
					<option value="七年級">七年級</option>
				</select>
			</div>
		</div>
	
		<div class="row mt-3">
			<div class="col-xl-4">
				<label for="captainInfo">姓名</label>
				<input type="text" name="captainName" class="form-control text-center">
			</div>
			<div class="col-xl-2">
				<label for="captainInfo">稱謂</label>
				<select name="captainSex" class="form-control">
					<option selected value="">請選擇...</option>
					<option>先生</option>
					<option>小姐</option>
				</select>
			</div>
			<div class="col-xl-3">
				<label for="captainInfo">身份證字號</label>
				<input type="text" name="captainID" id="captainID" class="form-control text-center" placeholder="外籍人士請填居留證號" maxlength="12">
			</div>
			<div class="col-xl-3">
				<label for="captainInfo">生日</label>
				<input type="" name="captainBirth" class="form-control datepicker">
			</div>
		</div>
		
		<div class="row mt-3">
			<div class="col-xl-4">
				<label for="captainInfo">行動電話</label>
				<input type="text" name="captainPhone" id="captainPhon" class="form-control text-center" placeholder="格式為 0912345678" maxlength="10">
			</div>
			<div class="col-xl-8">
				<label for="captainInfo">e-Mail</label>
				<input type="text" name="captainEmail" id="captainEmail" class="form-control text-center" placeholder="請使用gmail或非免費信箱，以順利發送競賽相關通知">
			</div>
		</div>
		
		<div class="row mt-3">		
			<div class="col-xl-2">
				<label for="captainInfo">通訊地-城市</label>
				<select name="captainCity" class="form-control" id="captainCity">
					<option selected value="">縣市</option>
				</select>
			</div>
			<div class="col-xl-2">
				<label for="captainInfo">通訊地-行政區</label>
				<select name="captainDistrict" class="form-control" id="captainDistrict">
					<option selected value="">鄉鎮市區</option>
				</select>
			</div>
			<div class="col-xl-8">
				<label for="captainInfo">通訊地址</label>
				<input type="text" name="captainAddr" class="form-control text-center">
			</div>		
		</div>
	</div>
<!-- 隊長資料 End-->

<!-- 隊員1 資料 -->
<p>
<!--
  <a class="h3 text-info" mt-5 data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
    隊員資訊
  </a>
-->
<button class="btn btn-info btn-lg btn-block mt-5" type="button" data-toggle="collapse" data-target="#collapseExample1" aria-expanded="false" aria-controls="collapseExample"><span class="fa fa-user-plus"></span>點此登錄第二位隊伍成員</button>
<div class="collapse" id="collapseExample1">
	<div class="form-group my-3">
		<div class="row">
			<div class="col-xl-4">
				<label for="captainInfo">就讀院所</label>
				<select name="member1College" class="form-control" id="member1College">
				</select>
			</div>
			<div class="col-xl-4">
				<label for="captainInfo">就讀科系</label>
				<select name="member1Depart" class="form-control" id="member1Depart">
				</select>
			</div>
			<div class="col-xl-2">
				<label for="captainInfo">修習學位</label>
				<select name="member1Degree" class="form-control">
					<option selected value="">請選擇...</option>
					<option value="五專">五專</option>
					<option value="二專">二專</option>
					<option value="四技">四技</option>
					<option value="二技">二技</option>
					<option value="學士">學士</option>
					<option value="碩士">碩士</option>
					<option value="博士">博士</option>
				</select>
			</div>
			<div class="col-xl-2">
				<label for="captainInfo">年級</label>
				<select name="member1Grade" class="form-control">
					<option selected value="">請選擇...</option>
					<option value="一年級">一年級</option>
					<option value="二年級">二年級</option>
					<option value="三年級">三年級</option>
					<option value="四年級">四年級</option>
					<option value="五年級">五年級</option>
					<option value="六年級">六年級</option>
					<option value="七年級">七年級</option>
				</select>
			</div>
		</div>

		<div class="row mt-3">
			<div class="col-xl-4">
				<label for="captainInfo">姓名</label>
				<input type="text" name="member1Name" class="form-control text-center">
			</div>
			<div class="col-xl-2">
				<label for="captainInfo">稱謂</label>
				<select name="member1Sex" class="form-control">
					<option selected value="">請選擇...</option>
					<option>先生</option>
					<option>小姐</option>
				</select>
			</div>
			<div class="col-xl-3">
				<label for="captainInfo">身份證字號</label>
				<input type="text" name="member1ID" id="member1ID" class="form-control text-center" placeholder="外籍人士請填居留證號" maxlength="12">
			</div>
			<div class="col-xl-3">
				<label for="captainInfo">生日</label>
				<input type="" name="member1Birth" class="form-control datepicker">
			</div>
		</div>
		
		<div class="row mt-3">
			<div class="col-xl-4">
				<label for="captainInfo">行動電話</label>
				<input type="text" name="member1Phone" id="member1Phone" class="form-control text-center" placeholder="格式為 0912345678" maxlength="10">
			</div>
			<div class="col-xl-8">
				<label for="captainInfo">e-Mail</label>
				<input type="text" name="member1Email" id="member1Email" class="form-control text-center" placeholder="請使用gmail或非免費信箱，以順利發送競賽相關通知">
			</div>
		</div>
		
		<div class="row mt-3">		
			<div class="col-xl-2">
				<label for="captainInfo">通訊地-城市</label>
				<select name="member1City" class="form-control" id="member1City">
					<option selected value="">縣市</option>
				</select>
			</div>
			<div class="col-xl-2">
				<label for="captainInfo">通訊地-行政區</label>
				<select name="member1District" class="form-control" id="member1District">
					<option selected value="">鄉鎮市區</option>
				</select>
			</div>
			<div class="col-xl-8">
				<label for="captainInfo">通訊地址</label>
				<input type="text" name="member1Addr" class="form-control text-center">
			</div>		
		</div>
	</div>
</div>
</p>
<!-- 隊員1 資料 End-->

<!-- 隊員2 資料 -->
<p>
<button class="btn btn-info btn-lg btn-block mt-5" type="button" data-toggle="collapse" data-target="#collapseExample2" aria-expanded="false" aria-controls="collapseExample"><span class="fa fa-user-plus"></span>點此登錄第三位隊伍成員</button>
<div class="collapse" id="collapseExample2">
	<div class="form-group my-3">
		<div class="row">
			<div class="col-xl-4">
				<label for="captainInfo">就讀院所</label>
				<select name="member2College" class="form-control" id="member2College">
				</select>
			</div>
			<div class="col-xl-4">
				<label for="captainInfo">就讀科系</label>
				<select name="member2Depart" class="form-control" id="member2Depart">
				</select>
			</div>
			<div class="col-xl-2">
				<label for="captainInfo">修習學位</label>
				<select name="member2Degree" class="form-control">
					<option selected value="">請選擇...</option>
					<option value="五專">五專</option>
					<option value="二專">二專</option>
					<option value="四技">四技</option>
					<option value="二技">二技</option>
					<option value="學士">學士</option>
					<option value="碩士">碩士</option>
					<option value="博士">博士</option>
				</select>
			</div>
			<div class="col-xl-2">
				<label for="captainInfo">年級</label>
				<select name="member2Grade" class="form-control">
					<option selected value="">請選擇...</option>
					<option value="一年級">一年級</option>
					<option value="二年級">二年級</option>
					<option value="三年級">三年級</option>
					<option value="四年級">四年級</option>
					<option value="五年級">五年級</option>
					<option value="六年級">六年級</option>
					<option value="七年級">七年級</option>
				</select>
			</div>
		</div>
		
		<div class="row mt-3">
			<div class="col-xl-4">
				<label for="captainInfo">姓名</label>
				<input type="text" name="member2Name" class="form-control text-center">
			</div>
			<div class="col-xl-2">
				<label for="captainInfo">稱謂</label>
				<select name="member2Sex" class="form-control">
					<option selected value="">請選擇...</option>
					<option>先生</option>
					<option>小姐</option>
				</select>
			</div>
			<div class="col-xl-3">
				<label for="captainInfo">身份證字號</label>
				<input type="text" name="member2ID" id="member2ID" class="form-control text-center" placeholder="外籍人士請填居留證號" maxlength="12">
			</div>
			<div class="col-xl-3">
				<label for="captainInfo">生日</label>
				<input type="" name="member2Birth" class="form-control datepicker">
			</div>
		</div>
		
		<div class="row mt-3">
			<div class="col-xl-4">
				<label for="captainInfo">行動電話</label>
				<input type="text" name="member2Phone" id="member2Phone" class="form-control text-center" placeholder="格式為 0912345678" maxlength="10">
			</div>
			<div class="col-xl-8">
				<label for="captainInfo">e-Mail</label>
				<input type="text" name="member2Email" id="member2Email" class="form-control text-center" placeholder="請使用gmail或非免費信箱，以順利發送競賽相關通知">
			</div>
		</div>
		
		<div class="row mt-3">		
			<div class="col-xl-2">
				<label for="captainInfo">通訊地-城市</label>
				<select name="member2City" class="form-control" id="member2City">
					<option selected value="">縣市</option>
				</select>
			</div>
			<div class="col-xl-2">
				<label for="captainInfo">通訊地-行政區</label>
				<select name="member2District" class="form-control" id="member2District">
					<option selected value="">鄉鎮市區</option>
				</select>
			</div>
			<div class="col-xl-8">
				<label for="captainInfo">通訊地址</label>
				<input type="text" name="member2Addr" class="form-control text-center">
			</div>		
		</div>
	</div>
</div>
</p>

<div class="container-fluid mx-auto mt-5 text-center">
	<div class="form-group my-3 mx-auto text-center">
		<div class="row mx-auto text-center">
			<div class="col-xl-12 mx-auto text-center">
				<input type="checkbox" name="agreeRules" id="agreeRules" style="width: 16px;height: 16px;"> 本隊所有成員均已詳閱 「活動辦法」、「競賽規則」及「保護政策」，一致同意遵守且尊重主辦單位之安排，報名參加此次競賽。 ※(必要)
			</div>
		</div>
	</div>
</div>

</form>
<!-- 隊員2 資料 End-->

<!-- 表單傳送按鈕 -->
<div class="col-md-6 mx-auto text-center my-5">
<button type="reset" class="btn btn-outline-danger mr-4"><span class="fa fa-times"></span>清除重填</button>
<button onClick="chkCCForm()" class="btn btn-outline-warning ml-4">下一步<span class="fa fa-share-square-o"></span></button>
</div>

</div>
<!-- 報名表單 End -->