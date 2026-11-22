CREATE DATABASE IF NOT EXISTS db_penjualan;
USE db_penjualan;

DROP TABLE IF EXISTS transaksi;
DROP TABLE IF EXISTS pelanggan;
DROP TABLE IF EXISTS barang;
DROP TABLE IF EXISTS supplier;
DROP TABLE IF EXISTS user;

CREATE TABLE user (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(30) NOT NULL UNIQUE,
    password VARCHAR(32) NOT NULL,
    nama VARCHAR(100),
    level TINYINT NOT NULL
);

CREATE TABLE barang (
    id VARCHAR(20) PRIMARY KEY,
    nama VARCHAR(100),
    harga INT,
    stok INT
);

CREATE TABLE supplier (
    id VARCHAR(20) PRIMARY KEY,
    nama VARCHAR(100),
    telp VARCHAR(20),
    alamat TEXT
);

CREATE TABLE pelanggan (
    id VARCHAR(20) PRIMARY KEY,
    nama VARCHAR(100),
    jenis_kelamin ENUM('L','P'),
    telp VARCHAR(20),
    alamat TEXT
);

CREATE TABLE transaksi (
    id INT AUTO_INCREMENT PRIMARY KEY,
    waktu_transaksi DATE,
    keterangan TEXT,
    total INT,
    pelanggan_id VARCHAR(20),
    FOREIGN KEY (pelanggan_id) REFERENCES pelanggan(id)
);

INSERT INTO user (username, password, nama, level) VALUES
('owner', '5be057accb25758101fa5eadbbd79503', 'Budi', 1),
('kasir', 'de28f8f7998f23ab4194b51a6029416f', 'Wati', 2);

INSERT INTO barang VALUES
('B001', 'Beras 5 Kg', 65000, 40),
('B002', 'Minyak Goreng 2 Liter', 38000, 35),
('B003', 'Gula Pasir 1 Kg', 17000, 50),
('B004', 'Telur Ayam 1 Kg', 29000, 30),
('B005', 'Mie Instan', 3500, 200);

INSERT INTO supplier VALUES
('S001', 'PT Sumber Pangan', '031555101', 'Surabaya'),
('S002', 'CV Maju Jaya', '031555202', 'Sidoarjo'),
('S003', 'UD Berkah Tani', '031555303', 'Gresik');

INSERT INTO pelanggan VALUES
('P001', 'Andi Saputra', 'L', '081234567801', 'Surabaya'),
('P002', 'Siti Aminah', 'P', '081234567802', 'Sidoarjo'),
('P003', 'Budi Santoso', 'L', '081234567803', 'Gresik'),
('P004', 'Dewi Lestari', 'P', '081234567804', 'Surabaya'),
('P005', 'Rudi Hartono', 'L', '081234567805', 'Malang'),
('P006', 'Putri Ayu', 'P', '081234567806', 'Surabaya'),
('P007', 'Joko Widodo', 'L', '081234567807', 'Mojokerto'),
('P008', 'Rina Marlina', 'P', '081234567808', 'Sidoarjo'),
('P009', 'Agus Salim', 'L', '081234567809', 'Gresik');

INSERT INTO transaksi (waktu_transaksi, keterangan, total, pelanggan_id) VALUES
('2026-11-01', 'Pembelian barang', 13000, 'P001'),
('2026-11-01', 'Pembelian barang', 13000, 'P002'),
('2026-11-01', 'Pembelian barang', 13000, 'P003'),
('2026-11-02', 'Pembelian barang', 13000, 'P004'),
('2026-11-02', 'Pembelian barang', 13000, 'P005'),
('2026-11-02', 'Pembelian barang', 13000, 'P001'),
('2026-11-02', 'Pembelian barang', 13000, 'P006'),
('2026-11-03', 'Pembelian barang', 13000, 'P007'),
('2026-11-04', 'Pembelian barang', 13000, 'P008'),
('2026-11-05', 'Pembelian barang', 13000, 'P009'),
('2026-11-05', 'Pembelian barang', 13000, 'P002'),
('2026-11-06', 'Pembelian barang', 13000, 'P003'),
('2026-11-07', 'Pembelian barang', 13000, 'P004');
