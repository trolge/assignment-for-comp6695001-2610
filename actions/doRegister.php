<?php

// TODO: Check user data and credential given from register.php page and save user data to session
// Detail TODO:
// 1. Validate the user data is valid or not
//      1.1. User name: must be filled
//      1.2. User email: ends with @gmail.com or @binus.ac.id
//      1.3. User gender: between Male, Female, and Prefer not to tell
//      1.4. User password: at least 8 characters, at least consists of 1 upper case characters, 1 lower case characters, 1 number, and 1 symbol
// 2. If all validation checks out, save user data to session
// 3. Redirect user to login.php page to log in

// CODE STARTS HERE
    session_start();

    $register_error = [];

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $username = $_POST['user-name'] ?? '';
        $email = $_POST['user-email'] ?? '';
        $gender = $_POST['user-gender'] ?? ''; 
        $password = $_POST['user-password'] ?? '';

        //VALIDATION
        if (empty(trim($username))) {
            $register_error[] = "User name cannot be empty.";
        } 
        if (!preg_match('/@(gmail\.com|binus\.ac\.id)$/i', $email)) {
            $register_error[] = "Email address must end with @gmail.com or @binus.ac.id.";
        } 
        if (!in_array($gender, ["Male", "Female", "Prefer not to say"])) {
            $register_error[] = "Gender must be Male, Female, or Prefer not to say.";
        } 
        if (strlen($password) < 8 ||
            !preg_match('/[A-Z]/', $password) ||
            !preg_match('/[a-z]/', $password) ||
            !preg_match('/[0-9]/', $password) ||
            !preg_match('/[^A-Za-z0-9]/', $password)) {
            $register_error[] = "Password must be at least 8 characters, 
            also at least contains 1 upper case character, 
            1 lowercase character, 1 number, and 1 symbol";
        } 
        //SUCCESSFUL REGISTRATION
        if (empty($register_error))  {
            if (!isset($_SESSION['users'])) {
                $_SESSION['users'] = [];
            }
            $_SESSION['users'][$email] = [
                'username' => $username,
                'email' => $email,
                'gender' => $gender,
                'password' => $password
            ];
            header("Location: ../login.php");
            exit();
        } else {
            $_SESSION['register_error'] = $register_error;
            header('Location: ../register.php');
            exit();
        }
    }
?>

