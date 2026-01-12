<?php
// api/units.php

// 1. Header wajib buat API (biar bisa diakses dari mana aja)
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET, POST");

// 2. Panggil koneksi database (mundur satu folder ke belakang)
include_once '../koneksi.php';

// 3. Cek user mau ngapain? (GET atau POST)
$method = $_SERVER['REQUEST_METHOD'];

// === LOGIC GET (AMBIL DATA) ===
if ($method == 'GET') {
    // Query pake JOIN biar kita dapet nama tipe unit & harganya, bukan cuma ID doang
    $query = "SELECT units.id, units.unit_name, units.status, 
                     unit_types.type_name, unit_types.hourly_rate 
              FROM units 
              JOIN unit_types ON units.type_id = unit_types.id";
    
    $stmt = $koneksi->prepare($query);
    $stmt->execute();
    $units = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Kirim balikan JSON
    echo json_encode([
        "status" => "success",
        "total_data" => count($units),
        "data" => $units
    ]);
}

// === LOGIC POST (TAMBAH DATA BARU) ===
elseif ($method == 'POST') {
    // Baca data JSON yang dikirim user
    $data = json_decode(file_get_contents("php://input"));

    // Validasi dikit: Pastikan data gak kosong
    if (!empty($data->unit_name) && !empty($data->type_id)) {
        
        $query = "INSERT INTO units (unit_name, type_id, status) VALUES (:name, :type, 'available')";
        $stmt = $koneksi->prepare($query);

        // Binding data biar aman dari hack SQL Injection
        $stmt->bindParam(':name', $data->unit_name);
        $stmt->bindParam(':type', $data->type_id);

        if ($stmt->execute()) {
            echo json_encode(["status" => "success", "message" => "Unit berhasil ditambah!"]);
        } else {
            echo json_encode(["status" => "error", "message" => "Gagal nambah unit."]);
        }
    } else {
        echo json_encode(["status" => "error", "message" => "Data tidak lengkap!"]);
    }
}
?>