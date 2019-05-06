<?php
  ob_start();
  session_start();
  $timezone = date_default_timezone_set("Europe/Helsinki");

  $con = mysqli_connect("localhost", "root", "", "spotifyclone");


  if(mysqli_connect_errno()){
    echo "Fail to connect:" . mysqli_connect_errno();
  }

?>
