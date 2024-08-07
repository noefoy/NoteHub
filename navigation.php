<?php
// Start the session to access session variables
session_start();
?>

<div class="topnav">
    <nav>
        <img class="notehub_logo" src="./notehub_logo.png" alt="Logo">
        <div class="menu-icon fix">&#9776;</div>
        <ul class="nav-links">
            <li><a href="index.php">Home</a></li>
            <li><a href="help.php">Help</a></li>
            <?php
                // Check if the user is logged in
                if (isset($_SESSION['user_id'])) {
                    // If logged in, show logout link
                    echo '<li><a href="logout.php">Logout</a></li>';
                } else {
                    // If not logged in, show login link
                    echo '<li><a href="login.html">Login</a></li>';
                }
            ?>
        </ul>
    </nav>
</div>
