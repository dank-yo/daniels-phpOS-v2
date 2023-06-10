<?php

require('../config.php');

function checkUserExistance($email){
  try {
    $conn = new PDO("mysql:host=".dbserv.";dbname=".dbname, dbuser, dbpass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT email FROM userbase WHERE email = :email";

    $stmt = $conn->prepare($sql);
    $stmt->execute(['email' => $email]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $conn = null;

    return !empty($result);

  }catch(PDOException $e) {
    $error = $e->getMessage();
    $_SESSION["register_notif"] = $error;
    $conn = null;
    header("Location: ../register.php");
    exit();
  }
}

function insertUser($data){
  try {
    /*Insert Encrypted user info to main database for verifying*/
    $conn = new PDO("mysql:host=".dbserv.";dbname=".dbname, dbuser, dbpass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "insert into userbase (uid, username, password, email, firstname, lastname, IP, created, lastlogin, role)
            values (:uid, :username, :password, :email, :firstname, :lastname, :IP, :created, :lastlogin, :role)";

    $stmt = $conn->prepare($sql);
    $stmt->execute($data);
    $conn = null;

    $success = "Success! You may now login with " . $data['email'];
    $_SESSION["login_notif"] = $success;

    header('Location: ../login.php');
  }catch(PDOException $e) {
    $error = $e->getMessage();
    $_SESSION["register_notif"] = $error;
    $conn = null;
    header("Location: ../register.php");
    exit();
  }
}


foreach ($_POST as $key => $value) {
  if (empty($value)) {
    $error = "Error! $key field empty!";
    $_SESSION["register_notif"] = $error;
    header("Location: ../register.php");
    exit();
  }
}

if ($_POST['password'] == $_POST['re-password']) {
  // Set Variables
  $firstname = $_POST['firstname'];
  $lastname = $_POST['lastname'];
  $username = $_POST['username'];
  $password = $_POST['password'];
  $email = $_POST['email'];

  // Hash the password
  $password = password_hash($password, PASSWORD_DEFAULT);

  // Other variable assignments if needed
  $uid = rand(1, 9999);

  $data = [
    'uid' => $uid,
    'username' => $username,
    'password' => $password,
    'email' => $email,
    'firstname' => $firstname,
    'lastname' => $lastname,
    'IP' => $clientIP,
    'created' => $datetime,
    'lastlogin' => $datetime,
    'role' => 'user'
  ];

  // Process the rest of the code here
  if (checkUserExistance($email)) {
    $error = 'Error! Email already attached to account!';
  }else{
    insertUser($data);
  }
} else {
  $error = "Error: Passwords don't match!";
}


if (isset($error)) {
  $_SESSION["register_notif"] = $error;
  header("Location: ../register.php");
  exit();
}