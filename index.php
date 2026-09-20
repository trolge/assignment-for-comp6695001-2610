<?php
    session_start();

    if (empty($_SESSION['logged_in_user']) && isset($_COOKIE['remember_user'])) {
        $email = $_COOKIE['remember_user'];
        if (isset($_SESSION['users'][$email])) {
            $_SESSION['logged_in_user'] = $_SESSION['users'][$email];
        }
    }
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
        <h1>Home Page</h1>
    </div>

    <!-- TODO: Print logged in user name in "user-name" span here -->
    <!-- CODE STARTS HERE -->
    <?php
        $username = htmlspecialchars($_SESSION['logged_in_user']['username'] ?? '', ENT_QUOTES, 'UTF-8');
    ?>
    <div>
        Welcome, <span id="user-name"><?= $username ?></span>
    </div>
    <!-- CODE ENDS HERE -->

    <div>
        <div>
            Menu:
        </div>
        <ul>
            <li><a href="/profile.php">View Profile</a></li>
            <li><a href="/logout.php">Logout</a></li>
        </ul>
    </div>
</body>
</html>