<?php
include 'assets/incudes/db.php';

// Voeg een admin toe met wachtwoord "admin123"
$hashedPassword = password_hash('admin123', PASSWORD_DEFAULT);
$stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
$stmt->execute(['admin', $hashedPassword]);

echo "Admin account aangemaakt!";
?>