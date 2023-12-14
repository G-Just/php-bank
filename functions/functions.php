<?php
function fetch(): array
{
    $data = file_get_contents('./database/data.JSON');
    $data = json_decode($data);
    return $data;
}

function createWallet($id, $name, $lname, $number, $code, $balance)
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
