-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 21, 2015 at 12:18 PM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `tes`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id_admin` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(12) NOT NULL,
  `password` varchar(32) NOT NULL,
  `nama_lengkap` varchar(64) NOT NULL,
  PRIMARY KEY (`id_admin`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `username`, `password`, `nama_lengkap`) VALUES
(1, 'dark89', '098f6bcd4621d373cade4e832627b4f6', 'Sumijan'),
(8, 'udin', '21232f297a57a5a743894a0e4a801fc3', 'Udin Pea'),
(9, 'nunu', '21232f297a57a5a743894a0e4a801fc3', 'Nunu Reza'),
(10, 'test', '21232f297a57a5a743894a0e4a801fc3', 'Heri');

-- --------------------------------------------------------

--
-- Table structure for table `bank_soal`
--

CREATE TABLE IF NOT EXISTS `bank_soal` (
  `id_soal` int(12) NOT NULL AUTO_INCREMENT,
  `id_tes` int(11) NOT NULL,
  `soal` text NOT NULL,
  `a` text NOT NULL,
  `b` text NOT NULL,
  `c` text NOT NULL,
  `d` text NOT NULL,
  `jawaban_benar` varchar(1) NOT NULL,
  PRIMARY KEY (`id_soal`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

--
-- Dumping data for table `bank_soal`
--

INSERT INTO `bank_soal` (`id_soal`, `id_tes`, `soal`, `a`, `b`, `c`, `d`, `jawaban_benar`) VALUES
(1, 1, 'Tekanan ke atas dari magma yang menyebabkan gerak lempeng dan menimbulkan energi yang menekan lapisan kulit bumi sehingga terjadi pergeseran kulit bumi disebut gejala ….', 'tektonik', 'seisme', 'vulkanik', 'eksogen', 'C'),
(2, 1, 'Berikut ini cara hidup yang tidak termasuk ciri kehidupan manusia purba masa berburu dan mengumpulkan makanan adalah ....', 'hidup sudah menetap', 'food gathering', 'hidupnya berpindah-pindah', 'hidupnya bergantung pada alam', 'A'),
(3, 1, 'Keikutsertaan merasakan apa yang dirasakan orang lain disebut . . . .', 'simpati atau empati', 'identifikasi', 'akomodasi', 'sugesti', 'A'),
(4, 1, 'Keinginan yang menjadi pendorong manusia melakukan kegiatan ekonomi ialah ...', 'prinsip ekonomi', 'motif ekonomi', 'sistem ekonomi', 'hukum ekonomi', 'B'),
(5, 1, 'Kumpulan peta yang sudah dibagi-bagi berdasarkan benua, negara, provinsi, dan seterusnya disatukan menjadi sebuah buku disebut ....', 'globe', 'peta', 'atlas', 'peta buta', 'C'),
(6, 1, 'Semakin ke atas tekanan udara ....', 'semakin naik', 'semakin turun', 'tetap', 'tidak teratur', 'B'),
(7, 1, 'Pada sekitar abad ke-7 sampai abad ke-11, Kerajaan Sriwijaya menjadi pusat perdagangan di Nusantara. Hal ini disebabkan oleh ....', 'Kerjaan Sriwijaya merupakan kerjaan maritim', 'letak Kerajaan sriwijaya di dekat selat malaka', 'Kerjaan Sriwijaya memiliki pelaut-pelaut ulung', 'mata pencaharian utama masyarakatnya adalah perdagangan', 'B'),
(8, 1, 'Wali Songo adalah sebutan bagi sem­bilan wali yang merupakan tokoh penyebar agama Islam di pulau....', 'bali', 'jawa', 'kalimantan', 'sulawesi', 'B'),
(9, 1, 'Tujuan kedatangan bangsa Eropa ke Indonesia adalah ....', 'mencari daerah rempah-rempah', 'membuktikan teori bumi bulat', 'mencari pasar di wilayah asia', 'mencari bahan baku perindusttrian', 'A'),
(10, 1, 'Tujuan dari kegiatan produksi adalah....', 'meningkatkan kegunaan suatu barang', 'mengolah SDA menjadi alat pemuas kebutuhan', 'menghasilkan barang dan jasa', 'semua jawaban benar', 'D'),
(11, 1, 'Berikut adalah berbagai upaya yang dilakukan oleh pemerintah dalam upaya mengatasi masalah jumlah penduduk, kecuali ... .', 'mencanangkan program KB', 'membatasi tunjangan anak bagi PNS/ABRI', 'membangun berbagai sarana kesehatan', 'menetapkan batas usia nikah yang diatur dalam undang-undang', 'C'),
(12, 1, 'Di bawah ini yang bukan merupakan cirri manusia kreatif adalah….', 'mandiri', 'percaya diri', 'tekun', 'pesimis', 'D'),
(13, 1, 'Kemenangan Jepang atas Rusia memberikan pengaruh positif bagi pergerakan nasional Indonesia sebab....', 'Jepang sbg bgs Asia mampu mengalahkan Rusia', 'Jepang membantu perjuangan bangsa Indonesia berupa persenjataan', 'Indonesia dapat meminta bantuan Jepang untuk mendesak Belanda', 'kekalahan Rusia menandai kekalahan bangsa Eropa seluruhnya', 'A'),
(14, 1, 'Perilaku menyimpang yang termasuk sebagai tindak kriminalitas adalah ... .', 'kebut-kebutan kelompok', 'perampokan di bank', 'remaja yang mabuk', 'perjudian', 'B'),
(15, 1, 'Salah satu isi KMB yang sangat penting bagi bangsa Indonesia yaitu ...', 'antara RIS dan Belanda akan diadakan kerja sama', 'RIS mendapatkan kapal perang dan persenjataan dari Belanda', 'Belanda mengakui kedulatan RIS', 'tentara kerajaan Belanda ditarik dari Indonesia', 'C'),
(16, 2, 'Dibawah ini adalah besaran Turunan...(kecuali)', 'Volume', 'Massa jenis', 'Kuat Arus', 'Kecepatan', 'C'),
(17, 2, 'Bila ada Ali menghitung panjan sisi meja dengan penggaris ternyata lebih sedikit jumlahnya dibandingkan dengan menggunakan pensil.\r\nPerlakuan Ali tersebut disebut....', 'Berlogika', 'Menghitung', 'Mengukur', 'Membandingkan', 'C'),
(18, 2, 'Apa arti dari 12 Kg...', 'Besaran Panjang bernilai 12 satuannya kilogram', 'Besaran Massa bernilai 12 satuannya kilogram', 'Besaran Volume bernilai 12 satuannya kilogram', 'Besaran Waktu bernilai 12 satuannya kilogram', 'B'),
(19, 2, 'Dibawah ini adalah besaran pokok.....(Kecuali)', 'Panjang', 'Massa', 'Waktu', 'Luas', 'D'),
(20, 2, 'Apa yang dimaksud dengan mengukur...?', 'Membandingkan satuan dengan yang lain dan sejenis', 'Menghitung satuan dengan yang lain dan sejenis', 'Mengeja satuan dengan yang lain dan sejenis', 'Menambah satuan dengan yang lain dan sejenis', 'A'),
(21, 2, 'Pernyataan dibawah ini adalah benar kecuali...', 'Membandingkan satuan dengan besaran lain dan sejenis adalah meng', 'Sesuatu yang dapat diukur merupakan besaran', 'Bila 2 m bis dijumlahkan dengan 200 cm', 'Besaran yang diturunkan dari besaran pokok merupakan besaran tur', 'A'),
(22, 2, '108 km/jam =', '300 m/s', '30 m/s', '3 m/s', 'Semua salah', 'B'),
(23, 2, 'Kuat arus mempunyai satuan SI...', 'Ampere Meter', 'Centimeter', 'Ampere', 'Kilometer', 'C'),
(24, 2, '2 m + 300 cm =', '5 meter', '50 meter', '302 meter', '150 meter', 'A'),
(25, 2, 'Besaran yang didefinisikan sendiri dari besaran itu sendiri disebut...', 'Besaran Turunan', 'Besaran Pokok', 'Besaran Utama', 'Besaran Kedua', 'B');

-- --------------------------------------------------------

--
-- Table structure for table `guru`
--

CREATE TABLE IF NOT EXISTS `guru` (
  `nip` bigint(18) NOT NULL,
  `nuptk` varchar(20) NOT NULL,
  `nama_guru` varchar(64) NOT NULL,
  `tmp_lahir` varchar(32) NOT NULL,
  `tgl_lahir` varchar(10) NOT NULL,
  `golongan` varchar(5) NOT NULL,
  `pend_guru` varchar(4) NOT NULL,
  `id_matpel` int(11) NOT NULL,
  PRIMARY KEY (`nip`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `guru`
--

INSERT INTO `guru` (`nip`, `nuptk`, `nama_guru`, `tmp_lahir`, `tgl_lahir`, `golongan`, `pend_guru`, `id_matpel`) VALUES
(130682461, '9035733643210013', 'Peti Siti Fatimah', 'Tasikmalaya', '08/01/1966', 'III D', 'S1', 2),
(130802921, '6146748651200015', 'Lilis Lisnawati', 'Tasikmalaya', '04/30/1970', 'III D', 'S1', 3),
(130902216, '5346706066230006', 'Kurnia Wahab', 'Cirebon', '08/01/1979', 'III A', 'S1', 6),
(132087674, '0974739642300072', 'Tati Suryati', 'Tasikmalaya', '07/01/1981', 'IV A', 'S1', 3),
(132087678, '4937732641280012', 'Anita Alyani', 'Tasikmalaya', '08/01/1976', 'III C', 'S1', 5),
(132097329, '2433736637300152', 'Hardiman', 'Tasikmalaya', '07/01/1973', 'IV B', 'S1', 11),
(132097333, '2433736637300153', 'Lia Maemunah', 'Tasikmalaya', '06/01/1980', 'III A', 'S1', 1),
(132097345, '8855748669110012', 'Ayi Nurjamil', 'Tasimalaya', '07/01/1969', 'IV A', 'S1', 10),
(132097399, '0056746650200013', 'Nono Sumarno', 'Tasikmalaya', '04/01/1970', 'IV A', 'S1', 8),
(132121384, '4397732635300012', 'Ayi Komalasari', 'Tasikmalaya', '08/01/1973', 'IV A', 'S1', 7),
(1320973567, '6934744647300062', 'Aris Budiman', 'Tasikmalaya', '06/01/1977', 'III D', 'S1', 9);

-- --------------------------------------------------------

--
-- Table structure for table `hasil_jawaban`
--

CREATE TABLE IF NOT EXISTS `hasil_jawaban` (
  `nis` varchar(12) NOT NULL,
  `id_soal` int(11) NOT NULL,
  `jawaban` varchar(4) NOT NULL,
  `keterangan` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hasil_jawaban`
