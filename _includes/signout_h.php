<?php
session_start();
if (isset($_SESSION['id'])) {
    unset($_SESSION);
    session_destroy();
    header('Location: ../index.php?status=signed_out');
    exit();
} else {
    header('Location: ../index.php?error=unauthorized');
    die();
}
