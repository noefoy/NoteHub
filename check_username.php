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

// Überprüfen, ob der Benutzername bereits existiert
$username = $_GET['username'];
$check_username_sql = "SELECT * FROM Users WHERE username='$username'";
$result = $conn->query($check_username_sql);
$response = ['exists' => false];
if ($result->num_rows > 0) {
    $response['exists'] = true;
}

header('Content-Type: application/json');
echo json_encode($response);

// Verbindung zur Datenbank schließen
$conn->close();
?>