--

INSERT INTO `hasil_jawaban` (`nis`, `id_soal`, `jawaban`, `keterangan`) VALUES
('0001567930', 6, 'B', 'Benar'),
('0001567930', 1, 'C', 'Benar'),
('0001567930', 12, 'D', 'Benar'),
('0001567930', 14, 'B', 'Benar'),
('0001567930', 7, 'B', 'Benar'),
('0001567930', 8, 'B', 'Benar'),
('0001567930', 10, 'D', 'Benar'),
('0001567930', 11, 'C', 'Benar'),
('0001567930', 13, 'A', 'Benar'),
('0001567930', 15, 'C', 'Benar'),
('0001567930', 2, 'A', 'Benar'),
('0001567930', 3, 'A', 'Benar'),
('0001567930', 9, 'A', 'Benar'),
('0001567930', 4, 'B', 'Benar'),
('0001567930', 5, 'C', 'Benar'),
('0001567931', 4, 'B', 'Benar'),
('0001567931', 12, 'D', 'Benar'),
('0001567931', 15, 'C', 'Benar'),
('0001567931', 5, 'C', 'Benar'),
('0001567931', 6, 'B', 'Benar'),
('0001567931', 10, 'D', 'Benar'),
('0001567931', 11, 'C', 'Benar'),
('0001567931', 13, 'A', 'Benar'),
('0001567931', 1, 'C', 'Benar'),
('0001567931', 8, 'B', 'Benar'),
('0001567931', 7, 'D', 'Salah'),
('0001567931', 9, 'A', 'Benar'),
('0001567931', 2, 'C', 'Salah'),
('0001567931', 3, 'C', 'Salah'),
('0001567931', 14, 'C', 'Salah'),
('0001567932', 11, 'A', 'Salah'),
('0001567932', 9, 'C', 'Salah'),
('0001567932', 14, 'B', 'Benar'),
('0001567932', 4, 'B', 'Benar'),
('0001567932', 2, 'C', 'Salah'),
('0001567932', 15, 'A', 'Salah'),
('0001567932', 5, 'C', 'Benar'),
('0001567932', 12, 'B', 'Salah'),
('0001567932', 6, 'B', 'Benar'),
('0001567932', 8, 'B', 'Benar'),
('0001567932', 3, 'A', 'Benar'),
('0001567932', 1, 'C', 'Benar'),
('0001567932', 10, 'D', 'Benar'),
('0001567932', 7, 'B', 'Benar'),
('0001567932', 13, 'D', 'Salah'),
('0001567933', 14, 'C', 'Salah'),
('0001567933', 4, 'B', 'Benar'),
('0001567933', 8, 'B', 'Benar'),
('0001567933', 6, 'A', 'Salah'),
('0001567933', 13, 'C', 'Salah'),
('0001567933', 5, 'B', 'Salah'),
('0001567933', 2, 'C', 'Salah'),
('0001567933', 12, 'D', 'Benar'),
('0001567933', 11, 'A', 'Salah'),
('0001567933', 1, 'C', 'Benar'),
('0001567933', 3, 'A', 'Benar'),
('0001567933', 15, 'D', 'Salah'),
('0001567933', 10, 'D', 'Benar'),
('0001567933', 9, 'A', 'Benar'),
('0001567933', 7, 'B', 'Benar'),
('0001567934', 3, 'A', 'Benar'),
('0001567934', 7, 'B', 'Benar'),
('0001567934', 5, 'A', 'Salah'),
('0001567934', 8, 'D', 'Salah'),
('0001567934', 6, 'C', 'Salah'),
('0001567934', 9, 'A', 'Benar'),
('0001567934', 12, 'C', 'Salah'),
('0001567934', 1, 'A', 'Salah'),
('0001567934', 15, 'A', 'Salah'),
('0001567934', 10, 'B', 'Salah'),
('0001567934', 11, 'D', 'Salah'),
('0001567934', 2, 'C', 'Salah'),
('0001567934', 4, 'A', 'Salah'),
('0001567934', 14, 'D', 'Salah'),
('0001567934', 13, 'D', 'Salah'),
('0001567935', 13, 'A', 'Benar'),
('0001567935', 1, 'A', 'Salah'),
('0001567935', 10, 'D', 'Benar'),
('0001567935', 11, 'A', 'Salah'),
('0001567935', 8, 'B', 'Benar'),
('0001567935', 7, 'B', 'Benar'),
('0001567935', 4, 'B', 'Benar'),
('0001567935', 12, 'D', 'Benar'),
('0001567935', 5, 'C', 'Benar'),
('0001567935', 9, 'B', 'Salah'),
('0001567935', 2, 'A', 'Benar'),
('0001567935', 14, 'D', 'Salah'),
('0001567935', 15, 'C', 'Benar'),
('0001567935', 6, 'B', 'Benar'),
('0001567935', 3, 'A', 'Benar'),
('0011124132', 12, 'D', 'Benar'),
('0011124132', 9, 'A', 'Benar'),
('0011124132', 1, 'C', 'Benar'),
('0011124132', 14, 'C', 'Salah'),
('0011124132', 10, 'D', 'Benar'),
('0011124132', 13, 'C', 'Salah'),
('0011124132', 3, 'A', 'Benar'),
('0011124132', 15, 'C', 'Benar'),
('0011124132', 5, 'A', 'Salah'),
('0011124132', 2, 'A', 'Benar'),
('0011124132', 8, 'B', 'Benar'),
('0011124132', 7, 'B', 'Benar'),
('0011124132', 6, 'C', 'Salah'),
('0011124132', 4, 'B', 'Benar'),
('0011124132', 11, 'C', 'Benar'),
('0011124135', 7, 'B', 'Benar'),
('0011124135', 14, 'B', 'Benar'),
('0011124135', 1, 'A', 'Salah'),
('0011124135', 9, 'C', 'Salah'),
('0011124135', 15, 'C', 'Benar'),
('0011124135', 3, 'A', 'Benar'),
('0011124135', 2, 'A', 'Benar'),
('0011124135', 6, 'B', 'Benar'),
('0011124135', 13, 'D', 'Salah'),
('0011124135', 11, 'A', 'Salah'),
('0011124135', 12, 'D', 'Benar'),
('0011124135', 5, 'C', 'Benar'),
('0011124135', 4, 'B', 'Benar'),
('0011124135', 8, 'B', 'Benar'),
('0011124135', 10, 'D', 'Benar'),
('0011124137', 9, 'A', 'Benar'),
('0011124137', 1, 'C', 'Benar'),
('0011124137', 13, 'B', 'Salah'),
('0011124137', 3, 'A', 'Benar'),
('0011124137', 8, 'B', 'Benar'),
('0011124137', 14, 'B', 'Benar'),
('0011124137', 2, 'B', 'Salah'),
('0011124137', 5, 'C', 'Benar'),
('0011124137', 6, 'B', 'Benar'),
('0011124137', 11, 'C', 'Benar'),
('0011124137', 10, 'D', 'Benar'),
('0011124137', 12, 'D', 'Benar'),
('0011124137', 15, 'C', 'Benar'),
('0011124137', 4, 'B', 'Benar'),
('0011124137', 7, 'D', 'Salah'),
('0016014163', 1, 'C', 'Benar'),
('0016014163', 12, 'D', 'Benar'),
('0016014163', 4, 'B', 'Benar'),
('0016014163', 7, 'B', 'Benar'),
('0016014163', 3, 'A', 'Benar'),
('0016014163', 5, 'C', 'Benar'),
('0016014163', 15, 'C', 'Benar'),
('0016014163', 8, 'B', 'Benar'),
('0016014163', 9, 'A', 'Benar'),
('0016014163', 14, 'B', 'Benar'),
('0016014163', 11, 'C', 'Benar'),
('0016014163', 6, 'D', 'Salah'),
('0016014163', 13, 'C', 'Salah'),
('0016014163', 2, 'B', 'Salah'),
('0016014163', 10, 'D', 'Benar'),
('0012005180', 6, 'A', 'Salah'),
('0012005180', 7, 'B', 'Benar'),
('0012005180', 2, 'B', 'Salah'),
('0012005180', 8, 'B', 'Benar'),
('0012005180', 9, 'A', 'Benar'),
('0012005180', 14, 'B', 'Benar'),
('0012005180', 11, 'C', 'Benar'),
('0012005180', 13, 'C', 'Salah'),
('0012005180', 10, 'A', 'Salah'),
('0012005180', 15, 'C', 'Benar'),
('0012005180', 5, 'C', 'Benar'),
('0012005180', 4, 'B', 'Benar'),
('0012005180', 3, 'A', 'Benar'),
('0012005180', 12, 'D', 'Benar'),
('0012005180', 1, 'C', 'Benar'),
('0012005181', 1, 'C', 'Benar'),
('0012005181', 7, 'B', 'Benar'),
('0012005181', 9, 'A', 'Benar'),
('0012005181', 4, 'B', 'Benar'),
('0012005181', 5, 'C', 'Benar'),
('0012005181', 13, 'A', 'Benar'),
('0012005181', 12, 'D', 'Benar'),
('0012005181', 15, 'C', 'Benar'),
('0012005181', 2, 'B', 'Salah'),
('0012005181', 6, 'B', 'Benar'),
('0012005181', 3, 'A', 'Benar'),
('0012005181', 8, 'B', 'Benar'),
('0012005181', 14, 'D', 'Salah'),
('0012005181', 11, 'C', 'Benar'),
('0012005181', 10, 'D', 'Benar'),
('0016013561', 1, 'C', 'Benar'),
('0016013561', 6, 'B', 'Benar'),
('0016013561', 12, 'D', 'Benar'),
('0016013561', 8, 'B', 'Benar'),
('0016013561', 9, 'A', 'Benar'),
('0016013561', 15, 'C', 'Benar'),
('0016013561', 14, 'D', 'Salah'),
('0016013561', 10, 'D', 'Benar'),
('0016013561', 2, 'A', 'Benar'),
('0016013561', 4, 'A', 'Salah'),
('0016013561', 5, 'B', 'Salah'),
('0016013561', 7, 'C', 'Salah'),
('0016013561', 3, 'A', 'Benar'),
('0016013561', 11, 'C', 'Benar'),
('0016013561', 13, 'A', 'Benar'),
('0016013562', 11, 'C', 'Benar'),
('0016013562', 5, 'A', 'Salah'),
('0016013562', 1, 'C', 'Benar'),
('0016013562', 9, 'A', 'Benar'),
('0016013562', 14, 'B', 'Benar'),
('0016013562', 3, 'A', 'Benar'),
('0016013562', 10, 'D', 'Benar'),
('0016013562', 8, 'B', 'Benar'),
('0016013562', 13, 'A', 'Benar'),
('0016013562', 2, 'A', 'Benar'),
('0016013562', 7, 'A', 'Salah'),
('0016013562', 15, 'A', 'Salah'),
('0016013562', 4, 'C', 'Salah'),
('0016013562', 6, 'B', 'Benar'),
('0016013562', 12, 'D', 'Benar'),
('0016013563', 10, 'D', 'Benar'),
('0016013563', 1, 'C', 'Benar'),
('0016013563', 3, 'A', 'Benar'),
('0016013563', 11, 'C', 'Benar'),
('0016013563', 9, 'A', 'Benar'),
('0016013563', 6, 'B', 'Benar'),
('0016013563', 13, 'A', 'Benar'),
('0016013563', 4, 'B', 'Benar'),
('0016013563', 8, 'B', 'Benar'),
('0016013563', 7, 'B', 'Benar'),
('0016013563', 2, 'B', 'Salah'),
('0016013563', 15, 'A', 'Salah'),
('0016013563', 14, 'B', 'Benar'),
('0016013563', 5, 'C', 'Benar'),
('0016013563', 12, 'D', 'Benar'),
('0001567930', 18, 'B', 'Benar'),
('0001567930', 21, 'A', 'Benar'),
('0001567930', 25, 'A', 'Salah'),
('0001567930', 20, 'B', 'Salah'),
('0001567930', 16, 'B', 'Salah'),
('0001567930', 19, 'B', 'Salah'),
('0001567930', 17, 'D', 'Salah'),
('0001567930', 23, 'C', 'Benar'),
('0001567930', 24, 'A', 'Benar'),
('0001567930', 22, 'A', 'Salah'),
('0001567931', 22, 'A', 'Salah'),
('0001567931', 23, 'C', 'Benar'),
('0001567931', 17, 'C', 'Benar'),
('0001567931', 21, 'D', 'Salah'),
('0001567931', 25, 'A', 'Salah'),
('0001567931', 16, 'B', 'Salah'),
('0001567931', 24, 'A', 'Benar'),
('0001567931', 20, 'A', 'Benar'),
('0001567931', 19, 'D', 'Benar'),
('0001567931', 18, 'B', 'Benar'),
('0001567932', 19, 'D', 'Benar'),
('0001567932', 16, 'D', 'Salah'),
('0001567932', 25, 'A', 'Salah'),
('0001567932', 23, 'C', 'Benar'),
('0001567932', 24, 'A', 'Benar'),
('0001567932', 22, 'B', 'Benar'),
('0001567932', 20, 'A', 'Benar'),
('0001567932', 18, 'C', 'Salah'),
('0001567932', 17, 'C', 'Benar'),
('0001567932', 21, 'C', 'Salah'),
('0001567933', 23, 'C', 'Benar'),
('0001567933', 18, 'B', 'Benar'),
('0001567933', 21, 'B', 'Salah'),
('0001567933', 24, 'A', 'Benar'),
('0001567933', 19, 'A', 'Salah'),
('0001567933', 17, 'C', 'Benar'),
('0001567933', 16, 'C', 'Benar'),
('0001567933', 20, 'B', 'Salah'),
('0001567933', 25, 'B', 'Benar'),
('0001567933', 22, 'A', 'Salah'),
('0001567934', 21, 'B', 'Salah'),
('0001567934', 25, 'B', 'Benar'),
('0001567934', 23, 'C', 'Benar'),
('0001567934', 20, 'A', 'Benar'),
('0001567934', 16, 'C', 'Benar'),
('0001567934', 18, 'B', 'Benar'),
('0001567934', 17, 'C', 'Benar'),
('0001567934', 22, 'A', 'Salah'),
('0001567934', 24, 'A', 'Benar'),
('0001567934', 19, 'B', 'Salah');

