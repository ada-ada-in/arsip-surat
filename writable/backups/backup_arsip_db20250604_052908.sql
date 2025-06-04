

CREATE TABLE `disposisi_kepada` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `nama_kordinator` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `nip` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `nama_disposisi_kepada` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `disposisi_kepada` (`id`, `nama_kordinator`, `nip`, `nama_disposisi_kepada`, `created_at`, `updated_at`) VALUES ('1', 'Febriadi S.H', '19812311231111', 'Kordinator Sekretariat', '2025-06-04 05:28:32', '2025-06-04 05:28:32');


CREATE TABLE `disposisi_petunjuk` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `nama_disposisi_petunjuk` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `disposisi_petunjuk` (`id`, `nama_disposisi_petunjuk`, `created_at`, `updated_at`) VALUES ('1', 'Dikaji dan di tindak lanjuti', '2025-06-04 05:28:37', '2025-06-04 05:28:37');


CREATE TABLE `jenis_laporan` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `nama_jenis_laporan` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `jenis_laporan` (`id`, `nama_jenis_laporan`, `created_at`, `updated_at`) VALUES ('1', 'Sangat Segera', '2025-06-04 05:28:08', '2025-06-04 05:28:08');


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

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES ('1', '2025-02-25-144538', 'App\\Database\\Migrations\\CreateTableUsers', 'default', 'App', '1749014827', '1');
INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES ('2', '2025-05-10-102316', 'App\\Database\\Migrations\\CreateTabelJenisLaporan', 'default', 'App', '1749014827', '1');
INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES ('3', '2025-05-10-102536', 'App\\Database\\Migrations\\CreateTabelSifatLaporan', 'default', 'App', '1749014827', '1');
INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES ('4', '2025-05-10-102625', 'App\\Database\\Migrations\\CreateTabelStatusLaporan', 'default', 'App', '1749014827', '1');
INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES ('5', '2025-05-10-105908', 'App\\Database\\Migrations\\CreateTabelDisposisiKepada', 'default', 'App', '1749014827', '1');
INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES ('6', '2025-05-10-110006', 'App\\Database\\Migrations\\CreateTabelDisposisiPetunjuk', 'default', 'App', '1749014827', '1');
INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES ('7', '2025-05-13-135856', 'App\\Database\\Migrations\\CreateTabelSurat', 'default', 'App', '1749014827', '1');


CREATE TABLE `sifat_laporan` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `nama_sifat_laporan` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `sifat_laporan` (`id`, `nama_sifat_laporan`, `created_at`, `updated_at`) VALUES ('1', 'Sifat 5', '2025-06-04 05:28:16', '2025-06-04 05:28:16');


CREATE TABLE `status_laporan` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `nama_status_laporan` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `status_laporan` (`id`, `nama_status_laporan`, `created_at`, `updated_at`) VALUES ('1', 'Status 1', '2025-06-04 05:28:24', '2025-06-04 05:28:24');


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
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `surat_id_user_foreign` (`id_user`),
  KEY `surat_id_jenis_foreign` (`id_jenis`),
  KEY `surat_id_sifat_foreign` (`id_sifat`),
  KEY `surat_id_status_foreign` (`id_status`),
  KEY `surat_id_disposisi_kepada_foreign` (`id_disposisi_kepada`),
  KEY `surat_id_disposisi_petunjuk_foreign` (`id_disposisi_petunjuk`),
  CONSTRAINT `surat_id_disposisi_kepada_foreign` FOREIGN KEY (`id_disposisi_kepada`) REFERENCES `disposisi_kepada` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `surat_id_disposisi_petunjuk_foreign` FOREIGN KEY (`id_disposisi_petunjuk`) REFERENCES `disposisi_petunjuk` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `surat_id_jenis_foreign` FOREIGN KEY (`id_jenis`) REFERENCES `jenis_laporan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `surat_id_sifat_foreign` FOREIGN KEY (`id_sifat`) REFERENCES `sifat_laporan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `surat_id_status_foreign` FOREIGN KEY (`id_status`) REFERENCES `status_laporan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `surat_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `surat` (`id`, `id_user`, `id_jenis`, `id_sifat`, `id_status`, `id_disposisi_kepada`, `id_disposisi_petunjuk`, `perihal`, `nomor_surat`, `nomor_agenda`, `tanggal_diterima`, `is_completed`, `lampiran`, `dari`, `tipe_surat`, `created_at`, `updated_at`) VALUES ('1', '1', '1', '1', '1', NULL, NULL, 'Permintaan dokumentasi pengawasan', 'B-58/PM.01.02/K/JA/91', '-', '0000-00-00 00:00:00', '0', '-', 'Bawaslu Prov. Jambi', 'masuk', '2025-06-04 05:28:49', '2025-06-04 05:28:49');
INSERT INTO `surat` (`id`, `id_user`, `id_jenis`, `id_sifat`, `id_status`, `id_disposisi_kepada`, `id_disposisi_petunjuk`, `perihal`, `nomor_surat`, `nomor_agenda`, `tanggal_diterima`, `is_completed`, `lampiran`, `dari`, `tipe_surat`, `created_at`, `updated_at`) VALUES ('2', '1', '1', '1', '1', NULL, NULL, 'Permintaan dokumentasi pengawasan', 'B-58/PM.01.02/K/JA/23', '0913111', '0000-00-00 00:00:00', '0', '-', 'Bawaslu Prov. Jambi', 'keluar', '2025-06-04 05:29:00', '2025-06-04 05:29:00');


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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `users` (`id`, `name`, `email`, `password`, `handphone`, `role`, `is_active`, `created_at`, `updated_at`) VALUES ('1', 'admin', 'admin@example.com', '$2y$10$8NjKscOd2xcjWuHM/Az9vOMGrNZP6HNaCud77ZU4UpHE4AfQhl9Vq', '081231111111', 'admin', '1', '2025-06-04 05:27:37', '2025-06-04 05:27:37');
