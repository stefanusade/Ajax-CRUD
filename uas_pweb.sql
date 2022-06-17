-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 10, 2022 at 09:39 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.4.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `uas_pweb`
--

-- --------------------------------------------------------

--
-- Table structure for table `author`
--

CREATE TABLE `author` (
  `id_author` int(8) NOT NULL,
  `author` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `author`
--

INSERT INTO `author` (`id_author`, `author`) VALUES
(1, 'Tere Liye'),
(2, 'Sara Wijayanto'),
(3, 'Ria SW'),
(4, 'Ria Ricis'),
(5, 'Leila S. Chudori'),
(6, 'Ilana Tan'),
(7, 'Dee Lestari'),
(8, 'Andrea Hirata'),
(9, 'Pramoedya Ananta Toer');

-- --------------------------------------------------------

--
-- Table structure for table `buku`
--

CREATE TABLE `buku` (
  `id_buku` int(8) NOT NULL,
  `id_author` int(11) NOT NULL,
  `id_pub` int(11) NOT NULL,
  `id_genre` int(8) NOT NULL,
  `judul` varchar(225) NOT NULL,
  `sampul` varchar(225) NOT NULL,
  `harga` int(11) NOT NULL,
  `tahun` int(4) NOT NULL,
  `halaman` int(11) NOT NULL,
  `sinopsis` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `buku`
--

INSERT INTO `buku` (`id_buku`, `id_author`, `id_pub`, `id_genre`, `judul`, `harga`, `tahun`, `halaman`, `sinopsis`) VALUES
(1, 1, 1, 1, 'Si Putih', 99, 2021, 376, 'Kisah ini bermula dari Si Putih yang bukan merupakan hewan biasa. Si Putih merupakan hewan kuno yang lahir di peradaban panjang klan Polaris. Klan Polaris adalah klan yang kerap diserang oleh pandemi. Di sana terdapat puluhan miliar makhluk hidup yang mana pada ribuan tahun lalu sejarah menuliskan bahwa tidak sedikit penduduknya dapat berkomunikasi dengan hewan, bahkan dapat saling memahami dan itu merupakan kemampuan yang jarang ditemukan.'),
(2, 1, 1, 1, 'Lumpu', 99, 2021, 368, 'Yes! Akhirnya, Raib, Seli dan Ali kembali bertualang. Kalian sudah kangen dengan trio ini? Misi  mereka adalah menyelamatkan Miss Selena, guru matematika mereka. Tapi, apakah semua berjalan mudah? siapa yang bersedia membantu mereka? Kali ini, si genius Ali memutuskan meminta bantuan dari sosok yang tidak terduga, karena musuh dari musuh adalah teman.'),
(3, 1, 2, 2, 'Pulang-Pergi', 98, 2021, 417, '\"Ada jodoh yang ditemukan lewat tatapan pertama. Ada persahabatan yang diawali lewat sapa hangat. Bagaimana jika takdir bersama ternyata, diawali dengan pertarungan mematikan? Lantas semua cerita berkelindan dengan, pengejaran demi pengejaran mencari jawaban? Pulang-Pergi.\"'),
(4, 2, 3, 3, 'Wingit', 88, 2020, 256, 'Penelusuran di sebuah kompleks perumahan terbengkalai kawasan Jakarta Timur malam itu awalnya berjalan menyenangkan. Sebelum masuk ke area kompleks, saya bersama Wisnu, Fadi, dan Demian membuka vlog dengan gimmick seru untuk mencairkan suasana. Namun, setibanya di lokasi rumah tingkat yang dikelilingi pepohonan dan semak, saya melihat semakin banyak makhluk tak kasatmata yang membuat saya terkejut. Tidak jauh dari situ, saya merasakan kehadiran sosok hantu yang ingin berkomunikasi dengan saya.'),
(5, 3, 1, 1, 'Off The Record 3', 120, 2021, 312, 'Semua orang melihatku sebagai orang yang berhasil menggapai impian. Mereka pun menjadikanku sebagai panutan untuk menggapai impian mereka. Mungkin mereka benar karena secara kasatmata terlihat demikian. Sayangnya, semua yang mereka lihat dan kulakukan ini barulah sebuah permulaan. Kuharap setelah keadaan kembali pulih kita bisa memulai semuanya dari awal lagi. '),
(6, 4, 4, 4, 'Bukan Buku Nikah', 116, 2020, 220, 'Yang namanya perasaan, nggak bisa bohong. Apalagi, kalau sudah sayang. Mendapatkan hati kamu itu tidak mudah. Jadi, tidak mungkin kutinggalkan begitu saja. Aku hanya butuh waktu, hingga saatnya siap dengan kalimat, “Boleh, kah, aku menjadi pendamping dalam suka dan duka di hidupmu?”Rangga: Kenapa pria itu harus datang, saat perempuanku sudah nyaman? Nggak ada alasan untuk laki-laki yang meninggalkan ketika diminta kepastian. Perempuan itu bukan wahana permainan. Yang dengan gampang datang lalu ditinggalkan.'),
(7, 5, 5, 5, 'Laut Bercerita', 55, 2017, 389, 'Berkisah tentang perjuangan para mahasiswa dan aktivis yang menuntut hak-hak kemanusiaan kepada pemerintah Orde Baru. Di bawah tekanan dan bahaya, mereka pantang menyerah demi Indonesia yang lebih baik. Meski pada akhirnya mereka harus bersembunyi dalam pelarian dan akhirnya tertangkap lalu disiksa. Disekap di ruang bawah tanah, tidak tahu kapan mereka akan pulang. Beberapa dari mereka kembali menghirup udara bebas namun memiliki luka yang tak akan pernah sembuh. Sementara ketiga belas orang lainnya, hilang tak ada kabar. Inilah kisah tentang perjuangan, kehilangan, kekejian, cinta, dan harapan. Kawan-kawan, dengarkanlah kisah Biru Laut.'),
(8, 6, 1, 6, 'The Star and I', 89, 2021, 344, 'Ollie atau dikenal dengan Olivia Mitchell meniti karir sebagai aktor teater di Broadway. Sebenarnya, tujuannya ke New York tidak hanya semata-mata ingin mengeksplorasi bakatnya dan mewujudkan impiannya menjadi aktor profesional di Broadway. Ia memiliki misi pribadi yaitu mencari orang tua kandungnya. '),
(9, 7, 6, 1, 'Rapijali', 99, 2021, 368, 'Berkisah tentang kehidupan gadis yang memiliki bakat bermain musik yang istimewa yang diturunkan oleh kakeknya. Ping memiliki kehidupan yang sempurna, dengan orang-orang yang mencintainya. Ada Yuda Alexander, kakek Ping yang mantan anggota grup band ternama yang kini membentuk grup band baru bersama teman-teman dan cucu semata wayangnya. Ada Oding, anak laki-laki seumuran Ping yang sudah seperti saudara baginya. '),
(10, 8, 6, 1, 'Endensor', 55, 2017, 290, 'Menceritakan tentang seorang anak bernama Ikal yang tinggal di pelosok Melayu. Karena tersebut menerima warga pribumi yang paling cerdas. Pada novel ini menggunakan sudut pandang orang pertama pelaku kedua. Maksudnya yakni novel ini lebih banyak menceritakan tentang kehidupan Weh yakni teman dari ayahnya Ikal yang tinggal di perahu. Sebenarnya novel ini merupakan kelanjutan dari novel Laskar Pelangi.'),
(11, 8, 6, 1, 'Sang Pemimpi', 59, 2006, 292, 'Tentang masa SMA tiga orang pemuda, yaitu Ikal, Arai dan Jimbron. Mereka bertiga adalah remaja yang berasal dari Belitong dan melanjutkan sekolah di Manggar, SMA Negeri pertama di Manggar. Untuk mencukupi kebutuhan sekolahnya Arai, Ikal dan Jimbron bekerja paruh waktu sebagai kuli di pasar ikan.'),
(12, 8, 6, 4, 'Laskar Pelangi', 50, 2008, 534, 'Berkisahkan 10 orang anak yang tinggal di Belitung Timur, Desa Gantung Kabupaten Gantung. Kisah ini awalnya dimulai karena Depdikbud yang akan membubarkan sekolah Muhamamadiyah yang terancam akan dibubarkan jika tidak memiliki 10 murid. Saat itu kepala sekolah Pak Hafran mengumumkan jika jumlah muridnya tidak mencapai 10 orang maka Depdikbud akan membubarkan sekolah tersebut.'),
(13, 9, 7, 7, 'Bumi Manusia', 145, 1980, 535, 'Bumi Manusia menceritakan tentang kehidupan Minke, siswa HBS sekolah menengah atas dengan pengantar bahasa Belanda. Minke merupakan satu-satunya orang Indonesia di antara siswa Belanda. Sebagai keturunan priayi, ia mendapat kesempatan dari pemerintah kolonial untuk bersekolah di sana.'),
(14, 9, 7, 7, 'Anak Semua Bangsa', 132, 1980, 404, 'Novel Anak Semua Bangsa karya Pramoedya Ananta Toer menggambarkan penderitaan rakyat Jawa dibawah pemerintahan Belanda yang licik dan haus kekuasaan. Dari sudut pandang Minke, seorang penulis pribumi yang begitu mendewakan Eropa, kita dapat melihat kembali sejarah bangsa Indonesia, serta bercermin melihat diri sendiri'),
(15, 9, 8, 8, 'Jejak Langkah', 95, 2009, 724, 'Jejak Langkah mengisahkan benih-benih awal pergerakan nasional Indonesia. Melalui Minke, pembaca diperlihatkan proses lahir dan berkembangnya organisasi-organisasi generasi pertama pergerakan kaum pribumi di Hindia. Minke mengawali kisahnya dengan pengalaman-pengalamannya selama dengan belajar di Stovia');

-- --------------------------------------------------------

--
-- Table structure for table `genre`
--

CREATE TABLE `genre` (
  `id_genre` int(8) NOT NULL,
  `genre` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `genre`
--

INSERT INTO `genre` (`id_genre`, `genre`) VALUES
(1, 'Fiksi'),
(2, 'Aksi'),
(3, 'Horor'),
(4, 'Romance'),
(5, 'Sejarah'),
(6, 'Petualangan'),
(7, 'Drama'),
(8, 'Roman');

-- --------------------------------------------------------

--
-- Table structure for table `publisher`
--

CREATE TABLE `publisher` (
  `id_pub` int(8) NOT NULL,
  `pub` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `publisher`
--

INSERT INTO `publisher` (`id_pub`, `pub`) VALUES
(1, 'Gramedia Pustaka Utama'),
(2, 'Sabak Grip Nusantara'),
(3, 'Elex Media Komputindo'),
(4, 'Loveable'),
(5, 'Kepustakaan Populer Gramedia'),
(6, 'PT. Bentang Pustaka'),
(7, 'Hasta Mitra'),
(8, 'Lentera Dipantera');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `author`
--
ALTER TABLE `author`
  ADD PRIMARY KEY (`id_author`);

--
-- Indexes for table `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`id_buku`),
  ADD KEY `id_author` (`id_author`),
  ADD KEY `id_pub` (`id_pub`),
  ADD KEY `id_genre` (`id_genre`);

--
-- Indexes for table `genre`
--
ALTER TABLE `genre`
  ADD PRIMARY KEY (`id_genre`);

--
-- Indexes for table `publisher`
--
ALTER TABLE `publisher`
  ADD PRIMARY KEY (`id_pub`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `author`
--
ALTER TABLE `author`
  MODIFY `id_author` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `buku`
--
ALTER TABLE `buku`
  MODIFY `id_buku` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `genre`
--
ALTER TABLE `genre`
  MODIFY `id_genre` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `publisher`
--
ALTER TABLE `publisher`
  MODIFY `id_pub` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `buku`
--
ALTER TABLE `buku`
  ADD CONSTRAINT `buku_ibfk_1` FOREIGN KEY (`id_author`) REFERENCES `author` (`id_author`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `buku_ibfk_2` FOREIGN KEY (`id_pub`) REFERENCES `publisher` (`id_pub`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `buku_ibfk_3` FOREIGN KEY (`id_genre`) REFERENCES `genre` (`id_genre`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
