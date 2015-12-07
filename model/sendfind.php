<?php
header("Content-type:text/html;charset=utf-8");
ini_set('display_errors',0);
class sendfind
{
	function sendout($checknum)
	{
		require_once('email.class.php');
		$smtpserver = "smtp.126.com";
		$smtpserverport =25;
		$smtpusermail = "[邮箱]";
//		$smtpemailto="[邮箱]";­
		$destination=$checknum['email'];
		$smtpuser = "[密码]";
		$smtppass = "[密码]";
		$mailtitle = "邮箱注册验证!";
		$mailcontent = "<h1>邮箱验证码为".$checknum['ran']."</h1></br><a>根据此验证码完成密码的修改!</a>";
		$mailtype = "HTML";
		$smtp =& new smtp($smtpserver,$smtpserverport,true,$smtpuser,$smtppass);
		$smtp->debug = false;
		$state = $smtp->sendmail($destination, $smtpusermail, $mailtitle, $mailcontent, $mailtype,"utf-8");
	}
}
?>
