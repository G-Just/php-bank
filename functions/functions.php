<?php
if (!defined('REQ')) {
    header('Location: ../index.php?error=unauthorized');
    die();
}

function updateData($data): void
{
    $data = json_encode($data, JSON_PRETTY_PRINT);
    file_put_contents(__DIR__ . '/../database/data.JSON', $data);
}

function readData($id = -1): array | object
{
    $id = (int)$id;
    $data = file_get_contents(__DIR__ . '/../database/data.JSON'); // <- 3h fixing this CANCER with relative paths
    $data = json_decode($data);
    if ($id === -1) {
        return $data;
    } else {
        foreach ($data as $object) {
            if ($object->id === $id) {
                return $object;
            }
        }
    }
    die("Reading failed. Maybe the requested ID -> ($id) doesn't exist?");
}

function addNewWallet($name, $lname, $number, $code): void
{
    $currentData = readData();
    if (isset((end($currentData)->id))) {
        $id = (end($currentData)->id) + 1;
    } else {
        $id = 0;
    }
    $newWallet = ['id' => $id, 'name' => $name, 'lastName' => $lname, 'number' => $number, 'personalCode' => $code, 'balance' => 0];
    array_push($currentData, $newWallet);
    updateData($currentData);
}

function modifyWallet($id, $amount)
{
    $currentData = readData();
    foreach ($currentData as $wallet) {
        if ($wallet->id === (int)$id) {
            $wallet->balance = round($wallet->balance, 2);
            $wallet->balance += round($amount, 2);
        }
    }
    updateData($currentData);
}

function removeWallet($id)
{
    $currentData = readData();
    foreach ($currentData as $key => $wallet) {
        if ($wallet->id === (int)$id) {
            unset($currentData[$key]);
        }
    }
    $currentData = array_values($currentData);
    updateData($currentData);
}

function createWallet($id, $name, $lname, $number, $code, $balance): void
{
    echo "
    <tr>
    <td>$lname $name</td>
    <td>$code</td>
    <td>$number</td>
    <td>$" . number_format($balance, 2) . "</td>
    <td>
    <span class='long'>
    <a class='add-f' href='./deposit.php?wallet=$id'>Add</a>
    <a class='remove-f' href='./withdraw.php?wallet=$id'>Withdraw</a>
    <a class='close-f' href='./_includes/remove_h.php?wallet=$id' onclick=\"return confirm(`Are you sure?\nAll account data will be lost.`)\">Close</a>
    </span>
    <span class='short'>
    <a class='add-f' href='./deposit.php?wallet=$id'>+</a>
    <a class='remove-f' href='./withdraw.php?wallet=$id'>-</a>
    <a class='close-f' href='./_includes/remove_h.php?wallet=$id' onclick=\"return confirm(`Are you sure?\nAll account data will be lost.`)\">X</a>
    </span>
    </td>
    </tr>";
}

function sortByLastName($a, $b)
{
    if (($a->lastName <=> $b->lastName) === 0) {
        return $a->name <=> $b->name;
    } else {
        return $a->lastName <=> $b->lastName;
    }
}

function validPersonalCode($code): bool
{
    if (strlen($code) === 11) {
        if ($code[0] >= 1 && $code[0] <= 6) {
            if (checkdate(substr($code, 3, 2), substr($code, 5, 2), substr($code, 1, 2))) {
                $s = $code[0] * 1 + $code[1] * 2 + $code[2] * 3 + $code[3] * 4 + $code[4] * 5 + $code[5] * 6 + $code[6] * 7 + $code[7] * 8 + $code[8] * 9 + $code[9] * 1;
                if ($s % 11 === 10) {
                    $s = $code[0] * 3 + $code[1] * 4 + $code[2] * 5 + $code[3] * 6 + $code[4] * 7 + $code[5] * 8 + $code[6] * 9 + $code[7] * 1 + $code[8] * 2 + $code[9] * 3;
                    if ($s % 11 === 10 && $s % 11 == $code[10]) {
                        return true;
                    } elseif ($s % 11 == $code[10]) {
                        return true;
                    }
                } elseif ($s % 11 == $code[10]) {
                    return true;
                }
            }
        }
    }
    return false;
}

function validateSignUp(...$values): array
{
    $users = json_decode(file_get_contents(__DIR__ . '/../database/credentials.JSON'));
    foreach ($values as $entry) {
        if (empty($entry)) {
            header('Location: ../signup.php?error=empty_fields');
            exit();
        }
    }
    foreach ($users as $entry) {
        if ($entry->email == $values[1]) {
            header('Location: ../signup.php?error=duplicate_email');
            exit();
        }
    }
    if (!filter_var($values[1], FILTER_VALIDATE_EMAIL)) {
        header('Location: ../signup.php?error=invalid_email');
        exit();
    }
    if ($values[2] !== $values[3]) {
        header('Location: ../signup.php?error=passwords_do_not_match');
        exit();
    }
    if (isset((end($users)->id))) {
        $id = (end($users)->id) + 1;
    } else {
        $id = 0;
    }
    $password = password_hash($values[2], PASSWORD_DEFAULT);
    return ['id' => $id, 'username' => $values[0], 'email' => $values[1], 'password' => $password];
}

function validateAccount(...$values): bool
{
    $data = readData();
    foreach ($values as $entry) {
        if (empty($entry)) {
            header('Location: ../new.php?error=empty_fields');
            exit();
        }
    }
    foreach ($data as $entry) {
        if ($entry->personalCode === end($values)) {
            header('Location: ../new.php?error=duplicate_personal_code');
            exit();
        }
    }
    if (strlen($values[0]) < 3 || strlen($values[1]) < 3) {
        header('Location: ../new.php?error=short');
        exit();
    }
    if (strlen($values[0]) > 13 || strlen($values[1]) > 13) {
        header('Location: ../new.php?error=long');
        exit();
    }
    if (!validPersonalCode($values[2])) {
        header('Location: ../new.php?error=invalid_personal_code');
        exit();
    }
    return true;
}
function generateBankNumber(): string
{
    $data = readData();
    $number = '';
    foreach (range(1, 11) as $digit) {
        $number = $number . (string)rand(0, 9);
    }
    foreach ($data as $entry) {
        if ($number === substr($entry->number, 9)) {
            return generateBankNumber();
        }
    }
    return $number;
}
