<?php
session_start();
$_SESSION=array();
ini_set('display_errors',0);
if(isset($_COOKIE[session_name()]))
{
	setcookie(session_name(),'',time()-42000,'/');
}
ini_set('display_errors',1);
echo "<div id='bodybg'><img src='./picture/7.jpg' class='stretch'/></div>";
echo "<div style='left:850px;position:fixed;top:80px;'><h1>华师开源代码部落</h1></div>";//style='background-color:transparent'
echo "<div><form  action='controller/find.php' method=post></div>
	  <input type=hidden name=login value='login'>
	  <div style='left:860px;position:fixed;top:160px;'><h3>账号: <input type=text name=email ></h3></div>
	  <div style='left:860px;position:fixed;top:220px;'><h3>密码: <input type=password name=password ></h3></div>
	  <div style='left:860px;position:fixed;top:280px;'><h3>验证码: <input type=text name=validate style='width:155'></h3></div>
	  <div style='left:1090px;position:fixed;top:280px;'><img title='点击刷新' src='./model/captcha.php' align=absbottom onclick=this.src='./model/captcha.php?'+Math.random();></div>
	  <div style='left:890px;position:fixed;top:355px;'><input type=submit value=登录 style='width:75;height:30'></div>
	  <div style='left:1000px;position:fixed;top:355px;'><input type=reset value=重置 style='width:75;height:30'></div></form>";
echo "<div style='left:890px;position:fixed;top:410px;'><a href='view/insert.php'><font color='009900'>注册账号</font></a></div>";	  
echo "<div style='left:995px;position:fixed;top:410px;'><a href='./view/findback.php'><font color='009900'>忘记密码</font></a></div>";
echo "<div style='left:40px;position:fixed;top:650px;'><a>Copyright: @2015 scnu by caizhiheng ,All rights reserved</a></div>";
?>
<style>
#bodybg{
position:absolute;
width:100%;
height:100%;
left:0px;
top:0px;
z-index:0;
}
#bodybg .stretch{width:100%;height:100%;}
</style>
