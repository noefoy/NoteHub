<!DOCTYPE html>
<html lang="de"> 
<head>
    <meta charset="utf-8">

    <link rel="stylesheet" href="styles.css">
    <title>NoteHub</title>
    <link rel="icon" type="image/png" href="./notehub_logo.png">
</head>
<body class="faqbody">

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
                    // Check if a session is not already active
                    if (session_status() == PHP_SESSION_NONE) {
                        session_start();
                    }
                    
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

    <div class="faq">
    <h2>Frequently Asked Questions</h2>
    <ol class="faqpage">
        <li class="faq-item">
            <strong class="question">What is NoteHub?</strong>
            <p class="answer">NoteHub is a platform designed to help users organize and manage their notes efficiently.</p>
        </li>
        <li class="faq-item">
            <strong class="question">How can NoteHub assist users with organizing and managing their notes?</strong>
            <p class="answer">NoteHub provides features for creating, editing, and accessing notes seamlessly, allowing users to stay organized and productive.</p>
        </li>
        <li class="faq-item">
            <strong class="question">What features does NoteHub offer for note creation, editing, and access?</strong>
            <p class="answer">NoteHub allows users to create new notes, edit existing ones, and access their notes from any device with internet connectivity.</p>
        </li>
        <li class="faq-item">
            <strong class="question">Why should users choose NoteHub over other note-taking platforms?</strong>
            <p class="answer">NoteHub offers a user-friendly interface, robust features, and reliable performance, making it an ideal choice for note-taking needs.</p>
        </li>
        <li class="faq-item">
            <strong class="question">How can users begin using NoteHub to manage their notes effectively?</strong>
            <p class="answer">Users can sign up for an account on NoteHub and start creating, editing, and organizing their notes immediately.</p>
        </li>
    </ol>
    </div>

</body>
<footer>
    <p class="footercontent">&copy; 2024 NoteHub. All rights reserved. <a href="impressum.php" class="footercontent">Impressum</a></p>
</footer>
</html>