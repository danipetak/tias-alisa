INSERT INTO `setups` (`id`, `slug`, `values`, `json_content`, `created_at`, `updated_at`) VALUES
(1, 'profil', NULL, '{\"fax\": null, \"npwp\": null, \"email\": \"info@alisa.id\", \"alamat\": \"Klajuran Gang Anggrek no 1 Sidokarto Godean Sleman, Daerah Istimewa Yogyakarta\", \"nomor_telepon\": \"082138842995\", \"nama_perusahaan\": \"PT ALISA INDONESIA\", \"akuntan_perusahaan\": \"Maria Selena\", \"pemilik_perusahaan\": \"Dani Greget Sumangghani\"}', '2021-03-19 06:58:54', '2021-03-19 07:01:05'),
(2, 'link', 'Kas di Tangan', NULL, '2021-03-20 02:57:23', '2021-03-20 03:05:00'),
(3, 'link', 'Kas di Bank', NULL, '2021-03-19 17:00:00', '2021-03-19 17:00:00'),
(4, 'link', 'Setara Kas', NULL, '2021-03-19 17:00:00', '2021-03-20 03:38:58'),
(5, 'link', 'Perpajakan', NULL, '2021-03-20 03:40:01', '2021-03-20 03:40:01'),
(6, 'link', 'Beban Keuangan (Bunga)', NULL, '2021-03-20 03:40:17', '2021-03-20 03:40:17'),
(7, 'link', 'Setoran Modal (Ekuitas)', NULL, '2021-03-20 03:40:25', '2021-03-20 03:40:25'),
(8, 'link', 'Pengembalian ke Pemilik (Ekuitas)', NULL, '2021-03-20 03:40:33', '2021-03-20 03:40:33'),
(9, 'link', 'Laba di Tahan (Ekuitas)', NULL, '2021-03-20 03:40:43', '2021-03-20 03:40:43'),
(10, 'link', 'Laba Periode Berjalan', NULL, '2021-03-20 03:40:49', '2021-03-20 03:40:49'),
(11, 'link', 'R/K Pusat (Konsolidasi)', NULL, '2021-03-20 03:40:55', '2021-03-20 03:40:55'),
(12, 'link', 'R/K Cabang (Konsolidasi)', NULL, '2021-03-20 03:41:13', '2021-03-20 03:41:13'),
(13, 'link', 'R/K Antar-Cabang (Konsolidasi)', NULL, '2021-03-20 03:41:56', '2021-03-20 03:41:56'),
(14, 'link', 'Aset Lancar (Level 2)', NULL, '2021-03-20 03:42:21', '2021-03-20 03:42:21'),
(15, 'link', 'Utang Lancar (Level 2)', NULL, '2021-03-20 03:42:29', '2021-03-20 03:42:29'),
(16, 'link', 'Beban Personnel (Pengeluaran Karyawan)', NULL, '2021-03-20 03:42:40', '2021-03-20 03:42:40'),
(17, 'link', 'Beban Penyusutan', NULL, '2021-03-20 03:42:47', '2021-03-20 03:42:47'),
(18, 'link', 'Revaluasi Penurunan Nilai Aset Tetap', NULL, '2021-03-20 03:44:08', '2021-03-20 03:44:08'),
(19, 'link', 'Revaluasi Kenaikan Nilai Aset Tetap', NULL, '2021-03-20 03:44:16', '2021-03-20 03:44:16');
COMMIT;


INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Dani Greget Sumangghani', 'sumangghani@gmail.com', NULL, '$2y$10$FE3liH4EWd2fq3lNaYhgYulxuGsciOUCyqi7eyhr/3ohWg6yF3LIi', 0, NULL, '2021-03-18 15:36:31', '2021-03-18 23:27:46', NULL),
(2, 'Shofia Utami', 'shofiautami@gmail.com', NULL, '$2y$10$FE3liH4EWd2fq3lNaYhgYulxuGsciOUCyqi7eyhr/3ohWg6yF3LIi', 1, NULL, '2021-03-19 15:55:32', '2021-03-19 15:55:32', NULL),
(3, 'Ika Fatmasari', 'ikafatmasari@gmail.com', NULL, '$2y$10$2IYUFSVnX5DDKguFx1dbLOobVKZDiV326odhirO27RYdbgR.gcQyW', 1, NULL, '2021-03-19 15:56:35', '2021-03-19 16:38:08', NULL);
COMMIT;
