<?php
session_start();
?>
<style>
#bodybg3{
position:absolute;
width:100%;
height:100%;
left:0px;
top:0px;
z-index:0;
}
#bodybg3 .stretch3{width:100%;height:100%;}
</style>
<script language="JavaScript">
function submit(i){
//提交操作
var f1 = document.getElementById("form"+i);
f1.submit();
//document.form1.submit();
}
</script>
<?php
ini_set('display_errors',0);
if($_SESSION['user']!="123")
{
    echo "<script language=\"JavaScript\">\r\n";
    echo "location.replace(\"http://2.osscnu.sinaapp.com/index.php\");\r\n";
	echo "</script>";
	exit;
}
echo "<div id='bodybg3'><img src='../picture/9.jpg' class='stretch3'/></div>";
echo "<div style='left:540px;position:fixed;top:90px;'><h3>博&nbsp&nbsp&nbsp客&nbsp&nbsp&nbsp区</h3></div>";
echo "<div style='left:540px;position:fixed;top:580px;'><input type=button onclick=window.location.href='./blogwrite.php' value='进入我的博客'></div>";
echo "<div style='left:440px;position:fixed;top:0px;'><h1>欢迎来到华师开源代码部落</h1></div>";
echo "<div style='left:940px;position:fixed;top:10px;'>我的账号: $_SESSION[username]</a></div>";
echo "<div style='left:1180px;position:fixed;top:10px;'><a href='./update.php'><font color='0000FF'>修 改 资 料</font></a></div>";
echo "<div style='left:1280px;position:fixed;top:10px;'><a href='../index.php'><font color='0000FF'>退 出</font></a></div>";
echo "<div style='left:100px;position:fixed;top:60px;'><h3>开&nbsp&nbsp源&nbsp&nbsp代&nbsp&nbsp码&nbsp&nbsp区</h3></div>";
echo "<div style='left:50px;position:fixed;top:130px;'>今日更新:</div>";
echo "<div style='left:80px;position:fixed;top:560px;'><input type=button onclick=window.location.href='./publish.php' value='发布我的开源代码' style='width:130;height:30px'></div>";

require_once('../model/scnublog.php');
$showblog= new scnublog();
$blogres=$showblog->showblog();
echo "<div style='left:500px;position:fixed;top:150px;'><a href='javascript:void(0)' onclick='submit(1)'><font color='0000FF'>$blogres[0]</font></a></div></br>";
echo "<div style='left:500px;position:fixed;top:190px;'><a href='javascript:void(0)' onclick='submit(2)'><font color='0000FF'>$blogres[1]</font></a></div></br>";
echo "<div style='left:500px;position:fixed;top:230px;'><a href='javascript:void(0)' onclick='submit(3)'><font color='0000FF'>$blogres[2]</font></a></div></br>";
echo "<div style='left:500px;position:fixed;top:270px;'><a href='javascript:void(0)' onclick='submit(4)'><font color='0000FF'>$blogres[3]</font></a></div></br>";
echo "<div style='left:500px;position:fixed;top:310px;'><a href='javascript:void(0)' onclick='submit(5)'><font color='0000FF'>$blogres[4]</font></a></div></br>";
echo "<div style='left:500px;position:fixed;top:350px;'><a href='javascript:void(0)' onclick='submit(6)'><font color='0000FF'>$blogres[5]</font></a></div></br>";
echo "<div style='left:500px;position:fixed;top:390px;'><a href='javascript:void(0)' onclick='submit(7)'><font color='0000FF'>$blogres[6]</font></a></div></br>";
echo "<div style='left:500px;position:fixed;top:430px;'><a href='javascript:void(0)' onclick='submit(8)'><font color='0000FF'>$blogres[7]</font></a></div></br>";
echo "<div style='left:500px;position:fixed;top:470px;'><a href='javascript:void(0)' onclick='submit(9)'><font color='0000FF'>$blogres[8]</font></a></div></br>";
echo "<div style='left:500px;position:fixed;top:510px;'><a href='javascript:void(0)' onclick='submit(10)'><font color='0000FF'>$blogres[9]</font></a></div></br>";
echo "<div><form id='form1' action='../controller/blog.php' method='post'></div>";
echo "<input type=hidden name=showblog value='showblog'>
	  <input type=hidden name=blogtitle id=blogtitle value='$blogres[0]'></form>";
echo "<div><form id='form2' action='../controller/blog.php' method='post'></div>";
echo "<input type=hidden name=showblog value='showblog'>
	  <input type=hidden name=blogtitle id=blogtitle value='$blogres[1]'></form>";
echo "<div><form id='form3' action='../controller/blog.php' method='post'></div>";
echo "<input type=hidden name=showblog value='showblog'>
	  <input type=hidden name=blogtitle id=blogtitle value='$blogres[2]'></form>";
echo "<div><form id='form4' action='../controller/blog.php' method='post'></div>";
echo "<input type=hidden name=showblog value='showblog'>
	  <input type=hidden name=blogtitle id=blogtitle value='$blogres[3]'></form>";
echo "<div><form id='form5' action='../controller/blog.php' method='post'></div>";
echo "<input type=hidden name=showblog value='showblog'>
	  <input type=hidden name=blogtitle id=blogtitle value='$blogres[4]'></form>";
