<?php
session_start();
//header("Content-type:text/html;charset=utf-8");
ini_set('display_errors',0);
class scnublog
{
	function searchusername()
	{
		$con=mysql_connect(SAE_MYSQL_HOST_M.':'.SAE_MYSQL_PORT,SAE_MYSQL_USER,SAE_MYSQL_PASS);
		if(!$con)
		{
			die('Could not connect:'.mysql_error());
		}
		mysql_query("set names utf8");
		mysql_select_db(SAE_MYSQL_DB,$con);
		$usr=$_SESSION['username'];
		$sql="select * from login where email='$usr'";
		$res=mysql_query($sql,$con);
		if(mysql_num_rows($res))
		{
			$row=mysql_fetch_array($res);
			return $row['username'];
		}
		else
		{
			mysql_close($con);
			return false;
		}
	}

	function blogsave($recv2)
	{
		$checknumber=array('id'=>null);
		if($recv2['blogtitle']==null ||  $recv2['blogcontents']==null)
		{
			$checknumber=array('id'=>'41');
			return $checknumber;
		}
		$con=mysql_connect(SAE_MYSQL_HOST_M.':'.SAE_MYSQL_PORT,SAE_MYSQL_USER,SAE_MYSQL_PASS);
		if(!$con)
		{
			die('Could not connect:'.mysql_error());
		}
		mysql_query("set names utf8");
		mysql_select_db(SAE_MYSQL_DB,$con);
		$usr=$_SESSION['username'];
		$search= new scnublog();
		$usrname=$search->searchusername();
		$time=date('Y/m/d h:i:s',time());
		$sql="insert into blog(email,username,blogtitle,blogcontents,time) values('$usr','$usrname','$recv2[blogtitle]','$recv2[blogcontents]','$time')";
		if(!mysql_query($sql,$con))
		{
			mysql_close($con);
			die('Error:'.mysql_error);
		}
		mysql_close($con);
		$checknumber=array('id'=>'42');
		return $checknumber;
	}
	function showmyblog()
	{
		$checknumber=array('id'=>null);
		$con=mysql_connect(SAE_MYSQL_HOST_M.':'.SAE_MYSQL_PORT,SAE_MYSQL_USER,SAE_MYSQL_PASS);
		if(!$con)
		{
			die('Could not connect:'.mysql_error());
		}
		mysql_query("set names utf8");
		mysql_select_db(SAE_MYSQL_DB,$con);
		$usr=$_SESSION['username'];
		$sql="select * from blog where email='$usr' order by id desc limit 10";
		$res=mysql_query($sql,$con);
		$result=array();
		$num=mysql_num_rows($res);
		if($num)
		{
			while($row=mysql_fetch_array($res))
			{
				array_push($result,$row['blogtitle'].'------'.$row['time']);
			}
			mysql_close($con);
			return $result;
		}
		mysql_close($con);
	}
	function showblog()
	{
		$checknumber=array('id'=>null);
		$con=mysql_connect(SAE_MYSQL_HOST_M.':'.SAE_MYSQL_PORT,SAE_MYSQL_USER,SAE_MYSQL_PASS);
		if(!$con)
		{
			die('Could not connect:'.mysql_error());
		}
		mysql_query("set names utf8");
		mysql_select_db(SAE_MYSQL_DB,$con);
		$sql="select * from blog order by id desc limit 10";
		$res=mysql_query($sql,$con);
		$result=array();
		$num=mysql_num_rows($res);
		if($num)
		{
			while($row=mysql_fetch_array($res))
			{
				array_push($result,$row['blogtitle'].'------'.$row['time']);
			}
			mysql_close($con);
			return $result;
		}
		mysql_close($con);
	}

	function blogshow($sendrecv,$sendrecv2)
	{
		$checknumber=array('id'=>null);
		$con=mysql_connect(SAE_MYSQL_HOST_M.':'.SAE_MYSQL_PORT,SAE_MYSQL_USER,SAE_MYSQL_PASS);
		if(!$con)
		{
			die('Could not connect:'.mysql_error());
		}
		mysql_query("set names utf8");
		mysql_select_db(SAE_MYSQL_DB,$con);
		$sql="select * from blog where blogtitle='$sendrecv' and time='$sendrecv2'";
		$res=mysql_query($sql,$con);
		$row=mysql_fetch_array($res);
		$num=mysql_num_rows($res);
		if($num)
		{
			$checknumber=array('id'=>'43');
			$_SESSION['blogtitle']=$row['blogtitle'];
			$_SESSION['blogcontents']=$row['blogcontents'];
			$_SESSION['mytime']=$sendrecv2;
			mysql_close($con);
			return $checknumber;
		}
		$checknumber=array('id'=>'44');
		mysql_close($con);
		return $checknumber;
		
	}

}

?>
