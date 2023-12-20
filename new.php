<?php
require './globals/head.html';
require './globals/navbar.php';
define('REQ', TRUE);
require './functions/functions.php';
if (!isset($_SESSION['id'])) {
    header('Location: ./signin.php?error=not_signed_in');
    die();
}
?>

<body>
    <div id='form-window-wrapper'>
        <div id="form-window">
            <form action="./_includes/new_h.php" method="POST">
                <p>Your new bank account number</p>
                <?php
                $data = readData();
                if (count($data) > 0) {
                    $number = str_pad((string)(int)substr(end($data)->number, 9, 11) + 1, 11, '0', STR_PAD_LEFT);
                    $number = "LT0099999$number";
                } else {
                    $number = "LT009999900000000001";
                }
                echo "<h1>$number</h1>";
                echo "<input type='hidden' name='number' value='$number'>"
                ?>
                <label for="fname">First Name</label>
                <input type="text" name="fname" id="fname">
                <label for="lname">Last Name</label>
                <input type="text" name="lname" id="lname">
                <label for="code">Personal code</label>
                <input type="number" name="code" id="code">
                <button type="submit" name='submit'>Create</button>
            </form>
        </div>
    </div>
</body>