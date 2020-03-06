<!DOCTYPE html>
<html>

<?php include 'includes/head.php';?>

<body>
	
	<?php include 'includes/header.php';?>
	
	<?php if (Session::exists('user_id')) 
	{
	    include_once 'includes/menubar/menubar_login.php';;
	}else 
	{
	   include 'includes/menubar/menubar_logout.php';
	}
	?>

<div class="clear"></div>
	
	
	