<?php
session_start();
?>
<style>
#bodybg2{
position:absolute;
width:100%;
height:100%;
left:0px;
top:0px;
z-index:0;
}
#bodybg2 .stretch2{width:100%;height:100%;}
</style>
<?php
ini_set('display_errors',0);
$_SESSION=array();
if(isset($_COOKIE[session_name()]))
{
	setcookie(session_name(),'',time()-42000,'/');
}

echo "<div id='bodybg2'><img src='../picture/12.jpg' class='stretch2'/></div>";
echo "<div style='left:540px;position:fixed;top:80px;'><h2>请填写个人信息</h2></div>";
echo "<div><form action='../controller/find.php' method=post></div>
	  <input type=hidden name=insert value='insert'>
	  <div style='left:540px;position:fixed;top:150px;'>输入账号: </div>
	  <div style='left:540px;position:fixed;top:180px;'><input type=text name=email placeholder='邮箱地址'></div>
	  <div style='left:540px;position:fixed;top:210px;'>密码: </div>
	  <div style='left:540px;position:fixed;top:240px;'><input type=password name=password placeholder='6~10位密码'></div>
	  <div style='left:540px;position:fixed;top:270px;'>确认密码: </div>
	  <div style='left:540px;position:fixed;top:300px;'><input type=password name=password2 placeholder='6~10位密码'></div>
	  <div style='left:540px;position:fixed;top:330px;'>昵称: </div>
	  <div style='left:540px;position:fixed;top:360px;'><input type=text name=username placeholder='输入昵称'></div>
	  <div style='left:540px;position:fixed;top:390px;'>验证码: </div>
	  <div style='left:540px;position:fixed;top:420px;'><input type=text name=validate style='width:80'></div>
	  <div style='left:630px;position:fixed;top:400px;'><img title='点击刷新' src='../model/captcha.php' align=absbottom onclick=this.src='../model/captcha.php?'+Math.random();></div>
	  <div style='left:540px;position:fixed;top:460px;'><input type=submit value='注 册'  style='width:75;height:25px'></div>
	  <div style='left:630px;position:fixed;top:460px;'><input type=reset value='重 置'  style='width:75;height:25px'></div>
	  </form>";
echo "<div style=left:540px;position:fixed;top:500px><a href='../index.php'><font color='009900'>后 退</font></a></div>";

?>
