<?php
session_start();
?>
<style>
#bodybg7{
position:absolute;
width:100%;
height:100%;
left:0px;
top:0px;
z-index:0;
}
#bodybg7 .stretch7{width:100%;height:100%;}
</style>
<script language="JavaScript">
function submit(i){
//提交操作
var f1 = document.getElementById("form"+i);
var b1 = document.getElementById("blogtitle");
f1.submit();
//document.form1.submit();
}
</script>
<?php
ini_set('display_errors',0);
if($_SESSION['user']!="123")
{
	header("Location:http://2.osscnu.sinaapp.com/index.php");
	exit;
}
echo "<div id='bodybg7'><img src='../picture/9.jpg' class='stretch7'/></div>";
echo "<div style='left:500px;position:fixed;top:30px;'><h2>编&nbsp&nbsp写&nbsp&nbsp我&nbsp&nbsp的&nbsp&nbsp博&nbsp&nbsp客</h2></div>";
echo "<div style='left:940px;position:fixed;top:10px;'>我的账号: $_SESSION[username]</a></div>";
echo "<div><form action='../controller/blog.php' method=post></div>";
echo "<div style='left:480px;position:fixed;top:130px;'><h4>标题:&nbsp <input type=text name=blogtitle></h4></div>";
echo "<input type=hidden name=blogwrite value='blogwrite'>";
echo "<div style='left:480px;position:fixed;top:180px;'><h4>内容:&nbsp</h4></div>";
echo "<div style='left:480px;position:fixed;top:230px;'><textarea type=text name=blogcontents style='resize:none;width:300px;height:350px;'></textarea></div>";
echo "<div style='left:500px;position:fixed;top:600px;'><input type=submit value='发 表' style='width:80px;height:30px;'></div>";
echo "<div style='left:630px;position:fixed;top:600px;'><input type=reset  value='重 置' style='width:80px;height:30px;'></form></div>";
echo "<div style='left:1180px;position:fixed;top:10px;'><a href='./update.php'><font color='0000FF'>修 改 资 料</font></a></div>";
echo "<div style='left:1280px;position:fixed;top:10px;'><a href='./index.php'><font color='0000FF'>返 回</font></a></div>";
echo "<div style='left:100px;position:fixed;top:70px;'><h3>我&nbsp&nbsp的&nbsp&nbsp博&nbsp&nbsp客</h3></div>";
//echo "<div style='left:120px;position:fixed;top:100px;'><a href='./showmyblog.php'>我的博客</a></div>";
require_once('../model/scnublog.php');
$kk= new scnublog();
$rr=$kk->showmyblog();
echo "<div style='left:70px;position:fixed;top:140px;'><a href='javascript:void(0)' onclick='submit(1)'><font color='0000FF'>$rr[0]</font></a></div></br>";
echo "<div style='left:70px;position:fixed;top:170px;'><a href='javascript:void(0)' onclick='submit(2)'><font color='0000FF'>$rr[1]</font></a></div></br>";
echo "<div style='left:70px;position:fixed;top:200px;'><a href='javascript:void(0)' onclick='submit(3)'><font color='0000FF'>$rr[2]</font></a></div></br>";
echo "<div style='left:70px;position:fixed;top:230px;'><a href='javascript:void(0)' onclick='submit(4)'><font color='0000FF'>$rr[3]</font></a></div></br>";
echo "<div style='left:70px;position:fixed;top:260px;'><a href='javascript:void(0)' onclick='submit(5)'><font color='0000FF'>$rr[4]</font></a></div></br>";
echo "<div style='left:70px;position:fixed;top:290px;'><a href='javascript:void(0)' onclick='submit(6)'><font color='0000FF'>$rr[5]</font></a></div></br>";
echo "<div style='left:70px;position:fixed;top:320px;'><a href='javascript:void(0)' onclick='submit(7)'><font color='0000FF'>$rr[6]</font></a></div></br>";
echo "<div style='left:70px;position:fixed;top:350px;'><a href='javascript:void(0)' onclick='submit(8)'><font color='0000FF'>$rr[7]</font></a></div></br>";
echo "<div style='left:70px;position:fixed;top:380px;'><a href='javascript:void(0)' onclick='submit(9)'><font color='0000FF'>$rr[8]</font></a></div></br>";
echo "<div style='left:70px;position:fixed;top:410px;'><a href='javascript:void(0)' onclick='submit(10)'><font color='0000FF'>$rr[9]</font></a></div></br>";
echo "<div><form id='form1' action='../controller/blog.php' method='post'></div>";
echo "<input type=hidden name=showmyblog value='showmyblog'>
	  <input type=hidden name=blogtitle id=blogtitle value='$rr[0]'></form>";
echo "<div><form id='form2' action='../controller/blog.php' method='post'></div>";
echo "<input type=hidden name=showmyblog value='showmyblog'>
	  <input type=hidden name=blogtitle id=blogtitle value='$rr[1]'></form>";
echo "<div><form id='form3' action='../controller/blog.php' method='post'></div>";
echo "<input type=hidden name=showmyblog value='showmyblog'>
	  <input type=hidden name=blogtitle id=blogtitle value='$rr[2]'></form>";
echo "<div><form id='form4' action='../controller/blog.php' method='post'></div>";
echo "<input type=hidden name=showmyblog value='showmyblog'>
	  <input type=hidden name=blogtitle id=blogtitle value='$rr[3]'></form>";
echo "<div><form id='form5' action='../controller/blog.php' method='post'></div>";
echo "<input type=hidden name=showmyblog value='showmyblog'>
	  <input type=hidden name=blogtitle id=blogtitle value='$rr[4]'></form>";
echo "<div><form id='form6' action='../controller/blog.php' method='post'></div>";
echo "<input type=hidden name=showmyblog value='showmyblog'>
	  <input type=hidden name=blogtitle id=blogtitle value='$rr[5]'></form>";
echo "<div><form id='form7' action='../controller/blog.php' method='post'></div>";
echo "<input type=hidden name=showmyblog value='showmyblog'>
	  <input type=hidden name=blogtitle id=blogtitle value='$rr[6]'></form>";
echo "<div><form id='form8' action='../controller/blog.php' method='post'></div>";
echo "<input type=hidden name=showmyblog value='showmyblog'>
	  <input type=hidden name=blogtitle id=blogtitle value='$rr[7]'></form>";
echo "<div><form id='form9' action='../controller/blog.php' method='post'></div>";
echo "<input type=hidden name=showmyblog value='showmyblog'>
	  <input type=hidden name=blogtitle id=blogtitle value='$rr[8]'></form>";
echo "<div><form id='form10' action='../controller/blog.php' method='post'></div>";
echo "<input type=hidden name=showmyblog value='showmyblog'>
	  <input type=hidden name=blogtitle id=blogtitle value='$rr[9]'></form>";

?>
