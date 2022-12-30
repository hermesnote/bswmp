<!-- 報名資訊 -->
<div class="table-responsive">
	<div class="col-md-8 mx-auto">
	<table class="table table-hover mx-auto mt-5" id="teamInfo">
		
		<thead class="table-info">
		<tr>
			<th scope="col" colspan="4" class="text-center h2 text-dark">以下是您的報名資訊</th>
		</tr>
		</thead>
		
		<tbody>
		<tr class="table-light">
			<th scope="row" width="15%">參賽項目</th>
			<td width="35%"><?php echo $projectName ?></td>
			<th scope="row" width="15%">報名費用</th>
			<td width="35%">新台幣 $<?php echo $MN ?> 元整</td>
		</tr>
		<tr class="table-light">
			<th scope="row">代表學校</th>
			<td><?php echo $school ?></td>
			<th scope="row">隊伍名稱</th>
			<td><?php echo $teamName ?></td>
		</tr>
		<tr class="table-light">
			<th scope="row">隊伍編號</th>
			<td><?php echo $teamNO ?></td>
			<th scope="row">隊伍人數</th>
			<td id="teamMans"><?php echo $teamMans ?></td>
		</tr>
		<tr class="table-light">
			<th scope="row">收據抬頭</th>
			<td><?php echo $receiptTitle ?></td>
			<th scope="row">統一編號</th>
			<td><?php echo $taxID ?></td>
		</tr>
	</table>
	</div>
</div>
	
<div class="table-responsive" id="captainInfo">
	<div class="col-md-8 mx-auto">
	<table class="table table-hover mx-auto" id="captainInfo">
		<tr class="table-success">
			<th scope="row" colspan="4" class="text-center">隊長資訊</th>
		</tr>
		<tr>
			<th scope="row" width="15%">姓名</th>
			<td width="35%"><?php echo $captainName ?></td>
			<th scope="row" width="15%">ID</th>
			<td width="35%"><?php echo substr($captainID, 0, 4).'＊＊＊'.substr($captainID, -3) ?></td>
		</tr>
		<tr>
			<th scope="row">目前學籍</th>
			<td colspan="3"><?php echo $school.$captainCollege.$captainDepart.$captainGrade ?></td>
		</tr>
		<tr>
			<th scope="row">行動電話</th>
			<td><?php echo substr($captainPhone, 0, 4).'＊＊＊'.substr($captainPhone, -3) ?></td>
			<th scope="row">Email</th>
			<td>
				<?php
					 echo strstr($captainEmail, '@', true).'@'.'＊＊＊';
				?>
			</td>
		</tr>
		<tr>
			<th scope="row">通訊地址</th>
			<td colspan="3"><?php echo $captainAddr ?></td>
		</tr>
	</table>
	</div>
</div>

<div class="table-responsive" id="member1Info">
	<div class="col-md-8 mx-auto">
	<table class="table table-hover mx-auto" id="member1Info">
		<tr class="table-success">
			<th scope="row" colspan="4" class="text-center">隊員資訊</th>
		</tr>
		<tr class="table-light">
			<th scope="row" width="15%">姓名</th>
			<td width="35%"><?php echo $member1Name ?></td>
			<th scope="row" width="15%">ID</th>
			<td width="35%"><?php echo substr($member1ID, 0, 4).'＊＊＊'.substr($member1ID, -3) ?></td>
		</tr>
		<tr  class="table-light">
			<th scope="row">目前學籍</th>
			<td colspan="3"><?php echo $school.$member1College.$member1Depart.$member1Grade ?></td>
		</tr>
		<tr  class="table-light">
			<th scope="row">行動電話</th>
			<td><?php echo substr($member1Phone, 0, 4).'＊＊＊'.substr($member1Phone, -3) ?></td>
			<th scope="row">Email</th>
			<td>
				<?php
				echo strstr($member1Email, '@', true).'@'.'＊＊＊';
				?>
			</td>
		</tr>
		<tr  class="table-light">
			<th scope="row">通訊地址</th>
			<td colspan="3"><?php echo $member1Addr ?></td>
		</tr>
	</table>
	</div>
</div>

<div class="table-responsive" id="member2Info">
	<div class="col-md-8 mx-auto">
	<table class="table table-hover mx-auto" id="member2Info">
		<tr class="table-success">
			<th scope="row" colspan="4" class="text-center">隊員資訊</th>
		</tr>
		<tr class="table-light">
			<th scope="row" width="15%">姓名</th>
			<td width="35%"><?php echo $member2Name ?></td>
			<th scope="row" width="15%">ID</th>
			<td width="35%"><?php echo substr($member2ID, 0, 4).'＊＊＊'.substr($member2ID, -3) ?></td>
		</tr>
		<tr  class="table-light">
			<th scope="row">目前學籍</th>
			<td colspan="3"><?php echo $school.$member2College.$member2Depart.$member2Grade ?></td>
		</tr>
		<tr  class="table-light">
			<th scope="row">行動電話</th>
			<td><?php echo substr($member2Phone, 0, 4).'＊＊＊'.substr($member2Phone, -3) ?></td>
			<th scope="row">Email</th>
			<td>
				<?php
				echo strstr($member2Email, '@', true).'@'.'＊＊＊';
				?>
			</td>
		</tr>
		<tr  class="table-light">
			<th scope="row">通訊地址</th>
			<td colspan="3"><?php echo $member2Addr ?></td>
		</tr>
	</table>
	</div>
</div>