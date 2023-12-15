<?php
include './globals/head.php';
include './globals/navbar.php';
require './functions/functions.php';
?>

<body>
    <div id='wallet-list'>
        <?php
        $data = read();
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
    </div>;
</body>

</html>