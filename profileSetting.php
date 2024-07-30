<?php
	require_once 'header.php';
	if(!isset($_SESSION['user'])) die();
	$status = "";
	loadProfile();
	
	$user = $_SESSION['user'];
	$role = $_SESSION['role'];
	$email = $_SESSION['email'];
	$status = $_SESSION['status'];

	$imgPath = 'assets/images/'.$user.'.jpg';
	if (!file_exists($imgPath)) {
	    $imgPath = 'assets/images/defaultProfile.png';
	}
	echo <<<_END
	<div class="row">
		<div class="col-md-4">
		</div>
		<div class="col-md-4">
			<div class="panel panel-info width-300px">
				<div class="panel-heading"><b>Profile</b></div>
				<div class="panel-body">
					<img src="$imgPath" alt="default profile" class="img-profile"/>
					<p><span class="glyphicon glyphicon-user"/>&nbsp $user</p>
					<p><span class="glyphicon glyphicon-exclamation-sign"/>&nbsp $role</p>
					<p><span class="glyphicon glyphicon-envelope"/>&nbsp $email</p>
					<p><span class="glyphicon glyphicon-info-sign"/>&nbsp $status</p>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-4">
		</div>
		<div class="col-md-4 well">
			<form method="POST" action="profileSetting.php" enctype='multipart/form-data'>
				<div class="form-group">
			    	<label for="profile">Profile Picture</label>
			    	<input type="file" class="form-control-file" id="profile" name="profile">
			  	</div>
			  	<div class="form-group">
			    	<label for="status">Status</label>
			    	<textarea id="status" class="form-control" name="status"></textarea>
			  	</div>
			  	<div class="form-group">
					<button class="btn btn-default">Update</button>
				</div>
			</form>
		</div>
	</div>
_END;
	if(isset($_POST['status'])){
		if (trim($_POST['status'])!= "")
		{
	    	$text = sanitizeString($_POST['status']);
	    	$text = preg_replace('/\s\s+/', ' ', $text);

			queryMysql("UPDATE members SET status='$text' where user='$user'");
			header("Refresh:0; url=profileSetting.php");
	  	}
  	}
 	$status= stripslashes(preg_replace('/\s\s+/', ' ', $status));

  	if (isset($_FILES['profile']['name']))
  	{
    	$saveto = "assets/images/$user.jpg";
    	move_uploaded_file($_FILES['profile']['tmp_name'], $saveto);
    	$typeok = TRUE;

    	switch($_FILES['profile']['type'])
    	{
      		case "image/gif":   $src = imagecreatefromgif($saveto); break;
      		case "image/jpeg":  // Both regular and progressive jpegs
      		case "image/pjpeg": $src = imagecreatefromjpeg($saveto); break;
      		case "image/png":   $src = imagecreatefrompng($saveto); break;
      		default:            $typeok = FALSE; break;
    	}

    	if ($typeok)
    	{
     		list($w, $h) = getimagesize($saveto);

      		$max = 100;
      		$tw  = $w;
      		$th  = $h;

      		if ($w > $h && $max < $w)
      		{
        		$th = $max / $w * $h;
        		$tw = $max;
      		}
      		elseif ($h > $w && $max < $h)
      		{
        		$tw = $max / $h * $w;
        		$th = $max;
      		}
      		elseif ($max < $w)
      		{
        		$tw = $th = $max;
      		}

      		$tmp = imagecreatetruecolor($tw, $th);
      		imagecopyresampled($tmp, $src, 0, 0, 0, 0, $tw, $th, $w, $h);
      		imageconvolution($tmp, array(array(-1, -1, -1),
        	array(-1, 16, -1), array(-1, -1, -1)), 8, 0);
      		imagejpeg($tmp, $saveto);
      		imagedestroy($tmp);
      		imagedestroy($src);
      		header("Refresh:0; url=profileSetting.php");
    	}
  	}
	require_once 'footer.php';
?>