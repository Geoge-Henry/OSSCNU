<?php
session_start();
ini_set('display_errors',0);
class model
{
	function done($form)
	{
		$checknumber=array('id'=>null,'ran'=>null,'email'=>null);
		if($form['email']==null ||  $form['password']==null)
		{
			$checknumber=array('id'=>'1');
			return $checknumber;
        }
		else 
		{	
			$con=mysql_connect(SAE_MYSQL_HOST_M.':'.SAE_MYSQL_PORT,SAE_MYSQL_USER,SAE_MYSQL_PASS);
			if(!$con)
			{
				die('Could not connect:'.mysql_error());
			}
			mysql_query("set names utf8");
			mysql_select_db(SAE_MYSQL_DB,$con);
            $code= new CRYPT();
            $encodepsw=$code->encrypt($form['password']);
			$sql="select * from login where email='$form[email]' and password='$encodepsw'";
			$res=mysql_query($sql,$con);
			if(mysql_num_rows($res))
			{
				$sql="select * from login where email='$form[email]'";
				$res2=mysql_query($sql,$con);
				$row=mysql_fetch_array($res2);
				if($row['checknum']!=null)
				{
					$checknumber=array('id'=>'12');
					return $checknumber;
				}
				$validate=$form['validate'];
				if($validate!=$_SESSION['authnum_session'])
				{
					$checknumber=array('id'=>'14');
					return $checknumber;
				}
                
				$_SESSION['username']=$form['email'];
                //                echo "<script language=\"JavaScript\">\r\n";
                //echo "alert('$_SESSION[username]');\r\n";
                //echo "</script>";
				mysql_close($con);
				$checknumber=array('id'=>'3');
				return $checknumber;
			}
			else
			{
				mysql_close($con);
				$checknumber=array('id'=>'2');
				return $checknumber;
			}
		}
	}

	function insert($form)
	{
		$checknumber=array('id'=>null,'ran'=>null,'email'=>null);
		if($form['email']==null || $form['password']==null || $form['password2']==null || $form['username']==null)
		{	
			$checknumber=array('id'=>'5');
			return $checknumber;
		}
		if($form['password']!=$form['password2'])
		{
			$checknumber=array('id'=>'4');
			return $checknumber;
		}
		$length=strlen($form['password']);
		if($length>10 || $length<6)
		{
			$checknumber=array('id'=>'6');
			return $checknumber;
		}
		$length2=mb_strlen($form['username'],'UTF-8');
		if($length2>5)
		{
			$checknumber=array('id'=>'13');
			return $checknumber;
		}
		$zhengcheck= new model();
		$survey=$zhengcheck->pregE($form['email']);
		if($survey!=1)
		{
			$checknumber=array('id'=>'9');
			return $checknumber;
		}
		$con=mysql_connect(SAE_MYSQL_HOST_M.':'.SAE_MYSQL_PORT,SAE_MYSQL_USER,SAE_MYSQL_PASS);
		if(!$con)
		{
			die('Could not connect:'.mysql_error());
		}
		mysql_query("set names utf8");
		mysql_select_db(SAE_MYSQL_DB,$con);
		$sql="select * from login where email='$form[email]'";
		$res=mysql_query($sql,$con);
		if(mysql_num_rows($res))
		{
			mysql_close($con);
			$checknumber=array('id'=>'7');
			return $checknumber;
		}
		$validate=$form['validate'];
		if($validate!=$_SESSION['authnum_session'])
		{
			mysql_close($con);
			$checknumber=array('id'=>'15');
			return $checknumber;
		}
		$ran=rand(100000,999999);
		$checknumber=array('id'=>'8','ran'=>$ran,'email'=>$form['email']);
		$code= new CRYPT();
		$encodepsw=$code->encrypt($form['password']);
		$sql="insert into login(email,password,username,checknum) values('$form[email]','$encodepsw','$form[username]','$ran')";
		if(!mysql_query($sql,$con))
		{
			mysql_close($con);
			die('Error:'.mysql_error);
		}
		mysql_close($con);
		return $checknumber;
	}
	function updated($form)
	{
		$usr=$_SESSION['username'];
	
		$checknumber=array('id'=>null,'ran'=>null,'email'=>null);
		if($form['password']==null && $form['password2']==null && $form['username']==null)
		{
			$checknumber=array('id'=>'22');
			return $checknumber;
		}
		if($form['password']!=null || $form['password2']!=null)
		{
			if($form['password']!=$form['password2'])
			{
				$checknumber=array('id'=>'23');
				return $checknumber;
			}
			$length=strlen($form['password']);
			echo $length;
			if($length>10 || $length<6)
			{
				$checknumber=array('id'=>'24');
				return $checknumber;
			}
		}
		$length3=mb_strlen($form['username'],'UTF-8');
		if($length3>5)
		{
			$checknumber=array('id'=>'25');
			return $checknumber;
		}
		if($form['username']!=null && $form['password']==null)
		$sql="update login set username='$form[username]'where email='$usr'";
		if($form['username']==null && $form['password']!=null)
		{
		$code= new CRYPT();
		$encodepsw=$code->encrypt($form['password']);
		$sql="update login set password='$encodepsw'where email='$usr'";
		}
		if($form['username']!=null && $form['password']!=null)
		{
		$code= new CRYPT();
		$encodepsw=$code->encrypt($form['password']);
		$sql="update login set username='$form[username]',password='$encodepsw' where email='$usr'";
		}

		$con=mysql_connect(SAE_MYSQL_HOST_M.':'.SAE_MYSQL_PORT,SAE_MYSQL_USER,SAE_MYSQL_PASS);
		if(!$con)
		{
			die('Could not connect:'.mysql_error());
		}
		mysql_query("set names utf8");
		mysql_select_db(SAE_MYSQL_DB,$con);
		if(!mysql_query($sql,$con))
		{
			mysql_close($con);
			die('Error:'.mysql_error);
		}
		mysql_close($con);
		$checknumber=array('id'=>'3');
		return $checknumber;
	}

