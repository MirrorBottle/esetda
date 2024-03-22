# ************************************************************
# Sequel Ace SQL dump
# Version 20031
#
# https://sequel-ace.com/
# https://github.com/Sequel-Ace/Sequel-Ace
#
# Host: 127.0.0.1 (MySQL 8.0.28)
# Database: sisda_db
# Generation Time: 2022-03-22 02:07:20 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
SET NAMES utf8mb4;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE='NO_AUTO_VALUE_ON_ZERO', SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table skpd_employees
# ------------------------------------------------------------

DROP TABLE IF EXISTS `skpd_employees`;

CREATE TABLE `skpd_employees` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `skpd_id` bigint unsigned NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nip` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `position` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `group` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `skpd_employees_skpd_id_foreign` (`skpd_id`),
  CONSTRAINT `skpd_employees_skpd_id_foreign` FOREIGN KEY (`skpd_id`) REFERENCES `skpds` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `skpd_employees` WRITE;
/*!40000 ALTER TABLE `skpd_employees` DISABLE KEYS */;

INSERT INTO `skpd_employees` (`id`, `skpd_id`, `name`, `nip`, `position`, `group`, `created_at`, `updated_at`, `deleted_at`)
VALUES
	(1,1,'Dr. Bambang Indratno Gunawan',NULL,'Anggota Bidang Ekonomi TGUP3 Prov. Kaltim',NULL,NULL,NULL,NULL),
	(2,1,'Dr. Ir. H. Ibrahim, MP',NULL,'Anggota Bidang Ekonomi TGUP3 Prov. Kaltim',NULL,NULL,NULL,NULL),
	(3,1,'Dr. Ir. H. Zairin Zain, M.Si',NULL,'Anggota Bidang Infrastruktur TGUP3 Prov. Kaltim',NULL,NULL,NULL,NULL),
	(4,1,'Dr. H. Abdullah Karim',NULL,'Anggota Bidang SDM TGUP3 Prov. Kaltim',NULL,NULL,NULL,NULL),
	(5,2,'Dr. Drs. Moh. Jauhar Effendi. M.Si','19611216 198603 1 014','Asisten Pemerintahan dan Kesra Setda Prov. Kaltim','IV/D',NULL,NULL,NULL),
	(6,37,'dr. Hj. Padilah Mante Runa, M.Si, MARS','19611118 198903 2 004','Direktur RSJD Atma Husada Mahakam','IV/C',NULL,NULL,NULL),
	(7,37,'dr. H. Jaya Mualimin., Sp.KJ.,cM.Kes., MARS','19710720 200604 1 002','Direktur RSJD Atma Husada Mahakam ','IV/B',NULL,NULL,NULL),
	(8,36,'dr. David Hariadi Masjhoer,Sp.OT','19650314 199803 1 001','Direktur RSUD. A. Wahab Sjahranie','IV/B',NULL,NULL,NULL),
	(9,32,'Dr. H.M. Irfan Pranata, SE, MM','19740818 199703 1 006','Inspektur Daerah Prov. Kaltim','II/A',NULL,NULL,NULL),
	(10,38,'Drs. Gede Yusa, SH','19620407 201607 1 001','Kasatpol PP Prov. Kaltim','IV/C',NULL,NULL,NULL),
	(11,6,'Dra. Hj. Ismiati, M.Si','19650914 199012 2 001','Kepala Badan Pendapatan Prov. Kaltim','IV/D',NULL,NULL,NULL),
	(12,8,'Dra. Nina Dewi, M.AP','19660928 198609 2 001','Kepala Badan Pengembangan Sumber Daya Manusia','IV/B',NULL,NULL,NULL),
	(13,7,'Abdullah Sani, SH, M.Hum','19640101 199003 1 028','Kepala Balitbangda Prov. Kaltim','IV/D',NULL,NULL,NULL),
	(14,6,'Dr. Ir. H. M. Aswin, M.M','19630216 198803 1 008','Kepala Bappeda Prov. Kaltim','IV/D',NULL,NULL,NULL),
	(15,10,'Drs. Andi Muhammad Ishak, Apt, M.Si','19680814 199403 1 012','Kepala Biro Kesejahteraan Rakyat Setda Prov. Kaltim','IV/B',NULL,NULL,NULL),
	(16,5,'Drs. Diddy Rusdiansyah Anan Dani, M.MX','19640627 199003 1 0061','Kepala BKD Prov. Kaltimx','IV/DX','2022-03-13 14:41:54','2022-03-13 14:42:40','2022-03-13 14:42:40'),
	(17,1,'Andy Nur S.Kom, M.A.','1889 10101 9001','Kepala Bidang Teknologi Informasi','SSS','2022-03-15 22:15:56','2022-03-15 22:15:56',NULL);

/*!40000 ALTER TABLE `skpd_employees` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table skpds
# ------------------------------------------------------------

DROP TABLE IF EXISTS `skpds`;

CREATE TABLE `skpds` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `budget_expanse` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `wa_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `skpds` WRITE;
/*!40000 ALTER TABLE `skpds` DISABLE KEYS */;

