<?php
$mail->ClearAddresses();
$mail->setFrom('service@wmpcca.com', '台灣財富管理規劃顧問認證協會'); 
$mail->AddAddress($staffEmail);
$mail->Subject = "後台管理帳號開通驗證碼"; //信件主旨
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

 <table border='3' bordercolor='#067277' cellpadding='0' cellspacing='0' width='80%' align='center'>
  <tr>
   <td align='center'>
    	<hr color='white'>
	  <a style='color:#F8B218;font-family:微軟正黑體;font-size:20px;font-weight: 800;'> - WMPCCA後台帳號開通 - </a><br>
	  <br>
	  <a style='color:#067277;font-family:微軟正黑體;font-size:20px;font-weight: 800;'>帳號：$account</a><br>
	  <a style='color:#067277;font-family:微軟正黑體;font-size:20px;font-weight: 800;'>密碼：$pwd</a><br>
	  <br>
	  <a style='color:#067277;font-family:微軟正黑體;font-size:20px;font-weight: 800;'>驗證碼：$verification</a><br>
	  <br>
	  <br>
	  <a style='color:silver;font-family:微軟正黑體;font-size:16px;font-weight: 800;'>※請複製驗證碼回網站完成後台帳號開通</a>
		<hr color='white'>
   </td>
  </tr>
 </table>

</table>
</body>
</html>
";
$mail->Send();
?>