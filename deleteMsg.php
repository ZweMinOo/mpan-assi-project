<?php
	require_once 'functions.php';
	if(isset($_GET['id'])){
		$id = $_GET['id'];
		$reload = $_GET['reload'];
		$query = "DELETE FROM comments WHERE id = '$id'";
		queryMySql($query);
		header("Refresh:0; url=$reload");
	}
?>