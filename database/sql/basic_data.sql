--
-- Dumping data untuk tabel `accounts`
--

INSERT INTO `accounts` (`id`, `parent`, `head`, `kode_akun`, `nama_akun`, `deskripsi`, `tipe_akun`, `level`, `sn`, `period_id`, `begining_balance`, `link_id`, `endpoin`, `created_at`, `updated_at`, `deleted_at`, `status`) VALUES
(1, NULL, 1, '1', 'Aset', NULL, 0, 1, 'db', NULL, NULL, NULL, NULL, '2021-03-19 10:00:00', '2021-03-19 10:00:00', NULL, 2),
(2, NULL, 2, '2', 'Kewajiban', NULL, 0, 1, 'cr', NULL, NULL, NULL, NULL, '2021-03-19 10:00:00', '2021-03-19 10:00:00', NULL, 2),
(3, NULL, 3, '3', 'Ekuitas', NULL, 0, 1, 'cr', NULL, NULL, NULL, NULL, '2021-03-19 10:00:00', '2021-03-19 10:00:00', NULL, 2),
(4, NULL, 4, '4', 'Penerimaan', NULL, 1, 1, 'cr', NULL, NULL, NULL, NULL, '2021-03-19 10:00:00', '2021-03-19 10:00:00', NULL, 2),
(5, NULL, 5, '5', 'Biaya Atas Penerimaan', NULL, 1, 1, 'db', NULL, NULL, NULL, NULL, '2021-03-19 10:00:00', '2021-03-19 10:00:00', NULL, 2),
(6, NULL, 6, '6', 'Beban', NULL, 1, 1, 'db', NULL, NULL, NULL, NULL, '2021-03-19 10:00:00', '2021-03-19 10:00:00', NULL, 2),
(7, NULL, 7, '7', 'Kos', NULL, 1, 1, 'db', NULL, NULL, NULL, NULL, '2021-03-19 10:00:00', '2021-03-19 10:00:00', NULL, 2),
(8, NULL, 8, '8', 'Penerimaan Lain atau Komperhensif', NULL, 1, 1, 'cr', NULL, NULL, NULL, NULL, '2021-03-19 10:00:00', '2021-03-19 10:00:00', NULL, 2),
(9, NULL, 9, '9', 'Beban atau Biaya Lainnya', NULL, 1, 1, 'db', NULL, NULL, NULL, NULL, '2021-03-19 10:00:00', '2021-03-19 10:00:00', NULL, 2),
(10, 1, 1, '11', 'Aset Lancar', NULL, 0, 2, 'db', NULL, NULL, 14, NULL, '2021-03-19 10:00:00', '2021-03-19 10:00:00', NULL, 2),
(11, 1, 1, '12', 'Aset Tetap', NULL, 0, 2, 'db', NULL, NULL, NULL, NULL, '2021-03-19 10:00:00', '2021-03-19 10:00:00', NULL, 2),
(12, 2, 2, '21', 'Kewajiban Jangka Pendek', NULL, 0, 2, 'cr', NULL, NULL, 15, NULL, '2021-03-19 10:00:00', '2021-03-19 10:00:00', NULL, 2),
(13, 2, 2, '22', 'Kewajiban Jangka Panjang', NULL, 0, 2, 'cr', NULL, NULL, NULL, NULL, '2021-03-19 10:00:00', '2021-03-19 10:00:00', NULL, 2),
(14, 3, 3, '31', 'Setoran Modal', NULL, 0, 2, 'cr', NULL, NULL, NULL, NULL, '2021-03-19 10:00:00', '2021-03-19 10:00:00', NULL, 2),
(15, 3, 3, '32', 'Saldo Laba', NULL, 0, 2, 'cr', NULL, NULL, NULL, NULL, '2021-03-19 10:00:00', '2021-03-19 10:00:00', NULL, 2),
(16, 3, 3, '399', 'Ekuitas Lainnya', NULL, 0, 2, 'cr', NULL, NULL, NULL, NULL, '2021-03-19 10:00:00', '2021-03-19 10:00:00', NULL, 2),
(17, 3, 3, '3298', 'Laba Periode Berjalan', NULL, 0, 3, 'cr', NULL, NULL, NULL, NULL, '2021-03-19 10:00:00', '2021-03-19 10:00:00', NULL, 2),
(18, 3, 3, '3299', 'Laba Ditahan', NULL, 0, 3, 'cr', NULL, NULL, NULL, NULL, '2021-03-19 10:00:00', '2021-03-19 10:00:00', NULL, 2),
(19, 18, 3, '329999', 'Laba Rugi di Tahan', NULL, 0, 4, 'cr', 1, NULL, 9, NULL, '2021-03-19 10:00:00', '2021-03-19 10:00:00', NULL, 2),
(20, 17, 3, '329898', 'Laba Rugi Periode Berjalan', NULL, 0, 4, 'cr', NULL, NULL, 10, NULL, '2021-03-19 10:00:00', '2021-03-19 10:00:00', NULL, 2),
(21, 10, 1, '111', 'Kas dan Setara Kas', NULL, 0, 3, 'db', NULL, NULL, NULL, NULL, '2021-03-22 04:45:29', '2021-03-22 04:45:29', NULL, 1),
(22, 4, 4, '41', 'Penerimaan Penjualan', NULL, 1, 2, 'db', NULL, NULL, NULL, 1, '2021-03-22 04:45:29', '2021-03-22 04:45:29', NULL, 1),
(23, 4, 4, '42', 'Penerimaan Jasa', NULL, 1, 2, 'db', NULL, NULL, NULL, NULL, '2021-03-22 04:45:29', '2021-03-22 04:45:29', NULL, 1),
(24, 21, 1, '1111', 'Kas di Tangan', NULL, 0, 4, 'db', 1, NULL, 2, NULL, '2021-03-22 04:46:02', '2021-03-22 04:46:02', NULL, 1),
(25, 21, 1, '1112', 'Kas Bank Mandiri', NULL, 0, 4, 'db', 1, NULL, 3, NULL, '2021-03-22 04:46:02', '2021-03-22 04:46:02', NULL, 1),
(26, 21, 1, '1113', 'Kas Bank BNI', NULL, 0, 4, 'db', 1, NULL, 3, NULL, '2021-03-22 04:46:02', '2021-03-22 06:42:07', NULL, 1);

