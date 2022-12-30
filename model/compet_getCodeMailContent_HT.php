<?php
$mail->ClearAddresses();
$mail->setFrom('service@wmpcca.com', '台灣財富管理規劃顧問認證協會'); 
$mail->AddAddress($email);
$mail->Subject = "參選代號及驗證碼"; //信件主旨
$mail->Body = "
	  <p>  $city $school $depart $name 老師 您好 </p>
	  <p>  歡迎參加 $projectName </p>
	  <p>  以下為您參加本次活動專屬帳戶資訊 </p>
	  <p>  選拔代碼：$examNO </p>
	  <p>  驗證碼：$vCode </p>
	  <p>  請使用上述隊伍編號及驗證碼<a href='https://wmpcca.com/bswmp/form/view/histock_index.php'>登入活動專區</a></p>
	  
<br><br><br><br><br>
      <h3>台灣財富管理規劃顧問認證協會 WMPCCA</h3>
      <h4>任何問題請至協會網站填寫線上聯絡表單，或參考以下資訊：<br>
      <a href='http://www.wmpcca.com'>協會首頁</a> | E-mail：<a href='mailto:wmpdatw@gmail.com'>wmpdatw@gmail.com</a><br>
      電話：(02)2501-6862 | 傳真：(02)2501-6882<br>
      週一至週五09:30-18:00</h4>
      <a style='font-size: 13px'>此為系統自動發送，請勿直接回覆。可以參考我們的<a href='http://www.wmpcca.com' style='font-size: 13px'>隱私權政策</a>. <a style='font-size: 13px'>為了確保能收到來自台灣財富管理規劃顧問認證協會的信件，請將service@wmpcca.com加入您的通訊錄</a>
";
$mail->Send();
?>