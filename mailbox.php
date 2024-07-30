<?php 
	require_once 'header.php';
	if($_SESSION['user']==null) die();
	$user = $_SESSION['user'];
	$error = $query = $result = "";

	if(isset($_POST['toUser'])&&isset($_POST['subject'])&&isset($_POST['message'])){
		if($_POST['toUser']==""||$_POST['subject']==""||$_POST['message']==""){
			$error =  "Please fill all field";
		}
		else{
			$toUser = $_POST['toUser'];
			$query = "SELECT * FROM members WHERE user = '$toUser'";
			$result = queryMysql($query);
			$num = $result->num_rows;
			if($num==0){
				$error = "Please fill a valid user";
			}
			else{
				$error= "";
				$subject = $_POST['subject'];
				$message = $_POST['message'];
				$time = time();
				$query = "INSERT INTO mails (sender,receiver,time,subject,message) VALUES ('$user','$toUser','$time','$subject','$message')";
				$result = queryMysql($query);
				echo "<script>alert('message sent!')</script>";
			}
		}
	}
	echo "<div class='row'>";
	if(isset($_SESSION["user"])) {
		$user = $_SESSION["user"];
		$email = "mymail@gmail.com";
		$status = "I am a developer";
		$imgPath = 'assets/images/'.$user.'.jpg';
		if (!file_exists($imgPath)) {
		    $imgPath = 'assets/images/defaultProfile.png';
		}
		echo <<<_END
			<div class="col-md-3">
				<div class="panel panel-info width-300px height-300px">
					<div class="panel-heading"><b>Profile</b></div>
					<div class="panel-body">
						<img src="$imgPath" alt="default profile" class="img-profile"/>
						<p><span class="glyphicon glyphicon-user"/>&nbsp $user</p>
						<p><span class="glyphicon glyphicon-envelope"/>&nbsp $email</p>
						<p><span class="glyphicon glyphicon-info-sign"/>&nbsp $status</p>
					</div>
				</div>
			</div>
_END;
	}
	else
	{
		die();
	}
