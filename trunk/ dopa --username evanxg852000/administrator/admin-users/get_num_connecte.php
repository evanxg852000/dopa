<?php
include("../../system.admin.php");
session_start();
$pass_conet=$_SESSION['pass'] ;
$login_conet=$_SESSION['login']; 
$num_con=get_num_connecte($login_conet,$pass_conet);
echo $num_con;
?>