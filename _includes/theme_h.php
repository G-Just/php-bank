<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_COOKIE['theme'])) {
        if ($_COOKIE['theme'] == 'dark') {
            setcookie("theme", "", time() - 3600);
            setcookie('theme', 'light', 0, "/");
        } else {
            setcookie("theme", "", time() - 3600);
            setcookie('theme', 'dark', 0, "/");
        }
    } else {
        setcookie('theme', 'dark', 0, "/");
    }
    header('Location: ../index.php');
} else {
    header('Location: ../index.php?error=unauthorized');
    die();
}
