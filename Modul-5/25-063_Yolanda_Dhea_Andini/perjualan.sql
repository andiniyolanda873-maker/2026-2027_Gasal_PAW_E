DROP DATABASE IF EXISTS perjualan;
CREATE DATABASE IF NOT EXISTS perjualan;
USE perjualan;

CREATE TABLE pelanggan (
  id int(11) NOT NULL AUTO_INCREMENT,
  nama varchar(100),
  jenis_kelamin enum('L','P'),
  telp varchar(12),
  alamat text,
  PRIMARY KEY (id)
);

CREATE TABLE supplier (
  id int(11) NOT NULL AUTO_INCREMENT,
  nama varchar(100),
  telp varchar(12),
  alamat text,
  PRIMARY KEY (id)
);

CREATE TABLE barang (
  id int(11) NOT NULL AUTO_INCREMENT,
  kode_barang varchar(10),
  nama_barang varchar(100),
  harga int(11),
  stok int(11),
  supplier_id int(11),
  PRIMARY KEY (id),
  FOREIGN KEY (supplier_id) REFERENCES supplier(id) ON DELETE SET NULL
);

CREATE TABLE transaksi (
  id int(11) NOT NULL AUTO_INCREMENT,
  waktu_transaksi date,
  keterangan text,
  total int(11),
  pelanggan_id int(11),
  PRIMARY KEY (id),
  FOREIGN KEY (pelanggan_id) REFERENCES pelanggan(id)
);

CREATE TABLE transaksi_detail (
  transaksi_id int(11) NOT NULL,
  barang_id int(11) NOT NULL,
  harga int(11),
  qty int(11),
  PRIMARY KEY (transaksi_id, barang_id),
  FOREIGN KEY (transaksi_id) REFERENCES transaksi(id),
  FOREIGN KEY (barang_id) REFERENCES barang(id)
);

CREATE TABLE pembayaran (
  id int(11) NOT NULL AUTO_INCREMENT,
  waktu_bayar datetime,
  total int(11),
  metode enum('TUNAI','TRANSFER','EDC'),
  transaksi_id int(11),
  PRIMARY KEY (id),
  FOREIGN KEY (transaksi_id) REFERENCES transaksi(id)
);

CREATE TABLE user (
  id_user tinyint(11) NOT NULL AUTO_INCREMENT,
  username varchar(30),
  password varchar(35),
  nama varchar(50),
  alamat varchar(150),
  hp varchar(12),
  level tinyint(1),
  PRIMARY KEY (id_user)
);

INSERT INTO pelanggan (nama, jenis_kelamin, telp, alamat) VALUES
('Andi Saputra', 'L', '081234567801', 'Surabaya'),
('Siti Aminah', 'P', '081234567802', 'Bangkalan'),
('Budi Santoso', 'L', '081234567803', 'Sidoarjo'),
('Dewi Lestari', 'P', '081234567804', 'Gresik'),
('Rudi Hartono', 'L', '081234567805', 'Surabaya'),
('Rina Wulandari', 'P', '081234567806', 'Madura'),
('Agus Setiawan', 'L', '081234567807', 'Malang'),
('Nur Hidayah', 'P', '081234567808', 'Bangkalan'),
('Hendra Wijaya', 'L', '081234567809', 'Surabaya'),
('Lilis Suryani', 'P', '081234567810', 'Sampang');

INSERT INTO supplier (nama, telp, alamat) VALUES
('PT. Maju Bersama', '08123456', 'Surabaya'),
('PT. Senang Sekali', '081515563', 'Bangkalan'),
('PT. Segar Segar', '0845454663', 'Surabaya'),
('PT. Sumber Rejeki', '0817771122', 'Sidoarjo'),
('CV. Jaya Abadi', '0818882233', 'Gresik'),
('CV. Mitra Sejahtera', '0819993344', 'Malang'),
('PT. Sentosa Makmur', '0812224455', 'Madura'),
('CV. Berkah Selalu', '0813335566', 'Surabaya'),
('PT. Cahaya Baru', '0814446677', 'Sampang'),
('CV. Harapan Kita', '0815557788', 'Bangkalan');

