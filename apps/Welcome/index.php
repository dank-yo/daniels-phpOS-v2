<?php
require('default.php');
?>
<!DOCTYPE html>
<html>
<head>
    <?php
        inject_bootstrap();
        inject_app_settings("Welcome", "Welcome"); 
    ?>
</head>

<body class='shell-theme'>
    <div class='text-center m-2'>
        <h1>Welcome <?php echo $_SESSION['firstname']; ?>!</h1>
    </div>
    <div class='text-left'>
        <p class='m-2 p-2'>
            This is <?php echo version ?> of my web browser operating system, built using PHP and JavaScript. 
            I redesigned it with the initial intention of using it as my portfolio webpage. 
            However, I realized that a portfolio page should focus more on functionality rather than interactivity.
        </p>
        <h4 class='m-2 p-2'>2.0.1</h4>
        <ul>
            <li>Updated Contacts functionality.</li>
            <li>Updated login/registration system.</li>
        </ul>
        <h4 class='m-2 p-2'>2.0.0</h4>
        <ul>
            <li>Using a more object oriented code base.</li>
            <li>Implemented much more JavaScript functionality.</li>
            <li>Multiple windows can be opened at the same time.</li>
        </ul>
    </div>
<body>

</html>