-- phpMyAdmin SQL Dump

-- version 5.2.0

-- https://www.phpmyadmin.net/

--

-- Hôte : 127.0.0.1

-- Généré le : jeu. 01 juin 2023 à 00:44

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
        `icon` varchar(50) DEFAULT NULL,
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
        `icon`,
        `created_at`,
        `updated_at`,
        `deleted_at`
    )
VALUES (
        1,
        'téléphones',
        'phone',
        '2022-12-09 18:25:51',
        NULL,
        NULL
    ), (
        2,
        'pc portable',
        'laptop',
        '2022-12-09 18:25:51',
        NULL,
        NULL
    ), (
        3,
        'tabléttes',
        'tablet',
        '2022-12-09 18:25:51',
        NULL,
        NULL
    ), (
        4,
        'montres',
        'smartwatch',
        '2022-12-09 18:25:51',
        NULL,
        NULL
    ), (
        5,
        'pc bureau',
        'pc-display',
        '2022-12-09 18:25:51',
        NULL,
        NULL
    ), (
        6,
        'Test',
        NULL,
        '2023-04-03 22:46:14',
        NULL,
        '2023-04-03 22:46:22'
    );

-- --------------------------------------------------------

--

-- Structure de la table `clients`

--

CREATE TABLE
    `clients` (
        `id` int(11) NOT NULL,
        `prenom` varchar(100) DEFAULT NULL,
        `nom` varchar(255) DEFAULT NULL,
        `num` int(11) NOT NULL DEFAULT 0,
        `ville` varchar(255) DEFAULT NULL,
        `adresse` varchar(255) DEFAULT NULL,
        `telephone` varchar(255) DEFAULT NULL,
        `email` varchar(150) DEFAULT NULL,
        `password` varchar(250) DEFAULT NULL,
        `role` varchar(50) DEFAULT NULL,
        `created_at` datetime NOT NULL DEFAULT current_timestamp(),
        `updated_at` datetime DEFAULT NULL,
        `deleted_at` datetime DEFAULT NULL,
        `user_id` int(11) DEFAULT NULL
    ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

--

-- Déchargement des données de la table `clients`

--

INSERT INTO
    `clients` (
        `id`,
        `prenom`,
        `nom`,
        `num`,
        `ville`,
        `adresse`,
        `telephone`,
        `email`,
        `password`,
        `role`,
        `created_at`,
        `updated_at`,
        `deleted_at`,
        `user_id`
    )
VALUES (
        3,
        'nabila',
        'ahmadouch',
        1,
        NULL,
        NULL,
        NULL,
        'nabila@gmail.com',
        '$2y$10$DIWlogHQJvu1mVNDk1d4W.N0KBet3KWktEQYBSimjMJ5oSNVL809G',
        'ADMIN',
        '2023-05-22 22:51:57',
        '2023-05-22 22:51:57',
        NULL,
        3
    ), (
        4,
        'youssra',
        'afnigher',
        2,
        '',
        '',
        '0',
        'youssra@gmail.com',
        '$2y$10$zyRkzEmUCsGlw0LoiilKt.35GOHhfQr.nlVJpER3hOc4YVLjggJNy',
        'USER',
        '2023-05-22 22:53:44',
        '2023-05-31 23:29:49',
        NULL,
        4
    ), (
        5,
        'hind',
        'oulad hadj chaib',
        3,
        'tanger',
        'Tanger maroc',
        '06060606',
        'hind@gmail.com',
        NULL,
        'USER',
        '2023-05-31 23:31:56',
        NULL,
        NULL,
        NULL
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
        `coupon_id` int(11) DEFAULT NULL,
        `created_at` datetime NOT NULL DEFAULT current_timestamp(),
        `updated_at` datetime DEFAULT NULL,
        `deleted_at` datetime DEFAULT NULL
    ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

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
        `coupon_id` int(11),
        `created_at` datetime,
        `updated_at` datetime,
        `deleted_at` datetime,
        `commande_num` varchar(7),
        `date_commande_format` varchar(10),
        `client_num` int(11),
        `client_nom` varchar(255),
        `client_email` varchar(150),
        `client_ville` varchar(255),
        `client_adresse` varchar(255),
        `status_nom` varchar(200),
        `status_color` varchar(30),
        `coupon_code` varchar(100),
        `coupon_montant` decimal(10, 2),
        `coupon_active` int(4)
    );

-- --------------------------------------------------------

--

-- Structure de la table `commande_produit`

--

CREATE TABLE
    `commande_produit` (
        `id` int(11) NOT NULL,
        `commande_id` int(11) DEFAULT NULL,
        `produit_id` int(11) DEFAULT NULL,
        `quantite` int(11) NOT NULL DEFAULT 1,
        `created_at` datetime NOT NULL DEFAULT current_timestamp(),
        `updated_at` datetime DEFAULT NULL,
        `deleted_at` datetime DEFAULT NULL
    ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

-- --------------------------------------------------------

--

-- Doublure de structure pour la vue `commande_produits_view`

-- (Voir ci-dessous la vue réelle)

--

CREATE TABLE
    `commande_produits_view` (
        `id` int(11),
        `produit_id` int(11),
        `image` varchar(255),
        `reference` varchar(200),
        `designation` varchar(200),
        `prix` int(11),
        `prix_decimale` varchar(18),
        `categorie_nom` varchar(200),
        `couleur_nom` varchar(200),
        `quantite` int(11),
        `prix_total` varchar(32),
        `commande_id` int(11)
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
        4,
        'gray',
        '2022-12-09 18:23:30',
        NULL,
        NULL
    ), (
        5,
        'green',
        '2022-12-13 22:09:11',
        NULL,
        NULL
    ), (
        6,
        'orange',
        '2022-12-13 22:09:11',
        NULL,
        NULL
    ), (
        7,
        'pink',
        '2022-12-13 22:09:11',
        NULL,
        NULL
    ), (
        8,
        'purple',
        '2022-12-23 19:37:28',
        NULL,
        NULL
    ), (
        9,
        'black',
        '2023-04-03 22:46:51',
        NULL,
        NULL
    ), (
        10,
        'magenta',
        '2023-04-11 00:15:45',
        NULL,
        NULL
    ), (
        11,
        'cyan',
        '2023-04-11 00:20:06',
        NULL,
        NULL
    );

-- --------------------------------------------------------

--

-- Structure de la table `coupons`

--

CREATE TABLE
    `coupons` (
        `id` int(11) NOT NULL,
        `code` varchar(100) DEFAULT NULL,
        `montant` decimal(10, 2) NOT NULL DEFAULT 0.00,
        `status` tinyint(1) NOT NULL DEFAULT 0,
        `created_at` datetime NOT NULL DEFAULT current_timestamp(),
        `updated_at` datetime DEFAULT NULL,
        `deleted_at` datetime DEFAULT NULL
    ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

--

-- Déchargement des données de la table `coupons`

--

INSERT INTO
    `coupons` (
        `id`,
        `code`,
        `montant`,
        `status`,
        `created_at`,
        `updated_at`,
        `deleted_at`
    )
VALUES (
        1,
        'ramadan',
        '300.00',
        1,
        '2023-02-27 23:26:23',
        '2023-02-27 23:36:42',
        NULL
    ), (
        2,
        'hind',
        '350.00',
        0,
        '2023-02-27 23:28:58',
        '2023-02-27 23:36:06',
        NULL
    ), (
        3,
        'test',
        '100.00',
        1,
        '2023-02-27 23:47:27',
        '2023-02-27 23:47:39',
        '2023-02-27 23:47:43'
    ), (
        4,
        'blackfriday2023',
        '500.00',
        1,
        '2023-03-01 23:50:01',
        NULL,
        NULL
    ), (
        5,
        'new',
        '100.00',
        1,
        '2023-03-09 02:01:50',
        '2023-03-09 02:02:04',
        NULL
    ), (
        6,
        'new 2',
        '50.00',
        0,
        '2023-03-09 02:02:22',
        NULL,
        NULL
    );

-- --------------------------------------------------------

--

-- Structure de la table `paniers`

--

CREATE TABLE
    `paniers` (
        `id` int(11) NOT NULL,
        `ip_adresse` varchar(100) DEFAULT NULL,
        `user_id` int(11) DEFAULT NULL,
        `date_panier` datetime DEFAULT current_timestamp()
    ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

--

-- Déchargement des données de la table `paniers`

--

INSERT INTO
    `paniers` (
        `id`,
        `ip_adresse`,
        `user_id`,
        `date_panier`
    )
VALUES (
        1,
        NULL,
        4,
        '2023-05-22 23:51:54'
    ), (
        2,
        '::1',
        NULL,
        '2023-05-22 23:52:49'
    );

-- --------------------------------------------------------

--

-- Structure de la table `panier_produit`

--

CREATE TABLE
    `panier_produit` (
        `id` int(11) NOT NULL,
        `panier_id` int(11) DEFAULT NULL,
        `produit_id` int(11) DEFAULT NULL,
        `qt` int(11) NOT NULL DEFAULT 1
    ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

--

-- Déchargement des données de la table `panier_produit`

--

INSERT INTO
    `panier_produit` (
        `id`,
        `panier_id`,
        `produit_id`,
        `qt`
    )
VALUES (1, 1, 8, 1), (2, 2, 6, 1), (3, 1, 11, 1), (4, 2, 7, 1), (5, 1, 3, 1);

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
        '8.jpg',
        'r-102',
        'iphone pro max 255 ssd',
        1300000,
        1,
        8,
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
        5,
        1,
        '2022-12-09 18:35:22',
        '2022-12-30 19:44:01',
        NULL
    ), (
        5,
        '4.jpg',
        'R-4',
        'Imac gray',
        2400000,
        5,
        4,
        '2022-12-09 18:35:22',
        '2022-12-09 18:35:26',
        NULL
    ), (
        6,
        '5.jpg',
        'R-6',
        'Rwatch 250',
        2400000,
        5,
        2,
        '2022-12-09 22:10:28',
        '2022-12-30 19:44:24',
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
        5,
        '2022-12-13 23:26:59',
        NULL,
        NULL
    ), (
        9,
        '8.jpg',
        'r-40',
        'Iphone Pro max',
        20000,
        2,
        8,
        '2023-01-09 23:45:58',
        '2023-03-09 02:00:27',
        NULL
    ), (
        10,
        '8.jpg',
        'R-10',
        'Iphone 14 Pro Max',
        10000,
        1,
        1,
        '2023-01-09 23:48:46',
        '2023-03-09 01:59:55',
        NULL
    ), (
        11,
        '11084-onYLBqQz.jpg',
        'R-11',
        'Apple AirPods (2ᵉ g&eacute;n&eacute;ration)',
        168900,
        4,
        4,
        '2023-01-23 23:48:06',
        NULL,
        NULL
    ), (
        12,
        '',
        '',
        '',
        0,
        1,
        1,
        '2023-04-03 22:47:38',
        NULL,
        '2023-04-03 22:47:46'
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

-- Structure de la table `produit_wishlist`

--

CREATE TABLE
    `produit_wishlist` (
        `id` int(11) NOT NULL,
        `produit_id` int(11) DEFAULT NULL,
        `wishlist_id` int(11) DEFAULT NULL,
        `created_at` datetime NOT NULL DEFAULT current_timestamp(),
        `deleted_at` datetime DEFAULT NULL
    ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

--

-- Déchargement des données de la table `produit_wishlist`

--

INSERT INTO
    `produit_wishlist` (
        `id`,
        `produit_id`,
        `wishlist_id`,
        `created_at`,
        `deleted_at`
    )
VALUES (
        1,
        5,
        1,
        '2023-05-04 00:28:22',
        '2023-05-04 00:32:15'
    ), (
        2,
        5,
        1,
        '2023-05-04 00:30:40',
        '2023-05-04 00:32:15'
    ), (
        3,
        5,
        1,
        '2023-05-04 00:31:38',
        '2023-05-04 00:32:15'
    ), (
        4,
        3,
        1,
        '2023-05-04 00:34:12',
        '2023-05-04 00:34:26'
    ), (
        6,
        7,
        1,
        '2023-05-08 22:27:04',
        NULL
    ), (
        7,
        7,
        56,
        '2023-05-08 22:48:36',
        NULL
    ), (
        8,
        8,
        1,
        '2023-05-08 23:27:27',
        '2023-05-08 23:28:44'
    ), (
        9,
        11,
        56,
        '2023-05-08 23:28:05',
        '2023-05-19 23:41:13'
    ), (
        10,
        2,
        56,
        '2023-05-19 23:36:40',
        NULL
    ), (
        11,
        11,
        56,
        '2023-05-19 23:41:15',
        NULL
    ), (
        12,
        3,
        56,
        '2023-05-20 03:50:56',
        NULL
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

-- Structure de la table `wishlists`

--

CREATE TABLE
    `wishlists` (
        `id` int(11) NOT NULL,
        `ip_adresse` varchar(50) DEFAULT NULL,
        `created_at` datetime NOT NULL DEFAULT current_timestamp(),
        `deleted_at` datetime DEFAULT NULL
    ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

--

-- Déchargement des données de la table `wishlists`

--

INSERT INTO
    `wishlists` (
        `id`,
        `ip_adresse`,
        `created_at`,
        `deleted_at`
    )
VALUES (
        1,
        '127.0.0.1',
        '2023-05-04 00:23:04',
        NULL
    ), (
        56,
        '::1',
        '2023-05-08 22:48:36',
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
    `c`.`coupon_id` AS `coupon_id`,
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
    lcase(`s`.`color`) AS `status_color`,
    ifnull(`cp`.`code`, '') AS `coupon_code`,
    ifnull(`cp`.`montant`, 0) AS `coupon_montant`,
    ifnull(`cp`.`status`, 0) AS `coupon_active`
FROM ( ( (
                `commandes` `c`
                left join `clients` `cl` on(`cl`.`id` = `c`.`client_id`)
            )
            left join `status` `s` on(`s`.`id` = `c`.`status_id`)
        )
        left join `coupons` `cp` on(`cp`.`id` = `c`.`coupon_id`)
    )
WHERE
    `c`.`deleted_at` is nullnull;

-- --------------------------------------------------------

--

-- Structure de la vue `commande_produits_view`

--

DROP TABLE IF EXISTS `commande_produits_view`;

CREATE ALGORITHM = UNDEFINED DEFINER = `root` @`localhost` SQL SECURITY DEFINER VIEW `commande_produits_view` AS
SELECT
    `cp`.`id` AS `id`,
    `pv`.`id` AS `produit_id`,
    `pv`.`image` AS `image`,
    `pv`.`reference` AS `reference`,
    `pv`.`designation` AS `designation`,
    `pv`.`prix` AS `prix`,
    `pv`.`prix_decimale` AS `prix_decimale`,
    `pv`.`categorie_nom` AS `categorie_nom`,
    `pv`.`couleur_nom` AS `couleur_nom`,
    `cp`.`quantite` AS `quantite`,
    format(
        `pv`.`prix` / 100 * `cp`.`quantite`,
        2
    ) AS `prix_total`,
    `cp`.`commande_id` AS `commande_id`
FROM (
        `commande_produit` `cp`
        left join `produits_view` `pv` on(`pv`.`id` = `cp`.`produit_id`)
    );

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

ALTER TABLE `clients`
ADD PRIMARY KEY (`id`),
ADD KEY `user_id` (`user_id`);

--

-- Index pour la table `commandes`

--

ALTER TABLE `commandes`
ADD PRIMARY KEY (`id`),
ADD
    KEY `client_id` (`client_id`),
ADD
    KEY `status_id` (`status_id`),
ADD
    KEY `coupon_id` (`coupon_id`);

--

-- Index pour la table `commande_produit`

--

ALTER TABLE `commande_produit`
ADD PRIMARY KEY (`id`),
ADD
    KEY `commande_id` (`commande_id`),
ADD
    KEY `produit_id` (`produit_id`);

--

-- Index pour la table `couleurs`

--

ALTER TABLE `couleurs` ADD PRIMARY KEY (`id`);

--

-- Index pour la table `coupons`

--

ALTER TABLE `coupons` ADD PRIMARY KEY (`id`);

--

-- Index pour la table `paniers`

--

ALTER TABLE `paniers`
ADD PRIMARY KEY (`id`),
ADD KEY `user_id` (`user_id`);

--

-- Index pour la table `panier_produit`

--

ALTER TABLE `panier_produit`
ADD PRIMARY KEY (`id`),
ADD
    KEY `produit_id` (`produit_id`),
ADD
    KEY `panier_id` (`panier_id`);

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

-- Index pour la table `produit_wishlist`

--

ALTER TABLE `produit_wishlist`
ADD PRIMARY KEY (`id`),
ADD
    KEY `produit_id` (`produit_id`),
ADD
    KEY `wishlist_id` (`wishlist_id`);

--

-- Index pour la table `status`

--

ALTER TABLE `status` ADD PRIMARY KEY (`id`);

--

-- Index pour la table `wishlists`

--

ALTER TABLE `wishlists` ADD PRIMARY KEY (`id`);

--

-- AUTO_INCREMENT pour les tables déchargées

--

--

-- AUTO_INCREMENT pour la table `categories`

--

ALTER TABLE
    `categories` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 7;

--

-- AUTO_INCREMENT pour la table `clients`

--

ALTER TABLE
    `clients` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 6;

--

-- AUTO_INCREMENT pour la table `commandes`

--

ALTER TABLE
    `commandes` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--

-- AUTO_INCREMENT pour la table `commande_produit`

--

ALTER TABLE
    `commande_produit` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--

-- AUTO_INCREMENT pour la table `couleurs`

--

ALTER TABLE
    `couleurs` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 12;

--

-- AUTO_INCREMENT pour la table `coupons`

--

ALTER TABLE
    `coupons` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 7;

--

-- AUTO_INCREMENT pour la table `paniers`

--

ALTER TABLE
    `paniers` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 3;

--

-- AUTO_INCREMENT pour la table `panier_produit`

--

ALTER TABLE
    `panier_produit` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 6;

--

-- AUTO_INCREMENT pour la table `produits`

--

ALTER TABLE
    `produits` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 13;

--

-- AUTO_INCREMENT pour la table `produit_wishlist`

--

ALTER TABLE
    `produit_wishlist` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 13;

--

-- AUTO_INCREMENT pour la table `status`

--

ALTER TABLE
    `status` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 6;

--

-- AUTO_INCREMENT pour la table `wishlists`

--

ALTER TABLE
    `wishlists` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 57;

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
    CONSTRAINT `commandes_ibfk_2` FOREIGN KEY (`status_id`) REFERENCES `status` (`id`) ON UPDATE CASCADE,
ADD
    CONSTRAINT `commandes_ibfk_3` FOREIGN KEY (`coupon_id`) REFERENCES `coupons` (`id`) ON UPDATE CASCADE;

--

-- Contraintes pour la table `commande_produit`

--

ALTER TABLE `commande_produit`
ADD
    CONSTRAINT `commande_produit_ibfk_1` FOREIGN KEY (`commande_id`) REFERENCES `commandes` (`id`) ON UPDATE CASCADE,
ADD
    CONSTRAINT `commande_produit_ibfk_2` FOREIGN KEY (`produit_id`) REFERENCES `produits` (`id`) ON UPDATE CASCADE;

--

-- Contraintes pour la table `paniers`

--

ALTER TABLE `paniers`
ADD
    CONSTRAINT `paniers_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--

-- Contraintes pour la table `panier_produit`

--

ALTER TABLE `panier_produit`
ADD
    CONSTRAINT `panier_produit_ibfk_1` FOREIGN KEY (`panier_id`) REFERENCES `paniers` (`id`) ON UPDATE CASCADE,
ADD
    CONSTRAINT `panier_produit_ibfk_2` FOREIGN KEY (`produit_id`) REFERENCES `produits` (`id`) ON UPDATE CASCADE;

--

-- Contraintes pour la table `produits`

--

ALTER TABLE `produits`
ADD
    CONSTRAINT `produits_ibfk_1` FOREIGN KEY (`categorie_id`) REFERENCES `categories` (`id`) ON UPDATE CASCADE,
ADD
    CONSTRAINT `produits_ibfk_2` FOREIGN KEY (`couleur_id`) REFERENCES `couleurs` (`id`) ON UPDATE CASCADE;

--

-- Contraintes pour la table `produit_wishlist`

--

ALTER TABLE `produit_wishlist`
ADD
    CONSTRAINT `produit_wishlist_ibfk_1` FOREIGN KEY (`produit_id`) REFERENCES `produits` (`id`) ON UPDATE CASCADE,
ADD
    CONSTRAINT `produit_wishlist_ibfk_2` FOREIGN KEY (`wishlist_id`) REFERENCES `wishlists` (`id`) ON UPDATE CASCADE;

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */

;

/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */

;

/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */

;