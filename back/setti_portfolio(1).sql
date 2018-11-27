-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  mar. 20 nov. 2018 à 09:19
-- Version du serveur :  10.1.31-MariaDB
-- Version de PHP :  7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `setti_portfolio`
--

-- --------------------------------------------------------

--
-- Structure de la table `t_competences`
--

CREATE TABLE `t_competences` (
  `id_competence` int(3) NOT NULL,
  `icon` varchar(100) NOT NULL,
  `competence` varchar(150) NOT NULL,
  `niveau` varchar(50) NOT NULL,
  `categorie` enum('Back','CMS','Frameworks','Front') NOT NULL,
  `id_utilisateur` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `t_competences`
--

INSERT INTO `t_competences` (`id_competence`, `icon`, `competence`, `niveau`, `categorie`, `id_utilisateur`) VALUES
(37, 'php7.jpg', 'PHP 74', '70%', '', 1),
(38, 'bootstrap.jpg', 'Bootstrap 4', '90%', 'Frameworks', 1),
(39, 'mysql.jpg', 'MYSQL888', '700%', 'Frameworks', 1),
(46, 'wp.jpg', 'Wordpress', '60%', 'CMS', 1),
(49, 'github.jpg', 'Git', '70%', 'Back', 1),
(50, 'html-5-icon.jpg', 'HTML 5', '90%', 'Front', 1),
(51, 'css3.jpg', 'CSS 3', '80%', 'Front', 1),
(52, 'js.png', 'JavaScript', '60%', 'Front', 1),
(53, 'jq.jpg', 'jQuery', '60%', 'Front', 1);

-- --------------------------------------------------------

--
-- Structure de la table `t_experiences`
--

CREATE TABLE `t_experiences` (
  `id_experience` int(3) NOT NULL,
  `dates_exp` varchar(100) NOT NULL,
  `titre_exp` varchar(150) NOT NULL,
  `stitre_exp` varchar(200) NOT NULL,
  `description_exp` text NOT NULL,
  `id_utilisateur` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `t_experiences`
--

INSERT INTO `t_experiences` (`id_experience`, `dates_exp`, `titre_exp`, `stitre_exp`, `description_exp`, `id_utilisateur`) VALUES
(1, 'PROJET WEB PERSONNEL - SITE CV', 'Octobre -2018', 'Binliothèque François Mitterrand', 'Intégration HTML CSS JS Bootstrap et responsive design Développement Backend sur PHP', 1),
(2, 'Développeur Web Intégrateur', 'Pour ENVIE2E', 'projet en cours - depuis octobre 2018', 'Utilisation du CMS WordPress Installation du thème Divi Veiller à la structure du code, au respect des pratiques W3C pour avoir un référencement naturel (SEO) optimisé Gestion de projet et relation client', 1),
(3, 'experience', 'experience', '2018', 'Descriptiexperienceon d&#039;experience', 1),
(4, 'experience23', 'experience23', '20183', 'Desexperienceexperie3', 1);

-- --------------------------------------------------------

--
-- Structure de la table `t_formations`
--

CREATE TABLE `t_formations` (
  `id_formation` int(3) NOT NULL,
  `formation` varchar(150) NOT NULL,
  `stitre_form` varchar(150) NOT NULL,
  `dates_form` varchar(100) NOT NULL,
  `description_form` text NOT NULL,
  `id_utilisateur` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `t_formations`
--

INSERT INTO `t_formations` (`id_formation`, `formation`, `stitre_form`, `dates_form`, `description_form`, `id_utilisateur`) VALUES
(3, 'FORMATION INTÉGRATEUR DÉVELOPPEUR WEB', 'Webforce 3 et LePoleS -', 'Depuis mai 2018', 'Formation de 10 mois labellisée Grande École du Numérique Techniques de développement web et mobile', 1),
(4, 'Passage du passeport numérique multimédia', 'Associatiob Colombbus', 'Mars 2018', '', 1),
(7, 'formation24', 'formation24', '2002 / 20184', 'formation2formation2formation2formation24', 1),
(8, 'formation', 'Formation', 'forma', 'formaformaforma', 1),
(9, 'Parcourt numérique', 'Association Colombbus', 'Mars 2018', 'à belleville', 1);

-- --------------------------------------------------------

--
-- Structure de la table `t_loisirs`
--

CREATE TABLE `t_loisirs` (
  `id_loisir` int(3) NOT NULL,
  `loisir` varchar(200) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `id_utilisateur` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `t_loisirs`
--

INSERT INTO `t_loisirs` (`id_loisir`, `loisir`, `photo`, `id_utilisateur`) VALUES
(8, 'Vie associative', '', 0),
(11, 'pâtisserie', '', 0),
(12, 'pâtisse', '', 1),
(15, 'loisir ', 'home-bg.jpg', 1),
(16, 'sport', 'wallpaper2you_422199.jpg', 1),
(17, 'ines', 'bg_02.jpg', 1),
(18, 'music', 'contact-bg.jpg', 1);

-- --------------------------------------------------------

--
-- Structure de la table `t_messages`
--

CREATE TABLE `t_messages` (
  `id_message` int(3) NOT NULL,
  `nom` varchar(200) NOT NULL,
  `email` varchar(100) NOT NULL,
  `message` text NOT NULL,
  `id_utilisateur` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `t_realisations`
--

CREATE TABLE `t_realisations` (
  `id_realisation` int(3) NOT NULL,
  `titre_real` varchar(150) NOT NULL,
  `stitre_real` varchar(150) NOT NULL,
  `dates-real` varchar(100) NOT NULL,
  `description_real` text NOT NULL,
  `id_utilisateur` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `t_reseaux`
--

CREATE TABLE `t_reseaux` (
  `id_reseau` int(3) NOT NULL,
  `url` text NOT NULL,
  `id_utilisateur` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `t_reseaux`
--

INSERT INTO `t_reseaux` (`id_reseau`, `url`, `id_utilisateur`) VALUES
(3, '<a href=\"https://www.linkedin.com/feed/\" target=\"_blank\"><i class=\"fab fa-linkedin fa-2x fa-fw\"></i></a>', 1),
(4, '<a href=\"https://twitter.com/?lang=fr\" target=\"_blank\"><i class=\"fab fa-twitter-square fa-2x fa-fw\"></i></a>', 1),
(5, '<a href=\"https://www.instagram.com/?hl=fr\" target=\"_blank\"><i class=\"fab fa-instagram fa-2x fa-fw\"></i></a>', 1),
(11, '<a href=\"https://www.facebook.com/\" target=\"_blank\"><i class=\"fab fa-facebook fa-2x fa-fw\"></i></a>', 1),
(16, '<a href=\"https://github.com/\" target=\"_blank\"><i class=\"fab fa-github-square fa-2x fa-fw\"></i></a>', 1),
(17, '<a href=\"https://www.webnots.com/bootstrap-4-cards-tutorial/\" target=\"_blank\"><i class=\"fab fa-facebook fa-2x fa-fw\"></i></a>', 1);

-- --------------------------------------------------------

--
-- Structure de la table `t_utilisateurs`
--

CREATE TABLE `t_utilisateurs` (
  `id_utilisateur` int(3) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `pseudo` varchar(20) NOT NULL,
  `mdp` varchar(20) NOT NULL,
  `prenom` varchar(20) NOT NULL,
  `nom` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `civilite` enum('M','Mme') NOT NULL,
  `ville` varchar(50) NOT NULL,
  `code_postal` varchar(5) NOT NULL,
  `adresse` text NOT NULL,
  `tel` varchar(20) NOT NULL,
  `age` smallint(3) NOT NULL,
  `anniversaire` date NOT NULL,
  `genre` enum('F','H') NOT NULL,
  `pays` varchar(30) NOT NULL,
  `commentaire` text NOT NULL,
  `statut` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `t_utilisateurs`
--

INSERT INTO `t_utilisateurs` (`id_utilisateur`, `photo`, `pseudo`, `mdp`, `prenom`, `nom`, `email`, `civilite`, `ville`, `code_postal`, `adresse`, `tel`, `age`, `anniversaire`, `genre`, `pays`, `commentaire`, `statut`) VALUES
(1, 'profil.jpg', 'Setti', '790910', 'Setti', 'Belkacem', 'settibelkacem313@gmail.com', 'Mme', 'Les Lilas', '93260', '96 Rue Romain Rolland', '', 39, '1979-03-30', 'F', 'france', 'Pas de commentaire', 1),
(2, '', 'mouh', 'mouh', 'mohammed', 'Yessad', 'mouh@gmail.com', 'M', 'Pré Saint Gervais', '93310', 'fuisdhgtiuqioszg', '0652369841', 33, '0000-00-00', 'H', 'France', 'hjerhgiehzrgioju&#039;omouha', 0);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `t_competences`
--
ALTER TABLE `t_competences`
  ADD PRIMARY KEY (`id_competence`);

--
-- Index pour la table `t_experiences`
--
ALTER TABLE `t_experiences`
  ADD PRIMARY KEY (`id_experience`);

--
-- Index pour la table `t_formations`
--
ALTER TABLE `t_formations`
  ADD PRIMARY KEY (`id_formation`);

--
-- Index pour la table `t_loisirs`
--
ALTER TABLE `t_loisirs`
  ADD PRIMARY KEY (`id_loisir`);

--
-- Index pour la table `t_messages`
--
ALTER TABLE `t_messages`
  ADD PRIMARY KEY (`id_message`);

--
-- Index pour la table `t_realisations`
--
ALTER TABLE `t_realisations`
  ADD PRIMARY KEY (`id_realisation`);

--
-- Index pour la table `t_reseaux`
--
ALTER TABLE `t_reseaux`
  ADD PRIMARY KEY (`id_reseau`);

--
-- Index pour la table `t_utilisateurs`
--
ALTER TABLE `t_utilisateurs`
  ADD PRIMARY KEY (`id_utilisateur`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `t_competences`
--
ALTER TABLE `t_competences`
  MODIFY `id_competence` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT pour la table `t_experiences`
--
ALTER TABLE `t_experiences`
  MODIFY `id_experience` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `t_formations`
--
ALTER TABLE `t_formations`
  MODIFY `id_formation` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `t_loisirs`
--
ALTER TABLE `t_loisirs`
  MODIFY `id_loisir` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT pour la table `t_messages`
--
ALTER TABLE `t_messages`
  MODIFY `id_message` int(3) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `t_realisations`
--
ALTER TABLE `t_realisations`
  MODIFY `id_realisation` int(3) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `t_reseaux`
--
ALTER TABLE `t_reseaux`
  MODIFY `id_reseau` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT pour la table `t_utilisateurs`
--
ALTER TABLE `t_utilisateurs`
  MODIFY `id_utilisateur` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
