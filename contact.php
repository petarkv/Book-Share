<?php require_once 'core/init.php';?>

<head>
  <title>Book Sharing Online || Contact</title>
  <meta charset="utf-8">
  <link rel="stylesheet" href="css/screen.css">
</head>

<?php include 'includes/header.php';?>

<?php if (Session::exists('user_id')) {
	    include_once 'includes/menubar/menubar_login.php';;
	}else {
	include 'includes/menubar/menubar_logout.php';
	}
	?>

<div id="container">

<?php include 'includes/contact_form.php';?>

</div>

<?php include 'includes/overall/footer.php';?>
