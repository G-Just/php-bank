<?php
require './templates/head.php';
require './templates/navbar.php';
?>


<div id='form-window-wrapper'>
    <div id="form-window" class="credentials">
        <form action="./_includes/signup_h.php" method="POST">
            <h1 style='text-align:center;font-size:3rem;'>Sign Up</h1>
            <label for="username">Username <span>*used for display only</span></label>
            <input type="text" name="username" id="username">
            <label for="email">Email <span>*used to sign in</span></label>
            <input type="text" name="email" id="email">
            <label for="password">Password</label>
            <input type="password" name="password" id="password">
            <label for="password_confirm">Confirm password</label>
            <input type="password" name="password_confirm" id="password_confirm">
            <button type="submit" name='submit'>Sign Up</button>
            <p>Already have an account? <a href="./signin.php">Sign In</a></p>
        </form>
    </div>
</div>
</body>