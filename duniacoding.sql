-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 26 Mar 2023 pada 18.14
-- Versi server: 10.4.24-MariaDB
-- Versi PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `duniacoding`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `administrator`
--

CREATE TABLE `administrator` (
  `administrator_id` int(11) NOT NULL,
  `administrator_name` varchar(50) NOT NULL,
  `administrator_email` varchar(50) NOT NULL,
  `administrator_password` varchar(100) NOT NULL,
  `administrator_avatar` varchar(100) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `event`
--

CREATE TABLE `event` (
  `event_id` int(11) NOT NULL,
  `mentor_id` int(11) NOT NULL,
  `event_label` varchar(50) NOT NULL,
  `event_name` varchar(100) NOT NULL,
  `event_room` varchar(100) NOT NULL,
  `event_documentation` varchar(100) NOT NULL,
  `event_date` date NOT NULL,
  `event_time` time NOT NULL,
  `event_about` text NOT NULL,
  `event_desc` text NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `event`
--

INSERT INTO `event` (`event_id`, `mentor_id`, `event_label`, `event_name`, `event_room`, `event_documentation`, `event_date`, `event_time`, `event_about`, `event_desc`, `created_at`, `updated_at`) VALUES
(1, 1, 'Webinar Series #44', 'Slicing UI Design with Flutter', 'https://meet.google.com/', 'https://www.youtube.com/', '2023-02-19', '19:00:00', 'About', 'Description', '2023-02-25 01:22:22', '2023-02-25 01:22:22'),
(2, 1, 'Webinar Series #44', 'Slicing UI Design with Flutter', 'https://meet.google.com/', 'https://www.youtube.com/', '2023-02-20', '19:00:00', 'About', 'Description', '2023-02-25 01:22:22', '2023-02-25 01:22:22'),
(3, 1, 'Webinar Series #44', 'Slicing UI Design with Flutter', 'https://meet.google.com/', 'https://www.youtube.com/', '2023-02-21', '19:00:00', 'About', 'Description', '2023-02-25 01:22:22', '2023-02-25 01:22:22'),
(4, 1, 'Webinar Series #44', 'Slicing UI Design with Flutter', 'https://meet.google.com/', 'https://www.youtube.com/', '2023-02-21', '19:00:00', 'About', 'Description', '2023-02-25 01:22:22', '2023-02-25 01:22:22'),
(5, 1, 'Webinar Series #44', 'Slicing UI Design with Flutter', 'https://meet.google.com/', 'https://www.youtube.com/', '2023-02-24', '19:00:00', 'About', 'Description', '2023-02-25 01:22:22', '2023-02-25 01:22:22'),
(6, 1, 'Webinar Series #44', 'Slicing UI Design with Flutter', 'https://meet.google.com/', 'https://www.youtube.com/', '2023-03-25', '19:00:00', 'About', 'Description', '2023-02-25 01:22:22', '2023-02-25 01:22:22'),
(7, 1, 'Webinar Series #44', 'Slicing UI Design with Flutter', 'https://meet.google.com/', 'https://www.youtube.com/', '2023-03-26', '19:00:00', 'About', 'Description', '2023-02-25 01:22:22', '2023-02-25 01:22:22');

-- --------------------------------------------------------

--
-- Struktur dari tabel `event_member`
--

CREATE TABLE `event_member` (
  `event_member_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `member_event_date` datetime NOT NULL,
  `member_event_attendance` enum('','present','absent') NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `member`
--

CREATE TABLE `member` (
  `member_id` int(11) NOT NULL,
  `member_name` varchar(50) NOT NULL,
  `member_job` varchar(50) NOT NULL,
  `member_company` varchar(50) NOT NULL,
  `member_email` varchar(50) NOT NULL,
  `member_password` varchar(100) NOT NULL,
  `member_instagram` varchar(50) NOT NULL,
  `member_linkedin` varchar(50) NOT NULL,
  `member_avatar` varchar(100) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `member`
--

INSERT INTO `member` (`member_id`, `member_name`, `member_job`, `member_company`, `member_email`, `member_password`, `member_instagram`, `member_linkedin`, `member_avatar`, `created_at`, `updated_at`) VALUES
(1, 'Member Dunia Coding', 'Front-end Mobile Developer', 'Dunia Coding', 'member-dc@email.com', '55e331bbddc65deee1ee9f4ca705a5b39a60cb70', 'https://www.instagram.com/duniacoding/', 'https://www.linkedin.com/company/duniacoding/', '', '2023-02-22 02:05:37', '2023-02-24 22:50:31'),
(2, 'Test Name', 'Test Job', 'Tes Company', 'testemail@email.com', '461d756810aacff1457fa75c83159e677cb08d73', 'https://www.instagram.com/test/', 'https://www.linkedin.com/in/test/', '', '2023-02-22 19:41:18', '2023-02-24 23:17:19');

-- --------------------------------------------------------

--
-- Struktur dari tabel `mentor`
--

CREATE TABLE `mentor` (
  `mentor_id` int(11) NOT NULL,
  `mentor_name` varchar(50) NOT NULL,
  `mentor_job` varchar(50) NOT NULL,
  `mentor_company` varchar(50) NOT NULL,
  `mentor_email` varchar(50) NOT NULL,
  `mentor_password` varchar(100) NOT NULL,
  `mentor_instagram` varchar(50) NOT NULL,
  `mentor_linkedin` varchar(50) NOT NULL,
  `mentor_avatar` varchar(100) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `mentor`
--

INSERT INTO `mentor` (`mentor_id`, `mentor_name`, `mentor_job`, `mentor_company`, `mentor_email`, `mentor_password`, `mentor_instagram`, `mentor_linkedin`, `mentor_avatar`, `created_at`, `updated_at`) VALUES
(1, 'Name', 'Mentor', 'DC', 'mentor@email.com', 'a6bff811c0044581bee6743c962aee3347bd4108', 'https://www.instagram.com/mentor/', 'https://www.linkedin.com/company/mentor/', '', '2023-02-25 01:20:08', '2023-02-25 01:20:08');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `administrator`
--
ALTER TABLE `administrator`
  ADD PRIMARY KEY (`administrator_id`);

--
-- Indeks untuk tabel `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`event_id`),
  ADD KEY `mentor_id` (`mentor_id`);

--
-- Indeks untuk tabel `event_member`
--
ALTER TABLE `event_member`
  ADD PRIMARY KEY (`event_member_id`),
  ADD KEY `event_id` (`event_id`),
  ADD KEY `member_id` (`member_id`);

--
-- Indeks untuk tabel `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`member_id`);

--
-- Indeks untuk tabel `mentor`
--
ALTER TABLE `mentor`
  ADD PRIMARY KEY (`mentor_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `administrator`
--
ALTER TABLE `administrator`
  MODIFY `administrator_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `event`
--
ALTER TABLE `event`
  MODIFY `event_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `event_member`
--
ALTER TABLE `event_member`
  MODIFY `event_member_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `member`
--
ALTER TABLE `member`
  MODIFY `member_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `mentor`
--
ALTER TABLE `mentor`
  MODIFY `mentor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `event`
--
ALTER TABLE `event`
  ADD CONSTRAINT `event_ibfk_1` FOREIGN KEY (`mentor_id`) REFERENCES `mentor` (`mentor_id`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `event_member`
--
ALTER TABLE `event_member`
  ADD CONSTRAINT `event_member_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `event` (`event_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `event_member_ibfk_2` FOREIGN KEY (`member_id`) REFERENCES `member` (`member_id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
