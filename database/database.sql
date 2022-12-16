-- phpMyAdmin SQL Dump

-- version 5.2.0

-- https://www.phpmyadmin.net/

--

-- Hôte : 127.0.0.1

-- Généré le : ven. 16 déc. 2022 à 23:25

-- Version du serveur : 10.4.25-MariaDB

-- Version de PHP : 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";

START TRANSACTION;

SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */

;

/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */

;

/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */

;

/*!40101 SET NAMES utf8mb4 */

;

--

-- Base de données : `gestion_factures`

--

-- --------------------------------------------------------

--

-- Structure de la table `categories`

--

CREATE TABLE
    `categories` (
        `id` int(11) NOT NULL,
        `nom` varchar(200) DEFAULT NULL,
        `created_at` datetime NOT NULL DEFAULT current_timestamp(),
        `updated_at` datetime DEFAULT NULL,
        `deleted_at` datetime DEFAULT NULL
    ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

--

-- Déchargement des données de la table `categories`

--

INSERT INTO
    `categories` (
        `id`,
        `nom`,
        `created_at`,
        `updated_at`,
        `deleted_at`
    )
VALUES (
        1,
        'téléphones',
        '2022-12-09 18:25:51',
        NULL,
        NULL
    ), (
        2,
        'pc portable',
        '2022-12-09 18:25:51',
        NULL,
        NULL
    ), (
        3,
        'tablettes',
        '2022-12-09 18:25:51',
        NULL,
        NULL
    ), (
        4,
        'montres',
        '2022-12-09 18:25:51',
        NULL,
        NULL
    ), (
        5,
        'pc bureau',
        '2022-12-09 18:25:51',
        NULL,
        NULL
    );

-- --------------------------------------------------------

--

-- Structure de la table `clients`

--

CREATE TABLE
    `clients` (
        `id` int(11) NOT NULL,
        `nom` varchar(255) DEFAULT NULL,
        `num` int(11) NOT NULL DEFAULT 0,
        `email` varchar(255) DEFAULT NULL,
        `ville` varchar(255) DEFAULT NULL,
        `adresse` varchar(255) DEFAULT NULL,
        `telephone` varchar(255) DEFAULT NULL,
        `created_at` datetime NOT NULL DEFAULT current_timestamp(),
        `updated_at` datetime DEFAULT NULL,
        `deleted_at` datetime DEFAULT NULL
    ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

--

-- Déchargement des données de la table `clients`

--

INSERT INTO
    `clients` (
        `id`,
        `nom`,
        `num`,
        `email`,
        `ville`,
        `adresse`,
        `telephone`,
        `created_at`,
        `updated_at`,
        `deleted_at`
    )
VALUES (
        1,
        'samir arsalane',
        3,
        'samir.arsalan@gmail.com',
        'tanger',
        '90 000 tanger maroc',
        '0539934455',
        '2022-12-02 18:16:58',
        NULL,
        '2022-12-02 18:56:54'
    ), (
        2,
        'driss alamie',
        20,
        'driss.alami@gmail.com',
        'rabat',
        '91 000 rabat maroc        2',
        '539935566',
        '2022-12-02 18:16:58',
        '2022-12-02 20:32:22',
        NULL
    ), (
        3,
        'Siami',
        3,
        'siami@gmail.com',
        'tanger',
        '90 000 tanger maroc',
        '0665568899',
        '2022-12-02 18:52:58',
        NULL,
        NULL
    ), (
        4,
        'Test',
        4,
        'test@gmail.com',
        'tanger',
        'Test',
        '6060606',
        '2022-12-02 19:59:49',
        NULL,
        '2022-12-02 20:01:54'
    );

-- --------------------------------------------------------

--

-- Structure de la table `commandes`

--

CREATE TABLE
    `commandes` (
        `id` int(11) NOT NULL,
        `num` int(11) DEFAULT NULL,
        `date_commande` date DEFAULT NULL,
        `client_id` int(11) DEFAULT NULL,
        `status_id` int(11) DEFAULT NULL,
        `created_at` datetime NOT NULL DEFAULT current_timestamp(),
        `updated_at` datetime DEFAULT NULL,
        `deleted_at` datetime DEFAULT NULL
    ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

--

-- Déchargement des données de la table `commandes`

--

INSERT INTO
    `commandes` (
        `id`,
        `num`,
        `date_commande`,
        `client_id`,
        `status_id`,
        `created_at`,
        `updated_at`,
        `deleted_at`
    )
VALUES (
        1,
        1,
        '2022-12-15',
        2,
        1,
        '2022-12-16 20:34:20',
        NULL,
        NULL
    ), (
        2,
        2,
        '2022-12-16',
        3,
        4,
        '2022-12-16 20:34:20',
        NULL,
        NULL
    ), (
        3,
        3,
        '2022-12-17',
        1,
        5,
        '2022-12-16 22:21:24',
        NULL,
        NULL
    );

-- --------------------------------------------------------

--

-- Doublure de structure pour la vue `commandes_view`

-- (Voir ci-dessous la vue réelle)

--

CREATE TABLE
    `commandes_view` (
        `id` int(11),
        `num` int(11),
        `date_commande` date,
        `client_id` int(11),
        `status_id` int(11),
        `created_at` datetime,
        `updated_at` datetime,
        `deleted_at` datetime,
        `commande_num` varchar(7),
        `date_commande_format` varchar(10),
        `client_num` int(11),
        `client_nom` varchar(255),
        `client_email` varchar(255),
        `client_ville` varchar(255),
        `client_adresse` varchar(255),
        `status_nom` varchar(200),
        `status_color` varchar(30)
    );

-- --------------------------------------------------------

--

-- Structure de la table `couleurs`

--

CREATE TABLE
    `couleurs` (
        `id` int(11) NOT NULL,
        `nom` varchar(200) DEFAULT NULL,
        `created_at` datetime NOT NULL DEFAULT current_timestamp(),
        `updated_at` datetime DEFAULT NULL,
        `deleted_at` datetime DEFAULT NULL
    ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

--

-- Déchargement des données de la table `couleurs`

--

INSERT INTO
    `couleurs` (
        `id`,
        `nom`,
        `created_at`,
        `updated_at`,
        `deleted_at`
    )
VALUES (
        1,
        'blue',
        '2022-12-09 18:23:30',
        NULL,
        NULL
    ), (
        2,
        'yellow',
        '2022-12-09 18:23:30',
        NULL,
        NULL
    ), (
        3,
        'red',
        '2022-12-09 18:23:30',
        NULL,
        NULL
    ), (
        5,
        'gray',
        '2022-12-09 18:23:30',
        NULL,
        NULL
    ), (
        101,
        'green',
        '2022-12-13 22:09:11',
        NULL,
        NULL
    ), (
        102,
        'Orange',
        '2022-12-13 22:09:11',
        NULL,
        NULL
    ), (
        103,
        'Pink',
        '2022-12-13 22:09:11',
        NULL,
        NULL
    );

-- --------------------------------------------------------

--

-- Structure de la table `produits`

--

CREATE TABLE
    `produits` (
        `id` int(11) NOT NULL,
        `image` varchar(255) DEFAULT NULL,
        `reference` varchar(200) DEFAULT NULL,
        `designation` varchar(200) DEFAULT NULL,
        `prix` int(11) DEFAULT 0,
        `categorie_id` int(11) DEFAULT NULL,
        `couleur_id` int(11) DEFAULT NULL,
        `created_at` datetime NOT NULL DEFAULT current_timestamp(),
        `updated_at` datetime DEFAULT NULL,
        `deleted_at` datetime DEFAULT NULL
    ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

--

-- Déchargement des données de la table `produits`

--

INSERT INTO
    `produits` (
        `id`,
        `image`,
        `reference`,
        `designation`,
        `prix`,
        `categorie_id`,
        `couleur_id`,
        `created_at`,
        `updated_at`,
        `deleted_at`
    )
VALUES (
        1,
        '1.jpg',
        'r-99',
        'iphone pro max 255 ssd',
        1300000,
        1,
        1,
        '2022-12-09 18:35:22',
        NULL,
        NULL
    ), (
        2,
        '2.jpg',
        'r-300',
        'iphone pro max 512 ssd',
        1300000,
        1,
        2,
        '2022-12-09 18:35:22',
        NULL,
        NULL
    ), (
        3,
        '3.jpg',
        'r-3',
        'macbook m2 1 to ssd',
        3000000,
        2,
        1,
        '2022-12-09 18:35:22',
        NULL,
        NULL
    ), (
        5,
        '4.jpg',
        'R-4',
        'Imac gray',
        2400000,
        5,
        5,
        '2022-12-09 18:35:22',
        '2022-12-09 18:35:26',
        NULL
    ), (
        6,
        '5.jpg',
        'R-6',
        'Rwatch 250',
        800000,
        4,
        2,
        '2022-12-09 22:10:28',
        NULL,
        NULL
    ), (
        7,
        '6.jpg',
        'r-7',
        'Imac 24 pouce Yellow',
        2400000,
        5,
        2,
        '2022-12-13 23:22:38',
        NULL,
        NULL
    ), (
        8,
        '7.jpg',
        'r-8',
        'Imac 24 pouce Green',
        2400000,
        5,
        101,
        '2022-12-13 23:26:59',
        NULL,
        NULL
    );

-- --------------------------------------------------------

--

-- Doublure de structure pour la vue `produits_view`

-- (Voir ci-dessous la vue réelle)

--

CREATE TABLE
    `produits_view` (
        `id` int(11),
        `image` varchar(255),
        `reference` varchar(200),
        `designation` varchar(200),
        `prix` int(11),
        `categorie_id` int(11),
        `couleur_id` int(11),
        `created_at` datetime,
        `updated_at` datetime,
        `deleted_at` datetime,
        `prix_decimale` varchar(18),
        `categorie_nom` varchar(200),
        `couleur_nom` varchar(200)
    );

-- --------------------------------------------------------

--

-- Structure de la table `status`

--

CREATE TABLE
    `status` (
        `id` int(11) NOT NULL,
        `nom` varchar(200) DEFAULT NULL,
        `color` varchar(30) DEFAULT NULL,
        `created_at` datetime NOT NULL DEFAULT current_timestamp(),
        `updated_at` datetime DEFAULT NULL,
        `deleted_at` datetime DEFAULT NULL
    ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

--

-- Déchargement des données de la table `status`

--

INSERT INTO
    `status` (
        `id`,
        `nom`,
        `color`,
        `created_at`,
        `updated_at`,
        `deleted_at`
    )
VALUES (
        1,
        'en attente',
        'secondary',
        '2022-12-16 20:29:56',
        NULL,
        NULL
    ), (
        2,
        'en cours',
        'info',
        '2022-12-16 20:29:56',
        NULL,
        NULL
    ), (
        3,
        'livré',
        'success',
        '2022-12-16 20:29:56',
        NULL,
        NULL
    ), (
        4,
        'annuler',
        'danger',
        '2022-12-16 20:29:56',
        NULL,
        NULL
    ), (
        5,
        'retour',
        'warning',
        '2022-12-16 20:29:56',
        NULL,
        NULL
    );

-- --------------------------------------------------------

--

-- Structure de la vue `commandes_view`

--

DROP TABLE IF EXISTS `commandes_view`;

CREATE ALGORITHM = UNDEFINED DEFINER = `root` @`localhost` SQL SECURITY DEFINER VIEW `commandes_view` AS
SELECT
    `c`.`id` AS `id`,
    `c`.`num` AS `num`,
    `c`.`date_commande` AS `date_commande`,
    `c`.`client_id` AS `client_id`,
    `c`.`status_id` AS `status_id`,
    `c`.`created_at` AS `created_at`,
    `c`.`updated_at` AS `updated_at`,
    `c`.`deleted_at` AS `deleted_at`,
    concat('BC-', lpad(`c`.`num`, 4, 0)) AS `commande_num`,
    date_format(
        `c`.`date_commande`,
        '%d/%m/%Y'
    ) AS `date_commande_format`,
    `cl`.`num` AS `client_num`,
    lcase(`cl`.`nom`) AS `client_nom`,
    lcase(`cl`.`email`) AS `client_email`,
    lcase(`cl`.`ville`) AS `client_ville`,
    lcase(`cl`.`adresse`) AS `client_adresse`,
    lcase(`s`.`nom`) AS `status_nom`,
    lcase(`s`.`color`) AS `status_color`
FROM ( (
            `commandes` `c`
            join `clients` `cl` on(`cl`.`id` = `c`.`client_id`)
        )
        join `status` `s` on(`s`.`id` = `c`.`status_id`)
    )
WHERE
    `c`.`deleted_at` is nullnull;

-- --------------------------------------------------------

--

-- Structure de la vue `produits_view`

--

DROP TABLE IF EXISTS `produits_view`;

CREATE ALGORITHM = UNDEFINED DEFINER = `root` @`localhost` SQL SECURITY DEFINER VIEW `produits_view` AS
SELECT
    `p`.`id` AS `id`,
    `p`.`image` AS `image`,
    `p`.`reference` AS `reference`,
    `p`.`designation` AS `designation`,
    `p`.`prix` AS `prix`,
    `p`.`categorie_id` AS `categorie_id`,
    `p`.`couleur_id` AS `couleur_id`,
    `p`.`created_at` AS `created_at`,
    `p`.`updated_at` AS `updated_at`,
    `p`.`deleted_at` AS `deleted_at`,
    format(`p`.`prix` / 100, 2) AS `prix_decimale`,
    `c`.`nom` AS `categorie_nom`,
    `cl`.`nom` AS `couleur_nom`
FROM ( (
            `produits` `p`
            join `categories` `c` on(`c`.`id` = `p`.`categorie_id`)
        )
        join `couleurs` `cl` on(`cl`.`id` = `p`.`couleur_id`)
    )
WHERE `p`.`deleted_at` is null
ORDER BY `p`.`id` ASC;

--

-- Index pour les tables déchargées

--

--

-- Index pour la table `categories`

--

ALTER TABLE `categories` ADD PRIMARY KEY (`id`);

--

-- Index pour la table `clients`

--

ALTER TABLE `clients` ADD PRIMARY KEY (`id`);

--

-- Index pour la table `commandes`

--

ALTER TABLE `commandes`
ADD PRIMARY KEY (`id`),
ADD
    KEY `client_id` (`client_id`),
ADD
    KEY `status_id` (`status_id`);

--

-- Index pour la table `couleurs`

--

ALTER TABLE `couleurs` ADD PRIMARY KEY (`id`);

--

-- Index pour la table `produits`

--

ALTER TABLE `produits`
ADD PRIMARY KEY (`id`),
ADD
    KEY `categorie_id` (`categorie_id`),
ADD
    KEY `produits_ibfk_2` (`couleur_id`);

--

-- Index pour la table `status`

--

ALTER TABLE `status` ADD PRIMARY KEY (`id`);

--

-- AUTO_INCREMENT pour les tables déchargées

--

--

-- AUTO_INCREMENT pour la table `categories`

--

ALTER TABLE
    `categories` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 6;

--

-- AUTO_INCREMENT pour la table `clients`

--

ALTER TABLE
    `clients` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 5;

--

-- AUTO_INCREMENT pour la table `commandes`

--

ALTER TABLE
    `commandes` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 4;

--

-- AUTO_INCREMENT pour la table `couleurs`

--

ALTER TABLE
    `couleurs` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 104;

--

-- AUTO_INCREMENT pour la table `produits`

--

ALTER TABLE
    `produits` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 9;

--

-- AUTO_INCREMENT pour la table `status`

--

ALTER TABLE
    `status` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 6;

--

-- Contraintes pour les tables déchargées

--

--

-- Contraintes pour la table `commandes`

--

ALTER TABLE `commandes`
ADD
    CONSTRAINT `commandes_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON UPDATE CASCADE,
ADD
    CONSTRAINT `commandes_ibfk_2` FOREIGN KEY (`status_id`) REFERENCES `status` (`id`) ON UPDATE CASCADE;

--

-- Contraintes pour la table `produits`

--

ALTER TABLE `produits`
ADD
    CONSTRAINT `produits_ibfk_1` FOREIGN KEY (`categorie_id`) REFERENCES `categories` (`id`) ON UPDATE CASCADE,
ADD
    CONSTRAINT `produits_ibfk_2` FOREIGN KEY (`couleur_id`) REFERENCES `couleurs` (`id`) ON UPDATE CASCADE;

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */

;

/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */

;

/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */

;