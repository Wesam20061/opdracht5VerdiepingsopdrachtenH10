<<?php
// Databaseverbinding
$servername = "localhost"; // verander naar jouw servernaam indien nodig
$username = "root"; // verander naar jouw gebruikersnaam indien nodig
$password = ""; // verander naar jouw wachtwoord indien nodig
$database = "poll";

// Verbinding maken met de database
try {
    $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    // Zet de PDO error mode in op exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>
