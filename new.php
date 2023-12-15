<?php
include('./globals/head.php');
include('./globals/navbar.php');
include('./functions/functions.php');
?>

<body>
    <div>
        <form action="POST">
            <label for="fname">First Name</label>
            <input type="text" name="fname" id="fname">
            <label for="lname">Last Name</label>
            <input type="text" name="lname" id="lname">
            <label for="id">Personal code</label>
            <input type="number" name="id" id="id">
        </form>
    </div>
</body>