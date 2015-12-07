<?php
session_start();
?>
<style>
#bodybg6{
position:absolute;
width:100%;
height:100%;
left:0px;
top:0px;
z-index:0;
}
#bodybg6 .stretch6{width:100%;height:100%;}
</style>
<?php
ini_set('display_errors',0);
if($_SESSION['user']!="123")
{
	header("Location:http://2.osscnu.sinaapp.com/index.php");
	exit;
}
header("Content-type:text/html;charset=utf-8");
echo "<div id='bodybg6'><img src='../picture/12.jpg' class='stretch6'/></div>";
echo "<div style='left:560px;position:fixed;top:80px;'><h3>请修改个人信息</h3></div>";
echo "<div><form action='../controller/find.php' method=post></div>
	  <input type=hidden name=update value='update'>
	  <div style='left:540px;position:fixed;top:150px;'>密码: </div>
	  <div style='left:540px;position:fixed;top:180px;'><input type=password name=password placeholder='6~10位密码'></div>
	  <div style='left:540px;position:fixed;top:210px;'>确认密码: </div>
	  <div style='left:540px;position:fixed;top:240px;'><input type=password name=password2 placeholder='6~10位密码'></div>
	  <div style='left:540px;position:fixed;top:270px;'>昵称: </div>
	  <div style='left:540px;position:fixed;top:300px;'><input type=text name=username placeholder='输入昵称'></div>
	  <div style='left:540px;position:fixed;top:330px;'><input type=submit value='修 改' style='width:75;height:25px'></div>
	  <div style='left:630px;position:fixed;top:330px;'><input type=reset value='重 置' style='width:75;height:25px'></div>
	  </form>";
echo "<div style=left:540px;position:fixed;top:380px><a href='./index.php'><font color='009900'>后 退</font></a></div>";
?>
