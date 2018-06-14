-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le :  jeu. 14 juin 2018 à 20:22
-- Version du serveur :  5.6.38
-- Version de PHP :  7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de données :  `web-trotter`
--

-- --------------------------------------------------------

--
-- Structure de la table `articles`
--

CREATE TABLE `articles` (
  `id` int(11) NOT NULL,
  `titre` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `auteur_id` int(255) DEFAULT NULL,
  `dateA` date DEFAULT NULL,
  `lattitude` float DEFAULT NULL,
  `photo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `longitude` float NOT NULL,
  `adresse` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `categorie` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `articles`
--

INSERT INTO `articles` (`id`, `titre`, `description`, `auteur_id`, `dateA`, `lattitude`, `photo`, `longitude`, `adresse`, `categorie`) VALUES
(1, 'L\'Hotel de Ville', 'L\'hôtel de Ville fut érigé en 1553. Ses peintures murales représentent la religion réformée et les blasons des villes suisses alliées à la République de Mulhouse. Il est maintenant occupé par le musée historique de la ville.', 4, '2018-06-12', 47.7466, 'Mulhouse_hotel_de_ville.jpg', 7.33923, '2 place de la Réunion, 68100 Mulhouse', 'Autre monument historique'),
(5, 'La Tour de Bollwerk', 'La Tour de Bollwerk fut érigée au XIVème siècle. Sa fresque médiévale, peinte en 1893 par Ferdinand Wagner, représente l\'attaque de Mulhouse par Martin Malterer en 1385.', 9, '2018-06-12', 47.7485, 'tour-du-bollwerk-52612-600-600-F.jpg', 7.34201, '10-14 Rue de Metz, 68100 Mulhouse', 'Tour'),
(2, 'La Tour de Nessel', 'La tour de Nessel était autrefois une tour porte qui donnait accès à la ville. Probablement construite au XIVème siècle, elle fut transformée en simple tour au courant du XVème siècle. Elle servit de prison et fut abandonnée après 1798, pour être vendue à un bourgeois en 1803.', 5, '2018-06-12', 47.7448, 'tour-nessel.jpg', 7.32966, 'arrêt de tram \"Tour Nessel\", 68100 Mulhouse', 'Tour'),
(3, 'La tour du Diable', 'Cette tour semble avoir été batie durant la seconde moitié du XIVème siècle, bien que sa fenêtre et son encadrement semble dater de 1434. Elle eu plusieurs nom, tirés des noms des habitants voisins de la tour, comme Wiss Turm ou Veltin Bernhards Turm. Son nom de \"Tour du Diable\" apparu probablement lors des XVème et XVIème siècle, pendant la chasse aux sorcières. Elles y étaient alors enfermées, torturées et probablement exécutées sur place. Cette tour servit enfin de prison puis de tour de guet. Elle faillit être détruite en 1904et fut restaurée en 1906', 8, '2018-06-12', 47.7435, '42957933.jpg', 7.33072, '18 Rue Gay Lussac, 68100 Mulhouse', 'Tour'),
(4, 'Le Temple Saint-Etienne', 'Le Temple de Saint-Etienne est une ancienne église réformée par les protestants. Ses dimentions en font le plus haut bâtiment protestant de France, et ses dimensions lui donnent le surnom de \"cathédrale de Mulhouse\"', 5, '2018-06-12', 47.7471, 'temple.png', 7.33875, '12 Place de la Réunion, 68100 Mulhouse', 'Monument religieux'),
(6, 'Le Monument aux Morts', 'Il fut inauguré en 1927, avenue du Président Roosevelt. En 1942, il fut partiellement détruit, puis restauré en 1954.', 9, '2018-06-12', 47.7489, 'monument_aux_morts.jpg', 7.3306, '14 Boulevard du Président Roosevelt, 68200 Mulhouse', 'Autre monument historique'),
(7, 'La Tour du Hasenrain', 'Cette tour est un observatoire en maçonnerie édifié en 1900. L\'ancient mot Hasenrain désigne le nom de l\'un des cantons de la République de Mulhouse.', 3, '2018-06-12', 47.7343, 'tour_hasenrain.jpg', 7.3323, ' 87 Avenue d\'Altkirch, 68100 Mulhouse', 'Tour'),
(11, 'La Maison des Têtes', 'Voici un bâtiment très célèbre de la ville de Colmar, bâtiment que vous découvrirez en plein centre-ville, non loin de l\'Hôtel de Ville. La Maison des Têtes, ou Kopfhüs dans le patois local, est une bâtisse originale qui doit certainement son nom à cette façade admirable et notamment à ce balcon orné de multiples petites têtes. Classée monument historique, la Maison des Têtes plaira probablement aux amateurs de belles sculptures et de détails minutieux. ', 1, '2018-06-12', 48.0785, 'La maison des têtes.jpg', 7.35557, '19, Rue des Tetes, 68000 Colmar', 'Autre monument historique'),
(12, 'L\'ancien corps de garde ', 'Le corps de garde a été élevé en 1575 (maître d\'œuvre Beier Melchior). La loggia, élevée entre 1577 et 1582, permettait au Magistrat de prêter serment et de prononcer les condamnations.\r\nAvant de servir d\'affectation au logement du corps de garde, ce bâtiment était destiné à servir d\'hôtel de ville.\r\nLe passage vers la rue des Marchands servait de marché aux noix et aux oléagineux.', 2, '2018-06-12', 48.0769, 'Ancien_Corps_de_Garde_in_Colmar_2011-04.jpg', 7.35779, '17 Place de la Cathédrale, 68000 Colmar', 'Autre monument historique'),
(13, 'Cathérale de Fribourg', 'La tour, presque carrée à sa base, se prolonge en son centre par une section à 12 côtés, par-dessus laquelle elle devient octogonale et en forme de fuseau. Elle est finalement prolongée par une flèche.\r\nElle constitue la seule église gothique allemande dont la tour a été achevée au Moyen Âge (1330), et a miraculeusement été préservée jusqu’alors, survivant aux bombardements de Novembre 1944, qui détruisirent beaucoup de maisons environnantes. Au cours du bombardement, la tour a du résister à de lourdes vibrations, sa survie à celles-ci est attribuée à son ancrage principal qui relie les sections de la flèche. Les vitraux avaient à l’époque été enlevés de la flèche et de ce fait ne subirent aucun dommage.', 6, '2018-06-12', 47.9953, '2_Freiburger_Münster.jpg', 7.85159, 'Münsterplatz 6, 79098 Freiburg im Breisgau, Allemagne', 'Monument religieux'),
(14, 'Château du Haut-Koenigsbourg', 'Le château du Haut-Kœnigsbourg est un ancien château fort du XIIe siècle, profondément remanié au XVe siècle. Il fut sous Guillaume II un symbole impérial allemand, qui se dresse sur la commune française d\'Orschwiller dans le département du Bas-Rhin en région Grand Est, au sein de la région historique et culturelle d\'Alsace.\r\nLe nom actuel du château, Haut-Kœnigsbourg, est le résultat de l\'adaptation du nom allemand Hohkönigsburg qui se traduit par « haut-château du roi ».', 7, '2018-06-12', 48.2495, '800px-Chateau_Haut_Koenigsbourg.jpg', 7.34448, '67600 Orschwiller, France', 'Châteaux'),
(15, 'Route des vins d\'Alsace', 'La route des vins d\'Alsace est un itinéraire touristique qui parcourt la région viticole à la découverte des vins et de leur production.\r\nInaugurée en 1953, elle est la plus ancienne route viticole de France, s\'étendant sur plus de 170 kilomètres et 73 communes, à travers les départements du Haut-Rhin et du Bas-Rhin. Son emblème est le vin blanc.', 8, '2018-06-12', 48.1327, 'Route des vins d\'Alsace Niedermorschwihr.jpg', 7.30356, 'Route des Vins, 68240 Kaysersberg-Vignoble, France', 'Autre monument historique'),
(16, 'Musée du Sapeur Pompier', 'Un des plus grands musées du sapeur-pompier en France.\r\nIl reprend, complète, modernise et surtout présente dans ses propres locaux la prestigieuse collection qui a constitué jusqu\'à présent le Musée du Sapeur-Pompier de Mulhouse et qui a été présentée dans le cadre du Musée du Chemin de Fer à Mulhouse de 1978 à 2003. Dans les deux halls (1100 et 1200 m2), nous pouvons trouver des vitrines, une salle audio-visuelle, une boutique, une bibliothèque, des engins sur roues, une centaine d\'équipements (matériel, habillement, objets insolites...), une centrale téléphonique complète, des avertisseurs publics d\'incendie... ', 4, '2018-06-12', 47.5041, 'Musee du sapeur pompier.jpg', 7.30435, '4 Rue de Toulouse, 68100 Mulhouse, France', 'Musée'),
(17, 'Relais Nautique de la Porte d\'Alsace ', 'Le Relais Nautique de la Porte d\'Alsace est situé à proximité de Dannemarie, bourg concentrant tous les commerces nécessaires.\r\nLe relais peut accueillir une cinquantaine de bateaux de toute taille sur trois pontons différents.\r\nEau potable et électricité sont à la disposition des plaisanciers (selon modalités définies par la collectivité)\r\nUne laverie, des sanitaires équipés de douches, des aires de jeux, des espaces verts et des tables de pique-nique sont à la disposition des plaisanciers et de leurs invités.\r\nChaque année, Madame Anne Stephan, responsable du Relais Nautique, organise une séance de retrait des bateaux pour leur hivernage puis au printemps une séance de remise à l\'eau. Il est ainsi possible pour les plaisanciers de procéder à l\'entretien courant de leur bateau sur place. ', 5, '2018-06-12', 47.6395, 'relais nautique de la porte d\'alsace.jpg', 7.11267, '68210 Wolfersdorf, France', 'Autre monument historique'),
(18, 'Le Musée de Théodore Deck', 'Le Musée de Théodore Deck (précédemment appelé le Musée du Florival) se situe dans une grande maison sur la place Jeanne d\'Arc à Guebwiller et examine l\'histoire de la ville et en particulier les céramiques de Théodore Deck, un important céramiste du 19ème siècle né ici. Même si vous n\'avez jamais entendu parler de Théodore Deck une visite au musée est fortement recommandée si vous êtes intéressé par la céramique.', 4, '2018-06-12', 47.9055, 'Musée Théodore DECK.jpg', 7.2145, '1 Rue du 4 Février, 68500 Guebwiller, France', 'Musée'),
(19, 'Église abbatiale d\'Ottmarsheim', 'Datant à l\'origine de la première moitié du 11ème siècle, l\'Église de Saint-Pierre et Saint-Paul à l\'origine faisait partie d\'une abbaye bénédictine qui a été construite ici par Rodolphe d\'Altenbourg, un riche propriétaire. Il est inhabituel en conception, d\'une forme octogonale, et un exemple très impressionnant de l\'architecture d\'églises de style romain qui est presque totalement absente de tout décoration superflue.', 2, '2018-06-12', 47.7874, 'Église abbatiale d\'Ottmarsheim.jpg', 7.50752, '1 Rue du Couvent, 68490 Ottmarsheim, France', 'Monument religieux');

-- --------------------------------------------------------

--
-- Structure de la table `commentaires`
--

CREATE TABLE `commentaires` (
  `id` int(11) NOT NULL,
  `auteur_id` int(11) DEFAULT NULL,
  `texte` text COLLATE utf8_unicode_ci,
  `date` date DEFAULT NULL,
  `article_id` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `commentaires`
--

INSERT INTO `commentaires` (`id`, `auteur_id`, `texte`, `date`, `article_id`) VALUES
(1, 5, 'lucas : Super endroit !', '2018-06-13', 1),
(2, 5, 'lucas : j\'aime bien ! J\'y vais souvent, mais je ne savais pas son nom ! Merci :D', '2018-06-13', 5),
(3, 4, 'karl : Pas mal! Je connaissais pas !', '2018-06-13', 5),
(4, 9, 'lea : Elle est jolie! Dommage qu\'elle ne soit pas plus mise en valeur :/', '2018-06-13', 2),
(5, 9, 'lea : Ce temple est vraiment splendide ! ', '2018-06-14', 4),
(6, 9, 'lea : J\'ai toujours trouvé cette maison amusante !', '2018-06-14', 11),
(7, 9, 'lea : Des bateaux en Alsace, on aura tout vu ! ', '2018-06-14', 17),
(8, 6, 'florian : Le musée à  l\'intérieur est cool!', '2018-06-14', 1),
(9, 8, 'hamid : J\'aime bien cette tour elle est jolie !', '2018-06-14', 7),
(10, 7, 'baptiste : J\'ai toujours eu peur de cette tour étant enfant ! ', '2018-06-14', 3),
(11, 3, 'samantha : @lea moi elle me fait flipper :O !', '2018-06-14', 11);

-- --------------------------------------------------------

--
-- Structure de la table `dislikearticle`
--

CREATE TABLE `dislikearticle` (
  `id` int(11) NOT NULL,
  `article_id` int(11) DEFAULT NULL,
  `auteur_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `dislikearticle`
--

INSERT INTO `dislikearticle` (`id`, `article_id`, `auteur_id`) VALUES
(7, 1, 9),
(10, 17, 9),
(11, 3, 9),
(12, 7, 9),
(13, 12, 9),
(14, 15, 9),
(15, 16, 9);

-- --------------------------------------------------------

--
-- Structure de la table `likearticle`
--

CREATE TABLE `likearticle` (
  `id` int(11) NOT NULL,
  `article_id` int(11) DEFAULT NULL,
  `auteur_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `likearticle`
--

INSERT INTO `likearticle` (`id`, `article_id`, `auteur_id`) VALUES
(12, 1, 9),
(15, 2, 9),
(16, 11, 9),
(17, 1, 6),
(18, 14, 9);

-- --------------------------------------------------------

--
-- Structure de la table `likecom`
--

CREATE TABLE `likecom` (
  `id` int(11) NOT NULL,
  `commentaire_id` int(11) DEFAULT NULL,
  `auteur_id` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `likecom`
--

INSERT INTO `likecom` (`id`, `commentaire_id`, `auteur_id`) VALUES
(1, 1, 5),
(2, 1, 5),
(3, 1, 5),
(4, 1, 5),
(5, 2, 5),
(6, 3, 5),
(7, 5, 5);

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `contenu` text,
  `auteur_id` int(11) DEFAULT NULL,
  `destinataire_id` int(11) DEFAULT NULL,
  `date` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `messages`
--

INSERT INTO `messages` (`id`, `contenu`, `auteur_id`, `destinataire_id`, `date`) VALUES
(1, 'Salut ! \r\nJe savais pas que tu avais un compte sur ce site toi aussi ! Ca te dirais qu\'on fasse une sortie dans les jours qui viennent avec la bande, pour visiter tous ces monuments ?', 4, 5, 'June 14, 2018, 7:08 pm'),
(2, 'Hey salut ! \r\nOuais ça me dit carrément ! attend je vais prévenir les autres !\r\n', 5, 4, 'June 14, 2018, 7:09 pm'),
(3, 'Yo sam !\r\nKarl est aussi sur le site et nous propose de faire une sortie pour visiter les monuments avec le reste de la bande ça te tente? ', 5, 3, 'June 14, 2018, 7:10 pm'),
(4, 'Yo lélé ! Karl est aussi sur le site et nous propose de faire une sortie pour visiter les monuments avec le reste de la bande ça te tente?\r\n', 5, 9, 'June 14, 2018, 7:10 pm'),
(5, 'Yo flo  ! Karl est aussi sur le site et nous propose de faire une sortie pour visiter les monuments avec le reste de la bande ça te tente?', 5, 6, 'June 14, 2018, 7:11 pm'),
(6, 'Yo Baptiste ! Karl est aussi sur le site et nous propose de faire une sortie pour visiter les monuments avec le reste de la bande ça te tente?', 5, 7, 'June 14, 2018, 7:11 pm'),
(7, 'Yo Hamid  ! Karl est aussi sur le site et nous propose de faire une sortie pour visiter les monuments avec le reste de la bande ça te tente?', 5, 8, 'June 14, 2018, 7:12 pm'),
(8, 'cool ! \r\n', 4, 5, 'June 14, 2018, 7:12 pm'),
(9, 'Salut ! \r\nCette semaine je pourrais pas, j\'ai ma tante qui viens me rendre visite ^^ mais après je suis dispo !\r\n', 9, 5, 'June 14, 2018, 7:17 pm'),
(10, 'Yo ! \r\nAvec plaisir, quand ça ? ', 3, 5, 'June 14, 2018, 7:17 pm'),
(11, 'pourquoi pas! dis-moi juste quand ! ', 8, 5, 'June 14, 2018, 7:18 pm'),
(12, 'Je suis un peu malade en ce moment, je pense pas que je pourrais .. déso !', 6, 5, 'June 14, 2018, 7:19 pm'),
(13, 'Je travaille en journée, mais en soirée ça peut s\'arranger ! :D\r\n', 7, 5, 'June 14, 2018, 7:20 pm');

-- --------------------------------------------------------

--
-- Structure de la table `reclamations`
--

CREATE TABLE `reclamations` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) DEFAULT NULL,
  `prenom` varchar(255) DEFAULT NULL,
  `mail` varchar(255) DEFAULT NULL,
  `sujet` varchar(255) DEFAULT NULL,
  `message` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `reclamations`
--

INSERT INTO `reclamations` (`id`, `nom`, `prenom`, `mail`, `sujet`, `message`) VALUES
(1, 'Collot', 'Lucas', 'lucas@web-trotter.fr', 'Coucou', 'Coucou tout le monde, vivement la fin de ce projet !\r\n');

-- --------------------------------------------------------

--
-- Structure de la table `signalement`
--

CREATE TABLE `signalement` (
  `id` int(11) NOT NULL,
  `article_id` int(11) DEFAULT NULL,
  `auteur_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `signalement`
--

INSERT INTO `signalement` (`id`, `article_id`, `auteur_id`) VALUES
(5, 6, 5),
(6, 16, 5),
(7, 18, 5),
(8, 3, 9),
(10, 13, 9);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `mail` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pseudo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `photo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `groupe` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `niveau` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `name`, `mail`, `password`, `pseudo`, `date`, `photo`, `groupe`, `niveau`) VALUES
(3, 'samantha', 'samantha@web-trotter.fr', 'c5422c052bfbd7bbd9764e0467688b62193fec4fa32a1b13af28d1708d5870ec', 'samantha', '2018-06-12 09:41:56', 'samantha.png', 'membre', 0),
(4, 'karl', 'karl@web-trotter.fr', 'c31a690b528b81ac710a80d6137285dbc96d2472ce04d31f444717ac72d38183', 'karl', '2018-06-12 09:37:22', 'karl.png', 'admin', 0),
(5, 'lucas', 'lucas@web-trotter.fr', '7cadab457ad8d811f134612436daaa5e5914b20dc2502865f714035b0f267680', 'lucas', '2018-06-12 08:56:48', 'lucas.png', 'admin', 0),
(6, 'florian', 'florian@web-trotter.fr', 'b9987dcb78ee4d401fd66748ece2202d18daf9c9bb0c5974308082bd2619a8be', 'florian', '2018-06-12 09:24:01', 'florian.png', 'membre', 0),
(7, 'baptiste', 'baptiste@web-trotter.fr', '6e0035d2bef4bbdfd2832d9819260a0182ec56478e9b3e662caaeac4b80abd56', 'baptiste', '2018-06-12 10:03:15', 'baptiste.png', 'membre', 0),
(8, 'hamid', 'hamid@web-trotter.fr', 'b36ffc3cea02a265926cab0e3bb647aace65345d7999c8604b2a3067fdc6f234', 'hamid', '2018-06-12 10:30:00', 'hamid.png', 'membre', 0),
(9, 'lea', 'lea@web-trotter.fr', '020dc2295b4ca69a44356c864ff86aa3cb8026d7ce3b64db402cfaf7da4915e4', 'lea', '2018-06-12 08:21:10', 'lea.png', 'admin', 0);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `commentaires`
--
ALTER TABLE `commentaires`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `dislikearticle`
--
ALTER TABLE `dislikearticle`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `likearticle`
--
ALTER TABLE `likearticle`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `likecom`
--
ALTER TABLE `likecom`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `reclamations`
--
ALTER TABLE `reclamations`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `signalement`
--
ALTER TABLE `signalement`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT pour la table `commentaires`
--
ALTER TABLE `commentaires`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `dislikearticle`
--
ALTER TABLE `dislikearticle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pour la table `likearticle`
--
ALTER TABLE `likearticle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT pour la table `likecom`
--
ALTER TABLE `likecom`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT pour la table `reclamations`
--
ALTER TABLE `reclamations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `signalement`
--
ALTER TABLE `signalement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;