<?php
	require_once 'header.php';

  	$error = $user = $pass = "";

  	if (isset($_POST['user']))
  	{
    	$user = sanitizeString($_POST['user']);
    	$pass = sanitizeString($_POST['pass']);

    	if ($user == "" || $pass == "")
        	$error = "<span style='color:red;'>Not all fields were entered<br></span>";
    	else
    	{
    		$result = queryMySQL("SELECT user,pass,role FROM members WHERE user='$user' AND pass='$pass'");

	      	if ($result->num_rows == 0)
	      	{
	        	$error = "<span class='error'> Username/Password invalid </span><br><br>";
	      	}
	      	else
	      	{
	        	$_SESSION['user'] = $user;
	        	$_SESSION['pass'] = $pass;
	        	$row = $result->fetch_array(MYSQLI_ASSOC);
	        	$_SESSION['role'] = $row['role'];
	    
	        	header("Refresh:0; url=index.php");
	        	die("You are now logged in. Please <a href='index.php'>click here</a> to continue.<br><br>");
	      	}
    	}
  	}


	echo <<<_END
	<div class="row">
	<div class="col-md-4"></div>
	<div class="well col-md-4 bg-dark">
		      	  	<form class="form-horizontal" method='post' action='login.php'>
		      	  		<p> Login Form </p>
		      	  		$error
			          	<div class="input-group">
			            	<span class="input-group-addon bg-dark"><i class="glyphicon glyphicon-user font-white"></i></span>
			            	<input id="user" type="text" class="form-control bg-dark" name="user" value="$user" placeholder="Username"/>
			          	</div>
			          	<br>
			          	<div class="input-group">
			            	<span class="input-group-addon bg-dark"><i class="glyphicon glyphicon-lock font-white"></i></span>
			            	<input id="pass" type="password" class="form-control bg-dark" name="pass" value="$pass" placeholder="Password"/>
			          	</div>    
			          	<br>	
			          	<button type="submit" style="width:100%" value="login" id="login" class="btn btn-dark"/>Login</button>
			        	<br>
			        	<br>
			        	Not a member ?
			        	<a href="signup.php">Create an new account</a>
			    </div>
    <div class="col-md-4"></div>
    </div>
_END;
	require_once 'footer.php';
?>