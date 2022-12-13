ALTER TABLE categories
ADD
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP AFTER nom,
ADD
    updated_at DATETIME NULL DEFAULT NULL AFTER created_at,
ADD
    deleted_at DATETIME NULL DEFAULT NULL AFTER updated_at;

SELECT
    p.*,
    c.nom As categorie_nom,
    cl.nom As couleur_nom
FROM produits p
    INNER JOIN categories c ON c.id = p.categorie_id
    INNER JOIN couleurs cl ON cl.id = p.couleur_id
ORDER BY p.id;

-- CREATE VIEW PRODUITS_VIEW AS

CREATE OR REPLACE VIEW PRODUITS_VIEW AS 
	SELECT
	    p.*,
	    FORMAT(p.prix / 100, 2) As prix_decimale,
	    c.nom As categorie_nom,
	    cl.nom As couleur_nom
	FROM produits p
	    INNER JOIN categories c ON c.id = p.categorie_id
	    INNER JOIN couleurs cl ON cl.id = p.couleur_id
	WHERE p.deleted_at IS NULL
	ORDER BY p.id
; 

select * from couleurs;

select * from produits;