<?php
session_start();
?>
<style>
#bodybg5{
position:absolute;
width:100%;
height:100%;
left:0px;
top:0px;
z-index:0;
}
#bodybg5 .stretch5{width:100%;height:100%;}
</style>
<?php
ini_set('display_errors',0);
if($_SESSION['user']!="1234")
{
	header("Location:http://2.osscnu.sinaapp.com/index.php");
	exit;
}
header("Content-type:text/html;charset=utf-8");
echo "<div id='bodybg5'><img src='../picture/11.jpg' class='stretch5'/></div>";
echo "<div style='left:540px;position:fixed;top:100px;'><h2>请修改个人密码</h2></div>";
echo "<div><form action='../controller/find.php' method=post></div>
	  <input type=hidden name=reset value='reset'>
	  <div style='left:540px;position:fixed;top:180px;'>密码: </div>
	  <div style='left:540px;position:fixed;top:210px;'><input type=password name=password placeholder='6~10位密码'></div>
	  <div style='left:540px;position:fixed;top:250px;'>确认密码: </div>
	  <div style='left:540px;position:fixed;top:280px;'><input type=password name=password2 placeholder='6~10位密码'></div>
	  <div style='left:540px;position:fixed;top:320px;'><input type=submit value='修 改' style='width:75;height:25px'></div>
	  <div style='left:630px;position:fixed;top:320px;'><input type=reset value='重 置' style='width:75;height:25px'></div>
	  </form>";
echo "<div style=left:540px;position:fixed;top:360px><a href='../view/findback.php'><font color='009900'>后 退</font></a></div>";
?>
