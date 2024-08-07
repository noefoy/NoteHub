<!DOCTYPE html>
<html lang="de"> 
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, inital-scale=1.0">
    <meta name="author" content="Vincent Witzmann">
    <meta name="keywords" content="NoteHub">
    <link rel="stylesheet" href="styles.css">
    <title>NoteHub</title>
    <link rel="icon" type="image/png" href="./notehub_logo.png">
</head>
<body>

    <div class="topnav">
        
        <nav>
            <img class="notehub_logo" src="./notehub_logo.png" alt="Logo">
            <div class="menu-icon fix">&#9776;</div>
            <ul class="nav-links">
            <?php
            session_start();
            // Check if the user is logged in
            if (isset($_SESSION['user_id'])) {
                // If logged in, show button to create a note
                echo '<li><a href="noteoverview.php" class="button">My Notes</a></li>';
            }
        ?>
                <li><a href="index.php">Home</a></li>
                <li><a href="help.php">Help</a></li>
                <?php
                    // Start the session
    
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
    
    




    <section class="content">
    <div class="container">
        <h1>Welcome to NoteHub!</h1>
        <p>NoteHub is your go-to platform for organizing and managing your notes.</p>
        <p>With NoteHub, you can create, edit, and access your notes from anywhere, at any time.</p>
        <p>Get started today and take control of your notes!</p>

        <br><br><br><br><br>
    </div>
</section>




<script src="script.js"></script>

</body> 
<br><br><br><br>
<footer>
    <p class="footercontent">&copy; 2024 NoteHub. All rights reserved. <a href="impressum.php" class="footercontent">Impressum</a></p>
</footer>
</html>
