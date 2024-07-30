<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="assets/css/font-awesome.css">
	<link rel="stylesheet" type="text/css" href="assets/css/jquery.dataTables.css">
	<link rel="stylesheet" type="text/css" href="assets/css/style1.css">
	<script src="assets/js/jquery.js"></script>
	<script src="assets/js/jquery.dataTables.js"></script>
	<script src="assets/js/jquery-1.11.1.min.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
</head>
<style>
	a {
		text-decoration: none;
		color:white;
	}
	a:hover {
		color:yellow;
	}
</style>
<body>
	<div id="icon-bar" class="icon-bar">
<?php
	session_start();

	require_once 'functions.php';

	if(isset($_SESSION['user'])){
		$user = $_SESSION['user'];
		echo <<<_END
		<a class="active" href="index.php"><i class="fa fa-home"></i></a> 
		<a href="members.php"><i class="fa fa-group"></i></a> 
	  	<a href="profileSetting.php"><i class="fa fa-cogs"></i></a> 
	  	<a href="mailbox.php?box=in"><i class="fa fa-envelope"></i></a> 
	  	<a href="logout.php"><i class="fa fa-sign-out"></i></a>
_END;
	}
	else{
		echo <<<_END
		<a class="active" href="index.php"><i class="fa fa-home"></i></a>
	  	<a href="login.php"><i class="fa fa-sign-in"></i></a>
	  	<a href="signup.php"><i class="fa fa-key"></i></a>
_END;
	}
?>
	</div>	
	<div id="main">
		<div id="nav" class="nav navbar-inverse navbar-fixed-top">
			<div class="container-fluid">
				<div class="navbar-header">
					<span class="fa fa-navicon" style="font-size:36px;cursor:pointer;color:white;" onclick="toggleNav()"/>
				</div>
			</div>
		</div>