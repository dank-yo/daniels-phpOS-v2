<?php
require('../config.php');

function checkHash($email, $password){
  try {
    $conn = new PDO("mysql:host=".dbserv.";dbname=".dbname, dbuser, dbpass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT uid, username, password FROM userbase WHERE email = :email";

    $stmt = $conn->prepare($sql);
    $stmt->execute(['email' => $email]);
    $results = $stmt->fetch(PDO::FETCH_ASSOC);
    $conn = null;

    $password_hash = $results['password'];
    if(password_verify($password, $password_hash)){
      return true;
    }else{
      $error = "Error: Unable to verify password hash!";
      return false;
    }
  } catch(PDOException $e) {
    $error = $e->getMessage();
    $_SESSION["login_notif"] = $error;
    header("Location: ../login.php");
    exit();
  }
}

if(!empty($_POST['email']) && !empty($_POST['password'])) {
  /*Setting Variables*/
  $email = $_POST['email'];
  $pass = $_POST['password'];

  $conn = new PDO("mysql:host=".dbserv.";dbname=".dbname, dbuser, dbpass);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $sql = "SELECT COUNT(*) FROM userbase WHERE email = :email";
  $stmt = $conn->prepare($sql);
  $stmt->execute(['email' => $email]);
  $count = $stmt->fetchColumn();

  if($count > 0){
    if(checkHash($email, $pass) == true){
      $sql = "SELECT uid, email, username, firstname, lastname, created, role
              FROM userbase
              WHERE email = :email";

      $stmt = $conn->prepare($sql);
      $stmt->execute(['email' => $email]);
      $result = $stmt->fetch(PDO::FETCH_ASSOC);
      
      $_SESSION['logged_in'] = true;
      $_SESSION['uid'] = $result['uid'];
      $_SESSION['username'] = $result['username'];
      $_SESSION['firstname'] = $result['firstname'];
      $_SESSION['lastname'] = $result['lastname'];
      $_SESSION['email'] = $result['email'];
      $_SESSION['created'] = $result['created'];
      $_SESSION['role'] = $result['role'];
      
      switch($result['role']){
        case 'admin':
          $_SESSION['usericon'] = 'img/icons/account_icons/super-user.svg';
          break;
        case 'user':
          $_SESSION['usericon'] = 'img/icons/account_icons/default-user.svg';
          break;
      }

      header("Location: ../index.php");
      exit();
    }else{
      $error = "Error! Incorrect password!";
    }
  }else{
    $error = "Error! Email does not exist!";
  }
}else {
  $error = "Error: Please fill in all the fields!";
}
?>
