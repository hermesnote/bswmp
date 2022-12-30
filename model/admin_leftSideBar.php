<!-- Admin Left Side Bar -->
	<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
		<form role="search">
			<div class="form-group">
				<input type="text" class="form-control" placeholder="搜尋...">
			</div>
		</form>
		<ul class="nav menu active">
			<li><a href="admin_index2.php"><span class="glyphicon glyphicon-dashboard"></span> 儀表板</a></li>


			<!-- 訂單專區 -->
			<li class="parent authority1">
				<a href="../view/admin_orderList.php">
					<span class="glyphicon glyphicon-usd"></span> 訂單資訊 <span data-toggle="collapse" href="#sub-item-1" class="icon pull-right"></span> 
				</a>
				<ul class="children collapse show" id="sub-item-1">
					<li>
						<a class="" href="admin_orderList.php">
							<span class="glyphicon glyphicon-list-alt"></span> 訂單查詢
						</a>
					</li>
					<li>
						<a class="" href="admin_receiptList.php">
							<span class="glyphicon glyphicon-list-alt"></span> 收據查詢
						</a>
					</li>
<!--
					<li>
						<a class="" href="">
							<span class="glyphicon glyphicon-list-alt"></span> 發票查詢
						</a>
					</li>
-->
				</ul>
			</li>


			<!-- 競賽專區 -->
			<li class="parent authority1">
				<a href="../view/admin_competCollege.php">
					<span class="glyphicon glyphicon-flag"></span> 競賽資訊 <span data-toggle="collapse" href="#sub-item-2" class="icon pull-right"></span> 
				</a>
				<ul class="children collapse show" id="sub-item-2">
					<li>
						<a class="" href="admin_competCollege.php">
							<span class="glyphicon glyphicon-list-alt"></span> 大專組-隊伍資料
						</a>
					</li>
					<li>
						<a class="" href="admin_studentsInfo.php">
							<span class="glyphicon glyphicon-list-alt"></span> 大專組-隊員資料
						</a>
					</li>
					<li>
						<a class="" href="admin_competSocial.php">
							<span class="glyphicon glyphicon-share-alt"></span> 社會組-隊伍
						</a>
					</li>
					<li>
						<a class="" href="admin_memberInfo.php">
							<span class="glyphicon glyphicon-share-alt"></span> 社會組-隊員
						</a>
					</li>
					<li>
						<a class="" href="admin_competScore.php">
							<span class="glyphicon glyphicon-list-alt"></span> 評審專區
						</a>
					</li>
					<li>
						<a class="" href="admin_competDate.php">
							<span class="glyphicon glyphicon-list-alt"></span> 競賽設定
						</a>
					</li>
				</ul>
			</li>

			
			<!-- 申請表單 -->
			<li class="parent authority1">
				<a href="../view/admin_vCode.php">
					<span class="glyphicon glyphicon-pencil"></span> 表單系統 <span data-toggle="collapse" href="#sub-item-3" class="icon pull-right"></span> 
				</a>
				<ul class="children collapse show" id="sub-item-3">
					<li>
						<a class="" href="admin_vCode.php">
							<span class="glyphicon glyphicon-list-alt"></span> vCode專區
						</a>
					</li>
					<li>
						<a class="" href="admin_survey.php">
							<span class="glyphicon glyphicon-list-alt"></span> 問卷系統
						</a>
					</li>
					<li>
						<a class="" href="admin_teacherList.php">
							<span class="glyphicon glyphicon-list-alt"></span> 產學聯繫
						</a>
					</li>
				</ul>
			</li>			

			
			<!-- 顧問專區 -->
			<li class="parent authority1">
				<a href="../view/admin_advisorExam.php">
					<span class="glyphicon glyphicon-flag"></span> 顧問專區 <span data-toggle="collapse" href="#sub-item-2" class="icon pull-right"></span> 
				</a>
				<ul class="children collapse show" id="sub-item-2">
					<li>
						<a class="" href="admin_advisorExam.php">
							<span class="glyphicon glyphicon-list-alt"></span> 顧問測驗
						</a>
					</li>
					<li>
						<a class="" href="admin_advisorList.php">
							<span class="glyphicon glyphicon-list-alt"></span> 顧問列表
						</a>
					</li>
					<li>
						<a class="" href="admin_advisorSet.php">
							<span class="glyphicon glyphicon-list-alt"></span> 顧問設定
						</a>
					</li>
						</a>
					</li>
				</ul>
			</li>


			<!-- 保富桌遊 -->
			<li class="parent authority2">
				<a href="../view/admin_hiStock.php">
					<span class="glyphicon glyphicon-flag"></span> 金融證券實務 <span data-toggle="collapse" href="#sub-item-2" class="icon pull-right"></span> 
				</a>
				<ul class="children collapse show" id="sub-item-2">
					<li>
						<a class="" href="../view/admin_hiStock.php">
							<span class="glyphicon glyphicon-list-alt"></span> 活動設定
						</a>
					</li>
					<li>
						<a class="" href="../view/admin_histockScore.php">
							<span class="glyphicon glyphicon-list-alt"></span> 成績評審(HT)
						</a>
					</li>
					<li>
						<a class="" href="../view/admin_histock_Score_HS.php">
							<span class="glyphicon glyphicon-list-alt"></span> 成績評審(HS)
						</a>
					</li>
					<li>
						<a class="" href="../view/admin_histockSignupHT.php">
							<span class="glyphicon glyphicon-list-alt"></span> 選拔管理
						</a>
					</li>
					<li>
						<a class="" href="../view/admin_histockInfoHT.php">
							<span class="glyphicon glyphicon-list-alt"></span> 教師資訊
						</a>
					</li>
					<li>
						<a class="" href="../view/admin_histockSignupHS.php">
							<span class="glyphicon glyphicon-list-alt"></span> 隊伍管理
						</a>
					</li>
					<li>
						<a class="" href="../view/admin_histockInfoHS.php">
							<span class="glyphicon glyphicon-list-alt"></span> 隊員資訊
						</a>
					</li>
					<li>
						<a class="" href="#">
							<span class="glyphicon glyphicon-list-alt"></span> 訂單查詢
						</a>
					</li>
					<li>
						<a class="" href="#">
							<span class="glyphicon glyphicon-list-alt"></span> 收據查詢
						</a>
					</li>
					<li>
						<a class="" href="../view/admin_HSexamEdit.php">
							<span class="glyphicon glyphicon-list-alt"></span> 題庫操作
						</a>
					</li>
						</a>
					</li>
				</ul>
			</li>

			
			<!-- 進階功能 -->
			<li class="parent authority0">
				<a href="../view/admin_KEYsAccount.php">
					<span class="glyphicon glyphicon-pencil"></span> 進階功能 <span data-toggle="collapse" href="#sub-item-3" class="icon pull-right"></span> 
				</a>
				<ul class="children collapse show" id="sub-item-3">
					<li>
						<a class="authority0" href="../view/admin_competEdit.php">
							<span class="glyphicon glyphicon-list-alt"></span> 報名編修
						</a>
					</li>
					<li>
						<a class="authority0" href="../view/admin_KEYsAccount.php">
							<span class="glyphicon glyphicon-list-alt"></span> KEYs操作
						</a>
					</li>
					<li>
						<a class="authority0" href="admin_log.php">
							<span class="glyphicon glyphicon-list-alt"></span> adminLog
						</a>
					</li>
					<li>
						<a class="authority0" href="compet_log.php">
							<span class="glyphicon glyphicon-list-alt"></span> competLog
						</a>
					</li>
				</ul>
			</li>				
			
			
			<li role="presentation" class="divider"></li>
			<li style="padding-bottom: 100px;"><a href="../model/admin_logout.php"><span class="glyphicon glyphicon-user"></span> 登出系統 (<span class="text-danger" id="staffNO"><?php echo $staffNO; ?>:<span id="postType"><?php echo $postType; ?></span></span>)</a></li>
		</ul>
	</div><!--/.sidebar-->