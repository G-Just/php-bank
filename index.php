<?php
require './globals/head.php';
require './globals/navbar.php';
define('REQ', TRUE);
require './functions/functions.php';
?>

<div id='table-wrapper'>
    <?php
    $data = readData();
    usort($data, 'sortByLastName');
    if (count($data) > 0) {
        echo " <table id='wallet-table'>
                    <thead>
                        <tr>
                            <td>Owner</td>
                            <td>Personal code</td>
                            <td>Account number</td>
                            <td>Balance</td>
                            <td>Actions</td>
                        </tr>
                    </thead>
                    <tbody>";
        foreach ($data as $entry) {
            createWallet(
                $entry->id,
                $entry->name,
                $entry->lastName,
                $entry->number,
                $entry->personalCode,
                $entry->balance
            );
        }
    } else {
        echo "<p id='call-to-action'>No accounts present. Be the first! <a href='new.php'>Create an account</a><p>";
    }
    ?>
    </tbody>
    </table>
</div>
</body>

</html>