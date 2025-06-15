

CREATE TABLE `disposisi_kepada` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `nama_kordinator` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `nip` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `nama_disposisi_kepada` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `disposisi_kepada` (`id`, `nama_kordinator`, `nip`, `nama_disposisi_kepada`, `created_at`, `updated_at`) VALUES ('1', 'Febriadi S.H', '1234567890', 'Ketua/Kordiv SDMO dan Diklat', '2025-06-08 17:17:26', '2025-06-08 17:17:26');


CREATE TABLE `disposisi_petunjuk` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `nama_disposisi_petunjuk` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `disposisi_petunjuk` (`id`, `nama_disposisi_petunjuk`, `created_at`, `updated_at`) VALUES ('1', 'Dikaji dan di tindak lanjuti', '2025-06-08 17:17:35', '2025-06-08 17:17:35');


CREATE TABLE `jenis_laporan` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `nama_jenis_laporan` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `jenis_laporan` (`id`, `nama_jenis_laporan`, `created_at`, `updated_at`) VALUES ('1', 'Sangat Segera', '2025-06-08 17:17:04', '2025-06-08 17:17:04');


CREATE TABLE `migrations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `version` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `class` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `group` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `namespace` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `time` int NOT NULL,
  `batch` int unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES ('1', '2025-02-25-144538', 'App\\Database\\Migrations\\CreateTableUsers', 'default', 'App', '1749402970', '1');
INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES ('2', '2025-05-10-102316', 'App\\Database\\Migrations\\CreateTabelJenisLaporan', 'default', 'App', '1749402970', '1');
INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES ('3', '2025-05-10-102536', 'App\\Database\\Migrations\\CreateTabelSifatLaporan', 'default', 'App', '1749402970', '1');
INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES ('4', '2025-05-10-102625', 'App\\Database\\Migrations\\CreateTabelStatusLaporan', 'default', 'App', '1749402970', '1');
INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES ('5', '2025-05-10-105908', 'App\\Database\\Migrations\\CreateTabelDisposisiKepada', 'default', 'App', '1749402970', '1');
INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES ('6', '2025-05-10-110006', 'App\\Database\\Migrations\\CreateTabelDisposisiPetunjuk', 'default', 'App', '1749402970', '1');
INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES ('7', '2025-05-13-135856', 'App\\Database\\Migrations\\CreateTabelSurat', 'default', 'App', '1749402971', '1');


CREATE TABLE `sifat_laporan` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `nama_sifat_laporan` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `sifat_laporan` (`id`, `nama_sifat_laporan`, `created_at`, `updated_at`) VALUES ('1', 'Sifat 5', '2025-06-08 17:17:11', '2025-06-08 17:17:11');


CREATE TABLE `status_laporan` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `nama_status_laporan` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `status_laporan` (`id`, `nama_status_laporan`, `created_at`, `updated_at`) VALUES ('1', 'Status 1', '2025-06-08 17:17:17', '2025-06-08 17:17:17');


CREATE TABLE `surat` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `id_user` int unsigned NOT NULL,
  `id_jenis` int unsigned NOT NULL,
  `id_sifat` int unsigned NOT NULL,
  `id_status` int unsigned NOT NULL,
  `id_disposisi_kepada` int unsigned DEFAULT NULL,
  `id_disposisi_petunjuk` int unsigned DEFAULT NULL,
  `perihal` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `nomor_surat` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `nomor_agenda` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `tanggal_diterima` datetime NOT NULL,
  `is_completed` enum('0','1') COLLATE utf8mb4_general_ci NOT NULL DEFAULT '0',
  `lampiran` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `dari` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `tipe_surat` enum('masuk','keluar') COLLATE utf8mb4_general_ci NOT NULL,
  `link_surat` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `surat_id_jenis_foreign` (`id_jenis`),
  KEY `surat_id_sifat_foreign` (`id_sifat`),
  KEY `surat_id_status_foreign` (`id_status`),
  KEY `surat_id_disposisi_kepada_foreign` (`id_disposisi_kepada`),
  KEY `surat_id_disposisi_petunjuk_foreign` (`id_disposisi_petunjuk`),
  KEY `surat_id_user_foreign` (`id_user`),
  CONSTRAINT `surat_id_disposisi_kepada_foreign` FOREIGN KEY (`id_disposisi_kepada`) REFERENCES `disposisi_kepada` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `surat_id_disposisi_petunjuk_foreign` FOREIGN KEY (`id_disposisi_petunjuk`) REFERENCES `disposisi_petunjuk` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `surat_id_jenis_foreign` FOREIGN KEY (`id_jenis`) REFERENCES `jenis_laporan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `surat_id_sifat_foreign` FOREIGN KEY (`id_sifat`) REFERENCES `sifat_laporan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `surat_id_status_foreign` FOREIGN KEY (`id_status`) REFERENCES `status_laporan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `surat_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `surat` (`id`, `id_user`, `id_jenis`, `id_sifat`, `id_status`, `id_disposisi_kepada`, `id_disposisi_petunjuk`, `perihal`, `nomor_surat`, `nomor_agenda`, `tanggal_diterima`, `is_completed`, `lampiran`, `dari`, `tipe_surat`, `link_surat`, `created_at`, `updated_at`) VALUES ('1', '1', '1', '1', '1', NULL, NULL, '-', '31', '1', '0000-00-00 00:00:00', '0', '-', '-', 'masuk', 'uploads/surat/1749464595_a1710fb36a1ba2a02ccf.pdf', '2025-06-08 17:21:24', '2025-06-09 10:23:15');
INSERT INTO `surat` (`id`, `id_user`, `id_jenis`, `id_sifat`, `id_status`, `id_disposisi_kepada`, `id_disposisi_petunjuk`, `perihal`, `nomor_surat`, `nomor_agenda`, `tanggal_diterima`, `is_completed`, `lampiran`, `dari`, `tipe_surat`, `link_surat`, `created_at`, `updated_at`) VALUES ('2', '1', '1', '1', '1', NULL, NULL, '-', '3', '1', '0000-00-00 00:00:00', '0', '-', '-', 'masuk', NULL, '2025-06-08 17:24:11', '2025-06-08 17:24:11');
INSERT INTO `surat` (`id`, `id_user`, `id_jenis`, `id_sifat`, `id_status`, `id_disposisi_kepada`, `id_disposisi_petunjuk`, `perihal`, `nomor_surat`, `nomor_agenda`, `tanggal_diterima`, `is_completed`, `lampiran`, `dari`, `tipe_surat`, `link_surat`, `created_at`, `updated_at`) VALUES ('3', '1', '1', '1', '1', NULL, NULL, '-', '3', '1', '0000-00-00 00:00:00', '0', '-', '-', 'masuk', 'http://localhost:8080/uploads/surat/1749403643_98639ed535382f909e96.pdf', '2025-06-08 17:27:23', '2025-06-08 17:27:23');
INSERT INTO `surat` (`id`, `id_user`, `id_jenis`, `id_sifat`, `id_status`, `id_disposisi_kepada`, `id_disposisi_petunjuk`, `perihal`, `nomor_surat`, `nomor_agenda`, `tanggal_diterima`, `is_completed`, `lampiran`, `dari`, `tipe_surat`, `link_surat`, `created_at`, `updated_at`) VALUES ('4', '1', '1', '1', '1', NULL, NULL, '-', '3', '1', '0000-00-00 00:00:00', '0', '-', '-', 'masuk', 'uploads/surat/1749403677_7223bd69a758f7878371.pdf', '2025-06-08 17:27:57', '2025-06-08 17:27:57');
INSERT INTO `surat` (`id`, `id_user`, `id_jenis`, `id_sifat`, `id_status`, `id_disposisi_kepada`, `id_disposisi_petunjuk`, `perihal`, `nomor_surat`, `nomor_agenda`, `tanggal_diterima`, `is_completed`, `lampiran`, `dari`, `tipe_surat`, `link_surat`, `created_at`, `updated_at`) VALUES ('5', '1', '1', '1', '1', NULL, NULL, '-', '3', '1', '0000-00-00 00:00:00', '0', '-', '-', 'masuk', 'uploads/surat/1749403717_94cc176920f87f072bfd.xlsx', '2025-06-08 17:28:37', '2025-06-08 17:28:37');
INSERT INTO `surat` (`id`, `id_user`, `id_jenis`, `id_sifat`, `id_status`, `id_disposisi_kepada`, `id_disposisi_petunjuk`, `perihal`, `nomor_surat`, `nomor_agenda`, `tanggal_diterima`, `is_completed`, `lampiran`, `dari`, `tipe_surat`, `link_surat`, `created_at`, `updated_at`) VALUES ('6', '1', '1', '1', '1', NULL, NULL, 'Permintaan dokumentasi pengawasan', 'B-58/PM.01.02/K/JA/34', '-', '0000-00-00 00:00:00', '0', '-', 'Bawaslu Prov. Jambi', 'masuk', 'C:\\fakepath\\asdasss.pdf', '2025-06-08 17:32:32', '2025-06-08 17:32:32');
INSERT INTO `surat` (`id`, `id_user`, `id_jenis`, `id_sifat`, `id_status`, `id_disposisi_kepada`, `id_disposisi_petunjuk`, `perihal`, `nomor_surat`, `nomor_agenda`, `tanggal_diterima`, `is_completed`, `lampiran`, `dari`, `tipe_surat`, `link_surat`, `created_at`, `updated_at`) VALUES ('7', '1', '1', '1', '1', NULL, NULL, 'Permintaan dokumentasi pengawasan', 'B-58/PM.01.02/K/JA/34', '-', '0000-00-00 00:00:00', '0', '-', 'Bawaslu Prov. Jambi', 'masuk', 'uploads/surat/1749455982_15699c5bddc13f34ff63.pdf', '2025-06-09 07:59:42', '2025-06-09 07:59:42');
INSERT INTO `surat` (`id`, `id_user`, `id_jenis`, `id_sifat`, `id_status`, `id_disposisi_kepada`, `id_disposisi_petunjuk`, `perihal`, `nomor_surat`, `nomor_agenda`, `tanggal_diterima`, `is_completed`, `lampiran`, `dari`, `tipe_surat`, `link_surat`, `created_at`, `updated_at`) VALUES ('8', '2', '1', '1', '1', NULL, NULL, 'Perihal', 'B-58/PM.01.02/K/JA/90', '-', '0000-00-00 00:00:00', '0', '-', '123123', 'keluar', 'uploads/surat/1749457591_36197e444350daccee57.pdf', '2025-06-09 08:26:31', '2025-06-14 04:22:03');
INSERT INTO `surat` (`id`, `id_user`, `id_jenis`, `id_sifat`, `id_status`, `id_disposisi_kepada`, `id_disposisi_petunjuk`, `perihal`, `nomor_surat`, `nomor_agenda`, `tanggal_diterima`, `is_completed`, `lampiran`, `dari`, `tipe_surat`, `link_surat`, `created_at`, `updated_at`) VALUES ('9', '1', '1', '1', '1', '1', '1', '-', '311', '1', '2025-06-17 00:00:00', '0', '-', '-', 'masuk', 'uploads/surat/1749493751_f8d3226f42830e25bf74.xlsx', '2025-06-09 10:13:36', '2025-06-14 18:21:12');
INSERT INTO `surat` (`id`, `id_user`, `id_jenis`, `id_sifat`, `id_status`, `id_disposisi_kepada`, `id_disposisi_petunjuk`, `perihal`, `nomor_surat`, `nomor_agenda`, `tanggal_diterima`, `is_completed`, `lampiran`, `dari`, `tipe_surat`, `link_surat`, `created_at`, `updated_at`) VALUES ('10', '1', '1', '1', '1', NULL, NULL, 'Perihal', 'B-58/PM.01.02/K/JA/90', '-', '0000-00-00 00:00:00', '1', '-', '123123', 'masuk', 'uploads/surat/1749495490_2e041b2d0118d8c5e3c4.pdf', '2025-06-09 18:28:07', '2025-06-09 18:58:10');
INSERT INTO `surat` (`id`, `id_user`, `id_jenis`, `id_sifat`, `id_status`, `id_disposisi_kepada`, `id_disposisi_petunjuk`, `perihal`, `nomor_surat`, `nomor_agenda`, `tanggal_diterima`, `is_completed`, `lampiran`, `dari`, `tipe_surat`, `link_surat`, `created_at`, `updated_at`) VALUES ('11', '2', '1', '1', '1', NULL, NULL, '123', 'B-58/PM.01.02/K/JA/34', '1', '0000-00-00 00:00:00', '0', '-', '-', 'masuk', 'uploads/surat/1749494218_fdbff11fc81a736505bc.xlsx', '2025-06-09 18:36:47', '2025-06-09 18:36:58');


CREATE TABLE `users` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `handphone` varchar(15) COLLATE utf8mb4_general_ci NOT NULL,
  `role` enum('admin','user') COLLATE utf8mb4_general_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `users` (`id`, `name`, `email`, `password`, `handphone`, `role`, `is_active`, `created_at`, `updated_at`) VALUES ('1', 'admin', 'admin@example.com', '$2y$10$6OJXjSmhpJiC6vxFZtR6Me4CRDGAbP3naUFC64rTjqhSulrg6gbm.', '0812312111122', 'admin', '1', '2025-06-08 17:16:43', '2025-06-11 04:57:52');
INSERT INTO `users` (`id`, `name`, `email`, `password`, `handphone`, `role`, `is_active`, `created_at`, `updated_at`) VALUES ('2', 'user2', 'user@example.com', '$2y$10$OUTPUX1jEG7ScR.bSfhMBez5TaJOS1EHrwFEigFltClMZ7z2aQ.Gq', '081234567890', 'user', '0', '2025-06-09 18:29:51', '2025-06-14 18:51:14');
