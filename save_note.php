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

// Get the user ID from the session
$user_id = $_SESSION['user_id'];

// Check if the title and note content are provided
if (isset($_POST['title']) && isset($_POST['recognized-text'])) {
    // Get the title and note content from the POST parameters
    $title = $_POST['title'];
    $note_content = $_POST['recognized-text'];

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

    // SQL-Abfrage vorbereiten, um einen neuen Notizdatensatz einzufügen
    $sql = "INSERT INTO Notes (user_id, title, content) VALUES ('$user_id', '$title', '$note_content')";

    // SQL-Abfrage ausführen
    if ($conn->query($sql) === TRUE) {
        // Redirect the user to the noteoverview page after successful creation
        header("Location: noteoverview.php");
        exit();
    } else {
        echo "Error inserting record: " . $conn->error;
    }

    // Verbindung zur Datenbank schließen
    $conn->close();
} else {
    // Redirect the user back to the create note page if title or note content is not provided
    header("Location: create_note.php");
    exit();
}
?>
