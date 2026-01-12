<?php
// api/checkout.php - REVISI ANTI BUG 105 RIBU
ob_start();
include_once '../koneksi.php'; // Ini udah bawa settingan UTC dari file di atas

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

try {
    $data = json_decode(file_get_contents("php://input"));
    if (empty($data->rental_id)) throw new Exception("ID Kosong");

    $koneksi->beginTransaction();

    // 1. Ambil Data Rental
    $query = "SELECT rentals.*, unit_types.hourly_rate, units.id as uid 
              FROM rentals 
              JOIN units ON rentals.unit_id = units.id
              JOIN unit_types ON units.type_id = unit_types.id
              WHERE rentals.id = :rid AND rentals.status = 'active'";
    
    $stmt = $koneksi->prepare($query);
    $stmt->execute([':rid' => $data->rental_id]);
    $rental = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$rental) throw new Exception("Rental tidak aktif/tidak ditemukan");

    // 2. LOGIC DURASI (PURE PHP UTC)
    $start = new DateTime($rental['start_time']); // Udah UTC dari DB
    $end   = new DateTime(); // Sekarang (Udah UTC karena settingan koneksi.php)
    
    $diff = $start->diff($end);
    $total_jam = $diff->h + ($diff->days * 24);
    $menit = $diff->i;

    // Logic Pembulatan: Lewat 10 menit denda 1 jam
    if ($menit > 10) $total_jam += 1;
    if ($total_jam < 1) $total_jam = 1; // Minimal bayar 1 jam

    $biaya_sewa = $total_jam * $rental['hourly_rate'];

    // 3. Hitung Snack
    $snack = $koneksi->prepare("SELECT SUM(subtotal) as total FROM snack_orders WHERE rental_id = ?");
    $snack->execute([$data->rental_id]);
    $biaya_snack = $snack->fetchColumn() ?: 0;

    $total_bayar = $biaya_sewa + $biaya_snack;

    // 4. Update & Simpan (Jam End pake format DB)
    $end_string = $end->format('Y-m-d H:i:s');

    $koneksi->prepare("UPDATE rentals SET end_time = ?, status = 'completed' WHERE id = ?")
            ->execute([$end_string, $data->rental_id]);

    $koneksi->prepare("UPDATE units SET status = 'available' WHERE id = ?")
            ->execute([$rental['uid']]);

    $koneksi->prepare("INSERT INTO payments (rental_id, amount_rental, amount_snack, total_paid) VALUES (?, ?, ?, ?)")
            ->execute([$data->rental_id, $biaya_sewa, $biaya_snack, $total_bayar]);

    $koneksi->commit();
    ob_clean();

    echo json_encode([
        "status" => "success",
        "struk" => [
            "total_bayar" => number_format($total_bayar),
            "durasi" => "$total_jam Jam (Real: $diff->h Jam $diff->i Menit)"
        ]
    ]);

} catch (Exception $e) {
    if ($koneksi->inTransaction()) $koneksi->rollBack();
    ob_clean();
    echo json_encode(["status" => "error", "message" => $e->getMessage()]);
}
?>