<?php
require('config.php');

runLoginCheck();

?>

<!doctype html>
<html>

    <head>
    <?php inject_default_page_head('Home'); ?>

    <script>
        window.onload = function(){
            startTime();

            const dock_list = document.getElementById('dock-list');

            const messages = new Applet(1, "Messages", 'application', 'apps/Messages/', 560, 500);
            const contact = new Applet(3, "Contacts", 'application', 'apps/Contacts/', 600, 360);
            const settings = new Applet(4, "Settings", 'application', 'apps/Settings/', 420, 500);

            dock_list.appendChild(messages.element);
            dock_list.appendChild(contact.element);
            dock_list.appendChild(settings.element);
            
            <?php 
                load_welcome_panel();
            ?>
        }
    </script>

    </head>

    <body class='d-flex overflow-hidden'>
        <nav class="navbar-wrapper navbar navbar-expand-sm d-flex justify-content-between fixed-top shell-theme" data-mdb-toggle='animation' data-mdb-animation-start='navbar-slide' data-mdb-animation-reset='false'>
            <div class="dropdown w-100">
                <a class="btn btn-sm p-0" style='margin-left: 2px;' data-bs-toggle="dropdown"><img src="img/logo/fav-icon-light-128.ico" alt="o" width=24></a>
                <div class="dropdown-menu shell-theme" data-mdb-toggle="animation" data-mdb-animation="fade-in-down" style="animation-duration: 1500ms;" reset="true">
                    <div class='dropdown-user-info d-flex'>
                        <div class='dropdown-user-avatar'>
                            <img src='<?php echo $_SESSION['usericon'];?>' class='dropdown-avatar-img'></img>
                        </div>
                        <div class='dropdown-user-information m-2'>
                            <p class='m-0 p-0'>Name: <?php echo $_SESSION['firstname'] . " " . $_SESSION['lastname']?></p>
                            <p class='m-0 p-0'>User: <?php echo $_SESSION['username'] . "#" . formatUID($_SESSION['uid']); ?></p>
                            <p class='m-0 p-0'>Email: <?php echo $_SESSION['email']; ?></p>
                            <p class='m-0 p-0'>Role: <?php echo $_SESSION['role']; ?></p>
                            <p class='m-0 p-0'>Created: <?php echo $_SESSION['created']; ?></p>
                        </div>
                    </div>
                    <div class='w-100'>
                        <ul class='dropdown-button-list d-flex justify-content-center'>
                            <li><a href='php/logout_script.php' class='btn btn-sm shell-button shell-dropdown-button'><img src='img/icons/logout.svg'></img></a></li>
                            <li><a href='' class='btn btn-sm shell-button shell-dropdown-button' disabled><img src='img/icons/login.svg'></img></a></li>
                            <li><a href='' class='btn btn-sm shell-button shell-dropdown-button' disabled><img src='img/icons/register.svg'></img></a></li>
                        </ul>
                    </div>
                </div>
                <div>

                </div>
            </div>
            <div class='datetime w-100 text-center' id='time'></div>
            <div class='w-100'></div>
        </nav>
        <div class='dock-wrapper d-flex align-items-center' data-mdb-animation-reset='false' id='dock-wrapper' >
            <div class='dock shell-theme'>
                <ul id='dock-list' class="dock-items text-muted">
                </ul>
            </div>
        </div>
        <div class='desktop-wrapper' id='desktop'>
        </div>
    </body>
</html>