<?php
require('default.php');
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
        <table>
            <tr>
                <th class='user'>
                    <img src='Contacts/img/avi.svg' width='100%'></img>
                    <p class='m-0 p-1'><?php echo $_SESSION['username'] . "#" . formatUID($_SESSION['uid']); ?></p>
                </th>
                <th id='function-row' class='search-function'>
                    <button id="addButton" class='login-button' style='height: 40px; font-size: 14px'>+</button>
                </th>
            </tr>
            <tr>
                <td class='friends-list'>
                </td>
                <td>
                <?php
                if (isset($_SESSION['query-userbase-results'])) {
                    $results = $_SESSION['query-userbase-results'];

                    if (!empty($results)) {
                        echo "<div>";
                        foreach ($results as $row) {
                            echo "<div>" . $row['username'] . "#" . formatUID($row['uid']) . "</div>";
                        }
                        echo "</div>";
                    }
                }
                ?>
                </td>
            </tr>
        </table>
    </body>
</html>
<script src='./Contacts/js/main.js'></script>