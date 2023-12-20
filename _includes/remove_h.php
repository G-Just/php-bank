<?php
session_start();
define('REQ', TRUE);
require '../functions/functions.php';
if (!isset($_SESSION['id'])) {
    header('Location: ../signin.php?error=not_signed_in');
    die();
}

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['wallet'])) {
    $id = $_GET['wallet'];
    $wallet = readData($id);
    print_r($wallet);
    if ($wallet->balance === 0) {
        removeWallet($id);
        header('Location: ../index.php?status=account_removed');
        exit();
    } else {
        header('Location: ../index.php?error=balance_not_zero');
        exit();
    }
} else {
    header('Location: ../index.php?error=unauthorized');
    die();
}
