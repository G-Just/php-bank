<?php
function read($id = -1): array | object
{
    $data = file_get_contents('./database/data.JSON');
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
    die("Reading failed. Maybe the requested ID doesn't exist?");
}
function write($name, $lname, $number, $code): void
{
    $currentData = read();
    if (isset((end($currentData)->id))) {
        $id = (end($currentData)->id) + 1;
    } else {
        $id = 0;
    }
    $newWallet = ['id' => $id, 'name' => $name, 'lastName' => $lname, 'number' => $number, 'personalCode' => $code, 'balance' => 0];
    array_push($currentData, $newWallet);
    $currentData = json_encode($currentData);
    file_put_contents('./database/data.JSON', $currentData);
}
function createWallet($id, $name, $lname, $number, $code, $balance): void
{
    echo "
    <div class='wallet'>
        <div class='top'>
            <p>Name: $name</p>
            <p>Last Name: $lname</p>
            <p>$number</p>
            <p>$code</p>
        </div>
        <div class='mid'>
            <p>" . '$ ' . number_format($balance, 2) . "</p>
        </div>
        <div class='bot'>
            <a href='./deposit.php?wallet=$id'>Add funds</a>
            <a href='./withdraw.php?wallet=$id'>Withdraw funds</a>
            <button>Close account</button>
        </div>
    </div>";
}
