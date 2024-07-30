<?php
	require_once 'header.php';
	$error = $user = $pass = $email = $role = $passConfirm = "";
	if (isset($_SESSION['user'])) destroySession();
echo <<<_END
	<div id="modal-registrator" class="modal fade" role="dialog">
	  	<div class="modal-dialog modal-registrator">
		    <!-- Modal content-->
		    <div class="modal-content">
		      	<div class="modal-header">
		        	<button type="button" class="close" data-dismiss="modal">&times;</button>
		        	<h4 class="modal-title">Please enter your details to registrator</h4>
		      	</div>
		      	<div class="modal-body">
		      	  	<form class="form-horizontal" method='post' action='index.php'>	
		      	  		$error	
				        <div class="input-group">
				          	<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
				         	<input id="user" type="text" class="form-control" name="user" value='$user' placeholder="Username"/>
				        </div>
				        <br>
				        <div class="input-group">
				            <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
				            <input id="email" type="email" class="form-control" name="email" value='$email' placeholder="email"/>
				        </div>
				        <br>
				        <div class="input-group">
				            <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
				            <input id="pass" type="password" class="form-control" name="pass" value='$pass' placeholder="Password"/>
				        </div>
				        <br>
				        <div class="input-group">
				            <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
				            <input id="pass-confirm" type="password" class="form-control" name="pass-confirm" name="$passConfirm" placeholder="Confirm Password"/>
				        </div>     
				        <br>
				        <button type="submit" style="width:100%"  value="signup" id="signup" class="btn btn-primary" data-toggle="modal" data-target="#modal-registrator"/>Sign up</button><br><br>
			        
			        	<h5> Already a member ? </h5>
			        	<a href="#"><h5 data-dismiss="modal">Click to Login</h5></a>
			    </div>
		      	<div class="modal-footer">
		        	<button type="reset" style="float:left;" class="btn btn-danger"/>Cancel</button>
		        	</form> 
		        	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		      	</div>
		    </div>
	  	</div>
	</div>
_END;
		

		

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
			        queryMysql("INSERT INTO members (user,pass,email,role) VALUES('$user', '$pass','$email','Member')");
			        $error = "Account created, please Log in to continue.<br><br>";
			    }
			}
		}

	
?>