<?php
include_once '../koneksi.php';
header("Content-Type: application/json");

$method = $_SERVER['REQUEST_METHOD'];

if ($method == 'POST') {
    // Restock (Tambah Stok)
    $data = json_decode(file_get_contents("php://input"));
    
    $stmt = $koneksi->prepare("UPDATE snacks SET stock = stock + :qty WHERE id = :id");
    if($stmt->execute([':qty' => $data->qty, ':id' => $data->id])) {
        echo json_encode(["status" => "success", "message" => "Stok berhasil ditambah!"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Gagal update stok"]);
    }
}
?>