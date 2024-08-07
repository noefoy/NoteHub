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

// Check if the note ID is provided as a URL parameter
if (!isset($_GET['id'])) {
    // Redirect the user to the noteoverview page if no ID is provided
    header("Location: noteoverview.php");
    exit();
}

// Get the note ID from the URL parameter
$note_id = $_GET['id'];

// Verbindung zur Datenbank herstellen
$servername = "localhost"; // Standardmäßig ist der Servername localhost
$username = "root"; // Standardmäßig ist der Benutzername root
$password = ""; // Standardmäßig ist das Passwort leer
$dbname = "notehub"; // Der Name deiner Datenbank

// Verbindung herstellen
$conn = new mysqli($servername, $username, $password, $dbname);

// Überprüfen, ob die Verbindung erfolgreich war
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL-Abfrage vorbereiten, um den ausgewählten Notizdatensatz abzurufen
$sql = "SELECT * FROM Notes WHERE id='$note_id'";

// SQL-Abfrage ausführen
$result = $conn->query($sql);

// Überprüfen, ob ein Ergebnis zurückgegeben wurde
if ($result->num_rows > 0) {
    // Notizdatensatz abrufen
    $row = $result->fetch_assoc();
    $title = $row["title"];
    $content = $row["content"];
} else {
    // Redirect the user to the noteoverview page if no note is found with the provided ID
    header("Location: noteoverview.php");
    exit();
}

// Verbindung zur Datenbank schließen
$conn->close();
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Vincent Witzmann">
    <meta name="keywords" content="NoteHub">
    <link rel="stylesheet" href="styles.css">
    <title>Edit Note - NoteHub</title>
    <link rel="icon" type="image/png" href="./notehub_logo.png">
</head>
<body>

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

<section class="create-note">
    <div class="create-note-container">
        <h1 class="create-note-heading">Edit Note</h1>
        <form action="save_edit.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $note_id; ?>">
            <label for="title" class="enter-note-title">Enter note title:</label>
            <input type="text" id="title" name="title" required value="<?php echo $title; ?>" style="width: 30%;">
            <br>
            <label for="note" class="enter-your-note">Enter your note:</label>
            <textarea id="note" name="note" rows="4" cols="50" required style="border-radius: 15px;"><?php echo $content; ?></textarea>
            <br>
            <input type="submit" name="save" value="Save Changes">
            <!-- Delete button -->
            <input type="submit" name="delete" value="Delete Note" onclick="return confirm('Are you sure you want to delete this note?')">
        </form>
    </div>
</section>

<footer class="noteoverview-footer">
    <p class="footercontent">&copy; 2024 NoteHub. All rights reserved. <a href="impressum.php" class="footercontent">Impressum</a></p>
</footer>

</body>
</html>
