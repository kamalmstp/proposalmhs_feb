-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 12, 2020 at 05:44 AM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.2.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `proposal_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `catatan`
--

CREATE TABLE `catatan` (
  `id` int(10) UNSIGNED NOT NULL,
  `proposal_id` int(10) UNSIGNED NOT NULL,
  `catatan` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2017_11_06_054939_entrust_setup_tables', 1),
(4, '2017_11_09_150845_proposal_table', 1),
(5, '2017_11_10_150034_catatan_table', 1),
(6, '2018_01_07_164417_tambah_kolom_proposal', 1),
(7, '2018_01_08_233900_pagu_table', 1),
(8, '2018_02_05_212506_prodi_table', 1),
(9, '2018_02_05_215705_tambah_kolom_users', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pagu`
--

CREATE TABLE `pagu` (
  `id` int(10) UNSIGNED NOT NULL,
  `tahun` int(11) NOT NULL,
  `pagu` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sisa` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pagu`
--

INSERT INTO `pagu` (`id`, `tahun`, `pagu`, `sisa`, `created_at`, `updated_at`) VALUES
(1, 2020, '34.000', '34.000', '2020-09-12 03:15:56', '2020-09-12 03:15:56');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `display_name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'proposal_mhs', NULL, NULL, '2020-09-12 03:00:57', '2020-09-12 03:00:57'),
(2, 'proposal_masuk', NULL, NULL, '2020-09-12 03:00:57', '2020-09-12 03:00:57'),
(3, 'proposal_revisi', NULL, NULL, '2020-09-12 03:00:57', '2020-09-12 03:00:57'),
(4, 'proposal_disetujui', NULL, NULL, '2020-09-12 03:00:57', '2020-09-12 03:00:57'),
(5, 'proposal_ditolak', NULL, NULL, '2020-09-12 03:00:57', '2020-09-12 03:00:57'),
(6, 'status_dana', NULL, NULL, '2020-09-12 03:00:57', '2020-09-12 03:00:57'),
(7, 'input_proposal', NULL, NULL, '2020-09-12 03:00:57', '2020-09-12 03:00:57'),
(8, 'edit_proposal', NULL, NULL, '2020-09-12 03:00:57', '2020-09-12 03:00:57');

-- --------------------------------------------------------

--
-- Table structure for table `permission_role`
--

CREATE TABLE `permission_role` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permission_role`
--

INSERT INTO `permission_role` (`permission_id`, `role_id`) VALUES
(1, 6),
(2, 2),
(2, 4),
(2, 5),
(3, 4),
(4, 2),
(4, 3),
(4, 4),
(4, 5),
(5, 4),
(6, 3),
(7, 6),
(8, 6);

-- --------------------------------------------------------

--
-- Table structure for table `prodi`
--

CREATE TABLE `prodi` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `prodi`
--

INSERT INTO `prodi` (`id`, `nama`, `created_at`, `updated_at`) VALUES
(1, 'D3 Akuntansi', '2020-09-07 08:01:58', '2020-09-07 08:01:58'),
(2, 'D3 Perpajakan', '2020-09-07 08:04:44', '2020-09-07 08:04:44'),
(3, 'S1 Manajemen', '2020-09-07 08:04:45', '2020-09-07 08:04:45'),
(4, 'S1 Akuntansi', '2020-09-07 08:04:45', '2020-09-07 08:04:45'),
(5, 'S1 Ilmu Ekonomi dan Studi Pembangunan', '2020-09-07 08:04:45', '2020-09-07 08:04:45'),
(6, 'S2 Manajemen', '2020-09-07 08:04:45', '2020-09-07 08:04:45'),
(7, 'S2 Ilmu Ekonomi', '2020-09-07 08:04:45', '2020-09-07 08:04:45'),
(8, 'S2 Akuntansi', '2020-09-07 08:04:45', '2020-09-07 08:04:45'),
(9, 'Pendidikan Profesi Akuntansi', '2020-09-07 08:04:45', '2020-09-07 08:04:45');

-- --------------------------------------------------------

--
-- Table structure for table `proposal`
--

CREATE TABLE `proposal` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `organisasi` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kegiatan` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tempat` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `anggaran_a` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `anggaran_b` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dana` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lpj` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `proposal`
--

INSERT INTO `proposal` (`id`, `user_id`, `organisasi`, `kegiatan`, `tanggal`, `tempat`, `anggaran_a`, `anggaran_b`, `dana`, `status`, `file`, `lpj`, `created_at`, `updated_at`) VALUES
(1, 6, 'sdfdg', 'dsgdg', '2020-09-12 09:32:46', 'sthsh', 'shsth', 'shdsh', 'sdhdsh', 'Disetujui', 'agadg', 'agadg', '2020-09-12 01:32:46', '2020-09-12 01:32:46');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `display_name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'Administrator', NULL, '2020-09-12 00:41:20', '2020-09-12 00:41:20'),
(2, 'dekan', 'Dekan', NULL, '2020-09-12 00:41:20', '2020-09-12 00:41:20'),
(3, 'wd2', 'Wakil Dekan 2', NULL, '2020-09-12 00:41:20', '2020-09-12 00:41:20'),
(4, 'wd3', 'Wakil Dekan 3', NULL, '2020-09-12 00:41:20', '2020-09-12 00:41:20'),
(5, 'umum', 'Umum', NULL, '2020-09-12 00:41:20', '2020-09-12 00:41:20'),
(6, 'mhs', 'Mahasiswa', NULL, '2020-09-12 00:41:20', '2020-09-12 00:41:20');

-- --------------------------------------------------------

--
-- Table structure for table `role_user`
--

CREATE TABLE `role_user` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_user`
--

INSERT INTO `role_user` (`user_id`, `role_id`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5),
(6, 6);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `ps_id` int(10) UNSIGNED NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nim` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prodi` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telepon` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `ps_id`, `email`, `name`, `nim`, `prodi`, `telepon`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 1, 'admin@mail.com', 'Halimah T', 'kjsdfkj', 'Mahasiswa', '87498', '$2y$10$Svh4Re9GN2dFXrxBER3rNeNeg5sTh6OU6PXrkdAJKdNbRkLXQZYhG', 'q2Z8Slrrg1AX3Bsya4Dnp9mNFkt8q5yxIfaZSDuC5iRyKLIEbcgbcwZkCaig', '2020-09-12 00:29:39', '2020-09-12 01:01:41'),
(2, 1, 'dekan@mail.com', 'Dekan', '21334325', 'xfgh', '546457', '$2y$10$ZQa/8suY8jnGJEQ4UXGT9usEg3fVgMNOvczyyTcFV8rzNmic7ihxa', 'l0KiKvI5V84SezpEGAxHzGeEZgK0JhxTfnF46YRCR4pZlgvAuQ5k0NV9pyId', '2020-09-12 00:50:37', '2020-09-12 01:01:20'),
(3, 2, 'wd2@mail.com', 'Wakil Dekan 2 T', '3453434', 'sgsg', '25235', '$2y$10$ZQa/8suY8jnGJEQ4UXGT9usEg3fVgMNOvczyyTcFV8rzNmic7ihxa', '97YxrPZAaP85EvmuACHTBMJGKt3qEwnl2p06vVDlhVaZG4Y54VHpuh7pwip4', '2020-09-12 00:50:37', '2020-09-12 01:01:51'),
(4, 4, 'wd3@mail.com', 'Wakil Dekan 3', '4657', 'sgfdhgh', '4345747', '$2y$10$ZQa/8suY8jnGJEQ4UXGT9usEg3fVgMNOvczyyTcFV8rzNmic7ihxa', 'jhKWJ3GfqdJ2x6XXz0P4VxlEiRNvOjW3TZLfFGLxdia4ykCaorfpi9Mhfwfl', '2020-09-12 00:50:37', '2020-09-12 00:50:37'),
(5, 9, 'umum@mail.com', 'Umum', '3656', 'dfyjgdj', '346346', '$2y$10$ZQa/8suY8jnGJEQ4UXGT9usEg3fVgMNOvczyyTcFV8rzNmic7ihxa', 'mxvOlPfaNWMtwubh6V8RnlnW29m12VrEhRgek8iS29hJZwpNHy0B9Yl84vaW', '2020-09-12 00:50:37', '2020-09-12 01:06:16'),
(6, 9, 'mahasiswa@mail.com', 'Halimah 2', '123456789', 'Mahasiswa', '081234567895', '$2y$10$ZQa/8suY8jnGJEQ4UXGT9usEg3fVgMNOvczyyTcFV8rzNmic7ihxa', 'pPak12qIJT9KF0RxdndHOMDCjWN17qBjXwdJrfC3iirhuGlcuHAXMm5dL14Q', '2020-09-12 00:32:01', '2020-09-12 01:06:09');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `catatan`
--
ALTER TABLE `catatan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `catatan_proposal_id_foreign` (`proposal_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pagu`
--
ALTER TABLE `pagu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_unique` (`name`);

--
-- Indexes for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `permission_role_role_id_foreign` (`role_id`);

--
-- Indexes for table `prodi`
--
ALTER TABLE `prodi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `proposal`
--
ALTER TABLE `proposal`
  ADD PRIMARY KEY (`id`),
  ADD KEY `proposal_user_id_foreign` (`user_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_unique` (`name`);

--
-- Indexes for table `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`user_id`,`role_id`),
  ADD KEY `role_user_role_id_foreign` (`role_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_ps_id_foreign` (`ps_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `catatan`
--
ALTER TABLE `catatan`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `pagu`
--
ALTER TABLE `pagu`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `prodi`
--
ALTER TABLE `prodi`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `proposal`
--
ALTER TABLE `proposal`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `catatan`
--
ALTER TABLE `catatan`
  ADD CONSTRAINT `catatan_proposal_id_foreign` FOREIGN KEY (`proposal_id`) REFERENCES `proposal` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `proposal`
--
ALTER TABLE `proposal`
  ADD CONSTRAINT `proposal_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `role_user`
--
ALTER TABLE `role_user`
  ADD CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `role_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ps_id_foreign` FOREIGN KEY (`ps_id`) REFERENCES `prodi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
