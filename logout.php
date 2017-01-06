<?php
session_start();

if(!isset($_SESSION['user']))
{
	header("Location: myaccount.php");
}
else if(isset($_SESSION['user'])!="")
{
	
}

if(isset($_GET['logout']))
{
	session_destroy();
	unset($_SESSION['user']);
	header("Location: index.php");
}
?>