-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 30 déc. 2022 à 21:38
-- Version du serveur : 10.4.25-MariaDB
-- Version de PHP : 7.4.30
SET
    SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";

START TRANSACTION;

SET
    time_zone = "+00:00";

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
CREATE TABLE `categories` (
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
VALUES
    (
        1,
        'téléphones',
        '2022-12-09 18:25:51',
        NULL,
        NULL
    ),
    (
        2,
        'pc portable',
        '2022-12-09 18:25:51',
        NULL,
        NULL
    ),
    (
        3,
        'tablettes',
        '2022-12-09 18:25:51',
        NULL,
        NULL
    ),
    (
        4,
        'montres',
        '2022-12-09 18:25:51',
        NULL,
        NULL
    ),
    (
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
CREATE TABLE `clients` (
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
VALUES
    (
        1,
        'samir arsalane',
        3,
        'samir.arsalan@gmail.com',
        'tanger',
        '90 000 tanger maroc',
        '0539934455',
        '2022-12-02 18:16:58',
        NULL,
        NULL
    ),
    (
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
    ),
    (
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
    ),
    (
        4,
        'Test',
        4,
        'test@gmail.com',
        'tanger',
        'Test',
        '6060606',
        '2022-12-02 19:59:49',
        NULL,
        NULL
    ),
    (
        5,
        'Bouchra Abouhrate',
        3,
        'bouchra@gmail.com',
        'asila',
        'Asila',
        '0680608060',
        '2022-12-26 22:41:09',
        NULL,
        NULL
    ),
    (
        6,
        'Hicham Douzi',
        6,
        'hicham@gmail.com',
        'Rabat',
        'Rabat Maroc',
        '064543578',
        '2022-12-26 22:41:46',
        NULL,
        NULL
    ),
    (
        7,
        'Hind',
        7,
        'hind@gmail.com',
        'tanger',
        'Tanger 90000',
        '06060606',
        '2022-12-30 20:13:46',
        NULL,
        NULL
    );

-- --------------------------------------------------------
--
-- Structure de la table `commandes`
--
CREATE TABLE `commandes` (
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
VALUES
    (
        1,
        1,
        '2022-12-15',
        2,
        4,
        '2022-12-16 20:34:20',
        NULL,
        NULL
    ),
    (
        2,
        2,
        '2022-12-16',
        4,
        4,
        '2022-12-16 20:34:20',
        NULL,
        NULL
    ),
    (
        3,
        3,
        '2022-12-17',
        1,
        5,
        '2022-12-16 22:21:24',
        NULL,
        NULL
    ),
    (
        4,
        4,
        '2022-12-23',
        3,
        4,
        '2022-12-23 20:09:12',
        NULL,
        NULL
    ),
    (
        5,
        5,
        '2022-12-26',
        5,
        1,
        '2022-12-26 22:42:16',
        NULL,
        NULL
    ),
    (
        6,
        6,
        '2022-12-30',
        3,
        3,
        '2022-12-30 19:45:51',
        NULL,
        NULL
    );

-- --------------------------------------------------------
-- --------------------------------------------------------
--
-- Structure de la table `commande_produit`
--
CREATE TABLE `commande_produit` (
    `id` int(11) NOT NULL,
    `commande_id` int(11) DEFAULT NULL,
    `produit_id` int(11) DEFAULT NULL,
    `quantite` int(11) NOT NULL DEFAULT 1,
    `created_at` datetime NOT NULL DEFAULT current_timestamp(),
    `updated_at` datetime DEFAULT NULL,
    `deleted_at` datetime DEFAULT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

--
-- Déchargement des données de la table `commande_produit`
--
INSERT INTO
    `commande_produit` (
        `id`,
        `commande_id`,
        `produit_id`,
        `quantite`,
        `created_at`,
        `updated_at`,
        `deleted_at`
    )
VALUES
    (
        1,
        4,
        1,
        2,
        '2022-12-23 20:50:03',
        NULL,
        NULL
    ),
    (
        2,
        4,
        2,
        3,
        '2022-12-23 20:50:19',
        NULL,
        NULL
    ),
    (
        3,
        4,
        3,
        3,
        '2022-12-23 21:22:17',
        NULL,
        NULL
    ),
    (
        4,
        4,
        5,
        1,
        '2022-12-26 23:16:48',
        NULL,
        NULL
    ),
    (
        7,
        4,
        8,
        6,
        '2022-12-26 23:44:52',
        NULL,
        NULL
    ),
    (
        8,
        5,
        8,
        4,
        '2022-12-26 23:50:40',
        NULL,
        NULL
    ),
    (
        9,
        3,
        5,
        1,
        '2022-12-26 23:58:52',
        NULL,
        NULL
    ),
    (
        10,
        3,
        7,
        1,
        '2022-12-26 23:59:03',
        NULL,
        NULL
    ),
    (
        11,
        5,
        7,
        2,
        '2022-12-30 18:52:33',
        NULL,
        NULL
    ),
    (
        12,
        1,
        8,
        2,
        '2022-12-30 21:23:00',
        NULL,
        NULL
    ),
    (
        13,
        1,
        7,
        2,
        '2022-12-30 21:23:51',
        NULL,
        NULL
    );

-- --------------------------------------------------------
--
-- Doublure de structure pour la vue `commande_produits_view`
-- (Voir ci-dessous la vue réelle)
--
-- --------------------------------------------------------
--
-- Structure de la table `couleurs`
--
CREATE TABLE `couleurs` (
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
VALUES
    (
        1,
        'blue',
        '2022-12-09 18:23:30',
        NULL,
        NULL
    ),
    (
        2,
        'yellow',
        '2022-12-09 18:23:30',
        NULL,
        NULL
    ),
    (
        3,
        'red',
        '2022-12-09 18:23:30',
        NULL,
        NULL
    ),
    (
        5,
        'gray',
        '2022-12-09 18:23:30',
        NULL,
        NULL
    ),
    (
        101,
        'green',
        '2022-12-13 22:09:11',
        NULL,
        NULL
    ),
    (
        102,
        'Orange',
        '2022-12-13 22:09:11',
        NULL,
        NULL
    ),
    (
        103,
        'Pink',
        '2022-12-13 22:09:11',
        NULL,
        NULL
    ),
    (
        104,
        'purple',
        '2022-12-23 19:37:28',
        NULL,
        NULL
    );

-- --------------------------------------------------------
--
-- Structure de la table `produits`
--
CREATE TABLE `produits` (
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
VALUES
    (
        1,
        '8.jpg',
        'r-102',
        'iphone pro max 255 ssd',
        1300000,
        1,
        104,
        '2022-12-09 18:35:22',
        NULL,
        NULL
    ),
    (
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
    ),
    (
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
    ),
    (
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
    ),
    (
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
    ),
    (
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
    ),
    (
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
-- --------------------------------------------------------
--
-- Structure de la table `status`
--
CREATE TABLE `status` (
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
VALUES
    (
        1,
        'en attente',
        'secondary',
        '2022-12-16 20:29:56',
        NULL,
        NULL
    ),
    (
        2,
        'en cours',
        'info',
        '2022-12-16 20:29:56',
        NULL,
        NULL
    ),
    (
        3,
        'livré',
        'success',
        '2022-12-16 20:29:56',
        NULL,
        NULL
    ),
    (
        4,
        'annuler',
        'danger',
        '2022-12-16 20:29:56',
        NULL,
        NULL
    ),
    (
        5,
        'retour',
        'warning',
        '2022-12-16 20:29:56',
        NULL,
        NULL
    );

-- --------------------------------------------------------
-- --------------------------------------------------------
--
-- Index pour les tables déchargées
--
--
-- Index pour la table `categories`
--
ALTER TABLE
    `categories`
ADD
    PRIMARY KEY (`id`);

--
-- Index pour la table `clients`
--
ALTER TABLE
    `clients`
ADD
    PRIMARY KEY (`id`);

--
-- Index pour la table `commandes`
--
ALTER TABLE
    `commandes`
ADD
    PRIMARY KEY (`id`),
ADD
    KEY `client_id` (`client_id`),
ADD
    KEY `status_id` (`status_id`);

--
-- Index pour la table `commande_produit`
--
ALTER TABLE
    `commande_produit`
ADD
    PRIMARY KEY (`id`),
ADD
    KEY `commande_id` (`commande_id`),
ADD
    KEY `produit_id` (`produit_id`);

--
-- Index pour la table `couleurs`
--
ALTER TABLE
    `couleurs`
ADD
    PRIMARY KEY (`id`);

--
-- Index pour la table `produits`
--
ALTER TABLE
    `produits`
ADD
    PRIMARY KEY (`id`),
ADD
    KEY `categorie_id` (`categorie_id`),
ADD
    KEY `produits_ibfk_2` (`couleur_id`);

--
-- Index pour la table `status`
--
ALTER TABLE
    `status`
ADD
    PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--
--
-- AUTO_INCREMENT pour la table `categories`
--
ALTER TABLE
    `categories`
MODIFY
    `id` int(11) NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 6;

--
-- AUTO_INCREMENT pour la table `clients`
--
ALTER TABLE
    `clients`
MODIFY
    `id` int(11) NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 8;

--
-- AUTO_INCREMENT pour la table `commandes`
--
ALTER TABLE
    `commandes`
MODIFY
    `id` int(11) NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 7;

--
-- AUTO_INCREMENT pour la table `commande_produit`
--
ALTER TABLE
    `commande_produit`
MODIFY
    `id` int(11) NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 14;

--
-- AUTO_INCREMENT pour la table `couleurs`
--
ALTER TABLE
    `couleurs`
MODIFY
    `id` int(11) NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 105;

--
-- AUTO_INCREMENT pour la table `produits`
--
ALTER TABLE
    `produits`
MODIFY
    `id` int(11) NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 9;

--
-- AUTO_INCREMENT pour la table `status`
--
ALTER TABLE
    `status`
MODIFY
    `id` int(11) NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 6;

--
-- Contraintes pour les tables déchargées
--
--
-- Contraintes pour la table `commandes`
--
ALTER TABLE
    `commandes`
ADD
    CONSTRAINT `commandes_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON UPDATE CASCADE,
ADD
    CONSTRAINT `commandes_ibfk_2` FOREIGN KEY (`status_id`) REFERENCES `status` (`id`) ON UPDATE CASCADE;

--
-- Contraintes pour la table `commande_produit`
--
ALTER TABLE
    `commande_produit`
ADD
    CONSTRAINT `commande_produit_ibfk_1` FOREIGN KEY (`commande_id`) REFERENCES `commandes` (`id`) ON UPDATE CASCADE,
ADD
    CONSTRAINT `commande_produit_ibfk_2` FOREIGN KEY (`produit_id`) REFERENCES `produits` (`id`) ON UPDATE CASCADE;

--
-- Contraintes pour la table `produits`
--
ALTER TABLE
    `produits`
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