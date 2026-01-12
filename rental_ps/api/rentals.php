<?php
// api/rentals.php - Support Member Linking
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
date_default_timezone_set('UTC'); // Ikut settingan global

include_once '../koneksi.php';

$method = $_SERVER['REQUEST_METHOD'];

if ($method == 'POST') {
    $data = json_decode(file_get_contents("php://input"));

    if (empty($data->unit_id)) {
        echo json_encode(["status" => "error", "message" => "Pilih unit dulu!"]); exit;
    }

    try {
        $koneksi->beginTransaction();

        // Cek Unit
        $cek = $koneksi->prepare("SELECT status FROM units WHERE id = :uid FOR UPDATE");
        $cek->execute([':uid' => $data->unit_id]);
        $unit = $cek->fetch(PDO::FETCH_ASSOC);

        if (!$unit || $unit['status'] != 'available') {
            $koneksi->rollBack();
            echo json_encode(["status" => "error", "message" => "Unit lagi dipake!"]); exit;
        }

        // INSERT RENTAL (DENGAN MEMBER ID)
        $sql_rental = "INSERT INTO rentals (unit_id, member_id, start_time, status) VALUES (:uid, :mid, NOW(), 'active')";
        $stmt = $koneksi->prepare($sql_rental);
        
        // Cek apakah ada member_id yang dikirim
        $member_id = !empty($data->member_id) ? $data->member_id : NULL;

        $stmt->execute([
            ':uid' => $data->unit_id,
            ':mid' => $member_id
        ]);

        // Update Status Unit
        $koneksi->prepare("UPDATE units SET status = 'occupied' WHERE id = ?")->execute([$data->unit_id]);

        $koneksi->commit();
        echo json_encode(["status" => "success", "message" => "Billing Jalan!"]);

    } catch (Exception $e) {
        $koneksi->rollBack();
        echo json_encode(["status" => "error", "message" => $e->getMessage()]);
    }
}
elseif ($method == 'GET') {
    // Ambil data buat monitoring (Join Member Name)
    $query = "SELECT rentals.id, units.unit_name, rentals.start_time, rentals.status, 
              COALESCE(members.name, 'Guest') as player_name 
              FROM rentals 
              JOIN units ON rentals.unit_id = units.id 
              LEFT JOIN members ON rentals.member_id = members.id
              WHERE rentals.status = 'active'";
    
    $stmt = $koneksi->query($query);
    echo json_encode(["status" => "success", "data" => $stmt->fetchAll(PDO::FETCH_ASSOC)]);
}
?>