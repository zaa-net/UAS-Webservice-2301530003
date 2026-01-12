<?php
// api/members.php - EDISI POIN SULTAN
include_once '../koneksi.php';
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: GET, POST, DELETE");

$method = $_SERVER['REQUEST_METHOD'];

// === GET: AMBIL DATA MEMBER + HITUNG POIN ===
if ($method == 'GET') {
    // Query sakti: Gabungin tabel members sama payments lewat rentals
    // COALESCE(SUM(...), 0) artinya kalo belom pernah main, poinnya 0
    $sql = "SELECT m.*, 
            FLOOR(COALESCE(SUM(p.total_paid), 0) / 10000) as total_points 
            FROM members m
            LEFT JOIN rentals r ON m.id = r.member_id
            LEFT JOIN payments p ON r.id = p.rental_id
            GROUP BY m.id
            ORDER BY m.id DESC";
            
    $stmt = $koneksi->query($sql);
    $members = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Cek Expired Realtime
    $today = date('Y-m-d');
    foreach ($members as &$m) {
        if ($m['expiry_date'] && $m['expiry_date'] < $today) {
            $m['status'] = 'EXPIRED';
        } else {
            $m['status'] = 'ACTIVE';
        }
    }
    
    echo json_encode(["data" => $members]);
} 

// === POST: DAFTAR MEMBER BARU ===
elseif ($method == 'POST') {
    $data = json_decode(file_get_contents("php://input"));
    
    if(empty($data->name) || empty($data->phone)) {
        echo json_encode(["status" => "error", "message" => "Nama & HP wajib diisi!"]); exit;
    }
    
    $duration = !empty($data->duration) ? (int)$data->duration : 1;
    $join_date = date('Y-m-d');
    $expiry_date = date('Y-m-d', strtotime("+$duration months", strtotime($join_date)));
    
    try {
        $stmt = $koneksi->prepare("INSERT INTO members (name, phone, address, join_date, expiry_date) VALUES (:n, :p, :a, :j, :e)");
        $stmt->execute([
            ':n' => $data->name, 
            ':p' => $data->phone, 
            ':a' => $data->address ?? '-',
            ':j' => $join_date,
            ':e' => $expiry_date
        ]);
        echo json_encode(["status" => "success", "message" => "Member aktif sampai $expiry_date"]);
    } catch(Exception $e) {
        echo json_encode(["status" => "error", "message" => "Gagal: " . $e->getMessage()]);
    }
}

// === DELETE: HAPUS MEMBER ===
elseif ($method == 'DELETE') {
    $data = json_decode(file_get_contents("php://input"));
    if(empty($data->id)) { echo json_encode(["status" => "error", "message" => "ID Kosong"]); exit; }
    
    $stmt = $koneksi->prepare("DELETE FROM members WHERE id = :id");
    if($stmt->execute([':id' => $data->id])) {
        echo json_encode(["status" => "success", "message" => "Member dihapus."]);
    } else {
        echo json_encode(["status" => "error", "message" => "Gagal hapus."]);
    }
}
?>