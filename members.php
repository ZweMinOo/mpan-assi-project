<?php
	require_once 'header.php';
	$ban = "";
	$result = queryMySQL("SELECT user,role FROM members");

	if ($result->num_rows == 0)
	{
	     $error = "<span class='error'> Username/Password invalid </span><br><br>";
	}
	else
	{
		echo "<div class='well'>";
		echo "<div class='row'><div class='col-md-4 col-sm-5 well bg-dark'><b>User</b></div><div class='col-md-4 col-sm-5 well bg-dark'><b>Role</b></div></div>";
		$num = $result->num_rows;
		for($j = 0 ; $j < $num ; $j++){
	        $row = $result->fetch_array(MYSQLI_ASSOC);
	        $user = $row['user'];
	        $role = $row['role'];
	        if($_SESSION['role'] == 'Administrator') {
	        echo <<<_END
	        	<div class='row'>
	        		<div class='col-md-4 col-sm-5 well bg-dark'>
	        			<a href="profile.php" data-toggle="modal" data-target="#modal-profile">$user</a>
	        		</div>
	        		<div class='col-md-4 col-sm-5 well bg-dark'>$role</div>
	        		<div class='col-md-1 col-sm-2'>
		        		<a href="members.php?ban=$user">
		        		<img src="assets/images/ban.png" width="40px" height="40px"/>
		        		</a>
		        	</div>
		        </div>
_END;
	        	
	        }
	        else{
	        echo <<<_END
	        	<div class='row'>
	        		<div class='col-md-4 col-sm-5 well bg-dark'>
	        			<a href="profile.php?view=$user">$user</a>
	        		</div>
	        		<div class='col-md-4 col-sm-5 well bg-dark'>$role</div>
	        	</div>
_END;
	        }
		} 
	    echo "</div></div>";
	}
	if(isset($_GET['ban'])){
		$ban = sanitizeString($_GET['ban']);
		$query = "DELETE FROM comments WHERE user='$ban'";
		queryMysql($query);
		$query = "DELETE FROM mails WHERE sender='$ban' OR receiver='$ban'";
		queryMysql($query);
		$query = "DELETE FROM members WHERE user='$ban'";
		queryMysql($query);
		header("Refresh:0; url=members.php");
	}

	require_once 'footer.php';
?>