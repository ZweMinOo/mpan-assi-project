<?php
  require_once 'header.php';

  if (isset($_SESSION['user']))
  {
    destroySession();
    header("Refresh:0; url=index.php");
    echo "You have been logged out. Please " .
         "<a href='index.php'>click here</a> to refresh the screen.";
  }
  else echo "You cannot log out because you are not logged in";

  require_once 'footer.php';
?>