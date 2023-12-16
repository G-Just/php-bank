<?php
include '../functions/functions.php';

$id = $_GET['wallet'];

$wallet = readData($id)[0];
print_r($wallet);
if ($wallet->balance === 0) {
    removeWallet($id);
    header('Location: ../index.php?status=account_removed');
} else {
    header('Location: ../index.php?error=balance_not_zero');
}
