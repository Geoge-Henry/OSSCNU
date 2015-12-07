<?php
session_start();
ini_set('display_errors',0);
require_once('./ValidateCode.class.php');
$_vc=new ValidateCode();
$_vc->doimg();
$_SESSION['authnum_session']=$_vc->getCode();

?>
