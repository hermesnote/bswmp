<div class="container-fluid">
<form name="staffSignupForm" id="staffSignupForm" class="col-8 mx-auto my-5" action="admin_verificationSent.php" method="post">
	<div class="text-info text-center display-4">
		WMPCCA - 後台註冊系統
	</div>
	<button class="btn btn-info btn-lg btn-block mt-3" type="button" disabled><span class="fa fa-pencil"></span>個人資訊</button>
	<div class="form-group my-3">
		
		<div class="row">
			<div class="col-xl-4">
				<label for="staffNO">員工編號</label>
				<input type="text" name="staffNO" value="" id="staffNO" class="form-control text-center" placeholder="系統自動生成" disabled>
			</div>
			<div class="col-xl-4">
				<label for="arrival">到職日</label>
				<input type="" name="arrival" value="" id="projectNO" class="disableCancel form-control text-center datepicker">

			</div>
			<div class="col-xl-4">
				<label for="postTitle">職務名稱</label>
				<input type="text" name="postTitle" value="" id="postType" class="form-control text-center" placeholder="與名片相同">
			</div>
		</div>
		
		<div class="row mt-3">
			<div class="col-xl-4">
				<label for="staffName">姓名</label>
				<input type="text" name="staffName" value="" id="staffName" class="form-control text-center">

			</div>
			<div class="col-xl-4">
				<label for="identifyNO">身份證字號</label>
				<input type="text" name="identifyNO" value="" id="identifyNO" class="form-control text-center" maxlength="10">
			</div>
			<div class="col-xl-4">
				<label for="staffSex">稱謂</label>
				<select name="staffSex" class="form-control">
					<option selected value="">請選擇...</option>
					<option>先生</option>
					<option>小姐</option>
				</select>
			</div>
		</div>

		<div class="row mt-3">
			<div class="col-xl-4">
				<label for="staffBirth">生日</label>
				<input type="" name="staffBirth" value="" id="staffBirth" class="form-control text-center datepicker">
			</div>
			<div class="col-xl-4">
				<label for="staffLineID">LINE ID</label>
				<input type="text" name="staffLineID" id="staffLineID" class="form-control text-center">
			</div>
			<div class="col-xl-4">
				<label for="staffDegree">最高學歷</label>
				<select name="staffDegree" class="form-control">
					<option selected value="">請選擇...</option>
					<option value="五專">五專</option>
					<option value="二專">二專</option>
					<option value="四技">四技</option>
					<option value="二技">二技</option>
					<option value="學士">學士</option>
					<option value="碩士">碩士</option>
					<option value="博士">博士</option>
				</select>			</div>
		</div>	
		
		<div class="row mt-3">
			<div class="col-xl-4">
				<label for="staffPhone">行動電話</label>
				<input type="text" name="staffPhone" id="staffPhone" class="form-control text-center" maxlength="10">

			</div>
			<div class="col-xl-8">
				<label for="staffEmail">E-mail</label>
				<input type="text" name="staffEmail" value="" id="projectName" class="form-control text-center">
			</div>
		</div>
		
		<div class="row mt-3">
			<div class="col-xl-3">
				<label for="staffCity">通訊地-城市</label>
				<select name="staffCity" class="form-control" id="captainCity">
					<option selected value="">縣市</option>
				</select>
			</div>
			<div class="col-xl-3">
				<label for="staffDistrict">通訊地-行政區</label>
				<select name="staffDistrict" class="form-control" id="captainDistrict">
					<option selected value="">鄉鎮市區</option>
				</select>
			</div>
			<div class="col-xl-6">
				<label for="staffAddr">通訊地址</label>
				<input type="text" name="staffAddr" class="form-control text-center">
			</div>		
		</div>		
		
	<button class="btn btn-info btn-lg btn-block mt-3" type="button" disabled><span class="fa fa-pencil"></span>帳號設定</button>		
		<div class="row mt-3">
			<div class="col-xl-4">
				<label for="account">帳號使用</label>
				<select name="account" class="form-control" id="account">
				<option selected value="">請選擇...</option>
				<option value="0">以員工編號作為登入帳號</option>
				<option value="1">以身份證字號作為登入帳號</option>
				<option value="2">以E-Mail信箱作為登入帳號</option>
				</select>
			</div>
			<div class="col-xl-4">
				<label for="pwd">登入密碼</label>
				<input type="password" name="pwd" id="pwd" class="form-control text-center">
			</div>
			<div class="col-xl-4">
				<label for="pwd2">再次確認密碼</label>
				<input type="password" name="pwd2" id="pwd2" class="form-control text-center">
			</div>
		</div>		
		
	</div>
</form>

<div class="col-md-6 mx-auto text-center my-5">
	<button type="reset" class="btn btn-outline-danger mr-4" id="btnReset" aria-pressed="false"><span class="fa fa-times"></span>清除重填</button>
	<button onClick="chkAdminRegister()" class="btn btn-outline-warning ml-4">註冊帳號<span class="fa fa-share-square-o"></span></button>
</div>

</div>
