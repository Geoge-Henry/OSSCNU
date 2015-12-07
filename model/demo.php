<?php
session_start();
//header("Content-type:text/html;charset=utf-8");
ini_set('display_errors',0);
class demo
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

	function savedemo($recv)
	{
        $usr=$_SESSION['username'];
		$checknumber=array('id'=>null);
		if(empty($recv['filename']) || empty($recv['filetitle']) || empty($recv['contents']))
		{
			$checknumber=array('id'=>'31');
			return $checknumber;
		}	
        $b=move_uploaded_file($recv['tmpname'],'saestor://osdemo/'.$usr.'/'.$recv['filename']);
        //echo file_get_contents("/home/henry/pokers/".$_FILES['demo']['name']);
		if($b)
		{
			$con=mysql_connect(SAE_MYSQL_HOST_M.':'.SAE_MYSQL_PORT,SAE_MYSQL_USER,SAE_MYSQL_PASS);
			if(!$con)
			{
				die('Could not connect:'.mysql_error());
			}
			mysql_query("set names utf8");
			mysql_select_db(SAE_MYSQL_DB,$con);
			$getusr= new demo();
			$username=$getusr->searchusername();
			$time=date('Y/m/d h:i:s',time());
			$sql="insert into demo(email,filename,username,filetitle,contents,time) values('$usr','$recv[filename]','$username','$recv[filetitle]','$recv[contents]','$time') ";
			if(!mysql_query($sql,$con))
			{
				mysql_close($con);
				die('Error:'.mysql_error);
			}
			mysql_close($con);
			$checknumber=array('id'=>'32');
			return $checknumber;
		}
	}

	function showdemo()
	{
		$checknumber=array('id'=>null);
		$con=mysql_connect(SAE_MYSQL_HOST_M.':'.SAE_MYSQL_PORT,SAE_MYSQL_USER,SAE_MYSQL_PASS);
		if(!$con)
		{
			die('Could not connect:'.mysql_error());
		}
		mysql_query("set names utf8");
		mysql_select_db(SAE_MYSQL_DB,$con);
		$getusr= new demo();
		$username=$getusr->searchusername();
		$sql="select * from demo order by id desc limit 10";
		$res=mysql_query($sql,$con);
		$result=array();
		$num=mysql_num_rows($res);
		if($num)
		{
			while($row=mysql_fetch_array($res))
			{
				array_push($result,$row['filetitle'].'------'.$row['username'].'---'.$row[time]);
			}
			mysql_close($con);
			return $result;
		}
		mysql_close($con);
		return false;
	}

	function demoall($sendrecv5,$sendrecv6)
	{
		$checknumber=array('id'=>null);
		$con=mysql_connect(SAE_MYSQL_HOST_M.':'.SAE_MYSQL_PORT,SAE_MYSQL_USER,SAE_MYSQL_PASS);
		if(!$con)
		{
			die('Could not connect:'.mysql_error());
		}
		mysql_query("set names utf8");
		mysql_select_db(SAE_MYSQL_DB,$con);
		$sql="select * from demo where filetitle='$sendrecv5' and time='$sendrecv6'";
		$res=mysql_query($sql,$con);
		$num=mysql_num_rows($res);
		if($num)
		{
			$row=mysql_fetch_array($res);
			$checknumber=array('id'=>'33');
			$_SESSION['filename']=$row['filename'];
			$_SESSION['filetitle']=$row['filetitle'];
			$_SESSION['contents']=$row['contents'];
			$_SESSION['demotime']=$row['time'];
            $_SESSION['down']=$row['email'];
			mysql_close($con);
			return $checknumber;
		}
		mysql_close($con);
		$checknumber=array('id'=>'34');
		return $checknumber;
	}



}
