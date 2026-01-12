<?php
// struk.php - EDISI GACOR KANG
include 'koneksi.php';

$id = $_GET['id'] ?? 0;

// Ambil Data Lengkap (Termasuk Tipe Unit & Nama Member)
$query = "SELECT rentals.*, units.unit_name, unit_types.type_name, payments.*, 
          COALESCE(members.name, 'Guest') as member_name,
          members.id as member_id
          FROM rentals 
          JOIN units ON rentals.unit_id = units.id
          JOIN unit_types ON units.type_id = unit_types.id
          LEFT JOIN payments ON rentals.id = payments.rental_id
          LEFT JOIN members ON rentals.member_id = members.id
          WHERE rentals.id = :id";

$stmt = $koneksi->prepare($query);
$stmt->execute([':id' => $id]);
$data = $stmt->fetch(PDO::FETCH_ASSOC);

if(!$data) die("Data hilang ditelan bumi!");

// Hitung Poin (Logic: Rp 10.000 = 1 Poin)
$points_earned = 0;
if($data['member_name'] !== 'Guest') {
    $points_earned = floor($data['total_paid'] / 10000);
}

// Data Snack
$s_query = "SELECT snacks.snack_name, snack_orders.qty, snack_orders.subtotal 
            FROM snack_orders JOIN snacks ON snack_orders.snack_id = snacks.id 
            WHERE rental_id = ?";
$s_stmt = $koneksi->prepare($s_query);
$s_stmt->execute([$id]);
$snacks = $s_stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Struk #<?= $id ?></title>
    <style>
        body { font-family: 'Courier New', monospace; font-size: 12px; max-width: 300px; margin: 0 auto; padding: 10px; background: #fff; color: #000; }
        .center { text-align: center; }
        .left { text-align: left; }
        .right { text-align: right; }
        .line { border-bottom: 1px dashed #000; margin: 8px 0; }
        .flex { display: flex; justify-content: space-between; }
        .bold { font-weight: bold; }
        h3 { margin: 5px 0; }
        @media print { .no-print { display: none; } }
    </style>
</head>
<body onload="window.print()">
    <div class="center">
        <h3>RENTAL PS GACOR KANG</h3>
        <small>Jl. Pro Player No. 1, Server</small><br>
        <small>WA: 0812-3456-7890</small>
    </div>
    
    <div class="line"></div>
    
    <div class="flex">
        <span><?= date('d/m/y H:i', strtotime($data['end_time'])) ?></span>
        <span>ID: #<?= $id ?></span>
    </div>
    <div class="flex">
        <span>Kasir: Admin</span>
        <span>Unit: <?= $data['unit_name'] ?></span>
    </div>
    <div class="left">
        <span>Type: <?= $data['type_name'] ?></span>
    </div>
    <div class="flex bold" style="margin-top:5px">
        <span>Member:</span>
        <span><?= strtoupper($data['member_name']) ?></span>
    </div>

    <div class="line"></div>
    
    <?php 
        $start = new DateTime($data['start_time']);
        $end = new DateTime($data['end_time']);
        $diff = $start->diff($end);
    ?>
    <div class="bold">SEWA CONSOLE</div>
    <div class="flex">
        <span>Durasi: <?= $diff->h ?> Jam <?= $diff->i ?> Menit</span>
        <span><?= number_format($data['amount_rental']) ?></span>
    </div>

    <?php if(count($snacks) > 0): ?>
        <div class="bold" style="margin-top:5px">F&B ORDER</div>
        <?php foreach($snacks as $s): ?>
            <div class="flex">
                <span><?= $s['qty'] ?>x <?= $s['snack_name'] ?></span>
                <span><?= number_format($s['subtotal']) ?></span>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>

    <div class="line"></div>
    
    <div class="flex bold" style="font-size:14px; margin: 10px 0;">
        <span>TOTAL BAYAR</span>
        <span>Rp <?= number_format($data['total_paid']) ?></span>
    </div>

    <?php if($points_earned > 0): ?>
    <div class="center" style="border: 1px solid #000; padding: 5px; margin-bottom: 10px;">
        <small>Selamat! Anda dapat poin:</small><br>
        <strong style="font-size:14px">+<?= $points_earned ?> POIN</strong>
    </div>
    <?php endif; ?>
    
    <div class="center">
        <small>*** TERIMA KASIH ***</small><br>
        <small>Barang hilang/rusak tanggung jawab penyewa</small><br>
        <small><i>#GacorKang</i></small>
    </div>

    <button class="no-print" onclick="window.print()" style="width:100%; margin-top:20px; padding:10px; cursor:pointer; font-weight:bold;">CETAK LAGI</button>
</body>
</html>