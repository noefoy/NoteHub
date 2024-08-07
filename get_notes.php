<?php
// Start the session to access session variables
// This check ensures that session_start() is not called if a session is already active
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    die("You are not logged in.");
}

// Get the user ID from the session variable
$user_id = $_SESSION['user_id'];

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

// SQL-Abfrage vorbereiten
$sql = "SELECT * FROM Notes WHERE user_id='$user_id'"; // user_id ist die ID des angemeldeten Benutzers

// SQL-Abfrage ausführen
$result = $conn->query($sql);

// Initialisiere das Array für Notizen
$notes = [];

// Überprüfen, ob ein Ergebnis zurückgegeben wurde
if ($result->num_rows > 0) {
    // Ergebnis ausgeben
    while($row = $result->fetch_assoc()) {
        // Füge den Datensatz zum Notizen-Array hinzu
        $notes[] = $row;
    }
}

// Verbindung zur Datenbank schließen
$conn->close();

// Rückgabe der Notizen
return $notes;
?>
