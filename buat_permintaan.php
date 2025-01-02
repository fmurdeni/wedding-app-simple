<?php
session_start();
require 'config.php';

// Pastikan user sudah login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Ambil detail layanan yang dipilih
$layanan_id = $_GET['layanan_id'] ?? null;
$layanan_query = "SELECT layanan.*, vendors.nama_vendor 
                  FROM layanan 
                  JOIN vendors ON layanan.vendor_id = vendors.id 
                  WHERE layanan.id = $layanan_id";
$layanan_result = $conn->query($layanan_query);
$layanan = $layanan_result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $client_id = $_SESSION['user_id'];
    $layanan_id = $_POST['layanan_id'];
    $tanggal_acara = $_POST['tanggal_acara'];
    $metode_pembayaran = $_POST['metode_pembayaran'];
    $total_harga = $_POST['total_harga'];

    $sql = "INSERT INTO permintaan_layanan (client_id, layanan_id, tanggal_acara, metode_pembayaran, total_harga) 
            VALUES ($client_id, $layanan_id, '$tanggal_acara', '$metode_pembayaran', $total_harga)";
    
    if ($conn->query($sql) === TRUE) {
        $permintaan_id = $conn->insert_id;
        header("Location: konfirmasi_permintaan.php?id=$permintaan_id");
        exit();
    } else {
        $error = "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Buat Permintaan Layanan</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Buat Permintaan Layanan</h2>
        </div>
        <?php if(isset($error)) echo "<p style='color:red; text-align:center;'>$error</p>"; ?>
        <form method="post">
            <input type="hidden" name="layanan_id" value="<?php echo $layanan['id']; ?>">
            <input type="hidden" name="total_harga" value="<?php echo $layanan['harga']; ?>">
            
            <div class="description">
                <p><strong>Layanan Dipilih:</strong> <?php echo $layanan['nama_layanan'] . " - " . $layanan['nama_vendor']; ?></p>
                
                <p><strong>Harga:</strong> Rp. <?php echo number_format($layanan['harga'], 0, ',', '.'); ?></p>
                
                <label>Tanggal Acara:</label>
                <input type="date" name="tanggal_acara" required><br>
                
                <label>Metode Pembayaran:</label>
                <select name="metode_pembayaran" required>
                    <option value="">Pilih Bank</option>
                    <option value="BNI">BNI</option>
                    <option value="BRI">BRI</option>
                    <option value="Mandiri">Mandiri</option>
                </select><br>
                
                <input type="submit" value="Ajukan Permintaan">
            </div>
        </form>
        
        <div class="menu">
            <a href="dashboard.php" class="button">Kembali ke Dashboard</a>
        </div>
    </div>
</body>
</html>