INSERT INTO `skpds` (`id`, `name`, `budget_expanse`, `wa_number`, `contact`, `created_at`, `updated_at`)
VALUES
	(1,'Anggota Tim Gubernur Untuk Pengawalan Percepatan Pembangunan (TGUP3) Provinsi Kalimantan Timur','TGUP3 Provinsi Kalimantan Timur\r\nBiro Umum Setda Kalimantan Timur','+6285161318191','Andy Nur',NULL,'2022-03-22 10:00:44'),
	(2,'ASISTEN ADMINISTRASI UMUM','ASISTEN ADMINISTRASI UMUM\r\nASISTEN ADMINISTRASI KHUSUS','+6282255682584','Fahmi Fitnanda',NULL,'2022-03-17 15:24:36'),
	(3,'ASISTEN EKONOMI & ADMINISTRASI PEMBANGUNAN','ASISTEN EKONOMI & ADMINISTRASI PEMBANGUNAN','+6282255682584','Fahmi Fitnanda',NULL,'2022-03-17 08:46:02'),
	(4,'BADAN KEPEGAWAIAN DAERAH','BADAN KEPEGAWAIAN DAERAH','+6282255682584','Fahmi Fitnanda',NULL,'2022-03-17 08:46:02'),
	(5,'BADAN PENANGGULANGAN BENCANA DAERAH','BADAN PENANGGULANGAN BENCANA DAERAH','+6282255682584','Fahmi Fitnanda',NULL,'2022-03-17 08:46:02'),
	(6,'BADAN PENDAPATAN DAERAH','BADAN PENDAPATAN DAERAH','+6282255682584','Fahmi Fitnanda',NULL,'2022-03-17 08:46:02'),
	(7,'BADAN PENELITIAN DAN PENGEMBANGAN DAERAH','BADAN PENELITIAN DAN PENGEMBANGAN DAERAH','+6282255682584','Fahmi Fitnanda',NULL,'2022-03-17 08:46:02'),
	(8,'BADAN PENGEMBANGAN SDM','BADAN PENGEMBANGAN SDM','+6282255682584','Fahmi Fitnanda',NULL,'2022-03-17 08:46:02'),
	(9,'BADAN PERENCANAAN PEMBANGUNAN DAERAH','BADAN PERENCANAAN PEMBANGUNAN DAERAH','+6282255682584','Fahmi Fitnanda',NULL,'2022-03-17 08:46:02'),
	(10,'BIRO KESEJAHTERAAN RAKYAT','BIRO KESEJAHTERAAN RAKYAT','+6282255682584','Fahmi Fitnanda',NULL,'2022-03-17 08:46:02'),
	(11,'DINAS ENERGI DAN SUMBER DAYA MINERAL','DINAS ENERGI DAN SUMBER DAYA MINERAL','+6282255682584','Fahmi Fitnanda',NULL,'2022-03-17 08:46:02'),
	(12,'DINAS KEHUTANAN','DINAS KEHUTANAN','+6282255682584','Fahmi Fitnanda',NULL,'2022-03-17 08:46:02'),
	(13,'DINAS KELAUTAN DAN PERIKANAN','DINAS KELAUTAN DAN PERIKANAN','+6282255682584','Fahmi Fitnanda',NULL,'2022-03-17 08:46:02'),
	(14,'DINAS KEPENDUDUKAN, PEMBERDAYAAN PEREMPUAN & PA','DINAS KEPENDUDUKAN, PEMBERDAYAAN PEREMPUAN & PA','+6282255682584','Fahmi Fitnanda',NULL,'2022-03-17 08:46:02'),
	(15,'DINAS KESEHATAN ','DINAS KESEHATAN ','+6282255682584','Fahmi Fitnanda',NULL,'2022-03-17 08:46:02'),
	(16,'DINAS KOMUNIKASI DAN INFORMATIKA','DINAS KOMUNIKASI DAN INFORMATIKA','+6282255682584','Fahmi Fitnanda',NULL,'2022-03-17 08:46:02'),
	(17,'DINAS LINGKUNGAN HIDUP','DINAS LINGKUNGAN HIDUP','+6282255682584','Fahmi Fitnanda',NULL,'2022-03-17 08:46:02'),
	(18,'DINAS PANGAN DAN HORTIKULTURA','DINAS PANGAN DAN HORTIKULTURA','+6282255682584','Fahmi Fitnanda',NULL,'2022-03-17 08:46:02'),
	(19,'DINAS PARIWISATA','DINAS PARIWISATA','+6282255682584','Fahmi Fitnanda',NULL,'2022-03-17 08:46:02'),
	(20,'DINAS PEMBERDAYAAN MASYARAKAT DAN PEMERINTAHAN DESA','DINAS PEMBERDAYAAN MASYARAKAT DAN PEMERINTAHAN DESA','+6282255682584','Fahmi Fitnanda',NULL,'2022-03-17 08:46:02'),
	(21,'DINAS PEMUDA DAN OLAHRAGA','DINAS PEMUDA DAN OLAHRAGA','+6282255682584','Fahmi Fitnanda',NULL,'2022-03-17 08:46:02'),
	(22,'DINAS PENDIDIKAN DAN KEBUDAYAAN','DINAS PENDIDIKAN DAN KEBUDAYAAN','+6282255682584','Fahmi Fitnanda',NULL,'2022-03-17 08:46:02'),
	(23,'DINAS PERHUBUNGAN','DINAS PERHUBUNGAN','+6282255682584','Fahmi Fitnanda',NULL,'2022-03-17 08:46:02'),
	(24,'DINAS PERINDAGKOP DAN UMKM','DINAS PERINDAGKOP DAN UMKM','+6282255682584','Fahmi Fitnanda',NULL,'2022-03-17 08:46:02'),
	(25,'DINAS PERKEBUNAN','DINAS PERKEBUNAN','+6282255682584','Fahmi Fitnanda',NULL,'2022-03-17 08:46:02'),
	(26,'DINAS PERPUSTAKAN DAERAH','DINAS PERPUSTAKAN DAERAH','+6282255682584','Fahmi Fitnanda',NULL,'2022-03-17 08:46:02'),
	(27,'DINAS PETERNAKAN DAN KESEHATAN HEWAN','DINAS PETERNAKAN DAN KESEHATAN HEWAN','+6282255682584','Fahmi Fitnanda',NULL,'2022-03-17 08:46:02'),
	(28,'DINAS PU, PENATA RUANG & PERUMAHAN RAKYAT','DINAS PU, PENATA RUANG & PERUMAHAN RAKYAT','+6282255682584','Fahmi Fitnanda',NULL,'2022-03-17 08:46:02'),
	(29,'DINAS SOSIAL','DINAS SOSIAL','+6282255682584','Fahmi Fitnanda',NULL,'2022-03-17 08:46:02'),
	(30,'DINAS TENAGA KERJA','DINAS TENAGA KERJA','+6282255682584','Fahmi Fitnanda',NULL,'2022-03-17 08:46:02'),
	(31,'DPMPTSP','DPMPTSP','+6282255682584','Fahmi Fitnanda',NULL,'2022-03-17 08:46:02'),
	(32,'INSPEKTORAT','INSPEKTORAT','+6282255682584','Fahmi Fitnanda',NULL,'2022-03-17 08:46:02'),
	(33,'KEPALA BADAN PENGELOLAAN KEUANGAN DAN ASET DAERAH','KEPALA BADAN PENGELOLAAN KEUANGAN DAN ASET DAERAH','+6282255682584','Fahmi Fitnanda',NULL,'2022-03-17 08:46:02'),
	(34,'KESATUAN BANGSA DAN POLITIK','KESATUAN BANGSA DAN POLITIK','+6282255682584','Fahmi Fitnanda',NULL,'2022-03-17 08:46:02'),
	(35,'PLH. ASISTEN PEMERINTAHAN DAN KESRA','PLH. ASISTEN PEMERINTAHAN DAN KESRA','+6282255682584','Fahmi Fitnanda',NULL,'2022-03-17 08:46:02'),
	(36,'RUMAH SAKIT ABDUL WAHAB SYAHRANI','RUMAH SAKIT ABDUL WAHAB SYAHRANI','+6282255682584','Fahmi Fitnanda',NULL,'2022-03-17 08:46:02'),
	(37,'RUMAH SAKIT JIWA ATMA HUSADA','RUMAH SAKIT JIWA ATMA HUSADA','+6282255682584','Fahmi Fitnanda',NULL,'2022-03-17 08:46:02'),
	(38,'SATUAN POLISI PAMONG PRAJA','SATUAN POLISI PAMONG PRAJA','+6282255682584','Fahmi Fitnanda',NULL,'2022-03-17 08:46:02'),
	(39,'SEKRETARIAT DEWAN','SEKRETARIAT DEWAN','+6282255682584','Fahmi Fitnanda',NULL,'2022-03-17 08:46:02'),
	(40,'SEKRETARIAT DEWAN PERWAKILAN RAKYAT DAERAH','SEKRETARIAT DEWAN PERWAKILAN RAKYAT DAERAH','+6282255682584','Fahmi Fitnanda',NULL,'2022-03-17 08:46:02');

