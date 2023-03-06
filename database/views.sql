
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


CREATE OR REPLACE VIEW COMMANDES_VIEW AS
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
WHERE c.deleted_at IS NULL;

CREATE OR REPLACE VIEW COMMANDE_PRODUITS_VIEW AS
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
	LEFT JOIN produits_view pv ON pv.id = cp.produit_id;