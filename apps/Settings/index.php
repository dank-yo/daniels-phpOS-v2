<?php
require('default.php');

?>
<!DOCTYPE html>
<html>
<head>
    <?php
    inject_app_settings("Contact", "Contact", "img/avi.svg");
    inject_bootstrap();
    echo "<link rel='stylesheet' href='Settings/css/default.css'>";
    ?>
</head>

<body class='shell-theme' style='height: 100%;'>
    <!-- Password Change Form -->
    <div class="container">
        <div class='text-center'>
            <h2>Settings</h2>
            <form method="POST" action="">
                <div class="form-group">
                    <label for="new_password">New Password:</label>
                    <input type="password" class="form-control" id="new_password" name="new_password" required>
                </div>
                <button type="submit" class="btn btn-primary">Change Password</button>
            </form>
    </div>
</body>
</html>