?>
	<div class="row">
		<div class="col-md-6 col-sm-8">
			<div class="panel panel-dark">
				<div class="panel-heading bg-black" style="height:50px;">
					<p style="float:left;">Mail Box</p>
					<p style="float:right;">
						<a href="#" onclick="show('in')">Inbox</a>,
						<a href="#" onclick="show('sent')">Sent box</a>,
						<a href="#" onclick="show('compose')">Compose mail</a>
					</p>
				</div>
				<!-- Inbox, sent box -->
				<div id="box">
				<?php
				$type = "";
				$num = 0;
				if(isset($_GET['box'])) 
				{
					if($_GET['box']=='sent'){
						$type = "Sent box";
						$query = "SELECT * FROM mails WHERE sender = '$user' ORDER BY time DESC";
						$result = queryMysql($query);
						$num = $result->num_rows;
					}
					else if($_GET['box']=='in'){
						$type = "Inbox";
						$query = "SELECT * FROM mails WHERE receiver = '$user' ORDER BY time DESC";
						$result = queryMysql($query);
						$num = $result->num_rows;
					}
				}
 				if($num==0){
 					echo <<<_END
 					<h3> $type </h3>
					<div class="panel-body bg-white well">
						<div class="col-md-4 col-sm-4">
						</div>
						<div class="col-md-6 col-sm-6">
							<p style="padding-top:14px">
							No message current
							</p>
						</div>
						<div class="col-md-2 col-sm-2">
						</div>
					</div>
_END;
 				}
 				else{
 				echo <<<_END
 				<h3> $type </h3>
 				<div class="panel-body bg-white well">
					<div class="col-md-4 col-sm-4">
						<b>User</b>
					</div>
					<div class="col-md-6 col-sm-6">
						<b>Subject</b>
					</div>
					<div class="col-md-2 col-sm-2">
							
					</div>
				</div>
_END;
				}
				for ($j = 0 ; $j < $num ; ++$j)
    			{
    				$row = $result->fetch_array(MYSQLI_ASSOC);
    				$id = $row['id'];
    				$imgPath = $receiver = $sender = "";
    				if($type == 'Sent box'){
    					$receiver =  $row['receiver'];
    					$imgPath = 'assets/images/'.$receiver.'.png';
						if (!file_exists($imgPath)) {
						    $imgPath = 'assets/images/defaultProfile.png';
						}
    				}
    				else{
    					$sender = $row['sender'];
    					$imgPath = 'assets/images/'.$sender.'.png';
						if (!file_exists($imgPath)) {
						    $imgPath = 'assets/images/defaultProfile.png';
						}
    				}
    				$subject = $row['subject'];
    				$mail = $row['message'];
				echo <<<_END
					<div class="panel-body bg-white well">
						<div class="col-md-4 col-sm-4">
_END;
				
				echo <<<_END
							<img src="$imgPath" width="70px" height="70px" style="border:2px solid black; border-radius:5px;"/>
							$sender
						</div>
						<div class="col-md-6 col-sm-6">
							<p style="padding-top:14px">
							$subject
							</p>
						</div>
						<div class="col-md-2 col-sm-2">
							<a href='mailbox.php?view=$id'>
								<button class="btn btn-primary" onclick="show('view')">
									View
								</button>
							</a>
						</div>
					</div>
_END;
				}
				?>
				</div>
				<!-- End inbox, sent box -->
				<!-- View message -->
				<div id="view" style="display: none;">
				<?php

				if(isset($_GET['view'])) {
					$mid = $_GET['view'];
					$query = "SELECT * FROM mails WHERE id = '$mid'";
					$result = queryMysql($query);
	 				$num    = $result->num_rows;		
					
					for ($j = 0 ; $j < $num ; ++$j)
	    			{
	    				$row = $result->fetch_array(MYSQLI_ASSOC);
	    				$id = $row['id'];
	    				$who = "";
	    				if($type=="Sent box") $who = "Receiver";
	    				$receiver = $row['receiver'];
	    				$subject = $row['subject'];
	    				$mail = $row['message'];
	    				$time = $row['time'];
      					$hour = date('h:i',$time);
						$date = date('Y/m/d',$time);
						$time = $date . " at " . $hour;
	    				$imgPath = 'assets/images/'.$receiver.'.png';
	    				if (!file_exists($imgPath)) {
					    $imgPath = 'assets/images/defaultProfile.png';
						}
					echo <<<_END
						<div class="panel-body bg-white well">
							<div class="row">
								<div class="col-md-4 col-sm-4">
									<h4>User</h4>
									<img src="$imgPath" width="70px" height="70px" style="border:2px solid black; border-radius:5px;"/>
									<b>$receiver</b>
								</div>
							</div>
							<div class="row">
								<div class="col-md-8 col-sm-8">
									<p style="padding-top:14px">
									<h4>Subject</h4> $subject
									</p>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12 col-sm-12">
									<h4>Compose mail</h4>
									$time
									<br>
									<pre>$mail</pre>
								</div>
							</div>
						</div>
						<script>
							box.style= "display:none;";
							view.style= "display:block;";
							compose.style= "display:none;";
						</script>
_END;
				}
			}
?>
				</div>
				<!-- End view message -->
				<!-- Compose Mail -->
				<div id="compose" style="display:none;">
					<div class="panel-body bg-white well">
						<form class="form-horizonal" method="POST" action="mailbox.php?box=compose">
							<?php echo "<span style='color:red;'>$error</span>"; ?>
							<div class="row">
								<div class="col-md-4 col-sm-4">
									<h4>User</h4>
								</div>
								<div class="col-md-4 col-sm-4">
									<input type="text" class="form-control" name="toUser"/>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-md-4 col-sm-4">
									<h4>Subject</h4>
								</div>
								<div class="col-md-8 col-sm-8">
									<input type="text" class="form-control" name="subject"/>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-md-4 col-sm-4">
									<h4>Compose mail</h4>
								</div>
								<div class="col-md-8 col-sm-8">
									<textarea name="message" class="form-control"></textarea>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-md-8 col-sm-8">
								</div>
								<div class="col-md-4 col-sm-4">
									<button type="submit" class="btn btn-primary" style="width:100%;">
										Send
									</button>
								</div>
							</div>
						</form>
					</div>
				</div>
				<!-- End Compose Mail -->
			</div>
		</div>
	</div>
	<script>
		function show(panel){
			var box = document.getElementById('box');
			var view =document.getElementById('view');
			var compose = document.getElementById('compose');

			if(panel == "sent" || panel == "in"){
				box.style= "display:block;";
				view.style= "display:none;";
				compose.style= "display:none;";
				window.location.href= "mailbox.php?box="+panel;
			}else if( panel == "view"){
				
			}else{
				box.style= "display:none;";
				view.style= "display:none;";
				compose.style= "display:block;";
			}
		}
	</script>
<?php
	if(isset($_GET['box'])){
		if($_GET['box']=='compose'){
		echo <<<_END
		<script>
		box.style= "display:none;";
		view.style= "display:none;";
		compose.style= "display:block;";
		</script>
_END;
	}
	}
	require_once 'footer.php';
?>