INSERT INTO barang (kode_barang, nama_barang, harga, stok, supplier_id) VALUES
('BRG001', 'Beras 5kg', 65000, 50, 1),
('BRG002', 'Minyak Goreng 2L', 38000, 40, 1),
('BRG003', 'Gula Pasir 1kg', 16000, 60, 2),
('BRG004', 'Telur 1kg', 28000, 30, 2),
('BRG005', 'Mie Instan', 3500, 200, 3),
('BRG006', 'Sabun Mandi', 4500, 100, 3),
('BRG007', 'Shampoo Sachet', 1000, 150, 4),
('BRG008', 'Kopi Sachet', 2000, 120, 5),
('BRG009', 'Teh Celup', 12000, 45, 6),
('BRG010', 'Susu Kental Manis', 11000, 70, 7);

INSERT INTO transaksi (waktu_transaksi, keterangan, total, pelanggan_id) VALUES
('2026-10-01', 'Pembelian bulanan', 130000, 1),
('2026-10-02', 'Pembelian harian', 38000, 2),
('2026-10-03', 'Pembelian harian', 48000, 3),
('2026-10-04', 'Pembelian harian', 56000, 4),
('2026-10-05', 'Pembelian mie instan', 35000, 5),
('2026-10-06', 'Pembelian harian', 18000, 6),
('2026-10-07', 'Pembelian harian', 5000, 7),
('2026-10-08', 'Pembelian harian', 12000, 8),
('2026-10-09', 'Pembelian harian', 24000, 9),
('2026-10-10', 'Pembelian harian', 33000, 10);

INSERT INTO transaksi_detail (transaksi_id, barang_id, harga, qty) VALUES
(1, 1, 65000, 2),
(2, 2, 38000, 1),
(3, 3, 16000, 3),
(4, 4, 28000, 2),
(5, 5, 3500, 10),
(6, 6, 4500, 4),
(7, 7, 1000, 5),
(8, 8, 2000, 6),
(9, 9, 12000, 2),
(10, 10, 11000, 3);

INSERT INTO pembayaran (waktu_bayar, total, metode, transaksi_id) VALUES
('2026-10-01 10:00:00', 130000, 'TUNAI', 1),
('2026-10-02 11:00:00', 38000, 'TRANSFER', 2),
('2026-10-03 09:30:00', 48000, 'EDC', 3),
('2026-10-04 13:15:00', 56000, 'TUNAI', 4),
('2026-10-05 14:00:00', 35000, 'TRANSFER', 5),
('2026-10-06 15:20:00', 18000, 'EDC', 6),
('2026-10-07 08:45:00', 5000, 'TUNAI', 7),
('2026-10-08 16:10:00', 12000, 'TRANSFER', 8),
('2026-10-09 12:00:00', 24000, 'EDC', 9),
('2026-10-10 17:30:00', 33000, 'TUNAI', 10);

INSERT INTO user (username, password, nama, alamat, hp, level) VALUES
('admin', MD5('admin123'), 'Administrator', 'Surabaya', '081200000001', 1),
('kasir1', MD5('kasir123'), 'Kasir Satu', 'Bangkalan', '081200000002', 2),
('kasir2', MD5('kasir123'), 'Kasir Dua', 'Sidoarjo', '081200000003', 2),
('gudang1', MD5('gudang123'), 'Petugas Gudang', 'Gresik', '081200000004', 3),
('owner', MD5('owner123'), 'Pemilik Toko', 'Surabaya', '081200000005', 1),
('kasir3', MD5('kasir123'), 'Kasir Tiga', 'Malang', '081200000006', 2),
('kasir4', MD5('kasir123'), 'Kasir Empat', 'Madura', '081200000007', 2),
('gudang2', MD5('gudang123'), 'Petugas Gudang Dua', 'Sampang', '081200000008', 3),
('staff1', MD5('staff123'), 'Staff Satu', 'Surabaya', '081200000009', 3),
('staff2', MD5('staff123'), 'Staff Dua', 'Bangkalan', '081200000010', 3);
