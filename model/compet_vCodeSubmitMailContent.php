<?php
//寄發開通碼通知Email
$mail->ClearAddresses();
$mail->setFrom('service@wmpcca.com', '台灣財富管理規劃顧問認證協會'); 
$mail->AddAddress($email);
$mail->Subject = "已收到您提交申請的vCode需求"; //信件主旨
$mail->Body = "
	  <p> 申 請 人：$staffName </p>
	  <p> 代　　碼：$staffNO </p>	  
	  <p> 申請項目：$vCodeDescribe1 </p>
	  <p> 額度上限：$vCodeLimited </p>
	  <p> ※ 後續審核結果將發放寄Email </p>
";
$mail->Send();
?>