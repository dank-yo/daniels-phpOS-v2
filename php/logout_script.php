<?php
require('../config.php');

session_destroy();
$_SESSION = [];

header("Location: ../login.php");
exit();
?>