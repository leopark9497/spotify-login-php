<?php
function sanitizeEmail($inputText){
  $inputText = strip_tags($inputText);
  $inputText = str_replace(" ", "", $inputText);
  return $inputText;
}
function sanitizePassword($inputText){
  $inputText = strip_tags($inputText);
  return $inputText;
}

if(isset($_POST['registerButton'])){
  $email = sanitizeEmail($_POST['email']);
  $password = sanitizePassword($_POST['password']);
  $password2 = sanitizePassword($_POST['password2']);
  $wasSuccessful = $account -> register($email, $password, $password2);
  if($wasSuccessful == true){
    $_SESSION['emailLoggedIn']=$email;
    header("Location: index.php");
  }
}
 ?>
