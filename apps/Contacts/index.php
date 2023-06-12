<?php
require('default.php');
require('./php/get_friends.php');
?>
<!DOCTYPE html>
<html class='overflow-hidden'>
<head>
    <?php
        inject_bootstrap();
        inject_app_settings("Contacts", "Contacts", "./css/default.css"); 
    ?>
</head>

    <body class='shell-theme'>
        <div class='container'>
            <div class='row'>
                <div class='col-md-2 user' style='border: 2px solid white'>
                    <img src='Contacts/img/avi.svg' width='100%'></img>
                    <h3 class='m-0 p-0' style='overflow: auto'><?php echo $_SESSION['username'] . "#" . formatUID($_SESSION['uid']); ?><h3>
                </div>
                <div id='function-row' class='col-md-10 search-function' style='border: 2px solid white'>
                    <button id="addButton" class='login-button' style='height: 40px; font-size: 14px'>+</button>
                </div>
            </div>

            <div class='row'>
                <div class='col-md-2 w-25 text-center' style='border: 2px solid white'>
                    <h3>Friends</h3>
                    <div><?php $results = findFriends();  foreach ($results as $row) {echo "<p>" . $row['friends'] . "</p>";} ?></div>
                </div>
                <div class='col-md-10 w-75' style='border: 2px solid white'>

                </div>
            </div>

            <!--
            <div class='col-sm-2'>
                <?php
                if (isset($_SESSION['query-userbase-results'])) {

                    if (!empty($results)) {
                        echo "<div class='col-sm-2' style='border: 2px solid white'>
                                <div style='border: 2px solid white'>Username#ID</div>";
                        foreach ($results as $row) {
                            echo "<div style='border: 2px solid white'>" . $row['username'] . "#" . formatUID($row['uid']) . "</div>";
                        }
                        echo "</div>";
                    }
                }
                ?>
            </div> -->
        </div>
    </body>
</html>
<script src='./Contacts/js/main.js'></script>