echo "<div><form id='form6' action='../controller/blog.php' method='post'></div>";
echo "<input type=hidden name=showblog value='showblog'>
	  <input type=hidden name=blogtitle id=blogtitle value='$blogres[5]'></form>";
echo "<div><form id='form7' action='../controller/blog.php' method='post'></div>";
echo "<input type=hidden name=showblog value='showblog'>
	  <input type=hidden name=blogtitle id=blogtitle value='$blogres[6]'></form>";
echo "<div><form id='form8' action='../controller/blog.php' method='post'></div>";
echo "<input type=hidden name=showblog value='showblog'>
	  <input type=hidden name=blogtitle id=blogtitle value='$blogres[7]'></form>";
echo "<div><form id='form9' action='../controller/blog.php' method='post'></div>";
echo "<input type=hidden name=showblog value='showblog'>
	  <input type=hidden name=blogtitle id=blogtitle value='$blogres[8]'></form>";
echo "<div><form id='form10' action='../controller/blog.php' method='post'></div>";
echo "<input type=hidden name=showblog value='showblog'>
	  <input type=hidden name=blogtitle id=blogtitle value='$blogres[9]'></form>";


require_once('../model/demo.php');
$kk= new demo();
$rr=$kk->showdemo();
echo "<div style='left:70px;position:fixed;top:170px;'><a href='javascript:void(0)' onclick='submit(11)'><font color='0000FF'>$rr[0]</font></a></div></br>";
echo "<div style='left:70px;position:fixed;top:210px;'><a href='javascript:void(0)' onclick='submit(12)'><font color='0000FF'>$rr[1]</font></a></div></br>";
echo "<div style='left:70px;position:fixed;top:250px;'><a href='javascript:void(0)' onclick='submit(13)'><font color='0000FF'>$rr[2]</font></a></div></br>";
echo "<div style='left:70px;position:fixed;top:290px;'><a href='javascript:void(0)' onclick='submit(14)'><font color='0000FF'>$rr[3]</font></a></div></br>";
echo "<div style='left:70px;position:fixed;top:330px;'><a href='javascript:void(0)' onclick='submit(15)'><font color='0000FF'>$rr[4]</font></a></div></br>";
echo "<div style='left:70px;position:fixed;top:370px;'><a href='javascript:void(0)' onclick='submit(16)'><font color='0000FF'>$rr[5]</font></a></div></br>";
echo "<div style='left:70px;position:fixed;top:410px;'><a href='javascript:void(0)' onclick='submit(17)'><font color='0000FF'>$rr[6]</font></a></div></br>";
echo "<div style='left:70px;position:fixed;top:450px;'><a href='javascript:void(0)' onclick='submit(18)'><font color='0000FF'>$rr[7]</font></a></div></br>";
echo "<div style='left:70px;position:fixed;top:490px;'><a href='javascript:void(0)' onclick='submit(19)'><font color='0000FF'>$rr[8]</font></a></div></br>";
echo "<div style='left:70px;position:fixed;top:530px;'><a href='javascript:void(0)' onclick='submit(20)'><font color='0000FF'>$rr[9]</font></a></div></br>";
echo "<div><form id='form11' action='../controller/files.php' method='post'></div>";
echo "<input type=hidden name=demoall value='demoall'>
	  <input type=hidden name=filetitle id=filetitle value='$rr[0]'></form>";
echo "<div><form id='form12' action='../controller/files.php' method='post'></div>";
echo "<input type=hidden name=demoall value='demoall'>
	  <input type=hidden name=filetitle id=filetitle value='$rr[1]'></form>";
echo "<div><form id='form13' action='../controller/files.php' method='post'></div>";
echo "<input type=hidden name=demoall value='demoall'>
	  <input type=hidden name=filetitle id=filetitle value='$rr[2]'></form>";
echo "<div><form id='form14' action='../controller/files.php' method='post'></div>";
echo "<input type=hidden name=demoall value='demoall'>
	  <input type=hidden name=filetitle id=filetitle value='$rr[3]'></form>";
echo "<div><form id='form15' action='../controller/files.php' method='post'></div>";
echo "<input type=hidden name=demoall value='demoall'>
	  <input type=hidden name=filetitle id=filetitle value='$rr[4]'></form>";
echo "<div><form id='form16' action='../controller/files.php' method='post'></div>";
echo "<input type=hidden name=demoall value='demoall'>
	  <input type=hidden name=filetitle id=filetitle value='$rr[5]'></form>";
echo "<div><form id='form17' action='../controller/files.php' method='post'></div>";
echo "<input type=hidden name=demoall value='demoall'>
	  <input type=hidden name=filetitle id=filetitle value='$rr[6]'></form>";
echo "<div><form id='form18' action='../controller/files.php' method='post'></div>";
echo "<input type=hidden name=demoall value='demoall'>
	  <input type=hidden name=filetitle id=filetitle value='$rr[7]'></form>";
echo "<div><form id='form19' action='../controller/files.php' method='post'></div>";
echo "<input type=hidden name=demoall value='demoall'>
	  <input type=hidden name=filetitle id=filetitle value='$rr[8]'></form>";
echo "<div><form id='form20' action='../controller/files.php' method='post'></div>";
echo "<input type=hidden name=demoall value='demoall'>
	  <input type=hidden name=filetitle id=filetitle value='$rr[9]'></form>";
?>
