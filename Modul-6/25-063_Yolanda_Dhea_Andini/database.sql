DROP DATABASE IF EXISTS penjualan;
CREATE DATABASE IF NOT EXISTS penjualan;
USE penjualan;

CREATE TABLE supplier (
  id int AUTO_INCREMENT PRIMARY KEY,
  nama varchar(100) NOT NULL,
  telp varchar(12),
  alamat text
) ENGINE=InnoDB;

CREATE TABLE barang (
  id int AUTO_INCREMENT PRIMARY KEY,
  kode_barang varchar(10) NOT NULL UNIQUE,
  nama_barang varchar(100) NOT NULL,
  harga int NOT NULL,
  stok int NOT NULL,
  supplier_id int NOT NULL,
  FOREIGN KEY (supplier_id) REFERENCES supplier(id)
    ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB;

CREATE TABLE pelanggan (
  id varchar(20) PRIMARY KEY,
  nama varchar(100) NOT NULL,
  jenis_kelamin enum('L','P') NOT NULL,
  telp varchar(12),
  alamat text
) ENGINE=InnoDB;

CREATE TABLE transaksi (
  id int AUTO_INCREMENT PRIMARY KEY,
  waktu_transaksi date NOT NULL,
  keterangan text,
  total int NOT NULL DEFAULT 0,
  pelanggan_id varchar(20) NOT NULL,
  FOREIGN KEY (pelanggan_id) REFERENCES pelanggan(id)
    ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB;

CREATE TABLE transaksi_detail (
  transaksi_id int NOT NULL,
  barang_id int NOT NULL,
  harga int NOT NULL,
  qty int NOT NULL,
  PRIMARY KEY (transaksi_id, barang_id),
  FOREIGN KEY (transaksi_id) REFERENCES transaksi(id)
    ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (barang_id) REFERENCES barang(id)
    ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB;

CREATE TABLE pembayaran (
  id int AUTO_INCREMENT PRIMARY KEY,
  waktu_bayar datetime NOT NULL,
  total int NOT NULL,
  metode enum('TUNAI','TRANSFER','EDC') NOT NULL,
  transaksi_id int NOT NULL,
  FOREIGN KEY (transaksi_id) REFERENCES transaksi(id)
    ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB;

CREATE TABLE user (
  id_user tinyint AUTO_INCREMENT PRIMARY KEY,
  username varchar(30) NOT NULL UNIQUE,
  password varchar(35) NOT NULL,
  nama varchar(50) NOT NULL,
  alamat varchar(150),
  hp varchar(20),
  level tinyint(1) NOT NULL
) ENGINE=InnoDB;

INSERT INTO supplier (nama, telp, alamat) VALUES
('PT Sumber Pangan', '031555101', 'Jl. Rungkut No. 10 Surabaya'),
('CV Manis Jaya', '031555102', 'Jl. Darmo No. 25 Surabaya'),
('UD Sinar Mie', '031555103', 'Jl. Kenjeran No. 7 Surabaya'),
('PT Bersih Sejahtera', '031555104', 'Jl. Gubeng No. 3 Surabaya'),
('CV Maju Bersama', '031555105', 'Jl. Wiyung No. 18 Surabaya');

INSERT INTO barang (kode_barang, nama_barang, harga, stok, supplier_id) VALUES
('BRG001', 'Beras 5kg', 65000, 50, 1),
('BRG002', 'Minyak Goreng 2L', 36000, 40, 1),
('BRG003', 'Gula Pasir 1kg', 17000, 60, 2),
('BRG004', 'Kopi Bubuk 200g', 15000, 35, 2),
('BRG005', 'Mie Instan', 3500, 200, 3),
('BRG006', 'Sabun Mandi', 4500, 80, 4),
('BRG007', 'Deterjen 1kg', 22000, 45, 5),
('BRG008', 'Teh Celup', 8000, 70, 2);

INSERT INTO pelanggan (id, nama, jenis_kelamin, telp, alamat) VALUES
('P001', 'Yolanda Dhea Andini', 'P', '081234500001', 'Jl. Mawar No. 1 Surabaya'),
('P002', 'Aurelia Putri Maharani', 'P', '081234500002', 'Jl. Melati No. 2 Surabaya'),
('P003', 'Rizky Ramadhan', 'L', '081234500003', 'Jl. Kenanga No. 3 Sidoarjo'),
('P004', 'Anindya Kirana', 'P', '081234500004', 'Jl. Anggrek No. 4 Surabaya'),
('P005', 'Bagas Satria Wijaya', 'L', '081234500005', 'Jl. Dahlia No. 5 Gresik');

INSERT INTO user (username, password, nama, alamat, hp, level) VALUES
('admin', MD5('admin123'), 'Yolanda Dhea Andini', 'Surabaya', '081300000001', 1),
('kasir1', MD5('kasir123'), 'Salsabila Nur Aini', 'Surabaya', '081300000002', 2),
('kasir2', MD5('kasir123'), 'Fajar Nugroho', 'Sidoarjo', '081300000003', 2),
('gudang', MD5('gudang123'), 'Dimas Prasetyo', 'Surabaya', '081300000004', 3),
('owner', MD5('owner123'), 'Citra Maheswari', 'Surabaya', '081300000005', 1);

INSERT INTO transaksi (waktu_transaksi, keterangan, total, pelanggan_id) VALUES
('2026-10-01', 'Belanja bulanan', 99000, 'P001'),
('2026-10-02', 'Belanja dapur', 71000, 'P002'),
('2026-10-03', 'Belanja harian', 43500, 'P003'),
('2026-10-05', 'Beli deterjen', 22000, 'P001'),
('2026-10-07', 'Belanja besar', 219000, 'P004'),
('2026-10-09', 'Belanja mingguan', 26500, 'P005'),
('2026-10-12', 'Belanja gula dan kopi', 66000, 'P002'),
('2026-10-15', 'Belanja kebutuhan rumah', 80000, 'P003'),
('2026-10-18', 'Belanja harian', 28500, 'P004'),
('2026-10-20', 'Belanja bulanan', 132000, 'P005');

INSERT INTO transaksi_detail (transaksi_id, barang_id, harga, qty) VALUES
(1, 1, 65000, 1), (1, 3, 17000, 2),
(2, 2, 36000, 1), (2, 5, 3500, 10),
(3, 4, 15000, 2), (3, 6, 4500, 3),
(4, 7, 22000, 1),
(5, 1, 65000, 2), (5, 2, 36000, 2), (5, 3, 17000, 1),
(6, 5, 3500, 5), (6, 6, 4500, 2),
(7, 3, 17000, 3), (7, 4, 15000, 1),
(8, 7, 22000, 2), (8, 2, 36000, 1),
(9, 6, 4500, 4), (9, 5, 3500, 3),
(10, 1, 65000, 1), (10, 4, 15000, 3), (10, 7, 22000, 1);

INSERT INTO pembayaran (waktu_bayar, total, metode, transaksi_id) VALUES
('2026-10-01 10:15:00', 99000, 'TUNAI', 1),
('2026-10-02 11:20:00', 71000, 'TRANSFER', 2),
('2026-10-03 09:40:00', 43500, 'TUNAI', 3),
('2026-10-05 14:05:00', 22000, 'EDC', 4),
('2026-10-07 16:30:00', 219000, 'TRANSFER', 5);
