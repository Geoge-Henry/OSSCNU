<?php
session_start();
?>
<style>
#bodybg9{
position:absolute;
width:100%;
height:100%;
left:0px;
top:0px;
z-index:0;
}
#bodybg9 .stretch9{width:100%;height:100%;}
</style>
<?php
ini_set('display_errors',0);
if($_SESSION['user']!="123")
{
	header("Location:http://2.osscnu.sinaapp.com/index.php");
	exit;
}
header("Content-type:text/html;charset=utf-8");
echo "<div id='bodybg9'><img src='../picture/9.jpg' class='stretch9'/></div>";
echo "<div style='left:550px;position:fixed;top:40px;'><h2>代&nbsp&nbsp码&nbsp&nbsp详&nbsp&nbsp情</h2></div>";
echo "<div style='left:940px;position:fixed;top:10px;'>我的账号: $_SESSION[username]</div>";
echo "<div style='left:450px;position:fixed;top:130px;'><h4>标题:&nbsp&nbsp$_SESSION[filetitle]</h4></div>";
echo "<div style='left:450px;position:fixed;top:170px;'><h4>内容: </h4></div>";
echo "<div style='left:450px;position:fixed;top:220px;'><textarea type=text disabled='disabled' style='resize:none;width:300px;height:350px'>$_SESSION[contents]</textarea></div>";
echo "<div style='left:500px;position:fixed;top:630px;'>发表自: $_SESSION[demotime]</div>";
echo "<div style='left:530px;position:fixed;top:580px;'><input type=button value='点击下载此代码' onclick=window.location.href='../model/download.php' style='width:130px;height:30px;'></div>";
echo "<div style='left:1180px;position:fixed;top:10px;'><a href='./update.php'><font color='0000FF'>修 改 资 料</font></a></div>";
echo "<div style='left:1280px;position:fixed;top:10px;'><a href='./index.php'><font color='0000FF'>返 回</font></a></div>";
?>
