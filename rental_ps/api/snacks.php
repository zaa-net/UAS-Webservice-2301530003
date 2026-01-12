<?php
// api/snacks.php - Logic Pesen Makan/Minum

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET, POST");

include_once '../koneksi.php';

$method = $_SERVER['REQUEST_METHOD'];

// === GET: LIHAT MENU MAKANAN ===
if ($method == 'GET') {
    $stmt = $koneksi->query("SELECT * FROM snacks");
    $menu = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode(["status" => "success", "data" => $menu]);
}

// === POST: PESEN MAKAN (ORDER) ===
elseif ($method == 'POST') {
    $data = json_decode(file_get_contents("php://input"));

    // Butuh: rental_id (siapa yg pesen), snack_id (apa yg dipesen), qty (berapa banyak)
    if (empty($data->rental_id) || empty($data->snack_id)) {
        echo json_encode(["status" => "error", "message" => "Data order ga lengkap!"]);
        exit;
    }
    
    $qty = !empty($data->qty) ? $data->qty : 1;

    try {
        $koneksi->beginTransaction();

        // 1. Cek Harga & Stok Snack
        $cek = $koneksi->prepare("SELECT price, stock FROM snacks WHERE id = :sid");
        $cek->bindParam(':sid', $data->snack_id);
        $cek->execute();
        $snack = $cek->fetch(PDO::FETCH_ASSOC);

        if (!$snack || $snack['stock'] < $qty) {
            echo json_encode(["status" => "error", "message" => "Stok habis atau menu ga ada!"]);
            $koneksi->rollBack();
            exit;
        }

        // 2. Hitung Subtotal (Harga x Qty)
        $subtotal = $snack['price'] * $qty;

        // 3. Masukin ke Snack Orders
        $sql_order = "INSERT INTO snack_orders (rental_id, snack_id, qty, subtotal) 
                      VALUES (:rid, :sid, :qty, :sub)";
        $stmt = $koneksi->prepare($sql_order);
        $stmt->bindParam(':rid', $data->rental_id);
        $stmt->bindParam(':sid', $data->snack_id);
        $stmt->bindParam(':qty', $qty);
        $stmt->bindParam(':sub', $subtotal);
        $stmt->execute();

        // 4. Kurangin Stok Gudang
        $sql_stok = "UPDATE snacks SET stock = stock - :qty WHERE id = :sid";
        $up_stok = $koneksi->prepare($sql_stok);
        $up_stok->bindParam(':qty', $qty);
        $up_stok->bindParam(':sid', $data->snack_id);
        $up_stok->execute();

        $koneksi->commit();
        echo json_encode(["status" => "success", "message" => "Nyam! Pesanan berhasil dicatat."]);

    } catch (Exception $e) {
        $koneksi->rollBack();
        echo json_encode(["status" => "error", "message" => "Gagal order: " . $e->getMessage()]);
    }
}
?>