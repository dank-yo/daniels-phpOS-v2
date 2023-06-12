<?php

function findFriends(){
    try {
        $conn = new PDO("mysql:host=".dbserv.";dbname=".dbname, dbuser, dbpass);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $username_query = $_SESSION['username'];
        $uid_query = $_SESSION['uid'];

        $sql = "SELECT friends FROM userbase WHERE uid = '$uid_query' AND username = '$username_query'";

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

function formatFriends($array){
    $usernames = explode('; ', $array); // Split the string into an array using semicolon as the delimiter
    $formattedFriends = '';

    foreach ($usernames as $username) {
        $formattedFriends .= "<p>" . $username . "</p>";
    }

    return $formattedFriends;
}

?>
