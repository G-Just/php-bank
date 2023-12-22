<?php
define('REQ', TRUE);
require '../functions/functions.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = htmlspecialchars($_POST['username']);
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);
    $passwordConfirm = htmlspecialchars($_POST['password_confirm']);
    $data = json_decode(file_get_contents(__DIR__ . '/../database/credentials.JSON'));
    array_push($data, validateSignUp($username, $email, $password, $passwordConfirm));
    $data = json_encode($data, JSON_PRETTY_PRINT);
    file_put_contents(__DIR__ . '/../database/credentials.JSON', $data);
    header('Location: ../signin.php?status=user_created');
    exit();
} else {
    header('Location: ../index.php?error=unauthorized');
    die();
}
