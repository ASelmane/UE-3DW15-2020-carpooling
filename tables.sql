CREATE TABLE `users` (
  `id` int AUTO_INCREMENT NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `birthday` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `users` (`id`, `firstname`, `lastname`, `email`, `birthday`) VALUES
(1, 'Vincent', 'Godé', 'hello@vincentgo.fr', '1990-11-08'),
(2, 'Albert', 'Dupond', 'sonemail@gmail.com', '1985-11-08'),
(3, 'Thomas', 'Dumoulin', 'sonemail2@gmail.com', '1985-10-08');

-- --------------------------------------------------------

--
-- Structure de la table `users_annonces`
--

DROP TABLE IF EXISTS `users_annonces`;
CREATE TABLE IF NOT EXISTS `users_annonces` (
  `user_id` int(11) NOT NULL,
  `annonce_id` int(11) NOT NULL,
  PRIMARY KEY (`user_id`,`annonce_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `users_annonces`
--

INSERT INTO `users_annonces` (`user_id`, `annonce_id`) VALUES
(1, 1),
(1, 2),
(2, 3),
(3, 4);

-- --------------------------------------------------------

--
-- Structure de la table `users_cars`
--

DROP TABLE IF EXISTS `users_cars`;
CREATE TABLE IF NOT EXISTS `users_cars` (
  `user_id` int(11) NOT NULL,
  `car_id` int(11) NOT NULL,
  PRIMARY KEY (`user_id`,`car_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `users_cars`
--

INSERT INTO `users_cars` (`user_id`, `car_id`) VALUES
(1, 1),
(1, 2),
(2, 3),
(3, 4);

-- --------------------------------------------------------

--
-- Structure de la table `annonces`
--

DROP TABLE IF EXISTS `annonces`;
CREATE TABLE IF NOT EXISTS `annonces` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lieuDepart` varchar(255) NOT NULL,
  `lieuArrivee` varchar(255) NOT NULL,
  `dateDepart` datetime NOT NULL,
  `place` varchar(255) NOT NULL,
  `prix` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `annonces`
--

INSERT INTO `annonces` (`id`, `lieuDepart`, `lieuArrivee`, `dateDepart`, `place`, `prix`) VALUES
(1, 'Rouen', 'Paris', '2020-11-17 16:20:00', '2', '15'),
(2, 'Poitiers', 'Paris', '2020-11-24 19:45:00', '2', '32'),
(3, 'Limoges', 'Tours', '2020-11-29 13:19:00', '1', '25'),
(4, 'Marseille', 'Paris', '2020-11-02 20:00:00', '3', '45');

-- --------------------------------------------------------

--
-- Structure de la table `annonces_cars`
--

DROP TABLE IF EXISTS `annonces_cars`;
CREATE TABLE IF NOT EXISTS `annonces_cars` (
  `annonce_id` int(11) NOT NULL,
  `car_id` int(11) NOT NULL,
  PRIMARY KEY (`annonce_id`,`car_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `annonces_cars`
--

INSERT INTO `annonces_cars` (`annonce_id`, `car_id`) VALUES
(1, 2),
(2, 1),
(3, 3),
(4, 4);

-- --------------------------------------------------------

--
-- Structure de la table `cars`
--

DROP TABLE IF EXISTS `cars`;
CREATE TABLE IF NOT EXISTS `cars` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `marque` varchar(255) NOT NULL,
  `modele` varchar(255) NOT NULL,
  `couleur` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `cars`
--

INSERT INTO `cars` (`id`, `marque`, `modele`, `couleur`) VALUES
(1, 'Skoda', 'Fabia', 'Noire'),
(2, 'Huandai', 'Getz', 'Rouge'),
(3, 'Mercedes', 'Classe C', 'Noire'),
(4, 'Renaut', 'Zoé', 'Bleu');

-- --------------------------------------------------------

--
-- Structure de la table `reservations`
--

DROP TABLE IF EXISTS `reservations`;
CREATE TABLE IF NOT EXISTS `reservations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `annonce_id` int(11) NOT NULL,
  `dateReservation` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `reservations`
--

INSERT INTO `reservations` (`id`, `user_id`, `annonce_id`, `dateReservation`) VALUES
(1, 1, 4, '2020-11-24 11:53:00'),
(2, 2, 2, '2020-11-24 11:51:00'),
(3, 3, 2, '2020-11-24 13:47:00');

