<?php
define('REQ', TRUE);
require '../functions/functions.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);
    $users = json_decode(file_get_contents(__DIR__ . '/../database/credentials.JSON'));
    foreach ($users as $user) {
        if ($user->email === $email) {
            if (password_verify($password, $user->password)) {
                session_start();
                $_SESSION['id'] = $user->id;
                $_SESSION['username'] = $user->username;
                $_SESSION['email'] = $user->email;
                header('Location: ../index.php?status=signed_in');
                exit();
            } else {
                header('Location: ../signin.php?error=wrong_password');
                exit();
            }
        }
    }
    header('Location: ../signin.php?error=email_not_found');
    exit();
} else {
    header('Location: ../index.php?error=unauthorized');
    die();
}
