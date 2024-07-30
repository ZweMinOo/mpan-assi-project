<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../assets/css/font-awesome.css">
	<link rel="stylesheet" type="text/css" href="../assets/css/templatemo-style.css">
	<link rel="stylesheet" type="text/css" href="../assets/css/jquery.dataTables.css">
	<link rel="stylesheet" type="text/css" href="../assets/css/style1.css">
	<!--<link rel="stylesheet" type="text/css" href="assets/css/style.css"> -->
	<script src="../assets/js/jquery.js"></script>
	<script src="../assets/js/jquery.dataTables.js"></script>
	<script src="../assets/js/jquery-1.11.1.min.js"></script>
	<script src="../assets/js/bootstrap.min.js"></script>
</head>
<body>
	<div id="icon-bar" class="icon-bar">
<?php

	require_once '../functions.php';

	if(isset($_SESSION['user'])){
		echo <<<_END
		<a class="active" href="../index.php"><i class="fa fa-home"></i></a> 
	  	<a href="profile1 - Copy.php"><i class="fa fa-user"></i></a> 
	  	<a href="../messages.php"><i class="fa fa-envelope"></i></a> 
	  	<a href="#"><i class="fa fa-globe"></i></a>
	  	<a href="../logout.php"><i class="fa fa-sign-out"></i></a>
_END;
	//data-toggle="modal" data-target="#modal-profile"
	}
	else{
		//data-toggle="modal" data-target="#modal-registrator"
		echo <<<_END
		<a class="active" href="../index.php"><i class="fa fa-home"></i></a>
	  	<a href="../login.php"><i class="fa fa-sign-in"></i></a>
	  	<a href="../signup.php"><i class="fa fa-key"></i></a>
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