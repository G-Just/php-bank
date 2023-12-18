<?php
define('REQ', TRUE);
require '../functions/functions.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $deposit = $_POST['deposit'];
    $id = $_POST['id'];
    if ($deposit <= 0 || !isset($deposit) || $deposit > PHP_INT_MAX) {
        header("Location: ../deposit.php?wallet=$id&error=invalid_amount");
        exit();
    }
    modifyWallet($id, $deposit);
    header("Location: ../index.php?status=deposit_added");
    exit();
} else {
    header('Location: ../index.php?error=unauthorized');
    die();
}
