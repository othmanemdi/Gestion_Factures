ALTER TABLE
	commande_produit
ADD
	created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
ADD
	updated_at DATETIME NULL DEFAULT NULL
AFTER
	created_at,
ADD
	deleted_at DATETIME NULL DEFAULT NULL
AFTER
	updated_at;

SELECT
	p.*,
	c.nom As categorie_nom,
	cl.nom As couleur_nom
FROM
	produits p
	LEFT JOIN categories c ON c.id = p.categorie_id
	LEFT JOIN couleurs cl ON cl.id = p.couleur_id
ORDER BY
	p.id;

-- CREATE VIEW PRODUITS_VIEW AS
CREATE
OR REPLACE VIEW PRODUITS_VIEW AS
SELECT
	p.*,
	FORMAT(p.prix / 100, 2) As prix_decimale,
	c.nom As categorie_nom,
	cl.nom As couleur_nom
FROM
	produits p
	LEFT JOIN categories c ON c.id = p.categorie_id
	LEFT JOIN couleurs cl ON cl.id = p.couleur_id
WHERE
	p.deleted_at IS NULL
ORDER BY
	p.id;

select
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
from
	(
		(
			`gestion_factures`.`produits` `p`
			join `gestion_factures`.`categories` `c` on(`c`.`id` = `p`.`categorie_id`)
		)
		join `gestion_factures`.`couleurs` `cl` on(`cl`.`id` = `p`.`couleur_id`)
	)
where
	`p`.`deleted_at` is null
order by
	`p`.`id`;

select
	*
from
	couleurs;

select
	*
from
	produits;

CREATE
OR REPLACE VIEW COMMANDES_VIEW AS
SELECT
	c.*,
	CONCAT('BC-', LPAD(c.num, 4, 0)) AS commande_num,
	DATE_FORMAT(c.date_commande, "%d/%m/%Y") AS date_commande_format,
	cl.num AS client_num,
	LOWER(cl.nom) AS client_nom,
	LOWER(cl.email) AS client_email,
	LOWER(cl.ville) AS client_ville,
	LOWER(cl.adresse) AS client_adresse,
	LOWER(s.nom) AS status_nom,
	LOWER(s.color) AS status_color,
	IFNULL(cp.code, '') AS coupon_code,
	IFNULL(cp.montant, 0) AS coupon_montant
FROM
	commandes c
	LEFT JOIN clients cl ON cl.id = c.client_id
	LEFT JOIN status s ON s.id = c.status_id
	LEFT JOIN coupons cp ON cp.id = c.coupon_id
WHERE
	c.deleted_at IS NULL;

SELECT
	*
FROM
	commandes_view;

update
	produits
set
	image = '1.jpg'
where
	id = 1;

SELECT
	pv.*,
	cp.quantite,
	(pv.prix / 100) * cp.quantite AS prix_total
FROM
	commande_produit cp
	LEFT JOIN produits_view pv ON pv.id = cp.id;

CREATE
OR REPLACE VIEW COMMANDE_PRODUITS_VIEW AS
SELECT
	cp.id,
	pv.id As produit_id,
	pv.image,
	pv.reference,
	pv.designation,
	pv.prix,
	pv.prix_decimale,
	pv.categorie_nom,
	pv.couleur_nom,
	cp.quantite,
	FORMAT((pv.prix / 100) * cp.quantite, 2) AS prix_total,
	cp.commande_id
FROM
	commande_produit cp
	LEFT JOIN produits_view pv ON pv.id = cp.produit_id