

CREATE TABLE `disposisi_kepada` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `nama_kordinator` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `nip` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `nama_disposisi_kepada` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `disposisi_kepada` (`id`, `nama_kordinator`, `nip`, `nama_disposisi_kepada`, `created_at`, `updated_at`) VALUES ('1', 'Febriadi S.H', '19812311231111', 'Ketua/Kordiv SDMO dan Diklat', '2025-06-04 05:13:18', '2025-06-04 05:13:18');
INSERT INTO `disposisi_kepada` (`id`, `nama_kordinator`, `nip`, `nama_disposisi_kepada`, `created_at`, `updated_at`) VALUES ('2', 'Febriadi S.H', '19812311231111', 'Kordiv Pengananan Pelanggan dan Penyelesaian Sengketa', '2025-06-04 05:13:35', '2025-06-04 05:13:35');
INSERT INTO `disposisi_kepada` (`id`, `nama_kordinator`, `nip`, `nama_disposisi_kepada`, `created_at`, `updated_at`) VALUES ('3', 'Febriadi S.H', '19812311231111', 'Kordiv HPPMHM', '2025-06-04 05:13:53', '2025-06-04 05:13:53');
INSERT INTO `disposisi_kepada` (`id`, `nama_kordinator`, `nip`, `nama_disposisi_kepada`, `created_at`, `updated_at`) VALUES ('4', 'Febriadi S.H', '19812311231111', 'Kordinator Sekretariat', '2025-06-04 05:14:03', '2025-06-04 05:14:03');


CREATE TABLE `disposisi_petunjuk` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `nama_disposisi_petunjuk` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `disposisi_petunjuk` (`id`, `nama_disposisi_petunjuk`, `created_at`, `updated_at`) VALUES ('1', 'Dikaji dan di tindak lanjuti', '2025-06-04 05:14:22', '2025-06-04 05:14:22');
INSERT INTO `disposisi_petunjuk` (`id`, `nama_disposisi_petunjuk`, `created_at`, `updated_at`) VALUES ('2', 'Siapkan Materi', '2025-06-04 05:14:27', '2025-06-04 05:14:27');
INSERT INTO `disposisi_petunjuk` (`id`, `nama_disposisi_petunjuk`, `created_at`, `updated_at`) VALUES ('3', 'Hadiri', '2025-06-04 05:14:33', '2025-06-04 05:14:33');
INSERT INTO `disposisi_petunjuk` (`id`, `nama_disposisi_petunjuk`, `created_at`, `updated_at`) VALUES ('4', 'Selesai', '2025-06-04 05:14:38', '2025-06-04 05:14:38');
INSERT INTO `disposisi_petunjuk` (`id`, `nama_disposisi_petunjuk`, `created_at`, `updated_at`) VALUES ('5', 'Arsip Khusus', '2025-06-04 05:14:46', '2025-06-04 05:14:46');
INSERT INTO `disposisi_petunjuk` (`id`, `nama_disposisi_petunjuk`, `created_at`, `updated_at`) VALUES ('6', 'UDK', '2025-06-04 05:14:51', '2025-06-04 05:14:51');
INSERT INTO `disposisi_petunjuk` (`id`, `nama_disposisi_petunjuk`, `created_at`, `updated_at`) VALUES ('7', 'Arsip', '2025-06-04 05:15:01', '2025-06-04 05:15:01');
INSERT INTO `disposisi_petunjuk` (`id`, `nama_disposisi_petunjuk`, `created_at`, `updated_at`) VALUES ('8', 'Mengetahui', '2025-06-04 05:15:07', '2025-06-04 05:15:07');
INSERT INTO `disposisi_petunjuk` (`id`, `nama_disposisi_petunjuk`, `created_at`, `updated_at`) VALUES ('9', 'Hadiri bersama saya', '2025-06-04 05:15:12', '2025-06-04 05:15:12');
INSERT INTO `disposisi_petunjuk` (`id`, `nama_disposisi_petunjuk`, `created_at`, `updated_at`) VALUES ('10', 'Tindak Lanjuti', '2025-06-04 05:15:20', '2025-06-04 05:15:20');
INSERT INTO `disposisi_petunjuk` (`id`, `nama_disposisi_petunjuk`, `created_at`, `updated_at`) VALUES ('11', 'Pedoman', '2025-06-04 05:15:29', '2025-06-04 05:15:29');
INSERT INTO `disposisi_petunjuk` (`id`, `nama_disposisi_petunjuk`, `created_at`, `updated_at`) VALUES ('12', 'Tugaskan', '2025-06-04 05:15:33', '2025-06-04 05:15:40');


