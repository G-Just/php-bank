<?php

print_r($location);
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_COOKIE['theme'])) {
        if ($_COOKIE['theme'] == 'dark') {
            setcookie('theme', '', time() - 3600);
            setcookie('theme', 'light', 0, '/');
        } else {
            setcookie('theme', '', time() - 3600);
            setcookie('theme', 'dark', 0, '/');
        }
    } else {
        setcookie('theme', 'dark', 0, "/");
    }
    preg_match('/(?<=php-u2\/).*(?!\?)/', $_POST['from'], $location);
    $location = (preg_split('/[?=]/', $location[0]));
    if ($location[1] == 'wallet') {
        header('Location: ../' . $location[0] . '?' . $location[1] . '=' . $location[2]);
    } else {
        header('Location: ../' . $location[0] ?? '');
    }
} else {
    header('Location: ../index.php?error=unauthorized');
    die();
}
