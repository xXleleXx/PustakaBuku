-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 14, 2024 at 02:39 AM
-- Server version: 8.0.30
-- PHP Version: 8.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kls_industri`
--

-- --------------------------------------------------------

--
-- Table structure for table `buku`
--

CREATE TABLE `buku` (
  `kategori_buku_id` int DEFAULT NULL,
  `id_buku` int NOT NULL,
  `judul` varchar(255) DEFAULT NULL,
  `penulis` varchar(255) DEFAULT NULL,
  `sinopsis` text,
  `image` varchar(8000) DEFAULT NULL,
  `tahun_terbit` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `buku`
--

INSERT INTO `buku` (`kategori_buku_id`, `id_buku`, `judul`, `penulis`, `sinopsis`, `image`, `tahun_terbit`) VALUES
(7, 15, 'Laskar Pelangi', 'Andrea Hirata', 'Kisah ini mengisahkan perjuangan sepuluh anak di Belitung yang menghadapi berbagai tantangan untuk mendapatkan pendidikan. Mereka adalah bagian dari sekolah Muhammadiyah yang sederhana dan penuh keterbatasan, namun memiliki semangat tinggi dalam belajar.', '670959c73abb1.jpg', '2005-09-05'),
(6, 16, 'JAGO Javascript', 'Raju Wandira', 'Buku mengenai pembelajaran bahasa pemograman javascript', '670957225f354.jpg', '2023-05-04'),
(7, 17, 'Bumi Manusia', 'Pramoedya Ananta Toer', 'Berlatar belakang pada masa kolonial Belanda, novel ini bercerita tentang kehidupan Minke, seorang pemuda pribumi yang cerdas dan berpikiran maju. Ia berjuang untuk memperjuangkan keadilan dan kemerdekaan dalam masyarakat yang penuh dengan ketidakadilan. Bumi Manusia menjadi bagian dari Tetralogi Pulau Buru, yang menggambarkan kompleksitas kehidupan di Indonesia pada masa itu.', '67095a4c44227.jpg', '1980-04-01'),
(7, 18, 'Orang-orang Proyek', 'Ahmad Tohari', 'Buku ini mengeksplorasi kehidupan orang-orang yang terlibat dalam proyek pembangunan di Indonesia, mengungkap berbagai praktik korupsi dan penyalahgunaan kekuasaan. Melalui tokoh utama yang idealis, Ahmad Tohari menggambarkan bagaimana seorang individu berusaha melawan sistem yang korup. Orang-orang Proyek adalah novel yang memberikan kritik sosial terhadap kondisi masyarakat Indonesia pada masa itu.', '67095ae411d56.jpg', '1985-05-10'),
(8, 19, 'Catatan Seorang Demonstran', 'Soe Hok Gie', 'Buku ini merupakan kumpulan catatan harian Soe Hok Gie, aktivis mahasiswa Indonesia yang berjuang untuk keadilan sosial di era 1960-an. Buku ini menjadi inspirasi bagi banyak generasi muda yang memperjuangkan keadilan dan kebenaran.', '67095c4b2e1b2.jpg', '1983-12-17'),
(6, 20, 'Pendidikan Sebagai Proses Emansipasi ', 'Ki Hadjar Dewantara', 'Buku ini menggali konsep pendidikan yang dibangun oleh Ki Hadjar Dewantara, tokoh pendidikan Indonesia. Beliau menekankan bahwa pendidikan harus mampu memberikan kemerdekaan bagi individu untuk berkembang sesuai dengan potensinya. Buku ini merupakan salah satu landasan penting dalam dunia pendidikan Indonesia, yang menekankan kemandirian, budaya, dan nilai-nilai kebangsaan dalam proses belajar', '67095e5062e56.jpg', '1922-05-02'),
(7, 21, 'Amba', 'Laksmi Pamuntjak', 'Amba adalah kisah cinta yang berlatar peristiwa bersejarah G30S di Indonesia. Novel ini mengisahkan seorang wanita bernama Amba yang mencari kekasihnya, Bhisma, seorang dokter yang dituduh komunis dan dibuang ke Pulau Buru. Melalui perjalanan Amba, pembaca diajak menyusuri sejarah, cinta, dan pengorbanan di tengah-tengah konflik politik Indonesia.', '67095f4638221.jpg', '2012-09-12'),
(7, 22, 'Pulang ', 'Leila S. Chudori', 'Pulang menceritakan kehidupan keluarga Indonesia yang terpaksa tinggal di Paris akibat pengasingan politik pasca-peristiwa 1965. Novel ini menggambarkan kesulitan yang dihadapi orang-orang buangan politik yang jauh dari tanah air, serta rasa rindu dan cinta mereka terhadap Indonesia. Pulang juga menyingkap isu tentang kebebasan, identitas, dan bagaimana politik memengaruhi kehidupan pribadi seseorang.', '67096177d786f.jpg', '2012-10-06');

-- --------------------------------------------------------

--
-- Table structure for table `kategori_buku`
--

CREATE TABLE `kategori_buku` (
  `kategori_buku_id` int NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `deskripsi` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `kategori_buku`
--

INSERT INTO `kategori_buku` (`kategori_buku_id`, `name`, `deskripsi`) VALUES
(1, 'Fantasi', 'Buku Fiktif'),
(2, 'Horor', 'Buku Seram'),
(6, 'Pendidikan', 'Buku untuk belajar'),
(7, 'Novel', 'Buku Novel'),
(8, 'Politik', 'Buku Mengenai Politik'),
(9, 'Fiksi', 'Buku Fiksi');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`id_buku`),
  ADD KEY `kategori_buku_id` (`kategori_buku_id`);

--
-- Indexes for table `kategori_buku`
--
ALTER TABLE `kategori_buku`
  ADD PRIMARY KEY (`kategori_buku_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `buku`
--
ALTER TABLE `buku`
  MODIFY `id_buku` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `kategori_buku`
--
ALTER TABLE `kategori_buku`
  MODIFY `kategori_buku_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `buku`
--
ALTER TABLE `buku`
  ADD CONSTRAINT `buku_ibfk_1` FOREIGN KEY (`kategori_buku_id`) REFERENCES `kategori_buku` (`kategori_buku_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
