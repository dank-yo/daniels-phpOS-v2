<?php
session_start();

require('../../../config.php');

function findAllUsers(){
    try {
        $conn = new PDO("mysql:host=".dbserv.";dbname=".dbname, dbuser, dbpass);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "SELECT username, uid FROM userbase";

        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $conn = null;

        return $results;
    } catch (PDOException $e) {
        // Handle the exception, log error, or display an error message
        echo "Error: " . $e->getMessage();
        return [];
    }
}

if (empty($_POST['user'])) {
    $tmp = findAllUsers(); 
    foreach ($tmp as $row) {
        echo $row['username'];
    }
}

$_SESSION['query-userbase-results'] = findAllUsers();
header('Location: ../');
exit();
?>
