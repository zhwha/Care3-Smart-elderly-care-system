-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Hôte : sql104.infinityfree.com
-- Généré le :  sam. 20 juin 2026 à 11:05
-- Version du serveur :  11.4.12-MariaDB
-- Version de PHP :  7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `if0_42080828_elderly_care_system`
--

-- --------------------------------------------------------

--
-- Structure de la table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `password`, `created_at`) VALUES
(1, 'Main Admin', 'admin@care.com', '123456', '2026-05-19 12:48:44');

-- --------------------------------------------------------

--
-- Structure de la table `doctor_appointments`
--

CREATE TABLE `doctor_appointments` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `doctor_name` varchar(100) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `time` varchar(50) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `doctor_appointments`
--

INSERT INTO `doctor_appointments` (`id`, `user_id`, `doctor_name`, `date`, `time`, `notes`, `created_at`) VALUES
(11, 30, 'Omar', '2026-06-07', '10:30', 'physical therapy session for knee rehabilitation', '2026-06-06 14:38:18'),
(12, 30, 'salim', '2026-06-11', '11:00 ', '', '2026-06-09 09:05:40');

-- --------------------------------------------------------

--
-- Structure de la table `elderly_profiles`
--

CREATE TABLE `elderly_profiles` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `medical_notes` text DEFAULT NULL,
  `emergency_contact` varchar(20) DEFAULT NULL,
  `lat` varchar(50) DEFAULT NULL,
  `lng` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `elderly_profiles`
--

