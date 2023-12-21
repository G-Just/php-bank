<?php
require './templates/head.php';
require './templates/navbar.php';
?>


<div id='form-window-wrapper'>
    <div id="form-window" class="credentials">
        <form action="./_includes/signin_h.php" method="POST">
            <h1 style='text-align:center;font-size:3rem;'>Sign In</h1>
            <label for="email">Email</label>
            <input type="text" name="email" id="email">
            <label for="password">Password</label>
            <input type="password" name="password" id="password">
            <button type="submit" name='submit'>Sign in</button>
            <p>Don't have an account? <a href="./signup.php">Sign In</a></p>
        </form>
    </div>
</div>
</body>