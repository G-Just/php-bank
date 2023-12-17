<?php
include './globals/head.html';
include './globals/navbar.php';
define('REQ', TRUE);
require './functions/functions.php';
?>

<body>
    <div id='table-wrapper'>
        <table id='wallet-table'>
            <thead>
                <tr>
                    <td>Owner</td>
                    <td>Personal number</td>
                    <td>Account number</td>
                    <td>Balance</td>
                    <td>Actions</td>
                </tr>
            </thead>
            <tbody>
                <?php
                $data = readData();
                usort($data, "sortByLastName");
                if (count($data) > 0) {
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
                    echo "No accounts present. Be the first! <a href='new.php'>Create an account</a>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>