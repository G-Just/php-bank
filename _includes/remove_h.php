<?php
define('REQ', TRUE);
include '../functions/functions.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_GET['wallet'];

    $wallet = readData($id)[0];
    print_r($wallet);
    if ($wallet->balance === 0) {
        removeWallet($id);
        header('Location: ../index.php?status=account_removed');
    } else {
        header('Location: ../index.php?error=balance_not_zero');
    }
} else {
    header('Location: ../index.php?error=unauthorized');
    die();
}
