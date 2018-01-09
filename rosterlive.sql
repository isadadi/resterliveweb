-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 09, 2017 at 09:25 PM
-- Server version: 5.6.21
-- PHP Version: 5.6.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `rosterlive`
--

-- --------------------------------------------------------

--
-- Table structure for table `rl_dosen`
--

CREATE TABLE IF NOT EXISTS `rl_dosen` (
`dosen_id` int(4) NOT NULL,
  `dosen_nip` char(18) NOT NULL,
  `dosen_name` tinytext NOT NULL,
  `dosen_kode` char(3) NOT NULL,
  `prodi_id` char(4) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rl_dosen`
--

INSERT INTO `rl_dosen` (`dosen_id`, `dosen_nip`, `dosen_name`, `dosen_kode`, `prodi_id`) VALUES
(2, '1234567890', 'Romi Fadillah', 'ROM', '1402'),
(3, '098765445', 'Baihaqi', 'BAI', '1402'),
(4, '9876578', 'Seniman', 'SNM', '1402');

-- --------------------------------------------------------

--
-- Table structure for table `rl_fakultas`
--

CREATE TABLE IF NOT EXISTS `rl_fakultas` (
  `fakultas_id` char(2) NOT NULL,
  `fakultas_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rl_fakultas`
--

INSERT INTO `rl_fakultas` (`fakultas_id`, `fakultas_name`) VALUES
('14', 'Fakultas Ilmu Komputer dan Teknologi Informasi');

-- --------------------------------------------------------

--
-- Table structure for table `rl_jadwal`
--

CREATE TABLE IF NOT EXISTS `rl_jadwal` (
`jad_id` int(11) NOT NULL,
  `mat_kul_id` varchar(8) NOT NULL,
  `jad_kom` char(5) NOT NULL,
  `id_ruangan` int(11) NOT NULL,
  `jad_hari` varchar(25) NOT NULL,
  `jad_jam_mulai` time NOT NULL,
  `dosen_id` int(4) NOT NULL,
  `prodi_id` char(4) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rl_jadwal`
--

INSERT INTO `rl_jadwal` (`jad_id`, `mat_kul_id`, `jad_kom`, `id_ruangan`, `jad_hari`, `jad_jam_mulai`, `dosen_id`, `prodi_id`) VALUES
(36, 'TIF2304', 'A', 4, 'Senin', '08:50:00', 2, '1402'),
(37, 'TIF2304', 'A', 4, 'Senin', '09:40:00', 2, '1402'),
(38, 'TIF2304', 'A', 4, 'Senin', '10:30:00', 2, '1402'),
(39, 'TIF2301', 'C', 1, 'Senin', '08:00:00', 2, '1402'),
(40, 'TIF2301', 'C', 1, 'Senin', '08:50:00', 2, '1402'),
(41, 'TIF2301', 'C', 1, 'Senin', '09:40:00', 2, '1402'),
(42, 'TIF3401', 'D', 2, 'Senin', '10:30:00', 2, '1402'),
(43, 'TIF3401', 'D', 2, 'Senin', '11:20:00', 2, '1402'),
(44, 'TIF3401', 'D', 2, 'Senin', '12:10:00', 2, '1402'),
(45, 'TIF4501', 'B', 1, 'Selasa', '09:40:00', 3, '1402'),
(46, 'TIF4501', 'B', 1, 'Selasa', '10:30:00', 3, '1402'),
(47, 'TIF4501', 'B', 1, 'Selasa', '11:20:00', 3, '1402');

-- --------------------------------------------------------

--
-- Table structure for table `rl_jadwal_ganti`
--

CREATE TABLE IF NOT EXISTS `rl_jadwal_ganti` (
`jad_gan_id` int(11) NOT NULL,
  `mat_kul_id` varchar(8) NOT NULL,
  `jad_gan_kom` char(5) NOT NULL,
  `jad_gan_ruangan` tinytext NOT NULL,
  `jad_gan_tanggal_sebelum_ganti` date NOT NULL,
  `jad_gan_tanggal_setelah_ganti` date NOT NULL,
  `jad_gan_jam_mulai` time NOT NULL,
  `dosen_id` char(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `rl_jadwal_ujian`
--

CREATE TABLE IF NOT EXISTS `rl_jadwal_ujian` (
`jad_uj_id` int(11) NOT NULL,
  `mat_kul_id` varchar(8) NOT NULL,
  `jad_uj_kom` char(5) NOT NULL,
  `id_ruangan` int(11) NOT NULL,
  `jad_uj_tanggal` date NOT NULL,
  `jad_uj_waktu` time NOT NULL,
  `id_tgl_ujian` int(11) NOT NULL,
  `prodi_id` char(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `rl_krs`
--

CREATE TABLE IF NOT EXISTS `rl_krs` (
`krs_id` int(11) NOT NULL,
  `mahasiswa_nim` char(9) NOT NULL,
  `mat_kul_id` varchar(8) NOT NULL,
  `krs_kom` char(5) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=99 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rl_krs`
--

INSERT INTO `rl_krs` (`krs_id`, `mahasiswa_nim`, `mat_kul_id`, `krs_kom`) VALUES
(82, '141402118', 'TIF2301', 'C'),
(83, '141402118', 'TIF2304', 'B'),
(84, '141402118', 'TIF4501', 'B'),
(85, '141402118', 'TIF4509', 'A'),
(86, '141402118', 'TIF3401', 'D'),
(91, '141402039', 'TIF2301', 'C'),
(92, '141402039', 'TIF4501', 'B'),
(93, '141402039', 'TIF4509', 'A'),
(94, '141402039', 'TIF3401', 'D'),
(97, '141402155', 'TIF4501', 'B'),
(98, '141402155', 'TIF3401', 'D');

-- --------------------------------------------------------

--
-- Table structure for table `rl_mahasiswa`
--

CREATE TABLE IF NOT EXISTS `rl_mahasiswa` (
  `mahasiswa_nim` char(9) NOT NULL,
  `mahasiswa_name` tinytext NOT NULL,
  `mahasiswa_password` varchar(32) NOT NULL,
  `mahasiswa_gender` enum('pria','wanita') DEFAULT NULL,
  `prodi_id` char(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rl_mahasiswa`
--

INSERT INTO `rl_mahasiswa` (`mahasiswa_nim`, `mahasiswa_name`, `mahasiswa_password`, `mahasiswa_gender`, `prodi_id`) VALUES
('141402039', 'Muhammad Isa Dadi Hasibuan', '11101996', NULL, '1402'),
('141402118', 'Fiqih Fatwa', '11101996', NULL, '1402'),
('141402155', 'M. SAKTA AKBARI', '1996-12-18', NULL, '1402');

-- --------------------------------------------------------

--
-- Table structure for table `rl_mata_kuliah`
--

CREATE TABLE IF NOT EXISTS `rl_mata_kuliah` (
  `mat_kul_id` varchar(8) NOT NULL,
  `mat_kul_name` tinytext NOT NULL,
  `mat_kul_type` enum('W','P') NOT NULL,
  `mat_kul_sks` int(1) NOT NULL,
  `prodi_id` char(4) NOT NULL,
  `mat_semester` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rl_mata_kuliah`
--

INSERT INTO `rl_mata_kuliah` (`mat_kul_id`, `mat_kul_name`, `mat_kul_type`, `mat_kul_sks`, `prodi_id`, `mat_semester`) VALUES
('TIF2301', 'Struktur Data dan Algoritma', 'W', 3, '1402', '3'),
('TIF2304', 'Komunikasi Data dan Jaringan ', 'W', 3, '1402', '3'),
('TIF3401', 'Arsitektur Data', 'W', 3, '1402', '5'),
('TIF4501', 'Pemrograman Mobile', 'W', 3, '1402', '7'),
('TIF4509', 'Sistem Sensor dan Aplikasi', 'P', 2, '1402', '7');

-- --------------------------------------------------------

--
-- Table structure for table `rl_prodi`
--

CREATE TABLE IF NOT EXISTS `rl_prodi` (
  `prodi_id` char(4) NOT NULL,
  `prodi_name` varchar(25) NOT NULL,
  `fakultas_id` char(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rl_prodi`
--

INSERT INTO `rl_prodi` (`prodi_id`, `prodi_name`, `fakultas_id`) VALUES
('1402', 'Teknologi Informasi', '14');

-- --------------------------------------------------------

--
-- Table structure for table `rl_ruangan`
--

CREATE TABLE IF NOT EXISTS `rl_ruangan` (
`id_ruangan` int(11) NOT NULL,
  `nama_ruangan` varchar(20) NOT NULL,
  `prodi_id` char(4) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rl_ruangan`
--

INSERT INTO `rl_ruangan` (`id_ruangan`, `nama_ruangan`, `prodi_id`) VALUES
(1, 'TI101', '1402'),
(2, 'TI102', '1402'),
(3, 'TI103', '1402'),
(4, 'TI104', '1402'),
(5, 'TI105', '1402'),
(6, 'TI106', '1402');

-- --------------------------------------------------------

--
-- Table structure for table `rl_tanggal_ujian`
--

CREATE TABLE IF NOT EXISTS `rl_tanggal_ujian` (
`id_tgl_ujian` int(11) NOT NULL,
  `tgl_mulai_ujian` date NOT NULL,
  `tgl_selesai_ujian` date NOT NULL,
  `prodi_id` char(4) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rl_tanggal_ujian`
--

INSERT INTO `rl_tanggal_ujian` (`id_tgl_ujian`, `tgl_mulai_ujian`, `tgl_selesai_ujian`, `prodi_id`) VALUES
(9, '2017-10-09', '2017-10-22', '1402');

-- --------------------------------------------------------

--
-- Table structure for table `rl_user`
--

CREATE TABLE IF NOT EXISTS `rl_user` (
`user_id` int(11) NOT NULL,
  `user_name` tinytext NOT NULL,
  `user_uname` varchar(25) NOT NULL,
  `user_password` varchar(100) NOT NULL,
  `user_role_id` tinyint(4) NOT NULL,
  `user_status_active` varchar(1) NOT NULL,
  `user_last_ip_address` varchar(20) NOT NULL,
  `user_last_login` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `id_prodi` char(4) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rl_user`
--

INSERT INTO `rl_user` (`user_id`, `user_name`, `user_uname`, `user_password`, `user_role_id`, `user_status_active`, `user_last_ip_address`, `user_last_login`, `id_prodi`) VALUES
(2, 'Bambang', 'user1', '$2y$10$SsrVnfMhSXF0M0UNCGxGoOistPZRlKaATQpzK2edui8xhQjeY/q3.', 1, '1', '', '2017-10-03 16:27:27', ''),
(3, 'Bambang', 'user2', '$2y$10$SsrVnfMhSXF0M0UNCGxGoOistPZRlKaATQpzK2edui8xhQjeY/q3.', 2, '1', '', '2017-10-03 16:27:23', '1402');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `rl_dosen`
--
ALTER TABLE `rl_dosen`
 ADD PRIMARY KEY (`dosen_id`), ADD KEY `prodi_id` (`prodi_id`);

--
-- Indexes for table `rl_fakultas`
--
ALTER TABLE `rl_fakultas`
 ADD PRIMARY KEY (`fakultas_id`);

--
-- Indexes for table `rl_jadwal`
--
ALTER TABLE `rl_jadwal`
 ADD PRIMARY KEY (`jad_id`), ADD KEY `mat_kul_id` (`mat_kul_id`), ADD KEY `dosen_id` (`dosen_id`);

--
-- Indexes for table `rl_jadwal_ganti`
--
ALTER TABLE `rl_jadwal_ganti`
 ADD PRIMARY KEY (`jad_gan_id`);

--
-- Indexes for table `rl_jadwal_ujian`
--
ALTER TABLE `rl_jadwal_ujian`
 ADD PRIMARY KEY (`jad_uj_id`);

--
-- Indexes for table `rl_krs`
--
ALTER TABLE `rl_krs`
 ADD PRIMARY KEY (`krs_id`), ADD KEY `mahasiswa_nim` (`mahasiswa_nim`), ADD KEY `mat_kul_id` (`mat_kul_id`);

--
-- Indexes for table `rl_mahasiswa`
--
ALTER TABLE `rl_mahasiswa`
 ADD PRIMARY KEY (`mahasiswa_nim`), ADD KEY `prodi_id` (`prodi_id`);

--
-- Indexes for table `rl_mata_kuliah`
--
ALTER TABLE `rl_mata_kuliah`
 ADD PRIMARY KEY (`mat_kul_id`);

--
-- Indexes for table `rl_prodi`
--
ALTER TABLE `rl_prodi`
 ADD PRIMARY KEY (`prodi_id`), ADD KEY `fakultas_id` (`fakultas_id`);

--
-- Indexes for table `rl_ruangan`
--
ALTER TABLE `rl_ruangan`
 ADD PRIMARY KEY (`id_ruangan`);

--
-- Indexes for table `rl_tanggal_ujian`
--
ALTER TABLE `rl_tanggal_ujian`
 ADD PRIMARY KEY (`id_tgl_ujian`);

--
-- Indexes for table `rl_user`
--
ALTER TABLE `rl_user`
 ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `rl_dosen`
--
ALTER TABLE `rl_dosen`
MODIFY `dosen_id` int(4) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `rl_jadwal`
--
ALTER TABLE `rl_jadwal`
MODIFY `jad_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=48;
--
-- AUTO_INCREMENT for table `rl_jadwal_ganti`
--
ALTER TABLE `rl_jadwal_ganti`
MODIFY `jad_gan_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `rl_jadwal_ujian`
--
ALTER TABLE `rl_jadwal_ujian`
MODIFY `jad_uj_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `rl_krs`
--
ALTER TABLE `rl_krs`
MODIFY `krs_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=99;
--
-- AUTO_INCREMENT for table `rl_ruangan`
--
ALTER TABLE `rl_ruangan`
MODIFY `id_ruangan` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `rl_tanggal_ujian`
--
ALTER TABLE `rl_tanggal_ujian`
MODIFY `id_tgl_ujian` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `rl_user`
--
ALTER TABLE `rl_user`
MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `rl_dosen`
--
ALTER TABLE `rl_dosen`
ADD CONSTRAINT `rl_dosen_ibfk_1` FOREIGN KEY (`prodi_id`) REFERENCES `rl_prodi` (`prodi_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `rl_krs`
--
ALTER TABLE `rl_krs`
ADD CONSTRAINT `rl_krs_ibfk_1` FOREIGN KEY (`mahasiswa_nim`) REFERENCES `rl_mahasiswa` (`mahasiswa_nim`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `rl_krs_ibfk_2` FOREIGN KEY (`mat_kul_id`) REFERENCES `rl_mata_kuliah` (`mat_kul_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `rl_mahasiswa`
--
ALTER TABLE `rl_mahasiswa`
ADD CONSTRAINT `rl_mahasiswa_ibfk_1` FOREIGN KEY (`prodi_id`) REFERENCES `rl_prodi` (`prodi_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `rl_prodi`
--
ALTER TABLE `rl_prodi`
ADD CONSTRAINT `rl_prodi_ibfk_1` FOREIGN KEY (`fakultas_id`) REFERENCES `rl_fakultas` (`fakultas_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
