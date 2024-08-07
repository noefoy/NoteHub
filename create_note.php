<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Vincent Witzmann">
    <meta name="keywords" content="NoteHub">
    <link rel="stylesheet" href="styles.css">
    <title>NoteHub - Create Note</title>
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
                ?>        </ul>
    </nav>
</div>

<section class="create-note">
    <div class="create-note-container">
        <h1 class="create-note-heading">Create a New Note</h1>
        <form action="save_note.php" method="POST">
            <label for="title" class="enter-note-title">Enter note title:</label>
            <input type="text" id="title" name="title" required placeholder="Enter title..." style="width: 30%;">
            <br>
            <label for="note" class="enter-your-note">Enter your note:</label>
            <textarea id="recognized-text" name="recognized-text" rows="4" cols="50" required placeholder=" Bla bla bla..." style="border-radius: 15px;"></textarea>
            <br>
            <input type="submit" value="Save Note">
        </form>
        <br>
        <form action="http://127.0.0.1:5000/run-script" method="post">
            <input type="submit" value="Start Dictation"></button>
        </form>
        <br>
        <form action="http://127.0.0.1:5000/stop-script" method="post">
            <input type="submit" value="Stop Dictation"></button>
        </form>
    </div>

</section>
<script src="index.js"></script>


<footer>
    <p class="footercontent">&copy; 2024 NoteHub. All rights reserved. <a href="impressum.php" class="footercontent">Impressum</a></p>
</footer>
</body>
</html>
