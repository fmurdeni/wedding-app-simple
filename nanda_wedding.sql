-- Database untuk Aplikasi Wedding Organizer

CREATE DATABASE IF NOT EXISTS nanda_wedding;
USE nanda_wedding;

-- Tabel Client
CREATE TABLE clients (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(100) NOT NULL,
    telepon VARCHAR(20),
    alamat TEXT
);

-- Tabel Vendor
CREATE TABLE vendors (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama_vendor VARCHAR(100) NOT NULL,
    kontak VARCHAR(20),
    deskripsi TEXT
);

-- Tabel Layanan
CREATE TABLE layanan (
    id INT AUTO_INCREMENT PRIMARY KEY,
    vendor_id INT,
    nama_layanan VARCHAR(100) NOT NULL,
    deskripsi TEXT,
    harga DECIMAL(10,2),
    FOREIGN KEY (vendor_id) REFERENCES vendors(id)
);

-- Tabel Permintaan Layanan
CREATE TABLE permintaan_layanan (
    id INT AUTO_INCREMENT PRIMARY KEY,
    client_id INT,
    layanan_id INT,
    tanggal_acara DATE,
    metode_pembayaran VARCHAR(50),
    status ENUM('Menunggu', 'Diproses', 'Selesai') DEFAULT 'Menunggu',
    total_harga DECIMAL(10,2),
    FOREIGN KEY (client_id) REFERENCES clients(id),
    FOREIGN KEY (layanan_id) REFERENCES layanan(id)
);

-- Insert data contoh
INSERT INTO clients (nama, email, password, telepon) VALUES 
('Meyrina Putri', 'meyrina@gmail.com', 'password123', '08123456789');

INSERT INTO vendors (nama_vendor, kontak, deskripsi) VALUES 
('Vendor Foto', '08111222333', 'Layanan fotografi profesional'),
('Vendor Catering', '08444555666', 'Layanan katering pernikahan');

INSERT INTO layanan (vendor_id, nama_layanan, deskripsi, harga) VALUES 
(1, 'Paket Foto Standar', 'Foto pernikahan 1 hari', 5000000),
(1, 'Paket Foto Premium', 'Foto pernikahan 2 hari', 8000000),
(2, 'Paket Catering Standar', 'Makanan untuk 100 orang', 10000000),
(2, 'Paket Catering Mewah', 'Makanan untuk 200 orang', 15000000);
