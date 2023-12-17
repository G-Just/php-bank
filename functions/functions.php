<?php
function test()
{
    return 'Test';
}
function updateData($data): void
{
    $data = json_encode($data);
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
                return [$object];
            }
        }
    }
    die("readDataing failed. Maybe the requested ID -> $id doesn't exist?");
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
            $wallet->balance += (float)$amount;
            print_r($wallet);
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
    <a class='add-f' href='./deposit.php?wallet=$id'>Add</a>
    <a class='remove-f' href='./withdraw.php?wallet=$id'>Withdraw</a>
    <a class='close-f' href='./_includes/remove_h.php?wallet=$id'>Close</a></td>
    </tr>";
}
function sortByLastName($a, $b): int
{
    $tempArr = [$a->lastName, $b->lastName];
    $sortedArr = [$a->lastName, $b->lastName];
    sort($sortedArr);
    if ($tempArr[0] === $sortedArr[0]) {
        return -1;
    } else {
        return 1;
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
