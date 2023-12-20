<?php
session_start();
?>
<div id='navbar'>
    <div>
        <p>United <span><img src="./assets/phplogo.png" alt="php logo"></span> bank</p>
        <a href='./'>Accounts</a>
        <a href='./new.php'>Create a new account</a>
    </div>

    <div>
        <?php
        if (isset($_SESSION['id'])) {
            echo "<h2>Signed in as : " . $_SESSION['username'] . "</h2>
            <a href='./_includes/signout_h.php'>Sign out</a>";
        } else {
            echo "<a href='./signup.php'>Sign up</a>
            <a href='./signin.php'>Sign in</a>";
        }
        ?>
        <form action="./_includes/theme_h.php" method="POST">
            <input type='image' id='theme' src=<?php
                                                if (isset($_COOKIE['theme']) && $_COOKIE['theme'] === 'dark') {
                                                    echo './assets/moon.svg';
                                                } else {
                                                    echo './assets/sun.svg';
                                                } ?> alt="theme change" />
        </form>
    </div>
</div>