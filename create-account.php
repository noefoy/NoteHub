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
    $confirm_password = $_POST['confirm_password'];

    // Überprüfen, ob das Passwort und die Bestätigung übereinstimmen
    if ($password !== $confirm_password) {
        // Wenn Passwörter nicht übereinstimmen, Fehlermeldung anzeigen
        echo "<p style='color: red; font-weight: bold;'>Password and confirmation password do not match</p>";
    } else {
        // Überprüfen, ob der Benutzername bereits existiert
        $check_username_sql = "SELECT * FROM Users WHERE username='$username'";
        $result = $conn->query($check_username_sql);
        if ($result->num_rows > 0) {
            // Wenn Benutzername bereits existiert, Fehlermeldung anzeigen
            echo "<p style='color: red; font-weight: bold;'>Username already exists. Please choose a different one.</p>";
        } else {
            // SQL-Abfrage vorbereiten
            $sql = "INSERT INTO Users (username, password) VALUES ('$username', '$password')";

            // SQL-Abfrage ausführen
            if ($conn->query($sql) === TRUE) {
                // Account erfolgreich erstellt
                // Weiterleitung zur Login-Seite mit Erfolgsmeldung
                header("Location: login.html?success=1");
                exit(); // Beenden der Skriptausführung nach Weiterleitung
            } else {
                // Fehler beim Erstellen des Accounts
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    }
}

// Verbindung zur Datenbank schließen
$conn->close();
?>