<?php
	// db connect deatils
	$dbhost  = 'localhost';
	$dbname  = 'dbmpan'; 
	$dbuser  = 'root'; 
	$dbpass  = '';
	$appname = "MPAN";

	$connection = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
	if ($connection->connect_error) die($connection->connect_error);

	function createTable($name, $query) // To create table
	{
		queryMysql("CREATE TABLE IF NOT EXISTS $name($query)");
	    echo "Table '$name' created or already exists.<br>";
	}

	function queryMysql($query) // run user query
	{
	    global $connection;
	    $result = $connection->query($query);
	    if (!$result) die($connection->error);
	    return $result;
	}

	function destroySession() // logout
	{
	    $_SESSION=array();

	    if (session_id() != "" || isset($_COOKIE[session_name()]))
	      setcookie(session_name(), '', time()-2592000, '/');

		session_destroy();
	}

	function sanitizeString($var) // filtering statements
	{
	    global $connection;
	    $var = strip_tags($var);
	    $var = htmlentities($var);
	    $var = stripslashes($var);
	    return $connection->real_escape_string($var);
	}

	function showComments($api,$reload){
    $query  = "SELECT * FROM comments WHERE api='$api' ORDER BY time DESC";
    $result = queryMysql($query);
    $num    = $result->num_rows;
    for ($j = 0 ; $j < $num ; ++$j)
    {
     	 $row = $result->fetch_array(MYSQLI_ASSOC);
      	$id = $row['id'];
      	$user = $row['user'];
      	$imgPath = 'assets/images/'.$user.'.png';
		if (!file_exists($imgPath)) {
		    $imgPath = 'assets/images/defaultProfile.png';
		}
      	$msg = $row['text'];
      	$time = $row['time'];
      	$hour = date('h:i',$time);
		$date = date('Y/m/d',$time);
		$time = $date . " at " . $hour;
      	echo "<div class='panel panel-default'>";
      	echo "<div class='panel-heading'>";
     	// echo "<p> ";
      	echo "<img src='$imgPath' style='width:80px;height:70px;' alt='default'/>&nbsp;";
     	 echo "<b>".$user."</b></div>";
      	echo "<div class='panel-body'><div class='col-md-10 col-sm-10'>";
      	if(isset($_SESSION['role'])){
	        if($_SESSION['role']=='Administrator'){
	          	echo $msg . "</div><div class='col-md-2 col-sm-2'><a href='deleteMsg.php?id=$id&reload=$reload'><button class='btn btn-danger'>Delete</button></a></div></div><div class='panel-footer'>$time</div></div>";
	        }else {
	          echo $msg . "</div></div><div class='panel-footer'>$time</div></div>";
	        }
    	}
    	else{
    		 echo $msg . "</div></div><div class='panel-footer'>$time</div></div>";
    	}
    }
  }
	function loadProfile(){
		$user = $_SESSION['user'];
		$pass = $_SESSION['pass'];
		$result = queryMySQL("SELECT user,pass,role,email,status FROM members WHERE user='$user' AND pass='$pass'");

	    if ($result->num_rows == 0)
	    {
	        $error = "<span class='error'> Username/Password invalid </span><br><br>";
	    }
	    else
	    {
	        $_SESSION['user'] = $user;
	        $row = $result->fetch_array(MYSQLI_ASSOC);
	        $_SESSION['role'] = $row['role'];
	        $_SESSION['email'] = $row['email'];
	    	$_SESSION['status'] = $row['status'];
	    }
	}
?>