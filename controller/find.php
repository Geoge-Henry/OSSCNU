<?php
session_start();
ini_set('display_errors',0);
$login=$_POST['login'];
$insert=$_POST['insert'];
$update=$_POST['update'];
$findback=$_POST['findback'];
$findback2=$_POST['findback2'];
$reset=$_POST['reset'];
$resume=array('checknum'=>$_GET['checknum'],'emails'=>$_GET['emails']);
$form=array('email'=>$_POST['email'],'password'=>$_POST['password'],'password2'=>$_POST['password2'],'username'=>$_POST['username'],'validate'=>$_POST['validate'],'checknum'=>$_POST['checknum']);
if($login['login']!=null)
{
      require_once('../model/jiami.php');
    require_once('../model/done.php');
$contr=new controller();
$contr->check($form);
}
if($insert['insert']!=null)
{
    require_once('../model/jiami.php');
    require_once('../model/done.php');
$contents=$form['email'];
$contr2=new controller();
$contr2->insert($form);
}
if($update['update']!=null)
{
    require_once('../model/jiami.php');
    require_once('../model/done.php');
$contr3= new controller();
$contr3->updated($form);
}
if($resume['checknum']!=null && $resume['emails']!=null)
{
    require_once('../model/done.php');
$contr4= new controller();
$contr4->resumenum($resume);
}
if($findback['findback']!=null)
{
    require_once('../model/done.php');
$contr5= new controller();
$contr5->sendfind($form);
}
if($findback2['findback2']!=null)
{
    require_once('../model/done.php');
$contr6= new controller();
$contr6->compare($form);
}
if($reset['reset']!=null)
{
    require_once('../model/jiami.php');
    require_once('../model/done.php');
$contr7= new controller();
$contr7->reset($form);
}

class controller
{
	function check($form)
	{
		$model= new model();
		$final=$model->done($form);
 		$result= new controller();
 		$result->show($final);
	}

	function insert($form)
	{
		$model= new model();
		$final=$model->insert($form);
		$result= new controller();
		$result->show($final);
	}

	function updated($form)
	{
		$model= new model();
		$final=$model->updated($form);
		$result= new controller();
		$result->show($final);
	}
	function resumenum($resume)
	{
		$model= new model();
		$final=$model->resumenum($resume);
		$result= new controller();
		$result->show($final);
	}
	function sendfind($form)
	{
		$model= new model();
		$final=$model->sendfind($form);
		$result= new controller();
		$result->show($final);
	}
	function compare($form)
	{
		$model= new model();
		$final=$model->compare($form);
		$result= new controller();
		$result->show($final);
	}
	function reset($form)
	{
		$model= new model();
		$final=$model->reset($form);
		$result= new controller();
		$result->show($final);
	}