--
-- Dumping data untuk tabel `cashflows`
--

INSERT INTO `cashflows` (`id`, `aliran`, `kategori`, `nama`, `created_at`, `updated_at`) VALUES
(1, 'penerimaan', 'operasional', 'Penerimaan atas aktivitas usaha', '2021-03-20 08:39:13', '2021-03-20 08:39:13'),
(2, 'pengeluaran', 'operasional', 'Pembelian kebutuhan operasional usaha', '2021-03-20 08:39:27', '2021-03-20 08:39:27');

--
-- Dumping data untuk tabel `periods`
--

INSERT INTO `periods` (`id`, `start`, `end`, `created_at`, `updated_at`, `deleted_at`, `status`) VALUES
(1, '2021-01-01', '2021-12-31', '2021-03-20 14:19:07', '2021-03-20 16:14:26', NULL, 2),
(2, '2022-01-01', '2022-12-31', '2021-03-20 14:27:49', '2021-03-20 16:04:05', NULL, 1);

--
-- Dumping data untuk tabel `setups`
--

INSERT INTO `setups` (`id`, `slug`, `values`, `json_content`, `created_at`, `updated_at`, `status`) VALUES
(1, 'profil', NULL, '{\"fax\": null, \"npwp\": null, \"email\": \"info@alisa.id\", \"alamat\": \"Klajuran Gang Anggrek no 1 Sidokarto Godean Sleman, Daerah Istimewa Yogyakarta\", \"nomor_telepon\": \"082138842995\", \"nama_perusahaan\": \"PT ALISA INDONESIA\", \"akuntan_perusahaan\": \"Maria Selena\", \"pemilik_perusahaan\": \"Dani Greget Sumangghani\"}', '2021-03-19 06:58:54', '2021-03-19 07:01:05', 1),
(2, 'link', 'Kas di Tangan', NULL, '2021-03-20 02:57:23', '2021-03-20 03:05:00', 1),
(3, 'link', 'Kas di Bank', NULL, '2021-03-19 17:00:00', '2021-03-19 17:00:00', 1),
(4, 'link', 'Setara Kas', NULL, '2021-03-19 17:00:00', '2021-03-20 03:38:58', 1),
(5, 'link', 'Perpajakan', NULL, '2021-03-20 03:40:01', '2021-03-20 03:40:01', 1),
(6, 'link', 'Beban Keuangan (Bunga)', NULL, '2021-03-20 03:40:17', '2021-03-20 03:40:17', 1),
(7, 'link', 'Setoran Modal (Ekuitas)', NULL, '2021-03-20 03:40:25', '2021-03-20 03:40:25', 1),
(8, 'link', 'Pengembalian ke Pemilik (Ekuitas)', NULL, '2021-03-20 03:40:33', '2021-03-20 03:40:33', 1),
(9, 'link', 'Laba di Tahan (Ekuitas)', NULL, '2021-03-20 03:40:43', '2021-03-20 03:40:43', 2),
(10, 'link', 'Laba Periode Berjalan', NULL, '2021-03-20 03:40:49', '2021-03-20 03:40:49', 2),
(11, 'link', 'R/K Pusat (Konsolidasi)', NULL, '2021-03-20 03:40:55', '2021-03-20 03:40:55', 1),
(12, 'link', 'R/K Cabang (Konsolidasi)', NULL, '2021-03-20 03:41:13', '2021-03-20 03:41:13', 1),
(13, 'link', 'R/K Antar-Cabang (Konsolidasi)', NULL, '2021-03-20 03:41:56', '2021-03-20 03:41:56', 1),
(14, 'link', 'Aset Lancar', NULL, '2021-03-20 03:42:21', '2021-03-20 03:42:21', 2),
(15, 'link', 'Utang Lancar', NULL, '2021-03-20 03:42:29', '2021-03-20 03:42:29', 2),
(16, 'link', 'Beban Personnel (Pengeluaran Karyawan)', NULL, '2021-03-20 03:42:40', '2021-03-20 03:42:40', 1),
(17, 'link', 'Beban Penyusutan', NULL, '2021-03-20 03:42:47', '2021-03-20 03:42:47', 1),
(18, 'link', 'Revaluasi Penurunan Nilai Aset Tetap', NULL, '2021-03-20 03:44:08', '2021-03-20 03:44:08', 1),
(19, 'link', 'Revaluasi Kenaikan Nilai Aset Tetap', NULL, '2021-03-20 03:44:16', '2021-03-20 03:44:16', 1);

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Dani Greget Sumangghani', 'sumangghani@gmail.com', NULL, '$2y$10$FE3liH4EWd2fq3lNaYhgYulxuGsciOUCyqi7eyhr/3ohWg6yF3LIi', 0, NULL, '2021-03-18 08:36:31', '2021-03-18 16:27:46', NULL),
(2, 'Shofia Nur Rachma Utami', 'shofiautami@gmail.com', NULL, '$2y$10$FE3liH4EWd2fq3lNaYhgYulxuGsciOUCyqi7eyhr/3ohWg6yF3LIi', 1, NULL, '2021-03-19 08:55:32', '2021-03-19 16:51:31', NULL),
(3, 'Ika Fatmasari', 'ikafatmasari@gmail.com', NULL, '$2y$10$2IYUFSVnX5DDKguFx1dbLOobVKZDiV326odhirO27RYdbgR.gcQyW', 1, NULL, '2021-03-19 08:56:35', '2021-03-19 09:38:08', NULL);
