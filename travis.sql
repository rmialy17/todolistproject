
-- SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
-- START TRANSACTION;
-- SET time_zone = "+00:00";



DROP TABLE IF EXISTS `task`;
CREATE TABLE IF NOT EXISTS `task` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_done` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_527EDB25A76ED395` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


INSERT INTO `task` (`id`, `user_id`, `created_at`, `title`, `content`, `is_done`) VALUES
(4, NULL, '2022-04-16 17:09:00', 'Tâche 4', 'Faire un gâteau', 0),
(6, 2, '2022-04-17 04:11:52', 'Le titre', 'le contenu', 1),
(7, 2, '2022-04-17 04:15:35', 'Le titre', 'le contenu', 0),
(8, 2, '2022-04-17 04:18:35', 'Le titre', 'le contenu', 0),
(9, 2, '2022-04-17 04:58:48', 'Le titre', 'le contenu', 1),
(10, 2, '2022-04-17 05:05:02', 'Le titre', 'le contenu', 0),
(11, 2, '2022-04-17 05:12:10', 'Le titre', 'le contenu', 0),
(12, 2, '2022-04-17 05:13:19', 'Le titre', 'le contenu', 0),
(13, 2, '2022-04-17 05:18:57', 'Le titre', 'le contenu', 0),
(14, 2, '2022-04-17 05:22:35', 'Le titre', 'le contenu', 0),
(15, 2, '2022-04-17 05:29:56', 'Le titre', 'le contenu', 0),
(16, 2, '2022-04-17 05:30:37', 'Le titre', 'le contenu', 0),
(17, 2, '2022-04-17 11:45:11', 'Le titre', 'le contenu', 0),
(18, 2, '2022-04-17 12:32:51', 'Le titre', 'le contenu', 0),
(19, 2, '2022-04-17 12:36:34', 'Le titre', 'le contenu', 0),
(20, 2, '2022-04-17 13:12:28', 'Le titre', 'le contenu', 0),
(21, 2, '2022-04-17 13:57:31', 'Le titre', 'le contenu', 0),
(22, 2, '2022-04-17 15:45:33', 'Le titre', 'le contenu', 0),
(23, 2, '2022-04-17 15:48:23', 'Le titre', 'le contenu', 0),
(24, 2, '2022-04-17 15:54:42', 'Le titre', 'le contenu', 0),
(25, 2, '2022-04-17 18:11:57', 'Le titre', 'le contenu', 0),
(26, 2, '2022-04-17 18:37:28', 'Le titre', 'le contenu', 0),
(27, 2, '2022-04-17 18:39:53', 'Le titre', 'le contenu', 0),
(28, 2, '2022-04-17 18:42:06', 'Le titre', 'le contenu', 0),
(29, 2, '2022-04-17 18:43:56', 'Le titre', 'le contenu', 0),
(30, 2, '2022-04-17 18:45:56', 'Le titre', 'le contenu', 0),
(31, 2, '2022-04-17 18:54:30', 'Le titre', 'le contenu', 0),
(32, 2, '2022-04-17 18:59:16', 'Le titre', 'le contenu', 0),
(33, 2, '2022-04-17 19:00:58', 'Le titre', 'le contenu', 0),
(34, 2, '2022-04-17 19:02:15', 'Le titre', 'le contenu', 0),
(35, 2, '2022-04-17 19:02:57', 'Le titre', 'le contenu', 0),
(36, 2, '2022-04-17 19:12:39', 'Le titre', 'le contenu', 0),
(37, 2, '2022-04-17 19:16:46', 'Le titre', 'le contenu', 0),
(38, 2, '2022-04-17 19:20:05', 'Le titre', 'le contenu', 0),
(39, 2, '2022-04-19 11:46:07', 'Le titre', 'le contenu', 0),
(40, 2, '2022-04-19 11:49:09', 'Le titre', 'le contenu', 0),
(41, 2, '2022-04-19 11:52:16', 'Le titre', 'le contenu', 0),
(42, 2, '2022-04-19 11:54:09', 'Le titre', 'le contenu', 0),
(43, 2, '2022-04-19 12:13:02', 'Le titre', 'le contenu', 0),
(44, 2, '2022-04-19 12:16:11', 'Le titre', 'le contenu', 0),
(45, 2, '2022-04-19 12:19:18', 'Le titre', 'le contenu', 0);



DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8D93D649F85E0677` (`username`),
  UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


INSERT INTO `user` (`id`, `username`, `password`, `email`, `roles`) VALUES
(1, 'admin', '$2y$13$9zAg8xov1yZT4HMqG6..puXMEaZk84DL6LY3dK3gov4V2.tP2kjWS', 'admin@gmail.com', '[\"ROLE_ADMIN\"]'),
(2, 'userdemo', '$2y$13$wvROV/OmiiKa4y1eD3uzqeqAwO9MqUtxwJawgkTGVMiCxFMpg4qvG', 'userdemo@gmail.com', '[\"ROLE_USER\"]'),
(3, 'newadmin', '$2y$13$1ZGyAkPglZU2FkRs4Y4m4.bYULyrUCL5393uqJVesp5KvP0.ThUla', 'newadmin@gmail.com', '[\"ROLE_ADMIN\"]');


ALTER TABLE `task`
  ADD CONSTRAINT `FK_527EDB25A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);
COMMIT;

