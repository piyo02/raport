-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: 21 Feb 2020 pada 16.16
-- Versi Server: 5.7.29-0ubuntu0.18.04.1
-- PHP Version: 7.2.24-0ubuntu0.18.04.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `raport`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `absence`
--

CREATE TABLE `absence` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `student_id` int(10) UNSIGNED NOT NULL,
  `sick` int(3) NOT NULL,
  `permission` int(3) NOT NULL,
  `without_explanation` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `absence`
--

INSERT INTO `absence` (`id`, `user_id`, `student_id`, `sick`, `permission`, `without_explanation`) VALUES
(1, 20, 1, 10, 1, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `achievement`
--

CREATE TABLE `achievement` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `student_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `assignment`
--

CREATE TABLE `assignment` (
  `id` int(10) UNSIGNED NOT NULL,
  `student_id` int(10) UNSIGNED NOT NULL,
  `course_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `value` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `assignment`
--

INSERT INTO `assignment` (`id`, `student_id`, `course_id`, `user_id`, `name`, `value`) VALUES
(1, 1, 1, 20, 'Tugas Pertama', 90),
(2, 1, 2, 22, 'Tugas Hapalan Al-Qur\'an', 85);

-- --------------------------------------------------------

--
-- Struktur dari tabel `attitude`
--

CREATE TABLE `attitude` (
  `id` int(10) UNSIGNED NOT NULL,
  `school_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `attitude`
--

INSERT INTO `attitude` (`id`, `school_id`, `name`) VALUES
(2, 1, 'Sosial'),
(3, 1, 'spiritual');

-- --------------------------------------------------------

--
-- Struktur dari tabel `category`
--

CREATE TABLE `category` (
  `id` int(10) UNSIGNED NOT NULL,
  `school_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `category`
--

INSERT INTO `category` (`id`, `school_id`, `name`, `description`) VALUES
(1, 1, 'Kelompok A', 'Mata Pelajaran Wajib'),
(2, 1, 'Kelompok B', 'Mata Pelajaran Peminatan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `classroom`
--

CREATE TABLE `classroom` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `school_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `classroom`
--

INSERT INTO `classroom` (`id`, `user_id`, `school_id`, `name`, `description`) VALUES
(1, 20, 1, 'X IPA 1', 'Kelas 10 IPA 1'),
(2, 22, 1, 'XI IPA 1', '-');

-- --------------------------------------------------------

--
-- Struktur dari tabel `courses`
--

CREATE TABLE `courses` (
  `id` int(10) UNSIGNED NOT NULL,
  `school_id` int(10) UNSIGNED NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `courses`
--

INSERT INTO `courses` (`id`, `school_id`, `category_id`, `name`, `description`) VALUES
(1, 1, 1, 'Matematika', 'Matematika Wajib'),
(2, 1, 1, 'Agama', 'Pelajaran Agama'),
(3, 1, 2, 'Fisika', 'Pelajaran Fisika'),
(4, 1, 1, 'Nama', '-');

-- --------------------------------------------------------

--
-- Struktur dari tabel `extracurricular`
--

CREATE TABLE `extracurricular` (
  `id` int(10) UNSIGNED NOT NULL,
  `school_id` int(10) UNSIGNED NOT NULL,
  `group_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `extracurricular`
--

INSERT INTO `extracurricular` (`id`, `school_id`, `group_id`, `name`) VALUES
(1, 1, 1, 'Pramuka'),
(2, 1, 1, 'Olahraga'),
(3, 1, 2, 'Kesenian');

-- --------------------------------------------------------

--
-- Struktur dari tabel `extracurricular_group`
--

CREATE TABLE `extracurricular_group` (
  `id` int(10) UNSIGNED NOT NULL,
  `school_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `extracurricular_group`
--

INSERT INTO `extracurricular_group` (`id`, `school_id`, `name`, `description`) VALUES
(1, 1, 'Ekstrakurikuler Wajib', 'Wajib diikuti semua siswa'),
(2, 1, 'Ekstrakurikuler Pilihan', 'Ekskul Pilihan Siswa');

-- --------------------------------------------------------

--
-- Struktur dari tabel `groups`
--

CREATE TABLE `groups` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `groups`
--

INSERT INTO `groups` (`id`, `name`, `description`) VALUES
(1, 'admin', 'Administrator'),
(2, 'uadmin', 'user admin'),
(3, 'school_admin', 'Admin Sekolah'),
(4, 'school_head', 'Kepala Sekolah'),
(5, 'teacher', 'User Guru');

-- --------------------------------------------------------

--
-- Struktur dari tabel `login_attempts`
--

CREATE TABLE `login_attempts` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `menus`
--

CREATE TABLE `menus` (
  `id` int(10) UNSIGNED NOT NULL,
  `menu_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `link` varchar(50) NOT NULL,
  `list_id` varchar(200) NOT NULL,
  `icon` varchar(50) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `position` int(4) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `menus`
--

INSERT INTO `menus` (`id`, `menu_id`, `name`, `link`, `list_id`, `icon`, `status`, `position`, `description`) VALUES
(113, 5, 'Beranda', 'teacher/home', 'home_index', 'home', 1, 1, '-'),
(114, 5, 'Input Penilaian', 'teacher/assessment', 'assessment_index', 'home', 1, 1, '-'),
(115, 2, 'Beranda', 'uadmin/home', 'home_index', 'home', 1, 1, '-'),
(116, 2, 'Sekolah', 'uadmin/schools', 'schools_index', 'home', 1, 1, '-'),
(117, 3, 'Beranda', 'school_admin/home', 'home_index', 'home', 1, 1, '-'),
(118, 3, 'Sekolah', 'school_admin/school', 'school_admin_school', 'home', 1, 1, '-'),
(119, 118, 'Mata Pelajaran', 'school_admin/courses', 'courses_index', 'home', 1, 1, '-'),
(120, 118, 'Kelas', 'school_admin/classroom', 'classroom_index', 'home', 1, 1, '-'),
(121, 3, 'Guru', 'school_admin/users', 'users_index', 'home', 1, 1, '-'),
(122, 118, 'Aturan Penilaian', 'school_admin/assessment', 'assessment_index', 'home', 1, 1, '-'),
(123, 118, 'Ekstrakurikuler', 'school_admin/extracurricular', 'extracurricular_index', 'home', 1, 1, '-');

-- --------------------------------------------------------

--
-- Struktur dari tabel `predicate_attitude`
--

CREATE TABLE `predicate_attitude` (
  `id` int(10) UNSIGNED NOT NULL,
  `school_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(2) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `predicate_attitude`
--

INSERT INTO `predicate_attitude` (`id`, `school_id`, `name`, `description`) VALUES
(2, 1, 'A', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quis, perspiciatis!'),
(3, 1, 'B', 'Baik');

-- --------------------------------------------------------

--
-- Struktur dari tabel `predicate_rating`
--

CREATE TABLE `predicate_rating` (
  `id` int(10) UNSIGNED NOT NULL,
  `school_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(2) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `predicate_rating`
--

INSERT INTO `predicate_rating` (`id`, `school_id`, `name`, `description`) VALUES
(2, 1, 'A', 'Sangat Baik'),
(3, 1, 'B', 'Baik'),
(4, 1, 'C', 'Cukup'),
(5, 1, 'D', 'Kurang');

-- --------------------------------------------------------

--
-- Struktur dari tabel `rating_extracurricular`
--

CREATE TABLE `rating_extracurricular` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `student_id` int(10) UNSIGNED NOT NULL,
  `extracurricular_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `rating_extracurricular`
--

INSERT INTO `rating_extracurricular` (`id`, `student_id`, `extracurricular_id`, `name`, `description`) VALUES
(4, 1, 1, 'SB', 'Sangat Baik'),
(5, 1, 2, 'B', 'Baik'),
(6, 1, 3, 'B', 'Baik');

-- --------------------------------------------------------

--
-- Struktur dari tabel `rating_final`
--

CREATE TABLE `rating_final` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `student_id` int(10) UNSIGNED NOT NULL,
  `course_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `value` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `rating_final`
--

INSERT INTO `rating_final` (`id`, `student_id`, `course_id`, `user_id`, `name`, `value`) VALUES
(1, 1, 1, 20, 'UAS', 80),
(2, 1, 2, 22, 'UAS', 88),
(3, 1, 1, 20, 'Remedial Final', 75);

-- --------------------------------------------------------

--
-- Struktur dari tabel `rating_formula`
--

CREATE TABLE `rating_formula` (
  `id` int(10) UNSIGNED NOT NULL,
  `school_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `value` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `rating_formula`
--

INSERT INTO `rating_formula` (`id`, `school_id`, `name`, `value`) VALUES
(2, 1, 'assignment', 2),
(3, 1, 'test', 1),
(4, 1, 'mid', 1),
(5, 1, 'final', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `rating_mid`
--

CREATE TABLE `rating_mid` (
  `id` int(10) UNSIGNED NOT NULL,
  `student_id` int(10) UNSIGNED NOT NULL,
  `course_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `value` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `rating_mid`
--

INSERT INTO `rating_mid` (`id`, `student_id`, `course_id`, `user_id`, `name`, `value`) VALUES
(1, 1, 1, 20, 'UTS', 78),
(2, 1, 2, 22, 'UTS', 88);

-- --------------------------------------------------------

--
-- Struktur dari tabel `rating_portfolio`
--

CREATE TABLE `rating_portfolio` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `student_id` int(10) UNSIGNED NOT NULL,
  `course_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `value` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `rating_practice`
--

CREATE TABLE `rating_practice` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `student_id` int(10) UNSIGNED NOT NULL,
  `course_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `value` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `rating_project`
--

CREATE TABLE `rating_project` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `student_id` int(10) UNSIGNED NOT NULL,
  `course_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `value` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `rating_skill`
--

CREATE TABLE `rating_skill` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `student_id` int(10) UNSIGNED NOT NULL,
  `course_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `value` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `rating_skill`
--

INSERT INTO `rating_skill` (`id`, `student_id`, `course_id`, `user_id`, `name`, `value`) VALUES
(1, 1, 1, 20, 'Keterampilan', 81);

-- --------------------------------------------------------

--
-- Struktur dari tabel `rating_test`
--

CREATE TABLE `rating_test` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `student_id` int(10) UNSIGNED NOT NULL,
  `course_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `value` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `rating_test`
--

INSERT INTO `rating_test` (`id`, `student_id`, `course_id`, `user_id`, `name`, `value`) VALUES
(1, 1, 1, 20, 'Ulangan Harian 1', 80),
(2, 1, 2, 22, 'Ulangan Harian 1', 95);

-- --------------------------------------------------------

--
-- Struktur dari tabel `schools`
--

CREATE TABLE `schools` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `school_head_id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `schools`
--

INSERT INTO `schools` (`id`, `user_id`, `school_head_id`, `name`, `address`) VALUES
(1, 19, 18, 'SMAN 1 MOROSI', 'MOROSI');

-- --------------------------------------------------------

--
-- Struktur dari tabel `school_head_profile`
--

CREATE TABLE `school_head_profile` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `nip` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `school_head_profile`
--

INSERT INTO `school_head_profile` (`id`, `user_id`, `nip`) VALUES
(2, 18, '192 168 1 1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `students`
--

CREATE TABLE `students` (
  `id` int(10) UNSIGNED NOT NULL,
  `school_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `nis` varchar(8) NOT NULL,
  `nisn` varchar(15) NOT NULL,
  `classroom_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `students`
--

INSERT INTO `students` (`id`, `school_id`, `name`, `nis`, `nisn`, `classroom_id`) VALUES
(1, 1, 'Al Zidni', '12345', '00019191', 1),
(2, 1, 'Kharisma Yunitra', '1212', '00019192', 1),
(3, 1, 'Zidni', '1283', '00019198', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `student_attitude`
--

CREATE TABLE `student_attitude` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `attitude_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `student_id` int(10) UNSIGNED NOT NULL,
  `predicate_id` int(10) UNSIGNED NOT NULL,
  `course_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `student_attitude`
--

INSERT INTO `student_attitude` (`id`, `attitude_id`, `user_id`, `student_id`, `predicate_id`, `course_id`) VALUES
(2, 3, 20, 1, 2, 1),
(3, 2, 22, 1, 2, 2),
(4, 3, 22, 1, 3, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `student_profile`
--

CREATE TABLE `student_profile` (
  `id` int(10) UNSIGNED NOT NULL,
  `school_id` int(10) UNSIGNED NOT NULL,
  `classroom_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `nis` varchar(8) NOT NULL,
  `nisn` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `teacher_profile`
--

CREATE TABLE `teacher_profile` (
  `id` int(10) UNSIGNED NOT NULL,
  `school_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `nip` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `teacher_profile`
--

INSERT INTO `teacher_profile` (`id`, `school_id`, `user_id`, `nip`) VALUES
(2, 1, 22, '192 168 1 1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(254) NOT NULL,
  `activation_selector` varchar(255) DEFAULT NULL,
  `activation_code` varchar(255) DEFAULT NULL,
  `forgotten_password_selector` varchar(255) DEFAULT NULL,
  `forgotten_password_code` varchar(255) DEFAULT NULL,
  `forgotten_password_time` int(11) UNSIGNED DEFAULT NULL,
  `remember_selector` varchar(255) DEFAULT NULL,
  `remember_code` varchar(255) DEFAULT NULL,
  `created_on` int(11) UNSIGNED NOT NULL,
  `last_login` int(11) UNSIGNED DEFAULT NULL,
  `active` tinyint(1) UNSIGNED DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `image` text NOT NULL,
  `address` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `email`, `activation_selector`, `activation_code`, `forgotten_password_selector`, `forgotten_password_code`, `forgotten_password_time`, `remember_selector`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `phone`, `image`, `address`) VALUES
(1, '127.0.0.1', 'admin@fixl.com', '$2y$12$XpBgMvQ5JzfvN3PTgf/tA.XwxbCOs3mO0a10oP9/11qi1NUpv46.u', 'admin@fixl.com', NULL, '', NULL, NULL, NULL, NULL, NULL, 1268889823, 1576342019, 1, 'Admin', 'istrator', '081342989185', 'USER_1_1571554027.jpeg', 'admin'),
(13, '::1', 'uadmin@gmail.com', '$2y$10$78SZyvKRKMU7nPCew9w4nOpEUmJ1SeTV4L4ZG2NXXSfbEaswqoepq', 'uadmin@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1568678256, 1576342172, 1, 'admin', 'Dinas', '00', 'USER_13_1568678463.jpg', 'jln mutiara no 8'),
(18, '::1', 'subur@gmail.com', '$2y$10$mfqzS5OmKEzpKeda8JxBce/Tli8Xkxe0kQ5N.l1lJWOGTlvHtDkbW', 'subur@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1576244780, NULL, 1, 'Haji', 'Subur', '081232578168', 'default.jpg', 'Morosi'),
(19, '::1', 'smansa_morosi@gmail.com', '$2y$10$7/nMU75i/IXjC2lrox.kqOqNsSLdLMZnEK6XyJNrzSkr18F8WSIMi', 'smansa_morosi@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1576244780, 1576396800, 1, 'Admin ', 'SMAN 1 MOROSI', '081232578168', 'default.jpg', 'MOROSI'),
(20, '::1', 'zidni@gmail.com', '$2y$10$0KyjH0yaWbjPJI/AWEufC.dnWvYdliLe2NOzhLpLiMyIn/U/7w9tq', 'zidni@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1576246240, 1576589452, 1, 'Al Zidni', 'Kasim', '081232578168', 'default.jpg', 'BTN Graha Mandiri Permai Blok K/07'),
(22, '::1', 'guru@gmail.com', '$2y$10$6J7.MvMNs39dLQe8HM1Mn.ashaGhvb4UFRVK9CXZnEFfs4vCqUJV.', 'guru@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1576396791, 1576426418, 1, 'Guru', 'Ku', '081232578169', 'default.jpg', 'Jalan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users_groups`
--

CREATE TABLE `users_groups` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `group_id` mediumint(8) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `users_groups`
--

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
(1, 1, 1),
(29, 13, 2),
(34, 18, 4),
(35, 19, 3),
(36, 20, 5),
(38, 22, 5);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `absence`
--
ALTER TABLE `absence`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `achievement`
--
ALTER TABLE `achievement`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `assignment`
--
ALTER TABLE `assignment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `course_id` (`course_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `attitude`
--
ALTER TABLE `attitude`
  ADD PRIMARY KEY (`id`),
  ADD KEY `school_id` (`school_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`),
  ADD KEY `school_id` (`school_id`);

--
-- Indexes for table `classroom`
--
ALTER TABLE `classroom`
  ADD PRIMARY KEY (`id`),
  ADD KEY `school_id` (`school_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `school_id` (`school_id`);

--
-- Indexes for table `extracurricular`
--
ALTER TABLE `extracurricular`
  ADD PRIMARY KEY (`id`),
  ADD KEY `school_id` (`school_id`),
  ADD KEY `group_id` (`group_id`);

--
-- Indexes for table `extracurricular_group`
--
ALTER TABLE `extracurricular_group`
  ADD PRIMARY KEY (`id`),
  ADD KEY `school_id` (`school_id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login_attempts`
--
ALTER TABLE `login_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `predicate_attitude`
--
ALTER TABLE `predicate_attitude`
  ADD PRIMARY KEY (`id`),
  ADD KEY `school_id` (`school_id`);

--
-- Indexes for table `predicate_rating`
--
ALTER TABLE `predicate_rating`
  ADD PRIMARY KEY (`id`),
  ADD KEY `school_id` (`school_id`);

--
-- Indexes for table `rating_extracurricular`
--
ALTER TABLE `rating_extracurricular`
  ADD PRIMARY KEY (`id`),
  ADD KEY `extracurricular_id` (`extracurricular_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `rating_final`
--
ALTER TABLE `rating_final`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course_id` (`course_id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `rating_formula`
--
ALTER TABLE `rating_formula`
  ADD PRIMARY KEY (`id`),
  ADD KEY `school_id` (`school_id`);

--
-- Indexes for table `rating_mid`
--
ALTER TABLE `rating_mid`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `course_id` (`course_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `rating_portfolio`
--
ALTER TABLE `rating_portfolio`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `course_id` (`course_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `rating_practice`
--
ALTER TABLE `rating_practice`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `course_id` (`course_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `rating_project`
--
ALTER TABLE `rating_project`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `course_id` (`course_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `rating_skill`
--
ALTER TABLE `rating_skill`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `course_id` (`course_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `rating_test`
--
ALTER TABLE `rating_test`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course_id` (`course_id`),
  ADD KEY `user_id_2` (`user_id`),
  ADD KEY `rating_test_ibfk_1` (`student_id`);

--
-- Indexes for table `schools`
--
ALTER TABLE `schools`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `school_head_id` (`school_head_id`);

--
-- Indexes for table `school_head_profile`
--
ALTER TABLE `school_head_profile`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD KEY `classroom_id` (`classroom_id`),
  ADD KEY `school_id` (`school_id`);

--
-- Indexes for table `student_attitude`
--
ALTER TABLE `student_attitude`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `attitude_id` (`attitude_id`),
  ADD KEY `predicate_id` (`predicate_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `course_id` (`course_id`);

--
-- Indexes for table `student_profile`
--
ALTER TABLE `student_profile`
  ADD PRIMARY KEY (`id`),
  ADD KEY `classroom_id` (`classroom_id`),
  ADD KEY `school_id` (`school_id`);

--
-- Indexes for table `teacher_profile`
--
ALTER TABLE `teacher_profile`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `school_id` (`school_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uc_email` (`email`),
  ADD UNIQUE KEY `uc_activation_selector` (`activation_selector`),
  ADD UNIQUE KEY `uc_forgotten_password_selector` (`forgotten_password_selector`),
  ADD UNIQUE KEY `uc_remember_selector` (`remember_selector`);

--
-- Indexes for table `users_groups`
--
ALTER TABLE `users_groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`),
  ADD KEY `fk_users_groups_users1_idx` (`user_id`),
  ADD KEY `fk_users_groups_groups1_idx` (`group_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `absence`
--
ALTER TABLE `absence`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `achievement`
--
ALTER TABLE `achievement`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `assignment`
--
ALTER TABLE `assignment`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `attitude`
--
ALTER TABLE `attitude`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `classroom`
--
ALTER TABLE `classroom`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `extracurricular`
--
ALTER TABLE `extracurricular`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `extracurricular_group`
--
ALTER TABLE `extracurricular_group`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `login_attempts`
--
ALTER TABLE `login_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124;
--
-- AUTO_INCREMENT for table `predicate_attitude`
--
ALTER TABLE `predicate_attitude`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `predicate_rating`
--
ALTER TABLE `predicate_rating`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `rating_extracurricular`
--
ALTER TABLE `rating_extracurricular`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `rating_final`
--
ALTER TABLE `rating_final`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `rating_formula`
--
ALTER TABLE `rating_formula`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `rating_mid`
--
ALTER TABLE `rating_mid`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `rating_portfolio`
--
ALTER TABLE `rating_portfolio`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `rating_practice`
--
ALTER TABLE `rating_practice`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `rating_project`
--
ALTER TABLE `rating_project`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `rating_skill`
--
ALTER TABLE `rating_skill`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `rating_test`
--
ALTER TABLE `rating_test`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `schools`
--
ALTER TABLE `schools`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `school_head_profile`
--
ALTER TABLE `school_head_profile`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `student_attitude`
--
ALTER TABLE `student_attitude`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `student_profile`
--
ALTER TABLE `student_profile`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `teacher_profile`
--
ALTER TABLE `teacher_profile`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `users_groups`
--
ALTER TABLE `users_groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `absence`
--
ALTER TABLE `absence`
  ADD CONSTRAINT `absence_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `absence_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`);

--
-- Ketidakleluasaan untuk tabel `achievement`
--
ALTER TABLE `achievement`
  ADD CONSTRAINT `achievement_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`);

--
-- Ketidakleluasaan untuk tabel `assignment`
--
ALTER TABLE `assignment`
  ADD CONSTRAINT `assignment_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`),
  ADD CONSTRAINT `assignment_ibfk_2` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`),
  ADD CONSTRAINT `assignment_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Ketidakleluasaan untuk tabel `attitude`
--
ALTER TABLE `attitude`
  ADD CONSTRAINT `attitude_ibfk_1` FOREIGN KEY (`school_id`) REFERENCES `schools` (`id`);

--
-- Ketidakleluasaan untuk tabel `category`
--
ALTER TABLE `category`
  ADD CONSTRAINT `category_ibfk_1` FOREIGN KEY (`school_id`) REFERENCES `schools` (`id`);

--
-- Ketidakleluasaan untuk tabel `classroom`
--
ALTER TABLE `classroom`
  ADD CONSTRAINT `classroom_ibfk_1` FOREIGN KEY (`school_id`) REFERENCES `schools` (`id`),
  ADD CONSTRAINT `classroom_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Ketidakleluasaan untuk tabel `courses`
--
ALTER TABLE `courses`
  ADD CONSTRAINT `courses_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`),
  ADD CONSTRAINT `courses_ibfk_2` FOREIGN KEY (`school_id`) REFERENCES `schools` (`id`);

--
-- Ketidakleluasaan untuk tabel `extracurricular`
--
ALTER TABLE `extracurricular`
  ADD CONSTRAINT `extracurricular_ibfk_1` FOREIGN KEY (`school_id`) REFERENCES `schools` (`id`),
  ADD CONSTRAINT `extracurricular_ibfk_2` FOREIGN KEY (`group_id`) REFERENCES `extracurricular_group` (`id`);

--
-- Ketidakleluasaan untuk tabel `extracurricular_group`
--
ALTER TABLE `extracurricular_group`
  ADD CONSTRAINT `extracurricular_group_ibfk_1` FOREIGN KEY (`school_id`) REFERENCES `schools` (`id`);

--
-- Ketidakleluasaan untuk tabel `predicate_attitude`
--
ALTER TABLE `predicate_attitude`
  ADD CONSTRAINT `predicate_attitude_ibfk_1` FOREIGN KEY (`school_id`) REFERENCES `schools` (`id`);

--
-- Ketidakleluasaan untuk tabel `rating_extracurricular`
--
ALTER TABLE `rating_extracurricular`
  ADD CONSTRAINT `rating_extracurricular_ibfk_1` FOREIGN KEY (`extracurricular_id`) REFERENCES `extracurricular` (`id`),
  ADD CONSTRAINT `rating_extracurricular_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`);

--
-- Ketidakleluasaan untuk tabel `rating_final`
--
ALTER TABLE `rating_final`
  ADD CONSTRAINT `rating_final_ibfk_2` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`),
  ADD CONSTRAINT `rating_final_ibfk_3` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`),
  ADD CONSTRAINT `rating_final_ibfk_4` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Ketidakleluasaan untuk tabel `rating_formula`
--
ALTER TABLE `rating_formula`
  ADD CONSTRAINT `rating_formula_ibfk_1` FOREIGN KEY (`school_id`) REFERENCES `schools` (`id`);

--
-- Ketidakleluasaan untuk tabel `rating_mid`
--
ALTER TABLE `rating_mid`
  ADD CONSTRAINT `rating_mid_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`),
  ADD CONSTRAINT `rating_mid_ibfk_2` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`),
  ADD CONSTRAINT `rating_mid_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Ketidakleluasaan untuk tabel `rating_portfolio`
--
ALTER TABLE `rating_portfolio`
  ADD CONSTRAINT `rating_portfolio_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`),
  ADD CONSTRAINT `rating_portfolio_ibfk_2` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`),
  ADD CONSTRAINT `rating_portfolio_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Ketidakleluasaan untuk tabel `rating_practice`
--
ALTER TABLE `rating_practice`
  ADD CONSTRAINT `rating_practice_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`),
  ADD CONSTRAINT `rating_practice_ibfk_2` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`),
  ADD CONSTRAINT `rating_practice_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Ketidakleluasaan untuk tabel `rating_project`
--
ALTER TABLE `rating_project`
  ADD CONSTRAINT `rating_project_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`),
  ADD CONSTRAINT `rating_project_ibfk_2` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`),
  ADD CONSTRAINT `rating_project_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Ketidakleluasaan untuk tabel `rating_skill`
--
ALTER TABLE `rating_skill`
  ADD CONSTRAINT `rating_skill_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`),
  ADD CONSTRAINT `rating_skill_ibfk_2` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`),
  ADD CONSTRAINT `rating_skill_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Ketidakleluasaan untuk tabel `rating_test`
--
ALTER TABLE `rating_test`
  ADD CONSTRAINT `rating_test_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`),
  ADD CONSTRAINT `rating_test_ibfk_2` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`),
  ADD CONSTRAINT `rating_test_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Ketidakleluasaan untuk tabel `schools`
--
ALTER TABLE `schools`
  ADD CONSTRAINT `schools_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `schools_ibfk_2` FOREIGN KEY (`school_head_id`) REFERENCES `users` (`id`);

--
-- Ketidakleluasaan untuk tabel `school_head_profile`
--
ALTER TABLE `school_head_profile`
  ADD CONSTRAINT `school_head_profile_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Ketidakleluasaan untuk tabel `student_attitude`
--
ALTER TABLE `student_attitude`
  ADD CONSTRAINT `student_attitude_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`),
  ADD CONSTRAINT `student_attitude_ibfk_2` FOREIGN KEY (`attitude_id`) REFERENCES `attitude` (`id`),
  ADD CONSTRAINT `student_attitude_ibfk_3` FOREIGN KEY (`predicate_id`) REFERENCES `predicate_attitude` (`id`),
  ADD CONSTRAINT `student_attitude_ibfk_4` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `student_attitude_ibfk_5` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`);

--
-- Ketidakleluasaan untuk tabel `student_profile`
--
ALTER TABLE `student_profile`
  ADD CONSTRAINT `student_profile_ibfk_1` FOREIGN KEY (`classroom_id`) REFERENCES `classroom` (`id`),
  ADD CONSTRAINT `student_profile_ibfk_2` FOREIGN KEY (`school_id`) REFERENCES `schools` (`id`);

--
-- Ketidakleluasaan untuk tabel `teacher_profile`
--
ALTER TABLE `teacher_profile`
  ADD CONSTRAINT `teacher_profile_ibfk_1` FOREIGN KEY (`school_id`) REFERENCES `schools` (`id`);

--
-- Ketidakleluasaan untuk tabel `users_groups`
--
ALTER TABLE `users_groups`
  ADD CONSTRAINT `fk_users_groups_groups1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_groups_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
