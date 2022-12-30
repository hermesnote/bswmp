<div class="container-fluid text-cenrter">
<div class="col-8 mx-auto">
<!-- 資料傳送表單 -->
<form name="ccPostForm" method="post" id="ccPostForm">
<!-- 報名資訊 -->
<input type="hidden" name="orderTime" value="<?php echo $orderTime; ?>">
<input type="hidden" name="projectNO" value="<?php echo $projectNO; ?>">
<input type="hidden" name="projectName" value="<?php echo $projectName; ?>">
<input type="hidden" name="MN" value="<?php echo $MN; ?>">
<input type="hidden" name="payStatus" value="<?php echo $payStatus; ?>">
<input type="hidden" name="eventCode" value="<?php echo $eventCode; ?>">
<input type="hidden" name="orderNO" value="<?php echo $orderNO; ?>">
<input type="hidden" name="customerNO" value="<?php echo $customerNO; ?>">
<input type="hidden" name="receiptTitle" value="<?php echo $receiptTitle; ?>">
<input type="hidden" name="taxID" value="<?php echo $taxID; ?>">
<!-- 隊伍資訊 -->
<input type="hidden" name="registerTime" value="<?php echo $registerTime; ?>">
<input type="hidden" name="teamNO" value="<?php echo $teamNO; ?>">
<input type="hidden" name="teamName" value="<?php echo $teamName; ?>">
<input type="hidden" name="district" value="<?php echo $district; ?>">
<input type="hidden" name="school" value="<?php echo $school; ?>">
<input type="hidden" name="teacher" value="<?php echo $teacher; ?>">
<!-- 隊長資訊 -->
<input type="hidden" name="captainCollege" value="<?php echo $captainCollege; ?>">
<input type="hidden" name="captainDepart" value="<?php echo $captainDepart; ?>">
<input type="hidden" name="captainDegree" value="<?php echo $captainDegree; ?>">
<input type="hidden" name="captainGrade" value="<?php echo $captainGrade; ?>">
<input type="hidden" name="captainName" value="<?php echo $captainName; ?>">
<input type="hidden" name="captainSex" value="<?php echo $captainSex; ?>">
<input type="hidden" name="captainID" value="<?php echo $captainID; ?>">
<input type="hidden" name="captainBirth" value="<?php echo $captainBirth; ?>">
<input type="hidden" name="captainPhone" value="<?php echo $captainPhone; ?>">
<input type="hidden" name="captainPhone" value="<?php echo $captainPhone; ?>">
<input type="hidden" name="captainEmail" value="<?php echo $captainEmail; ?>">
<input type="hidden" name="captainAddr" value="<?php echo $captainAddr; ?>">
<!-- 隊員1資訊 -->
<input type="hidden" name="member1College" value="<?php echo $member1College; ?>">
<input type="hidden" name="member1Depart" value="<?php echo $member1Depart; ?>">
<input type="hidden" name="member1Degree" value="<?php echo $member1Degree; ?>">
<input type="hidden" name="member1Grade" value="<?php echo $member1Grade; ?>">
<input type="hidden" name="member1Name" value="<?php echo $member1Name; ?>">
<input type="hidden" name="member1Sex" value="<?php echo $member1Sex; ?>">
<input type="hidden" name="member1ID" value="<?php echo $member1ID; ?>">
<input type="hidden" name="member1Birth" value="<?php echo $member1Birth; ?>">
<input type="hidden" name="member1Phone" value="<?php echo $member1Phone; ?>">
<input type="hidden" name="member1Phone" value="<?php echo $member1Phone; ?>">
<input type="hidden" name="member1Email" value="<?php echo $member1Email; ?>">
<input type="hidden" name="member1Addr" value="<?php echo $member1Addr; ?>">
<!-- 隊員2資訊 -->
<input type="hidden" name="member2College" value="<?php echo $member2College; ?>">
<input type="hidden" name="member2Depart" value="<?php echo $member2Depart; ?>">
<input type="hidden" name="member2Degree" value="<?php echo $member2Degree; ?>">
<input type="hidden" name="member2Grade" value="<?php echo $member2Grade; ?>">
<input type="hidden" name="member2Name" value="<?php echo $member2Name; ?>">
<input type="hidden" name="member2Sex" value="<?php echo $member2Sex; ?>">
<input type="hidden" name="member2ID" value="<?php echo $member2ID; ?>">
<input type="hidden" name="member2Birth" value="<?php echo $member2Birth; ?>">
<input type="hidden" name="member2Phone" value="<?php echo $member2Phone; ?>">
<input type="hidden" name="member2Phone" value="<?php echo $member2hone; ?>">
<input type="hidden" name="member2Email" value="<?php echo $member2Email; ?>">
<input type="hidden" name="member2Addr" value="<?php echo $member2Addr; ?>">
<!-- 按鈕區 -->
<div class="mx-auto text-center my-5">
	<button type="button" onclick="history.back()" class="btn btn-outline-danger mr-4"><span class="fa fa-times"></span>放棄，回上一頁</button>
	<button type="submit" class="btn btn-outline-warning ml-4">下一步，選擇繳費方式<span class="fa fa-share-square-o"></span></button>
</div>
</form>
</div>
</div>