<?php
/*  This file is the default php configuragtion file including
    - Database Login
    - Page Title & Head
    - Bootstrap Handler
    - Style Sheet Handler
    - 
*/
session_start();

define('dbserv', 'localhost');
define('dbname', 'phpOS');
define('dbuser', 'root');
define('dbpass', '');

define('version', 'rel-2.0.1');

error_reporting(E_ALL);
ini_set('display_errors', 1);

/*Global Date/Time Variables*/
date_default_timezone_set('America/Indiana/Vincennes');
$datetime = date('Y-m-d H:i:s');
$date = date('Y-m-d');
$time = date('H:i:s');

if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $clientIP = $_SERVER['HTTP_X_FORWARDED_FOR'];
} else {
    $clientIP = $_SERVER['REMOTE_ADDR'];
}
  

function inject_heading($string, $path="img/logo/fav-icon-dark-32.ico"){
    //Page Title
    echo "<title>" . $string . "</title>";
    //Favicon
    echo "<link rel='icon' type='image/x-icon' href='".$path."'>";
}

function set_home($path=""){
    //Home Directory
    echo "<base href='http://localhost/webOS/" . $path . "'>";
}

function inject_css($path="css/default.css"){
    // default style sheet included
    echo "<link rel='stylesheet' href='http://localhost/webOS/".$path."'>";
}

function inject_app_css($path){
    return inject_css("apps/$path");
}

function inject_bootstrap(){
    // jsDelivr for Bootstrap compiled CSS and JS
    echo '<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
          <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>';
}

function inject_js(){
    echo "
        <script src='js/clock.js'></script>
        <script src='js/window.js'></script>
        <script src='js/dock.js'></script>
        <script src='js/applet.js'></script>";
}

function inject_app_settings($string, $path){
    set_home("apps/$path");
    inject_heading($string);
    inject_css();
    inject_app_css("$path/css/default.css");
}

function inject_default_page_head($string){
    set_home();
    inject_heading("WebOS | " . $string);
    inject_bootstrap();
    inject_css();
    inject_js();
}

function runLoginCheck($path=""){
    if(!isset($_SESSION['logged_in'])){
      $_SESSION['login_notif'] = "Error! You must be logged in to do that!";
      header("Location: " . $path . "login.php");
    }
}

/* This function is there to check if any user has proper priviliges for an action*/
function runPrivilegeCheck($path){
    if($_SESSION['role'] != 'admin' || $_SESSION['role'] == 'user'){
        $_SESSION['error'] = "You do not have priviliges for that!";
        header("Location: " . $path . "index.php");
    }
  }

function load_session_vars(){
    if(!isset($_SESSION['logged-in'])){
        $_SESSION['logged-in'] = false;
    }
    if(!isset($_SESSION['uid'])){
        $_SESSION['uid'] = null;
    }
    if(!isset($_SESSION['username'])){
        $_SESSION['username'] = null;
    }
    if(!isset($_SESSION['loaded_welcome'])){
        $_SESSION['loaded_welcome'] = false;;
    }
}
function load_welcome_panel(){
    if($_SESSION['loaded_welcome'] == false){
        echo "createObject(0, 'Welcome', 'apps/Welcome/', 440, 220);";
            
    }
    $_SESSION['loaded_welcome'] = true;
}

function formatUID($number) {
    $numberLength = strlen((string) $number);
    
    // Determine the number of zeros to prepend based on the length of the number
    $zeros = str_repeat('0', 4 - $numberLength);
    
    // Concatenate the zeros with the original number
    $formattedNumber = $zeros . $number;
    
    return $formattedNumber;
}

load_session_vars();
?>