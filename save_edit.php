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

// Check if the note ID is provided as a POST parameter
if (!isset($_POST['id'])) {
    // Redirect the user to the noteoverview page if no ID is provided
    header("Location: noteoverview.php");
    exit();
}

// Get the note ID from the POST parameter
$note_id = $_POST['id'];

// Check if the delete button was clicked
if (isset($_POST['delete'])) {
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

    // SQL-Abfrage vorbereiten, um den Notizdatensatz zu löschen
    $sql = "DELETE FROM Notes WHERE id='$note_id'";

    // SQL-Abfrage ausführen
    if ($conn->query($sql) === TRUE) {
        // Redirect the user to the noteoverview page after successful deletion
        header("Location: noteoverview.php");
        exit();
    } else {
        echo "Error deleting record: " . $conn->error;
    }

    // Verbindung zur Datenbank schließen
    $conn->close();
} else {
    // Update the note if the save button was clicked

    // Check if the title and note content are provided
    if (isset($_POST['title']) && isset($_POST['note'])) {
        // Get the title and note content from the POST parameters
        $title = $_POST['title'];
        $note_content = $_POST['note'];

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

        // SQL-Abfrage vorbereiten, um den Notizdatensatz zu aktualisieren
        $sql = "UPDATE Notes SET title='$title', content='$note_content' WHERE id='$note_id'";

        // SQL-Abfrage ausführen
        if ($conn->query($sql) === TRUE) {
            // Redirect the user to the noteoverview page after successful update
            header("Location: noteoverview.php");
            exit();
        } else {
            echo "Error updating record: " . $conn->error;
        }

        // Verbindung zur Datenbank schließen
        $conn->close();
    } else {
        // Redirect the user back to the edit page if title or note content is not provided
        header("Location: edit.php?id=$note_id");
        exit();
    }
}
?>
