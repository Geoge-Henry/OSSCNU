<?php
session_start();
?>
<meta http-equiv=Content-Type content="text/html;charset=utf8">
<style>
#bodybg4{
position:absolute;
width:100%;
height:100%;
left:0px;
top:0px;
z-index:0;
}
#bodybg4 .stretch4{width:100%;height:100%;}
</style>
<script language="JavaScript">
function qq(){
//提交操作
var btn = document.getElementById("btn");
btn.disabled=true;
var msg = document.getElementById("msg");
//获取表单对象和用户信息值
var f = document.form1;
var email = f.email.value;
var findback = f.findback.value;
//接收表单的URL地址
var url = "../controller/find.php";
//需要POST的值，把每个变量都通过&来联接
var postStr = "email="+ email + "&findback=" + findback;
           var ajax = false;
          //开始初始化XMLHttpRequest对象
          if(window.XMLHttpRequest) { //Mozilla 浏览器
                  ajax = new XMLHttpRequest();
                  if (ajax.overrideMimeType) {//设置MiME类别
                          ajax.overrideMimeType("text/xml");
                  }
          }
          else if (window.ActiveXObject) { // IE浏览器
                  try {
                          ajax = new ActiveXObject("Msxml2.XMLHTTP");
                  } catch (e) {
                          try {
                                  ajax = new ActiveXObject("Microsoft.XMLHTTP");
                          } catch (e) {}
                  }
          }
          if (!ajax) { // 异常，创建对象实例失败
                  window.alert("不能创建XMLHttpRequest对象实例.");
                  return false;
          }
               
               
               
//通过Post方式打开连接
ajax.open("POST", url, true);
//定义传输的文件HTTP头信息
ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
//发送POST数据
ajax.send(postStr);
//获取执行状态
ajax.onreadystatechange = function() {
    //如果执行状态成功，那么就把返回信息写到指定的层里
    if (ajax.readyState == 4 && ajax.status == 200) {
     var str = ajax.responseText;
		if(str.substring(0,3)=="don")
		c(60);
		else
		{
		alert(str.substring(0,7));
		window.location.href="http://2.osscnu.sinaapp.com/view/findback.php";
		}
    }
}

}
function c(i){
 var btn = document.getElementById("btn");
 var e=document.getElementById("email");
 i--;
 if(i==0){
  btn.value = "点击获取验证码";
  e.disabled=false;
  btn.disabled=false;
 }
 else{
  btn.value = "重新获取验证码("+i+")";
  e.disabled="disabled";
  setTimeout("c("+i+")",1000);
 }
}

function d(){
var d=document.getElementById("email");
var e=document.getElementById("email2");
e.value=d.value;
}

</script>

<?php
$_SESSION=array();
ini_set('display_errors',0);
if(isset($_COOKIE[session_name()]))
{
	setcookie(session_name(),'',time()-42000,'/');
}
header("Content-type:text/html;charset=utf-8");
echo "<div id='bodybg4'><img src='../picture/11.jpg' class='stretch4'/></div>";
echo "<div style='left:540px;position:fixed;top:100px;'><h2>通过注册邮箱找回密码</h2></div>";
echo "<div id='msg'></div>";
echo "<div><form action='../controller/find.php' id='form1' name='form1' method=post></div>
	  <input type=hidden name=findback value='findback'>
	  <div style='left:510px;position:fixed;top:180px;'>邮箱: </div>
	  <div style='left:510px;position:fixed;top:210px;'><input type=text name=email placeholder='邮箱号' id='email'></div>
	  <div style='left:700px;position:fixed;top:210px;'><input type=button onclick='qq()' id=btn value='点击获取验证码' style='width:135;height:25px'></div>
	  </form>";
echo "<div><form action='../controller/find.php' id='form2' onsubmit='d()'  method=post></div>
	  <input type=hidden name=findback2 value='findback2'>
	  <input type=hidden name=email id='email2' value=''>
	  <div style='left:510px;position:fixed;top:250px;'>验证码: </div>
	  <div style='left:510px;position:fixed;top:280px;'><input type=text name=checknum placeholder='验证码'></div>
	  <div style='left:700px;position:fixed;top:280px;'><input type=submit value='验证' style='width:135;height:25px'></div></form>";
echo "<div style=left:510px;position:fixed;top:320px><a href='./index.php'><font color='009900'>后 退</font></a></div>";
?>
