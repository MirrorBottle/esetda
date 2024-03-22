--
-- Dumping data for table `senders`
--

INSERT INTO `senders` (`id`, `name`, `address`, `description`, `created_at`, `updated_at`) VALUES
(6, 'SUN EDUCATION GROUP', NULL, NULL, '2020-01-09 13:44:17', '2020-01-09 13:44:17'),
(7, 'TABLOID NASIONAL PATROLI POST', NULL, NULL, '2020-01-09 13:45:32', '2020-01-09 13:45:32'),
(8, 'PT. MIGAS MANDIRI PRATAMA KALTIM (PERSERODA)', NULL, NULL, '2020-01-09 13:46:58', '2020-01-09 13:46:58');

--
-- Dumping data for table `inboxes`
--

INSERT INTO `inboxes` (`id`, `biro_id`, `user_id`, `no`, `title`, `date`, `date_entry`, `receiver_detail_id`, `sender_id`, `description`, `is_attachment`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 2, 7, '004/SUN/LINGUA/VIII/2020', 'SURAT PERMOHONAN AUDIENSI DENGAN WAKIL GUBERNUR KALTIM', '2020-01-06', '2020-01-09', 92, 6, NULL, 0, '2020-01-09 13:44:17', '2020-01-09 13:44:17', NULL),
(2, 2, 7, '001/TN-PP/I/2020', 'SOSIALISASI DAN PENYAMPAIAN DAN BUKU ANTI KORUPSI TAHUN 2019', '2020-01-07', '2020-01-09', 81, 7, NULL, 0, '2020-01-09 13:45:32', '2020-01-09 13:45:32', NULL),
(3, 2, 7, '002/MMP-KT/I/2020', 'PENGANGKATAN DEWAN KOMISARIS PERSEROAN PT. MMP KALTIM', '2020-01-09', '2020-01-09', 95, 8, NULL, 0, '2020-01-09 13:46:58', '2020-01-09 13:46:58', NULL);

--
-- Dumping data for table `outboxes`
--

INSERT INTO `outboxes` (`id`, `biro_id`, `user_id`, `no`, `title`, `date`, `date_entry`, `receiver_detail_id`, `description`, `is_attachment`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 2, 7, '003.1/4543/B.PPOD-I', 'RALAT SURAT BIRO PPOD', '2020-01-09', '2020-01-09', 86, NULL, 0, '2020-01-09 14:38:39', '2020-01-09 14:38:39', NULL),
(2, 2, 7, '660.1/4534-HK/2019', 'PENUNJUKKAN PERSONIL SEBAGAI TIM PENYUSUN NASKAH AKADEMIK DAN RAPERDA PENGELOLAAN LIMBAH B3', '2019-08-13', '2020-01-09', 55, NULL, 0, '2020-01-09 14:42:17', '2020-01-09 14:42:17', NULL);
