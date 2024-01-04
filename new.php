<?php
require './templates/head.php';
require './templates/navbar.php';
define('REQ', TRUE);
require './functions/functions.php';
if (!isset($_SESSION['id'])) {
    header('Location: ./signin.php?error=not_signed_in');
    die();
}
?>

<div id='form-window-wrapper'>
    <div id="form-window">
        <form action="./_includes/new_h.php" method="POST">
            <p>New bank account number</p>
            <?php
            $data = readData();
            $number = "LT0099999" . generateBankNumber();
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