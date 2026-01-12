<?php
// koneksi.php - GLOBAL TIMEZONE SETTING (UTC/SAO TOME)

// 1. Paksa PHP pake jam UTC (Biar gak ikut jam laptop/WIB)
date_default_timezone_set('UTC');

$host = "localhost";
$user = "root";
$pass = "";
$db   = "db_rental_ps";

try {
    $koneksi = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    $koneksi->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // 2. Paksa MySQL Database juga pake UTC
    $koneksi->exec("SET time_zone = '+00:00'");
    
} catch(PDOException $e) {
    header('Content-Type: application/json');
    echo json_encode(["status" => "error", "message" => "DB Error: " . $e->getMessage()]);
    exit;
}
?>