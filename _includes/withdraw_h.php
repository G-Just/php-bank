<?php
define('REQ', TRUE);
require '../functions/functions.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $withdraw = $_POST['withdraw'];
    $id = $_POST['id'];
    $wallet = readData((int)$id)[0]->balance;
    if ($withdraw <= 0 || !isset($withdraw) || $withdraw > PHP_INT_MAX) {
        header("Location: ../withdraw.php?wallet=$id&error=invalid_amount");
        exit();
    }
    if ($withdraw > $wallet) {
        header("Location: ../withdraw.php?wallet=$id&error=insufficient_funds");
        exit();
    }
    modifyWallet($id, $withdraw * -1);
    header("Location: ../index.php?status=balance_withdrawn");
} else {
    header('Location: ../index.php?error=unauthorized');
    die();
}