CREATE TABLE `jenis_laporan` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `nama_jenis_laporan` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `jenis_laporan` (`id`, `nama_jenis_laporan`, `created_at`, `updated_at`) VALUES ('1', 'Biasa', '2025-06-04 05:10:58', '2025-06-04 05:10:58');
INSERT INTO `jenis_laporan` (`id`, `nama_jenis_laporan`, `created_at`, `updated_at`) VALUES ('2', 'Penting', '2025-06-04 05:11:04', '2025-06-04 05:11:04');
INSERT INTO `jenis_laporan` (`id`, `nama_jenis_laporan`, `created_at`, `updated_at`) VALUES ('3', 'Segera', '2025-06-04 05:11:10', '2025-06-04 05:11:10');
INSERT INTO `jenis_laporan` (`id`, `nama_jenis_laporan`, `created_at`, `updated_at`) VALUES ('4', 'Sangat Segera', '2025-06-04 05:11:14', '2025-06-04 05:11:14');


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

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES ('1', '2025-02-25-144538', 'App\\Database\\Migrations\\CreateTableUsers', 'default', 'App', '1749013727', '1');
INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES ('2', '2025-05-10-102316', 'App\\Database\\Migrations\\CreateTabelJenisLaporan', 'default', 'App', '1749013727', '1');
INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES ('3', '2025-05-10-102536', 'App\\Database\\Migrations\\CreateTabelSifatLaporan', 'default', 'App', '1749013727', '1');
INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES ('4', '2025-05-10-102625', 'App\\Database\\Migrations\\CreateTabelStatusLaporan', 'default', 'App', '1749013727', '1');
INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES ('5', '2025-05-10-105908', 'App\\Database\\Migrations\\CreateTabelDisposisiKepada', 'default', 'App', '1749013727', '1');
INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES ('6', '2025-05-10-110006', 'App\\Database\\Migrations\\CreateTabelDisposisiPetunjuk', 'default', 'App', '1749013727', '1');
INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES ('7', '2025-05-13-135856', 'App\\Database\\Migrations\\CreateTabelSurat', 'default', 'App', '1749013727', '1');


CREATE TABLE `sifat_laporan` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `nama_sifat_laporan` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `sifat_laporan` (`id`, `nama_sifat_laporan`, `created_at`, `updated_at`) VALUES ('1', 'Sifat Example 1', '2025-06-04 05:11:27', '2025-06-04 05:11:27');
INSERT INTO `sifat_laporan` (`id`, `nama_sifat_laporan`, `created_at`, `updated_at`) VALUES ('2', 'Sifat Example 2', '2025-06-04 05:11:36', '2025-06-04 05:11:36');
INSERT INTO `sifat_laporan` (`id`, `nama_sifat_laporan`, `created_at`, `updated_at`) VALUES ('3', 'Sifat Example 3', '2025-06-04 05:11:43', '2025-06-04 05:11:43');
INSERT INTO `sifat_laporan` (`id`, `nama_sifat_laporan`, `created_at`, `updated_at`) VALUES ('4', 'Sifat Example 4', '2025-06-04 05:11:49', '2025-06-04 05:11:49');


