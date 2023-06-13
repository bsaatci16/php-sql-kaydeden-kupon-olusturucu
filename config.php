<?php
$dbHost = "localhost";
$dbUser = "root";
$dbPass = "";
$dbName = "steam";

// Veritabanı bağlantısı oluştur
$conn = new mysqli($dbHost, $dbUser, $dbPass, $dbName);

// Bağlantı hatası kontrolü
if ($conn->connect_error) {
    die("Veritabanı bağlantısı başarısız: " . $conn->connect_error);
}
?>
