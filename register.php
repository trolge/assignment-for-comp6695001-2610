<?php
    session_set_cookie_params([
        'httponly' => true,
        'secure' => true
    ]);
    session_start();

    if (!isset($_SESSION['logged_in_user']) && isset($_COOKIE['remember_user'])) {
        $email = $_COOKIE['remember_user'];
        if (isset($_SESSION['users'][$email])) {
            $_SESSION['logged_in_user'] = $_SESSION['users'][$email];
        }
    }
    if (isset($_SESSION['logged_in_user'])) {
        header("Location: index.php");
        exit();
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
        <div>
            Register
        </div>

        <!-- TODO: When user clicks login, form will collect data in input tags and send the data to actions/doLogin.php using POST request method. -->
        <!-- CODE STARTS HERE -->
        <form method="POST" action="actions/doRegister.php">
            <div>
                <label>Full Name</label>
                <input type="text" id="user-name" name="user-name">
            </div>
            <div>
                <label>E-mail Address</label>
                <input type="text" id="user-email" name="user-email">
            </div>
            <div>
                <label>Gender</label>
                <input type="radio" name="user-gender" id="user-gender-male" value="Male"> Male
                <input type="radio" name="user-gender" id="user-gender-female" value="Female"> Female
                <input type="radio" name="user-gender" id="user-gender-prefer-not-to-say" value="Prefer not to say"> Prefer not to say
            </div>
            <div>
                <label for="user-password">Password</label>
                <input type="password" id="user-password" name="user-password">
            </div>
            <div>
                <button type="submit">Register</button>
            </div>

            <!-- TODO: Print error message, if exists, that comes from actions/doLogin.php. -->
            <!-- CODE STARTS HERE -->
            <div id="error-message">
            <?php
                if (!empty($_SESSION['register_error'])) {
                    foreach ($_SESSION['register_error'] as $error) {
                        echo "<p> $error </p>";
                    }
                    unset($_SESSION['register_error']);
                }
            ?>
            </div>
            <!-- CODE ENDS HERE -->
             
        </form>
        <!-- CODE ENDS HERE -->
    </div>
</body>
</html>