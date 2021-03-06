<?php
/*
File Name: regConfirmationPage.php
Last Edited: 05/30/2021
Author: Katie Pundt
*/
require_once 'User.php';
require_once 'Database.php';
require_once 'Email.php';
require_once 'utilities.php';
require_secure();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
    <title>PCC Food Pantry | New Account Confirmation</title>
    <!-- Reset CSS -->
    <link href="css/reset.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400&display=swap" rel="stylesheet">
    <!-- Project CSS -->
    <link href="css/pantherPantry.css" rel="stylesheet">
</head>
<body>
<h1>New Account Confirmation</h1>
<nav>
    <a href="../../web/pantryHome.html">Home</a>
    <a href="../../web/loginForm.php">Login</a>
    <a href="../../web/registerForm.php">Create New Account</a>
</nav>
<div id="wrapper">
    <p class="output"><?php
        $firstName = $_POST["first"];
        $lastName = $_POST["last"];
        $username = $_POST["username"];
        $password = $_POST["password"];
        $email = $_POST["email"];
        $cellPhone = $_POST["cellPhone"];
        $account_exists = Database::duplicate_account($username);
        if($account_exists) {
            echo "An account with that username already exists. Please login or try again.";
        } else {
            if($cellPhone == TRUE) {
                $receive_sms = 1;
            } else {
                $receive_sms = 0;
                $cellPhone = NULL;
            }
            Database::create_account($firstName, $lastName, $username, $password, $email, $cellPhone, $receive_sms);
            $_SESSION["session_username"] = $username;
            Email::send_verification();
            echo "Thank you " . $firstName . " " . $lastName . " for registering for the PCC Panther Pantry!"
                . "<br>" . "An activation email has been sent to " . $email . ". ";
        }
        ?></p>
</div>
</body>
</html>
