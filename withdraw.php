<?php
include './globals/head.php';
include './globals/navbar.php';
require './functions/functions.php'
?>

<body>
    <div id='form-window-wrapper'>
        <div id="form-window">
            <form action="./_includes/withdraw_h.php" method="POST">
                <p>Account owner:</p>
                <?php
                $data = read((int)$_GET['wallet'])[0];
                echo '<h1 style=text-align:center;margin-bottom:3px>' . $data->name . ' ' . $data->lastName . '</h1>';
                echo '<h5 style=text-align:center;margin-bottom:10px>' . $data->personalCode . '</h5>';
                echo '<p>Account number:</p>';
                echo '<h1 style=text-align:center;margin-bottom:10px>' . $data->number . '</h1>';
                echo '<p>Current balance:</p>';
                echo '<h1 style=text-align:center;margin-bottom:20px>' . '$ ' . number_format($data->balance, 2) . '</h1>';
                echo "<input type='hidden' name='id' value=" . $data->id . '>'
                ?>
                <label style='text-align:center;' for="withdraw">Withdraw amount</label>
                <input type="number" step="0.01" name="withdraw" id="withdraw">
                <button type="submit" name='submit'>Withdraw funds</button>
            </form>
        </div>
    </div>
</body>