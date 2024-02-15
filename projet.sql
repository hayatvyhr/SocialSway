-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3308
-- Généré le : sam. 20 mai 2023 à 03:14
-- Version du serveur : 10.4.28-MariaDB
-- Version de PHP : 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `projet`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `password` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `admin`
--

INSERT INTO `admin` (`id`, `email`, `nom`, `prenom`, `password`) VALUES
(1, 'h@gmail.com', 'roubakhi', 'hayat', '147852369');

-- --------------------------------------------------------

--
-- Structure de la table `data_user`
--

CREATE TABLE `data_user` (
  `id_user` int(11) DEFAULT NULL,
  `type` varchar(3) DEFAULT NULL,
  `visites_p` int(11) DEFAULT 0,
  `theme` int(11) DEFAULT 0,
  `revenue_1` int(11) DEFAULT 0,
  `revenue_2` int(11) DEFAULT 0,
  `revenue_3` int(11) DEFAULT 0,
  `revenue_4` int(11) DEFAULT 0,
  `revenue_5` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `data_user`
--

INSERT INTO `data_user` (`id_user`, `type`, `visites_p`, `theme`, `revenue_1`, `revenue_2`, `revenue_3`, `revenue_4`, `revenue_5`) VALUES
(10708, 'inf', 0, 0, 0, 0, 0, 0, 0),
(9, 'mar', 0, 0, 0, 0, 0, 0, 0),
(10709, 'inf', 0, 0, 0, 0, 0, 0, 0),
(10710, 'inf', 0, 0, 0, 0, 0, 0, 0),
(10, 'mar', 0, 0, 0, 0, 0, 0, 0),
(11, 'mar', 0, 0, 0, 0, 0, 0, 0),
(12, 'mar', 0, 0, 0, 0, 0, 0, 0),
(10711, 'inf', 0, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `friendship`
--

CREATE TABLE `friendship` (
  `id_inf` int(11) DEFAULT NULL,
  `id_mar` int(11) DEFAULT NULL,
  `link` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `influencer`
--

CREATE TABLE `influencer` (
  `id` int(11) NOT NULL,
  `imagee` varchar(100) NOT NULL DEFAULT 'no-image',
  `nom` varchar(30) NOT NULL,
  `prenom` varchar(30) NOT NULL,
  `datenaissance` date NOT NULL,
  `email` varchar(200) NOT NULL,
  `gsm` int(11) NOT NULL,
  `adresse` varchar(100) NOT NULL,
  `genre` varchar(1) NOT NULL,
  `domaine` varchar(120) NOT NULL,
  `socialmedia` varchar(100) NOT NULL,
  `username` varchar(40) NOT NULL,
  `motdepasse` varchar(20) NOT NULL,
  `followers` int(11) DEFAULT NULL,
  `langue` varchar(50) DEFAULT NULL,
  `continent` varchar(50) DEFAULT NULL,
  `points` varchar(50) DEFAULT NULL,
  `disponible` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `influencer`
--

INSERT INTO `influencer` (`id`, `imagee`, `nom`, `prenom`, `datenaissance`, `email`, `gsm`, `adresse`, `genre`, `domaine`, `socialmedia`, `username`, `motdepasse`, `followers`, `langue`, `continent`, `points`, `disponible`) VALUES
(10708, '4323001.png', 'youssra', 'aya', '2023-05-27', 'imane@gmail.com', 767540000, 'rue2', 'F', 'IT', '[\"Instagram\",\"Facebook\"]', '[\"imane\",\"imane1\"]', '12345678Wi', 20000, 'english', 'afrique', NULL, 0),
(10709, '201634.png', 'saidi', 'ahlam', '2023-05-24', 'ahlam@gmail.com', 767540000, 'rue2', 'F', 'design', '[\"Instagram\",\"Facebook\"]', '[\"al\",\"bl\"]', '11111111Wi', 2300000, 'francais', NULL, NULL, 0),
(10711, '3.png', 'ww', 'wiam', '2023-05-11', 'allysa1@gmail.com', 767540000, 'rue1', 'F', 'IT', '[\"Instagram\"]', '[\"sdwed\"]', '12345678Wi', 78876, 'rr', NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Structure de la table `marque`
--

CREATE TABLE `marque` (
  `id` int(11) NOT NULL,
  `logo` varchar(100) NOT NULL,
  `nom` varchar(40) NOT NULL,
  `motdepasse` varchar(50) NOT NULL,
  `datedecreation` date NOT NULL,
  `email` varchar(100) NOT NULL,
  `fax_tel` varchar(50) NOT NULL,
  `adresse` varchar(150) NOT NULL,
  `domaine` varchar(200) NOT NULL,
  `chiffredaffaire` int(11) NOT NULL,
  `nomderep` varchar(30) NOT NULL,
  `prenomderep` varchar(30) NOT NULL,
  `emailderep` varchar(150) NOT NULL,
  `gsm` int(11) NOT NULL,
  `points` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `marque`
--

INSERT INTO `marque` (`id`, `logo`, `nom`, `motdepasse`, `datedecreation`, `email`, `fax_tel`, `adresse`, `domaine`, `chiffredaffaire`, `nomderep`, `prenomderep`, `emailderep`, `gsm`, `points`) VALUES
(7, 'Artboard 1.png', 'ahmed2', '12345678Wi', '2023-05-02', 'm1@gmail.com', '3333', 'rue1', 'IT', 1223, 'ahmed', 'med', 'med@gmail.com', 767540000, 0),
(9, '1.png', 'ww', '123', '0000-00-00', 'm2@gmail.com', '3333', 'rue1', 'IT', 0, 'anouar', 'ali', 'med@gmail.com', 767540000, 0),
(10, '95149d_01.jpg', 'dacia', '12345678Wi', '2023-05-02', 'm3@gmail.com', '3333', 'rue1', 'IT', 1223, 'saidi', 'ahmed', 'med@gmail.com', 767540000, 0),
(11, 'beautiful-woman-avatar-character-icon-free-vector.jpg', 'sephora maroc', '12345678Wi', '2023-05-01', 'm4@gmail.com', '3333', 'rue1', 'design', 200009, 'salmi', 'Alia', 'alia@gmail.com', 767540000, 0),
(12, '2.png', 'ww', '12345678Wi', '0000-00-00', 'h11@gmail.com', '3333', 'rue1', 'IT', 0, 'ahmed', 'wiam', 'emaila@gmail', 767540000, 0);

-- --------------------------------------------------------

--
-- Structure de la table `message`
--

CREATE TABLE `message` (
  `msg_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `recever_id` int(11) DEFAULT NULL,
  `timeDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `messagetext` varchar(500) DEFAULT NULL,
  `typeS` varchar(5) DEFAULT NULL,
  `typeR` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `message`
--

INSERT INTO `message` (`msg_id`, `user_id`, `recever_id`, `timeDate`, `messagetext`, `typeS`, `typeR`) VALUES
(53, 10710, 10709, '2023-05-20 00:59:40', 'hey', 'inf', 'inf'),
(54, 10708, 10709, '2023-05-20 01:02:54', 'hey', 'inf', 'inf');

-- --------------------------------------------------------

--
-- Structure de la table `offres`
--

CREATE TABLE `offres` (
  `id_mar` int(11) NOT NULL,
  `nb_postes` int(11) DEFAULT NULL,
  `date_offre` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `partenariats`
--

CREATE TABLE `partenariats` (
  `id_partenariat` int(11) NOT NULL,
  `id_marque` int(11) DEFAULT NULL,
  `id_infl` int(11) DEFAULT NULL,
  `date_debut` date DEFAULT NULL,
  `date_fin` date DEFAULT NULL,
  `termes` varchar(500) DEFAULT NULL,
  `inf_sign` varchar(150) DEFAULT NULL,
  `mar_sign` varchar(1250) DEFAULT NULL,
  `salaire` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `partenariats`
--

INSERT INTO `partenariats` (`id_partenariat`, `id_marque`, `id_infl`, `date_debut`, `date_fin`, `termes`, `inf_sign`, `mar_sign`, `salaire`) VALUES
(7, 7, 10708, '2023-05-12', '2023-05-31', 'a:2:{i:0;s:5:\"date \";i:1;s:6:\"terme2\";}', '1 (1).png', 'Q4.png', 400),
(8, 10, 10708, '2023-05-20', '2023-05-31', 'a:2:{i:0;s:20:\"respecter les dates \";i:1;s:0:\"\";}', 'Oprah-Winfrey-Signature-1.png', 'Michael-Jordan-personal-autograph.png', 200),
(9, 10, 10708, '2023-05-20', '2023-05-31', 'a:2:{i:0;s:20:\"respecter les dates \";i:1;s:0:\"\";}', NULL, 'Michael-Jordan-personal-autograph.png', 200),
(10, 11, 10708, '2023-05-20', '2023-06-23', 'a:2:{i:0;s:19:\"respecter les dates\";i:1;s:19:\"respecter la marque\";}', '2 (1).png', 'Michael-Jordan-personal-autograph.png', 2000),
(11, 11, 10709, '2023-05-19', '2023-05-31', 'a:2:{i:0;s:19:\"respecter les dates\";i:1;s:21:\"respecter les clinets\";}', NULL, 'Oprah-Winfrey-Signature-1.png', 400000),
(12, 11, 10710, '2023-05-31', '2023-06-23', 'a:1:{i:0;s:10:\"le respect\";}', NULL, 'Oprah-Winfrey-Signature-1.png', 50000),
(13, 10, 10708, '2023-05-30', '2025-06-21', 'a:3:{i:0;s:142:\" L\'influenceur peut être tenu de produire un contenu créatif original et de qualité en relation avec la marque et ses produits ou services.\";i:1;s:90:\"L\'influenceur peut être tenu d\'inclure des mentions de la marque dans le contenu créé,.\";i:2;s:154:\"L\'influenceur doit se conformer aux directives fournies par la marque concernant le ton, le style, les valeurs de la marque et les messages à véhiculer.\";}', NULL, 'Michael-Jordan-personal-autograph.png', 234000000),
(14, 10, 10708, '2023-05-30', '2025-06-21', 'a:3:{i:0;s:142:\" L\'influenceur peut être tenu de produire un contenu créatif original et de qualité en relation avec la marque et ses produits ou services.\";i:1;s:90:\"L\'influenceur peut être tenu d\'inclure des mentions de la marque dans le contenu créé,.\";i:2;s:154:\"L\'influenceur doit se conformer aux directives fournies par la marque concernant le ton, le style, les valeurs de la marque et les messages à véhiculer.\";}', NULL, 'Michael-Jordan-personal-autograph.png', 234000000),
(15, 9, 10708, '2023-05-30', '2026-10-22', 'a:2:{i:0;s:184:\"L\'influenceur peut être tenu de soutenir activement la promotion de la marque sur ses propres réseaux sociaux en partageant, commentant et interagissant avec le contenu de la marque.\";i:1;s:141:\"L\'influenceur peut être tenu de produire un contenu créatif original et de qualité en relation avec la marque et ses produits ou services.\";}', NULL, 'Michael-Jordan-personal-autograph.png', 2000),
(16, 11, 10708, '2023-05-25', '2023-06-08', 'a:2:{i:0;s:19:\"respecter les dates\";i:1;s:21:\"respecter les membres\";}', NULL, 'Michael-Jordan-personal-autograph.png', 2000),
(17, 9, 10708, '2023-05-18', '2023-05-31', 'a:1:{i:0;s:4:\"ijoh\";}', NULL, 'Screenshot_20230519-161052_Instagram.jpg', 200),
(18, 9, 10708, '2023-05-18', '2023-05-31', 'a:1:{i:0;s:4:\"ijoh\";}', NULL, 'Screenshot_20230519-161052_Instagram.jpg', 200);

-- --------------------------------------------------------

--
-- Structure de la table `supp`
--

CREATE TABLE `supp` (
  `idSup` int(11) NOT NULL,
  `type` varchar(5) DEFAULT NULL,
  `message` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `todo_list`
--

CREATE TABLE `todo_list` (
  `id_user` int(11) DEFAULT NULL,
  `id_mar` int(11) DEFAULT NULL,
  `deadline` date DEFAULT NULL,
  `title` varchar(50) DEFAULT NULL,
  `tasks` varchar(350) DEFAULT NULL,
  `assigned` int(11) DEFAULT 0,
  `assigned_content` varchar(600) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `influencer`
--
ALTER TABLE `influencer`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `marque`
--
ALTER TABLE `marque`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`msg_id`);

--
-- Index pour la table `offres`
--
ALTER TABLE `offres`
  ADD PRIMARY KEY (`id_mar`);

--
-- Index pour la table `partenariats`
--
ALTER TABLE `partenariats`
  ADD PRIMARY KEY (`id_partenariat`);

--
-- Index pour la table `supp`
--
ALTER TABLE `supp`
  ADD PRIMARY KEY (`idSup`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `influencer`
--
ALTER TABLE `influencer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10712;

--
-- AUTO_INCREMENT pour la table `marque`
--
ALTER TABLE `marque`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `message`
--
ALTER TABLE `message`
  MODIFY `msg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT pour la table `partenariats`
--
ALTER TABLE `partenariats`
  MODIFY `id_partenariat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
