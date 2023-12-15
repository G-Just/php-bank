<?php
require '../functions/functions.php';
function validate(...$values): bool
{
    $data = read();
    foreach ($values as $entry) {
        if (empty($entry)) {
            header('Location: ../new.php?error=empty_fields');
            exit();
        }
    }
    foreach ($data as $entry) {
        if ($entry->personalCode === end($values)) {
            header('Location: ../new.php?error=duplicate_personalCode');
            exit();
        }
    }
    if (strlen($values[0]) <= 3 || strlen($values[1]) <= 3) {
        header('Location: ../new.php?error=short');
        exit();
    }
    if (!validPersonalCode($values[2])) {
        header('Location: ../new.php?error=invalid_personalCode');
        exit();
    }
    return true;
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['fname']);
    $lname = htmlspecialchars($_POST['lname']);
    $code = htmlspecialchars($_POST['code']);
    $number = $_POST['number'];
    if (validate($name, $lname, $code)) {
        write($name, $lname, $number, $code);
        header('Location: ../index.php?status=created');
    }
} else {
    header('Location: ../index.php?status=unauthorized');
    die();
}
