<?php
include './globals/head.html';
include './globals/navbar.php';
define('REQ', TRUE);
require './functions/functions.php';
?>

<body>
    <div id='form-window-wrapper'>
        <div id="form-window">
            <form action="./_includes/deposit_h.php" method="POST">
                <p>Account owner:</p>
                <?php
                $data = readData($_GET['wallet']);
                echo '<h1 style=text-align:center;margin-bottom:3px>' . $data->name . ' ' . $data->lastName . '</h1>'
                    . '<h5 style=text-align:center;margin-bottom:10px>' . $data->personalCode . '</h5>'
                    . '<p>Account number:</p>'
                    . '<h1 style=text-align:center;margin-bottom:10px>' . $data->number . '</h1>'
                    . '<p>Current balance:</p>'
                    . '<h1 style=text-align:center;margin-bottom:20px>' . '$ ' . number_format($data->balance, 2) . '</h1>'
                    . '<h1 id=' . 'bal' . ' style=display:none>' . $data->balance . '</h1>'
                    . "<input type='hidden' name='id' value=" . $data->id . '>'
                ?>
                <label style='text-align:center;' for="deposit">Deposit amount</label>
                <input id='inp' style='margin-bottom:0' type="number" step="0.01" name="deposit" id="deposit" oninput="
                const el = document.getElementById('expected');
                const txt = document.getElementById('inp');
                const balance = document.getElementById('bal');
                const trbal = +balance.innerText;
                el.innerHTML = `Expected balance : ${trbal+(+txt.value) >= 0 && +txt.value > 0 ? `$ ${(trbal+(+txt.value)).toFixed(2)}` : 'Invalid'}`;
                ">
                <p id='expected' style='font-size:0.9rem'>‎</p>
                <button type="submit" name='submit'>Add funds</button>
            </form>
        </div>
    </div>
</body>