<?php
	require_once 'header.php';

	$error = $user = $pass = $email = $role = $passConfirm = "";

	if (isset($_SESSION['user'])) destroySession();

	if (isset($_POST['user']))
	{
		$user = sanitizeString($_POST['user']);
		$pass = sanitizeString($_POST['pass']);
		$email = sanitizeString($_POST['email']);
		$passConfirm = sanitizeString($_POST['pass-confirm']);

		if ($user == "" || $pass == "" || $email == "" || $passConfirm == ""){
			$error = "Not all fields were entered<br><br>";

		}
		elseif ($pass != $passConfirm) {
			$error = "Password not match<br><br>";
		}
		else
		{
			$result = queryMysql("SELECT * FROM members WHERE user='$user'");

			if ($result->num_rows) {
			       	$error = "That username already exists<br><br>";
			}
			else
			{
			    $role = "Member";
			    queryMysql("INSERT INTO members (user,pass,email,role) VALUES('$user', '$pass','$email','$role')");
			    $error = "Account created, please Log in to continue.<br><br>";
			}
		}
	}

echo <<<_END
	<div class="row">
	<div class="col-md-4"></div>
	<div class="well col-md-4 bg-dark">
		      	  	<form class="form-horizontal" method='post' action='signup.php'>	
		      	  		<p> Sign Up Form </p>
		      	  		<p style="color:red">$error</p>	
				        <div class="input-group">
				          	<span class="input-group-addon bg-dark"><i class="glyphicon glyphicon-user font-white"></i></span>
				         	<input id="user" type="text" class="form-control bg-dark" name="user" value='$user' placeholder="Username"/>
				        </div>
				        <br>
				        <div class="input-group">
				            <span class="input-group-addon bg-dark"><i class="glyphicon glyphicon-envelope font-white""></i></span>
				            <input id="email" type="email" class="form-control bg-dark" name="email" value='$email' placeholder="email"/>
				        </div>
				        <br>
				        <div class="input-group">
				            <span class="input-group-addon bg-dark"><i class="glyphicon glyphicon-lock font-white""></i></span>
				            <input id="pass" type="password" class="form-control bg-dark" name="pass" value='$pass' placeholder="Password"/>
				        </div>
				        <br>
				        <div class="input-group">
				            <span class="input-group-addon bg-dark"><i class="glyphicon glyphicon-lock font-white""></i></span>
				            <input id="pass-confirm" type="password" class="form-control bg-dark" name="pass-confirm" name="$passConfirm" placeholder="Confirm Password"/>
				        </div>     
				        <br>
				        <button type="submit" style="width:100%"  value="signup" id="signup" class="btn btn-dark" />
				        Sign up</button><br><br>
			        
			        	Already a member ? 
			        	<a href="login.php">Click to Login</a>
    </div>
    <div class="col-md-4"></div>
    </div>
_END;
	require_once 'footer.php';
?>