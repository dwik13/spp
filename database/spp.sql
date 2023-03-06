-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 03 Mar 2023 pada 04.21
-- Versi server: 10.4.27-MariaDB
-- Versi PHP: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `spp`
--

DELIMITER $$
--
-- Prosedur
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `get_siswa` ()   BEGIN
    SELECT `tb_siswa`.*, `tb_kelas`.`nama_kelas`, `tb_spp`.`tahun`, `tb_spp`.`nominal`
                FROM `tb_siswa` JOIN `tb_kelas`
                ON `tb_siswa`.`id_kelas` = `tb_kelas`.`id_kelas`
                JOIN `tb_spp` ON `tb_siswa` .`id_spp` = `tb_spp`.`id_spp` ORDER BY `tb_siswa`.`nisn`, `tb_siswa`.`id_kelas` ASC;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `level_get` (IN `level` INT(11))   BEGIN
      SELECT * FROM tb_level WHERE level = id_level;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `login_check` (IN `user` VARCHAR(100), IN `pass` VARCHAR(225))   BEGIN
     SELECT * FROM tb_petugas WHERE user = username AND pass = password;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `siswa_check` (IN `user` VARCHAR(100), IN `pass` VARCHAR(225))   BEGIN
   SELECT * FROM tb_siswa WHERE user = nisn AND pass = nis;

END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_jurusan`
--

CREATE TABLE `tb_jurusan` (
  `id_jurusan` int(11) NOT NULL,
  `jurusan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_jurusan`
--

INSERT INTO `tb_jurusan` (`id_jurusan`, `jurusan`) VALUES
(1, 'Rekayasa Perangkat Lunak'),
(2, 'Teknik Komputer dan Jaringan'),
(3, 'Multimedia');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_kelas`
--

