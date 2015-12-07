<meta http-equiv=Content-Type content="text/html;charset=utf8">
<?php
ini_set('display_errors',0);
class sendmail
{
	function sendout($checknum)
	{
		require_once('email.class.php');
		$smtpserver = "smtp.126.com";
		$smtpserverport =25;
		$smtpusermail = "[邮箱]";
//		$smtpemailto="[邮箱]";­
		$destination=$checknum['email'];
		$smtpuser = "[邮箱]";
		$smtppass = "[密码]";
		$mailtitle = "邮箱注册验证!";
		$mailcontent = "<h1>激活码为".$checknum['ran']."</h1></br><a href='http://2.osscnu.sinaapp.com/controller/find.php?checknum=".$checknum['ran']."&emails=".$checknum['email']."'>点击此链接以完成验证激活!</a>";
		$mailtype = "HTML";
		$smtp =& new smtp($smtpserver,$smtpserverport,true,$smtpuser,$smtppass);
		$smtp->debug = false;
		$state = $smtp->sendmail($destination, $smtpusermail, $mailtitle, $mailcontent, $mailtype,"utf-8");
	}
}
?>
