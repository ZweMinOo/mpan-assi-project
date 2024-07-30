<?php
	require_once 'header.php';
	$user = $email = $status = $query = $result = $row = $role ='';
	if(isset($_GET['view'])){
		$user = $_GET['view'];
		$query = "SELECT * FROM members WHERE user = '$user'";
		$result = queryMysql($query);
		$row = $result->fetch_array(MYSQLI_ASSOC);
		$email = $row['email'];
		$role = $row['role'];
		$status = $row['status'];
	}
	else{
		die();
	}
	$imgPath = 'assets/images/'.$user.'.jpg';
	if (!file_exists($imgPath)) {
	    $imgPath = 'assets/images/defaultProfile.png';
	}
	echo <<<_END
	<div class="row">
		<div class="col-md-4 col-sm-4">
			
		</div>
		<div class="col-md-3 col-sm-3">
			<div class="panel panel-info" style="text-align:center;">
				<div class="panel-heading"><b>Profile</b></div>
				<div class="panel-body">
					<img src="$imgPath" alt="default profile" class="img-profile"/>
					<p><span class="glyphicon glyphicon-user"/>&nbsp $user </p>
					<p><span class="glyphicon glyphicon-envelope"/>&nbsp $email </p>
					<p><span class="glyphicon glyphicon-exclamation-sign"/>&nbsp $role </p>
					<p><span class="glyphicon glyphicon-info-sign"/>&nbsp $status</p>
				</div>
			</div>
		</div>
		<div class="col-md-2 col-sm-2">
			<a href="members.php">
				<button class="btn btn-default">Back</button>
			</a>
		</div>
	</div>
_END;
	require_once 'footer.php';
?>