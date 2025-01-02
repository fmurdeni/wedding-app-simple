<?php
session_start();
require 'config.php';

// Pastikan user sudah login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Ambil data vendor
$vendor_query = "SELECT * FROM vendors";
$vendor_result = $conn->query($vendor_query);

// Ambil data layanan
$layanan_query = "SELECT layanan.*, vendors.nama_vendor 
                  FROM layanan 
                  JOIN vendors ON layanan.vendor_id = vendors.id";
$layanan_result = $conn->query($layanan_query);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - Wedding Organizer</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Selamat Datang, <?php echo $_SESSION['user_name']; ?></h2>
        </div>
        
        <div class="description">
            <h3>Daftar Vendor</h3>
            <table>
                <tr>
                    <th>Nama Vendor</th>
                    <th>Kontak</th>
                    <th>Deskripsi</th>
                </tr>
                <?php while($vendor = $vendor_result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $vendor['nama_vendor']; ?></td>
                    <td><?php echo $vendor['kontak']; ?></td>
                    <td><?php echo $vendor['deskripsi']; ?></td>
                </tr>
                <?php endwhile; ?>
            </table>

            <h3>Daftar Layanan</h3>
            <table>
                <tr>
                    <th>Nama Layanan</th>
                    <th>Vendor</th>
                    <th>Deskripsi</th>
                    <th>Harga</th>
                    <th>Aksi</th>
                </tr>
                <?php while($layanan = $layanan_result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $layanan['nama_layanan']; ?></td>
                    <td><?php echo $layanan['nama_vendor']; ?></td>
                    <td><?php echo $layanan['deskripsi']; ?></td>
                    <td>Rp. <?php echo number_format($layanan['harga'], 0, ',', '.'); ?></td>
                    <td><a href="buat_permintaan.php?layanan_id=<?php echo $layanan['id']; ?>" class="button">Pilih</a></td>
                </tr>
                <?php endwhile; ?>
            </table>
        </div>

        <div class="menu">
            <a href="logout.php" class="button">Logout</a>
        </div>
    </div>
</body>
</html>
