<?php
include_once '../koneksi.php';
header("Content-Type: application/json");

$type = $_GET['type'] ?? 'daily'; // daily, monthly, yearly

if ($type == 'daily') {
    // Laporan Hari Ini
    $sql = "SELECT DATE_FORMAT(payment_time, '%H:00') as jam, SUM(total_paid) as omzet 
            FROM payments WHERE DATE(payment_time) = CURDATE() GROUP BY jam";
    $total_sql = "SELECT SUM(total_paid) as total FROM payments WHERE DATE(payment_time) = CURDATE()";
} elseif ($type == 'monthly') {
    // Laporan Bulan Ini
    $sql = "SELECT DATE_FORMAT(payment_time, '%Y-%m-%d') as tanggal, SUM(total_paid) as omzet 
            FROM payments WHERE MONTH(payment_time) = MONTH(CURDATE()) AND YEAR(payment_time) = YEAR(CURDATE()) GROUP BY tanggal";
    $total_sql = "SELECT SUM(total_paid) as total FROM payments WHERE MONTH(payment_time) = MONTH(CURDATE()) AND YEAR(payment_time) = YEAR(CURDATE())";
}

$chart_data = $koneksi->query($sql)->fetchAll(PDO::FETCH_ASSOC);
$grand_total = $koneksi->query($total_sql)->fetch(PDO::FETCH_ASSOC)['total'] ?? 0;

echo json_encode([
    "chart" => $chart_data,
    "total" => number_format($grand_total, 0, ',', '.')
]);
?>