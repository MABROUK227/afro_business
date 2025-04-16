-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le : mer. 16 avr. 2025 à 12:47
-- Version du serveur : 8.0.40
-- Version de PHP : 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `afrobiz`
--

-- --------------------------------------------------------

--
-- Structure de la table `avis`
--

CREATE TABLE `avis` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `entreprise_id` bigint UNSIGNED NOT NULL,
  `note` int NOT NULL,
  `commentaire` text COLLATE utf8mb4_unicode_ci,
  `date_experience` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `avis`
--

INSERT INTO `avis` (`id`, `user_id`, `entreprise_id`, `note`, `commentaire`, `date_experience`, `created_at`, `updated_at`) VALUES
(3, 2, 4, 5, 'kjhghjklmù', '2025-04-09', '2025-04-14 13:36:05', '2025-04-14 13:36:05');

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
  `id` bigint UNSIGNED NOT NULL,
  `libelle` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id`, `libelle`, `created_at`, `updated_at`) VALUES
(1, 'Artisanat', '2025-03-05 08:19:32', '2025-03-05 08:19:32'),
(2, 'Commerce', '2025-03-05 08:19:32', '2025-03-05 08:19:32'),
(3, 'Culture et loisirs', '2025-03-05 08:19:32', '2025-03-05 08:19:32'),
(4, 'Déplacements', '2025-03-05 08:19:32', '2025-03-05 08:19:32'),
(5, 'Éducation', '2025-03-05 08:19:32', '2025-03-05 08:19:32'),
(6, 'Finance', '2025-03-05 08:19:32', '2025-03-05 08:19:32'),
(7, 'Juridiques', '2025-03-05 08:19:32', '2025-03-05 08:19:32'),
(8, 'L’administratif', '2025-03-05 08:19:32', '2025-03-05 08:19:32'),
(9, 'Les associations', '2025-03-05 08:19:32', '2025-03-05 08:19:32'),
(10, 'Logement', '2025-03-05 08:19:32', '2025-03-05 08:19:32'),
(11, 'Restaurant', '2025-03-05 08:19:32', '2025-03-05 08:19:32'),
(12, 'Santé', '2025-03-05 08:19:32', '2025-03-05 08:19:32'),
(13, 'Services ménagers', '2025-03-05 08:19:32', '2025-03-05 08:19:32'),
(14, 'Technologie', '2025-03-05 08:19:32', '2025-03-05 08:19:32'),
(15, 'Voyages', '2025-03-05 08:19:32', '2025-03-05 08:19:32');

-- --------------------------------------------------------

--
-- Structure de la table `entreprises`
--

CREATE TABLE `entreprises` (
  `id` bigint UNSIGNED NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `adresse` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telephone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `site_web` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reseaux_sociaux` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `presentation` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `services` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_categorie` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `entreprises`
--

INSERT INTO `entreprises` (`id`, `nom`, `description`, `adresse`, `telephone`, `email`, `site_web`, `reseaux_sociaux`, `photo`, `presentation`, `services`, `id_categorie`, `created_at`, `updated_at`, `user_id`) VALUES
(3, 'mabrouk', 'fyuioiuytg!uçgyui', 'mabrouk@gmail.com', '+330623025212', 'root@gmail.com', 'https://laravel.com/docs/10.x/vite#running-vite', '{\"facebook\":\"jiui\",\"linkedin\":null,\"twitter\":null}', '{\"photo1\":null,\"photo2\":null,\"photo3\":null}', 'je prefere cette entreprise', 'nos servces', 3, '2025-04-14 13:31:21', '2025-04-14 13:31:21', 2),
(4, 'mabrouk', 'ueheçueàeàee))e', '3 rue messonier pere et fils', '+33062304212', 'mabrouk@gmail.com', 'https://laravel.com', '{\"facebook\":\"jiui\",\"linkedin\":\"j\",\"twitter\":\"eee\"}', '{\"photo1\":null,\"photo2\":\"photos\\/dTc450oStGKvM9zEOQj38KNLWmOx8SqxfS3auehv.jpg\",\"photo3\":\"photos\\/3KwIJcQ7RQ3dvMkdjjcGE5pBlQZdQ7QDCi1JlWcq.jpg\"}', '\"ueuiei', 'ffifororpr', 5, '2025-04-14 13:34:02', '2025-04-14 13:34:02', 2),
(5, 'mabrouk', 'j\' enregistre la base de données', 'mabrouk@gmail.com', '+33062025212', 'mabrou@gmail.com', 'https://laravel.com', '{\"facebook\":\"d\",\"linkedin\":\"d\",\"twitter\":\"d\"}', '{\"photo1\":null,\"photo2\":null,\"photo3\":null}', 'ff', 'nos servces', 6, '2025-04-15 05:56:06', '2025-04-15 05:56:06', 3);

-- --------------------------------------------------------

--
-- Structure de la table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `horaires`
--

CREATE TABLE `horaires` (
  `id` bigint UNSIGNED NOT NULL,
  `id_entreprise` bigint UNSIGNED NOT NULL,
  `jour` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ouverture` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fermeture` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `horaires`
--

INSERT INTO `horaires` (`id`, `id_entreprise`, `jour`, `ouverture`, `fermeture`, `created_at`, `updated_at`) VALUES
(15, 3, 'Lundi', '00:00', '00:00', '2025-04-14 13:31:21', '2025-04-14 13:31:21'),
(16, 3, 'Mardi', '00:00', '00:00', '2025-04-14 13:31:21', '2025-04-14 13:31:21'),
(17, 3, 'Mercredi', '00:00', '00:00', '2025-04-14 13:31:21', '2025-04-14 13:31:21'),
(18, 3, 'Jeudi', '00:00', '00:03', '2025-04-14 13:31:21', '2025-04-14 13:31:21'),
(19, 3, 'Vendredi', '00:00', '00:00', '2025-04-14 13:31:21', '2025-04-14 13:31:21'),
(20, 3, 'Samedi', '04:00', '05:00', '2025-04-14 13:31:21', '2025-04-14 13:31:21'),
(21, 3, 'Dimanche', '03:04', '05:04', '2025-04-14 13:31:21', '2025-04-14 13:31:21'),
(22, 4, 'Lundi', '00:00', '00:00', '2025-04-14 13:34:02', '2025-04-14 13:34:02'),
(23, 4, 'Mardi', '07:00', '00:00', '2025-04-14 13:34:02', '2025-04-14 13:34:02'),
(24, 4, 'Mercredi', '04:00', '05:00', '2025-04-14 13:34:02', '2025-04-14 13:34:02'),
(25, 4, 'Jeudi', '23:00', '23:00', '2025-04-14 13:34:02', '2025-04-14 13:34:02'),
(26, 4, 'Vendredi', '05:00', '09:00', '2025-04-14 13:34:02', '2025-04-14 13:34:02'),
(27, 4, 'Samedi', '23:00', '23:00', '2025-04-14 13:34:02', '2025-04-14 13:34:02'),
(28, 4, 'Dimanche', '03:00', '23:00', '2025-04-14 13:34:02', '2025-04-14 13:34:02'),
(29, 5, 'Lundi', '09:04', '05:06', '2025-04-15 05:56:06', '2025-04-15 05:56:06'),
(30, 5, 'Mardi', '06:30', '00:34', '2025-04-15 05:56:06', '2025-04-15 05:56:06'),
(31, 5, 'Mercredi', '03:04', '05:00', '2025-04-15 05:56:06', '2025-04-15 05:56:06'),
(32, 5, 'Jeudi', '06:39', '07:23', '2025-04-15 05:56:06', '2025-04-15 05:56:06'),
(33, 5, 'Vendredi', '06:30', '06:30', '2025-04-15 05:56:06', '2025-04-15 05:56:06'),
(34, 5, 'Samedi', '07:23', '07:23', '2025-04-15 05:56:06', '2025-04-15 05:56:06'),
(35, 5, 'Dimanche', '06:30', '06:30', '2025-04-15 05:56:06', '2025-04-15 05:56:06');

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2025_02_08_131946_create_categories_tables', 1),
(2, '2014_10_12_000000_create_users_table', 2),
(3, '2025_02_08_131655_create_entreprise_table', 3),
(4, '2014_10_12_100000_create_password_reset_tokens_table', 4),
(5, '2019_08_19_000000_create_failed_jobs_table', 4),
(6, '2019_12_14_000001_create_personal_access_tokens_table', 4),
(7, '2025_02_08_131758_create_horaires_tables', 4),
(8, '2025_02_14_134701_create_avis_table', 4),
(9, '2025_02_18_094854_add_user_id_to_entreprises_table', 4);

-- --------------------------------------------------------

--
-- Structure de la table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `password_reset_tokens`
--

INSERT INTO `password_reset_tokens` (`email`, `token`, `created_at`) VALUES
('mabrouk@gmail.com', '$2y$12$smAufLdFYfob.sIurW7n2O1jlvGTfhXh7ghHNbjj5AcWoaEuMZasi', '2025-04-15 05:50:29');

-- --------------------------------------------------------

--
-- Structure de la table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(2, 'mabrouk', 'mabrouk@gmail.com', NULL, '$2y$12$wjRuwzBXKvC4TxgkahKXn.z2Jg79f9ZyOfm07rayT4G6vir3QLUbW', NULL, '2025-04-14 13:21:17', '2025-04-14 13:21:17'),
(3, 'mabrouk', 'mabroukjjj@gmail.com', NULL, '$2y$12$2CFYBRaCoawCWJuzcvTWT.UYapqqTkJ5HakNCuFZkHM1ODftZ2Oom', NULL, '2025-04-15 05:51:24', '2025-04-15 05:51:24');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `avis`
--
ALTER TABLE `avis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `avis_user_id_foreign` (`user_id`),
  ADD KEY `avis_entreprise_id_foreign` (`entreprise_id`);

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_libelle_unique` (`libelle`);

--
-- Index pour la table `entreprises`
--
ALTER TABLE `entreprises`
  ADD PRIMARY KEY (`id`),
  ADD KEY `entreprises_id_categorie_foreign` (`id_categorie`),
  ADD KEY `entreprises_user_id_foreign` (`user_id`);

--
-- Index pour la table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Index pour la table `horaires`
--
ALTER TABLE `horaires`
  ADD PRIMARY KEY (`id`),
  ADD KEY `horaires_id_entreprise_foreign` (`id_entreprise`);

--
-- Index pour la table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Index pour la table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `avis`
--
ALTER TABLE `avis`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pour la table `entreprises`
--
ALTER TABLE `entreprises`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `horaires`
--
ALTER TABLE `horaires`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT pour la table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `avis`
--
ALTER TABLE `avis`
  ADD CONSTRAINT `avis_entreprise_id_foreign` FOREIGN KEY (`entreprise_id`) REFERENCES `entreprises` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `avis_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Contraintes pour la table `entreprises`
--
ALTER TABLE `entreprises`
  ADD CONSTRAINT `entreprises_id_categorie_foreign` FOREIGN KEY (`id_categorie`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `entreprises_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `horaires`
--
ALTER TABLE `horaires`
  ADD CONSTRAINT `horaires_id_entreprise_foreign` FOREIGN KEY (`id_entreprise`) REFERENCES `entreprises` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
