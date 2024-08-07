<?php
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

// Überprüfen, ob das Formular gesendet wurde
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Benutzereingaben aus dem Formular abrufen
    $username = $_POST['username'];
    $password = $_POST['password'];

    // SQL-Abfrage vorbereiten
    $sql = "SELECT * FROM Users WHERE username='$username' AND password='$password'";

    // SQL-Abfrage ausführen
    $result = $conn->query($sql);

    // Überprüfen, ob ein Ergebnis zurückgegeben wurde
    if ($result->num_rows > 0) {
        // Benutzer erfolgreich authentifiziert
        // Benutzerdaten abrufen
        $row = $result->fetch_assoc();
        $user_id = $row['id']; // Annahme: Die Benutzer-ID ist in der Spalte "id"
        
        // Session starten und Benutzer-ID speichern
        session_start();
        $_SESSION['user_id'] = $user_id;

        // Weiterleitung zur noteoverview.php
        header("Location: noteoverview.php");
        exit(); // Wichtig, um sicherzustellen, dass keine weiteren Inhalte nach der Weiterleitung gesendet werden
    } else {
        // Benutzer nicht gefunden oder falsches Passwort
        $error_message = "Invalid username or password!";
        // Fehlermeldung als JavaScript-Code ausgeben
        echo "<script>alert('$error_message'); window.location.href = 'login.html';</script>";
    }
}

// Verbindung zur Datenbank schließen
$conn->close();
?>