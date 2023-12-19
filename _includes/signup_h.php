<?php
define('REQ', TRUE);
require '../functions/functions.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = htmlspecialchars($_POST['username']);
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);
    $passwordConfirm = htmlspecialchars($_POST['password_confirm']);
    function validate(...$values): array
    {
        $users = json_decode(file_get_contents(__DIR__ . '/../database/credentials.JSON'));
        foreach ($values as $entry) {
            if (empty($entry)) {
                header('Location: ../signup.php?error=empty_fields');
                exit();
            }
        }
        foreach ($users as $entry) {
            if ($entry->email == $values[1]) {
                header('Location: ../signup.php?error=duplicate_email');
                exit();
            }
        }
        if (!filter_var($values[1], FILTER_VALIDATE_EMAIL)) {
            header('Location: ../signup.php?error=invalid_email');
            exit();
        }
        if ($values[2] !== $values[3]) {
            header('Location: ../signup.php?error=passwords_do_not_match');
            exit();
        }
        if (isset((end($users)->id))) {
            $id = (end($users)->id) + 1;
        } else {
            $id = 0;
        }
        $password = password_hash($values[2], PASSWORD_DEFAULT);
        return ['id' => $id, 'username' => $values[0], 'email' => $values[1], 'password' => $password];
    }
    $data = json_decode(file_get_contents(__DIR__ . '/../database/credentials.JSON'));
    array_push($data, validate($username, $email, $password, $passwordConfirm));
    $data = json_encode($data, JSON_PRETTY_PRINT);
    file_put_contents(__DIR__ . '/../database/credentials.JSON', $data);
    header('Location: ../signin.php?status=account_created');
    exit();
} else {
    header('Location: ../index.php?error=unauthorized');
    die();
}
