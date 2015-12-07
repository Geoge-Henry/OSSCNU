<?php
session_start();
ini_set('display_errors',0);
//require_once('SaeStorage.class.php');
if($_SESSION['user']!="123")
{
	header("Location:http://2.osscnu.sinaapp.com/index.php");
	exit;
}

//$file=file_get_contents("saestor://osdemo/".$_SESSION['username']."/".$_SESSION['filename']);
 $file=fopen('saestor://osdemo/'.$_SESSION['down'].'/'.$_SESSION['filename'],"r");
  header("Content-Type:application/octet-stream");
  header("Accept-Ranges: bytes");
  header("Accepy-Length:".filesize('saestor://osdemo/'.$_SESSION['down'].'/'.$_SESSION['filename']));
  header("Content-Disposition: attachment;filename=".$_SESSION['filename']);
  echo fread($file,filesize('saestor://osdemo/'.$_SESSION['down'].'/'.$_SESSION['filename']));
  fclose($file);

//$domain = "saestor://osdemo/".$_SESSION['username']."/";
//$filename = $_SESSION['filename'];
//http://zzstudy.offcn.com/archives/1495
//http://blog.csdn.net/seashoreman/article/details/20992279

//echo file_get_contents("saestor://osdemo/haha.txt");
//echo file_get_contents("saestor://osdemo/".$_SESSION['username']."/".$_SESSION['filename']);
//$stor = new SaeStorage();
//"4n0n2y241k","10z5kh00z0hjzhylmyzz055zx34mzzmj2xli0xyl"
//if(!$stor->fileExist($domain, $filename))
//  die();

//$attr = $stor->getAttr($domain, $filename);
//echo "ok".$attr;
//header("Content-Type:application/octet-stream");
//header('Content-type: '.$attr['content_type']);
//header('Content-Disposition: attachment; filename="'.$filename.'"');

//echo $stor->read($domain, $filename);
/*if(!$stor->read($domain,$filename))
echo "ok";
else
   echo "kkkkk";*/
?>