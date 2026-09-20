<?php
session_start();

// TODO: Check sent user credentials from login.php page and logged them into the web application
// Detail TODO:
// 1. Get user credentials (email and password) that has been sent from login.php
// 2. Compare sent user credentials and saved user credentials when register new user (refer to the Register page procedure and logic)
// 3. If user comparation shows the user does not exists in saved user credentials, redirect back to login.php page and show error message of "Wrong user e-mail and password combination".
// 4. If user comparation shows the user exists in saved user credentials, regenerate the session ID, save user data to session as logged on user and redirect to home.php

// Notes:
// 1. When user chooses to check "Remember Me" checkbox, issue a persistent cookie with an expiration of 7 days. On another day the user accessed the web application, they will be logged on to their logged on user data.

// CODE STARTS HERE
if ($_SERVER['REQUEST_METHOD'] === "POST") {

    $email = $_POST['user-email'] ?? '';
    $password = $_POST['user-password'] ?? '';
    $remember_me = isset($_POST['remember-me']);

    if (isset($_SESSION['users'][$email]) &&
        $password === $_SESSION['users'][$email]['password']) {
        session_regenerate_id(true);   
        $_SESSION['logged_in_user'] = $_SESSION['users'][$email];
        if ($remember_me) {
            setcookie('remember_user', $email, time() + (7 * 24 * 60 * 60), "/");
        }
        header("Location: ../index.php");
        exit();
    }
    else {
        $_SESSION['login_error'] = "Wrong user e-mail and password combination";
        header("Location: ../login.php");
        exit();
    }
}
?>