/*!40000 ALTER TABLE `skpds` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table spt_signers
# ------------------------------------------------------------

DROP TABLE IF EXISTS `spt_signers`;

CREATE TABLE `spt_signers` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `label` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `position` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nip` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `spt_signers` WRITE;
/*!40000 ALTER TABLE `spt_signers` DISABLE KEYS */;

INSERT INTO `spt_signers` (`id`, `label`, `title`, `name`, `position`, `nip`, `created_at`, `updated_at`, `deleted_at`)
VALUES
	(1,'An. Ass. I','a.n. SEKRETARIS DAERAH\nASISTEN PEMERINTAHAN DAN\nKESEJAHTERAAN RAKYAT','DR. DRS. MOH JAUHAR EFENDI, M.Si','PEMBINA UTAMA MADYA','19611216 198603 1 014',NULL,NULL,NULL),
	(2,'Sekda','SEKRETARIS DAERAH PROV. KALTIM','MUHAMMAD SA\'BANI','PEMBINA UTAMA MADYA','19620128 198803 1 005',NULL,NULL,NULL),
	(3,'Pj. Sekda','Pj. SEKRETARIS DAERAH PROV. KALTIM','MUHAMMAD SA\'BANI','PEMBINA UTAMA MADYA','19620128 198803 1 005',NULL,NULL,NULL),
	(4,'Plh. Ass. I','Plh. SEKRETARIS  DAERAH  PROV. KALTIM','DR. DRS. MOH JAUHAR EFENDI, M.Si','PEMBINA UTAMA MADYA','19611216 198603 1 014',NULL,NULL,NULL),
	(5,'Plh. Ass. II','Plh. SEKRETARIS  DAERAH  PROV. KALTIM','ABU HELMI, SE, M.Si','PEMBINA UTAMA MADYA','19620407 198811 1 001',NULL,NULL,NULL),
	(6,'An. Ass. II','a.n. SEKRETARIS  DAERAH  PROV. KALTIM\nASISTEN PEREKONOMIAN DAN \nADMINISTRASI PEMBANGUNAN','ABU HELMI, SE, M.Si','PEMBINA UTAMA MADYA','19620407 198811 1 001',NULL,NULL,NULL),
	(7,'Plt. Sekda',' PLT.  SEKRETARIS DAERAH PROV. KALTIM','DR. HJ. MEILIANA, SE, MM','PEMBINA UTAMA MADYA','19590509 198602 2 001',NULL,NULL,NULL),
	(8,'An. Ass. III','a.n. SEKRETARIS DAERAH PROV. KALTIM\nASISTEN ADMINISTRASI UMUM','H. FATHUL HALIM, SE, MM','PEMBINA UTAMA MADYA','19620112 198803 1 011',NULL,NULL,NULL),
	(9,'Gubernur','GUBERNUR KALIMANTAN TIMUR','DR. IR. H. ISRAN NOOR, M.SI	',NULL,NULL,NULL,NULL,NULL),
	(10,'Wakil Gubernur','GUBERNUR KALIMANTAN TIMUR\nWAKIL','IR. H. HADI MULYADI, M.SI',NULL,NULL,NULL,NULL,NULL),
	(11,'Plt. Sekda2',' PLT.  SEKRETARIS DAERAH PROV. KALTIM','MUHAMMAD SA\'BANI','PEMBINA UTAMA MADYA','19620128 198803 1 005',NULL,NULL,NULL),
	(12,'Plh. Ass. III','Plh. SEKRETARIS  DAERAH  PROV. KALTIM','H. FATHUL HALIM, SE, MM','PEMBINA UTAMA MADYA','19620112 198803 1 011',NULL,NULL,NULL),
	(13,'WADAWx','WADAWx','ANDY NURx','GUBx','09812390x','2022-03-13 13:58:38','2022-03-13 14:00:48','2022-03-13 14:00:48');