CREATE TABLE `tb_kelas` (
  `id_kelas` int(11) NOT NULL,
  `nama_kelas` varchar(100) NOT NULL,
  `id_jurusan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_kelas`
--

INSERT INTO `tb_kelas` (`id_kelas`, `nama_kelas`, `id_jurusan`) VALUES
(13, 'X RPL 1', 1),
(14, 'X RPL 2', 1),
(15, 'X TKJ 1', 2),
(16, 'X TKJ 2', 2),
(23, 'XI RPL 1', 1),
(24, 'XII RPL 1', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_level`
--

CREATE TABLE `tb_level` (
  `id_level` int(11) NOT NULL,
  `level` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_level`
--

INSERT INTO `tb_level` (`id_level`, `level`) VALUES
(1, 'Admin'),
(2, 'Petugas');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pembayaran`
--

CREATE TABLE `tb_pembayaran` (
  `id_pembayaran` int(11) NOT NULL,
  `id_petugas` int(11) DEFAULT NULL,
  `nisn` char(10) NOT NULL,
  `tgl_bayar` date DEFAULT NULL,
  `jatuh_tempo` date NOT NULL,
  `bulan_dibayar` varchar(10) NOT NULL,
  `tahun_dibayar` varchar(4) NOT NULL,
  `id_spp` int(11) NOT NULL,
  `jumlah_bayar` int(11) NOT NULL,
  `ket` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_pembayaran`
--

INSERT INTO `tb_pembayaran` (`id_pembayaran`, `id_petugas`, `nisn`, `tgl_bayar`, `jatuh_tempo`, `bulan_dibayar`, `tahun_dibayar`, `id_spp`, `jumlah_bayar`, `ket`) VALUES
(350, 18, '0012345678', '2023-02-27', '2023-02-27', 'Februari', '2023', 19, 135000, 'LUNAS'),
(351, 18, '0012345678', '2023-02-27', '2023-03-27', 'Maret', '2023', 19, 135000, 'LUNAS'),
(352, 1, '0012345678', '2023-02-27', '2023-04-27', 'April', '2023', 19, 135000, 'LUNAS'),
(353, 1, '0012345678', '2023-02-27', '2023-05-27', 'Mei', '2023', 19, 135000, 'LUNAS'),
(354, NULL, '0012345678', NULL, '2023-06-27', 'Juni', '2023', 19, 135000, ''),
(355, NULL, '0012345678', NULL, '2023-07-27', 'Juli', '2023', 19, 135000, ''),
(356, NULL, '0012345678', NULL, '2023-08-27', 'Agustus', '2023', 19, 135000, ''),
(357, NULL, '0012345678', NULL, '2023-09-27', 'September', '2023', 19, 135000, ''),
(358, NULL, '0012345678', NULL, '2023-10-27', 'Oktober', '2023', 19, 135000, ''),
(359, NULL, '0012345678', NULL, '2023-11-27', 'November', '2023', 19, 135000, ''),
(360, NULL, '0012345678', NULL, '2023-12-27', 'Desember', '2023', 19, 135000, ''),
(361, NULL, '0012345678', NULL, '2024-01-27', 'Januari', '2024', 19, 135000, ''),
(422, 21, '0012234567', '2023-03-02', '2022-07-11', 'Juli', '2022', 23, 150000, 'LUNAS'),
(423, 21, '0012234567', '2023-03-02', '2022-08-11', 'Agustus', '2022', 23, 150000, 'LUNAS'),
(424, 1, '0012234567', '2023-03-03', '2022-09-11', 'September', '2022', 23, 150000, 'LUNAS'),
(425, NULL, '0012234567', NULL, '2022-10-11', 'Oktober', '2022', 23, 150000, ''),
(426, NULL, '0012234567', NULL, '2022-11-11', 'November', '2022', 23, 150000, ''),
(427, NULL, '0012234567', NULL, '2022-12-11', 'Desember', '2022', 23, 150000, ''),
(428, NULL, '0012234567', NULL, '2023-01-11', 'Januari', '2023', 23, 150000, ''),
(429, NULL, '0012234567', NULL, '2023-02-11', 'Februari', '2023', 23, 150000, ''),
(430, NULL, '0012234567', NULL, '2023-03-11', 'Maret', '2023', 23, 150000, ''),
(431, NULL, '0012234567', NULL, '2023-04-11', 'April', '2023', 23, 150000, ''),
(432, NULL, '0012234567', NULL, '2023-05-11', 'Mei', '2023', 23, 150000, ''),
(433, NULL, '0012234567', NULL, '2023-06-11', 'Juni', '2023', 23, 150000, ''),
(434, 18, '0022345678', '2023-03-02', '2022-07-11', 'Juli', '2022', 23, 150000, 'LUNAS'),
(435, NULL, '0022345678', NULL, '2022-08-11', 'Agustus', '2022', 23, 150000, ''),
(436, NULL, '0022345678', NULL, '2022-09-11', 'September', '2022', 23, 150000, ''),
(437, NULL, '0022345678', NULL, '2022-10-11', 'Oktober', '2022', 23, 150000, ''),
(438, NULL, '0022345678', NULL, '2022-11-11', 'November', '2022', 23, 150000, ''),
(439, NULL, '0022345678', NULL, '2022-12-11', 'Desember', '2022', 23, 150000, ''),
(440, NULL, '0022345678', NULL, '2023-01-11', 'Januari', '2023', 23, 150000, ''),
(441, NULL, '0022345678', NULL, '2023-02-11', 'Februari', '2023', 23, 150000, ''),
(442, NULL, '0022345678', NULL, '2023-03-11', 'Maret', '2023', 23, 150000, ''),
(443, NULL, '0022345678', NULL, '2023-04-11', 'April', '2023', 23, 150000, ''),
(444, NULL, '0022345678', NULL, '2023-05-11', 'Mei', '2023', 23, 150000, ''),
(445, NULL, '0022345678', NULL, '2023-06-11', 'Juni', '2023', 23, 150000, ''),
(446, NULL, '0123423421', NULL, '2022-07-11', 'Juli', '2022', 23, 150000, ''),
(447, NULL, '0123423421', NULL, '2022-08-11', 'Agustus', '2022', 23, 150000, ''),
(448, NULL, '0123423421', NULL, '2022-09-11', 'September', '2022', 23, 150000, ''),
(449, NULL, '0123423421', NULL, '2022-10-11', 'Oktober', '2022', 23, 150000, ''),
(450, NULL, '0123423421', NULL, '2022-11-11', 'November', '2022', 23, 150000, ''),
(451, NULL, '0123423421', NULL, '2022-12-11', 'Desember', '2022', 23, 150000, ''),
(452, NULL, '0123423421', NULL, '2023-01-11', 'Januari', '2023', 23, 150000, ''),
(453, NULL, '0123423421', NULL, '2023-02-11', 'Februari', '2023', 23, 150000, ''),
(454, NULL, '0123423421', NULL, '2023-03-11', 'Maret', '2023', 23, 150000, ''),
(455, NULL, '0123423421', NULL, '2023-04-11', 'April', '2023', 23, 150000, ''),
(456, NULL, '0123423421', NULL, '2023-05-11', 'Mei', '2023', 23, 150000, ''),
(457, NULL, '0123423421', NULL, '2023-06-11', 'Juni', '2023', 23, 150000, '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_petugas`
--

CREATE TABLE `tb_petugas` (
  `id_petugas` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(225) NOT NULL,
  `nama_petugas` varchar(100) NOT NULL,
  `id_level` int(11) NOT NULL,
  `deskripsi` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_petugas`
--

INSERT INTO `tb_petugas` (`id_petugas`, `username`, `password`, `nama_petugas`, `id_level`, `deskripsi`) VALUES
(1, 'dwikhusnul', '827ccb0eea8a706c4c34a16891f84e7b', 'dwi khusnul', 1, '12345'),
(18, 'yahya', '827ccb0eea8a706c4c34a16891f84e7b', 'yahya salamudin', 2, '12345'),
(20, 'dwik', '827ccb0eea8a706c4c34a16891f84e7b', 'dwi khusnul khotimah', 2, '12345'),
(21, 'admin', '827ccb0eea8a706c4c34a16891f84e7b', 'Administrator', 1, '12345');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_siswa`
--

CREATE TABLE `tb_siswa` (
  `nisn` char(10) NOT NULL,
  `nis` char(8) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `id_kelas` int(11) NOT NULL,
  `alamat` text NOT NULL,
  `no_telp` varchar(13) NOT NULL,
  `id_spp` int(11) NOT NULL,
  `image` varchar(128) NOT NULL,
  `status` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_siswa`
--

INSERT INTO `tb_siswa` (`nisn`, `nis`, `nama`, `id_kelas`, `alamat`, `no_telp`, `id_spp`, `image`, `status`) VALUES
('0012234567', '00123466', 'Diva Oliviya Mayantika', 24, 'Jember', '082546765678', 23, 'WhatsApp_Image_2023-02-27_at_15_06_591.jpeg', 'aktif'),
('0012345678', '00123456', 'Ririn Novita Sari', 13, 'Jember', '082345678908', 19, '', 'tdkaktif'),
('0022345678', '00324567', 'Hilyatus Zahro', 24, 'Jember', '083454567612', 23, 'WhatsApp_Image_2023-02-27_at_15_07_031.jpeg', 'aktif'),
('0123423421', '00256787', 'Amjad Balqis Amiroh', 24, 'Jember', '089765675841', 23, 'WhatsApp_Image_2023-02-27_at_15_06_59_(1)1.jpeg', 'aktif');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_spp`
--

CREATE TABLE `tb_spp` (
  `id_spp` int(11) NOT NULL,
  `tahun` varchar(16) NOT NULL,
  `nominal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_spp`
--

INSERT INTO `tb_spp` (`id_spp`, `tahun`, `nominal`) VALUES
(19, '2020/2021', 135000),
(20, '2021/2022', 135000),
(23, '2022/2023', 150000);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_jurusan`
--
ALTER TABLE `tb_jurusan`
  ADD PRIMARY KEY (`id_jurusan`);

--
-- Indeks untuk tabel `tb_kelas`
--
ALTER TABLE `tb_kelas`
  ADD PRIMARY KEY (`id_kelas`),
  ADD KEY `id_jurusan` (`id_jurusan`);

--
-- Indeks untuk tabel `tb_level`
--
ALTER TABLE `tb_level`
  ADD PRIMARY KEY (`id_level`);

--
-- Indeks untuk tabel `tb_pembayaran`
--
ALTER TABLE `tb_pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`),
  ADD KEY `id_petugas` (`id_petugas`),
  ADD KEY `id_spp` (`id_spp`),
  ADD KEY `nisn` (`nisn`);

--
-- Indeks untuk tabel `tb_petugas`
--
ALTER TABLE `tb_petugas`
  ADD PRIMARY KEY (`id_petugas`),
  ADD KEY `id_level` (`id_level`);

--
-- Indeks untuk tabel `tb_siswa`
--
ALTER TABLE `tb_siswa`
  ADD PRIMARY KEY (`nisn`),
  ADD KEY `id_kelas` (`id_kelas`),
  ADD KEY `id_spp` (`id_spp`);

--
-- Indeks untuk tabel `tb_spp`
--
ALTER TABLE `tb_spp`
  ADD PRIMARY KEY (`id_spp`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_jurusan`
--
ALTER TABLE `tb_jurusan`
  MODIFY `id_jurusan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tb_kelas`
--
ALTER TABLE `tb_kelas`
  MODIFY `id_kelas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT untuk tabel `tb_level`
--
ALTER TABLE `tb_level`
  MODIFY `id_level` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tb_pembayaran`
--
ALTER TABLE `tb_pembayaran`
  MODIFY `id_pembayaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=458;

--
-- AUTO_INCREMENT untuk tabel `tb_petugas`
--
ALTER TABLE `tb_petugas`
  MODIFY `id_petugas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT untuk tabel `tb_spp`
--
ALTER TABLE `tb_spp`
  MODIFY `id_spp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tb_kelas`
--
ALTER TABLE `tb_kelas`
  ADD CONSTRAINT `tb_kelas_ibfk_1` FOREIGN KEY (`id_jurusan`) REFERENCES `tb_jurusan` (`id_jurusan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_pembayaran`
--
ALTER TABLE `tb_pembayaran`
  ADD CONSTRAINT `tb_pembayaran_ibfk_1` FOREIGN KEY (`id_spp`) REFERENCES `tb_spp` (`id_spp`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_pembayaran_ibfk_2` FOREIGN KEY (`id_petugas`) REFERENCES `tb_petugas` (`id_petugas`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_pembayaran_ibfk_3` FOREIGN KEY (`nisn`) REFERENCES `tb_siswa` (`nisn`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_petugas`
--
ALTER TABLE `tb_petugas`
  ADD CONSTRAINT `tb_petugas_ibfk_1` FOREIGN KEY (`id_level`) REFERENCES `tb_level` (`id_level`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_siswa`
--
ALTER TABLE `tb_siswa`
  ADD CONSTRAINT `tb_siswa_ibfk_1` FOREIGN KEY (`id_kelas`) REFERENCES `tb_kelas` (`id_kelas`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_siswa_ibfk_2` FOREIGN KEY (`id_spp`) REFERENCES `tb_spp` (`id_spp`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