INSERT INTO `elderly_profiles` (`id`, `user_id`, `age`, `medical_notes`, `emergency_contact`, `lat`, `lng`) VALUES
(6, 14, 25, 'hh', '11221', NULL, NULL),
(13, 29, 62, 'Diabetes', 'Ali 95563421', NULL, NULL),
(14, 41, 63, '', 'Walid97780164', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `emergency_alerts`
--

CREATE TABLE `emergency_alerts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `message` varchar(255) DEFAULT 'Emergency Alert!',
  `location` varchar(255) DEFAULT NULL,
  `status` varchar(50) DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `latitude` varchar(100) DEFAULT NULL,
  `longitude` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `emergency_alerts`
--

INSERT INTO `emergency_alerts` (`id`, `user_id`, `message`, `location`, `status`, `created_at`, `latitude`, `longitude`) VALUES
(37, 29, 'ðŸš¨ Emergency triggered', NULL, 'active', '2026-06-06 15:07:31', '23.684204', '58.11853'),
(38, 29, 'ðŸš¨ Emergency triggered', NULL, 'active', '2026-06-09 09:01:00', '23.568019512790624', '58.16676149184844'),
(39, 29, 'ðŸš¨ Emergency triggered', NULL, 'active', '2026-06-15 09:53:17', '23.603593', '58.159878000000006'),
(40, 29, 'ðŸš¨ Emergency triggered', NULL, 'active', '2026-06-18 16:06:15', '23.684204', '58.11853');

-- --------------------------------------------------------

--
-- Structure de la table `family_links`
--

CREATE TABLE `family_links` (
  `id` int(11) NOT NULL,
  `elderly_id` int(11) DEFAULT NULL,
  `family_id` int(11) DEFAULT NULL,
  `relation` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `family_links`
--

INSERT INTO `family_links` (`id`, `elderly_id`, `family_id`, `relation`, `created_at`) VALUES
(5, 29, 30, 'Son', '2026-06-06 14:30:55');

-- --------------------------------------------------------

--
-- Structure de la table `medications`
--

CREATE TABLE `medications` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `dosage` varchar(100) DEFAULT NULL,
  `time` varchar(50) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `medications`
--

INSERT INTO `medications` (`id`, `user_id`, `name`, `dosage`, `time`, `notes`, `created_at`) VALUES
(10, 30, 'Lisinopril', '10 mg', '08:00 AM', 'Take with food to a  void stomach upset', '2026-06-06 14:33:49');

-- --------------------------------------------------------

--
-- Structure de la table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `message` varchar(255) DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  `is_read` tinyint(4) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `notifications`
--

INSERT INTO `notifications` (`id`, `user_id`, `message`, `type`, `is_read`, `created_at`) VALUES
(23, 30, 'ðŸ“… New Doctor Appointment Added', 'appointment', 0, '2026-06-06 14:38:18'),
(24, 30, ' Nurse Request Sent', 'nurse', 0, '2026-06-06 14:41:54'),
(25, 30, ' Nurse Request Sent', 'nurse', 0, '2026-06-09 09:01:48'),
(26, 30, 'ðŸ“… New Doctor Appointment Added', 'appointment', 0, '2026-06-09 09:05:40'),
(27, 30, ' Nurse Request Sent', 'nurse', 0, '2026-06-09 09:06:43');

-- --------------------------------------------------------

--
-- Structure de la table `nurse_requests`
--

CREATE TABLE `nurse_requests` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `time` varchar(50) DEFAULT NULL,
  `duration` varchar(50) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `status` varchar(50) DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `nurse_requests`
--

INSERT INTO `nurse_requests` (`id`, `user_id`, `date`, `time`, `duration`, `notes`, `status`, `created_at`) VALUES
(15, 30, '2026-06-07', '08:00 AM', '1 hours', '', 'rejected', '2026-06-06 14:41:54'),
(16, 30, '2026-06-09', '10:30', '1 hours', '', 'accepted', '2026-06-09 09:01:48'),
(17, 30, '2026-06-07', '10:30', '1 hours', '', 'accepted', '2026-06-09 09:06:43');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `role` enum('elderly','family','nurse','admin') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `last_login` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `phone`, `role`, `created_at`, `last_login`) VALUES
(14, 'aicha', 'aichaayad7@gmail.com', '$2y$10$rTP/XmfZRUhlqVxMGDIFX.47hnlhHc3J1i5imqPvuRaysEHy.iFry', '07919062', 'elderly', '2026-06-03 00:00:22', NULL),
(29, 'farah', 'farah345@gmail.com', '$2y$10$oNpkeuoqAowQ3V6uPmxqjej3TrAvcySQU1N9vixkTQJEOCXjm1zYu', '95774144', 'elderly', '2026-06-06 14:28:17', '2026-06-18 23:47:39'),
(30, 'Ali ', 'Ali9090@gmail.com', '$2y$10$sPePZS5NBFyTWFpDyAwrGu23NB9sB.7HyZsPT1SSHj/1gxyjmTAyi', '36249292', 'family', '2026-06-06 14:30:55', '2026-06-18 23:48:48'),
(31, 'malak', 'malak234@gmail.com', '$2y$10$6I857bjttpnQIPPpz1QDheBPMGrWS7fE.QLKgNm0FVuixBsVlzD9y', '43659438', 'nurse', '2026-06-06 14:40:16', '2026-06-18 23:47:21'),
(41, 'Salim', 'salim123@gmail.com', '$2y$10$GKxZ1DgruFWBmUGTs/vgfuLi0sEHQgqJsmiwO1Z1ZWKUynN3RNEw.', '56543323', 'elderly', '2026-06-15 14:49:27', NULL),
(42, 'leo albalushi', 'ju89@gmail.com', '$2y$10$nKqfntDQ4Ddk.Ey.rffwBOFZEpoCGwwNjaeUvtOA9355LSvvsj7ue', '9495187', 'nurse', '2026-06-18 19:47:37', NULL);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Index pour la table `doctor_appointments`
--
ALTER TABLE `doctor_appointments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Index pour la table `elderly_profiles`
--
ALTER TABLE `elderly_profiles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Index pour la table `emergency_alerts`
--
ALTER TABLE `emergency_alerts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Index pour la table `family_links`
--
ALTER TABLE `family_links`
  ADD PRIMARY KEY (`id`),
  ADD KEY `elderly_id` (`elderly_id`),
  ADD KEY `family_id` (`family_id`);

--
-- Index pour la table `medications`
--
ALTER TABLE `medications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Index pour la table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Index pour la table `nurse_requests`
--
ALTER TABLE `nurse_requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `doctor_appointments`
--
ALTER TABLE `doctor_appointments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `elderly_profiles`
--
ALTER TABLE `elderly_profiles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT pour la table `emergency_alerts`
--
ALTER TABLE `emergency_alerts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT pour la table `family_links`
--
ALTER TABLE `family_links`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `medications`
--
ALTER TABLE `medications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT pour la table `nurse_requests`
--
ALTER TABLE `nurse_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `doctor_appointments`
--
ALTER TABLE `doctor_appointments`
  ADD CONSTRAINT `doctor_appointments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `elderly_profiles`
--
ALTER TABLE `elderly_profiles`
  ADD CONSTRAINT `elderly_profiles_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `emergency_alerts`
--
ALTER TABLE `emergency_alerts`
  ADD CONSTRAINT `emergency_alerts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `family_links`
--
ALTER TABLE `family_links`
  ADD CONSTRAINT `family_links_ibfk_1` FOREIGN KEY (`elderly_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `family_links_ibfk_2` FOREIGN KEY (`family_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `medications`
--
ALTER TABLE `medications`
  ADD CONSTRAINT `medications_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `nurse_requests`
--
ALTER TABLE `nurse_requests`
  ADD CONSTRAINT `nurse_requests_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
