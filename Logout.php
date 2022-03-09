<?php
    // source: https://www.tutorialspoint.com/php/php_login_example.htm
    session_start();
    unset($_SESSION["user_id"]);
    unset($_SESSION["user_name"]);

    echo 'You have been successfully logged out';
    header('Refresh: 2; URL = index.html');
?>