<?php
session_start();
?>
<style>
#bodybg10{
position:absolute;
width:100%;
height:100%;
left:0px;
top:0px;
z-index:0;
}
#bodybg10 .stretch10{width:100%;height:100%;}
</style>
<?php
ini_set('display_errors',0);
if($_SESSION['user']!="123")
{
	header("Location:http://2.osscnu.sinaapp.com/index.php");
	exit;
}

header("Content-type:text/html;charset=utf-8");
echo "<div id='bodybg10'><img src='../picture/9.jpg' class='stretch10'/></div>";
echo "<div style='left:500px;position:fixed;top:30px;'><h2>发&nbsp&nbsp布&nbsp&nbsp我&nbsp&nbsp的&nbsp&nbsp代&nbsp&nbsp码</h2></div>";
echo "<div style='left:940px;position:fixed;top:10px;'>我的账号: $_SESSION[username]</a></div>";
echo "<div><form enctype='multipart/form-data' action='../controller/files.php' method=post></div>";
echo "<div style='left:180px;position:fixed;top:130px;'><h4>标题:&nbsp <input type=text name=filetitle size='50px' style='height:20px;'></h4></div>";
echo "<input type=hidden name=files value='files'>";
echo "<div style='left:180px;position:fixed;top:180px;'><h4>代码描述:&nbsp</h4></div>";
echo "<div style='left:180px;position:fixed;top:230px;'><textarea type=text name=contents style='resize:none;width:600px;height:250px;'></textarea></div>";
echo "<div style='left:200px;position:fixed;top:505px;'><input type=file name=demo></div>";
echo "<div style='left:510px;position:fixed;top:500px;'><input type=submit value='发 布' style='width:90px;height:30px;'></div>";
echo "<div style='left:660px;position:fixed;top:500px;'><input type=reset  value='重 置' style='width:90px;height:30px;'></form></div>";
echo "<div style='left:1180px;position:fixed;top:10px;'><a href='./update.php'><font color='0000FF'>修 改 资 料</font></a></div>";
echo "<div style='left:1280px;position:fixed;top:10px;'><a href='./index.php'><font color='0000FF'>返 回</font></a></div>";
