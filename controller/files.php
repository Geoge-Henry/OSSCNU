<?php
session_start();
//header("Content-type:text/html;charset=utf-8");
$files=$_POST['files'];
$demoall=$_POST['demoall'];
$recv=array('tmpname'=>$_FILES['demo']['tmp_name'],'filename'=>$_FILES['demo']['name'],'filetype'=>$_FILES['demo']['type'],'filesize'=>$_FILES['demo']['size'],'filetitle'=>$_POST['filetitle'],'contents'=>$_POST['contents']);
if($files['files']!=null)
{
require_once('../model/demo.php');
$contr8= new filecontroller();
$contr8->savedemo($recv);
}
if($demoall['demoall']!=null)
{
$recv5=strpos($recv['filetitle'],"------");
$sendrecv5=substr($recv['filetitle'],0,$recv5);
$recv6=strpos(substr($recv['filetitle'],$recv5+6),"---");
$sendrecv6=substr(substr($recv['filetitle'],$recv5+6),$recv6+3);
require_once('../model/demo.php');
$contr11= new filecontroller();
$contr11->demoall($sendrecv5,$sendrecv6);
}

class filecontroller
{
	function savedemo($recv)
	{
		$demo= new demo();
		$finally=$demo->savedemo($recv);
		$demoresult= new filecontroller();
		$demoresult->showout($finally);
	}
	function demoall($sendrecv5,$sendrecv6)
	{
		$demo= new demo();
		$finally=$demo->demoall($sendrecv5,$sendrecv6);
		$demoresult= new filecontroller();
		$demoresult->showout($finally);
	}

	function showout($finally)
	{
		if($finally['id']=='31')
		{
		echo "<script language=\"JavaScript\">\r\n";
		echo "alert(\"上传代码失败!请确认完善表单!\");\r\n";
		echo "location.replace(\"http://2.osscnu.sinaapp.com/view/publish.php\");\r\n";
		echo "</script>";
		exit;
		}
		if($finally['id']=='32')
		{
		echo "<script language=\"JavaScript\">\r\n";
		echo "alert(\"上传代码成功!\");\r\n";
		echo "location.replace(\"http://2.osscnu.sinaapp.com/view/publish.php\");\r\n";
		echo "</script>";
		exit;	
		}
		if($finally['id']=='33')
		{
		echo "<script language=\"JavaScript\">\r\n";
		echo "location.replace(\"http://2.osscnu.sinaapp.com/view/showdemo.php\");\r\n";
		echo "</script>";
		exit;	
		}
		if($finally['id']=='34')
		{
		echo "<script language=\"JavaScript\">\r\n";
		echo "alert(\"读取失败!\");\r\n";
		echo "location.replace(\"http://2.osscnu.sinaapp.com/view/index.php\");\r\n";
		echo "</script>";
		exit;	
		}


	}
}
//echo file_get_contents("/home/henry/pokers/".$_FILES['demo']['name']);
?>
