<?php
    session_start();

    if (empty($_SESSION['logged_in_user']) && isset($_COOKIE['remember_user'])) {
        $email = $_COOKIE['remember_user'];
        if (isset($_SESSION['users'][$email])) {
            $_SESSION['logged_in_user'] = $_SESSION['users'][$email];
        }
    }
    if (!isset($_SESSION['logged_in_user'])) {
    header("Location: login.php");
    exit();
    }

    $user = $_SESSION['logged_in_user'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Project 1 - Login Register</title>
</head>
<body>
    <div>
        <h1>View Profile Page</h1>
    </div>

    <!-- TODO: Print logged in user name, user e-mail address, and user gender in respective input tags -->
    <!-- CODE STARTS HERE -->
    <div>
        <div>
            <label for="user-name">User Name</label>
            <input type="text" id="user-name" value="<?= htmlspecialchars($user['username'] ?? '', ENT_QUOTES, 'UTF-8') ?>" disabled>
        </div>
        <div>
            <label for="user-email">User E-mail Address</label>
            <input type="text" id="user-email" value="<?= htmlspecialchars($user['email'] ?? '', ENT_QUOTES, 'UTF-8') ?>" disabled>
        </div>
        <div>
            <label for="user-gender">User Gender</label>
            <input type="text" id="user-gender" value="<?= htmlspecialchars($user['gender'] ?? '', ENT_QUOTES, 'UTF-8') ?>" disabled>
        </div>
    </div>
    <!-- CODE ENDS HERE -->
</body>
</html>