<?php
$mail->ClearAddresses();
$mail->setFrom('service@wmpcca.com', '台灣財富管理規劃顧問認證協會'); 
$mail->AddAddress($getCaptainEmail);
$mail->Subject = "報名費繳款資訊"; //信件主旨
$mail->Body = "
<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml'>
 <head>
  <meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
  <title>ecPayed Email</title>
  <meta name='viewport' content='width=device-width, initial-scale=1.0'/>
</head>
<body style='margin: 0; padding: 0;background: #F0F0F0'>
<table align='center' border='0' cellpadding='0' cellspacing='0' width='700' style='max-width:100%' bordercolor='#F0F0F0' style='margin-top: 30px;margin-bottom: 30px;'>
 <tr>
  <td bgcolor='white' align='center'>
	  <a href='http://www.wmpcca.com'><img src='https://wmpcca.com/bswmp/form/img/cc_mail_Main_1.png' alt='' width='700' height='488' max-width='100%' style='display: block;' /></a>
	 </td>
 </tr>
<tr>
<td bgcolor='#ffffff' style='padding: 30px 30px 30px 30px;'>
 <table border='3' bordercolor='#067277' cellpadding='0' cellspacing='0' width='80%' align='center'>
  <tr>
   <td align='center'>
    	<hr color='white'>
	  <a style='color:#F8B218;font-family:微軟正黑體;font-size:20px;font-weight: 800;'> - 歡迎參加 2019全國大專盃理財規劃競賽 - </a><br>
	  <a style='color:#F8B218;font-family:微軟正黑體;font-size:20px;font-weight: 800;'> - 以下是您的繳費資訊 - </a><br>
	  <br>
	  <a style='color:#067277;font-family:微軟正黑體;font-size:20px;font-weight: 800;'>代表學校：$School</a><br>
	  <a style='color:#067277;font-family:微軟正黑體;font-size:20px;font-weight: 800;'>隊伍名稱：$teamName</a><br>
	  <a style='color:#067277;font-family:微軟正黑體;font-size:20px;font-weight: 800;'>隊伍編號：$teamNO</a><br>
	  <a style='color:#067277;font-family:微軟正黑體;font-size:20px;font-weight: 800;'>繳費金額：$TradeAmt</a><br>
	  <br>
	  <a style='color:#F8B218;font-family:微軟正黑體;font-size:20px;font-weight: 800;'> *** 如果您選擇繳款方式為「ATM」 *** </a><br>
	  <a style='color:#067277;font-family:微軟正黑體;font-size:20px;font-weight: 800;'>銀行代碼：$BankCode</a><br>
	  <a style='color:#067277;font-family:微軟正黑體;font-size:20px;font-weight: 800;'>繳費帳號：$vAccount</a><br>
	  <br>
	  <a style='color:#F8B218;font-family:微軟正黑體;font-size:20px;font-weight: 800;'> *** 如果您選擇繳款方式為「超商代碼」 *** </a><br>
	  <a style='color:#067277;font-family:微軟正黑體;font-size:20px;font-weight: 800;'>超商代碼：$PaymentNo</a><br>
	  <br>
	  <a style='color:#F8B218;font-family:微軟正黑體;font-size:20px;font-weight: 800;'> *** 請在以下期限前完成繳費，逾期需重新報名 *** </a><br>
	  <a style='color:#067277;font-family:微軟正黑體;font-size:20px;font-weight: 800;'>繳費期限：$ExpireDate</a><br>
	  <br>
	  <a style='color:silver;font-family:微軟正黑體;font-size:16px;font-weight: 800;'>※以上報名資料如有問題請利用下方表單聯絡協會</a>
		<hr color='white'>
   </td>
  </tr>
 </table>
</td>
</tr>
<tr>
  <td bgcolor='white' align='center'>
	  <a href='https://wmpcca.com/bswmp/form/view/cc_signup.php'><img src='https://wmpcca.com/bswmp/form/img/asc1-4.png' width='346' height='60'></a>
	  <a href='https://goo.gl/2J6T3X'><img src='http://wmpcca.com/wp-content/uploads/2018/09/asc2-4.png' width='346' height='60'></a>
  </td>
</tr>
 <tr>
  <td bgcolor='white' align='center'>
	  <a href='https://www.holdingkeys.com'><img src='http://wmpcca.com/wp-content/uploads/2018/09/asc4-4.png' width='346' height='60'></a>
	  <a href='http://wmpcca.com/contact/'><img src='http://wmpcca.com/wp-content/uploads/2018/09/asc3-4.png' width='346' height='60'></a>
  </td>
 </tr>
 <tr>
  <td bgcolor='white'>
<h3>台灣財富管理規劃顧問認證協會 WMPCCA</h3>
<h4>任何問題，請點擊上方聯絡協會：填寫線上聯絡表單，或參考以下資訊：<br>
<a href='http://www.wmpcca.com'>協會首頁</a> | E-mail：<a href='mailto:wmpdatw@gmail.com'>wmpdatw@gmail.com</a><br>
電話：(02)2501-6862 | 傳真：(02)2501-6882<br>
週一至週五09:30-18:00</h4>
  </td>
 </tr>
<tr>
	<td>
		<a style='font-size: 13px'>此為系統自動發送，請勿直接回覆。可以參考我們的<a href='http://www.wmpcca.com' style='font-size: 13px'>隱私權政策</a>. <a style='font-size: 13px'>為了確保能收到來自台灣財富管理規劃顧問認證協會的信件，請將service@wmpcca.com加入您的通訊錄</a>
	</td>
</tr>
</table>
</body>
</html>
";
$mail->Send();
?>