/*!40000 ALTER TABLE `spt_signers` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table spts
# ------------------------------------------------------------

DROP TABLE IF EXISTS `spts`;

CREATE TABLE `spts` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `inbox_id` bigint unsigned NOT NULL,
  `letter_number` int NOT NULL,
  `letter_signers` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `letter_date` date DEFAULT NULL,
  `skpd_id` bigint unsigned NOT NULL,
  `skpd_employee` json NOT NULL,
  `purpose` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `place` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `destination` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `duration` tinyint NOT NULL,
  `departure_date` date NOT NULL,
  `return_date` date NOT NULL,
  `budget_expanse` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `signer_id` bigint unsigned NOT NULL,
  `is_accepted` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `spts_signer_id_foreign` (`signer_id`),
  KEY `spts_inbox_id_foreign` (`inbox_id`),
  CONSTRAINT `spts_inbox_id_foreign` FOREIGN KEY (`inbox_id`) REFERENCES `inboxes` (`id`),
  CONSTRAINT `spts_signer_id_foreign` FOREIGN KEY (`signer_id`) REFERENCES `spt_signers` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `spts` WRITE;
/*!40000 ALTER TABLE `spts` DISABLE KEYS */;

INSERT INTO `spts` (`id`, `inbox_id`, `letter_number`, `letter_signers`, `letter_date`, `skpd_id`, `skpd_employee`, `purpose`, `place`, `destination`, `duration`, `departure_date`, `return_date`, `budget_expanse`, `signer_id`, `is_accepted`, `created_at`, `updated_at`)
VALUES
	(5,20219,2,'\"{\\\"name\\\":[\\\"Imam Ghozali Mustafa\\\",\\\"Andy Nur\\\",\\\"Fahmi F\\\"],\\\"position\\\":[\\\"Kasub\\\",\\\"Wakasub\\\",\\\"Wawakasub\\\"]}\"','2022-03-16',1,'\"{\\\"id\\\":[\\\"17\\\",\\\"1\\\",\\\"5\\\",\\\"6\\\",\\\"2\\\"],\\\"name\\\":[\\\"Andy Nur S.Kom, M.A.\\\",\\\"Dr. Bambang Indratno Gunawan\\\",\\\"Dr. Drs. Moh. Jauhar Effendi. M.Si\\\",\\\"dr. Hj. Padilah Mante Runa, M.Si, MARS\\\",\\\"Dr. Ir. H. Ibrahim, MP\\\"]}\"','MANTAP','Samarinda','Pontianak',4,'2022-03-20','2022-03-24','TGUP3 Provinsi Kalimantan Timur\r\nBiro Umum Setda Kalimantan Timur',3,1,'2022-03-17 15:32:58','2022-03-22 10:00:53'),
	(6,20129,3,NULL,'2022-03-15',14,'\"{\\\"id\\\":[\\\"1\\\",\\\"8\\\",\\\"12\\\"],\\\"name\\\":[\\\"Dr. Bambang Indratno Gunawan\\\",\\\"dr. David Hariadi Masjhoer,Sp.OT\\\",\\\"Dra. Nina Dewi, M.AP\\\"]}\"','PERESMIAN TAMAN KOTA SUMEDANG','Balikpapan','Sumedang',6,'2022-03-16','2022-03-22','DINAS KEPENDUDUKAN, PEMBERDAYAAN PEREMPUAN & PA SUMEDANG',2,0,'2022-03-17 19:18:22','2022-03-22 09:55:34'),
	(7,20134,4,NULL,'2022-03-17',3,'\"{\\\"id\\\":[\\\"12\\\"],\\\"name\\\":[\\\"Dra. Nina Dewi, M.AP\\\"]}\"','MENENTUKAN IKN','Samarinda','Balikpapan',6,'2022-03-20','2022-03-26','ASISTEN EKONOMI & ADMINISTRASI PEMBANGUNAN',8,0,'2022-03-17 21:37:58','2022-03-19 16:58:18');

/*!40000 ALTER TABLE `spts` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
