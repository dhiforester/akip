-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 28, 2025 at 05:45 PM
-- Server version: 5.7.31
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `akip`
--

-- --------------------------------------------------------

--
-- Table structure for table `akses`
--

DROP TABLE IF EXISTS `akses`;
CREATE TABLE IF NOT EXISTS `akses` (
  `id_akses` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `kontak` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL COMMENT 'hash',
  `akses` varchar(15) NOT NULL COMMENT 'Admin, Provinsi, Kabupaten, Inspektorat, OPD',
  `foto` char(40) DEFAULT NULL,
  `timestamp_creat` timestamp NOT NULL,
  PRIMARY KEY (`id_akses`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `akses`
--

INSERT INTO `akses` (`id_akses`, `nama`, `email`, `kontak`, `password`, `akses`, `foto`, `timestamp_creat`) VALUES
(1, 'Solihul Hadi', 'dhiforester@gmail.com', '089601154726', '$2y$10$HNk9u9EN0XpV3aTM2l7BJeaPHgoDDlRVBnSl.aB/sfRF.Jo1Q90TS', 'Admin', '6GLviBsKap3x75pc9feh9OiGkM2ikfSSebf.jpeg', '2025-02-01 12:07:53'),
(20, 'Dedeh Delawati', 'dedehdelawati@gmail.com', '089676857758', '$2y$10$Kwoeq19KmUfKpUEpGDOsBeRWtOLBBOqO06dOykId8fuFoNZViZ9/6', 'Inspektorat', 'H5rLr1C4zRgL7h3FnWriZ7rgzO7Pe2wqb2Q.png', '2025-02-16 17:14:36'),
(22, 'Nur Alifah', 'nuralifah@gmail.com', '0892282738', '$2y$10$bZvcaSpZcGsaC5irQxFKjOt9eC/tzf8SFnNTlcV3.qSM8HXezBEye', 'Admin', '8prGDkbOyAI8f7SKB2on8wVu9sxJT9UhyZz.jpeg', '2025-02-17 12:30:04'),
(23, 'Dewi Widiastuti', 'dewiwidastuti@gmail.com', '0987567464756', '$2y$10$plOjoNx8lXHfPF1X0MPP6uxhW.oCoCYzS4eFzR9RAl7KjKEPj0Y/q', 'Provinsi', 'FszFZWudYu2V33X8IaN8KNLzwinVNK0mBjz.jpeg', '2025-02-17 12:31:27'),
(24, 'Ayu Prisila', 'ayuprisila@gmail.com', '089536376', '$2y$10$r9ivq0HsSGpF3pwucRxd2euzqr34iROS/V5qTV30hWYSUVXUWQq5u', 'Kabupaten', '4l7G7vwvi82lC09nlRwuJmaygucayx25Vjc.png', '2025-02-17 12:37:00'),
(25, 'Windy Yanuariska', 'windygiga@gmail.com', '0891524236375', '$2y$10$VmXm0Tac8D1uvBrQ20UR3.ZC52sNl3qQyhwGQMtzvZYHm9FiTwUam', 'OPD', 'cK7ZQOjEVIh9Y7JjaXSNojbmTGxPgtuFQoE.jpeg', '2025-02-17 12:38:52'),
(27, 'Ani Maryani', 'aninuraeni12311@yahoo.com', '09883938737', 'aninuraeni12311', 'OPD', '', '2025-02-18 03:43:14'),
(28, 'Solihul Hadi', 'solihulhadi@gmail.com', '089778787878', '$2y$10$HNk9u9EN0XpV3aTM2l7BJeaPHgoDDlRVBnSl.aB/sfRF.Jo1Q90TS', 'Admin', NULL, '2025-02-01 14:51:17'),
(29, 'abc', 'abc@gmail.com', '0896607571776', '$2y$10$HzBMQopjt9IsBqS5buNt0.6XApqg2fCfCcnhYGOCvG/bE2oEwOut2', 'Admin', '', '2025-02-19 06:32:22'),
(30, 'iwan', 'aa@gmail.com', '081223538681', '$2y$10$tV6Akr4Ndgz6NCf80p8Sae1CehGVuiSvR.NuUO2/N/UlqN47XRXpu', 'Inspektorat', '', '2025-02-19 06:58:09');

-- --------------------------------------------------------

--
-- Table structure for table `akses_inspektorat`
--

DROP TABLE IF EXISTS `akses_inspektorat`;
CREATE TABLE IF NOT EXISTS `akses_inspektorat` (
  `id_akses_inspektorat` int(11) NOT NULL AUTO_INCREMENT,
  `id_akses` int(11) NOT NULL,
  `id_inspektorat` char(36) NOT NULL,
  PRIMARY KEY (`id_akses_inspektorat`),
  KEY `inspektorat_to_akses` (`id_akses`),
  KEY `akses_to_inspektorat` (`id_inspektorat`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `akses_inspektorat`
--

INSERT INTO `akses_inspektorat` (`id_akses_inspektorat`, `id_akses`, `id_inspektorat`) VALUES
(6, 20, 'sIZZCSiG06Akwh2qT79CycSUY9JZKWbBY24m'),
(7, 30, 'sIZZCSiG06Akwh2qT79CycSUY9JZKWbBY24m');

-- --------------------------------------------------------

--
-- Table structure for table `akses_kabupaten`
--

DROP TABLE IF EXISTS `akses_kabupaten`;
CREATE TABLE IF NOT EXISTS `akses_kabupaten` (
  `id_akses_kabupaten` int(11) NOT NULL AUTO_INCREMENT,
  `id_akses` int(11) NOT NULL,
  `id_provinsi` int(11) NOT NULL,
  `id_kabkot` int(11) NOT NULL,
  PRIMARY KEY (`id_akses_kabupaten`),
  KEY `id_akses` (`id_akses`),
  KEY `id_provinsi` (`id_provinsi`),
  KEY `id_kabkot` (`id_kabkot`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `akses_kabupaten`
--

INSERT INTO `akses_kabupaten` (`id_akses_kabupaten`, `id_akses`, `id_provinsi`, `id_kabkot`) VALUES
(1, 24, 90901, 90901);

-- --------------------------------------------------------

--
-- Table structure for table `akses_opd`
--

DROP TABLE IF EXISTS `akses_opd`;
CREATE TABLE IF NOT EXISTS `akses_opd` (
  `id_akses_opd` int(11) NOT NULL AUTO_INCREMENT,
  `id_akses` int(11) NOT NULL,
  `id_opd` int(11) NOT NULL,
  PRIMARY KEY (`id_akses_opd`),
  KEY `opd_to_akses` (`id_akses`),
  KEY `opd_to_opd` (`id_opd`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `akses_opd`
--

INSERT INTO `akses_opd` (`id_akses_opd`, `id_akses`, `id_opd`) VALUES
(2, 25, 6),
(4, 27, 6);

-- --------------------------------------------------------

--
-- Table structure for table `akses_provinsi`
--

DROP TABLE IF EXISTS `akses_provinsi`;
CREATE TABLE IF NOT EXISTS `akses_provinsi` (
  `id_akses_provinsi` int(11) NOT NULL AUTO_INCREMENT,
  `id_akses` int(11) NOT NULL,
  `id_provinsi` int(11) NOT NULL,
  PRIMARY KEY (`id_akses_provinsi`),
  KEY `akses_prov_to_akses` (`id_akses`),
  KEY `akses_prov_to_provinsi` (`id_provinsi`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `akses_provinsi`
--

INSERT INTO `akses_provinsi` (`id_akses_provinsi`, `id_akses`, `id_provinsi`) VALUES
(1, 23, 90901);

-- --------------------------------------------------------

--
-- Table structure for table `akses_token`
--

DROP TABLE IF EXISTS `akses_token`;
CREATE TABLE IF NOT EXISTS `akses_token` (
  `id_akses_token` int(11) NOT NULL AUTO_INCREMENT,
  `id_akses` int(11) NOT NULL,
  `akses_token` char(36) NOT NULL,
  `timestamp_creat` timestamp NOT NULL,
  `timestamp_expired` timestamp NOT NULL,
  PRIMARY KEY (`id_akses_token`),
  KEY `id_akses` (`id_akses`)
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `akses_token`
--

INSERT INTO `akses_token` (`id_akses_token`, `id_akses`, `akses_token`, `timestamp_creat`, `timestamp_expired`) VALUES
(49, 28, 'cYFt3Z5rE9zMgGUQmu9u3am46d5d9DVRpLC0', '2025-02-18 07:52:31', '2025-02-18 09:20:17'),
(52, 1, 'DUdXMgAYks2s3TQNWtSzywYJTWQJfhFENAhR', '2025-02-19 02:22:45', '2025-02-19 03:42:39'),
(58, 29, 'EE3JZDpo6bwlZh7X5VV0a8rxI1w4sPKpalMm', '2025-03-05 07:36:37', '2025-03-05 08:39:44');

-- --------------------------------------------------------

--
-- Table structure for table `captcha`
--

DROP TABLE IF EXISTS `captcha`;
CREATE TABLE IF NOT EXISTS `captcha` (
  `id_captcha` char(36) NOT NULL,
  `unique_code` char(5) NOT NULL,
  `timestamp_creat` timestamp NOT NULL,
  `timestamp_expired` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `captcha`
--

INSERT INTO `captcha` (`id_captcha`, `unique_code`, `timestamp_creat`, `timestamp_expired`) VALUES
('hpS7jtW2Kw0gAHxGvUeIQ40ifiwmn9teTrZz', 'X67U4', '2025-03-22 08:27:19', '2025-03-22 08:37:19');

-- --------------------------------------------------------

--
-- Table structure for table `evaluasi_periode`
--

DROP TABLE IF EXISTS `evaluasi_periode`;
CREATE TABLE IF NOT EXISTS `evaluasi_periode` (
  `id_evaluasi_periode` char(36) NOT NULL,
  `periode` varchar(20) NOT NULL,
  `date_mulai` date NOT NULL,
  `date_selesai` date NOT NULL,
  PRIMARY KEY (`id_evaluasi_periode`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `evaluasi_periode`
--

INSERT INTO `evaluasi_periode` (`id_evaluasi_periode`, `periode`, `date_mulai`, `date_selesai`) VALUES
('0Hlr9ya5eEHNHrtUJ7MZiapAPIg6zdbTcp5j', '2024', '2025-01-01', '2025-06-30'),
('C7tbl1fuYma0clwQs7CDlTYozQBGF4hJVLdv', '2025/1', '2025-02-01', '2025-02-28'),
('kma0qUa8iCeZV6NhFM2Ell9ss3VHca7u4Ofj', '2025/2', '2025-03-01', '2025-03-31');

-- --------------------------------------------------------

--
-- Table structure for table `help`
--

DROP TABLE IF EXISTS `help`;
CREATE TABLE IF NOT EXISTS `help` (
  `id_help` int(12) NOT NULL AUTO_INCREMENT,
  `author` varchar(50) NOT NULL,
  `judul` varchar(100) NOT NULL,
  `kategori` varchar(50) NOT NULL,
  `deskripsi` longtext NOT NULL,
  `datetime_creat` datetime NOT NULL,
  `datetime_update` datetime NOT NULL,
  `status` varchar(15) NOT NULL COMMENT 'Publish, Draft',
  PRIMARY KEY (`id_help`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `help`
--

INSERT INTO `help` (`id_help`, `author`, `judul`, `kategori`, `deskripsi`, `datetime_creat`, `datetime_update`, `status`) VALUES
(6, 'Solihul Hadi', 'Pengguna Akun Pertama Kali', 'Tentang Aplikasi', '&lt;p&gt;Akun akses aplikasi pertama kali dilakukan oleh super admin (pengembang aplikasi) yang sekaligus sebagai permulaan untuk membuat akun akses lainnya. Untuk pengguna yang akan melakukan akses pertama kali perlu mendapatkan akun akses dari admin primer. Sedangkan untuk pengguna aplikasi setelahnya dapat meminta akun akses dari pihak yang berwenang untuk membuatkan akses.&lt;/p&gt;\n&lt;p&gt;Dalam hal ini, penugasan seseorang untuk mengelola data akun akses setiap perusahaan atau organisasi akan berbeda-beda sesuai kebijakan yang berlaku. Namun, yang perlu diketahui bahawa pihak yang bisa menambahkan akses secara tidak langsung memegang sepenuhnya kredensial dari aplikasi ini. Oleh sebab itu, perlu hati-hati dalam penetapan seseorang dalam penugasan membuatkan akun akses. Hal ini karena pihak tersebut bisa mengontrol secara penuh aplikasi ini sesaui penjelasan tersebut di atas.&lt;/p&gt;\n&lt;p&gt;Setelah anda mendapatkan akun akses pada aplikasi, silahkan login dengan memasukan alamat email dan password. Setelah berhasil, silahkan ubah password bawaan anda melalui halaman profil yang ada di bagian pojok kanan atas aplikasi ini. Mengubah password untuk pertama kali bertujuan untuk menjadikan akun anda sebagai entitas yang bebas. Sehingga hanya anda secara pribadi yang bisa mengelola aplikasi tanpa terikat.&lt;/p&gt;', '2024-11-24 01:58:47', '2024-11-24 01:59:35', 'Publish'),
(7, 'Solihul Hadi', 'Pengaturan Website Pertama Kali', 'Pengaturan', '&lt;p&gt;Website dapat terhubung dari &lt;em&gt;web server&lt;/em&gt; manapun menuju admin page menggunakan pengaturan dinamis yang sudah ditetapkan. Dalam hal ini, pengaturan website tersebut terdiri dari url server, user key server dan password server. Oleh sebab itu, perlu diperhatikan ketiga pengaturan tersebut pada saat anda melakukan instalasi website agar dapat berjalan dengan benar. Adapun tahapan pengaturan tersebut sebagai berikut:&lt;/p&gt;\n&lt;p&gt;1. Buka script php yang ada pada directory _Config/Connection.php&lt;/p&gt;\n&lt;p&gt;2. Tambahkan script berikut ini :&lt;/p&gt;\n&lt;div style=&quot;color: #cccccc; background-color: #1f1f1f; font-family: Consolas, \'Courier New\', monospace; font-weight: normal; font-size: 14px; line-height: 19px; white-space: pre;&quot;&gt;\n&lt;div&gt;&lt;span style=&quot;color: #569cd6;&quot;&gt;&amp;lt;?php&lt;/span&gt;&lt;/div&gt;\n&lt;div&gt;&lt;span style=&quot;color: #d4d4d4;&quot;&gt;&amp;nbsp; &amp;nbsp; &lt;/span&gt;&lt;span style=&quot;color: #6a9955;&quot;&gt;//Berikut Ini Variabel Penting Untuk Dapat Mengakses Service API&lt;/span&gt;&lt;/div&gt;\n&lt;div&gt;&lt;span style=&quot;color: #d4d4d4;&quot;&gt;&amp;nbsp; &amp;nbsp; &lt;/span&gt;&lt;span style=&quot;color: #9cdcfe;&quot;&gt;$url_server&lt;/span&gt;&lt;span style=&quot;color: #d4d4d4;&quot;&gt;=&lt;/span&gt;&lt;span style=&quot;color: #ce9178;&quot;&gt;&quot;http://localhost:81/runners_event_pro/admin.kuninganrunners.com&quot;&lt;/span&gt;&lt;span style=&quot;color: #d4d4d4;&quot;&gt;;&lt;/span&gt;&lt;/div&gt;\n&lt;div&gt;&lt;span style=&quot;color: #d4d4d4;&quot;&gt;&amp;nbsp; &amp;nbsp; &lt;/span&gt;&lt;span style=&quot;color: #9cdcfe;&quot;&gt;$user_key_server&lt;/span&gt;&lt;span style=&quot;color: #d4d4d4;&quot;&gt;=&lt;/span&gt;&lt;span style=&quot;color: #ce9178;&quot;&gt;&quot;XeK9am6QLhZSLfapsJmgR16C9WN3nueAWJTL&quot;&lt;/span&gt;&lt;span style=&quot;color: #d4d4d4;&quot;&gt;;&lt;/span&gt;&lt;/div&gt;\n&lt;div&gt;&lt;span style=&quot;color: #d4d4d4;&quot;&gt;&amp;nbsp; &amp;nbsp; &lt;/span&gt;&lt;span style=&quot;color: #9cdcfe;&quot;&gt;$password_server&lt;/span&gt;&lt;span style=&quot;color: #d4d4d4;&quot;&gt;=&lt;/span&gt;&lt;span style=&quot;color: #ce9178;&quot;&gt;&quot;e1SqNhaJMRs1c4JC3n1M&quot;&lt;/span&gt;&lt;span style=&quot;color: #d4d4d4;&quot;&gt;;&lt;/span&gt;&lt;/div&gt;\n&lt;div&gt;&lt;span style=&quot;color: #569cd6;&quot;&gt;?&lt;/span&gt;&lt;span style=&quot;color: #569cd6;&quot;&gt;&amp;gt;&lt;/span&gt;&lt;/div&gt;\n&lt;/div&gt;\n&lt;p&gt;3. Keterangan pengaturan :&lt;/p&gt;\n&lt;ul&gt;\n&lt;li&gt;&lt;code&gt;url_server &lt;/code&gt;: Diisi dengan base url admin page.&lt;/li&gt;\n&lt;li&gt;&lt;code&gt;user_key_server &lt;/code&gt;: Diisi dengan user key yang diperoleh dari admin aplikasi pada saat membuat kredensial.&lt;/li&gt;\n&lt;li&gt;&lt;code&gt;password_server &lt;/code&gt;: Diisi dengan password server yang juga diperoleh dari admin pada saat membuat kredensial.&lt;/li&gt;\n&lt;/ul&gt;\n&lt;p&gt;4. Simpan pengaturan kemudian mulai uji coba koneksi dengan mereload halaman website.&lt;/p&gt;\n&lt;p&gt;Untuk memastikan semua service dan konten berjalan dengan baik, buka halaman website satu per satu.&lt;/p&gt;\n&lt;p&gt;&amp;nbsp;&lt;/p&gt;', '2024-11-29 01:10:50', '2024-11-30 23:33:45', 'Publish'),
(8, 'Solihul Hadi', 'Arsitektur Aplikasi', 'Tentang Aplikasi', '&lt;p&gt;Aplikasi Runner Event Pro dirancang untuk memudahkan penyelenggaraan event lari, mulai dari tahap persiapan hingga pelaksanaan. Dengan fitur-fitur lengkap dan user-friendly, aplikasi ini menjadi alat andalan untuk memastikan kelancaran acara lari. Berikut adalah arsitektur aplikasi secara umum yang dikembangkan untuk menangani berbagai proses.&lt;/p&gt;\n&lt;p&gt;&lt;img style=&quot;display: block; margin-left: auto; margin-right: auto;&quot; src=&quot;assets/img/Help/0923727458c84e30.png&quot; alt=&quot;&quot; width=&quot;60%&quot; /&gt;Fungsi utama dari aplikasi ini terdiri dari pengelolaan informasi event, pengelolaan data peserta, pendaftaran dan proses pembayaran. Masing-masing modul berkomunikasi dengan kredensial yang dikelola pada halaman admin page.&lt;/p&gt;\n&lt;p&gt;&amp;nbsp;&lt;/p&gt;', '2024-11-30 22:49:33', '2024-11-30 23:33:07', 'Publish'),
(10, 'Solihul Hadi', 'Kelola Fitur Pada Aplikasi', 'Akun Dan Akses', '&lt;p&gt;&lt;img src=&quot;assets/img/Help/806c36645509d531.png&quot; alt=&quot;&quot; width=&quot;100%&quot; /&gt;&lt;/p&gt;\n&lt;p&gt;Setiap ijin akses pada halaman yang ada pada aplikasi, didasarkan pada referensi fitur yang terdaftar pada database. Untuk mempermudah admin dan pengembang melakukan maping dalam setiap ijin akses yang diberikan maka perlu adanya referensi fitur tersebut. Untuk lebih jelas, berikut ini adalah panduan penggunaan halaman fitur aplikasi yang bisa anda lakukan.&lt;/p&gt;\n&lt;p&gt;&lt;strong&gt;A. Menambah Referensi Fitur Aplikasi&lt;/strong&gt;&lt;/p&gt;\n&lt;p&gt;Berikut ini tahapan untuk menambah referensi fitur aplikasi :&lt;/p&gt;\n&lt;ol&gt;\n&lt;li&gt;Pilih menu \'akses\' kemudian pilih \'Fitur Aplikasi\'.&lt;/li&gt;\n&lt;li&gt;Pada halaman utama, pilit tombol \'Tambah\', kemudian sistem akan menampilkan form tambah fitur.&lt;/li&gt;\n&lt;li&gt;Isi form nama fitur dengan nama fitur yang ingin diberikan akses, isi juga kategori fitur untuk mempermudah pengelompokan.&lt;/li&gt;\n&lt;li&gt;Kode fitur dapat diisi dengan kode unik, pada form ini anda bisa melakukan generate secara otomatis menggunakan tombol yang tersedia.&lt;/li&gt;\n&lt;li&gt;Isi keterangan dengan informasi deskripsi dan fungsi dari fitur tersebut.&lt;/li&gt;\n&lt;li&gt;Terakhir pilih tombol \'Simpan\' jika berhasil sistem akan menampilkan notifikasi proses berhasil.&lt;/li&gt;\n&lt;/ol&gt;\n&lt;p&gt;&lt;strong&gt;B. Melakukan Filter Data&lt;br /&gt;&lt;/strong&gt;&lt;/p&gt;\n&lt;p&gt;Untuk mempermudah developer untuk mengelola data referensi fitur aplikasi maka disediakan filter yang berfungsi untuk melakukan shorting data, membatasi jumlah baris data yang ditampilkan, melakukan pencarian, serta merubah mode pengurutan data. Cara penggunaannya dapat dilakukan dengan memilih tombol \'Filter\' pada bagian atas halaman utama referensi fitur aplikasi kemudian sistem akan menampilkan form filter tersebut. Berikut ini adalah beberapa fungsi form yang tersedia.&lt;/p&gt;\n&lt;ol&gt;\n&lt;li&gt;Batas/Limit : Berfungsi untuk membatasi jumlah baris data yang ditampilkan pada setiap halaman.&lt;/li&gt;\n&lt;li&gt;Dasar Pengurutan : Adalah nama kolom yang akan menjadi dasar pengurutan.&lt;/li&gt;\n&lt;li&gt;Tipe Urutan : Adalah bentuk urutan baik itu secara ascending (A to Z) maupun descanding (Z to A)&lt;/li&gt;\n&lt;li&gt;Dasar Pencarian : Adalah acuan pencarian untuk melakukan pencarian secara spesifik pada kolom tertentu.&lt;/li&gt;\n&lt;li&gt;Kata Kunci : Adalah karakter yang akan dijadikan kunci pencarian.&lt;/li&gt;\n&lt;/ol&gt;\n&lt;p&gt;&lt;strong&gt;C. Edit/Ubah Referensi Referensi&amp;nbsp; Fitur Aplikasi&lt;/strong&gt;&lt;/p&gt;\n&lt;p&gt;Untuk melakukan perubahan pada konten referensi fitur, anda dapat melakukannya dengan cara memilih tombol opsi pada bagian atas salah satu item data atau tanda titik tiga. Selanjutnya ada beberapa pilihan yang bisa dipilih. Anda tinggal memilih opsi \'Edit Fitur\' dan sistem akan menampilkan popup konfirmasi perubahan. Langkah selanjutnya pilih pada tombol \'Lanjutkan\' dan sistem akan mengarahkan anda ke halaman form edit referensi fitu.&lt;/p&gt;\n&lt;p&gt;Silahkan lakukan perubahan yang ingin anda lakukan, diakhiri dengan memilih tombol simpan. Apabila proses berhasil, sistem akan menampilkan pemberitahuan berhasil.&lt;/p&gt;\n&lt;p&gt;&lt;strong&gt;D. Hapus Data Referensi Fitur Aplikasi&lt;/strong&gt;&lt;/p&gt;\n&lt;p&gt;Hal yang sama bisa anda lakukan untuk proses menghapus data referensi fitur. Pilih opsi (titik tiga) pada bagian atas salah satu item data kemudian pilih menu \'Hapus\'. Sistem akan menampilkan popup konfirmasi proses hapus data, selanjutnya anda tinggal melanjutkan dengan mengkonfirmasinya. Jika berhasil sistem akan menampilkan pemberitahuan dan data terhapus dari baris referensi.&lt;/p&gt;\n&lt;p&gt;&amp;nbsp;&lt;/p&gt;\n&lt;div class=&quot;alert alert-danger alert-dismissible fade show&quot; role=&quot;alert&quot;&gt;&lt;strong&gt;Perlu diketahui&lt;/strong&gt;&lt;br /&gt;Melakukan perubahan pada data referensi fitur akan menyebabkan perubahan aturan ijin akses.&lt;/div&gt;', '2024-12-01 03:16:53', '2024-12-01 18:25:51', 'Publish'),
(14, 'Solihul Hadi', 'Entitias atau Level Akses', 'Akun Dan Akses', '&lt;p&gt;&lt;img src=&quot;assets/img/Help/d246d7f2549de4a3.png&quot; alt=&quot;&quot; width=&quot;100%&quot; /&gt;&lt;/p&gt;\n&lt;p&gt;Entitias atau level akses adalah sebuah label group akses yang menentukan aturan standar ijin akses pengguna pada sebuah fitur aplikasi. Informasi ini juga dapat direperesentasikan sebagai aturan tugas masing-masing pengguna berdasarkan group tertentu. Adapun kegunaan dari informasi ini adalah untuk mempermudah admin aplikasi dalam menentukan aturan ijin akses, sehingga ketika menentukan tugas dan hak pengguna bisa berdasarkan group tertentu yang sudah diatur sebelumnya.&lt;/p&gt;\n&lt;p&gt;Halaman entitas/level dapat di akses melalui menu kiri pada bagian menu \'Akses\' kemudian pilih sub menu \'Entitas\'. Untuk lebih jelasnya mengenai penggunaan fitur ini daapt dilihat pada uraian berikut :&lt;/p&gt;\n&lt;p&gt;&lt;strong&gt;A. Menambahkan Entitas Akses&lt;/strong&gt;&lt;/p&gt;\n&lt;p&gt;Menambahkan entitias akses dapat dilakukan dengan tahapan sebagai berikut :&lt;/p&gt;\n&lt;ol&gt;\n&lt;li&gt;Setelah anda masuk ke halaman utama kelola data entitas/level, pilih tombol \'Tambah\' pada bagian atas halaman.&lt;/li&gt;\n&lt;li&gt;Isi nama entitias dengan nama entitias yang anda inginkan, keterangan dengan penjelasan singkat apa saja tugas adan hak entitas tersebut dan isi pada bagian ijin akses.&lt;/li&gt;\n&lt;li&gt;Beri tanda checklist pada list fitur yang mungkin dapat diakses oleh entitias tersebut.&lt;/li&gt;\n&lt;li&gt;Jika sudah yakin dengan data yang anda input, kemudian pilih tombol \'Simpan\'.&lt;/li&gt;\n&lt;li&gt;Apabila berhasil maka sistem akan menampilkan pemberitahuan berhasil.&lt;/li&gt;\n&lt;/ol&gt;\n&lt;p&gt;&lt;strong&gt;B. Mengubah Entitias Akses&lt;/strong&gt;&lt;/p&gt;\n&lt;p&gt;Untuk mengubah entitas akses dapat dilakukan dengan tahapan berikut :&lt;/p&gt;\n&lt;ol&gt;\n&lt;li&gt;Pada halaman utama data entitas akses, pilih salah satu item data yang ingin anda rubah kemudian pilih opsi.&lt;/li&gt;\n&lt;li&gt;Tombol opsi berada pada pojok kanan atas item entitias tersebut dengan tanda titik tiga.&lt;/li&gt;\n&lt;li&gt;Pilih menu Edit/Ubah, kemudian isi perubahan anda pada form yang tersedia.&lt;/li&gt;\n&lt;li&gt;Jika sudah klik simpan dan sistem akan menyimpan perubahan anda.&lt;/li&gt;\n&lt;li&gt;Jika berhasil akan muncul notifikasi pemberitahuan berhasil.&lt;/li&gt;\n&lt;/ol&gt;\n&lt;p&gt;&lt;strong&gt;C. Menghapus Entitias Akses&lt;/strong&gt;&lt;/p&gt;\n&lt;p&gt;Sebelum anda menghapus data entitas akses, perlu anda ketahui bahwa menghapus data tersebut akan menyebabkan semua pengguna yang terhubung dengan entitas tersebut tidak akan bisa mengakses aplikasi sebagaimana mestinya. Berikut ini tahapan untuk menghapus data entitas/level akses tersebut :&lt;/p&gt;\n&lt;ol&gt;\n&lt;li&gt;Seperti tahapan edit sebelumnya, pilih salah satu item data dan klik pada titik tiga di pojok kanan atas.&lt;/li&gt;\n&lt;li&gt;Pilih menu \'Hapus\' dan sistem akan menampilkan popup konfirmasi hapus data.&lt;/li&gt;\n&lt;li&gt;Jika yakin ingin menghapus data tersebut maka klik pada tombol \'Ya, Hapus\'.&lt;/li&gt;\n&lt;li&gt;Jika berhasil maka sistem akan menampilkan notifikasi berhasil&lt;/li&gt;\n&lt;/ol&gt;', '2024-12-01 18:37:55', '2024-12-01 20:03:03', 'Publish'),
(15, 'Solihul Hadi', 'Kelola Akun Akses Pengguna', 'Akun Dan Akses', '&lt;p&gt;&lt;img src=&quot;assets/img/Help/795b6ad988f14adb.png&quot; alt=&quot;&quot; width=&quot;100%&quot; /&gt;&lt;/p&gt;\n&lt;p&gt;Akun akses pengguna adalah halaman yang berfungsi untuk mengelola semua akun akses pada aplikasi. Pengguna pada aplikasi ini sepenuhnya dikelola oleh admin yang memiliki hak dan kewenangan mengelola akun tersebut. Untuk dapat menggunakan fitur ini, anda dapat melakukannya dengan cara memilih menu \'Akses\' pada bagian kiri halaman, kemudian pilih sub menu \'Akun Akses\'. Untuk lebih lengkapnya, berikut ini adalah tahap-tahap penggunaan fitur kelola akun akses pengguna.&lt;/p&gt;\n&lt;p&gt;&lt;strong&gt;A. Tambah Akun Akses&lt;/strong&gt;&lt;/p&gt;\n&lt;p&gt;Berikut ini tahap-tahap untuk menambah data akun akses :&lt;/p&gt;\n&lt;ul&gt;\n&lt;li&gt;Pada halaman utama fitur akses pilih tombol \'Tambah\' kemudian sistem akan menampilkan form yang dapat anda isi sesuai keinginan.&lt;/li&gt;\n&lt;li&gt;Form nama diisi dengan nama pengguna, kontak dengan nomor kontak HP pengguna, email kemudian akses entitias diisi dengan nama entitias yang sudah tersedia.&lt;/li&gt;\n&lt;li&gt;Silahkan masukan password yang nantinya akan digunakan oleh pengguna aplikasi untuk melakukan login.&lt;/li&gt;\n&lt;li&gt;Jika semua form sudah terisi, terakhir klik pada tombol \'Simpan\'.&lt;/li&gt;\n&lt;li&gt;Jika berhasil maka sistem akan menampilkan notifikasi berhasil.&lt;/li&gt;\n&lt;/ul&gt;\n&lt;p&gt;&lt;strong&gt;B. Ubah Akun Akses&lt;/strong&gt;&lt;/p&gt;\n&lt;p&gt;Anda dapat melakukan perubahan pada akun akses. Berikut ini tahapan-tahapan yang bisa anda lakukan :&lt;/p&gt;\n&lt;ol&gt;\n&lt;li&gt;Pada masing-masing item data akses, pilih opsi dengan gambar titik tiga dibagian pojok kanan atas item data akses tersebut.&lt;/li&gt;\n&lt;li&gt;Untuk melakukan perubahan informasi dasar pengguna, pilih menu \'Ubah Info\'.&lt;/li&gt;\n&lt;li&gt;Untuk melakukan perubahan foto profil pengguna, pilih \'Ubah Foto\'.&lt;/li&gt;\n&lt;li&gt;Untuk melakukan perubahan pada ijin akses, pilih menu \'Ijin Akses\'.&lt;/li&gt;\n&lt;li&gt;Dan untuk melakukan perubahan pada password, pilih \'Ubah Password\'.&lt;/li&gt;\n&lt;li&gt;Pada masing-masing menu opsi yang tersedia akan muncul form yang sesuai dengan tujuan perubahan tersebut.&lt;/li&gt;\n&lt;li&gt;Jika sudah yakin dengan perubahan yang anda lakukan, pilih tombol \'Simpan\'&lt;/li&gt;\n&lt;li&gt;Apabila proses berhasil maka sistem akan menampilkan pemberitahuan berhasil.&lt;/li&gt;\n&lt;/ol&gt;\n&lt;p&gt;&lt;strong&gt;C. Hapus Akun Akses&lt;/strong&gt;&lt;/p&gt;\n&lt;p&gt;Perlu anda ketahui bahwa menghapus data akses akan menyebabkan pemilik akun tidak bisa lagi melakukan akses login ke dalam aplikasi. Berikut ini tahap-tahap yang bisa anda lakukan untuk menghapus data akses tersebut :&lt;/p&gt;\n&lt;ol&gt;\n&lt;li&gt;Pada item data akses yang akan dihapus, pilih tombol opsi dengan gambar titik tiga pada bagian pojok kanan atas.&lt;/li&gt;\n&lt;li&gt;Pilih menu \'Hapus\' kemdudian sistem akan menampilkan popup konfirmasi penghapusan data.&lt;/li&gt;\n&lt;li&gt;Jika anda setuju pilih tombol \'Ya, Hapus\'&lt;/li&gt;\n&lt;li&gt;Apabila proses berhasil maka sistem akan menampilkan notifikasi berhasil.&lt;/li&gt;\n&lt;/ol&gt;\n&lt;p&gt;&lt;strong&gt;D. Atur Ijin Akses Pengguna Secara Manual&lt;/strong&gt;&lt;/p&gt;\n&lt;p&gt;Anda bisa melakukan perubahan pada ijin akses akun tertentu secara spontan. Proses ini bertujuan jika dalam waktu tertentu anda ingin melakukan perubahan pada ijin akses seseorang pengguna aplikasi. Lebih jelas berikut tahapan-tahapan yang bisa anda lakukan :&lt;/p&gt;\n&lt;ol&gt;\n&lt;li&gt;Pada item data akses pilih opsi dan pilih menu \'Ijin Akses\'.&lt;/li&gt;\n&lt;li&gt;Berikan tanda checklist pada fitur yang diijinkan dapat diakses oleh pengguna tersebut.&lt;/li&gt;\n&lt;li&gt;Jika sudah klik pada tombol \'Simpan\'&lt;/li&gt;\n&lt;li&gt;Apabila proses berhasil maka sistem akan menampilkan notifikasi berhasil.&lt;/li&gt;\n&lt;/ol&gt;', '2024-12-01 20:07:07', '2024-12-01 21:19:25', 'Publish'),
(16, 'Solihul Hadi', 'Halaman Profil Pengguna', 'Profil', '&lt;p&gt;&lt;img src=&quot;assets/img/Help/a172b186669f87f3.png&quot; alt=&quot;&quot; width=&quot;100%&quot; /&gt;&lt;/p&gt;\n&lt;p&gt;Halaman profil berfungsi untuk menampilkan informasi pengguna yang login pada saat itu. Halaman profil menampilkan beberapa informasi yang terdiri dari foto pengguna, nama, email, kontak, nama entitias akses, waktu terakhr kali melaukan update dan informasi fitur apa saja yang bisa diakses oleh yang bersangkutan. Selain itu pada tab yang berbeda, pengguna dapat melakukan monitoring terhadap aktifitas yang dilakukannya pada halaman \'Aktivitas\'. Setiap pengguna juga diberikan ijin untuk melakukan perubahan pada data profil akses masing-masing, baik itu merubah foto, password, atau informasi identitias pribadinya.&lt;/p&gt;\n&lt;p&gt;Berikut ini beberapa fungsi dari tombol/fitur yang ada pada halaman tersebut :&lt;/p&gt;\n&lt;ol&gt;\n&lt;li&gt;&lt;strong&gt;Ubah Foto : &lt;/strong&gt;Berfungsi untuk mengubah foto profil anda.&lt;/li&gt;\n&lt;li&gt;&lt;strong&gt;Ubah Profil :&lt;/strong&gt; Berfungsi untuk mengubah informasi identitias pengguna/akun anda.&lt;/li&gt;\n&lt;li&gt;&lt;strong&gt;Ubah Password :&lt;/strong&gt; Berfungsi untuk mengubah password akun anda ketika login.&lt;/li&gt;\n&lt;li&gt;&lt;strong&gt;Tab Rules :&lt;/strong&gt; Berisikan informasi fitur yang bisa anda akses.&lt;/li&gt;\n&lt;li&gt;&lt;strong&gt;Tab Aktivitas :&lt;/strong&gt; Berisikan informasi mengenai catatan aktivitas yang anda lakukan.&lt;/li&gt;\n&lt;/ol&gt;', '2024-12-01 21:27:09', '2024-12-01 22:12:28', 'Publish'),
(17, 'Solihul Hadi', 'Mengubah Foto Profil', 'Profil', '&lt;p&gt;&lt;img src=&quot;_Page/PostAcceptor/../../assets/img/Help/bdd08919f267c486.png&quot; alt=&quot;&quot; width=&quot;100%&quot; /&gt;&lt;/p&gt;\n&lt;p&gt;Setiap pengguna dapat mengubah foto profilnya masing-masing sesuai keinginan. Foto profil ini akan ditampilkan pada bagian atas kanan setiap pengguna setelah melakukan login ke dalam aplikasi. Berikut ini adalah tahap-tahap untuk melakukan perubahan pada foto profil pengguna :&lt;/p&gt;\n&lt;ol&gt;\n&lt;li&gt;Masuk ke halaman profil dengan memilih menu kanan atas yang bergambar foto profil pengguna.&lt;/li&gt;\n&lt;li&gt;Pilih Sub menu profil saya, maka sistem akan mengarahkan anda ke halaman profil anda.&lt;/li&gt;\n&lt;li&gt;Pada halaman utama profil ini, ada beberapa tombol fitur yang bisa anda gunakan. Selanjutnya cari tombol \'Ubah Foto\'.&lt;/li&gt;\n&lt;li&gt;Sistem akan menampilkan form upload file foto. Silahkan pilih foto yang ingin anda gunakan untuk mengganti foto profil lama anda.&lt;/li&gt;\n&lt;li&gt;Pastikan foto profil yang anda gunakan tidak lebih dari 2 mb.&lt;/li&gt;\n&lt;li&gt;Tipe file yang diperbolehkan untuk digunakan diantaranya adalah JPG, JPEG, PNG dan GIF.&lt;/li&gt;\n&lt;li&gt;Jika sudah, pilih tombol \'Simpan\'.&lt;/li&gt;\n&lt;li&gt;Sistem akan melakukan pembaharuan data anda, apabila berhasil maka sistem akan menampilkan notifikasi berhasil.&lt;/li&gt;\n&lt;/ol&gt;\n&lt;p&gt;&amp;nbsp;&lt;/p&gt;', '2024-12-01 22:08:59', '2024-12-01 22:08:59', 'Publish'),
(18, 'Solihul Hadi', 'Ubah Profil (Identitas) Pengguna', 'Profil', '&lt;p&gt;&lt;img src=&quot;_Page/PostAcceptor/../../assets/img/Help/ab3ac3dba8b4e94a.png&quot; alt=&quot;&quot; width=&quot;100%&quot; /&gt;&lt;/p&gt;\n&lt;p&gt;Pada halaman profil, anda juga bisa melakukan perubahan pada informasi pribadi anda yang terdiri dari nama, email dan kontak. Untuk melakukan perubahan pada informasi identitas anda tersebut dapat dilakukan dengan tahap-tahap berikut ini :&lt;/p&gt;\n&lt;ol&gt;\n&lt;li&gt;Masuk ke halaman profil, dengan memilih menu pada pojok kanan atas aplikasi yang bergambar foto profil anda.&lt;/li&gt;\n&lt;li&gt;Pilih Sub Menu \'Profil Saya\', kemudian anda akan diarahkan pada halaman utama profil.&lt;/li&gt;\n&lt;li&gt;Cari tombol \'Ubah Profil\' dan sistem akan menampilkan form ubah profil yang terdiri dari form input nama lengkap, alamat email dan kontak.&lt;/li&gt;\n&lt;li&gt;Silahkan isi perubahan data yang anda inginkan.&lt;/li&gt;\n&lt;li&gt;Jika sudah, klik pada tombol \'Simpan\'.&lt;/li&gt;\n&lt;li&gt;Jika berhasil maka sistem akan menampilkan notifikasi berhasil.&lt;/li&gt;\n&lt;/ol&gt;', '2024-12-01 22:17:51', '2024-12-01 22:17:51', 'Publish'),
(19, 'Solihul Hadi', 'Ubah Password', 'Profil', '&lt;p&gt;&lt;img src=&quot;_Page/PostAcceptor/../../assets/img/Help/73dc6241714505e0.png&quot; alt=&quot;&quot; width=&quot;100%&quot; /&gt;&lt;/p&gt;\n&lt;p&gt;Setelah anda mendapatkan akun akses pertama kali dari admin yang berwenang, hal pertama yang perlu anda lakukan adalah mengubah password. Fungsi mengubah password pertama kali agar anda menggunakan karakter password yang menurut anda mudah untuk diingat. Berikut ini adalah langkah-langkah untuk mengubah password anda.&lt;/p&gt;\n&lt;ol&gt;\n&lt;li&gt;Masuk ke halaman utama profil dengan cara memilih menu pojok kanan atas yang bergambar foto profil anda.&lt;/li&gt;\n&lt;li&gt;Pilih Sub menu Profil Saya kemdudian sistem akan mengarahkan anda ke halaman utama profil.&lt;/li&gt;\n&lt;li&gt;Jika sudah, cari tombol ubah password.&lt;/li&gt;\n&lt;li&gt;sistem akan menampilkan form ubah password tersebut, silahkan lakukan penyesuaian dengan mengisi password baru anda.&lt;/li&gt;\n&lt;li&gt;Ulangi password yang tadi anda masukan pada kolom form berikutnya.&lt;/li&gt;\n&lt;li&gt;Perlu anda ketahui bahwa karakter password yang anda masukan tidak boleh kurang dari 6 karakter atau lebih dari 20 karakter.&lt;/li&gt;\n&lt;li&gt;Password yang bisa anda gunakan hanya karakter angka dan huruf. Dalam hal ini anda tidak bisa memasukan karakter unik seperti tanda baca.&lt;/li&gt;\n&lt;li&gt;Simpan perubahan dengan memilih tombol \'Simpan\'&lt;/li&gt;\n&lt;li&gt;Jika berhasil sistem akan menampilkan pemberitahuan berhasil.&lt;/li&gt;\n&lt;/ol&gt;', '2024-12-01 22:39:32', '2024-12-01 22:39:32', 'Publish'),
(20, 'Solihul Hadi', 'Pengaturan Umum Aplikasi', 'Pengaturan', '&lt;p&gt;&lt;img src=&quot;_Page/PostAcceptor/../../assets/img/Help/098f6709a7ffb247.png&quot; alt=&quot;&quot; width=&quot;100%&quot; /&gt;&lt;/p&gt;\n&lt;p&gt;Pengaturan umum aplikasi adalah halaman yang digunakan untuk melakukan pengaturan dasar aplikasi dari mulai meta tag halaman hingga base url yang digunakan. Pengaturan ini sangat penting dalam menentukan bentuk tampilan dan informasi dasar dari sumber daya yang digunakan. Beberapa properti yang perlu anda pahami diantaranya sebagai berikut.&lt;/p&gt;\n&lt;ol&gt;\n&lt;li&gt;&lt;strong&gt;Judul Halaman&lt;/strong&gt; digunakan untuk menentukan isi konten pada meta tag title pada halaman utama.&lt;/li&gt;\n&lt;li&gt;&lt;strong&gt;Kata kunci&lt;/strong&gt; digunakan untuk menentukan isi konten pada meta tag keyword.&lt;/li&gt;\n&lt;li&gt;&lt;strong&gt;Deskripsi &lt;/strong&gt;digunakan untuk menentukan isi konten pada meta tag description.&lt;/li&gt;\n&lt;li&gt;&lt;strong&gt;Email&lt;/strong&gt;, &lt;strong&gt;Kontak &lt;/strong&gt;dan &lt;strong&gt;Alamat&lt;/strong&gt; digunakan untuk menentukan isi konten pada informasi dasar company/perusahaan atau nama pemilik dari situs web.&lt;/li&gt;\n&lt;li&gt;&lt;strong&gt;Favicon dan logo&lt;/strong&gt; digunakan sebagai atribut tambahan pada tampilan utama.&lt;/li&gt;\n&lt;li&gt;&lt;strong&gt;Base Url &lt;/strong&gt;digunakan sebagai alat url utama dari aplikasi. (Setiap perubahan domain perlu diatur ulang base url ini)&lt;/li&gt;\n&lt;/ol&gt;', '2024-12-02 03:02:45', '2024-12-02 03:02:45', 'Publish'),
(21, 'Solihul Hadi', 'Pengaturan Payment Gateway', 'Pengaturan', '&lt;p&gt;&lt;img src=&quot;assets/img/Help/5788523f3d7434cf.png&quot; alt=&quot;&quot; width=&quot;100%&quot; /&gt;&lt;/p&gt;\n&lt;p&gt;Pengaturan payment gateway digunakan untuk mengatur koneksi dengan provider penyedia layanan pembayaran (Dalam hal ini, menggunakan layanan dari midtrans). Semua atribut kredensial yang digunakan dikelola pada halaman ini.Pengaturan payment gateway berada di menu kiri bagian \'Pengaturan\' kemudian pilih sub menu \'Payment Gateway\'. Anda akan diarahkan pada halaman mandiri yang berisi form pengaturan dan beberapa tab list untuk pengujian.&lt;/p&gt;\n&lt;p&gt;Lebih jelas mengenai properti pada pengaturan ini dijelaskan sebagai berikut :&lt;/p&gt;\n&lt;ol&gt;\n&lt;li&gt;&lt;strong&gt;Status pengaturan : &lt;/strong&gt;Merupakan parameter apakah semua pengaturan yang digunakan akan ditetapkan sebagai metode pembayaran.&lt;/li&gt;\n&lt;li&gt;&lt;strong&gt;URL API Payment : &lt;/strong&gt;Merupakan gateway penghubung antara aplikasi dengan provider. Parameter ini menghubungkan aplikasi dengan sebuah script khusus yang diterbitkan pada domain public dan dapat diakses secara aman menggunakan protokol https://&lt;/li&gt;\n&lt;li&gt;&lt;strong&gt;Url Call Back :&lt;/strong&gt; Merupakan alamat url yang mengarah ke dalam aplikasi untuk melakukan handling apabila script API payment memperoleh data update status pembayaran. Secara default url call back tersebut akan mengarah ke directory _Api/Payment/UpdatePaymentStatus.php&lt;/li&gt;\n&lt;li&gt;&lt;strong&gt;Url Status :&lt;/strong&gt; Merupakan url khusus yang digunakan oleh provider untuk melakukan pengecekan status pembayaran secara manual melalui order id. Dalam mode sanbox diarahkan ke &lt;small&gt;&lt;code class=&quot;text text-grayish&quot;&gt;https://api.sandbox.midtrans.com&lt;/code&gt;&lt;/small&gt; sedangkan dalam mode production diarahkan ke &lt;small&gt;&lt;code class=&quot;text text-grayish&quot;&gt;https://api.midtrans.com&lt;/code&gt;&lt;/small&gt;.&lt;/li&gt;\n&lt;li&gt;&lt;strong&gt;API Key :&lt;/strong&gt; Merupakan karakter khusus yang berfungsi untuk proses otentifikasi dari&amp;nbsp; API Payment ke aplikasi.&lt;/li&gt;\n&lt;li&gt;&lt;strong&gt;ID Merchant :&lt;/strong&gt; Merupakan id yang kredensial yang diperoleh dari provider.&lt;/li&gt;\n&lt;li&gt;&lt;strong&gt;Client Key, Server Key, Snap URL dan Environment :&lt;/strong&gt; Merupakan parameter dasar kredensial dari provider untuk dapat menggunakan sumber daya yang disediakan. Untuk memahami cara penggunaan payment gateway pada sisi development dapat dilihat pada dokumentasi&lt;a href=&quot;https://docs.midtrans.com/docs/snap-snap-integration-guide&quot; target=&quot;_blank&quot; rel=&quot;noopener&quot;&gt; berikut ini&lt;/a&gt;.&lt;/li&gt;\n&lt;/ol&gt;\n&lt;p&gt;Setelah anda menyimpan pengaturan tersebut, lakukan pengujian koneksi dengan snap button. Berikut ini langkah-langkah pengujian yang bisa anda lakukan :&lt;/p&gt;\n&lt;ol&gt;\n&lt;li&gt;Buka tab list \'Uji Coba Snap Button\'.&lt;/li&gt;\n&lt;li&gt;Masukan kode transaksi, atau anda bisa membuatnya secara otomatis dengan memilih tombol generate.&lt;/li&gt;\n&lt;li&gt;Masukan juga order id yang juga bisa anda buat dengan memilih tombol generate.&lt;/li&gt;\n&lt;li&gt;Masukan jumlah tagihan. Dalam hal ini gunakan nominal berapapun.&lt;/li&gt;\n&lt;li&gt;Masukan nama pelanggan yang akan muncul pada halaman pembayaran nanti.&lt;/li&gt;\n&lt;li&gt;Masukan alamat email pelanggan yang nantinya akan digunakan untuk mengirim notifikasi status pembayaran.&lt;/li&gt;\n&lt;li&gt;Masukan juga nomor kontak pelanggan.&lt;/li&gt;\n&lt;li&gt;Selanjutnya pilih tombol \'Generate\' pada form snap token untuk meminta kode unik pembayaran dari provider.&lt;/li&gt;\n&lt;li&gt;Jika semua parameter sudah diisi, selanjutnya pilih tombol \'Generate Button\'.&lt;/li&gt;\n&lt;li&gt;Sistem akan mengirim permintaan ke provider melalui API service dan jika berhasil akan muncultombol pembayaran.&lt;/li&gt;\n&lt;/ol&gt;\n&lt;p&gt;Semua data pembayaran yang dikirim ke payment gateway akan muncul pada tab list Log Order Id. Anda bisa memilih salah satu data tersebut untuk menampilkan detailnya.&lt;/p&gt;\n&lt;p&gt;&amp;nbsp;&lt;/p&gt;', '2024-12-02 03:12:10', '2024-12-02 03:38:09', 'Publish'),
(22, 'Solihul Hadi', 'Pengaturan Email Gateway', 'Pengaturan', '&lt;p&gt;&lt;img src=&quot;_Page/PostAcceptor/../../assets/img/Help/ca49e26c8c167315.png&quot; alt=&quot;&quot; width=&quot;100%&quot; /&gt;&lt;/p&gt;\n&lt;p&gt;Form &lt;strong&gt;Pengaturan Email Gateway&lt;/strong&gt; digunakan untuk mengkonfigurasi layanan pengiriman email melalui server SMTP. Konfigurasi ini memungkinkan sistem aplikasi untuk mengirimkan email secara otomatis, seperti notifikasi, verifikasi, atau laporan, menggunakan akun email yang diatur dalam form ini.&lt;/p&gt;\n&lt;p&gt;Berikut adalah fungsi dari masing-masing field dalam form:&lt;/p&gt;\n&lt;ol&gt;\n&lt;li&gt;\n&lt;p&gt;&lt;strong&gt;URL Service Gateway&lt;/strong&gt;&lt;/p&gt;\n&lt;ul&gt;\n&lt;li&gt;Mengisi URL gateway yang mengarahkan ke endpoint layanan email yang digunakan.&lt;/li&gt;\n&lt;li&gt;Contoh: &lt;code&gt;https://mailer.kuninganrunners.online/index.php&lt;/code&gt;&lt;/li&gt;\n&lt;li&gt;URL ini harus diisi sesuai dengan lokasi skrip email gateway pada server hosting Anda.&lt;/li&gt;\n&lt;/ul&gt;\n&lt;/li&gt;\n&lt;li&gt;\n&lt;p&gt;&lt;strong&gt;Email Account&lt;/strong&gt;&lt;/p&gt;\n&lt;ul&gt;\n&lt;li&gt;Email pengirim yang digunakan untuk mengirimkan pesan.&lt;/li&gt;\n&lt;li&gt;Pastikan email ini aktif dan dibuat melalui layanan web hosting yang Anda gunakan.&lt;/li&gt;\n&lt;li&gt;Contoh: &lt;code&gt;admin_kngr@kuninganrunners.online&lt;/code&gt;&lt;/li&gt;\n&lt;/ul&gt;\n&lt;/li&gt;\n&lt;li&gt;\n&lt;p&gt;&lt;strong&gt;Password Email&lt;/strong&gt;&lt;/p&gt;\n&lt;ul&gt;\n&lt;li&gt;Password akun email yang dimasukkan harus sama dengan yang digunakan untuk login ke akun email Anda di layanan hosting.&lt;/li&gt;\n&lt;li&gt;Harap menjaga keamanan password ini.&lt;/li&gt;\n&lt;/ul&gt;\n&lt;/li&gt;\n&lt;li&gt;\n&lt;p&gt;&lt;strong&gt;Nama Pengirim&lt;/strong&gt;&lt;/p&gt;\n&lt;ul&gt;\n&lt;li&gt;Nama yang akan ditampilkan sebagai pengirim pada email yang dikirimkan.&lt;/li&gt;\n&lt;li&gt;Contoh: &lt;code&gt;Admin Kuningan Runner&lt;/code&gt;&lt;/li&gt;\n&lt;/ul&gt;\n&lt;/li&gt;\n&lt;li&gt;\n&lt;p&gt;&lt;strong&gt;Port SMTP&lt;/strong&gt;&lt;/p&gt;\n&lt;ul&gt;\n&lt;li&gt;Port yang digunakan oleh server SMTP untuk mengirim email.&lt;/li&gt;\n&lt;li&gt;Biasanya, port &lt;code&gt;465&lt;/code&gt; digunakan untuk koneksi SMTP dengan enkripsi SSL, atau &lt;code&gt;587&lt;/code&gt; untuk TLS.&lt;/li&gt;\n&lt;li&gt;Jika tidak yakin, gunakan port sesuai dengan rekomendasi penyedia hosting Anda.&lt;/li&gt;\n&lt;/ul&gt;\n&lt;/li&gt;\n&lt;/ol&gt;\n&lt;hr /&gt;\n&lt;h3&gt;Panduan Pengisian Form&lt;/h3&gt;\n&lt;ol&gt;\n&lt;li&gt;\n&lt;p&gt;&lt;strong&gt;Persiapkan Informasi Email Gateway&lt;/strong&gt;&lt;br /&gt;Pastikan Anda memiliki:&lt;/p&gt;\n&lt;ul&gt;\n&lt;li&gt;URL layanan email gateway.&lt;/li&gt;\n&lt;li&gt;Akun email dan passwordnya.&lt;/li&gt;\n&lt;li&gt;Nama pengirim yang ingin ditampilkan.&lt;/li&gt;\n&lt;li&gt;Port SMTP sesuai layanan hosting Anda.&lt;/li&gt;\n&lt;/ul&gt;\n&lt;/li&gt;\n&lt;li&gt;\n&lt;p&gt;&lt;strong&gt;Isi Field dengan Tepat&lt;/strong&gt;&lt;/p&gt;\n&lt;ul&gt;\n&lt;li&gt;Salin informasi URL gateway ke dalam field &lt;strong&gt;URL Service Gateway&lt;/strong&gt;.&lt;/li&gt;\n&lt;li&gt;Masukkan akun email ke field &lt;strong&gt;Email Account&lt;/strong&gt;.&lt;/li&gt;\n&lt;li&gt;Isi password akun email pada field &lt;strong&gt;Password Email&lt;/strong&gt;.&lt;/li&gt;\n&lt;li&gt;Masukkan nama pengirim yang ingin tampil di email ke field &lt;strong&gt;Nama Pengirim&lt;/strong&gt;.&lt;/li&gt;\n&lt;li&gt;Isi port SMTP sesuai layanan hosting Anda, biasanya &lt;code&gt;465&lt;/code&gt; untuk SSL atau &lt;code&gt;587&lt;/code&gt; untuk TLS.&lt;/li&gt;\n&lt;/ul&gt;\n&lt;/li&gt;\n&lt;li&gt;\n&lt;p&gt;&lt;strong&gt;Klik Simpan Pengaturan&lt;/strong&gt;&lt;br /&gt;Setelah semua informasi diisi dengan benar, tekan tombol &lt;strong&gt;SIMPAN PENGATURAN&lt;/strong&gt; untuk menyimpan konfigurasi.&lt;/p&gt;\n&lt;/li&gt;\n&lt;li&gt;\n&lt;p&gt;&lt;strong&gt;Uji Coba Pengiriman Email&lt;/strong&gt;&lt;br /&gt;Setelah pengaturan disimpan, lakukan uji coba dengan mengirimkan email untuk memastikan bahwa konfigurasi berhasil.&lt;/p&gt;\n&lt;/li&gt;\n&lt;/ol&gt;\n&lt;hr /&gt;\n&lt;h3&gt;Catatan Keamanan&lt;/h3&gt;\n&lt;ul&gt;\n&lt;li&gt;Jangan membagikan informasi akun email dan password kepada pihak yang tidak berkepentingan.&lt;/li&gt;\n&lt;li&gt;Gunakan password yang kuat untuk meningkatkan keamanan akun email Anda.&lt;/li&gt;\n&lt;li&gt;Pastikan koneksi antara aplikasi dan server SMTP terenkripsi (SSL/TLS).&lt;/li&gt;\n&lt;/ul&gt;', '2024-12-02 03:41:39', '2024-12-02 03:43:26', 'Publish');

-- --------------------------------------------------------

--
-- Table structure for table `inspektorat`
--

DROP TABLE IF EXISTS `inspektorat`;
CREATE TABLE IF NOT EXISTS `inspektorat` (
  `id_inspektorat` char(36) NOT NULL,
  `id_provinsi` int(11) NOT NULL,
  `id_kabkot` int(11) NOT NULL,
  `nama_inspektorat` varchar(100) NOT NULL,
  `telepon` varchar(20) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_inspektorat`),
  KEY `id_provinsi` (`id_provinsi`),
  KEY `id_kabkot` (`id_kabkot`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inspektorat`
--

INSERT INTO `inspektorat` (`id_inspektorat`, `id_provinsi`, `id_kabkot`, `nama_inspektorat`, `telepon`, `alamat`) VALUES
('3wg4hEHZYKZdbgChJYYfqMUHnBJkDYSfDFPW', 90901, 90901, 'Badan Pengawas Standar Kesehatan', '', ''),
('bqmvQrHhkA2UT3r5uLAv65a0euO5gkC0ZVWK', 90901, 90901, 'Badan Pengawas Kinerja Instansi', '089676857759', ''),
('eOJaY5y4W3pAe86fBOl75YEPdWUPKlivtbQI', 90901, 90901, 'Badan Pengawas Keuangan', '089789689', 'Jalan RE Martadinata No.78 Kuningan\r\nKode Pos : 45513'),
('Kv7qAx31DXac9g0yY4aUPMRVrUtC9HGUkdEA', 90901, 90901, 'Badan Pengawas Kepegawaian', '089676857759', 'Jalan RE Martadinata'),
('Sdk6hCm5mFsuIz3Qw1ZuslJYpnV4OlUOrBCI', 90901, 90901, 'Badan Pengawas Pertanian', '', ''),
('sIZZCSiG06Akwh2qT79CycSUY9JZKWbBY24m', 31165, 37298, 'Bandung', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `komponen`
--

DROP TABLE IF EXISTS `komponen`;
CREATE TABLE IF NOT EXISTS `komponen` (
  `id_komponen` char(36) NOT NULL,
  `id_evaluasi_periode` char(36) NOT NULL,
  `kode` varchar(20) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `keterangan` text,
  PRIMARY KEY (`id_komponen`),
  UNIQUE KEY `id_komponen` (`id_komponen`),
  KEY `id_evaluasi_periode` (`id_evaluasi_periode`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `komponen`
--

INSERT INTO `komponen` (`id_komponen`, `id_evaluasi_periode`, `kode`, `nama`, `keterangan`) VALUES
('1AZjTq3d6JasjojSTm9UIb9xkex3jYxcvzUi', '0Hlr9ya5eEHNHrtUJ7MZiapAPIg6zdbTcp5j', '1', 'Perencanaan Kinerja', 'p'),
('7PRMMfw0s0xV6R1r8LfyulMA73o3dXng8NgM', 'kma0qUa8iCeZV6NhFM2Ell9ss3VHca7u4Ofj', 'B', 'Pengukuran Kinerja', 'Pengukuran Kinerja adalah proses sistematis untuk menilai sejauh mana tujuan dan sasaran yang telah ditetapkan dalam perencanaan kinerja organisasi tercapai'),
('8mhAHeJOTNfFxroEraRa1di3WiQFIQk6gJrW', 'kma0qUa8iCeZV6NhFM2Ell9ss3VHca7u4Ofj', 'A', 'Perancanaan Kinerja', 'Perencanaan Kinerja adalah proses sistematis yang digunakan untuk menentukan tujuan, sasaran, indikator, dan target kinerja organisasi dalam suatu periode tertentu'),
('AB43K3NcSTCXXqYsIK51YnlmscGzL5Vci9ZN', 'kma0qUa8iCeZV6NhFM2Ell9ss3VHca7u4Ofj', 'D', 'Evaluasi pelaporan kinerja internal', 'Evaluasi Pelaporan Kinerja Internal adalah proses penilaian sistematis terhadap laporan kinerja yang disusun oleh unit atau bagian dalam suatu organisasi, termasuk organisasi pemerintah daerah atau instansi seperti rumah sakit.'),
('Cdb2SJCyXrXzK7NZ553stvKDcTC85eN7ORgY', '0Hlr9ya5eEHNHrtUJ7MZiapAPIg6zdbTcp5j', '4', 'Evaluasi Akuntabilitas Kinerja Internal', 'a'),
('GexHNZGElcibynxCB2MOhD20juxMn2b0gTKN', 'kma0qUa8iCeZV6NhFM2Ell9ss3VHca7u4Ofj', 'C', 'Pelaporan Kinerja', 'Pelaporan Kinerja adalah proses penyampaian informasi mengenai capaian kinerja suatu organisasi pemerintah dalam periode tertentu, berdasarkan perencanaan dan pengukuran kinerja yang telah dilakukan sebelumnya'),
('ijpAfgg1nrELsIAiCNcyhAK32ZflcCq0OYi8', '0Hlr9ya5eEHNHrtUJ7MZiapAPIg6zdbTcp5j', '2', 'Pengukuran Kinerja', 'j'),
('MxW8U6C2ZGgbfrOfTm0YHzGP0GFMrYtahp35', '0Hlr9ya5eEHNHrtUJ7MZiapAPIg6zdbTcp5j', '3', 'Pelaporan Kinerja', 'a');

-- --------------------------------------------------------

--
-- Table structure for table `komponen_sub`
--

DROP TABLE IF EXISTS `komponen_sub`;
CREATE TABLE IF NOT EXISTS `komponen_sub` (
  `id_komponen_sub` char(36) NOT NULL,
  `id_komponen` char(36) NOT NULL,
  `id_evaluasi_periode` char(36) NOT NULL,
  `kode` varchar(20) NOT NULL,
  `nama` text NOT NULL,
  `keterangan` text,
  PRIMARY KEY (`id_komponen_sub`),
  KEY `id_komponen` (`id_komponen`),
  KEY `id_evaluasi_periode` (`id_evaluasi_periode`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `komponen_sub`
--

INSERT INTO `komponen_sub` (`id_komponen_sub`, `id_komponen`, `id_evaluasi_periode`, `kode`, `nama`, `keterangan`) VALUES
('3zrSlJupQsE1FB8xm1L576lbNK3S9g1suO9Z', 'ijpAfgg1nrELsIAiCNcyhAK32ZflcCq0OYi8', '0Hlr9ya5eEHNHrtUJ7MZiapAPIg6zdbTcp5j', '2', 'Pengukuran Kinerja telah menjadi kebutuhan dalam mewujudkan Kinerja secara Efektif dan Efisien dan telah dilakukan secara berjenjang dan berkelanjutan', 's'),
('7AH9AGmGZVFgLtsqJxNVH7iIZVNN1vMvFwqd', '8mhAHeJOTNfFxroEraRa1di3WiQFIQk6gJrW', 'kma0qUa8iCeZV6NhFM2Ell9ss3VHca7u4Ofj', '3', 'Perencanaan Kinerja telah dimanfaatkan untuk mewujudkan hasil yang berkesinambungan', 'm'),
('9fisJ8XHC1a8wgEzXeT4xQ5moRYamEaDJGlD', 'Cdb2SJCyXrXzK7NZ553stvKDcTC85eN7ORgY', '0Hlr9ya5eEHNHrtUJ7MZiapAPIg6zdbTcp5j', '2', 'Evaluasi Akuntabilitas Kinerja Internal telah dilaksanakan secara berkualitas dengan Sumber Daya yang memadai', 'a'),
('jABJ4ska7wCC9bRhlcBhmVLA0qTib3DkXA2Q', 'ijpAfgg1nrELsIAiCNcyhAK32ZflcCq0OYi8', '0Hlr9ya5eEHNHrtUJ7MZiapAPIg6zdbTcp5j', '3', 'Pengukuran Kinerja telah dijadikan dasar dalam pemberian Reward dan Punishment, serta penyesuaian strategi dalam mencapai kinerja yang efektif dan efisien', 'd'),
('ntGPT4w2FTgrsDLzpknwQtYxi0BqhU7Ffx8u', '1AZjTq3d6JasjojSTm9UIb9xkex3jYxcvzUi', '0Hlr9ya5eEHNHrtUJ7MZiapAPIg6zdbTcp5j', '1', 'Dokumen perencasns sudash tersedia', 'Dokumen perencasns sudash tersedia'),
('nWYGAUnjrTRNNDizXL9s3ft7ieWocuoDEe6m', '8mhAHeJOTNfFxroEraRa1di3WiQFIQk6gJrW', 'kma0qUa8iCeZV6NhFM2Ell9ss3VHca7u4Ofj', '1', 'Dokumen Perencanaan Kinerja telah tersedia', 'Keberadaan'),
('phH1ZtOa1OyiGzF18IyALJFWSYtPbNdAGsev', '8mhAHeJOTNfFxroEraRa1di3WiQFIQk6gJrW', 'kma0qUa8iCeZV6NhFM2Ell9ss3VHca7u4Ofj', '2', 'Dokumen Perencanaan kinerja telah memenuhi standar yang baik, yaitu untuk mencapai hasil, dengan ukuran kinerja yang SMART, menggunakan penyelarasan (cascading) disetiap level secara logis, serta memperhatikan kinerja bidang lain (crosscutting)', 'Dokumen Perencanaan Kinerja telah sesuai standar yang baik'),
('Szp1diWJT7joq13CVe74OiV4vwrZurEizqzU', '7PRMMfw0s0xV6R1r8LfyulMA73o3dXng8NgM', 'kma0qUa8iCeZV6NhFM2Ell9ss3VHca7u4Ofj', '1', 'Pengukuran Kinerja telah dilakukan', 's'),
('T2FWWFzMiQzRKSNKUY2Q1lSrNfyO45Cba1bi', 'Cdb2SJCyXrXzK7NZ553stvKDcTC85eN7ORgY', '0Hlr9ya5eEHNHrtUJ7MZiapAPIg6zdbTcp5j', '1', 'Evaluasi Akuntabilitas Kinerja Internal telah dilaksanakan', 's'),
('TrodLvoJEaszXWr1EGR1CnXC8YiCi7d8eeSs', '7PRMMfw0s0xV6R1r8LfyulMA73o3dXng8NgM', 'kma0qUa8iCeZV6NhFM2Ell9ss3VHca7u4Ofj', '3', 'Pengukuran Kinerja telah dijadikan dasar dalam pemberian Reward dan Punishment, serta penyesuaian strategi dalam mencapai kinerja yang efektif dan efisien', 'z'),
('tud0Yc90sNmhcRoJRmyU5emEgvS3o46gwNlE', '7PRMMfw0s0xV6R1r8LfyulMA73o3dXng8NgM', 'kma0qUa8iCeZV6NhFM2Ell9ss3VHca7u4Ofj', '2', 'Pengukuran Kinerja telah menjadi kebutuhan dalam mewujudkan Kinerja secara Efektif dan Efisien dan telah dilakukan secara berjenjang dan berkelanjutan', 'z'),
('Usml0HBjUGloUQYsLBa5TZds72JhEGJuDeut', 'Cdb2SJCyXrXzK7NZ553stvKDcTC85eN7ORgY', '0Hlr9ya5eEHNHrtUJ7MZiapAPIg6zdbTcp5j', '3', 'Implementasi SAKIP telah meningkat karena evaluasi Akuntabilitas Kinerja Internal sehingga memberikan kesan yang nyata (dampak) dalam efektifitas dan efisiensi Kinerja', 'a'),
('VD4YCW73c3azHYNeSZh1JIiDuo0WRX2DyLwl', 'ijpAfgg1nrELsIAiCNcyhAK32ZflcCq0OYi8', '0Hlr9ya5eEHNHrtUJ7MZiapAPIg6zdbTcp5j', '1', 'Pengukuran Kinerja telah dilakukan', 'a');

-- --------------------------------------------------------

--
-- Table structure for table `kriteria`
--

DROP TABLE IF EXISTS `kriteria`;
CREATE TABLE IF NOT EXISTS `kriteria` (
  `id_kriteria` char(36) NOT NULL,
  `id_komponen_sub` char(36) NOT NULL,
  `id_komponen` char(36) NOT NULL,
  `id_evaluasi_periode` char(36) NOT NULL,
  `kode` varchar(20) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `keterangan` text,
  PRIMARY KEY (`id_kriteria`),
  KEY `id_komponen_sub` (`id_komponen_sub`),
  KEY `id_komponen` (`id_komponen`),
  KEY `id_evaluasi_periode` (`id_evaluasi_periode`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kriteria`
--

INSERT INTO `kriteria` (`id_kriteria`, `id_komponen_sub`, `id_komponen`, `id_evaluasi_periode`, `kode`, `nama`, `keterangan`) VALUES
('2gBkMbnSQxsDylVAi5fIAwGHIkpqxBKjmcds', 'VD4YCW73c3azHYNeSZh1JIiDuo0WRX2DyLwl', 'ijpAfgg1nrELsIAiCNcyhAK32ZflcCq0OYi8', '0Hlr9ya5eEHNHrtUJ7MZiapAPIg6zdbTcp5j', '3', 'Pimpinan selalu teribat sebagai pengambil keputusan (Decision Maker) dalam mengukur capaian kinerja.', 'a'),
('A3tzQ321c9tt59HPmfjWwbVliWLsfLkBYpAC', 'nWYGAUnjrTRNNDizXL9s3ft7ieWocuoDEe6m', '8mhAHeJOTNfFxroEraRa1di3WiQFIQk6gJrW', 'kma0qUa8iCeZV6NhFM2Ell9ss3VHca7u4Ofj', '2', 'Terdapat dokumen pedoman perencanaan jangka panjang', 'Terdapat dokumen pedoman perencanaan jangka panjang'),
('avElILRyln4dzs3s9CXQZZjv1Ft2fAveZLyE', 'phH1ZtOa1OyiGzF18IyALJFWSYtPbNdAGsev', '8mhAHeJOTNfFxroEraRa1di3WiQFIQk6gJrW', 'kma0qUa8iCeZV6NhFM2Ell9ss3VHca7u4Ofj', '5', 'Ukuran Keberhasilan IKU (Indikator Kinerja Utama) telah memenuhi kriteria SMART.', 'ok'),
('cpb31BljBdhE9eRBmMG4PRzkhevlrkPYRo0x', 'nWYGAUnjrTRNNDizXL9s3ft7ieWocuoDEe6m', '8mhAHeJOTNfFxroEraRa1di3WiQFIQk6gJrW', 'kma0qUa8iCeZV6NhFM2Ell9ss3VHca7u4Ofj', '3', 'Terdapat dokumen perencanaan kinerja jangka menengah.', 'A'),
('EgroFSrQYxEEczXw7PLeItWIv5gotVdqCxkB', 'nWYGAUnjrTRNNDizXL9s3ft7ieWocuoDEe6m', '8mhAHeJOTNfFxroEraRa1di3WiQFIQk6gJrW', 'kma0qUa8iCeZV6NhFM2Ell9ss3VHca7u4Ofj', '1', 'Terdapat pedoman teknis perencanaan kinerja', 'Terdapat pedoman teknis perencanaan kinerja'),
('IohGhd1Zwb4tAf2i9fBHOSZ432batOx6dp8U', 'phH1ZtOa1OyiGzF18IyALJFWSYtPbNdAGsev', '8mhAHeJOTNfFxroEraRa1di3WiQFIQk6gJrW', 'kma0qUa8iCeZV6NhFM2Ell9ss3VHca7u4Ofj', '2', 'Dokumen Perencanaan Kinerja telah dipublikasikan tepat waktu.', 'l'),
('k67c8QfuHgzfvZuH7VPYK9s3bvVTPSWCu2q4', 'VD4YCW73c3azHYNeSZh1JIiDuo0WRX2DyLwl', 'ijpAfgg1nrELsIAiCNcyhAK32ZflcCq0OYi8', '0Hlr9ya5eEHNHrtUJ7MZiapAPIg6zdbTcp5j', '1', 'Terdapat pedoman teknis pengukuran kinerja dan pengumpulan data kinerja.', 'a'),
('KcJxqy8jqhmsnzFGRxaFXTxYoIVbtQq31gJt', 'nWYGAUnjrTRNNDizXL9s3ft7ieWocuoDEe6m', '8mhAHeJOTNfFxroEraRa1di3WiQFIQk6gJrW', 'kma0qUa8iCeZV6NhFM2Ell9ss3VHca7u4Ofj', '4', 'Terdapat dokumen perencanaan kinerja jangka pendek.', 'ok'),
('NvpqP8whLiXqYhjirL0AgmtVFzg16gl0p7mX', 'phH1ZtOa1OyiGzF18IyALJFWSYtPbNdAGsev', '8mhAHeJOTNfFxroEraRa1di3WiQFIQk6gJrW', 'kma0qUa8iCeZV6NhFM2Ell9ss3VHca7u4Ofj', '1', 'Dokumen Perencanaan Kinerja telah diformalkan.', 'ok'),
('S0LUoKgNgZKrHkgqYAh5qet1RB47jrpRpZJD', 'nWYGAUnjrTRNNDizXL9s3ft7ieWocuoDEe6m', '7PRMMfw0s0xV6R1r8LfyulMA73o3dXng8NgM', 'kma0qUa8iCeZV6NhFM2Ell9ss3VHca7u4Ofj', '1', 'Terdapat pedoman teknis pengukuran kinerja dan pengumpulan data kinerja.', 'z'),
('ucpEpLwE3vkSshjBw8zHsowGDVU2KMg3ve6F', 'nWYGAUnjrTRNNDizXL9s3ft7ieWocuoDEe6m', '8mhAHeJOTNfFxroEraRa1di3WiQFIQk6gJrW', 'kma0qUa8iCeZV6NhFM2Ell9ss3VHca7u4Ofj', '5', 'Terdapat dokumen perencanaan aktivitas yang mendukung kinerja.', 'A'),
('ux72rXlmKPj0zbOaMqd0YMQoGoew8SV5wrGU', 'VD4YCW73c3azHYNeSZh1JIiDuo0WRX2DyLwl', 'ijpAfgg1nrELsIAiCNcyhAK32ZflcCq0OYi8', '0Hlr9ya5eEHNHrtUJ7MZiapAPIg6zdbTcp5j', '2', 'Terdapat Definisi Operasional yang jelas atas kinerja dan cara mengukur indikator kinerja.', 'a'),
('VJKkQD3KGO2TFaPtWAW2lrYakHFcvzu3RDi0', 'nWYGAUnjrTRNNDizXL9s3ft7ieWocuoDEe6m', '8mhAHeJOTNfFxroEraRa1di3WiQFIQk6gJrW', 'kma0qUa8iCeZV6NhFM2Ell9ss3VHca7u4Ofj', '6', 'Terdapat dokumen perencanaan anggaran yang mendukung kinerja.', 'S'),
('vjsHn1rNiLX8CJJliV75lqhXyqgdb7zkLGky', 'nWYGAUnjrTRNNDizXL9s3ft7ieWocuoDEe6m', '8mhAHeJOTNfFxroEraRa1di3WiQFIQk6gJrW', 'kma0qUa8iCeZV6NhFM2Ell9ss3VHca7u4Ofj', '7', 'Target yang ditetapkan dalam Perencanaan Kinerja dapat dicapai (achievable), menantang, dan realistis.', 'a');

-- --------------------------------------------------------

--
-- Table structure for table `kriteria_indikator`
--

DROP TABLE IF EXISTS `kriteria_indikator`;
CREATE TABLE IF NOT EXISTS `kriteria_indikator` (
  `id_kriteria_indikator` int(12) NOT NULL AUTO_INCREMENT,
  `id_wilayah` int(11) NOT NULL COMMENT 'Kabupaten/Kota',
  `periode` int(11) NOT NULL,
  `kode` varchar(20) NOT NULL,
  `level` varchar(20) NOT NULL COMMENT 'Level 1, Level 2, Level 3, Level 4',
  `level_1` varchar(20) NOT NULL COMMENT 'indikator',
  `level_2` varchar(20) DEFAULT NULL COMMENT 'sub indikator',
  `level_3` varchar(20) DEFAULT NULL COMMENT 'kriteria',
  `level_4` varchar(20) DEFAULT NULL COMMENT 'pertanyaan',
  `teks` text NOT NULL,
  `alternatif` text COMMENT 'json',
  `keterangan` text,
  `bobot` decimal(10,2) DEFAULT NULL COMMENT '0-100',
  PRIMARY KEY (`id_kriteria_indikator`)
) ENGINE=InnoDB AUTO_INCREMENT=168 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kriteria_indikator`
--

INSERT INTO `kriteria_indikator` (`id_kriteria_indikator`, `id_wilayah`, `periode`, `kode`, `level`, `level_1`, `level_2`, `level_3`, `level_4`, `teks`, `alternatif`, `keterangan`, `bobot`) VALUES
(1, 0, 0, 'A', 'Level 1', 'A', '', '', '', 'PERENCANAAN KINERJA', '', NULL, '0.00'),
(9, 0, 0, 'B', 'Level 1', 'B', '', '', '', 'PENGUKURAN KINERJA ', '', NULL, '0.00'),
(10, 0, 0, 'C', 'Level 1', 'C', '', '', '', 'PELAPORAN KINERJA', '', NULL, '0.00'),
(37, 0, 0, 'D', 'Level 1', 'D', '', '', '', 'EVALUASI INTERNAL KINERJA', '', NULL, '0.00'),
(38, 0, 0, 'E', 'Level 1', 'E', '', '', '', 'PENCAPAIAN SASARAN/KINERJA ORGANISASI', '', NULL, '0.00'),
(54, 0, 0, 'A.1', 'Level 2', 'A', '1', '', '', 'RPJM Desa', '', NULL, '0.00'),
(55, 0, 0, 'A.2', 'Level 2', 'A', '2', '', '', 'Perencanaan Kinerja Tahunan', '', NULL, '0.00'),
(56, 0, 0, 'B.1', 'Level 2', 'B', '1', '', '', 'Pemenuhan Pengukuran', '', NULL, '0.00'),
(57, 0, 0, 'B.2', 'Level 2', 'B', '2', '', '', 'Kualitas Pengukuran', '', NULL, '0.00'),
(58, 0, 0, 'B.3', 'Level 2', 'B', '3', '', '', 'Implementasi Pengukuran', '', NULL, '0.00'),
(59, 0, 0, 'C.1', 'Level 2', 'C', '1', '', '', 'Pemenuhan Pelaporan', '', NULL, '0.00'),
(60, 0, 0, 'C.2', 'Level 2', 'C', '2', '', '', 'Penyajian Informasi Kinerja', '', NULL, '0.00'),
(61, 0, 0, 'C.3', 'Level 2', 'C', '3', '', '', 'Pemanfaatan Informasi Kinerja', '', NULL, '0.00'),
(62, 0, 0, 'D.1', 'Level 2', 'D', '1', '', '', 'Pemenuhan Evaluasi', '', NULL, '0.00'),
(63, 0, 0, 'D.2', 'Level 2', 'D', '2', '', '', 'Kualitas Evaluasi', '', NULL, '0.00'),
(64, 0, 0, 'D.3', 'Level 2', 'D', '3', '', '', 'Pemanfaatan Evaluasi', '', NULL, '0.00'),
(65, 0, 0, 'E.1', 'Level 2', 'E', '1', '', '', 'Kinerja Yang Dilaporkan (output)', '', NULL, '0.00'),
(66, 0, 0, 'E.2', 'Level 2', 'E', '2', '', '', 'Kinerja Yang Dilaporkan (Outcome)', '', NULL, '0.00'),
(67, 0, 0, 'A.1.1', 'Level 3', 'A', '1', '1', '', 'Pemenuhan RPJM Desa', '', NULL, '2.00'),
(68, 0, 0, 'A.1.2', 'Level 3', 'A', '1', '2', '', 'Kualitas RPJM Desa', '', NULL, '5.00'),
(69, 0, 0, 'A.1.3', 'Level 3', 'A', '1', '3', '', 'Implementasi RPJM Desa', '', NULL, '3.00'),
(70, 0, 0, 'A.2.1', 'Level 3', 'A', '2', '1', '', 'Pemenuhan Perencanaan Kinerja Tahunan', '', NULL, '4.00'),
(71, 0, 0, 'A.2.2', 'Level 3', 'A', '2', '2', '', 'Kualitas Perencanaan Kinerja Tahunan (RKPDes)', '', NULL, '10.00'),
(72, 0, 0, 'A.2.3', 'Level 3', 'A', '2', '3', '', 'Implementasi Perencanaan Kinerja Tahunan', '', NULL, '6.00'),
(73, 0, 0, 'B.1.1', 'Level 3', 'B', '1', '1', '', 'Pemenuhan Pengukuran', '', NULL, '5.00'),
(74, 0, 0, 'B.2.1', 'Level 3', 'B', '2', '1', '', 'Kualitas Pengukuran', '', NULL, '12.50'),
(75, 0, 0, 'B.3.1', 'Level 3', 'B', '3', '1', '', 'Implementasi Pengukuran', '', NULL, '7.50'),
(76, 0, 0, 'C.1.1', 'Level 3', 'C', '1', '1', '', 'Pemenuhan Pelaporan', '', NULL, '3.00'),
(77, 0, 0, 'C.2.1', 'Level 3', 'C', '2', '1', '', 'Penyajian Informasi Kinerja', '', NULL, '7.50'),
(78, 0, 0, 'C.3.1', 'Level 3', 'C', '3', '1', '', 'Pemanfaatan Informasi Kinerja', '', NULL, '4.50'),
(79, 0, 0, 'D.1.1', 'Level 3', 'D', '1', '1', '', 'Pemenuhan Evaluasi', '', NULL, '2.00'),
(80, 0, 0, 'D.2.1', 'Level 3', 'D', '2', '1', '', 'Kualitas Evaluasi', '', NULL, '5.00'),
(81, 0, 0, 'D.3.1', 'Level 3', 'D', '3', '1', '', 'Pemanfaatan Evaluasi', '', NULL, '3.00'),
(82, 0, 0, 'E.1.1', 'Level 3', 'E', '1', '1', '', 'Kinerja Yang Dilaporkan (output)', '', NULL, '7.50'),
(83, 0, 0, 'E.2.1', 'Level 3', 'E', '2', '1', '', 'Kinerja Yang Dilaporkan (Outcome)', '', NULL, '12.50'),
(85, 0, 0, 'A.1.1.1', 'Level 4', 'A', '1', '1', '1', 'RPJM  Desa  telah  disusun.', '[{\"char\":\"A\",\"label\":\"Ya\",\"nilai\":\"0.3\"},{\"char\":\"B\",\"label\":\"Tidak\",\"nilai\":\"0\"}]', '', '0.00'),
(86, 0, 0, 'A.1.1.2', 'Level 4', 'A', '1', '1', '2', 'RPJM  Desa  telah  memuat tujuan', '[{\"char\":\"A\",\"label\":\"Ya\",\"nilai\":\"0.3\"},{\"char\":\"B\",\"label\":\"Tidak\",\"nilai\":\"0\"}]', NULL, '0.00'),
(87, 0, 0, 'A.1.1.3', 'Level 4', 'A', '1', '1', '3', 'Dokumen  RPJM  Desa  telah memuat  sasaran', '[{\"char\":\"A\",\"label\":\"Ya\",\"nilai\":\"0.3\"},{\"char\":\"B\",\"label\":\"Tidak\",\"nilai\":\"0\"}]', NULL, '0.00'),
(88, 0, 0, 'A.1.1.4', 'Level 4', 'A', '1', '1', '4', 'Dokumen  RPJM  Desa  telah memuat  indikator  kinerja sasaran', '[{\"char\":\"a\",\"label\":\"apabila  seluruh  sasaran  telah  dilengkapi  dengan indikatornya\",\"nilai\":\"0.3\"},{\"char\":\"b\",\"label\":\"apabila  >  90%  sasaran  telah  dilengkapi  dengan indikatornya\",\"nilai\":\"0.25\"},{\"char\":\"c\",\"label\":\"apabila  75%<  sasaran  yang  telah  dilengkapi  dengan indikatornya  <  90%\",\"nilai\":\"0.20\"},{\"char\":\"d\",\"label\":\"apabila  20%<  sasaran  yang  telah  dilengkapi  dengan indikatornya  <  75%\",\"nilai\":\"0.15\"},{\"char\":\"e\",\"label\":\"apabila  sasaran  yang  telah  dilengkapi  dengan indikatornya  <  20%\",\"nilai\":\"0\"}]', NULL, '0.00'),
(89, 0, 0, 'A.1.1.5', 'Level 4', 'A', '1', '1', '5', 'Dokumen  RPJM  Desa  telah memuat  target  tahunan', '[{\"char\":\"a\",\"label\":\"apabila  seluruh  sasaran  telah  dilengkapi  dengan  target pencapaiannya\",\"nilai\":\"0.3\"},{\"char\":\"b\",\"label\":\"apabila  >  90%  sasaran  telah  dilengkapi  dengan  target pencapaiannya\",\"nilai\":\"0.25\"},{\"char\":\"c\",\"label\":\"apabila  75%<  sasaran    telah  dilengkapi  dengan target  pencapaiannya  <  90%\",\"nilai\":\"0.2\"},{\"char\":\"d\",\"label\":\"apabila  20%<  sasaran   telah  dilengkapi  dengan target  pencapaiannya  <  75%\",\"nilai\":\"0.15\"},{\"char\":\"e\",\"label\":\"apabila  sasaran  yang  telah  dilengkapi  dengan  target pencapaiannya  <  20%\",\"nilai\":\"0\"}]', '', '0.00'),
(90, 0, 0, 'A.1.1.6', 'Level 4', 'A', '1', '1', '6', 'RPJM  Desa  telah  menyajikan IKU', '[{\"char\":\"A\",\"label\":\"apabila  lebih  dari  90%  indikator  yang  ada  di RPJMD/RPJMDes  telah  menggambarkan  kinerja  utama Pemdes\",\"nilai\":\"0.3\"},{\"char\":\"B\",\"label\":\"apabila  75%<  indikator  yang  menggambarkan  kinerja utama  Pemdes  <  90%\",\"nilai\":\"0.25\"},{\"char\":\"C\",\"label\":\"apabila  40%<  indikator  yang  menggambarkan  kinerja utama  Pemdes  <  75%\",\"nilai\":\"0.2\"},{\"char\":\"D\",\"label\":\"apabila  10%<  indikator  yang  menggambarkan  kinerja utama  Pemdes  <  40%\",\"nilai\":\"0.15\"},{\"char\":\"E\",\"label\":\"apabila  indikator  yang  menggambarkan  kinerja  utama Pemdes  <  10%\",\"nilai\":\"0\"}]', 'RPJMD/RPJMDes  dikatakan  menyajikan (memanfaatkan)  IKU  jika  tujuan  dan  atau  sasaran  yang ada  dapat  direpresentasikan  (relevan)  dengan  IKU  yang sudah  diformalkan.', '0.00'),
(91, 0, 0, 'A.1.1.7', 'Level 4', 'A', '1', '1', '7', 'RPJMDes  telah dipublikasikan', '[{\"char\":\"A\",\"label\":\"Ya\",\"nilai\":\"0.2\"},{\"char\":\"B\",\"label\":\"Tidak\",\"nilai\":\"0\"}]', '', '0.00'),
(92, 0, 0, 'A.1.2.1', 'Level 4', 'A', '1', '2', '1', 'Tujuan  telah  berorientasi hasil', '[{\"char\":\"A\",\"label\":\"apabila  lebih  dari  90%  tujuan  yang  ditetapkan  telah berorientasi  hasi\",\"nilai\":\"0.7\"},{\"char\":\"B\",\"label\":\" apabila  75%<  tujuan  yang  berorientasi  hasil  <  90%\",\"nilai\":\"0.55\"},{\"char\":\"C\",\"label\":\"apabila  40%<  tujuan  yang  berorientasi  hasil  <75%\",\"nilai\":\"0.35\"},{\"char\":\"D\",\"label\":\"apabila  10%  <  tujuan  yang  berorientasi  hasil<40%\",\"nilai\":\"0.15\"},{\"char\":\"E\",\"label\":\" apabila  tujuan  yang  ditetapkan  berorientasi  hasil  <  10%\",\"nilai\":\"0.05\"}]', NULL, '0.00'),
(93, 0, 0, 'A.1.2.2', 'Level 4', 'A', '1', '2', '2', 'Sasaran  telah  berorientasi hasil', '[{\"char\":\"A\",\"label\":\"apabila  lebih  dari  90%  sasaran  dalam  RPJMDes/hasil program  telah  berorientasi  hasil\",\"nilai\":\"0.7\"},{\"char\":\"B\",\"label\":\"apabila  75%<  berorientasi  hasil  <90%\",\"nilai\":\"0.55\"},{\"char\":\"C\",\"label\":\"apabila  40%<  berorientasi  hasil  <75%\",\"nilai\":\"0.35\"},{\"char\":\"D\",\"label\":\"apabila  10%  <  berorientasi  hasil  <40%\",\"nilai\":\"0.15\"},{\"char\":\"E\",\"label\":\" apabila  kondisi  jangka  menengah  dan  sasaran  yang berorientasi  hasil  <  10%\",\"nilai\":\"0.05\"}]', NULL, '0.00'),
(94, 0, 0, 'A.1.2.3', 'Level 4', 'A', '1', '2', '3', 'Indikator  kinerja  sasaran (outcome  dan  output)  telah memenuhi  kriteria  indikator kinerja  yang  baik', '[{\"char\":\"A\",\"label\":\"apabila  lebih  dari  90%  indikator  sasaran  dalam RPJMD/RPJMDes  telah  memenuhi  kriteria  SMART  dan Cukup\",\"nilai\":\"0.7\"},{\"char\":\"B\",\"label\":\"apabila  75%<  Indikator  SMART<  90%\",\"nilai\":\"0.55\"},{\"char\":\"C\",\"label\":\" apabila  40%<  Indikator  SMART<75%\",\"nilai\":\"0.35\"},{\"char\":\"D\",\"label\":\" apabila  10%<  Indikator  SMART<40%\",\"nilai\":\"0.15\"},{\"char\":\"E\",\"label\":\"apabila  indikator  yang  SMART  <  10%\",\"nilai\":\"0.05\"}]', NULL, '0.00'),
(95, 0, 0, 'A.1.2.4', 'Level 4', 'A', '1', '2', '4', 'Target  kinerja  ditetapkan dengan  baik', '[{\"char\":\"A\",\"label\":\"apabila  >  90%  target  yang  ditetapkan  memenuhi seluruh  kriteria  target  yang  baik\",\"nilai\":\"0.7\"},{\"char\":\"B\",\"label\":\"apabila  75%  <  target  yang  memenuhi  seluruh  kriteria  < 90%\",\"nilai\":\"0.55\"},{\"char\":\"C\",\"label\":\"apabila  sebagian  besar  (  >  75%)  target  yang  ditetapkan tidak  berdasarkan  basis  data  yang  memadai  dan argumen  yang  logis\",\"nilai\":\"0.35\"},{\"char\":\"D\",\"label\":\"apabila  sebagian  besar  (  >  75%)  target  yang  ditetapkan tidak  berdasarkan  indikator  yang  SMART\",\"nilai\":\"0.15\"},{\"char\":\"E\",\"label\":\" apabila  sebagian  besar  (  >  75%)  target  yang  ditetapkan tidak  memenuhi  seluruh  kriteria  target  yang  baik\",\"nilai\":\"0.05\"}]', NULL, '0.00'),
(96, 0, 0, 'A.1.2.5', 'Level 4', 'A', '1', '2', '5', 'Bidang/Program  dan  kegiatan merupakan  cara  untuk mencapai tujuan/sasaran/hasil program/hasil kegiatan', '[{\"char\":\"A\",\"label\":\"apabila  program/kegiatan  yang  ditetapkan  telah memenuhi  seluruh  kriteria\",\"nilai\":\"0.7\"},{\"char\":\"B\",\"label\":\"apabila  program/kegiatan  yang  ditetapkan  telah memenuhi  sebagian  besar  kriteria\",\"nilai\":\"0.55\"},{\"char\":\"C\",\"label\":\"apabila  program/kegiatan  yang  ditetapkan  menjadi penyebab  tidak  langsung  terwujudnya  tujuan  dan sasaran\",\"nilai\":\"0.35\"},{\"char\":\"D\",\"label\":\"apabila  program/kegiatan  yang  ditetapkan  dianggap tidak  cukup  untuk  mencapai  tujuan  dan  sasaran\",\"nilai\":\"0.15\"},{\"char\":\"E\",\"label\":\"apabila  penetapan  program/kegiatan  mendahului  (atau tidak  disertai  dengan)  penetapan  tujuan  dan  sasaran\",\"nilai\":\"0.05\"}]', NULL, '0.00'),
(97, 0, 0, 'A.1.2.6', 'Level 4', 'A', '1', '2', '6', 'Dokumen  RPJMDes  telah selaras  dengan  Dokumen RPJMD', '[{\"char\":\"A\",\"label\":\"apabila  >  90%  tujuan  dan  sasaran  yang  ditetapkan  telah selaras\",\"nilai\":\"0.7\"},{\"char\":\"B\",\"label\":\"apabila  75%  <  tujuan  dan  sasaran  yang  selaras  <  90%\",\"nilai\":\"0.55\"},{\"char\":\"C\",\"label\":\"apabila  40%  <  tujuan  dan  sasaran  yang  selaras  <  75%\",\"nilai\":\"0.35\"},{\"char\":\"D\",\"label\":\"apabila  10%<  tujuan  dan  sasaran  yang  selaras  <  40%\",\"nilai\":\"0.15\"},{\"char\":\"E\",\"label\":\"apabila  tujuan  dan  sasaran  yang  selaras  <  10%\",\"nilai\":\"0.05\"}]', NULL, '0.00'),
(98, 0, 0, 'A.1.2.7', 'Level 4', 'A', '1', '2', '7', 'Dokumen  RPJMDes  telah menetapkan  hal-hal  yang seharusnya  ditetapkan', '[{\"char\":\"A\",\"label\":\"apabila  lebih  dari  90%  tujuan,  Sasaran  dan  indikator RPJMDes  telah  mengacu  pada  seluruh  kriteria  yang ditetapkan\",\"nilai\":\"0.8\"},{\"char\":\"B\",\"label\":\"apabila  lebih  dari  75%  tujuan,  Sasaran  dan  indikator RPJMDes  telah  mengacu  pada  seluruh  kriteria  yang ditetapkan\",\"nilai\":\"0.6\"},{\"char\":\"C\",\"label\":\"apabila  tujuan,  Sasaran  dan  indikator  RPJMDes  tidak mengacu  pada  isu  strategis  atau  praktik  terbaik\",\"nilai\":\"0.4\"},{\"char\":\"D\",\"label\":\"apabila  tujuan,  Sasaran  dan  indikator  RPJMDes  yang mengacu  pada  seluruh  kriteria  yang  ditetapkan  tidak lebih  dari  10%\",\"nilai\":\"0.2\"},{\"char\":\"E\",\"label\":\"apabila  lebih  dari  75%  tujuan\",\"nilai\":\"0.1\"}]', NULL, '0.00'),
(99, 0, 0, 'A.1.3.1', 'Level 4', 'A', '1', '3', '1', 'Dokumen  RPJMDes digunakan  sebagai  acuan penyusunan  Dokumen rencana  kinerja  tahunan (RKPDes)', '[{\"char\":\"A\",\"label\":\"apabila  lebih  dari  90%  indikator  tujuan  dan  sasaran yang  ada  di  RPJMDes  telah  selaras  dengan  indikator hasil/capaian  program   yang     ada     dalam     rencana kinerja     tahunan\",\"nilai\":\"1\"},{\"char\":\"B\",\"label\":\"apabila  75%  <  keselarasan  indikator  tujuan  dan  sasaran RPJMD/RPJMDes  dengan  indikator  hasil/capaian program  dalam  rencana  kinerja  tahunan  <90%\",\"nilai\":\"0.8\"},{\"char\":\"C\",\"label\":\" apabila  40%  <  keselarasan  indikator  tujuan  dan  sasaran RPJMD/RPJMDes  dengan  indikator hasil/capaianprogram  dalam  rencana  kinerja  tahunan <75%\",\"nilai\":\"0.6\"},{\"char\":\"D\",\"label\":\"apabila  10%  <  keselarasan  indikator  tujuan  dan  sasaran RPJMD/RPJMDes  dengan  indikator  hasil/capaian program  dalam  rencana  kinerja  tahunan  <40%\",\"nilai\":\"0.4\"},{\"char\":\"E\",\"label\":\"apabila  keselarasan  indikator  tujuan  dan  sasaran RPJMD/RPJMDes  dengan  indikator  hasil/capaian program  dalam  rencana  kinerja  tahunan  <10%\",\"nilai\":\"0.2\"}]', NULL, '0.00'),
(100, 0, 0, 'A.1.3.2', 'Level 4', 'A', '1', '3', '2', 'Target  jangka  menengah dalam  RPJMDes  telah dimonitor  pencapaiannya sampai  dengan  tahun berjalan', '[{\"char\":\"A\",\"label\":\"apabila  target  jangka  menengah  (JM)  telah  dimonitor dan  memenuhi   seluruh   kriteria   yang   disebutkan dibawah\",\"nilai\":\"1\"},{\"char\":\"B\",\"label\":\" apabila  target  JM  telah  dimonitor  berdasarkan  kriteria yang  disebutkan  dibawah,  namun  belum  seluruh rekomendasi  ditindaklanjuti\",\"nilai\":\"0.8\"},{\"char\":\"C\",\"label\":\"apabila  target  JM  telah  dimonitor   dengan   kriteria tersebut  namun  tidak  ada  tindak  lanjut  terhadap rekomendasi  yang  diberikan\",\"nilai\":\"0.6\"},{\"char\":\"D\",\"label\":\"apabila  monitoring  target  JM  dilakukan  secara insidentil,  tidak  terjadwal,  tanpa  SOP  atau  mekanisme yang  jelas\",\"nilai\":\"0.4\"},{\"char\":\"E\",\"label\":\"Target  JM  tidak  dimonitor\",\"nilai\":\"0.2\"}]', NULL, '0.00'),
(101, 0, 0, 'A.1.3.3', 'Level 4', 'A', '1', '3', '3', 'Dokumen  RPJMDes  telah direview  secara  berkala', '[{\"char\":\"A\",\"label\":\"apabila  RPJMDes  telah  direview  dan  hasilnya menunjukkan  kondisi  yang  lebih  baik  (terdapat  inovasi)\",\"nilai\":\"1\"},{\"char\":\"B\",\"label\":\"apabila  RPJMDes  telah  direview  secara  berkala  dan hasilnya  masih  relevan  dengan  kondisi  saat  ini\",\"nilai\":\"0.8\"},{\"char\":\"C\",\"label\":\"apabila  RPJMDes  telah  direview,  ada  upaya  perbaikan namun  belum  ada  perbaikan  yang  signifikan\",\"nilai\":\"0.6\"},{\"char\":\"D\",\"label\":\"apabila  RPJMDes  telah  direview\",\"nilai\":\"0.4\"},{\"char\":\"E\",\"label\":\"Tidak  ada  review/tidak  diketahui  apakah  RPJMDes masih  relevan  dengan  kondisi  saat  ini\",\"nilai\":\"0.2\"}]', NULL, '0.00'),
(102, 0, 0, 'A.2.1.1', 'Level 4', 'A', '2', '1', '1', 'Dokumen  perencanaan kinerja  tahunan  (RKPDes telah  disusun)', '[{\"char\":\"Ya\",\"label\":\"apabila  secara  formal  ada  dokumen  atau  media  yang memuat  sasaran  (kinerja/hasil),  indikator  dan  target kinerja  (bukan  kerja)  tahunan  yang  akan  dicapai  serta strategi  (program  dan  kegiatan)  untuk  mencapai  sasaran tersebut  dan   dibuat  sebelum  mengajukan  anggaran\",\"nilai\":\"1\"},{\"char\":\"Tidak\",\"label\":\"Jika  rencana  kinerja  dimaksud  tidak  menjadi  prasyarat dalam  pengajuan  anggaran\",\"nilai\":\"0\"}]', NULL, '0.00'),
(103, 0, 0, 'A.2.1.2', 'Level 4', 'A', '2', '1', '2', 'Perjanjian  Kinerja  (PK)  telah disusun', '[{\"char\":\"Ya\",\"label\":\"apabila  terdapat  dokumen  PK  yang  secara  formal  telah ditandatangani  oleh  (para)  pihak  yang  berkepentingan (Sesuai  Perbup  No.53  Tahun  2019)\",\"nilai\":\"1\"},{\"char\":\"Tidak\",\"label\":\"\",\"nilai\":\"0\"}]', NULL, '0.00'),
(104, 0, 0, 'A.2.1.3', 'Level 4', 'A', '2', '1', '3', 'PK  telah  menyajikan  IKU', '[{\"char\":\"A\",\"label\":\"apabila  lebih  dari  95%  IKU  telah  diperjanjikan  dalam PK  Pemdes\",\"nilai\":\"1\"},{\"char\":\"B\",\"label\":\"apabila  80%<  IKU  yang  telah  diperjanjikan  dalam  PK Pemdes  <  95%\",\"nilai\":\"0.8\"},{\"char\":\"C\",\"label\":\"apabila  50%<  IKU  yang  telah  diperjanjikan  dalam  PK Pemdes  <  80%\",\"nilai\":\"0.6\"},{\"char\":\"D\",\"label\":\"apabila  10%<  IKU  yang  telah  diperjanjikan  dalam  PK Pemdes  <  50%\",\"nilai\":\"0.4\"},{\"char\":\"E\",\"label\":\"apabila  IKU  yang  telah  diperjanjikan  dalam  PK Pemdes  <  10%\",\"nilai\":\"0.2\"}]', NULL, '0.00'),
(105, 0, 0, 'A.2.1.4', 'Level 4', 'A', '2', '1', '4', 'PK  telah  dipublikasikan', '[{\"char\":\"Ya\",\"label\":\"jika  dokumen  Perjanjian  Kinerja  dapat  diakses  dengan  mudah  setiap  saat  (misalnya:  melalui  website resmi  Pemerintah  Desa  atau  media  lain  yang memudahkan  publik  untuk  mengakses)\",\"nilai\":\"1\"},{\"char\":\"Tidak\",\"label\":\"\",\"nilai\":\"0\"}]', NULL, '0.00'),
(106, 0, 0, 'A.2.2.1', 'Level 4', 'A', '2', '2', '1', 'Sasaran  telah  berorientasi hasil', '[{\"char\":\"A\",\"label\":\"apabila  lebih  dari  90%  sasaran  yang  ada  di  dokumen rencana  kinerja  tahunan  dan  di  dokumen  perjanjian kinerja  telah  berorientasi  hasil\",\"nilai\":\"1\"},{\"char\":\"B\",\"label\":\" apabila  75%  <  sasaran  telah  berorientasi  hasil  <  90%\",\"nilai\":\"0.8\"},{\"char\":\"C\",\"label\":\"apabila  40%  <  sasaran  telah  berorientasi  hasil  <  75%\",\"nilai\":\"0.6\"},{\"char\":\"D\",\"label\":\"apabila  10%  <  sasaran  telah  berorientasi  hasil  <  40%\",\"nilai\":\"0.4\"},{\"char\":\"E\",\"label\":\"apabila  sasaran  telah  berorientasi  hasil  <  10%\",\"nilai\":\"0.2\"}]', NULL, '0.00'),
(107, 0, 0, 'A.2.2.2', 'Level 4', 'A', '2', '2', '2', 'Indikator  kinerja  sasaran  dan hasil  program  (outcome)  telah memenuhi  kriteria  indikator kinerja  yang  baik', '[{\"char\":\"A\",\"label\":\"apabila  lebih  dari  90%  indikator  sasaran  dan  hasil program  dalam  rencana  kinerja  tahunan  dan  PK  telah memenuhi  kriteria  SMART  dan  Cukup\",\"nilai\":\"1\"},{\"char\":\"B\",\"label\":\"apabila  75%<  Indikator  SMART<  90%\",\"nilai\":\"0.8\"},{\"char\":\"C\",\"label\":\"apabila  40%<  Indikator  SMART<75%\",\"nilai\":\"0.6\"},{\"char\":\"D\",\"label\":\" apabila  10%<  Indikator  SMART<40%\",\"nilai\":\"0.4\"},{\"char\":\"E\",\"label\":\"apabila  indikator  yang  SMART  <  10%\",\"nilai\":\"0.2\"}]', NULL, '0.00'),
(108, 0, 0, 'A.2.2.3', 'Level 4', 'A', '2', '2', '3', 'Target  kinerja  ditetapkan dengan  baik', '[{\"char\":\"A\",\"label\":\"apabila  >  90%  target  yang  ditetapkan  dalam  rencana kinerja  tahunan  dan  di  PK  memenuhi  seluruh  kriteria target  yang  baik\",\"nilai\":\"1\"},{\"char\":\"B\",\"label\":\" apabila  75%  <  target  yang  memenuhi  seluruh  kriteria <  90%\",\"nilai\":\"0.8\"},{\"char\":\"C\",\"label\":\"apabila  sebagian  besar  (  >  75%)  target  yang ditetapkan  tidak  berdasarkan  basis  data  yang memadai   dan   argumen    yang  logis\",\"nilai\":\"0.6\"},{\"char\":\"D\",\"label\":\"apabila  sebagian  besar  (  >  75%)  target  yang ditetapkan  tidak  berdasarkan  indikator  yang  SMART\",\"nilai\":\"0.4\"},{\"char\":\"E\",\"label\":\"apabila  sebagian  besar  (  >  75%)  target  yang ditetapkan  tidak  memenuhi  seluruh  kriteria  target yang  baik\",\"nilai\":\"0.2\"}]', NULL, '0.00'),
(109, 0, 0, 'A.2.2.4', 'Level 4', 'A', '2', '2', '4', 'Kegiatan  merupakan  cara untuk  mencapai  sasaran', '[{\"char\":\"A\",\"label\":\" apabila  kegiatan  yang  ditetapkan  memenuhi  seluruh kriteria\",\"nilai\":\"1\"},{\"char\":\"B\",\"label\":\" apabila  kegiatan  yang  ditetapkan  telah  memenuhi sebagian  besar  kriteria\",\"nilai\":\"0.8\"},{\"char\":\"C\",\"label\":\" apabila  kegiatan  yang  ditetapkan  menjadi  penyebab tidak  langsung  terwujudnya  sasaran\",\"nilai\":\"0.6\"},{\"char\":\"D\",\"label\":\"apabila  kegiatan  yang  ditetapkan  dianggap  tidak cukup  untuk  mencapai  sasaran\",\"nilai\":\"0.4\"},{\"char\":\"E\",\"label\":\"apabila  kegiatan  yang  ditetapkan  tidak  relevan dengan  pencapaian  sasaran\",\"nilai\":\"0.2\"}]', NULL, '0.00'),
(110, 0, 0, 'A.2.2.5', 'Level 4', 'A', '2', '2', '5', 'Kegiatan  dalam  rangka mencapai  sasaran  telah didukung  oleh  anggaran  yang memadai', '[{\"char\":\"A\",\"label\":\"Jika  untuk  setiap  sasaran  yang  ditetapkan  dapat diidentifikasikan  kegiatan  dan  anggarannya,  baik yang  bersifat  langsung  maupun  tidak  langsung\",\"nilai\":\"1\"},{\"char\":\"B\",\"label\":\"Jika  sasaran  yang  teridentifikasi  sampai  kepada anggarannya  (langsung  dan  tidak  langsung)  >  80%\",\"nilai\":\"0.8\"},{\"char\":\"C\",\"label\":\"Jika  >  50%  sasaran  hanya  dapat  dikaitkan  dengan anggaran  yang  bersifat  langsung  saja\",\"nilai\":\"0.6\"},{\"char\":\"D\",\"label\":\" Jika  sasaran  yang  terkait  dengan  anggaran  langsung <  50%\",\"nilai\":\"0.4\"},{\"char\":\"E\",\"label\":\"Jika  sasaran  ditetapkan  setelah  adanya  kegiatan  dan anggaran\",\"nilai\":\"0.2\"}]', NULL, '0.00'),
(111, 0, 0, 'A.2.2.6', 'Level 4', 'A', '2', '2', '6', 'Dokumen  PK  telah  selaras dengan  RPJMD/RPJMDes', '[{\"char\":\"A\",\"label\":\" apabila  lebih  dari  90%  sasaran  dalam  PK  telah  selaras dengan  tujuan/sasaran  RPJMD/RPJMDes/RKPD\",\"nilai\":\"1\"},{\"char\":\"B\",\"label\":\"apabila  75%  <  keselarasan  sasaran  PK  dengan RPJMD/RPJMDes/RKPD  <  90%\",\"nilai\":\"0.8\"},{\"char\":\"C\",\"label\":\"apabila  40%  <  keselarasan  sasaran  PK  dengan RPJMD/RPJMDes/RKPD  <  75%\",\"nilai\":\"0.6\"},{\"char\":\"D\",\"label\":\"apabila  10%  <  keselarasan  sasaran  PK  dengan RPJMD/RPJMDes/RKPD  <  40%\",\"nilai\":\"0.4\"},{\"char\":\"E\",\"label\":\"apabila  keselarasan  sasaran  PK  dengan RPJMD/RPJMDes/RKPD  <  10%. kriteria  selaras\",\"nilai\":\"0.2\"}]', NULL, '0.00'),
(112, 0, 0, 'A.2.2.7', 'Level 4', 'A', '2', '2', '7', 'Dokumen  PK  telah menetapkan  hal-  hal  yang seharusnya  ditetapkan  (dalam kontrak  kinerja/tugas  fungsi)', '[{\"char\":\"A\",\"label\":\"apabila  lebih  dari  90%  Sasaran  dan  indikator  PK  telah mengacu  pada  seluruh  kriteria  yang  ditetapkan\",\"nilai\":\"1\"},{\"char\":\"B\",\"label\":\" apabila  lebih  dari  75%  Sasaran  dan  indikator  PK  telah mengacu  pada  seluruh  kriteria  yang  ditetapkan\",\"nilai\":\"0.8\"},{\"char\":\"C\",\"label\":\" apabila  Sasaran  dan  indikator  PK  tidak  mengacu pada  isu  strategis  atau  praktik  terbaik  dan  tidak menggambarkan  kondisi  (outcome)  yang  seharusnya terwujud  pada  tahun  yang  bersangkutan\",\"nilai\":\"0.6\"},{\"char\":\"D\",\"label\":\"apabila  Sasaran  dan  indikator  PK  yang  mengacu  pada seluruh  kriteria  yang  ditetapkan  tidak  lebih  dari  10%\",\"nilai\":\"0.4\"},{\"char\":\"E\",\"label\":\"apabila  lebih  dari  75%  Sasaran  dan  indikator  PK  yang ditetapkan  tidak  menggambarkan  core  business  dan isu  strategis  yang  berkembang\",\"nilai\":\"0.2\"}]', NULL, '0.00'),
(113, 0, 0, 'A.2.2.8', 'Level 4', 'A', '2', '2', '8', 'Rencana  Aksi  atas  Kinerja sudah  ada', '[{\"char\":\"Ya\",\"label\":\" jika  Rencana  Aksi  (RA)  yang  dimaksud  merupakan penjabaran  lebih  lanjut  dari  target2  kinerja  yang  ada di  Perjanjian  Kinerja  (PK)\",\"nilai\":\"1\"},{\"char\":\"Tidak\",\"label\":\"\",\"nilai\":\"0\"}]', NULL, '0.00'),
(114, 0, 0, 'A.2.2.9', 'Level 4', 'A', '2', '2', '9', 'Rencana  Aksi  atas  Kinerja telah  mencantumkan  target secara  periodik  atas  kinerja', '[{\"char\":\"A\",\"label\":\"apabila  lebih  dari  90%  target  kinerja  dalam rencana/perjanjian  kinerja  tahunan  telah  (dapat) dijabarkan  lebih  lanjut  menjadi  target  periodik  dalam Rencana  Aksi  (RA)\",\"nilai\":\"1\"},{\"char\":\"B\",\"label\":\" apabila  75%  <  keselarasan  target  PK  dengan  target periodik  dalam  RA  <  90%\",\"nilai\":\"0.8\"},{\"char\":\"C\",\"label\":\"apabila  40%  <  keselarasan  target  PK  dengan  target periodik  dalam  RA  <  75%\",\"nilai\":\"0.6\"},{\"char\":\"D\",\"label\":\" apabila  10%  <  keselarasan  target  PK  dengan  target periodik  dalam  RA  <  40%\",\"nilai\":\"0.4\"},{\"char\":\"E\",\"label\":\" apabila  keselarasan  target  PK  dengan  target  periodik dalam  RA<  10% Rencana  atau  Perjanjian  Kinerja  Tahunan  harus  dapat dimanfaatkan  dalam  (selaras  dengan)  Rencana  Aksi  yang lebih  detail\",\"nilai\":\"0.2\"}]', NULL, '0.00'),
(115, 0, 0, 'A.2.2.10', 'Level 4', 'A', '2', '2', '10', 'Rencana  Aksi  atas  kinerja telah  mencantumkan  sub kegiatan/  komponen  rinci setiap  periode  yang  akan dilakukan  dalam  rangka mencapai  kinerja', '[{\"char\":\"A\",\"label\":\"Ya\",\"nilai\":\"1\"},{\"char\":\"B\",\"label\":\"Tidak\",\"nilai\":\"0\"}]', NULL, '0.00'),
(116, 0, 0, 'A.2.3.1', 'Level 4', 'A', '2', '3', '1', 'Rencana  kinerja  tahunan dimanfaatkan  dalam penyusunan  anggaran', '[{\"char\":\"Ya\",\"label\":\"Jika  target-target  kinerja  sasaran  dalam  rencana  kinerja  tahunan  menjadi  prasyarat  dalam  pengajuan dan  pengaloksian  anggaran\",\"nilai\":\"1.2\"},{\"char\":\"Tidak\",\"label\":\"Jika  target-target  kinerja  sasaran  dalam  rencana kinerja  dimaksud  tidak  menjadi  prasyarat  dalam pengajuan  anggaran\",\"nilai\":\"0\"}]', NULL, '0.00'),
(117, 0, 0, 'A.2.3.2', 'Level 4', 'A', '2', '3', '2', 'Target  kinerja  yang diperjanjikan  telah  digunakan untuk  mengukur keberhasilan', '[{\"char\":\"A\",\"label\":\"apabila  terdapat  bukti  yang  cukup  bahwa pemanfaatan  PK  yang  ditandatangani  memenuhi seluruh  kriteria  yang  ditetapkan\",\"nilai\":\"1.2\"},{\"char\":\"B\",\"label\":\"apabila  terdapat  bukti  yang  cukup  bahwa  PK  yang ditandatangani  dijadikan  dasar  untuk  mengukur  dan menyimpulkan  keberhasilan  maupun  kegagalan\",\"nilai\":\"1\"},{\"char\":\"C\",\"label\":\"apabila  terdapat  bukti  yang  cukup  bahwa  PK  yang ditandatangani  telah  diukur  dan  hasil  pengukuran telah  diketahui  oleh  atasan  (pemberi  amanah)\",\"nilai\":\"0.8\"},{\"char\":\"D\",\"label\":\"apabila  PK  yang  ditandatangani  sebatas  telah dilakukan  monitoring\",\"nilai\":\"0.6\"},{\"char\":\"E\",\"label\":\"apabila  terhadap  PK  yang  ditandatangani  tidak dilakukan  pengukuran  atau  monitoring\",\"nilai\":\"0.4\"}]', NULL, '0.00'),
(118, 0, 0, 'A.2.3.3', 'Level 4', 'A', '2', '3', '3', 'Rencana  Aksi  atas  Kinerja telah  dimonitor pencapaiannya  secara  berkala', '[{\"char\":\"A\",\"label\":\"apabila  monitoring  kinerja  telah  memenuhi  seluruh kriteria  yang  ditetapkan\",\"nilai\":\"1.2\"},{\"char\":\"B\",\"label\":\"apabila  monitoring  dilakukan  sesuai  kriteria,  kecuali penerapan  reward  and  punishment\",\"nilai\":\"1\"},{\"char\":\"C\",\"label\":\"apabila  monitoring  dilakukan  terbatas  pada penyerahan  atau  pengumpulan  hasil  pengukuran capaian  kinerja\",\"nilai\":\"0.8\"},{\"char\":\"D\",\"label\":\"apabila  pengukuran  capaian  kinerja  periodik  tidak lebih  dari  80%\",\"nilai\":\"0.6\"},{\"char\":\"E\",\"label\":\"apabila  monitoring  atau  pengukuran  capaian  target periodik<  50%\",\"nilai\":\"0.4\"}]', NULL, '0.00'),
(119, 0, 0, 'A.2.3.4', 'Level 4', 'A', '2', '3', '4', 'Rencana  Aksi  telah dimanfaatkan  dalam pengarahan  dan pengorganisasian  kegiatan', '[{\"char\":\"A\",\"label\":\"apabila  pemanfaatan  RA  telah  memenuhi  seluruh kriteria  yang  ditetapkan\",\"nilai\":\"1.2\"},{\"char\":\"B\",\"label\":\"apabila  pemanfaatan  RA  memenuhi  kriteria  yang ditetapkan  kecuali  hal  terkait  dengan  otorisasi  dan eksekusi  pelaksanaan  atau  penundaan  kegiatan\",\"nilai\":\"1\"},{\"char\":\"C\",\"label\":\"apabila  pemamfaatan  RA  terbatas  pada  pelaporan atau  dokumentasi  semata  tanpa  ada  tindakan  nyata selanjutnya\",\"nilai\":\"0.8\"},{\"char\":\"D\",\"label\":\"apabila  capaian  RA  tidak  berpengaruh  terhadap penilaian  atau  penyimpulan  capaian  kinerja\",\"nilai\":\"0.6\"},{\"char\":\"E\",\"label\":\"apabila  target-target  dalam  RA  yang  disusun  memiliki keselarasan  <  50%  dari  target2  kinerja  dalam  PK\",\"nilai\":\"0.4\"}]', NULL, '0.00'),
(120, 0, 0, 'A.2.3.5', 'Level 4', 'A', '2', '3', '5', 'Perjanjian  Kinerja  telah dimanfaatkan  untuk penyusunan  (identifikasi) kinerja  sampai  kepada  tingkat Sekdes,  Kadus  dan  Kasie', '[{\"char\":\"A\",\"label\":\"apabila  lebih  dari  90%  target  kinerja  dalam rencana/perjanjian  kinerja  tahunan  telah  (dapat) dijabarkan  lebih  lanjut  menjadi  target  kinerja  Sekdes, Kadus  dan  Kasie\",\"nilai\":\"1.2\"},{\"char\":\"B\",\"label\":\"apabila  75%  <  keselarasan  target  PK  dengan  target kinerja  Sekdes,  Kadus  dan  Kasie  <  90%\",\"nilai\":\"1\"},{\"char\":\"C\",\"label\":\"apabila  40%  <  keselarasan  target  PK  dengan  target kinerja  Sekdes,  Kadus  dan  Kasie  <  75%\",\"nilai\":\"0.8\"},{\"char\":\"D\",\"label\":\"apabila  10%  <  keselarasan  target  PK  dengan  target kinerja  Sekdes,  Kadus  dan  Kasie  <  40%\",\"nilai\":\"0.6\"},{\"char\":\"E\",\"label\":\"apabila  keselarasan  target  PK  dengan  target  kinerja Sekdes,  Kadus  dan  Kasie<  10%\",\"nilai\":\"0.4\"}]', NULL, '0.00'),
(121, 0, 0, 'B.1.1.1', 'Level 4', 'B', '1', '1', '1', 'Telah  terdapat  indikator kinerja  utama  (IKU)  sebagai ukuran  kinerja  secara  formal', '[{\"char\":\"Ya\",\"label\":\"apabila  Pemdes  telah  memiliki  Indikator  Kinerja  Utama (IKU)  level  Pemda  dan  level  Satuan  kerja  yang  telah ditetapkan  secara  formal  dalam  suatu  keputusan pimpinan\",\"nilai\":\"1.25\"},{\"char\":\"Tidak\",\"label\":\"\",\"nilai\":\"0\"}]', NULL, '0.00'),
(122, 0, 0, 'B.1.1.2', 'Level 4', 'B', '1', '1', '2', 'Telah  terdapat  ukuran  kinerja tingkat  Sekdes,  Kadus  dan Kasie  sebagai  turunan  kinerja atasannya', '[{\"char\":\"A\",\"label\":\"apabila  lebih  dari  90%  Sekdes,  Kadus  dan  Kasie  telah memiliki  ukuran  kinerja  yang  terukur\",\"nilai\":\"1.25\"},{\"char\":\"B\",\"label\":\"apabila  75%  <  Sekdes,  Kadus  dan  Kasie  yang  memiliki ukuran  kinerja  yang  terukur  <  90%\",\"nilai\":\"1\"},{\"char\":\"C\",\"label\":\"apabila  40%  <  Sekdes,  Kadus  dan  Kasie  yang  memiliki ukuran  kinerja  yang  terukur  <  75%\",\"nilai\":\"0.8\"},{\"char\":\"D\",\"label\":\"apabila  10%  <  Sekdes,  Kadus  dan  Kasie  yang  memiliki ukuran  kinerja  yang  terukur  <  40%\",\"nilai\":\"0.6\"},{\"char\":\"E\",\"label\":\"apabila  Sekdes,  Kadus  dan  Kasie  yang  memiliki  ukuran kinerja  yang  terukur  <  10%\",\"nilai\":\"0.4\"}]', NULL, '0.00'),
(123, 0, 0, 'B.1.1.3', 'Level 4', 'B', '1', '1', '3', 'Terdapat  mekanisme pengumpulan  data  kinerja', '[{\"char\":\"A\",\"label\":\" apabila  mekanisme  pengumpulan  data  kinerja memenuhi  seluruh  kriteria  yang  ditetapkan\",\"nilai\":\"1.25\"},{\"char\":\"B\",\"label\":\"apabila  mekanisme  pengumpulan  data  kinerja memenuhi  kriteria  yang  ditetapkan  kecuali  penanggung jawab  yang  jelas\",\"nilai\":\"1\"},{\"char\":\"C\",\"label\":\"apabila  >  80%  capaian  (realisasi)  kinerja  dapat  diyakini validitas  datanya\",\"nilai\":\"0.8\"},{\"char\":\"D\",\"label\":\" apabila  realisasi  data  kinerja  kurang  dapat  diyakini validitasnya  (validitas  sumber  data  diragukan)\",\"nilai\":\"0.6\"},{\"char\":\"E\",\"label\":\"apabila  realisasi  data  kinerja  tidak  dapat  diverifikasi\",\"nilai\":\"0.4\"}]', NULL, '0.00'),
(124, 0, 0, 'B.1.1.4', 'Level 4', 'B', '1', '1', '4', 'Indikator  Kinerja  Utama  telah dipublikasikan', '[{\"char\":\"Ya\",\"label\":\"jika  dokumen  yang  memuat  IKU  dapat  diakses  dengan mudah  setiap  saat.  (misalnya:  melalui  website  resmi pemerintah  Desa)\",\"nilai\":\"1.25\"},{\"char\":\"Tidak\",\"label\":\"\",\"nilai\":\"0\"}]', NULL, '0.00'),
(125, 0, 0, 'B.2.1.1', 'Level 4', 'B', '2', '1', '1', 'IKU  telah  memenuhi  kriteria indikator  yang  baik', '[{\"char\":\"A\",\"label\":\"apabila  lebih  dari  90%  IKU  telah  memenuhi  kriteria\",\"nilai\":\"1.5\"},{\"char\":\"B\",\"label\":\" apabila  75%  <  IKU  yang  telah  memenuhi  kriteria  <  90%\",\"nilai\":\"1.2\"},{\"char\":\"C\",\"label\":\"apabila  40%  <  IKU  yang  telah  memenuhi  kriteria  <  75%\",\"nilai\":\"0.9\"},{\"char\":\"D\",\"label\":\"apabila  10%  <  IKU  yang  telah  memenuhi  kriteria  <  40%\",\"nilai\":\"0.6\"},{\"char\":\"E\",\"label\":\"apabila  IKU  yang  telah  memenuhi  kriteria  <  10%\",\"nilai\":\"0.3\"}]', 'Kinerja  Utama  merupakan  hasil  kerja  yang  menggambarkan:                                                                                                                                                           -        mandat  dari  pemerintah  daerah/satuan  kerja;\r\n-        prioritas  daerah  atau  satuan  kerja;\r\n-        isu  strategik  di  daerah  tersebut;\r\n-        alasan  keberadaan  pemerintah  di  daerah  dan  alasan dibentuknya  satuan  kerja  tersebut       ', '0.00'),
(126, 0, 0, 'B.2.1.2', 'Level 4', 'B', '2', '1', '2', 'IKU  telah  cukup  untuk mengukur  kinerja', '[{\"char\":\"A\",\"label\":\"apabila  lebih  dari  90%  IKU  yang  ditetapkan  telah  cukup untuk  mengukur  atau  menggambarkan  sasaran  atau kondisi  yang  akan  diwujudkan\",\"nilai\":\"1.5\"},{\"char\":\"B\",\"label\":\"apabila  75%  <  IKU  yang  cukup  <  90%\",\"nilai\":\"1.2\"},{\"char\":\"C\",\"label\":\"apabila  40%  <  IKU  yang  cukup  <  75%\",\"nilai\":\"0.9\"},{\"char\":\"D\",\"label\":\"apabila  10%  <  IKU  yang  cukup  <  40%\",\"nilai\":\"0.6\"},{\"char\":\"E\",\"label\":\"apabila  IKU  yang  cukup  <  10%\",\"nilai\":\"0.3\"}]', 'Representatif  (alat  ukur  yg  mewakili)  untuk  mengukur kinerja  yang  seharusnya;\r\n-        Jumlahnya  memadai  utk  menyimpulkan  tercapainya', '0.00'),
(127, 0, 0, 'B.2.1.3', 'Level 4', 'B', '2', '1', '3', 'IKU  Pemdes  telah  selaras dengan  IKU  Pemda', '[{\"char\":\"A\",\"label\":\" apabila  lebih  dari  90%  IKU  Pemdes  telah  selaras  dengan IKU  Pemda\",\"nilai\":\"1.5\"},{\"char\":\"B\",\"label\":\"apabila  75%  <  keselarasan  IKU  <  90%\",\"nilai\":\"1.2\"},{\"char\":\"C\",\"label\":\"apabila  40%  <  keselarasan  IKU  <  75%\",\"nilai\":\"0.9\"},{\"char\":\"D\",\"label\":\"apabila  10%  <  keselarasan  IKU  <  40%\",\"nilai\":\"0.6\"},{\"char\":\"E\",\"label\":\"apabila  keselarasan  IKU  <  10%\",\"nilai\":\"0.3\"}]', 'Kriteria  IKU  yang  selaras:                                                                                                                                   -        IKU  Pemdes  merupakan  breakdown  dari  IKU  Pemda;\r\n-        Indikator  Kinerja  Utama  Pemdes  menjadi  penyebab\r\n(memiliki  hubungan  kausalitas)  terwujudnya  tujuan  dan sasaran  yang  ditetapkan  Pemda.', '0.00'),
(128, 0, 0, 'B.2.1.4', 'Level 4', 'B', '2', '1', '4', 'Ukuran  (Indikator)  kinerja Sekdes,  Kadus,  Kasie  telah memenuhi  kriteria  indikator kinerja  yang  baik', '[{\"char\":\"A\",\"label\":\"apabila  lebih  dari  90%  indikator  yang  ditetapkan  telah memenuhi  kriteria\",\"nilai\":\"1.5\"},{\"char\":\"B\",\"label\":\" apabila  75%  <  indikator  yang  ditetapkan    telah memenuhi  kriteria  <  90%\",\"nilai\":\"1.2\"},{\"char\":\"C\",\"label\":\" apabila  40%  <  indikator  yang  ditetapkan   telah memenuhi  kriteria  <  75%\",\"nilai\":\"0.9\"},{\"char\":\"D\",\"label\":\"apabila  10%  <  indikator  yang  ditetapkan    telah memenuhi  kriteria  <  40%\",\"nilai\":\"0.6\"},{\"char\":\"E\",\"label\":\"apabila  indikator  yang  ditetapkan  yang  telah  memenuhi kriteria  <  10%\",\"nilai\":\"0.3\"}]', 'Kriteria  minimal  indikator  kinerja  yang  baik  adalah  relevan dan  dapat  diukur  (measureable)                                                                                                                      Indikator  dikategorikan  relevan  apabila:                                                                                                           -   Menggambarkan  kinerja  atau  hasil  sesuai  dengan levelnya  terkait  langsung  dengan  kinerja  (sasaran)  atau kondisi  yang  akan  diukur;\r\n-  Mewakili  (representatif)  kinerja  (sasaran)  atau  kondisi yang  akan  diwujudkan;\r\n- Indikator  tersebut  mengindikasikan  (mencerminkan) terwujudnya  kinerja  atau  sasaran  yang  ditetapkan                                                                                                                                            Indikator  dikategorikan  dapat  diukur  apabila  :                                                                                               -        jelas  satuan  ukurannya;\r\n-  formulasi  perhitungan  dapat  diidentifikasi;\r\n-    cara  perhitungannya  disepakati  banyak  pihak.', '0.00'),
(129, 0, 0, 'B.2.1.5', 'Level 4', 'B', '2', '1', '5', 'Indikator  kinerja  Sekdes, Kadus,  Kasie  telah  selaras dengan  indikator  kinerja atasannya', '[{\"char\":\"A\",\"label\":\"apabila  lebih  dari  90%  indikator  kinerja  Sekdes,  Kadus, Kasie  kerja  telah  selaras  dengan  indikator  kinerja atasannya\",\"nilai\":\"1.5\"},{\"char\":\"B\",\"label\":\"apabila  75%  <  keselarasan  indikator  <  90%\",\"nilai\":\"1.2\"},{\"char\":\"C\",\"label\":\"apabila  40%  <  keselarasan  indikator  <  75%\",\"nilai\":\"0.9\"},{\"char\":\"D\",\"label\":\"apabila  10%  <  keselarasan  indikator  <  40%\",\"nilai\":\"0.6\"},{\"char\":\"E\",\"label\":\"apabila  keselarasan  indikator  <  10%\",\"nilai\":\"0.3\"}]', 'Kriteria  indikator  yang  selaras:                                                                                                                            -   Indikator  kinerja  Sekdes,  Kadus,  Kasie  merupakan\r\nbreakdown  dari  indikator  atasan;\r\n-  Indikator  kinerja  Sekdes,  Kadus,  Kasie  menjadi penyebab  (memiliki  hubungan  kausalitas)  terwujudnya kinerja  atasan', '0.00'),
(130, 0, 0, 'B.2.1.6', 'Level 4', 'B', '2', '1', '6', 'Pengumpulan  data  kinerja dapat  diandalkan', '[{\"char\":\"A\",\"label\":\"apabila  lebih  dari  90%  data  (capaian)  kinerja  yang dihasilkan  dapat  diandalkan\",\"nilai\":\"1.5\"},{\"char\":\"B\",\"label\":\"apabila  75%  <  data  (capaian)  kinerja  yang  dapat diandalkan  <  90%\",\"nilai\":\"1.2\"},{\"char\":\"C\",\"label\":\"apabila  40%  <  data  (capaian)  kinerja  yang  dapat diandalkan  <  75%\",\"nilai\":\"0.9\"},{\"char\":\"D\",\"label\":\"apabila  10%  <  data  (capaian)  kinerja  yang  dapat diandalkan  <  40%\",\"nilai\":\"0.6\"},{\"char\":\"E\",\"label\":\"apabila  data  (capaian)  kinerja  yang  dapat  diandalkan  < 10%. Pengumpulan  data  kinerja  dapat  diandalkan\",\"nilai\":\"0.3\"}]', 'Pengumpulan  data  kinerja  dapat  diandalkan;                                                                                                  -   Informasi  capaian  kinerja  berdasarkan  fakta  sebenarnya atau  bukti  yang  memadai   dan  dapat dipertanggungjawabkan;                                                                                                               \r\n -   Data  yang  dikumpulkan  didasarkan  suatu  mekanisme yang  memadai  atau  terstruktur  (jelas  mekanisme pengumpulan  datanya,  siapa  yg  mengumpulkan  data, mencatat,   dan  siapa  yg  mensupervisi,  serta  sumber data  valid);                                                                                                                                                                                                                                      -    Data  kinerja  yang  diperoleh  tepat  waktu;                                                                                                                           -     Data  yang  dikumpulkan  memiliki  tingkat  kesalahan yang  minimal.', '0.00'),
(131, 0, 0, 'B.2.1.7', 'Level 4', 'B', '2', '1', '7', 'Pengumpulan  data  kinerja  atas Rencana  Aksi  dilakukan  secara berkala (bulanan/triwulanan/semester)', '[{\"char\":\"Ya\",\"label\":\"apabila  seluruh  target  yang  ada  dalam  Rencana  Aksi telah  diukur  realisasinya  secara  berkala (bulanan/triwulanan/  semester)\",\"nilai\":\"1.5\"},{\"char\":\"Tidak\",\"label\":\"\",\"nilai\":\"0\"}]', '', '0.00'),
(132, 0, 0, 'B.2.1.8', 'Level 4', 'B', '2', '1', '8', 'Pengukuran  kinerja  sudah dikembangkan  menggunakan teknologi  informasi', '[{\"char\":\"Ya\",\"label\":\"apabila  Kem/Pemda  telah  melakukan  pengukuran kinerja  secara  berjenjang  mulai  dari  staf,  manajerial sampai  kepada  pimpinan  teringgi  dan  tingkat  instansi dan  pengukuran  tersebut  menggunakan  bantuan teknologi  sehingga  capaian  atau  progres  kinerja  dapat diidentifikasi  secara  lebih  tepat  dan  cepat\",\"nilai\":\"2\"},{\"char\":\"Tidak\",\"label\":\"\",\"nilai\":\"0\"}]', '', '0.00'),
(133, 0, 0, 'B.3.1.1', 'Level 4', 'B', '3', '1', '1', 'IKU  telah  dimanfaatkan  dalam dokumen-dokumen perencanaan  dan penganggaran', '[{\"char\":\"A\",\"label\":\"apabila  lebih  dari  90%  IKU  yang  ditetapkan  telah dimanfaatkan  sesuai  dengan  kriteria  yang  ditetapkan\",\"nilai\":\"1.5\"},{\"char\":\"B\",\"label\":\"apabila  75%  <  IKU  yang  telah  dimanfaatkan  <  90%\",\"nilai\":\"1.2\"},{\"char\":\"C\",\"label\":\"apabila  40%  <  IKU  yang  telah  dimanfaatkan  <  75%\",\"nilai\":\"0.9\"},{\"char\":\"D\",\"label\":\"apabila  IKU  tidak  dimanfaatkan  pada  dokumen penganggaran  (RKPDes)\",\"nilai\":\"0.6\"},{\"char\":\"E\",\"label\":\"apabila  IKU  yang  ada  tidak  dimanfaatkan,  baik  dalam perencanaan  maupun  dalam  penganggaran\",\"nilai\":\"0.3\"}]', 'Kriteria  dimanfaatkan  dalam  dokumen  perencanaan  dan penganggaran:                                                                                                                      -    dijadikan  alat  ukur  pencapaian  kondisi  jangka menengah/sasaran  utama  dalam  dokumen  Rencana Kinerja  Jangka  Menengah,  Rencana  Kinerja  Tahunan, Penganggaran  dan  Perjanjian  Kinerja;\r\n-    dijadikan  alat  ukur  tercapainya  outcome  atau  hasil- hasil  program  yang  ditetapkan  dalam  dokumen anggaran  (RKPDes).', '0.00'),
(134, 0, 0, 'B.3.1.2', 'Level 4', 'B', '3', '1', '2', 'IKU  telah  dimanfaatkan  untuk penilaian  kinerja', '[{\"char\":\"A\",\"label\":\"apabila  terdapat  bukti  yang  cukup  IKU  telah dimanfaatkan  sepenuhnya  sebagaimana  kriteria  yang ditetapkan\",\"nilai\":\"1.5\"},{\"char\":\"B\",\"label\":\"apabila  IKU  yang  ada  dimanfaatkan  sesuai  kriteria namun  tidak  termasuk  pengenaan  sanksi  atau punishment\",\"nilai\":\"1\"},{\"char\":\"C\",\"label\":\"apabila  hasil  pengukuran  IKU  tidak  berdampak  apapun bagi  entitas\",\"nilai\":\"0.5\"}]', ' Dimanfaatkan  untuk  penilaian  kinerja  memenuhi  kriteria sebagai  berikut  :                                                                                                                                                       -        Capaian  IKU  dijadikan  dasar  penilaian  kinerja;\r\n-        Capaian  IKU  dijadikan  dasar  reward  atau  punishment.', '0.00'),
(135, 0, 0, 'B.3.1.3', 'Level 4', 'B', '3', '1', '3', 'Target  kinerja  Sekdes,  Kadus, Kasie  telah  dimonitor pencapaiannya', '[{\"char\":\"A\",\"label\":\"apabila  target  kinerja  telah  dimonitor  dan  memenuhi seluruh  kriteria  yang  disebutkan  dibawah\",\"nilai\":\"1.5\"},{\"char\":\"B\",\"label\":\"apabila  target  kinerja  telah  dimonitor  berdasarkan kriteria  yang  disebutkan  dibawah,  namun  belum seluruh  rekomendasi  ditindaklanjuti\",\"nilai\":\"1.2\"},{\"char\":\"C\",\"label\":\"pabila  target  kinerja  telah  dimonitor  dengan  kriteria tersebut  namun  tidak  ada  tindak  lanjut  terhadap rekomendasi  yang  diberikan\",\"nilai\":\"0.9\"},{\"char\":\"D\",\"label\":\"apabila  monitoring  target  kinerja  dilakukan  secara insidentil,  tidak  terjadual,  tanpa  SOP  atau  mekanisme yang  jelas\",\"nilai\":\"0.6\"},{\"char\":\"E\",\"label\":\" Target  kinerja  tidak  dimonitor\",\"nilai\":\"0.3\"}]', 'Monitoring  target  (kinerja)  mengacu  pada  prasyarat  sebagai\r\nberikut:                                                                                                                                                                           -        Terdapat  breakdown  target  kinerja  tahunan  kedalam target-target  bulanan/periodik  yang  selaras  dan terukur;\r\n-        Terdapat  pihak  atau  bagian  yang  bertanggungjawab untuk  melaporkan  dan  yang  memonitor  kinerja  secara\r\nperiodik;                                                                                                                                                                             -        Terdapat  jadual,  mekanisme  atau  SOP  yang  jelas tentang  mekanisme  monitoring  kinerja  secara  periodik;\r\n-        Terdapat  dokumentasi  hasil  monitoring;\r\n-        Terdapat  tindak  lanjut  atas  hasil  monitoring.', '0.00'),
(136, 0, 0, 'B.3.1.4', 'Level 4', 'B', '3', '1', '4', 'Hasil  pengukuran  (capaian) kinerja  mulai  dari  setingkat Kasie  keatas  telah  dikaitkan dengan  (dimanfaatkan  sebagai dasar  pemberian)  reward  dan punishment', '[{\"char\":\"A\",\"label\":\" Jika  seluruh  jabatan  setingkat  Kasie  keatas  telah menerima  reward  dan  punishment  yang  sebanding (terkait)  dengan  hasil  pengukuran  (capaian)  kinerjanya\",\"nilai\":\"1.5\"},{\"char\":\"B\",\"label\":\" Jika  70%  <  pejabat  yg  memiliki  keterkaitan  capaian dengan  reward  dan  punishmentnya  <  100%\",\"nilai\":\"1.2\"},{\"char\":\"C\",\"label\":\"Jika  50%  <  pejabat  yg  memiliki  keterkaitan  capaian dengan  reward  dan  punishmentnya  <  70%\",\"nilai\":\"0.9\"},{\"char\":\"D\",\"label\":\"Jika  10%  <  pejabat  yg  memiliki  keterkaitan  capaian dengan  reward  dan  punishmentnya  <  50%\",\"nilai\":\"0.6\"},{\"char\":\"E\",\"label\":\"Jika  capaian  kinerja  tidak  memiliki  keterkaitan  dengan reward  dan  punishmentnya\",\"nilai\":\"0.3\"}]', 'hasil  pengukuran  dikatakan  terkait  dengan  reward  dan punishment  apabila  terdapat  perbedaan(dapat  diidentifikasi)  tingkat  reward  dan  punishment  antara:                                                                 -   pejabat/pegawai  yang  berkinerja  dengan  yang  tidak berkinerja  (tidak  jelas  kinerjanya);\r\n-  pejabat/pegawai  yang  mencapai  target  dengan  yang tidak  mencapai  target;\r\n-   pejabat/pegawai  yang  selesai  tepat  waktu  dengan  yang tidak  tepat  waktu  (tidak  selesai);\r\n-  pejabat/pegawai  dengan  capaian  diatas  standar  dengan yang  standar.', '0.00'),
(137, 0, 0, 'B.3.1.5', 'Level 4', 'B', '3', '1', '5', 'IKU  telah  direview  secara berkala', '[{\"char\":\"A\",\"label\":\" apabila  IKU  telah  direvisi  dan  hasilnya  menunjukkan kondisi  yang  lebih  baik  (inovatif)\",\"nilai\":\"1.5\"},{\"char\":\"B\",\"label\":\"apabila  IKU  telah  direview  secara  berkala  dan  hasilnya masih  relevan  dengan  kondisi  saat  ini\",\"nilai\":\"1.2\"},{\"char\":\"C\",\"label\":\" apabila  IKU  telah  direview,  ada  upaya  perbaikan  namun belum  ada  perbaikan  yang  signifikan\",\"nilai\":\"0.9\"},{\"char\":\"D\",\"label\":\" apabila  IKU  telah  direview\",\"nilai\":\"0.6\"},{\"char\":\"E\",\"label\":\"Tidak  ada  review\",\"nilai\":\"0.3\"}]', '', '0.00'),
(138, 0, 0, 'C.1.1.1', 'Level 4', 'C', '1', '1', '1', 'Laporan  Kinerja  telah  disusun', '[{\"char\":\"A\",\"label\":\"Ya\",\"nilai\":\"0.75\"},{\"char\":\"B\",\"label\":\"Tidak\",\"nilai\":\"0\"}]', '', '0.00'),
(139, 0, 0, 'C.1.1.2', 'Level 4', 'C', '1', '1', '2', 'Laporan  Kinerja  telah disampaikan  tepat  waktu', '[{\"char\":\"A\",\"label\":\"Ya\",\"nilai\":\"0.75\"},{\"char\":\"B\",\"label\":\"Tidak\",\"nilai\":\"0\"}]', '', '0.00'),
(140, 0, 0, 'C.1.1.3', 'Level 4', 'C', '1', '1', '3', 'Laporan  Kinerja  telah  di  upload kedalam  website', '[{\"char\":\"A\",\"label\":\"Ya\",\"nilai\":\"0.75\"},{\"char\":\"B\",\"label\":\"Tidak\",\"nilai\":\"0\"}]', '', '0.00'),
(141, 0, 0, 'C.1.1.4', 'Level 4', 'C', '1', '1', '4', 'Laporan  Kinerja  menyajikan informasi  mengenai pencapaian  IKU', '[{\"char\":\"A\",\"label\":\"apabila  lebih  dari  90%  capaian  yang  disajikan  bersifat Kinerja  Utama  IKU)\",\"nilai\":\"0.75\"},{\"char\":\"B\",\"label\":\"apabila  75%  <  capaian  yang  disajikan  bersifat  Kinerja Utama  (IKU)  <  90%\",\"nilai\":\"0.6\"},{\"char\":\"C\",\"label\":\"apabila  40%  <  capaian  yang  disajikan  bersifat  Kinerja Utama  (IKU)  <  75%\",\"nilai\":\"0.45\"},{\"char\":\"D\",\"label\":\" apabila  10%  <  capaian  yang  disajikan  bersifat  Kinerja Utama  (IKU)  <  40%\",\"nilai\":\"0.3\"},{\"char\":\"E\",\"label\":\"apabila  capaian  yang  disajikan  bersifat  Kinerja  Utama (IKU)  <  10%\",\"nilai\":\"0.15\"}]', 'IKU  yang  disajikan  harus  mengacu  kepada  kriteria  IKU  yang\r\nbaik  yaitu  SMART  dan  menggambarkan  kinerja  utama  yang seharusnya.  dengan  mengacu  pada  kriteria  sebagai  berikut  :                                                                                                                                                                 -   sesuai  dengan  tugas  dan  fungsi;\r\n-   menggambarkan  core  business;', '0.00');
INSERT INTO `kriteria_indikator` (`id_kriteria_indikator`, `id_wilayah`, `periode`, `kode`, `level`, `level_1`, `level_2`, `level_3`, `level_4`, `teks`, `alternatif`, `keterangan`, `bobot`) VALUES
(142, 0, 0, 'C.2.1.1', 'Level 4', 'C', '2', '1', '1', 'Laporan  Kinerja  menyajikan informasi  pencapaian  sasaran yang  berorientasi  outcome', '[{\"char\":\"A\",\"label\":\"apabila  lebih  dari  90%  sasaran  yang  disampaikan  dalam Laporan  Kinerja  berorientasi  outcome\",\"nilai\":\"1\"},{\"char\":\"B\",\"label\":\"apabila  75%  <  sasaran  outcome  dalam  Laporan  Kinerja <  90%\",\"nilai\":\"0.8\"},{\"char\":\"C\",\"label\":\"apabila  40%  <  sasaran  outcome  dalam  Laporan  Kinerja <  75%\",\"nilai\":\"0.6\"},{\"char\":\"D\",\"label\":\"apabila  10%  <  sasaran  outcome  dalam  Laporan  Kinerja <  40%\",\"nilai\":\"0.4\"},{\"char\":\"E\",\"label\":\"apabila  sasaran  outcome  dalam  Laporan  Kinerja  <  10%\",\"nilai\":\"0.2\"}]', '  Informasi  Laporan  Kinerja  berorientasi  outcome  artinya:                                                                       -   Informasi  yang  disajikan  dalam  Laporan  Kinerja menggambarkan  hasil2  (termasuk  output-output penting)  yang  telah  dicapai  dan  seharusnya  tercapai sampai  dengan  saat  ini;\r\n-   Laporan  Kinerja  tidak  hanya  berfokus  pada  informasi tentang  kegiatan  atau  proses  yang  telah  dilaksanakan pada  tahun  yang  bersangkutan  digunakan;                                                                                                                                                -   Laporan  Kinerja  tidak  berorientasi  hanya  pada  informasi tentang  realisasi  seluruh  anggaran  yang  telah.', '0.00'),
(143, 0, 0, 'C.2.1.2', 'Level 4', 'C', '2', '1', '2', 'Laporan  Kinerja  menyajikan informasi  mengenai  kinerja yang  telah  diperjanjikan', '[{\"char\":\"A\",\"label\":\"apabila  lebih  dari  90%  capaian  yang  disajikan  bersifat kinerja  yang  dijanjikan/disepakati  dalam  Perjanjian Kinerja  (PK)\",\"nilai\":\"1\"},{\"char\":\"B\",\"label\":\"apabila  75%  <  capaian  yang  disajikan  bersifat  kinerja yang  dijanjikan  dalam  PK  <  90%\",\"nilai\":\"0.8\"},{\"char\":\"C\",\"label\":\"apabila  40%  <  capaian  yang  disajikan  bersifat  kinerja yang  dijanjikan  dalam  PK  <  75%\",\"nilai\":\"0.6\"},{\"char\":\"D\",\"label\":\"apabila  10%  <  capaian  yang  disajikan  bersifat  kinerja yang  dijanjikan  dalam  PK  <  40%\",\"nilai\":\"0.4\"},{\"char\":\"E\",\"label\":\"apabila  capaian  yang  disajikan  bersifat  kinerja  yang dijanjikan  dalam  PK  <  10%\",\"nilai\":\"0.2\"}]', '', '0.00'),
(144, 0, 0, 'C.2.1.3', 'Level 4', 'C', '2', '1', '3', 'Laporan  Kinerja  menyajikan evaluasi  dan  analisis  mengenai capaian  kinerja', '[{\"char\":\"A\",\"label\":\"pabila  Laporan  Kinerja  menyajikan  lebih  dari  90% sasaran  yang  dievaluasi  dan  dianalisis  capaiannya bersifat  kinerja  (outcome),  bukan  proses\",\"nilai\":\"1\"},{\"char\":\"B\",\"label\":\"apabila  75%  <  sasaran  yang  dievaluasi  dan  dianalisis capaiannya  bersifat  kinerja  (outcome),  bukan  proses  < 90%\",\"nilai\":\"0.8\"},{\"char\":\"C\",\"label\":\"apabila  40%  <  sasaran  yang  dievaluasi  dan  dianalisis capaiannya  bersifat  kinerja  (outcome),  bukan  proses  < 75%\",\"nilai\":\"0.6\"},{\"char\":\"D\",\"label\":\" apabila  10%  <  sasaran  yang  dievaluasi  dan  dianalisis capaiannya  bersifat  kinerja  (outcome),  bukan  proses  < 40%\",\"nilai\":\"0.4\"},{\"char\":\"E\",\"label\":\"apabila  sasaran  yang  dievaluasi  dan  dianalisis capaiannya  bersifat  kinerja  (outcome),  bukan  proses  < 10%\",\"nilai\":\"0.2\"}]', 'menyajikan  evaluasi  dan  analisis  mengenai  capaian  kinerja. artinya:                                                                                                                                                                                                                        -        Laporan  Kinerja  menguraikan  hasil  evaluasi  dan analisis  tentang   capaian-capaian  kinerja  outcome  atau output  penting,  bukan  hanya  proses  atau  realisasi kegiatan-kegiatan  yang  ada  di  dokumen  anggaran  (DIPA)', '0.00'),
(145, 0, 0, 'C.2.1.4', 'Level 4', 'C', '2', '1', '4', 'Laporan  Kinerja  menyajikan pembandingan  data  kinerja yang  memadai  antara  realisasi tahun  ini  dengan  realisasi tahun  sebelumnya  dan pembandingan  lain  yang diperlukan', '[{\"char\":\"A\",\"label\":\"apabila  Laporan  Kinerja  menyajikan  seluruh pembandingan  sebagaimana  yang  tercakup  dalam kriteria  dibawah\",\"nilai\":\"1\"},{\"char\":\"B\",\"label\":\"Laporan  Kinerja  menyajikan  seluruh  pembandingan sebagaimana  yang  tercakup  dalam  kriteria  dibawah, kecuali  pembandingan  dengan  standar  nasional\",\"nilai\":\"0.8\"},{\"char\":\"C\",\"label\":\"apabila  Laporan  Kinerja  hanya  menyajikan pembandingan  Realisasi  vs  Target  dan  Kinerja  tahun berjalan  vs  kinerja  tahun  sebelumnya\",\"nilai\":\"0.6\"},{\"char\":\"D\",\"label\":\"apabila  Laporan  Kinerja  hanya  menyajikan pembandingan  Realisasi  vs  Target\",\"nilai\":\"0.4\"},{\"char\":\"E\",\"label\":\"apabila  tidak  ada  pembandingan  data  kinerja  (capaian sasaran). Pembandingan  yang  memadai\",\"nilai\":\"0.2\"}]', 'mencakup:                                                                                                                                          -        Target  vs  Realisasi;\r\n-        Realisasi  tahun  berjalan  vs  realisasi  tahun  sebelumnya;\r\n-        Realisasi  sampai  dengan  tahun  berjalan  vs  target  jangka menengah;', '0.00'),
(146, 0, 0, 'C.2.1.5', 'Level 4', 'C', '2', '1', '5', 'Laporan  Kinerja  menyajikan informasi  tentang  analisis efisiensi  penggunaan  sumber daya', '[{\"char\":\"A\",\"label\":\"Jika   besaran   efisiensi  yang   terjadi  dapat dikuantifikasikan\",\"nilai\":\"1.5\"},{\"char\":\"B\",\"label\":\" Jika  hanya  berupa  info  tentang  efisiensi  yang  telah dilakukan\",\"nilai\":\"0.8\"},{\"char\":\"C\",\"label\":\"Jika  hanya  berupa  info  tentang  upaya  efisiensi  yang dilakukan\",\"nilai\":\"0.55\"},{\"char\":\"D\",\"label\":\"Jika  tidak  ada  informasi  tentang  efisiensi\",\"nilai\":\"0.3\"}]', '', '0.00'),
(147, 0, 0, 'C.2.1.6', 'Level 4', 'C', '2', '1', '6', 'Laporan  Kinerja  menyajikan informasi  keuangan  yang terkait  dengan  pencapaian sasaran  kinerja  instansi', '[{\"char\":\"A\",\"label\":\" apabila  Laporan  Kinerja  mampu  menyajikan  informasi keuangan  yang  terkait  langsung  dengan  seluruh pencapaian  sasaran  (outcome)\",\"nilai\":\"1\"},{\"char\":\"B\",\"label\":\" apabila  Laporan  Kinerja  mampu  menyajikan  informasi keuangan  atas  >  80%  sasaran\",\"nilai\":\"0.8\"},{\"char\":\"C\",\"label\":\"apabila  Laporan  Kinerja  hanya  menyajikan  informasi keuangan  atas  >  50%  sasaran\",\"nilai\":\"0.6\"},{\"char\":\"D\",\"label\":\"apabila  Laporan  Kinerja  hanya  menyajikan  realisasi keuangan  atas  <  50%  sasaran\",\"nilai\":\"0.4\"},{\"char\":\"E\",\"label\":\"apabila  tidak  ada  informasi  keuangan  yang  dapat dikaitkan  dengan  sasaran  atau  kinerja  tertentu\",\"nilai\":\"0.2\"}]', 'apabila  tidak  ada  informasi  keuangan  yang  dapat dikaitkan  dengan  sasaran  atau  kinerja  tertentu.', '0.00'),
(148, 0, 0, 'C.2.1.7', 'Level 4', 'C', '2', '1', '7', 'Informasi  kinerja  dalam Laporan  Kinerja  dapat diandalkan', '[{\"char\":\"A\",\"label\":\"apabila  lebih  dari  90%  realisasi  kinerja  dapat diandalkan  sesuai  dengan  kriteria\",\"nilai\":\"1\"},{\"char\":\"B\",\"label\":\"apabila  75%  <  keandalan  data  realisasi  kinerja  <  90%\",\"nilai\":\"0.8\"},{\"char\":\"C\",\"label\":\"apabila  40%  <  keandalan  data  realisasi  kinerja  <  75%\",\"nilai\":\"0.6\"},{\"char\":\"D\",\"label\":\"apabila  10%  <  keandalan  data  realisasi  kinerja  <  40%\",\"nilai\":\"0.4\"},{\"char\":\"E\",\"label\":\"apabila  keandalan  data  realisasi  kinerja  <  10%\",\"nilai\":\"0.2\"}]', 'Dapat  diandalkan  dengan  kriteria:                                                                                                                                                                  -        datanya  valid;\r\n-        dapat  ditelusuri  ke  sumber  datanya;\r\n-        diperoleh  dari  sumber  yang  kompeten;                                                                                                                  -        dapat  diverifikasi;\r\n-        konsisten.', '0.00'),
(149, 0, 0, 'C.3.1.1', 'Level 4', 'C', '3', '1', '1', 'Informasi  kinerja  telah digunakan  dalam  pelaksanaan evaluasi  akuntabilitas  kinerja', '[{\"char\":\"Ya\",\"label\":\"jika  informasi  kinerja  dalam  laporan  kinerja  dapat dimanfaatkan  dalam  evaluasi  AKIP                                                                                                                                                                                                                           Istilah  dapat  dimanfaatkan  sangat  terkait  dengan  kualitas informasi  kinerja\",\"nilai\":\"1.5\"},{\"char\":\"Tidak\",\"label\":\" Jika  capaian  bobot  kualitas  informasi kinerja  (C.II)  kurang  dari  60%\",\"nilai\":\"0\"}]', '', '0.00'),
(150, 0, 0, 'C.3.1.2', 'Level 4', 'C', '3', '1', '2', 'Informasi     yang     disajikan telah       digunakan       dalam perbaikan  perencanaan', '[{\"char\":\"A\",\"label\":\"apabila  pemanfaatan  bersifat  ekstensif  dan menyeluruh\",\"nilai\":\"1.5\"},{\"char\":\"B\",\"label\":\"apabila  pemanfaatan  bersifat  ekstensif  namun  belum menyeluruh  (sebagian)\",\"nilai\":\"1.2\"},{\"char\":\"C\",\"label\":\" apabila  pemanfaatan  hanya  bersifat  sebagian\",\"nilai\":\"0.9\"},{\"char\":\"D\",\"label\":\"apabila  kurang  dimanfaatkan\",\"nilai\":\"0.6\"},{\"char\":\"E\",\"label\":\"apabila  tidak  ada  pemanfaatan \",\"nilai\":\"0.4\"}]', ' telah  digunakan  dalam  perbaikan  perencanaan.  artinya:                                                                          -        Laporan  Kinerja  yang  disusun  sampai  dengan  saat  ini telah  berdampak  kepada  perbaikan  perencanaan, baik  perencanaan  jangka  menengah,  tahunan\r\nmaupun   dalam  penetapan  atau  perjanjian  kinerja yang  disusun.', '0.00'),
(151, 0, 0, 'C.3.1.3', 'Level 4', 'C', '3', '1', '3', 'Informasi  yang  disajikan telah  digunakan  untuk menilai  dan  memperbaiki pelaksanaan  program  dan kegiatan  Desa', '[{\"char\":\"A\",\"label\":\"apabila  pemanfaatan  bersifat  ekstensif  dan  menyeluruh\",\"nilai\":\"1.5\"},{\"char\":\"B\",\"label\":\" apabila  pemanfaatan  bersifat  ekstensif  namun  belum menyeluruh  (sebagian)\",\"nilai\":\"1.2\"},{\"char\":\"C\",\"label\":\"apabila  pemanfaatan  hanya  bersifat  sebagian\",\"nilai\":\"0.9\"},{\"char\":\"D\",\"label\":\"apabila  kurang  dimanfaatkan\",\"nilai\":\"0.6\"},{\"char\":\"E\",\"label\":\"apabila  tidak  ada  pemanfaatan\",\"nilai\":\"0.4\"}]', 'Pemilihan  a,  b,  c,  d,  atau  e  didasarkan  pada  professional judgement  evaluator,  dengan  tetap  memperhatikan kriteria  yang  ditetapkan.\r\nTelah  digunakan  untuk  menilai  dan  memperbaiki pelaksanaan  program  dan  kegiatan.\r\nArtinya informasi  yang  disajikan  dalam  Laporan  Kinerja  telah mengakibatkan  perbaikan  dalam  pengelolaan program  dan  kegiatan  dan  dapat  menyimpulkan\r\nkeberhasilan  atau  kegagalan  program  secara  terukur                                                                                                                                                                             ', '0.00'),
(152, 0, 0, 'D.1.1.1', 'Level 4', 'D', '1', '1', '1', 'Terdapat  pemantauan kemajuan  pencapaian  kinerja beserta  hambatannya', '[{\"char\":\"A\",\"label\":\"Ya\",\"nilai\":\"0.5\"},{\"char\":\"B\",\"label\":\"Tidak\",\"nilai\":\"0\"}]', 'YA apabila  terdapat  pemantauan  kemajuan  kinerja  dan hambatan  yang  ekstensif  dan  memenuhi  kriteria sebagaimana  disebutkan  dibawah;                                                                       - apabila  pemantauan  hanya  melalui  pertemuan-  pertemuan  yang  tidak  terdokumentasi;\r\npemantauan  mengenai  kemajuan  pencapaian  kinerja  beserta hambatannya.  artinya:                                                                                                                            -        mengidentifikasikan,  mencatat  (membuat  catatan), mencari  tahu,  mengadministrasikan  kemajuan (progress)  kinerja;\r\n-        dapat  menjawab  atau  menyimpulkan  posisi  (prestasi atau  capaian)  kinerja  terakhir;              -        mengambil  langkah  yang  diperlukan  untuk  mengatasi hambatan  pencapaian  kinerja;\r\n-        melaporkan  hasil  pemantauan  tersebut  kepada pimpinan.', '0.00'),
(153, 0, 0, 'D.1.1.2', 'Level 4', 'D', '1', '1', '2', 'Evaluasi  program  telah dilakukan', '[{\"char\":\"A\",\"label\":\"Ya\",\"nilai\":\"0.5\"},{\"char\":\"B\",\"label\":\"Tidak\",\"nilai\":\"0\"}]', 'Ya      apabila  seluruh  program  telah  dievaluasi  dan  mampu menjawab  seluruh  kriteria  sebagaimana  ditetapkan;\r\nTidak apabila  evaluasi  program  hanya  menginformasikan  pelaksanaan  program  serta kegiatannya,  tanpa    me nginformasikan  atau  menyimpulkan  keberhasilan  atau\r\nkegagalan  program;                                                                                                                                                                                                   Program  telah  dievaluasi:                                                                                                                                                                                                                                                         -        Terdapat  informasi  tentang  capaian  hasil-hasil  program;\r\n-        Terdapat  simpulan  keberhasilan  atau  ketidakberhasilan program;\r\n-        Terdapat  analisis  dan  simpulan  tentang  kondisi  sebelum dan  sesudah  dilaksanakannya  suatu  program;                                                                                                                       -        Terdapat  analisis  tentang  perubahan  target  grup  yang dituju  oleh  program;\r\n-        Terdapat  ukuran  yang  memadai  tentang  keberhasilan program.', '0.00'),
(154, 0, 0, 'D.1.1.3', 'Level 4', 'D', '1', '1', '3', 'Evaluasi  atas  pelaksanaan Rencana  Aksi  telah  dilakukan', '[{\"char\":\"A\",\"label\":\"pemantauan  rencana  aksi  dilakukan  periodik  minimal triwulan\",\"nilai\":\"1\"},{\"char\":\"B\",\"label\":\"pemantauan  rencana  aksi  dilakukan  periodik semesteran\",\"nilai\":\"0.75\"},{\"char\":\"C\",\"label\":\" pemantauan  rencana  aksi  dilakukan  periodik  tahunan\",\"nilai\":\"0.5\"},{\"char\":\"D\",\"label\":\" tidak  dilakukan  evaluasi  rencana  aksi\",\"nilai\":\"0.25\"}]', 'Rencana  Aksi  telah  dievaluasi.  dengan  kriteria:                                                                                                                                       -        Terdapat  informasi  tentang  capaian  hasil-hasil  rencana atau  agenda;                                                        -        Terdapat  simpulan  keberhasilan  atau  ketidakberhasilan rencana  atau  agenda;\r\n-        Terdapat  analisis  dan  simpulan  tentang  kondisi  sebelum dan  sesudah  dilaksanakannya  suatu  rencana  atau agenda;\r\n-        Terdapat  ukuran  yang  memadai  tentang  keberhasilan rencana  atau  agenda.', '0.00'),
(155, 0, 0, 'D.2.1.1', 'Level 4', 'D', '2', '1', '1', 'Evaluasi  program  dilaksanakan dalam  rangka  menilai keberhasilan  program', '[{\"char\":\"A\",\"label\":\"apabila  terdapat  simpulan  mengenai  keberhasilan  atau kegagalan  program  yang  dievaluasi  dan  terdapat  bukti yang  cukup  rekomendasi  telah  (akan)  ditindaklanjuti\",\"nilai\":\"0.5\"},{\"char\":\"B\",\"label\":\"apabila  terdapat  simpulan  mengenai  keberhasilan  atau kegagalan  program  yang  dievaluasi\",\"nilai\":\"0.4\"},{\"char\":\"C\",\"label\":\"apabila  evaluasi  program  telah  dilaksanakan  namun belum  menyimpulkan  keberhasilan  atau  kegagalan program  (karena  ukuran  keberhasilan  program  masih belum  jelas)\",\"nilai\":\"0.3\"},{\"char\":\"D\",\"label\":\"apabila  evaluasi  telah  dilakukan  sebatas  pelaksanaan program  dan  kegiatan  serta  penyerapan  anggaran\",\"nilai\":\"0.2\"},{\"char\":\"E\",\"label\":\" belum  dilakukan  evaluasi  program\",\"nilai\":\"0.1\"}]', 'a.      apabila  terdapat  simpulan  mengenai  keberhasilan  atau kegagalan  program  yang  dievaluasi  dan  terdapat  bukti yang  cukup  rekomendasi  telah  (akan)  ditindaklanjuti;\r\nb.      apabila  terdapat  simpulan  mengenai  keberhasilan  atau\r\nkegagalan  program  yang  dievaluasi;                                                                                                                   c.      apabila  evaluasi  program  telah  dilaksanakan  namun belum  menyimpulkan  keberhasilan  atau  kegagalan program  (karena  ukuran  keberhasilan  program  masih belum  jelas);\r\nd.      apabila  evaluasi  telah  dilakukan  sebatas  pelaksanaan program  dan  kegiatan  serta  penyerapan  anggaran;\r\ne.      belum  dilakukan  evaluasi  program.', '0.00'),
(156, 0, 0, 'D.2.1.2', 'Level 4', 'D', '2', '1', '2', 'Evaluasi  program  telah memberikan  rekomendasi- rekomendasi  perbaikan perencanaan  kinerja  yang dapat  dilaksanakan', '[{\"char\":\"A\",\"label\":\" apabila  evaluasi  program  telah  disertai  rekomendasi  yg terkait  dengan  perencanaan  kinerja  dan  rekomendasi tersebut  telah  (disetujui  untuk)  dilaksanakan\",\"nilai\":\"0.5\"},{\"char\":\"B\",\"label\":\"apabila  evaluasi  program  telah  disertai  rekomendasi  yg terkait  dengan  perencanaan  kinerja  dan  80% rekomendasi  tersebut  disetujui  untuk  dilaksanakan\",\"nilai\":\"0.4\"},{\"char\":\"C\",\"label\":\"apabila  evaluasi  program  telah  disertai  rekomendasi  yg terkait  dengan  perencanaan  kinerja  dan  60% rekomendasi  tersebut  disetujui  untuk  dilaksanakan\",\"nilai\":\"0.3\"},{\"char\":\"D\",\"label\":\"apabila  evaluasi  program  telah  disertai  rekomendasi  yg terkait  dengan  perencanaan  kinerja  dan  rekomendasi yang  disetujui  untuk  dilaksanakan  tidak  lebih  dari  50%\",\"nilai\":\"0.2\"},{\"char\":\"E\",\"label\":\"apabila  evaluasi  program  tidak  disertai  rekomendasi perbaikan  perencanaan  atau  rekomendasi  tersebut  tidak dapat  dilaksanakan\",\"nilai\":\"0.1\"}]', 'a.      apabila  evaluasi  program  telah  disertai  rekomendasi  yg terkait  dengan  perencanaan  kinerja  dan  rekomendasi tersebut  telah  (disetujui  untuk)  dilaksanakan;\r\nb.      apabila  evaluasi  program  telah  disertai  rekomendasi  yg terkait  dengan  perencanaan  kinerja  dan  80% rekomendasi  tersebut  disetujui  untuk  dilaksanakan;                                             \r\nc.      apabila  evaluasi  program  telah  disertai  rekomendasi  yg terkait  dengan  perencanaan  kinerja  dan  60% rekomendasi  tersebut  disetujui  untuk  dilaksanakan;\r\nd.      apabila  evaluasi  program  telah  disertai  rekomendasi  yg terkait  dengan  perencanaan  kinerja  dan  rekomendasi yang  disetujui  untuk  dilaksanakan  tidak  lebih  dari  50%;\r\ne.      apabila  evaluasi  program  tidak  disertai  rekomendasi perbaikan  perencanaan  atau  rekomendasi  tersebut  tidak dapat  dilaksanakan.', '0.00'),
(157, 0, 0, 'D.2.1.3', 'Level 4', 'D', '2', '1', '3', 'Evaluasi  program  telah memberikan  rekomendasi- rekomendasi  peningkatan kinerja  yang  dapat dilaksanakan', '[{\"char\":\"A\",\"label\":\"apabila  evaluasi  program  telah  disertai  rekomendasi  yg terkait  dengan  peningkatan  kinerja  dan  rekomendasi  tsb telah  (disetujui  untuk)  dilaksanakan\",\"nilai\":\"1\"},{\"char\":\"B\",\"label\":\" apabila  evaluasi  program  telah  disertai  rekomendasi  yg terkait  dengan  peningkatan  kinerja  dan  80% rekomendasi  tsb  disetujui  untuk  dilaksanakan\",\"nilai\":\"0.75\"},{\"char\":\"C\",\"label\":\"apabila  evaluasi  program  telah  disertai  rekomendasi  yg terkait  dengan  peningkatan  kinerja  dan  60% rekomendasi  tsb  disetujui  untuk  dilaksanakan\",\"nilai\":\"0.5\"},{\"char\":\"D\",\"label\":\"apabila  evaluasi  program  telah  disertai  rekomendasi  yg terkait  dengan  peningkatan  kinerja  dan  rekomendasi yang  disetujui  untuk  dilaksanakan  tidak  lebih  dari  50%\",\"nilai\":\"0.25\"},{\"char\":\"E\",\"label\":\"apabila  evaluasi  program  tidak  disertai  rekomendasi perbaikan  peningkatan  kinerja  atau  rekomendasi tersebut  tidak  dapat  dilaksanakan\",\"nilai\":\"0\"}]', 'a.      apabila  evaluasi  program  telah  disertai  rekomendasi  yg terkait  dengan  peningkatan  kinerja  dan  rekomendasi  tsb telah  (disetujui  untuk)  dilaksanakan;\r\nb.      apabila  evaluasi  program  telah  disertai  rekomendasi  yg\r\nterkait  dengan  peningkatan  kinerja  dan  80% rekomendasi  tsb  disetujui  untuk  dilaksanakan;                                                                                                                                                           c.      apabila  evaluasi  program  telah  disertai  rekomendasi  yg terkait  dengan  peningkatan  kinerja  dan  60% rekomendasi  tsb  disetujui  untuk  dilaksanakan;\r\nd.      apabila  evaluasi  program  telah  disertai  rekomendasi  yg terkait  dengan  peningkatan  kinerja  dan  rekomendasi yang  disetujui  untuk  dilaksanakan  tidak  lebih  dari  50%;\r\ne.      apabila  evaluasi  program  tidak  disertai  rekomendasi perbaikan  peningkatan  kinerja  atau  rekomendasi tersebut  tidak  dapat  dilaksanakan.', '0.00'),
(158, 0, 0, 'D.2.1.4', 'Level 4', 'D', '2', '1', '4', 'Pemantauan  Rencana  Aksi dilaksanakan  dalam  rangka mengendalikan  kinerja', '[{\"char\":\"A\",\"label\":\" apabila  pemantauan  atas  Rencana  aksi  telah  dilakukan secara  bulanan\",\"nilai\":\"1\"},{\"char\":\"B\",\"label\":\"apabila  pemantauan  atas  Rencana  aksi  telah  dilakukan secara  triwulan\",\"nilai\":\"0.75\"},{\"char\":\"C\",\"label\":\" jika  terdapat  penilaian  atas  seluruh  aksi  yang dilaksanakan  dan  tidak  ada  alternatif  yang  diberikan\",\"nilai\":\"0.5\"},{\"char\":\"D\",\"label\":\"jika  tidak  terdapat  penilaian  dan  tidak  ada  alternatif yang  diberikan\",\"nilai\":\"0.25\"},{\"char\":\"E\",\"label\":\" jika  tidak  terdapat  pemantauan\",\"nilai\":\"0\"}]', 'a.      apabila  pemantauan  atas  Rencana  aksi  telah  dilakukan secara  bulanan;\r\nb.      apabila  pemantauan  atas  Rencana  aksi  telah  dilakukan\r\nsecara  triwulan;                                                                                                                                                                         c.      apabila  pemantauan  atas  Rencana  aksi  telah  dilakukan secara  semesteran;\r\nd.      apabila  evaluasi  atas  Rencana  aksi  telah  dilakukan secara  tahunan;\r\ne.      apabila  tidak  dilakukan  pemantauan  Rencana  aksi.', '0.00'),
(159, 0, 0, 'D.2.1.5', 'Level 4', 'D', '2', '1', '5', 'Pemantauan  Rencana  Aksi telah  memberikan  alternatif perbaikan  yang  dapat dilaksanakan', '[{\"char\":\"A\",\"label\":\"jika  terdapat  penilaian  atas  seluruh  aksi  yang dilaksanakan  dan  alternatif  yang  diberikan\",\"nilai\":\"1\"},{\"char\":\"B\",\"label\":\"Jika  terdapat  penilaian  atas  seluruh  aksi  yang dilaksanakan  dan  sebagian  alternatif  yang  diberikan;\",\"nilai\":\"0.75\"},{\"char\":\"C\",\"label\":\"jika  terdapat  penilaian  atas  seluruh  aksi  yang dilaksanakan  dan  tidak  ada  alternatif  yang  diberikan\",\"nilai\":\"0.5\"},{\"char\":\"D\",\"label\":\"Jika  tidak  terdapat  penilaian  dan  tidak  ada  alternatif yang  diberikan\",\"nilai\":\"0.25\"},{\"char\":\"E\",\"label\":\" jika  tidak  terdapat  pemantauan\",\"nilai\":\"0\"}]', 'a.      jika  terdapat  penilaian  atas  seluruh  aksi  yang dilaksanakan  dan  alternatif  yang  diberikan;\r\nb.      jika  terdapat  penilaian  atas  seluruh  aksi  yang dilaksanakan  dan  sebagian  alternatif  yang  diberikan;\r\nc.        jika  terdapat  penilaian  atas  seluruh  aksi  yang dilaksanakan  dan  tidak  ada  alternatif  yang  diberikan;\r\nd.       jika  tidak  terdapat  penilaian  dan  tidak  ada  alternatif yang  diberikan;\r\ne.      jika  tidak  terdapat  pemantauan', '0.00'),
(160, 0, 0, 'D.2.1.6', 'Level 4', 'D', '2', '1', '6', 'Hasil  evaluasi  Rencana  Aksi telah  menunjukkan  perbaikan setiap  periode', '[{\"char\":\"A\",\"label\":\"Jika  setiap  triwulan  menunjukkan  perbaikan\",\"nilai\":\"1\"},{\"char\":\"B\",\"label\":\"Jika  tidak  setiap  triwulan  menunjukkan  perbaikan\",\"nilai\":\"0.7\"},{\"char\":\"C\",\"label\":\"Jika  setiap  semester  menunjukkan  perbaikan\",\"nilai\":\"0.4\"},{\"char\":\"D\",\"label\":\"Jika  tidak  ada  perbaikan\",\"nilai\":\"0.1\"}]', 'a.      Jika  setiap  triwulan  menunjukkan  perbaikan;\r\nb.      Jika  tidak  setiap  triwulan  menunjukkan  perbaikan;\r\nc.      Jika  setiap  semester  menunjukkan  perbaikan;\r\nd.      Jika  tidak  ada  perbaikan.', '0.00'),
(161, 0, 0, 'D.3.1.1', 'Level 4', 'D', '3', '1', '1', 'Hasil  evaluasi  program  telah ditindaklanjuti  untuk perbaikan  pelaksanaan program  di  masa  yang  akan datang', '[{\"char\":\"A\",\"label\":\"Jika  >  90%  rekomendasi  yang  terkait  dengan perencanaan  telah  ditindaklanjuti\",\"nilai\":\"3\"},{\"char\":\"B\",\"label\":\"Jika  75%  <  tindaklanjut  rekomendasi  yang  terkait dengan  perencanaan  u2264  90%\",\"nilai\":\"2.5\"},{\"char\":\"C\",\"label\":\"Jika  40%  <  tindaklanjut  rekomendasi  yang  terkait dengan  perencanaan  u2264  75% \",\"nilai\":\"2\"},{\"char\":\"D\",\"label\":\" Jika  10%  <  tindaklanjut  rekomendasi  yang  terkait dengan  perencanaan  u2264  40%\",\"nilai\":\"1.5\"},{\"char\":\"E\",\"label\":\"Jika  tindaklanjut  rekomendasi  yang  terkait  dengan perencanaan  u226410%\",\"nilai\":\"1\"}]', '', '0.00'),
(162, 0, 0, 'E.1.1.1', 'Level 4', 'E', '1', '1', '1', 'Target  dapat  dicapai', '[{\"char\":\"A\",\"label\":\"apabila  rata2  capaian  kinerja  lebih  dari  110%\",\"nilai\":\"3\"},{\"char\":\"B\",\"label\":\"apabila  90%  <  rata2  capaian  kinerja<  110%\",\"nilai\":\"2.5\"},{\"char\":\"C\",\"label\":\"apabila  60%  <  rata2  capaian  kinerja  <  90%\",\"nilai\":\"2\"},{\"char\":\"D\",\"label\":\"apabila  40%  <  rata2  capaian  kinerja  <  60%\",\"nilai\":\"1.5\"},{\"char\":\"E\",\"label\":\"apabila  rata2  capaian  kinerja  <  40%\",\"nilai\":\"0\"}]', '', '0.00'),
(163, 0, 0, 'E.1.1.2', 'Level 4', 'E', '1', '1', '2', 'Capaian  kinerja  lebih  baik  dari tahun  sebelumnya', '[{\"char\":\"A\",\"label\":\"apabila  lebih  dari  120%  rata2  capaian  kinerja  tahun berjalan  melebihi  capaian  tahun  sebelumnya\",\"nilai\":\"3\"},{\"char\":\"B\",\"label\":\" apabila  110%  <  rata2  capaian  kinerja  tahun  berjalan yang  melebihi  tahun  sebelumnya<  120%\",\"nilai\":\"2.5\"},{\"char\":\"C\",\"label\":\"apabila  90%  <  rata2  capaian  kinerja  tahun  berjalan yang  melebihi  tahun  sebelumnya  <  110%\",\"nilai\":\"2\"},{\"char\":\"D\",\"label\":\"apabila  60%  <  rata2  capaian  kinerja  tahun  berjalan yang  melebihi  tahun  sebelumnya  <  90%\",\"nilai\":\"1.5\"},{\"char\":\"E\",\"label\":\"apabila  rata2  capaian  kinerja  tahun  berjalan  yang melebihi  tahun  sebelumnya  <  60%\",\"nilai\":\"0\"}]', '', '0.00'),
(164, 0, 0, 'E.1.1.3', 'Level 4', 'E', '1', '1', '3', 'Informasi  mengenai  kinerja dapat  diandalkan', '[{\"char\":\"A\",\"label\":\"apabila  informasi  capaian  output  memenuhi  kriteria sebagaimana  yang  ditetapkan\",\"nilai\":\"1.5\"},{\"char\":\"B\",\"label\":\"apabila  lebih  dari  80%  capaian  output  memenuhi kriteria  sebagaimana  yang  ditetapkan\",\"nilai\":\"0.75\"},{\"char\":\"C\",\"label\":\" apabila  lebih  dari  60%  capaian  output  memenuhi kriteria  sebagaimana  yang  ditetapkan\",\"nilai\":\"0.5\"},{\"char\":\"D\",\"label\":\" apabila  sebagin  besar  informasi  capaian  output  sangat diragukan  validitas  datanya\",\"nilai\":\"0.25\"},{\"char\":\"E\",\"label\":\"apabila  capaian  output  tidak  dapat  diandalkan\",\"nilai\":\"0\"}]', 'Informasi  kinerja  dapat  diandalkan.  dengan  kriteria  sebagai berikut  :                                                                                                                                                                                     -        diperoleh  dari  dasar  perhitungan  (formulasi)  yang  valid;\r\n-        dihasilkan  dari  sumber2  atau  basis  data  yang  dapat dipercaya  (kompeten);\r\n-        dapat  ditelusuri  sumber  datanya;\r\n-        dapat  diverifikasi;\r\n-        up  to  date;', '0.00'),
(165, 0, 0, 'E.2.1.1', 'Level 4', 'E', '2', '1', '1', 'Target  dapat  dicapai', '[{\"char\":\"A\",\"label\":\" apabila  rata2  capaian  kinerja  lebih  dari  110%\",\"nilai\":\"4\"},{\"char\":\"B\",\"label\":\"apabila  90%  <  rata2  capaian  kinerja<  110%\",\"nilai\":\"3\"},{\"char\":\"C\",\"label\":\"apabila  60%  <  rata2  capaian  kinerja  <  90%\",\"nilai\":\"2\"},{\"char\":\"D\",\"label\":\"apabila  40%  <  rata2  capaian  kinerja  <  60%\",\"nilai\":\"1\"},{\"char\":\"E\",\"label\":\"apabila  rata2  capaian   kinerja   <   40%. (Jawaban  ditulis  pada  lembar  KKE1-I  Capaian)\",\"nilai\":\"0\"}]', '', '0.00'),
(166, 0, 0, 'E.2.1.2', 'Level 4', 'E', '2', '1', '2', 'Capaian  kinerja  lebih  baik  dari tahun  sebelumnya', '[{\"char\":\"A\",\"label\":\"apabila  lebih  dari  120%  rata2  capaian  kinerja  tahun berjalan  melebihi  capaian  tahun  sebelumnya\",\"nilai\":\"4\"},{\"char\":\"B\",\"label\":\"apabila  110%  <  rata2  capaian  kinerja  tahun  berjalan yang  melebihi  tahun  sebelumnya<  120%\",\"nilai\":\"3\"},{\"char\":\"C\",\"label\":\"apabila  90%  <  rata2  capaian  kinerja  tahun  berjalan yang  melebihi  tahun  sebelumnya  <  110%\",\"nilai\":\"2\"},{\"char\":\"D\",\"label\":\"apabila  60%  <  rata2  capaian  kinerja  tahun  berjalan yang  melebihi  tahun  sebelumnya  <  90%\",\"nilai\":\"1\"},{\"char\":\"E\",\"label\":\"apabila  rata2  capaian  kinerja  tahun  berjalan  yang melebihi  tahun  sebelumnya  <  60%\",\"nilai\":\"0\"}]', '(Jawaban  ditulis  pada  lembar  KKE1-I  Capaian)', '0.00'),
(167, 0, 0, 'E.2.1.3', 'Level 4', 'E', '2', '1', '3', 'Informasi  mengenai  kinerja dapat  diandalkan', '[{\"char\":\"A\",\"label\":\"apabila  informasi  capaian  output  memenuhi  kriteria sebagaimana  yang  ditetapkan\",\"nilai\":\"4.5\"},{\"char\":\"B\",\"label\":\"apabila  lebih  dari  80%  capaian  output  memenuhi kriteria  sebagaimana  yang  ditetapkan\",\"nilai\":\"3.5\"},{\"char\":\"C\",\"label\":\" apabila  lebih  dari  60%  capaian  output  memenuhi kriteria  sebagaimana  yang  ditetapkan\",\"nilai\":\"2.5\"},{\"char\":\"D\",\"label\":\"apabila  sebagin  besar  informasi  capaian  output  sangat diragukan  validitas  datanya\",\"nilai\":\"1.5\"},{\"char\":\"E\",\"label\":\"apabila  capaian  output  tidak  dapat  diandalkan\",\"nilai\":\"0\"}]', 'Informasi  kinerja  dapat  diandalkan.  dengan  kriteria  sebagai berikut  :                                                                                                                                                                                     -        diperoleh  dari  dasar  perhitungan  (formulasi)  yang  valid;\r\n-        dihasilkan  dari  sumber2  atau  basis  data  yang  dapat dipercaya  (kompeten);\r\n-        dapat  ditelusuri  sumber  datanya;\r\n-        dapat  diverifikasi;\r\n-        up  to  date;', '0.00');

-- --------------------------------------------------------

--
-- Table structure for table `log`
--

DROP TABLE IF EXISTS `log`;
CREATE TABLE IF NOT EXISTS `log` (
  `id_log` int(10) NOT NULL AUTO_INCREMENT,
  `id_akses` int(11) NOT NULL,
  `datetime_log` datetime NOT NULL,
  `kategori_log` text NOT NULL,
  `deskripsi_log` text NOT NULL,
  PRIMARY KEY (`id_log`),
  KEY `id_akses` (`id_akses`)
) ENGINE=InnoDB AUTO_INCREMENT=127 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `log`
--

INSERT INTO `log` (`id_log`, `id_akses`, `datetime_log`, `kategori_log`, `deskripsi_log`) VALUES
(1, 1, '2025-02-16 19:21:39', 'Akses', 'Tambah Akses'),
(2, 1, '2025-02-16 19:23:36', 'Akses', 'Tambah Akses'),
(3, 1, '2025-02-16 19:25:11', 'Akses', 'Tambah Akses'),
(4, 1, '2025-02-16 19:31:22', 'Akses', 'Tambah Akses'),
(5, 1, '2025-02-16 19:35:21', 'Akses', 'Tambah Akses'),
(6, 1, '2025-02-16 19:36:24', 'Akses', 'Tambah Akses'),
(7, 1, '2025-02-16 21:28:15', 'Akses', 'Update Akses Berhasil'),
(8, 1, '2025-02-16 21:28:24', 'Akses', 'Update Akses Berhasil'),
(9, 1, '2025-02-16 22:15:51', 'Akses', 'Tambah Akses'),
(10, 1, '2025-02-16 22:41:32', 'Akses', 'Update Password Berhasil'),
(11, 1, '2025-02-16 23:17:21', 'Akses', 'Edit Foto'),
(12, 1, '2025-02-16 23:18:58', 'Akses', 'Edit Foto'),
(13, 1, '2025-02-17 00:14:04', 'Akses', 'Hapus Akses Berhasil'),
(14, 1, '2025-02-17 00:14:19', 'Akses', 'Tambah Akses'),
(15, 1, '2025-02-17 00:14:36', 'Akses', 'Tambah Akses'),
(16, 1, '2025-02-17 01:05:03', 'OPD', 'Tambah OPD'),
(17, 1, '2025-02-17 01:06:10', 'OPD', 'Tambah OPD'),
(18, 1, '2025-02-17 01:40:35', 'OPD', 'Tambah OPD'),
(19, 1, '2025-02-17 03:17:23', 'OPD', 'Tambah OPD'),
(20, 1, '2025-02-17 03:17:29', 'OPD', 'Tambah OPD'),
(21, 1, '2025-02-17 03:22:52', 'OPD', 'Hapus OPD'),
(22, 1, '2025-02-17 03:26:29', 'OPD', 'Hapus OPD'),
(23, 1, '2025-02-17 03:50:40', 'Inspektorat', 'Tambah Inspektorat Berhasil'),
(24, 1, '2025-02-17 03:51:00', 'Inspektorat', 'Tambah Inspektorat Berhasil'),
(25, 1, '2025-02-17 03:51:18', 'Inspektorat', 'Tambah Inspektorat Berhasil'),
(26, 1, '2025-02-17 03:51:36', 'Inspektorat', 'Tambah Inspektorat Berhasil'),
(27, 1, '2025-02-17 03:51:57', 'Inspektorat', 'Tambah Inspektorat Berhasil'),
(28, 1, '2025-02-17 19:29:04', 'Akses', 'Tambah Akses'),
(29, 1, '2025-02-17 19:30:04', 'Akses', 'Tambah Akses'),
(30, 1, '2025-02-17 19:31:27', 'Akses', 'Tambah Akses'),
(31, 1, '2025-02-17 19:37:00', 'Akses', 'Tambah Akses'),
(32, 1, '2025-02-17 19:38:52', 'Akses', 'Tambah Akses'),
(33, 1, '2025-02-17 19:43:13', 'Akses', 'Tambah Akses'),
(34, 1, '2025-02-17 19:52:23', 'Akses', 'Update Akses Berhasil'),
(35, 1, '2025-02-17 22:56:18', 'Akses', 'Hapus Akses Berhasil'),
(36, 1, '2025-02-17 23:52:16', 'Akses', 'Update Password Berhasil'),
(37, 1, '2025-02-17 23:52:39', 'Akses', 'Update Password Berhasil'),
(38, 1, '2025-02-18 00:25:12', 'Akses', 'Edit Foto'),
(39, 1, '2025-02-18 00:26:12', 'Akses', 'Edit Foto'),
(40, 1, '2025-02-18 00:27:19', 'Akses', 'Edit Foto'),
(41, 1, '2025-02-18 00:28:08', 'Akses', 'Edit Foto'),
(42, 1, '2025-02-18 00:28:20', 'Akses', 'Edit Foto'),
(43, 1, '2025-02-18 00:28:33', 'Akses', 'Edit Foto'),
(44, 1, '2025-02-18 00:29:25', 'Akses', 'Edit Foto'),
(45, 1, '2025-02-18 00:32:47', 'Akses', 'Update Akses Berhasil'),
(46, 1, '2025-02-18 01:24:29', 'Akses', 'Update Akses Berhasil'),
(47, 1, '2025-02-18 01:24:38', 'Akses', 'Update Akses Berhasil'),
(48, 1, '2025-02-18 01:24:46', 'Akses', 'Update Akses Berhasil'),
(49, 1, '2025-02-18 01:25:00', 'Akses', 'Update Akses Berhasil'),
(50, 1, '2025-02-18 01:29:06', 'Akses', 'Hapus Akses Berhasil'),
(51, 1, '2025-02-18 02:08:44', 'Akses', 'Edit Akses'),
(52, 1, '2025-02-18 02:08:58', 'Akses', 'Edit Akses'),
(53, 1, '2025-02-18 02:09:20', 'Akses', 'Edit Akses'),
(54, 1, '2025-02-18 02:58:15', 'Akses', 'Edit Akses'),
(55, 1, '2025-02-18 10:43:14', 'Akses', 'Tambah Akses'),
(56, 1, '2025-02-18 10:45:23', 'Akses', 'Edit Akses'),
(57, 1, '2025-02-18 10:45:38', 'Akses', 'Edit Password'),
(58, 1, '2025-02-18 21:44:42', 'Setting', 'Setting General'),
(59, 1, '2025-02-19 13:32:22', 'Akses', 'Tambah Akses'),
(60, 29, '2025-02-19 13:51:15', 'OPD', 'Tambah OPD'),
(61, 29, '2025-02-19 13:53:22', 'Inspektorat', 'Update Inspektorat Berhasil'),
(62, 29, '2025-02-19 13:58:09', 'Akses', 'Tambah Akses'),
(63, 29, '2025-02-19 13:59:13', 'OPD', 'Tambah OPD'),
(64, 29, '2025-02-19 14:02:41', 'Periode Evaluasi', 'Edit Periode Evaluasi'),
(65, 1, '2025-02-19 16:27:11', 'Komponen', 'Tambah Komponen'),
(66, 1, '2025-02-19 16:29:43', 'Sub Komponen', 'Tambah Sub Komponen'),
(67, 1, '2025-02-19 16:37:52', 'Uraian', 'Tambah Uraian'),
(68, 29, '2025-02-19 16:59:01', 'Sub Komponen', 'Tambah Sub Komponen'),
(69, 29, '2025-02-19 16:59:44', 'Sub Komponen', 'Hapus Sub Komponen'),
(70, 29, '2025-02-19 17:00:35', 'Sub Komponen', 'Edit Sub Komponen'),
(71, 29, '2025-02-19 17:02:03', 'Kriteria', 'Tambah Kriteria'),
(72, 29, '2025-02-19 17:02:24', 'Kriteria', 'Edit Kriteria'),
(73, 29, '2025-02-19 17:11:28', 'Uraian', 'Update Lampiran Uraian'),
(74, 29, '2025-02-19 17:39:43', 'Uraian', 'Hapus Uraian'),
(75, 29, '2025-02-19 17:40:55', 'Uraian', 'Edit Uraian'),
(76, 29, '2025-02-19 17:42:49', 'Uraian', 'Tambah Uraian'),
(77, 29, '2025-02-19 17:43:26', 'Uraian', 'Hapus Uraian'),
(78, 29, '2025-02-20 22:32:10', 'Kriteria', 'Tambah Kriteria'),
(79, 29, '2025-02-20 23:01:33', 'Uraian', 'Tambah Uraian'),
(80, 29, '2025-02-20 23:03:38', 'Uraian', 'Edit Uraian'),
(81, 29, '2025-02-20 23:04:07', 'Uraian', 'Edit Uraian'),
(82, 29, '2025-02-20 23:05:21', 'Sub Komponen', 'Tambah Sub Komponen'),
(83, 29, '2025-02-20 23:06:47', 'Sub Komponen', 'Edit Sub Komponen'),
(84, 29, '2025-02-20 23:07:58', 'Uraian', 'Tambah Uraian'),
(85, 29, '2025-02-20 23:09:07', 'Sub Komponen', 'Edit Sub Komponen'),
(86, 29, '2025-02-20 23:15:03', 'Kriteria', 'Tambah Kriteria'),
(87, 29, '2025-02-20 23:16:53', 'Kriteria', 'Tambah Kriteria'),
(88, 29, '2025-02-21 00:20:07', 'Kriteria', 'Hapus Kriteria'),
(89, 29, '2025-02-21 00:20:23', 'Kriteria', 'Hapus Kriteria'),
(90, 29, '2025-02-21 00:21:11', 'Kriteria', 'Tambah Kriteria'),
(91, 29, '2025-02-21 00:22:11', 'Kriteria', 'Tambah Kriteria'),
(92, 29, '2025-02-21 00:23:33', 'Kriteria', 'Tambah Kriteria'),
(93, 29, '2025-02-21 00:23:48', 'Kriteria', 'Hapus Kriteria'),
(94, 29, '2025-02-21 00:24:32', 'Kriteria', 'Tambah Kriteria'),
(95, 29, '2025-02-21 00:24:41', 'Kriteria', 'Hapus Kriteria'),
(96, 29, '2025-02-21 00:26:22', 'Sub Komponen', 'Tambah Sub Komponen'),
(97, 29, '2025-02-21 00:27:30', 'Sub Komponen', 'Hapus Sub Komponen'),
(98, 29, '2025-02-21 00:28:11', 'Sub Komponen', 'Tambah Sub Komponen'),
(99, 29, '2025-02-21 00:28:39', 'Sub Komponen', 'Hapus Sub Komponen'),
(100, 29, '2025-02-21 00:29:14', 'Sub Komponen', 'Tambah Sub Komponen'),
(101, 29, '2025-02-21 00:29:32', 'Sub Komponen', 'Hapus Sub Komponen'),
(102, 29, '2025-02-22 20:06:28', 'Komponen', 'Edit Komponen'),
(103, 29, '2025-02-22 20:07:03', 'Komponen', 'Tambah Komponen'),
(104, 29, '2025-02-22 20:08:01', 'Sub Komponen', 'Tambah Sub Komponen'),
(105, 29, '2025-02-22 20:08:36', 'Sub Komponen', 'Tambah Sub Komponen'),
(106, 29, '2025-02-22 20:09:00', 'Sub Komponen', 'Tambah Sub Komponen'),
(107, 29, '2025-02-22 20:09:59', 'Kriteria', 'Tambah Kriteria'),
(108, 29, '2025-02-22 20:10:20', 'Kriteria', 'Tambah Kriteria'),
(109, 29, '2025-02-22 20:11:48', 'Kriteria', 'Tambah Kriteria'),
(110, 29, '2025-02-22 20:13:28', 'Komponen', 'Tambah Komponen'),
(111, 29, '2025-02-22 20:13:49', 'Komponen', 'Tambah Komponen'),
(112, 29, '2025-02-22 20:14:21', 'Sub Komponen', 'Tambah Sub Komponen'),
(113, 29, '2025-02-22 20:15:29', 'Sub Komponen', 'Edit Sub Komponen'),
(114, 29, '2025-02-22 20:16:08', 'Sub Komponen', 'Tambah Sub Komponen'),
(115, 29, '2025-02-22 20:16:43', 'Sub Komponen', 'Tambah Sub Komponen'),
(116, 29, '2025-02-22 21:55:34', 'Kriteria', 'Tambah Kriteria'),
(117, 29, '2025-02-22 21:56:21', 'Kriteria', 'Tambah Kriteria'),
(118, 29, '2025-02-22 22:00:47', 'Kriteria', 'Tambah Kriteria'),
(119, 29, '2025-02-22 22:04:35', 'Kriteria', 'Edit Kriteria'),
(120, 29, '2025-02-22 22:30:21', 'Kriteria', 'Tambah Kriteria'),
(121, 29, '2025-02-22 22:30:53', 'Kriteria', 'Hapus Kriteria'),
(122, 29, '2025-02-22 22:35:19', 'Kriteria', 'Tambah Kriteria'),
(123, 29, '2025-02-22 22:54:53', 'Sub Komponen', 'Tambah Sub Komponen'),
(124, 29, '2025-02-22 22:55:40', 'Sub Komponen', 'Tambah Sub Komponen'),
(125, 29, '2025-02-22 22:56:14', 'Sub Komponen', 'Tambah Sub Komponen'),
(126, 29, '2025-02-22 22:56:59', 'Kriteria', 'Tambah Kriteria');

-- --------------------------------------------------------

--
-- Table structure for table `opd`
--

DROP TABLE IF EXISTS `opd`;
CREATE TABLE IF NOT EXISTS `opd` (
  `id_opd` int(11) NOT NULL AUTO_INCREMENT,
  `id_provinsi` int(11) DEFAULT NULL,
  `id_kabkot` int(11) NOT NULL,
  `id_inspektorat` char(36) DEFAULT NULL,
  `nama_opd` varchar(255) NOT NULL,
  `telepon` varchar(20) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_opd`),
  KEY `id_wilayah_provinsi` (`id_provinsi`),
  KEY `opd_to_kabkot` (`id_kabkot`),
  KEY `id_inspektorat` (`id_inspektorat`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `opd`
--

INSERT INTO `opd` (`id_opd`, `id_provinsi`, `id_kabkot`, `id_inspektorat`, `nama_opd`, `telepon`, `alamat`) VALUES
(1, 1, 2, NULL, 'Badan Kepegawaian dan Pengembangan Sumber Daya Manusia', '0897886758', 'Jalan Anggrek 4 Nomor 15'),
(3, 90901, 90901, NULL, 'Badan pengawas Keuangan', '02328459', ''),
(4, 90901, 90901, NULL, 'Badan pengawas Keuangan Kuningan', '02328459', ''),
(6, 90901, 90901, 'eOJaY5y4W3pAe86fBOl75YEPdWUPKlivtbQI', 'Dinas Pertanian', '0232423234', 'Jalan Anggrek 4\r\n'),
(7, 90901, 90901, 'sIZZCSiG06Akwh2qT79CycSUY9JZKWbBY24m', 'Bapeda', '0', ''),
(8, 31165, 37298, 'sIZZCSiG06Akwh2qT79CycSUY9JZKWbBY24m', 'Inspektorat', '0', '');

-- --------------------------------------------------------

--
-- Table structure for table `setting_email_gateway`
--

DROP TABLE IF EXISTS `setting_email_gateway`;
CREATE TABLE IF NOT EXISTS `setting_email_gateway` (
  `id_setting_email_gateway` int(10) NOT NULL AUTO_INCREMENT,
  `email_gateway` text,
  `password_gateway` varchar(20) DEFAULT NULL,
  `url_provider` text,
  `port_gateway` varchar(10) DEFAULT NULL,
  `nama_pengirim` varchar(25) DEFAULT NULL,
  `url_service` text NOT NULL,
  PRIMARY KEY (`id_setting_email_gateway`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `setting_email_gateway`
--

INSERT INTO `setting_email_gateway` (`id_setting_email_gateway`, `email_gateway`, `password_gateway`, `url_provider`, `port_gateway`, `nama_pengirim`, `url_service`) VALUES
(1, 'dhiforester@rsuelsyifa.com', 'solihulhadi1412', 'mail.rsuelsyifa.com', '465', 'Admin SAKIP', 'http://mailer.rsuelsyifa.com');

-- --------------------------------------------------------

--
-- Table structure for table `setting_general`
--

DROP TABLE IF EXISTS `setting_general`;
CREATE TABLE IF NOT EXISTS `setting_general` (
  `id_setting_general` int(10) NOT NULL AUTO_INCREMENT,
  `title_page` varchar(50) NOT NULL,
  `kata_kunci` varchar(255) NOT NULL,
  `deskripsi` varchar(255) NOT NULL,
  `alamat_bisnis` varchar(255) NOT NULL,
  `email_bisnis` varchar(255) NOT NULL,
  `telepon_bisnis` varchar(15) NOT NULL,
  `favicon` varchar(40) NOT NULL,
  `logo` varchar(40) NOT NULL,
  `base_url` varchar(255) NOT NULL,
  `author` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_setting_general`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `setting_general`
--

INSERT INTO `setting_general` (`id_setting_general`, `title_page`, `kata_kunci`, `deskripsi`, `alamat_bisnis`, `email_bisnis`, `telepon_bisnis`, `favicon`, `logo`, `base_url`, `author`) VALUES
(1, 'AKIP OPD', 'Sistem Akuntabilitas Kinerja Instansi Pemerintah', 'Sistem Akuntabilitas Kinerja Instansi Pemerintah', 'Kabupaten Kuningan', 'dhiforester@gmail.com', '0232875995', 'd1c440590659c240197306eb713551.png', 'aaf8cccc1d62f607f6253523ae2b4c.png', 'http://localhost:81/egoverment/app.e-sakipku.com/', 'CV.Langkuy');

-- --------------------------------------------------------

--
-- Table structure for table `uraian`
--

DROP TABLE IF EXISTS `uraian`;
CREATE TABLE IF NOT EXISTS `uraian` (
  `id_uraian` char(36) NOT NULL,
  `id_kriteria` char(36) NOT NULL,
  `id_komponen_sub` char(36) NOT NULL,
  `id_komponen` char(36) NOT NULL,
  `id_evaluasi_periode` char(36) NOT NULL,
  `kode` varchar(20) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `alternatif` json NOT NULL,
  `lampiran` json DEFAULT NULL,
  `bobot` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`id_uraian`),
  KEY `uraian_to_periode` (`id_evaluasi_periode`),
  KEY `uraian_to_komponen` (`id_komponen`),
  KEY `uraian_to_sub_komponen` (`id_komponen_sub`),
  KEY `uraian_to_kriteria` (`id_kriteria`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `uraian`
--

INSERT INTO `uraian` (`id_uraian`, `id_kriteria`, `id_komponen_sub`, `id_komponen`, `id_evaluasi_periode`, `kode`, `nama`, `alternatif`, `lampiran`, `bobot`) VALUES
('0VukPLcZ0NMSps7Rzcjz8P4exnDn4KUVgpzu', 'avElILRyln4dzs3s9CXQZZjv1Ft2fAveZLyE', 'phH1ZtOa1OyiGzF18IyALJFWSYtPbNdAGsev', '8mhAHeJOTNfFxroEraRa1di3WiQFIQk6gJrW', 'kma0qUa8iCeZV6NhFM2Ell9ss3VHca7u4Ofj', '5', 'SK IKU', '{\"type\": \"select_option\", \"alternatif\": [{\"label\": \"1\", \"value\": \"1\"}]}', '[]', '1.00'),
('QSo2HaoZjbgZfoRUoxmlTSNSSMvN7ga9vwWo', 'EgroFSrQYxEEczXw7PLeItWIv5gotVdqCxkB', 'nWYGAUnjrTRNNDizXL9s3ft7ieWocuoDEe6m', '8mhAHeJOTNfFxroEraRa1di3WiQFIQk6gJrW', 'kma0qUa8iCeZV6NhFM2Ell9ss3VHca7u4Ofj', '1', 'Pedoman teknis perencanaan kinerja', '{\"type\": \"select_option\", \"alternatif\": [{\"label\": \"1\", \"value\": \"1\"}]}', '[]', '1.00'),
('sFu8sfGjLspJNHvdfmnobAT1rYI4ejzDm3iN', 'avElILRyln4dzs3s9CXQZZjv1Ft2fAveZLyE', 'phH1ZtOa1OyiGzF18IyALJFWSYtPbNdAGsev', '8mhAHeJOTNfFxroEraRa1di3WiQFIQk6gJrW', 'kma0qUa8iCeZV6NhFM2Ell9ss3VHca7u4Ofj', '2', 'Renstra', '{\"type\": \"select_option\", \"alternatif\": [{\"label\": \"1\", \"value\": \"1\"}]}', '[]', '1.00');

-- --------------------------------------------------------

--
-- Table structure for table `wilayah_kabkot`
--

DROP TABLE IF EXISTS `wilayah_kabkot`;
CREATE TABLE IF NOT EXISTS `wilayah_kabkot` (
  `id_kabkot` int(11) NOT NULL AUTO_INCREMENT,
  `id_provinsi` int(11) NOT NULL,
  `kabkot` varchar(50) NOT NULL,
  PRIMARY KEY (`id_kabkot`),
  KEY `id_provinsi` (`id_provinsi`)
) ENGINE=InnoDB AUTO_INCREMENT=90902 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wilayah_kabkot`
--

INSERT INTO `wilayah_kabkot` (`id_kabkot`, `id_provinsi`, `kabkot`) VALUES
(2, 1, 'Kab. Simeulue'),
(151, 1, 'Kab. Aceh Singkil'),
(283, 1, 'Kab. Aceh Selatan'),
(550, 1, 'Kab. Aceh Tenggara'),
(952, 1, 'Kab. Aceh Timur'),
(1489, 1, 'Kab. Aceh Tengah'),
(1799, 1, 'Kab. Aceh Barat'),
(2134, 1, 'Kab. Aceh Besar'),
(2762, 1, 'Kab. Pidie'),
(3517, 1, 'Kab. Bireuen'),
(4144, 1, 'Kab. Aceh Utara'),
(5025, 1, 'Kab. Aceh Barat Daya'),
(5187, 1, 'Kab. Gayo Lues'),
(5343, 1, 'Kab. Aceh Tamiang'),
(5569, 1, 'Kab. Nagan Raya'),
(5803, 1, 'Kab. Aceh Jaya'),
(5986, 1, 'Kab. Bener Meriah'),
(6230, 1, 'Kab. Pidie Jaya'),
(6460, 1, 'Kota Banda Aceh'),
(6560, 1, 'Kota Sabang'),
(6580, 1, 'Kota Langsa'),
(6652, 1, 'Kota Lhokseumawe'),
(6725, 1, 'Kota Subulussalam'),
(6806, 6805, 'Kab. Nias'),
(6935, 6805, 'Kab. Mandailing Natal'),
(7364, 6805, 'Kab. Tapanuli Selatan'),
(7627, 6805, 'Kab. Tapanuli Tengah'),
(7825, 6805, 'Kab. Tapanuli Utara'),
(8093, 6805, 'Kab. Toba Samosir'),
(8354, 6805, 'Kab. Labuhan Batu'),
(8462, 6805, 'Kab. Asahan'),
(8692, 6805, 'Kab. Simalungun'),
(9091, 6805, 'Kab. Dairi'),
(9276, 6805, 'Kab. Karo'),
(9563, 6805, 'Kab. Deli Serdang'),
(9980, 6805, 'Kab. Langkat'),
(10281, 6805, 'Kab. Nias Selatan'),
(10614, 6805, 'Kab. Humbang Hasundutan'),
(10779, 6805, 'Kab. Pakpak Bharat'),
(10840, 6805, 'Kab. Samosir'),
(10984, 6805, 'Kab. Serdang Bedagai'),
(11245, 6805, 'Kab. Batu Bara'),
(11404, 6805, 'Kab. Padang Lawas Utara'),
(11802, 6805, 'Kab. Padang Lawas'),
(12119, 6805, 'Kab. Labuhan Batu Selatan'),
(12179, 6805, 'Kab. Labuhan Batu Utara'),
(12278, 6805, 'Kab. Nias Utara'),
(12403, 6805, 'Kab. Nias Barat'),
(12522, 6805, 'Kota Sibolga'),
(12544, 6805, 'Kota Tanjung Balai'),
(12582, 6805, 'Kota Pematang Siantar'),
(12644, 6805, 'Kota Tebing Tinggi'),
(12685, 6805, 'Kota Medan'),
(12858, 6805, 'Kota Binjai'),
(12901, 6805, 'Kota Padangsidimpuan'),
(12987, 6805, 'Kota Gunungsitoli'),
(13096, 20721, 'Kab. Kepulauan Mentawai'),
(13150, 20721, 'Kab. Pesisir Selatan'),
(13345, 20721, 'Kab. Solok'),
(13434, 20721, 'Kab. Sijunjung'),
(13505, 20721, 'Kab. Tanah Datar'),
(13595, 20721, 'Kab. Padang Pariaman'),
(13673, 20721, 'Kab. Agam'),
(13772, 20721, 'Kab. Lima Puluh Kota'),
(13865, 20721, 'Kab. Pasaman'),
(13910, 20721, 'Kab. Solok Selatan'),
(13957, 20721, 'Kab. Dharmasraya'),
(14021, 20721, 'Kab. Pasaman Barat'),
(14052, 20721, 'Kota Padang'),
(14168, 20721, 'Kota Solok'),
(14184, 20721, 'Kota Sawah Lunto'),
(14226, 20721, 'Kota Padang Panjang'),
(14245, 20721, 'Kota Bukittinggi'),
(14273, 20721, 'Kota Payakumbuh'),
(14355, 20721, 'Kota Pariaman'),
(14432, 6805, 'Kab. Nias'),
(14561, 6805, 'Kab. Mandailing Natal'),
(14990, 6805, 'Kab. Tapanuli Selatan'),
(15253, 6805, 'Kab. Tapanuli Tengah'),
(15451, 6805, 'Kab. Tapanuli Utara'),
(15719, 6805, 'Kab. Toba Samosir'),
(15980, 6805, 'Kab. Labuhan Batu'),
(16088, 6805, 'Kab. Asahan'),
(16318, 6805, 'Kab. Simalungun'),
(16717, 6805, 'Kab. Dairi'),
(16902, 6805, 'Kab. Karo'),
(17189, 6805, 'Kab. Deli Serdang'),
(17606, 6805, 'Kab. Langkat'),
(17907, 6805, 'Kab. Nias Selatan'),
(18240, 6805, 'Kab. Humbang Hasundutan'),
(18405, 6805, 'Kab. Pakpak Bharat'),
(18466, 6805, 'Kab. Samosir'),
(18610, 6805, 'Kab. Serdang Bedagai'),
(18871, 6805, 'Kab. Batu Bara'),
(19030, 6805, 'Kab. Padang Lawas Utara'),
(19428, 6805, 'Kab. Padang Lawas'),
(19745, 6805, 'Kab. Labuhan Batu Selatan'),
(19805, 6805, 'Kab. Labuhan Batu Utara'),
(19904, 6805, 'Kab. Nias Utara'),
(20029, 6805, 'Kab. Nias Barat'),
(20148, 6805, 'Kota Sibolga'),
(20170, 6805, 'Kota Tanjung Balai'),
(20208, 6805, 'Kota Pematang Siantar'),
(20270, 6805, 'Kota Tebing Tinggi'),
(20311, 6805, 'Kota Medan'),
(20484, 6805, 'Kota Binjai'),
(20527, 6805, 'Kota Padangsidimpuan'),
(20613, 6805, 'Kota Gunungsitoli'),
(20722, 20721, 'Kab. Kepulauan Mentawai'),
(20776, 20721, 'Kab. Pesisir Selatan'),
(20971, 20721, 'Kab. Solok'),
(21060, 20721, 'Kab. Sijunjung'),
(21131, 20721, 'Kab. Tanah Datar'),
(21221, 20721, 'Kab. Padang Pariaman'),
(21299, 20721, 'Kab. Agam'),
(21398, 20721, 'Kab. Lima Puluh Kota'),
(21491, 20721, 'Kab. Pasaman'),
(21536, 20721, 'Kab. Solok Selatan'),
(21583, 20721, 'Kab. Dharmasraya'),
(21647, 20721, 'Kab. Pasaman Barat'),
(21678, 20721, 'Kota Padang'),
(21794, 20721, 'Kota Solok'),
(21810, 20721, 'Kota Sawah Lunto'),
(21852, 20721, 'Kota Padang Panjang'),
(21871, 20721, 'Kota Bukittinggi'),
(21899, 20721, 'Kota Payakumbuh'),
(21981, 20721, 'Kota Pariaman'),
(22058, 22057, 'Kab. Ogan Komering Ulu'),
(22225, 22057, 'Kab. Ogan Komering Ilir'),
(22563, 22057, 'Kab. Muara Enim'),
(22914, 22057, 'Kab. Lahat'),
(23313, 22057, 'Kab. Musi Rawas'),
(23623, 22057, 'Kab. Musi Banyuasin'),
(23874, 22057, 'Kab. Banyu Asin'),
(24198, 22057, 'Kab. Ogan Komering Ulu Selatan'),
(24454, 22057, 'Kab. Ogan Komering Ulu Timur'),
(24771, 22057, 'Kab. Ogan Ilir'),
(25029, 22057, 'Kab. Empat Lawang'),
(25195, 22057, 'Kota Palembang'),
(25319, 22057, 'Kota Prabumulih'),
(25363, 22057, 'Kota Pagar Alam'),
(25404, 22057, 'Kota Lubuklinggau'),
(25486, 25485, 'Kab. Bengkulu Selatan'),
(25658, 25485, 'Kab. Rejang Lebong'),
(25830, 25485, 'Kab. Bengkulu Utara'),
(26072, 25485, 'Kab. Kaur'),
(26283, 25485, 'Kab. Seluma'),
(26497, 25485, 'Kab. Mukomuko'),
(26665, 25485, 'Kab. Lebong'),
(26790, 25485, 'Kab. Kepahiang'),
(26909, 25485, 'Kab. Bengkulu Tengah'),
(27063, 25485, 'Kota Bengkulu'),
(27141, 27140, 'Kab. Lampung Barat'),
(27293, 27140, 'Kab. Tanggamus'),
(27616, 27140, 'Kab. Lampung Selatan'),
(27885, 27140, 'Kab. Lampung Timur'),
(28174, 27140, 'Kab. Lampung Tengah'),
(28510, 27140, 'Kab. Lampung Utara'),
(28781, 27140, 'Kab. Way Kanan'),
(29018, 27140, 'Kab. Tulangbawang'),
(29185, 27140, 'Kab. Pesawaran'),
(29339, 27140, 'Kab. Pringsewu'),
(29480, 27140, 'Kab. Mesuji'),
(29563, 27140, 'Kab. Tulang Bawang Barat'),
(29652, 27140, 'Kab. Pesisir Barat'),
(29782, 27140, 'Kota Bandar Lampung'),
(29929, 27140, 'Kota Metro'),
(29958, 29957, 'Kab. Bangka'),
(30038, 29957, 'Kab. Belitung'),
(30093, 29957, 'Kab. Bangka Barat'),
(30164, 29957, 'Kab. Bangka Tengah'),
(30234, 29957, 'Kab. Bangka Selatan'),
(30296, 29957, 'Kab. Belitung Timur'),
(30343, 29957, 'Kota Pangkal Pinang'),
(30394, 30393, 'Kab. Karimun'),
(30458, 30393, 'Kab. Bintan'),
(30520, 30393, 'Kab. Natuna'),
(30606, 30393, 'Kab. Lingga'),
(30685, 30393, 'Kab. Kepulauan Anambas'),
(30747, 30393, 'Kota B A T A M'),
(30824, 30393, 'Kota Tanjung Pinang'),
(30848, 30847, 'Kab. Kepulauan Seribu'),
(30857, 30847, 'Kota Jakarta Selatan'),
(30933, 30847, 'Kota Jakarta Timur'),
(31009, 30847, 'Kota Jakarta Pusat'),
(31062, 30847, 'Kota Jakarta Barat'),
(31127, 30847, 'Kota Jakarta Utara'),
(31166, 31165, 'Kab. Bogor'),
(31641, 31165, 'Kab. Sukabumi'),
(32075, 31165, 'Kab. Cianjur'),
(32468, 31165, 'Kab. Bandung'),
(32780, 31165, 'Kab. Garut'),
(33265, 31165, 'Kab. Tasikmalaya'),
(33656, 31165, 'Kab. Ciamis'),
(33948, 31165, 'Kab. Kuningan'),
(34357, 31165, 'Kab. Cirebon'),
(34822, 31165, 'Kab. Majalengka'),
(35192, 31165, 'Kab. Sumedang'),
(35502, 31165, 'Kab. Indramayu'),
(35851, 31165, 'Kab. Subang'),
(36135, 31165, 'Kab. Purwakarta'),
(36345, 31165, 'Kab. Karawang'),
(36685, 31165, 'Kab. Bekasi'),
(36896, 31165, 'Kab. Bandung Barat'),
(37078, 31165, 'Kab. Pangandaran'),
(37182, 31165, 'Kota Bogor'),
(37257, 31165, 'Kota Sukabumi'),
(37298, 31165, 'Kota Bandung'),
(37480, 31165, 'Kota Cirebon'),
(37508, 31165, 'Kota Bekasi'),
(37577, 31165, 'Kota Depok'),
(37652, 31165, 'Kota Cimahi'),
(37671, 31165, 'Kota Tasikmalaya'),
(37751, 31165, 'Kota Banjar'),
(37782, 37781, 'Kab. Cilacap'),
(38091, 37781, 'Kab. Banyumas'),
(38450, 37781, 'Kab. Purbalingga'),
(38708, 37781, 'Kab. Banjarnegara'),
(39007, 37781, 'Kab. Kebumen'),
(39494, 37781, 'Kab. Purworejo'),
(40005, 37781, 'Kab. Wonosobo'),
(40286, 37781, 'Kab. Magelang'),
(40680, 37781, 'Kab. Boyolali'),
(40967, 37781, 'Kab. Klaten'),
(41395, 37781, 'Kab. Sukoharjo'),
(41575, 37781, 'Kab. Wonogiri'),
(41895, 37781, 'Kab. Karanganyar'),
(42090, 37781, 'Kab. Sragen'),
(42319, 37781, 'Kab. Grobogan'),
(42619, 37781, 'Kab. Blora'),
(42931, 37781, 'Kab. Rembang'),
(43240, 37781, 'Kab. Pati'),
(43668, 37781, 'Kab. Kudus'),
(43810, 37781, 'Kab. Jepara'),
(44022, 37781, 'Kab. Demak'),
(44286, 37781, 'Kab. Semarang'),
(44541, 37781, 'Kab. Temanggung'),
(44851, 37781, 'Kab. Kendal'),
(45158, 37781, 'Kab. Batang'),
(45422, 37781, 'Kab. Pekalongan'),
(45727, 37781, 'Kab. Pemalang'),
(45964, 37781, 'Kab. Tegal'),
(46270, 37781, 'Kab. Brebes'),
(46585, 37781, 'Kota Magelang'),
(46606, 37781, 'Kota Surakarta'),
(46663, 37781, 'Kota Salatiga'),
(46690, 37781, 'Kota Semarang'),
(46884, 37781, 'Kota Pekalongan'),
(46936, 37781, 'Kota Tegal'),
(46969, 46968, 'Kab. Kulon Progo'),
(47070, 46968, 'Kab. Bantul'),
(47163, 46968, 'Kab. Gunung Kidul'),
(47326, 46968, 'Kab. Sleman'),
(47430, 46968, 'Kota Yogyakarta'),
(47491, 47490, 'Kab. Pacitan'),
(47675, 47490, 'Kab. Ponorogo'),
(48004, 47490, 'Kab. Trenggalek'),
(48176, 47490, 'Kab. Tulungagung'),
(48467, 47490, 'Kab. Blitar'),
(48738, 47490, 'Kab. Kediri'),
(49109, 47490, 'Kab. Malang'),
(49533, 47490, 'Kab. Lumajang'),
(49760, 47490, 'Kab. Jember'),
(50040, 47490, 'Kab. Banyuwangi'),
(50282, 47490, 'Kab. Bondowoso'),
(50525, 47490, 'Kab. Situbondo'),
(50679, 47490, 'Kab. Probolinggo'),
(51034, 47490, 'Kab. Pasuruan'),
(51424, 47490, 'Kab. Sidoarjo'),
(51796, 47490, 'Kab. Mojokerto'),
(52119, 47490, 'Kab. Jombang'),
(52447, 47490, 'Kab. Nganjuk'),
(52752, 47490, 'Kab. Madiun'),
(52974, 47490, 'Kab. Magetan'),
(53228, 47490, 'Kab. Ngawi'),
(53465, 47490, 'Kab. Bojonegoro'),
(53924, 47490, 'Kab. Tuban'),
(54273, 47490, 'Kab. Lamongan'),
(54775, 47490, 'Kab. Gresik'),
(55150, 47490, 'Kab. Bangkalan'),
(55443, 47490, 'Kab. Sampang'),
(55644, 47490, 'Kab. Pamekasan'),
(55843, 47490, 'Kab. Sumenep'),
(56201, 47490, 'Kota Kediri'),
(56251, 47490, 'Kota Blitar'),
(56276, 47490, 'Kota Malang'),
(56339, 47490, 'Kota Probolinggo'),
(56374, 47490, 'Kota Pasuruan'),
(56413, 47490, 'Kota Mojokerto'),
(56434, 47490, 'Kota Madiun'),
(56465, 47490, 'Kota Surabaya'),
(56657, 47490, 'Kota Batu'),
(56686, 56685, 'Kab. Pandeglang'),
(57061, 56685, 'Kab. Lebak'),
(57435, 56685, 'Kab. Tangerang'),
(57739, 56685, 'Kab. Serang'),
(58095, 56685, 'Kota Tangerang'),
(58213, 56685, 'Kota Cilegon'),
(58265, 56685, 'Kota Serang'),
(58338, 56685, 'Kota Tangerang Selatan'),
(58401, 58400, 'Kab. Jembrana'),
(58458, 58400, 'Kab. Tabanan'),
(58602, 58400, 'Kab. Badung'),
(58671, 58400, 'Kab. Gianyar'),
(58749, 58400, 'Kab. Klungkung'),
(58813, 58400, 'Kab. Bangli'),
(58890, 58400, 'Kab. Karang Asem'),
(58977, 58400, 'Kab. Buleleng'),
(59135, 58400, 'Kota Denpasar'),
(59184, 59183, 'Kab. Lombok Barat'),
(59317, 59183, 'Kab. Lombok Tengah'),
(59469, 59183, 'Kab. Lombok Timur'),
(59744, 59183, 'Kab. Sumbawa'),
(59934, 59183, 'Kab. Dompu'),
(60014, 59183, 'Kab. Bima'),
(60228, 59183, 'Kab. Sumbawa Barat'),
(60302, 59183, 'Kab. Lombok Utara'),
(60341, 59183, 'Kota Mataram'),
(60398, 59183, 'Kota Bima'),
(60442, 60441, 'Kab. Sumba Barat'),
(60523, 60441, 'Kab. Sumba Timur'),
(60702, 60441, 'Kab. Kupang'),
(60904, 60441, 'Kab. Timor Tengah Selatan'),
(61167, 60441, 'Kab. Timor Tengah Utara'),
(61363, 60441, 'Kab. Belu'),
(61595, 60441, 'Kab. Alor'),
(61787, 60441, 'Kab. Lembata'),
(61948, 60441, 'Kab. Flores Timur'),
(62218, 60441, 'Kab. Sikka'),
(62400, 60441, 'Kab. Ende'),
(62700, 60441, 'Kab. Ngada'),
(62864, 60441, 'Kab. Manggarai'),
(63038, 60441, 'Kab. Rote Ndao'),
(63138, 60441, 'Kab. Manggarai Barat'),
(63318, 60441, 'Kab. Sumba Tengah'),
(63389, 60441, 'Kab. Sumba Barat Daya'),
(63532, 60441, 'Kab. Nagekeo'),
(63653, 60441, 'Kab. Manggarai Timur'),
(63838, 60441, 'Kab. Sabu Raijua'),
(63908, 60441, 'Kota Kupang'),
(63967, 63966, 'Kab. Sambas'),
(64169, 63966, 'Kab. Bengkayang'),
(64311, 63966, 'Kab. Landak'),
(64481, 63966, 'Kab. Pontianak'),
(64558, 63966, 'Kab. Sanggau'),
(64743, 63966, 'Kab. Ketapang'),
(65013, 63966, 'Kab. Sintang'),
(65315, 63966, 'Kab. Kapuas Hulu'),
(65621, 63966, 'Kab. Sekadau'),
(65716, 63966, 'Kab. Melawi'),
(65897, 63966, 'Kab. Kayong Utara'),
(65947, 63966, 'Kab. Kubu Raya'),
(66052, 63966, 'Kota Pontianak'),
(66088, 63966, 'Kota Singkawang'),
(66121, 66120, 'Kab. Kotawaringin Barat'),
(66222, 66120, 'Kab. Kotawaringin Timur'),
(66418, 66120, 'Kab. Kapuas'),
(66666, 66120, 'Kab. Barito Selatan'),
(66768, 66120, 'Kab. Barito Utara'),
(66881, 66120, 'Kab. Sukamara'),
(66919, 66120, 'Kab. Lamandau'),
(67011, 66120, 'Kab. Seruyan'),
(67122, 66120, 'Kab. Katingan'),
(67297, 66120, 'Kab. Pulang Pisau'),
(67405, 66120, 'Kab. Gunung Mas'),
(67545, 66120, 'Kab. Barito Timur'),
(67659, 66120, 'Kab. Murung Raya'),
(67793, 66120, 'Kota Palangka Raya'),
(67830, 67829, 'Kab. Tanah Laut'),
(67977, 67829, 'Kab. Kota Baru'),
(68201, 67829, 'Kab. Banjar'),
(68510, 67829, 'Kab. Barito Kuala'),
(68728, 67829, 'Kab. Tapin'),
(68874, 67829, 'Kab. Hulu Sungai Selatan'),
(69034, 67829, 'Kab. Hulu Sungai Tengah'),
(69215, 67829, 'Kab. Hulu Sungai Utara'),
(69445, 67829, 'Kab. Tabalong'),
(69588, 67829, 'Kab. Tanah Bumbu'),
(69748, 67829, 'Kab. Balangan'),
(69912, 67829, 'Kota Banjarmasin'),
(69970, 67829, 'Kota Banjar Baru'),
(69997, 69996, 'Kab. Paser'),
(70152, 69996, 'Kab. Kutai Barat'),
(70411, 69996, 'Kab. Kutai Kartanegara'),
(70667, 69996, 'Kab. Kutai Timur'),
(70821, 69996, 'Kab. Berau'),
(70945, 69996, 'Kab. Penajam Paser Utara'),
(71004, 69996, 'Kota Balikpapan'),
(71037, 69996, 'Kota Samarinda'),
(71101, 69996, 'Kota Bontang'),
(71121, 71120, 'Kab. Malinau'),
(71246, 71120, 'Kab. Bulungan'),
(71338, 71120, 'Kab. Tana Tidung'),
(71365, 71120, 'Kab. Nunukan'),
(71622, 71120, 'Kota Tarakan'),
(71648, 71647, 'Kab. Bolaang Mongondow'),
(71831, 71647, 'Kab. Minahasa'),
(72127, 71647, 'Kab. Kepulauan Sangihe'),
(72310, 71647, 'Kab. Kepulauan Talaud'),
(72471, 71647, 'Kab. Minahasa Selatan'),
(72664, 71647, 'Kab. Minahasa Utara'),
(72800, 71647, 'Kab. Bolaang Mongondow Utara'),
(72898, 71647, 'Kab. Siau Tagulandang Biaro'),
(73002, 71647, 'Kab. Minahasa Tenggara'),
(73159, 71647, 'Kab. Bolaang Mongondow Selatan'),
(73230, 71647, 'Kab. Bolaang Mongondow Timur'),
(73287, 71647, 'Kota Manado'),
(73386, 71647, 'Kota Bitung'),
(73464, 71647, 'Kota Tomohon'),
(73514, 71647, 'Kota Kotamobagu'),
(73553, 73552, 'Kab. Banggai Kepulauan'),
(73783, 73552, 'Kab. Banggai'),
(74146, 73552, 'Kab. Morowali'),
(74416, 73552, 'Kab. Poso'),
(74592, 73552, 'Kab. Donggala'),
(74777, 73552, 'Kab. Toli-toli'),
(74892, 73552, 'Kab. Buol'),
(75019, 73552, 'Kab. Parigi Moutong'),
(75267, 73552, 'Kab. Tojo Una-una'),
(75421, 73552, 'Kab. Sigi'),
(75592, 73552, 'Kota Palu'),
(75647, 75646, 'Kab. Kepulauan Selayar'),
(75747, 75646, 'Kab. Bulukumba'),
(75894, 75646, 'Kab. Bantaeng'),
(75957, 75646, 'Kab. Jeneponto'),
(76082, 75646, 'Kab. Takalar'),
(76187, 75646, 'Kab. Gowa'),
(76372, 75646, 'Kab. Sinjai'),
(76462, 75646, 'Kab. Maros'),
(76579, 75646, 'Kab. Pangkajene Dan Kepulauan'),
(76685, 75646, 'Kab. Barru'),
(76747, 75646, 'Kab. Bone'),
(77146, 75646, 'Kab. Soppeng'),
(77225, 75646, 'Kab. Wajo'),
(77416, 75646, 'Kab. Sidenreng Rappang'),
(77534, 75646, 'Kab. Pinrang'),
(77655, 75646, 'Kab. Enrekang'),
(77797, 75646, 'Kab. Luwu'),
(78037, 75646, 'Kab. Tana Toraja'),
(78206, 75646, 'Kab. Luwu Utara'),
(78397, 75646, 'Kab. Luwu Timur'),
(78534, 75646, 'Kab. Toraja Utara'),
(78676, 75646, 'Kota Makassar'),
(78831, 75646, 'Kota Parepare'),
(78858, 75646, 'Kota Palopo'),
(78916, 78915, 'Kab. Buton'),
(79180, 78915, 'Kab. Muna'),
(79454, 78915, 'Kab. Konawe'),
(79900, 78915, 'Kab. Kolaka'),
(80193, 78915, 'Kab. Konawe Selatan'),
(80581, 78915, 'Kab. Bombana'),
(80744, 78915, 'Kab. Wakatobi'),
(80853, 78915, 'Kab. Kolaka Utara'),
(81001, 78915, 'Kab. Buton Utara'),
(81067, 78915, 'Kab. Konawe Utara'),
(81224, 78915, 'Kota Kendari'),
(81299, 78915, 'Kota Baubau'),
(81352, 81351, 'Kab. Boalemo'),
(81444, 81351, 'Kab. Gorontalo'),
(81667, 81351, 'Kab. Pohuwato'),
(81785, 81351, 'Kab. Bone Bolango'),
(81970, 81351, 'Kab. Gorontalo Utara'),
(82105, 81351, 'Kota Gorontalo'),
(82166, 82165, 'Kab. Majene'),
(82257, 82165, 'Kab. Polewali Mandar'),
(82440, 82165, 'Kab. Mamasa'),
(82630, 82165, 'Kab. Mamuju'),
(82800, 82165, 'Kab. Mamuju Utara'),
(82877, 82876, 'Kab. Maluku Tenggara Barat'),
(82966, 82876, 'Kab. Maluku Tenggara'),
(83060, 82876, 'Kab. Maluku Tengah'),
(83263, 82876, 'Kab. Buru'),
(83357, 82876, 'Kab. Kepulauan Aru'),
(83484, 82876, 'Kab. Seram Bagian Barat'),
(83588, 82876, 'Kab. Seram Bagian Timur'),
(83747, 82876, 'Kab. Maluku Barat Daya'),
(83873, 82876, 'Kab. Buru Selatan'),
(83934, 82876, 'Kota Ambon'),
(83990, 82876, 'Kota Tual'),
(84025, 84024, 'Kab. Halmahera Barat'),
(84174, 84024, 'Kab. Halmahera Tengah'),
(84245, 84024, 'Kab. Kepulauan Sula'),
(84398, 84024, 'Kab. Halmahera Selatan'),
(84684, 84024, 'Kab. Halmahera Utara'),
(84899, 84024, 'Kab. Halmahera Timur'),
(84987, 84024, 'Kab. Pulau Morotai'),
(85057, 84024, 'Kota Ternate'),
(85142, 84024, 'Kota Tidore Kepulauan'),
(85224, 85223, 'Kab. Fakfak'),
(85359, 85223, 'Kab. Kaimana'),
(85453, 85223, 'Kab. Teluk Wondama'),
(85543, 85223, 'Kab. Teluk Bintuni'),
(85685, 85223, 'Kab. Manokwari'),
(86136, 85223, 'Kab. Sorong Selatan'),
(86268, 85223, 'Kab. Sorong'),
(86430, 85223, 'Kab. Raja Ampat'),
(86576, 85223, 'Kab. Tambrauw'),
(86637, 85223, 'Kab. Maybrat'),
(86813, 85223, 'Kota Sorong'),
(86852, 86851, 'Kab. Merauke'),
(87041, 86851, 'Kab. Jayawijaya'),
(87170, 86851, 'Kab. Jayapura'),
(87334, 86851, 'Kab. Nabire'),
(87430, 86851, 'Kab. Kepulauan Yapen'),
(87556, 86851, 'Kab. Biak Numfor'),
(87763, 86851, 'Kab. Paniai'),
(87844, 86851, 'Kab. Puncak Jaya'),
(87920, 86851, 'Kab. Mimika'),
(88018, 86851, 'Kab. Boven Digoel'),
(88151, 86851, 'Kab. Mappi'),
(88299, 86851, 'Kab. Asmat'),
(88485, 86851, 'Kab. Yahukimo'),
(89055, 86851, 'Kab. Pegunungan Bintang'),
(89367, 86851, 'Kab. Tolikara'),
(89917, 86851, 'Kab. Sarmi'),
(90014, 86851, 'Kab. Keerom'),
(90083, 86851, 'Kab. Waropen'),
(90181, 86851, 'Kab. Supiori'),
(90225, 86851, 'Kab. Mamberamo Raya'),
(90292, 86851, 'Kab. Nduga'),
(90333, 86851, 'Kab. Lanny Jaya'),
(90487, 86851, 'Kab. Mamberamo Tengah'),
(90552, 86851, 'Kab. Yalimo'),
(90585, 86851, 'Kab. Puncak'),
(90674, 86851, 'Kab. Dogiyai'),
(90764, 86851, 'Kab. Intan Jaya'),
(90808, 86851, 'Kab. Deiyai'),
(90844, 86851, 'Kota Jayapura'),
(90893, 31165, 'BANDUNG'),
(90897, 90896, 'INDRAGIRI HILIR'),
(90900, 31165, 'MAJALENGKA'),
(90901, 90901, 'Inferno City');

-- --------------------------------------------------------

--
-- Table structure for table `wilayah_provinsi`
--

DROP TABLE IF EXISTS `wilayah_provinsi`;
CREATE TABLE IF NOT EXISTS `wilayah_provinsi` (
  `id_provinsi` int(11) NOT NULL AUTO_INCREMENT,
  `provinsi` varchar(50) NOT NULL,
  PRIMARY KEY (`id_provinsi`)
) ENGINE=InnoDB AUTO_INCREMENT=90902 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wilayah_provinsi`
--

INSERT INTO `wilayah_provinsi` (`id_provinsi`, `provinsi`) VALUES
(1, 'Aceh'),
(6805, 'Sumatera Utara'),
(20721, 'Sumatera Barat'),
(22057, 'Sumatera Selatan'),
(25485, 'Bengkulu'),
(27140, 'Lampung'),
(29957, 'Kepulauan Bangka Belitung'),
(30393, 'Kepulauan Riau'),
(30847, 'Dki Jakarta'),
(31165, 'Jawa Barat'),
(37781, 'Jawa Tengah'),
(46968, 'Di Yogyakarta'),
(47490, 'Jawa Timur'),
(56685, 'Banten'),
(58400, 'Bali'),
(59183, 'Nusa Tenggara Barat'),
(60441, 'Nusa Tenggara Timur'),
(63966, 'Kalimantan Barat'),
(66120, 'Kalimantan Tengah'),
(67829, 'Kalimantan Selatan'),
(69996, 'Kalimantan Timur'),
(71120, 'Kalimantan Utara'),
(71647, 'Sulawesi Utara'),
(73552, 'Sulawesi Tengah'),
(75646, 'Sulawesi Selatan'),
(78915, 'Sulawesi Tenggara'),
(81351, 'Gorontalo'),
(82165, 'Sulawesi Barat'),
(82876, 'Maluku'),
(84024, 'Maluku Utara'),
(85223, 'Papua Barat'),
(86851, 'Papua'),
(90896, 'RIAU'),
(90901, 'AbGhotam');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `akses_inspektorat`
--
ALTER TABLE `akses_inspektorat`
  ADD CONSTRAINT `akses_to_inspektorat` FOREIGN KEY (`id_inspektorat`) REFERENCES `inspektorat` (`id_inspektorat`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `inspektorat_to_akses` FOREIGN KEY (`id_akses`) REFERENCES `akses` (`id_akses`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `akses_kabupaten`
--
ALTER TABLE `akses_kabupaten`
  ADD CONSTRAINT `akses_kab_akses` FOREIGN KEY (`id_akses`) REFERENCES `akses` (`id_akses`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `akses_kab_kabkot` FOREIGN KEY (`id_kabkot`) REFERENCES `wilayah_kabkot` (`id_kabkot`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `akses_kab_provinsi` FOREIGN KEY (`id_provinsi`) REFERENCES `wilayah_provinsi` (`id_provinsi`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `akses_opd`
--
ALTER TABLE `akses_opd`
  ADD CONSTRAINT `opd_to_akses` FOREIGN KEY (`id_akses`) REFERENCES `akses` (`id_akses`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `opd_to_opd` FOREIGN KEY (`id_opd`) REFERENCES `opd` (`id_opd`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `akses_provinsi`
--
ALTER TABLE `akses_provinsi`
  ADD CONSTRAINT `akses_prov_to_akses` FOREIGN KEY (`id_akses`) REFERENCES `akses` (`id_akses`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `akses_prov_to_provinsi` FOREIGN KEY (`id_provinsi`) REFERENCES `wilayah_provinsi` (`id_provinsi`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `akses_token`
--
ALTER TABLE `akses_token`
  ADD CONSTRAINT `to_akses` FOREIGN KEY (`id_akses`) REFERENCES `akses` (`id_akses`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `inspektorat`
--
ALTER TABLE `inspektorat`
  ADD CONSTRAINT `inspektorat_to_kabkot` FOREIGN KEY (`id_kabkot`) REFERENCES `wilayah_kabkot` (`id_kabkot`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `inspektorat_to_provinsi` FOREIGN KEY (`id_provinsi`) REFERENCES `wilayah_provinsi` (`id_provinsi`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `komponen`
--
ALTER TABLE `komponen`
  ADD CONSTRAINT `komponen_evaluasi` FOREIGN KEY (`id_evaluasi_periode`) REFERENCES `evaluasi_periode` (`id_evaluasi_periode`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `komponen_sub`
--
ALTER TABLE `komponen_sub`
  ADD CONSTRAINT `sub_komponen_to_komponen` FOREIGN KEY (`id_komponen`) REFERENCES `komponen` (`id_komponen`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sub_komponen_to_periode` FOREIGN KEY (`id_evaluasi_periode`) REFERENCES `evaluasi_periode` (`id_evaluasi_periode`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `kriteria`
--
ALTER TABLE `kriteria`
  ADD CONSTRAINT `kriteria_to_komponen` FOREIGN KEY (`id_komponen`) REFERENCES `komponen` (`id_komponen`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `kriteria_to_komponen_sub` FOREIGN KEY (`id_komponen_sub`) REFERENCES `komponen_sub` (`id_komponen_sub`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `kriteria_to_periode` FOREIGN KEY (`id_evaluasi_periode`) REFERENCES `evaluasi_periode` (`id_evaluasi_periode`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `log`
--
ALTER TABLE `log`
  ADD CONSTRAINT `log_to_akses` FOREIGN KEY (`id_akses`) REFERENCES `akses` (`id_akses`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `opd`
--
ALTER TABLE `opd`
  ADD CONSTRAINT `opd_to_inspektorat` FOREIGN KEY (`id_inspektorat`) REFERENCES `inspektorat` (`id_inspektorat`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `opd_to_kabkot` FOREIGN KEY (`id_kabkot`) REFERENCES `wilayah_kabkot` (`id_kabkot`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `opd_to_provinsi` FOREIGN KEY (`id_provinsi`) REFERENCES `wilayah_provinsi` (`id_provinsi`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `uraian`
--
ALTER TABLE `uraian`
  ADD CONSTRAINT `uraian_to_komponen` FOREIGN KEY (`id_komponen`) REFERENCES `komponen` (`id_komponen`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `uraian_to_kriteria` FOREIGN KEY (`id_kriteria`) REFERENCES `kriteria` (`id_kriteria`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `uraian_to_periode` FOREIGN KEY (`id_evaluasi_periode`) REFERENCES `evaluasi_periode` (`id_evaluasi_periode`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `uraian_to_sub_komponen` FOREIGN KEY (`id_komponen_sub`) REFERENCES `komponen_sub` (`id_komponen_sub`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `wilayah_kabkot`
--
ALTER TABLE `wilayah_kabkot`
  ADD CONSTRAINT `to_wilayah_provinsi` FOREIGN KEY (`id_provinsi`) REFERENCES `wilayah_provinsi` (`id_provinsi`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