	function pregE($test)
	{
		$zhengze='^[a-z0-9]+([._\\-]*[a-z0-9])*@([a-z0-9]+[-a-z0-9]*[a-z0-9]+.){1,63}[a-z0-9]+$';
		$result=ereg($zhengze,$test);
		return $result;
	}
	
	function resumenum($resume)
	{
		$checknumber=array('id'=>null,'ran'=>null,'email'=>null);
		if($resume['checknum']==null || $resume['emails']==null)
		{
			$checknumber=array('id'=>'11');
			return $checknumber;
		}
		$con=mysql_connect(SAE_MYSQL_HOST_M.':'.SAE_MYSQL_PORT,SAE_MYSQL_USER,SAE_MYSQL_PASS);
		if(!$con)
		{
			die('Could not connect:'.mysql_error());
		}
		mysql_query("set names utf8");
		mysql_select_db(SAE_MYSQL_DB,$con);
		$sql="select * from login where email='$resume[emails]' and checknum='$resume[checknum]'";
		$res=mysql_query($sql,$con);
		if(mysql_num_rows($res))
		{
			$sql="update login set checknum=null where email='$resume[emails]'";		
			if(!mysql_query($sql,$con))
			{
				mysql_close($con);
				$checknumber=array('id'=>'11');
				return $checknumber;
			}
			mysql_close($con);
			$checknumber=array('id'=>'10');
			return $checknumber;
		}
		else
		{
			mysql_close($con);
			$checknumber=array('id'=>'11');
			return $checknumber;
		}
	}
	function sendfind($form)
	{
		$checknumber=array('id'=>null,'ran'=>null,'email'=>null);
		if($form['email']==null)
		{
			$checknumber=array('id'=>'16');
			return $checknumber;
		}
		$zhengcheck= new model();
		$survey=$zhengcheck->pregE($form['email']);
		if($survey!=1)
		{
			$checknumber=array('id'=>'26');
			return $checknumber;
		}
		$con=mysql_connect(SAE_MYSQL_HOST_M.':'.SAE_MYSQL_PORT,SAE_MYSQL_USER,SAE_MYSQL_PASS);
		if(!$con)
		{
			die('Could not connect:'.mysql_error());
		}
		mysql_query("set names utf8");
		mysql_select_db(SAE_MYSQL_DB,$con);
		$sql="select * from login where email='$form[email]'";
		$res=mysql_query($sql,$con);
		$row=mysql_fetch_array($res);
		if($row['email']==null)
		{
			$checknumber=array('id'=>'17');
			return $checknumber;
		}
		$ran=rand(100000,999999);
		$sql="update login set checknum='$ran' where email='$form[email]'";
		if(!mysql_query($sql,$con))
		{
			mysql_close($con);
			die('Error:'.mysql_error);
		}
		mysql_close($con);
		$checknumber=array('id'=>'18','ran'=>$ran,'email'=>$form['email']);
		return $checknumber;
	}

	function compare($form)
	{
		$checknumber=array('id'=>null,'ran'=>null,'email'=>null);
		if($form['checknum']==null)
		{
			$checknumber=array('id'=>'19');
			return $checknumber;
		}
		$con=mysql_connect(SAE_MYSQL_HOST_M.':'.SAE_MYSQL_PORT,SAE_MYSQL_USER,SAE_MYSQL_PASS);
		if(!$con)
		{
			die('Could not connect:'.mysql_error());
		}
		mysql_query("set names utf8");
		mysql_select_db(SAE_MYSQL_DB,$con);
		$sql="select * from login where email='$form[email]'";
		$res=mysql_query($sql,$con);
		$row=mysql_fetch_array($res);
		if($row['checknum']!=$form['checknum'])
		{
			$checknumber=array('id'=>'20');
			return $checknumber;
		}
		$sql="update login set checknum=null where email='$form[email]'";
		if(!mysql_query($sql,$con))
		{
			mysql_close($con);
			die('Error:'.mysql_error);
		}
		mysql_close($con);
		$checknumber=array('id'=>'21','username'=>$form['email']);
		$_SESSION['username']=$form['email'];
		return $checknumber;
	}

	function reset($form)
	{
		$usr=$_SESSION['username'];
	
		$checknumber=array('id'=>null,'ran'=>null,'email'=>null);
		if($form['password']==null && $form['password2']==null)
		{
			$checknumber=array('id'=>'27');
			return $checknumber;
		}
		if($form['password']!=$form['password2'])
		{
			$checknumber=array('id'=>'28');
			return $checknumber;
		}
		$length=strlen($form['password']);
		if($length>10 || $length<6)
		{
			$checknumber=array('id'=>'29');
			return $checknumber;
		}
		$code= new CRYPT();
		$encodepsw=$code->encrypt($form['password']);
		$sql="update login set password='$encodepsw'where email='$usr'";
		$con=mysql_connect(SAE_MYSQL_HOST_M.':'.SAE_MYSQL_PORT,SAE_MYSQL_USER,SAE_MYSQL_PASS);
		if(!$con)
		{
			die('Could not connect:'.mysql_error());
		}
		mysql_query("set names utf8");
		mysql_select_db(SAE_MYSQL_DB,$con);
		if(!mysql_query($sql,$con))
		{
			mysql_close($con);
			die('Error:'.mysql_error);
		}
		mysql_close($con);
		$checknumber=array('id'=>'30');
		return $checknumber;
	}


}
?>
