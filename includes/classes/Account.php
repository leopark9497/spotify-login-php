<?php
  /**
   *
   */
  class Account
  {
    private $errorArray;
    private $con;
    public function __construct($con){
      $this->errorArray = array();
      $this->con = $con;
    }

    public function login ($em, $pw)  {
      $pw = md5($pw);
      $query = mysqli_query($this->con, "SELECT * FROM users WHERE email='$em' AND password='$pw'");
      if (mysqli_num_rows($query) == 1){
        return true;
      }
      else {
        array_push($this->errorArray, "Invalid email or password");
        return false;
      }
    }

    public function  register($em, $pw, $pw2){
        $this->validateEmail($em);
        $this->validatePassword($pw, $pw2);
        if(empty($this->errorArray) == true){
        //Insert into db
        return $this->insertUserDetails($em, $pw);
      }
      else{
        return false;
      }
    }

    public function getError($error){
          if(!in_array($error, $this->errorArray)){
            $error ="";
          }
          return "<p class='errorMessage'>$error</p>";
        }
      private function insertUserDetails($em, $pw){
        $encryptedPw = md5($pw);
        $date = date("Y-m-d");
        $result = mysqli_query($this->con,
        "INSERT INTO users VALUES ('', '$em','$encryptedPw','$date','')");
        return $result;

      }
      private function  validateEmail($em){
        $checkEmailQuery = mysqli_query($this->con, "SELECT email FROM users WHERE email='$em'");
        if (mysqli_num_rows($checkEmailQuery) != 0){
          array_push($this->errorArray, "This email has been taken");
          return;
        }
      }
      private function validatePassword($pw, $pw2){
        if($pw!= $pw2){
          array_push($this->errorArray, "Your passwords donot match");
          return;
        }
        if(strlen($pw)>32 || strlen($pw)<5){
          array_push($this->errorArray, "Your password must be between 5 and 32 characters");
          return;
        }
      }

  }


 ?>
