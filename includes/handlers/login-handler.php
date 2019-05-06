<?php
if(isset($_POST['loginButton'])){
  $email = $_POST['loginUsername'];
  $password =$_POST['loginPassword'];

  $result= $account->login($email,$password);
  if($result == true){
    $_SESSION['emailLoggedIn']=$email;
    header("Location: index.php");
  }
}

 ?>
