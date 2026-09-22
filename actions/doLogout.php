<?php

// TODO: Log user out from the web application
// Detail TODO:
// 1. Remove saved user information in Session
// 2. Regenerate new Session ID
// 3. Redirect user to login.php page

// CODE STARTS HERE
    session_set_cookie_params([
        'httponly' => true,
        'secure' => true
    ]);
    session_start();

    unset($_SESSION['logged_in_user']);
    setcookie('remember_user', '', [
        'expires' => time() - 3600,
        'path' => '/',
        'httponly' => true,
        'secure' => true
    ]);
    session_regenerate_id(true);
    header("Location: ../login.php");
    exit();
?>