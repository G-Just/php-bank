<?php
define('REQ', TRUE);
require '../functions/functions.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = htmlspecialchars($_POST['fname']);
    $lname = htmlspecialchars($_POST['lname']);
    $code = htmlspecialchars($_POST['code']);
    $number = $_POST['number'];
    if (validateAccount($name, $lname, $code)) {
        addNewWallet($name, $lname, $number, $code);
        header('Location: ../index.php?status=created');
    }
} else {
    header('Location: ../index.php?error=unauthorized');
    die();
}
