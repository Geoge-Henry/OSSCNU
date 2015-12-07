<?php
session_start();
//header("Content-type:text/html;charset=utf-8");
$blogwrite=$_POST['blogwrite'];
$showmyblog=$_POST['showmyblog'];
$showblog=$_POST['showblog'];
$recv2=array('blogtitle'=>$_POST['blogtitle'],'blogcontents'=>$_POST['blogcontents']);

if($blogwrite!=null)
{
require_once('../model/scnublog.php');
$contr9= new blog();
$contr9->blogwrite($recv2);
}
if($showmyblog!=null)
{
	$recv3=strpos($recv2['blogtitle'],"------");
	$sendrecv=substr($recv2['blogtitle'],0,$recv3);
	$sendrecv2=substr($recv2['blogtitle'],$recv3+6);
   	require_once('../model/scnublog.php');
	$_SESSION['select']="select2";
	$contr9= new blog();
	$contr9->blogshow($sendrecv,$sendrecv2);
}
if($showblog!=null)
{
	$recv4=strpos($recv2['blogtitle'],"------");
	$sendrecv3=substr($recv2['blogtitle'],0,$recv4);
	$sendrecv4=substr($recv2['blogtitle'],$recv4+6);
    require_once('../model/scnublog.php');
	$_SESSION['select']="select";
	$contr10= new blog();
	$contr10->blogshow($sendrecv3,$sendrecv4);
}

class blog
{
	function blogwrite($recv2)
	{
		$scnublog= new scnublog();
		$finally2=$scnublog->blogsave($recv2);
		$blogresult= new blog();
		$blogresult->showout($finally2);
	}
	function blogshow($sendrecv,$sendrecv2)
	{
		$scnublog= new scnublog();
		$finally2=$scnublog->blogshow($sendrecv,$sendrecv2);
		$blogresult= new blog();
		$blogresult->showout($finally2);
	}

	function showout($finally2)
	{
		if($finally2['id']=='41')
		{
		echo "<script language=\"JavaScript\">\r\n";
		echo "alert(\"上传博文失败!请确认完善博文!\");\r\n";
		echo "location.replace(\"http://2.osscnu.sinaapp.com/view/blogwrite.php\");\r\n";
		echo "</script>";
		exit;
		}
		else if($finally2['id']=='42')
		{
		echo "<script language=\"JavaScript\">\r\n";
		echo "alert(\"上传博文成功!\");\r\n";
		echo "location.replace(\"http://2.osscnu.sinaapp.com/view/blogwrite.php\");\r\n";
		echo "</script>";
		exit;
		}
		else if($finally2['id']=='43')
		{
		echo "<script language=\"JavaScript\">\r\n";
		echo "location.replace(\"http://2.osscnu.sinaapp.com/view/showblog.php\");\r\n";
		echo "</script>";
		exit;
		}
		else if($finally2['id']=='44')
		{
		echo "<script language=\"JavaScript\">\r\n";
		echo "alert(\"博文读取失败!\");\r\n";
		echo "location.replace(\"http://2.osscnu.sinaapp.com/view/index.php\");\r\n";
		echo "</script>";
		exit;
		}
	
	}

}

?>
