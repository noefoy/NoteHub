<?php
// Check if a session is not already active
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect the user to the login page
    header("Location: login.html");
    exit(); // Make sure to exit after redirecting
}
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Vincent Witzmann">
    <meta name="keywords" content="NoteHub">
    <link rel="stylesheet" href="styles.css">
    <title>Note Overview - NoteHub</title>
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

<section class="notecontent">
    <div class="notecontainer"> 
        <h1 class="noteh1">Your Notes</h1>
         <!-- Button to create a new note -->
    <div class="create-note-button">
        <a href="create_note.php" onclick="clearTextArea() class="create-note-link">Create New Note</a>
    </div>
        
        <!-- Displaying notes with edit links -->
        <div class="notes-each">
        <?php
        include 'get_notes.php';
        if (!empty($notes)) {
            foreach ($notes as $note) {
                echo "<div class='note'>";
                echo "<h2>" . $note["title"] . "</h2>";
                echo "<p>" . $note["content"] . "</p>";
                echo "<a href='edit.php?id=" . $note["id"] . "'>Edit</a>";
                echo "</div>";
            }
        } else {
            echo "<p class='no-notes-message'>No notes found.</p>";
                }
        ?>
        </div>

        
    </div>
    
</section>
<script src="index.js"></script>

<footer class="noteoverview-footer">
    <p class="footercontent">&copy; 2024 NoteHub. All rights reserved. <a href="impressum.php" class="footercontent">Impressum</a></p>
</footer>

</body>
</html>
