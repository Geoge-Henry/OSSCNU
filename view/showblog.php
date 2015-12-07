<?php
session_start();
?>
<style>
#bodybg8{
position:absolute;
width:100%;
height:100%;
left:0px;
top:0px;
z-index:0;
}
#bodybg8 .stretch8{width:100%;height:100%;}
</style>
<?php
ini_set('display_errors',0);
if($_SESSION['user']!="123")
{
	header("Location:http://2.osscnu.sinaapp.com/index.php");
	exit;
}

header("Content-type:text/html;charset=utf-8");
if($_SESSION['select']=="select")
{
echo "<div id='bodybg8'><img src='../picture/9.jpg' class='stretch8'/></div>";
echo "<div style='left:560px;position:fixed;top:50px;'><h3>博&nbsp&nbsp客&nbsp&nbsp全&nbsp&nbsp文</h3></div>";
echo "<div style='left:940px;position:fixed;top:10px;'>我的账号: $_SESSION[username]</div>";
echo "<div style='left:450px;position:fixed;top:130px;'><h4>标题:&nbsp&nbsp$_SESSION[blogtitle]</h4></div>";
echo "<div style='left:450px;position:fixed;top:170px;'><h4>内容: </h4></div>";
echo "<div style='left:450px;position:fixed;top:220px;'><textarea type=text disabled='disabled' style='resize:none;width:300px;height:350px'>$_SESSION[blogcontents]</textarea></div>";
echo "<div style='left:500px;position:fixed;top:580px;'>写自: $_SESSION[mytime]</div>";
echo "<div style='left:1180px;position:fixed;top:10px;'><a href='./update.php'><font color='0000FF'>修 改 资 料</font></a></div>";
echo "<div style='left:1280px;position:fixed;top:10px;'><a href='./index.php'><font color='0000FF'>返 回</font></a></div>";
}
if($_SESSION['select']=="select2")
{
echo "<div id='bodybg8'><img src='../picture/9.jpg' class='stretch8'/></div>";
echo "<div style='left:560px;position:fixed;top:50px;'><h3>博&nbsp&nbsp客&nbsp&nbsp全&nbsp&nbsp文</h3></div>";
echo "<div style='left:940px;position:fixed;top:10px;'>我的账号: $_SESSION[username]</div>";
echo "<div style='left:450px;position:fixed;top:130px;'><h4>标题:&nbsp&nbsp$_SESSION[blogtitle]</h4></div>";
echo "<div style='left:450px;position:fixed;top:170px;'><h4>内容: </h4></div>";
echo "<div style='left:450px;position:fixed;top:220px;'><textarea type=text disabled='disabled' style='resize:none;width:300px;height:350px'>$_SESSION[blogcontents]</textarea></div>";
echo "<div style='left:500px;position:fixed;top:580px;'>写自: $_SESSION[mytime]</div>";
echo "<div style='left:1180px;position:fixed;top:10px;'><a href='./update.php'><font color='0000FF'>修 改 资 料</font></a></div>";
echo "<div style='left:1280px;position:fixed;top:10px;'><a href='./blogwrite.php'><font color='0000FF'>返 回</font></a></div>";
}
?>