-- --------------------------------------------------------

--
-- Table structure for table `hasil_ujian`
--

CREATE TABLE IF NOT EXISTS `hasil_ujian` (
  `id_hasil` int(100) NOT NULL AUTO_INCREMENT,
  `id_ujian` int(11) NOT NULL,
  `nis` bigint(10) NOT NULL,
  `benar` varchar(4) NOT NULL,
  `salah` varchar(4) NOT NULL,
  `kosong` varchar(4) NOT NULL,
  `skor` float NOT NULL,
  `status` varchar(32) NOT NULL,
  PRIMARY KEY (`id_hasil`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `jadwal`
--

CREATE TABLE IF NOT EXISTS `jadwal` (
  `id_jadwal` int(11) NOT NULL AUTO_INCREMENT,
  `id_tes` int(11) NOT NULL,
  `id_kelas` int(11) NOT NULL,
  `tgl_tes` varchar(32) NOT NULL,
  PRIMARY KEY (`id_jadwal`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `jadwal`
--

INSERT INTO `jadwal` (`id_jadwal`, `id_tes`, `id_kelas`, `tgl_tes`) VALUES
(7, 1, 2, '19/08/2015 15.45'),
(8, 1, 1, '19/08/2015 19.45'),
(9, 2, 1, '12/08/2015 10.00'),
(10, 2, 2, '13/08/2015 10.00');

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE IF NOT EXISTS `kelas` (
  `id_kelas` int(11) NOT NULL AUTO_INCREMENT,
  `kelas` varchar(5) NOT NULL,
  `nama_kelas` varchar(6) NOT NULL,
  PRIMARY KEY (`id_kelas`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id_kelas`, `kelas`, `nama_kelas`) VALUES
(1, 'VII', 'VII A'),
(2, 'VII', 'VII B'),
(3, 'VII', 'VII C'),
(4, 'VII', 'VII D'),
(5, 'VIII', 'VIII A'),
(6, 'VIII', 'VIII B'),
(7, 'VIII', 'VIII C'),
(8, 'VIII', 'VIII D'),
(9, 'IX', 'IX A'),
(10, 'IX', 'IX B'),
(11, 'IX', 'IX C'),
(12, 'IX', 'IX E'),
(13, 'VII', 'VII E'),
(14, 'IX', 'IX G');

-- --------------------------------------------------------

--
-- Table structure for table `matpel`
--

CREATE TABLE IF NOT EXISTS `matpel` (
  `id_matpel` int(11) NOT NULL AUTO_INCREMENT,
  `nama_matpel` varchar(64) NOT NULL,
  `kkm` float NOT NULL,
  PRIMARY KEY (`id_matpel`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `matpel`
--

INSERT INTO `matpel` (`id_matpel`, `nama_matpel`, `kkm`) VALUES
(1, 'IPA', 65),
(2, 'IPS', 65),
(3, 'MTK', 55),
(4, 'PKN', 60),
(5, 'B.INGGRIS', 65),
(6, 'B.ARAB', 70),
(7, 'B.INDONESIA', 75),
(8, 'B.SUNDA', 60),
(9, 'TIK', 60),
(10, 'PAI', 75),
(11, 'SENBUD', 60);

-- --------------------------------------------------------

--
-- Table structure for table `mengajar`
--

CREATE TABLE IF NOT EXISTS `mengajar` (
  `kd` int(4) NOT NULL AUTO_INCREMENT,
  `nip` bigint(18) NOT NULL,
  `id_kelas` int(11) NOT NULL,
  PRIMARY KEY (`kd`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `mengajar`
--

INSERT INTO `mengajar` (`kd`, `nip`, `id_kelas`) VALUES
(1, 130682461, 1),
(2, 132097333, 1),
(3, 130682461, 2),
(4, 132097333, 2);

-- --------------------------------------------------------

--
-- Table structure for table `pengguna`
--

CREATE TABLE IF NOT EXISTS `pengguna` (
  `id_pengguna` int(18) NOT NULL AUTO_INCREMENT,
  `pengguna` varchar(18) NOT NULL,
  `password` varchar(32) NOT NULL,
  `level` varchar(12) NOT NULL,
  `status` varchar(12) NOT NULL,
  PRIMARY KEY (`id_pengguna`),
  UNIQUE KEY `pengguna` (`pengguna`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=68 ;

--
-- Dumping data for table `pengguna`
--

INSERT INTO `pengguna` (`id_pengguna`, `pengguna`, `password`, `level`, `status`) VALUES
(4, 'Super Admin', '21232f297a57a5a743894a0e4a801fc3', 'Super Admin', 'Aktif'),
(13, '130802921', '7fdf61d37c50f9d6d9d214395d1759bb', 'Guru', 'Aktif'),
(14, '130682461', '77e69c137812518e359196bb2f5e9bb9', 'Guru', 'Aktif'),
(15, '130902216', 'c75c18f3ae723d20af8aaa8215cd706d', 'Guru', 'Aktif'),
(16, '132121384', '3701ec8f7397f1fb028550ec7a352d39', 'Guru', 'Aktif'),
(17, '132087678', 'db3e53677b68bd7714a94bf3ea6bd863', 'Guru', 'Aktif'),
(18, '132087674', '080da190479ab43ab0bf4bbfcc130942', 'Guru', 'Aktif'),
(19, '132097399', '9ac76d173147a9480c2546e7d6c3a05f', 'Guru', 'Aktif'),
(20, '132097345', '1886b6c33c46282709ca01d365518791', 'Guru', 'Aktif'),
(21, '1320973567', 'f9ccf880e8798df788f4e7c89fa56855', 'Guru', 'Aktif'),
(22, '132097329', '388690cdb4433592c49a1248f8858fe3', 'Guru', 'Aktif'),
(30, '132097333', '5f0a22d8c46aa7492ffec6b9e9ec7b3a', 'Guru', 'Aktif'),
(31, '0001567930', '0923e9ff37bbcb8618c7c18cddf7c332', 'Siswa', 'Aktif'),
(32, '0001567931', '4114b314bb659050a630cb4c21dfa945', 'Siswa', 'Aktif'),
(33, '0001567932', '0581b3e1d943a6f25c135d64b42158aa', 'Siswa', 'Aktif'),
(34, '0001567933', '6fd66297e6459bb008a9a2be2245e5b7', 'Siswa', 'Aktif'),
(35, '0001567934', '4c1708fdfb8cfa31ce0bfd950153d5e5', 'Siswa', 'Aktif'),
(36, '0001567935', 'd7231c33592f2be5b168c66a6ab9bca0', 'Siswa', 'Aktif'),
(37, '0011124132', '71816da83e749f5bf4c008e0043a6520', 'Siswa', 'Aktif'),
(38, '0011124135', 'a9167b922de6e3fe1534b41b132960d5', 'Siswa', 'Aktif'),
(39, '0011124137', '86ef5de3bf869cd6e7b4a4a8ab95321a', 'Siswa', 'Aktif'),
(40, '0012005180', 'c1b21187f5fc3ee81ebf3a66bc10f72d', 'Siswa', 'Aktif'),
(41, '0012005181', '7fc2a38097c79de0e4fb0861cecbe161', 'Siswa', 'Aktif'),
(42, '0016013561', '2f811bb5eb969e91e769f9ebcdbe8463', 'Siswa', 'Aktif'),
(43, '0016013562', 'a0e08c86bce8c8448f4ecea27fd42e0a', 'Siswa', 'Aktif'),
(44, '0016013563', '6f0b595b6a166008931130fe8fbf7905', 'Siswa', 'Aktif'),
(45, '0016013564', '4ac2381929d3db0d4b4640e199dd0bf0', 'Siswa', 'Aktif'),
(46, '0016013565', '7040de9517311bba91ea4937468156e1', 'Siswa', 'Aktif'),
(47, '0016013567', '2aae2a9ff8ef191f0c3de502d6c8b810', 'Siswa', 'Aktif'),
(48, '0016013568', '832da7805f17835908fb9a501efead99', 'Siswa', 'Aktif'),
(49, '0016013569', 'eb6a3187377509c6e1860c366739dbc1', 'Siswa', 'Aktif'),
(50, '0016013570', '6bdfcf94c01e55f7a26f8013087be67e', 'Siswa', 'Aktif'),
(51, '0016014163', 'cf31bf12035c146044d503223d2fa245', 'Siswa', 'Aktif'),
(52, '0016014164', 'e000590c66bfacac129bff5d4160e636', 'Siswa', 'Aktif'),
(53, '0016014165', 'e5b643bb03f58e7c3b79c171f807711e', 'Siswa', 'Aktif'),
(54, '0016014166', '14cdc49de88dfb8cc391314c4800501c', 'Siswa', 'Aktif'),
(55, '0016014167', 'a706e937b55243828743c7caa708e3fb', 'Siswa', 'Aktif'),
(56, '0016014168', 'f13caa248a0f891bc6a88b790c12f021', 'Siswa', 'Aktif'),
(57, '0016014169', 'dc06d566c2e4d0da90f1f044de4a7e75', 'Siswa', 'Aktif'),
(58, '0016014170', 'eb6a3187377509c6e1860c366739dbc1', 'Siswa', 'Aktif'),
(59, '0016014171', '598675a278cf529b63f7485acec02b71', 'Siswa', 'Aktif'),
(60, '0016312166', 'dc06d566c2e4d0da90f1f044de4a7e75', 'Siswa', 'Aktif'),
(61, '0020889432', '7e2559d1989d9f3b4c0f800e64af1dc0', 'Siswa', 'Aktif'),
(62, '0022212746', '4460c7e039b137c09b475a6731646680', 'Siswa', 'Aktif'),
(63, '0022212747', '58beeb2d5f5307f01832fdf7b9e2365b', 'Siswa', 'Aktif'),
(64, '0022212748', '7e2559d1989d9f3b4c0f800e64af1dc0', 'Siswa', 'Aktif'),
(65, '0022212749', '2d61465d720e7f3af1205b2e9a06d56a', 'Siswa', 'Aktif'),
(66, '0022594378', 'ee84ab436fbcfc0d338b2eada43c8ea1', 'Siswa', 'Aktif'),
(67, '0030159648', '64ef00372bff70aac6242a79e6dfa0c7', 'Siswa', 'Aktif');

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE IF NOT EXISTS `siswa` (
  `nis` varchar(12) NOT NULL,
  `nama_siswa` varchar(64) NOT NULL,
  `jenkel` varchar(12) NOT NULL,
  `tmp_lahir` varchar(32) NOT NULL,
  `tgl_lahir` varchar(10) NOT NULL,
  `id_kelas` int(11) NOT NULL,
  PRIMARY KEY (`nis`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`nis`, `nama_siswa`, `jenkel`, `tmp_lahir`, `tgl_lahir`, `id_kelas`) VALUES
('0001567930', 'Wilda Aulia', 'Perempuan', 'Tasikmalaya', '21/01/2002', 1),
('0001567931', 'Egi Erdiansyah', 'Laki-laki', 'Tasikmalaya', '27/01/2002', 1),
('0001567932', 'Rian Maulana', 'Laki-laki', 'Tasikmalaya', '20/02/2002', 1),
('0001567933', 'Wida Widiyanti', 'Perempuan', 'Tasikmalaya', '01/01/2002', 1),
('0001567934', 'Sihab Muslim', 'Laki-laki', 'Tasikmalaya', '29/09/2000', 1),
('0001567935', 'Dina Lestari', 'Perempuan', 'Tasikmalaya', '11/12/2002', 1),
('0011124132', 'Fitri Yani', 'Perempuan', 'Tasikmalaya', '02/02/2001', 1),
('0011124135', 'Dewi Yulianti', 'Perempuan', 'Tasikmalaya', '04/08/2001', 1),
('0011124137', 'Mila Sadiatul Kamilah', 'Perempuan', 'Tasikmalaya', '13/09/2001', 1),
('0012005180', 'DEDE NURYADIN', 'Laki-laki', 'Tasikmalaya', '08/10/2001', 2),
('0012005181', 'WILDA JUWAIDATUL JANAH', 'Perempuan', 'Tasikmalaya', '18/11/2001', 2),
('0016013561', 'LINDA ST NURAJIZAH', 'Perempuan', 'Tasikmalaya', '17/02/2001', 2),
('0016013562', 'DADAN HINDANI', 'Laki-laki', 'Tasikmalaya', '09/07/2001', 2),
('0016013563', 'RIYAN', 'Laki-laki', 'Tasikmalaya', '12/07/2001', 2),
('0016013564', 'YANA', 'Laki-laki', 'Tasikmalaya', '12/09/2001', 2),
('0016013565', 'RISKA SULISTIANI', 'Perempuan', 'Tasikmalaya', '18/10/2001', 2),
('0016013567', 'RIDA NURSYPA ARPAH', 'Perempuan', 'Tasikmalaya', '25/10/2001', 2),
('0016013568', 'PIAN NOPIAN', 'Laki-laki', 'Tasikmalaya', '08/11/2001', 2),
('0016013569', 'MOH FAISAL', 'Laki-laki', 'Tasikmalaya', '17/12/2001', 2),
('0016013570', 'JUWITA RATNA WULAN', 'Perempuan', 'Tasikmalaya', '21/12/2001', 2),
('0016014163', 'Dita Amanda', 'Perempuan', 'Tasikmalaya', '06/06/2001', 1),
('0016014164', 'Sela Riani', 'Perempuan', 'Tasikmalaya', '09/06/2001', 1),
('0016014165', 'Ani Siti Hodijah', 'Perempuan', 'Tasikmalaya', '01/06/2001', 1),
('0016014166', 'Ina Liana', 'Perempuan', 'Tasikmalaya', '31/08/2001', 1),
('0016014167', 'Riski Mauris', 'Laki-laki', 'Tasikmalaya', '08/09/2001', 1),
('0016014168', 'Hesti Cahyani', 'Perempuan', 'Tasikmalaya', '26/11/2001', 1),
('0016014169', 'Sri Wulandari', 'Perempuan', 'Tasikmalaya', '12/12/2001', 1),
('0016014170', 'Indah Windy Khoerunisa', 'Perempuan', 'Tasikmalaya', '17/12/2001', 1),
('0016014171', 'Yosi Srianita', 'Perempuan', 'Tasikmalaya', '20/12/2000', 1),
('0016312166', 'MUHAMAD ARIF RAHMAN', 'Laki-laki', 'Tasikmalaya', '12/12/2001', 2),
('0020889432', 'ADE RESTI YULIANTI', 'Perempuan', 'Tasikmalaya', '17/08/2002', 2),
('0022212746', 'ANIS ST NURJAMILAH', 'Perempuan', 'Tasikmalaya', '7/03/2002', 2),
('0022212747', 'ALPIN', 'Laki-laki', 'Tasikmalaya', '27/07/2002', 2),
('0022212748', 'MOH IMAN GUMILANG', 'Laki-laki', 'Tasikmalaya', '17/08/2002', 2),
('0022212749', 'AI KHOPI NURAJIZAH', 'Perempuan', 'Tasikmalaya', '13/09/2002', 2),
('0022594378', 'SYIFA NURCAHYANI', 'Perempuan', 'Tasikmalaya', '15/08/2002', 2),
('0030159648', 'YANTO', 'Laki-laki', 'Tasikmalaya', '17/08/2003', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tes`
--

CREATE TABLE IF NOT EXISTS `tes` (
  `id_tes` int(11) NOT NULL AUTO_INCREMENT,
  `nama_tes` varchar(64) NOT NULL,
  `nip` bigint(18) NOT NULL,
  `jumlah_soal` int(3) NOT NULL,
  `waktu` int(2) NOT NULL,
  `status_tes` int(1) NOT NULL,
  PRIMARY KEY (`id_tes`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tes`
--

INSERT INTO `tes` (`id_tes`, `nama_tes`, `nip`, `jumlah_soal`, `waktu`, `status_tes`) VALUES
(1, 'Tes IPS', 130682461, 15, 30, 1),
(2, 'Tes IPA', 132097333, 10, 20, 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