CREATE TABLE `status_laporan` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `nama_status_laporan` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `status_laporan` (`id`, `nama_status_laporan`, `created_at`, `updated_at`) VALUES ('1', 'Status Example 1', '2025-06-04 05:12:03', '2025-06-04 05:12:03');
INSERT INTO `status_laporan` (`id`, `nama_status_laporan`, `created_at`, `updated_at`) VALUES ('2', 'Status Example 2', '2025-06-04 05:12:12', '2025-06-04 05:12:12');
INSERT INTO `status_laporan` (`id`, `nama_status_laporan`, `created_at`, `updated_at`) VALUES ('3', 'Status Example 3', '2025-06-04 05:12:17', '2025-06-04 05:12:17');
INSERT INTO `status_laporan` (`id`, `nama_status_laporan`, `created_at`, `updated_at`) VALUES ('5', 'Status Example 4', '2025-06-04 05:12:32', '2025-06-04 05:12:32');


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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `surat` (`id`, `id_user`, `id_jenis`, `id_sifat`, `id_status`, `id_disposisi_kepada`, `id_disposisi_petunjuk`, `perihal`, `nomor_surat`, `nomor_agenda`, `tanggal_diterima`, `is_completed`, `lampiran`, `dari`, `tipe_surat`, `created_at`, `updated_at`) VALUES ('1', '1', '4', '4', '3', NULL, NULL, 'Permintaan dokumentasi pengawasan', 'B-58/PM.01.02/K/JA/90', '-', '0000-00-00 00:00:00', '0', '-', 'Bawaslu Prov. Jambi', 'masuk', '2025-06-04 05:16:47', '2025-06-04 05:16:47');
INSERT INTO `surat` (`id`, `id_user`, `id_jenis`, `id_sifat`, `id_status`, `id_disposisi_kepada`, `id_disposisi_petunjuk`, `perihal`, `nomor_surat`, `nomor_agenda`, `tanggal_diterima`, `is_completed`, `lampiran`, `dari`, `tipe_surat`, `created_at`, `updated_at`) VALUES ('2', '1', '4', '3', '2', NULL, NULL, 'Permintaan dokumentasi pengawasan', 'B-58/PM.01.02/K/JA/23', '0913111', '0000-00-00 00:00:00', '0', '-', 'Bawaslu Prov. Jambi', 'keluar', '2025-06-01 05:17:26', '2025-06-01 05:17:26');
INSERT INTO `surat` (`id`, `id_user`, `id_jenis`, `id_sifat`, `id_status`, `id_disposisi_kepada`, `id_disposisi_petunjuk`, `perihal`, `nomor_surat`, `nomor_agenda`, `tanggal_diterima`, `is_completed`, `lampiran`, `dari`, `tipe_surat`, `created_at`, `updated_at`) VALUES ('3', '1', '4', '3', '3', '4', '12', 'Permintaan dokumentasi pengawasan', 'B-58/PM.01.02/K/JA/91', '-', '2025-06-21 00:00:00', '1', '-', 'Bawaslu Prov. Jambi', 'masuk', '2025-06-04 05:17:58', '2025-06-04 10:37:06');
INSERT INTO `surat` (`id`, `id_user`, `id_jenis`, `id_sifat`, `id_status`, `id_disposisi_kepada`, `id_disposisi_petunjuk`, `perihal`, `nomor_surat`, `nomor_agenda`, `tanggal_diterima`, `is_completed`, `lampiran`, `dari`, `tipe_surat`, `created_at`, `updated_at`) VALUES ('4', '2', '4', '3', '3', NULL, NULL, 'Permintaan dokumentasi pengawasan', 'B-58/PM.01.02/K/JA/91', '-', '0000-00-00 00:00:00', '0', '-', 'Bawaslu Prov. Jambi', 'masuk', '2025-06-04 10:55:54', '2025-06-04 10:55:54');
INSERT INTO `surat` (`id`, `id_user`, `id_jenis`, `id_sifat`, `id_status`, `id_disposisi_kepada`, `id_disposisi_petunjuk`, `perihal`, `nomor_surat`, `nomor_agenda`, `tanggal_diterima`, `is_completed`, `lampiran`, `dari`, `tipe_surat`, `created_at`, `updated_at`) VALUES ('5', '3', '4', '3', '3', NULL, NULL, 'Permintaan dokumentasi pengawasan', 'B-58/PM.01.02/K/JA/91', '-', '0000-00-00 00:00:00', '0', '-', 'Bawaslu Prov. Jambi', 'masuk', '2025-06-07 08:35:35', '2025-06-07 08:35:35');
INSERT INTO `surat` (`id`, `id_user`, `id_jenis`, `id_sifat`, `id_status`, `id_disposisi_kepada`, `id_disposisi_petunjuk`, `perihal`, `nomor_surat`, `nomor_agenda`, `tanggal_diterima`, `is_completed`, `lampiran`, `dari`, `tipe_surat`, `created_at`, `updated_at`) VALUES ('6', '3', '3', '3', '3', NULL, NULL, 'Permintaan dokumentasi pengawasan', 'B-58/PM.01.02/K/JA/34', '-', '0000-00-00 00:00:00', '0', '-', 'Bawaslu Prov. Jambi', 'keluar', '2025-06-07 08:35:53', '2025-06-07 08:35:53');


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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `users` (`id`, `name`, `email`, `password`, `handphone`, `role`, `is_active`, `created_at`, `updated_at`) VALUES ('1', 'user1', 'user1@example.com', '$2y$10$uf2j2dk0hnH0h1ZyWDj62.xKuHn0tSqmBOMFlL2rOMq8UfNTgJ7xi', '081234567890', 'user', '1', '2025-06-04 05:09:12', '2025-06-04 05:09:12');
INSERT INTO `users` (`id`, `name`, `email`, `password`, `handphone`, `role`, `is_active`, `created_at`, `updated_at`) VALUES ('2', 'admin', 'admin@example.com', '$2y$10$0ah5j4YDwVPuV30v5fhSbuy.MCDcDIFxvzmd6fUiKW5w6XJvq0PoS', '081231111111', 'admin', '1', '2025-06-04 05:10:02', '2025-06-04 05:10:02');
INSERT INTO `users` (`id`, `name`, `email`, `password`, `handphone`, `role`, `is_active`, `created_at`, `updated_at`) VALUES ('3', 'Bawaslu User 3', 'user3@example.com', '$2y$10$CjMRHR9/WBHfGh2lbK6UV.qhaoQb/LWEeYxJ7hqLT/d7Q/qE9nRlO', '081239123111', 'user', '1', '2025-06-07 08:35:04', '2025-06-07 08:35:04');
INSERT INTO `users` (`id`, `name`, `email`, `password`, `handphone`, `role`, `is_active`, `created_at`, `updated_at`) VALUES ('4', 'admin2', 'admin2@example.com', '$2y$10$gaGv9ONawTEELmZAsC2yD.oc.tWfXHZrgqtYOlfUNAw/A5DVoWOj.', '0812312111122', 'admin', '1', '2025-06-07 12:07:25', '2025-06-07 12:07:25');
