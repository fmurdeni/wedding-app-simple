<?php
session_start();
require 'config.php';

// Pastikan user sudah login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Ambil detail permintaan
$permintaan_id = $_GET['id'] ?? null;
$query = "SELECT pl.*, l.nama_layanan, v.nama_vendor, c.nama as nama_client 
          FROM permintaan_layanan pl
          JOIN layanan l ON pl.layanan_id = l.id
          JOIN vendors v ON l.vendor_id = v.id
          JOIN clients c ON pl.client_id = c.id
          WHERE pl.id = $permintaan_id";
$result = $conn->query($query);
$permintaan = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Konfirmasi Permintaan Layanan</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        @media print {
            .no-print { display: none; }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Konfirmasi Permintaan Layanan</h2>
        </div>
        
        <div class="description">
            <p><strong>Nomor Permintaan:</strong> <?php echo $permintaan_id; ?></p>
            <p><strong>Nama Client:</strong> <?php echo $permintaan['nama_client']; ?></p>
            <p><strong>Layanan:</strong> <?php echo $permintaan['nama_layanan']; ?></p>
            <p><strong>Vendor:</strong> <?php echo $permintaan['nama_vendor']; ?></p>
            <p><strong>Tanggal Acara:</strong> <?php echo $permintaan['tanggal_acara']; ?></p>
            <p><strong>Metode Pembayaran:</strong> <?php echo $permintaan['metode_pembayaran']; ?></p>
            <p><strong>Total Harga:</strong> Rp. <?php echo number_format($permintaan['total_harga'], 0, ',', '.'); ?></p>
            <p><strong>Status:</strong> <?php echo $permintaan['status']; ?></p>
        </div>

        <div class="menu no-print">
            <button onclick="window.print()" class="button">Cetak Konfirmasi</button>
            <a href="dashboard.php" class="button">Kembali ke Dashboard</a>
        </div>
    </div>
</body>
</html>
