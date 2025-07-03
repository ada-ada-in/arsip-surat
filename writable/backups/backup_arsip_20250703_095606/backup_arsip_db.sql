

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

INSERT INTO `users` (`id`, `name`, `email`, `password`, `handphone`, `role`, `is_active`, `created_at`, `updated_at`) VALUES ('1', 'admin2', 'admin2@example.com', '$2y$10$X7ynMgupalLceXdlDx0WPuFNP/IW2lywMw.2sGCsLUYYk.QwABGuS', '0812312111122', 'admin', '1', '2025-06-15 20:05:29', '2025-06-15 20:05:29');
INSERT INTO `users` (`id`, `name`, `email`, `password`, `handphone`, `role`, `is_active`, `created_at`, `updated_at`) VALUES ('2', 'user1', 'user1@example.com', '$2y$10$85/B2bGKQHnGMWK/QDbeleA9CDJeudTAbfRtAOYmyNQnoi1sEvEhG', '081234567890', 'user', '1', '2025-06-16 14:26:33', '2025-06-16 14:26:33');


CREATE TABLE `jenis_laporan` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `nama_jenis_laporan` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `jenis_laporan` (`id`, `nama_jenis_laporan`, `created_at`, `updated_at`) VALUES ('1', 'Sangat Segera', '2025-06-25 06:45:45', '2025-06-25 06:45:45');


CREATE TABLE `sifat_laporan` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `nama_sifat_laporan` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `sifat_laporan` (`id`, `nama_sifat_laporan`, `created_at`, `updated_at`) VALUES ('1', 'Sifat 1', '2025-06-25 06:45:54', '2025-06-25 06:45:54');


CREATE TABLE `status_laporan` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `nama_status_laporan` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `status_laporan` (`id`, `nama_status_laporan`, `created_at`, `updated_at`) VALUES ('1', 'Status 1', '2025-06-25 06:46:00', '2025-06-25 06:46:00');


CREATE TABLE `disposisi_kepada` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `nama_kordinator` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `nip` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `nama_disposisi_kepada` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `disposisi_kepada` (`id`, `nama_kordinator`, `nip`, `nama_disposisi_kepada`, `created_at`, `updated_at`) VALUES ('1', 'Febriadi S.H', '1234567890', 'Ketua/Kordiv SDMO dan Diklat', '2025-06-25 06:46:11', '2025-06-25 06:46:11');


CREATE TABLE `disposisi_petunjuk` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `nama_disposisi_petunjuk` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `disposisi_petunjuk` (`id`, `nama_disposisi_petunjuk`, `created_at`, `updated_at`) VALUES ('1', 'Dikaji dan di tindak lanjuti', '2025-06-25 06:46:24', '2025-06-25 06:46:24');


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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `surat` (`id`, `id_user`, `id_jenis`, `id_sifat`, `id_status`, `id_disposisi_kepada`, `id_disposisi_petunjuk`, `perihal`, `nomor_surat`, `nomor_agenda`, `tanggal_diterima`, `is_completed`, `lampiran`, `dari`, `tipe_surat`, `link_surat`, `created_at`, `updated_at`) VALUES ('1', '1', '1', '1', '1', NULL, NULL, 'perihal', 'B-58/PM.01.02/K/JA/34', '-', '0000-00-00 00:00:00', '0', '-', 'Dari', 'masuk', 'uploads/surat/1750834004_cad7f54ddc78c5b60e2e.pdf', '2025-06-25 06:46:44', '2025-06-25 06:46:44');
INSERT INTO `surat` (`id`, `id_user`, `id_jenis`, `id_sifat`, `id_status`, `id_disposisi_kepada`, `id_disposisi_petunjuk`, `perihal`, `nomor_surat`, `nomor_agenda`, `tanggal_diterima`, `is_completed`, `lampiran`, `dari`, `tipe_surat`, `link_surat`, `created_at`, `updated_at`) VALUES ('2', '2', '1', '1', '1', '1', '1', 'perihal', 'B-58/PM.01.02/K/JA/341', '123111', '2025-06-24 00:00:00', '0', '-', 'Dari', 'masuk', 'uploads/surat/1751533999_f30665324f2a94df45c5.pdf', '2025-06-25 07:39:17', '2025-07-03 09:29:13');
INSERT INTO `surat` (`id`, `id_user`, `id_jenis`, `id_sifat`, `id_status`, `id_disposisi_kepada`, `id_disposisi_petunjuk`, `perihal`, `nomor_surat`, `nomor_agenda`, `tanggal_diterima`, `is_completed`, `lampiran`, `dari`, `tipe_surat`, `link_surat`, `created_at`, `updated_at`) VALUES ('3', '2', '1', '1', '1', NULL, NULL, 'perihal', 'B-58/PM.01.02/K/JA/3413', 'adwd', '0000-00-00 00:00:00', '0', '-', 'Dari', 'keluar', 'uploads/surat/1751536200_f24b534f3808df6605e2.pdf', '2025-07-03 09:50:01', '2025-07-03 09:50:01');


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

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES ('1', '2025-02-25-144538', 'App\\Database\\Migrations\\CreateTableUsers', 'default', 'App', '1750017921', '1');
INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES ('2', '2025-05-10-102316', 'App\\Database\\Migrations\\CreateTabelJenisLaporan', 'default', 'App', '1750017921', '1');
INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES ('3', '2025-05-10-102536', 'App\\Database\\Migrations\\CreateTabelSifatLaporan', 'default', 'App', '1750017922', '1');
INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES ('4', '2025-05-10-102625', 'App\\Database\\Migrations\\CreateTabelStatusLaporan', 'default', 'App', '1750017922', '1');
INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES ('5', '2025-05-10-105908', 'App\\Database\\Migrations\\CreateTabelDisposisiKepada', 'default', 'App', '1750017922', '1');
INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES ('6', '2025-05-10-110006', 'App\\Database\\Migrations\\CreateTabelDisposisiPetunjuk', 'default', 'App', '1750017922', '1');
INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES ('7', '2025-05-13-135856', 'App\\Database\\Migrations\\CreateTabelSurat', 'default', 'App', '1750017922', '1');
