INSERT INTO `setups` (`id`, `slug`, `values`, `json_content`, `created_at`, `updated_at`) VALUES
(1, 'profil', NULL, '{\"fax\": null, \"npwp\": null, \"email\": \"info@alisa.id\", \"alamat\": \"Klajuran Gang Anggrek no 1 Sidokarto Godean Sleman, Daerah Istimewa Yogyakarta\", \"nomor_telepon\": \"082138842995\", \"nama_perusahaan\": \"PT ALISA INDONESIA\", \"akuntan_perusahaan\": \"Maria Selena\", \"pemilik_perusahaan\": \"Dani Greget Sumangghani\"}', '2021-03-19 13:58:54', '2021-03-19 14:01:05');


INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Dani Greget Sumangghani', 'sumangghani@gmail.com', NULL, '$2y$10$FE3liH4EWd2fq3lNaYhgYulxuGsciOUCyqi7eyhr/3ohWg6yF3LIi', 0, NULL, '2021-03-18 15:36:31', '2021-03-18 23:27:46', NULL),
(2, 'Shofia Utami', 'shofiautami@gmail.com', NULL, '$2y$10$FE3liH4EWd2fq3lNaYhgYulxuGsciOUCyqi7eyhr/3ohWg6yF3LIi', 1, NULL, '2021-03-19 15:55:32', '2021-03-19 15:55:32', NULL),
(3, 'Ika Fatmasari', 'ikafatmasari@gmail.com', NULL, '$2y$10$2IYUFSVnX5DDKguFx1dbLOobVKZDiV326odhirO27RYdbgR.gcQyW', 1, NULL, '2021-03-19 15:56:35', '2021-03-19 16:38:08', NULL);
COMMIT;