	function show($final)
	{
		if($final['id']=="1")
		{
		echo "<script language=\"JavaScript\">\r\n";
		echo "alert(\"用户名和密码不能为空!\");\r\n";
            echo "location.replace(\"http://2.osscnu.sinaapp.com/index.php\");\r\n";
		echo "</script>";
		exit;
		}
		else if($final['id']=="2")
		{
		echo "<script language=\"JavaScript\">\r\n";
		echo "alert(\"用户名或密码错误!请重试!\");\r\n";
		echo "location.replace(\"http://2.osscnu.sinaapp.com/index.php\");\r\n";
		echo "</script>";
		exit;
		}
		else if($final['id']=="3")
		{
			$_SESSION['user']="123";
              echo "<script language=\"JavaScript\">\r\n";
   			  echo "location.replace(\"http://2.osscnu.sinaapp.com/view/index.php\");\r\n";
			  echo "</script>";
		      exit;
		}
		else if($final['id']=="4")
		{
		echo "<script language=\"JavaScript\">\r\n";
		echo "alert(\"两次密码输入不相同,请重试!\");\r\n";
		echo "location.replace(\"http://2.osscnu.sinaapp.com/view/insert.php\");\r\n";
		echo "</script>";
		exit;
		}
		else if($final['id']=="5")
		{
		echo "<script language=\"JavaScript\">\r\n";
		echo "alert(\"请完善表单,再注册!\");\r\n";
		echo "location.replace(\"http://2.osscnu.sinaapp.com/view/insert.php\");\r\n";
		echo "</script>";
		exit;
		}
		else if($final['id']=="6")
		{
		echo "<script language=\"JavaScript\">\r\n";
		echo "alert(\"密码必须是6~10位数字\");\r\n";
		echo "location.replace(\"http://2.osscnu.sinaapp.com/view/insert.php\");\r\n";
		echo "</script>";
		exit;
		}
		else if($final['id']=="7")
		{
		echo "<script language=\"JavaScript\">\r\n";
		echo "alert(\"用户名已经存在!\");\r\n";
		echo "location.replace(\"http://2.osscnu.sinaapp.com/view/insert.php\");\r\n";
		echo "</script>";
		exit;
		}
		else if($final['id']=="8")
		{	
           	require_once('../model/sendmail.php');
			$checknum=$final;
			$send= new sendmail();
			$send->sendout($checknum);
			echo "<script language=\"JavaScript\">\r\n";
			echo "alert(\"注册成功!请登录邮箱以激活!\");\r\n";
			echo "location.replace(\"http://2.osscnu.sinaapp.com/index.php\");\r\n";
			echo "</script>";
			exit;
		}
		else if($final['id']=="9")
		{
		echo "<script language=\"JavaScript\">\r\n";
		echo "alert(\"邮箱格式不正确!\");\r\n";
		echo "location.replace(\"http://2.osscnu.sinaapp.com/view/insert.php\");\r\n";
		echo "</script>";
		exit;
		}
		else if($final['id']=="10")
		{
		echo "<script language=\"JavaScript\">\r\n";
		echo "alert(\"验证成功!\");\r\n";
		echo "location.replace(\"http://2.osscnu.sinaapp.com/index.php\");\r\n";
		echo "</script>";
		exit;
		}
		else if($final['id']=="11")
		{
		echo "<script language=\"JavaScript\">\r\n";
		echo "alert(\"验证失败,请重试!\");\r\n";
		echo "location.replace(\"http://2.osscnu.sinaapp.com/index.php\");\r\n";
		echo "</script>";
		exit;
		}
		else if($final['id']=="12")
		{
		echo "<script language=\"JavaScript\">\r\n";
		echo "alert(\"邮箱未验证,请验证后再登录!\");\r\n";
		echo "location.replace(\"http://2.osscnu.sinaapp.com/index.php\");\r\n";
		echo "</script>";
		exit;
		}
		else if($final['id']=="13")
		{
		echo "<script language=\"JavaScript\">\r\n";
		echo "alert(\"用户昵称长度超过10字节!请重试!\");\r\n";
		echo "location.replace(\"http://2.osscnu.sinaapp.com/view/insert.php\");\r\n";
		echo "</script>";
		exit;
		}
		else if($final['id']=="14")
		{
		echo "<script language=\"JavaScript\">\r\n";
		echo "alert(\"验证码错误!请重试!\");\r\n";
		echo "location.replace(\"http://2.osscnu.sinaapp.com/index.php\");\r\n";
		echo "</script>";
		exit;
		}
		else if($final['id']=="15")
		{
		echo "<script language=\"JavaScript\">\r\n";
		echo "alert(\"验证码错误!请重试!\");\r\n";
		echo "location.replace(\"http://2.osscnu.sinaapp.com/view/insert.php\");\r\n";
		echo "</script>";
		exit;
		}
		else if($final['id']=="16")
		{
		echo "邮箱不能为空!";
		exit;
		}
		else if($final['id']=="17")
		{
		echo "邮箱不存在!!";
		exit;
		}
		else if($final['id']=="18")
		{
           	require_once('../model/sendfind.php');
			$checknum=$final;
			$send= new sendfind();
			$send->sendout($checknum);
            echo "done";
			exit;
		}
		else if($final['id']=="19")
		{
		echo "<script language=\"JavaScript\">\r\n";
		echo "alert(\"验证码为空!请重试!\");\r\n";
		echo "location.replace(\"http://2.osscnu.sinaapp.com/view/findback.php\");\r\n";
		echo "</script>";
		exit;
		}
		else if($final['id']=="20")
		{
		echo "<script language=\"JavaScript\">\r\n";
		echo "alert(\"验证码错误!请重试!\");\r\n";
		echo "location.replace(\"http://2.osscnu.sinaapp.com/view/findback.php\");\r\n";
		echo "</script>";
		exit;
		}
		else if($final['id']=="21")
		{
		$_SESSION['user']='1234';
		echo "<script language=\"JavaScript\">\r\n";
		echo "alert(\"验证成功!\");\r\n";
		echo "location.replace(\"http://2.osscnu.sinaapp.com/view/reset.php\");\r\n";
		echo "</script>";
		exit;
		}
		else if($final['id']=="22")
		{
		echo "<script language=\"JavaScript\">\r\n";
		echo "alert(\"请填写要修改的昵称或者密码!\");\r\n";
		echo "location.replace(\"http://2.osscnu.sinaapp.com/view/update.php\");\r\n";
		echo "</script>";
		exit;
		}
		else if($final['id']=="23")
		{
		echo "<script language=\"JavaScript\">\r\n";
		echo "alert(\"两次输入密码不同,请重试!\");\r\n";
		echo "location.replace(\"http://2.osscnu.sinaapp.com/view/update.php\");\r\n";
		echo "</script>";
		exit;
		}
		else if($final['id']=="24")
		{
		echo "<script language=\"JavaScript\">\r\n";
		echo "alert(\"密码长度必须在6~10位以内!\");\r\n";
		echo "location.replace(\"http://2.osscnu.sinaapp.com/view/update.php\");\r\n";
		echo "</script>";
		exit;
		}
		else if($final['id']=="25")
		{
		echo "<script language=\"JavaScript\">\r\n";
		echo "alert(\"用户昵称长度超过10字节!请重试!\");\r\n";
		echo "location.replace(\"http://2.osscnu.sinaapp.com/view/update.php\");\r\n";
		echo "</script>";
		exit;
		}
		else if($final['id']=="26")
		{
		echo "邮箱格式不正确!请重试!";
		exit;
		}
		else if($final['id']=="27")
		{
		echo "<script language=\"JavaScript\">\r\n";
		echo "alert(\"密码不能为空!\");\r\n";
		echo "location.replace(\"http://2.osscnu.sinaapp.com/view/reset.php\");\r\n";
		echo "</script>";
		exit;
		}
		else if($final['id']=="28")
		{
		echo "<script language=\"JavaScript\">\r\n";
		echo "alert(\"两次密码输入不相同!请重试\");\r\n";
		echo "location.replace(\"http://2.osscnu.sinaapp.com/view/reset.php\");\r\n";
		echo "</script>";
		exit;
		}
		else if($final['id']=="29")
		{
		echo "<script language=\"JavaScript\">\r\n";
		echo "alert(\"密码长度必须在6~10位以内!\");\r\n";
		echo "location.replace(\"http://2.osscnu.sinaapp.com/view/reset.php\");\r\n";
		echo "</script>";
		exit;
		}
		else if($final['id']=="30")
		{
		echo "<script language=\"JavaScript\">\r\n";
		echo "alert(\"修改成功!请重新登录!\");\r\n";
		echo "location.replace(\"http://2.osscnu.sinaapp.com/index.php\");\r\n";
		echo "</script>";
		exit;
		}


	}
}
?>